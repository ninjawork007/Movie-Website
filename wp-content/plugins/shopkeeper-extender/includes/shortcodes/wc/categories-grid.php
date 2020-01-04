<?php

function sk_product_categories_shortcode( $atts ) {

	wp_enqueue_style(  'shopkeeper-categories-grid-shortcode-styles' );

	extract( shortcode_atts( array(
		'product_categories_selection'	=> 'auto',
		'ids'							=> '',
		'number'     					=> 12,
		'order'      					=> 'asc',
		'hide_empty'				 	=> 1,
		'show_count'					=> 0,
		'parent'     					=> '0'
	), $atts ) );

	if ( isset( $atts[ 'ids' ] ) ) {
		$ids = explode( ',', $atts[ 'ids' ] );
		$ids = array_map( 'trim', $ids );
	} else {
		$ids = array();
	}

	$hide_empty = ( $hide_empty == true && $hide_empty == 1 ) ? 1 : 0;

	if ($product_categories_selection == "auto") {

		$args = array(
			'orderby'    => 'title',
			'order'      => $order,
			'hide_empty' => $hide_empty,
			'number'	 => $number,
		);

		if ($parent == 0) {
			$args['parent']= 0;
		}


	} else {

		$args = array(
			'orderby'    => 'include',
			'hide_empty' => $hide_empty,
			'include'    => $ids,
		);

		$parent = 999;

	}

	$product_categories = get_terms( 'product_cat', $args );

	if ( $hide_empty ) {
		foreach ( $product_categories as $key => $category ) {
			if ( $category->count == 0 ) {
				unset( $product_categories[ $key ] );
			}
		}
	}

	ob_start();

	$cat_counter = 0;

	$cat_number = count($product_categories);

	if ( $product_categories ) {

		foreach ( $product_categories as $category ) {

				   
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
			}
			
			?>

			<div class="category_<?php echo $cat_class; ?>">
				<div class="category_grid_box">
					<span class="category_item_bkg" style="background-image:url(<?php echo esc_url($image); ?>)"></span> 
					<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>" class="category_item" >
						<span class="category_name"><?php echo esc_html($category->name); ?>
							<?php if ( $show_count ) { ?>
								<span class="category_count"><?php echo esc_html($category->count); ?></span>
							<?php } ?>
						</span>
					</a>
				</div>
			</div>

			<?php

		}
		
		?>
					
			<div class="clearfix"></div>
					
		<?php

	}

	woocommerce_reset_loop();

	return '<div class="row"><div class="sk_categories_grid">' . ob_get_clean() . '</div></div>';
}

add_shortcode("product_categories_grid", "sk_product_categories_shortcode");