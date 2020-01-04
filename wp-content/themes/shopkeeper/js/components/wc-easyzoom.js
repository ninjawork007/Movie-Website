jQuery( function($) {

	"use strict";

	$(window).on( 'load', function() {
		
		//Product Gallery zoom	
		
		if ($(".easyzoom").length ) {
			
			if ( $(window).width() > 1024 ) {
				
				var $easyzoom = $(".easyzoom").easyZoom({
					loadingNotice: '',
					errorNotice: '',
					preventClicks: false,
					linkAttribute: "href",
				});
				
				var easyzoom_api = $easyzoom.data('easyZoom');
				
				$(".variations").on('change', 'select', function() {					
					easyzoom_api.teardown();
					easyzoom_api._init();
				});
			
			} else {
				
				$(".easyzoom a").on( 'click', function(event) {
					event.preventDefault();
				});

			}
		
		}
	
	});

});