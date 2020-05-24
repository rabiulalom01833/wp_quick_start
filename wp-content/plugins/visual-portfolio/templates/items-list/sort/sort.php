<?php
/**
 * Default sort template.
 *
 * @var $args
 * @package visual-portfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

?>

<ul class="<?php echo esc_attr( $args['class'] ); ?> vp-sort__style-default">
    <?php
    // phpcs:ignore
    foreach ( $args['items'] as $item ) {
        ?>
        <li class="<?php echo esc_attr( $item['class'] ); ?>">
            <a href="<?php echo esc_url( $item['url'] ); ?>" data-vp-sort="<?php echo esc_attr( $item['sort'] ); ?>">
                <?php echo esc_html( $item['label'] ); ?>
            </a>
        </li>
        <?php
    }
    ?>
</ul>
