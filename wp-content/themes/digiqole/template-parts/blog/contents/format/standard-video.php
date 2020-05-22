<div class="post-media post-video">
   <?php if(has_post_thumbnail()): ?>
        <img class="img-fluid" alt="<?php the_title_attribute(); ?>" src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" >
       <?php 
        if ( is_sticky() ) {
                  echo '<sup class="meta-featured-post"> <i class="fa fa-thumb-tack"></i> ' . esc_html__( 'Sticky', 'digiqole' ) . ' </sup>';
           }  
           ?>

   <?php if( defined( 'FW' ) && digiqole_meta_option(get_the_ID(),'featured_video')!=''): ?>
            <div class="video-link-btn">
               <a href="<?php echo digiqole_meta_option(get_the_ID(),'featured_video'); ?>" class="play-btn popup-btn"><i class="icon icon-play"></i></a>
            </div>
   <?php endif; ?> 
              
   <?php endif; ?>
         </div>
         <div class="post-body clearfix">

         <div class="entry-header">
           <?php digiqole_post_meta(); ?>
           <h2 class="entry-title">
               <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
           </h2>
         </div>

         <div class="post-content">
            <div class="entry-content">
                <p>
                     <?php digiqole_excerpt( 40, null ); ?>
                </p>
            </div>
            <?php
               if(!is_single()):
                  $blog_read_more_text = digiqole_option('blog_read_more_text','continue'); 
                  $blog_read_more = digiqole_option('blog_read_more');
                  if($blog_read_more=='yes'){
                        printf('<div class="post-footer readmore-btn-area"><a class="readmore" href="%1$s"> '.$blog_read_more_text.' <i class="icon icon-arrow-right"></i></a></div>',
                     get_the_permalink()
                        );
                  }
               endif; 
            ?>
         </div>
   <!-- Post content right-->

</div>
<!-- post-body end-->