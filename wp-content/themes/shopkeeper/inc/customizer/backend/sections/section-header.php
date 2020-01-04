<?php
/**
 * Customizer header controls
 *
 * @package shopkeeper
 */


/* Header Styles */

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'radio-image',
    'settings'    => 'main_header_layout',
    'label'       => esc_attr__( 'Header Layout', 'shopkeeper' ),
    'section'     => 'header_style',
    'default'     => '1',
    'priority'    => 10,
    'choices'     => array(
            '1'         => get_template_directory_uri() . '/images/theme_options/icons/header_1.png',
            '11'        => get_template_directory_uri() . '/images/theme_options/icons/header_1b.png',
            '2'         => get_template_directory_uri() . '/images/theme_options/icons/header_2.png',
            '22'        => get_template_directory_uri() . '/images/theme_options/icons/header_2b.png',
            '3'         => get_template_directory_uri() . '/images/theme_options/icons/header_3.png',
        ),
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'custom',
    'default'	  => '<hr />',
    'settings'    => 'separator_' . $sep++,
    'section'     => 'header_style',
    'priority'    => 10,
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'slider',
    'settings'    => 'main_header_font_size',
    'label'       => esc_attr__( 'Navigation Font Size', 'shopkeeper' ),
    'section'     => 'header_style',
    'default'     => 13,
    'choices'     => array(
            'min'  => 11,
            'max'  => 16,
            'step' => 1,
        ),
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'color',
    'settings'    => 'main_header_font_color',
    'label'       => esc_attr__( 'Navigation Font Color', 'shopkeeper' ),
    'section'     => 'header_style',
    'default'     => '#000',
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'custom',
    'default'	  => '<hr />',
    'settings'    => 'separator_' . $sep++,
    'section'     => 'header_style',
    'priority'    => 10,
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'background',
    'settings'    => 'main_header_background',
    'label'       => esc_attr__( 'Header Background Color', 'shopkeeper' ),
    'section'     => 'header_style',
    'default'	  => array('background-color' => '#FFFFFF'),
    'priority'    => 10,
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'custom',
    'default'	  => '<hr />',
    'settings'    => 'separator_' . $sep++,
    'section'     => 'header_style',
    'priority'    => 10,
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'slider',
    'settings'    => 'spacing_above_logo',
    'label'       => esc_html__( 'Spacing Above the Logo', 'shopkeeper' ),
    'section'     => 'header_style',
    'default'     => 20,
    'priority'    => 10,
    'choices'     => array(
        'min'  => 0,
        'max'  => 200,
        'step' => 1,
    ),
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'slider',
    'settings'    => 'spacing_below_logo',
    'label'       => esc_html__( 'Spacing Below the Logo', 'shopkeeper' ),
    'section'     => 'header_style',
    'default'     => 20,
    'priority'    => 10,
    'choices'     => array(
            'min'  => 0,
            'max'  => 200,
            'step' => 1,
        ),
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'custom',
    'default'	  => '<hr />',
    'settings'    => 'separator_' . $sep++,
    'section'     => 'header_style',
    'priority'    => 10,
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'header_width',
    'label'       => esc_html__( 'Header Width', 'shopkeeper' ),
    'section'     => 'header_style',
    'default'     => 'custom',
    'priority'    => 10,
    'choices'     => array(
            'full'  => 'Full',
            'custom'    => 'Custom',
        ),
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'slider',
    'settings'    => 'header_max_width',
    'label'       => esc_html__( 'Custom Max Width', 'shopkeeper' ),
    'section'     => 'header_style',
    'default'     => 1680,
    'priority'    => 10,
    'choices'     => array(
            'min'  => 960,
            'max'  => 1680,
            'step' => 1,
        ),
    'active_callback'    => array(
        array(
            'setting'  => 'header_width',
            'operator' => '==',
            'value'    => 'custom',
        ),
    ),
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'collapsible',
    'label'		  => 'Header Transparency',
    'settings'    => 'main_header_transparency_collapsible',
    'slug'    	  => 'main_header_transparency_collapsible',
    'section'     => 'header_style',
    'priority'    => 10,
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'toggle',
    'settings'    => 'main_header_transparency',
    'label'       => esc_attr__( 'Transparent Header', 'shopkeeper' ),
    'section'     => 'header_style',
    'default'     => false,
    'description' => '<span class="dashicons dashicons-editor-help"></span><a target="_blank" href="https://shopkeeper.wp-theme.help/hc/en-us/articles/206678899">Working with Header Transparency</a>',
    'priority'    => 10,
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'main_header_transparency_scheme',
    'label'       => esc_attr__( 'Default Transparency Color Scheme', 'shopkeeper' ),
    'section'     => 'header_style',
    'default'     => 'transparency_light',
    'priority'    => 10,
    'choices'     => array(
            'transparency_light'    => 'Light Transparency',
            'transparency_dark'     => 'Dark Transparency',
        ),
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'collapsible',
    'label'		  => 'Light Transparency Scheme',
    'settings'    => 'main_header_transparent_light_collapsible',
    'slug'    	  => 'main_header_transparent_light_collapsible',
    'section'     => 'header_style',
    'priority'    => 10,
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'color',
    'settings'    => 'main_header_transparent_light_color',
    'label'       => esc_attr__( 'Text / Icon Color', 'shopkeeper' ),
    'section'     => 'header_style',
    'default'     => '#fff',
    'priority'    => 10,
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'image',
    'settings'    => 'light_transparent_header_logo',
    'label'       => esc_attr__( 'Logo Light', 'shopkeeper' ),
    'section'     => 'header_style',
    'default'     => '',
    'priority'    => 10,
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'collapsible',
    'label'		  => 'Dark Transparency Scheme',
    'settings'    => 'main_header_transparent_dark_collapsible',
    'slug'    	  => 'main_header_transparent_dark_collapsible',
    'section'     => 'header_style',
    'priority'    => 10,
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'color',
    'settings'    => 'main_header_transparent_dark_color',
    'label'       => esc_attr__( 'Text / Icon Color', 'shopkeeper' ),
    'section'     => 'header_style',
    'default'     => '#000',
    'priority'    => 10,
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'image',
    'settings'    => 'dark_transparent_header_logo',
    'label'       => esc_attr__( 'Logo Dark', 'shopkeeper' ),
    'section'     => 'header_style',
    'default'     => '',
    'priority'    => 10,
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'collapsible',
    'label'		  => 'Product Categories Transparency',
    'settings'    => 'main_product_categories_transparency_collapsible',
    'slug'    	  => 'main_product_categories_transparency_collapsible',
    'section'     => 'header_style',
    'priority'    => 10,
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'shop_category_header_transparency_scheme',
    'label'       => esc_attr__( 'Product Categories Transparency', 'shopkeeper' ),
    'section'     => 'header_style',
    'default'     => 'no_transparency',
    'priority'    => 10,
    'choices'     => array(
            'inherit'               => 'Same as Above',
            'no_transparency'       => 'No Transparency',
            'transparency_light'    => 'Light Transparency',
            'transparency_dark'     => 'Dark Transparency',
        ),
));

