jQuery( function ($) {

	"use strict";

	var window_width = $(window).innerWidth();

	//submenu adjustments
	function submenu_adjustments() {
		$(".main-navigation > ul > .menu-item").on( 'mouseenter', function() {
			if ( $(this).children(".sub-menu").length > 0 ) {
				var submenu = $(this).children(".sub-menu");
				var window_width = parseInt($(window).outerWidth());
				var submenu_width = parseInt(submenu.outerWidth());
				var submenu_offset_left = parseInt(submenu.offset().left);
				var submenu_adjust = window_width - submenu_width - submenu_offset_left;

				if (submenu_adjust < 0) {
					submenu.css("left", submenu_adjust-30 + "px");
				}
			}
		});
	}

	submenu_adjustments();

	//woocommerce tabs
	$('.woocommerce-tabs .panel:first-child').addClass('current');
	$('.woocommerce-tabs ul.tabs li a').off('click').on('click', function(){
		var that = $(this);
		var currentPanel = that.attr('href');

		that.parent().siblings().removeClass('active')
					.end()
					.addClass('active');

		$('.woocommerce-tabs').find(currentPanel).siblings('.panel').filter(':visible').fadeOut(500,function(){
			$('.woocommerce-tabs').find(currentPanel).siblings('.panel').removeClass('current');
			$('.woocommerce-tabs').find(currentPanel).addClass('current').fadeIn(500);
		})

		return false;
	})

	// close search offcanvas
	$(document).on('click', '.site-search .close-button', function(){
		$(document).find('#offCanvasTop1').removeAttr("style");
	});

    //product animation (thanks Sam Sehnert)

    $.fn.visible = function(partial) {

      var $t            = $(this),
          $w            = $(window),
          viewTop       = $w.scrollTop(),
          viewBottom    = viewTop + $w.height(),
          _top          = $t.offset().top,
          _bottom       = _top + $t.height(),
          compareTop    = partial === true ? _bottom : _top,
          compareBottom = partial === true ? _top : _bottom;

    return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

    };


    //if is visible on screen add a class
    $("section.related").each(function(i, el) {
        if ($(el).visible(true)) {
            $(el).addClass("on_screen");
        }
    });

	$(".nano").nanoScroller();

	//mobile menu
	$(".mobile-navigation .menu-item-has-children .sub-menu").before('<div class="more"><span class="spk-icon-down-small"></span></div>');

	$(".mobile-navigation").on("click", ".more", function(e) {
		e.stopPropagation();

		var submenus = $(this).parent().find(".sub-menu");
		$.each(submenus, function(x,y){
			$(y).find(".sub-menu").addClass("open");
			$(y).find(".more").remove();
		});

		$(this).parent().toggleClass("current")
						.children(".sub-menu").toggleClass("open");

		$(this).parent().find('.more').html($(this).parent().find('.more').html() == '<span class="spk-icon-down-small"></span>' ? '<span class="spk-icon-up-small"></span>' : '<span class="spk-icon-down-small"></span>');
		$(".nano").nanoScroller();
	});

	$(".mobile-navigation").on("click", "a", function(e) {
		if($(this).attr('href') == '#' && $(this).parent('.menu-item').hasClass('menu-item-has-children')) {
			$(this).parent().find('.more').trigger('click');
		} else if($(this).attr('href').indexOf('#') > -1) {
			$('#offCanvasRight1').foundation('close');
		}
	});

	function replace_img_source(selector) {
		var data_src = $(selector).attr('data-src');
		$(selector).one('load', function() {
		}).each(function() {
			$(selector).attr('src', data_src);
			$(selector).css("opacity", "1");
		});
	}

	$('#products-grid li img').each(function(){
		replace_img_source(this);
	});

	$('.related.products li img').each(function(){
		replace_img_source(this);
	});

	$('.upsells.products li img').each(function(){
		replace_img_source(this);
	});

	$('.add_to_cart_button').on('click',function(){
		$(this).parents('li.animate').addClass('product_added_to_cart')
	})


	//scroll on reviews tab
	$('.woocommerce-review-link').off('click').on('click',function(){

		$('.tabs li a').each(function(){
			if ($(this).attr('href')=='#tab-reviews') {
				$(this).trigger('click');
			}
		});

		var elem_on_screen_height = 0;

		if ( $('body').hasClass('admin-bar') ) {
			elem_on_screen_height += 32;
		}

		if ( $('.getbowtied_theme_explorer_wrapper').length > 0 && $('.getbowtied_theme_explorer_wrapper').is('visible') ) {
			elem_on_screen_height += $('.getbowtied_theme_explorer_wrapper').outerHeight();
		}

		var tab_reviews_topPos = $('.woocommerce-tabs').offset().top - elem_on_screen_height;

		$('html, body').animate({
            scrollTop: tab_reviews_topPos
        }, 1000);

		return false;
	})


	$('.add_to_wishlist').on('click',function(){
		$(this).parents('.yith-wcwl-add-button').addClass('show_overlay');
	})

	// Login/register
	var account_tab_list = $('.account-tab-list');

	account_tab_list.on('click','.account-tab-link',function(){

		if ( $('.account-tab-link').hasClass('registration_disabled') ) {
			return false;
		} else {

			var that = $(this),
				target = that.attr('href');

			that.parent().siblings().find('.account-tab-link').removeClass('current');
			that.addClass('current');

			$('.account-forms').find($(target)).siblings().stop().fadeOut(function(){
				$('.account-forms').find($(target)).fadeIn();
			});

			//$(target).siblings().stop().fadeOut(function(){
			//	$(target).fadeIn();
			//});

			return false;
		}
	});

	// Login/register mobile
	$('.account-tab-link-register').on('click',function(){
		$('.login-form').stop().fadeOut(function(){
			$('.register-form').fadeIn();
		})
		return false;
	})

	$('.account-tab-link-login').on('click',function(){
		$('.register-form').stop().fadeOut(function(){
			$('.login-form').fadeIn();
		})
		return false;
	})

    // Disable fresco
    function disable_fresco() {

		if ( getbowtied_scripts_vars.product_lightbox != 1 ) {

			$(".product-images-layout .fresco, .product-images-layout-mobile .fresco, .woocommerce-product-gallery__wrapper .fresco").on('click',function() {
				return false;
			});
		}
	}

    disable_fresco();


	//add fresco groups to images galleries
	$(".gallery").each(function() {

		var that = $(this);

		that.find('.gallery-item').each(function(){

			var this_gallery_item = $(this);

			this_gallery_item.find('.fresco').attr('data-fresco-group', that.attr('id'));

			if ( this_gallery_item.find('.gallery-caption').length > 0 ) {
				this_gallery_item.find('.fresco').attr('data-fresco-caption', this_gallery_item.find('.gallery-caption').text());
			}

		});

	});

	function handleSelect() {
		if ($(window).innerWidth() > 1023 ) {

			var select2 = $(".orderby, .big-select").select2({
				//placeholder: "Select a State",
				allowClear: true,
				minimumResultsForSearch: Infinity
			});

		}
	}

	handleSelect();


	//gallery caption

	$('.gallery-item').each(function(){

		var that = $(this);

		if ( that.find('.gallery-caption').length > 0 ) {
			that.append('<span class="gallery-caption-trigger">i</span>')
		}

	})

	$('.gallery-caption-trigger').on('mouseenter',function(){
		$(this).siblings('.gallery-caption').addClass('show');
	});

	$('.gallery-caption-trigger').on('mouseleave',function(){
		$(this).siblings('.gallery-caption').removeClass('show');
	});

	$('.trigger-footer-widget').on('click', function(){

		var trigger = $(this).parent();

		trigger.fadeOut('1000',function(){
			trigger.remove();
			$('.site-footer-widget-area').fadeIn();
		});
	});

	//Language Switcher
	$('.topbar-language-switcher').on( 'change', function(){
		window.location = $(this).val();
	});

	$(window).on( 'load', function() {

        setTimeout(function() {
            $(".product_thumbnail.with_second_image").css("background-size", "cover");
			$(".product_thumbnail.with_second_image").addClass("second_image_loaded");
        }, 300);

        if ($(window).outerWidth() > 1024) {
			$.stellar({
				horizontalScrolling: false,
                responsive: true
			});
		}

		setTimeout(function(){
			$('.parallax, .single-post-header-bkg').addClass('loaded');
		},150)

	});

	$(window).on( 'resize', function(){

        $('.site-search-form-wrapper-inner, .site-search .widget_search .search-form').css('margin-left',-$(window).width()/4);

		$(".main-navigation > ul > .menu-item > .sub-menu").css("left", "-15px");

	});

    $(window).on( 'scroll', function() {

		//animate products
        if ($(window).innerWidth() > 640 ) {
			$(".products li").each(function(i, el) {
				if ($(el).visible(true)) {
					$(el).addClass("animate");
				}
			});
		}

        //mark this selector as visible
        $("section.related, #site-footer").each(function(i, el) {
            if ($(el).visible(true)) {
                $(el).addClass("on_screen");

            } else {
                $(el).removeClass("on_screen");

            }
        });

		//single post overlay -  only for large-up
		if ( $(window).width() > 1024 ) {
			$('.single-post-header-overlay').css('opacity', 0.3 + ($(window).scrollTop()) / (($(window).height())*1.4) );
		}

    });

	$('.widget_layered_nav span.count, .widget_product_categories span.count').each(function(){
		var count = $(this).html();
		count = count.substring(1, count.length-1);
		$(this).html(count);
	})

	/******************** average rating widget ****************************/
	$('.widget_rating_filter ul li a').each(function(){
		var count = $(this).contents().filter(function(){
		  return this.nodeType == 3;
		})[0].nodeValue;

		$(this).contents().filter(function(){
		  return this.nodeType == 3;
		})[0].nodeValue = '';

		count = count.slice(2,-1);

		$(this).append('<span class="count">' + count + '</span>');
	})

	/********************** my account tabs by url **************************/
	if ( ('form#register').length > 0 )
	{
		var hash = window.location.hash;
		if (hash)
		{
			$('.account-tab-link').removeClass('current');
			$('a[href="'+hash+'"]').addClass('current');

			hash = hash.substring(1);
			$('.account-forms > form').hide();
			$('form#'+hash).show();
		}
	}


	/************************************************************************/
	/****************************** BACK TO TOP *****************************/
	/************************************************************************/

	var offset = 300,
	//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
	offset_opacity = 1200,
	//duration of the top scrolling animation (in ms)
	scroll_top_duration = 700,
	//grab the "back to top" link
	$back_to_top = $('.cd-top');

	//hide or show the "back to top" link
	$(window).on( 'scroll', function(){
		( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
		if( $(this).scrollTop() > offset_opacity ) {
			$back_to_top.addClass('cd-fade-out');
		}
	});

	//smooth scroll to top
	$back_to_top.on('click', function(event){
		event.preventDefault();
		$('body,html').animate({
			scrollTop: 0 ,
		 	}, scroll_top_duration
		);
	});

	// browser window scroll (in pixels) after which the "back to top" link is shown
	var offset = 300,
		//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
		offset_opacity = 1200,
		//duration of the top scrolling animation (in ms)
		scroll_top_duration = 700,
		//grab the "back to top" link
		$back_to_top = $('.cd-top');

	//hide or show the "back to top" link
	$(window).on( 'scroll', function(){
		( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
		if( $(this).scrollTop() > offset_opacity ) {
			$back_to_top.addClass('cd-fade-out');
		}
	});

	//smooth scroll to top
	$back_to_top.on('click', function(event){
		event.preventDefault();
		$('body,html').animate({
			scrollTop: 0 ,
		 	}, scroll_top_duration
		);
	});

	function bs_fix_vc_full_width_row() {

        var elements = $('[data-vc-full-width="true"]');
        $.each(elements, function () {
            var el = jQuery(this);
            el.css('right', el.css('left')).css('left', '');
        });

    }

	// Fixes rows in RTL
    if( $('body').hasClass("rtl") ) {
        $(document).on('vc-full-width-row', function () {
            bs_fix_vc_full_width_row();
        });
    }

    // Run one time because it was not firing in Mac/Firefox and Windows/Edge some times
    if ($('body').hasClass("rtl")) {
        bs_fix_vc_full_width_row();
    }

	// Checkout Form Submit Arrow at Focus

	$(document).on('focus', '.woocommerce-cart #content table.cart td.actions .coupon #coupon_code', function() {
		$('.woocommerce-cart #content table.cart td.actions .coupon').addClass('focus');
	});

	$(document).on('focusout', '.woocommerce-cart #content table.cart td.actions .coupon #coupon_code', function() {
		$('.woocommerce-cart #content table.cart td.actions .coupon').removeClass('focus');
	});

	$(document).on('focus', 'form.checkout_coupon #coupon_code', function() {
		$('form.checkout_coupon .checkout_coupon_inner').addClass('focus');
	});

	$(document).on('focusout', 'form.checkout_coupon #coupon_code', function() {
		$('form.checkout_coupon .checkout_coupon_inner').removeClass('focus');
	});

	// Checkout expand forms
	$('.woocommerce-checkout').on('click', '.showlogin', function() {
		$('form.woocommerce-form-login').toggleClass('fade');
	});

	$('.woocommerce-checkout').on('click', '.showcoupon, .checkout_coupon_inner .button', function() {
		$('form.woocommerce-form-coupon').toggleClass('fade');
	});

	$(window).on( 'load', function() {
		$(".vc_images_carousel").each(function() {
			var height = $(this).find(".vc_item.vc_active").height();
			$(this).css("height", height);
		});
	});

	$(".vc_images_carousel").on('click', '.vc_right, .vc_left, .vc_carousel-indicators li', function(){

		var that = $(this);

		setTimeout(function(){
			var height = that.parents(".vc_images_carousel").find(".vc_item.vc_active").height();
			that.parents(".vc_images_carousel").css("height", height);
		}, 600);


	});

	// set focus on search input field in off-canvas
	$(document).on('click touchend', 'header .site-tools .search-button .spk-icon-search', function(){
		setTimeout( function(){
			$(".off-canvas .woocommerce-product-search .search-field").focus();
		}, 800);
	});

	// close off-canvas when 'ESC' is pressed
	$(document).on( 'keyup', function(event){
		//check if user has pressed 'Esc'
    	if( ( event.which=='27' ) && ( $('.off-canvas').length ) && ( $('.off-canvas').hasClass('is-open') ) ) {
    		$('.off-canvas').foundation('close');
		}
	});

	// When Viewport Height is equal with 768, make the minicart image smaller
	var windowHeight 		 = $(window).height();
	var minicart_product_img = $('.shopkeeper-mini-cart .widget.woocommerce.widget_shopping_cart .widget_shopping_cart_content .cart_list.product_list_widget li.mini_cart_item .product-item-bg');

	if ( windowHeight == 768) {
		minicart_product_img.addClass('smaller-vh');
	} else {
		minicart_product_img.removeClass('smaller-vh');
	}

	// If both facebook messenger and get this theme plugins exists, make them look nice
	if ( $('#fbmsg').length ) {

		if ( $('.getbowtied_get_this_theme').length ) {
			$('#fbmsg').addClass('gbt_plugin_installed');
		} else {
			$('#fbmsg').removeClass('gbt_plugin_installed');
		}
	}

	$("body.single-product form.cart").on("change", "input.qty, input.custom-qty", function() {
        $('button.single_add_to_cart_button.ajax_add_to_cart').data("quantity", this.value);
    });

	$('.cd-quick-view form.cart input[name="quantity"]').trigger('change');

	// overlay for loader on ajax add to cart and wishlist
	$('body').on("click", ".products .ajax_add_to_cart", function() {
		$(this).parents('.column').find('.product_thumbnail').prepend('<div class="overlay"></div>');
	});
	$('body').on('added_to_cart', function(){
		$('.product_thumbnail .overlay').remove();
	});

	//progress add to cart button
	$("button.single_add_to_cart_button.ajax_add_to_cart.progress-btn").on("click", function(e) {
		var progressBtn = $(this);

		if (!progressBtn.hasClass("active")) {
		  progressBtn.addClass("active");
		  setTimeout(function() {
		  	progressBtn.addClass("check");
		  }, 1500);
		  setTimeout(function() {
		  	progressBtn.removeClass("active");
		  	progressBtn.removeClass("check");
		  }, 3500);
		}
	});

	$(document).foundation();
});
