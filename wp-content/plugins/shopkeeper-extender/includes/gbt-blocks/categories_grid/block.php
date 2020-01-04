<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

include_once( dirname( __FILE__ ) . '/functions/function-setup.php' );

//==============================================================================
//	Frontend Output
//==============================================================================
if ( ! function_exists( 'gbt_18_sk_render_frontend_categories_grid' ) ) {
	function gbt_18_sk_render_frontend_categories_grid( $attributes ) {

		extract( shortcode_atts( array(
			'categoryIDs'					=> '',
			'orderby'						=> 'menu_order',
			'limit'     					=> 8,
			'columns'						=> '3',
			'hideEmpty'				 		=> false,
			'productCount'				 	=> true,
			'parentOnly'     				=> false,
			'align'							=> 'center',
			'queryDisplayType'				=> 'all_categories',
		), $attributes ) );

		$args['taxonomy'] = 'product_cat';
		if ( $queryDisplayType == 'specific' ) {
			$args['orderby'] 	= 'include';
			$args['include'] 	= $categoryIDs;
			$args['hide_empty'] = false;
		} else {
			$args['number']	 		= $limit;
			$args['hide_empty']		= $hideEmpty;
			$args['parent']			= ($parentOnly === true)? 0 : '';
			switch ( $orderby ) {
				case 'menu_order': break;
				case 'title_asc' :
					$args['orderby'] = 'title';
					$args['order']	 = 'asc';
					break;
				case 'title_desc':
					$args['orderby'] = 'title';
					$args['order']	 = 'desc';
					break;
				default: break;
			}
		}

		$product_categories = get_terms( $args );

		ob_start();

		$cat_counter = 0;
		$cat_number = count($product_categories);

		if ( $product_categories ) : ?>
			<div class="gbt_18_sk_categories_grid align<?php echo $align; ?>">
				<div class="gbt_18_sk_categories_grid_wrapper">
					<?php foreach ($product_categories as $category):

						$thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
						$image = wp_get_attachment_url( $thumbnail_id );

						$cat_class = "";
						$cat_counter++;   

						switch ($cat_number) {
							case 1:
								$cat_class = "one_cat_" . $cat_counter;
								break;
							case 2:
								$cat_class = "two_cat_" . $cat_counter;
								break;
							case 3:
								$cat_class = "three_cat_" . $cat_counter;
								break;
							case 4:
								$cat_class = "four_cat_" . $cat_counter;
								break;
							case 5:
								$cat_class = "five_cat_" . $cat_counter;
								break;
							default:
								if ($cat_counter < 7) {
									$cat_class = $cat_counter;
								} else {
									$cat_class = "more_than_6";
								}
						} ?>
			            <div class="gbt_18_sk_category_<?php echo $cat_class; ?>">
							<div class="gbt_18_sk_category_grid_box">
								<span class="gbt_18_sk_category_item_bkg" style="background-image:url(<?php echo esc_url($image); ?>)"></span> 
								<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>" class="gbt_18_sk_category_item" >
									<h4 class="gbt_18_sk_category_name"><?php echo esc_html($category->name); ?>
										<?php if ( $productCount ) { ?>
											<sup class="gbt_18_sk_category_count"><?php echo esc_html($category->count); ?></sup>
										<?php } ?>
									</h4>
								</a>
							</div>
						</div>
					<?php endforeach; ?>
					<div class="clearfix"></div>
		 		</div>
			</div>
		<?php endif;
		return ob_get_clean();
	}
}