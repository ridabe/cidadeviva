<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * helper functions
 */

// simply echo the variable
// ----------------------------------------------------------------------------------------
function digiqole_return( $s ) {
   
	return $s;
}

function digiqole_post_tags(){
	$terms = get_terms( array(
		'taxonomy'    => 'post_tag',
		'hide_empty'  => false,
		'posts_per_page' => -1, 
  ) );

  $cat_list = [];
  foreach($terms as $post) {
  $cat_list[$post->term_id]  = [$post->name];
  }
  return $cat_list;
}

function digiqole_get_image_size()
{
   $digiqole_image_size = [];
   foreach(get_intermediate_image_sizes() as $value){
      $digiqole_image_size[$value] = $value;
   }
   return $digiqole_image_size;
}

//css unit check
function digiqole_style_unit( $data ) {
   $css_units = ["px","mm","in","pt","pc","em","vw","%","cm"];
   $footer_padding_top_unit = substr($data, -2);
   $footer_padding_top_unit_percent = substr($data, -1);
   if(in_array($footer_padding_top_unit,$css_units) || in_array($footer_padding_top_unit_percent,$css_units)){
    return $data; 
   }else{
     return (int)$data."px";
   }
   
   return $data;
}

// return the specific value from theme options/ customizer/ etc
// ----------------------------------------------------------------------------------------
function digiqole_option( $key, $default_value = '', $meta_option_first = false, $method = 'customizer' ) {
	if ( defined( 'FW' ) ) {
		switch ( $method ) {
			case 'theme-settings':
				$value = fw_get_db_settings_option( $key );
				break;
			case 'customizer':
				$value = fw_get_db_customizer_option( $key );
				break;
			default:
				$value = '';
				break;
      }
      if($meta_option_first == true && defined('DIGIQOLE_DEMO')){
        
			return digiqole_post_option( get_the_ID(), $key, $default_value);
      }
      
		return (!isset($value) || $value == '') ? $default_value :  $value;
	}
	return $default_value;
}

function digiqole_post_option( $postid, $key, $default_value = '') {
	if ( defined( 'FW' ) ) {
		$value = fw_get_db_post_option($postid, $key, $default_value);
	}
	return (!isset($value) || $value == '') ? $default_value :  $value;
}



// return the specific value from metabox
// ----------------------------------------------------------------------------------------
function digiqole_meta_option( $postid, $key, $default_value = '' ) {
	if ( defined( 'FW' ) ) {
		$value = fw_get_db_post_option($postid, $key, $default_value);
	}
	return (!isset($value) || $value == '') ? $default_value :  $value;
}


// unyson based image resizer
// ----------------------------------------------------------------------------------------
function digiqole_resize( $url, $width = false, $height = false, $crop = false ) {
	if ( function_exists( 'fw_resize' ) ) {
		$fw_resize	 = FW_Resize::getInstance();
		$response	 = $fw_resize->process( $url, $width, $height, $crop );
		return (!is_wp_error( $response ) && !empty( $response[ 'src' ] ) ) ? $response[ 'src' ] : $url;
	} else {
		$response = wp_get_attachment_image_src( $url, array( $width, $height ) );
		if ( !empty( $response ) ) {
			return $response[ 0 ];
		}
	}
}


// extract unyson image data from option value in a much simple way
// ----------------------------------------------------------------------------------------
function digiqole_src( $key, $default_value = '', $input_as_attachment = false ) { // for src
	if ( $input_as_attachment == true ) {
		$attachment = $key;
	} else {
		$attachment = digiqole_option( $key );
	}

	if ( isset( $attachment[ 'url' ] ) && !empty( $attachment ) ) {
		return $attachment[ 'url' ];
	}

	return $default_value;
}


// return attachment alt in safe mode
// ----------------------------------------------------------------------------------------
function digiqole_alt( $id ) {
	if ( !empty( $id ) ) {
		$alt = get_post_meta( $id, '_wp_attachment_image_alt', true );
		if ( !empty( $alt ) ) {
			$alt = $alt;
		} else {
			$alt = get_the_title( $id );
		}
		return $alt;
	}
}


// get original id in WPML enabled WP
// ----------------------------------------------------------------------------------------
function digiqole_org_id( $id, $name = true ) {
	if ( function_exists( 'icl_object_id' ) ) {
		$id = icl_object_id( $id, 'page', true, 'en' );
	}

	if ( $name === true ) {
		$post = get_post( $id );
		return $post->post_name;
	} else {
		return $id;
	}
}


