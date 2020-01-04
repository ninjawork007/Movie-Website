<?php
/**
 * Theme styles
 *
 * @package shopkeeper
 */

/**
 * Vendor styles
 */
function shopkeeper_vendor_styles() {
    wp_enqueue_style( 'animate', 		get_template_directory_uri() . '/css/vendor/animate.css', NULL, '1.0.0', 'all' );
    wp_enqueue_style( 'fresco', 		get_template_directory_uri() . '/css/vendor/fresco/fresco.css', NULL, '2.2.2', 'all' );
    wp_enqueue_style( 'easyzoom', 		get_template_directory_uri() . '/css/vendor/easyzoom.css', NULL, '2.4.0', 'all' );
    wp_enqueue_style( 'nanoscroller',   get_template_directory_uri() . '/css/vendor/nanoscroller.css', NULL, '0.7.6', 'all' );
    wp_enqueue_style( 'select2', 		get_template_directory_uri() . '/css/vendor/select2.css', NULL, '4.0.5', 'all' );
    wp_enqueue_style( 'swiper', 		get_template_directory_uri() . '/css/vendor/swiper.css', NULL, '4.4.6', 'all' );
}
add_action( 'wp_enqueue_scripts', 'shopkeeper_vendor_styles' );

/**
 * Theme styles
 */
function shopkeeper_theme_styles() {

    if( Shopkeeper_Opt::getOption( 'smooth_transition_between_pages', false ) ) {
        wp_enqueue_style( 'shopkeeper-page-in-out', get_template_directory_uri() . '/css/page-in-out.css', NULL, shopkeeper_theme_version(), 'all' );
    }

    wp_enqueue_style( 'shopkeeper-icon-font',       get_template_directory_uri() . '/inc/fonts/shopkeeper-icon-font/style.css', NULL, shopkeeper_theme_version(), 'all' );
    wp_enqueue_style( 'shopkeeper-styles',          get_template_directory_uri() . '/css/styles.css', NULL, shopkeeper_theme_version(), 'all' );
    wp_enqueue_style( 'shopkeeper-default-style',   get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'shopkeeper_theme_styles', 99 );

/**
 * Plugin styles
 */
function shopkeeper_plugin_styles() {
    if( SHOPKEEPER_GERMAN_MARKET_IS_ACTIVE || SHOPKEEPER_WOOCOMMERCE_GERMANIZED_IS_ACTIVE ) {
        wp_enqueue_style( 'shopkeeper-german-market-styles', get_template_directory_uri() . '/css/plugins/german-market.css', NULL, shopkeeper_theme_version(), 'all' );
    }

    if ( SHOPKEEPER_DOKAN_MULTIVENDOR_IS_ACTIVE ) {
        wp_enqueue_style( 'shopkeeper-dokan-styles', get_template_directory_uri() . '/css/plugins/dokan.css', NULL, shopkeeper_theme_version(), 'all' );
    }

    if ( SHOPKEEPER_WOOCOMMERCE_PRODUCT_ADDONS_IS_ACTIVE ) {
        wp_enqueue_style( 'shopkeeper-addons-styles', get_template_directory_uri() . '/css/plugins/woo-addons.css', NULL, shopkeeper_theme_version(), 'all' );
    }

    if( SHOPKEEPER_WISHLIST_IS_ACTIVE ) {
        wp_enqueue_style( 'shopkeeper-wishlist-styles', get_template_directory_uri() . '/css/plugins/wishlist.css', NULL, shopkeeper_theme_version(), 'all' );
    }

    if( SHOPKEEPER_ELEMENTOR_IS_ACTIVE ) {
        wp_enqueue_style( 'shopkeeper-elementor-styles', get_template_directory_uri() . '/css/plugins/elementor.css', NULL, shopkeeper_theme_version(), 'all' );
    }
}
add_action( 'wp_enqueue_scripts', 'shopkeeper_plugin_styles', 100 );

?>
