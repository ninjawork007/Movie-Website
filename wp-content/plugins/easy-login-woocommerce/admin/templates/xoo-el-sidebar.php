<?php
	$plugins_list = array(

		array(
			'title' 	=> 'Woo Side Cart',
			'dashicon'  => 'dashicons-cart',
			'desc' 		=> 'Adds a site wide basket icon that displays the added cart items.',
			'demo' 		=> 'http://demo.xootix.com/side-cart-for-woocommerce',
			'download'  => 'https://wordpress.org/plugins/side-cart-woocommerce/'
		),

		array(
			'title' 	=> 'Woo Waitlist',
			'dashicon'  => 'dashicons-list-view',
			'desc' 		=> 'Lets you track demand for out-of-stock items, ensuring your customers feel informed.',
			'demo' 		=> 'http://demo.xootix.com/waitlist-for-woocommerce',
			'download'  => 'https://wordpress.org/plugins/waitlist-woocommerce/'
		),

		array(
			'title' 	=> 'Woo Quick View',
			'dashicon'  => 'dashicons-welcome-view-site',
			'desc' 		=> 'Allow users to get a quick look of products without opening the product page.',
			'demo' 		=> 'http://demo.xootix.com/quick-view-for-woocommerce',
			'download'  => 'https://wordpress.org/plugins/quick-view-woocommerce/'
		),

		array(
			'title' 	=> 'Woo Cart Popup',
			'dashicon'  => 'dashicons-cart',
			'desc' 		=> 'Shows the item added to cart without page refresh.',
			'demo' 		=> 'http://demo.xootix.com/cart-pop-up-for-woocommerce',
			'download'  => 'https://wordpress.org/plugins/added-to-cart-popup-woocommerce/'
		),
	)
?>

<a class="xoo-sidebar-toggle">Hide</a>
<div class="xoo-other-plugins">
	<div class="xoo-sidebar-head">
		<span class="xoo-op-head">Try other awesome plugins</span>
	</div>

	<ul class="xoo-op-list">

		<?php foreach($plugins_list as $plugin): ?>
			<li class="xoo-op-plugin">
				<div class="xoo-op-plugin-icon">
					<span class="dashicons <?php echo $plugin['dashicon']; ?>"></span>
				</div>

				<div class="xoo-op-plugin-details">
					<span class="xoo-op-plugin-head"><?php echo $plugin['title']; ?></span>
					<span class="xoo-op-plugin-about"><?php echo $plugin['desc']; ?></span>
					<a href="<?php echo $plugin['demo']; ?>">Demo</a>
					<a href="<?php echo $plugin['download']; ?>">Download</a>
				</div>
			</li>
		<?php endforeach; ?>
	</ul>
	<a href="http://xootix.com/support">Need Help? Use Live Chat</a>
</div>