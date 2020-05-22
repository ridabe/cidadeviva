<?php
      
      $show_view_count = (isset($settings['show_view_count'])) 
                           ? $settings['show_view_count'] 
                           : ''; 
      $show_author = (isset($settings['show_author'])) 
                           ? $settings['show_author'] 
                           : 'no'; 
      $ts_image_size	= (isset($settings['ts_image_size']))
                      ? $settings['ts_image_size']
                      : 'full';  
          
      $reverse_col = $settings['reverse_col'];
      $cols        = ['order-md-1','order-md-2'];

      if($reverse_col =='yes'){
         $cols = array_reverse($cols);
      }

      $show_author_avator = isset($settings['show_author_avator'])?
                              $settings['show_author_avator'] 
                              :'no';   


 
?>
<div class="post-block-item block-item-post style2">
   <div class="row">                    
   <?php while ($query->have_posts()) : $query->the_post();?>

         <?php if ( $query->current_post == 0 ): ?>
              <div class="col-md-6 col-sm-6 <?php echo esc_attr($cols[0]); ?>">
              <?php  require DIGIQOLE_EDITOR_ELEMENTOR. '/widgets/style/post-grid/slider-style2.php'; ?>    
              </div>

            <?php else: ?>
            <?php if ( $query->current_post == 1 ): ?>
               <div class="col-md-6 col-sm-6 <?php echo esc_attr($cols[1]); ?>">
            <?php endif; ?> 

            <div class="post-block-list">
               <div class="post-block-style post-float media">                   
                     <div class="post-thumb d-flex">
                        <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('digiqole-small'); ?></a>
                     </div>
                     <div class="post-content media-body">
                          <?php if($show_cat == 'yes'): ?> 
                                 <?php require DIGIQOLE_THEME_DIR . '/template-parts/blog/category/parts/cat-style.php'; ?>
                           <?php endif; ?>
                           <h4 class="post-title"><a href="<?php echo esc_url( get_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php echo esc_html(wp_trim_words( get_the_title() ,$post_title_crop,'') );  ?></a></h4>
                           <div class="post-meta">
                              <?php if($show_date == 'yes') { ?>
                                    <span class="post-date"><i class="fa fa-clock-o" aria-hidden="true"></i>  <?php echo get_the_date(get_option('date_format')); ?></span>
                                    
                              <?php } ?>
                           </div>
                     </div><!-- Post content end -->
               </div><!-- Post block style end -->
            </div>
            
            <?php if (($query->current_post + 1) == ($query->post_count)) {?>
                  
               </div><!-- List post Col end -->
                  <?php } ?> 
         <?php endif ?> <!-- feature item -->

   <?php endwhile; ?>
   </div><!-- row -->                     
 </div><!-- block-item6 -->