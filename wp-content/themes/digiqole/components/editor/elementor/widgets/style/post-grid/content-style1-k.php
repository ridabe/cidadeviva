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
  
      $post_content_crop = (isset($settings['post_content_crop'])) 
                           ? $settings['post_content_crop'] 
                           : '20'; 
      $post_sm_title_crop = (isset($settings['post_sm_title_crop'])) 
                           ? $settings['post_sm_title_crop'] 
                           : '20'; 
      $ts_image_size	= (isset($settings['ts_image_size']))
                      ? $settings['ts_image_size']
                      : 'full';  

      $reverse_col   = $settings['reverse_col'];

      $cols = ['order-md-1','order-md-2'];

      if($reverse_col =='yes'){
         $cols = array_reverse($cols);
      }
      $show_author_avator = isset($settings['show_author_avator'])?
                              $settings['show_author_avator'] 
                              :'no';   
  
?>
<div class="post-block-item style3">
   <div class="row">                    
   <?php while ($query->have_posts()) : $query->the_post();?>
      <div class="col-md-3 col-sm-6 feature-grid-content">
            <div class="post-block-style clearfix">
                     <?php if (  (has_post_thumbnail())  ) { ?>
                           
                        <div class="post-thumb ts-resize">
                              <div class="item ts-overlay-style" style="background-image:url(<?php echo esc_attr(esc_url(get_the_post_thumbnail_url(null, 'digiqole-medium'))); ?>)">
                              <a href="<?php the_permalink(); ?>" class="img-link"></a>
                           </div>
                              <?php if($show_cat == 'yes'): ?> 
                                 <div class="grid-cat">
                                    <?php require DIGIQOLE_THEME_DIR . '/template-parts/blog/category/parts/cat-style.php'; ?>
                                 </div>
                              <?php  endif; ?>
                           </div>
                        <div class="post-content">
                        
                     <h4 class="post-title"><a href="<?php echo esc_url( get_permalink()); ?>" rel="bookmark" title="<?php  the_title_attribute(); ?>"><?php echo wp_trim_words( get_the_title() ,$post_title_crop,''); ?></a></h4>
               
                     <div class="post-meta <?php echo esc_attr($show_author_avator == 'yes'?'ts-avatar-container':''); ?> ">
                        <?php if($show_author_avator=='yes'): ?>
                           <?php printf('<span class="ts-author-avatar">%1$s<a href="%2$s">%3$s</a></span>',
                                 get_avatar( get_the_author_meta( 'ID' ), 45 ), 
                                 esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), 
                                 get_the_author()
                              ); ?>
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
                        <p><?php echo esc_html( wp_trim_words(get_the_excerpt(),$post_content_crop,'') );?></p>
                     <?php endif; ?>
                     <?php if($readmore != '') { ?>
                        <a class="post-readmore" href="<?php echo esc_url( get_permalink()); ?>" > <?php echo esc_html($readmore); ?> <i class="fa fa-arrow-right"></i> </a>
                     <?php } ?>
                  
                  </div><!-- Post content end -->

                  <?php } ?>
                  
               </div><!-- Post Block style end -->


         </div><!-- Col end -->
   <?php endwhile; ?>
   </div><!-- row -->                     
 </div><!-- block-item6 -->