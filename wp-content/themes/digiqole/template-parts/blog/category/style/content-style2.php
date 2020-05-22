
<div class="category-main-desc">
   <span> <?php echo category_description(); ?> </span>
</div>
<div class="main-content-inner category-layout2">
  <div class="row"> 
   <?php while ( have_posts() ) : the_post(); ?>
      
      <article id="post-<?php the_ID(); ?>" <?php post_class('post-layout col-md-12'); ?>>
         <?php  get_template_part( 'template-parts/blog/category/parts/grid', 'content_left_img' ); ?>
      </article>

   <?php endwhile; ?>
   </div>
</div>