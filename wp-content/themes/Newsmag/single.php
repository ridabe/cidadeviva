<?php get_header();
    global $content_width;

    $content_width = 980;
?>

    <div class="td-container td-post-template-default">
        <div class="td-container-border">
            <div class="td-pb-row">
                <div class="td-pb-span12 td-main-content" role="main">
                    <div class="td-ss-main-content">
                        <?php
                        get_template_part('loop-single' );
                        comments_template('', true);
                        ?>
                    </div>
                </div>
            </div> <!-- /.td-pb-row -->
        </div>
    </div> <!-- /.td-container -->

<?php get_footer() ?>