   <?php 
      
      $back_to_top = digiqole_option('back_to_top'); 
      $mailchimp_short_code = '';
      $mailchimp_short_code =    digiqole_option("footer_mailchimp");
      $footer_top_show_hide =    digiqole_option("footer_top_show_hide");
   ?>
  <?php if(defined( 'FW' )): ?>

  <?php if($footer_top_show_hide == 'yes'): ?>
   <div class="newsletter-area">
      <div class="container">
         <div class="row">
            <div class="col-lg-7 col-md-5 align-self-center">
            <div class="footer-logo">
               <a class="logo" href="<?php echo esc_url(home_url('/')); ?>">
                     <img  class="img-fluid" src="<?php 
                        echo esc_url(
                           digiqole_src(
                              'general_light_logo',
                              DIGIQOLE_IMG . '/logo/logo-light.png'
                           )
                        );
                     ?>" alt="<?php bloginfo('name'); ?>">
                  </a>
              </div>
            </div>
            <div class="col-lg-5 col-md-7">
                <?php if( shortcode_exists('mc4wp_form') && $mailchimp_short_code!='' ): ?>  
                     <div class="ts-subscribe">
                            <?php  echo do_shortcode($mailchimp_short_code);  ?>  
                     </div>  
                  <?php endif; ?>
            </div>
         </div>
      </div>
   </div>
 <?php endif; ?>

   <?php endif; ?>


   <?php if(defined( 'FW' )): ?>
      <?php if( is_active_sidebar('footer-bottom-center') || is_active_sidebar('footer-left') || is_active_sidebar('footer-center') || is_active_sidebar('footer-right') || is_active_sidebar('footer-bottom-left') ): ?> 
         <footer class="ts-footer" >
            <div class="container">
            <?php if( is_active_sidebar('footer-left') || is_active_sidebar('footer-center') || is_active_sidebar('footer-right') ): ?> 
                  <div class="row">
                     <div class="col-lg-4 col-md-12 fadeInUp">
                        <?php  dynamic_sidebar( 'footer-left' ); ?>

                     </div>
                     <div class="col-lg-3 offset-lg-1 col-md-6">
                        <?php  dynamic_sidebar( 'footer-center' ); ?>
                     </div>
                     <div class="col-lg-4  col-md-6">
                       <?php  dynamic_sidebar( 'footer-right' ); ?>
                     </div>
                     <!-- end col -->
                  </div>
               <?php endif; ?>  
           </div>
                  
         </footer>
      <?php endif; ?>   
   <?php endif; ?>
      
   <div class="copy-right">
         <div class="container">
            <div class="row">
               <div class="col-md-11  align-self-center">

                  <div class="copyright-text text-center">
                  <?php 
                        $copyright_text = digiqole_option('footer_copyright', 'Copyright © 2019 Digiqole. All Right Reserved.'); 
                  ?>
                  <p> <?php echo digiqole_kses($copyright_text);   ?></p>
                  </div>
               </div>


               <div class="top-up-btn col-md-1">
                  <!-- end footer -->
                  <?php if($back_to_top=="yes"): ?>
                     <div class="BackTo">
                        <a href="#" class="icon icon-arrow-up" aria-hidden="true"></a>
                     </div>
                  <?php endif; ?>
               </div>
            </div>
            <!-- end row -->
         </div>
   </div>
        <!-- end footer -->
 