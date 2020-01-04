jQuery( function($) {

    "use strict";

    $(".main-navigation > ul > .menu-item").on( 'mouseenter', function() {
        if ($(this).children(".sub-menu").length > 0) {
            var t = $(this).children(".sub-menu");
            var a = parseInt( t.outerWidth() / 2 );

            t.css('left' , a-(t.outerWidth()));
        }
    });

    $(window).on( 'load', function() {

        if( $('html').attr('dir') == 'rtl' ){
                $('[data-vc-full-width="true"]').each( function(i,v){
                    $(this).css('right' , $(this).css('left') ).css( 'left' , 'auto');
                });
            }
    });
});
