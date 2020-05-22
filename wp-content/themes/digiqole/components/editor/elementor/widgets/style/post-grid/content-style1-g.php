<?php

  $reverse_col = $settings['reverse_col'];
  $cols        = ['order-md-1','order-md-2'];

  if($reverse_col =='yes'){
    $cols = array_reverse($cols);
  }

   $ts_image_size	= (isset($settings['ts_image_size']))
                      ? $settings['ts_image_size']
                      : 'full';  
   $show_author_avator = isset($settings['show_author_avator'])?
                        $settings['show_author_avator'] 
                        :'no';   
 
?>
<div class="block-item-post post-block-style7">
   <div class="row">                    
   <?php while ($query->have_posts()) : $query->the_post();?>

         <?php if ( $query->current_post == 0 ): ?>
              <div class="col-md-7 col-sm-6 <?php echo esc_attr($cols[0]); ?>">
              <?php  require DIGIQOLE_EDITOR_ELEMENTOR. '/widgets/style/post-grid/slider-style2.php'; ?>    
              </div>

            <?php else: ?>
            <?php if ( $query->current_post == 1 ): ?>
               <div class="col-md-5 col-sm-6 list-item <?php echo esc_attr($cols[1]); ?>">
            <?php endif; ?> 
         
               <?php require DIGIQOLE_EDITOR_ELEMENTOR . '/widgets/style/post-list/content-style1.php'; ?>
            <?php if (($query->current_post + 1) == ($query->post_count)) {?>
                  
               </div><!-- List post Col end -->
                  <?php } ?> 
         <?php endif ?> <!-- feature item -->

   <?php endwhile; ?>
   </div><!-- row -->                     
 </div><!-- block-item6 -->