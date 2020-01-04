<?php
/**
 * Admin scripts
 *
 * @package shopkeeper
 */

/**
 * Admin scripts
 */
function shopkeeper_admin_scripts() {
    if ( is_admin() ) {
        wp_enqueue_script( 'shopkeeper-customizer', get_template_directory_uri() . '/js/components/wp-customizer.js', array( 'jquery' ), shopkeeper_theme_version(), TRUE );
        wp_enqueue_script( 'shopkeeper-notices',    get_template_directory_uri() . '/js/components/admin-notices.js', array( 'jquery' ), shopkeeper_theme_version(), TRUE );
    }
}
add_action( 'admin_enqueue_scripts', 'shopkeeper_admin_scripts' );

/**
 * Deactivate AJAX Add to Cart when incompatible plugin is active
 */
function shopkeeper_customizer_deactivate_ajax_add_to_cart() {

	$active_option['active_option'] = '1';
	$active_option['plugin'] = '';

	if( class_exists('WC_Product_Addons') ) {
		$active_option['active_option'] = '0';
		$active_option['plugin'] .= 'incompatible-woo-addons ';
	}

	if( class_exists('Wcff') ) {
		$active_option['active_option'] = '0';
		$active_option['plugin'] .= 'incompatible-fields-factory ';
	}

	wp_localize_script( 'shopkeeper-customizer', 'getbowtied_customizer_vars', $active_option );
}
if( SHOPKEEPER_WOOCOMMERCE_IS_ACTIVE ) {
    add_action( 'admin_enqueue_scripts', 'shopkeeper_customizer_deactivate_ajax_add_to_cart' );
}

?>
