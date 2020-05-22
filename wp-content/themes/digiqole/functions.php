<?php

/**
 * theme's main functions and globally usable variables, contants etc
 * added: v1.0 
 * textdomain: digiqole, class: DIGIQOLE, var: $digiqole_, constants: DIGIQOLE_, function: digiqole_
 */

// shorthand contants
// ------------------------------------------------------------------------
define('DIGIQOLE_THEME', 'DIGIQOLE Newspaper and Magazine WordPress Theme');
define('DIGIQOLE_VERSION', time());
define('DIGIQOLE_MINWP_VERSION', '4.3');
define('DIGIQOLE_DEMO',true);

// shorthand contants for theme assets url
// ------------------------------------------------------------------------
define('DIGIQOLE_THEME_URI', get_template_directory_uri());
define('DIGIQOLE_IMG', DIGIQOLE_THEME_URI . '/assets/images');
define('DIGIQOLE_CSS', DIGIQOLE_THEME_URI . '/assets/css');
define('DIGIQOLE_JS', DIGIQOLE_THEME_URI . '/assets/js');



// shorthand contants for theme assets directory path
// ----------------------------------------------------------------------------------------
define('DIGIQOLE_THEME_DIR', get_template_directory());
define('DIGIQOLE_IMG_DIR', DIGIQOLE_THEME_DIR . '/assets/images');
define('DIGIQOLE_CSS_DIR', DIGIQOLE_THEME_DIR . '/assets/css');
define('DIGIQOLE_JS_DIR', DIGIQOLE_THEME_DIR . '/assets/js');

define('DIGIQOLE_CORE', DIGIQOLE_THEME_DIR . '/core');
define('DIGIQOLE_COMPONENTS', DIGIQOLE_THEME_DIR . '/components');
define('DIGIQOLE_EDITOR', DIGIQOLE_COMPONENTS . '/editor');
define('DIGIQOLE_EDITOR_ELEMENTOR', DIGIQOLE_EDITOR . '/elementor');
define('DIGIQOLE_EDITOR_GUTENBERG', DIGIQOLE_EDITOR . '/gutenberg');
define('DIGIQOLE_INSTALLATION', DIGIQOLE_CORE . '/installation-fragments');
define('DIGIQOLE_REMOTE_CONTENT', esc_url('http://demo.themewinter.com/demo-content/digiqole'));


// set up the content width value based on the theme's design
// ----------------------------------------------------------------------------------------
if (!isset($content_width)) {
    $content_width = 800;
}

// set up theme default and register various supported features.
// ----------------------------------------------------------------------------------------

function digiqole_setup() {

    // make the theme available for translation
    $lang_dir = DIGIQOLE_THEME_DIR . '/languages';
    load_theme_textdomain('digiqole', $lang_dir);

    // add support for post formats
    add_theme_support('post-formats', [
        'standard', 'image', 'video', 'audio','gallery'
    ]);

    // add support for automatic feed links
    add_theme_support('automatic-feed-links');

    // let WordPress manage the document title
    add_theme_support('title-tag');

    // add support for post thumbnails
    add_theme_support('post-thumbnails');

    // woocommerce support
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-slider' );



    // hard crop center center
    set_post_thumbnail_size(850, 560, ['center', 'center']);
    add_image_size( 'digiqole-medium', 600, 398, array( 'center', 'center' ) );
    add_image_size( 'digiqole-small', 455, 300, array( 'center', 'center' ) );

  
 
    // register navigation menus
    register_nav_menus(
        [
            'primary' => esc_html__('Primary Menu', 'digiqole'),
            'topbarmenu' => esc_html__('TopBar Menu', 'digiqole'),
            'footermenu' => esc_html__('Footer Menu', 'digiqole'),
        ]
    );
  

    // HTML5 markup support for search form, comment form, and comments
    add_theme_support('html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
    ));
    /*
     * Enable support for wide alignment class for Gutenberg blocks.
     */
    add_theme_support( 'align-wide' );
    add_theme_support( 'editor-styles' );
    add_theme_support( 'wp-block-styles' );

}
add_action('after_setup_theme', 'digiqole_setup');


add_action('enqueue_block_editor_assets', 'digiqole_action_enqueue_block_editor_assets' );
function digiqole_action_enqueue_block_editor_assets() {
    wp_enqueue_style( 'digiqole-fonts', digiqole_google_fonts_url(['Barlow:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i', 'Roboto:300,300i,400,400i,500,500i,700,700i,900,900i']), null,  DIGIQOLE_VERSION );

    wp_enqueue_style( 'digiqole-gutenberg-editor-font-awesome-styles', DIGIQOLE_CSS . '/font-awesome.css', null, DIGIQOLE_VERSION );
    wp_enqueue_style( 'digiqole-gutenberg-editor-customizer-styles', DIGIQOLE_CSS . '/gutenberg-editor-custom.css', null, DIGIQOLE_VERSION );
    wp_enqueue_style( 'digiqole-gutenberg-editor-styles', DIGIQOLE_CSS . '/gutenberg-custom.css', null, DIGIQOLE_VERSION );
    wp_enqueue_style( 'digiqole-gutenberg-blog-styles', DIGIQOLE_CSS . '/blog.css', null, DIGIQOLE_VERSION );
}

