<?php

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    global $post, $product;

    //woocommerce_before_single_product
	//nothing changed

	//woocommerce_before_single_product_summary
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );

	add_action( 'woocommerce_before_single_product_summary_sale_flash', 'woocommerce_show_product_sale_flash', 10 );
	add_action( 'woocommerce_before_single_product_summary_product_images', 'woocommerce_show_product_images', 20 );

	//woocommerce_single_product_summary
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

	add_action( 'woocommerce_single_product_summary_single_title', 'woocommerce_template_single_title', 5 );
	add_action( 'woocommerce_single_product_summary_single_rating', 'woocommerce_template_single_rating', 10 );
	add_action( 'woocommerce_single_product_summary_single_price', 'woocommerce_template_single_price', 10 );
	add_action( 'woocommerce_single_product_summary_single_excerpt', 'woocommerce_template_single_excerpt', 20 );
	add_action( 'woocommerce_single_product_summary_single_add_to_cart', 'woocommerce_template_single_add_to_cart', 30 );
	add_action( 'woocommerce_single_product_summary_single_meta', 'woocommerce_template_single_meta', 40 );
	add_action( 'woocommerce_single_product_summary_single_sharing', 'woocommerce_template_single_sharing', 50 );

	//woocommerce_after_single_product_summary
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

	add_action( 'woocommerce_after_single_product_summary_data_tabs', 'woocommerce_output_product_data_tabs', 10 );

	//woocommerce_after_single_product
	//nothing changed

	//custom actions
	add_action( 'woocommerce_before_main_content_breadcrumb', 'woocommerce_breadcrumb', 20, 0 );
	add_action( 'woocommerce_product_summary_thumbnails', 'woocommerce_show_product_thumbnails', 20 );

	if(class_exists('WC_Wishlists_Plugin')) {
		remove_action('woocommerce_single_product_summary', array($GLOBALS['wishlists'], 'bind_wishlist_button'), 0);
		add_action('woocommerce_single_product_summary_single_add_to_cart', array($GLOBALS['wishlists'], 'bind_wishlist_button'), 0);
	}

?>


<div class="product_layout_2 custom-layout">

	<?php if ( !post_password_required() ) : ?>

		<div class="row">
			<?php do_action( 'woocommerce_before_single_product' ); ?>
		</div>

		<div id="product-<?php the_ID(); ?>" <?php function_exists('wc_product_class')? wc_product_class( '', $product ) : post_class(); ?>>

			<div class="row">

					<div class="product_content_wrapper">

						<div class="row">

							<div class="medium-12 large-8 columns">

								<div class="product-images-wrapper">

									<!-- Mobile Gallery -->
									<?php get_template_part( 'woocommerce/single-product/product-mobile-gallery' ); ?>

									<div class="product-badges">
										<!-- sale -->
										<div class="product-sale">
												<?php do_action( 'woocommerce_before_single_product_summary_sale_flash' ); ?>
										</div>
									</div>



									<?php
										do_action( 'woocommerce_before_single_product_summary_product_images' );
										do_action( 'woocommerce_before_single_product_summary' );
									?>
								</div>


								<div class="product_infos fixed">

									<!-- <div class="large-4 columns"> -->

										<div class="product_summary_top">

										 	<?php do_action('woocommerce_before_main_content_breadcrumb');

									 		if( Shopkeeper_Opt::getOption( 'review_tab', true ) ) :
											do_action( 'woocommerce_single_product_summary_single_rating' );
											endif;

										 	 ?>

										 </div>

										<div class="product_summary_middle">
											<?php

												do_action( 'woocommerce_single_product_summary_single_title' );

												if ( post_password_required() ) {
													echo get_the_password_form();
													return;
												}
											?>
										</div><!--.product_summary_top-->

										<?php do_action( 'woocommerce_single_product_summary_single_price' ); ?>

											<?php if( SHOPKEEPER_GERMAN_MARKET_IS_ACTIVE ) : ?>
												<div class="german-market-info">
													<?php do_action( 'woocommerce_single_product_german_market_info' ); ?>
												</div>
											<?php elseif( SHOPKEEPER_WOOCOMMERCE_GERMANIZED_IS_ACTIVE ) : ?>
												<div class="germanized-active">
													<?php do_action( 'woocommerce_single_product_germanized_info' ); ?>
												</div>
											<?php endif; ?>

										<?php
											do_action( 'woocommerce_single_product_summary_single_excerpt' ); ?>

											<!-- out of stock -->
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
											do_action( 'woocommerce_single_product_summary_single_add_to_cart' );
											do_action( 'woocommerce_single_product_summary' );
											do_action( 'getbowtied_woocommerce_before_single_product_summary_data_tabs' );
											do_action( 'woocommerce_single_product_summary_single_meta' );
										?>

									<!-- </div> -->

								</div>

								<?php do_action( 'woocommerce_after_single_product_summary_data_tabs' ); ?>

								<?php if ( $product->get_upsell_ids() ) : ?>
									<div class="single_product_summary_upsell">
										<?php do_action( 'woocommerce_after_single_product_summary_upsell_display' ); ?>
									</div><!-- .single_product_summary_upsells -->
								<?php endif; ?>

								<div class="single_product_summary_related">
									<?php do_action( 'woocommerce_after_single_product_summary_related_products' ); ?>
								</div><!-- .single_product_summary_related -->


							</div><!-- .columns -->

							<?php

							$viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] ) : array();
							$viewed_products = array_filter( array_map( 'absint', $viewed_products ) );

							?>

						</div><!-- .row -->

					</div><!--.product_content_wrapper-->


		    </div><!-- .row -->

    <div class="row">
        <div class="large-9 large-centered columns">
            <?php
				do_action( 'woocommerce_single_product_summary_single_sharing' );
			?>

        </div><!-- .columns -->
    </div><!-- .row -->

    <meta itemprop="url" content="<?php the_permalink(); ?>" />

	</div><!-- #product-<?php the_ID(); ?> -->

	<div class="row">
	    <div class="xlarge-9 xlarge-centered columns">
			<?php do_action( 'woocommerce_after_single_product' ); ?>
	    </div><!-- .columns -->
	</div><!-- .row -->

	<!-- product navigation -->
	<div class="product_navigation">
	   <?php shopkeeper_product_nav( 'nav-below' ); ?>
   </div>



	<?php else: ?>

		<div class="row">
		    <div class="large-9 large-centered columns">
		    <br/><br/><br/><br/>
				<?php echo get_the_password_form(); ?>
			</div>
		</div>

	<?php endif; ?>

</div>
