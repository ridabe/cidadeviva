<?php get_header() ?>

<div class="td-container">
    <div class="td-container-border">
        <div class="td-pb-row">
            <div class="td-pb-span8 td-main-content td-pb-padding-side" role="main">
                <div class="td-ss-main-content">
                    <?php
                    if (have_posts()) {
                        while ( have_posts() ) : the_post();
                            ?>
                            <h1 class="entry-title td-page-title">
                                <a href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title_attribute() ?>"><?php the_title() ?></a>
                            </h1>
                            <?php
                            the_content(esc_html__('Continue', 'newsmag'));
                        endwhile; //end loop
                    }
                    ?>
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

<?php get_footer() ?>