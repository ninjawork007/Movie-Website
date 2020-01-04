jQuery( function($) {

    'use strict';

    // Product Quantity Custom Buttons

    $(document).on('click', '.plus-btn', function(e) {

        var input = $(this).prev('input.custom-qty');

    	if( $('body').hasClass('rtl') ) {
    		input = $(this).next('input.custom-qty');
    	}

        var val  = parseInt(input.val());
        var max  = parseInt(input.attr('max'));
        var step = parseInt(input.attr('step')) || 1;

        if( !isNaN(max) ) {
            if( max > val ) {
                input.val( val+step ).change();
            }
        } else {
            input.val( val+step ).change();
        }

        return false;
    });

    $(document).on('click', '.minus-btn', function(e) {

        var input = $(this).next('input.custom-qty');

    	if( $('body').hasClass('rtl') ) {
    		input = $(this).prev('input.custom-qty');
    	}

        var val  = parseInt(input.val());
        var min  = parseInt(input.attr('min'));
        var step = parseInt(input.attr('step')) || 1;

        if( !isNaN(min) ) {
            if( min < val ) {
                input.val( val-step ).change();
            }
        } else {
            input.val( val-step ).change();
        }

        return false;
    });

	var windowWidth = $(window).width();

    // Input Quantity Long Press

    if (  windowWidth > 1024 ) {

		var timer;

		$(document).on('mousedown', '.plus-btn', function(e) {

		    var input = $(this).prev('input.custom-qty');
		    var val = parseInt(input.val());

		    timer = setInterval(function() {

		        val++;
		        input.val(val);

		    }, 250);

		});

		$(document).on('mousedown', '.minus-btn', function(e) {

		    var input = $(this).next('input.custom-qty');
		    var val = parseInt(input.val());

		    timer = setInterval(function() {

		      	if (val > 1) {
					val--;
					input.val(val);
		        }

		     }, 250);
		});


		document.addEventListener("mouseup", function(){
	   		if (timer) clearInterval(timer)
		});

	}
});
