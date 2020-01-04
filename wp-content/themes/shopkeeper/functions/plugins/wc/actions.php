<?php
/**
 * WC actions
 *
 * @package shopkeeper
 */

/**
 * Load selected notification style
 */
function shopkeeper_load_notification_style() {

    if( Shopkeeper_Opt::getOption( 'notification_mode', '1' ) == '1' ) {
        include( get_template_directory() . '/inc/notifications/custom/class-custom-notifications.php' );
    } else {
        include( get_template_directory() . '/inc/notifications/classic/class-classic-notifications.php' );
    }
}
add_action( 'wp_loaded', 'shopkeeper_load_notification_style', 100 );

/**
 * Predictive search
 */
function shopkeeper_predictive_search() {
    if( Shopkeeper_Opt::getOption( 'predictive_search', true ) ) {
        include_once( get_template_directory() . '/inc/search/class-search.php' );
    }
}
add_action( 'wp_loaded', 'shopkeeper_predictive_search', 100 );

/**
 * Remove Woocommerce prettyPhoto
 */
function shopkeeper_remove_woo_lightbox() {
    wp_dequeue_script('prettyPhoto-init');
}
add_action( 'wp_enqueue_scripts', 'shopkeeper_remove_woo_lightbox', 99 );

/**
 * Display no message on search
 */
function shopkeeper_add_notice_search($message) {
	if ( is_search() ) {
		return false;
	}
}
add_action( 'woocommerce_archive_description', 'shopkeeper_add_notice_search', 10, 1 );

/**
 * Continue shopping button on cart page
 */
function shopkeeper_add_continue_shopping_button_to_cart() {
	$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
	if ( !empty($shop_page_url) ) {
		echo '<div class="shopkeeper-continue-shopping">';
		echo ' <a href="'.$shop_page_url.'" class="button">'. esc_html__('Continue shopping', 'woocommerce') .'</a>';
		echo '</div>';
	}
}
add_action( 'woocommerce_after_cart', 'shopkeeper_add_continue_shopping_button_to_cart' );

/**
 * External Product in new tab
 */
function shopkeeper_external_add_to_cart() {
    global $product;

    if ( ! $product->add_to_cart_url() ) {
        return;
    }

    $product_url = $product->add_to_cart_url();
    $button_text = $product->single_add_to_cart_text();

    do_action( 'woocommerce_before_add_to_cart_button' ); ?>
    <p class="cart">
        <a href="<?php echo esc_url( $product_url ); ?>" target="_blank" rel="nofollow" class="single_add_to_cart_button button alt"><?php echo esc_html( $button_text ); ?></a>
    </p>
    <?php do_action( 'woocommerce_after_add_to_cart_button' );
}
remove_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );
add_action( 'woocommerce_external_add_to_cart', 'shopkeeper_external_add_to_cart', 30 );

/**
 * WooCommerce Cart is empty remove notice class
 */
function shopkeeper_empty_cart_message() {
	echo '<p class="cart-empty">' . wp_kses_post( apply_filters( 'wc_empty_cart_message', __( 'Your cart is currently empty.', 'woocommerce' ) ) ) . '</p>';
}
remove_action( 'woocommerce_cart_is_empty', 'wc_empty_cart_message', 10 );
add_action( 'woocommerce_cart_is_empty', 'shopkeeper_empty_cart_message', 10 );

?>
