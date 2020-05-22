<?php
/**
 * content.php
 *
 * The default template for displaying content.
 */
$blog_author_show = (isset($settings['show_author'])) 
						? $settings['show_author'] 
						: digiqole_option( 'blog_author_show', 'yes' );
						
$blog_date_show			= (isset($settings['show_date'])) 
						? $settings['show_date'] 
						: digiqole_option( 'blog_date_show', 'yes' );
$blog_cat_show			= (isset($settings['show_cat'])) 
						? $settings['show_cat'] 
						: digiqole_option( 'blog_cat_show', 'yes' );
$thumb 					= (isset($thumb))
						? $thumb
						: [600, 398];
$crop					= (isset($settings['post_title_crop']))
                        ? $settings['post_title_crop'] : 8;
$show_view_count		= (isset($settings['show_view_count']))
						? $settings['show_view_count']: 'yes';
$cat = get_the_category();
?>
   <div class="post-video">
      <a href="<?php 
      $video_url = digiqole_post_option( get_the_ID(), 'featured_video' );
      echo esc_url($video_url);?>" class="ts-play-btn">
         <i class="fa fa-play" aria-hidden="true"></i>
      </a>
   </div>
   <div class="post-content">
        <?php if($blog_cat_show=="yes"): ?> 
           <?php require DIGIQOLE_THEME_DIR . '/template-parts/blog/category/parts/cat-style.php'; ?>
         <?php endif; ?>   
        <h4 class="post-title md">
            <a href=" <?php echo esc_url(get_post_permalink()); ?> " > <?php the_title(); ?> </a>
        </h4>
        <ul class="post-meta-info">
          <?php if($blog_date_show == 'yes'): ?>
            <li class="post-date">
                <i class="fa fa-clock-o"></i>
                <?php echo get_the_date(get_option('date_format')); ?>
            </li> 
          <?php endif; ?>    
            <?php if($show_view_count == 'yes'): ?>
            <li class="post-view">
                <i class="icon icon-eye"></i>
                <?php echo digiqole_get_postview(get_the_ID()); ?>
            </li> 
            <?php endif; ?>   
        </ul> 
   </div>


