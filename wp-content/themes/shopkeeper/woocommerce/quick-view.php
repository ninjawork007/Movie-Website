<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

while ( have_posts() ) : the_post();

	global $post, $product;

    add_action( 'woocommerce_before_single_product_summary_sale_flash', 'woocommerce_show_product_sale_flash', 10 );
    add_action( 'woocommerce_before_single_product_summary_product_images', 'woocommerce_show_product_images', 20 );

    add_action( 'woocommerce_single_product_summary_single_title', 'woocommerce_template_single_title', 5 );
    add_action( 'woocommerce_single_product_summary_single_rating', 'woocommerce_template_single_rating', 10 );
    add_action( 'woocommerce_single_product_summary_single_price', 'woocommerce_template_single_price', 10 );
    add_action( 'woocommerce_single_product_summary_single_excerpt', 'woocommerce_template_single_excerpt', 20 );
    add_action( 'woocommerce_single_product_summary_single_add_to_cart', 'woocommerce_template_single_add_to_cart', 30 );
    add_action( 'woocommerce_single_product_summary_single_meta', 'woocommerce_template_single_meta', 40 );
    add_action( 'woocommerce_single_product_summary_single_sharing', 'woocommerce_template_single_sharing', 50 );

    add_action( 'woocommerce_product_summary_thumbnails', 'woocommerce_show_product_thumbnails', 20 );

    if(class_exists('WC_Wishlists_Plugin')) {
		remove_action('wc_quick_view_before_single_product', array($GLOBALS['wishlists'], 'bind_wishlist_button'), 0);
		add_action('woocommerce_single_product_summary_single_add_to_cart', array($GLOBALS['wishlists'], 'bind_wishlist_button'), 0);
	}

    function add_product_class($classes) {
	    $classes[] = "product";
	    return $classes;
	}
	add_filter('post_class', 'add_product_class');

	?>

	<?php if ( !post_password_required() ) : ?>

	<div id="product-<?php the_ID(); ?>" <?php function_exists('wc_product_class')? wc_product_class( 'product', $product ) : post_class(); ?>>
		<a href="#0" class="cd-close"></a>
        <div class="cd-slider-wrapper">
        	<?php
            $image_title 				= esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_src 					= wp_get_attachment_image_src( get_post_thumbnail_id(), 'shop_thumbnail' );
			$image_data_src				= wp_get_attachment_image_src( get_post_thumbnail_id(), 'shop_single' );
			$image_data_src_original 	= wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
			$image_link  				= wp_get_attachment_url( get_post_thumbnail_id() );
			$image       				= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
			$image_original				= get_the_post_thumbnail( $post->ID, 'full' );
			$attachment_count   		= count( $product->get_gallery_image_ids() );
			$catalog_image 				= get_the_post_thumbnail( $post->ID, 'shop_catalog');
			?>

			<div class="cover-image">
				<?php echo get_the_post_thumbnail( $post->ID, 'shop_catalog'); ?>
            </div>

			<div class="swiper-container">
				<div class="swiper-wrapper images woocommerce-product-gallery__wrapper">
					<?php if ( has_post_thumbnail() ) { ?>
					<div class="swiper-slide woocommerce-product-gallery__image">
						<?php echo get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) ); ?>
		            </div>
					<?php
		            $attachment_ids = $product->get_gallery_image_ids();
		            if ( $attachment_ids ) {
		                foreach ( $attachment_ids as $attachment_id ) {
		                    $image_link = wp_get_attachment_url( $attachment_id );
		                    if (!$image_link) continue;
		                    $image_title       			= esc_attr( get_the_title( $attachment_id ) );
		                    $image_src         			= wp_get_attachment_image_src( $attachment_id, 'shop_single_small_thumbnail' );
							$image_data_src    			= wp_get_attachment_image_src( $attachment_id, 'shop_single' );
							$image_data_src_original 	= wp_get_attachment_image_src( $attachment_id, 'full' );
							$image_link        			= wp_get_attachment_url( $attachment_id );
						    $image		      			= wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );?>
							<div class="swiper-slide">
	                            <img src="<?php echo esc_url($image_data_src[0]); ?>" alt="<?php echo esc_attr($image_title); ?>">
		                    </div>
		                	<?php
						}
					}
		            ?>
					<?php
					} else {
				        echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', wc_placeholder_img_src() ), $post->ID );
				    }
				    ?>
				</div>

				<div class="swiper-pagination"></div>

			</div>

			<div class="swiper-button-prev"></div>
			<div class="swiper-button-next"></div>

        </div><!-- cd-slider-wrapper -->

        <div class="cd-item-info">
            <div class="product_infos">

                <?php do_action( 'woocommerce_single_product_summary_single_rating' );?>
                <a href="<?php the_permalink(); ?>"><?php do_action( 'woocommerce_single_product_summary_single_title' );?></a>

				<div class="product_price">
                    <?php do_action( 'woocommerce_single_product_summary_single_price' ); ?>
                </div>

                <div class="product_excerpt">
                	<?php do_action( 'woocommerce_single_product_summary_single_excerpt' ); ?>
          		</div>

        		<?php do_action( 'woocommerce_single_product_summary_single_add_to_cart' ); ?>

	                <div class="quickview-badges">
	                    <?php if( !Shopkeeper_Opt::getOption( 'catalog_mode', false ) ) : ?>
							<?php if ( !$product->is_in_stock() && !empty( Shopkeeper_Opt::getOption( 'out_of_stock_label', 'Out of stock' ) ) ) : ?>
	                           <div class="out_of_stock_wrapper">
	                               <div class="out_of_stock_badge_single <?php if (!$product->is_on_sale()) : ?>first_position<?php endif; ?>">
										<?php printf( __( '%s', 'woocommerce' ), Shopkeeper_Opt::getOption( 'out_of_stock_label', 'Out of stock' )); ?>
	                               </div>
	                           </div>
	                        <?php endif; ?>
	                    <?php endif; ?>
		            	<?php
		            		if( !Shopkeeper_Opt::getOption( 'catalog_mode', false ) ) {
								do_action( 'woocommerce_before_single_product_summary_sale_flash' );
						} ?>
	                </div>
            </div><!-- product_infos -->
        </div><!-- cd-item-info -->
	</div><!-- #product-<?php the_ID(); ?> -->

	<?php else: ?>

	<div class="row">
	    <div class="large-9 large-centered columns">
	    <br/><br/><br/><br/>
			<?php echo get_the_password_form(); ?>
		</div>
	</div>

	<?php endif; ?>

<?php endwhile; // end of the loop.