/* Header Elements */

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'collapsible',
    'label'		  => 'Wishlist',
    'settings'    => 'header_wishlist_collapsible',
    'slug'    	  => 'header_wishlist_collapsible',
    'section'     => 'header_elements',
    'priority'    => 10,
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'toggle',
    'settings'    => 'main_header_wishlist',
    'label'       => esc_attr__( 'Wishlist Icon', 'shopkeeper' ),
    'section'     => 'header_elements',
    'description' => '<span class="dashicons dashicons-editor-help"></span>Requires the <a target="_blank" href="https://wordpress.org/plugins/yith-woocommerce-wishlist/">YITH WooCommerce Wishlist</a> plugin.',
    'default'     => true,
    'priority'    => 10,
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'custom',
    'default'	  => '<hr />',
    'settings'    => 'separator_' . $sep++,
    'section'     => 'header_elements',
    'priority'    => 10,
    'active_callback'    => array(
        array(
            'setting'  => 'main_header_wishlist',
            'operator' => '==',
            'value'    => true,
        )
    ),
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'image',
    'settings'    => 'main_header_wishlist_icon',
    'label'       => esc_html__( 'Custom Wishlist Icon', 'shopkeeper' ),
    'section'     => 'header_elements',
    'default'     => '',
    'priority'    => 10,
    'active_callback'    => array(
        array(
            'setting'  => 'main_header_wishlist',
            'operator' => '==',
            'value'    => true,
        ),
    ),
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'collapsible',
    'label'		  => 'Shopping Cart',
    'settings'    => 'header_shopping_cart_collapsible',
    'slug'    	  => 'header_shopping_cart_collapsible',
    'section'     => 'header_elements',
    'priority'    => 10,
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'toggle',
    'settings'    => 'main_header_shopping_bag',
    'label'       => esc_attr__( 'Shopping Cart Icon', 'shopkeeper' ),
    'section'     => 'header_elements',
    'default'     => true,
    'priority'    => 10,
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'custom',
    'default'	  => '<hr />',
    'settings'    => 'separator_' . $sep++,
    'section'     => 'header_elements',
    'priority'    => 10,
    'active_callback'    => array(
        array(
            'setting'  => 'main_header_shopping_bag',
            'operator' => '==',
            'value'    => true,
        )
    ),
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'image',
    'settings'    => 'main_header_shopping_bag_icon',
    'label'       => esc_html__( 'Custom Shopping Cart Icon', 'shopkeeper' ),
    'section'     => 'header_elements',
    'default'     => '',
    'priority'    => 10,
    'active_callback'    => array(
        array(
            'setting'  => 'main_header_shopping_bag',
            'operator' => '==',
            'value'    => true,
        ),
    ),
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'custom',
    'default'	  => '<hr />',
    'settings'    => 'separator_' . $sep++,
    'section'     => 'header_elements',
    'priority'    => 10,
    'active_callback'    => array(
        array(
            'setting'  => 'main_header_shopping_bag',
            'operator' => '==',
            'value'    => true,
        )
    ),
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'option_minicart',
    'label'       => esc_attr__( 'Cart Icon Function', 'shopkeeper' ),
    'section'     => 'header_elements',
    'default'     => '1',
    'priority'    => 10,
    'choices'     => array(
            '1'     => esc_attr__( 'Mini Cart', 'shopkeeper' ),
            '2'     => esc_attr__( 'Link', 'shopkeeper' ),
        ),
    'active_callback'    => array(
        array(
            'setting'  => 'main_header_shopping_bag',
            'operator' => '==',
            'value'    => true,
        ),
    ),
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'option_minicart_open',
    'label'       => esc_attr__( 'Open Mini Cart On', 'shopkeeper' ),
    'section'     => 'header_elements',
    'default'     => '1',
    'priority'    => 10,
    'choices'     => array(
            '1'     => esc_attr__( 'Click', 'shopkeeper' ),
            '2'     => esc_attr__( 'Hover', 'shopkeeper' ),
        ),
    'active_callback'    => array(
        array(
            'setting'  => 'option_minicart',
            'operator' => '==',
            'value'    => '1',
        ),
    ),
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'text',
    'settings'    => 'main_header_minicart_message',
    'label'       => esc_attr__( 'Mini Cart Message', 'shopkeeper' ),
    'section'     => 'header_elements',
    'default'     => '',
    'priority'    => 10,
    'active_callback'    => array(
        array(
            'setting'  => 'main_header_shopping_bag',
            'operator' => '==',
            'value'    => true,
        ),
        array(
            'setting'  => 'option_minicart',
            'operator' => '==',
            'value'    => '1',
        ),
    ),
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'collapsible',
    'label'		  => 'My Account',
    'settings'    => 'header_my_account_collapsible',
    'slug'    	  => 'header_my_account_collapsible',
    'section'     => 'header_elements',
    'priority'    => 10,
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'toggle',
    'settings'    => 'my_account_icon_state',
    'label'       => esc_attr__( 'My Account Icon', 'shopkeeper' ),
    'section'     => 'header_elements',
    'default'     => true,
    'priority'    => 10,
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'custom',
    'settings'    => 'separator_' . $sep++,
    'default'	  => '<hr />',
    'section'     => 'header_elements',
    'priority'    => 10,
    'active_callback'    => array(
        array(
            'setting'  => 'my_account_icon_state',
            'operator' => '==',
            'value'    => true,
        )
    ),
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'image',
    'settings'    => 'custom_my_account_icon',
    'label'       => esc_html__( 'Custom My Account Icon', 'shopkeeper' ),
    'section'     => 'header_elements',
    'default'     => '',
    'priority'    => 10,
    'active_callback'    => array(
        array(
            'setting'  => 'my_account_icon_state',
            'operator' => '==',
            'value'    => true,
        ),
    ),
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'collapsible',
    'label'		  => 'Search',
    'settings'    => 'header_search_collapsible',
    'slug'    	  => 'header_search_collapsible',
    'section'     => 'header_elements',
    'priority'    => 10,
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'toggle',
    'settings'    => 'main_header_search_bar',
    'label'       => esc_attr__( 'Search Icon', 'shopkeeper' ),
    'section'     => 'header_elements',
    'default'     => true,
    'priority'    => 10,
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'custom',
    'settings'    => 'separator_' . $sep++,
    'default'	  => '<hr />',
    'section'     => 'header_elements',
    'priority'    => 10,
    'active_callback'    => array(
        array(
            'setting'  => 'main_header_search_bar',
            'operator' => '==',
            'value'    => true,
        )
    ),
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'image',
    'settings'    => 'main_header_search_bar_icon',
    'label'       => esc_html__( 'Custom Search Icon', 'shopkeeper' ),
    'section'     => 'header_elements',
    'default'     => '',
    'priority'    => 10,
    'active_callback'    => array(
        array(
            'setting'  => 'main_header_search_bar',
            'operator' => '==',
            'value'    => true,
        ),
    ),
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'collapsible',
    'label'		  => 'Off-Canvas Drawer',
    'settings'    => 'header_offcanvas_collapsible',
    'slug'    	  => 'header_offcanvas_collapsible',
    'section'     => 'header_elements',
    'priority'    => 10,
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'toggle',
    'settings'    => 'main_header_off_canvas',
    'label'       => esc_attr__( 'Off-Canvas Drawer', 'shopkeeper' ),
    'section'     => 'header_elements',
    'default'     => false,
    'priority'    => 10,
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'custom',
    'settings'    => 'separator_' . $sep++,
    'default'	  => '<hr />',
    'section'     => 'header_elements',
    'priority'    => 10,
    'active_callback'    => array(
        array(
            'setting'  => 'main_header_off_canvas',
            'operator' => '==',
            'value'    => true,
        )
    ),
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'image',
    'settings'    => 'main_header_off_canvas_icon',
    'label'       => esc_html__( 'Custom Off-Canvas Icon', 'shopkeeper' ),
    'section'     => 'header_elements',
    'default'     => '',
    'priority'    => 10,
    'active_callback'    => array(
        array(
            'setting'  => 'main_header_off_canvas',
            'operator' => '==',
            'value'    => true,
        ),
    ),
));

