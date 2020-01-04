<?php


function getbowtied_theme_register_required_plugins() {

  if (!class_exists('GetBowtied_Tools')):
  $plugins = array(
      'woocommerce' => array(
        'name'               => 'WooCommerce',
        'slug'               => 'woocommerce',
        'required'           => false,
        'description'        => 'The eCommerce engine of your WordPress site.',
        'demo_required'      => true
      ),
      'js_composer' => array(
          'name'               => 'WPBakery Page Builder',
          'slug'               => 'js_composer',
          'source'             => get_template_directory() . '/inc/plugins/js_composer.zip',
          'required'           => false,
          'external_url'       => '',
          'description'        => 'The page builder plugin coming with the theme.',
          'demo_required'      => true,
          'version'            => '6.0.5'
      ),
      'one-click-demo-import'=> array(
        'name'               => 'One Click Demo Import',
        'slug'               => 'one-click-demo-import',
        'required'           => false,
        'description'        => 'Adds easy-to-use demo import functionality.',
        'demo_required'      => true
      ),
      'envato-market'        => array(
        'name'               => 'Envato Market',
        'slug'               => 'envato-market',
        'required'           => false,
        'source'             => 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
        'description'        => 'Enables updates for all your Envato purchases.',
        'demo_required'      => false,
      ),
      'shopkeeper-extender'  => array(
        'name'               => 'Shopkeeper Extender',
        'slug'               => 'shopkeeper-extender',
        'source'             => 'https://github.com/getbowtied/shopkeeper-extender/zipball/master',
        'required'           => true,
        'external_url'       => 'https://github.com/getbowtied/shopkeeper-extender',
        'description'        => 'Extends the functionality of Shopkeeper with theme-specific features.',
        'demo_required'      => true,
      ),
      'hookmeup'             => array(
        'name'               => 'HookMeUp – Additional Content for WooCommerce',
        'slug'               => 'hookmeup',
        'required'           => false,
        'description'        => 'Customize WooCommerce templates without coding.',
        'demo_required'      => false
      ),
      'yith-woocommerce-wishlist' => array(
        'name'               => 'YITH Wishlist',
        'slug'               => 'yith-woocommerce-wishlist',
        'required'           => false,
        'description'        => 'Extends WooCommerce by adding Wishlist functionality.',
        'demo_required'      => false,
      ),
      'shopkeeper-deprecated' => array(
        'name'                => 'Shopkeeper Deprecated Features',
        'slug'                => 'shopkeeper-deprecated',
        'source'             => 'https://github.com/getbowtied/shopkeeper-deprecated/zipball/master',
        'required'            => false,
        'external_url'       => 'https://github.com/getbowtied/shopkeeper-deprecated',
        'description'         => 'Old features of Shopkeeper that are no longer used.',
        'demo_required'       => false,
      ),
      'shopkeeper-portfolio ' => array(
        'name'                => 'Shopkeeper Portfolio Addon',
        'slug'                => 'shopkeeper-portfolio',
        'source'              => 'https://github.com/getbowtied/shopkeeper-portfolio/zipball/master',
        'required'            => false,
        'external_url'        => 'https://github.com/getbowtied/shopkeeper-portfolio',
        'description'         => 'Extends the functionality of Shopkeeper by adding a "Portfolio" custom post type.',
        'demo_required'       => true,
      ),
    );
  else: 
     $plugins = array(
      'woocommerce' => array(
        'name'               => 'WooCommerce',
        'slug'               => 'woocommerce',
        'required'           => false,
        'description'        => 'The eCommerce engine of your WordPress site.',
        'demo_required'      => true
      ),
      'js_composer' => array(
        'name'               => 'WPBakery Page Builder',
        'slug'               => 'js_composer',
        'source'             => get_template_directory() . '/inc/plugins/js_composer.zip',
        'required'           => false,
        'external_url'       => '',
        'description'        => 'The page builder plugin coming with the theme.',
        'demo_required'      => true,
        'version'            => '6.0.3'
      ),
      'shopkeeper-extender'  => array(
        'name'               => 'Shopkeeper Extender',
        'slug'               => 'shopkeeper-extender',
        'source'             => 'https://github.com/getbowtied/shopkeeper-extender/zipball/master',
        'required'           => true,
        'external_url'       => 'https://github.com/getbowtied/shopkeeper-extender',
        'description'        => 'Extends the functionality of Shopkeeper with theme-specific features.',
        'demo_required'      => true,
      ),
      'hookmeup'             => array(
        'name'               => 'HookMeUp – Additional Content for WooCommerce',
        'slug'               => 'hookmeup',
        'required'           => false,
        'description'        => 'Customize WooCommerce templates without coding.',
        'demo_required'      => false
      ),
      'yith-woocommerce-wishlist' => array(
        'name'               => 'YITH Wishlist',
        'slug'               => 'yith-woocommerce-wishlist',
        'required'           => false,
        'description'        => 'Extends WooCommerce by adding Wishlist functionality.',
        'demo_required'      => false,
      ),
      'shopkeeper-deprecated' => array(
        'name'                => 'Shopkeeper Deprecated Features',
        'slug'                => 'shopkeeper-deprecated',
        'source'             => 'https://github.com/getbowtied/shopkeeper-deprecated/zipball/master',
        'required'            => false,
        'external_url'       => 'https://github.com/getbowtied/shopkeeper-deprecated',
        'description'         => 'Old features of Shopkeeper that are no longer used.',
        'demo_required'       => false,
      ),
      'shopkeeper-portfolio ' => array(
        'name'                => 'Shopkeeper Portfolio Addon',
        'slug'                => 'shopkeeper-portfolio',
        'source'              => 'https://github.com/getbowtied/shopkeeper-portfolio/zipball/master',
        'required'            => false,
        'external_url'        => 'https://github.com/getbowtied/shopkeeper-portfolio',
        'description'         => 'Extends the functionality of Shopkeeper by adding a "Portfolio" custom post type.',
        'demo_required'       => true,
      ),
    );
    endif;

  $config = array(
    'id'               => 'getbowtied',
    'default_path'      => '',
    'parent_slug'       => 'themes.php',
    'menu'              => 'tgmpa-install-plugins',
    'has_notices'       => true,
    'is_automatic'      => false,
  );

  tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', 'getbowtied_theme_register_required_plugins' );


