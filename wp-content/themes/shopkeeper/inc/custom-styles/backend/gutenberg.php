<?php

$headings_base_size = Shopkeeper_Opt::getOption( 'headings_font_size', 23 );
$h0_size = $headings_base_size * 3.157;
$h1_size = $headings_base_size * 2.369;
$h2_size = $headings_base_size * 1.777;
$h3_size = $headings_base_size * 1.333;
$h4_size = $headings_base_size * 1;
$h5_size = $headings_base_size * 0.75;
$mobile_base_size = 13;
$h0_size_mobile = $mobile_base_size * 3.157;
$h1_size_mobile = $mobile_base_size * 2.369;
$h2_size_mobile = $mobile_base_size * 1.777;
$h3_size_mobile = $mobile_base_size * 1.333;
$h4_size_mobile = $mobile_base_size * 1;
$h5_size_mobile = $mobile_base_size * 0.75;

$custom_gutenberg_styles = '
	.edit-post-visual-editor .wp-block h1,
	.edit-post-visual-editor .wp-block h2,
	.edit-post-visual-editor .wp-block h3,
	.edit-post-visual-editor .wp-block h4,
	.edit-post-visual-editor .wp-block h5,
	.edit-post-visual-editor .wp-block h6,
	.edit-post-visual-editor .wp-block label,
	.edit-post-visual-editor .wp-block table thead tr th,
	.edit-post-visual-editor .wp-block input[type="reset"],
	.edit-post-visual-editor .wp-block input[type="submit"],
	.wp-block-latest-posts a,
	.wp-block-button,
	.wp-block-cover .wp-block-cover-text,
	.wp-block-subhead,
	.wp-block-image	figcaption,
	.wp-block .wp-block-pullquote .editor-rich-text p,
	.wp-block .wp-block-quote .editor-rich-text p,
	.wp-block .wp-block-pullquote .wp-block-pullquote__citation,
	.wp-block .wp-block-quote .wp-block-quote__citation,
	.gbt_18_sk_latest_posts_title,
	.gbt_18_sk_editor_banner_title,
	.gbt_18_sk_editor_slide_title_input,
	.gbt_18_sk_editor_slide_button_input,
	.gbt_18_sk_categories_grid .gbt_18_sk_category_name,
	.gbt_18_sk_categories_grid .gbt_18_sk_category_count,
	.gbt_18_sk_slider_wrapper .gbt_18_sk_slide_button,
	.gbt_18_sk_posts_grid .gbt_18_sk_posts_grid_title,
	.gbt_18_sk_editor_portfolio_item_title,
	.editor-post-title .editor-post-title__input,
	.wc-products-block-preview .product-title,
	.wc-products-block-preview .product-add-to-cart,
	.wc-block-products-category .wc-product-preview__title,
	.wc-block-products-category .wc-product-preview__add-to-cart,
	.wp-block-media-text .editor-inner-blocks .editor-rich-text p,
	.edit-post-visual-editor p.has-drop-cap:first-letter,
	.wc-block-products-grid .wc-product-preview__title,
	.wc-block-grid .wc-block-grid__products .wc-block-grid__product .wc-block-grid__product-link .wc-block-grid__product-title,
	.wc-block-grid__product-title,
	.wc-block-grid__product-onsale,
	.wc-block-featured-product__price .woocommerce-Price-amount
	{
		font-family: ' . shopkeeper_get_main_font() . ';
	}

	.edit-post-visual-editor .wp-block p,
	.edit-post-visual-editor .wp-block textarea:not(.editor-post-title__input),
	.gbt_18_sk_editor_banner_subtitle,
	.gbt_18_sk_editor_slide_description_input,
	.edit-post-visual-editor .wp-block select
	{
		font-family: ' . shopkeeper_get_secondary_font() . ';
	}

	.edit-post-visual-editor .wp-block input,
	.editor-styles-wrapper .wp-block
	{
		font-family: ' . shopkeeper_get_secondary_font() . ' !important;
	}

	.wp-block input[type="radio"]:after,
	.wp-block .input-radio:after,
	.wp-block input[type="checkbox"]:after,
	.wp-block .input-checkbox:after
	{
		border: 2px solid rgba(' . shopkeeper_hex2rgb( Shopkeeper_Opt::getOption( 'body_color', '#545454' ) ) . ',0.8);
	}

	.wp-block input[type="radio"]:checked:after,
	.wp-block .input-radio:checked:after,
	.wp-block input[type="checkbox"]:checked:after,
	.wp-block .input-checkbox:checked:after
	{
		border-color: ' . Shopkeeper_Opt::getOption( 'main_color', '#EC7A5C' ) . '!important;
	}

	.wp-block input[type="checkbox"]:checked:after,
	.wp-block .input-checkbox:checked:after,
	.wc-block-featured-product .wp-block-button__link,
	.wc-block-featured-category .wp-block-button__link
	{
		background-color: ' . Shopkeeper_Opt::getOption( 'main_color', '#EC7A5C' ) . ';
	}

	.wp-block input[type="radio"]:checked:before,
	.wp-block .input-radio:checked:before
	{
		background-color: ' . Shopkeeper_Opt::getOption( 'main_color', '#EC7A5C' ) . '!important;
	}

	.wp-block input,
	.wp-block textarea:not(.editor-post-title__input),
	.wp-block select
	{
		border-color: rgba(' . shopkeeper_hex2rgb( Shopkeeper_Opt::getOption( 'body_color', '#545454' ) ) . ',0.1) !important;
	}

	.wc-block-featured-product .wp-block-button__link,
	.wc-block-featured-category .wp-block-button__link,
	.edit-post-visual-editor .wc-block-featured-product h2.wc-block-featured-category__title,
	.edit-post-visual-editor .wc-block-featured-category h2.wc-block-featured-category__title,
	.wc-block-featured-product .wc-block-featured-product__wrapper,
	.edit-post-visual-editor .wp-block .wc-block-featured-product h3
	{
		color: ' . Shopkeeper_Opt::getOption( 'main_background', array('background-color' => '#FFFFFF') )['background-color'] . ';
	}

	.edit-post-visual-editor
	{
		background-color:' . Shopkeeper_Opt::getOption( 'main_background', array('background-color' => '#FFFFFF') )['background-color'] . ';
	}

	.gbt_18_sk_latest_posts_title,
	.edit-post-visual-editor .wp-block-quote p,
	.edit-post-visual-editor .wp-block-pullquote p,
	.edit-post-visual-editor .wp-block-pullquote__citation,
	.wp-block-media-text .editor-inner-blocks .editor-rich-text p,
	.wc-block-grid .wc-block-grid__products .wc-block-grid__product .wc-block-grid__product-link .wc-block-grid__product-title
	{
		color: ' . Shopkeeper_Opt::getOption( 'headings_color', '#000000' ) . ';
	}

	.gbt_18_sk_latest_posts_title:hover,
	.edit-post-visual-editor .wp-block-latest-posts a,
	.edit-post-visual-editor .wp-block-archives a,
	.edit-post-visual-editor .wp-block-categories a,
	.gbt_18_sk_posts_grid_title,
	.wc-block-products-grid .wc-product-preview__add-to-cart,
	.wc-product-preview .star-rating span:before,
	.wc-block-grid .wc-block-grid__products .wc-block-grid__product .wc-block-grid__product-rating .star-rating span::before,
	.wc-block-grid .wc-block-grid__products .wc-block-grid__product .wc-block-grid__product-add-to-cart .wp-block-button__link,
	.wc-block-product-categories.is-list ul li a
	{
		color: ' . Shopkeeper_Opt::getOption( 'main_color', '#EC7A5C' ) . ';
	}

	.editor-styles-wrapper,
	.edit-post-visual-editor,
	.edit-post-visual-editor .wp-block-quote__citation,
	.edit-post-visual-editor .wp-block p,
	.edit-post-visual-editor .wp-block table tr th,
	.edit-post-visual-editor .wp-block table tr td,
	.edit-post-visual-editor .wp-block table thead tr th,
	.edit-post-visual-editor .wp-block pre,
	.edit-post-visual-editor .wp-block li,
	.edit-post-visual-editor .wp-block label,
	.wp-block-latest-posts__post-date,
	.wp-block-gallery .blocks-gallery-item figcaption,
	.wp-block-audio figcaption,
	.wp-block-image figcaption,
	.wp-block-video figcaption
	{
		color: ' . Shopkeeper_Opt::getOption( 'body_color', '#545454' ) . ';
	}

	.editor-post-title__block .editor-post-title__input,
	.edit-post-visual-editor .wp-block blockquote:not(.has-text-color) p,
	.edit-post-visual-editor .wp-block h1,
	.edit-post-visual-editor .wp-block h2,
	.edit-post-visual-editor .wp-block h3,
	.edit-post-visual-editor .wp-block h4,
	.edit-post-visual-editor .wp-block h5,
	.edit-post-visual-editor .wp-block h6
	{
		color: ' . Shopkeeper_Opt::getOption( 'headings_color', '#000000' ) . ';
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

	.wc-block-products-grid .wc-product-preview__price,
	.wc-block-grid__product-price.price,
	.wc-block-grid__product-price.price del
	{
		color: rgba(' . shopkeeper_hex2rgb( Shopkeeper_Opt::getOption( 'body_color', '#545454' ) ) . ',0.55);
	}

	@media only screen and (min-width: 1025px)
	{
		.editor-styles-wrapper .wp-block p,
		.editor-styles-wrapper .wp-block ul li ul,
		.editor-styles-wrapper .wp-block ul li ol,
		.editor-styles-wrapper .wp-block ul,
		.editor-styles-wrapper .wp-block ol,
		.editor-styles-wrapper .wp-block dl
		{
			font-size: ' . Shopkeeper_Opt::getOption( 'body_font_size', 16 ) . 'px;
		}
	}

	.edit-post-visual-editor .wp-block h1 { font-size: ' . esc_html( $h1_size_mobile ) . 'px; }
	.edit-post-visual-editor .wp-block h2 { font-size: ' . esc_html( $h2_size_mobile ) . 'px; }
	.edit-post-visual-editor .wp-block h3 { font-size: ' . esc_html( $h3_size_mobile ) . 'px; }
	.edit-post-visual-editor .wp-block h4 { font-size: ' . esc_html( $h4_size_mobile ) . 'px; }
	.edit-post-visual-editor .wp-block h5 { font-size: ' . esc_html( $h5_size_mobile ) . 'px; }

	.edit-post-visual-editor .wp-block p.has-drop-cap:first-letter,
	.editor-post-title__input
	{
		font-size: ' . esc_html( $h0_size_mobile ) . 'px !important;
	}

	@media only screen and (min-width: 768px) {

		.edit-post-visual-editor .wp-block h1 { font-size: ' . esc_html( $h1_size ) . 'px; }
		.edit-post-visual-editor .wp-block h2 { font-size: ' . esc_html( $h2_size ) . 'px; }
		.edit-post-visual-editor .wp-block h3 { font-size: ' . esc_html( $h3_size ) . 'px; }
		.edit-post-visual-editor .wp-block h4 { font-size: ' . esc_html( $h4_size ) . 'px; }
		.edit-post-visual-editor .wp-block h5 { font-size: ' . esc_html( $h5_size ) . 'px; }

		.edit-post-visual-editor .wp-block p.has-drop-cap:first-letter,
		.editor-post-title__input
		{
			font-size: ' . esc_html( $h0_size ) . 'px !important;
		}
	}

	@media only screen and (min-width: 768px)
	{
		.wc-block-products-grid .wc-product-preview__title
		{
			font-size: ' . Shopkeeper_Opt::getOption( 'product_title_font_size', 12 ) . 'px !important;
		}
	}
';

?>
