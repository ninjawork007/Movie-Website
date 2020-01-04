<?php
/**
 * Customizer product controls
 *
 * @package shopkeeper
 */

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'radio-image',
     'settings'    => 'product_layout',
     'label'       => esc_attr__( 'Product Page Layout', 'shopkeeper' ),
     'section'     => 'product',
     'default'     => 'default',
     'priority'    => 10,
     'choices'     => array(
             'default'        => get_template_directory_uri() . '/images/theme_options/icons/product_layout_1.png',
             'style_2'        => get_template_directory_uri() . '/images/theme_options/icons/product_layout_2.png',
             'style_3'        => get_template_directory_uri() . '/images/theme_options/icons/product_layout_3.png',
             'style_4'        => get_template_directory_uri() . '/images/theme_options/icons/product_layout_4.png'
         ),
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'custom',
     'default'	  => '<hr />',
     'settings'    => 'separator_' . $sep++,
     'section'     => 'product',
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'radio-image',
     'settings'    => 'product_quantity_style',
     'label'       => esc_attr__( 'Product Quantity Style', 'shopkeeper' ),
     'section'     => 'product',
     'default'     => 'default',
     'priority'    => 10,
     'choices'     => array(
             'default'        => get_template_directory_uri() . '/images/theme_options/icons/product_qty_style_1.png',
             'custom'         => get_template_directory_uri() . '/images/theme_options/icons/product_qty_style_2.png'
         ),
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'custom',
     'default'	  => '<hr />',
     'settings'    => 'separator_' . $sep++,
     'section'     => 'product',
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'toggle',
     'settings'    => 'product_gallery_zoom',
     'label'       => esc_attr__( 'Product Gallery Zoom', 'shopkeeper' ),
     'section'     => 'product',
     'default'     => true,
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'custom',
     'default'	  => '<hr />',
     'settings'    => 'separator_' . $sep++,
     'section'     => 'product',
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'toggle',
     'settings'    => 'product_gallery_lightbox',
     'label'       => esc_attr__( 'Product Gallery Lightbox', 'shopkeeper' ),
     'section'     => 'product',
     'default'     => true,
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'custom',
     'default'	  => '<hr />',
     'settings'    => 'separator_' . $sep++,
     'section'     => 'product',
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'toggle',
     'settings'    => 'related_products',
     'label'       => esc_attr__( 'Related Products', 'shopkeeper' ),
     'section'     => 'product',
     'default'     => true,
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'custom',
     'default'	  => '<hr />',
     'settings'    => 'separator_' . $sep++,
     'section'     => 'product',
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'slider',
     'settings'    => 'related_products_number',
     'label'       => esc_attr__( 'Number of Related Products', 'shopkeeper' ),
     'section'     => 'product',
     'default'     => 4,
     'priority'    => 10,
     'choices'	  =>
         array
         (
             'min'	=> 2,
             'max'	=> 6,
             'step'	=> 1
         ),
     'active_callback'    => array(
         array(
             'setting'  => 'related_products',
             'operator' => '==',
             'value'    => true,
         ),
     ),
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'custom',
     'default'	  => '<hr />',
     'settings'    => 'separator_' . $sep++,
     'section'     => 'product',
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'toggle',
     'settings'    => 'review_tab',
     'label'       => esc_attr__( 'Review Tab', 'shopkeeper' ),
     'section'     => 'product',
     'default'     => true,
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'custom',
     'default'	  => '<hr />',
     'settings'    => 'separator_' . $sep++,
     'section'     => 'product',
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'toggle',
     'settings'    => 'ajax_add_to_cart',
     'label'       => esc_attr__( 'AJAX Add to Cart', 'shopkeeper' ),
     'section'     => 'product',
     'description' => wp_kses( __('<span class="dashicons dashicons-editor-help"></span>The option is available for simple products.<div class="ajax-error"><span class="dashicons dashicons-warning"></span>Functionality turned off automatically due to incompatibility with:<span class="woo-addons">WooCommerce Product Add-Ons</span><span class="m-price-calculator">WC Measurement Price Calculator</span><span class="fields-factory">WC Fields Factory</span></div>', 'shopkeeper'), array( 'span' => array( 'class' => array(), 'div' => array() ) ) ),
     'default'     => true,
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'custom',
     'default'	  => '<hr />',
     'settings'    => 'separator_' . $sep++,
     'section'     => 'product',
     'priority'    => 10,
 ));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'toggle',
    'settings'    => 'disabled_outofstock_variations',
    'label'       => esc_attr__( 'Disable Out of Stock Variations', 'shopkeeper' ),
    'section'     => 'product',
    'default'     => true,
    'description' => wp_kses( __("<span class='dashicons dashicons-editor-help'></span>The variations will be disabled in the attribute's options list.", 'shopkeeper'), array( 'span' => array( 'class' => array() ) ) ),
    'priority'    => 10,
));

?>
