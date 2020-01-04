<?php
/**
 * WC actions
 *
 * @package shopkeeper
 */

/**
 * Wishlist message notification remove
 */
function shopkeeper_yith_wcwl_added_to_cart_message( $message ){
   return false;
}
if( Shopkeeper_Opt::getOption( 'notification_mode', '1' ) == '1' ) {
    add_action( 'yith_wcwl_added_to_cart_message', 'shopkeeper_yith_wcwl_added_to_cart_message' );
}

?>
