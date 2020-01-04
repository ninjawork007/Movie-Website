<?php

	$page_id = "";
	$the_excerpt = "";
	if ( is_single() || is_page() ) {
		$page_id = get_the_ID();
	} else if ( is_home() ) {
		$page_id = get_option('page_for_posts');
		$page = get_post($page_id);
		$the_excerpt = $page->post_excerpt;
	}

    $blog_with_sidebar = "";
    if ( Shopkeeper_Opt::getOption( 'sidebar_blog_listing', false ) ) $blog_with_sidebar = "yes";
    if (isset($_GET["blog_with_sidebar"])) $blog_with_sidebar = $_GET["blog_with_sidebar"];


	if (get_post_meta( $page_id, 'page_title_meta_box_check', true )) {
		$page_title_option = get_post_meta( $page_id, 'page_title_meta_box_check', true );
	} else {
		$page_title_option = "on";
	}

	$page_header_src = "";

	if (!is_front_page()):
    	if ( $page_header_src = wp_get_attachment_url( get_post_thumbnail_id( $page_id ) ) );
    endif;



?>

	<div id="primary" class="content-area">

    <div id="content" class="site-content index-layout-3" role="main">


        <?php if ( have_posts() ) : ?>

		<?php if (!empty($page_header_src) && !is_category() && !is_author() && !is_date() && !is_tag() ): ?>
		    <header class="entry-header-page with-featured-img" style="background:url(<?php echo esc_url( $page_header_src ); ?>) center center no-repeat; background-size: cover;">
		<?php else: ?>
			<header class="entry-header-page">
		<?php endif; ?>
				<div class="row">

					<div class="xlarge-8 large-10 xlarge-centered large-centered columns without-sidebar index-layout-1">
						<ul class="list_categories list-centered">
						<?php
							if ( is_category() ) : ?>
								<div class="page-type page-title-desc"><?php esc_html_e( 'Category Archives', 'shopkeeper' ); ?></div>
								<h1 class="page-title blog-listing"><?php echo single_cat_title("", false) ?></h1>
								<?php $args = array(
										'show_option_all'    => '',
										'orderby'            => 'name',
										'order'              => 'ASC',
										'style'              => 'list',
										'show_count'         => 0,
										'hide_empty'         => 1,
										'use_desc_for_title' => 1,
										'child_of'           => get_cat_id( single_cat_title("", false) ),
										'feed'               => '',
										'feed_type'          => '',
										'feed_image'         => '',
										'exclude'            => '',
										'exclude_tree'       => '',
										'include'            => '',
										'hierarchical'       => 1,
										'title_li'           => '',
										'show_option_none'   => '',
										'number'             => null,
										'echo'               => 1,
										'depth'              => 1,
										'current_category'   => 0,
										'pad_counts'         => 0,
										'taxonomy'           => 'category',
										'walker'             => null
								);
							else: ?>
							<?php if( is_tag() ) : ?>
								<h1 class="page-title blog-listing"><?php echo single_tag_title("", false ); ?> </h1>
							<?php elseif( is_author() ) : ?>
								<h1 class="page-title blog-listing"><?php echo get_the_author(); ?> </h1>
							<?php elseif( is_date() ) : ?>
								<h1 class="page-title blog-listing"><?php echo get_the_archive_title(); ?> </h1>
							<?php elseif ( (isset($page_title_option)) && ($page_title_option == "on") ) : ?>
								<h1 class="page-title blog-listing"> <?php single_post_title();?> </h1>
							<?php endif; ?>
							<?php $args = array(
									'show_option_all'    => '',
									'orderby'            => 'name',
									'order'              => 'ASC',
									'style'              => 'list',
									'show_count'         => 0,
									'hide_empty'         => 1,
									'use_desc_for_title' => 1,
									'child_of'           => 0,
									'feed'               => '',
									'feed_type'          => '',
									'feed_image'         => '',
									'exclude'            => '',
									'exclude_tree'       => '',
									'include'            => '',
									'hierarchical'       => 1,
									'title_li'           => '',
									'show_option_none'   => 'No categories',
									'number'             => null,
									'echo'               => 1,
									'depth'              => 1,
									'current_category'   => 0,
									'pad_counts'         => 0,
									'taxonomy'           => 'category',
									'walker'             => null
							);
							 endif; ?>

							<?php $current_cat = is_home()? 'current-cat' : ''; ?>

		            		<li class="cat-item <?php echo esc_attr( $current_cat ); ?>">
								<a href="<?php if ( get_option( 'show_on_front' ) == 'page' ) echo get_permalink( get_option('page_for_posts' ) );
									else echo esc_url( home_url() );?>"><?php esc_html_e( 'All', 'shopkeeper'); ?>
								</a>
							</li>

						   <?php wp_list_categories( $args ); ?>

						</ul>

						<?php if ( ! empty( category_description($current_cat) ) ) : ?>
							<div class="page-desc">
								<?php echo category_description($current_cat); ?>
							</div>
						<?php endif; ?>

						<?php if( !empty($the_excerpt) ) : ?>
							<div class="page-desc"><?php echo esc_html($the_excerpt); ?></div>
						<?php endif; ?>

					</div><!-- .large-10-->

				</div><!-- .row-->

			</header>

			<div class="blog-posts_container">


				<?php
			    	if ( isset($sticky[0]) ) {
				    	global $wp_query;
						$args = array_merge( $wp_query->query_vars, array(  'post__not_in' => array($sticky[0]) ) );
						query_posts( $args );
					}
		    	?>


				<ul class="blog-posts">


					<?php if ( have_posts() ) : ?>

					<?php while ( have_posts() ) : the_post(); ?>

							<li class="blog-post">

								<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

									<?php the_category(); ?>

									<?php
										// placeholder for missing images
										$placeholder = ( !has_post_thumbnail() ) ? 'no-image' : '';
									?>

									<div class="bg-image-wrapper <?php echo esc_attr( $placeholder ); ?>">

										<a class="post-link" href="<?php the_permalink();?>">

											<span class="post-image" >
												<?php the_post_thumbnail(); ?>
											</span>

										</a>

									</div>

									<div class="post_content_wrapper">

										<div class="post_content">


									        <?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>

									        <?php echo '<p>' . wp_trim_words(get_the_excerpt(), 15) . ' </p>'?>

									        <a class="read_more" href="<?php echo get_permalink(); ?>"><?php esc_html_e('Continue Reading', 'shopkeeper'); ?></a>

								        </div>

									</div>

										<a class="entry-link" href="<?php echo the_permalink(); ?>"></a>

								</article>

							</li>

					<?php endwhile; ?>

				<?php else : ?>

					<?php get_template_part( 'content', 'none' ); ?>

				<?php endif; ?>

				</ul>

				<?php getbowtied_the_posts_navigation(); ?>


				</div><!-- .row-->



			</div><!-- .columns-->

        <?php else : ?>

            <?php get_template_part( 'no-results', 'index' ); ?>

        <?php endif; ?>

        </div><!-- #content -->

    </div><!-- #primary -->
