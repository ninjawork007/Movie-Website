<?php
/**
 * Customizer styling controls
 *
 * @package shopkeeper
 */

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'color',
     'settings'    => 'body_color',
     'label'       => esc_attr__( 'Body Text Color', 'shopkeeper' ),
     'section'     => 'styling',
     'default'     => '#545454',
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'custom',
     'default'	  => '<hr />',
     'settings'    => 'separator_' . $sep++,
     'section'     => 'styling',
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'color',
     'settings'    => 'headings_color',
     'label'       => esc_attr__( 'Headings Color', 'shopkeeper' ),
     'section'     => 'styling',
     'default'     => '#000000',
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'custom',
     'default'	  => '<hr />',
     'settings'    => 'separator_' . $sep++,
     'section'     => 'styling',
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'color',
     'settings'    => 'main_color',
     'label'       => esc_attr__( 'Accent Color', 'shopkeeper' ),
     'section'     => 'styling',
     'default'     => '#EC7A5C',
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'custom',
     'default'	  => '<hr />',
     'settings'    => 'separator_' . $sep++,
     'section'     => 'styling',
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'background',
     'settings'    => 'main_background',
     'label'       => esc_attr__( 'Body Background', 'shopkeeper' ),
     'section'     => 'styling',
     'default'     => array('background-color' => '#FFFFFF'),
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'custom',
     'default'	  => '<hr />',
     'settings'    => 'separator_' . $sep++,
     'section'     => 'styling',
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'toggle',
     'settings'    => 'smooth_transition_between_pages',
     'label'       => esc_attr__( 'Smooth Transition Between Pages', 'shopkeeper' ),
     'section'     => 'styling',
     'default'     => 0,
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'custom',
     'default'	  => '<hr />',
     'settings'    => 'separator_' . $sep++,
     'section'     => 'styling',
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'color',
     'settings'    => 'offcanvas_bg_color',
     'label'       => esc_attr__( 'Off-Canvas Background Color', 'shopkeeper' ),
     'section'     => 'styling',
     'default'     => '#ffffff',
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'custom',
     'default'	  => '<hr />',
     'settings'    => 'separator_' . $sep++,
     'section'     => 'styling',
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'color',
     'settings'    => 'offcanvas_headings_color',
     'label'       => esc_attr__( 'Off-Canvas Headings Color', 'shopkeeper' ),
     'section'     => 'styling',
     'default'     => '#000000',
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'custom',
     'default'	  => '<hr />',
     'settings'    => 'separator_' . $sep++,
     'section'     => 'styling',
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'color',
     'settings'    => 'offcanvas_text_color',
     'label'       => esc_attr__( 'Off-Canvas Text Color', 'shopkeeper' ),
     'section'     => 'styling',
     'default'     => '#545454',
     'priority'    => 10,
 ));

?>
