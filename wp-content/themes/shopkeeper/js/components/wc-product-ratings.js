jQuery( function($) {

    'use strict';

    // Product Ratings Tooltip

    if ( $(window).width() > 1024 ) {

        var woocommerce_review_link_hover   = $('.product .woocommerce-product-rating .woocommerce-review-link').html();
        var woocommerce_review_link         = $('.product .woocommerce_review_link_hover');
        var woocommerce_product_rating      = $('.product .woocommerce-product-rating');
        var rating_tooltip                  = '<div class="woocommerce_review_link_hover">' + woocommerce_review_link_hover + '</div>';

        // check to see if the woocommerce reviews tab is enabled
        if ( woocommerce_review_link_hover != undefined ) {

            woocommerce_product_rating.before(rating_tooltip);

            woocommerce_product_rating.on({
                mouseenter: function() {

                    $('.woocommerce_review_link_hover').addClass('hovered')
                },
                mouseleave: function() {

                    $('.woocommerce_review_link_hover').removeClass('hovered')
                }

            });
        }
    }
});
