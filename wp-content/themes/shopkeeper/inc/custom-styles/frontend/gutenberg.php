<?php

$custom_styles .= '

	.gbt_18_sk_latest_posts_title,
	.wp-block-quote p,
	.wp-block-pullquote p,
	.wp-block-quote cite,
	.wp-block-pullquote cite,
	.wp-block-media-text p
	{
		color: ' . Shopkeeper_Opt::getOption( 'headings_color', '#000000' ) . ';
	}

	.gbt_18_sk_latest_posts_title:hover,
	.gbt_18_sk_posts_grid_title
	{
		color: ' . Shopkeeper_Opt::getOption( 'main_color', '#EC7A5C' ) . ';
	}

	.wp-block-latest-posts__post-date,
	.wp-block-gallery .blocks-gallery-item figcaption,
	.wp-block-audio figcaption,
	.wp-block-image figcaption,
	.wp-block-video figcaption
	{
		color: ' . Shopkeeper_Opt::getOption( 'body_color', '#545454' ) . ';
	}

	.wp-block-quote:not(.is-large):not(.is-style-large),
	.wp-block-quote
	{
		border-left-color: ' . Shopkeeper_Opt::getOption( 'headings_color', '#000000' ) . ';
	}

	.wp-block-pullquote
	{
		border-top-color: ' . Shopkeeper_Opt::getOption( 'headings_color', '#000000' ) . ';
		border-bottom-color: ' . Shopkeeper_Opt::getOption( 'headings_color', '#000000' ) . ';
	}

	.gbt_18_sk_latest_posts_item_link:hover .gbt_18_sk_latest_posts_img_overlay
	{
		background: ' . Shopkeeper_Opt::getOption( 'main_color', '#EC7A5C' ) . ';
	}
';

$mobile_base_size = 13;
$headings_base_size = Shopkeeper_Opt::getOption( 'headings_font_size', 23 );
$h0_size = $headings_base_size * 3.157;
$h0_size_mobile = $mobile_base_size * 3.157;

$custom_styles .= '
	p.has-drop-cap:first-letter
	{
		font-size: ' . esc_html( $h0_size_mobile ) . 'px !important;
	}

	@media only screen and (min-width: 768px) {

		p.has-drop-cap:first-letter
		{
			font-size: ' . esc_html( $h0_size ) . 'px !important;
		}
	}
';

?>
