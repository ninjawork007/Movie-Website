<?php

// [slider]
function sk_slider_shortcode($params = array(), $content = null) {

	wp_enqueue_style( 'swiper' );
	wp_enqueue_script( 'swiper' );

	wp_enqueue_style(  'shopkeeper-slider-shortcode-styles' );
	wp_enqueue_script( 'shopkeeper-slider-shortcode-script' );

	extract(shortcode_atts(array(
		'full_height' 				=> 'yes',
		'custom_height'	 			=> '',
		'hide_arrows'				=> '',
		'hide_bullets'				=> '',
		'color_navigation_bullets' 	=> '#000;',
		'color_navigation_arrows'	=> '#000;',
		'custom_autoplay_speed'		=> 10
	), $params));

	if ($full_height == 'no' && !empty($custom_height))
	{
		$height = 'height:'.$custom_height.';';
		$extra_class = '';
	}
	else
	{
		$height = '';
		$extra_class = 'full_height';
	}

	$bottom_line = '<style>

						.shortcode_getbowtied_slider .shortcode-slider-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active:after
						{
							background-color: '. $color_navigation_bullets . ';
						}

					</style>';


	$getbowtied_slider = $bottom_line . '

		<div class="shortcode_getbowtied_slider swiper-container '.$extra_class.'" style="'.$height.' width: 100%" data-autoplay="'.$custom_autoplay_speed.'">
			<div class="swiper-wrapper">
			'.do_shortcode($content).'
			</div>';

	if (!$hide_arrows):
			$getbowtied_slider .= '
				<div style="color: '. $color_navigation_arrows .'" class="swiper-button-prev"><i class="spk-icon spk-icon-left-arrow-thin-large"></i></div>
    			<div style="color: '. $color_navigation_arrows .'" class="swiper-button-next"><i class="spk-icon spk-icon-right-arrow-thin-large"></i></div>';
    endif;

    if (!$hide_bullets):
    		$getbowtied_slider .= '
				<div style="color: '. $color_navigation_bullets .'" class="shortcode-slider-pagination"></div>';
    endif;

	$getbowtied_slider .=	'</div>';

	return $getbowtied_slider;
}

add_shortcode('slider', 'sk_slider_shortcode');

function sk_image_slide_shortcode($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'title' 					=> '',
		'title_font_size'			=> '64px',
		'title_line_height'			=> '',
		'title_font_family'			=> 'primary_font',
		'description' 				=> '',
		'description_font_size' 	=> '21px',
		'description_line_height'	=> '',
		'description_font_family'	=> 'primary_font',
		'text_color'				=> '#000000',
		'button_text' 				=> '',
		'button_url'				=> '',
		'link_whole_slide'			=> '',
		'button_color'				=> '#000000',
		'button_text_color'			=>'#FFFFFF',
		'bg_color'					=> '#CCCCCC',
		'bg_image'					=> '',
		'text_align'				=> 'left'

	), $params));

	switch ($text_align)
	{
		case 'left':
			$class = 'left-align';
			break;
		case 'right':
			$class = 'right-align';
			break;
		case 'center':
			$class = 'center-align';
	}


	if (!empty($title))
	{
		$title_line_height = $title_line_height ? $title_line_height : $title_font_size;
		$title = '<h2 class="'.$title_font_family.'" style="color:'.$text_color.'; font-size:'.$title_font_size.'; line-height: '.$title_line_height.'">'.$title.'</h2>';
	} else {
		$title = "";
	}

	if (is_numeric($bg_image))
	{
		$bg_image = wp_get_attachment_url($bg_image);
	} else {
		$bg_image = "";
	}

	if (!empty($description))
	{
		$description_line_height = $description_line_height ? $description_line_height : $description_font_size;
		$description = '<p class="'.$description_font_family.'" style="color:'.$text_color.'; font-size:'.$description_font_size.'; line-height: '.$description_line_height.'">'.$description.'</p>';
	} else {
		$description = "";
	}

	if (!empty($button_text))
	{
		$button = '<a class="button" style="color:'.$button_text_color.' !important; background: '.$button_color.' !important" href="'.$button_url.'">'.$button_text.'</a>';
	} else {
		$button = "";
	}

	if ($link_whole_slide && !empty($button_url))
	{
		$slide_link = '<a href="'.$button_url.'" class="fullslidelink"></a>';
	}
	else
	{
		$slide_link = '';
	}


	$getbowtied_image_slide = '
			<div class="swiper-slide '.$class.'"
			style=	"background: '.$bg_color.' url('.$bg_image.') center center no-repeat ;
					-webkit-background-size: cover;
					-moz-background-size: cover;
					-o-background-size: cover;
					background-size: cover;
					color: '.$text_color.'">
				'.$slide_link.'
				<div class="slider-content" data-swiper-parallax="-50%">
					<div class="slider-content-wrapper">
						'.wp_kses_post($title).'
						'.wp_kses_post($description).'
						'.wp_kses_post($button).'
					</div>
				</div>
			</div>';

	return $getbowtied_image_slide;
}

add_shortcode('image_slide', 'sk_image_slide_shortcode');
