<?php


function section_shortcode($atts, $content = null){

	 extract( shortcode_atts( array(  
        'section_title'=>'',  
        'section_details'=>'',  
         
         
	 
	),$atts)
	);
	
 	$section_title_img_array = wp_get_attachment_image_src( $section_title_img,'full');
 	 
  
	$section_title_shortcode_title_markep = ' 
		 
			<div class="section-title">
				<h2>'.$section_title.'</h2>  
				 <p>'.$section_details.'</p>
			</div>
		 
	';	
	return $section_title_shortcode_title_markep;
	
}
add_shortcode('section_shortcode_title','section_shortcode');














?>