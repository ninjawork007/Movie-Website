<?php
/**
 * Theme scripts
 *
 * @package shopkeeper
 */

/**
 * Vendor scripts with priority
 */
function shopkeeper_vendor_scripts_high_priority() {

    if( Shopkeeper_Opt::getOption( 'smooth_transition_between_pages', false ) ) {
        wp_enqueue_script( 'nprogress', get_template_directory_uri() . '/js/vendor/nprogress.js', NULL, shopkeeper_theme_version(), FALSE);
        wp_enqueue_script( 'shopkeeper-page-in-out', get_template_directory_uri() . '/js/components/page-in-out.js', array('nprogress', 'jquery'), shopkeeper_theme_version(), FALSE);
    }
}
add_action( 'wp_enqueue_scripts', 'shopkeeper_vendor_scripts_high_priority', 0 );

/**
 * Vendor scripts
 */
function shopkeeper_vendor_scripts() {

    if( SHOPKEEPER_WOOCOMMERCE_IS_ACTIVE && !is_woocommerce() ) {
        wp_enqueue_script( 'salvattore', get_template_directory_uri() . '/js/vendor/salvattore.js', array('jquery'), '1.0.9', TRUE );
    }

    wp_enqueue_script( 'foundation-init-js', get_template_directory_uri() . '/inc/foundation/js/foundation.js', 	 array('jquery'), '6.4.3',  TRUE );
    wp_enqueue_script( 'isotope-js', 		 get_template_directory_uri() . '/js/vendor/isotope.pkgd.min.js', 		 array('jquery'), 'v3.0.6', TRUE );
    wp_enqueue_script( 'fresco', 			 get_template_directory_uri() . '/js/vendor/fresco.js', 				 array('jquery'), '2.2.2',  TRUE );
    wp_enqueue_script( 'imagesloaded', 		 get_template_directory_uri() . '/js/vendor/imagesloaded.js', 			 array('jquery'), '3.1.4',  TRUE );
    wp_enqueue_script( 'easyzoom', 			 get_template_directory_uri() . '/js/vendor/easyzoom.js', 				 array('jquery'), '2.4.0',  TRUE );
    wp_enqueue_script( 'touchswipe', 		 get_template_directory_uri() . '/js/vendor/jquery.touchSwipe.min.js',   array('jquery'), '1.6.18', TRUE );
    wp_enqueue_script( 'swiper', 			 get_template_directory_uri() . '/js/vendor/swiper.js', 				 array('jquery'), '4.4.6',  TRUE );
    wp_enqueue_script( 'select2', 			 get_template_directory_uri() . '/js/vendor/select2.min.js', 			 array('jquery'), '4.0.5',  TRUE );
    wp_enqueue_script( 'nanoscroller', 		 get_template_directory_uri() . '/js/vendor/jquery.nanoscroller.min.js', array('jquery'), '0.7.6',  TRUE );
    wp_enqueue_script( 'stellar', 			 get_template_directory_uri() . '/js/vendor/jquery.stellar.min.js', 	 array('jquery'), '0.6.2',  TRUE );
    wp_enqueue_script( 'velocity', 			 get_template_directory_uri() . '/js/vendor/velocity.min.js', 			 array('jquery'), '1.0.0',  TRUE );
}
add_action( 'wp_enqueue_scripts', 'shopkeeper_vendor_scripts', 98 );

/**
 * Vendor scripts
 */
function shopkeeper_theme_scripts() {

    /** In Footer **/
    if( is_rtl() ) {
        wp_enqueue_script( 'shopkeeper-rtl-js', get_template_directory_uri() . '/js/components/rtl.js', array('jquery'), shopkeeper_theme_version(), TRUE );
    }

    if ( SHOPKEEPER_WPBAKERY_IS_ACTIVE) { // If VC exists/active load scripts after VC
        $dependencies = array('jquery', 'wpb_composer_front_js');
    } else { // Do not depend on VC
        $dependencies = array('jquery');
    }

    wp_enqueue_script( 'shopkeeper-scripts-dist', get_template_directory_uri() . '/js/scripts-dist.js', $dependencies, shopkeeper_theme_version(), TRUE );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    $ajax_url = admin_url('admin-ajax.php', 'relative');
    if ( class_exists('SitePress') ) {
        $my_current_lang = apply_filters( 'wpml_current_language', NULL );
        if ( $my_current_lang ) {
            $ajax_url = add_query_arg( 'wpml_lang', $my_current_lang, $ajax_url );
    }}

    $getbowtied_scripts_vars_array = array(

        'ajax_load_more_locale' 	=> esc_html__( 'Load More Items', 'shopkeeper' ),
        'ajax_loading_locale' 		=> esc_html__( 'Loading', 'shopkeeper' ),
        'ajax_no_more_items_locale' => esc_html__( 'No more items available.', 'shopkeeper' ),

        'pagination_blog' 			=> Shopkeeper_Opt::getOption( 'pagination_blog', 'infinite_scroll' ),
        'layout_blog' 				=> Shopkeeper_Opt::getOption( 'layout_blog', 'layout-3' ),
        'shop_pagination_type' 		=> Shopkeeper_Opt::getOption( 'pagination_shop', 'infinite_scroll' ),

        'option_minicart' 			=> Shopkeeper_Opt::getOption( 'option_minicart', '1' ),
        'option_minicart_open' 		=> Shopkeeper_Opt::getOption( 'option_minicart_open', '1' ),
        'catalog_mode'				=> Shopkeeper_Opt::getOption( 'catalog_mode', false ),
        'product_lightbox'			=> Shopkeeper_Opt::getOption( 'product_gallery_lightbox', true ),
        'product_gallery_zoom'		=> Shopkeeper_Opt::getOption( 'product_gallery_zoom', true ),

        'ajax_url'					=> esc_url($ajax_url),
    );

    wp_localize_script( 'shopkeeper-scripts-dist', 'getbowtied_scripts_vars', $getbowtied_scripts_vars_array );
}
add_action( 'wp_enqueue_scripts', 'shopkeeper_theme_scripts', 99 );

?>
