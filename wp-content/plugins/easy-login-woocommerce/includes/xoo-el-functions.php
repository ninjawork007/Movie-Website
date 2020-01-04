<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

//Menu items filter
if( !function_exists( 'xoo_el_nav_menu_items' ) ):
	function xoo_el_nav_menu_items( $items ) {

		if( empty( $items ) || !is_array( $items ) ) return;


		$actions_classes = array(
			'xoo-el-login-tgr',
			'xoo-el-reg-tgr',
			'xoo-el-lostpw-tgr',
			'xoo-el-logout-menu',
			'xoo-el-myaccount-menu',
			'xoo-el-username-menu'
		);

		$user = wp_get_current_user();

		foreach ( $items as $key => $item ) {

			$classes = $item->classes;

			if( !empty( $action_class = array_values( array_intersect( $actions_classes, $classes ) ) ) ){

				$action_class = $action_class[0];

				if( is_user_logged_in() ){

					if( $action_class === "xoo-el-myaccount-menu" ){
						//do nothing
						continue;
					}
					elseif( $action_class === "xoo-el-logout-menu" ){
						if( $item->url ) continue;
						$gl_options = get_option('xoo-el-general-options');
						$logout_redirect = !empty( $gl_options['m-logout-url'] ) ? $gl_options['m-logout-url'] : $_SERVER['REQUEST_URI'];
						$item->url = wp_logout_url($logout_redirect);
					}
					elseif( $action_class === "xoo-el-username-menu" ){
						$item->title = get_avatar($user->ID).str_replace( 'username' , $user->user_login , $item->title );
						if( class_exists('woocommerce') ){
							$item->url 	 = wc_get_page_permalink( 'myaccount' );
						}
					}
					else{
						unset($items[$key]);
					}

				}
				else{
					if( $action_class === "xoo-el-logout-menu" || $action_class === "xoo-el-myaccount-menu" ||  $action_class === "xoo-el-username-menu" ){
						unset($items[$key]);
					}

				}

			}
		}

		return $items;
	}
	add_filter('wp_nav_menu_objects','xoo_el_nav_menu_items',11);
endif;

//Internationalization
if( !function_exists( 'xoo_el_load_plugin_textdomain' ) ):
	function xoo_el_load_plugin_textdomain() {
		$domain = 'easy-login-woocommerce';
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );
		load_textdomain( $domain, WP_LANG_DIR . '/'.$domain.'-' . $locale . '.mo' ); //wp-content languages
		load_plugin_textdomain( $domain, FALSE, basename( dirname( __FILE__ ) ) . '/languages/' ); // Plugin Languages
	}
	add_action('plugins_loaded','xoo_el_load_plugin_textdomain',100);
endif;


//Get tempalte
if( !function_exists( 'xoo_get_template' ) ){
	function xoo_get_template ( $template_name, $path = '', $args = array(), $return = false ) {

	    $located = xoo_locate_template ( $template_name, $path );

	    if ( $args && is_array ( $args ) ) {
	        extract ( $args );
	    }

	    if ( $return ) {
	        ob_start ();
	    }

	    // include file located
	    if ( file_exists ( $located ) ) {
	        include ( $located );
	    }

	    if ( $return ) {
	        return ob_get_clean ();
	    }
	}
}


//Locate template
if( !function_exists( 'xoo_locate_template' ) ){
	function xoo_locate_template ( $template_name, $template_path ) {

	    // Look within passed path within the theme - this is priority.
		$template = locate_template(
			array(
				'templates/' . $template_name,
				$template_name,
			)
		);

		//Check woocommerce directory for older version
		if( !$template && class_exists( 'woocommerce' ) ){
			if( file_exists( WC()->plugin_path() . '/templates/' . $template_name ) ){
				$template = WC()->plugin_path() . '/templates/' . $template_name;
			}
		}

	    if ( ! $template ) {
	        $template = trailingslashit( $template_path ) . $template_name;
	    }

	    return $template;
	}
}

//Inline Form Shortcode
if( !function_exists( 'xoo_el_inline_form' ) ){
	function xoo_el_inline_form_shortcode($user_atts){

		$atts = shortcode_atts( array(
			'active'	=> 'login',
		), $user_atts, 'xoo_el_inline_form');

		if( is_user_logged_in() ) return;

		$args = array(
			'form_class' => 'xoo-el-form-inline',
			'form_active' => $atts['active']
		); 
		
		xoo_get_template( 'xoo-el-form.php', XOO_EL_PATH.'/templates/', $args );

	}
	add_shortcode( 'xoo_el_inline_form', 'xoo_el_inline_form_shortcode' );
}

//Add notice
function xoo_el_add_notice( $notice_type = 'error', $message, $notice_class = null ){

	$classes = $notice_type === 'error' ? 'xoo-el-notice-error' : 'xoo-el-notice-success';
	
	$classes .= ' '.$notice_class;

	$html = '<div class="'.$classes.'">'.$message.'</div>';
	
	return apply_filters('xoo_el_notice_html',$html,$message,$classes);
}

//Print notices
function xoo_el_print_notices( $form_type = null, $notices = null ){

	global $limit_login_attempts_obj;

	$av_options = (array) get_option( 'xoo-el-advanced-options' );

	if($form_type === 'login' && !xoo_el_is_limit_login_ok() ){
		$notices .= '<div class="xoo-el-lla-notice"><div class="xoo-el-notice-error">'.$limit_login_attempts_obj->error_msg().'</div></div>';
	}

	$notices .= '<div class="xoo-el-notice"></div>';
	echo $notices;
}


//Is limit login ok
function xoo_el_is_limit_login_ok(){
	global $limit_login_attempts_obj;
	//return if limit login plugin doesn't exist
	if( !$limit_login_attempts_obj ) return true;

	return $limit_login_attempts_obj->is_limit_login_ok();

}

//Override woocommerce form login template
function xoo_el_override_myaccount_login_form( $located, $template_name, $args, $template_path, $default_path ){

	$gl_options 	  = get_option('xoo-el-general-options');
	$enable_myaccount = $gl_options['m-en-myaccount-page'];

	if( $template_name === 'myaccount/form-login.php' && $enable_myaccount === "yes" ){
		$located = xoo_locate_template( 'xoo-el-wc-form-login.php', XOO_EL_PATH.'/templates/' );
	}
	return $located;
}
add_filter( 'wc_get_template', 'xoo_el_override_myaccount_login_form', 10, 5 );


?>