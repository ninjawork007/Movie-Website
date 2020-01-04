<?php
/**
 * Customizer blog controls
 *
 * @package shopkeeper
 */

 /* Blog Archive */

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'radio-image',
     'settings'    => 'layout_blog',
     'label'       => esc_attr__( 'Blog Layout', 'shopkeeper' ),
     'section'     => 'blog_archive',
     'default'     => 'layout-3',
     'priority'    => 10,
     'choices'     => array(
             'layout-1'        => get_template_directory_uri() . '/images/theme_options/icons/blog_layout_1.png',
             'layout-2'        => get_template_directory_uri() . '/images/theme_options/icons/blog_layout_2.png',
             'layout-3'        => get_template_directory_uri() . '/images/theme_options/icons/blog_layout_3.png'
         ),
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'custom',
     'default'	  => '<hr />',
     'settings'    => 'separator_' . $sep++,
     'section'     => 'blog_archive',
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'toggle',
     'settings'    => 'sidebar_blog_listing',
     'label'       => esc_attr__( 'Blog Sidebar', 'shopkeeper' ),
     'section'     => 'blog_archive',
     'default'     => false,
     'description' => '<span class="dashicons dashicons-editor-help"></span>Only available for Blog Layout 1 and 2 and Single Posts.',
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'custom',
     'default'	  => '<hr />',
     'settings'    => 'separator_' . $sep++,
     'section'     => 'blog_archive',
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'radio-buttonset',
     'settings'    => 'pagination_blog',
     'label'       => esc_attr__( 'Blog Pagination Style', 'shopkeeper' ),
     'section'     => 'blog_archive',
     'default'     => 'infinite_scroll',
     'priority'    => 10,
     'choices'     => array(
             'classic'               	=> 'Classic',
             'load_more_button'          => 'Load More',
             'infinite_scroll'           => 'Infinite'
         ),
 ));

/* Single Post */

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'slider',
     'settings'    => 'single_post_width',
     'label'       => esc_html__( 'Content Width', 'shopkeeper' ),
     'section'     => 'single_post',
     'description' => esc_html__( 'Available for single posts without sidebar.', 'shopkeeper' ),
     'default'     => 708,
     'priority'    => 10,
     'choices'     => array(
             'min'  => 708,
             'max'  => 960,
             'step' => 1,
         ),
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'custom',
     'default'	  => '<hr />',
     'settings'    => 'separator_' . $sep++,
     'section'     => 'single_post',
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'toggle',
     'settings'    => 'post_meta_author',
     'label'       => esc_attr__( 'Author', 'shopkeeper' ),
     'section'     => 'single_post',
     'default'     => true,
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'custom',
     'default'	  => '<hr />',
     'settings'    => 'separator_' . $sep++,
     'section'     => 'single_post',
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'toggle',
     'settings'    => 'post_meta_date',
     'label'       => esc_attr__( 'Date', 'shopkeeper' ),
     'section'     => 'single_post',
     'default'     => true,
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'custom',
     'default'	  => '<hr />',
     'settings'    => 'separator_' . $sep++,
     'section'     => 'single_post',
     'priority'    => 10,
 ));

 Kirki::add_field( 'shopkeeper', array(
     'type'        => 'toggle',
     'settings'    => 'post_meta_categories',
     'label'       => esc_attr__( 'Categories', 'shopkeeper' ),
     'section'     => 'single_post',
     'default'     => true,
     'priority'    => 10,
 ));

?>
