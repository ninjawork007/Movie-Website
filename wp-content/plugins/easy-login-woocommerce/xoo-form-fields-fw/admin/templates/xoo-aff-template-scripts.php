<?php

//Include all files under templates folder
$path  = XOO_AFF_DIR . '/admin/templates/scripts/';

?>


<script type="text/html" id="tmpl-xoo-aff-field-settings-container">
	<?php include $path.'/field-settings-container.php'; ?>
</script>

<script type="text/html" id="tmpl-xoo-aff-field-settings">
	<div class="xoo-aff-fs-input xoo-aff-fs-{{data.width}}">
		<?php include $path.'/field-settings.php'; ?>
	</div>
</script>

<script type="text/html" id="tmpl-xoo-aff-field-section">
	<?php include $path.'/field-section.php'; ?>
</script>

<script type="text/html" id="tmpl-xoo-aff-field-display">
	<?php include $path.'/field-display.php'; ?>
</script>

<script type="text/html" id="tmpl-xoo-aff-notice">
	<?php include $path.'/notice.php'; ?>
</script>