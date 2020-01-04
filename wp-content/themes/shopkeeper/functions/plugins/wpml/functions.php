<?php
/**
 * WPML functions
 *
 * @package shopkeeper
 */

/**
 * Top Bar Languages DropDown
 */
function languages_top_bar() {
    $languages = icl_get_languages('skip_missing=0&orderby=code');

    if( !empty($languages) ) { ?>

        <div id="top_bar_language_list" class="topbar-language-switcher">

        <ul>
 			<li class="menu-item-first"><a href="#"><?php echo ICL_LANGUAGE_NAME; ?></a>

 			<ul class="sub-menu">

 	       <?php
 	        foreach($languages as $l) {
 	            echo '<li class="sub-menu-item">';
 	            if($l['country_flag_url']){
 	                if(!$l['active']) echo '<a class="flag" href="'.$l['url'].'">';
 	                echo '<img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" />';
 	                if(!$l['active']) echo '</a>';
 	            }
 	            if(!$l['active']) echo '<a href="'.$l['url'].'">';
 	            echo apply_filters( 'wpml_display_language_names', NULL, $l['native_name'], $l['translated_name'] );
 	            if(!$l['active']) echo '</a>';
 	            echo '</li>';
 	        }

 	        echo '</ul></li>';
 	        ?>

    <?php } ?>

 	<?php echo '</ul></div>';
}
