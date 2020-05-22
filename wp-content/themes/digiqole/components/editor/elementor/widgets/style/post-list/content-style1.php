 
   <div class="item">
      <div class="post-content">
         <?php if($settings['show_cat'] == 'yes'): $cat = get_the_category(); ?>
            <?php require DIGIQOLE_THEME_DIR . '/template-parts/blog/category/parts/cat-style.php'; ?>
         <?php endif; ?>
         <h4 class="post-title">
               <a href="<?php the_permalink(); ?>">  <?php echo esc_html(wp_trim_words(get_the_title(), $settings['post_title_crop'],'')); ?></a>
         </h4>
         <?php if($settings['show_date'] == 'yes'): ?>
         <div class="post-meta">
            <span>
               <i class="fa fa-clock-o"></i> <?php echo get_the_date(get_option('date_format')); ?>
            </span>
         </div>
         <?php endif; ?>
      </div>
   </div>