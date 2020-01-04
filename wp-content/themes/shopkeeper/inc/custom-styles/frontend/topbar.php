<?php

$site_top_bar_height = 0;
if( Shopkeeper_Opt::getOption( 'top_bar_switch', false ) ) {
	$site_top_bar_height = 43;
}

$custom_styles .= '
	#site-top-bar
	{
		height: ' . esc_html($site_top_bar_height) . 'px;
	}
';

if( Shopkeeper_Opt::getOption( 'top_bar_navigation_position', 'right' ) == 'left' ) {
	$custom_styles .= '
		#site-navigation-top-bar
		{
			float: left;
		}
	';
}

$custom_styles .= '
	#site-top-bar,
	#site-navigation-top-bar .sf-menu ul
	{
		background: ' . Shopkeeper_Opt::getOption( 'top_bar_background_color', '#333333' ) . ';
	}

	#site-top-bar,
	#site-top-bar a,
	.language-and-currency .wcml_currency_switcher > ul > li.wcml-cs-active-currency > a
	{
		color: ' . Shopkeeper_Opt::getOption( 'top_bar_typography', '#fff' ) . ';
	}

	#site-top-bar ul.sk_social_icons_list li svg
	{
		fill: ' . Shopkeeper_Opt::getOption( 'top_bar_typography', '#fff' ) . ';
	}
';

?>
