<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

include_once( dirname(__FILE__) . '/functions/function-setup.php' );
include_once( dirname(__FILE__) . '/functions/function-helpers.php' );

//==============================================================================
//  Frontend Output
//==============================================================================
if ( ! function_exists( 'gbt_18_sk_render_frontend_portfolio' ) ) {
    function gbt_18_sk_render_frontend_portfolio( $attributes ) {
        
        $sliderrandomid = rand();
        
        extract(shortcode_atts(array(
            'number'                    => '12',
            'categoriesSavedIDs'        => '',
            'showFilters'               => false,
            'columns'                   => '3',
            'align'                     => 'center',
            'orderby'                   => 'date_desc',
            'className'                 => 'is-style-default'
        ), $attributes));
        ob_start();

        if( substr($categoriesSavedIDs, - 1) == ',' ) {
            $categoriesSavedIDs = substr( $categoriesSavedIDs, 0, -1);
        }

        if( substr($categoriesSavedIDs, 0, 1) == ',' ) {
            $categoriesSavedIDs = substr( $categoriesSavedIDs, 1);
        }
        
        $args = array(                  
            'post_status'           => 'publish',
            'post_type'             => 'portfolio',
            'posts_per_page'        => $number
        );

        switch ( $orderby ) {
            case 'date_asc' :
                $args['orderby'] = 'date';
                $args['order']   = 'asc';
                break;
            case 'date_desc' :
                $args['orderby'] = 'date';
                $args['order']   = 'desc';
                break;
            case 'title_asc' :
                $args['orderby'] = 'title';
                $args['order']   = 'asc';
                break;
            case 'title_desc':
                $args['orderby'] = 'title';
                $args['order']   = 'desc';
                break;
            default: break;
        }

        if( $categoriesSavedIDs != '' ) {
            $args['tax_query'] = array(
                array(
                    'taxonomy'  => 'portfolio_categories',
                    'field'     => 'term_id',
                    'terms'     => explode(",",$categoriesSavedIDs)
                ),
           );
        }
        
        $portfolioItems = get_posts( $args );

        if ( !empty($portfolioItems) ) :

            $portfolio_categories_queried = [];
        
            foreach($portfolioItems as $post) :
                
                $terms = get_the_terms( $post->ID, 'portfolio_categories' ); // get an array of all the terms as objects.
                
                if ( !empty( $terms ) && !is_wp_error( $terms ) ) {
                    foreach($terms as $term) {
                        $portfolio_categories_queried[$term->slug] = $term->name;
                    }
                }
                
            endforeach;

            $portfolio_categories_queried = array_unique($portfolio_categories_queried);

        endif;
        
        $items_per_row_class = '';
        if ( strpos( $className, 'is-style-default') !== false ) {
            $items_per_row_class = 'default_grid items_per_row_' . $columns;
        }
        
        ?>
        
        <!-- Wrappers -->
        <div class="gbt_18_sk_portfolio wp-block-gbt-portfolio <?php echo $className; ?> align<?php echo $align; ?>">
            <div class="portfolio-isotope-container gbt_18_sk_portfolio_container <?php echo $items_per_row_class ;?>">
                        
            <!-- Filters -->
            <?php if ($showFilters) : ?>
                <div class="portfolio-filters">            
                    <?php
                    
                    if ( !empty( $portfolio_categories_queried ) && !is_wp_error( $portfolio_categories_queried ) ){
                        echo '<ul class="filters-group list-centered">';
                            echo '<li class="filter-item is-checked" data-filter="*">' . esc_html__("Show all", "shopkeeper-portfolio") . '</li>';
                        foreach ( $portfolio_categories_queried as $key => $value ) {
                            echo '<li class="filter-item" data-filter=".' . $key . '">' . $value . '</li>';
                        }
                        echo '</ul>';
                    }
                               
                    ?>            
                </div>
            <?php endif; ?>
                
                <div class="portfolio-isotope">
                    
                    <div class="portfolio-grid-sizer"></div>

                    <div class="portfolio-grid-items">
                    
                        <?php
                                                                
                            if ( !empty($portfolioItems) ) :
            
                                foreach($portfolioItems as $post) :
                                              
                                    $related_thumb = [""];                      
                                    if ( has_post_thumbnail($post->ID)) {
                                        $related_thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
                                    }

                                   $terms_slug = get_the_terms( $post->ID, 'portfolio_categories' ); // get an array of all the terms as objects.
                                    $term_slug_class = "";
                                    if ( !empty( $terms_slug ) && !is_wp_error( $terms_slug ) ){
                                        foreach ( $terms_slug as $term_slug ) {
                                            $term_slug_class .=  $term_slug->slug . " ";
                                        }
                                    }
                                    
                                    if (get_post_meta( $post->ID, 'portfolio_color_meta_box', true )) {
                                        $portfolio_color_option = get_post_meta( $post->ID, 'portfolio_color_meta_box', true );
                                    } else {
                                        $portfolio_color_option = "none";
                                    }
                                    
                                ?>

                                    <div class="portfolio-box hidden <?php echo esc_html($term_slug_class); ?>">
                                        
                                        <a href="<?php echo get_permalink($post->ID); ?>" class="portfolio-box-inner hover-effect-link" style="background-color:<?php echo esc_html($portfolio_color_option); ?>">
                                            
                                            <div class="portfolio-content-wrapper hover-effect-content">
                                                
                                                <?php if ($related_thumb[0] != "") : ?>
                                                    <span class="portfolio-thumb hover-effect-thumb" style="background-image: url(<?php echo esc_url($related_thumb[0]); ?>)"></span>
                                                <?php endif; ?>
                                                
                                                <h2 class="portfolio-title hover-effect-title"><?php echo $post->post_title; ?></h2>
                                                
                                                <p class="portfolio-categories hover-effect-text"><?php echo strip_tags (get_the_term_list($post->ID, 'portfolio_categories', "", ", "));?></p>
                                                 
                                            </div>
                                            
                                        </a>
                                        
                                    </div>
                            
                            <?php endforeach; // end of the loop. ?>

                        <?php endif; ?>

                    </div>
                </div>
            
            <!-- Wrappers -->
            </div>
        </div>
        
        <?php

        wp_reset_query();
       
        return ob_get_clean();
    }
}