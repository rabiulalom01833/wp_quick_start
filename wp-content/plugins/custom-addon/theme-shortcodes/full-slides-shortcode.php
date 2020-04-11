<?php

function full_slide_shortcode($atts , $content = null){
    extract( shortcode_atts( array( 
		'count'=> 1, 
		 
		 
		 
    ), $atts) );
     
    $qq = new WP_Query(
        array(
 		'post_type' => 'full_slide',
		 
		)
    );      
         
    $slider_amrkeutp = '
		 <script type="text/javascript">
			jQuery(window).load(function(){
				 jQuery(".full-slides-shortcode").owlCarousel({
					    loop:false, 	 
						autoplay:false,
						items:1, 
						nav:false, 
                        dots:true, 		
						navText:["<i class=\'fas fa-angle-left\'></i>","<i class=\'fas fa-angle-right\'></i>"],
						animateOut: \'bounceInDown\',
						animateOut: \'fadeIn\', 						
						autoplayTimeout:5000,
						responsive:{
							0:{
							 
								dots:true
							},
							600:{
							 
								dots:true
							},
							 
							
						}
				  });
				  
				 
        	  
				  
				  
			});
		</script>
		
        <section id="slider_wrapper"> 
		<div id="main_slider" class="owl-carousel owl-theme full-slides-shortcode">
					
	';
    
    while($qq->have_posts()) : $qq->the_post();
	    $mood = get_post_meta($post->ID, 'Mood', true);
        $idd = get_the_ID();
        $stock_slider_filed = get_post_meta($idd, 'stock_slide_option', true); 
        $post_content = get_the_content();
        $slider_amrkeutp .= '
         
			<div class="item item-img-1" style="background:url('.get_the_post_thumbnail_url($idds,'full').'); ">
				<div class="slider_table">
					<div class="slider_table_Cell lefts">
						<div class="container">
							<div class="row">
								<div class="col-xl-12 col-lg-12 col-md-12 col-12">  
									<h2>'.get_the_title($idd).'</h2>
									'.wpautop($post_content).' 
									 <a href="https://www.akij.net/our-companies/"><button class="btn-read">Our Companies</button></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>	 
        
        ';        
    endwhile;
    $slider_amrkeutp.= '
	 			
		</div> 
	</section> 
	
	 ';
    wp_reset_query();
    return $slider_amrkeutp;
}
add_shortcode('full_slide', 'full_slide_shortcode');  

?>