<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * hooks for wp blog part
 */

// if there is no excerpt, sets a defult placeholder
// ----------------------------------------------------------------------------------------
function digiqole_excerpt( $words = 20, $more = 'BUTTON' ) {
   
	if($more == 'BUTTON'){
		$more = '<a class="btn btn-primary">'.esc_html__('read more', 'digiqole').'</a>';
	}
	$excerpt		 = get_the_excerpt();
	$trimmed_content = wp_trim_words( $excerpt, $words, $more );
	echo digiqole_kses( $trimmed_content );
}


// change textarea position in comment form
// ----------------------------------------------------------------------------------------
function digiqole_move_comment_textarea_to_bottom( $fields ) {
	$comment_field		 = $fields[ 'comment' ];
	unset( $fields[ 'comment' ] );
	$fields[ 'comment' ] = $comment_field;
	return $fields;
}
add_filter( 'comment_form_fields', 'digiqole_move_comment_textarea_to_bottom' );


// change textarea position in comment form
// ----------------------------------------------------------------------------------------
function digiqole_search_form( $form ) {
    $form = '
        <form  method="get" action="' . esc_url( home_url( '/' ) ) . '" class="digiqole-serach xs-search-group">
            <div class="input-group">
                <input type="search" class="form-control" name="s" placeholder="' .esc_attr__( 'Search Keyword', 'digiqole' ) . '" value="' . get_search_query() . '">
                <button class="input-group-btn search-button"><i class="icon icon-search1"></i></button>
            </div>
        </form>';
	return $form;
}
add_filter( 'get_search_form', 'digiqole_search_form' );

function digiqole_body_classes( $classes ) {

    if ( is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'sidebar-active';
    }else{
        $classes[] = 'sidebar-inactive';
    }
    $box_class =  digiqole_option('general_body_box_layout');
    $page_body_box_layout = digiqole_meta_option(get_the_ID(),"page_body_box_layout");

    if(isset($box_class['style'])){
        if($box_class['style']=='yes'){
         $classes[] = 'body-box-layout';
        }
    }
   //  if(isset($box_class['style'])){
   //      if($box_class['style']=='yes' && $page_body_box_layout== 'yes'){
   //       $classes[] = 'body-box-layout';
   //      }
   //  }

   if(digiqole_option('style_theme_setting')=="dark"){
      $classes[]  = 'dark-mode';
   }
 
    return $classes;
 }
 
 add_filter( 'body_class','digiqole_body_classes' );



function digiqole_track_post_views ($post_id) {
	if(digiqole_option('show_view_count', 'yes') == 'yes'){
		if ( !is_single() ) return;
		if ( empty ( $post_id) ) {
			global $post;
			$post_id = $post->ID;    
		}
		digiqole_set_postview($post_id);
	}
}

add_action( 'wp_head', 'digiqole_track_post_views');


function digiqole_exclude_category_sticky_post( $query ) {
  
   if( $query->is_category() && !$query->is_home() ){
      $category = get_queried_object();
      if( isset($category->cat_ID) ) {
       
         $cat_layout = digiqole_term_option( $category->cat_ID, 'block_category_template', 'style6' );
         if( $cat_layout=='style6' ) {
            $query->set('post__not_in', get_option('sticky_posts'));
         }

      }
       
   }
   
}
add_action( 'pre_get_posts', 'digiqole_exclude_category_sticky_post' );
if ( ! function_exists( 'wp_body_open' ) ) {
   function wp_body_open() {
           do_action( 'wp_body_open' );
   }
}

/*
  single blog ad
*/

function digiqole_single_blog_content_ad($content){
  
   $single_ad_enable   =  digiqole_option('single_blog_banner');
   if(isset($single_ad_enable['single_ad_enable'])){
      $single_ad_enable   =  digiqole_option('single_blog_banner')['single_ad_enable'];
   }else{
      $single_ad_enable= 'no';
   }
   $fullcontent= '';
   if($single_ad_enable=='no' || 'post' != get_post_type() || !is_single()){
      return $content;
   }

   $single_ad_position =  digiqole_option('single_blog_banner')['single_ad_position'];
   if($single_ad_position=='after_content'){
      $fullcontent = $content.digiqole_single_blog_ad();
   }elseif($single_ad_position=='before_content'){
      $fullcontent = digiqole_single_blog_ad().$content;
   }else{
      return $content;
   }
   return $fullcontent;
   
}

add_filter('the_content', 'digiqole_single_blog_content_ad');

