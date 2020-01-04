jQuery(function($) {
	
	"use strict";

	$('.shortcode_getbowtied_slider').each(function() {

		var autoplay = $(this).attr('data-autoplay');
		if ($.isNumeric(autoplay)) {
			autoplay = autoplay * 1000;
		} else {
			autoplay = 10000;
		}

		var mySwiper = new Swiper ($(this), {
			
			// Optional parameters
		    direction: 'horizontal',
		    loop: true,
		    grabCursor: true,
			preventClicks: true,
			preventClicksPropagation: true,
			autoplay: {
			    delay: autoplay,
		  	},
			speed: 600,
			effect: 'slide',
			parallax: true,
		    // Pagination
		    pagination: {
			    el: $(this).find('.shortcode-slider-pagination'),
			    type: 'bullets',
			    clickable: true
			},
		    // Navigation
		    navigation: {
			    nextEl: '.swiper-button-next',
			    prevEl: '.swiper-button-prev',
			},
		});

	});
});
