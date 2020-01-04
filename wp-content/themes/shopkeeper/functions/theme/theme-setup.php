<?php
/**
 * Theme setup
 *
 * @package shopkeeper
 */

if ( ! isset( $content_width ) ) {
    $content_width = 900;
}

/**
 * Main setup function
 */
function shopkeeper_theme_setup() {

    // Theme textdomain.
    load_theme_textdomain( 'shopkeeper', get_template_directory() . '/languages' );

    // Theme support.
    add_theme_support( 'title-tag' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'woocommerce');

    // Woocommerce Gallery.
    add_theme_support( 'wc-product-gallery-slider' );

    if( Shopkeeper_Opt::getOption( 'product_gallery_zoom', true ) ) {
        add_theme_support( 'wc-product-gallery-zoom' );
    } else {
        remove_theme_support( 'wc-product-gallery-zoom' );
    }

    add_theme_support( 'woocommerce', array(

        // Product grid theme settings
        'product_grid'        => array(
            'default_rows'    => get_option('woocommerce_catalog_rows', 5),
            'min_rows'        => 2,
            'max_rows'        => '',

            'default_columns' => get_option('woocommerce_catalog_columns', 5),
            'min_columns'     => 1,
            'max_columns'     => 6,
        ),
    ) );

    //	WooCommerce thumb size for product gallery (single).
    add_filter( 'woocommerce_gallery_thumbnail_size', function( $size ) {
        return 'thumbnail';
    } );

    // Gutenberg.
    add_theme_support( 'align-wide' );
    add_theme_support( 'editor-styles' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'responsive-embeds' );

    add_editor_style( 'css/admin/editor-styles.css' );

    add_post_type_support('page', 'excerpt');

    // Add Image Sizes.
    $shop_catalog_image_size = get_option( 'shop_catalog_image_size' );
    $shop_single_image_size = get_option( 'shop_single_image_size' );
    add_image_size('product_small_thumbnail', (int)$shop_catalog_image_size['width']/3, (int)$shop_catalog_image_size['height']/3, isset($shop_catalog_image_size['crop']) ? true : false); // made from shop_catalog_image_size
    add_image_size('shop_single_small_thumbnail', (int)$shop_single_image_size['width']/3, (int)$shop_single_image_size['height']/3, isset($shop_catalog_image_size['crop']) ? true : false); // made from shop_single_image_size
    add_image_size( 'blog-isotope', 620, 500, true );

    // Register menus.
    register_nav_menus( array(
        'top-bar-navigation' => esc_html__( 'Top Bar Navigation', 'shopkeeper' ),
        'main-navigation' => esc_html__( 'Main Navigation', 'shopkeeper' ),
        'footer-navigation' => esc_html__( 'Footer Navigation', 'shopkeeper' ),
    ) );
}
add_action( 'after_setup_theme', 'shopkeeper_theme_setup' );

/**
 * Register nav menus
 */
function shopkeeper_custom_nav_menus() {

    if ( Shopkeeper_Opt::getOption( 'main_header_off_canvas', false ) ) {
        register_nav_menus( array(
            'secondary_navigation' => esc_html__( 'Secondary Navigation (Off-Canvas)', 'shopkeeper' ),
        ) );
    }

    if ( Shopkeeper_Opt::getOption( 'main_header_layout', '1' ) == '2' || Shopkeeper_Opt::getOption( 'main_header_layout', '1' ) == '22' ) {
        register_nav_menus( array(
            'centered_header_left_navigation' => esc_html__( 'Centered Header - Left Navigation', 'shopkeeper' ),
            'centered_header_right_navigation' => esc_html__( 'Centered Header - Right Navigation', 'shopkeeper' ),
        ) );
    }
}
add_action( 'init', 'shopkeeper_custom_nav_menus' );

/**
 * Register widgets
 */
function shopkeeper_widgets_init() {

	$sidebars_widgets = wp_get_sidebars_widgets();
	$footer_area_widgets_counter = "0";

	if (isset($sidebars_widgets['footer-widget-area'])) {
        $footer_area_widgets_counter  = count($sidebars_widgets['footer-widget-area']);
    }

	switch ($footer_area_widgets_counter) {
		case 0:
			$footer_area_widgets_columns ='large-12';
			break;
		case 1:
			$footer_area_widgets_columns ='large-12';
			break;
		case 2:
			$footer_area_widgets_columns ='large-6';
			break;
		case 3:
			$footer_area_widgets_columns ='large-4';
			break;
		case 4:
			$footer_area_widgets_columns ='large-3';
			break;
		default:
			$footer_area_widgets_columns ='large-3';
	}

	// Default sidebar.
	register_sidebar(array(
		'name'          => esc_html__( 'Sidebar', 'shopkeeper' ),
		'id'            => 'default-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

	// Footer widget area.
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area', 'shopkeeper' ),
		'id'            => 'footer-widget-area',
		'before_widget' => '<div class="' . $footer_area_widgets_columns . ' columns"><aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside></div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Catalog widget area.
	register_sidebar( array(
		'name'          => esc_html__( 'Shop Sidebar', 'shopkeeper' ),
		'id'            => 'catalog-widget-area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Offcanvas widget area.
	register_sidebar( array(
		'name'          => esc_html__( 'Right Offcanvas Sidebar', 'shopkeeper' ),
		'id'            => 'offcanvas-widget-area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'shopkeeper_widgets_init' );

/**
 * Favicon
 */
function shopkeeper_favicon(){
	if (has_site_icon() == false)
	    echo '<link rel="icon" href="' . get_stylesheet_directory_uri() . '/favicon.png" />';
}
add_action( 'wp_head', 'shopkeeper_favicon' );

?>
