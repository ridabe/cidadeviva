
<div class="block-item-post style9">
   <?php 
   $ts_image_size	= (isset($settings['ts_image_size']))
                     ? $settings['ts_image_size']
                     : 'full';  
   $show_author_avator = isset($settings['show_author_avator'])?
                         $settings['show_author_avator'] 
                         :'no';
   $show_rating      =   (isset($settings['show_rating'])) ? $settings['show_rating'] :'no'; 
   ?>      
   <div class="row">
                   
      <?php while ($query->have_posts()) : $query->the_post();?>
            <?php  $cat = get_the_category(); 
            $post_id = get_the_ID();
            ?>
            
            <div class="col-md-6 col-lg-<?php echo esc_attr($grid_column); ?>">
               <div <?php post_class(" ts-overlay-review-style featured-post ts-review-post post-block-style11"); ?>>
                  <div class="item ts-overlay-style item-before" style="background-image:url(<?php echo esc_attr(esc_url(get_the_post_thumbnail_url())); ?>)">
                     <a class="img-link" href="<?php the_permalink(); ?>"></a> 
                     
                     <div class="overlay-post-content">
                        <div class="post-content text-center">

                           <div class="grid-category">
                              <?php if($show_cat == 'yes'): ?> 
                                    <?php require DIGIQOLE_THEME_DIR . '/template-parts/blog/category/parts/cat-style.php'; ?>
                                 <?php  endif; ?>
                           </div>

                           <h4 class="post-title md"><a href="<?php echo esc_url( get_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php echo wp_trim_words( get_the_title() ,$post_title_crop,''); ?></a></h4>
                        
                           <div class="post-meta <?php echo esc_attr($show_author_avator == 'yes'?'ts-avatar-container':''); ?>">
                                 <?php if($show_author_avator=='yes'): ?>
                                       <?php printf('<span class="ts-author-avatar">%1$s<a href="%2$s">%3$s</a></span>',
                                             get_avatar( get_the_author_meta( 'ID' ), 45 ), 
                                             esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), 
                                             get_the_author()
                                          ); ?>
                                       <?php endif; ?>  
                                       <?php if( $show_author == 'yes') { ?>
                                          <?php if ( get_the_author_meta('first_name') != "" || get_the_author_meta('last_name') != "" ) { ?>
                                             <span class="post-author"><i class="fa fa-user"></i><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author_meta('first_name');?> <?php echo get_the_author_meta('last_name');?></a></span>
                                          <?php } else { ?>
                                             <span class="post-author"> <i class="fa fa-user"></i> <?php the_author_posts_link() ?></span>
                                          <?php }?>
                                       <?php } ?>
                                       <?php if($show_date == 'yes') { ?>
                                          <span class="post-date"><i class="fa fa-clock-o"></i> <?php echo get_the_date(get_option('date_format')); ?></span>
                                       <?php } ?>
                                       <?php if($show_view_count == 'yes'){ ?>
                                          <span class="post-view">
                                          <i class="icon icon-fire"></i>
                                             <?php echo digiqole_get_postview(get_the_ID()); ?>
                                          </span>   
                                       <?php } ?>
                                       
                                 </div>
                                 
                                 <?php if($show_rating=='yes'): ?>
                                    <div class="post-review">
                                       <?php echo do_shortcode("[wp-reviews-rating post-id='$post_id' ratting-show='yes' count-show='no' vote-show='yes' vote-text='Votes' class='']"); ?>
                                    </div>
                                 <?php endif; ?>
                                       
                                 <p><?php echo esc_html( wp_trim_words(get_the_excerpt(),$post_content_crop,'') );?></p>
                                 
                                 <?php if($readmore != '') { ?>
                                    <a class="post-readmore" href="<?php echo esc_url( get_permalink()); ?>" > <?php echo esc_html($readmore); ?> <i class="icon icon-arrow-right"></i> </a>
                                 <?php } ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>   <!-- col end --> 
      <?php endwhile; ?>
               
   </div>              
 </div><!-- block-item6 -->