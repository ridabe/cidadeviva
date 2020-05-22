

<?php

      if(digiqole_option('blog_category_title_show','yes')=='no'){
         return;
      }  
      
      $category = get_category( get_query_var( 'cat' ) );
      $cat_class = digiqole_term_option($category->cat_ID, 'block_category_template', 'style1'); ?>
    
      <div class="category-main-title heading-style3 <?php echo esc_attr($cat_class); ?>">
         <h1 class="block-title">
            <span class="title-angle-shap"> <?php echo esc_html__('Category','digiqole').' :'; ?>  <?php single_cat_title(); ?> </span>
         </h1>
      </div>

   <?php digiqole_child_category_meta(); ?>
