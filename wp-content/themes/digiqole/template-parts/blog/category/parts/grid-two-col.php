
<div class="entry-blog">
   <?php if(has_post_thumbnail()): ?>
      <div class="post-media post-image">

      <a href="<?php echo esc_url(get_the_permalink()); ?>">
            <img class="img-fluid" src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt=" <?php the_title_attribute(); ?>">
      </a>
      </div>
   <?php endif; ?>
   <div class="post-body">
      <div class="entry-blog-header">
         <?php digiqole_category_meta(); ?>
         <h2 class="entry-title">
            <a href="<?php echo esc_url(get_the_permalink()); ?>"><?php echo esc_html( digiqole_get_crop_title(get_the_title()) ); ?></a>
         </h2>
      </div>
      <div class="entry-blog-meta">
         <?php digiqole_category_post_meta(); ?>  
      </div>
      <div class="entry-blog-summery">
         <?php echo digiqole_get_excerpt(); ?>
      </div>
   </div>
</div>




