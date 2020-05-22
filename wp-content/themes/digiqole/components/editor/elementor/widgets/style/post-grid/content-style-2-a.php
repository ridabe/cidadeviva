<?php
/**
 * content.php
 *
 * The default template for displaying content.
 */
$show_author = (isset($settings['show_author'])) 
						? $settings['show_author'] 
						: digiqole_option( 'blog_author_show', 'yes' );
						

$show_date	= (isset($settings['show_date'])) 
						? $settings['show_date'] 
                  : digiqole_option( 'blog_date_show', 'yes' );
                  
$show_view_count	= (isset($settings['show_view_count'])) 
						? $settings['show_view_count'] 
                  : digiqole_option( 'show_view_count', 'yes' );
                  
$blog_cat_show	   = (isset($settings['show_cat'])) 
						? $settings['show_cat'] 
						: digiqole_option( 'blog_cat_show', 'yes' );
$thumb 					= (isset($thumb))
						? $thumb
                  : [600, 398];
$crop					= (isset($settings['post_title_crop']))
						? $settings['post_title_crop']
                  : 20;
$show_rating     =   (isset($settings['show_rating']))
                      ? $settings['show_rating']
                      :'no'; 
$desc_limit      =   (isset($settings['desc_limit']))
                      ? $settings['desc_limit']
                      :'20'; 
$show_desc       =   (isset($settings['show_desc']))
                      ? $settings['show_desc']
                      :'no'; 
 $loadmore_class = isset($loadmore_class)?$loadmore_class:'';   
 $ts_image_size  = (isset($settings['ts_image_size']))
                      ? $settings['ts_image_size']
                      : 'full';                                  

$show_author_avator = isset($settings['show_author_avator'])?
                      $settings['show_author_avator'] 
                      :'no'; 
?>
<div <?php post_class("loadmore-style2 $loadmore_class"); ?>>
   <div class="post-block-style">
      <?php if (  (has_post_thumbnail())  ) { ?>

         <div class="post-thumb ts-resize">
            <?php if(get_post_format()=='video'): ?>
            <?php $video = digiqole_meta_option(get_the_ID(),'featured_video','#');  
            
            ?>
                  <div class="post-video-content">
                     <a href="<?php echo esc_url($video); ?>" class="ts-play-btn">
                        <i class="fa fa-play" aria-hidden="true"></i>
                     </a>
                  </div> 
            <?php endif; ?> 
         
            <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('digiqole-medium'); ?></a>
              
               <?php if($blog_cat_show == 'yes'): ?> 
                  <div class="grid-cat">
                     <?php require DIGIQOLE_THEME_DIR . '/template-parts/blog/category/parts/cat-style.php'; ?>
                  </div>
               <?php  endif; ?>

            <?php if($show_rating=='yes'): ?> 
               <?php digiqole_review_score_limit(); ?>
            <?php endif; ?>  
            
         </div>
      <div class="post-content">
   
         
      <h4 class="post-title"><a href="<?php echo esc_url( get_permalink()); ?>" rel="bookmark" title="<?php  the_title_attribute(); ?>"><?php echo wp_trim_words( get_the_title() ,$crop,''); ?></a></h4>

      <div class="post-meta <?php echo esc_attr($show_author_avator=='yes'?'ts-avatar-container':''); ?>">
         <?php if($show_author_avator == 'yes'): ?>
                        
               <?php  printf('<span class="ts-author-avatar">%1$s<a href="%2$s">%3$s</a></span>',
                     get_avatar( get_the_author_meta( 'ID' ), 45 ), 
                     esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), 
                     get_the_author()
                  );
               ?>

         <?php endif; ?>
         <?php if( $show_author == 'yes') { ?>
            <?php if ( get_the_author_meta('first_name') != "" || get_the_author_meta('last_name') != "" ) { ?>
               <span class="post-author"><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html(get_the_author_meta('first_name'));?> <?php echo esc_html(get_the_author_meta('last_name'));?></a></span>
            <?php } else { ?>
               <span class="post-author"> 
               <i class="fa fa-user"></i>
               <?php the_author_posts_link() ?></span>
            <?php }?>
         <?php } ?>
         <?php if($show_date == 'yes') { ?>
            <span class="post-date"> 
               <i class="fa fa-clock-o" aria-hidden="true"></i> 
               <?php echo get_the_date(get_option('date_format')); ?>

            </span>
         <?php } ?>
         <?php if($show_view_count == 'yes'){ ?>
            <span class="post-view">
            <i class="icon icon-fire"></i>
               <?php echo digiqole_get_postview(get_the_ID()); ?>
            </span>   
         <?php } ?>
         
      </div>
      <?php if($show_desc == 'yes'): ?>
         <p><?php echo esc_html( wp_trim_words(get_the_excerpt(),$desc_limit,'') );?></p>
      <?php endif; ?>
     
   
   </div><!-- Post content end -->

   <?php } ?>
   
</div><!-- Post Block style end -->
</div>
