<?php
/**
 * GBTHELPERS
 *
 * A helper class for the plugin
 *
 * @class 		GBTHELPERS
 * @version		2.0
 * @category	Class
 * @author 		GetBowtied
 */

if ( ! class_exists( 'GBTHELPERS' ) ) {
	class GBTHELPERS {

		/**
		 * Do not instance
		 */
		private function __construct(){}

		protected static $gbthemes = array( 'merchandiser', 'shopkeeper', 'mrtailor', 'theretailer', 'thehanger' );

		/**
		 * Fetch the theme slug as tbe option domain
		 *
		 * @return string
		 */
		public static function theme_slug() {
			$theme = wp_get_theme();
			return $theme->template;
		}

		/**
		 * Fetch the theme name
		 *
		 * @return string
		 */
		public static function theme_name() {
			$theme = wp_get_theme();
			if ( $theme->parent() !== false ) {
				$theme_name = $theme->parent()->Name;
			} else {
				$theme_name = $theme->Name;
			}

			return $theme_name;
		}

		/**
		 * Returns the (parent) theme version
		 *
		 * @return version
		 */
		public static function theme_version() {
			$getbowtied_theme = wp_get_theme();
			if ( $getbowtied_theme->parent() ) :
				return $getbowtied_theme->parent()->get( 'Version' );
			else :
				return $getbowtied_theme->get( 'Version' );
			endif;
		}

		public static function path() {
			return 'getbowtied-tools/getbowtied-tools.php';
		}

		/**
		 * Returns the envato link for the active GetBowtied theme
		 *
		 * @return string url
		 */
		public static function envato_link() {
			switch ( self::theme_name() ) {
				case 'Shopkeeper':
				return 'https://themeforest.net/item/shopkeeper-ecommerce-wp-theme-for-woocommerce/9553045';
				break;

				case 'Merchandiser':
				return 'https://themeforest.net/item/merchandiser-ecommerce-wordpress-theme-for-woocommerce/15791151';
				break;

				case 'The Retailer':
				return 'https://themeforest.net/item/the-retailer-responsive-wordpress-theme/4287447';
				break;

				case 'Mr. Tailor':
				return 'https://themeforest.net/item/mr-tailor-responsive-woocommerce-theme/7292110';
				break;

				default:
				return false;
			}
		}

		/**
		 * Returns the link for the theme options panel
		 *
		 * @return string url
		 */
		public static function customizer_link() {
			switch ( self::theme_name() ) {
				case 'The Retailer':
					return esc_url( admin_url( 'admin.php?page=optionsframework' ) );
				break;

				case 'Mr. Tailor':
					return esc_url( admin_url( 'admin.php?page=theme_options' ) );
				break;

				default:
					return esc_url( admin_url( 'customize.php' ) );
				break;
			}
		}

		/**
		 * Returns the link for the theme options panel
		 *
		 * @return string url
		 */
		public static function customizer_menu_link() {
			switch ( self::theme_name() ) {
				case 'The Retailer':
					return 'admin.php?page=optionsframework';
				break;

				case 'Mr. Tailor':
					return 'admin.php?page=theme_options';
				break;

				default:
					return 'customize.php';
				break;
			}
		}

		/**
		 * Returns the support center link for the active GetBowtied theme
		 *
		 * @return string url
		 */
		public static function support_link() {
			if ( in_array( self::theme_slug(), self::$gbthemes ) ) {
				return 'http://' . self::theme_slug() . '.wp-theme.help';
			}
		}

		/**
		 * True if there is a remote update available
		 *
		 * @return boolean
		 */
		public static function hasUpdate() {
			return version_compare( GBTHELPERS::theme_version(), get_option( 'getbowtied_' . GBTHELPERS::theme_slug() . '_remote_ver' ), '<' );
		}

		/**
		 * Returns the remote version of the theme
		 *
		 * @return string|bool version|false
		 */
		public static function remoteVersion() {
			return get_option( 'getbowtied_' . GBTHELPERS::theme_slug() . '_remote_ver' );
		}


		public static function is_required_plugins() {
			return ( SHOPKEEPER_WOOCOMMERCE_IS_ACTIVE && SHOPKEEPER_WPBAKERY_IS_ACTIVE &&  class_exists(  'OCDI_Plugin' ));
		}
	}
}// End if().