/* Header Logo */

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'image',
    'settings'    => 'site_logo',
    'label'       => esc_html__( 'Your Logo', 'shopkeeper' ),
    'section'     => 'header_logo',
    'priority'    => 10,
    'default'	  => get_template_directory_uri() . '/images/shopkeeper-logo.png',
    'description' => wp_kses( __( '<span class="dashicons dashicons-editor-help"></span>Applied on Non-Transparent Headers. To upload a logo for a Tansparent Background go to <strong>Header Layout & Style</strong> section.', 'shopkeeper' ), array( 'span' => array( 'class' => array() ), 'strong' => array() )),
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'custom',
    'default'	  => '<hr />',
    'settings'    => 'separator_' . $sep++,
    'section'     => 'header_logo',
    'priority'    => 10,
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'image',
    'settings'    => 'sticky_header_logo',
    'label'       => esc_html__( 'Alternative Logo', 'shopkeeper' ),
    'section'     => 'header_logo',
    'priority'    => 10,
    'default'	  => get_template_directory_uri() . '/images/shopkeeper-logo.png',
    'description' => wp_kses( __('<span class="dashicons dashicons-editor-help"></span>Used on the <strong>Sticky Header</strong> and <strong>Mobile Devices</strong>.', 'shopkeeper' ), array( 'span' => array( 'class' => array() ), 'strong' => array() )),
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'custom',
    'default'	  => '<hr />',
    'settings'    => 'separator_' . $sep++,
    'section'     => 'header_logo',
    'priority'    => 10,
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'slider',
    'settings'    => 'logo_min_height',
    'label'       => esc_html__( 'Logo Container Min Width', 'shopkeeper' ),
    'section'     => 'header_logo',
    'priority'    => 10,
    'default'	  => 50,
    'choices'     => array(
            'min'  => 0,
            'max'  => 600,
            'step' => 1,
        ),
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'slider',
    'settings'    => 'logo_height',
    'label'       => esc_html__( 'Logo Container Height', 'shopkeeper' ),
    'section'     => 'header_logo',
    'priority'    => 10,
    'default'	  => 50,
    'choices'     => array(
            'min'  => 0,
            'max'  => 300,
            'step' => 1,
        ),
));

