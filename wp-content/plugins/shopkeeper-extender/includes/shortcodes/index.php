<?php

include_once( dirname( __FILE__ ) . '/wp/posts-slider.php' );
include_once( dirname( __FILE__ ) . '/wp/banner.php' );
include_once( dirname( __FILE__ ) . '/wp/slider.php' );

if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
	include_once( dirname( __FILE__ ) . '/wc/categories-grid.php' );
}

add_action( 'wp_enqueue_scripts', 'getbowtied_sk_shortcodes_styles', 99 );
function getbowtied_sk_shortcodes_styles() {
	wp_register_style('shopkeeper-posts-slider-shortcode-styles',		plugins_url( 'assets/css/posts-slider.css', __FILE__ ), NULL );
	wp_register_style('shopkeeper-banner-shortcode-styles',				plugins_url( 'assets/css/banner.css', __FILE__ ), NULL );
	wp_register_style('shopkeeper-slider-shortcode-styles',				plugins_url( 'assets/css/slider.css', __FILE__ ), NULL );
	wp_register_style('shopkeeper-categories-grid-shortcode-styles',	plugins_url( 'assets/css/categories-grid.css', __FILE__ ), NULL );
}

add_action( 'wp_enqueue_scripts', 'getbowtied_sk_shortcodes_scripts', 99 );
function getbowtied_sk_shortcodes_scripts() {
	wp_register_script('shopkeeper-posts-slider-shortcode-script', 	plugins_url( 'assets/js/posts-slider.js', __FILE__ ), array('jquery') );
	wp_register_script('shopkeeper-slider-shortcode-script', 		plugins_url( 'assets/js/slider.js', __FILE__ ), array('jquery') );
}

// Add Shortcodes to WP Bakery
if ( defined(  'WPB_VC_VERSION' ) ) {
	add_action( 'init', 'getbowtied_sk_wb_shortcodes' );
	function getbowtied_sk_wb_shortcodes() {
		include_once( dirname( __FILE__ ) . '/wb/posts-slider.php' );
		include_once( dirname( __FILE__ ) . '/wb/banner.php' );
		include_once( dirname( __FILE__ ) . '/wb/slider.php' );

		if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
			include_once( dirname( __FILE__ ) . '/wb/categories-grid.php' );
		}
	}
}