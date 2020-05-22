<?php 

$show_author_avator = isset($settings['show_author_avator'])?
                     $settings['show_author_avator'] 
                     :'no'; 
$show_rating      =   (isset($settings['show_rating'])) ? $settings['show_rating'] :'no'; 
$post_id = get_the_ID();

?>

<div class="post-block-style clearfix">
                     <?php if (  (has_post_thumbnail())  ) { ?>
                           
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
                        <div class="post-content">
                        <?php if($show_cat == 'yes'): ?> 
                          <?php require DIGIQOLE_THEME_DIR . '/template-parts/blog/category/parts/cat-style.php'; ?>
                       <?php  endif; ?>
                        
                      <h4 class="post-title"><a href="<?php echo esc_url( get_permalink()); ?>" rel="bookmark" title="<?php  the_title_attribute(); ?>"><?php echo wp_trim_words( get_the_title() ,$post_title_crop,''); ?></a></h4>
               
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
                       <?php if($show_rating=='yes'): ?>
                           <div class="post-review">
                              <?php echo do_shortcode("[wp-reviews-rating post-id='$post_id' ratting-show='yes' count-show='no' vote-show='yes' vote-text='Votes' class='']"); ?>
                           </div>
                        <?php endif; ?>
                        
                      <?php if($show_desc == 'yes'): ?>
                         <p><?php echo esc_html( wp_trim_words(get_the_excerpt(),$post_content_crop,'') );?></p>
                      <?php endif; ?>
                      <?php if($readmore != '') { ?>
                         <a class="post-readmore" href="<?php echo esc_url( get_permalink()); ?>" > <?php echo esc_html($readmore); ?> <i class="icon icon-arrow-right"></i> </a>
                      <?php } ?>
                  
                   </div><!-- Post content end -->
  
                  <?php } ?>
                  
</div><!-- Post Block style end -->