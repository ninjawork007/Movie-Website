<?php
/**
 * Admin setup
 *
 * @package shopkeeper
 */

require_once( get_template_directory() . '/inc/tgm/class-tgm-plugin-activation.php' );
require_once( get_template_directory() . '/inc/tgm/plugins.php' );
require_once( get_template_directory() . '/inc/admin/wizard/class-gbt-helpers.php' );
require_once( get_template_directory() . '/inc/admin/wizard/class-gbt-install-wizard.php' );
require_once( get_template_directory() . '/inc/demo/ocdi-setup.php' );

/**
 * On theme activation redirect to splash page and set wc image sizes
 */
global $pagenow;
if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
	wp_redirect(admin_url("themes.php?page=gbt-setup")); // Your admin page URL
	add_action( 'init', 'shopkeeper_woocommerce_image_dimensions', 1 );
}

/**
 * Define wc image sizes
 */
function shopkeeper_woocommerce_image_dimensions() {
  	$catalog = array(
		'width' 	=> '350',	// px
		'height'	=> '435',	// px
		'crop'		=> 1 		// true
	);

	$single = array(
		'width' 	=> '570',	// px
		'height'	=> '708',	// px
		'crop'		=> 1 		// true
	);

	$thumbnail = array(
		'width' 	=> '70',	// px
		'height'	=> '87',	// px
		'crop'		=> 1 		// false
	);

	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}
add_action( 'after_switch_theme', 'shopkeeper_woocommerce_image_dimensions', 1 );

/**
 * Admin notices
 */
function shopkeeper_theme_notifications() {
	?>

	<?php if ( !get_option('dismissed-hookmeup-notice', FALSE ) && !class_exists('HookMeUp') ) : ?>
		<div class="notice-warning settings-error notice is-dismissible hookmeup_notice">
			<p>
				<strong>
					<span>This theme recommends the following plugin: <em><a href="https://wordpress.org/plugins/hookmeup/" target="_blank">HookMeUp – Additional Content for WooCommerce</a></em>.</span>
				</strong>
			</p>
		</div>
	<?php endif;
}
add_action( 'admin_notices', 'shopkeeper_theme_notifications' );

/**
 * Admin dismiss notices
 */
function shopkeeper_dismiss_dashboard_notice() {
	if( $_POST['notice'] == 'hookmeup' ) {
		update_option('dismissed-hookmeup-notice', TRUE );
	}
}
add_action( 'wp_ajax_gbt_dismiss_dashboard_notice', 'shopkeeper_dismiss_dashboard_notice' );

?>
