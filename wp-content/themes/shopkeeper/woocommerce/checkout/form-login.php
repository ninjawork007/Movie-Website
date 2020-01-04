<?php
/**
 * Checkout login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.4.0
 */

defined( 'ABSPATH' ) || exit;

if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
	return;
}

?>
<div class="checkout_login">
	<div class="row">
		<div class="xlarge-9 large-11 xlarge-centered large-centered text-center columns">
			<div class="shopkeeper_checkout_login">
				<?php echo apply_filters( 'woocommerce_checkout_login_message', esc_html__( 'Returning customer?', 'woocommerce' ) ) . ' <a href="#" class="showlogin">' . esc_html__( 'Click here to login', 'woocommerce' ) . '</a>'; ?>
			</div>
	
			<?php
				woocommerce_login_form(
					array(
						'message'  => esc_html__( 'If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing &amp; Shipping section.', 'woocommerce' ),
						'redirect' => wc_get_page_permalink( 'checkout' ),
						'hidden'   => true,
					)
				);
			?>
			<div class="notice-border-container"></div>
		</div>
	</div>
	
</div><!-- .checkout_login-->
