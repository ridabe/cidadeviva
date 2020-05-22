
<div class="post-block-style">
   <?php if(has_post_thumbnail()): ?>
      <div class="post-thumb">
         <a href="<?php echo esc_url(get_the_permalink()); ?>">
            <img class="img-fluid" src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt=" <?php the_title_attribute(); ?>">
         </a>
         <div class="grid-cat">
            <?php digiqole_category_meta(); ?>
         </div>
      </div>
   <?php endif; ?>
   <div class="post-content">
      <div class="entry-blog-header">
         <h3 class="post-title md">
            <a href="<?php echo esc_url(get_the_permalink()); ?>"><?php echo esc_html(digiqole_get_crop_title(get_the_title())); ?></a>
         </h3>
      </div>
      <div class="post-meta">
         <?php digiqole_category_post_meta(); ?>  
      </div>
      <div class="entry-blog-summery">
         <p><?php  echo digiqole_get_excerpt(); ?></p>
      </div>
   </div>
</div>




