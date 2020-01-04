<?php

$custom_styles .= '
	.site-header
	{
		background: ' . Shopkeeper_Opt::getOption( 'sticky_header_background_color', '#fff' ) . ';
	}
';

if( isset(Shopkeeper_Opt::getOption( 'main_header_background', array('background-color' => '#FFFFFF') )['background-color']) ) {
	$custom_styles .= '
		@media only screen and (min-width: 63.9375em)
		{
			.site-header
			{
				background-color: ' . Shopkeeper_Opt::getOption( 'main_header_background', array('background-color' => '#FFFFFF') )['background-color'] . ';
			}
		}
	';
}

if( (isset(Shopkeeper_Opt::getOption( 'main_header_background', array('background-color' => '#FFFFFF') )['background-image'])) && Shopkeeper_Opt::getOption( 'main_header_background', array('background-color' => '#FFFFFF') )['background-image'] != "" ) {
	$custom_styles .= '
		@media only screen and (min-width: 63.9375em)
		{
			.site-header
			{
				background-image:url(' . esc_url(Shopkeeper_Opt::getOption( 'main_header_background', array('background-color' => '#FFFFFF') )['background-image']) . ');
			}
		}
	';
}

if( (isset(Shopkeeper_Opt::getOption( 'main_header_background', array('background-color' => '#FFFFFF') )['background-repeat'])) ) {
	$custom_styles .= '
		@media only screen and (min-width: 63.9375em)
		{
			.site-header
			{
			background-repeat: ' . Shopkeeper_Opt::getOption( 'main_header_background', array('background-color' => '#FFFFFF') )['background-repeat'] . ';
			}
		}
	';
}

if( (isset(Shopkeeper_Opt::getOption( 'main_header_background', array('background-color' => '#FFFFFF') )['background-position'])) ) {
	$custom_styles .= '
		@media only screen and (min-width: 63.9375em)
		{
			.site-header
			{
				background-position: ' . Shopkeeper_Opt::getOption( 'main_header_background', array('background-color' => '#FFFFFF') )['background-position'] . ';
			}
		}
	';
}

if( (isset(Shopkeeper_Opt::getOption( 'main_header_background', array('background-color' => '#FFFFFF') )['background-size'])) ) {
	$custom_styles .= '
		@media only screen and (min-width: 63.9375em)
		{
			.site-header
			{
				background-size: ' . Shopkeeper_Opt::getOption( 'main_header_background', array('background-color' => '#FFFFFF') )['background-size'] . ';
			}
		}
	';
}

if( (isset(Shopkeeper_Opt::getOption( 'main_header_background', array('background-color' => '#FFFFFF') )['background-attachment'])) ) {
	$custom_styles .= '
		@media only screen and (min-width: 63.9375em)
		{
			.site-header
			{
				background-attachment: ' . Shopkeeper_Opt::getOption( 'main_header_background', array('background-color' => '#FFFFFF') )['background-attachment'] . ';
			}
		}
	';
}

$site_logo_height = 33;
if( Shopkeeper_Opt::getOption( 'site_logo', get_template_directory_uri() . '/images/shopkeeper-logo.png' ) != "" ) {
	$site_logo_height = Shopkeeper_Opt::getOption( 'logo_height', 50 );
}

$content_margin = 0;

$page_id = "";
if ( is_single() || is_page() ) {
	$page_id = get_the_ID();
} else if ( is_home() ) {
	$page_id = get_option('page_for_posts');
}

if ( Shopkeeper_Opt::getOption( 'sticky_header', true ) || Shopkeeper_Opt::getOption( 'main_header_transparency', false ) ||
((get_post_meta($page_id, 'page_header_transparency', true)) && (get_post_meta($page_id, 'page_header_transparency', true) != "inherit"))
) {
	if ( Shopkeeper_Opt::getOption( 'main_header_layout', '1' ) == "1" || Shopkeeper_Opt::getOption( 'main_header_layout', '1' ) == "11" ) {
		$content_margin = $content_margin + $site_top_bar_height + $site_logo_height + Shopkeeper_Opt::getOption( 'spacing_above_logo', 20 ) + Shopkeeper_Opt::getOption( 'spacing_below_logo', 20 );
	}
	elseif ( Shopkeeper_Opt::getOption( 'main_header_layout', '1' ) == "2" || Shopkeeper_Opt::getOption( 'main_header_layout', '1' ) == "22" ) {
		$content_margin = $content_margin + $site_top_bar_height + $site_logo_height + Shopkeeper_Opt::getOption( 'spacing_above_logo', 20 ) + Shopkeeper_Opt::getOption( 'spacing_below_logo', 20 );
	}
	elseif ( Shopkeeper_Opt::getOption( 'main_header_layout', '1' ) == "3" ) {
		$content_margin = $content_margin + $site_top_bar_height + $site_logo_height + Shopkeeper_Opt::getOption( 'spacing_above_logo', 20 ) + Shopkeeper_Opt::getOption( 'spacing_below_logo', 20 ) + 50;
	}
}

if( Shopkeeper_Opt::getOption( 'header_width', 'custom' ) == "full" ) {
	$custom_styles .= '
		.site-header,
		#site-top-bar
		{
			padding-left: 20px;
			padding-right: 20px;
		}
	';
}

if( Shopkeeper_Opt::getOption( 'site_logo', get_template_directory_uri() . '/images/shopkeeper-logo.png' ) != "" ) {

	if( is_ssl() ) {
		$site_logo = str_replace("http://", "https://", Shopkeeper_Opt::getOption( 'site_logo', get_template_directory_uri() . '/images/shopkeeper-logo.png' ));
	} else {
		$site_logo = Shopkeeper_Opt::getOption( 'site_logo', get_template_directory_uri() . '/images/shopkeeper-logo.png' );
	}

	$custom_styles .= '
		@media only screen and (min-width: 1024px)
		{
			.site-branding img
			{
				height: ' . esc_html($site_logo_height) . 'px;
				width: auto;
			    transition: all 0.3s;
			}

			.site-header .main-navigation,
			.site-header .site-tools
			{
				height: ' . esc_html($site_logo_height) . 'px;
				line-height: ' . esc_html($site_logo_height) . 'px;
			}
		}
	';
}

$custom_styles .= '
	@media only screen and (min-width: 1024px)
	{
		.site-header
		{
			padding-top: ' . Shopkeeper_Opt::getOption( 'spacing_above_logo', 20 ) . 'px;
		}

		.site-header
		{
			padding-bottom: ' . Shopkeeper_Opt::getOption( 'spacing_below_logo', 20 ) . 'px;
		}
	}
';


$notification_top = $site_top_bar_height + $site_logo_height + Shopkeeper_Opt::getOption( 'spacing_above_logo', 20 ) + Shopkeeper_Opt::getOption( 'spacing_below_logo', 20 );
if( is_admin_bar_showing() ) {
	$notification_top = $notification_top + 32;
}

$custom_styles .= '
	@media only screen and (min-width: 63.9375em)
	{
		#page_wrapper.transparent_header .page-title-hidden .content-area,
		#page_wrapper.transparent_header .page-title-hidden > .row
		{
			padding-top: ' . esc_html($site_top_bar_height) . 'px;
		}

		#page_wrapper.transparent_header .content-area,
		#page_wrapper.sticky_header .content-area
		{
			padding-top: calc(' . $content_margin . 'px + 85px);
		}

		body.gbt_custom_notif .page-notifications
		{
			top: ' . $notification_top . 'px;
		}

		.transparent_header .single-post-header .title,
		#page_wrapper.transparent_header .shop_header .page-title,
		#page_wrapper.sticky_header:not(.transparent_header) .page-title-hidden .content-area
		{
			padding-top: ' . $content_margin . 'px;
		}

		.transparent_header .single-post-header.with-thumb .title
		{
			padding-top: ' . (200 + $content_margin) . 'px;
		}

		.transparent_header.sticky_header .page-title-shown .entry-header.with_featured_img,
		{
			margin-top: -' . ($content_margin + 85) . 'px;
		}

		.sticky_header .page-title-shown .entry-header.with_featured_img
		{
			margin-top: -' . $content_margin . 'px;
		}

		.page-template-default .transparent_header .entry-header.with_featured_img,
		.page-template-page-full-width .transparent_header .entry-header.with_featured_img
		{
			margin-top: -' . ($content_margin + 85) . 'px;
		}
	}
';

$custom_styles .= '
	.site-header,
	.default-navigation,
	.main-navigation .mega-menu > ul > li > a
	{
		font-size: ' . Shopkeeper_Opt::getOption( 'main_header_font_size', 13 ) . 'px;
	}

	.site-header,
	.main-navigation a,
	.site-tools ul li a,
	.shopping_bag_items_number,
	.wishlist_items_number,
	.site-title a,
	.widget_product_search .search-but-added,
	.widget_search .search-but-added
	{
		color: ' . Shopkeeper_Opt::getOption( 'sticky_header_color', '#000' ) . ';
	}

	.site-branding
	{
		border-color: ' . Shopkeeper_Opt::getOption( 'main_header_font_color', '#000' ) . ';
	}

	@media only screen and (min-width: 63.9375em)
	{
		.site-header,
		.main-navigation a,
		.site-tools ul li a,
		.shopping_bag_items_number,
		.wishlist_items_number,
		.site-title a,
		.widget_product_search .search-but-added,
		.widget_search .search-but-added
		{
			color: ' . Shopkeeper_Opt::getOption( 'main_header_font_color', '#000' ) . ';
		}

		.site-branding
		{
			border-color: ' . Shopkeeper_Opt::getOption( 'main_header_font_color', '#000' ) . ';
		}
	}
';

$custom_styles .= '
	@media only screen and (min-width: 1024px)
	{
		#page_wrapper.transparent_header.transparency_light .site-header,
		#page_wrapper.transparent_header.transparency_light .site-header .main-navigation a,
		#page_wrapper.transparent_header.transparency_light .site-header .site-tools ul li a,
		#page_wrapper.transparent_header.transparency_light .site-header .shopping_bag_items_number,
		#page_wrapper.transparent_header.transparency_light .site-header .wishlist_items_number,
		#page_wrapper.transparent_header.transparency_light .site-header .site-title a,
		#page_wrapper.transparent_header.transparency_light .site-header .widget_product_search .search-but-added,
		#page_wrapper.transparent_header.transparency_light .site-header .widget_search .search-but-added
		{
			color: ' . Shopkeeper_Opt::getOption( 'main_header_transparent_light_color', '#fff' ) . ';
		}
	}

	@media only screen and (min-width: 1024px)
	{
		#page_wrapper.transparent_header.transparency_dark .site-header,
		#page_wrapper.transparent_header.transparency_dark .site-header .main-navigation a,
		#page_wrapper.transparent_header.transparency_dark .site-header .site-tools ul li a,
		#page_wrapper.transparent_header.transparency_dark .site-header .shopping_bag_items_number,
		#page_wrapper.transparent_header.transparency_dark .site-header .wishlist_items_number,
		#page_wrapper.transparent_header.transparency_dark .site-header .site-title a,
		#page_wrapper.transparent_header.transparency_dark .site-header .widget_product_search .search-but-added,
		#page_wrapper.transparent_header.transparency_dark .site-header .widget_search .search-but-added
		{
			color: ' . Shopkeeper_Opt::getOption( 'main_header_transparent_dark_color', '#000' ) . ';
		}
	}
';

$custom_styles .= '
	@media only screen and (min-width: 63.9375em)
	{
		.site-header.sticky,
		#page_wrapper.transparent_header .site-header.sticky
		{
			background: ' . Shopkeeper_Opt::getOption( 'sticky_header_background_color', '#fff' ) . ';
		}

		.site-header.sticky,
		.site-header.sticky .main-navigation a,
		.site-header.sticky .site-tools ul li a,
		.site-header.sticky .shopping_bag_items_number,
		.site-header.sticky .wishlist_items_number,
		.site-header.sticky .site-title a,
		.site-header.sticky .widget_product_search .search-but-added,
		.site-header.sticky .widget_search .search-but-added,
		#page_wrapper.transparent_header .site-header.sticky,
		#page_wrapper.transparent_header .site-header.sticky .main-navigation a,
		#page_wrapper.transparent_header .site-header.sticky .site-tools ul li a,
		#page_wrapper.transparent_header .site-header.sticky .shopping_bag_items_number,
		#page_wrapper.transparent_header .site-header.sticky .wishlist_items_number,
		#page_wrapper.transparent_header .site-header.sticky .site-title a,
		#page_wrapper.transparent_header .site-header.sticky .widget_product_search .search-but-added,
		#page_wrapper.transparent_header .site-header.sticky .widget_search .search-but-added
		{
			color: ' . Shopkeeper_Opt::getOption( 'sticky_header_color', '#000' ) . ';
		}

		.site-header.sticky .site-branding
		{
			border-color: ' . Shopkeeper_Opt::getOption( 'sticky_header_color', '#000' ) . ';
		}
	}
';

if( !Shopkeeper_Opt::getOption( 'main_header_wishlist', true ) && !Shopkeeper_Opt::getOption( 'main_header_shopping_bag', true ) &&
!Shopkeeper_Opt::getOption( 'main_header_search_bar', true ) && !Shopkeeper_Opt::getOption( 'main_header_off_canvas', false ) ) {

		$custom_styles .= '.site-tools { margin:0; }';
}

if( Shopkeeper_Opt::getOption( 'sticky_header_logo', get_template_directory_uri() . '/images/shopkeeper-logo.png' ) != "" ) {
	$custom_styles .= '
		@media only screen and (max-width: 63.95em)
		{
			.site-logo
			{
				display: none;
			}

			.sticky-logo
			{
				display: block;
			}
		}
	';
}

/* header-centered-2-menus */

if( Shopkeeper_Opt::getOption( 'main_header_layout', '1' ) == "2" || Shopkeeper_Opt::getOption( 'main_header_layout', '1' ) == "22" ) {

	$header_col_right_menu_right_padding = 0;

	if ( Shopkeeper_Opt::getOption( 'main_header_wishlist', true ) ) $header_col_right_menu_right_padding += 60;
	if ( Shopkeeper_Opt::getOption( 'main_header_shopping_bag', true ) ) $header_col_right_menu_right_padding += 60;
	if ( Shopkeeper_Opt::getOption( 'main_header_search_bar', true ) ) $header_col_right_menu_right_padding += 40;
	if ( Shopkeeper_Opt::getOption( 'main_header_off_canvas', false ) ) $header_col_right_menu_right_padding += 40;

	$custom_styles .= '
		.header_col.right_menu
		{
			padding-right: ' . esc_html($header_col_right_menu_right_padding) . 'px;
		}

		.rtl .header_col.right_menu
		{
			padding-right: 0;
		}

		.rtl .header_col.left_menu
		{
			padding-left: ' . esc_html($header_col_right_menu_right_padding) . 'px;
		}

		.site-header .site-tools
		{
			height: 30px !important;
			position: absolute;
			top: 2px;
			right: 0;
		}
	';

	if( Shopkeeper_Opt::getOption( 'main_header_layout', '1' ) == "2" ) {
		$custom_styles .= '
			.header_col.left_menu .main-navigation
			{
				text-align: right !important;
				margin: 0 -15px !important;
			}

			.header_col.right_menu .main-navigation
			{
				text-align: left !important;
				margin: 0 -15px !important;
			}
		';
	}

	if ( Shopkeeper_Opt::getOption( 'main_header_layout', '1' ) == "22" ) {
		$custom_styles .= '
			.header_col.left_menu .main-navigation
			{
				text-align: left !important;
				margin: 0 -15px !important;
			}

			.header_col.right_menu .main-navigation
			{
				text-align: right !important;
				margin: 0 -15px !important;
			}
		';
	}

	$custom_styles .= '
		.header_col.branding
		{
			min-width: ' . Shopkeeper_Opt::getOption( 'logo_min_height', 50 ) . 'px;
		}
	';

}

/* header-centered-menu-under */

if( Shopkeeper_Opt::getOption( 'main_header_layout', '1' ) == "3" ) {

	$custom_styles .= '
		.main-navigation
		{
			text-align: center !important;
		}

		.site-header .main-navigation
		{
			height: 50px !important;
			line-height: 50px !important;
			margin: 10px auto -10px auto;
		}

		.site-header .site-tools
		{
			height: 30px !important;
			line-height: 30px !important;
			position: absolute;
			top: 2px;
			right: 0;
		}
	';
}

$mt = 85 + 46 + Shopkeeper_Opt::getOption( 'spacing_above_logo', 20 ) + Shopkeeper_Opt::getOption( 'spacing_below_logo', 20 );

$custom_styles .= '
	.transparent_header .with-featured-img
	{
		margin-top: -' . esc_html( $mt ) . 'px;
	}
';

?>
