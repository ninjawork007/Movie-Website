<?php

if( !function_exists('theme_warning') ) {
	function theme_warning() {

		?>

		<div class="error">
			<p>Shopkeeper Extender plugin couldn't find the Block Editor (Gutenberg) on this site. It requires WordPress 5+ or Gutenberg installed as a plugin.</p>
		</div>

		<?php
	}
}

if( !function_exists('is_wp_version') ) {
	function is_wp_version( $operator, $version ) {

		global $wp_version;

		return version_compare( $wp_version, $version, $operator );
	}
}

function sk_bool_to_string( $bool ) {
	$bool = is_bool( $bool ) ? $bool : ( 'yes' === $bool || 1 === $bool || 'true' === $bool || '1' === $bool );

	return true === $bool ? 'yes' : 'no';
}

function sk_string_to_bool( $string ) {
	return is_bool( $string ) ? $string : ( 'yes' === $string || 1 === $string || 'true' === $string || '1' === $string );
}