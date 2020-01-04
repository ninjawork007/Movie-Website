<?php

/******************************************************************************/
/* WooCommerce Product Layout *************************************************/
/******************************************************************************/

function getbowtied_product_layout($page_id) {

	$custom_product_layout = Shopkeeper_Opt::getOption( 'product_layout', 'default' );
	$page_product_layout = get_post_meta( $page_id, 'page_product_layout', true );

	$product_layout = "default";


	// Product Layout from Customiser

	switch ($custom_product_layout)
	{
	    case "default":
	        $product_layout = "default";
	        break;
	    case "style_2":
	        $product_layout = "style_2";
	        break;
	    case "style_3":
	        $product_layout = "style_3";
	        break;
	    case "style_4":
	        $product_layout = "style_4";
	        break;
	    default:
	        $product_layout = "default";
	        break;
	}


	// Overwrite Global Product Layout from Product Page Options

	switch ( $page_product_layout ) {
	    case "inherit":
	        // do nothing
	        break;
	    case "default":
	        $product_layout = "default";
	        break;
	    case "style_2":
	        $product_layout = "style_2";
	        break;
	    case "style_3":
	        $product_layout = "style_3";
	        break;
	    case "style_4":
	        $product_layout = "style_4";
	        break;
	    default:
	        // do nothing
	        break;
	}

	return $product_layout;

}
