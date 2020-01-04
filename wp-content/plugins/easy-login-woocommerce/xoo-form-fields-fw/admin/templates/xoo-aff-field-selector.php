<div class="xoo-aff-field-selector">
	<span>Select one of the field below.</span>
	<ul class="xoo-aff-select-fields-type">

		<?php
			$fields_obj = xoo_aff_fields();
			$types  	= $fields_obj::$types;
		?>

		<?php foreach ( $types as $type_id => $type_data ): ?>
			<?php if( $type_data['is_selectable'] === "yes" ): ?>
				<li><?php echo $type_data['title']; ?></li>
			<?php endif; ?>
		<?php endforeach; ?>
	</ul>

	<span class="xoo-aff-prem-note">Extra fields are part of premium version. </span>
	<div class="xoo-hero-btns">
		<a class="buy-prem button button-primary button-hero" href="http://demo.xootix.com/easy-login-for-woocommerce/">LIVE DEMO</a>
		<a class="live-demo button button-primary button-hero" href="http://xootix.com/plugins/easy-login-for-woocommerce/">BUY PREMIUM - 14$</a>
	</div>

</div>