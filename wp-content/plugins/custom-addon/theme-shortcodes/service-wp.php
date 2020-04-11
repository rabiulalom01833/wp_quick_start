 <?php


function service_boxs_details_shortcode($atts, $content = null){

	 extract( shortcode_atts( array(  
        'service_img'=>'',  
        'section_title_inner'=>'',  
        'section_sub_title_inner'=>'',  
        'read_more_url'=>'',  
   
	 
	),$atts)
	);
	
 	$service_img_array = wp_get_attachment_image_src( $service_img,'full');
 	 
  
	$section_title_shortcode_title_markep = ' 
        <div class="service_box_details">
            <div class="service_image">
                <img src="'.$service_img_array[0].'">
            </div>
            <div class="service_details">

                <div class="services_content">
                    <h2>'.$section_title_inner.'</h2>
                    <p>'.$section_sub_title_inner.'</p>
                </div>
                <div class="read_more">
                    <a href="'.$read_more_url.'"> See More </a>
                </div>

            </div>
        </div>
	';	
	return $section_title_shortcode_title_markep;
	
}
add_shortcode('service_boxs_details','service_boxs_details_shortcode');














?>