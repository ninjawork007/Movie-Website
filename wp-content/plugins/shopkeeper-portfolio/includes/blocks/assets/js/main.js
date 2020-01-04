( function( blocks ) {
	var blockCategories = blocks.getCategories();
	blockCategories.unshift({ 'slug': 'shopkeeper', 'title': 'Shopkeeper Blocks'});
	blocks.setCategories(blockCategories);
})(
	window.wp.blocks
);