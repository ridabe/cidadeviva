
<div class="main-content-inner category-layout4 row">
  
   <?php while ( have_posts() ) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class('post-layout col-md-6'); ?>>
         <?php  get_template_part( 'template-parts/blog/category/parts/grid', 'overlay-content' ); ?>
      </article>
   <?php endwhile; ?>

</div>