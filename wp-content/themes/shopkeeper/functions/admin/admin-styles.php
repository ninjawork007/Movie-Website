<?php
/**
 * Admin styles
 *
 * @package shopkeeper
 */

 /**
  * Admin styles
  */
function shopkeeper_admin_styles() {
    if ( is_admin() ) {

        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_style( 'shopkeeper_admin_styles', get_template_directory_uri() . "/css/admin/admin.css", false, shopkeeper_theme_version(), 'all' );

        if ( SHOPKEEPER_WPBAKERY_IS_ACTIVE ) {
            wp_enqueue_style( 'shopkeeper_visual_composer', get_template_directory_uri() .'/css/plugins/visual-composer.css', false, shopkeeper_theme_version(), 'all' );
        }
    }
}
add_action( 'admin_enqueue_scripts', 'shopkeeper_admin_styles' );

?>
