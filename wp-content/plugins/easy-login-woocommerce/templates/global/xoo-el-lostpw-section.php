<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$gl_options = get_option('xoo-el-general-options');
$en_reg   	= $gl_options['m-en-reg'];

?>

<div class="xoo-el-fields">
	
	<div class="xoo-el-notice"></div>

	<form class="xoo-el-action-form">
		
		<?php do_action('xoo_el_lostpassword_form_start'); ?>

		<span class="xoo-el-form-txt"><?php _e('Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.','easy-login-woocommerce'); ?></span>

		<div class="xoo-aff-group">
			<div class="xoo-aff-input-group">
				<span class="xoo-aff-input-icon fas fa-key"></span>
				<input type="text" placeholder="<?php _e('Username / Email','easy-login-woocommerce'); ?>" id="xoo-el-lostpw-email" name="user_login">
			</div>
		</div>

		<input type="hidden" name="_xoo_el_form" value="lostPassword">

		<?php do_action('xoo_el_lostpw_add_fields'); ?>

		<button type="submit" class="button btn xoo-el-action-btn xoo-el-lostpw-btn"><?php _e('Email Reset Link','easy-login-woocommerce'); ?></button>

		<?php do_action('xoo_el_lostpassword_form_end'); ?>

	</form>
</div>