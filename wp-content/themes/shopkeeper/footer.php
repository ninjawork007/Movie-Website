					<?php global $page_id, $woocommerce; ?>

                    <?php

                    $page_footer_option = "on";

					if (get_post_meta( $page_id, 'footer_meta_box_check', true )) {
						$page_footer_option = get_post_meta( $page_id, 'footer_meta_box_check', true );
					}

					if (class_exists('WooCommerce')) {
						if (is_shop() && get_post_meta( get_option( 'woocommerce_shop_page_id' ), 'footer_meta_box_check', true )) {
							$page_footer_option = get_post_meta( get_option( 'woocommerce_shop_page_id' ), 'footer_meta_box_check', true );
						}
					}

					?>

					<?php if ( $page_footer_option == "on" ) : ?>

                    <footer id="site-footer" role="contentinfo">

                    	 <?php if ( is_active_sidebar( 'footer-widget-area' ) ) : ?>

							<div class="trigger-footer-widget-area">
								<span class="trigger-footer-widget spk-icon-load-more"></span>
							</div>

							<div class="site-footer-widget-area">
								<div class="row">
									<?php dynamic_sidebar( 'footer-widget-area' ); ?>
								</div><!-- .row -->
							</div><!-- .site-footer-widget-area -->

						<?php endif; ?>

                        <div class="site-footer-copyright-area">
                            <div class="row">
								<div class="large-12 columns">

									<?php do_action( 'footer_socials'); ?>

									<nav class="footer-navigation-wrapper" role="navigation">
										<?php
											wp_nav_menu(array(
												'theme_location'  => 'footer-navigation',
												'fallback_cb'     => false,
												'container'       => false,
												'depth' 		  => 1,
												'items_wrap'      => '<ul class="%1$s">%3$s</ul>',
											));
										?>
									</nav><!-- #site-navigation -->

                                    <div class="copyright_text">
                                        <?php if ( Shopkeeper_Opt::getOption( 'footer_copyright_text', 'Shopkeeper - eCommerce WP Theme' ) != '' ) { ?>
											<?php printf( wp_kses_post(__( '%s', 'shopkeeper' )), Shopkeeper_Opt::getOption( 'footer_copyright_text', 'Shopkeeper - eCommerce WP Theme' )); ?>
                                        <?php } ?>
                                    </div><!-- .copyright_text -->

								</div><!--.large-12-->
							</div><!-- .row -->
                        </div><!-- .site-footer-copyright-area -->

                    </footer>

                    <?php endif; ?>

                </div><!-- #page_wrapper -->

             </div><!--</st-content -->

        <?php if (class_exists('WooCommerce') && (is_shop() || is_product_category() || is_product_tag() || (is_tax() && is_woocommerce() ))) : ?>
        <div class="off-canvas-wrapper">
        	<div class="off-canvas <?php echo is_rtl() ? 'position-right' : 'position-left' ?> <?php echo ( is_active_sidebar( 'catalog-widget-area' ) && ( Shopkeeper_Opt::getOption( 'sidebar_style', '1' ) == '0' ) ) ? 'hide-for-large':''; ?> <?php echo ( is_active_sidebar( 'catalog-widget-area' ) ) ? 'shop-has-sidebar':''; ?>" id="offCanvasLeft1" data-off-canvas>

        		<div class="menu-close hide-for-medium">
					<button class="close-button" aria-label="Close menu" type="button" data-close>
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

	            <div class="nano">
	                <div class="content">
	                    <div class="offcanvas_content_left wpb_widgetised_column">
	                        <div id="filters-offcanvas">
	                            <?php if ( is_active_sidebar( 'catalog-widget-area' ) ) : ?>
	                                <?php dynamic_sidebar( 'catalog-widget-area' ); ?>
	                            <?php endif; ?>
	                        </div>
	                    </div>
	               </div>
	            </div>
	        </div>
        </div>
    	<?php endif; ?>

		<div class="off-canvas-wrapper">
			<div class="off-canvas <?php echo is_rtl() ? 'position-left' : 'position-right' ?> " id="offCanvasRight1" data-off-canvas>

				<div class="menu-close hide-for-medium">
					<button class="close-button" aria-label="Close menu" type="button" data-close>
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

	           	<div class="nano">
	                <div class="content">
	                    <div class="offcanvas_content_right">

	                        <div id="mobiles-menu-offcanvas">

		                            <?php if( ( Shopkeeper_Opt::getOption( 'main_header_layout', '1' ) != "2" ) && ( Shopkeeper_Opt::getOption( 'main_header_layout', '1' ) != "22" ) ) : ?>

		                            	<?php if( has_nav_menu("main-navigation") ) : ?>
			                                <nav class="mobile-navigation primary-navigation hide-for-large" role="navigation">
			                                <?php
			                                    wp_nav_menu(array(
			                                        'theme_location'  => 'main-navigation',
			                                        'fallback_cb'     => false,
			                                        'container'       => false,
			                                        'items_wrap'      => '<ul id="%1$s">%3$s</ul>',
			                                    ));
			                                ?>
			                                </nav>
			                            <?php endif; ?>

		                            <?php endif; ?>

		                            <?php if( ( Shopkeeper_Opt::getOption( 'main_header_layout', '1' ) == "2" ) || ( Shopkeeper_Opt::getOption( 'main_header_layout', '1' ) == "22" ) ) : ?>

		                                <?php if( has_nav_menu("centered_header_left_navigation") ) : ?>
			                                <nav class="mobile-navigation hide-for-large" role="navigation">
			                                <?php
			                                    wp_nav_menu(array(
			                                        'theme_location'  => 'centered_header_left_navigation',
			                                        'fallback_cb'     => false,
			                                        'container'       => false,
			                                        'items_wrap'      => '<ul id="%1$s">%3$s</ul>',
			                                    ));
			                                ?>
			                                </nav>
			                            <?php endif; ?>

		                                <?php if( has_nav_menu("centered_header_right_navigation") ) : ?>
			                                <nav class="mobile-navigation hide-for-large" role="navigation">
			                                <?php
			                                    wp_nav_menu(array(
			                                        'theme_location'  => 'centered_header_right_navigation',
			                                        'fallback_cb'     => false,
			                                        'container'       => false,
			                                        'items_wrap'      => '<ul id="%1$s">%3$s</ul>',
			                                    ));
			                                ?>
			                                </nav>
			                            <?php endif; ?>

		                            <?php endif; ?>

									<?php if( Shopkeeper_Opt::getOption( 'main_header_off_canvas', false ) ) : ?>
										<?php if( has_nav_menu("secondary_navigation") ) : ?>
			                                <nav class="mobile-navigation" role="navigation">
			                                <?php
			                                    wp_nav_menu(array(
			                                        'theme_location'  => 'secondary_navigation',
			                                        'fallback_cb'     => false,
			                                        'container'       => false,
			                                        'items_wrap'      => '<ul id="%1$s">%3$s</ul>',
			                                    ));
			                                ?>
			                                </nav>
			                            <?php endif; ?>
		                            <?php endif; ?>

		                            <?php
									$theme_locations  = get_nav_menu_locations();
									if (isset($theme_locations['top-bar-navigation'])) {
										$menu_obj = get_term($theme_locations['top-bar-navigation'], 'nav_menu');
									}

									if ( (isset($menu_obj->count) && ($menu_obj->count > 0)) || (is_user_logged_in()) ) {
									?>

										<?php if( Shopkeeper_Opt::getOption( 'top_bar_switch', false ) ) : ?>
											<?php if( has_nav_menu("top-bar-navigation") ) : ?>
			                                    <nav class="mobile-navigation hide-for-large" role="navigation">
			                                    <?php
			                                        wp_nav_menu(array(
			                                            'theme_location'  => 'top-bar-navigation',
			                                            'fallback_cb'     => false,
			                                            'container'       => false,
			                                            'items_wrap'      => '<ul id="%1$s">%3$s</ul>',
			                                        ));
			                                    ?>

			                                    <?php if ( is_user_logged_in() ) { ?>
			                                        <ul><li><a href="<?php echo get_site_url(); ?>/?<?php echo get_option('woocommerce_logout_endpoint'); ?>=true" class="logout_link"><?php esc_html_e('Logout', 'woocommerce'); ?></a></li></ul>
			                                    <?php } ?>
			                                    </nav>
			                                <?php endif; ?>
		                                <?php endif; ?>

									<?php } ?>

	                        </div>
	                        <?php if ( is_active_sidebar( 'offcanvas-widget-area' ) ) : ?>
	                        	<div class="shop_sidebar wpb_widgetised_column">
	                            	<?php dynamic_sidebar( 'offcanvas-widget-area' ); ?>
	                            </div>
	                        <?php endif; ?>

						</div> <!-- offcanvas_content_right -->
					</div> <!-- content -->
				</div> <!-- nano -->
			</div> <!-- offcanvas -->
		</div> <!-- offcanvas wrapper -->


    <!-- Mini Cart -->
    <?php if (class_exists('WooCommerce')) { ?>
	    <?php if( Shopkeeper_Opt::getOption( 'main_header_shopping_bag', true ) ) : ?>
		    <div class="shopkeeper-mini-cart">
		    	<?php if ( class_exists( 'WC_Widget_Cart' ) ) { the_widget( 'WC_Widget_Cart' ); } ?>

		    	<?php
		    		if( !empty( Shopkeeper_Opt::getOption( 'main_header_minicart_message', '' ) ) ):
		    			echo '<div class="minicart-message">';
						printf( esc_html__( '%s', 'shopkeeper' ), Shopkeeper_Opt::getOption( 'main_header_minicart_message', '' ));
						echo '</div>';
		    		endif;
		    	?>
		    </div>
		<?php endif; ?>
	<?php } ?>

	 <!-- Site Search -->
    <div class="off-canvas-wrapper">
		<div class="site-search off-canvas position-top is-transition-overlap" id="offCanvasTop1" data-off-canvas>
			<div class="row has-scrollbar">
				<div class="site-search-close">
					<button class="close-button" aria-label="Close menu" type="button" data-close>
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<p class="search-text">
					<?php esc_html_e('What are you looking for?', 'shopkeeper'); ?>
				</p>
				<?php
				if ( SHOPKEEPER_WOOCOMMERCE_IS_ACTIVE ) {
					if ( Shopkeeper_Opt::getOption( 'predictive_search', true ) ) {
						do_action( 'getbowtied_product_search' );
					} else {
						the_widget( 'WC_Widget_Product_Search', 'title=' );
					}
				} else {
					the_widget( 'WP_Widget_Search', 'title=' );
				}
				?>
			</div>
		</div>
	</div><!-- .site-search -->

	 <!-- Back To Top Button -->
	<?php if( Shopkeeper_Opt::getOption( 'back_to_top_button', false ) ) : ?>
	<a href="#0" class="cd-top">
		<i class="spk-icon spk-icon-up-small" aria-hidden="true"></i>
	</a>
	<?php endif; ?>

	 <!-- Product Quick View -->
	<div class="cd-quick-view woocommerce"></div>

	<?php wp_footer(); ?>

</body>

</html>
