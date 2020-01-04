jQuery(function($) {
	
	"use strict";

	// dismiss dashboard notices
	$( document ).on( 'click', '.hookmeup_notice .notice-dismiss', function () {
		var data = {
            'action' : 'gbt_dismiss_dashboard_notice',
            'notice' : 'hookmeup'
        };

        jQuery.post( 'admin-ajax.php', data );  
	});
});