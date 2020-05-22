<?php 
      $category = get_queried_object();
      $sticky = get_option( 'sticky_posts' );
      $cat_layout = digiqole_term_option($category->cat_ID, 'block_category_template', 'style6');
    
      if(!count($sticky) || $cat_layout!='style6' ){
         return; 
      }
      rsort( $sticky );
      $args = array(
         'cat'=> $category->cat_ID,
         'post_type' => 'post',
         'posts_per_page' => 3,
         'post__in' => $sticky,
      );
      $sticky_post = new WP_Query( $args );

?>
   <section class="digiqole-category-style6 styicky-post container">
      <div class="row">
            <div class="col-lg-12 featured-tab-item">
               <div class="tab-content">
                     <?php $i = 0; while ($sticky_post->have_posts()) : $sticky_post->the_post(); $i++; ?>
                        <div class="tab-pane fade <?php echo esc_attr(($i == 1) ? 'show active' : ''); ?>" id="nav-post-tab-<?php echo esc_attr($i); ?>"> 
                              <div class="feauted-tab-img">
                                 <a href="<?php the_permalink(); ?>">
                                    <?php if(has_post_thumbnail()){
                                          the_post_thumbnail();
                                    } ?>
                                 </a>
                              </div>
                        </div>
                     <?php endwhile; 
                     wp_reset_postdata();?>
               </div>
                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs row featured-tab-post" role="tablist">
                     <?php $i = 0; while ($sticky_post->have_posts()) : $sticky_post->the_post(); $i++; ?>
                        <li role="presentation" class="col-lg">
                              <a class="nav-item nav-link <?php echo esc_attr(($i == 1) ? 'active' : ''); ?>" href="#nav-post-tab-<?php echo esc_attr($i); ?>"
                              aria-controls="nav-post-tab-<?php echo esc_attr($i)?>" role="tab" data-toggle="tab">
                                 <div class="post-content">
                                    <h3 class="post-title">
                                          <?php the_title(); ?>
                                    </h3>
                                    <ul class="post-meta-info">
                                          <li class="cat-name">
                                          <?php   
                                             $cat = get_the_category(); ?>
                                             <?php echo get_cat_name($cat[0]->term_id); ?>
                                          </li>
                                          <li>
                                             <?php echo esc_html( get_the_date() ); ?>
                                          </li>
                                    </ul>
                                 </div>
                              </a>
                        </li>
                     <?php endwhile; ?>
                  </ul>

            </div>
      </div>
   </section>