// converts rgb color code to hex format
// ----------------------------------------------------------------------------------------
function digiqole_rgb2hex( $hex ) {
	$hex		 = preg_replace( "/^#(.*)$/", "$1", $hex );
	$rgb		 = array();
	$rgb[ 'r' ]	 = hexdec( substr( $hex, 0, 2 ) );
	$rgb[ 'g' ]	 = hexdec( substr( $hex, 2, 2 ) );
	$rgb[ 'b' ]	 = hexdec( substr( $hex, 4, 2 ) );

	$color_hex = $rgb[ "r" ] . ", " . $rgb[ "g" ] . ", " . $rgb[ "b" ];
	return $color_hex;
}


// WP kses allowed tags
// ----------------------------------------------------------------------------------------
function digiqole_kses( $raw ) {

	$allowed_tags = array(
		'a'								 => array(
			'class'	 => array(),
			'href'	 => array(),
			'rel'	 => array(),
			'title'	 => array(),
			'target'	 => array(),
		),
		'abbr'							 => array(
			'title' => array(),
		),
		'b'								 => array(),
		'blockquote'					 => array(
			'cite' => array(),
		),
		'cite'							 => array(
			'title' => array(),
		),
		'code'							 => array(),
		'del'							 => array(
			'datetime'	 => array(),
			'title'		 => array(),
		),
		'dd'							 => array(),
		'div'							 => array(
			'class'	 => array(),
			'title'	 => array(),
			'style'	 => array(),
		),
		'dl'							 => array(),
		'dt'							 => array(),
		'em'							 => array(),
		'h1'							 => array(),
		'h2'							 => array(),
		'h3'							 => array(),
		'h4'							 => array(),
		'h5'							 => array(),
		'h6'							 => array(),
		'i'								 => array(
			'class' => array(),
		),
		'img'							 => array(
			'alt'	 => array(),
			'class'	 => array(),
			'height' => array(),
			'src'	 => array(),
			'width'	 => array(),
		),
		'li'							 => array(
			'class' => array(),
		),
		'ol'							 => array(
			'class' => array(),
		),
		'p'								 => array(
			'class' => array(),
		),
		'q'								 => array(
			'cite'	 => array(),
			'title'	 => array(),
		),
		'span'							 => array(
			'class'	 => array(),
			'title'	 => array(),
			'style'	 => array(),
		),
		'iframe'						 => array(
			'width'			 => array(),
			'height'		 => array(),
			'scrolling'		 => array(),
			'frameborder'	 => array(),
			'allow'			 => array(),
			'src'			 => array(),
		),
		'strike'						 => array(),
		'br'							 => array(),
		'strong'						 => array(),
		'data-wow-duration'				 => array(),
		'data-wow-delay'				 => array(),
		'data-wallpaper-options'		 => array(),
		'data-stellar-background-ratio'	 => array(),
		'ul'							 => array(
			'class' => array(),
		),
	);

	if ( function_exists( 'wp_kses' ) ) { // WP is here
		$allowed = wp_kses( $raw, $allowed_tags );
	} else {
		$allowed = $raw;
	}


	return $allowed;
}


// build google font url
// ----------------------------------------------------------------------------------------
function digiqole_google_fonts_url($font_families	 = []) {
	$fonts_url		 = '';
	/*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
    */
	if ( $font_families && 'off' !== _x( 'on', 'Google font: on or off', 'digiqole' ) ) { 
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) )
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}


// return megamenu child item's slug
// ----------------------------------------------------------------------------------------
function digiqole_get_mega_item_child_slug( $location, $option_id ) {
	$mega_item	 = '';
	$locations	 = get_nav_menu_locations();
	$menu		 = wp_get_nav_menu_object( $locations[ $location ] );
	$menuitems	 = wp_get_nav_menu_items( $menu->term_id );

	foreach ( $menuitems as $menuitem ) {

		$id			 = $menuitem->ID;
		$mega_item	 = fw_ext_mega_menu_get_db_item_option( $id, $option_id );
	}
	return $mega_item;
}


// return cover image from an youtube video url
// ----------------------------------------------------------------------------------------
function digiqole_youtube_cover( $e ) {
	$src = null;
	//get the url
	if ( $e != '' ){
		$url = $e;
		$queryString = parse_url( $url, PHP_URL_QUERY );
		parse_str( $queryString, $params );
		$v = $params[ 'v' ];
		//generate the src
		if ( strlen( $v ) > 0 ) {
			$src = "http://i3.ytimg.com/vi/$v/default.jpg";
		}
	}

	return $src;
}


