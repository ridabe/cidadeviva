<?php

 $blog_related_post = digiqole_option('blog_related_post','no'); 
 $blog_related_post_number = digiqole_option('blog_related_post_number',3); 

?>
<?php if($blog_related_post=="yes"): ?>
   <div class="ts-related-post"> 
      
         <div class="section-heading heading-style3">
           <h3 class="mb-25">
                  <?php echo esc_html(digiqole_option('blog_related_post_title','Related post')); ?>
            </h3>
         </div>
          <div class="popular-grid-slider owl-carousel">
         <?php 
            $related_post = digiqole_related_posts_by_tags($post->ID,$blog_related_post_number); 
            
           
            if( $related_post->have_posts() ) {
               while ($related_post->have_posts()) : $related_post->the_post(); ?>
              <div class="item item post-block-style">
                  <div class="post-thumb">
                     <a href="<?php the_permalink(); ?>">
                        <img class="img-fluid" src="<?php echo esc_url(digiqole_post_thumbnail()); ?>" alt="<?php the_post_thumbnail_caption(); ?>">
                     </a>
                     <div class="grid-cat">
                        <?php require DIGIQOLE_THEME_DIR . '/template-parts/blog/category/parts/cat-style.php'; ?>
                     </div>
                  </div>
                  <div class="post-content">
                     <h3 class="post-title">
                        <a href="<?php the_permalink(); ?>"><?php echo esc_html(wp_trim_words( get_the_title() ,'7','...') );  ?></a>
                        
                     </h3>
                     <span class="post-date-info">
                        <i class="fa fa-clock-o"></i>
                        <?php echo esc_html( get_the_date() ); ?>
                     </span>
                  </div>
              </div>
         
         <?php endwhile;
         }
           
         wp_reset_postdata();
      ?>
      </div>
   </div> 
<?php endif; ?>
