<?php get_header(); ?>

<div class="td-container">
    <div class="td-container-border">
        <div class="td-pb-row">
            <div class="td-pb-span8 td-main-content td-pb-padding">
                <div class="td-ss-main-content">
                    <?php
                    if (!empty($post->post_parent) and !empty($post->post_title)) {
                        echo tagdiv_page_generator::get_breadcrumbs(array(
                            'template' => 'attachment',
                            'parent_id' => $post->post_parent,
                            'attachment_title' => $post->post_title,
                        ));
                    } ?>
                    <h1 class="entry-title td-page-title">
                        <span><?php the_title() ?></span>
                    </h1>

                    <?php
                    if (have_posts()) {
                        while ( have_posts() ) : the_post();
                            if ( wp_attachment_is_image( $post->id ) ) {
                                $td_att_image = wp_get_attachment_image_src( $post->id, 'full');

                                if (!empty($td_att_image[0])) {
                                    $td_att_url = $td_att_image[0];
                                }

                                if (empty($td_att_image[0])) {
                                    $td_att_image[0] = ''; //init the variable to not have problems
                                }

                                $td_att_alt = '';

                                ?>
                                <a href="<?php echo wp_get_attachment_url($post->id); ?>" title="<?php the_title(); ?>" rel="attachment"><img class="td-attachment-page-image" src="<?php echo esc_url($td_att_image[0]);?>" alt="<?php echo esc_attr($td_att_alt); ?>" /></a>

                                <div class="td-attachment-page-content">
                                    <?php the_content(esc_html__('Continue', 'newsmag')); ?>
                                </div>
                            <?php }
                        endwhile;
                    } else { ?>
                        <div class="no-results td-pb-padding-side">
                            <h2><?php esc_html_e('No posts to display', 'newsmag') ?></h2>
                        </div>
                    <?php } ?>

                    <div class="td-attachment-prev"><?php previous_image_link(); ?></div>
                    <div class="td-attachment-next"><?php next_image_link(); ?></div>
                </div>
            </div>

            <div class="td-pb-span4 td-main-sidebar">
                <div class="td-ss-main-sidebar">
                    <?php dynamic_sidebar( 'td-default' ) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>