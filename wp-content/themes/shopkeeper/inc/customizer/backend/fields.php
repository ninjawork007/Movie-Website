<?php
/**
 * Customizer controls
 *
 * @package shopkeeper
 */

$sep = 0;

include_once( get_template_directory() . '/inc/customizer/backend/sections/section-blog.php' );
include_once( get_template_directory() . '/inc/customizer/backend/sections/section-fonts.php' );
include_once( get_template_directory() . '/inc/customizer/backend/sections/section-footer.php' );
include_once( get_template_directory() . '/inc/customizer/backend/sections/section-header.php' );
include_once( get_template_directory() . '/inc/customizer/backend/sections/section-styling.php' );

if( SHOPKEEPER_WOOCOMMERCE_IS_ACTIVE ) {
    include_once( get_template_directory() . '/inc/customizer/backend/sections/section-product.php' );
    include_once( get_template_directory() . '/inc/customizer/backend/sections/section-shop.php' );
}

?>
