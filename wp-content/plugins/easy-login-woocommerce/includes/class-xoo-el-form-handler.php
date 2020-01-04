<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Xoo_El_Form_Handler{

	//Process Login
	public static function process_login(){

		if ( isset($_POST['_xoo_el_form']) &&  $_POST['_xoo_el_form'] === 'login'  ) {
				
			try {

				$creds = array(
					'user_login'    => trim( $_POST['xoo-el-username'] ),
					'user_password' => $_POST['xoo-el-password'],
					'remember'      => isset( $_POST['xoo-el-rememberme'] ),
				);

				$validation_error = new WP_Error();
				$validation_error = apply_filters( 'xoo_el_process_login_errors', $validation_error,$creds );

				if ( $validation_error->get_error_code() ) {
					throw new Xoo_El_Exception( '<strong>' . __( 'Error:', 'easy-login-woocommerce' ) . '</strong> ' . $validation_error->get_error_message() );
				}

				if ( empty( $creds['user_login'] ) ) {
					throw new Xoo_El_Exception( '<strong>' . __( 'Error:', 'easy-login-woocommerce' ) . '</strong> ' . __( 'Username is required.', 'easy-login-woocommerce' ) );
				}

				// On multisite, ensure user exists on current site, if not add them before allowing login.
				if ( is_multisite() ) {
					$user_data = get_user_by( is_email( $creds['user_login'] ) ? 'email' : 'login', $creds['user_login'] );

					if ( $user_data && ! is_user_member_of_blog( $user_data->ID, get_current_blog_id() ) ) {
						add_user_to_blog( get_current_blog_id(), $user_data->ID, 'customer' );
					}
				}

				// Perform the login
				$user = wp_signon( apply_filters( 'xoo_el_login_credentials', $creds ), is_ssl() );

				if ( is_wp_error( $user ) ) {

					$message_code = $user->get_error_code();

					$lost_pw_text = ' <a class="xoo-el-lostpw-tgr">' .
						__( 'Lost your password?','easy-login-woocommerce' ).
						'</a>';

					$show_lostpw_on_errors = array(
						'incorrect_password', 'invalid_username', 'invalid_email'
					);

					if( in_array( $message_code, $show_lostpw_on_errors ) ){
						$message  = __( 'Incorrect Email or Username.','easy-login-woocommerce' ).$lost_pw_text;
					}
					else{
						$message = $user->get_error_message();
						$message = str_replace( '<strong>' . esc_html( $creds['user_login'] ) . '</strong>', '<strong>' . esc_html( $creds['user_login'] ) . '</strong>', $message );
					}
					throw new Xoo_El_Exception( $message );

				} else {

					if ( ! empty( $_POST['redirect'] ) ) {
						$redirect = $_POST['redirect'];
					}

					$redirect = wp_validate_redirect( apply_filters( 'xoo_el_login_redirect', $redirect ) );

					return array(
						'error' 	=> 0,
						'notice' 	=> xoo_el_add_notice('success','<i class="fa fa-check-circle" aria-hidden="true"></i> '.__('Login successful')),
						'redirect' 	=> $redirect
					);

				}
			} catch ( Xoo_El_Exception $e ) {
				$error = apply_filters( 'login_errors', $e->getMessage() );
				do_action( 'xo_el_login_failed' );

				return array(
					'error'			=> 1,
					'error_code' 	=> $e->getWpErrorCode(),
					'notice' 	=> xoo_el_add_notice('error', $message, $e->getWpErrorCode()),
				);

			}
		}

	}


	/**
	 * Process the registration form.
	 */
	public static function process_registration() {

		if ( isset($_POST['_xoo_el_form']) &&  $_POST['_xoo_el_form'] === 'register' ) {
			$username 		= isset( $_POST['xoo_el_reg_username'] ) ? $_POST['xoo_el_reg_username'] : '';
			$password 		= $_POST['xoo_el_reg_pass'];
			$email    		= $_POST['xoo_el_reg_email'];

			$reg_extra_data = array();

			try {

				$validation_error = new WP_Error();
				$validation_error = apply_filters( 'xoo_el_process_registration_errors', $validation_error, $username, $password, $email );

				if ( $validation_error->get_error_code() ) {
					throw new Xoo_El_Exception( $e );
				}

				$reg_admin_fields = xoo_aff()->get_fields_data();


				if( !empty( $reg_admin_fields ) ){
					foreach ( $reg_admin_fields as $field_id => $field_data ) {

						$settings = $field_data[ 'settings' ];
						if( empty( $settings ) ) continue;

						//If active & required & empty user input , throw error
						if( $settings['active'] === "yes" && $settings['required'] === "yes" &&  ( !isset( $_POST[ $field_id ] ) || trim( $_POST[$field_id ] ) == '' )  ){

							$label = $settings['show_label'] === "yes" && isset( $settings['label_text'] ) && !empty( $settings['label_text'] ) ? $settings['label_text'] : $settings['placeholder'];

							switch ( $field_id ) {
								case 'xoo_el_reg_terms':
									$error = __( 'Please accept the terms and conditions', 'easy-login-woocommerce' );
									break;
								
								default:
									$error = sprintf( esc_attr__( '%s cannot be empty', 'easy-login-woocommerce' ), $label );
									break;
							}
							
							throw new Xoo_El_Exception( $error );
						}

						//Add extra data for custom fields
						if( strpos( $field_id , 'xoo_el_' ) === false ){
							$reg_extra_data[ $field_id ] = $_POST[ $field_id ];
						}
					}
					
				}

				if( $reg_admin_fields['xoo_el_reg_pass_again']['settings']['active'] === "yes" && $password !== $_POST['xoo_el_reg_pass_again'] ){
					throw new Xoo_El_Exception( __("Passwords don't match","easy-login-woocommerce") );
				}

				$reg_extra_data['first_name'] 	= sanitize_text_field( $_POST['xoo_el_reg_fname'] );
				$reg_extra_data['last_name'] 	= sanitize_text_field( $_POST['xoo_el_reg_lname'] );

				$new_customer = self::create_customer( sanitize_email( $email ), sanitize_text_field( $username ), $password, $reg_extra_data );


				if ( is_wp_error( $new_customer ) ) {
					throw new Xoo_El_Exception( $new_customer );
				}

				$user = wp_authenticate( $email, $password );

				if( is_wp_error( $user ) ){
					throw new Xoo_El_Exception($user);
				}

				wp_set_auth_cookie( $new_customer, true );

				if ( ! empty( $_POST['redirect'] ) ) {
					$redirect = wp_sanitize_redirect( $_POST['redirect'] );
				}

				$redirect = wp_validate_redirect( apply_filters( 'xoo_el_registration_redirect', $redirect ) );

				$success_notice = '<i class="fa fa-check-circle" aria-hidden="true"></i> '.__('Registration successful','easy-login-woocommerce');

				//If user verification plugin is activated , handle verification notice
				if( class_exists('Xoo_Uv') ){
					$success_notice = xoo_get_template( 'xoo-el-user-verification-notice.php', XOO_EL_PATH.'/templates/global', $args, true );
				}

				return array(
					'error' => 0,
					'notice' => xoo_el_add_notice('success',$success_notice),
					'redirect' => $redirect
				);

			} catch ( Xoo_El_Exception $e ) {

				$message= apply_filters( 'xoo_el_registration_errors', $e->getMessage() );
				do_action('xoo_el_registration_failed');

				return array(
					'error' 		=> 1,
					'error_code' 	=> $e->getWpErrorCode(),
					'notice' 		=> xoo_el_add_notice('error', $message, $e->getWpErrorCode()),
				);
			}
		}
	}


	//Create new user
	public static function create_customer( $email, $username = '', $password = '', $extra_data = array() ){

		// Check the email address.
		if ( empty( $email ) || ! is_email( $email ) ) {
			return new WP_Error( 'registration-error-invalid-email', __( 'Please provide a valid email address.', 'easy-login-woocommerce' ) );
		}

		if ( email_exists( $email ) ) {
			return new WP_Error( 'registration-error-email-exists',  __( 'An account is already registered with your email address. Please log in.', 'easy-login-woocommerce' ) );
		}

		// Handle username creation.
		if ( !empty( $username ) ) {
			$username = sanitize_user( $username );

			if ( empty( $username ) || ! validate_username( $username ) ) {
				return new WP_Error( 'registration-error-invalid-username', __( 'Please enter a valid account username.', 'easy-login-woocommerce' ) );
			}

			if ( username_exists( $username ) ) {
				return new WP_Error( 'registration-error-username-exists', __( 'An account is already registered with that username. Please choose another.', 'easy-login-woocommerce' ) );
			}
		} else {
			$username = sanitize_user( current( explode( '@', $email ) ), true );

			// Ensure username is unique.
			$append     = 1;
			$o_username = $username;

			while ( username_exists( $username ) ) {
				$username = $o_username . $append;
				$append++;
			}
		}

		// Handle password creation.
		if ( empty( $password ) ) {
			return new WP_Error( 'registration-error-missing-password', __( 'Please enter an account password.', 'easy-login-woocommerce' ) );
		}

		$gl_options = get_option('xoo-el-general-options');

		$customer_data = array(
			'user_login' => $username,
			'user_pass'  => $password,
			'user_email' => $email,
			'role'       => esc_attr( $gl_options['m-user-role'] ),
		);
		
		$new_customer_data = apply_filters( 'xoo_el_register_new_customer_data', $customer_data );

		$customer_id = wp_insert_user( $new_customer_data );

		if ( is_wp_error( $customer_id ) ) {
			return new WP_Error( 'registration-error', __( 'Couldn&#8217;t register you&hellip; please contact us if you continue to have problems.', 'easy-login-woocommerce' ) );
		}

		$extra_data = apply_filters( 'xoo_el_register_customer_extra_data', $extra_data );
		
		foreach ( $extra_data as $meta_id => $meta_value ) {
			update_user_meta( $customer_id, $meta_id, $meta_value );
		}

		do_action( 'xoo_el_created_customer', $customer_id, $new_customer_data);

		if(class_exists('woocommerce')){
			do_action( 'woocommerce_created_customer', $customer_id, $new_customer_data, $password_generated );
		}

		return $customer_id;
	}


	// Process lost password form
	public static function process_lost_password(){
		if(isset($_POST['_xoo_el_form']) &&  $_POST['_xoo_el_form'] === 'lostPassword'){

			try{

				if( class_exists( 'woocommerce' ) ){

					wc_clear_notices(); // clear notices
					$success = WC_Shortcode_My_Account::retrieve_password();

					if($success){
						ob_start();
						wc_get_template( 'myaccount/lost-password-confirmation.php' );
						$lost_password_confirmation = ob_get_clean();
					}
					else{
						$errors = wc_get_notices('error');
						$error = 1;
						throw new Xoo_El_Exception(  $errors[0] );
					}

				}
				else{

					$success = self::retrieve_password();
					
					if( is_wp_error( $success ) ){
						throw new Xoo_El_Exception( $success );
					}
					else{
						$lost_password_confirmation = __( 'A password reset email has been sent to the email address on file for your account, but may take several minutes to show up in your inbox. Please wait at least 10 minutes before attempting another reset.', 'easy-login-woocommerce' );
					}
				}

				$notice = '<div class="xoo-el-lostpw-success">'.$lost_password_confirmation.'</div>';

				return array(
					'error' 	=> 0,
					'notice' 	=> xoo_el_add_notice('success', $notice),
					'redirect' 	=> $redirect
				);

			}
			catch( Xoo_El_Exception $e ){

				$message= apply_filters( 'xoo_el_password_reset_errors', $e->getMessage() );
				do_action( 'xo_el_password_reset_failed' );

				return array(
					'error' 	=> 1,
					'error_code' 	=> $e->getWpErrorCode(),
					'notice' 	=> xoo_el_add_notice('error', $message, $e->getWpErrorCode()),
				);

			}
		}
	}

	public static function retrieve_password() {
		$errors = new WP_Error();

		if ( empty( $_POST['user_login'] ) || ! is_string( $_POST['user_login'] ) ) {
			$errors->add('empty_username', __('<strong>ERROR</strong>: Enter a username or email address.','easy-login-woocommerce' ));
		} elseif ( strpos( $_POST['user_login'], '@' ) ) {
			$user_data = get_user_by( 'email', trim( wp_unslash( $_POST['user_login'] ) ) );
			if ( empty( $user_data ) )
				$errors->add('invalid_email', __('<strong>ERROR</strong>: There is no user registered with that email address.','easy-login-woocommerce' ));
		} else {
			$login = trim($_POST['user_login']);
			$user_data = get_user_by('login', $login);
		}

		/**
		 * Fires before errors are returned from a password reset request.
		 *
		 * @since 2.1.0
		 * @since 4.4.0 Added the `$errors` parameter.
		 *
		 * @param WP_Error $errors A WP_Error object containing any errors generated
		 *                         by using invalid credentials.
		 */
		do_action( 'lostpassword_post', $errors );

		if ( $errors->get_error_code() )
			return $errors;

		if ( !$user_data ) {
			$errors->add('invalidcombo', __('<strong>ERROR</strong>: Invalid username or email.','easy-login-woocommerce' ));
			return $errors;
		}

		// Redefining user_login ensures we return the right case in the email.
		$user_login = $user_data->user_login;
		$user_email = $user_data->user_email;
		$key = get_password_reset_key( $user_data );

		if ( is_wp_error( $key ) ) {
			return $key;
		}

		if ( is_multisite() ) {
			$site_name = get_network()->site_name;
		} else {
			/*
			 * The blogname option is escaped with esc_html on the way into the database
			 * in sanitize_option we want to reverse this for the plain text arena of emails.
			 */
			$site_name = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
		}

		$message = __( 'Someone has requested a password reset for the following account:','easy-login-woocommerce' ) . "\r\n\r\n";
		/* translators: %s: site name */
		$message .= sprintf( __( 'Site Name: %s','easy-login-woocommerce' ), $site_name ) . "\r\n\r\n";
		/* translators: %s: user login */
		$message .= sprintf( __( 'Username: %s','easy-login-woocommerce' ), $user_login ) . "\r\n\r\n";
		$message .= __( 'If this was a mistake, just ignore this email and nothing will happen.','easy-login-woocommerce' ) . "\r\n\r\n";
		$message .= __( 'To reset your password, visit the following address:','easy-login-woocommerce' ) . "\r\n\r\n";
		$message .= '<' . network_site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user_login ), 'login' ) . ">\r\n";

		/* translators: Password reset email subject. %s: Site name */
		$title = sprintf( __( '[%s] Password Reset','easy-login-woocommerce' ), $site_name );

		/**
		 * Filters the subject of the password reset email.
		 *
		 * @since 2.8.0
		 * @since 4.4.0 Added the `$user_login` and `$user_data` parameters.
		 *
		 * @param string  $title      Default email title.
		 * @param string  $user_login The username for the user.
		 * @param WP_User $user_data  WP_User object.
		 */
		$title = apply_filters( 'retrieve_password_title', $title, $user_login, $user_data );

		/**
		 * Filters the message body of the password reset mail.
		 *
		 * If the filtered message is empty, the password reset email will not be sent.
		 *
		 * @since 2.8.0
		 * @since 4.1.0 Added `$user_login` and `$user_data` parameters.
		 *
		 * @param string  $message    Default mail message.
		 * @param string  $key        The activation key.
		 * @param string  $user_login The username for the user.
		 * @param WP_User $user_data  WP_User object.
		 */
		$message = apply_filters( 'retrieve_password_message', $message, $key, $user_login, $user_data );

		if ( $message && !wp_mail( $user_email, wp_specialchars_decode( $title ), $message ) )
			return new WP_Error( 'xoo-el-mail-error', __('The email could not be sent.','easy-login-woocommerce' ) . "<br />\n" . __('Possible reason: your host may have disabled the mail() function.','easy-login-woocommerce' ) );

		return true;
	}


}

?>