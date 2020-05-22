   <!-- Article header -->
   <header class="entry-header clearfix">
       <?php do_action('ad_before_post_title'); ?> 
       <h1 class="post-title lg">
         <?php the_title(); ?>
          
      </h1>
      <?php  digiqole_post_meta(); ?>
   </header><!-- header end -->



<?php if ( has_post_thumbnail() && !post_password_required() ) : ?>
		<div class="post-media post-image">
            <?php if(get_post_format()=='video'): ?>
                  <?php get_template_part( 'template-parts/blog/post-parts/part-single', 'video' ); ?>  
             <?php elseif(get_post_format()=='gallery'): ?>
                  <?php get_template_part( 'template-parts/blog/post-parts/post-slider', 'gallery' ); ?>  
            <?php else: ?>
		     <img class="img-fluid" src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt=" <?php the_title_attribute(); ?>">
            <?php 
               $caption = get_the_post_thumbnail_caption();
               if($caption !=''):
                  ?>
                  <p class="img-caption-text"><?php the_post_thumbnail_caption(); ?></p>

             <?php 
                  endif;
               endif;
             ?>
 
      </div>
    
	<?php endif; ?>
	<div class="post-body clearfix">

		<!-- Article content -->
		<div class="entry-content clearfix">
			<?php
			if ( is_search() ) {
				the_excerpt();
			} else {
				the_content( digiqole_option('blog_read_more_text','Continue reading &rarr;') );
				digiqole_link_pages();
			}
			?>
         <div class="post-footer clearfix">
            <?php get_template_part( 'template-parts/blog/post-parts/part', 'tags' ); ?>
         </div> <!-- .entry-footer -->
			
         <?php
            if ( is_user_logged_in() && is_single() ) {
         ?>

            <p style="float:left;margin-top:20px;">
                  <?php
                  edit_post_link( 
                     esc_html__( 'Edit', 'digiqole' ), 
                     '<span class="meta-edit">', 
                     '</span>'
                  );
                  ?>
            
           </p>
         <?php
            }
         ?>
		</div> <!-- end entry-content -->
   </div> <!-- end post-body -->
