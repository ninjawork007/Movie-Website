<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Load Template

switch ( getbowtied_product_layout(get_the_ID()) )
{        
    case "default":
        get_template_part( 'woocommerce/content-single-product-default' );
        break;
    case "style_2":
        get_template_part( 'woocommerce/content-single-product-style-2' );
        break;
    case "style_3":
        get_template_part( 'woocommerce/content-single-product-style-3' );
        break;
    case "style_4":
        get_template_part( 'woocommerce/content-single-product-style-4' );
        break;
    default:
        get_template_part( 'woocommerce/content-single-product-default' );
        break;
}