/* Top Bar */

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'toggle',
    'settings'    => 'top_bar_switch',
    'label'       => esc_attr__( 'Top Bar', 'shopkeeper' ),
    'section'     => 'top_bar',
    'default'     => false,
    'priority'    => 10,
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'custom',
    'default'	  => '<hr />',
    'settings'    => 'separator_' . $sep++,
    'section'     => 'top_bar',
    'priority'    => 10,
    'active_callback'    => array(
        array(
            'setting'  => 'top_bar_switch',
            'operator' => '==',
            'value'    => true,
        )
    ),
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'color',
    'settings'    => 'top_bar_background_color',
    'label'       => esc_attr__( 'Top Bar Background Color', 'shopkeeper' ),
    'section'     => 'top_bar',
    'default'     => '#333333',
    'priority'    => 10,
    'choices'     => array(
        'alpha' => true,
    ),
    'active_callback'    => array(
        array(
            'setting'  => 'top_bar_switch',
            'operator' => '==',
            'value'    => true,
        ),
    ),
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'custom',
    'default'	  => '<hr />',
    'settings'    => 'separator_' . $sep++,
    'section'     => 'top_bar',
    'priority'    => 10,
    'active_callback'    => array(
        array(
            'setting'  => 'top_bar_switch',
            'operator' => '==',
            'value'    => true,
        )
    ),
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'color',
    'settings'    => 'top_bar_typography',
    'label'       => esc_attr__( 'Top Bar Text Color', 'shopkeeper' ),
    'section'     => 'top_bar',
    'default'     => '#fff',
    'priority'    => 10,
    'active_callback'    => array(
        array(
            'setting'  => 'top_bar_switch',
            'operator' => '==',
            'value'    => true,
        ),
    ),
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'custom',
    'default'	  => '<hr />',
    'settings'    => 'separator_' . $sep++,
    'section'     => 'top_bar',
    'priority'    => 10,
    'active_callback'    => array(
        array(
            'setting'  => 'top_bar_switch',
            'operator' => '==',
            'value'    => true,
        )
    ),
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'text',
    'settings'    => 'top_bar_text',
    'label'       => esc_attr__( 'Top Bar Text', 'shopkeeper' ),
    'section'     => 'top_bar',
    'default' 	  => 'Free Shipping on All Orders Over $75!',
    'priority'    => 10,
    'active_callback'    => array(
        array(
            'setting'  => 'top_bar_switch',
            'operator' => '==',
            'value'    => true,
        ),
    ),
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'custom',
    'default'	  => '<hr />',
    'settings'    => 'separator_' . $sep++,
    'section'     => 'top_bar',
    'priority'    => 10,
    'active_callback'    => array(
        array(
            'setting'  => 'top_bar_switch',
            'operator' => '==',
            'value'    => true,
        )
    ),
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'top_bar_navigation_position',
    'label'       => esc_attr__( 'Top Bar Navigation Position', 'shopkeeper' ),
    'section'     => 'top_bar',
    'default' 	  => 'right',
    'priority'    => 10,
    'choices'	  =>
        array(
            'left' 		=> 'Left',
            'right' 	=> 'Right'
        ),
    'active_callback'    => array(
        array(
            'setting'  => 'top_bar_switch',
            'operator' => '==',
            'value'    => true,
        ),
    ),
));

