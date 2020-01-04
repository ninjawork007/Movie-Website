<?php
/**
 * Germanized plugins functions
 *
 * @package shopkeeper
 */

if( SHOPKEEPER_GERMAN_MARKET_IS_ACTIVE ) {

    /**
     * German market compatibility
     */
 	function shopkeeper_german_market_compatibility() {
 		remove_action( 'woocommerce_single_product_summary',		array( 'WGM_Template', 'woocommerce_de_price_with_tax_hint_single' ), 7 );
 		remove_action( 'woocommerce_after_shop_loop_item_title',	array( 'WGM_Template', 'woocommerce_de_price_with_tax_hint_loop' ), 5 );

 		add_action( 'woocommerce_single_product_german_market_info',	array( 'WGM_Template', 'woocommerce_de_price_with_tax_hint_single' ), 7 );
 		add_filter( 'woocommerce_single_product_german_market_info', 	'__return_true' );
 	}

    shopkeeper_german_market_compatibility();
}

if( SHOPKEEPER_WOOCOMMERCE_GERMANIZED_IS_ACTIVE ) {

    /**
     * Germanized compatibility
     */
 	function shopkeeper_germanized_compatibility() {

 		if ( get_option( 'woocommerce_gzd_display_product_detail_unit_price' ) == 'yes' ) {
 			remove_action( 'woocommerce_single_product_summary', 'woocommerce_gzd_template_single_price_unit', wc_gzd_get_hook_priority( 'single_price_unit' ) );
 			add_action( 'woocommerce_single_product_germanized_info', 'woocommerce_gzd_template_single_price_unit', wc_gzd_get_hook_priority( 'single_price_unit' ) );
 		}

 		if ( get_option( 'woocommerce_gzd_display_product_detail_tax_info' ) == 'yes' || get_option( 'woocommerce_gzd_display_product_detail_shipping_costs' ) == 'yes' ) {
 			remove_action( 'woocommerce_single_product_summary', 'woocommerce_gzd_template_single_legal_info', wc_gzd_get_hook_priority( 'single_legal_info' ) );
 			add_action( 'woocommerce_single_product_germanized_info', 'woocommerce_gzd_template_single_legal_info', wc_gzd_get_hook_priority( 'single_legal_info' ) );
 		}

 		if ( get_option( 'woocommerce_gzd_display_product_detail_delivery_time' ) == 'yes' ) {
 			remove_action( 'woocommerce_single_product_summary', 'woocommerce_gzd_template_single_delivery_time_info', wc_gzd_get_hook_priority( 'single_delivery_time_info' ) );
 			add_action( 'woocommerce_single_product_germanized_info', 'woocommerce_gzd_template_single_delivery_time_info', wc_gzd_get_hook_priority( 'single_delivery_time_info' ) );
 		}

 		if ( get_option( 'woocommerce_gzd_display_product_detail_product_units' ) == 'yes' ) {
 			remove_action( 'woocommerce_product_meta_start', 'woocommerce_gzd_template_single_product_units', wc_gzd_get_hook_priority( 'single_product_units' ) );
 			add_action( 'woocommerce_single_product_germanized_info', 'woocommerce_gzd_template_single_product_units', wc_gzd_get_hook_priority( 'single_product_units' ) );
 		}

 		if ( get_option( 'woocommerce_gzd_display_listings_unit_price' ) == 'yes' ) {
 	        remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_gzd_template_single_price_unit', wc_gzd_get_hook_priority( 'loop_price_unit' ) );
 	        add_action( 'woocommerce_germanized_unit_price', 'woocommerce_gzd_template_single_price_unit', 1 );
 	    }
 	}

    shopkeeper_germanized_compatibility();
}

 ?>
