<?php
/**
* Plugin Name: Login/Signup Popup ( Inline Form + Woocommerce )
* Plugin URI: http://xootix.com/easy-login-for-woocommerce
* Author: XootiX
* Version: 1.3
* Text Domain: easy-login-woocommerce
* Domain Path: /languages
* Author URI: http://xootix.com
* Description: Allow users to login/signup anywhere from the site with the simple pop up.
* Tags: woocommerce login, woocommerce signup, woocommerce mobile login, otp login, login popup 
*/


//Exit if accessed directly
if(!defined('ABSPATH')){
	return;
}

define("XOO_EL_PATH",plugin_dir_path(__FILE__)); // Plugin path
define("XOO_EL_URL",plugins_url('',__FILE__)); // plugin url
define("XOO_EL_PLUGIN_BASENAME",plugin_basename( __FILE__ ));
define("XOO_EL_VERSION","1.3"); //Plugin version

/**
 * Check if WooCommerce is activated
 *
 * @since    1.0.0
 */
function xoo_el_init(){
	

	do_action('xoo_el_before_plugin_activation');

	if ( ! class_exists( 'Xoo_El_Core' ) ) {
		require XOO_EL_PATH.'/includes/class-xoo-el-core.php';
	}

	Xoo_El_Core::get_instance();

	
}
add_action('plugins_loaded','xoo_el_init');