/* Sticky Header */

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'toggle',
    'settings'    => 'sticky_header',
    'label'       => esc_attr__( 'Sticky Header', 'shopkeeper' ),
    'section'     => 'sticky_header',
    'default'     => true,
    'priority'    => 10,
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'custom',
    'default'	  => '<hr />',
    'settings'    => 'separator_' . $sep++,
    'section'     => 'sticky_header',
    'priority'    => 10,
    'active_callback'    => array(
        array(
            'setting'  => 'sticky_header',
            'operator' => '==',
            'value'    => true,
        )
    ),
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'color',
    'settings'    => 'sticky_header_background_color',
    'label'       => esc_attr__( 'Sticky Header Background Color', 'shopkeeper' ),
    'section'     => 'sticky_header',
    'default'     => '#fff',
    'priority'    => 10,
    'active_callback'    => array(
        array(
            'setting'  => 'sticky_header',
            'operator' => '==',
            'value'    => true,
        ),
    ),
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'custom',
    'default'	  => '<hr />',
    'settings'    => 'separator_' . $sep++,
    'section'     => 'sticky_header',
    'priority'    => 10,
    'active_callback'    => array(
        array(
            'setting'  => 'sticky_header',
            'operator' => '==',
            'value'    => true,
        )
    ),
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'color',
    'settings'    => 'sticky_header_color',
    'label'       => esc_attr__( 'Sticky Header Color', 'shopkeeper' ),
    'section'     => 'sticky_header',
    'default'     => '#000',
    'priority'    => 10,
    'active_callback'    => array(
        array(
            'setting'  => 'sticky_header',
            'operator' => '==',
            'value'    => true,
        ),
    ),
));

/* Predictive Search */

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'toggle',
    'settings'    => 'predictive_search',
    'label'       => esc_attr__( 'Predictive Search', 'shopkeeper' ),
    'section'     => 'search',
    'default'     => true,
    'priority'    => 10,
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'custom',
    'settings'    => 'separator_' . $sep++,
    'default'	  => '<hr />',
    'section'     => 'search',
    'priority'    => 10,
    'active_callback'    => array(
        array(
            'setting'  => 'predictive_search',
            'operator' => '==',
            'value'    => true,
        ),
    ),
));

Kirki::add_field( 'shopkeeper', array(
    'type'        => 'toggle',
    'settings'    => 'search_in_titles',
    'label'       => esc_attr__( 'Search Only in Product Titles', 'shopkeeper' ),
    'section'     => 'search',
    'default'     => false,
    'priority'    => 10,
    'active_callback'    => array(
        array(
            'setting'  => 'predictive_search',
            'operator' => '==',
            'value'    => true,
        ),
    ),
));

?>
