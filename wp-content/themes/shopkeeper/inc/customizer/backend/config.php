<?php
/**
 * Customizer config
 *
 * @package shopkeeper
 */

/**
 * Kirki config
 */
function getbowtied_kirki_update_url( $config ) {
    $config['url_path'] = get_template_directory_uri() . '/inc/customizer/src/vendor/kirki/';

    return $config;
}
add_filter( 'kirki/config', 'getbowtied_kirki_update_url' );

/**
 * Kirki collapsible control
 */
function shopkeeper_kirki_custom_control_collapsible( $wp_customize ) {

	class Kirki_Control_Collapsible extends WP_Customize_Control {
		public $type = 'collapsible';
		public function __construct( $manager, $id, $args = array() ) {
			parent::__construct( $manager, $id, $args );

			if ( ! empty( $args['slug'] ) ) {
				$this->slug = $args['slug'];
			}
		}

		public function render_content() {
		?>
			<div class="customizer-control-collapsible">
				<span class="<?php echo esc_html( $this->slug ); ?>"></span>
				<h3><?php echo esc_html( $this->label ); ?></h3>
			</div>
		<?php
		}
	}

	add_filter( 'kirki/control_types', function( $controls ) {
		$controls['collapsible'] = 'Kirki_Control_Collapsible';
		return $controls;
	} );
}
add_action( 'customize_register', 'shopkeeper_kirki_custom_control_collapsible' );

/**
 * Kirki custom fonts
 */
function shopkeeper_custom_fonts( $standard_fonts ) {
    $fonts["Radnika"] = array(
        "label" => "Radnika",
        "stack" => "Radnika"
    );

    $fonts["NeueEinstellung"] = array(
        "label" => "NeueEinstellung",
        "stack" => "NeueEinstellung",
    );

    $fonts["Arial, Helvetica, sans-serif"] = array(
        "label" => "Arial, Helvetica, sans-serif",
        "stack" => "Arial, Helvetica, sans-serif",
    );

    $fonts["Arial Black, Gadget, sans-serif"] = array(
        "label" => "Arial Black, Gadget, sans-serif",
        "stack" => "Arial Black, Gadget, sans-serif",
    );

    $fonts["Bookman Old Style, serif"] = array(
        "label" => "Bookman Old Style, serif",
        "stack" => "Bookman Old Style, serif",
    );

    $fonts["Comic Sans MS, cursive"] = array(
        "label" => "Comic Sans MS, cursive",
        "stack" => "Comic Sans MS, cursive",
    );

    $fonts["Courier, monospace"] = array(
        "label" => "Courier, monospace",
        "stack" => "Courier, monospace",
    );

    $fonts["Garamond, serif" ] = array(
        "label" => "Garamond, serif" ,
        "stack" => "Garamond, serif" ,
    );

    $fonts["Georgia, serif"] = array(
        "label" => "Georgia, serif",
        "stack" => "Georgia, serif",
    );

    $fonts["Impact, Charcoal, sans-serif"] = array(
        "label" => "Impact, Charcoal, sans-serif",
        "stack" => "Impact, Charcoal, sans-serif",
    );

    $fonts["Lucida Console, Monaco, monospace"] = array(
        "label" => "Lucida Console, Monaco, monospace",
        "stack" => "Lucida Console, Monaco, monospace",
    );

    $fonts["MS Sans Serif, Geneva, sans-serif"] = array(
        "label" => "MS Sans Serif, Geneva, sans-serif",
        "stack" => "MS Sans Serif, Geneva, sans-serif",
    );

    $fonts["MS Serif, New York, sans-serif"] = array(
        "label" => "MS Serif, New York, sans-serif",
        "stack" => "MS Serif, New York, sans-serif",
    );

    $fonts["Palatino Linotype, Book Antiqua, Palatino, serif"] = array(
        "label" => "Palatino Linotype, Book Antiqua, Palatino, serif",
        "stack" => "Palatino Linotype, Book Antiqua, Palatino, serif",
    );

    $fonts["Tahoma,Geneva, sans-serif"] = array(
        "label" => "Tahoma,Geneva, sans-serif",
        "stack" => "Tahoma,Geneva, sans-serif",
    );

    $fonts["Times New Roman, Times,serif" ] = array(
        "label" => "Times New Roman, Times,serif" ,
        "stack" => "Times New Roman, Times,serif" ,
    );

    $fonts["Trebuchet MS, Helvetica, sans-serif"] = array(
        "label" => "Trebuchet MS, Helvetica, sans-serif",
        "stack" => "Trebuchet MS, Helvetica, sans-serif",
    );

    $fonts["Verdana, Geneva, sans-serif" ] = array(
        "label" => "Verdana, Geneva, sans-serif" ,
        "stack" => "Verdana, Geneva, sans-serif" ,
    );

    return $fonts;
}
add_filter( 'kirki/fonts/standard_fonts', 'shopkeeper_custom_fonts' );

/**
 * Go To Page
 */
function shopkeeper_get_customize_section_url() {
	switch($_POST['page']) {
		case 'shop':
			echo get_permalink( wc_get_page_id( 'shop' ) );
			break;
		case 'blog':
			echo get_permalink( get_option( 'page_for_posts' ) );
			break;
		case 'product':
			$args = array('orderby' => 'rand', 'limit' => 1);
			$product = wc_get_products($args);
			echo get_permalink( $product[0]->get_id() );
			break;
		case 'post':
			$args = array('orderby' => 'rand', 'posts_per_page' => 1);
			$post = get_posts($args);
			echo get_permalink( $post[0]->ID );
			break;
		default:
			echo get_home_url();
			break;
	}
	exit();
}
add_action( 'wp_ajax_get_url', 'shopkeeper_get_customize_section_url' );

?>
