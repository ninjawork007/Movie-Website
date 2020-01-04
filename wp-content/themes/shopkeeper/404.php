<?php get_header(); ?>

	<div id="primary" class="content-area">

        <div class="row">	
            <div class="large-10 large-centered columns">    
                <div id="content" class="site-content" role="main">
                
                    <section class="error-404 not-found">
                        <header class="page-header">
                            <div class="error-banner"></div>
                            <h1 class="page-title"><?php esc_html_e( "Oops 404 again! That page can't be found.", 'shopkeeper' ); ?></h1>
                        </header><!-- .page-header -->
        
                        <div class="page-content">
                            
                            <p class="error-404-text"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'shopkeeper' ); ?></p>
        
                            <?php get_search_form(); ?>
        
                        </div><!-- .page-content -->
                    </section><!-- .error-404 -->
                    
                </div><!-- #content -->
            </div><!-- .large-12 .columns -->                
        </div><!-- .row -->
             
    </div><!-- #primary -->

<?php get_footer(); ?>