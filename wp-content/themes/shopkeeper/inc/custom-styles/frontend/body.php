<?php

if( (isset(Shopkeeper_Opt::getOption( 'main_background', array('background-color' => '#FFFFFF') )['background-color'])) ) {
	$custom_styles .= '
		.st-content
		{
			background-color: ' . Shopkeeper_Opt::getOption( 'main_background', array('background-color' => '#FFFFFF') )['background-color'] . ';
		}';
}

if( (isset(Shopkeeper_Opt::getOption( 'main_background', array('background-color' => '#FFFFFF') )['background-image'])) && (Shopkeeper_Opt::getOption( 'main_background', array('background-color' => '#FFFFFF') )['background-image'] != "") ) {
	$custom_styles .= '
		.st-content
		{
			background-image: url(' . esc_url(Shopkeeper_Opt::getOption( 'main_background', array('background-color' => '#FFFFFF') )['background-image']) . ');
		}';
}

if( (isset(Shopkeeper_Opt::getOption( 'main_background', array('background-color' => '#FFFFFF') )['background-repeat'])) && (Shopkeeper_Opt::getOption( 'main_background', array('background-color' => '#FFFFFF') )['background-repeat'] != "") ) {
	$custom_styles .= '
		.st-content
		{
			background-repeat: ' . Shopkeeper_Opt::getOption( 'main_background', array('background-color' => '#FFFFFF') )['background-repeat'] . ';
		}';
}

if( (isset(Shopkeeper_Opt::getOption( 'main_background', array('background-color' => '#FFFFFF') )['background-position'])) && (Shopkeeper_Opt::getOption( 'main_background', array('background-color' => '#FFFFFF') )['background-position'] != "") ) {
	$custom_styles .= '
		.st-content
		{
			background-position: ' . Shopkeeper_Opt::getOption( 'main_background', array('background-color' => '#FFFFFF') )['background-position'] . ';
		}';
}

if( (isset(Shopkeeper_Opt::getOption( 'main_background', array('background-color' => '#FFFFFF') )['background-size'])) && (Shopkeeper_Opt::getOption( 'main_background', array('background-color' => '#FFFFFF') )['background-size'] != "") ) {
	$custom_styles .= '
		.st-content
		{
			background-size: ' . Shopkeeper_Opt::getOption( 'main_background', array('background-color' => '#FFFFFF') )['background-size'] . ';
		}';
}

if( (isset(Shopkeeper_Opt::getOption( 'main_background', array('background-color' => '#FFFFFF') )['background-attachment'])) && (Shopkeeper_Opt::getOption( 'main_background', array('background-color' => '#FFFFFF') )['background-attachment'] != "") ) {
	$custom_styles .= '
		.st-content
		{
			background-attachment: ' . Shopkeeper_Opt::getOption( 'main_background', array('background-color' => '#FFFFFF') )['background-attachment'] . ';
		}';
}

if( is_user_logged_in() ) {
	$custom_styles .= '
		@media all and (min-width: 1024px) and (max-width: 1280px)
		{
			.position-left,
			.position-right
			{
				padding-top: 38px;
			}
		}
	';
}

if( !Shopkeeper_Opt::getOption( 'predictive_search', true ) ) {
	$custom_styles .= '
		@media all and (max-width: 767px) {
			.site-search {
			    min-height: 170px;
			    height: 170px;
			    -webkit-transform: translateY(-170px);
			    -ms-transform: translateY(-170px);
			    transform: translateY(-170px);
			}
		}
	';
}

?>
