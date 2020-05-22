<div class="category-main-desc">
   <span> <?php echo category_description(); ?> </span>
</div>
<div class="main-content-inner category-layout6">
    <?php while ( have_posts() ) : the_post(); ?>
      <?php global $wp_query;  
       if($wp_query->current_post == 0) { ?>
         <article id="post-<?php the_ID(); ?>" <?php post_class('post-layout'); ?>>
             <?php  get_template_part( 'template-parts/blog/category/parts/feature', 'content' ); ?>
         </article>
       <?php    
       } else { 
      ?>
         <article id="post-<?php the_ID(); ?>" <?php post_class('post-layout'); ?>>
            <?php  get_template_part( 'template-parts/blog/category/parts/grid', 'content_left_img' ); ?>
         </article>
      <?php } ?> 
   <?php endwhile; ?>
</div>