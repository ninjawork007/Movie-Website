<?php

$custom_styles .= '
	#site-footer
	{
		background: ' . Shopkeeper_Opt::getOption( 'footer_background_color', '#f4f4f4' ) . ';
	}
';

if( Shopkeeper_Opt::getOption( 'footer_background_color', '#f4f4f4' ) == "transparent" ) {
	$custom_styles .= '
		@media only screen and (max-width: 641px)
		{
			#site-footer
			{
				padding-top: 0;
			}
		}
	';
}

$custom_styles .= '
	#site-footer,
	#site-footer .copyright_text a
	{
		color: ' . Shopkeeper_Opt::getOption( 'footer_texts_color', '#868686' ) . ';
	}

	#site-footer a,
	#site-footer .widget-title,
	.footer-navigation-wrapper ul li:after
	{
		color: ' . Shopkeeper_Opt::getOption( 'footer_links_color', '#000' ) . ';
	}

	.footer_socials_wrapper ul.sk_social_icons_list li svg,
	.site-footer-widget-area ul.sk_social_icons_list li svg
	{
		fill: ' . Shopkeeper_Opt::getOption( 'footer_links_color', '#000' ) . ';
	}
';


if( Shopkeeper_Opt::getOption( 'expandable_footer', true ) ) {
	$custom_styles .= '
		.trigger-footer-widget-area
		{
			display: none;
		}
		.site-footer-widget-area
		{
			display: block;
		}
	';
}

?>
