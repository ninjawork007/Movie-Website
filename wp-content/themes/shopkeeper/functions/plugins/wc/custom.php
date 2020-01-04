<?php
/**
 * WC custom functions
 *
 * @package shopkeeper
 */

/**
 * Woocommerce Product Page Get Caption Text
 */
function wp_get_attachment( $attachment_id ) {
    $attachment = get_post( $attachment_id );

    return array(
        'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
        'caption' => $attachment->post_excerpt,
        'description' => $attachment->post_content,
        'href' => get_permalink( $attachment->ID ),
        'src' => $attachment->guid,
        'title' => $attachment->post_title
    );
}

/**
 * Custom WooCommerce related products
 */
function shopkeeper_custom_related_products() {

	if ( Shopkeeper_Opt::getOption( 'related_products', true ) ) {

		$related_products_number = (string)(Shopkeeper_Opt::getOption( 'related_products_number', 4 ));

		echo '<div class="row">';
			echo '<div class="large-12 large-centered columns">';
		    $atts = array(
				'columns'		 => $related_products_number,
				'posts_per_page' => $related_products_number,
				'orderby'        => 'rand'
			);
			woocommerce_related_products($atts); // Display 3 products in rows of 3
	    	echo '</div>';
	    echo '</div>';
	}
}

/**
 * Custom WooCommerce upsells
 */
function shopkeeper_custom_upsell_products() {

	echo '<div class="row">';
		echo '<div class="large-12 large-centered columns">';

		$related_products_number = (string)(Shopkeeper_Opt::getOption( 'related_products_number', 4 ));
		woocommerce_upsell_display( $related_products_number, $related_products_number ); // Display 3 products in rows of 3
    	echo '</div>';
    echo '</div>';
}

/**
 * Shop loop columns
 */
function shopkeeper_loop_columns_class() {
	global $woocommerce_loop;

	if ( ( isset($woocommerce_loop['columns']) && $woocommerce_loop['columns'] != "" ) ) {
		$products_per_column = $woocommerce_loop['columns'];
	} else {
		$products_per_column = get_option('woocommerce_catalog_columns', 5);

		if (isset($_GET["products_per_row"])) {
			$products_per_column = $_GET["products_per_row"];
		}
	}

	if ($products_per_column == 6) {
		$products_per_column_xlarge = 6;
		$products_per_column_large = 4;
		$products_per_column_medium = 3;
	}

	if ($products_per_column == 5) {
		$products_per_column_xlarge = 5;
		$products_per_column_large = 4;
		$products_per_column_medium = 3;
	}

	if ($products_per_column == 4) {
		$products_per_column_xlarge = 4;
		$products_per_column_large = 4;
		$products_per_column_medium = 3;
	}

	if ($products_per_column == 3) {
		$products_per_column_xlarge = 3;
		$products_per_column_large = 3;
		$products_per_column_medium = 2;
	}

	if ($products_per_column == 2) {
		$products_per_column_xlarge = 2;
		$products_per_column_large = 2;
		$products_per_column_medium = 2;
	}

	if ($products_per_column == 1) {
		$products_per_column_xlarge = 1;
		$products_per_column_large = 1;
		$products_per_column_medium = 1;
	}

	echo ( Shopkeeper_Opt::getOption( 'mobile_columns', 2 ) == 1 ) ? 'small-up-1' : 'small-up-2'; ?> medium-up-<?php echo esc_attr($products_per_column_medium); ?> large-up-<?php echo esc_attr($products_per_column_large); ?> xlarge-up-<?php echo esc_attr($products_per_column_xlarge); ?> xxlarge-up-<?php echo esc_attr($products_per_column);
}

/**
 * Deactivate AJAX Add to Cart when incompatible plugin is active
 */
function shopkeeper_deactivate_ajax_add_to_cart() {

	if( class_exists('WC_Product_Addons') || class_exists('Wcff') ) {

		set_theme_mod( 'ajax_add_to_cart', false);
	}
}
add_action( 'init', 'shopkeeper_deactivate_ajax_add_to_cart' );

?>
