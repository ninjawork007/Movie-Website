<?php
	global $woocommerce, $wp_version;
?>

<!DOCTYPE html>

<!--[if IE 9]>
<html class="ie ie9" <?php language_attributes(); ?>>
<![endif]-->

<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php if( Shopkeeper_Opt::getOption( 'smooth_transition_between_pages', false ) ) { ?>
		<div id="header-loader">
		    <div id="header-loader-under-bar"></div>
		</div>
	<?php }	?>

	<div id="st-container" class="st-container">

        <div class="st-content">

            <?php

			$header_sticky_class = "";
			$header_transparency_class = "";
			$transparency_scheme = "";

			if ( Shopkeeper_Opt::getOption( 'sticky_header', true ) ) {
				$header_sticky_class = "sticky_header";
			}

			if ( Shopkeeper_Opt::getOption( 'main_header_transparency', false ) ) {
				$header_transparency_class = "transparent_header";
			}

			$transparency_scheme = Shopkeeper_Opt::getOption( 'main_header_transparency_scheme', 'transparency_light' );

			$page_id = "";
			if ( is_single() || is_page() ) {
				$page_id = get_the_ID();
			} else if ( is_home() ) {
				$page_id = get_option('page_for_posts');
			} else if (class_exists('WooCommerce') && is_shop()) {
				$page_id = get_option( 'woocommerce_shop_page_id' );
			}

			if ( (get_post_meta($page_id, 'page_header_transparency', true)) && (get_post_meta($page_id, 'page_header_transparency', true) != "inherit") ) {
				$header_transparency_class = "transparent_header";
				$transparency_scheme = get_post_meta( $page_id, 'page_header_transparency', true );
			}

			if ( (get_post_meta($page_id, 'page_header_transparency', true)) && (get_post_meta($page_id, 'page_header_transparency', true) == "no_transparency") ) {
				$header_transparency_class = "";
				$transparency_scheme = "";
			}

			if (class_exists('WooCommerce'))
            {
                if ( is_product_category() && is_woocommerce() )
                {
                	if ( Shopkeeper_Opt::getOption( 'shop_category_header_transparency_scheme', 'no_transparency' ) == 'inherit' )
                	{
                		// do nothing, inherit
                	}
                	else if ( Shopkeeper_Opt::getOption( 'shop_category_header_transparency_scheme', 'no_transparency' ) == 'no_transparency' )
                	{
                		$header_transparency_class = "";
						$transparency_scheme = "";
                	}
                	else
                	{
                        $header_transparency_class = "transparent_header";
                        $transparency_scheme = Shopkeeper_Opt::getOption( 'shop_category_header_transparency_scheme', 'no_transparency' );
                	}
                }
            }

			?>

            <div id="page_wrapper" class="<?php echo esc_attr( $header_sticky_class ); ?> <?php echo esc_attr( $header_transparency_class ); ?> <?php echo esc_attr( $transparency_scheme ); ?>">

                <?php do_action( 'before' ); ?>

                <?php

				$header_max_width_style = "100%";
				if ( Shopkeeper_Opt::getOption( 'header_width', 'custom' ) == 'custom' ) {
					$header_max_width_style = Shopkeeper_Opt::getOption( 'header_max_width', 1680 ) . "px";
				} else {
					$header_max_width_style = "100%";
				}

				?>

                <div class="top-headers-wrapper">

                    <?php if ( Shopkeeper_Opt::getOption( 'top_bar_switch', false ) ) : ?>
                        <?php include( get_parent_theme_file_path('header-topbar.php') ); ?>
                    <?php endif; ?>

					<?php $header_layout = Shopkeeper_Opt::getOption( 'main_header_layout', '1' ); ?>
					<?php if ( $header_layout == "1" || $header_layout == "11" ) : ?>
						<?php include( get_parent_theme_file_path('header-default.php') ); ?>
                    <?php elseif ( $header_layout == "2" || $header_layout == "22" ) : ?>
                    	<?php include( get_parent_theme_file_path('header-centered-2menus.php') ); ?>
                    <?php elseif ( $header_layout == "3" ) : ?>
                    	<?php include( get_parent_theme_file_path('header-centered-menu-under.php') ); ?>
					<?php endif; ?>

                </div>
