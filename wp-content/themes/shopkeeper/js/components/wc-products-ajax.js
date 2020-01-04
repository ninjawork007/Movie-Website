jQuery(function($) {

	"use strict";

	var getbowtied_ajax_load = {

	    init: function() {

	        if (getbowtied_scripts_vars.shop_pagination_type == 'load_more_button' || getbowtied_scripts_vars.shop_pagination_type == 'infinite_scroll') {

		        $( function() {

		            if ($('.woocommerce-pagination').length && $('body').hasClass('archive')) {

		                $('.woocommerce-pagination').before('<div class="getbowtied_ajax_load_button"><a getbowtied_ajax_load_more_processing="0">'+getbowtied_scripts_vars.ajax_load_more_locale+'</a></div>');

		                if (getbowtied_scripts_vars.shop_pagination_type == 'infinite_scroll') {
		                    $('.getbowtied_ajax_load_button').addClass('getbowtied_ajax_load_more_hidden');
		                }

		                if ($('.woocommerce-pagination a.next').length == 0) {
	                        $('.getbowtied_ajax_load_button').addClass('getbowtied_ajax_load_more_hidden');
	                    }


		            	$('.woocommerce-pagination').hide();

		            }

		        });

		        $('body').on('click', '.getbowtied_ajax_load_button a', function(e) {

		            e.preventDefault();

		            if ($('.woocommerce-pagination a.next').length) {

		                $('.getbowtied_ajax_load_button a').attr('getbowtied_ajax_load_more_processing', 1);
		                var href = $('.woocommerce-pagination a.next').attr('href');

		                /*if(!getbowtied_ajax_load.msieversion()) {
							history.pushState(null, null, href);
						}*/

		                getbowtied_ajax_load.onstart();

		                $('.getbowtied_ajax_load_button').fadeOut(200, function(){
			                $('.woocommerce-pagination').before('<div class="getbowtied_ajax_load_more_loader"><span>'+getbowtied_scripts_vars.ajax_loading_locale+'</span></div>');
		                });


		                $.get(href, function(response) {

		                	/*if(!getbowtied_ajax_load.msieversion()) {
								document.title = $(response).filter('title').html();
							}*/

		                    $('.woocommerce-pagination').html($(response).find('.woocommerce-pagination').html());

		                    var i= 0;

		                    $(response).find('.content-area ul.products li').each(function() {

		                        // $(this).addClass('hidden');
		                        i++;
		                        $(this).find(".product_thumbnail.with_second_image").css("background-size", "cover");
								$(this).find(".product_thumbnail.with_second_image").addClass("second_image_loaded");
								$(this).addClass("ajax-loaded delay-"+i);
		                        $('.content-area ul.products li:last').after($(this));

		                    });

		                    $('.getbowtied_ajax_load_more_loader').fadeOut(200, function(){
			                    $('.getbowtied_ajax_load_button').fadeIn(200);
    		                    $('.getbowtied_ajax_load_button a').attr('getbowtied_ajax_load_more_processing', 0);
		                    });

		                    $('.getbowtied_ajax_load_more_loader').remove();

		                    getbowtied_ajax_load.onfinish();

		                    setTimeout(function(){

		                    	$('.content-area ul.products li.hidden').removeClass('hidden').addClass('animate');
		                    }, 500);

		                    if ($('.woocommerce-pagination a.next').length == 0) {
		                        $('.getbowtied_ajax_load_button').addClass('finished').removeClass('getbowtied_ajax_load_more_hidden');
		                        $('.getbowtied_ajax_load_button a').show().html(getbowtied_scripts_vars.ajax_no_more_items_locale).addClass('disabled');
		                    }

		                });

		            } else {

		                $('.getbowtied_ajax_load_button').addClass('finished').removeClass('getbowtied_ajax_load_more_hidden');
		                $('.getbowtied_ajax_load_button a').show().html(getbowtied_scripts_vars.ajax_no_more_items_locale).addClass('disabled');

		            }

		        });

	        }

	        if (getbowtied_scripts_vars.shop_pagination_type == 'infinite_scroll') {

		        var buffer_pixels = Math.abs(0);

		        $(window).on( 'scroll', function() {

		            if ($('.content-area ul.products').length) {

		                var a = $('.content-area ul.products').offset().top + $('.content-area ul.products').outerHeight();
		                var b = a - $(window).scrollTop();

		                if ((b - buffer_pixels) < $(window).height()) {
		                    if ($('.getbowtied_ajax_load_button a').attr('getbowtied_ajax_load_more_processing') == 0) {
		                        $('.getbowtied_ajax_load_button a').trigger('click');
		                    }
		                }

		            }

		        });

	        }
	    },

	    onstart: function() {
	    },

	    onfinish: function() {
            // window.shop_sidebar();
	    },
	};

	getbowtied_ajax_load.init();
	getbowtied_ajax_load.onfinish();
});
