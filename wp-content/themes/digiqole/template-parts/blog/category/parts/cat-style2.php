
   <?php $cat = get_the_category(); ?> 
   <?php if(isset($cat[0])): ?>
    <a 
         class="post-cat only-color" 
         href="<?php echo esc_url(get_category_link($cat[0]->term_id)); ?>"
         style="<?php echo esc_attr(digiqole_category_style($cat[0]->term_id, 'block_highlight_color')); ?>"
         >
         <?php echo get_cat_name($cat[0]->term_id); ?>
      </a>
   <?php endif; ?>   
