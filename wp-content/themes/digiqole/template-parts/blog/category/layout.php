
<?php
 

  $category = get_category( get_query_var( 'cat' ) );
  $cat_layout = digiqole_term_option($category->cat_ID, 'block_category_template', 'style1');
  
  get_template_part( 'template-parts/blog/category/parts/feature/feature', 'post' ); 
  get_template_part( 'template-parts/blog/category/style/content', $cat_layout );

