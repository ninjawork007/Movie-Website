<?php
/*
Template Name: Blank
*/
?>

<?php get_header(); ?>

<div class="blank-page full-width-page page-title-hidden">
	
    <div id="primary" class="content-area">
       
        <div id="content" class="site-content" role="main">
                
                <?php while ( have_posts() ) : the_post(); ?>
    
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
    
                <?php endwhile; ?>

        </div>        
        
    </div>
	
</div>
    
<?php get_footer(); ?>