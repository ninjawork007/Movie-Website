<?php

// [from_the_blog]
function sk_posts_slider_shortcode($atts, $content = null) {

	wp_enqueue_style( 'swiper' );
	wp_enqueue_script( 'swiper' );

	wp_enqueue_style(  'shopkeeper-posts-slider-shortcode-styles' );
	wp_enqueue_script( 'shopkeeper-posts-slider-shortcode-script' );

	extract(shortcode_atts(array(
		"posts" => '',
		"category" => ''
	), $atts));

	ob_start();

	?>

	<div class="row">
    <div class="from-the-blog-wrapper">

        <div class="from-the-blog swiper-container">
	        <div class="swiper-wrapper">

				<?php

	            $args = array(
	                'post_status' => 'publish',
	                'post_type' => 'post',
	                'category_name' => $category,
	                'posts_per_page' => $posts
	            );

	            $recentPosts = new WP_Query( $args );

	            if ( $recentPosts->have_posts() ) : ?>

	                <?php while ( $recentPosts->have_posts() ) : $recentPosts->the_post(); ?>

	                    <?php $post_format = get_post_format(get_the_ID()); ?>

	                    <div class="swiper-slide">

		                    <div class="from_the_blog_item <?php echo $post_format ? $post_format: 'standard'; ?> <?php if ( !has_post_thumbnail()) : ?>no_thumb<?php endif; ?>">

								<a class="from_the_blog_link" href="<?php the_permalink() ?>">
									<span class="from_the_blog_img_container">
										<span class="from_the_blog_overlay"></span>

										<?php if ( has_post_thumbnail()) :
											$image_id = get_post_thumbnail_id();
											$image_url = wp_get_attachment_image_src($image_id,'large', true);
										?>
											<span class="from_the_blog_img" style="background-image: url(<?php echo esc_url($image_url[0]); ?> );"></span>
											<span class="with_thumb_icon"></span>
										<?php else : ?>
											<span class="from_the_blog_noimg"></span>
											<span class="no_thumb_icon"></span>
										<?php endif;  ?>

									</span>
									<span class="from_the_blog_title" href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></span>
								</a>

		                        <div class="from_the_blog_content">
		                            <div class="post_meta_archive">
		                            	<?php _e( ' by ', 'shopkeeper-extender' ); ?>
		                            	<a class="url fn n" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )); ?>"
		                            		title="<?php echo sprintf( esc_html__( 'View all posts by %s', 'shopkeeper-extender' ), get_the_author() ); ?>"
		                            		rel="author">
		                            		<?php echo get_the_author(); ?>
		                            	</a>
		                            	<?php _e( ' on ', 'shopkeeper-extender' ); ?>
		                            	<a href="<?php the_permalink(); ?>" rel="bookmark"
		                            		title="<?php echo sprintf( esc_html__( 'Permalink to %s', 'shopkeeper-extender' ), the_title_attribute( 'echo=0' ) ); ?>">
		                            		<?php echo get_the_date(); ?>
		                            	</a>
									</div>
		                        </div>

		                    </div>

	                    </div>

	                <?php endwhile; ?>

	            <?php

	            endif;

	            ?>

	        </div>

	        <div class="swiper-pagination"></div>

        </div>

	</div>
    </div>

	<?php
	wp_reset_query();
	$content = ob_get_contents();
	ob_end_clean();

	return $content;
}

add_shortcode("from_the_blog", "sk_posts_slider_shortcode");
