<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package demo
 */

$footer_background_shap = get_template_directory_uri() .'./img/home1/footer-bg-1.png';
$fb_url = get_theme_mod( 'topbar_facebook_url');
$footer_short_details = get_theme_mod( 'footer_short_details');
$copy_right = get_theme_mod( 'copy_right');


?>

<footer id="footer-area" class="footer-all bg-p bg-light-black pt-50 pb-55">
        <div class="footer-images-1">
            <img class="f-images-1" src="<?php print esc_url($footer_background_shap); ?>" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="footer-content"> 

                        <?php  
                            wp_nav_menu(array(
                                'theme_location'=>'footermenu',
                                'menu_class'=>'footer-lists text-center', 
                            )); 
                        ?>
                        
                        <div class="footer-socials-icon text-center">
                            <a href="<?php print esc_url($fb_url); ?>"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fas fa-basketball-ball"></i></a>
                            <a href="#"><i class="fab fa-google-plus-g"></i></a>
                        </div>
                        <p><?php print esc_html__($footer_short_details); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
 
    <div id="copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                     <?php print esc_html__($copy_right); ?>
                </div>
            </div>
        </div>
    </div>
 
<?php wp_footer(); ?>

</body>
</html>
