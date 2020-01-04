<?php
/**
 * WP actions
 *
 * @package shopkeeper
 */

/**
 * Whitelist style for wp_kses_post()
 */
function shopkeeper_html_tags_code() {
  global $allowedposttags;
    $allowedposttags["style"] = array();
}
add_action( 'init', 'shopkeeper_html_tags_code', 10 );

?>
