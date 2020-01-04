<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

//==============================================================================
//	Portfolio Helpers
//==============================================================================
add_action('rest_api_init', 'gbt_18_sk_register_rest_portfolio_images' );
if ( ! function_exists( 'gbt_18_sk_register_rest_portfolio_images' ) ) {
    function gbt_18_sk_register_rest_portfolio_images(){
        register_rest_field( array('portfolio'),
            'fimg_url',
            array(
                'get_callback'    => 'gbt_18_sk_get_rest_portfolio_featured_image',
                'update_callback' => null,
                'schema'          => null,
            )
        );
    }
}

if ( ! function_exists( 'gbt_18_sk_get_rest_portfolio_featured_image' ) ) {
    function gbt_18_sk_get_rest_portfolio_featured_image( $object, $field_name, $request ) {
        if( $object['featured_media'] ){
            $img = wp_get_attachment_image_src( $object['featured_media'], 'large' );
            return $img[0];
        }
        return false;
    }
}