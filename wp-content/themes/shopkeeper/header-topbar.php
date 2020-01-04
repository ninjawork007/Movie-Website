<div id="site-top-bar">

    <?php if( Shopkeeper_Opt::getOption( 'header_width', 'custom' ) == 'custom' ) : ?>
    <div class="row">
        <div class="large-12 columns">
    <?php endif; ?>

        <div class="site-top-bar-inner" style="max-width:<?php echo esc_html($header_max_width_style); ?>">

            <div class="site-top-message">
                <?php if( !empty( Shopkeeper_Opt::getOption( 'top_bar_text', 'Free Shipping on All Orders Over $75!' ) ) ) {
                    printf( wp_kses_post(__( '%s', 'shopkeeper' )), Shopkeeper_Opt::getOption( 'top_bar_text', 'Free Shipping on All Orders Over $75!' ));
                } ?>
            </div>

            <?php do_action( 'header_socials'); ?>

            <nav id="site-navigation-top-bar" class="main-navigation" role="navigation">
                <?php
                    wp_nav_menu(array(
                        'theme_location'  => 'top-bar-navigation',
                        'fallback_cb'     => false,
                        'container'       => false,
                        'items_wrap'      => '<ul id="%1$s">%3$s</ul>',
                    ));
                ?>

                <?php if ( is_user_logged_in() && class_exists('WooCommerce') ) { ?>
                    <ul><li><a href="<?php echo wc_logout_url(); ?>" class="logout_link"><?php esc_html_e('Logout', 'woocommerce'); ?></a></li></ul>
                <?php } ?>
            </nav><!-- #site-navigation -->

        </div><!-- .site-top-bar-inner -->

    <?php if( Shopkeeper_Opt::getOption( 'header_width', 'custom' ) == 'custom' ) : ?>
        </div><!-- .columns -->
    </div><!-- .row -->
    <?php endif; ?>

</div><!-- #site-top-bar -->
