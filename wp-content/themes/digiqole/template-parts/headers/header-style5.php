<?php
   $class = '';
   $title = '';
   $header_nav_search_section    = 'yes';
   $header_nav_sticky            = 'no';
   $header_top_info_show         = 'no';
   $header_social_share         = 'no';
  
   if ( defined( 'FW' ) ) {
  
      $header_settings = digiqole_option('theme_header_default_settings');
  
      if(isset($header_settings['no'])) {
      
        $header_top_info_show = $header_settings['no']['header_top_info_show']; 
        $header_nav_search_section = $header_settings['no']['header_nav_search_section']; 
        $header_nav_sticky = $header_settings['no']['header_nav_sticky']; 
        $header_social_share = $header_settings['no']['header_social_share']; 
       
      } 
   
   } 
   
?>
 <?php if(defined( 'FW' ) && $header_top_info_show=='yes' ): ?>
<div class="topbar ">
   <div class="container">
      <div class="row">
         <div class="col-md-5 col-lg-6 xs-center">
           <div class="top-navbar">
           <?php
               if ( has_nav_menu( 'topbarmenu' ) ) {
                 
                  wp_nav_menu( array( 
                     'theme_location' => 'topbarmenu', 
                     'menu_class' => 'top-nav', 
                     'container' => '' 
                  ) );
               }

               ?>
           </div>
        
       
         </div>
         <div class="col-md-7 col-lg-6 align-self-center">
         <?php
          if($header_social_share=='yes'):
            $social_links = digiqole_option('general_social_links',[]);  ?>
            <ul class="social-links text-right">
               <li class="header-date-info"> <i class="fa fa-calendar-check-o" aria-hidden="true"></i>  
                  <?php echo date_i18n(get_option('date_format')); ?>
               </li>
                  <?php 
                  
                     if(count($social_links)):   
                        foreach($social_links as $sl):
                           if( isset( $sl['icon_class']) && isset($sl['ttile']) ) :
                              $class = 'ts-' . str_replace('fa fa-', '', $sl['icon_class']);
                              $title = $sl["title"];
                           endif; 
                  ?>
                        <li class="<?php echo esc_attr($class); ?>">
                           <a target="_blank" title="<?php echo esc_attr( $title = $sl["title"]); ?>" href="<?php echo esc_url($sl['url']); ?>">
                           <span class="social-icon">  <i class="<?php echo esc_attr($sl['icon_class']); ?>"></i> </span>
                           </a>
                        </li>
                  <?php endforeach; ?>
               <?php endif; ?>
            </ul>
            <?php endif; ?>
         <!-- end social links -->
         </div>
      <!-- end col -->
      </div>
   <!-- end row -->
   </div>
<!-- end container -->
</div>
<?php endif; ?>
<!-- tranding bar -->



<header id="header" class="header header-dark <?php echo esc_attr($header_nav_sticky=='yes'?'navbar-sticky':''); ?> ">
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
              <?php
                     
                     $digiqole_logo_url= esc_url(
                           digiqole_src(
                              'general_light_logo',
                              DIGIQOLE_IMG . '/logo/logo-light.png'
                           )
                        );
          

              ?>
              <?php echo  digiqole_text_logo()?'<h1 class="logo-title">':''; ?> 
                  <a class="logo" href="<?php echo esc_url(home_url('/')); ?>">
                     
                        <?php if(digiqole_text_logo()): ?> 
                           <?php echo esc_html(digiqole_text_logo()); ?>
                           <?php else: ?>
                              <img  class="img-fluid" src="<?php echo esc_url($digiqole_logo_url); ?>" alt="<?php echo get_bloginfo('name') ?>">
                           <?php endif; ?>
                        
                  </a>     
               <?php echo  digiqole_text_logo()?'</h1>':''; ?>  
               
               <button class="navbar-toggler" type="button" data-toggle="collapse"
                     data-target="#primary-nav" aria-controls="primary-nav" aria-expanded="false"
                     aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"><i class="icon icon-menu"></i></span>
               </button>
               
                  <?php get_template_part( 'template-parts/navigations/nav', 'primary' ); ?>
                 
                  <?php if(defined( 'FW' )): ?>
                     <div class="nav-search-area">
                        <?php if($header_nav_search_section=='yes'): ?>
                           <div class="header-search-icon">
                              <a href="#modal-popup-2" class="navsearch-button nav-search-button xs-modal-popup"><i class="icon icon-search1"></i></a>
                           </div>
                         <?php endif; ?>
                        <!-- xs modal -->
                        <div class="zoom-anim-dialog mfp-hide modal-searchPanel ts-search-form" id="modal-popup-2">
                           <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                 <div class="xs-search-panel">
                                       <?php get_search_form(); ?>
                                 </div>
                              </div>
                           </div>
                        </div><!-- End xs modal --><!-- end language switcher strart -->
                     </div>
                     
                  <?php endif; ?>
            <!-- Site search end-->
                                          
                        
         </nav>
      </div><!-- container end-->
</header>

<div class="tranding-bg-white trending-light">
    <div class="container">
    <?php 
         get_template_part( 'template-parts/newsticker/news', 'ticker' ); 
      ?>
    </div>
 </div>