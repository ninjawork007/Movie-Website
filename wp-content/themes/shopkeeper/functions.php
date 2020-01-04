<?php

// Kirki.
include_once( get_template_directory() . '/inc/customizer/src/vendor/kirki/kirki.php' );

// Helpers.
include_once( get_template_directory() . '/functions/helpers/helpers.php');

// Theme setup.
include_once( get_template_directory() . '/functions/theme/theme-setup.php');
include_once( get_template_directory() . '/functions/theme/theme-styles.php');
include_once( get_template_directory() . '/functions/theme/theme-scripts.php');

// Admin setup.
include_once( get_template_directory() . '/functions/admin/admin-setup.php');
include_once( get_template_directory() . '/functions/admin/admin-styles.php');
include_once( get_template_directory() . '/functions/admin/admin-scripts.php');

// Customizer.
include_once( get_template_directory() . '/inc/customizer/backend.php' );
include_once( get_template_directory() . '/inc/customizer/read-options.php' );

// WP.
include_once( get_template_directory() . '/functions/wp/actions.php');
include_once( get_template_directory() . '/functions/wp/filters.php');

// WC.
if( SHOPKEEPER_WOOCOMMERCE_IS_ACTIVE ) {
	include_once( get_template_directory() . '/functions/plugins/wc/actions.php');
	include_once( get_template_directory() . '/functions/plugins/wc/filters.php');
	include_once( get_template_directory() . '/functions/plugins/wc/custom.php');
}

// Germanized & German Market.
if( SHOPKEEPER_GERMAN_MARKET_IS_ACTIVE || SHOPKEEPER_WOOCOMMERCE_GERMANIZED_IS_ACTIVE ) {
	include_once( get_template_directory() . '/functions/plugins/germanized/functions.php');
}

// WPBakery.
if( SHOPKEEPER_WPBAKERY_IS_ACTIVE ) {
	include_once( get_template_directory() . '/functions/plugins/wb/functions.php');
}

// YITH Wishlist
if( SHOPKEEPER_WISHLIST_IS_ACTIVE ) {
	include_once( get_template_directory() . '/functions/plugins/wishlist/actions.php');
}

// WPML.
include_once( get_template_directory() . '/functions/plugins/wpml/functions.php');

// Load Custom Styles.
include_once( get_template_directory() . '/inc/custom-styles/init.php' );

// Load Post meta template.
include_once( get_template_directory() . '/inc/templates/post-meta.php' );

// Load Template Tags.
include_once( get_template_directory() . '/inc/templates/template-tags.php' );

//Include Metaboxes.
include_once( get_template_directory() . '/inc/metaboxes/page.php' );
include_once( get_template_directory() . '/inc/metaboxes/post.php' );
include_once( get_template_directory() . '/inc/metaboxes/product.php' );

//Quick View.
include_once( get_template_directory() . '/inc/woocommerce/quick_view.php' );

//Product Layout.
include_once( get_template_directory() . '/inc/woocommerce/product-layout.php' );
