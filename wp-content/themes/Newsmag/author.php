<?php
/*  ----------------------------------------------------------------------------
    the author template
 */

get_header();

$part_cur_auth_obj = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));

?>

<div class="td-container">
    <div class="td-container-border">
        <div class="td-pb-row">
            <div class="td-pb-span8 td-main-content">
                <div class="td-ss-main-content">
                    <div class="td-page-header td-pb-padding-side">
                        <?php echo tagdiv_page_generator::get_breadcrumbs(array(
                            'template'=>'author',
                            'author'=>$part_cur_auth_obj
                        )) ?>

                        <h1 class="entry-title td-page-title">
                            <span><?php printf( '%1$s', $part_cur_auth_obj->display_name ) ?></span>
                        </h1>
                    </div>

                    <div class="author-box-wrap author-page">
                        <?php  echo get_avatar($part_cur_auth_obj->user_email, '106'); ?>
                        <div class="desc">
                            <div class="td-author-counters">
                                <span class="td-author-post-count"><?php echo count_user_posts($part_cur_auth_obj->ID) . ' ' .  esc_html__('POSTS', 'newsmag') ?></span>
                                <span class="td-author-comments-count">
                                <?php
                                $comment_count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) AS total FROM $wpdb->comments WHERE comment_approved = 1 AND user_id = %d", $part_cur_auth_obj->ID));
                                printf( ' %1$s', $comment_count . ' '  . esc_html__('COMMENTS', 'newsmag') );
                                ?>
                                </span>
                            </div>

                            <?php
                            if (!empty($part_cur_auth_obj->user_url)) {
                                echo '<div class="td-author-url"><a href="' . esc_url($part_cur_auth_obj->user_url) . '">' . esc_url($part_cur_auth_obj->user_url) . '</a></div>';
                            }
                            printf( '%1$s', $part_cur_auth_obj->description );
                            ?>
                        </div>
                        <div class="clearfix"></div>
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
?>