<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

//==============================================================================
//	Enqueue Editor Assets
//==============================================================================
add_action( 'enqueue_block_editor_assets', 'gbt_18_sk_posts_grid_editor_assets' );
if ( ! function_exists( 'gbt_18_sk_posts_grid_editor_assets' ) ) {
	function gbt_18_sk_posts_grid_editor_assets() {
		
		wp_register_script(
			'gbt_18_sk_posts_grid_script',
			plugins_url( 'block.js', dirname(__FILE__) ),
			array( 'wp-api-request', 'wp-blocks', 'wp-i18n', 'wp-element' )
		);

		$language = isset($_GET['lang']) ? $_GET['lang'] : get_locale();

		wp_localize_script( 'gbt_18_sk_posts_grid_script', 'posts_grid_vars', array(
			'language' => $language
		) );

		add_action( 'init', function() {
			wp_set_script_translations( 'gbt_18_sk_posts_grid_script', 'shopkeeper-extender', plugin_dir_path( __FILE__ ) . 'languages' );
		});

		wp_register_style(
			'gbt_18_sk_posts_grid_editor_styles',
			plugins_url( 'assets/css/editor.css', dirname(__FILE__) ),
			array( 'wp-edit-blocks' ),
			filemtime(plugin_dir_path(__FILE__) . '../assets/css/editor.css')
		);
	}
}

//==============================================================================
//	Enqueue Frontend Assets
//==============================================================================
add_action( 'enqueue_block_assets', 'gbt_18_sk_posts_grid_assets' );
if ( ! function_exists( 'gbt_18_sk_posts_grid_assets' ) ) {
	function gbt_18_sk_posts_grid_assets() {
		
		wp_enqueue_style(
			'gbt_18_sk_posts_grid_styles',
			plugins_url( 'assets/css/style.css', dirname(__FILE__) ),
			array(),
			filemtime(plugin_dir_path(__FILE__) . '../assets/css/style.css')
		);
	}
}

//==============================================================================
//	Register Block Type
//==============================================================================
if ( function_exists( 'register_block_type' ) ) {
	register_block_type( 'getbowtied/sk-posts-grid', array(
		'editor_style'      => 'gbt_18_sk_posts_grid_editor_styles',
        'editor_script'     => 'gbt_18_sk_posts_grid_script',
		'attributes'      					=> array(
			'number'						=> array(
				'type'						=> 'number',
				'default'					=> '12',
			),
			'categoriesSavedIDs'			=> array(
				'type'						=> 'string',
				'default'					=> '',
			),
			'align'							=> array(
				'type'						=> 'string',
				'default'					=> 'center',
			),
			'orderby'						=> array(
				'type'						=> 'string',
				'default'					=> 'date_desc',
			),
			'columns'						=> array(
				'type'						=> 'number',
				'default'					=> '3'
			),
		),

		'render_callback' => 'gbt_18_sk_render_frontend_posts_grid',
	) );
}