<div class="row post-block-item block-item-post style8 post-feature">
                 
   <?php while ($query->have_posts()) : $query->the_post();?>
         
   <div class="col-md-6 col-sm-6 text-center col-lg-<?php echo esc_attr($grid_column)?>">
         <?php  require DIGIQOLE_EDITOR_ELEMENTOR. '/widgets/style/post-grid/content-style-c2.php'; ?>  
   </div><!-- Col end -->
        
   <?php endwhile; ?>
               
 </div><!-- block-item6 -->