<?php

$custom_styles .= '
	body,
	table tr th,
	table tr td,
	table thead tr th,
	blockquote p,
	pre,
	label,
	.select2-dropdown-open.select2-drop-above .select2-choice,
	.select2-dropdown-open.select2-drop-above .select2-choices,
	.select2-container,
	.big-select,
	.select.big-select,
	.post_meta_archive a,
	.post_meta a,
	.nav-next a,
	.nav-previous a,
	.blog-single h6,
	.page-description,
	.woocommerce #content nav.woocommerce-pagination ul li a:focus,
	.woocommerce #content nav.woocommerce-pagination ul li a:hover,
	.woocommerce #content nav.woocommerce-pagination ul li span.current,
	.woocommerce nav.woocommerce-pagination ul li a:focus,
	.woocommerce nav.woocommerce-pagination ul li a:hover,
	.woocommerce nav.woocommerce-pagination ul li span.current,
	.woocommerce-page #content nav.woocommerce-pagination ul li a:focus,
	.woocommerce-page #content nav.woocommerce-pagination ul li a:hover,
	.woocommerce-page #content nav.woocommerce-pagination ul li span.current,
	.woocommerce-page nav.woocommerce-pagination ul li a:focus,
	.woocommerce-page nav.woocommerce-pagination ul li a:hover,
	.woocommerce-page nav.woocommerce-pagination ul li span.current,
	.posts-navigation .page-numbers a:hover,
	.woocommerce table.shop_table th,
	.woocommerce-page table.shop_table th,
	.woocommerce-checkout .woocommerce-info,
	.customer_details dt,
	.wpb_widgetised_column .widget a,
	.wpb_widgetised_column .widget.widget_product_categories a:hover,
	.wpb_widgetised_column .widget.widget_layered_nav a:hover,
	.wpb_widgetised_column .widget.widget_layered_nav li,
	.portfolio_single_list_cat a,
	.gallery-caption-trigger,
	.woocommerce .widget_layered_nav ul li.chosen a,
	.woocommerce-page .widget_layered_nav ul li.chosen a,
	.widget_layered_nav ul li.chosen a,
	.woocommerce .widget_product_categories ul li.current-cat > a,
	.woocommerce-page .widget_product_categories ul li.current-cat > a,
	.widget_product_categories ul li.current-cat > a,
	.wpb_widgetised_column .widget.widget_layered_nav_filters a,
	.widget_shopping_cart p.total,
	.widget_shopping_cart p.total .amount,
	.wpb_widgetised_column .widget_shopping_cart li.empty,
	.index-layout-2 ul.blog-posts .blog-post article .post-date,
		.cd-quick-view .cd-close:after,
	form.checkout_coupon #coupon_code,
	.woocommerce .product_infos .quantity input.qty, .woocommerce #content .product_infos .quantity input.qty,
	.woocommerce-page .product_infos .quantity input.qty, .woocommerce-page #content .product_infos .quantity input.qty,
	#button_offcanvas_sidebar_left,
	.fr-position-text,
	.quantity.custom input.custom-qty,
	.add_to_wishlist,
	.product_infos .add_to_wishlist:before,
	.product_infos .yith-wcwl-wishlistaddedbrowse:before,
	.product_infos .yith-wcwl-wishlistexistsbrowse:before,
	#add_payment_method #payment .payment_method_paypal .about_paypal,
	.woocommerce-cart #payment .payment_method_paypal .about_paypal,
	.woocommerce-checkout #payment .payment_method_paypal .about_paypal,
	#stripe-payment-data > p > a,
	.product-name .product-quantity,
	.woocommerce #payment div.payment_box,
	.woocommerce-order-pay #order_review .shop_table tr.order_item td.product-quantity strong,
	.tinvwl_add_to_wishlist_button:before,
	body.gbt_classic_notif .woocommerce-info,
	.select2-search--dropdown:after,
	body.gbt_classic_notif .woocommerce-notice,
	.woocommerce-cart #content table.cart td.actions .coupon #coupon_code
	{
		color: ' . Shopkeeper_Opt::getOption( 'body_color', '#545454' ) . ';
	}

	a.woocommerce-remove-coupon:after,
	.shopkeeper-continue-shopping .button,
	.fr-caption,
	.woocommerce-order-pay .woocommerce .woocommerce-info,
	body.gbt_classic_notif .woocommerce-info::before
	{
		color: ' . Shopkeeper_Opt::getOption( 'body_color', '#545454' ) . '!important;
	}

	.nav-previous-title,
	.nav-next-title,
	.post_tags a,
	.wpb_widgetised_column .tagcloud a,
	.products .add_to_wishlist:before
	{
		color: rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'body_color', '#545454' )) . ',0.4);
	}

	.required
	{
		color: rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'body_color', '#545454' )) . ',0.4) !important;
	}

	.yith-wcwl-add-button,
	.yith-wcwl-wishlistaddedbrowse,
	.yith-wcwl-wishlistexistsbrowse,
	.share-product-text,
	.product_meta,
	.product_meta a,
	.product_meta_separator,
	.woocommerce table.shop_attributes td,
	.woocommerce-page table.shop_attributes td,
	.tob_bar_shop,
	.post_meta_archive,
	.post_meta,
	del,
	.wpb_widgetised_column .widget li,
	.wpb_widgetised_column .widget_calendar table thead tr th,
	.wpb_widgetised_column .widget_calendar table thead tr td,
	.wpb_widgetised_column .widget .post-date,
	.wpb_widgetised_column .recentcomments,
	.wpb_widgetised_column .amount,
	.wpb_widgetised_column .quantity,
	.products li:hover .add_to_wishlist:before,
	.product_after_shop_loop .price,
	.product_after_shop_loop .price ins,
	.wpb_widgetised_column .widget_price_filter .price_slider_amount,
	.product .product_after_shop_loop .product_after_shop_loop_price span.price .woocommerce-Price-amount.amount,
	.woocommerce .woocommerce-breadcrumb,
	.woocommerce-page .woocommerce-breadcrumb,
	.woocommerce .woocommerce-breadcrumb a,
	.woocommerce-page .woocommerce-breadcrumb a,
	.archive .products-grid li .product_thumbnail_wrapper > .price .woocommerce-Price-amount,
	.site-search .search-text,
	.site-search .site-search-close .close-button:hover,
	.menu-close .close-button:hover,
	.site-search .woocommerce-product-search:after,
	.site-search .widget_search .search-form:after
	{
		color: rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'body_color', '#545454' )) . ',0.55);
	}

	.products a.button.add_to_cart_button.loading,
	.woocommerce ul.products li.product .price del,
	.woocommerce ul.products li.product .price,
	.wc-block-grid__product-price.price,
	.wc-block-grid__product-price.price del,
	.wpb_wrapper .add_to_cart_inline del .woocommerce-Price-amount.amount
	{
		color: rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'body_color', '#545454' )) . ',0.55) !important;
	}

	.yith-wcwl-add-to-wishlist:after,
	.bg-image-wrapper.no-image,
	.site-search .spin:before,
	.site-search .spin:after
	{
		background-color: rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'body_color', '#545454' )) . ',0.55);
	}

	.woocommerce-thankyou-order-details
	{
		background-color: rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'body_color', '#545454' )) . ',0.25);
	}

	.product_layout_2 .product_content_wrapper .product-images-wrapper .product-images-style-2 .product_images .product-image .caption:before,
	.product_layout_3 .product_content_wrapper .product-images-wrapper .product-images-style-3 .product_images .product-image .caption:before,
	.fr-caption:before,
	.product_content_wrapper .product-images-wrapper .product_images .product-images-controller .dot.current
	{
		background-color: ' . Shopkeeper_Opt::getOption( 'body_color', '#545454' ) . ';
	}


	.product_content_wrapper .product-images-wrapper .product_images .product-images-controller .dot
	{
		background-color: rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'body_color', '#545454' )) . ',0.55);
	}

	#add_payment_method #payment div.payment_box .wc-credit-card-form,
	.woocommerce-account.woocommerce-add-payment-method #add_payment_method #payment div.payment_box .wc-payment-form,
	.woocommerce-cart #payment div.payment_box .wc-credit-card-form,
	.woocommerce-checkout #payment div.payment_box .wc-credit-card-form,
	.cd-quick-view .cd-item-info .product_infos .out_of_stock_wrapper .out_of_stock_badge_single,
	.product_content_wrapper .product_infos .woocommerce-variation-availability p.stock.out-of-stock,
	.product_layout_classic .product_infos .out_of_stock_wrapper .out_of_stock_badge_single,
	.product_layout_2 .product_content_wrapper .product_infos .out_of_stock_wrapper .out_of_stock_badge_single,
	.product_layout_3 .product_content_wrapper .product_infos .out_of_stock_wrapper .out_of_stock_badge_single,
	.product_layout_4 .product_content_wrapper .product_infos .out_of_stock_wrapper .out_of_stock_badge_single
	{
		border-color: rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'body_color', '#545454' )) . ',0.55);
	}

	.add_to_cart_inline .amount,
	.wpb_widgetised_column .widget,
	.wpb_widgetised_column .widget a:hover,
	.wpb_widgetised_column .widget.widget_product_categories a,
	.wpb_widgetised_column .widget.widget_layered_nav a,
	.widget_layered_nav ul li a,
	.widget_layered_nav,
	.wpb_widgetised_column aside ul li span.count,
	.shop_table.cart .product-price .amount,
	.quantity.custom .minus-btn,
	.quantity.custom .plus-btn,
	.woocommerce td.product-name dl.variation dt,
	.woocommerce td.product-name dl.variation dd,
	.woocommerce td.product-name dl.variation dt p,
	.woocommerce td.product-name dl.variation dd p,
	.woocommerce-page td.product-name dl.variation dt,
	.woocommerce-page td.product-name dl.variation dd p,
	.woocommerce-page td.product-name dl.variation dt p,
	.woocommerce-page td.product-name dl.variation dd p,
	.woocommerce a.remove,
	.woocommerce a.remove:after,
	.woocommerce td.product-name .wc-item-meta li
	{
		color: rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'body_color', '#545454' )) . ',0.8);
	}

	#coupon_code::-webkit-input-placeholder {
	   color: rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'body_color', '#545454' )) . ',0.8);
	}

	#coupon_code::-moz-placeholder {  /* Firefox 19+ */
	   color: rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'body_color', '#545454' )) . ',0.8);
	}

	#coupon_code:-ms-input-placeholder {
	   color: rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'body_color', '#545454' )) . ',0.8);
	}

	.woocommerce #content table.wishlist_table.cart a.remove,
	.woocommerce.widget_shopping_cart .cart_list li a.remove
	{
	   color: rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'body_color', '#545454' )) . ',0.8) !important;
	}

	input[type="text"],
	input[type="password"],
	input[type="date"],
	input[type="datetime"],
	input[type="datetime-local"],
	input[type="month"], input[type="week"],
	input[type="email"], input[type="number"],
	input[type="search"], input[type="tel"],
	input[type="time"], input[type="url"],
	textarea,
	select,
	.woocommerce-checkout .select2-container--default .select2-selection--single,
	.chosen-container-single .chosen-single,
	.country_select.select2-container,
	#billing_country_field .select2-container,
	#billing_state_field .select2-container,
	#calc_shipping_country_field .select2-container,
	#calc_shipping_state_field .select2-container,
	.woocommerce-widget-layered-nav-dropdown .select2-container .select2-selection--single,
	.woocommerce-widget-layered-nav-dropdown .select2-container .select2-selection--multiple,
	#shipping_country_field .select2-container,
	#shipping_state_field .select2-container,
	.woocommerce-address-fields .select2-container--default .select2-selection--single,
	.woocommerce-shipping-calculator .select2-container--default .select2-selection--single,
	.select2-container--default .select2-search--dropdown .select2-search__field,
	.woocommerce form .form-row.woocommerce-validated .select2-container .select2-selection,
	.woocommerce form .form-row.woocommerce-validated .select2-container,
	.woocommerce form .form-row.woocommerce-validated input.input-text,
	.woocommerce form .form-row.woocommerce-validated select,
	.woocommerce form .form-row.woocommerce-invalid .select2-container,
	.woocommerce form .form-row.woocommerce-invalid input.input-text,
	.woocommerce form .form-row.woocommerce-invalid select,
	.country_select.select2-container,
	.state_select.select2-container
	{
		border-color: rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'body_color', '#545454' )) . ',0.1) !important;
	}

	input[type="radio"]:after,
	.input-radio:after,
	input[type="checkbox"]:after,
	.input-checkbox:after
	{
		border-color: rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'body_color', '#545454' )) . ',0.8);
	}

	input[type="text"]:focus, input[type="password"]:focus,
	input[type="date"]:focus, input[type="datetime"]:focus,
	input[type="datetime-local"]:focus, input[type="month"]:focus,
	input[type="week"]:focus, input[type="email"]:focus,
	input[type="number"]:focus, input[type="search"]:focus,
	input[type="tel"]:focus, input[type="time"]:focus,
	input[type="url"]:focus, textarea:focus,
	select:focus,
	#coupon_code,
	.chosen-container-single .chosen-single:focus,
	.select2-dropdown,
	.woocommerce .product_infos .quantity input.qty,
	.woocommerce #content .product_infos .quantity input.qty,
	.woocommerce-page .product_infos .quantity input.qty,
	.woocommerce-page #content .product_infos .quantity input.qty,
	.post_tags a,
	.wpb_widgetised_column .tagcloud a,
	.coupon_code_wrapper,
	.woocommerce ul.digital-downloads:before,
	.woocommerce-page ul.digital-downloads:before,
	.woocommerce ul.digital-downloads li:after,
	.woocommerce-page ul.digital-downloads li:after,
	.widget_search .search-form,
	.woocommerce .widget_layered_nav ul li a:before,
	.woocommerce-page .widget_layered_nav ul li a:before,
	.widget_layered_nav ul li a:before,
	.woocommerce .widget_product_categories ul li a:before,
	.woocommerce-page .widget_product_categories ul li a:before,
	.widget_product_categories ul li a:before,
	.woocommerce-cart.woocommerce-page #content .quantity input.qty,
	.cd-quick-view .cd-item-info .product_infos .cart .quantity input.qty,
	.cd-quick-view .cd-item-info .product_infos .cart .woocommerce .quantity .qty,
	.woocommerce .order_review_wrapper table.shop_table tfoot tr:first-child td,
	.woocommerce-page .order_review_wrapper table.shop_table tfoot tr:first-child td,
	.woocommerce .order_review_wrapper table.shop_table tfoot tr:first-child th,
	.woocommerce-page .order_review_wrapper table.shop_table tfoot tr:first-child th,
	.select2-container .select2-dropdown--below
	{
		border-color: rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'body_color', '#545454' )) . ',0.15) !important;
	}

	.site-search .spin
	{
		border-color: rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'body_color', '#545454' )) . ',0.55);
	}

	.list-centered li a,
	.my_address_title,
	.woocommerce .shop_table.order_details tbody tr:last-child td,
	.woocommerce-page .shop_table.order_details tbody tr:last-child td,
	.woocommerce #payment ul.payment_methods li,
	.woocommerce-page #payment ul.payment_methods li,
	.comment-separator,
	.comment-list .pingback,
	.wpb_widgetised_column .widget,
	.search_result_item,
	.woocommerce div.product .woocommerce-tabs ul.tabs li:after,
	.woocommerce #content div.product .woocommerce-tabs ul.tabs li:after,
	.woocommerce-page div.product .woocommerce-tabs ul.tabs li:after,
	.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li:after,
	.woocommerce-checkout .woocommerce-customer-details h2,
	.off-canvas .menu-close
	{
		border-bottom-color: rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'body_color', '#545454' )) . ',0.15);
	}

	table tr td,
	.woocommerce table.shop_table td,
	.woocommerce-page table.shop_table td,
	.product_socials_wrapper,
	.woocommerce-tabs,
	.comments_section,
	.portfolio_content_nav #nav-below,
	.product_meta,
	.woocommerce .shop_table.woocommerce-checkout-review-order-table tr.cart-subtotal th,
	.woocommerce .shop_table.woocommerce-checkout-review-order-table tr.cart-subtotal td
	{
		border-top-color: rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'body_color', '#545454' )) . ',0.15);
	}

	.product_socials_wrapper,
	.product_meta
	{
		border-bottom-color: rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'body_color', '#545454' )) . ',0.15);
	}

	.woocommerce .cart-collaterals .cart_totals .order-total td,
	.woocommerce .cart-collaterals .cart_totals .order-total th,
	.woocommerce-page .cart-collaterals .cart_totals .order-total td,
	.woocommerce-page .cart-collaterals .cart_totals .order-total th,
	.woocommerce .cart-collaterals .cart_totals h2,
	.woocommerce .cart-collaterals .cross-sells h2,
	.woocommerce-page .cart-collaterals .cart_totals h2,
	.woocommerce-cart .woocommerce table.shop_table.cart tr:not(:nth-last-child(-n+2)),
	.woocommerce-page table.cart tr,
	.woocommerce-page #content table.cart tr,
	.widget_shopping_cart ul.cart_list li,
	.woocommerce .widget_shopping_cart ul.cart_list li
	{
		border-bottom-color: rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'body_color', '#545454' )) . ',0.05);
	}

	.woocommerce .cart-collaterals .cart_totals tr.shipping th,
	.woocommerce-page .cart-collaterals .cart_totals tr.shipping th,
	.woocommerce .cart-collaterals .cart_totals tr.order-total th,
	.woocommerce-page .cart-collaterals .cart_totals h2,
	.woocommerce .cart-collaterals .cart_totals table tr.order-total td:last-child,
	.woocommerce-page .cart-collaterals .cart_totals table tr.order-total td:last-child
	{
		border-top-color: rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'body_color', '#545454' )) . ',0.05);
	}

	table.shop_attributes tr td,
	.wishlist_table tr td,
	.shop_table.cart tr td
	{
		border-bottom-color: rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'body_color', '#545454' )) . ',0.1);
	}

	.woocommerce .cart-collaterals,
	.woocommerce-page .cart-collaterals,
	.checkout_right_wrapper,
	.woocommerce-form-track-order,
	.order-info
	{
		background: rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'body_color', '#545454' )) . ',0.05);
	}

	.woocommerce-cart .cart-collaterals:before,
	.woocommerce-cart .cart-collaterals:after,
	.custom_border:before,
	.custom_border:after,
	.woocommerce-order-pay #order_review:before,
	.woocommerce-order-pay #order_review:after
	{
		background-image: radial-gradient(closest-side, transparent 9px, rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'body_color', '#545454' )) . ',0.05) 100%);
	}

	.wpb_widgetised_column aside ul li span.count,
	.product-video-icon
	{
		background: rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'body_color', '#545454' )) . ',0.05);
	}

	.comments_section
	{
		background-color: rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'body_color', '#545454' )) . ',0.01) !important;
	}

	h1, h2, h3, h4, h5, h6,
	.entry-title-archive a,
	.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active a,
	.woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
	.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active a,
	.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active a,
	.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active a:hover,
	.woocommerce div.product .woocommerce-tabs ul.tabs li.active a:hover,
	.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active a:hover,
	.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active a:hover,
	.woocommerce table.cart .product-name a,
	.product-title-link,
	.wpb_widgetised_column .widget .product_list_widget a,
	.woocommerce .cart-collaterals .cart_totals .cart-subtotal th,
	.woocommerce-page .cart-collaterals .cart_totals .cart-subtotal th,
	.woocommerce .cart-collaterals .cart_totals tr.shipping th,
	.woocommerce-page .cart-collaterals .cart_totals tr.shipping th,
	.woocommerce-page .cart-collaterals .cart_totals tr.shipping th,
	.woocommerce-page .cart-collaterals .cart_totals tr.shipping td,
	.woocommerce-page .cart-collaterals .cart_totals tr.shipping td,
	.woocommerce .cart-collaterals .cart_totals tr.cart-discount th,
	.woocommerce-page .cart-collaterals .cart_totals tr.cart-discount th,
	.woocommerce .cart-collaterals .cart_totals tr.order-total th,
	.woocommerce-page .cart-collaterals .cart_totals tr.order-total th,
	.woocommerce .cart-collaterals .cart_totals h2,
	.woocommerce .cart-collaterals .cross-sells h2,
	.woocommerce .order_review_wrapper table.shop_table tfoot th,
	.woocommerce .order_review_wrapper table.shop_table thead th,
	.woocommerce-page .order_review_wrapper table.shop_table tfoot th,
	.woocommerce-page .order_review_wrapper table.shop_table thead th,
	.index-layout-2 ul.blog-posts .blog-post .post_content_wrapper .post_content .read_more,
	.index-layout-2 .with-sidebar ul.blog-posts .blog-post .post_content_wrapper .post_content .read_more,
	.index-layout-2 ul.blog-posts .blog-post .post_content_wrapper .post_content .read_more,
	.index-layout-3 .blog-posts_container ul.blog-posts .blog-post article .post_content_wrapper .post_content .read_more,
	.fr-window-skin-fresco.fr-svg .fr-side-next .fr-side-button-icon:before,
	.fr-window-skin-fresco.fr-svg .fr-side-previous .fr-side-button-icon:before,
	.fr-window-skin-fresco.fr-svg .fr-close .fr-close-icon:before,
	#button_offcanvas_sidebar_left .filters-icon,
	#button_offcanvas_sidebar_left .filters-text,
	.select2-container .select2-choice,
	.shop_header .list_shop_categories li.category_item > a,
	.shortcode_getbowtied_slider .swiper-button-prev,
	.shortcode_getbowtied_slider .swiper-button-next,
	.shortcode_getbowtied_slider .shortcode-slider-pagination,
	.yith-wcwl-wishlistexistsbrowse.show a,
	.product_socials_wrapper .product_socials_wrapper_inner a,
	.product_navigation #nav-below .product-nav-previous a,
	.product_navigation #nav-below .product-nav-next a,
	.cd-top,
	.fr-position-outside .fr-position-text,
	.fr-position-inside .fr-position-text,
	a.add_to_wishlist,
	.yith-wcwl-add-to-wishlist a,
	order_review_wrapper .woocommerce-checkout-review-order-table tr td,
	.order_review_wrapper .woocommerce-checkout-review-order-table ul li label,
	.order_review_wrapper .woocommerce-checkout-payment ul li label,
	.cart-collaterals .cart_totals .shop_table tr.cart-subtotal td,
	.cart-collaterals .cart_totals .shop_table tr.shipping td label,
	.cart-collaterals .cart_totals .shop_table tr.order-total td,
	.catalog-ordering select.orderby,
	.woocommerce .cart-collaterals .cart_totals table.shop_table_responsive tr td::before,
	.woocommerce .cart-collaterals .cart_totals table.shop_table_responsive tr td
	.woocommerce-page .cart-collaterals .cart_totals table.shop_table_responsive tr td::before,
	.shopkeeper_checkout_coupon, .shopkeeper_checkout_login,
	.wpb_wrapper .add_to_cart_inline .woocommerce-Price-amount.amount,
	.list-centered li a,
	tr.cart-discount td,
	section.woocommerce-customer-details table.woocommerce-table--customer-details th,
	.woocommerce-order-pay #order_review .shop_table tr td,
	.woocommerce-order-pay #order_review .shop_table tr th,
	.woocommerce-order-pay #order_review #payment ul li label,
	.woocommerce .shop_table.woocommerce-checkout-review-order-table tfoot tr td,
	.woocommerce-page .shop_table.woocommerce-checkout-review-order-table tfoot tr td,
	.woocommerce .shop_table.woocommerce-checkout-review-order-table tr td,
	.woocommerce-page .shop_table.woocommerce-checkout-review-order-table tr td,
	.woocommerce .shop_table.woocommerce-checkout-review-order-table tfoot th,
	.woocommerce-page .shop_table.woocommerce-checkout-review-order-table tfoot th,
	ul.wc_payment_methods.payment_methods.methods li.wc_payment_method > label,
	form.checkout .shop_table.woocommerce-checkout-review-order-table tr:last-child th,
	#reply-title,
	.product_infos .out_of_stock_wrapper .out_of_stock_badge_single,
	.product_content_wrapper .product_infos .woocommerce-variation-availability p.stock.out-of-stock,
	.tinvwl_add_to_wishlist_button,
	.woocommerce-cart table.shop_table td.product-subtotal *,
	.woocommerce-cart.woocommerce-page #content .quantity input.qty,
	.woocommerce-cart .entry-content .woocommerce .actions>.button,
	.woocommerce-cart #content table.cart td.actions .coupon:before,
	form .coupon.focus:after,
	.checkout_coupon_inner.focus:after,
	.checkout_coupon_inner:before,
	.widget_product_categories ul li .count,
	.widget_layered_nav ul li .count,
	.error-banner:before,
	.cart-empty,
	.cart-empty:before,
	.wishlist-empty,
	.wishlist-empty:before,
	.from_the_blog_title,
	.wc-block-grid .wc-block-grid__products .wc-block-grid__product .wc-block-grid__product-link .wc-block-grid__product-title
	{
		color: ' . Shopkeeper_Opt::getOption( 'headings_color', '#000000' ) . ';
	}

	ul.sk_social_icons_list li svg:not(.has-color)
	{
		fill: ' . Shopkeeper_Opt::getOption( 'headings_color', '#000000' ) . ';
	}

	.index-layout-2 ul.blog-posts .blog-post .post_content_wrapper .post_content h3.entry-title a,
	.index-layout-3 .blog-posts_container ul.blog-posts .blog-post article .post_content_wrapper .post_content .entry-title > a,
	#masonry_grid a.more-link,
	.account-tab-link:hover,
	.account-tab-link:active,
	.account-tab-link:focus,
	.catalog-ordering span.select2-container span,
	.catalog-ordering .select2-container .selection .select2-selection__arrow:before,
	.latest_posts_grid_wrapper .latest_posts_grid_title
	{
		color: ' . Shopkeeper_Opt::getOption( 'headings_color', '#000000' ) . '!important;
	}


	.index-layout-2 ul.blog-posts .blog-post .post_content_wrapper .post_content .read_more:before,
	.index-layout-3 .blog-posts_container ul.blog-posts .blog-post article .post_content_wrapper .post_content .read_more:before,
	#masonry_grid a.more-link:before
	{
		background-color: ' . Shopkeeper_Opt::getOption( 'headings_color', '#000000' ) . ';
	}

	.woocommerce div.product .woocommerce-tabs ul.tabs li a,
	.woocommerce #content div.product .woocommerce-tabs ul.tabs li a,
	.woocommerce-page div.product .woocommerce-tabs ul.tabs li a,
	.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a
	{
		color: rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'headings_color', '#000000' )) . ',0.35);
	}

	.woocommerce #content div.product .woocommerce-tabs ul.tabs li a:hover,
	.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover,
	.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a:hover,
	.woocommerce-page div.product .woocommerce-tabs ul.tabs li a:hover
	{
		color: rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'headings_color', '#000000' )) . ',0.45);
	}

	.fr-thumbnail-loading-background,
	.fr-loading-background,
	.blockUI.blockOverlay:before,
	.yith-wcwl-add-button.show_overlay.show:after,
	.fr-spinner:after,
	.fr-overlay-background:after,
	.search-preloader-wrapp:after,
	.product_thumbnail .overlay:after,
	.easyzoom.is-loading:after
	{
		border-color: rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'headings_color', '#000000' )) . ',0.35) !important;
		border-right-color: ' . Shopkeeper_Opt::getOption( 'headings_color', '#000000' ) . '!important;
	}
