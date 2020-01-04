<?php
/**
 * Customizer
 *
 * @package shopkeeper
 */

if ( SHOPKEEPER_KIRKI_IS_ACTIVE ) {
    include_once( get_template_directory() . '/inc/customizer/backend/config.php' );
	include_once( get_template_directory() . '/inc/customizer/backend/sections.php' );
    include_once( get_template_directory() . '/inc/customizer/backend/fields.php' );
}

?>
