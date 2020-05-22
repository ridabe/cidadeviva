
<div class="main-content-inner row category-layout1">
  
<?php while ( have_posts() ) : the_post(); ?>
   <article id="post-<?php the_ID(); ?>" <?php post_class('post-layout col-md-6'); ?>>
 		<?php  get_template_part( 'template-parts/blog/category/parts/grid', 'content' ); ?>
   </article>
<?php endwhile; ?>

</div>