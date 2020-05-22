<?php
/**
 * content.php
 *
 * The default template for displaying content.
 */
      $show_desc = (isset($settings['show_desc'])) 
                        ? $settings['show_desc'] 
                        : '';
      $show_author = (isset($settings['show_author'])) 
                        ? $settings['show_author'] 
                        : digiqole_option( 'blog_author_show', 'yes' );
                        

      $show_date	= (isset($settings['show_date'])) 
                        ? $settings['show_date'] 
                        : digiqole_option( 'blog_date_show', 'yes' );
    
                        
      $show_cat	    = (isset($settings['show_cat'])) 
                        ? $settings['show_cat'] 
                        : digiqole_option( 'blog_cat_show', 'yes' );
      $thumb 					= (isset($thumb))
                        ? $thumb
                        : [600, 398];
      $post_title_crop					= (isset($settings['post_title_crop']))
                        ? $settings['post_title_crop']
                        : 200;
     $ts_image_size	  = (isset($settings['ts_image_size']))
                      ? $settings['ts_image_size']
                      : 'full';  

?>
      <div class="post-block-style clearfix">
         <?php if (  (has_post_thumbnail())  ) { 
           
            ?>
               
            <div class="post-thumb ts-resize">
                  <?php if(get_post_format()=='video'): ?>
                  <?php $video = digiqole_meta_option($query->posts[0]->ID,'featured_video','#');  
                  
                  ?>
                        <div class="post-video-content">
                           <a href="<?php echo esc_url($video); ?>" class="ts-play-btn">
                              <i class="fa fa-play" aria-hidden="true"></i>
                           </a>
                        </div> 
                  <?php endif; ?> 
              
                  <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('full'); ?></a>
            </div>
         <?php } else { ?>
            <div class="post-thumb block6img-blank"></div>
         <?php } ?>
         <div class="post-content">
              <?php if($show_cat == 'yes'):  $cat = get_the_category(); ?> 
                  <a 
                     class="post-cat" 
                     href="<?php echo get_category_link($cat[0]->term_id); ?>" 
                  >
               <?php
                  echo esc_html(get_cat_name($cat[0]->term_id));
                  
               ?>
               </a> 
               <?php  endif; ?>
                  <h4 class="post-title"><a href="<?php echo esc_url( get_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php echo wp_trim_words( get_the_title() ,$post_title_crop,''); ?></a></h4>
         
            <div class="post-meta">
                  <?php if( $show_author == 'yes') { ?>
                     <?php if ( get_the_author_meta('first_name') != "" || get_the_author_meta('last_name') != "" ) { ?>
                        <span class="post-author"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author_meta('first_name');?> <?php echo get_the_author_meta('last_name');?></a></span>
                     <?php } else { ?>
                        <span class="post-author"> <i class="fa fa-user"></i>   <?php the_author_posts_link() ?></span>
                     <?php }?>
                  <?php } ?>
                  <?php if($show_date == 'yes') { ?>
                     <span class="post-date"> <?php echo get_the_date(get_option('date_format')); ?> </span>
                  <?php } ?>
            </div>
            <p><?php echo esc_html( wp_trim_words(get_the_excerpt(),$settings['post_content_crop'],'') );?></p>
            
         </div><!-- Post content end -->
      </div><!-- Post Block style end -->
