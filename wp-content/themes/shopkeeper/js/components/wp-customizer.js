jQuery(function($) {

	"use strict";

    $( function( $ ) {

        // Collapsible

        // Collapse all collapsible controls.
        $( '.customize-control-collapsible' ).closest( 'li[id*="_collapsible"]' ).toggleClass( 'customize-control-collapsed' );
        $( '.customize-control-collapsible' ).closest( 'li[id*="_collapsible"]' ).nextUntil( 'li[id*="_collapsible"]' ).toggleClass( 'customize-control-hidden' );

        // Expand collapsible controls on click.
        $( '.customize-control-collapsible' ).on( 'click', function() {

            $(this).closest( 'li[id*="_collapsible"]' ).toggleClass( 'customize-control-collapsed' );
            $(this).closest( 'li[id*="_collapsible"]' ).nextUntil( 'li[id*="_collapsible"]' ).toggleClass( 'customize-control-hidden' );

        } );

        // Go To Page

        var in_customizer = false;

        if ( typeof wp !== 'undefined' ) {
            if ( typeof wp.customize !== 'undefined' ) {
                in_customizer =  typeof wp.customize.section !== 'undefined' ? true : false;
            }
        }

        if ( in_customizer ) {

            if( getbowtied_customizer_vars.active_option == '0' ) {
                $('#customize-control-ajax_add_to_cart').addClass('disabled ' + getbowtied_customizer_vars.plugin);
            }

            wp.customize.panel( 'panel_shop', function( section ) {
                go_to_page( section, 'shop' );
            } );

            wp.customize.section( 'blog_archive', function( section ) {
                go_to_page( section, 'blog' );
            } );

            wp.customize.section( 'single_post', function( section ) {
                go_to_page( section, 'post' );
            } );

            wp.customize.section( 'product', function( section ) {
                go_to_page( section, 'product' );
            } );

        }

        function go_to_page( section, page ) {

            section.expanded.bind( function( isExpanded ) {
                if ( isExpanded ) {
                    var data = {
                        'action' : 'get_url',
                        'page'   : page
                    };

                    jQuery.post( 'admin-ajax.php', data, function(response) {
                        wp.customize.previewer.previewUrl.set(response);
                    });
                }
            } );
        }
    });
});
