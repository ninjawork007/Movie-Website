jQuery(function($) {

	"use strict";

	//  yith wishlist counter
	function getCookie(name) {
	    var dc = document.cookie;
	    var prefix = name + "=";
	    var begin = dc.indexOf("; " + prefix);
	    if (begin == -1) {
	        begin = dc.indexOf(prefix);
	        if (begin != 0) return null;
	    }
	    else
	    {
	        begin += 2;
	        var end = document.cookie.indexOf(";", begin);
	        if (end == -1) {
	        end = dc.length;
	        }
	    }
	    // because unescape has been deprecated, replaced with decodeURI
	    //return unescape(dc.substring(begin + prefix.length, end));
	    return decodeURIComponent(decodeURIComponent((dc.substring(begin + prefix.length, end))));
	}

	function getbowtied_update_wishlist_count(count) {
		if ( ( typeof count === "number" && isFinite(count) && Math.floor(count) === count ) && count >=0 ) {
			$('.wishlist_items_number').html(count);
		}
	}

	if ($('.wishlist_items_number').length ) {

		var wishlistCounter = 0;

		/*
		**	Check for Yith cookie
		*/
		var wlCookie = getCookie("yith_wcwl_products");

		if ( wlCookie != null ) {
            wlCookie = wlCookie.slice(0, wlCookie.indexOf(']') + 1);
			var products = JSON.parse(wlCookie);
			wishlistCounter =  Object.keys(products).length;
		} else 	{
			wishlistCounter = Number($('.wishlist_items_number').html());
		}

		/*
		**	Increment counter on add
		*/
		$('body').on( 'added_to_wishlist' , function(){
			wishlistCounter++;
			getbowtied_update_wishlist_count(wishlistCounter);
		});

		/*
		**	Decrement counter on remove
		*/
		$('body').on( 'removed_from_wishlist' , function(){
			wishlistCounter--;
			getbowtied_update_wishlist_count(wishlistCounter);
		});

		getbowtied_update_wishlist_count(wishlistCounter);
	}
});
