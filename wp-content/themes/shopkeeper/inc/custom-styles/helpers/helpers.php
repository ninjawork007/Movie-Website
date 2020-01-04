<?php
/**
 * Custom styles helper functions
 *
 * @package shopkeeper
 */

global $default_fonts;

$default_fonts = array(
    "Radnika"                                               => "Radnika",
    "NeueEinstellung"                                       => "NeueEinstellung",
    "Arial, Helvetica, sans-serif"                          => "Arial, Helvetica, sans-serif",
    "Arial Black, Gadget, sans-serif"                     	=> "Arial Black, Gadget, sans-serif",
    "Bookman Old Style, serif"                            	=> "Bookman Old Style, serif",
    "Comic Sans MS, cursive"                              	=> "Comic Sans MS, cursive",
    "Courier, monospace"                                    => "Courier, monospace",
    "Garamond, serif"                                       => "Garamond, serif",
    "Georgia, serif"                                        => "Georgia, serif",
    "Impact, Charcoal, sans-serif"                          => "Impact, Charcoal, sans-serif",
    "Lucida Console, Monaco, monospace"                   	=> "Lucida Console, Monaco, monospace",
    "Lucida Sans Unicode, 'Lucida Grande, sans-serif"    	=> "Lucida Sans Unicode, 'Lucida Grande, sans-serif",
    "MS Sans Serif, Geneva, sans-serif"                   	=> "MS Sans Serif, Geneva, sans-serif",
    "MS Serif, 'New York, sans-serif"                    	=> "MS Serif, 'New York, sans-serif",
    "Palatino Linotype, 'Book Antiqua, Palatino, serif"  	=> "Palatino Linotype, 'Book Antiqua, Palatino, serif",
    "Tahoma,Geneva, sans-serif"                             => "Tahoma,Geneva, sans-serif",
    "Times New Roman, Times,serif"                        	=> "Times New Roman, Times,serif",
    "Trebuchet MS, Helvetica, sans-serif"                 	=> "Trebuchet MS, Helvetica, sans-serif",
    "Verdana, Geneva, sans-serif"                           => "Verdana, Geneva, sans-serif"
);

/**
 * Theme main font
 */
function shopkeeper_get_main_font() {

    global $default_fonts;

    $main_font = 'NeueEinstellung';
	$new_main_font = Shopkeeper_Opt::getOption( 'new_main_font', array( 'font-family' => 'NeueEinstellung', 'variant' => '500', 'subsets' => array( 'latin' ) ) );
	if ( !in_array($new_main_font['font-family'], $default_fonts) ) {
		$main_font = '"' . $new_main_font['font-family'] . '", sans-serif';
	} else {
		$main_font = esc_html( $new_main_font['font-family'] );
	}

    return $main_font;
}

/**
 * Theme secondary font
 */
function shopkeeper_get_secondary_font() {

    global $default_fonts;
    
    $secondary_font = 'Radnika';
	$new_secondary_font = Shopkeeper_Opt::getOption( 'new_secondary_font', array( 'font-family'=> 'Radnika' ) );
	if ( !in_array($new_secondary_font['font-family'], $default_fonts) ) {
		$secondary_font = '"' . $new_secondary_font['font-family'] . '", sans-serif';
	} else {
		$secondary_font = esc_html( $new_secondary_font['font-family'] .', sans-serif' );
	}

    return $secondary_font;
}

?>
