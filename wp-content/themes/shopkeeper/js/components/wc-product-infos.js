jQuery( function($) {

	'use strict';

	// Stops Products_infos at Footer
	
	setTimeout(function(){
		if($(".single-product .product .product_infos .cart .StripeElement").children().length > 0) {
			$(".single-product .product .product_infos .cart").addClass("stripe-button");
		}
	},1000);

	if ( ($('.product_layout_2').length > 0) || ($('.product_layout_3').length > 0) || ($('.product_layout_4').length > 0) ) {

		// if product description is too long
		var productInfosHeight 			= $('.product .product_content_wrapper .product_infos').outerHeight();
		var productInfosPos	   			= $('.product .product_content_wrapper .product_infos').position().top;
		var productInfosWidth  			= $('.product .product_content_wrapper .product_infos').outerWidth();
		var productContentWrapperOff 	= $('.product_content_wrapper').offset().top;

		if (  (productInfosHeight >  $(window).innerHeight() - productContentWrapperOff) && ($(window).width() >= 1024) ) {
			$('.product_infos').addClass('long-description'); // product description is longer than actual viewport
		} else {
			$('.product_infos').css({ top: productContentWrapperOff });
		}

		// if product_infos is at at footer, stop it.
		$(window).on( 'scroll', function() {

		    var windowTop = $(window).scrollTop();
		    var footerTop = $("#site-footer").offset().top;
		    var productInfosOff = $('.product_infos.fixed').offset().top;
		    var productInfosH = $(".product_infos.fixed").height();
		    var padding = 40;  // let a distance between the product_infos and the footer
		    var footer = $("#site-footer");

		    if (windowTop + productInfosH + 200 > footerTop - padding ) {

		        $('.product_infos.fixed:not(.long-description)').css({
		        	top: (windowTop + productInfosH - footerTop + padding) * -1
		        });

		    } else {
		    	$('.product_infos.fixed:not(.long-description)').css({
		        	top 		:  productContentWrapperOff
		        });
		    }

		});

	}

	// only for product layout 3
	function product_layout_3() {

		if ( $('.product_layout_3').length > 0 ) {

			var productImagesWrapperWidth = $('.product_layout_3 .product-images-wrapper').width();
			var productImagesWrapper = $('.product_layout_3 .product-images-wrapper');
			var productTitle = $('.product_layout_3 .product_title');
			var widthPercent = $('.product_layout_3 .product-images-wrapper').width() / $(window).width() * 100;

			// set product title width 100% for mobile and tablet
			productTitle.css({
				width: $(window).width(),
				left : 'auto'
			 });

			if ( $(window).width() >= 1024 ) {

				// set position of the product title to be equal with the product images offset left
				productTitle.css({
					left	: $('.product_layout_3 .product-images-controller').offset().left
				});

				// add class for desktop for product title
				productTitle.addClass('for-desktop');
				// set product title width to be 75% of the product images wrapper width
				productTitle.css({ width: widthPercent * 0.75 + '%'});

				// set position of the product images controller layout 3
				var controllerLayout3 	= $('.product_layout_3 .product-images-controller');
				var productBadges 		= $('.product_layout_3 .product-badges');
				var productTitleHeight 	= productTitle.outerHeight();
				controllerLayout3.css('top', productImagesWrapper.offset().top + productTitleHeight + 40);
				productBadges.css('top', productTitleHeight + 40);
			} else {
				productTitle.removeClass('for-desktop');
			}
		}
	}

	product_layout_3();

	$(window).on( 'resize', function() {
		product_layout_3();
	});
});
