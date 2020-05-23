<?php

if (have_posts()) {
    while ( have_posts() ) : the_post(); ?>
        <div <?php post_class('td_module_15 td-post-content'); ?>>
            <div class="item-details">
                <?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark" title="%s">', esc_url( get_permalink() ), esc_html( get_the_title() ) ), '</a></h1>' ); ?>
                <div class="meta-info">
                    <!-- category -->
                    <ul class="td-category">
                        <?php
                        $categories = get_the_category();
                        if (!empty($categories)) {
                            foreach ($categories as $category) { ?>
                                <li class="entry-category"><a href="<?php echo esc_url(get_category_link($category->cat_ID)) ?>"><?php echo esc_attr($category->name) ?></a>
                                </li>
                            <?php }
                        } ?>
                    </ul>

                    <!-- author -->
                    <div class="td-post-author-name">
                        <div class="td-author-by"><?php echo esc_html_e('By', 'newsmag') ?></div>
                        <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta( 'ID' ))) ?>"><?php the_author() ?></a>
                        <div class="td-author-line"> - </div>
                    </div>

                    <!-- date -->
                    <span class="td-post-date">
                        <time class="entry-date updated td-module-date" datetime="<?php echo get_the_date('c') ?>" ><?php the_time(get_option('date_format')) ?></time>
                    </span>

                    <!-- comments -->
                    <div class="td-post-comments">
                        <a href="<?php comments_link() ?>"><i class="td-icon-comments"></i><?php comments_number('0','1','%') ?></a>
                    </div>
                </div>

                <!-- image -->
                <?php
                if( get_the_post_thumbnail_url(null, 'medium_large') != false ) { ?>
                    <div class="td-post-featured-image">
                        <figure>
                            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute() ?>">
                                <img class="entry-thumb" src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'medium_large')) ?>" alt="<?php echo esc_attr(strip_tags(the_title())) ?>" title="<?php echo esc_attr(strip_tags(the_title())) ?>" />
                            </a>
                            <figcaption class="wp-caption-text"><?php echo get_the_post_thumbnail_caption() ?></figcaption>
                        </figure>
                    </div>
                <?php } ?>

                <div class="td-post-text-content">
                    <?php the_content(esc_html__('Continue', 'newsmag')) ?>
                </div>
            </div>
        </div>
    <?php
    endwhile; // end loop
} else { ?>
    <div class="no-results td-pb-padding-side">
        <h2><?php esc_html_e('No posts to display', 'newsmag') ?></h2>
    </div>
<?php }

tagdiv_page_generator::get_pagination();