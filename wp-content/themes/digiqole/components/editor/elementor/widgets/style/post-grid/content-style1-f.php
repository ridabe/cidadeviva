<div class="post-block-item block-item-post style6">
                 
   <?php while ($query->have_posts()) : $query->the_post();?>
         
         <?php if ( $query->current_post == 0 || $query->current_post == 1 ): ?>
            <?php if($query->current_post == 0): ?>
               <div class="row post-feature">   
            <?php endif; ?>    
                  <div class="col-md-6 col-sm-6 ">
                     <?php  require DIGIQOLE_EDITOR_ELEMENTOR. '/widgets/style/post-grid/content-style-c2.php'; ?>  
                  </div><!-- Col end -->
                <?php if (($query->current_post + 1) == ($query->post_count) || $query->current_post==1): ?>
               </div> 
            <?php endif ?>
         <?php endif ?> <!-- feature item -->
         <?php if ( $query->current_post > 1 ): ?>
         <?php if($query->current_post == 2): ?>
               <div class="row">   
            <?php endif; ?>      
                  <div class="col-lg-3 col-md-6 ">
                     <?php  require DIGIQOLE_EDITOR_ELEMENTOR. '/widgets/style/post-list/content-style7.php'; ?>
                  </div>  
              <?php if (($query->current_post + 1) == ($query->post_count)): ?>
               </div> 
           <?php endif ?>    
         <?php endif ?> 
   <?php endwhile; ?>
               
 </div><!-- block-item6 -->