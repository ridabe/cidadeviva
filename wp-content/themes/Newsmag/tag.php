<?php
get_header();

$current_tag_name = single_tag_title( '', false );
?>

<div class="td-container td-category-container td_category_template_1">
        <div class="td-container-border">
            <div class="td-pb-row">
                <div class="td-pb-span8 td-main-content">
                    <div class="td-ss-main-content">
                        <div class="td-page-header td-pb-padding-side">
                            <?php echo tagdiv_page_generator::get_breadcrumbs(array(
                                'template'=>'tag',
                                'tag_name'=>$current_tag_name
                            )) ?>
                            <h1 class="entry-title td-page-title">
                                <span><?php esc_html_e('Tag', 'newsmag'); echo ': ' . $current_tag_name ?></span>
                            </h1>
                            <?php //the category description
                                $td_tag_description = tag_description();
                                if (!empty($td_tag_description)) {
                                    echo '<div class="td-category-description">' . $td_tag_description . '</div>';
                                }
                            ?>
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
