<?php
/**
 * content.php
 *
 * The default template for displaying content.
 */
$blog_author_show = (isset($settings['show_author'])) 
						? $settings['show_author'] 
						: digiqole_option( 'blog_author_show', 'yes' );
						
$blog_date_show			= (isset($settings['show_date'])) 
						? $settings['show_date'] 
						: digiqole_option( 'blog_date_show', 'yes' );
$blog_cat_show			= (isset($settings['show_cat'])) 
						? $settings['show_cat'] 
						: digiqole_option( 'blog_cat_show', 'yes' );
$thumb 					= (isset($thumb))
						? $thumb
						: [600, 398];
$crop					= (isset($settings['post_title_crop']))
                        ? $settings['post_title_crop'] : 8;
$show_view_count		= (isset($settings['show_view_count']))
						? $settings['show_view_count']: 'yes';
$cat = get_the_category();

$show_author_avator = isset($settings['show_author_avator'])?
                        $settings['show_author_avator'] 
                        :'no'; 
?>

   <div class="post-content">
        <?php if($blog_cat_show=="yes"): ?> 
           <?php require DIGIQOLE_THEME_DIR . '/template-parts/blog/category/parts/cat-style.php'; ?>
         <?php endif; ?>   
        <h4 class="post-title md">
            <a href=" <?php echo esc_url(get_post_permalink()); ?> " > <?php the_title(); ?> </a>
        </h4>
     
        <ul class="post-meta-info <?php echo esc_attr($show_author_avator=='yes'?'ts-avatar-container':''); ?>">
            <?php if($show_author_avator=='yes'): ?>
                     <?php printf('<li class="ts-author-avatar">%1$s<a href="%2$s">%3$s</a></li>',
                           get_avatar( get_the_author_meta( 'ID' ), 45 ), 
                           esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), 
                           get_the_author()
                        ); ?>
            <?php endif; ?>  
            <?php if( $blog_author_show == 'yes') { ?>
                <?php if ( get_the_author_meta('first_name') != "" || get_the_author_meta('last_name') != "" ) { ?>
                    <li class="post-author"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author_meta('first_name');?> <?php echo get_the_author_meta('last_name');?></a></li>
                <?php } else { ?>
                    <li class="post-author"> <i class="fa fa-user"></i>   <?php the_author_posts_link() ?></li>
                <?php }?>
            <?php } ?>
          <?php if($blog_date_show == 'yes'): ?>
            <li class="post-date">
                <i class="fa fa-clock-o"></i>
                <?php echo get_the_date(get_option('date_format')); ?>
            </li> 
          <?php endif; ?>    
            <?php if($show_view_count == 'yes'): ?>
            <li class="post-view">
                <i class="icon icon-eye"></i>
                <?php echo digiqole_get_postview(get_the_ID()); ?>
            </li> 
            <?php endif; ?>   
        </ul> 

        <p><?php echo esc_html( wp_trim_words(get_the_excerpt(),$content_crop,'') );?></p>
   </div>


