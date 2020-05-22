   <!-- Article header -->
   <header class="entry-header clearfix">
       <?php do_action('ad_before_post_title'); ?> 
       <h1 class="post-title lg">
         <?php the_title(); ?>
          
      </h1>
      <?php  digiqole_post_meta(); ?>
   </header><!-- header end -->

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
