   
   
   <?php $cat = get_the_category(); ?> 

   <?php foreach( $cat as $key => $category): ?>

            <?php
               if($key == 2):
                  break;
               endif; 
            ?>

            <a 
               class="post-cat" 
               href="<?php echo esc_url(get_category_link($category->term_id)); ?>"
               style="<?php echo esc_attr(digiqole_cat_style($category->term_id, 'block_highlight_color','bg')); ?>"
               >

               <?php echo esc_html($category->cat_name); ?>
               
            </a>
   
   <?php endforeach; ?>