// return embed code for sound cloud
// ----------------------------------------------------------------------------------------
function digiqole_soundcloud_embed( $url ) {
	return 'https://w.soundcloud.com/player/?url=' . urlencode($url) . '&auto_play=false&color=915f33&theme_color=00FF00';
}


// return embed code video url
// ----------------------------------------------------------------------------------------
function digiqole_video_embed($url){
    //This is a general function for generating an embed link of an FB/Vimeo/Youtube Video.
	$embed_url = '';
    if(strpos($url, 'facebook.com/') !== false) {
        //it is FB video
        // $embed_url ='https://www.facebook.com/plugins/video.php?href='.rawurlencode($url).'&show_text=1&width=200';
		
		//it is Youtube video
		$video_id = explode("v=",$url)[0];
		
		if(strpos($video_id, 'video_id=') !== false){
			$video_id = explode("video_id=",$video_id);
		}
		$embed_url ='https://www.facebook.com/v2.5/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2Fvideo.php%3Fv%3D'.$video_id[1];

    }else if(strpos($url, 'vimeo.com/') !== false) {
        //it is Vimeo video
        $video_id = explode("vimeo.com/",$url)[1];
        if(strpos($video_id, '&') !== false){
            $video_id = explode("&",$video_id)[0];
        }
        $embed_url ='https://player.vimeo.com/video/'.$video_id;
    }else if(strpos($url, 'youtube.com/') !== false) {
        //it is Youtube video
        $video_id = explode("v=",$url)[1];
        if(strpos($video_id, '&') !== false){
            $video_id = explode("&",$video_id)[0];
        }
		$embed_url ='https://www.youtube.com/embed/'.$video_id;
    }else if(strpos($url, 'youtu.be/') !== false){
        //it is Youtube video
        $video_id = explode("youtu.be/",$url)[1];
        if(strpos($video_id, '&') !== false){
            $video_id = explode("&",$video_id)[0];
        }
        $embed_url ='https://www.youtube.com/embed/'.$video_id;
    }else{
        //for new valid video URL
    }
    return $embed_url;
}

if ( !function_exists( 'digiqole_advanced_font_styles' ) ) :

	/**
	 * Get shortcode advanced Font styles
	 *
	 */
	function digiqole_advanced_font_styles( $style ) {

		$font_styles = $font_weight = '';

		$font_weight = (isset( $style[ 'font-weight' ] ) && $style[ 'font-weight' ]) ? 'font-weight:' . esc_attr( $style[ 'font-weight' ] ) . ';' : '';
		$font_weight = (isset( $style[ 'variation' ] ) && $style[ 'variation' ]) ? 'font-weight:' . esc_attr( $style[ 'variation' ] ) . ';' : $font_weight;

		$font_styles .= isset( $style[ 'family' ] ) ? 'font-family:"' . $style[ 'family' ] . '";' : '';
		$font_styles .= isset($style[ 'style' ] ) && $style[ 'style' ] ? 'font-style:' . esc_attr( $style[ 'style' ] ) . ';' : '';
		
		$font_styles .= isset( $style[ 'color' ] ) && !empty( $style[ 'color' ] ) ? 'color:' . esc_attr( $style[ 'color' ] ) . ';' : '';
		$font_styles .= isset( $style[ 'line-height' ] ) && !empty( $style[ 'line-height' ] ) ? 'line-height:' . esc_attr( $style[ 'line-height' ] ) . 'px;' : '';
		$font_styles .= isset( $style[ 'letter-spacing' ] ) && !empty( $style[ 'letter-spacing' ] ) ? 'letter-spacing:' . esc_attr( $style[ 'letter-spacing' ] ) . 'px;' : '';
		$font_styles .= isset( $style[ 'size' ] ) && !empty( $style[ 'size' ] ) ? 'font-size:' . esc_attr( $style[ 'size' ] ) . 'px;' : '';
		
		$font_styles .= !empty( $font_weight ) ? $font_weight : '';

		return !empty( $font_styles ) ? $font_styles : '';
	}

endif;

// return safe thumbnail
// ----------------------------------------------------------------------------------------
function digiqole_post_thumbnail($postID = null, $w = 455, $h = 300,$size=null){
	$src = DIGIQOLE_IMG . '/default_thumb.jpg';
	if(has_post_thumbnail($postID) && !post_password_required($postID)){
	
      if(isset($size)){
         return  get_the_post_thumbnail_url($postID, $size);
      }
      
      $src = get_the_post_thumbnail_url($postID, 'full');
		if($w == 'post-thumbnail'){
			return $src;
		}

		$src = digiqole_resize($src, $w, $h, true);
	}
	return $src;
}

