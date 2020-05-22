<?php
    $ts_image_size	= (isset($settings['ts_image_size']))
                  ? $settings['ts_image_size']
                  : 'full'; 
   $show_author_avator = isset($settings['show_author_avator'])?
                        $settings['show_author_avator'] 
                        :'no';    

               ?>

<div class="post-block-item block-item-post style4">
   <div class="row">                    
   <?php while ($query->have_posts()) : $query->the_post();?>

         <?php if ( $query->current_post == 0 ): ?>
            <div class="col-md-12">
               <?php  require DIGIQOLE_EDITOR_ELEMENTOR. '/widgets/style/post-grid/content-style4-a.php'; ?>   
            </div>
         <?php endif ?> <!-- feature item -->
         <div class="col-md-12">
            <div class="post-block-list">
               <div class="post-block-style post-float media">
                                                                  
                     <div class="post-thumb d-flex">
                        <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('digiqole-small'); ?></a>
                     </div>
                     <div class="post-content media-body">
                           <?php if($small_show_cat == 'yes'): ?> 
                              <?php require DIGIQOLE_THEME_DIR . '/template-parts/blog/category/parts/cat-style.php'; ?> 
                           <?php  endif; ?>
                              <h4 class="post-title"><a href="<?php echo esc_url( get_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php echo esc_html(wp_trim_words( get_the_title() ,$post_title_crop,'') );  ?></a></h4>
                              <div class="post-meta">
                           
                              <?php if($show_date == 'yes') { ?>
                                    <span class="post-date"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo get_the_date(get_option('date_format')); ?></span>
                                    
                              <?php } ?>
                        
                              </div>
                              
                        
                     </div><!-- Post content end -->
               </div><!-- Post block style end -->
            </div>
         </div>

   <?php endwhile; ?>
   </div><!-- row -->                     
 </div><!-- block-item6 -->