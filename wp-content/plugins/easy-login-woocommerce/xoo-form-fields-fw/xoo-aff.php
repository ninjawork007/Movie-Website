<?php

if( !defined( 'XOO_AFF_DIR' ) ){
	define( 'XOO_AFF_DIR', dirname(__FILE__) );
}

if( !defined( 'XOO_AFF_URL' ) ){
	define( 'XOO_AFF_URL', plugins_url( '', __FILE__  ) );
}

if( !defined( 'XOO_AFF_VERSION' ) ){
	define( 'XOO_AFF_VERSION', '1.0' );
}

//Begin
function xoo_aff_fire(){
	
	include XOO_AFF_DIR.'/includes/class-xoo-aff.php';
	xoo_aff(); // get instance

	do_action( 'xoo_aff_loaded' );
	
}
?>