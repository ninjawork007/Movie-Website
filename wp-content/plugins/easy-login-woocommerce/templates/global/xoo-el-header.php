<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$gl_options = get_option('xoo-el-general-options');
$en_reg   	= $gl_options['m-en-reg'];

?>

<div class="xoo-el-header">
	<ul class="xoo-el-tabs">

		<li class="xoo-el-login-tgr <?php echo $form_active === 'login' ? 'xoo-el-active' : ''; ?> xoo-el-login-ph"><?php _e( 'Login', 'easy-login-woocommerce' ); ?></li>

		<?php if($en_reg === "yes"): ?> 
			<li class="xoo-el-reg-tgr <?php echo $form_active === 'register' ? 'xoo-el-active' : ''; ?> xoo-el-register-ph"><?php _e( 'Sign up', 'easy-login-woocommerce' ); ?></li>
		<?php endif; ?>

	</ul>
</div>