<?php

$content_width_style = "100%";
if ( !Shopkeeper_Opt::getOption( 'sidebar_blog_listing', false ) ) {
	$content_width_style = Shopkeeper_Opt::getOption( 'single_post_width', 708 ) . 'px';
}

?>

<div class="intro-effect-fadeout">

	<?php
	$thumb_url = "";
	if ( has_post_thumbnail() ) {
		$thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' );
	}
	?>

    <?php

    $meta_class = '';
    if( !Shopkeeper_Opt::getOption( 'post_meta_author', true ) && !Shopkeeper_Opt::getOption( 'post_meta_date', true ) && !Shopkeeper_Opt::getOption( 'post_meta_categories', true ) ) {
    	$meta_class = 'no-meta';
    }

	$single_post_header_thumb_class = "";
	$single_post_header_thumb_class = "";
	$single_post_header_thumb_style = "";

	if ( is_single() && has_post_thumbnail() && ! post_password_required() ) {

		if (get_post_meta( $post->ID, 'post_featured_image_meta_box_check', true )) {
			$post_featured_image_option = get_post_meta( $post->ID, 'post_featured_image_meta_box_check', true );
		} else {
			$post_featured_image_option = "on";
		}

		if ( (isset($post_featured_image_option)) && ($post_featured_image_option == "on") ) {
			$single_post_header_thumb_class = "with-thumb";
			$single_post_header_thumb_style = 'background-image:url('.$thumb_url.')';
		} else {
			$single_post_header_thumb_class = "";
			$single_post_header_thumb_style = "";
		}

	}
	?>

    <div  class="header single-post-header <?php echo esc_attr( $single_post_header_thumb_class ); ?>">

		<?php if  ( $single_post_header_thumb_class == "with-thumb" ) : ?>
			<div class="single-post-header-bkg"  style="<?php echo esc_attr( $single_post_header_thumb_style ); ?>"></div>
			<div class="single-post-header-overlay"></div>
		<?php endif; ?>

		<div class="row">
            <div class="xxlarge-5 xlarge-8 large-12 large-centered columns">
                <div class="title">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    <div class="post_meta <?php echo esc_attr( $meta_class ); ?>"> <?php shopkeeper_entry_meta(); ?></div>
                </div>
            </div>
        </div>
    </div>

</div><!--.intro-effect-fadeout-->

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="row">

		<?php if( Shopkeeper_Opt::getOption( 'sidebar_blog_listing', false ) ) : ?>
		<div class="xxlarge-8 xlarge-10 large-12 large-centered columns with-sidebar">
		<?php else : ?>
		<div class="single-post-content without-sidebar" style="max-width:<?php echo esc_html($content_width_style); ?>">
		<?php endif; ?>

			<div class="row">

				<?php if( Shopkeeper_Opt::getOption( 'sidebar_blog_listing', false ) ) : ?>
				<div class="large-9 columns">
				<?php else : ?>
				<div class="large-12 columns">
				<?php endif; ?>

					<div class="entry-content blog-single">
						<?php the_content(); ?>
						<?php wp_link_pages(); ?>
					</div><!-- .entry-content -->

					<?php if ( is_single() ) : ?>

					<footer class="entry-meta">

						<div class="post_tags"> <?php echo shopkeeper_entry_tags(); ?></div>

					</footer><!-- .entry-meta -->

					<?php endif; ?>

				</div><!-- .columns-->

				<?php if( Shopkeeper_Opt::getOption( 'sidebar_blog_listing', false ) ) : ?>
				<div class="large-3 columns">
					<?php get_sidebar(); ?>
				</div><!-- .columns-->
				<?php endif; ?>

			</div><!-- .row-->

        </div><!-- .columns -->

    </div><!-- .row -->

</div><!-- #post -->
