<?php

class Xoo_Aff_Admin{

	protected static $_instance = null;

	protected $page_slug;

	public static function get_instance(){
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct(){
		$this->includes();
	}

	public function register_page( $page_slug ){

		$this->page_slug = $page_slug;
		//Load dependencies on register
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) ); 
		add_action( 'admin_footer', array( $this, 'templates') );

		do_action( 'xoo_aff_on_field_page' );
		
	}

	public function enqueue_scripts(){

		if( !isset( $_GET['page'] ) || $_GET['page'] !== $this->page_slug ) return; // Load scripts only on plugin page

		wp_enqueue_style( 'jquery-ui-css', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css' ); // Jquery UI CSS
		wp_enqueue_style( 'xoo-aff-fa', 'https://use.fontawesome.com/releases/v5.5.0/css/all.css' ); //Font Awesome
		wp_enqueue_style( 'xoo-aff-fa-picker', XOO_AFF_URL.'/lib/fontawesome-iconpicker/dist/css/fontawesome-iconpicker.min.css', array(), XOO_AFF_VERSION, 'all' ); //Font Awesome Icon Picker
		wp_enqueue_style( 'xoo-aff-admin-style', XOO_AFF_URL . '/admin/assets/css/xoo-aff-admin-style.css', array(), XOO_AFF_VERSION, 'all' );

		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script('jquery-ui-selectable');
		wp_enqueue_script('jquery-ui-sortable');

		wp_enqueue_script( 'xoo-aff-fa-pickers', XOO_AFF_URL.'/lib/fontawesome-iconpicker/dist/js/fontawesome-iconpicker.js', array( 'jquery'), XOO_AFF_VERSION, false );

		wp_enqueue_script( 'xoo-aff-admin-js', XOO_AFF_URL . '/admin/assets/js/xoo-aff-admin-js.js', array( 'jquery','wp-color-picker'), XOO_AFF_VERSION, false );
		wp_localize_script( 'xoo-aff-admin-js', 'xoo_aff_localize', array(
			'ajax_url' =>  admin_url().'admin-ajax.php',
		));
	}

	public function includes(){
		include XOO_AFF_DIR.'/admin/class-xoo-aff-fields.php';
		xoo_aff_fields();
	}

	public function templates(){
		include XOO_AFF_DIR.'/admin/templates/xoo-aff-template-scripts.php';
	}

	//Called by main plugin to display settings
	public function display_settings(){
		include XOO_AFF_DIR.'/admin/templates/xoo-aff-page-markup.php';
	}

}

function xoo_aff_admin(){
	return Xoo_Aff_Admin::get_instance();
}


?>