<?php

   $blog_author = digiqole_option('blog_author_show_footer'); 
  
?> 
<?php if($blog_author=="yes"): ?>
<div class="author-box solid-bg">
    <div class="author-img pull-left">
       <?php echo get_avatar(get_the_author_meta('ID')); ?>
    </div>
    <div class="author-info">
        <h3><?php echo get_the_author(); ?></h3>
        <p class="author-url">
            <a href="#">
            <?php echo get_the_author_meta('user_url'); ?>
            </a>
        </p>
         <p> 
            <?php echo get_the_author_meta('user_description'); ?>
         </p>
     </div>
</div> <!-- Author box end -->
<?php endif; ?>