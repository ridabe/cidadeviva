<?php
/**
 * The single post loop Default template
 **/

if (have_posts()) {
    the_post();
    ?>

    <article id="post-<?php echo get_the_ID() ?>" class="<?php echo join(' ', get_post_class());?>" itemscope itemtype="<?php echo tagdiv_global::$http_or_https ?>//schema.org/Article">
        <div class="td-post-header td-pb-padding-side">
            <?php echo tagdiv_page_generator::get_breadcrumbs(array(
                    'template'=>'single',
                    'title'=>get_the_title()
            )) ?>

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

            <header>
                <!-- title -->
                <h1 class="entry-title"><?php echo get_the_title() ?></h1>

                <div class="meta-info">
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
            </header>
        </div>

        <div class="td-post-content td-pb-padding-side">
            <!-- image -->
            <?php
            if(has_post_thumbnail()) { ?>
            <div class="td-post-featured-image">
                <figure>
                    <img class="entry-thumb" src="<?php echo esc_url(get_the_post_thumbnail_url()) ?>" alt="<?php echo esc_attr(strip_tags(the_title())) ?>" title="<?php echo esc_attr(strip_tags(the_title())) ?>" />
                    <figcaption class="wp-caption-text"><?php echo get_the_post_thumbnail_caption() ?></figcaption>
                </figure>
            </div>
            <?php
            } ?>

            <?php the_content(esc_html__('Continue', 'newsmag')) ?>
        </div>

        <footer>
            <?php
            // post pagination
            wp_link_pages(array(
                'before' => '<div class="page-nav page-nav-post td-pb-padding-side">',
                'after' => '</div>',
                'link_before' => '<div>',
                'link_after' => '</div>',
                'nextpagelink'     => '<i class="td-icon-menu-right"></i>',
                'previouspagelink' => '<i class="td-icon-menu-left"></i>'
            ));

            // tags
            $td_post_tags = get_the_tags();
            if (!empty($td_post_tags)) { ?>
                <div class="td-post-source-tags td-pb-padding-side">
                    <ul class="td-tags td-post-small-box clearfix">
                        <li><span><?php esc_html_e('TAGS', 'newsmag') ?></span></li>
                        <?php
                        foreach ($td_post_tags as $tag) { ?>
                            <li><a href="<?php echo esc_url(get_tag_link($tag->term_id)) ?>"><?php echo esc_html($tag->name) ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php }

            // next/prev posts
            $next_post = get_next_post();
            $prev_post = get_previous_post();

            if (!empty($next_post) or !empty($prev_post)) { ?>
                <div class="td-block-row td-post-next-prev">
                <?php
                if (!empty($prev_post)) { ?>
                    <div class="td-block-span6 td-post-prev-post">
                        <div class="td-post-next-prev-content"><span><?php esc_html_e('Previous article', 'newsmag') ?></span>
                            <a href="<?php echo esc_url(get_permalink($prev_post->ID)) ?>"><?php echo get_the_title( $prev_post->ID ) ?></a>
                        </div>
                    </div>
                <?php
                } else { ?>
                    <div class="td-block-span6 td-post-prev-post"></div>
                <?php
                } ?>

                    <div class="td-next-prev-separator"></div>

                <?php
                if (!empty($next_post)) { ?>
                    <div class="td-block-span6 td-post-next-post">
                        <div class="td-post-next-prev-content"><span><?php esc_html_e('Next article', 'newsmag') ?></span>
                            <a href="<?php echo esc_url(get_permalink($next_post->ID)) ?>"><?php echo get_the_title( $next_post->ID ) ?></a>
                        </div>
                    </div>
                <?php
                } ?>
                </div>
                <?php
            } ?>

            <!-- author box -->
            <?php
            $author_id = get_the_author_meta( 'ID' );
            ?>
            <div class="author-box-wrap">
               <a href="<?php echo esc_url(get_author_posts_url($author_id)) ?>">
                   <?php echo get_avatar(get_the_author_meta('email', $author_id), '96') ?>
               </a>

               <div class="desc">
                   <div class="td-author-name vcard author"><span class="fn">
                       <a href="<?php echo esc_url(get_author_posts_url($author_id)) ?>"><?php echo get_the_author_meta('display_name', $author_id) ?></a>
                   </span></div>

                   <?php  if (get_the_author_meta('user_url', $author_id) != '') { ?>
                       <div class="td-author-url"><a href="<?php echo esc_url(get_the_author_meta('user_url', $author_id)) ?>"><?php echo esc_url(get_the_author_meta('user_url', $author_id)) ?></a></div>
                   <?php } ?>

                   <div class="td-author-description">
                       <?php echo esc_html(get_the_author_meta('description', $author_id)) ?>
                   </div>
                   <div class="clearfix"></div>
               </div>
           </div>


        </footer>

    </article> <!-- /.post -->

<?php }