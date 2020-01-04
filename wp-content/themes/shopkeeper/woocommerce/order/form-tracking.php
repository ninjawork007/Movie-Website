<?php
/**
 * Order tracking form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $post;
?>

<div class="row">
	<div class="large-10 large-centered columns">
		<div class="track-order-container">
			
			<p class="track-order-description"><?php esc_html_e( 'To track your order please enter your Order ID in the box below and press the "Track" button. This was given to you on your receipt and in the confirmation email you should have received.', 'woocommerce' ); ?></p>
		
			<form action="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" method="post" class="custom_border woocommerce-form woocommerce-form-track-order track_order">
			 
				<p class="input_box"><label for="orderid"><?php esc_html_e( 'Order ID', 'woocommerce' ); ?></label> <input class="input-text" type="text" name="orderid" id="orderid" placeholder="<?php esc_html_e( 'Found in your order confirmation email.', 'woocommerce' ); ?>" /></p>
				<p class="input_box last"><label for="order_email"><?php esc_html_e( 'Billing email', 'woocommerce' ); ?></label> <input class="input-text" type="text" name="order_email" id="order_email" placeholder="<?php esc_html_e( 'Email you used during checkout.', 'woocommerce' ); ?>" /></p>
				<div class="clear"></div>
			
				<p class="form-row"><input type="submit" class="button" name="track" value="<?php esc_html_e( 'Track', 'woocommerce' ); ?>" /></p>
				<?php wp_nonce_field( 'woocommerce-order_tracking', 'woocommerce-order-tracking-nonce' ); ?>
			
			</form>
			
			
		</div><!-- .track-order-container-->
	</div><!-- .large-->
</div><!-- .row-->
