<?php global $yith_wcwl, $woocommerce; ?>

<header id="masthead" class="site-header centered" role="banner">

    <?php if( Shopkeeper_Opt::getOption( 'header_width', 'custom' ) == "custom" ) : ?>
    <div class="row">
        <div class="large-12 columns">
    <?php endif; ?>

            <div class="site-header-wrapper" style="max-width:<?php echo esc_html($header_max_width_style); ?>">

                <div class="wrapper_header_layout">

                    <div class="show-for-large header_col left_menu">
                        <nav class="main-navigation default-navigation" role="navigation">
                            <?php
                                $args = array(
                                    'theme_location'  => 'centered_header_left_navigation',
                                    'fallback_cb'     => false,
                                    'container'       => false,
                                    'items_wrap'      => '<ul class="%1$s">%3$s</ul>'
                                );

                                if( class_exists('rc_scm_walker') ) {
                                    $args['walker'] = new rc_scm_walker;
                                }

                                wp_nav_menu( $args );
                            ?>
                        </nav><!-- .main-navigation -->
                    </div>

                    <div class="header_col branding">
                        <div class="site-branding">

                            <?php

							if( Shopkeeper_Opt::getOption( 'site_logo', get_template_directory_uri() . '/images/shopkeeper-logo.png' ) != "" ) {
								if (is_ssl()) {
									$site_logo = str_replace("http://", "https://", Shopkeeper_Opt::getOption( 'site_logo', get_template_directory_uri() . '/images/shopkeeper-logo.png' ));
									if ($header_transparency_class == "transparent_header")	{
										if ( ( $transparency_scheme == "transparency_light" ) && ( Shopkeeper_Opt::getOption( 'light_transparent_header_logo', '' ) != "" ) ) {
											$site_logo = str_replace("http://", "https://", Shopkeeper_Opt::getOption( 'light_transparent_header_logo', '' ));
										}
										if ( ($transparency_scheme == "transparency_dark") && ( Shopkeeper_Opt::getOption( 'dark_transparent_header_logo', '' ) != "" ) ) {
											$site_logo = str_replace("http://", "https://", Shopkeeper_Opt::getOption( 'dark_transparent_header_logo', '' ));
										}
									}
								} else {
									$site_logo = Shopkeeper_Opt::getOption( 'site_logo', get_template_directory_uri() . '/images/shopkeeper-logo.png' );
									if ($header_transparency_class == "transparent_header")	{
										if ( ($transparency_scheme == "transparency_light") && ( Shopkeeper_Opt::getOption( 'light_transparent_header_logo', '' ) != "" ) ) {
											$site_logo = Shopkeeper_Opt::getOption( 'light_transparent_header_logo', '' );
										}
										if ( ($transparency_scheme == "transparency_dark") && ( Shopkeeper_Opt::getOption( 'dark_transparent_header_logo', '' ) != "" ) ) {
											$site_logo = Shopkeeper_Opt::getOption( 'dark_transparent_header_logo', '' );
										}
									}
								}

								if( Shopkeeper_Opt::getOption( 'sticky_header_logo', get_template_directory_uri() . '/images/shopkeeper-logo.png' ) != "" ) {
									if (is_ssl()) {
										$sticky_header_logo = str_replace("http://", "https://", Shopkeeper_Opt::getOption( 'sticky_header_logo', get_template_directory_uri() . '/images/shopkeeper-logo.png' ));
									} else {
										$sticky_header_logo = Shopkeeper_Opt::getOption( 'sticky_header_logo', get_template_directory_uri() . '/images/shopkeeper-logo.png' );
									}
								}


							?>

                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                                    <img class="site-logo" src="<?php echo esc_url($site_logo); ?>" title="<?php bloginfo( 'description' ); ?>" alt="<?php bloginfo( 'name' ); ?>" />
                                    <?php if ( Shopkeeper_Opt::getOption( 'sticky_header_logo', get_template_directory_uri() . '/images/shopkeeper-logo.png' ) != "" ) { ?>
                                        <img class="sticky-logo" src="<?php echo esc_url($sticky_header_logo); ?>" title="<?php bloginfo( 'description' ); ?>" alt="<?php bloginfo( 'name' ); ?>" />
                                    <?php } ?>
                                </a>

                            <?php } else { ?>

                                <div class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></div>

                            <?php } ?>

                        </div><!-- .site-branding -->
                    </div>

                    <div class="show-for-large header_col right_menu">
                        <nav class="main-navigation default-navigation" role="navigation">
                            <?php
                                $args = array(
                                    'theme_location'  => 'centered_header_right_navigation',
                                    'fallback_cb'     => false,
                                    'container'       => false,
                                    'items_wrap'      => '<ul class="%1$s">%3$s</ul>'
                                );

                                if( class_exists('rc_scm_walker') ) {
                                    $args['walker'] = new rc_scm_walker;
                                }

                                wp_nav_menu( $args );
                            ?>
                        </nav><!-- .main-navigation -->
                    </div>

                </div>

                <?php
				$site_tools_padding_class = "";
                if ( Shopkeeper_Opt::getOption( 'main_header_off_canvas', false ) ) {
					if ( Shopkeeper_Opt::getOption( 'main_header_off_canvas_icon', '' ) == "" ) {
                		$site_tools_padding_class = "offset";
					}
				}
				elseif ( Shopkeeper_Opt::getOption( 'main_header_search_bar', true ) ) {
                	if ( Shopkeeper_Opt::getOption( 'main_header_search_bar_icon', '' ) == "" ) {
						$site_tools_padding_class = "offset";
					}
				}
                ?>

                <div class="site-tools <?php echo esc_html($site_tools_padding_class); ?>">
                    <ul>

                        <?php if (class_exists('YITH_WCWL')) : ?>
                        <?php if ( Shopkeeper_Opt::getOption( 'main_header_wishlist', true ) ) : ?>
                        <li class="wishlist-button">
                            <a href="<?php echo esc_url($yith_wcwl->get_wishlist_url()); ?>" class="tools_button">
                                <span class="tools_button_icon">
                                    <?php if ( Shopkeeper_Opt::getOption( 'main_header_wishlist_icon', '' ) != "" ) : ?>
                                    <img src="<?php echo esc_url(Shopkeeper_Opt::getOption( 'main_header_wishlist_icon', '' )); ?>">
                                    <?php else : ?>
                                    <i class="spk-icon spk-icon-heart"></i>
									<?php endif; ?>
                                </span>
                                <span class="wishlist_items_number"><?php echo yith_wcwl_count_products(); ?></span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php endif; ?>

                        <?php if (class_exists('WooCommerce')) : ?>

                            <?php if ( Shopkeeper_Opt::getOption( 'main_header_shopping_bag', true ) ) : ?>
                            <?php if ( !Shopkeeper_Opt::getOption( 'catalog_mode', false ) ) : ?>
                            <li class="shopping-bag-button">
                                <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="tools_button">
                                    <span class="tools_button_icon">
                                    	<?php if ( Shopkeeper_Opt::getOption( 'main_header_shopping_bag_icon', '' ) != "" ) : ?>
                                        <img src="<?php echo esc_url(Shopkeeper_Opt::getOption( 'main_header_shopping_bag_icon', '' )); ?>">
                                        <?php else : ?>
                                        <i class="spk-icon spk-icon-cart-shopkeeper"></i>
    									<?php endif; ?>
                                    </span>
                                    <span class="shopping_bag_items_number"><?php echo esc_html(WC()->cart->get_cart_contents_count()); ?></span>
                                </a>
                            </li>
                            <?php endif; ?>
                            <?php endif; ?>

                            <?php if ( Shopkeeper_Opt::getOption( 'my_account_icon_state', true ) ) : ?>
                            <li class="my_account_icon">
                                <a class="tools_button" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
                                    <span class="tools_button_icon">
                                        <?php if ( Shopkeeper_Opt::getOption( 'custom_my_account_icon', '' ) != "" ) : ?>
                                        <img src="<?php echo esc_url(Shopkeeper_Opt::getOption( 'custom_my_account_icon', '' )); ?>">
                                        <?php else : ?>
                                        <i class="spk-icon spk-icon-user-account"></i>
                                        <?php endif; ?>
                                    </span>
                                </a>
                            </li>
                            <?php endif; ?>

                        <?php endif; ?>

                        <?php if ( Shopkeeper_Opt::getOption( 'main_header_search_bar', true ) ) : ?>
                        <li class="offcanvas-menu-button search-button">
                            <a class="tools_button" data-toggle="offCanvasTop1">
                                <span class="tools_button_icon">
                                    <?php if ( Shopkeeper_Opt::getOption( 'main_header_search_bar_icon', '' ) != "" ) : ?>
                                    <img src="<?php echo esc_url(Shopkeeper_Opt::getOption( 'main_header_search_bar_icon', '' )); ?>">
                                    <?php else : ?>
                                    <i class="spk-icon spk-icon-search"></i>
                                    <?php endif; ?>
                                </span>
                            </a>
                        </li>
                        <?php endif; ?>

                        <li class="offcanvas-menu-button <?php if ( !Shopkeeper_Opt::getOption( 'main_header_off_canvas', false ) ) : ?>hide-for-large<?php endif; ?>">
                            <a class="tools_button" data-toggle="offCanvasRight1">
                                <span class="tools_button_icon">
                                    <?php if ( Shopkeeper_Opt::getOption( 'main_header_off_canvas_icon', '' ) != "" ) : ?>
                                    <img src="<?php echo esc_url(Shopkeeper_Opt::getOption( 'main_header_off_canvas_icon', '' )); ?>">
                                    <?php else : ?>
                                    <i class="spk-icon spk-icon-menu"></i>
                                    <?php endif; ?>
                                </span>
                            </a>
                        </li>

                    </ul>
                </div>

            </div><!--.site-header-wrapper-->

    <?php if ( Shopkeeper_Opt::getOption( 'header_width', 'custom' ) == 'custom' ) : ?>
        </div><!-- .columns -->
    </div><!-- .row -->
    <?php endif; ?>

</header><!-- #masthead -->
