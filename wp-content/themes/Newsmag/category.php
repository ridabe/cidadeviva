<?php
get_header();

$cur_cat_id = get_query_var('cat');
$cur_cat_obj = get_category($cur_cat_id);
?>

<div class="td-container td-category-container td_category_template_1">
        <div class="td-container-border">
            <div class="td-pb-row">
                <div class="td-pb-span8 td-main-content">
                    <div class="td-ss-main-content">
                        <div class="td-category-header td-pb-padding-side">
                            <header>
                                <h1 class="entry-title td-page-title">
                                    <span><?php printf( '%1$s', $cur_cat_obj->name ) ?></span>
                                </h1>
                            </header>
                            <?php echo tagdiv_page_generator::get_breadcrumbs(array(
                                'template'=>'category',
                                'category_obj'=>$cur_cat_obj
                            )) ?>
                            <?php //the category description
                                if (!empty($cur_cat_obj->description)) {
                                    echo '<div class="td-category-description">' . $cur_cat_obj->description . '</div>';
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