';


if( isset(Shopkeeper_Opt::getOption( 'main_background', array('background-color' => '#FFFFFF') )['background-color']) ) {

	$custom_styles .= '
		.index-layout-2 ul.blog-posts .blog-post:first-child .post_content_wrapper,
		.index-layout-2 ul.blog-posts .blog-post:nth-child(5n+5) .post_content_wrapper,
		.cd-quick-view.animate-width,
		.woocommerce .button.getbowtied_product_quick_view_button,
		.fr-ui-outside .fr-info-background,
		.fr-info-background,
		.fr-overlay-background
		{
			background-color: ' . Shopkeeper_Opt::getOption( 'main_background', array('background-color' => '#FFFFFF'))['background-color'] . '!important;
		}

		.wc-block-featured-product h2.wc-block-featured-category__title,
		.wc-block-featured-category h2.wc-block-featured-category__title,
		.wc-block-featured-product * {
			color: ' . Shopkeeper_Opt::getOption( 'main_background', array('background-color' => '#FFFFFF'))['background-color'] .';
		}
		.product_content_wrapper .product-images-wrapper .product_images .product-images-controller .dot:not(.current),
		.product_content_wrapper .product-images-wrapper .product_images .product-images-controller li.video-icon .dot:not(.current)
		{
			border-color: ' . Shopkeeper_Opt::getOption( 'main_background', array('background-color' => '#FFFFFF'))['background-color'] . '!important;
		}

		.blockUI.blockOverlay
		{
			background: rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'main_background', array('background-color' => '#FFFFFF'))['background-color']) . ',0.5) !important;;
		}
	';
}