// limit title
// ----------------------------------------------------------------------------------------
function digiqole_limited_title( $title, $max = 20, $tail = '...' ) {
	return wp_trim_words($title, $max, $tail);
}

 // post view count 
// ----------------------------------------------------------------------------------------
// function to display number of posts.
function digiqole_get_postview($postID){
   $count_key = 'newszone_post_views_count';
   $count = get_post_meta($postID, $count_key, true);
   if($count==''){
       return "0";
   }
   return esc_html($count);
}

// function to count views.
function digiqole_set_postview($postID) {
   $count_key = 'newszone_post_views_count';
   $count = get_post_meta($postID, $count_key, true);
   if($count==''){
       $count = 0;
       delete_post_meta($postID, $count_key);
       add_post_meta($postID, $count_key, '0');
   }else{
       $count++;
       update_post_meta($postID, $count_key, $count);
   }
}

// return the specific value from term/ taxomony metabox
// ----------------------------------------------------------------------------------------
function digiqole_term_option( $termid, $key, $default_value = '', $taxomony = 'category', $return_org = false ) {
	if ( defined( 'FW' ) ) {
		$value = fw_get_db_term_option($termid, $taxomony, $key);
	   $override = fw_get_db_term_option($termid, $taxomony, 'override_default');
	   $override = defined('DIGIQOLE_DEMO') ? $override : 'no';

		if($return_org == false && $override != 'yes'){
		  $value = digiqole_option($key, $default_value);
		}
	}
	return (!isset($value) || $value == '') ? $default_value :  $value;
}

function digiqole_get_excerpt($count = 100 ) {
  
   $count = digiqole_desc_limit($count);

   $blog_read_more_text = digiqole_option('blog_read_more_text','readmore');
   $excerpt = get_the_excerpt();
   $excerpt = esc_html($excerpt);
   $words   = str_word_count($excerpt, 2);
   $pos     = array_keys($words);
   if(count($words)>$count){
      $excerpt = substr($excerpt, 0, $pos[$count]); 
   }
   $blog_read_more = digiqole_option('blog_read_more','yes');
   if($blog_read_more=='yes'){
      $excerpt = digiqole_kses($excerpt .'<a class="readmore-btn" href="'.esc_url(get_the_permalink()).'">'. $blog_read_more_text. '<i class="icon icon-arrow-right"> </i></a>');
   }
  
   return $excerpt;
   }
   function digiqole_desc_limit($default){
      if(!is_single() && !is_page()){
         $default_options = [
            'block_crop_desc_switch' => 'no',
            'yes' => [
               'block_crop_desc_limit' => 35
            ]
         ];
         $category = get_category( get_query_var( 'cat' ) );

       
        
         if(isset($category->cat_ID)){
            $check = digiqole_term_option($category->cat_ID, 'block_crop_desc', $default_options);
            if(isset($check['block_crop_desc_switch']) && $check['block_crop_desc_switch']=='yes'){

               $limit_options = digiqole_term_option($category->cat_ID, 'block_crop_desc', $default_options);
            
            }else{
               $limit_options = digiqole_option('block_crop_desc', $default_options);
            }
         }else{
            $limit_options = digiqole_option('block_crop_desc', $default_options); 
         }
        
         
         if($limit_options['block_crop_desc_switch'] == 'yes'){
            return $limit_options['yes']['block_crop_desc_limit'];
         }else{
            return $default;
         }
      }else{
         return $default;
      }
   }
   function digiqole_get_crop_title( $title , $count = 10 ) { 
         $count = digiqole_title_limit($count);

      return wp_trim_words($title,$count,'');
   }
   function digiqole_title_limit($default){
      if(!is_single() && !is_page()){
         $default_options = [
            'block_crop_title_switch' => 'no',
            'yes' => [
               'block_crop_title_limit' => 35
            ]
         ];
			
	
         $limit_options = digiqole_option('block_crop_title', $default_options);
         $category = get_category( get_query_var( 'cat' ) );

        
         if(isset($category->cat_ID)){
               $check = digiqole_term_option($category->cat_ID, 'block_crop_title', $default_options);
               if(isset($check['block_crop_title_switch']) &&  $check['block_crop_title_switch']=='yes'){
                  $limit_options = digiqole_term_option($category->cat_ID, 'block_crop_title', $default_options);
               }else{
                  $limit_options = digiqole_option('block_crop_title', $default_options);
               }

         }else{

            $limit_options = digiqole_option('block_crop_title', $default_options);

         }
         
         if($limit_options['block_crop_title_switch'] == 'yes'){
            return $limit_options['yes']['block_crop_title_limit'];
         }else{
            return $default;
			}

      }else{
         return $default;
      }
	}
	
	function digiqole_review_score_limit(){
		?>
		<div class="digiqole-rating">
		<?php
			  $rating = digiqole_review_rating( [ 'post-id' =>  get_the_ID(),  'ratting-show' => 'no', 'count-show' => 'yes', 'vote-show' => 'no', 'vote-text' => 'no', 'return-type' => 'only_avg' ]);
			
			  $return_data_global_setting = get_option('xs_review_global');
			  $score_limit =  (isset($return_data_global_setting['review_score_limit']) && $return_data_global_setting['review_score_limit'] != '0') ? $return_data_global_setting['review_score_limit'] : '5';
			  $rating_parcent = ($rating/$score_limit)*100;
				?>
				<div class="digiqole-review-percent">
					<div data-bar-color="<?php echo esc_attr(digiqole_cat_style_bg_color('block_highlight_color')); ?>" class="review-chart" data-percent="<?php echo esc_attr($rating_parcent); ?>">
						<?php
							echo '<i class="icon icon-star"></i>';
							echo  esc_html($rating); 
							?>
					</div>
				</div>
		</div> 

	<?php

	}

   function digiqole_cat_style( $termid,$key,$css='color') {
      
    
     if ( defined( 'FW' ) ) {
         $value = fw_get_db_term_option($termid,'category', $key);
         
         if($css == 'color'){
            return 'color:'.$value;
         }else{
            $color = fw_get_db_term_option($termid,'category', 'block_secondary_color');
            $style = 'background-color:' . $value.';';
            if($color!=''){
               $style .= 'color:' . $color;
            }
            return $style; 
         }
     }

     return;  
   }
   function digiqole_category_style( $termid,$key,$css='color') {
      
    
     if ( defined( 'FW' ) ) {
         $value = fw_get_db_term_option($termid,'category', $key);
         
         if($css == 'color'){
            return 'color:'.$value;
         }else{
            $color = fw_get_db_term_option($termid,'category', 'block_secondary_color');
            $style = 'color:' . $value.';';
            if($color!=''){
               $style .= 'color:' . $color;
            }
            return $style; 
         }
     }

     return;  
	}
	
   function digiqole_cat_style_bg_color($key, $default = '#f00') {
      
		$cat = get_the_category(); 
     if ( defined( 'FW' ) ) {
         $value = fw_get_db_term_option($cat[0]->term_id,'category', $key);
             
           return $value; 
			}
			return $default; 
}

    

   function digiqole_review_rating($arg = []){
      if( function_exists('review_kit_rating') ) {
          return review_kit_rating($arg);
      }
  }

  // social sharing buttons
