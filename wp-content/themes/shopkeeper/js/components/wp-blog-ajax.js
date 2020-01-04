jQuery(function($) {

	"use strict";

	var loader = {

		init: function()
		{
			$(window).on( 'load', function() {
	    		$('#masonry_grid').addClass('fade-in');
	    	})
		}
	}

	var getbowtied_blog_ajax_load = {

	    init: function() {

	        if (getbowtied_scripts_vars.pagination_blog == 'load_more_button' || getbowtied_scripts_vars.pagination_blog == 'infinite_scroll') {

		        $( function() {

		            if ($('.posts-navigation').length) {

		                $('.posts-navigation').before('<div class="getbowtied_blog_ajax_load_button"><a getbowtied_blog_ajax_load_more_processing="0">'+getbowtied_scripts_vars.ajax_load_more_locale+'</a></div>');

		                if (getbowtied_scripts_vars.pagination_blog == 'infinite_scroll') {
		                    $('.getbowtied_blog_ajax_load_button').addClass('getbowtied_blog_ajax_load_more_hidden');
		                }

		                if ($('.posts-navigation a.next').length == 0) {
	                        $('.getbowtied_blog_ajax_load_button').addClass('getbowtied_blog_ajax_load_more_hidden');
	                    }

		            }

		            $('.posts-navigation').hide();
	            	$('.blog-posts > .blog-post').addClass('getbowtied_blog_ajax_load_more_item_visible');

		        });

		        $('body').on('click', '.getbowtied_blog_ajax_load_button a', function(e) {

		            e.preventDefault();

		            if ($('.posts-navigation a.next').length) {

		                $('.getbowtied_blog_ajax_load_button a').attr('getbowtied_blog_ajax_load_more_processing', 1);
		                var href = $('.posts-navigation a.next').attr('href');

		                getbowtied_blog_ajax_load.onstart();

		                $('.getbowtied_blog_ajax_load_button').fadeOut(200, function(){
		                	$('.posts-navigation').before('<div class="getbowtied_blog_ajax_load_more_loader"><span>'+getbowtied_scripts_vars.ajax_loading_locale+'</span></div>');
		                });


		                $.get(href, function(response) {

		                    $('.posts-navigation').html($(response).find('.posts-navigation').html());

		                    var i= 0;

		                    $(response).find('.blog-posts > .blog-post').each(function() {

		                         if ( getbowtied_scripts_vars.layout_blog == "layout-1" ) {
		                         	i++;
		                         	$(this).addClass('loaded delay-'+i);

		                        	var grid = document.querySelector('#masonry_grid');
									var item = document.createElement('li');


									salvattore.appendElements(grid, [item]);
									item.outerHTML = $(this).prop('outerHTML');




		                         } else {

		                         	i++;
		                         	$(this).addClass('loaded delay-'+i);

		                        	$('.blog-posts > .blog-post:last').after($(this));

		                         }

		                    });


		                    $('.getbowtied_blog_ajax_load_more_loader').fadeOut(200, function(){
		                    	$(this).remove();
			                    $('.getbowtied_blog_ajax_load_button').show();
		                    	$('.getbowtied_blog_ajax_load_button a').attr('getbowtied_blog_ajax_load_more_processing', 0);
		                    });

		                    getbowtied_blog_ajax_load.onfinish();

		                    if ($('.posts-navigation a.next').length == 0) {
		                        $('.getbowtied_blog_ajax_load_button').addClass('finished').removeClass('getbowtied_blog_ajax_load_more_hidden');
		                        $('.getbowtied_blog_ajax_load_button a').show().html(getbowtied_scripts_vars.ajax_no_more_items_locale).addClass('disabled');
		                    }

		                });

		            } else {

		                $('.getbowtied_blog_ajax_load_button').addClass('finished').removeClass('getbowtied_blog_ajax_load_more_hidden');
		                $('.getbowtied_blog_ajax_load_button a').show().html(getbowtied_scripts_vars.ajax_no_more_items_locale).addClass('disabled');

		            }

		        });

	        }

	        if (getbowtied_scripts_vars.pagination_blog == 'infinite_scroll') {

		        var buffer_pixels = Math.abs(0);

		        $(window).on( 'scroll', function() {

		            if ($('.blog-posts').length) {

		                var a = $('.blog-posts').offset().top + $('.blog-posts').outerHeight();
		                var b = a - $(window).scrollTop();

		                if ((b - buffer_pixels) < $(window).height()) {
		                    if ($('.getbowtied_blog_ajax_load_button a').attr('getbowtied_blog_ajax_load_more_processing') == 0) {
		                        $('.getbowtied_blog_ajax_load_button a').trigger('click');
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

	loader.init();

	if (!$('body').hasClass('search'))
	{
		getbowtied_blog_ajax_load.init();
		getbowtied_blog_ajax_load.onfinish();
	}
});