$custom_styles .= '
	a,
	a:hover, a:focus,
	.woocommerce #respond input#submit:hover,
	.woocommerce a.button:hover,
	.woocommerce input.button:hover,
	.comments-area a,
	.edit-link,
	.post_meta_archive a:hover,
	.post_meta a:hover,
	.entry-title-archive a:hover,
	.no-results-text:before,
	.list-centered a:hover,
	.comment-edit-link,
	.filters-group li:hover,
	#map_button,
	.widget_shopkeeper_social_media a,
	.account-tab-link-mobile,
	.lost-reset-pass-text:before,
	.list_shop_categories a:hover,
	.add_to_wishlist:hover,
	.woocommerce div.product span.price,
	.woocommerce-page div.product span.price,
	.woocommerce #content div.product span.price,
	.woocommerce-page #content div.product span.price,
	.woocommerce div.product p.price,
	.woocommerce-page div.product p.price,
	.product_infos p.price,
	.woocommerce #content div.product p.price,
	.woocommerce-page #content div.product p.price,
	.comment-metadata time,
	.woocommerce p.stars a.star-1.active:after,
	.woocommerce p.stars a.star-1:hover:after,
	.woocommerce-page p.stars a.star-1.active:after,
	.woocommerce-page p.stars a.star-1:hover:after,
	.woocommerce p.stars a.star-2.active:after,
	.woocommerce p.stars a.star-2:hover:after,
	.woocommerce-page p.stars a.star-2.active:after,
	.woocommerce-page p.stars a.star-2:hover:after,
	.woocommerce p.stars a.star-3.active:after,
	.woocommerce p.stars a.star-3:hover:after,
	.woocommerce-page p.stars a.star-3.active:after,
	.woocommerce-page p.stars a.star-3:hover:after,
	.woocommerce p.stars a.star-4.active:after,
	.woocommerce p.stars a.star-4:hover:after,
	.woocommerce-page p.stars a.star-4.active:after,
	.woocommerce-page p.stars a.star-4:hover:after,
	.woocommerce p.stars a.star-5.active:after,
	.woocommerce p.stars a.star-5:hover:after,
	.woocommerce-page p.stars a.star-5.active:after,
	.woocommerce-page p.stars a.star-5:hover:after,
	.yith-wcwl-add-button:before,
	.yith-wcwl-wishlistaddedbrowse .feedback:before,
	.yith-wcwl-wishlistexistsbrowse .feedback:before,
	.woocommerce .star-rating span:before,
	.woocommerce-page .star-rating span:before,
	.product_meta a:hover,
	.woocommerce .shop-has-sidebar .no-products-info .woocommerce-info:before,
	.woocommerce-page .shop-has-sidebar .no-products-info .woocommerce-info:before,
	.woocommerce .woocommerce-breadcrumb a:hover,
	.woocommerce-page .woocommerce-breadcrumb a:hover,
	.intro-effect-fadeout.modify .post_meta a:hover,
	.from_the_blog_link:hover .from_the_blog_title,
	.portfolio_single_list_cat a:hover,
	.widget .recentcomments:before,
	.widget.widget_recent_entries ul li:before,
	#placeholder_product_quick_view .product_title:hover,
	.wpb_widgetised_column aside ul li.current-cat > span.count,
	.shopkeeper-mini-cart .widget.woocommerce.widget_shopping_cart .widget_shopping_cart_content p.buttons a.button.checkout.wc-forward,
	.getbowtied_blog_ajax_load_button:before, .getbowtied_blog_ajax_load_more_loader:before,
	.getbowtied_ajax_load_button:before, .getbowtied_ajax_load_more_loader:before,
	.list-centered li.current-cat > a:hover,
	#button_offcanvas_sidebar_left:hover,
	.shop_header .list_shop_categories li.category_item > a:hover,
	 #button_offcanvas_sidebar_left .filters-text:hover,
	 .products .yith-wcwl-wishlistaddedbrowse a:before, .products .yith-wcwl-wishlistexistsbrowse a:before,
	 .product_infos .yith-wcwl-wishlistaddedbrowse:before, .product_infos .yith-wcwl-wishlistexistsbrowse:before,
		.shopkeeper_checkout_coupon a.showcoupon,
	.woocommerce-checkout .showcoupon, .woocommerce-checkout .showlogin,
	.shop_sidebar .woocommerce.widget_shopping_cart p.buttons .button.wc-forward:not(.checkout),
	.woocommerce table.my_account_orders .woocommerce-orders-table__cell-order-actions .button,
	.woocommerce-MyAccount-content .woocommerce-pagination .woocommerce-button,
	body.gbt_classic_notif .woocommerce-message,
	body.gbt_classic_notif .woocommerce-error,
	body.gbt_classic_notif .wc-forward,
	body.gbt_classic_notif .woocommerce-error::before,
	body.gbt_classic_notif .woocommerce-message::before,
	body.gbt_classic_notif .woocommerce-info::before,
	.tinvwl_add_to_wishlist_button:hover,
	.tinvwl_add_to_wishlist_button.tinvwl-product-in-list:before,
	.return-to-shop .button.wc-backward,
	.wc-block-grid .wc-block-grid__products .wc-block-grid__product .wc-block-grid__product-rating .star-rating span::before
	{
		color: ' . Shopkeeper_Opt::getOption( 'main_color', '#EC7A5C' ) . ';
	}

	@media only screen and (min-width: 40.063em)
	{
		.nav-next a:hover,
		.nav-previous a:hover
		{
			color: ' . Shopkeeper_Opt::getOption( 'main_color', '#EC7A5C' ) . ';
		}

	}

	.widget_shopping_cart .buttons a.view_cart,
	.widget.widget_price_filter .price_slider_amount .button,
	.products a.button,
	.woocommerce .products .added_to_cart.wc-forward,
	.woocommerce-page .products .added_to_cart.wc-forward,
	body.gbt_classic_notif .woocommerce-info .button,
	.url:hover,
	.product_infos .yith-wcwl-wishlistexistsbrowse a:hover,
	.wc-block-grid__product-add-to-cart .wp-block-button__link
	{
		color: ' . Shopkeeper_Opt::getOption( 'main_color', '#EC7A5C' ) . '!important;
	}

	.order-info mark,
	.login_footer,
	.post_tags a:hover,
	.with_thumb_icon,
	.wpb_wrapper .wpb_toggle:before,
	#content .wpb_wrapper h4.wpb_toggle:before,
	.wpb_wrapper .wpb_accordion .wpb_accordion_wrapper .ui-state-default .ui-icon,
	.wpb_wrapper .wpb_accordion .wpb_accordion_wrapper .ui-state-active .ui-icon,
	.widget .tagcloud a:hover,
	section.related h2:after,
	.single_product_summary_upsell h2:after,
	.page-title.portfolio_item_title:after,
	.thumbnail_archive_container:before,
	.from_the_blog_overlay,
	.select2-results .select2-highlighted,
	.wpb_widgetised_column aside ul li.chosen span.count,
	.woocommerce .widget_product_categories ul li.current-cat > a:before,
	.woocommerce-page .widget_product_categories ul li.current-cat > a:before,
	.widget_product_categories ul li.current-cat > a:before,
	#header-loader .bar,
	.index-layout-2 ul.blog_posts .blog_post .post_content_wrapper .post_content .read_more:before,
	.index-layout-3 .blog_posts_container ul.blog_posts .blog_post article .post_content_wrapper .post_content .read_more:before,
	.page-notifications .gbt-custom-notification-notice,
	input[type="radio"]:before,
	.input-radio:before,
	.wc-block-featured-product .wp-block-button__link,
	.wc-block-featured-category .wp-block-button__link
	{
		background: ' . Shopkeeper_Opt::getOption( 'main_color', '#EC7A5C' ) . ';
	}

	.select2-container--default .select2-results__option--highlighted[aria-selected],
	.select2-container--default .select2-results__option--highlighted[data-selected]
	{
		background-color: ' . Shopkeeper_Opt::getOption( 'main_color', '#EC7A5C' ) . '!important;
	}

	@media only screen and (max-width: 40.063em) {

		.nav-next a:hover,
		.nav-previous a:hover
		{
			background: ' . Shopkeeper_Opt::getOption( 'main_color', '#EC7A5C' ) . ';
		}

	}

	.woocommerce .widget_layered_nav ul li.chosen a:before,
	.woocommerce-page .widget_layered_nav ul li.chosen a:before,
	.widget_layered_nav ul li.chosen a:before,
	.woocommerce .widget_layered_nav ul li.chosen:hover a:before,
	.woocommerce-page .widget_layered_nav ul li.chosen:hover a:before,
	.widget_layered_nav ul li.chosen:hover a:before,
	.woocommerce .widget_layered_nav_filters ul li a:before,
	.woocommerce-page .widget_layered_nav_filters ul li a:before,
	.widget_layered_nav_filters ul li a:before,
	.woocommerce .widget_layered_nav_filters ul li a:hover:before,
	.woocommerce-page .widget_layered_nav_filters ul li a:hover:before,
	.widget_layered_nav_filters ul li a:hover:before,
	.woocommerce .widget_rating_filter ul li.chosen a:before,
	.shopkeeper-mini-cart,
	.minicart-message,
	.woocommerce-message,
	.woocommerce-store-notice, p.demo_store,
	input[type="checkbox"]:checked:after,
	.input-checkbox:checked:after
	{
		background-color: ' . Shopkeeper_Opt::getOption( 'main_color', '#EC7A5C' ) . ';
	}

	.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
	.woocommerce-page .widget_price_filter .ui-slider .ui-slider-range,
	.woocommerce .quantity .plus,
	.woocommerce .quantity .minus,
	.woocommerce #content .quantity .plus,
	.woocommerce #content .quantity .minus,
	.woocommerce-page .quantity .plus,
	.woocommerce-page .quantity .minus,
	.woocommerce-page #content .quantity .plus,
	.woocommerce-page #content .quantity .minus,
	.widget_shopping_cart .buttons .button.wc-forward.checkout
	{
		background: ' . Shopkeeper_Opt::getOption( 'main_color', '#EC7A5C' ) . '!important;
	}

	.button,
	input[type="button"],
	input[type="reset"],
	input[type="submit"],
	.woocommerce-widget-layered-nav-dropdown__submit,
	.wc-stripe-checkout-button
	{
		background-color: ' . Shopkeeper_Opt::getOption( 'main_color', '#EC7A5C' ) . '!important;
	}

	.product_infos .yith-wcwl-wishlistaddedbrowse a:hover,
	.shipping-calculator-button:hover,
	.products a.button:hover,
	.woocommerce .products .added_to_cart.wc-forward:hover,
	.woocommerce-page .products .added_to_cart.wc-forward:hover,
	.products .yith-wcwl-wishlistexistsbrowse:hover a,
	.products .yith-wcwl-wishlistaddedbrowse:hover a,
	.order-number a:hover,
	.account_view_link:hover,
	.post-edit-link:hover,
	.getbowtied_ajax_load_button a:not(.disabled):hover,
	.getbowtied_blog_ajax_load_button a:not(.disabled):hover
	{
		color:  rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'main_color', '#EC7A5C' )) . ',0.8) !important;
	}

	.product-title-link:hover
	{
		color:  rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'headings_color', '#000000' )) . ',0.8);
	}

	.button:hover,
	input[type="button"]:hover,
	input[type="reset"]:hover,
	input[type="submit"]:hover,
	.woocommerce .product_infos .quantity .minus:hover,
	.woocommerce #content .product_infos .quantity .minus:hover,
	.woocommerce-page .product_infos .quantity .minus:hover,
	.woocommerce-page #content .product_infos .quantity .minus:hover,
	.woocommerce .quantity .plus:hover,
	.woocommerce #content .quantity .plus:hover,
	.woocommerce-page .quantity .plus:hover,
	.woocommerce-page #content .quantity .plus:hover,
	.wpb_wrapper .add_to_cart_inline .add_to_cart_button:hover,
	.woocommerce-widget-layered-nav-dropdown__submit:hover,
	.woocommerce-checkout a.button.wc-backward:hover
	{
		background: rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'main_color', '#EC7A5C' )) . ',0.8) !important;
	}

	.post_tags a:hover,
	.widget .tagcloud a:hover,
	.widget_shopping_cart .buttons a.view_cart,
	.account-tab-link-mobile,
	.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
	.woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle,
	.woocommerce .widget_product_categories ul li.current-cat > a:before,
	.woocommerce-page .widget_product_categories ul li.current-cat > a:before,
	.widget_product_categories ul li.current-cat > a:before,
	.widget_product_categories ul li a:hover:before,
	.widget_layered_nav ul li a:hover:before,
	input[type="radio"]:checked:after,
	.input-radio:checked:after,
	input[type="checkbox"]:checked:after,
	.input-checkbox:checked:after,
	.return-to-shop .button.wc-backward
	{
		border-color: ' . Shopkeeper_Opt::getOption( 'main_color', '#EC7A5C' ) . ';
	}

	.wpb_tour.wpb_content_element .wpb_tabs_nav  li.ui-tabs-active a,
	.wpb_tabs.wpb_content_element .wpb_tabs_nav li.ui-tabs-active a,
	.woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
	.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active a,
	.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active a,
	.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active a,
	.main-navigation ul ul li a:hover,
	.language-and-currency #top_bar_language_list > ul > li.menu-item-first > ul.sub-menu li a:hover,
	.language-and-currency .wcml_currency_switcher > ul > li.wcml-cs-active-currency ul.wcml-cs-submenu li a:hover
	{
		border-bottom-color: ' . Shopkeeper_Opt::getOption( 'main_color', '#EC7A5C' ) . ';
	}

	.woocommerce div.product .woocommerce-tabs ul.tabs li.active,
	.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active,
	.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active,
	.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active
	{
		border-top-color: ' . Shopkeeper_Opt::getOption( 'main_color', '#EC7A5C' ) . '!important;
	}

	.off-canvas,
	.offcanvas_content_left,
	.offcanvas_content_right
	{
		background-color: ' . Shopkeeper_Opt::getOption( 'offcanvas_bg_color', '#ffffff' ) . ';
		color: ' . Shopkeeper_Opt::getOption( 'offcanvas_text_color', '#545454' ) . ';
	}

	.off-canvas table tr th,
	.off-canvas table tr td,
	.off-canvas table thead tr th,
	.off-canvas blockquote p,
	.off-canvas label,
	.off-canvas .widget_search .search-form:after,
	.off-canvas .woocommerce-product-search:after,
	.off-canvas .submit_icon,
	.off-canvas .widget_search #searchsubmit,
	.off-canvas .widget_product_search .search-submit,
	.off-canvas .widget_search .search-submit,
	.off-canvas .woocommerce-product-search button[type="submit"],
	.off-canvas .wpb_widgetised_column .widget a:not(.button),
	.off-canvas .wpb_widgetised_column .widget a:not(.button),
	.off-canvas .wpb_widgetised_column .widget_calendar table thead tr th,
	.off-canvas .add_to_cart_inline .amount,
	.off-canvas .wpb_widgetised_column .widget,
	.off-canvas .wpb_widgetised_column .widget a:not(.button):hover,
	.off-canvas .wpb_widgetised_column .widget.widget_product_categories a,
	.off-canvas .wpb_widgetised_column .widget.widget_layered_nav a,
	.off-canvas .widget_layered_nav ul li a, .widget_layered_nav,
	.off-canvas .shop_table.cart .product-price .amount,
	.off-canvas .menu-close .close-button,
	.off-canvas .site-search-close .close-button
	{
		color: ' . Shopkeeper_Opt::getOption( 'offcanvas_text_color', '#545454' ) . '!important;
	}

	.off-canvas .widget-title,
	.off-canvas .mobile-navigation a,
	.off-canvas .mobile-navigation ul li .spk-icon-down-small:before,
	.off-canvas .mobile-navigation ul li .spk-icon-up-small:before,
	.off-canvas.site-search .widget_product_search .search-field,
	.off-canvas.site-search .widget_search .search-field,
	.off-canvas.site-search input[type="search"],
	.off-canvas .widget_product_search input[type="submit"],
	.off-canvas.site-search .search-form .search-field,
	.off-canvas .woocommerce .product-title-link
	{
		color: ' . Shopkeeper_Opt::getOption( 'offcanvas_headings_color', '#000000' ) . '!important;
	}

	.off-canvas ul.sk_social_icons_list li svg
	{
		fill: ' . Shopkeeper_Opt::getOption( 'offcanvas_headings_color', '#000000' ) . ';
	}

	.off-canvas .woocommerce .price,
	.off-canvas .site-search-close .close-button:hover,
	.off-canvas .search-text,
	.off-canvas .widget_search .search-form:after,
	.off-canvas .woocommerce-product-search:after,
	.off-canvas .submit_icon,
	.off-canvas .widget_search #searchsubmit,
	.off-canvas .widget_product_search .search-submit,
	.off-canvas .widget_search .search-submit,
	.off-canvas .woocommerce-product-search button[type="submit"],
	.off-canvas .wpb_widgetised_column .widget_price_filter .price_slider_amount
	{
		color: rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'offcanvas_text_color', '#545454' )) . ',0.55) !important;
	}

	.off-canvas.site-search input[type="search"],
	.off-canvas .menu-close,
	.off-canvas .mobile-navigation,
	.off-canvas .wpb_widgetised_column .widget
	{
		border-color: rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'offcanvas_text_color', '#545454' )) . ',0.1) !important;
	}

	.off-canvas.site-search input[type="search"]::-webkit-input-placeholder { color: rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'offcanvas_text_color', '#545454' )) . ',0.55) !important; }
	.off-canvas.site-search input[type="search"]::-moz-placeholder { color: rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'offcanvas_text_color', '#545454' )) . ',0.55) !important; }
	.off-canvas.site-search input[type="search"]:-ms-input-placeholder { color: rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'offcanvas_text_color', '#545454' )) . ',0.55) !important; }
	.off-canvas.site-search input[type="search"]:-moz-placeholder { color: rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'offcanvas_text_color', '#545454' )) . ',0.55) !important; }
