<?php if ( ! class_exists( 'GPUR_Reviews_List_Widget' ) ) {
	class GPUR_Reviews_List_Widget extends WP_Widget {
	
		function __construct() {
		
			$widget_ops = array( 
				'classname' => 'gpur-reviews-list-widget', 
				'description' => esc_html__( 'Display reviews.', 'gpur' ) 
			);
			
			parent::__construct( 
				'gpur-reviews-list-widget', 
				esc_html__( 'Ultimate Reviewer: Reviews List', 'gpur' ), 
				$widget_ops 
			);
			
		}

		function widget( $args, $instance ) {
		
			extract( $args );
				
			$title = isset( $instance['title'] ) ? $instance['title'] : '';
			$post_types = isset( $instance['post_types'] ) ? $instance['post_types'] : array( 'post' );
			$ids = isset( $instance['ids'] ) ? $instance['ids'] : '';
			$cats = isset( $instance['cats'] ) ? $instance['cats'] : '';
			$tags = isset( $instance['tags'] ) ? $instance['tags'] : '';
			$current_tax = isset( $instance['current_tax'] ) ? (bool) $instance['current_tax'] : 0;
			$sort = isset( $instance['sort'] ) ? $instance['sort'] : 'post-date-desc';
			$number = isset( $instance['number'] ) ? $instance['number'] : 5;
			$exclude_current_item = isset( $instance['exclude_current_item'] ) ? (bool) $instance['exclude_current_item'] : 0;
			$show_image = isset( $instance['show_image'] ) ? (bool) $instance['show_image'] : 0;
			$show_title = isset( $instance['show_title'] ) ? (bool) $instance['show_title'] : 0;
			$show_name = isset( $instance['show_name'] ) ? (bool) $instance['show_name'] : 0;
			$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : 0;
			$show_comments = isset( $instance['show_comments'] ) ? (bool) $instance['show_comments'] : 0;
			$show_likes = isset( $instance['show_likes'] ) ? (bool) $instance['show_likes'] : 0;
			$show_site_rating = isset( $instance['show_site_rating'] ) ? (bool) $instance['show_site_rating'] : 0;
			$show_user_rating = isset( $instance['show_user_rating'] ) ? (bool) $instance['show_user_rating'] : 0;
			$show_excerpt = isset( $instance['show_excerpt'] ) ? (bool) $instance['show_excerpt'] : 0;
			$show_view_link = isset( $instance['show_view_link'] ) ? (bool) $instance['show_view_link'] : 0;
			$image_size = isset( $instance['image_size'] ) ? $instance['image_size'] : '75 x 75';
			$title_length = isset( $instance['title_length'] ) ? $instance['title_length'] : '';
			$excerpt_length = isset( $instance['excerpt_length'] ) ? $instance['excerpt_length'] : '';
							
			echo wp_kses_post( $before_widget );

			echo wp_kses_post( $after_widget );		

		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = isset( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '';
			$instance['post_types'] = isset( $new_instance['post_types'] ) ? $new_instance['post_types'] : '';
			$instance['ids'] = isset( $new_instance['ids'] ) ? sanitize_text_field( $new_instance['ids'] ) : '';
			$instance['cats'] = isset( $new_instance['cats'] ) ? sanitize_text_field( $new_instance['cats'] ) : '';
			$instance['tags'] = isset( $new_instance['tags'] ) ? sanitize_text_field( $new_instance['tags'] ) : '';
			$instance['current_tax'] = isset( $new_instance['current_tax'] ) ? (bool) $new_instance['current_tax'] : 0;
			$instance['sort'] = isset( $_POST['sort'] ) ? sanitize_text_field( $_POST['sort'] ) : 'post-date-desc';
			$instance['number'] = isset( $new_instance['number'] ) ? intval( $new_instance['number'] ) : 5;
			$instance['exclude_current_item'] = isset( $new_instance['exclude_current_item'] ) ? (bool) $new_instance['exclude_current_item'] : 0;
			$instance['show_image'] = isset( $new_instance['show_image'] ) ? (bool) $new_instance['show_image'] : 0;
			$instance['show_title'] = isset( $new_instance['show_title'] ) ? (bool) $new_instance['show_title'] : 0;
			$instance['show_name'] = isset( $new_instance['show_name'] ) ? (bool) $new_instance['show_name'] : 0;
			$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : 0;
			$instance['show_comments'] = isset( $new_instance['show_comments'] ) ? (bool) $new_instance['show_comments'] : 0;
			$instance['show_likes'] = isset( $new_instance['show_likes'] ) ? (bool) $new_instance['show_likes'] : 0;
			$instance['show_site_rating'] = isset( $new_instance['show_site_rating'] ) ? (bool) $new_instance['show_site_rating'] : 0;
			$instance['show_user_rating'] = isset( $new_instance['show_user_rating'] ) ? (bool) $new_instance['show_user_rating'] : 0;
			$instance['show_excerpt'] = isset( $new_instance['show_excerpt'] ) ? (bool) $new_instance['show_excerpt'] : 0;
			$instance['show_view_link'] = isset( $new_instance['show_view_link'] ) ? (bool) $new_instance['show_view_link'] : 0;
			$instance['image_size'] = isset( $new_instance['image_size'] ) ? sanitize_text_field( $new_instance['image_size'] ) : '75 x 75';
			$instance['title_length'] = isset( $new_instance['title_length'] ) ? intval( $new_instance['title_length'] ) : '';
			$instance['excerpt_length'] = isset( $new_instance['excerpt_length'] ) ? intval( $new_instance['excerpt_length'] ) : '';
			return $instance;
		}

		function form( $instance ) {
		
			// Defaults
			$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
			$post_types = isset( $instance['post_types'] ) ? $instance['post_types'] : array( 'post' );
			$ids = isset( $instance['ids'] ) ? esc_attr( $instance['ids'] ) : '';
			$cats = isset( $instance['cats'] ) ? esc_attr( $instance['cats'] ) : '';
			$tags = isset( $instance['tags'] ) ? esc_attr( $instance['tags'] ) : '';
			$current_tax = isset( $instance['current_tax'] ) ? (bool) $instance['current_tax'] : 0;
			$sort = isset( $instance['sort'] ) ? esc_attr( $instance['sort'] ) : 'post-date-desc';
			$number = isset( $instance['number'] ) ? intval( $instance['number'] ) : 5;
			$exclude_current_item = isset( $instance['exclude_current_item'] ) ? (bool) $instance['exclude_current_item'] : 0;
			$show_image = isset( $instance['show_image'] ) ? (bool) $instance['show_image'] : 1;
			$show_title = isset( $instance['show_title'] ) ? (bool) $instance['show_title'] : 1;
			$show_name = isset( $instance['show_name'] ) ? (bool) $instance['show_name'] : 1;
			$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : 1;
			$show_comments = isset( $instance['show_comments'] ) ? (bool) $instance['show_comments'] : 1;
			$show_likes = isset( $instance['show_likes'] ) ? (bool) $instance['show_likes'] : 1;
			$show_site_rating = isset( $instance['show_site_rating'] ) ? (bool) $instance['show_site_rating'] : 1;
			$show_user_rating = isset( $instance['show_user_rating'] ) ? (bool) $instance['show_user_rating'] : 1;
			$show_excerpt = isset( $instance['show_excerpt'] ) ? (bool) $instance['show_excerpt'] : 1;
			$show_view_link = isset( $instance['show_view_link'] ) ? (bool) $instance['show_view_link'] : 1;
			$image_size = isset( $instance['image_size'] ) ? esc_attr( $instance['image_size'] ) : '75 x 75';
			$title_length = isset( $instance['title_length'] ) ? intval( $instance['title_length'] ) : '';
			$excerpt_length = isset( $instance['excerpt_length'] ) ? intval( $instance['excerpt_length'] ) : '';
			
			?>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'gpur' ); ?></label><br/>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'post_types' ) ); ?>"><?php esc_html_e( 'Post Types:', 'gpur' ); ?></label><br/>
				
				<?php
				$get_post_types = get_post_types( 
					array(
						'public'              => true,
						'exclude_from_search' => false,
					), 
					'names', 
					'and'
				);
				foreach ( $get_post_types as $get_post_type ) {
					if ( in_array( $get_post_type, $post_types ) ) {
						$checked = ' checked="checked"';
					} else {
						$checked = '';
					}
					if ( 'attachment' !== $get_post_type && 'gpur-template' !== $get_post_type ) { ?>
						<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'post_types' ) ); ?>-<?php echo esc_attr( $get_post_type ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_types' ) ); ?>[]" value="<?php echo esc_attr( $get_post_type ); ?>"<?php echo $checked; ?> /> <label for="<?php echo esc_attr( $this->get_field_id( 'post_types' ) ); ?>"><?php echo esc_attr( $get_post_type ); ?></label>
					<?php }	
				}
				?>
			</p>
					
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'ids' ) ); ?>"><?php esc_html_e( 'Post/Page IDs:', 'gpur' ); ?></label><br/>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ids' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ids' ) ); ?>" value="<?php echo esc_attr( $ids ); ?>" />
				<small><?php esc_html_e( 'Enter the post/pages IDs you want to show - separate IDs with a comma e.g. 123, 456, 789', 'gpur' ); ?></small>
			</p>
					
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cats' ) ); ?>"><?php esc_html_e( 'Categories:', 'gpur' ); ?></label><br/>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'cats' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'cats' ) ); ?>" value="<?php echo esc_attr( $cats ); ?>" />
				<small><?php esc_html_e( 'Enter the category slugs you want to display posts from - separate slugs with a comma e.g. category-1, category-2, category-3', 'gpur' ); ?></small>
			</p>
					
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'tags' ) ); ?>"><?php esc_html_e( 'Tags:', 'gpur' ); ?></label><br/>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'tags' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tags' ) ); ?>" value="<?php echo esc_attr( $tags ); ?>" />
				<small><?php esc_html_e( 'Enter the tag slugs you want to display posts from - separate slugs with a comma e.g. tag-1, tag-2, tag-3', 'gpur' ); ?></small>
			</p>
			
			<p>
				<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'current_tax' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'current_tax' ) ); ?>" value="1" <?php checked( $current_tax, true ); ?> /> <label for="<?php echo esc_attr( $this->get_field_id( 'current_tax' ) ); ?>"><?php esc_html_e( 'Current Taxonomy', 'gpur' ); ?></label><br/>
				<small><?php esc_html_e( 'Only show posts from the current category/tag.', 'gpur' ); ?></small>
			</p>
									
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'sort' ) ); ?>"><?php esc_html_e( 'Sort:', 'gpur' ); ?></label><br/>
				<select id="<?php echo esc_attr( $this->get_field_id( 'sort' ) ); ?>" name="sort">
					<option value="post-date-desc" <?php if ( 'post-date-desc' === $sort ) { echo 'selected="selected"'; } ?>><?php esc_html_e( 'Most Recent', 'gpur' ); ?></option>	
					<option value="post-title-asc" <?php if ( 'post-title-asc' === $sort ) { echo 'selected="selected"'; } ?>><?php esc_html_e( 'Alphabetical (A-Z)', 'gpur' ); ?></option>	
					<option value="post-title-desc" <?php if ( 'post-title-desc' === $sort ) { echo 'selected="selected"'; } ?>><?php esc_html_e( 'Alphabetical (Z-A)', 'gpur' ); ?></option>	
					<option value="site-rating-desc" <?php if ( 'site-rating-desc' === $sort ) { echo 'selected="selected"'; } ?>><?php esc_html_e( 'Highest Site Rated', 'gpur' ); ?></option>
					<option value="site-rating-asc" <?php if ( 'site-rating-asc' === $sort ) { echo 'selected="selected"'; } ?>><?php esc_html_e( 'Lowest Site Rated', 'gpur' ); ?></option>
					<option value="user-rating-desc" <?php if ( 'user-rating-desc' === $sort ) { echo 'selected="selected"'; } ?>><?php esc_html_e( 'Highest User Rated', 'gpur' ); ?></option>	
					<option value="user-rating-asc" <?php if ( 'user-rating-asc' === $sort ) { echo 'selected="selected"'; } ?>><?php esc_html_e( 'Lowest User Rated', 'gpur' ); ?></option>		
					<option value="user-votes-desc" <?php if ( 'user-votes-desc' === $sort ) { echo 'selected="selected"'; } ?>><?php esc_html_e( 'Most User Votes', 'gpur' ); ?></option>		
					<option value="likes-desc" <?php if ( 'likes-desc' === $sort ) { echo 'selected="selected"'; } ?>><?php esc_html_e( 'Most Likes', 'gpur' ); ?></option>		
					<option value="random" <?php if ( 'random' === $sort ) { echo 'selected="selected"'; } ?>><?php esc_html_e( 'Random', 'gpur' ); ?></option>		
					<option value="post-page-order" <?php if ( 'post-page-order' === $sort ) { echo 'selected="selected"'; } ?>><?php esc_html_e( 'Post/Page Order', 'gpur' ); ?></option>
				</select>
			</p>	
					
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number:', 'gpur' ); ?></label><br/>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" value="<?php echo absint( $number ); ?>" />
			</p>
			
			<p>
				<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'exclude_current_item' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'exclude_current_item' ) ); ?>" value="1" <?php checked( $exclude_current_item, true ); ?> /> <label for="<?php echo esc_attr( $this->get_field_id( 'exclude_current_item' ) ); ?>"><?php esc_html_e( 'Exclude Current Item', 'gpur' ); ?></label><br/>
				<small><?php esc_html_e( 'Exclude the current post/page from showing in the review list.', 'gpur' ); ?></small>
			</p>
			
			<?php esc_html_e( 'Show:', 'gpur' ); ?>
			
			<ul>
				
				<li>
					<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_image' ) ); ?>" value="1" <?php checked( $show_image, true ); ?> /> <label for="<?php echo esc_attr( $this->get_field_id( 'show_image' ) ); ?>"><?php esc_html_e( 'Featured Image', 'gpur' ); ?></label>
				</li>
			
				<li>
					<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_title' ) ); ?>" value="1" <?php checked( $show_title, true ); ?> /> <label for="<?php echo esc_attr( $this->get_field_id( 'show_title' ) ); ?>"><?php esc_html_e( 'Title', 'gpur' ); ?></label>
				</li>
			
				<li>
					<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_name' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_name' ) ); ?>" value="1" <?php checked( $show_name, true ); ?> /> <label for="<?php echo esc_attr( $this->get_field_id( 'show_name' ) ); ?>"><?php esc_html_e( 'Name', 'gpur' ); ?></label>
				</li>
			
				<li>
					<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_date' ) ); ?>" value="1" <?php checked( $show_date, true ); ?> /> <label for="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>"><?php esc_html_e( 'Date', 'gpur' ); ?></label>
				</li>
			
				<li>
					<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_comments' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_comments' ) ); ?>" value="1" <?php checked( $show_comments, true ); ?> /> <label for="<?php echo esc_attr( $this->get_field_id( 'show_comments' ) ); ?>"><?php esc_html_e( 'Comments', 'gpur' ); ?></label>
				</li>
			
				<li>
					<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_likes' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_likes' ) ); ?>" value="1" <?php checked( $show_likes, true ); ?> /> <label for="<?php echo esc_attr( $this->get_field_id( 'show_likes' ) ); ?>"><?php esc_html_e( 'Likes', 'gpur' ); ?></label>
				</li>
			
				<li>
					<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_site_rating' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_site_rating' ) ); ?>" value="1" <?php checked( $show_site_rating, true ); ?> /> <label for="<?php echo esc_attr( $this->get_field_id( 'show_site_rating' ) ); ?>"><?php esc_html_e( 'Site Rating', 'gpur' ); ?></label>
				</li>
			
				<li>
					<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_user_rating' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_user_rating' ) ); ?>" value="1" <?php checked( $show_user_rating, true ); ?> /> <label for="<?php echo esc_attr( $this->get_field_id( 'show_user_rating' ) ); ?>"><?php esc_html_e( 'User Rating', 'gpur' ); ?></label>
				</li>
			
				<li>
					<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_excerpt' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_excerpt' ) ); ?>" value="1" <?php checked( $show_excerpt, true ); ?> /> <label for="<?php echo esc_attr( $this->get_field_id( 'show_excerpt' ) ); ?>"><?php esc_html_e( 'Excerpt', 'gpur' ); ?></label>
				</li>
			
				<li>
					<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_view_link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_view_link' ) ); ?>" value="1" <?php checked( $show_view_link, true ); ?> /> <label for="<?php echo esc_attr( $this->get_field_id( 'show_view_link' ) ); ?>"><?php esc_html_e( 'View Link', 'gpur' ); ?></label>
				</li>
			
			</ul>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'image_size' ) ); ?>"><?php esc_html_e( 'Image Size:', 'gpur' ); ?></label><br/>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'image_size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image_size' ) ); ?>" value="<?php echo esc_attr( $image_size ); ?>" />
				<small><?php esc_html_e( 'Enter image size e.g. "thumbnail", "medium", "large", "full" or enter size in pixels e.g. 200 x 100 (width x height).', 'gpur' ); ?></small>
			</p>
							
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title_length' ) ); ?>"><?php esc_html_e( 'Title Length:', 'gpur' ); ?></label><br/>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title_length' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title_length' ) ); ?>" value="<?php echo esc_attr( $title_length ); ?>" />
				<small><?php esc_html_e( 'The number of characters in the title. Leave empty to display all characters.', 'gpur' ); ?></small>
			</p>
					
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'excerpt_length' ) ); ?>"><?php esc_html_e( 'Excerpt Length:', 'gpur' ); ?></label><br/>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'excerpt_length' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'excerpt_length' ) ); ?>" value="<?php echo esc_attr( $excerpt_length ); ?>" />
				<small><?php esc_html_e( 'The number of characters in the comment text. Leave empty to display all characters.', 'gpur' ); ?></small>
			</p>
									
			<?php

		}
	}

}