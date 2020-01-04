jQuery(document).ready(function ($) {	

	//portfolio isotope - hover effect
	$('.hover-effect-text').each(function(){
		
		var that = $(this);
		
		that.css('bottom',-that.outerHeight())
			.attr('data-height',that.outerHeight());
	})
	
	$('.hover-effect-link').mouseenter(function(){
		
		var that = $(this);
		
		if ( !that.find('.hover-effect-text').is(':empty') ) {
			
			var portfolio_cat_height = that.find('.hover-effect-text').outerHeight();
			
			that.find('.hover-effect-title').css('bottom',portfolio_cat_height);
			that.find('.hover-effect-text').css('bottom',0);
			
		}
		
	});
	
	
	$('.hover-effect-link').mouseleave(function(){
	
		var that = $(this);
		
		if ( !that.find('.hover-effect-text').is(':empty') ) {
		
			var portfolio_cat_height = that.find('.hover-effect-text').attr('data-height');
	
			that.find('.hover-effect-title').css('bottom',28);
			that.find('.hover-effect-text').css('bottom',-portfolio_cat_height);
		}
		
	});
	
	
	//portfolio isotope - adjust wrapper width, return portfolio_grid
    function portfolioIsotopeWrapper () {
           
		if ( $(window).innerWidth() > 1584 ) {
			$portfolio_grid = 5;
		} else if ( $(window).innerWidth() <= 480 ) {
			$portfolio_grid = 1;
		} else if ( $(window).innerWidth() <= 901 ) {
			$portfolio_grid = 2;
		} else if ( $(window).innerWidth() <= 1248 ) {
			$portfolio_grid = 3;
		} else {
			$portfolio_grid = 4;
		}
		
		if ( $('.items_per_row_3').length > 0 && $(window).innerWidth() > 1248 )
		{
			$portfolio_grid = 3;
		}
		
		if ( $('.items_per_row_4').length > 0 && $(window).innerWidth() > 1584 )
		{
			$portfolio_grid = 4;
		}
       
        $portfolio_wrapper_width = $('.portfolio-isotope-container').width();
   
        if ( $portfolio_wrapper_width % $portfolio_grid > 0 ) {
            $portfolio_wrapper_width = $portfolio_wrapper_width + ( $portfolio_grid - $portfolio_wrapper_width%$portfolio_grid);
        };
   
        $('.portfolio-isotope').css('width',$portfolio_wrapper_width);

        return $portfolio_grid;
    } // end portfolioIsotopeWrapper
   
    //portfolio isotope
    if ( $('.portfolio-isotope-container').length ) {
           
		var $portfolio_wrapper_inner,   
            $portfolio_wrapper_width,
            $portfolio_grid,
            $filterValue;
       
        $filterValue = $('.filters-group .is-checked').attr('data-filter');
                      
        $portfolio_grid =  portfolioIsotopeWrapper();
        portfolioIsotopeWrapper();
       
        var afterIsotope = function(){
            setTimeout(function(){
                //$('.preloader_isotope').remove();
                $(".portfolio-box").removeClass('hidden');
            },200); 
        }
       
        var portfolioIsotope=function(){
            var imgLoad = imagesLoaded($('.portfolio-isotope'));
           
            imgLoad.on('done',function(){

                $portfolio_wrapper_inner = $('.portfolio-isotope').isotope({
                    "itemSelector": ".portfolio-box",
					 //layoutMode: 'fitRows',
                    "masonry": { "columnWidth": ".portfolio-grid-sizer" }
                });
               
                afterIsotope()
            })
           
            imgLoad.on('fail',function(){

                portfolio_wrapper_inner = $('.portfolio-isotope').isotope({
                    "itemSelector": ".portfolio-box",
					 //layoutMode: 'fitRows',
                    "masonry": { "columnWidth": ".portfolio-grid-sizer" }
                });
               
                afterIsotope()
            })
           
        }
                   
        portfolioIsotope();
   
        // filter items on button click
        $('.filters-group').on( 'click', '.filter-item', function() {
		   
            $filterValue = $(this).attr('data-filter'); 
            $(this).parents('.portfolio-filters').siblings('.portfolio-isotope').isotope({ filter: $filterValue });
        
		});
    }//endif portfolio isotope

    $(window).resize(function(){

    	//portfolio isotope
        if ( $('.portfolio-isotope-container').length ) {
           
            var $portfolio_grid_on_resize;
           
            portfolioIsotopeWrapper()
            $portfolio_grid_on_resize =  portfolioIsotopeWrapper(); 
           
            if ( $portfolio_grid != $portfolio_grid_on_resize ) {

                $('.filters-group .filter-item').each(function(){
                    if ( $(this).attr('data-filter') == $filterValue ){
                            $(this).trigger('click');
                    }
                })
               
                $portfolio_grid = $portfolio_grid_on_resize;
        
				resizeIsotopeEnd();
           
            }
			
        }
    });

});