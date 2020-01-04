<?php 
function ocdi_import_files() {
  return array(
    array(
      'import_file_name'             => 'Default',
      // 'categories'                   => array( 'Category 1', 'Category 2' ),
      'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/demo/shopkeeper.wordpress.xml',
      // 'import_preview_image_url'     => 'http://import.getbowtied.com/shopkeeper-v2/wp-content/themes/shopkeeper/screenshot.png',
      //'import_notice'                => '',
      // 'preview_url'                  => 'http://import.getbowtied.com/shopkeeper-v2/',
    ),
  );
}
add_filter( 'pt-ocdi/import_files', 'ocdi_import_files' );

function ocdi_after_import_setup() {
    function set_reading_options( $settings ) {
      $reading_settings = $settings['reading_settings'];
      if ( ! empty( $reading_settings ) ) {
        $homepage   = get_page_by_title( html_entity_decode( $reading_settings['homepage'] ) );
        $blog     = get_page_by_title( html_entity_decode( $reading_settings['blog'] ) );
        if ( ( isset( $homepage ) && $homepage->ID ) && ( isset( $blog ) && $blog->ID) ) {
            update_option( 'show_on_front',   'page' );
            update_option( 'page_on_front',   $homepage->ID );
            update_option( 'page_for_posts',  $blog->ID );
          return true;
        }
      }
      return false;
    }
    function set_woocommerce_pages( $settings ) {
      if ( class_exists( 'Woocommerce' ) && ! empty( $settings['woocommerce_pages'] ) ) {
        foreach ( $settings['woocommerce_pages'] as $woo_name => $woo_title ) {
          $woopage = get_page_by_title( $woo_title );
          if ( isset( $woopage ) && property_exists( $woopage, 'ID' ) ) {
            update_option( $woo_name, $woopage->ID );
          }
        }
        return true;
      }
      return false;
    }
    function set_nav_menus( $settings ) {

      if ( is_array( $settings['navigation'] ) ) {
        $locations = get_theme_mod( 'nav_menu_locations' );
        $menus = wp_get_nav_menus();

        foreach ( (array) $menus as $theme_menu ) {
          foreach ( (array) $settings['navigation'] as $import_menu ) {
            if ( $theme_menu->name == $import_menu['name'] ) {
              $locations[ $import_menu['location'] ] = $theme_menu->term_id;
            }
          }
        }

        set_theme_mod( 'nav_menu_locations', $locations );
        return true;
      }
      return false;
    }
    $json = null;

    if ( is_file( get_template_directory() . '/inc/demo/demo-config.json' ) ) :

      require_once(ABSPATH . 'wp-admin/includes/file.php');

      WP_Filesystem();
      global $wp_filesystem;

      $rsp = $wp_filesystem->get_contents( get_template_directory() . '/inc/demo/demo-config.json' );
      $json = json_decode( $rsp, true );
    endif;

    if ($json !== null) {
      foreach ( $json as $demo ) {
        if ( $demo['demo_name'] == 'Default') {
          $settings = $demo['settings'];
        }
      }

      set_reading_options( $settings );
      set_woocommerce_pages( $settings );
      set_nav_menus( $settings );

      flush_rewrite_rules();
    }


}
add_action( 'pt-ocdi/after_import', 'ocdi_after_import_setup' );

add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

function ocdi_plugin_page_setup( $default_settings ) {
  $default_settings['parent_slug'] = 'admin.php';
  $default_settings['page_title']  = esc_html__( 'One Click Demo Import' , 'shopkeeper' );
  $default_settings['menu_title']  = esc_html__( 'Import Demo Data' , 'shopkeeper' );
  $default_settings['capability']  = 'import';
  $default_settings['menu_slug']   = 'getbowtied-demo-import';

  return $default_settings;
}