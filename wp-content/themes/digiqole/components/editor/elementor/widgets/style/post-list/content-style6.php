<?php
  $show_view_count = (isset($settings['show_view_count'])) 
                     ? $settings['show_view_count'] 
                     : ''; 
  $show_author = (isset($settings['show_author'])) 
                     ? $settings['show_author'] 
                     : 'no'; 
  $post_title_crop = (isset($settings['post_sm_title_crop'])) 
                     ? $settings['post_sm_title_crop'] 
                     : '35'; 
 
?>

<div class="post-block-style post-float media">
                                                     
      <div class="post-thumb d-flex">
         <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('digiqole-small'); ?></a>
      </div>
      <div class="post-content media-body">
               <?php if($show_cat == 'yes'): ?> 
                  <?php require DIGIQOLE_THEME_DIR . '/template-parts/blog/category/parts/cat-style2.php'; ?>
               <?php  endif; ?>
               <h4 class="post-title"><a href="<?php echo esc_url( get_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php echo esc_html(wp_trim_words( get_the_title() ,$post_title_crop,'') );  ?></a></h4>
               <div class="post-meta">
                    
               <?php if($show_date == 'yes') { ?>
                     <span class="post-date"><i class="fa fa-clock-o" aria-hidden="true"></i>  <?php echo get_the_date(get_option('date_format')); ?></span>
                     
               <?php } ?>
             
               </div>
               
         
      </div><!-- Post content end -->
</div><!-- Post block style end -->