';

if ( SHOPKEEPER_WOOCOMMERCE_GERMANIZED_IS_ACTIVE || SHOPKEEPER_GERMAN_MARKET_IS_ACTIVE ) {

	$custom_styles .= '
		.archive .products-grid li .product_german_market_info .woocommerce-de_price_taxrate span,
		.archive .products-grid li .product_german_market_info .woocommerce_de_versandkosten,
		.archive .products-grid li .product_german_market_info .price-per-unit,
		.archive .products-grid li .product_german_market_info .shipping_de.shipping_de_string,
		.germanized-active,
		.germanized-active p:not(.price),
		.germanized-active span,
		.germanized-active div,
		.german-market-active,
		.german-market-active p:not(.price),
		.german-market-active span,
		.german-market-active div,
		.german-market-info,
		.german-market-info p:not(.price),
		.german-market-info span,
		.german-market-info div,
		.products .wc-gzd-additional-info,
		.woocommerce-variation-price .woocommerce-de_price_taxrate,
		.woocommerce-variation-price .price-per-unit,
		.woocommerce-variation-price .woocommerce_de_versandkosten,
		.woocommerce-variation-price .shipping_de_string,
		.archive .products .delivery-time-info,
		.archive .products .shipping-costs-info,
		.wgm-info.woocommerce-de_price_taxrate
		{
			color: rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'body_color', '#545454' )) . ',0.55) !important;
		}

		span.wc-gzd-additional-info.shipping-costs-info,
		.product p.wc-gzd-additional-info
		{
			color: ' . esc_html(Shopkeeper_Opt::getOption( 'body_color', '#545454' )) . ';
		}

		.archive .woocommerce-de_price_taxrate,
		.archive .woocommerce_de_versandkosten,
		.archive .price-per-unit,
		.archive .wc-gzd-additional-info a,
		.products .product_after_shop_loop.germanized-active a:not(.button)
		{
			color: ' . Shopkeeper_Opt::getOption( 'headings_color', '#000000' ) . ';
		}
	';
}

