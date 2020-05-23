<?php
get_header();

//prepare the archives page title
if (is_day()) {
    $td_archive_title = esc_html__('Daily Archives:', 'newsmag'). ' ' . get_the_date();
} elseif (is_month()) {
    $td_archive_title = esc_html__('Monthly Archives:', 'newsmag') . ' ' . get_the_date('F Y');
} elseif (is_year()) {
    $td_archive_title = esc_html__('Yearly Archives:', 'newsmag') . ' ' . get_the_date('Y');
} else {
    $td_archive_title = esc_html__('Archives', 'newsmag');
}
?>

<div class="td-container">
        <div class="td-container-border">
            <div class="td-pb-row">
                <div class="td-pb-span8 td-main-content">
                    <div class="td-ss-main-content">
                        <div class="td-page-header td-pb-padding-side">
                            <?php echo tagdiv_page_generator::get_breadcrumbs(array('template'=>'archive')) ?>

                            <h1 class="entry-title td-page-title">
                                <span><?php printf( '%1$s', $td_archive_title ) ?></span>
                            </h1>
                        </div>

                        <?php
                        get_template_part('loop-archive' );
                        tagdiv_page_generator::get_pagination();
                        ?>
                    </div>
                </div>

                <div class="td-pb-span4 td-main-sidebar">
                    <div class="td-ss-main-sidebar">
                        <?php dynamic_sidebar( 'td-default' ); ?>
                    </div>
                </div>
            </div> <!-- /.td-pb-row -->
        </div>
    </div> <!-- /.td-container -->

<?php
get_footer();
