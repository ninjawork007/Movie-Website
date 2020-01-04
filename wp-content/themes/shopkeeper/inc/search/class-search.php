<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

if( SHOPKEEPER_WOOCOMMERCE_IS_ACTIVE ) {

	class GBT_Ajax_Search {

		function __construct() {

			add_action( 'wp_enqueue_scripts', array( $this, 'getbowtied_scripts' ) );
			if( Shopkeeper_Opt::getOption( 'search_in_titles', false ) ) {
				add_filter( 'posts_search', array( $this, 'getbowtied_search_filters' ), 501, 2 );
			}

			add_action( 'getbowtied_product_search', array( $this, 'getbowtied_product_search' ) );

			// Search results ajax action
			add_action( 'wc_ajax_' . 'search_ajax_search', array( $this, 'getbowtied_get_search_results' ) );
		}

		/*
		 * Register scripts.
		 */
		public function getbowtied_scripts() {

			if ( !is_admin() ) {

				$localize = array(
					'ajax_search_endpoint'	 => WC_AJAX::get_endpoint( 'search_ajax_search' ),
					'action_search'			 => 'search_ajax_search',
					'min_chars'				 => 3,
					'show_preloader'		 => true,
				);

				wp_enqueue_script( 'getbowtied-predictive-search-script', get_template_directory_uri() . '/inc/search/assets/js/search.js', array( 'jquery' ), shopkeeper_theme_version(), true );
				wp_localize_script( 'getbowtied-predictive-search-script', 'search', $localize );
			}
		}

		/*
		 * Get search results via ajax
		 */
		public function getbowtied_get_search_results() {
			global $woocommerce;

			$output	 = array();
			$results = array();
			$keyword = sanitize_text_field( $_REQUEST[ 'search_keyword' ] );

			// Search products
			if ( 'yes' === get_option( 'woocommerce_hide_out_of_stock_items' ) ) {
				$tax_query = array(
					'relation' 	   => 'AND',
	              	array(
						'taxonomy' => 'product_visibility',
						'field'    => 'name',
						'terms'    => 'exclude-from-search',
						'operator' => 'NOT IN',
					),
					array(
						'taxonomy' => 'product_visibility',
						'field'    => 'name',
						'terms'    => 'outofstock',
						'operator' => 'NOT IN',
					)
				);
			} else {
				$tax_query = array(
	              	array(
						'taxonomy' => 'product_visibility',
						'field'    => 'name',
						'terms'    => 'exclude-from-search',
						'operator' => 'NOT IN',
					)
	            );
			}

			$args = array(
				's'						 => $keyword,
				'posts_per_page'		 => 8,
				'post_type'				 => 'product',
				'post_status'			 => 'publish',
				'ignore_sticky_posts'	 => 1,
				'suppress_filters'		 => false,
				'tax_query'				 => $tax_query
			);

			$args = apply_filters('search_products_args', $args);

			$products = get_posts( $args );

			$output = array();
			$output['suggestions'] = '';

			if ( !empty( $products ) ) {

				$output['suggestions'] = $this->getbowtied_get_search_output( $products );
			}
			wp_reset_postdata();

			// Output
			echo json_encode( $output );

			die();
		}

		public function getbowtied_product_search() {
			?>

			<div class="widget_product_search">
				<div class="search-wrapp">
				    <form class="woocommerce-product-search search-form" role="search" method="get" action="<?php echo esc_url( home_url( '/'  ) ) ?>">
				        <div>
				            <input type="search"
				                   value="<?php echo get_search_query(); ?>"
				                   name="s"
				                   id="search-input"
				                   class="search-field search-input"
				                   placeholder="<?php echo esc_html_e( 'Search products&hellip;', 'woocommerce' ); ?>"
				                   data-min-chars="3"
				                   autocomplete="off" />
				            <div class="search-preloader"></div>

				            <input type="submit" value="<?php echo esc_html( 'Search', 'woocommerce' );  ?>" />
				            <input type="hidden" name="post_type" value="product" />

				            <?php if ( defined( 'ICL_LANGUAGE_CODE' ) ): // WPML compatible ?>
				              <input type="hidden" name="lang" value="<?php echo( ICL_LANGUAGE_CODE ); ?>" />
				            <?php endif; ?>
				        </div>
				    </form>
				</div>
			</div>

			<?php
		}

		/*
		 * Search Output
		 *
		 * @return string
		 */
		public function getbowtied_get_search_output( $products ) {

			ob_start();

			?>

			<div class="woocommerce columns-8">
				<ul id="products-grid" class="products small-up-4 medium-up-4 large-up-5 xlarge-up-6 xxlarge-up-8">

					<?php foreach ( $products as $product_id ) { ?>
						<?php $product = wc_get_product( $product_id ); ?>
							<?php if($product) { ?>

								<li class="column">

									<?php if ( Shopkeeper_Opt::getOption( 'second_image_product_listing', true ) ) {

											$product_thumbnail_second = [];
											$attachment_ids = $product->get_gallery_image_ids();
											if ( $attachment_ids ) {
												$loop = 0;
												foreach ( $attachment_ids as $attachment_id ) {
													$image_link = wp_get_attachment_url( $attachment_id );
													if (!$image_link) continue;
													$loop++;
													$product_thumbnail_second = wp_get_attachment_image_src($attachment_id, 'shop_catalog');
													if ($loop == 1) break;
												}
											}

											$style = '';
											$class = '';
											if (isset($product_thumbnail_second[0])) {
												$style = 'background-image:url(' . $product_thumbnail_second[0] . ')';
												$class = 'with_second_image second_image_loaded';
											}
										}

										$instock_class = '';
										if( !$product->is_in_stock() ){
											$instock_class = 'outofstock';
										}

										?>

										<div class="product_thumbnail_wrapper <?php echo esc_attr( $instock_class ); ?>">

											<div class="product_thumbnail <?php echo esc_attr( $class ); ?>">
												<a href="<?php echo get_permalink( $product->get_id() ); ?>">
													<span class="product_thumbnail_background" style="<?php echo esc_attr( $style ); ?>"></span>

													<?php
														if ( has_post_thumbnail( $product->get_id() ) ) {
															echo get_the_post_thumbnail( $product->get_id(), 'shop_catalog');
														} else {
															echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', wc_placeholder_img_src() ), $product->get_id() );
														}
													?>

												</a>
											</div>

											<?php if( !Shopkeeper_Opt::getOption( 'catalog_mode', false ) ) { ?>
												<?php if ( $product->is_on_sale() ) { ?>
													<span class="onsale"><?php echo esc_html__( 'Sale!', 'woocommerce' ); ?></span>
												<?php } ?>

												<?php if ( !$product->is_in_stock() && !empty( Shopkeeper_Opt::getOption( 'out_of_stock_label', 'Out of stock' ) ) ) { ?>
										            <div class="out_of_stock_badge_loop"><?php printf( __( '%s', 'woocommerce' ), Shopkeeper_Opt::getOption( 'out_of_stock_label', 'Out of stock' )); ?></div>
										        <?php } ?>
										    <?php } ?>

										</div>

										<h3><a class="product-title-link" href="<?php echo get_permalink( $product->get_id() ); ?>"><?php echo wp_kses_post($product->get_title()); ?></a></h3>

				    					<div class="product_after_shop_loop">

											<?php if ( $price_html = $product->get_price_html() ) { ?>
												<span class="price"><?php echo wp_kses($price_html, array('del' => array(), 'span' =>array('class' => array()), 'ins' => array())); ?></span>
											<?php } ?>

										</div>
								</li>
							<?php } ?>

					<?php } ?>

				</ul>
			</div>

			<?php

			return ob_get_clean();
		}

		/*
		 * Search only in products titles
		 *
		 * @param string $search SQL
		 *
		 * @return string prepared SQL
		 */
		public function getbowtied_search_filters( $search, $wp_query ) {
			global $wpdb;

			if ( empty( $search ) || is_admin() ) {
				return $search; // skip processing - there is no keyword
			}

			$q = $wp_query->query_vars;

			if ( $q[ 'post_type' ] !== 'product' ) {
				return $search; // skip processing
			}

			$n = !empty( $q[ 'exact' ] ) ? '' : '%';

			$search		 = $searchand	 = '';

			if ( !empty( $q[ 'search_terms' ] ) ) {
				foreach ( (array) $q[ 'search_terms' ] as $term ) {
					$term = esc_sql( $wpdb->esc_like( $term ) );

					$search .= "{$searchand} (";

					// Search in title
					$search .= "($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";

					$search .= ")";

					$searchand = ' AND ';
				}
			}

			if ( !empty( $search ) ) {
				$search = " AND ({$search}) ";
				if ( !is_user_logged_in() )
					$search .= " AND ($wpdb->posts.post_password = '') ";
			}

			return $search;
		}
	}

	$search = new GBT_Ajax_Search;
}

?>
