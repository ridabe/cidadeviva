<?php 

$override = (digiqole_post_option(get_the_ID(), 'override_default', 'no') == 'yes') ? true : false;
$layout = digiqole_option('post_header_layout', 'style1', $override);

if($layout!=='style5'){
   return;
}

?>
  <div class="col-md-12 post-header-style5">
         <?php if ( has_post_thumbnail() && !post_password_required() ) : ?>
               <!-- Article header -->
               <header class="entry-header clearfix" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url()); ?>')">
                 
                  <div class="entry-header-content">
                     <h1 class="post-title lg">
                        <?php the_title(); ?>
                     </h1>
                     <?php digiqole_post_meta(); ?>
                  <div>
               </header><!-- header end -->
               <?php 
                  $caption = get_the_post_thumbnail_caption();
                  if($caption !=''):
                     ?>
                     <p class="img-caption-text"><?php the_post_thumbnail_caption(); ?></p>

                  <?php endif; ?>
         <?php endif; ?>
   </div> 