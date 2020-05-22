<?php
  $show_view_count = (isset($settings['show_view_count'])) 
                     ? $settings['show_view_count'] 
                     : ''; 
  $show_author = (isset($settings['show_author'])) 
                     ? $settings['show_author'] 
                     : 'no'; 
  $show_desc = (isset($settings['show_desc'])) 
                     ? $settings['show_desc'] 
                     : 'no'; 
  $post_sm_title_crop = (isset($settings['post_sm_title_crop'])) 
                     ? $settings['post_sm_title_crop'] 
                     : '20'; 
   $thumb 			= (isset($thumb))
						? $thumb
                  : [600, 398];
   $ts_image_size	= (isset($settings['ts_image_size']))
                      ? $settings['ts_image_size']
                      : 'full';  

?>

<div class="post-block-style">
                                                     
      <div class="post-thumb">
          <div class="item" style="background-image:url(<?php echo esc_attr(esc_url(get_the_post_thumbnail_url(null, 'digiqole-small'))); ?>)">
            <a href="<?php echo esc_url( get_permalink() ); ?>" class="img-link" rel="bookmark" title="<?php the_title_attribute(); ?>"></a>
            <?php if($show_cat == 'yes'): ?> 
                        <?php require DIGIQOLE_THEME_DIR . '/template-parts/blog/category/parts/cat-style.php'; ?>
            <?php endif; ?>
          </div>
      </div>
      <div class="post-content">
         
               <h4 class="post-title">
                   <a href="<?php echo esc_url( get_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                      <?php echo esc_html(wp_trim_words( get_the_title() ,$post_sm_title_crop,'') );  ?>
                    </a>
                </h4>
               <div class="post-meta">
                   
               <?php if($show_date == 'yes') { ?>
                     <span class="post-date"> 
                         <i class="fa fa-clock-o"> </i> 
                         <?php echo get_the_date(get_option('date_format')); ?>
                     </span>
                     
               <?php } ?>
             
               </div>
         
      </div><!-- Post content end -->
</div><!-- Post block style end -->