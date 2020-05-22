<?php 

 $category          = get_category( get_query_var( 'cat' ) );
 $feature_post_show = digiqole_term_option($category->cat_ID,'block_featured_post', []); 
 if($feature_post_show == 'yes'){

  ?>
  <?php 

   $arguments = array(
      'cat' => $category->term_id,
      'posts_per_page' => 6,
      'orderby'     =>  'date',
      'order' => 'DESC', 
      'suppress_filters' => true,
      'meta_query' => array(
         array(
            'key' => 'digiqole_featured_post',
            'value' => 'yes', 
            
         ),
      ) ,
   );

   $featured_post = new \WP_Query($arguments);
   if(!$featured_post->post_count) {
   return; 

   }
?>

   <div class="feature-post row">
        <h1> <?php echo esc_html__('Feature post','digiqole'); ?> </h1>
            <div class="category-feature-slider owl-carousel">
                <?php while ( $featured_post->have_posts() ) : $featured_post->the_post(); ?>
                <div class="col-md-12">
                    <div class="item">
                        <img class="card-img-top mb-25" src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php the_title_attribute(); ?>">
                        <div class="post-content">
                            <h5 class="card-title post-title md"> <a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a> </h5>
                        </div>
                    </div>
                </div>
            <?php 
                endwhile; 
                wp_reset_postdata();
            ?> 
        </div>
   </div>
  <?php 
 }
 
?>

