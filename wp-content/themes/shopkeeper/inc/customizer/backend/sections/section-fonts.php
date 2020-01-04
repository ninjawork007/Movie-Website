<?php
/**
 * Customizer fonts controls
 *
 * @package shopkeeper
 */

 Kirki::add_field( 'shopkeeper', array(
     'type'     		=> 'typography',
     'settings' 		=> 'new_main_font',
     'label'    	  	=> esc_attr__( 'Main Font', 'shopkeeper' ),
     'description' 	=> wp_kses( __( '<span class="dashicons dashicons-editor-help"></span>Used for titles and Headings.', 'shopkeeper' ), array( 'span' => array( 'class' => array() ) ) ),
     'section'  		=> 'fonts',
     'priority' 		=> 10,
     'default'     => array(
         'font-family'    => 'NeueEinstellung',
         'variant'        => '500',
         'subsets'        => array( 'latin' ),
     ),
     'output'      => array(
         array(
             'element' => '',
         ),
     ),
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        	=> 'slider',
     'settings'   	=> 'headings_font_size',
     'label'    	  	=> esc_attr__( 'Headings Font Size (px)', 'shopkeeper' ),
     'section'     	=> 'fonts',
     'priority'    	=> 10,
     'default'     	=> 23,
     'choices'		=>
         array
         (
             'min' => '16',
             'step' => '1',
             'max' => '40',
         )
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'custom',
     'default'	  => '<hr />',
     'settings'    => 'separator_' . $sep++,
     'section'     => 'fonts',
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        	=> 'typography',
     'settings'    	=> 'new_secondary_font',
     'label'       	=> esc_attr__( 'Secondary Font', 'shopkeeper' ),
     'section'  	  	=> 'fonts',
     'priority'    	=> 10,
     'default'     => array(
         'font-family'    => 'Radnika',
     ),
     'output'      => array(
         array(
             'element' => '',
         ),
     ),
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        	=> 'slider',
     'settings'   	=> 'body_font_size',
     'label'    	  	=> esc_attr__( 'Body Font Size (px)', 'shopkeeper' ),
     'section'     	=> 'fonts',
     'priority'    	=> 10,
     'default'     	=> 16,
     'choices'		=>
         array
         (
             'min' => '12',
             'step' => '1',
             'max' => '20',
         )
 ));

?>
