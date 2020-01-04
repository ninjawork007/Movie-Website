<?php
/**
 * Customizer sections
 *
 * @package shopkeeper
 */

function shopkeeper_customizer_panels( $wp_customize ) {

	$wp_customize->add_panel( 'panel_header', array(
		'title'          => esc_html__( 'Header', 'shopkeeper' ),
		'priority'       => 5,
		'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_panel( 'panel_shop', array(
		'title'          => esc_html__( 'Shop', 'shopkeeper' ),
		'priority'       => 6,
		'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_panel( 'panel_blog', array(
		'title'          => esc_html__( 'Blog', 'shopkeeper' ),
		'priority'       => 8,
		'capability'     => 'edit_theme_options',
	) );
}
add_action( 'customize_register','shopkeeper_customizer_panels' );

// Config.
Kirki::add_config( 'shopkeeper', array(
    'capability'        => 'edit_theme_options',
    'option_type'       => 'theme_mod',
    'disable_output'    => true,
) );

// Sections.
Kirki::add_section( 'header_style', array(
    'title'          => esc_attr__('Header Styles', 'shopkeeper' ),
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'panel'          => 'panel_header',
) );

Kirki::add_section( 'header_elements', array(
    'title'          => esc_attr__( 'Header Elements', 'shopkeeper' ),
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'panel'          => 'panel_header',
) );

Kirki::add_section( 'header_logo', array(
    'title'          => esc_attr__( 'Logo', 'shopkeeper' ),
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'panel'          => 'panel_header',
) );

Kirki::add_section( 'top_bar', array(
    'title'          => esc_attr__( 'Top Bar', 'shopkeeper' ),
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'panel'          => 'panel_header',
) );

Kirki::add_section( 'sticky_header', array(
    'title'          => esc_attr__( 'Sticky Header', 'shopkeeper' ),
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'panel'          => 'panel_header',
) );

Kirki::add_section( 'search', array(
    'title'          => esc_attr__( 'Search', 'shopkeeper' ),
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'panel'          => 'panel_header',
) );

Kirki::add_section( 'footer', array(
    'title'          => esc_attr__( 'Footer', 'shopkeeper' ),
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
) );

// Blog Sections.
Kirki::add_section( 'blog_archive', array(
    'title'          => esc_attr__( 'Blog Posts Archive', 'shopkeeper' ),
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'panel'			 => 'panel_blog'
) );

Kirki::add_section( 'single_post', array(
    'title'          => esc_attr__( 'Single Post', 'shopkeeper' ),
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'panel'			 => 'panel_blog'
) );

// Shop Sections.
Kirki::add_section( 'shop_layout', array(
    'title'          => esc_attr__( 'Shop Layout', 'shopkeeper' ),
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'panel'			 => 'panel_shop'
) );

Kirki::add_section( 'product_card', array(
    'title'          => esc_attr__( 'Product Card', 'shopkeeper' ),
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'panel'			 => 'panel_shop'
) );

Kirki::add_section( 'shop_notifications', array(
    'title'          => esc_attr__( 'Shop Notifications', 'shopkeeper' ),
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'panel'			 => 'panel_shop'
) );

Kirki::add_section( 'product_badges', array(
    'title'          => esc_attr__( 'Product Badges', 'shopkeeper' ),
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'panel'			 => 'panel_shop'
) );

Kirki::add_section( 'mobile_settings', array(
    'title'          => esc_attr__( 'Mobile Settings', 'shopkeeper' ),
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'panel'			 => 'panel_shop'
) );

Kirki::add_section( 'catalog_mode', array(
    'title'          => esc_attr__( 'Catalog Mode', 'shopkeeper' ),
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'panel'			 => 'panel_shop'
) );

Kirki::add_section( 'product', array(
    'title'          => esc_attr__( 'Product Page', 'shopkeeper' ),
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
) );

Kirki::add_section( 'styling', array(
    'title'          => esc_attr__( 'Styling', 'shopkeeper' ),
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
) );

Kirki::add_section( 'fonts', array(
    'title'          => esc_attr__( 'Fonts', 'shopkeeper' ),
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
) );

Kirki::add_section( 'custom_code', array(
    'title'          => esc_attr__( 'Custom Code', 'shopkeeper' ),
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
) );

?>
