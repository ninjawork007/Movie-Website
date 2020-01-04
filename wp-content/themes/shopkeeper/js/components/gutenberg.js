jQuery( function ($) {

	"use strict";
	
	var uniqId = ( function() {
	    var i=0;
	    return function() {
	        return i++;
	    }
	})();

	// Add fresco to galleries
	$( ".wp-block-gallery" ).each(function() {

		var that = $(this);

		that.attr('id', 'gallery-'+uniqId());

	  	that.find('.blocks-gallery-item').each(function(){

		  	var this_gallery_item = $(this);

		  	var item_link = this_gallery_item.find('a').attr('href');

		  	if( item_link ) {

			  	item_link = item_link.split('.').pop();
			  	
			  	if( item_link && ( typeof item_link === 'string') && ( item_link == 'jpg' || item_link == 'jpeg' || item_link == 'png' || item_link == 'gif' ) ) {

			  		this_gallery_item.find('a').addClass('fresco');
					
					this_gallery_item.find('.fresco').attr('data-fresco-group', that.attr('id'));

					if ( this_gallery_item.find('figcaption').length > 0 ) {
						this_gallery_item.find('.fresco').attr('data-fresco-caption', this_gallery_item.find('figcaption').text());
					}
			  	}
		  	}			
		});
	});
});