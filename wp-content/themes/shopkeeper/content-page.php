<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="row">
		<div class="large-12 columns">

        <div class="entry-content">
            <?php the_content(); ?>
            <?php wp_link_pages(); ?>
        </div><!-- .entry-content -->

		</div><!-- .columns -->
    </div><!-- .row -->

</div><!-- #post -->
