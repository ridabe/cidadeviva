<?php

do_action( 'tdc_woo_single_product' );
if ( has_action( 'tdc_woo_single_product' ) ) {
    return;
}

get_header()

?>

<div class="td-main-content-wrap td-main-page-wrap">
    <div class="td-container">
        <div class="td-container-border">
            <div class="td-pb-row">
                <div class="td-pb-span8 td-main-content td-pb-padding-side" role="main">
                    <div class="td-ss-main-content">
                        <?php
                        woocommerce_breadcrumb();
                        woocommerce_content();
                        ?>
                    </div>
                </div>
                <div class="td-pb-span4 td-main-sidebar" role="complementary">
                    <div class="td-ss-main-sidebar">
                        <?php dynamic_sidebar( 'td-default' ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer() ?>