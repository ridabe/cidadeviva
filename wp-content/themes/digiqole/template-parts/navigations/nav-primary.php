<?php

$load_elementskit_menu = 0;

if(class_exists('\ElementsKit\Elementskit_Menu_Walker')){
  
   $locations = get_nav_menu_locations();
   
   if(isset($locations['primary'])){
      $menu_object = wp_get_nav_menu_object($locations[ 'primary' ]);
      $walker = new \ElementsKit\Elementskit_Menu_Walker();
   
      $load_elementskit_menu = $walker->is_megamenu($menu_object->slug);
   }

 

}

if($load_elementskit_menu != 1) {
   wp_nav_menu([
      'menu'            => 'primary',
      'theme_location'  => 'primary',
      'menu_id'         => 'main-menu',

      'container_id'    => 'primary-nav',
      'container'       => 'div',
      'container_class' => 'collapse navbar-collapse',
      'menu_class'      => 'navbar-nav',
      'depth'           => 3,
      'walker'          => new digiqole_navwalker(),
      'fallback_cb'     => 'digiqole_navwalker::fallback',
   ]);
}else{
      $markup = '
      <div class="elementskit-nav-identity-panel d-none">
         <div class="elementskit-site-title">
            <a class="elementskit-nav-logo" href="'.esc_url(home_url('/')) .'">
               <img src=" '. esc_url(
                  digiqole_src(
                     'general_dark_logo',
                     DIGIQOLE_IMG . '/logo/logo-dark.png'
                  )
               ) .' " alt="'. get_bloginfo("name") .'" >
            </a>
         </div>
         <button class="elementskit-menu-close elementskit-menu-toggler" type="button">X</button>
      </div>
   ';
   $args = [
      'menu'            => $menu_object->slug,
      'theme_location'  => 'primary',
      'menu_id'         => 'main-menu',

      'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>' . $markup,
      'container'       => 'div',
      'container_id'    => 'ekit-megamenu-primary-nav',
      'container_class' => 'elementskit-menu-container digiqole-elementskit-menu elementskit-menu-offcanvas-elements elementskit-navbar-nav-default elementskit_line_arrow',
      'menu_class'      => 'elementskit-navbar-nav elementskit-menu-po-right',
      'depth'           => 3,
      'echo'            => true,
      'fallback_cb'     => 'wp_page_menu',
      'walker'          => new \ElementsKit\Elementskit_Menu_Walker()
   ];

   echo '<div class="ekit-wid-con" >';
      wp_nav_menu($args);
   echo '</div>';
}