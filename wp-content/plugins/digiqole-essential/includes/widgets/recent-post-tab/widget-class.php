<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * recent post widget
 */
class Digiqole_Recent_Post_Tab extends WP_Widget {

	function __construct() {

		$widget_ops = array( 'classname' => 'digiqole_latest_post_tab_widget', 'description' => esc_html__('A widget that display latest,popular,most commented posts from all categories', 'digiqole-essential') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'digiqole_latest_post_tab_widget' );
		parent::__construct( 'digiqole_latest_post_tab_widget', esc_html__('Digiqole Latest Posts Tab', 'digiqole-essential'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		// Our variables from the widget settings.
		$title 			= apply_filters('widget_title', (!isset($instance['title']) ? '' : $instance['title']) );
		$categories 	= (!isset($instance['categories'])? '': $instance['categories']);
		$post_count 	= (!isset($instance['post_count'])? '': $instance['post_count']);
		$post_sortby 	= (!isset($instance['post_sortby'])? '': $instance['post_sortby']);
		$tab_left_title 	= apply_filters('tab_left_title',!isset($instance['tab_left_title'])? '': $instance['tab_left_title']);
        $tab_right_title 	= apply_filters('tab_right_title',!isset($instance['tab_right_title'])? '': $instance['tab_right_title']);
        $tab_center_title 	= apply_filters('tab_center_title',!isset($instance['tab_center_title'])? '': $instance['tab_center_title']);
		$post_title_crop 	= (!isset($instance['post_title_crop'])? '': $instance['post_title_crop']);


		  $arg_recent = [
            'post_type'   =>  'post',
            'post_status' => 'publish',
            'order' => 'DESC',
            'orderby' => 'date',
			'posts_per_page' => $post_count,
			'suppress_filters' => false,
          
            
        ];
        $arg_fav = [
            'post_type'   =>  'post',
            'post_status' => 'publish',
			'posts_per_page' => $post_count,
			'suppress_filters' => false,
        ];

        $arg_comment = [
            'post_type'   =>  'post',
            'post_status' => 'publish',
            'orderby' => 'comment_count',
			'posts_per_page' => $post_count,
			'suppress_filters' => false,
        ];

        switch($post_sortby){
         	case 'viewcount':
				$arg_fav['meta_key'] = 'newszone_post_views_count';
            $arg_fav['orderby']  = 'meta_value_num';
            break;
            case 'rating' : 
            $arg_fav['meta_key'] = 'xs_review_ratting_avg';
            $arg_fav['orderby']  = 'meta_value_num';
         default:
             	$arg_fav['orderby'] = 'date';
        	break;
        }
        
        if($categories!='' && $categories!='all'){
           $arg_recent['category__in'] = $categories;
           $arg_fav['category__in'] = $categories;
           $arg_comment['category__in'] = $categories;
        }
     
       $recent_posts = get_posts( $arg_recent );
       $fav_posts = get_posts( $arg_fav );
     
       $comment_posts = get_posts( $arg_comment );
       
       echo $before_widget;
		 ?>
    
		 
       <div class="post-list-item widgets grid-no-shadow">
			 <ul class="nav nav-tabs recen-tab-menu" role="tablist">
				 <li role="presentation">
					 <a class="active" href="#home" aria-controls="home" role="tab" data-toggle="tab">
		  					<span></span>
						 <?php echo esc_html($tab_left_title); ?>
					 </a>
				 </li>
				 <li role="presentation">
					 <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">
					 <span></span>
						 <?php echo esc_html($tab_right_title); ?>
					 </a>
				 </li>
             <li role="presentation">
					 <a href="#mostcomments"  role="tab" data-toggle="tab">
					 <span></span>
						 <?php echo esc_html($tab_center_title); ?>
					 </a>
				 </li>
			 </ul>
			 <div class="tab-content">
				 <div role="tabpanel" class="tab-pane active post-tab-list" id="home">
                  <?php if ( count($recent_posts) ) :  ?>
                     <?php $i=0; foreach($recent_posts as $recent_post): $i++; ?>
                        <div class="post-content media">   
                        
		  							<div class="post-thumb">
									  <img 
                              class="d-flex sidebar-img" 
                              src="<?php echo esc_url(digiqole_post_thumbnail($recent_post->ID)); ?>" 
                              alt="<?php echo esc_attr(digiqole_alt($recent_post->ID)); ?>">
										<span class="post-index"> <?php echo esc_html($i); ?> </span>

									</div>

                           <div class="media-body">
                              <span class="post-tag">
                              <?php $cat = get_the_category($recent_post->ID); ?>
							     <?php if(isset($cat[0])): ?> 
									<a 
										class="post-cat only-color" 
										href="<?php echo get_category_link($cat[0]->term_id); ?>"
										style="<?php echo esc_attr(digiqole_cat_style($cat[0]->term_id, 'block_highlight_color')); ?>"
										>
										<?php echo get_cat_name($cat[0]->term_id); ?>
									</a>
								 <?php endif; ?>
                              </span>
                              <h4 class="post-title">
                              <a href="<?php the_permalink($recent_post->ID); ?>"><?php esc_html_e(digiqole_limited_title(get_the_title($recent_post->ID), $post_title_crop)); ?></a>
										</h4>
										<div class="post-meta"><span class="post-date" ><i class="fa fa-clock-o" aria-hidden="true"></i> <?php  echo get_the_date(get_option('date_format'),$recent_post->ID); ?></span></div>

                           </div>
                        </div>
                     <?php endforeach;?>
                  <?php endif; ?>
				 </div>
				 <div role="tabpanel" class="tab-pane post-tab-list" id="profile">
					 <?php
               
               
					 if ( count($fav_posts) ) : ?>
						<?php $i=0; foreach($fav_posts as $fav_post): $i++;?>
							 <div class="post-content media">    
		  							<div class="post-thumb">
										<img 
										class="d-flex sidebar-img" 
										src="<?php echo esc_url(digiqole_post_thumbnail($fav_post->ID)); ?>" 
										alt="<?php echo esc_attr(digiqole_alt($fav_post->ID)); ?>">
										<span class="post-index"> <?php echo esc_html($i); ?> </span>

									</div>
								 <div class="media-body">
                          
									 <span class="post-tag">
									 <?php $cat = get_the_category($fav_post->ID); ?>
										 <?php if(isset($cat[0])): ?> 
											<a 
												class="post-cat only-color" 
												href="<?php echo get_category_link($cat[0]->term_id); ?>"
												style="<?php echo esc_attr(digiqole_cat_style($cat[0]->term_id, 'block_highlight_color')); ?>"
												>
												<?php echo get_cat_name($cat[0]->term_id); ?>
											</a>
										 <?php endif; ?>
									 </span>
									 <h4 class="post-title">
                            
										 <a href="<?php the_permalink($fav_post->ID); ?>"><?php esc_html_e(digiqole_limited_title(get_the_title($fav_post->ID), $post_title_crop)); ?></a>
									 </h4>
									 <div class="post-meta"><span class="post-date" ><i class="fa fa-clock-o" aria-hidden="true"></i> <?php  echo get_the_date(get_option('date_format'),$fav_post->ID); ?> </span></div>

								 </div>
							 </div>
                      <?php endforeach; ?>
					 <?php endif; ?>
				 </div>
             <div role="tabpanel" class="tab-pane post-tab-list" id="mostcomments">
					 <?php
                                
					 if ( count($comment_posts) ) : ?>
						<?php $i=0; foreach($comment_posts as $comment_post): $i++;?>
                      
							 <div class="post-content media">    
		  							<div class="post-thumb">
										<img 
										class="d-flex sidebar-img" 
										src="<?php echo esc_url(digiqole_post_thumbnail($comment_post->ID)); ?>" 
										alt="<?php echo esc_attr(digiqole_alt($comment_post->ID)); ?>">
										<span class="post-index"> <?php echo esc_html($i); ?> </span>

									</div>
								 <div class="media-body">
                          
									 <span class="post-tag">
									 <?php $cat = get_the_category($comment_post->ID); ?>
									    <?php if(isset($cat[0])): ?> 
											<a 
												class="post-cat only-color" 
												href="<?php echo get_category_link($cat[0]->term_id); ?>"
												style="<?php echo esc_attr(digiqole_cat_style($cat[0]->term_id, 'block_highlight_color')); ?>"
												>
												<?php echo get_cat_name($cat[0]->term_id); ?>
											</a>
										<?php endif; ?>
									 </span>
									 <h4 class="post-title">
										 <a href="<?php the_permalink($comment_post->ID); ?>"><?php esc_html_e(digiqole_limited_title(get_the_title($comment_post->ID), $post_title_crop)); ?></a>
									 </h4>
									 <div class="post-meta"><span class="post-date"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php  echo get_the_date(get_option('date_format'),$comment_post->ID); ?> </span></div>

								 </div>
							 </div>
                      <?php endforeach; ?>
					 <?php endif; ?>
				 </div>
			 </div>
		 </div>   

		 
	<?php
echo $after_widget;
}

function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	$instance['title'] 			= strip_tags( $new_instance['title'] );
	$instance['categories'] 	= $new_instance['categories'];
	$instance['post_count'] 	= strip_tags( $new_instance['post_count'] );
	$instance['post_sortby'] 	= strip_tags( $new_instance['post_sortby'] );
	$instance['tab_right_title'] 	= strip_tags( $new_instance['tab_right_title'] );
	$instance['tab_left_title'] 	= strip_tags( $new_instance['tab_left_title'] );
	$instance['tab_center_title'] 	= strip_tags( $new_instance['tab_center_title'] );
	$instance['post_title_crop'] 	= strip_tags( $new_instance['post_title_crop'] );

	return $instance;
}


function form( $instance ) {

	$defaults = array(
		'title' => esc_html__('Blog Posts', 'digiqole-essential'),
		'post_count' => 5,
		'post_sortby' =>  esc_html__('viewcount','digiqole-essential'),
		'tab_right_title' => esc_html__('RECENT','digiqole-essential'),
		'tab_left_title' => esc_html__('POPULAR','digiqole-essential'),
		'tab_center_title' => esc_html__('COMMENTS','digiqole-essential'),
		'post_title_crop' => '50',
		'categories' => ''
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title -->
		<p>
			<label for="<?php print $this->get_field_id( 'title' ); ?>"><?php esc_html_e('Title:', 'digiqole-essential'); ?></label>
			<input  type="text" class="widefat" id="<?php print $this->get_field_id( 'title' ); ?>" name="<?php print $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>"  />
		</p>

		<!-- Tab Left Title -->
		<p>
			<label for="<?php print $this->get_field_id( 'tab_left_title' ); ?>"><?php esc_html_e('Tab Left Title:', 'digiqole-essential'); ?></label>
			<input  type="text" class="widefat" id="<?php print $this->get_field_id( 'tab_left_title' ); ?>" name="<?php print $this->get_field_name( 'tab_left_title' ); ?>" value="<?php echo esc_attr( $instance['tab_left_title'] ); ?>"  />
		</p>

		<!-- Tab Left Title -->
		<p>
			<label for="<?php print $this->get_field_id( 'tab_right_title' ); ?>"><?php esc_html_e('Tab Right Title:', 'digiqole-essential'); ?></label>
			<input  type="text" class="widefat" id="<?php print $this->get_field_id( 'tab_right_title' ); ?>" name="<?php print $this->get_field_name( 'tab_right_title' ); ?>" value="<?php echo esc_attr( $instance['tab_right_title'] ); ?>"  />
		</p>

      	<!-- Ordered By -->
         <p>
            <label for="<?php echo $this->get_field_id( 'post_sortby' ); ?>"><?php esc_html_e('Sort By', 'digiqole-essential'); ?></label>
            <?php
            $options = array(
                'latestpost' 	=> esc_html__('Latest Posts','digiqole-essential'),
                'viewcount' 	=> esc_html__('Popular','digiqole-essential'),
                'rating' 	=> esc_html__('Rating','digiqole-essential'),
                
            );
            if(isset($instance['post_sortby'])) $orderby = $instance['post_sortby'];
            ?>
            <select class="widefat" id="<?php echo $this->get_field_id( 'post_sortby' ); ?>" name="<?php echo $this->get_field_name( 'post_sortby' ); ?>">
                <?php
                $op = '<option value="%s"%s>%s</option>';

                foreach ($options as $key=>$value ) {

                    if ($orderby === $key) {
                        printf($op, $key, ' selected="selected"', $value);
                    } else {
                        printf($op, $key, '', $value);
                    }
                }
                ?>
            </select>
        </p>

      
		<!-- Tab center Title -->
		<p>
			<label for="<?php print $this->get_field_id( 'tab_center_title' ); ?>"><?php esc_html_e('Tab Center Title:', 'digiqole-essential'); ?></label>
			<input  type="text" class="widefat" id="<?php print $this->get_field_id( 'tab_center_title' ); ?>" name="<?php print $this->get_field_name( 'tab_center_title' ); ?>" value="<?php echo esc_attr( $instance['tab_center_title'] ); ?>"  />
		</p>

		<!-- Post Title Crop-->
		<p>
			<label for="<?php print $this->get_field_id( 'post_title_crop' ); ?>"><?php esc_html_e('Post Title Crop:', 'digiqole-essential'); ?></label>
			<input  type="text" class="widefat" id="<?php print $this->get_field_id( 'post_title_crop' ); ?>" name="<?php print $this->get_field_name( 'post_title_crop' ); ?>" value="<?php echo esc_attr( $instance['post_title_crop'] ); ?>"  />
		</p>

	

		<!-- Post Category -->
		<p>
			<label for="<?php print $this->get_field_id('categories'); ?>"><?php esc_html_e('Filter by Categories', 'digiqole-essential'); ?></label>
			<select id="<?php print $this->get_field_id('categories'); ?>" name="<?php print $this->get_field_name('categories'); ?>" class="widefat categories" style="width:100%;">
			<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>> <?php echo esc_html__('All categories','digiqole-essential'); ?> </option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php print $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php print $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>

		<!-- Count of Latest Posts -->
		<p>
			<label for="<?php print $this->get_field_id( 'post_count' ); ?>"><?php esc_html_e('Count of Latest Post', 'digiqole-essential'); ?></label>
			<input  type="text" class="widefat" id="<?php print $this->get_field_id( 'post_count' ); ?>" name="<?php print $this->get_field_name( 'post_count' ); ?>" value="<?php echo esc_attr( $instance['post_count'] ); ?>" size="3" />
		</p>


		<?php
	}

}
