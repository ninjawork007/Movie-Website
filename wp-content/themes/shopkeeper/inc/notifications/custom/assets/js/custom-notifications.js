(function( $ ) {

	'use strict';

	function gbt_cn_onElementInserted(containerSelector, selector, childSelector, callback) {
		if ("MutationObserver" in window) {
			var onMutationsObserved = function (mutations) {
				mutations.forEach(function (mutation) {
					if (mutation.addedNodes.length) {
						if ($(mutation.addedNodes).length) {
							var finalSelector = selector;
							var ownElement = $(mutation.addedNodes).filter(selector);
							if (childSelector != '') {
								ownElement = ownElement.find(childSelector);
								finalSelector = selector + ' ' + childSelector;
							}
							ownElement.each(function (index) {
								callback($(this), index + 1, ownElement.length, finalSelector,true);
							});
							if (!ownElement.length) {
								var childElements = $(mutation.addedNodes).find(finalSelector);
								childElements.each(function (index) {
									callback($(this), index + 1, childElements.length, finalSelector,true);
								});
							}
						}
					}
				});
			};

			var target = $(containerSelector)[0];
			var config = {childList: true, subtree: true};
			var MutationObserver = window.MutationObserver || window.WebKitMutationObserver;
			var observer = new MutationObserver(onMutationsObserved);
			observer.observe(target, config);
		}
	}

	function gbt_cn_onAddedToCart(selector, theclass, callback) {
		if ("MutationObserver" in window) {
			var onMutationsObserved = function (mutations) {
				mutations.forEach((mutation) => {
					if(theclass != "") {
						if ((!mutation.oldValue || !mutation.oldValue.match(theclass) && mutation.oldValue.match('loading'))
							&& mutation.target.classList && mutation.target.classList.contains(theclass)) {
								callback();
						}
					} else {
						if (!mutation.oldValue || mutation.oldValue.match('loading')) {
								callback();
						}
					}
			    });
			};

			var target = selector[0];
			var MutationObserver = window.MutationObserver || window.WebKitMutationObserver;
			var observer = new MutationObserver(onMutationsObserved);
			var config = {attributes: true, attributeOldValue: true, attributeFilter: ['class']};
			observer.observe(target, config);
		}
	}

	var gbt_cn = {
		messages: [],
		open: false,
		init: function () {
			gbt_cn_onElementInserted('body', '.woocommerce-error', 		'', gbt_cn.readNotice);
			gbt_cn_onElementInserted('body', '.woocommerce-message', 	'', gbt_cn.readNotice);
			gbt_cn_onElementInserted('body', '.woocommerce-info', 		'', gbt_cn.readNotice);
			gbt_cn_onElementInserted('body', '.woocommerce-notice', 	'', gbt_cn.readNotice);

			gbt_cn.checkExistingElements('.woocommerce-error');
			gbt_cn.checkExistingElements('.woocommerce-message');
			gbt_cn.checkExistingElements('.woocommerce-info');
			gbt_cn.checkExistingElements('.woocommerce-notice');
		},
		checkExistingElements: function (selector) {
			var element = $(selector);
			if (element.length) {
				element.each(function (index) {
					gbt_cn.readNotice($(this), index + 1, element.length, selector,false);
				});
			}
		},
		readNotice: function (element, index, total, selector, dynamic) {
			var noticeType = 'success';

			if (selector.indexOf('error') > -1) {
				noticeType = 'error';
			} else if (selector.indexOf('info') > -1) {
				noticeType = 'info';
			}

			if (index <= total) {
				gbt_cn.storeMessage(element, noticeType, dynamic);
			}
			if (index == total) {
				gbt_cn.clearPopupMessages();
				gbt_cn.addMessagesToPopup();
				gbt_cn.openPopup(element);
				setTimeout(function(){
					gbt_cn.messages = [];
				}, 1000);
			}
		},
		clearPopupMessages: function () {
			$('#gbt-custom-notification-notice').find('.gbt-custom-notification-content').empty();
		},
		removeDuplicatedMessages: function () {
			var obj = {};
			for (var i = 0, len = gbt_cn.messages.length; i < len; i++) {
				obj[gbt_cn.messages[i]['message']] = gbt_cn.messages[i];
			}

			gbt_cn.messages = new Array();
			for (var key in obj)
				gbt_cn.messages.push(obj[key]);
		},
		isMessageValid: function (message, dynamic) {
			var ignored_msg = ["<p></p>", "<ul class=\"msg\"></ul>", "<ul></ul>"];
			// Ignored Messages
			var matches = ignored_msg.filter(function (string_check) {
				return message.indexOf(string_check) !== -1;
			});
			if (matches.length > 0) {
				return false;
			}

			return true;
		},
		storeMessage: function (notice, type, dynamic) {
			if (gbt_cn.isMessageValid(notice.html(),dynamic)) {
				gbt_cn.messages.push({message: notice.html(), type: type, dynamic:dynamic});
				gbt_cn.removeDuplicatedMessages();
			}
		},
		getAdditionalIconClass: function (noticeType) {
			var iconClass = "";
			switch (noticeType) {
				case "success":
					iconClass = gbt_cn_info.success_icon_class;
					break;
				case "error":
					iconClass = gbt_cn_info.error_icon_class;
					break;
				case "info":
					iconClass = gbt_cn_info.info_icon_class;
					break;
			}
			if (iconClass == "") {
				iconClass += " " + gbt_cn_info.icon_default_class;
			}
			return iconClass;
		},
		addMessagesToPopup: function (notice) {
			var delay_in = 0.5;
			var delay_out = 0.5 + 0.5 * gbt_cn.messages.length;
			var notif_delay = "";
			var notif_text_delay = "";
			var notification;

			$.each(gbt_cn.messages, function (index, value) {
				var additional_icon_class = gbt_cn.getAdditionalIconClass(value.type);
				var dynamicClass = value.dynamic ? 'gbt-cn-dynamic' : 'gbt-cn-static';

				if( gbt_cn_info.slide_out == 1 ) {
					notif_delay = "animation-delay: " + delay_in + "s, " + ( delay_out + 3 ) + "s";
					notif_text_delay = ( delay_in + 0.75 ) + "s, " + ( delay_out + 3.15 )  + "s";
				} else {
					notif_delay = "animation-delay: " + delay_in + "s";
					notif_text_delay = ( delay_in + 0.75 ) + "s";
				}

				if(value.message != "") {
					if(value.message.indexOf('product_notification_background') >= 0) { // build notification for added to cart product
						notification = $('#gbt-custom-notification-notice .gbt-custom-notification-content').append("<div class='gbt-custom-notification-notice " + value.type + ' ' + dynamicClass + " ' style='" + notif_delay + "'>" + value.message + "</div>");
						notification.find('.product_notification_text').css('animation-delay', notif_text_delay);
					} else { // build default notification
						$('#gbt-custom-notification-notice .gbt-custom-notification-content').append("<div class='gbt-custom-notification-notice " + value.type + ' ' + dynamicClass + " ' style='" + notif_delay + "'><i class='gbt-custom-notification-notice-icon " + additional_icon_class + "'></i><div class='gbt-custom-notification-message' style='animation-delay:" + notif_text_delay + "'><div>" + value.message + "</div></div></div>");
					}

					delay_in  = delay_in + 0.5;
					delay_out = delay_out - 0.5;
				}
			});
		},
		openPopup: function () {
			$('.gbt-custom-notification-notice').addClass('open-notice');
		}
	};

	document.addEventListener('DOMContentLoaded', function () {
		gbt_cn.init();
		$('body').trigger({
			type: 'gbt_cn',
			obj: gbt_cn
		});

		// Close notification on click
		$(document).on( 'click', '.page-notifications.slide-in .gbt-custom-notification-notice', function(){
			$(this).find('.product_notification_text').removeAttr( 'style' );
			$(this).find('.gbt-custom-notification-message').removeAttr( 'style' );
			$(this).removeAttr( 'style' ).removeClass('open-notice').addClass('close-notice');
		});

		//  Simple Product - Build and display notification on ajax add to cart
		$('body.gbt_custom_notif.single-product').on('click touchend', '.product.product-type-simple .columns > .product_infos .cart .ajax_add_to_cart', function(e){

			// get product's image
			if( $('body').find('.product_layout_classic').length > 0 ) {
				var imgSrc = $('.woocommerce-product-gallery .woocommerce-product-gallery__wrapper > .woocommerce-product-gallery__image img').attr('src') || "";
			} else {
				var imgSrc = $('.woocommerce-product-gallery__wrapper .product_images .product-image:first-child a img').attr('src') || "";
			}

			// get product's title
			var prodTitle = $('.product_title').html() || "";

			gbt_cn_onAddedToCart($(this), 'added', function() {
				$('#content').prepend('<div class="woocommerce-message"><div class="product_notification_wrapper"><div class="product_notification_background" style="background-image:url(' + imgSrc + ')"></div><div class="product_notification_text"><div>' + gbt_cn_info.cartButton + '&quot;' + prodTitle + '&quot; ' + gbt_cn_info.addedToCartMessage +'</div></div></div></div>');
			});
		});

		// Archive Page - Build and display notification on ajax add to cart
		$('body').on('click touchend', '.products .ajax_add_to_cart', function(){
			var imgSrc = $(this).parents('.column').find('.product_thumbnail_wrapper img').attr('src') || "";
			var prodTitle = $(this).parents('.column').find('.product-title-link').html() || "";

			gbt_cn_onAddedToCart($(this), 'added', function() {
				$('.st-content').prepend('<div class="woocommerce-message"><div class="product_notification_wrapper"><div class="product_notification_background" style="background-image:url(' + imgSrc + ')"></div><div class="product_notification_text"><div>' + gbt_cn_info.cartButton + '&quot;' + prodTitle + '&quot; ' + gbt_cn_info.addedToCartMessage +'</div></div></div></div>');
			});
		});

		// Quickview - Build and display notification on ajax add to cart
		$('body').on('click touchend', '.cd-quick-view .ajax_add_to_cart', function(){
			var imgSrc = $(this).parents('.product').find('.cover-image img').attr('src') || "";
			var prodTitle = $(this).parents('.product_infos').find('.product_title').html() || "";

			gbt_cn_onAddedToCart($(this), 'added', function() {
				$('.st-content').prepend('<div class="woocommerce-message"><div class="product_notification_wrapper"><div class="product_notification_background" style="background-image:url(' + imgSrc + ')"></div><div class="product_notification_text"><div>' + gbt_cn_info.cartButton + '&quot;' + prodTitle + '&quot; ' + gbt_cn_info.addedToCartMessage +'</div></div></div></div>');
			});
		});

		// Wishlist Page - Build and display notification on add to cart
		$('body.gbt_custom_notif.woocommerce-wishlist').on('click touchend', '.ajax_add_to_cart', function(){
			var imgSrc = $(this).parents('tr').find('.product-thumbnail img').attr('src') || "";
			var prodTitle = $(this).parents('tr').find('.product-name a').html() || "";

			gbt_cn_onAddedToCart($(this), "", function() {
				$('.st-content').prepend('<div class="woocommerce-message"><div class="product_notification_wrapper"><div class="product_notification_background" style="background-image:url(' + imgSrc + ')"></div><div class="product_notification_text"><div>' + gbt_cn_info.cartButton + '&quot;' + prodTitle + '&quot; ' + gbt_cn_info.addedToCartMessage +'</div></div></div></div>');
			});
		});
	});

} )( jQuery );