// ----------------------------------------------------------------------------------------
function digiqole_social_share(){
   $blog_social_share = digiqole_option('blog_social_share');
 
   if(!is_array($blog_social_share) && !count($blog_social_share)){
     return;
   }
	?>
	<ul class="social-list version-2">
      <?php foreach($blog_social_share as $item){ ?>
		   <li><a data-social="<?php echo esc_attr( $item['social']); ?>" class="<?php echo esc_attr( $item['social']); ?>" href="#" title="<?php the_title_attribute() ?>" ><i class="<?php echo esc_attr( $item['icon_class']); ?>"></i></a></li>
      <?php } ?>
	</ul>
	<?php
}

function digiqole_title_slugify($title){
   $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
   return $slug;
}

function digiqole_ekit_headers($format='html'){

   if(class_exists('ElementsKit')){ 
		$select = [];
      $args = array(
         'post_type' => 'elementskit_template',        
      );
       $headers = get_posts($args);  
		 foreach($headers as $header) {
			$select[$header->ID ] = $header->post_title;
		}
	 return $select;  

   }
   return [];
}

function digiqole_ekit_headers_activate(){
 
      $header_settings = digiqole_option('header_builder_enable');
    
 
}

function digiqole_array_elements_remove( $input ,$elements){

   $body_array = explode( ';',$input);
  
	if($body_array[$elements]=='font-weight:regular'){
      unset($body_array[$elements]);
   }
	
	return implode(";", $body_array);
}

function digiqole_text_logo(){
   $general_text_logo = digiqole_option('general_text_logo');
   if($general_text_logo=='yes'){
      $general_text_logo_settings = digiqole_option('general_text_logo_settings');
      if(isset($general_text_logo_settings['yes'])){
            $yes = $general_text_logo_settings['yes'];
            if($yes['general_text_logo_title']){

               $general_text_logo_title = $yes['general_text_logo_title'];
               return $general_text_logo_title;
            
            }
      }
   }
   return false;
}


  

