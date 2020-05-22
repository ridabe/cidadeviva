
<div class="post-block-style">
      <div class="entry-blog-header feature">
        <?php digiqole_category_meta(); ?>
         <h2 class="post-title lg">
            <a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a>
         </h2>
      </div>
      <div class="entry-blog-meta feature">
         <?php digiqole_category_post_meta(); ?>  
      </div>
   <?php if(has_post_thumbnail()): ?>
      <div class="post-thumb post-image">
         <a href="<?php echo esc_url(get_the_permalink()); ?>">
            <img class="img-fluid" src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt=" <?php the_title_attribute(); ?>">
         </a>
      </div>
   <?php endif; ?>
   <div class="post-content">
      <div class="entry-blog-summery">
         <?php echo the_excerpt(); ?>
      </div>
     
   </div>
</div>




