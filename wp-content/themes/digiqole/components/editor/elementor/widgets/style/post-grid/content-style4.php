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
$ts_image_size			= (isset($settings['ts_image_size']))
                      ? $settings['ts_image_size']
                      : 'full';  

   $reverse_col = $settings['reverse_col'];
   $cols = ['order-md-1','order-md-2'];
   if($reverse_col =='yes'){
      $cols = array_reverse($cols);
   }
?>
<div class="post-block-item style5">
   <div class="row">                    
   <?php while ($query->have_posts()) : $query->the_post();?>

         <?php if ( $query->current_post == 0 ): ?>
         
             <div class="col-xl-6 bg-feature-post <?php echo esc_attr($cols[0]); ?>">
                <?php  require DIGIQOLE_EDITOR_ELEMENTOR. '/widgets/style/post-grid/content-style4-a.php'; ?>
            </div><!-- Col end -->
            <?php else: ?>
            <?php if ( $query->current_post == 1 ): ?>
               <div class="col-xl-6 <?php echo esc_attr($cols[1]); ?>">
                  <div class="row">    
            <?php endif; ?> 
                      <div class="col-md-6 col-sm-6">
                        
                        <div class="post-block-style post-float clearfix">
                                                     
                           <div class="post-thumb">
                              <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('digiqole-small'); ?></a>
                              <?php if($show_cat == 'yes'): ?> 
                                    <div class="grid-cat">
                                      <?php require DIGIQOLE_THEME_DIR . '/template-parts/blog/category/parts/cat-style.php'; ?>
                                    </div>
                                 <?php endif; ?>
                           </div>
                           <div class="post-content">
                                 
                                    <h4 class="post-title"><a href="<?php echo esc_url( get_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php echo esc_html(wp_trim_words( get_the_title() ,$post_title_crop,'') );  ?></a></h4>
                                    <div class="post-meta">
                                    <?php if( $show_author == 'yes') { ?>
                                          <?php if ( get_the_author_meta('first_name') != "" || get_the_author_meta('last_name') != "" ) { ?>
                                             <span class="post-author">
                                                <i class="fa fa-user"></i>  
                                                <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author_meta('first_name');?> <?php echo get_the_author_meta('last_name');?></a></span>
                                          <?php } else { ?>
                                                
                                             <span class="post-author"> 
                                                <i class="fa fa-user"></i> 
                                                <?php the_author_posts_link() ?>
                                             </span>
                                          <?php }?>
                                    <?php }?>      
                                    <?php if( $show_date == 'yes' ) { ?>
                                          <span class="post-date"> 
                                             <i class="fa fa-clock-o"> </i> 
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
                                          <p> 
                                             <?php echo esc_html(wp_trim_words(get_the_content(),$post_content_crop,'')); ?>
                                       </p>
                                    <?php endif; ?> 
                              
                           </div><!-- Post content end -->
                        </div><!-- Post block style end -->
                      </div>   
                 <?php if (($query->current_post + 1) == ($query->post_count)) {?>
                   </div>
               </div><!-- List post Col end -->
                  <?php } ?> 
         <?php endif ?> <!-- feature item -->

   <?php endwhile; ?>
   </div><!-- row -->                     
 </div><!-- block-item6 -->
