<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


class Xoo_El_Core{

	protected static $_instance = null;

	public static function get_instance(){
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}


	public function __construct(){

		//Field framework
		require_once XOO_EL_PATH.'/xoo-form-fields-fw/xoo-aff.php';
		xoo_aff_fire(); // start framework
		
		require_once XOO_EL_PATH.'includes/class-xoo-el-exception.php';
		require_once XOO_EL_PATH.'includes/xoo-el-functions.php';

		if($this->is_request('frontend')){
			require_once XOO_EL_PATH.'includes/class-xoo-el-frontend.php';
			require_once XOO_EL_PATH.'includes/class-xoo-el-form-handler.php';
			require_once XOO_EL_PATH.'includes/class-xoo-el-actions.php';
		}

		if ($this->is_request('admin')) {

			require_once XOO_EL_PATH.'admin/xoo-el-admin-settings.php';
			require_once XOO_EL_PATH.'admin/class-xoo-el-aff-fields.php';
			require_once XOO_EL_PATH.'admin/includes/class-xoo-el-menu-settings.php';

			//Instantiating classes
			xoo_el_admin_settings();

		}

		add_action( 'wp_loaded', array( $this, 'on_install' ) );
		add_action( 'init', array( $this, 'start_session') );
		
	}



	/**
	 * What type of request is this?
	 *
	 * @param  string $type admin, ajax, cron or frontend.
	 * @return bool
	 */
	private function is_request( $type ) {
		switch ( $type ) {
			case 'admin':
				return is_admin();
			case 'ajax':
				return defined( 'DOING_AJAX' );
			case 'cron':
				return defined( 'DOING_CRON' );
			case 'frontend':
				return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
		}
	}


	/**
	* On install
	*/
	public function on_install(){

		$version_option = 'xoo-el-version';
		$db_version 	= get_option( $version_option );
		//Check if installed version is lower than the installed version
		if( version_compare( $db_version, '1.3', '<' ) ){
			//Map old values to new option
			$current_gl_value = get_option( 'xoo-el-gl-options' );
			if( $current_gl_value ){
				//changing 1 to yes
				if( isset( $current_gl_value['m-en-reg'] ) && $current_gl_value['m-en-reg'] == '1' ){
					$current_gl_value['m-en-reg'] = 'yes';
				}
				update_option( 'xoo-el-general-options', $current_gl_value );
			}
		}

		if( version_compare( $db_version, XOO_EL_VERSION, '<') ){
			//Update to current version
			update_option( $version_option, XOO_EL_VERSION);
		}
	}


	/* Start session */
	public function start_session(){
		if ( !session_id() && !is_admin() ) {
			session_start();
		}
	}


}


?>