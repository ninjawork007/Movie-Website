<?php
/**
 * Customizer footer controls
 *
 * @package shopkeeper
 */

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'color',
    'settings'    => 'footer_background_color',
    'label'       => esc_attr__( 'Footer Background Color', 'shopkeeper' ),
    'section'     => 'footer',
    'default'     => '#f4f4f4',
    'priority'    => 10,
    'choices'	  =>
        array(
            'alpha'		=> true
        )
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'custom',
    'default'	  => '<hr />',
    'settings'    => 'separator_' . $sep++,
    'section'     => 'footer',
    'priority'    => 10,
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'color',
    'settings'    => 'footer_texts_color',
    'label'       => esc_attr__( 'Footer Text', 'shopkeeper' ),
    'section'     => 'footer',
    'default'     => '#868686',
    'priority'    => 10,
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'custom',
    'default'	  => '<hr />',
    'settings'    => 'separator_' . $sep++,
    'section'     => 'footer',
    'priority'    => 10,
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'color',
    'settings'    => 'footer_links_color',
    'label'       => esc_attr__( 'Footer Links', 'shopkeeper' ),
    'section'     => 'footer',
    'default'     => '#000',
    'priority'    => 10,
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'custom',
    'default'	  => '<hr />',
    'settings'    => 'separator_' . $sep++,
    'section'     => 'footer',
    'priority'    => 10,
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'textarea',
    'settings'    => 'footer_copyright_text',
    'label'       => esc_attr__( 'Copyright Footnote', 'shopkeeper' ),
    'section'     => 'footer',
    'default' 	  => 'Shopkeeper - eCommerce WP Theme',
    'priority'    => 10,
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'custom',
    'default'	  => '<hr />',
    'settings'    => 'separator_' . $sep++,
    'section'     => 'footer',
    'priority'    => 10,
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'toggle',
    'settings'    => 'expandable_footer',
    'label'       => esc_attr__( 'Collapsed Widget Area on Mobiles', 'shopkeeper' ),
    'section'     => 'footer',
    'default'     => true,
    'priority'    => 10,
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'custom',
    'default'	  => '<hr />',
    'settings'    => 'separator_' . $sep++,
    'section'     => 'footer',
    'priority'    => 10,
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'toggle',
    'settings'    => 'back_to_top_button',
    'label'       => esc_attr__( 'Back To Top Button', 'shopkeeper' ),
    'section'     => 'footer',
    'default'     => false,
    'priority'    => 10,
));

?>
