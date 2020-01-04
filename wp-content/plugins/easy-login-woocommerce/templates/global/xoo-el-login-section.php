<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$gl_options = get_option('xoo-el-general-options');
$redirect 	= !empty( $gl_options['m-login-url'] ) ? esc_attr( $gl_options['m-login-url'] ) : $_SERVER['REQUEST_URI'];
$en_reg   	= $gl_options['m-en-reg'];

$av_options = (array) get_option( 'xoo-el-advanced-options' );

?>

<div class="xoo-el-fields">

	<?php xoo_el_print_notices('login'); ?>
	
	<form class="xoo-el-action-form">

		<?php do_action('xoo_el_login_form_start'); ?>

		<div class="xoo-aff-fields">

			<div class="xoo-aff-group">
				<div class="xoo-aff-input-group">
					<span class="xoo-aff-input-icon far fa-user"></span>
					<input type="text" placeholder="<?php _e('Username / Email','easy-login-woocommerce'); ?>" id="xoo-el-username" name="xoo-el-username" required>
				</div>
			</div>

			<div class="xoo-aff-group">
				<div class="xoo-aff-input-group">
					<span class="xoo-aff-input-icon fas fa-key"></span>
					<input type="password" placeholder="<?php _e('Password','easy-login-woocommerce'); ?>" id="xoo-el-password" name="xoo-el-password" required>
				</div>
			</div>

			<div class="xoo-aff-group xoo-el-login-btm-fields">
				<label class="xoo-el-form-label" for="xoo-el-rememberme">
					<input type="checkbox" name="xoo-el-rememberme" id="xoo-el-rememberme" value="forever" />
					<span><?php _e( 'Remember me', 'easy-login-woocommerce' ); ?></span>
				</label>

				
				<a class="xoo-el-lostpw-tgr"><?php _e('Forgot Password?','easy-login-woocommerce'); ?></a>

			</div>

			<?php do_action('xoo_el_login_add_fields'); ?>

		</div>

		<input type="hidden" name="_xoo_el_form" value="login">

		<button type="submit" class="button btn xoo-el-action-btn xoo-el-login-btn"><?php _e('Sign In','easy-login-woocommerce'); ?></button>

		<input type="hidden" name="redirect" value="<?php echo $redirect; ?>">

		<?php do_action('xoo_el_login_form_end'); ?>

	</form>
</div>