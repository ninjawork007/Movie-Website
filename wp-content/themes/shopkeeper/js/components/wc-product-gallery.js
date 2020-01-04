jQuery( function($) {

	"use strict";

	var classes = $(".custom-layout .mobile_gallery .woocommerce-product-gallery").attr("class");
	var ol_classes = $(".custom-layout .mobile_gallery .flex-control-thumbs").attr("class");

	$(window).on('resize', function() {
		if ($(window).width() < 1024) {
			$(".custom-layout .mobile_gallery > div").addClass(classes);
			$(".custom-layout .mobile_gallery ol").addClass(ol_classes);
		} else {
			$(".custom-layout .mobile_gallery .woocommerce-product-gallery").removeClass(classes);
			$(".custom-layout .mobile_gallery .flex-control-thumbs").removeClass(ol_classes);
		}
	});

	$(window).on( 'load', function() {

		if ($(window).width() > 1024) {
			$(".custom-layout .mobile_gallery .woocommerce-product-gallery").removeClass(classes);
			$(".custom-layout .mobile_gallery .flex-control-thumbs").removeClass(ol_classes);
		}

	});

	// Add fresco to default gallery
	if ( getbowtied_scripts_vars.product_lightbox == 1 ) {
		$( ".product_layout_classic .woocommerce-product-gallery__wrapper .woocommerce-product-gallery__image" ).each(function() {

			var that = $(this);

			$(this).attr('id', 'product-gallery');

		  	$(this).find('a').addClass('fresco');

			$(this).find('.fresco').attr('data-fresco-group', that.attr('id'));
			$(this).find('.fresco').attr('data-fresco-group-options', "overflow: true, thumbnails: 'vertical', onClick: 'close'");

			if( ! $(this).find('.fresco').hasClass('video') ) {
				if ( $(this).find('.fresco img').attr('data-caption').length > 0 ) {
					$(this).find('.fresco').attr('data-fresco-caption', $(this).find('.fresco img').attr('data-caption'));
				}
			}

		});
	}

	// Trigger fresco lightbox
	$('.easyzoom').on('click', '.easyzoom-flyout', function(){
		if ($(window).width() > 640) {
			$(this).siblings('.fresco.zoom').trigger('click');
		}
	});

	$('.product_layout_classic').on('click', '.zoomImg', function(){
		if ($(window).width() > 640) {
			$(this).siblings('.fresco').trigger('click');
		}
	});

	$('.woocommerce-product-gallery__image a').on('click', function(e){
		if ( getbowtied_scripts_vars.product_gallery_zoom != 1 ) {
			if ($(window).width() < 640) {
				e.stopPropagation();
	    		e.preventDefault();
			}
		}
	});

	$('.product_layout_classic').on('click', '.woocommerce-product-gallery__image.flex-active-slide a', function(e){
		if ( getbowtied_scripts_vars.product_lightbox != 1 && getbowtied_scripts_vars.product_gallery_zoom != 1 ) {
			e.stopPropagation();
    		e.preventDefault();
		} else {
			if ($(window).width() < 640) {
				e.stopPropagation();
	    		e.preventDefault();
			}
		}
	});

	$('.product_layout_classic').on('click', '.woocommerce-product-gallery__image.flex-active-slide a', function(e){
		if ( getbowtied_scripts_vars.product_lightbox != 1 ) {
			e.stopPropagation();
    		e.preventDefault();
		}
	});

	$('.product_layout_classic ').on('hover', '.woocommerce-product-gallery__image.flex-active-slide a', function(e){
		if ( getbowtied_scripts_vars.product_lightbox != 1 ) {
			$(this).css('cursor', 'default');
		}
	});

	// Scroll thumbnails - default gallery
	$(document).on('click touchend', '.product_layout_classic ol.flex-control-thumbs li img', function() {
		if ($(window).width() > 640) {
			activate_slide();
		}
	});

	function activate_slide() {

		var product_thumbnails 				= $('ol.flex-control-thumbs');
		var product_thumbnails_cells 		= product_thumbnails.find('li');
		var product_thumbnails_height 		= product_thumbnails.height();
		var product_thumbnails_cells_height	= product_thumbnails_cells.outerHeight();
		var product_images					= $('.woocommerce-product-gallery__wrapper');
		var index 							= $('.woocommerce-product-gallery__wrapper .woocommerce-product-gallery__image.flex-active-slide').index();

		var scrollY = (index * product_thumbnails_cells_height) - ( (product_thumbnails_height - product_thumbnails_cells_height) / 2) - 10;

		product_thumbnails.animate({
			scrollTop: scrollY
		}, 300);
	}

	// If both product gallery zoom & product gallery lightbox are disabled, make cursor default
	if ( getbowtied_scripts_vars.product_lightbox != 1 && getbowtied_scripts_vars.product_gallery_zoom != 1 ) {
		$('.product_layout_classic .woocommerce-product-gallery__wrapper .woocommerce-product-gallery__image a').css({'cursor' :'default'});
		$('.product_layout_2 .product-images-wrapper .product-image a img').css({'cursor' :'default'});
		$('.product_layout_3 .product-images-wrapper .product-image a img').css({'cursor' :'default'});
		$('.product_layout_4 .product-images-wrapper .product-image a img').css({'cursor' :'default'});
	}

	if ( getbowtied_scripts_vars.product_lightbox == 1 && getbowtied_scripts_vars.product_gallery_zoom != 1 ) {
		$('.product_layout_4 .product-images-wrapper .product-image a img').css({'cursor' :'pointer'});
	}

});
