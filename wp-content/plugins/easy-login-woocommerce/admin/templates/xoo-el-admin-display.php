<div class="xoo-tabs">
	<?php

	$current_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'general';

	echo '<h2 class="nav-tab-wrapper">';
	foreach ( $tabs as $tab_key => $tab_caption ) {
		$active = $current_tab == $tab_key ? 'nav-tab-active' : '';
		echo '<a class="nav-tab ' . $active . '" href="?page=xoo-el&tab=' . $tab_key . '">' . $tab_caption . '</a>';	
	}
	echo '</h2>';

	if( $current_tab === 'advanced' ){
		$option_name = 'premium';
	}
	else{
		$option_name = 'xoo-el-'.$current_tab.'-options';
	}

	?>
</div>

<?php
	
	if( $current_tab === 'fields' ) {
		xoo_aff_admin()->display_settings();
		return;
	}

?>


<div class="xoo-container">
	<div class="xoo-main">

		<?php if( $option_name === 'premium' ): ?>

			<?php include(plugin_dir_path(__FILE__).'xoo-el-premium-info.php'); ?>

		<?php else: ?>
			
			<form method="post" action="options.php">
				<?php
					settings_fields( $option_name ); // Display Settings

					do_settings_sections( $option_name ); // Display Sections

					submit_button( 'Save Settings' );	// Display Save Button
				?>			
			</form>

		<?php endif; ?>

		<div class="xoo-el-faqs">
			<span class="section-title">How to?</span>
			<ol>
				<li>Go to apperance->menus & select the desired option from "Login/Signup Popup" tab.</li>
				<li>
					<b>Popup button shortcode</b><br>
					Use shortcode [xoo_el_action] to include it anywhere on the website.<br>
					login: [xoo_el_action type="login" change_to="logout"]<br>
					Register: [xoo_el_action type="register" change_to="myaccount"]<br>
					Lost Password: [xoo_el_action type="lost-password"]<br>
					<span style="font-style: italic; display: inline-block; margin: 5px 0;">Attributes- type refers to form type , change_to refers to logged in link.</span>
				</li>
				<li><b>Inline form shortcode</b><br>[xoo_el_inline_form active="login"]</li>
				<li>
					Trigger pop up using classes.<br>
					Login: xoo-el-login-tgr<br>Register:xoo-el-reg-tgr <br>
					Lost password: xoo-el-lostpw-tgr<br>
					For eg: <?php echo htmlspecialchars('<a class="xoo-el-login-tgr">Login</a>'); ?>
				</li>
			</ol>
		</div>
	</div>

	<div class="xoo-sidebar">
		<?php include XOO_EL_PATH.'/admin/templates/xoo-el-sidebar.php'; ?>
	</div>
</div>

