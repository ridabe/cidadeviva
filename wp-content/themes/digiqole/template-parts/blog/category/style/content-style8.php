
<div class="main-content-inner category-layout4 category-layout8 row">
  
   <?php while ( have_posts() ) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class('post-layout col-md-4'); ?>>
         <?php  get_template_part( 'template-parts/blog/category/parts/grid', 'overlay-content-review' ); ?>
      </article>
   <?php endwhile; ?>

</div>