<?php


	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}


global $post, $product;

$modal_class = "fresco zoom";
$zoom_class = "";

if( Shopkeeper_Opt::getOption( 'product_gallery_zoom', true ) ) {
	$zoom_class = "easyzoom el_zoom";
}


?>

<?php

//Featured

$featured_image_title 				= esc_html( get_the_title( get_post_thumbnail_id() ) );
$featured_image_data_src			= wp_get_attachment_image_src( get_post_thumbnail_id(), 'shop_single' );
$featured_image_data_src_original 	= wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
$featured_image_link  				= $product->get_image_id() ? wp_get_attachment_url( get_post_thumbnail_id() ) : wc_placeholder_img_src( 'woocommerce_single' );

$featured_attachment_meta 			= wp_get_attachment(get_post_thumbnail_id());

$post_custom_values 	= get_post_custom( $post->ID );
$page_product_youtube 	= isset($post_custom_values['page_product_youtube']) ? esc_attr( $post_custom_values['page_product_youtube'][0]) : '';

?>

<div class="product-images-style-4 woocommerce-product-gallery__wrapper images">

    <div class="product_images">

		<?php

        //Featured
		?>

			<div class="product-image featured woocommerce-product-gallery__image">
            	<div class="<?php echo esc_attr( $zoom_class ); ?>">

	            	<a

	            	data-fresco-group="product-gallery"
	            	data-fresco-options="ui: 'outside', thumbnail: '<?php echo esc_url($featured_image_data_src[0]); ?>'"
	            	data-fresco-group-options="overflow: true, thumbnails: 'vertical', onClick: 'close'"
	            	data-fresco-caption="<?php echo esc_html($featured_attachment_meta['caption']); ?>"

	            	class="<?php echo esc_attr( $modal_class ); ?>"

	            	href="<?php echo esc_url($featured_image_link); ?>"

	            	>

						<?php if ( $product->get_image_id() ) { ?>
							<img src="<?php echo esc_url($featured_image_data_src[0]); ?>" data-src="<?php echo esc_url($featured_image_data_src[0]); ?>" alt="<?php echo esc_attr( $featured_image_title ); ?>" class="wp-post-image">
		                <?php } else { ?>
		                	<img src="<?php echo esc_url(wc_placeholder_img_src( 'woocommerce_single' )); ?>" data-src="<?php echo esc_url(wc_placeholder_img_src( 'woocommerce_single' )); ?>" >
		                <?php } ?>

	            	</a>

            	</div>

        	</div> <!-- / product-image featured -->

		<?php

        $attachment_ids = $product->get_gallery_image_ids();

        if ( $attachment_ids && count( $attachment_ids ) >= 1 ) : ?>


            <?php

            foreach ( $attachment_ids as $attachment_id ) {

           		$gallery_image_title       			= esc_attr( get_the_title( $attachment_id ) );
				$gallery_image_data_src    			= wp_get_attachment_image_src( $attachment_id, 'shop_single' );
				$gallery_image_data_src_original 	= wp_get_attachment_image_src( $attachment_id, 'full' );
				$gallery_image_link        			= wp_get_attachment_url( $attachment_id );

			    $gallery_attachment_meta			= wp_get_attachment($attachment_id);
				?>

				<div class="product-image">
                    <div class="<?php echo esc_attr( $zoom_class ); ?>">

	                    <a

	                    data-fresco-group="product-gallery"
	                    data-fresco-options="thumbnail: '<?php echo esc_url($gallery_image_data_src[0]); ?>'"
	                    data-fresco-caption="<?php echo esc_html($gallery_attachment_meta['caption']); ?>"

	                    class="<?php echo esc_attr( $modal_class ); ?>"

	                    href="<?php echo esc_url($gallery_image_link); ?>"

	                    >

	                        <img class="desktop-image" src="<?php echo esc_url($gallery_image_data_src[0]); ?>" alt="<?php echo esc_html($gallery_image_title); ?>">

	                    </a>
					</div>
                </div>

            	<?php } ?>

		<?php endif; ?>

	   	<!--  Video -->

	    <?php if ( $page_product_youtube ) : ?>

			<?php

				$embed_code = wp_oembed_get( $page_product_youtube );
				echo '<div class="video "> ' .$embed_code .'</div>';

				echo '<div class="product-video-icon">

						<a data-fresco-group="product-gallery" class="'.$modal_class.'" href="'.esc_url($page_product_youtube).'"><i class="spk-icon spk-icon-video-player"></i></a>
					</div>';

			?>

		<?php endif; ?>

    </div><!-- /.product_images -->

</div> <!-- / product-images-style-4 -->
