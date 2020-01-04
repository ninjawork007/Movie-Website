<?php
/**
 * Custom styles
 *
 * @package shopkeeper
 */

include_once( get_template_directory() . '/inc/custom-styles/helpers/helpers.php' );

/**
 * Frontend custom styles
 */
function shopkeeper_custom_theme_styles() {

	$custom_styles = '';
	$path = get_template_directory() . '/inc/custom-styles/frontend/';

	include( $path . 'body.php' );
	include( $path . 'fonts.php' );
	include( $path . 'colors.php' );
	include( $path . 'topbar.php' );
	include( $path . 'header.php' );
	include( $path . 'footer.php' );
	include( $path . 'woocommerce.php' );
	include( $path . 'gutenberg.php' );

	wp_add_inline_style( 'shopkeeper-styles', $custom_styles );
}
add_action( 'wp_enqueue_scripts', 'shopkeeper_custom_theme_styles', 100 );

/**
 * Backend custom styles
 */
function shopkeeper_custom_gutenberg_editor_styles() {

    global $current_screen;

    $custom_gutenberg_styles = '';

    include( get_template_directory() . '/inc/custom-styles/backend/gutenberg.php' );

    $current_screen = get_current_screen();
	if ( method_exists($current_screen, 'is_block_editor') && $current_screen->is_block_editor() ) {
		wp_add_inline_style( 'shopkeeper_admin_styles', $custom_gutenberg_styles );
	}
}
add_action( 'admin_enqueue_scripts', 'shopkeeper_custom_gutenberg_editor_styles', 99 );
