<?php

get_header();

switch( Shopkeeper_Opt::getOption( 'layout_blog', 'layout-3' ) )
{
    case "layout-1":
        include( get_parent_theme_file_path('index-layout-1.php') );
        break;
    case "layout-2":
        include( get_parent_theme_file_path('index-layout-2.php') );
        break;
    case "layout-3":
        include( get_parent_theme_file_path('index-layout-3.php') );
        break;
    default:
        include( get_parent_theme_file_path('index-layout-1.php') );
        break;
}

get_footer();
