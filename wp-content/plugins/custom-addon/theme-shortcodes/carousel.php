<?php

function clienttestimonail_code($atts , $content = null){
    extract( shortcode_atts( array( 
		'count'=> 1, 
		 
		 
    ), $atts) );
     
    $qq = new WP_Query(
        array(
 		'post_type' => 'clienttestimonailwp',
		 
		)
    );      
         
    $slider_amrkeutp = '
		 <script type="text/javascript">
			jQuery(window).load(function(){
				 jQuery(".clienttestimonail").owlCarousel({
					    loop:false, 	 
						autoplay:false,
						items:1,
						nav:false,
						dots:true, 
						margin:50,  
						responsive:{
							0:{
								items:1, 
							},
							768:{
								items:2, 
							},
							1000:{
								items:3, 
							},
							 1200:{
								items:4, 
								 
							}
						}  
					});
							 
						  
			});
		</script>
		<div class=" owl-carousel owl-theme clienttestimonail">  
	';
    
    while($qq->have_posts()) : $qq->the_post(); 
        $idd = get_the_ID();
        $stock_slider_filed = get_post_meta($idd, 'stock_slide_option', true); 
        $post_contents = get_the_content();
        $slider_amrkeutp .= '
		 
			<div class="clientTestimonail">  
				<img src="'.get_the_post_thumbnail_url($idds,'full').'" alt="" /> 
				'.wpautop($post_contents).'  
				<h2>'.get_the_title($idd).'</h2>  
			</div>
		';        
    endwhile;
    $slider_amrkeutp.= '
	 </div>
	 ';
    wp_reset_query();
    return $slider_amrkeutp;
}
add_shortcode('clienttestimonailwp', 'clienttestimonail_code');  

?>