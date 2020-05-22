<?php
/**
 * the template for displaying all posts.
 */

 
   $override = (digiqole_post_option(get_the_ID(), 'override_default', 'no') == 'yes') ? true : false;
   $layout = digiqole_option('post_header_layout', 'style1', $override);

   $blog_sidebar =  digiqole_option('post_sidebar_layout', 'sidebar-right', $override);
   $blog_sidebar =  $blog_sidebar == 'sidebar-none'?1:3;
   $column = ($blog_sidebar == 1 || !is_active_sidebar('sidebar-1')) ? 'col-lg-12' : 'col-lg-8 col-md-12';
   if($layout== 'style6'){
      $blog_sidebar = 1;
      $column = 'col-lg-9 mx-auto';

   }
 
   get_header(); 

   if($layout != 'style8'){
      get_template_part( 'template-parts/breadcrumb/breadcrumb');
   }
?>

<div id="main-content" class="main-container blog-single <?php echo esc_attr('post-layout-'.$layout); ?>"  role="main">
   
   <?php if($layout == 'style8'): ?>
         <!-- banner -->
         <div class="food-banner banner">
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-md-7">
                     <div class="banner-content">
                        <h1 class="ts-title">
                           <?php the_title(); ?>
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
           <?php
              get_template_part( 'template-parts/blog/single/header/content', $layout ); 
           ?> 
        </div>   
        <div class="row">
        <?php if($blog_sidebar == 2){
				get_sidebar();
			  }  ?>
            <div class="<?php echo esc_attr($column);?>">
            <?php while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(["post-content","post-single"]); ?>>
                  <?php get_template_part( 'template-parts/blog/single/content', $layout ); ?>
               </article>
               
               <?php get_template_part( 'template-parts/blog/post-parts/part', 'author' ); ?>
               <?php digiqole_post_nav(); ?>
               <?php do_action('digiqole_review_kit');?>
              
               <?php
                  get_template_part( 'template-parts/blog/post-parts/part', 'related-post' );
                  comments_template(); 
               ?>
				<?php endwhile; ?>
            </div> <!-- .col-md-8 -->
            <?php if($blog_sidebar == 3){
				get_sidebar();
			  }  ?>
         
        </div> <!-- .row -->
     
    </div> <!-- .container -->
</div> <!--#main-content -->
<?php get_footer(); ?>