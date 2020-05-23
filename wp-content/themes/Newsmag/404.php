<?php

do_action( 'tdc_404' );
if ( has_action( 'tdc_404' ) ) {
    return;
}

get_header();

?>

<div class="td-container">
    <div class="td-container-border">
        <div class="td-pb-row">
            <div class="td-pb-span12">
                <div class="td-404-title">
                    <?php esc_html_e('Ooops... Error 404', 'newsmag'); ?>
                </div>

                <div class="td-404-sub-title">
                    <?php esc_html_e('Sorry, but the page you are looking for doesn\'t exist.', 'newsmag'); ?>
                </div>

                <div class="td-404-sub-sub-title">
                    <?php esc_html_e('You can go to the', 'newsmag'); ?>
                    <a href="<?php echo esc_url(home_url( '/' )); ?>"><?php esc_html_e('HOMEPAGE', 'newsmag'); ?></a>
                </div>

                <h4 class="block-title"><span><?php esc_html_e('OUR LATEST POSTS', 'newsmag')?></span></h4>

                <?php
                    get_template_part('loop-archive' );
                ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>