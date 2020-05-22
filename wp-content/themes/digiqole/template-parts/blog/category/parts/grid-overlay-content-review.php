<?php
/**
 * content.php
 *
 * The default template for displaying content.
 */
$blog_author_show = (isset($settings['show_author'])) 
						? $settings['show_author'] 
                  : digiqole_option( 'blog_list_author_show', 'yes' );
$show_author_avator = (isset($settings['show_author_avator'])) 
						? $settings['show_author_avator'] 
						: digiqole_option( 'blog_author_avatar_show', 'no' );
						

$blog_date_show	= (isset($settings['show_date'])) 
						? $settings['show_date'] 
                  : digiqole_option( 'blog_list_date_show', 'yes' );
                  
$show_view_count	= (isset($settings['show_view_count'])) 
						? $settings['show_view_count'] 
                  : digiqole_option( 'show_view_count', 'yes' );
                  
$blog_cat_show	    = (isset($settings['show_cat'])) 
						? $settings['show_cat'] 
						: digiqole_option( 'blog_list_cat_show', 'yes' );
$thumb 					= (isset($thumb))
						? $thumb
                  : [600, 398];
$crop					= (isset($settings['post_title_crop']))
						? $settings['post_title_crop']
                  : 20;
$show_rating      =   (isset($settings['show_rating']))
                      ? $settings['show_rating']
                      :'no'; 
 $loadmore_class = isset($loadmore_class)?$loadmore_class:'';                                   

?>
<div <?php post_class("ts-overlay-style ts-overlay-review-style featured-post $loadmore_class"); ?>>
   <div class="item item-before" style="background-image:url(<?php echo esc_attr(esc_url(get_the_post_thumbnail_url())); ?>)">
      <a class="img-link" href="<?php the_permalink(); ?>"></a>
      <?php if($show_rating=='yes'): ?> 
         <?php digiqole_review_score_limit(); ?>
      <?php endif; ?>  
      
      <div class="overlay-post-content">
         <div class="post-content">

            <div class="grid-category">
               <?php if($blog_cat_show == 'yes'): ?> 
                  <?php require DIGIQOLE_THEME_DIR . '/template-parts/blog/category/parts/cat-style.php'; ?>
               <?php endif; ?>
            </div>

            <h3 class="post-title md">
               <a href="<?php the_permalink(); ?>">
                  <?php if(is_category()): ?> 
                     <?php echo digiqole_get_crop_title(get_the_title()); ?>
                  <?php else: ?>
                    <?php echo esc_html(wp_trim_words(get_the_title(), $crop,'')); ?>
                  <?php endif; ?>  
               </a>
            </h3>
           
            <ul class="post-meta-info <?php echo esc_attr($show_author_avator=='yes'?'ts-avatar-container':''); ?>">
              <?php if($show_author_avator=='yes'): ?>
                   <?php printf('<li class="post-author">%1$s<a href="%2$s">%3$s</a></li>',
                        get_avatar( get_the_author_meta( 'ID' ), 45 ), 
                        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), 
                        get_the_author()
                     ); ?>
               <?php endif; ?>
               <?php if($blog_author_show == 'yes'): ?>
                  <li class="author">
                    <i class="fa fa-user"></i>
                     <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                          <?php echo esc_html(get_the_author_meta('display_name')); ?>
                     </a>
                  </li>
               <?php endif; ?>
               <?php if($blog_date_show == 'yes'): ?>
                  <li>
                     <i class="fa fa-clock-o"></i>
                     <?php  echo esc_html(get_the_date()); ?>
                  </li>
               <?php endif; ?>

            </ul>
         </div>
      </div>
   </div>
</div>
