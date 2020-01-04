<?php

/**
 * Plugin Name:       		Shopkeeper Portfolio Addon
 * Plugin URI:        		https://shopkeeper.wp-theme.design/
 * Description:       		Extends the functionality of your WordPress site by adding a 'Portfolio' custom post type allowing you to organize and showcase you your work or products.
 * Version:           		1.2.3
 * Author:            		GetBowtied
 * Author URI:				https://getbowtied.com
 * Text Domain:				shopkeeper-portfolio
 * Domain Path:				/languages/
 * Requires at least: 		5.0
 * Tested up to: 			5.2.2
 *
 * @package  Shopkeeper Portfolio
 * @author   GetBowtied
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( ! function_exists( 'is_plugin_active' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

// Plugin Updater
require 'core/updater/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://raw.githubusercontent.com/getbowtied/shopkeeper-portfolio/master/core/updater/assets/plugin.json',
	__FILE__,
	'shopkeeper-portfolio'
);

if ( ! class_exists( 'ShopkeeperPortfolio' ) ) :

	/**
	 * ShopkeeperPortfolio class.
	*/
	class ShopkeeperPortfolio {

		/**
		 * The single instance of the class.
		 *
		 * @var ShopkeeperPortfolio
		*/
		protected static $_instance = null;

		/**
		 * ShopkeeperPortfolio constructor.
		 *
		*/
		public function __construct() {

			$this->gbt_import_options();
			$this->gbt_customizer_options();
			$this->gbt_register_post_type();
			$this->gbt_add_metabox();
			$this->gbt_register_shortcode();
			$this->gbt_register_scripts();
			$this->gbt_register_admin_scripts();
			$this->gbt_register_styles();
			$this->gbt_add_block();

			add_filter( 'single_template', array( $this, 'gbt_portfolio_template' ), 99 );
			add_filter( 'taxonomy_template', array( $this, 'gbt_portfolio_taxonomy_template' ), 99 );

			add_action( 'plugins_loaded', function() {
				if ( defined(  'WPB_VC_VERSION' ) ) {
					include_once( dirname(__FILE__) . '/includes/shortcodes/wb/portfolio.php' );
					if( function_exists('vc_set_default_editor_post_types') ) {
						vc_set_default_editor_post_types( array('post','page','product','portfolio') );
					}
				}
			});
		}

		/**
		 * Ensures only one instance of ShopkeeperPortfolio is loaded or can be loaded.
		 *
		 * @return ShopkeeperPortfolio
		*/
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		/**
		 * Imports customizer options stored as theme mods into the options WP table.
		 *
		 * @return void
		 */
		private function gbt_import_options() {
			if( !get_option( 'gbt_portfolio_options_import', false ) ) {
				$portfolio_option = get_theme_mod( 'portfolio_item_slug', 'portfolio-item' );
				update_option( 'gbt_portfolio_item_slug', $portfolio_option );
				update_option( 'gbt_portfolio_options_import', true );
			}
		}

		/**
		 * Registers customizer options.
		 *
		 * @return void
		 */
		protected function gbt_customizer_options() {
			add_action( 'customize_register', array( $this, 'gbt_portfolio_customizer' ) );
		}

		/**
		 * Creates customizer options.
		 *
		 * @return void
		 */
		public function gbt_portfolio_customizer( $wp_customize ) {

			// Section
			$wp_customize->add_section( 'portfolio', array(
		 		'title'       => esc_attr__( 'Portfolio', 'shopkeeper-portfolio' ),
		 		'priority'    => 20,
		 	) );

		 	// Fields
			$wp_customize->add_setting( 'gbt_portfolio_item_slug', array(
				'type'		 			=> 'option',
				'capability' 			=> 'manage_options',
				'default'     			=> 'portfolio-item',
			) );

			$wp_customize->add_control( 
				new WP_Customize_Control(
					$wp_customize,
					'gbt_portfolio_item_slug',
					array( 
						'type'			=> 'text',
						'label'       	=> esc_attr__( 'Portfolio Item Slug', 'shopkeeper-portfolio' ),
						'description' 	=> __('<span class="dashicons dashicons-editor-help"></span>Default slug is "portfolio-item". Enter a custom one to overwrite it. <br/><b>You need to regenerate your permalinks if you modify this!</b>', 'shopkeeper-portfolio'),
						'section'     	=> 'portfolio',
						'priority'    	=> 20,
					)
				)
			);
		}

		/**
		 * Registers portfolio post type and taxonomy
		 *
		 * @return void
		*/
		public static function gbt_register_post_type() {

			include_once( dirname(__FILE__) . '/includes/portfolio/post-type.php' );
			include_once( dirname(__FILE__) . '/includes/portfolio/taxonomy.php' );
		}

		/**
		 * Adds portfolio metabox
		 *
		 * @return void
		*/
		public static function gbt_add_metabox() {
			
			include_once( dirname(__FILE__) . '/includes/portfolio/metabox.php' );
		}

		/**
		 * Registers portfolio shortcode
		 *
		 * @return void
		*/
		public static function gbt_register_shortcode() {
			include_once( dirname(__FILE__) . '/includes/shortcodes/wp/portfolio.php' );
		}

		/**
		 * Loads Gutenberg blocks
		 *
		 * @return void
		*/
		public static function gbt_add_block() {
			add_action( 'plugins_loaded', function() {
				if( class_exists('WP_Block_Type_Registry') ) {
					$registry = new WP_Block_Type_Registry;
					if( !$registry->is_registered( 'getbowtied/sk-portfolio' ) ) {
						include_once( dirname(__FILE__) . '/includes/blocks/index.php' );
					}
				}
			});
		}

		/**
		 * Enqueues portfolio styles
		 *
		 * @return void
		*/
		public static function gbt_register_styles() {
			add_action( 'wp_enqueue_scripts', function() {
				wp_enqueue_style(
					'gbt-portfolio-styles', 
					plugins_url( 'includes/assets/css/portfolio.css', __FILE__ ), 
					NULL
				);
			} );
		}

		/**
		 * Enqueues portfolio scripts
		 *
		 * @return void
		*/
		public static function gbt_register_scripts() {
			add_action( 'wp_enqueue_scripts', function() {
				wp_enqueue_script(
					'gbt-portfolio-scripts',
					plugins_url( 'includes/assets/js/portfolio.js', __FILE__ ), 
					array('jquery'),
					false,
					true
				);
			}, 300 );
		}

		/**
		 * Enqueues portfolio admin scripts
		 *
		 * @return void
		*/
		public static function gbt_register_admin_scripts() {
			if ( is_admin() ) {
				add_action( 'admin_enqueue_scripts', function() {
					global $post_type;
					wp_enqueue_script(
						'gbt-portfolio-admin-scripts',
						plugins_url( 'includes/assets/js/wp-admin-portfolio.js', __FILE__ ), 
						array('wp-color-picker'), 
						false
					);
				} );
			}			
		}

		/**
		 * Loads portfolio template
		 *
		 * @return void
		*/
		public static function gbt_portfolio_template( $template ) {
			global $post;
			
			if ( $post->post_type == 'portfolio' ) {
				$page_portfolio_layout = get_post_meta( get_the_ID(), 'portfolio_layout', true );

		        if( $page_portfolio_layout == 'boxed' ) {
		        	$template = plugin_dir_path(__FILE__) . 'includes/templates/single-portfolio-boxed.php';
		        } else {
		        	$template = plugin_dir_path(__FILE__) . 'includes/templates/single-portfolio-full.php';
		        }
		    }

		    return $template;
		}

		/**
		 * Loads portfolio taxonomy template
		 *
		 * @return void
		*/
		public static function gbt_portfolio_taxonomy_template( $template ) {

			if( is_tax( 'portfolio_categories' ) ) {
				$template = plugin_dir_path(__FILE__) . 'includes/templates/taxonomy-portfolio_categories.php';
			}

			return $template;
		}
	}

endif;

$theme = wp_get_theme();
$parent_theme = $theme->parent();
if( $theme->template == 'shopkeeper' && ( $theme->version >= '2.8.2' || ( !empty($parent_theme) && $parent_theme->version >= '2.8.2' ) ) ) {
	$shopkeeper_portfolio = new ShopkeeperPortfolio;
}