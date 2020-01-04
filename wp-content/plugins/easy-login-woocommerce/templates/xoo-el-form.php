<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$gl_options = get_option('xoo-el-general-options');
$en_reg   	= $gl_options['m-en-reg'];
$form_active = isset( $form_active ) ? $form_active : 'login';

?>

<div class="xoo-el-form-container <?php echo apply_filters( 'xoo_el_form_class', $form_class ); ?>">
	<?php do_action('xoo_el_popup_start'); ?>

	<?php xoo_get_template( 'xoo-el-header.php', XOO_EL_PATH.'/templates/global/', $args = array( 'form_active' => $form_active ) ); ?>

	<div class="xoo-el-section xoo-el-section-login <?php echo $form_active === 'login' ? 'xoo-el-active' : ''; ?> xoo-el-login-ph">
		<?php xoo_get_template('xoo-el-login-section.php', XOO_EL_PATH.'/templates/global/'); ?>
	</div>

	<?php if($en_reg === "yes"): ?>
		<div class="xoo-el-section xoo-el-section-register <?php echo $form_active === 'register' ? 'xoo-el-active' : ''; ?> xoo-el-register-ph">
			<?php xoo_get_template('xoo-el-signup-section.php', XOO_EL_PATH.'/templates/global/'); ?>
		</div>
	<?php endif; ?>

	<div class="xoo-el-section xoo-el-section-lostpw <?php echo $form_active === 'lost-password' ? 'xoo-el-active' : ''; ?> xoo-el-lostpw-ph">
		<?php xoo_get_template('xoo-el-lostpw-section.php', XOO_EL_PATH.'/templates/global/'); ?>
	</div>

	<?php do_action('xoo_el_popup_end'); ?>

	<span class="xoo-el-footer-note"><?php _e('We do not share your personal details with anyone.','easy-login-woocommerce'); ?></span>
</div>