if ( SHOPKEEPER_DOKAN_MULTIVENDOR_IS_ACTIVE ) {

	$custom_styles .= '
		body.dokan-dashboard .dokan-table .row-actions .edit a,
		body.dokan-dashboard .dokan-table .row-actions .view a,
		body.dokan-dashboard .dokan-table td p a,
		body.dokan-dashboard .dokan-product-listing .dokan-product-listing-area del .amount,
		body.dokan-dashboard .pagination li span.current,
		body.dokan-dashboard .pagination li span:hover,
		body.dokan-dashboard .pagination li a:hover,
		body.dokan-store .dokan-pagination li.active a,
		body.dokan-store .dokan-pagination li span:hover,
		body.dokan-store .dokan-pagination li a:hover,
		body.dokan-dashboard .btn.btn-default:hover,
		body.dokan-store .dokan-widget-area ul li a
		{
			color: ' . esc_html(Shopkeeper_Opt::getOption( 'body_color', '#545454' )) . ';
		}

		body.dokan-store .woocommerce-breadcrumb,
		body.dokan-store .woocommerce-breadcrumb a,
		body.dokan-store .woocommerce-breadcrumb span
		{
			color: rgba(' . shopkeeper_hex2rgb(Shopkeeper_Opt::getOption( 'body_color', '#545454' )) . ',0.55);
		}

		.dokan-dashboard .dokan-dash-sidebar
		{
			background-color: ' . Shopkeeper_Opt::getOption( 'headings_color', '#000000' ) . ';
		}

		body.dokan-store .woocommerce-breadcrumb a:hover
		{
			color: ' . Shopkeeper_Opt::getOption( 'main_color', '#EC7A5C' ) . ';
		}

		.dokan-btn.dokan-btn-theme:not(.dokan-add-new-product):not([name="dokan_update_payment_settings"]):not([name="dokan_update_product"]):not([name="dokan_update_store_settings"]):not([name="dokan_save_account_details"]):not(.vendor-dashboard),
		.dokan-dashboard .btn-theme.add_note,
		.dokan-dashboard .gravatar-button-area a,
		.dokan-btn.dokan-btn-sm.delete,
		.dokan-product-edit .upload_file_button
		{
			color: ' . Shopkeeper_Opt::getOption( 'main_color', '#EC7A5C' ) . '!important;
		}

		.dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li.active,
		.dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li:hover,
		.dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li.dokan-common-links a:hover,
		.dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li .tooltip .tooltip-inner
		{
			background: ' . Shopkeeper_Opt::getOption( 'main_color', '#EC7A5C' ) . '!important;
		}

		.dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li .tooltip .tooltip-arrow
		{
			border-top-color: ' . Shopkeeper_Opt::getOption( 'main_color', '#EC7A5C' ) . ';
		}

		body.dokan-dashboard .dokan-table ins
		{
			background-color: ' . Shopkeeper_Opt::getOption( 'main_color', '#EC7A5C' ) . '!important;
		}

		.dokan-btn.vendor-dashboard,
		.dokan-feat-image-btn,
		.dokan-btn.dokan-add-new-product,
		.dokan-btn.dokan-btn-info,
		.dokan-form-horizontal .dokan-form-group .dokan-w4 .dokan-btn-theme,
		.dokan-new-product-area .dokan-btn[name="add_product"],
		.dokan-product-edit .dokan-btn[name="dokan_update_product"],
		.dokan-btn.insert-file-row
		{
			background-color: ' . Shopkeeper_Opt::getOption( 'main_color', '#EC7A5C' ) . '!important;
		}

		.dokan-btn.dokan-btn-theme,
		.dokan-dashboard .gravatar-button-area a,
		.dokan-form-horizontal .dokan-form-group .dokan-w4 .dokan-btn-theme,
		.dokan-feat-image-btn
		{
			border-color: ' . Shopkeeper_Opt::getOption( 'main_color', '#EC7A5C' ) . ';
		}

		.dokan-single-store .dokan-store-tabs ul li a
		{
			color: ' . Shopkeeper_Opt::getOption( 'sticky_header_color', '#000' ) . ';
		}
	';

	if( (isset(Shopkeeper_Opt::getOption( 'main_background', array('background-color' => '#FFFFFF') )['background-color'])) ) {

		$custom_styles .= '
			.dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li a,
			.dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li a i
			{
				color: ' . Shopkeeper_Opt::getOption( 'main_background', array('background-color' => '#FFFFFF') )['background-color'] . '!important;
			}
		';
	}
}

?>
