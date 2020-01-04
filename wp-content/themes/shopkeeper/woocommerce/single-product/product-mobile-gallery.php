<?php

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $post, $product;

$post_custom_values     = get_post_custom( $post->ID );
$page_product_youtube   = isset($post_custom_values['page_product_youtube']) ? esc_attr( $post_custom_values['page_product_youtube'][0]) : '';
$embed_code             = wp_oembed_get( $page_product_youtube );

$columns            = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id  = $product->get_image_id();
$attachment_ids 	= $product->get_gallery_image_ids();
$wrapper_classes    = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
	'woocommerce-product-gallery',
	'woocommerce-product-gallery--' . ( $product->get_image_id() ? 'with-images' : 'without-images' ),
	'woocommerce-product-gallery--columns-' . absint( $columns ),
	'images',
) );

?>

<div class="mobile_gallery">
	
    <div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
		<figure class="woocommerce-product-gallery__wrapper mobile-gallery">
			<?php
			if ( $product->get_image_id() ) {
				$html  = wc_get_gallery_image_html( $post_thumbnail_id, true );
			} else {
				$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
				$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
				$html .= '</div>';
			}

			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id );

			if ( $attachment_ids && $product->get_image_id() ) {
		        foreach ( $attachment_ids as $attachment_id ) {
		            echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', wc_get_gallery_image_html( $attachment_id, true  ), $attachment_id );
		        }
		    }

		    if ( $page_product_youtube ) {
		        echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', '<div data-thumb="'.get_template_directory_uri().'/images/gtb-video-player.svg" class="woocommerce-product-gallery__image youtube"><a class="video" href="'.esc_url($page_product_youtube).'"><div class="fluid-width-video-wrapper">'.$embed_code.'</div></a></div>', $attachment_ids[0] );
		    }
			?>
		</figure>
	</div>

</div> <!-- end mobile_gallery -->
