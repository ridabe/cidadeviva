<?php
/*  ----------------------------------------------------------------------------
    the default page template
 */

get_header();

?>
<div class="td-main-content-wrap">
    <div class="td-container">
        <div class="td-container-border">
            <div class="td-pb-row">
                <div class="td-pb-span8 td-main-content" role="main">
                    <div class="td-ss-main-content">
                        <?php
                        if (have_posts()) {
                            while ( have_posts() ) : the_post();
                                ?>
                                <div class="td-page-header td-pb-padding-side">
                                    <?php echo tagdiv_page_generator::get_breadcrumbs(array(
                                        'template'=>'page',
                                        'page_title'=>get_the_title()
                                    )) ?>
                                    <h1 class="entry-title td-page-title">
                                        <span><?php the_title() ?></span>
                                    </h1>
                                </div>
                                <div class="td-pb-padding-side td-page-content">
                                <?php
                                    the_content(esc_html__('Continue', 'newsmag'));
                            endwhile;//end loop
                        }
                        ?>
                        </div>
                        <?php comments_template('', true) ?>
                    </div>
                </div>
                <div class="td-pb-span4 td-main-sidebar" role="complementary">
                    <div class="td-ss-main-sidebar">
                        <?php dynamic_sidebar( 'td-default' ); ?>
                    </div>
                </div>
            </div> <!-- /.td-pb-row -->
        </div>
    </div> <!-- /.td-container -->
</div> <!-- /.td-main-content-wrap -->

<?php
get_footer();
