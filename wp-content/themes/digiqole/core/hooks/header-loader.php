<?php

function digiqole_header_builder_kit(){
    if(!is_customize_preview()){
        return;
    }

    $header_settings       = digiqole_option('theme_header_default_settings');
    $header_builder_enable = digiqole_option('header_builder_enable');

    if($header_builder_enable=='yes'){
        $args = [
            'posts_per_page'   => -1,
            'orderby'          => 'id',
            'order'            => 'DESC',
            'post_status'      => 'publish',
            'post_type'        => 'elementskit_template',
            'meta_query' => [
                [
                    'key'     => 'elementskit_template_activation',
                    'value'   => 'yes',
                    'compare' => '=',
                ],
            ],
        ];
        $headers = get_posts($args);
        foreach($headers as $header){
            update_post_meta($header->ID, 'elementskit_template_activation', '');
        }
    }
}
add_action( 'wp_loaded', 'digiqole_header_builder_kit' );


function digiqole_reading_progressbar() {
   $reading_progressbar_flag = false;

   $reading_progressbar = digiqole_option('blog_reading_pregressbar'); 
   if($reading_progressbar=='no'){
      return;
   }
   if(defined( 'FW' )){
   $blog_reading_pregressbar_settings = digiqole_option('blog_reading_pregressbar_settings'); 
   $post_type_area = $blog_reading_pregressbar_settings['yes']['blog_reading_progressbar_area'];

   $post_type_cls = '.main-container'; 
   if(in_array("all", $post_type_area)){
      $reading_progressbar_flag = true;
      
   }elseif(is_singular('post') && in_array("post", $post_type_area)){
      $reading_progressbar_flag = true;
      $post_type_cls = 'digiqole-single-post';
   }elseif(is_singular('page') && in_array("page", $post_type_area)){
      $reading_progressbar_flag = true;
   }elseif(is_category() && in_array("category", $post_type_area)){
      $reading_progressbar_flag = true;
   }else{
      return;
   }
}
  
 ?>
 
   <?php if($reading_progressbar_flag): ?>
   
      <?php if(is_singular('post') && in_array("post", $post_type_area)): ?>  
         <div data-posttypecls="<?php echo esc_attr($post_type_cls); ?>" class="digiqole_progress_container progress-container">
            <span class="progress-bar"></span>
         </div>
      <?php else: ?>   
      
      <div class="reading-progressbar">
         <div class="progress-container">
            <div class="progress-bar" id="readingProgressbar"></div>
         </div>  
      </div> 

      <?php endif; ?>

   
   <?php endif; ?> 

<?php
}
add_action( 'wp_body_open', 'digiqole_reading_progressbar' );