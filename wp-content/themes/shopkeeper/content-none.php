<div class="row">
    <div class="large-10 large-centered columns">
        <div id="content" class="site-content" role="main">

            <section class="error-404 not-found">
                <header class="page-header">
                    <div class="error-banner"></div>
                    <h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'shopkeeper' ); ?></h1>
                </header>

                <div class="page-content">
                    <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
                        <p>
                            <?php esc_html_e( 'Ready to publish your first post?', 'shopkeeper' ); ?>
                            <a href="<?php echo esc_url( admin_url( 'post-new.php' ) ); ?>"><?php esc_html_e( 'Get started here', 'shopkeeper' ); ?></a>
                        </p>
                    <?php elseif ( is_search() ) : ?>
                        <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'shopkeeper' ); ?></p>
                        <?php get_search_form(); ?>
                    <?php else : ?>
                        <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'shopkeeper' ); ?></p>
                        <?php get_search_form(); ?>
                    <?php endif; ?>

                </div>
            </section>

        </div>
    </div>
</div>
