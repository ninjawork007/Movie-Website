<?php

add_action( 'init', 'create_portfolio_categories' );

function create_portfolio_categories() {
	
	$labels = array(
		'name'                       => __('Portfolio Categories', 'shopkeeper-portfolio'),
		'singular_name'              => __('Portfolio Category', 'shopkeeper-portfolio'),
		'search_items'               => __('Search Portfolio Categories', 'shopkeeper-portfolio'),
		'popular_items'              => __('Popular Portfolio Categories', 'shopkeeper-portfolio'),
		'all_items'                  => __('All Portfolio Categories', 'shopkeeper-portfolio'),
		'edit_item'                  => __('Edit Portfolio Category', 'shopkeeper-portfolio'),
		'update_item'                => __('Update Portfolio Category', 'shopkeeper-portfolio'),
		'add_new_item'               => __('Add New Portfolio Category', 'shopkeeper-portfolio'),
		'new_item_name'              => __('New Portfolio Category Name', 'shopkeeper-portfolio'),
		'separate_items_with_commas' => __('Separate Portfolio Categories with commas', 'shopkeeper-portfolio'),
		'add_or_remove_items'        => __('Add or remove Portfolio Categories', 'shopkeeper-portfolio'),
		'choose_from_most_used'      => __('Choose from the most used Portfolio Categories', 'shopkeeper-portfolio'),
		'not_found'                  => __('No Portfolio Category found.', 'shopkeeper-portfolio'),
		'menu_name'                  => __('Portfolio Categories', 'shopkeeper-portfolio'),
	);

	$args = array(
		'hierarchical'          => true,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'hierarchical' 			=> true,
		'rest_base'				=> 'portfolio-category',
		'query_var'             => true,
		'show_in_rest'			=> true,
		'rewrite'               => array( 'slug' => 'portfolio-category' ),
	);

	register_taxonomy("portfolio_categories", "portfolio", $args);
}
