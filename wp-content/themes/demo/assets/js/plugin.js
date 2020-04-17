(function ($) {
    'use strict'

   	  
	 
     
    $(".full-slides-shortcode").owlCarousel({
        loop:true, 	 
        autoplay:true,
        items:1, 
        nav:true, 
        dots:true, 		
        navText:["<i class=\'fas fa-angle-left\'></i>","<i class=\'fas fa-angle-right\'></i>"], 
        responsive:{
            0:{
             
                dots:true
            },
            600:{
             
                dots:true
            },
             
            
        }
   });
  







	 
})(jQuery);