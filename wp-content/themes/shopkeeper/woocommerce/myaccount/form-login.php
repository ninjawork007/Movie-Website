<?php
/**
 * Login Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version 	3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<div class="row">
	
	<ul class="account-tab-list">
	 
		<li class="account-tab-item">
		    <a class="account-tab-link <?php echo ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' )  ? 'current':'registration_disabled' ?>" href="#login"><?php esc_html_e( 'Login', 'woocommerce' ); ?></a>
		</li>
		 
		<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>
			<li class="sep">/</li>
			<li class="account-tab-item last">
				<a class="account-tab-link" href="#register"><?php esc_html_e( 'Register', 'woocommerce' ); ?></a>
			</li>
		<?php endif; ?>
 
	</ul>

	<div class="medium-10 medium-centered large-6 large-centered columns">
		
		<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

		<div class="login-register-container">
				
					<div class="account-forms-container">
						
						
						<div class="account-forms">
							<form id="login" method="post" class="woocommerce-form woocommerce-form-login login login-form">
					
								<?php do_action( 'woocommerce_login_form_start' ); ?>

								<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
									<label for="username"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?> <span class="required">*</span></label>
									<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
								</p>
								<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
									<label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
									<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" />
								</p>

								<?php do_action( 'woocommerce_login_form' ); ?>

								<p class="form-row form-footer">
									<?php wp_nonce_field( 'woocommerce-login' ); ?>
									<button type="submit" class="woocommerce-Button button" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>"><?php esc_html_e( 'Login', 'woocommerce' ); ?></button>
									<br/><br/>
									<label for="rememberme" class="inline">
										<input class="woocommerce-Input woocommerce-Input--checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php esc_html_e( 'Remember me', 'woocommerce' ); ?>
									</label>
									<a class="lost-pass-link" href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
								</p>
								
								<?php do_action( 'woocommerce_login_form_end' ); ?>
							
							</form>
							
							
						<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>
								
							<form id="register" method="post" class="woocommerce-form woocommerce-form-register register register-form" <?php do_action( 'woocommerce_register_form_tag' ); ?> >
								
								<?php do_action( 'woocommerce_register_form_start' ); ?>

								<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

									<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
										<label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
										<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
									</p>

								<?php endif; ?>

								<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
									<label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
									<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
								</p>

								<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

									<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
										<label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
										<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
									</p>

								<?php else : ?>

									<p><?php esc_html_e( 'A password will be sent to your email address.', 'woocommerce' ); ?></p>

								<?php endif; ?>

								<?php do_action( 'woocommerce_register_form' ); ?>

								<p class="woocommerce-FormRow form-row">
									<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
									<button type="submit" class="woocommerce-Button button" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
								</p>

								<?php do_action( 'woocommerce_register_form_end' ); ?>

							</form><!-- .register-->
					
								
						<?php endif; ?>	
						</div><!-- .account-forms-->
						
					</div><!-- .account-forms-container-->
		</div><!-- .login-register-container-->
		
		<?php do_action( 'woocommerce_after_customer_login_form' ); ?>

	</div><!-- .large-6-->
</div><!-- .rows-->