// hooks for unyson framework
// ----------------------------------------------------------------------------------------
function digiqole_framework_customizations_path($rel_path) {
    return '/components';
}
add_filter('fw_framework_customizations_dir_rel_path', 'digiqole_framework_customizations_path');

function digiqole_remove_fw_settings() {
    remove_submenu_page( 'themes.php', 'fw-settings' );
}
add_action( 'admin_menu', 'digiqole_remove_fw_settings', 999 );


// include the init.php
// ----------------------------------------------------------------------------------------
require_once( DIGIQOLE_CORE . '/init.php');
require_once( DIGIQOLE_COMPONENTS . '/editor/elementor/elementor.php');


/*************************************
/*******  Load More  ********
**************************************/


function digiqole_post_ajax_loading_cb()
{   
    $settings =  $_POST['ajax_json_data'];
    $show_gradient = (($settings['show_gradient']== 'yes') ? 'gradient-post' : '');
   $arg = [
      'post_type'   =>  'post',
      'post_status' => 'publish',
      'order'       => $settings['order'],
      'posts_per_page' => $settings['posts_per_page'],
      'paged'             => $_POST['paged'],
      'tag__in'           => $settings['tags'],
      'suppress_filters' => false,
    
  ];

  if(count($settings['terms'])){
   $arg['tax_query'] = array(
      array(
                'taxonomy' => 'category',
                'terms'    => $settings['terms'],
                'field' => 'id',
                'include_children' => true,
                'operator' => 'IN'
        ),
    );
  }

  switch($settings['post_sortby']){
      case 'popularposts':
          $arg['meta_key'] = 'newszone_post_views_count';
          $arg['orderby'] = 'meta_value_num';
      break;
      case 'mostdiscussed':
          $arg['orderby'] = 'comment_count';
      break;
      default:
          $arg['orderby'] = 'date';
      break;
  }
   
  $allpostloding = new WP_Query($arg);
  $index = 0;

  while($allpostloding->have_posts()){ $allpostloding->the_post(); ?>
     
            <?php if($settings['grid_style']=='style1'): ?>
                <?php echo "<div class='col-md-6 grid-item $show_gradient' >"; ?>
                     <?php require( DIGIQOLE_COMPONENTS . '/editor/elementor/widgets/style/post-grid/content-style1.php');  ?>
               <?php echo "</div>"; ?> 

            <?php elseif($settings['grid_style']=='style2'): ?>
            <?php echo "<div class='col-md-6 grid-item $show_gradient' >"; ?>
                    <?php require( DIGIQOLE_COMPONENTS . '/editor/elementor/widgets/style/post-grid/content-style-2-a.php');  ?>
            <?php echo "</div>"; ?> 

             <?php elseif($settings['grid_style']=='style3'): ?>

             <?php echo "<div class='grid-item $show_gradient' >"; ?>
                  <?php require( DIGIQOLE_COMPONENTS . '/editor/elementor/widgets/style/post-list/content-style4-a.php');  ?>
             <?php echo "</div>"; ?> 
            <?php endif ?>

      
        <?php
     $index ++;
  }
  wp_reset_postdata();
  wp_die();
  
}

add_action( 'wp_ajax_nopriv_digiqole_post_ajax_loading', 'digiqole_post_ajax_loading_cb' );
add_action( 'wp_ajax_digiqole_post_ajax_loading', 'digiqole_post_ajax_loading_cb' );




// preloader function
// ----------------------------------------------------------------------------------------
            

function preloader_function(){
    $preloader_show = digiqole_option('preloader_show');
        if($preloader_show == 'yes'){
            $digiqole_preloader_logo_url= esc_url(digiqole_src('preloader_logo'));
        ?>
        <div id="preloader">
            <?php if($digiqole_preloader_logo_url !=''): ?>
            
            <div class="preloader-logo">
                <img  class="img-fluid" src="<?php echo esc_url($digiqole_preloader_logo_url); ?>" alt="<?php echo get_bloginfo('name') ?>">
            </div>
            <?php else: ?>
            <div class="spinner">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </div>
            <?php endif; ?>
            <div class="preloader-cancel-btn-wraper"> 
                <span class="btn btn-primary preloader-cancel-btn">
                  <?php echo esc_html_e('Cancel Preloader', 'digiqole'); ?></span>
            </div>
        </div>
    <?php
    }
}
add_action('wp_head', 'preloader_function');





