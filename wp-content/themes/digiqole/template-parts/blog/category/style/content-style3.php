

<div class="main-content-inner category-layout3">
  
<?php while ( have_posts() ) : the_post(); ?>
   <article id="post-<?php the_ID(); ?>" <?php post_class('post-layout'); ?>>
 		<?php  get_template_part( 'template-parts/blog/category/parts/grid', 'content' ); ?>
   </article>
<?php endwhile; ?>

</div>