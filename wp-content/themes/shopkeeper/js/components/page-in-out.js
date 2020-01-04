jQuery( function($) {

	"use strict";

	$(window).on('pagehide', function (e) {

		if ( e.persisted) {
		    $('#st-container').addClass('fade_out').removeClass('fade_in');
		    $('#header-loader-under-bar').removeClass('hidden');
		}
	})

	$(window).on( 'load', function(e) {
	    $('#st-container').addClass('fade_in').removeClass('fade_out');
	    $('#header-loader-under-bar').addClass('hidden');
	    NProgress.done();
	})

});
