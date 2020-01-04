<?php

$taxonomy     = 'product_cat';
$orderby      = 'name';  
$show_count   = 0;      // 1 for yes, 0 for no
$pad_counts   = 0;      // 1 for yes, 0 for no
$hierarchical = 1;      // 1 for yes, 0 for no  
$title        = '';  
$empty        = 0;

$args = array(
     'taxonomy'     => $taxonomy,
     'orderby'      => $orderby,
     'show_count'   => $show_count,
     'pad_counts'   => $pad_counts,
     'hierarchical' => $hierarchical,
     'title_li'     => $title,
     'hide_empty'   => $empty
);

$all_categories = get_categories( $args );
$cat_list = array();

foreach ($all_categories as $cat) {
	$cat_list[] = array('label' => $cat->name, 'value' => $cat->term_id);
}


// [product_categories_grid]

vc_map(array(
   "name"			=> "Product Categories - Grid",
   "category"		=> 'WooCommerce',
   "description"	=> "",
   "base"			=> "product_categories_grid",
   "class"			=> "",
   "icon"			=> "product_categories_grid",
   //'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
   //'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
   
   "params" 	=> array(
      
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Product Categories",
			"param_name"	=> "product_categories_selection",
			"value"			=> array(
				"Manually Pick Categories"					=> "manual",
				"Display X number of Product Categories"	=> "auto",
			),
			"std"			=> "auto",
		),

		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> false,
			"heading"		=> "Categories Display",
			"param_name"	=> "parent",
			"value"			=> array(
				"Parent Categories Only"				=> "0",
				"Parent Categories + Subcategories"		=> "999"
			),
			"dependency"	=> array(
				"element" 	=> "product_categories_selection",
				"value"		=> array('auto'),
			),
		),

		array(
			"type" 			=> "autocomplete",
			"heading" 		=> "Categories",
			"param_name" 	=> 'ids',
			"settings" 		=> array(
				"multiple" 	=> true,
				"sortable" 	=> true,
				"values"	=> $cat_list,
			),
			"save_always" => true,
			"dependency"	=> array(
				"element" 	=> "product_categories_selection",
				"value"		=> array('manual'),
			)
		),

		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "How many product categories to display?",
			"param_name"	=> "number",
			"value"			=> "",
			"dependency"	=> array(
				"element" 	=> "product_categories_selection",
				"value"		=> array('auto'),
			),
		),

		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> false,
			"heading"		=> "Alphabetical Order",
			"param_name"	=> "order",
			"value"			=> array(
				"Ascending"		=> "asc",
				"Descending"	=> "desc"				
			),
			"dependency"	=> array(
				"element" 	=> "product_categories_selection",
				"value"		=> array('auto'),
			),

		),
		
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class"			=> "hide_in_vc_editor",
			"heading"		=> "Hide Empty",
			"param_name"	=> "hide_empty",
			"value"			=> array(
				"Yes"	=> "1",
				"No"	=> "0"
			),
			"admin_label" 	=> true
		),

		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class"			=> "hide_in_vc_editor",
			"heading"		=> "Show Product Count",
			"param_name"	=> "show_count",
			"value"			=> array(
				"No"	=> "0",
				"Yes"	=> "1"
			),
			"admin_label" 	=> true
		),
   )
   
));