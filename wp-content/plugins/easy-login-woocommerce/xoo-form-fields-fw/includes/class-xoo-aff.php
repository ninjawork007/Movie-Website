<?php

class Xoo_Aff{

	protected static $_instance = null;

	protected static $db_field = 'xoo_aff_fields';

	public static function get_instance(){
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct(){
		$this->includes();
	}

	public function includes(){

		include XOO_AFF_DIR.'/includes/xoo-aff-functions.php';

		if( $this->is_request( 'admin' ) ){
			xoo_aff_get_template( 'class-xoo-aff-admin.php', XOO_AFF_DIR.'/admin/'  );
			xoo_aff_admin();
		}

	}


	//Enqueue scripts from the main plugin
	public function enqueue_scripts(){

		wp_enqueue_style( 'xoo-aff-style', XOO_AFF_URL.'/assets/css/xoo-aff-style.css', array(), XOO_AFF_VERSION) ;
		wp_enqueue_style( 'xoo-aff-font-awesome5', 'https://use.fontawesome.com/releases/v5.5.0/css/all.css' );

		$fields = $this->get_fields_data();

		$has_date = $datepicker_data = false;
		if( !empty( $fields ) ){
			foreach ( $fields as $field_id => $field_data) {
				if( !isset( $field_data['type'] ) ) continue;
				if( $field_data['type'] === "date" ){
					$has_date = true;
					$args = array(
						'dateFormat' => isset( $field_data['settings']['dateformat'] ) ? $field_data['settings']['dateformat'] : "yy-mm-dd",
					);

					$user_args = apply_filters( 'xoo_aff_datepicker_args', array(
						'changeMonth' => true,
						'changeYear'  => true,
						'yearRange' => 'c-100:c+10',
					), $field_id  );

					$datepicker_data[] = array(
						'id' 		=> $field_id,
						'args' 		=> array_merge( $args, $user_args )		
					);
				}
			}
		}

		if( $has_date ){
			wp_enqueue_style( 'jquery-ui-css', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css' );
			wp_enqueue_script('jquery-ui-datepicker');
		}

		wp_enqueue_script( 'xoo-aff-js', XOO_AFF_URL.'/assets/js/xoo-aff-js.js', array( 'jquery' ), XOO_AFF_VERSION, true );
		wp_localize_script('xoo-aff-js','xoo_aff_localize',array(
			'adminurl'  			=> admin_url().'admin-ajax.php',
			'datepicker_data'		=> json_encode( $datepicker_data )
		));


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

	public function get_fields_data(){
		return json_decode( get_option( self::$db_field ), true );
	}

	public function get_fields_html(){
		xoo_aff_get_template( 'xoo-aff-fields.php', XOO_AFF_DIR.'/includes/templates/' );
	}

}

function xoo_aff(){
	return Xoo_Aff::get_instance();
}

?>