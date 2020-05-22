<?php
   /**
    * the template for displaying archive pages.
    */
   
   $category = get_queried_object();
   $blog_sidebar = 3;
   $sidebar_class = 'col-lg-8 col-lg-4 sidebar-right';
   $cat_layout = digiqole_term_option($category->cat_ID, 'block_category_template', 'style1');
   if(isset($category->cat_ID) && digiqole_term_option($category->cat_ID, 'block_sidebar_layout', 'sidebar-right') == 'sidebar-none')
      {
         $sidebar_class = 'col-lg-12 sidebar-none';
         $blog_sidebar = 1;
      }
   get_header(); 
      if($cat_layout != 'style8'){
         get_template_part( 'template-parts/breadcrumb/breadcrumb');
      }

   ?><?php
 
   $permitted_title = ["style1","style4","style6",'style5', "style2", "style3"];

  if( in_array( $cat_layout,$permitted_title ) ) {
    echo '<div class="container">';  
       get_template_part( 'template-parts/blog/category/parts/category', 'title' ); 
    echo '</div>';
  }

?>

<section id="main-content" class="blog main-container" role="main">
   <?php if($cat_layout == 'style8'): ?>
   <!-- banner -->
   <div class="food-banner banner">
      <div class="container">
         <div class="row justify-content-center">
            <div class="col-md-7">
               <div class="banner-content">
                  <h1 class="ts-title">
                     <?php echo esc_html("Category : ","digiqole"); single_cat_title(); ?>
                  </h1>

                  <?php if( digiqole_option( 'blog_breadcrumb_show' ) == 'yes' ) { ?>
                     <?php digiqole_get_breadcrumbs('<i class="fa fa-angle-right"></i>'); ?>
                  <?php  } ?>  
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- banner end -->
   <?php endif; ?>
	<div class="container">
		<div class="row">
	   <?php if($blog_sidebar == 2){
				get_sidebar();
			  }  ?>
			<div class="<?php echo esc_attr($sidebar_class);?>">
				<?php if ( have_posts() ) : ?>
               
              <?php get_template_part( 'template-parts/blog/category/layout', 'layout' ); ?>  
				  <?php get_template_part( 'template-parts/blog/paginations/pagination', 'style2' ); ?>
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