<?php

class Xoo_Aff_Settings{

	protected static $_instance = null;

	public static function get_instance(){
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function includes(){
		include XOO_AFF_DIR.'/admin/settings/templates/topfields.php';
	}

}

?>