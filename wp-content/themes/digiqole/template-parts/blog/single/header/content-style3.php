
      <div class="col-md-12 post-header-style3">
         <?php if ( has_post_thumbnail() && !post_password_required() ) : ?>
               <!-- Article header -->
               <?php if(get_post_format()=='video'): ?>
                   <?php get_template_part( 'template-parts/blog/post-parts/part-single', 'video' ); ?>  
                <?php elseif(get_post_format()=='gallery'): ?>
                    <?php get_template_part( 'template-parts/blog/post-parts/post-slider', 'gallery' ); ?>  
                <?php else: ?>
                   <header class="entry-header clearfix" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url()); ?>')"> </header>
                   <!-- header end -->
              
             <?php 
             $caption = get_the_post_thumbnail_caption();
            if($caption !=''):
               ?>
               <p class="img-caption-text"><?php the_post_thumbnail_caption(); ?></p>

             <?php endif; ?>
            <?php endif; ?>
         <?php endif; ?>
     </div>  
  