<?php
/**
 * The main template file
 */

get_header();  

$blog_sidebar =  digiqole_option('post_sidebar_layout', 'sidebar-right', false);
$blog_sidebar =  $blog_sidebar=='sidebar-none'?1:3;

$column = ($blog_sidebar == 1 || !is_active_sidebar('sidebar-1')) ? 'col-lg-12' : 'col-lg-8 col-md-12';


?>
<section id="main-content" class="blog main-container" role="main">
	<div class="container">
     <div class="row">
       <?php if($blog_sidebar == 2){
				get_sidebar();
			  }  ?>
			<div class="<?php echo esc_attr($column);?>">
				<?php if ( have_posts() ) : ?>
				
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'template-parts/blog/contents/content', get_post_format() ); ?>
					<?php endwhile; ?>

					<?php get_template_part( 'template-parts/blog/paginations/pagination', 'style1' ); ?>
				<?php else : ?>
					<?php get_template_part( 'template-parts/blog/contents/content', 'none' ); ?>
				<?php endif; ?>
			</div><!-- .col-md-8 -->

         <?php if($blog_sidebar == 3){
				get_sidebar();
			  }  ?>
		</div><!-- .row -->
	</div><!-- .container -->
</section><!-- #main-content -->
<?php get_footer(); ?>