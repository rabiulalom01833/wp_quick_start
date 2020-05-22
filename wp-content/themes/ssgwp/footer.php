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


$fb_url = get_theme_mod( 'topbar_fb_url');
$ins_url = get_theme_mod( 'topbar_instagram_url');
$mob_no = get_theme_mod( 'mobile_no');
$email_no = get_theme_mod( 'email_no');
$copy_right_text = get_theme_mod( 'copy_right');


?>
<div class="form-area">
        <div class="container"> 
            <form action="/">
                <div class="row">
                    <div class="col-lg-4">
                        <input type="email" name="email" class="email-box" placeholder="ENTER EMAIL">
                    </div>
                    <div class="col-lg-4">
                        <div class="check-select"> 
                            <select class="select-city">
                                <option>SELECT CITY</option>
                                <option>SELECT CITY</option>
                                <option>SELECT CITY</option>
                                <option>SELECT CITY</option>
                                <option>SELECT CITY</option>
                            </select>
                            <div class="checkbox-wrapper media">
                                <div class="checkbox-item">
                                    <input type="radio" id="c1" name="ticket-type">
                                    <label for="c1"><i class="fa fa-male"></i></label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="radio" id="c2" name="ticket-type">
                                    <label for="c2"><i class="fa fa-female"></i></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="contact-button">
                            <a href="#" class="btn-2">JOIN MEMBER LIST</a>
                            <h6>321 444 MEMBERS</h6>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
 
    <footer class="footer-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 footer-col">
                    <div class="footer-left-widget">
                        <?php             
                            wp_nav_menu(array(
                                'theme_location'=>'footermenu',  
                            ));
                        
                         ?>
                        <p> <?php print esc_html__($copy_right_text); ?> </p>
                    </div>
                </div>
                <div class="col-lg-6 footer-col">
                    <div class="footer-right-widget">
                        <a href="<?php print esc_html__($fb_url); ?>"><i class="fab fa-instagram"></i></a>
                        <a href="<?php print esc_html__($ins_url); ?>"><i class="fab fa-facebook"></i></a>
                        <h6> 
                        <?php print esc_html__($mob_no); ?>
                        <br> 
                        <?php print esc_html__($email_no); ?>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </footer>
 
<?php wp_footer(); ?>

</body>
</html>
