<?php 
  $blog_popular_post_show = digiqole_option('blog_popular_post_show','no');
  if($blog_popular_post_show!='yes'){
    return;
  }  
   $args = [
      'posts_per_page'           => 5,
      'ignore_sticky_posts' => 1,
      'order'=>'DESC',
      'meta_key' =>'newszone_post_views_count',
      'orderby' =>'meta_value_num',
      'post__not_in' => [get_the_ID()],

      
  ];
  
  $populer_post = new WP_Query( $args ); 
  
?>
<?php if ( $populer_post->have_posts() ) : ?>

<div class="ts-popular-grid-box ">
      <div class="section-heading">
         <h3 class="block-title title-border">
            <span class="title-bg">
               <?php echo esc_html(digiqole_option('blog_popular_post_title','Popular post')); ?>
            </span>
         </h3>
      </div> 
    <div class="popular-grid-slider owl-carousel">
    <?php while ( $populer_post->have_posts() ) : 
              $populer_post->the_post(); 
              $category = get_the_category(); 
    ?>
        <div class="item">
            
            <div class="ts-post-thumb">
                <a href="<?php the_permalink(); ?>">
                    <img class="img-fluid" src="<?php echo esc_url(digiqole_post_thumbnail()); ?>" alt="<?php the_post_thumbnail_caption(); ?>">
                </a>
            </div>
            <div class="post-content">
                <?php require DIGIQOLE_THEME_DIR . '/template-parts/blog/category/parts/cat-style.php'; ?>
               <h3 class="post-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
               </h3>
               <span class="post-date-info">
                    <i class="fa fa-clock-o"></i>
                    <?php echo esc_html( get_the_date() ); ?>
               </span>
            </div>
        </div>
      <?php 
      endwhile; 
     
      ?>
        <?php wp_reset_postdata(); ?>
   </div>
    <!-- most-populers end-->
</div>
<?php endif; ?>