function after_tag_single_ad_custom_hook(){

   $single_ad_enable     =  digiqole_option('single_blog_banner')['single_ad_enable'];
   $single_ad_position   =  digiqole_option('single_blog_banner')['single_ad_position'];
   $post_type = get_post_type( );

   if($single_ad_enable=='yes' && $post_type == 'post' && 'after_tag'==$single_ad_position && is_single()){
      
      echo digiqole_kses(digiqole_single_blog_ad()); 
   } 

}
add_action('after_tag_ad','after_tag_single_ad_custom_hook');

function ad_before_post_title_custom_func(){
   $single_ad_enable     =  digiqole_option('single_blog_banner')['single_ad_enable'];
   
   $single_ad_position   =  digiqole_option('single_blog_banner')['single_ad_position'];
   $post_type = get_post_type(  );

   if($single_ad_enable=='yes' && $post_type == 'post' && 'before_title'== $single_ad_position && is_single()){
      $single_ad_html     =  digiqole_single_blog_ad();
      echo digiqole_kses($single_ad_html); 
   } 

   
}
add_action('ad_before_post_title','ad_before_post_title_custom_func');

// end single ad one


/*
  single blog ad two
*/

function digiqole_single_blog_content_ad_two($content){
  
   $single_ad_enable   =  digiqole_option('single_blog_banner_two');
   if(isset($single_ad_enable['single_ad_enable'])){
      $single_ad_enable   =  digiqole_option('single_blog_banner_two')['single_ad_enable'];
   }else{
      $single_ad_enable= 'no';
   }
   $fullcontent= '';
   if($single_ad_enable=='no' || 'post' != get_post_type() || !is_single()){
      return $content;
   }

   $single_ad_position =  digiqole_option('single_blog_banner_two')['single_ad_position'];
   if($single_ad_position=='after_content'){
      $fullcontent = $content.digiqole_single_blog_ad('single_blog_banner_two');
   }elseif($single_ad_position=='before_content'){
      $fullcontent = digiqole_single_blog_ad('single_blog_banner_two').$content;
   }else{
      return $content;
   }
   return $fullcontent;
   
}

add_filter('the_content', 'digiqole_single_blog_content_ad_two');

function after_tag_single_ad_custom_hook_two(){

   $single_ad_enable     =  digiqole_option('single_blog_banner_two')['single_ad_enable'];
   $single_ad_position   =  digiqole_option('single_blog_banner_two')['single_ad_position'];
   $post_type = get_post_type( );

   if($single_ad_enable=='yes' && $post_type == 'post' && 'after_tag'==$single_ad_position && is_single()){
      
      echo digiqole_kses(digiqole_single_blog_ad('single_blog_banner_two')); 
   } 

}
add_action('after_tag_ad','after_tag_single_ad_custom_hook_two');

function ad_before_post_title_custom_func_two(){
   $single_ad_enable     =  digiqole_option('single_blog_banner_two')['single_ad_enable'];
   
   $single_ad_position   =  digiqole_option('single_blog_banner_two')['single_ad_position'];
   $post_type = get_post_type(  );

   if($single_ad_enable=='yes' && $post_type == 'post' && 'before_title'== $single_ad_position && is_single()){
      $single_ad_html     =  digiqole_single_blog_ad('single_blog_banner_two');
      echo digiqole_kses($single_ad_html); 
   } 

   
}
add_action('ad_before_post_title','ad_before_post_title_custom_func_two');

//end single ad two

function digiqole_header_metadata() {
   
  if(is_single() && get_post_type()=='post'){ 
     $title = get_the_title();
     $img = get_the_post_thumbnail_url();
     ?>
      <meta name="description" content="<?php echo esc_attr($title); ?>">
      <meta property="og:title" content="<?php echo esc_attr($title); ?>">
      <meta property="og:description" content="<?php echo wp_strip_all_tags( get_the_excerpt(), true ); ?>">
      <meta property="og:image" content="<?php echo esc_url($img); ?>"/>
      <meta property="og:url" content="<?php echo esc_url(get_the_permalink()); ?>">
      
   <?php
  }
}
add_action( 'wp_head', 'digiqole_header_metadata' );





add_action('digiqole_review_kit', 'wur_meta_box_content_view_newszone', 999 )	;

function wur_meta_box_content_view_newszone(){
  
   if (class_exists('\WurReview\App\Content')) {
      echo \WurReview\App\Content::instance()->wur_meta_box_content_view('');
   }
}


