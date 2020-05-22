

<div class="category-main-desc">
   <span> <?php echo category_description(); ?> </span>
</div>

<div class="main-content-inner category-layout7">
   
   <?php while ( have_posts() ) : the_post(); ?>
      <?php if($wp_query->current_post==0): ?>
         <div class="row"> 
            <article id="post-<?php the_ID(); ?>" <?php post_class('post-layout col-md-12 feature-big'); ?>>
                  <?php  get_template_part( 'template-parts/blog/category/parts/grid', 'content-style-2' ); ?>
            </article>
         </div>   
      <?php else: ?>
         <?php if($wp_query->current_post==1): ?>
              <div class="row"> 
         <?php endif; ?> 
                  <article id="post-<?php the_ID(); ?>" <?php post_class('post-layout col-md-6'); ?>>
                     <?php  get_template_part( 'template-parts/blog/category/parts/grid', 'content-style-2-min' ); ?>
                  </article>
         <?php if($wp_query->current_post+1==$wp_query->post_count): ?>
             </div>
         <?php endif; ?> 
      <?php endif; ?> 
   <?php endwhile; ?>
</div>