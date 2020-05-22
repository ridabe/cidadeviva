<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * enqueue all theme scripts and styles
 */


// stylesheets
// ----------------------------------------------------------------------------------------
if ( !is_admin() ) {
	// 3rd party css
	wp_enqueue_style( 'digiqole-fonts', digiqole_google_fonts_url(['Barlow:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i', 'Roboto:300,300i,400,400i,500,500i,700,700i,900,900i']), null,  DIGIQOLE_VERSION );
	if( is_rtl() ){
	wp_enqueue_style( 'bootstrap-rtl',  DIGIQOLE_CSS . '/bootstrap.min-rtl.css', null,  DIGIQOLE_VERSION );
	}else{
		wp_enqueue_style( 'bootstrap',  DIGIQOLE_CSS . '/bootstrap.min.css', null,  DIGIQOLE_VERSION );

	}

   wp_enqueue_style( 'font-awesome',  DIGIQOLE_CSS . '/font-awesome.css', null,  DIGIQOLE_VERSION );
   wp_enqueue_style( 'icon-font',  DIGIQOLE_CSS . '/icon-font.css', null,  DIGIQOLE_VERSION );
	wp_enqueue_style( 'animate',  DIGIQOLE_CSS . '/animate.css', null,  DIGIQOLE_VERSION );
	wp_enqueue_style( 'magnific-popup',  DIGIQOLE_CSS . '/magnific-popup.css', null,  DIGIQOLE_VERSION );
	wp_enqueue_style( 'owl-carousel-min',  DIGIQOLE_CSS . '/owl.carousel.min.css', null,  DIGIQOLE_VERSION );
	wp_enqueue_style( 'owl-theme-default',  DIGIQOLE_CSS . '/owl.theme.default.min.css', null,  DIGIQOLE_VERSION );
	wp_enqueue_style( 'jquery-mCustomScrollbar',  DIGIQOLE_CSS . '/jquery.mCustomScrollbar.css', null,  DIGIQOLE_VERSION );
	wp_enqueue_style( 'digiqole-woocommerce', DIGIQOLE_CSS . '/woocommerce.css', null, DIGIQOLE_VERSION );

   // theme css
	wp_enqueue_style( 'digiqole-blog',  DIGIQOLE_CSS . '/blog.css', null,  DIGIQOLE_VERSION );
	wp_enqueue_style( 'digiqole-gutenberg-custom',  DIGIQOLE_CSS . '/gutenberg-custom.css', null,  DIGIQOLE_VERSION );
	 wp_enqueue_style( 'digiqole-master',  DIGIQOLE_CSS . '/master.css', null,  DIGIQOLE_VERSION );
	
	 if( is_rtl() ){
		wp_enqueue_style( 'digiqole-rtl', DIGIQOLE_THEME_URI . '/rtl.css', null, DIGIQOLE_VERSION );

	 }
}

// javascripts
// ----------------------------------------------------------------------------------------
if ( !is_admin() ) {

	// 3rd party scripts
	if ( is_rtl() ) {
		wp_enqueue_script( 'bootstrap-rtl',  DIGIQOLE_JS . '/bootstrap.min-rtl.js', array( 'jquery' ),  DIGIQOLE_VERSION, true );
	}else{
		wp_enqueue_script( 'bootstrap',  DIGIQOLE_JS . '/bootstrap.min.js', array( 'jquery' ),  DIGIQOLE_VERSION, true );
	}
	wp_enqueue_script( 'bootstrap',  DIGIQOLE_JS . '/bootstrap.min.js', array( 'jquery' ),  DIGIQOLE_VERSION, true );
   wp_enqueue_script( 'popper',  DIGIQOLE_JS . '/popper.min.js', array( 'jquery' ),  DIGIQOLE_VERSION, true );
	wp_enqueue_script( 'jquery-magnific-popup',  DIGIQOLE_JS . '/jquery.magnific-popup.min.js', array( 'jquery' ),  DIGIQOLE_VERSION, true );
	wp_enqueue_script( 'jquery-appear-min',  DIGIQOLE_JS . '/jquery.appear.min.js', array( 'jquery' ),  DIGIQOLE_VERSION, true );
   wp_enqueue_script( 'raphael-min',  DIGIQOLE_JS . '/raphael.min.js', array( 'jquery' ),  DIGIQOLE_VERSION, true );
   wp_enqueue_script( 'owl-carousel-min',  DIGIQOLE_JS . '/owl.carousel.min.js', array( 'jquery' ),  DIGIQOLE_VERSION, true );
   wp_enqueue_script( 'jquery-mCustomScrollbar-concat', DIGIQOLE_JS . '/jquery.mCustomScrollbar.concat.min.js', array( 'jquery' ), DIGIQOLE_VERSION, true );
   wp_enqueue_script( 'jquery-easypiechart', DIGIQOLE_JS . '/jquery.easypiechart.min.js', array( 'jquery' ), DIGIQOLE_VERSION, true );
  
    wp_enqueue_script( 'goodshare',  DIGIQOLE_JS . '/goodshare.min.js', array( ), true, true );
	// theme scripts

   wp_enqueue_script( 'digiqole-script',  DIGIQOLE_JS . '/script.js', array( 'jquery' ),  DIGIQOLE_VERSION, true );
   $blog_sticky_sidebar  = digiqole_option('blog_sticky_sidebar');  
  
   wp_localize_script( 'digiqole-script', 'digiqole_ajax', array(
	   
	   'ajax_url' => admin_url( 'admin-ajax.php' ),
	   'blog_sticky_sidebar' => $blog_sticky_sidebar,
        
	   ) );
	  
	
	
	// Load WordPress Comment js
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}