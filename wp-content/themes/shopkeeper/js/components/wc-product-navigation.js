jQuery( function($) {

	'use strict';

	// Products Dot Navigation [ Product Version 2 & 3 ]

	var productImagesController = $('.product-images-controller');
	var productImages 			= $('.product-images-style-2 .product_images .product-image:not(.mobile), .product-images-style-3 .product_images .product-image:not(.mobile)');
	var navigationItems 		= $('.product-images-style-2 .product-images-controller li a span.dot, .product-images-style-3 .product-images-controller li a span.dot');
	var productImagesContainer 	= $('.product-images-wrapper');
	var headerHeight 			= $('.site-header.sticky').outerHeight();

	// set position of the product images controller layout 2

	if ( $('.product_layout_2').length > 0 ) {

		var controllerLayout2 	= $('.product_layout_2 .product-images-controller');
		controllerLayout2.css('top', productImagesContainer.offset().top);
	}


	$(window).on( 'scroll', function() {

		navigationItems.addClass('current');

		productImages.each(function() {

			var $this = $(this);

			var activeImage = $(' a[href="#'+$this.attr('id')+'"]').data('number');


			if ( $this.offset().top + $this.outerHeight()  <= productImagesController.offset().top - headerHeight )  {

			 	navigationItems.removeClass('current');

				navigationItems.eq(activeImage).addClass('current');

			} else {
				navigationItems.eq(activeImage).removeClass('current');
			}

		});

		// set youtube vide icon current

		var youtubeVideo = $('.product_layout_2 .fluid-width-video-wrapper, .product_layout_3 .fluid-width-video-wrapper');

		if ( youtubeVideo.length > 0 ) {

			if ( youtubeVideo.offset().top  <= productImagesController.offset().top - headerHeight ) {
				$('li.video-icon span.dot').addClass('current');
			} else {
				$('.product-images-controller .video-icon .dot').removeClass('current');
			}

			if ( youtubeVideo.offset().top + youtubeVideo.outerHeight()  <= productImagesController.offset().top ) {

				$('.product-images-controller .video-icon .dot').removeClass('current');
			}

		}

	});


	// navigationItem smooth scroll
	if ( $('.single-product').length > 0 ) {

		$('a[href*="#controller-navigation-image"]:not([href="#"])').on( 'click', function() {

			if ( location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname ) {
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) +']');

				// if wordpress admin bar exists take care of that
				var adminBarHeight = 0;
				if ( $('body').hasClass('admin-bar') ) {
					var adminBarHeight = 32;
				}

				if (target.length) {
					$('html, body').animate({
					  scrollTop: target.offset().top - $('.site-header.sticky').outerHeight() - adminBarHeight
					}, 500);
				return false;
				}
			}

		});

	}

	// Video Autoplay on click
	if ( $('.product-image.video .fluid-width-video-wrapper iframe')) {

		$('.product_layout_2 .product-images-controller .video-icon > a, .product_layout_3 .product-images-controller .video-icon > a').on('click', function(e) {
			$('.product-image.video .fluid-width-video-wrapper iframe')[0].src += "&autoplay=1";
	    	e.preventDefault();
		});

	}				
 });
