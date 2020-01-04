<?php
/**
 * Customizer shop controls
 *
 * @package shopkeeper
 */

 /* Shop Layout */

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'toggle',
     'settings'    => 'breadcrumbs',
     'label'       => esc_attr__( 'Breadcrumbs', 'shopkeeper' ),
     'section'     => 'shop_layout',
     'default'     => true,
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'custom',
     'default'	  => '<hr />',
     'settings'    => 'separator_' . $sep++,
     'section'     => 'shop_layout',
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'radio-buttonset',
     'settings'    => 'sidebar_style',
     'label'       => esc_html__( 'Sidebar Style', 'shopkeeper' ),
     'section'     => 'shop_layout',
     'default'     => '1',
     'priority'    => 10,
     'choices'	  =>
         array(
             '0'		=> esc_html__('On Page', 'shopkeeper'),
             '1'		=> esc_html__('Off-Canvas', 'shopkeeper')
         )
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'custom',
     'default'	  => '<hr />',
     'settings'    => 'separator_' . $sep++,
     'section'     => 'shop_layout',
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'radio-buttonset',
     'settings'    => 'pagination_shop',
     'label'       => esc_attr__( 'Pagination Style', 'shopkeeper' ),
     'section'     => 'shop_layout',
     'priority'    => 10,
     'choices'	  =>
         array(
             'classic'               => 'Classic',
             'load_more_button'      => 'Load More',
             'infinite_scroll'       => 'Infinite'
         ),
     'default'     => 'infinite_scroll'
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'custom',
     'default'	  => '<hr />',
     'settings'    => 'separator_' . $sep++,
     'section'     => 'shop_layout',
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'radio-buttonset',
     'settings'    => 'category_style',
     'label'       => esc_html__( 'Category Display Style', 'shopkeeper' ),
     'section'     => 'shop_layout',
     'default'     => 'styled_grid',
     'priority'    => 10,
     'choices'	  =>
         array(
             'styled_grid'		=> esc_html__('Categories Grid', 'shopkeeper'),
             'original_grid'		=> esc_html__('Thumbs', 'shopkeeper')
         ),
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'custom',
     'settings'    => 'separator_' . $sep++,
     'section'     => 'shop_layout',
     'default'	  => '<hr />',
     'priority'    => 10,
     'active_callback'    => array(
         array(
             'setting'  => 'category_style',
             'operator' => '==',
             'value'    => 'styled_grid',
         ),
     ),
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'toggle',
     'settings'    => 'categories_grid_count',
     'label'       => esc_attr__( 'Display Number of Products on Categories Grid', 'shopkeeper' ),
     'section'     => 'shop_layout',
     'default'     => true,
     'priority'    => 10,
     'active_callback'    => array(
         array(
             'setting'  => 'category_style',
             'operator' => '==',
             'value'    => 'styled_grid',
         ),
     ),
 ));

/* Product Card */

 Kirki::add_field( 'shopkeeper', array(
     'type'        	=> 'slider',
     'settings'   	=> 'product_title_font_size',
     'label'    	  	=> esc_attr__( 'Product Title Font Size (px)', 'shopkeeper' ),
     'section'     	=> 'product_card',
     'priority'    	=> 10,
     'default'     	=> 12,
     'choices'		=>
         array
         (
             'min' => '10',
             'step' => '1',
             'max' => '24',
         )
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'custom',
     'default'	  => '<hr />',
     'settings'    => 'separator_' . $sep++,
     'section'     => 'product_card',
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'toggle',
     'settings'    => 'second_image_product_listing',
     'label'       => esc_html__( 'Second Product Image on Hover', 'shopkeeper' ),
     'section'     => 'product_card',
     'default'     => true,
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'custom',
     'default'	  => '<hr />',
     'settings'    => 'separator_' . $sep++,
     'section'     => 'product_card',
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'toggle',
     'settings'    => 'ratings_catalog_page',
     'label'       => esc_html__( 'Rating Stars', 'shopkeeper' ),
     'section'     => 'product_card',
     'default'     => true,
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'custom',
     'default'	  => '<hr />',
     'settings'    => 'separator_' . $sep++,
     'section'     => 'product_card',
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'radio-buttonset',
     'settings'    => 'add_to_cart_display',
     'label'       => esc_html__( 'Add to Cart Button Display', 'shopkeeper' ),
     'section'     => 'product_card',
     'default'     => '1',
     'priority'    => 10,
     'choices'	  =>
         array(
             '1'		=> esc_html__('When Hovering', 'shopkeeper'),
             '0'		=> esc_html__('At all Times', 'shopkeeper')
         )
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'custom',
     'default'	  => '<hr />',
     'settings'    => 'separator_' . $sep++,
     'section'     => 'product_card',
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'toggle',
     'settings'    => 'quick_view',
     'label'       => esc_attr__( 'Quick View', 'shopkeeper' ),
     'section'     => 'product_card',
     'default'     => false,
     'priority'    => 10,
 ));

/* Shop Notifications */

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'radio-buttonset',
     'settings'    => 'notification_mode',
     'label'       => esc_html__( 'Notification Style', 'shopkeeper' ),
     'section'     => 'shop_notifications',
     'default'     => '1',
     'priority'    => 10,
     'choices'	  =>
         array(
             '1'		=> esc_html__('Animated', 'shopkeeper'),
             '0'		=> esc_html__('Classic', 'shopkeeper')
         )
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'radio-buttonset',
     'settings'    => 'notification_style',
     'label'       => esc_html__( 'Animation', 'shopkeeper' ),
     'section'     => 'shop_notifications',
     'default'     => '1',
     'priority'    => 10,
     'choices'	  =>
         array(
             '1'		=> esc_html__('Slide Out', 'shopkeeper'),
             '0'		=> esc_html__('Always Visible', 'shopkeeper')
         ),
     'active_callback'    => array(
         array(
             'setting'  => 'notification_mode',
             'operator' => '==',
             'value'    => '1',
         ),
     ),
 ));

/* Product Badges */

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'text',
     'settings'    => 'out_of_stock_label',
     'label'       => esc_html__( 'Out of Stock Label', 'shopkeeper' ),
     'description' => esc_html__('If you\'re using a multi language plugin we recommend leaving the default value.', 'shopkeeper'),
     'section'     => 'product_badges',
     'default'     => 'Out of stock',
     'priority'    => 10
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'text',
     'settings'    => 'sale_label',
     'label'       => esc_html__( 'Sale Label', 'shopkeeper' ),
     'description' => esc_html__('If you\'re using a multi language plugin we recommend leaving the default value.', 'shopkeeper'),
     'section'     => 'product_badges',
     'default'     => 'Sale!',
     'priority'    => 10
 ));

/* Mobile Settings */

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'slider',
     'settings'    => 'mobile_columns',
     'label'       => esc_attr__( 'Number of Columns on Mobile', 'shopkeeper' ),
     'section'     => 'mobile_settings',
     'default'     => 2,
     'priority'    => 10,
     'choices'	  =>
         array(
             'min'	=> 1,
             'max'	=> 2,
             'step'  => 1
         )
 ));

/* Catalog Mode */

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'toggle',
     'settings'    => 'catalog_mode',
     'label'       => esc_attr__( 'Catalog Mode', 'shopkeeper' ),
     'section'     => 'catalog_mode',
     'default'     => false,
     'description' => wp_kses( __('<span class="dashicons dashicons-editor-help"></span>When enabled, the feature Turns Off the shopping functionality of WooCommerce.', 'shopkeeper'), array( 'span' => array( 'class' => array() ) ) ),
     'priority'    => 10,
 ));

?>
