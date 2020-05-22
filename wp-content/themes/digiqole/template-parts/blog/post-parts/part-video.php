
  
   <?php if(get_post_format()=='video'): ?>
      <?php if( defined( 'FW' ) && digiqole_meta_option(get_the_ID(),'featured_video')!=''): ?>
            <div class="video-link-btn">
               <a href="<?php echo digiqole_meta_option(get_the_ID(),'featured_video'); ?>" class="play-btn popup-btn"><i class="icon icon-play"></i></a>
            </div>
      <?php endif; ?> 
   <?php endif; ?> 