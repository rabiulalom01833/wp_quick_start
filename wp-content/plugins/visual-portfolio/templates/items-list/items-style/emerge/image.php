<?php
/**
 * Item image template.
 *
 * @var $args
 * @var $opts
 * @package visual-portfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

?>

<div class="vp-portfolio__item-img-wrap">
    <div class="vp-portfolio__item-img">
        <?php
        if ( $args['url'] ) {
            ?>
            <a href="<?php echo esc_url( $args['url'] ); ?>"
                <?php
                if ( isset( $args['url_target'] ) && $args['url_target'] ) :
                    ?>
                    target="<?php echo esc_attr( $args['url_target'] ); ?>"
                    <?php
                endif;
                ?>
            >
                <noscript><?php echo wp_kses( $args['image_noscript'], $args['image_allowed_html'] ); ?></noscript>
                <?php echo wp_kses( $args['image'], $args['image_allowed_html'] ); ?>
            </a>
            <?php
        } else {
            ?>
            <noscript><?php echo wp_kses( $args['image_noscript'], $args['image_allowed_html'] ); ?></noscript>
            <?php
            echo wp_kses( $args['image'], $args['image_allowed_html'] );
        }
        ?>
    </div>
</div>
