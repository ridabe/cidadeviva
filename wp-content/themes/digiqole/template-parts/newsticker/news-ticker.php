<?php 
   $newsticker_enable = digiqole_option('newsticker_enable');
   if($newsticker_enable!='yes'){
      return;
   }
   $newsticker_nav_enable    = digiqole_option('newsticker_nav_enable');
   $newsticker_post_order_by = digiqole_option('newsticker_post_order_by');
   $count   = digiqole_option('newsticker_post_number',5);
   $category_list = [];
   if( $newsticker_post_order_by=='category' && defined( 'FW' ) ) {
      $category_list = digiqole_option('newsticker_post_by_choice')['category']['newsticker_post_category'];
   }
   $tag_list = [];
   if( $newsticker_post_order_by=='tag' && defined( 'FW' ) ) {
      $tag_list = digiqole_option('newsticker_tag_by_choice')['tag']['newsticker_post_tag'];
   }
   $query_arg = array(
      'post_type'      => 'post',
      'posts_per_page' => esc_attr($count),
      'orderby'        =>'date',
		'order'          => 'DESC',
      'post_status'     => 'publish',
      'ignore_sticky_posts' => 1
     		
   );

   if ($newsticker_post_order_by == 'trending') {

      $query_arg['meta_key'] = 'newszone_post_views_count';
      $query_arg['orderby'] = 'meta_value_num';
      
   }  

   if($newsticker_post_order_by == 'category'){
      $query_arg['meta_key'] = 'newszone_post_views_count';
      $query_arg['orderby'] = 'meta_value_num';
      $query_arg['tax_query'] = array(

         array(
             'taxonomy' => 'category',
             'field'    => 'term_id',
             'terms'    => $category_list,
         ),

      );
    
   }
   if($newsticker_post_order_by == 'tag'){
      $query_arg['meta_key'] = 'newszone_post_views_count';
      $query_arg['orderby'] = 'meta_value_num';
      $query_arg['tax_query'] = array(
         array(
             'tag__in' => $tag_list,
         ),
      );
    
   }
   
   $news_ticker_post = new WP_Query($query_arg);

   if ($news_ticker_post->have_posts()) { 

   ?>

   <div class="tranding-bar">
				<div id="tredingcarousel" class="trending-slide carousel slide trending-slide-bg" data-ride="carousel">
					<?php  if(digiqole_option('newsticker_title')!='') { ?>
						<p class="trending-title"><i class="fa fa-bolt"></i> <?php echo esc_html(digiqole_option('newsticker_title'));?></p>
					<?php } ?>
					<div class="carousel-inner">
						<?php
						$k = 1;
						while ($news_ticker_post->have_posts()) : $news_ticker_post->the_post();?>
							<?php if( $k == 1 ){ ?>
							<div class="carousel-item active">
							<?php } else { ?>
							<div class="carousel-item">
							<?php } ?>
								<div class="post-content">
									<p class="post-title title-small"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></p>
								</div><!--/.most-view-item-content -->
							</div><!--/.carousel-item -->
						<?php
						$k++;
						endwhile;
						wp_reset_postdata(); ?>
					</div> <!--/.carousel-inner-->
					<?php if( $newsticker_nav_enable == 'yes' ) { ?>
						<div class="tp-control">
							 <a class="tp-control-prev" href="#tredingcarousel" role="button" data-slide="prev">
							    <i class="fa fa-angle-left"></i>
							  </a>
							  <a class="tp-control-next" href="#tredingcarousel" role="button" data-slide="next">
							      <i class="fa fa-angle-right"></i>
							  </a>
						  </div>
					  <?php } ?>
				</div> <!--/.trending-slide-->
			</div> <!--/.container-->
   <?php
   }





   

