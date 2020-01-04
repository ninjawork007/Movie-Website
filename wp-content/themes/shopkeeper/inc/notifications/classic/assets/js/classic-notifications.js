(function( $ ) {

	'use strict';

	function gbt_cln_onAddedToCart(selector, theclass, callback) {
		if ("MutationObserver" in window) {
			var onMutationsObserved = function (mutations) {
				mutations.forEach((mutation) => {
					if(theclass != "") {
						if ((!mutation.oldValue || !mutation.oldValue.match(theclass) && mutation.oldValue.match('loading')) 
							&& mutation.target.classList && mutation.target.classList.contains(theclass)) {
								callback($(this));
						}
					} else {
						if (!mutation.oldValue || mutation.oldValue.match('loading')) {
								callback($(this));
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

	document.addEventListener('DOMContentLoaded', function () {

		//  Simple Product - display notification on ajax add to cart
		$('body.single-product').on('click touchend', '.product.product-type-simple .columns > .product_infos .cart .ajax_add_to_cart', function(){
			var prodTitle = $('.product_title').html() || "";

			gbt_cln_onAddedToCart($(this), 'added', function() {
				$('.woocommerce-notices-wrapper').empty();
				$('.woocommerce-notices-wrapper').prepend('<div class="woocommerce-message">' + gbt_cn_info.cartButton + '&quot;' + prodTitle +  '&quot; ' + gbt_cn_info.addedToCartMessage + '</div>');
			});
		});
	});

} )( jQuery );