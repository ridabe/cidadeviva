<?php if ( ! class_exists( 'GPUR_User_Reviews_Widget' ) ) {
	class GPUR_User_Reviews_Widget extends WP_Widget {
	
		function __construct() {
		
			$widget_ops = array( 
				'classname' => 'gpur-user-reviews-widget', 
				'description' => esc_html__( 'Display user reviews.', 'gpur' ) 
			);
			
			parent::__construct( 
				'gpur-user-reviews-widget', 
				esc_html__( 'Ultimate Reviewer: User Reviews', 'gpur' ), 
				$widget_ops 
			);
			
		}

		function widget( $args, $instance ) {
		
			extract( $args );
				
			$title = isset( $instance['title'] ) ? $instance['title'] : '';
			$show_avatar = isset( $instance['show_avatar'] ) ? (bool) $instance['show_avatar'] : 0;
			$show_name = isset( $instance['show_name'] ) ? (bool) $instance['show_name'] : 0;
			$show_review_date = isset( $instance['show_review_date'] ) ? (bool) $instance['show_review_date'] : 0;
			$show_review_title = isset( $instance['show_review_title'] ) ? (bool) $instance['show_review_title'] : 0;
			$show_rating = isset( $instance['show_rating'] ) ? (bool) $instance['show_rating'] : 0;
			$show_likes = isset( $instance['show_likes'] ) ? (bool) $instance['show_likes'] : 0;
			$show_comment_text = isset( $instance['show_comment_text'] ) ? (bool) $instance['show_comment_text'] : 0;
			$show_view_link = isset( $instance['show_view_link'] ) ? (bool) $instance['show_view_link'] : 0;
			$show_post_title = isset( $instance['show_post_title'] ) ? (bool) $instance['show_post_title'] : 0;
			$order = isset( $instance['order'] ) ? $instance['order'] : 'date';
			$number = isset( $instance['number'] ) ? $instance['number'] : 5;
			$ids = isset( $instance['ids'] ) ? $instance['ids'] : '';
			$comment_text_length = isset( $instance['comment_text_length'] ) ? $instance['comment_text_length'] : '';
			$review_title_length = isset( $instance['review_title_length'] ) ? $instance['review_title_length'] : '';
			$show_avg_rating = isset( $instance['show_avg_rating'] ) ? (bool) $instance['show_avg_rating'] : 0;
			
			echo wp_kses_post( $before_widget );
	
				echo '<div class="gpur-element-wrapper gpur-user-reviews-wrapper">';
	
					if ( $title ) {
						echo wp_kses_post( $before_title . $title . $after_title );
					}
				
					// Comment order
					if ( 'top-rated' === $order ) {
						$meta_key = 'gpur_avg_rating';
						$order_by = 'meta_value_num';
						$order = 'desc';
					} elseif ( 'lowest-rated' === $order ) {
						$meta_key = 'gpur_avg_rating';
						$order_by = 'meta_value_num';
						$order = 'asc';
					} elseif ( 'most-helpful' === $order ) {
						$meta_key = 'gpur_up_votes';
						$order_by = 'meta_value_num';
						$order = 'desc';
					} else {
						$meta_key = '';
						$order_by = 'date';
						$order = 'desc';
					}
					
					if ( $ids ) {
						$ids = explode( ',', $ids );
					}
							
					// Query						
					$args = array(
						'type' => 'review',
						'meta_key' => $meta_key,
						'orderby' => $order_by,
						'order' => $order,
						'post__in' => $ids,
						'number' => $number,
						'post_status' => 'publish',
						'status' => 'approve',
					);
								
					$comments = get_comments( $args );
		
					// Comment Loop
					if ( $comments ) {
		
						foreach( $comments as $comment ) {
	
							echo '<div class="gpur-user-review">';
					
								// Commenter avatar
								if ( 1 == $show_avatar ) {
									echo '<div class="gpur-user-review-avatar">' . get_avatar( $comment, 48 ) . '</div>';
								}
								
								echo '<div class="gpur-user-review-meta">';
																	
									// Commenter name
									if ( 1 == $show_name ) {
										echo '<div class="gpur-user-review-name">' . get_comment_author_link( $comment ) . '</div>';
									}
							
									// Comment date
									if ( 1 == $show_review_date ) {
										echo '<div class="gpur-user-review-date">' . get_comment_date( get_option( 'date_format' ), $comment ) . '</div>';
									}
									
									// Rating
									if ( 1 == $show_rating ) {
									
										if ( 1 == $show_avg_rating ) { 
											$criteria = '';
										} else {
											$criteria = gpur_option( 'comment_form_criteria' );
										}
										
										static $run_once = true;
										
										echo gpur_show_rating_template( 
											array(
												'post_id' => $comment->comment_ID, 
												'meta' => 'widget',
												'run_once' => $run_once,
												'atts' => array(
													'data' => 'comment-rating',
													'max_rating' => gpur_option( 'comment_form_max_rating' ),
													'fractions' => gpur_option( 'comment_form_fractions' ),
													'step' => gpur_option( 'comment_form_step' ),
													'decimal_places' => gpur_option( 'comment_form_decimal_places' ),
													'show_zero_rating' => gpur_option( 'comment_rating_show_zero_rating' ),
												
													'style' => gpur_option( 'comment_rating_style' ),
													'text_position' => gpur_option( 'comment_rating_text_position' ),
													'rating_image' => gpur_option( 'comment_rating_rating_image' ),
													'empty_icon' => gpur_option( 'comment_rating_icons', 'empty_icon' ),
													'empty_icon_color' => gpur_option( 'comment_rating_icon_styling', 'empty_icon_color' ),
													'filled_icon' => gpur_option( 'comment_rating_icons', 'filled_icon' ),
													'filled_icon_color' => gpur_option( 'comment_rating_icon_styling', 'filled_icon_color' ),
													'icon_width' => gpur_option( 'comment_rating_icon', 'icon_width' ),
													'icon_height' => gpur_option( 'comment_rating_icons', 'icon_height' ),
												
													'rating_container_width' => gpur_option( 'comment_rating_rating_container', 'width' ),
													'rating_container_height' => gpur_option( 'comment_rating_rating_container', 'height' ),
													'rating_container_background_color' => gpur_option( 'comment_rating_rating_container', 'background_color' ),
													'rating_container_border_width' => gpur_option( 'comment_rating_rating_container', 'border_width' ),
													'rating_container_border_color' => gpur_option( 'comment_rating_rating_container', 'border_color' ),
													'rating_container_extra_css' => gpur_option( 'comment_rating_rating_container', 'extra_css' ),
												
													'gauge_width' => gpur_option( 'comment_rating_gauge', 'width' ),
													'gauge_filled_color_1' => gpur_option( 'comment_rating_gauge', 'filled_color_1' ),
													'gauge_filled_color_2' => gpur_option( 'comment_rating_gauge', 'filled_color_2' ),
													'gauge_empty_color' => gpur_option( 'comment_rating_gauge', 'empty_color' ),
												
													'show_avg_user_rating_text' => 0,
													'show_user_votes_text' => 0,
												
													'show_ind_user_rating_text' => 0,
													'ind_user_rating_number_size' => gpur_option( 'comment_rating_ind_user_rating_number', 'size' ),
													'ind_user_rating_number_color' => gpur_option( 'comment_rating_ind_user_rating_number', 'color' ),
													'ind_user_rating_number_extra_css' => gpur_option( 'comment_rating_ind_user_rating_number', 'extra_css' ),
													'show_ind_user_rating_max_rating_number' => gpur_option( 'comment_rating_show_ind_user_rating_max_rating_number' ),
													'ind_user_rating_max_rating_number_size' => gpur_option( 'comment_rating_ind_user_rating_max_rating_number', 'size' ),
													'ind_user_rating_max_rating_number_color' => gpur_option( 'comment_rating_ind_user_rating_max_rating_number', 'color' ),
													'ind_user_rating_max_rating_number_extra_css' => gpur_option( 'comment_rating_ind_user_rating_max_rating_number', 'extra_css' ),
												
													'criteria' => $criteria,
													'criteria_format' => gpur_option( 'comment_rating_criteria_format' ),
													'criteria_title_size' => gpur_option( 'comment_rating_criteria_title', 'size' ),
													'criteria_title_color' => gpur_option( 'comment_rating_criteria_title', 'color' ),
													'criteria_extra_css' => gpur_option( 'comment_rating_criteria_title', 'extra_css' ),
												
													'show_ranges_text' => 0,
												),
											)	
										);	
										
										$run_once = false;								
										
									}
									
									echo '<div class="gpur-clear"></div>';

								echo '</div>';
									
								echo '<div class="gpur-user-review-content">';
																
									$ellipses = apply_filters( 'gpur_ellipses', '...' );
								
									// Review title
									if ( 1 == $show_review_title ) {
										if ( $title = get_comment_meta( $comment->comment_ID, 'gpur_title', true ) ) {		
											if ( $review_title_length != '' ) {
												if ( mb_strlen( $title ) > $review_title_length ) {
													$title = mb_substr( $title, 0, (int) $review_title_length ) . $ellipses;
												}
											}
											echo '<div class="gpur-user-review-title">' . esc_attr( $title ) . '</div>';
										}
									}
					
									// Review text
									if ( 1 == $show_comment_text ) {
										if ( $text = $comment->comment_content ) {
											if ( $comment_text_length != '' ) {	
												if ( mb_strlen( $text ) > $comment_text_length ) {	
													$text = mb_substr( $text, 0, (int) $comment_text_length ) . $ellipses;
												}
											}	
											$view_link = '';
											if ( 1 == $show_view_link ) {
												$view_link = ' <a href="' . get_comment_link( $comment->comment_ID ) . '">' . esc_html__( 'View', 'gpur' ) . '</a>';
											}
											echo '<div class="gpur-user-review-text">' . esc_attr( $text ) . wp_kses_post( $view_link ) . '</div>';
										}
									}
								
									// Post title
									if ( 1 == $show_post_title ) {
										echo '<a href="' . get_comment_link( $comment->comment_ID ) . '" class="gpur-user-review-post-title">' . get_the_title( $comment->comment_post_ID ) . '</a>';
									}

									// Rating
									if ( 1 == $show_likes ) {
										if ( get_comment_meta( $comment->comment_ID, 'gpur_up_votes', true ) ) {
											
											if ( 1 == get_comment_meta( $comment->comment_ID, 'gpur_up_votes', true ) ) {
												$text = esc_html__( 'person', 'gpur' );
											} else {
												$text = esc_html__( 'people', 'gpur' );
											}
											
											echo '<div class="gpur-user-review-likes">' . sprintf( __( '%d %s found this helpful', 'gpur' ), get_comment_meta( $comment->comment_ID, 'gpur_up_votes', true ), $text ) . '</div>';
										}
									}
									
								echo '</div>';	
				
								echo '<div class="gpur-clear"></div>';
							
							echo '</div>';
				
						}
						
					}
					
				echo '</div>';
			
			echo wp_kses_post( $after_widget );		

		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = isset( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '';
			$instance['order'] = isset( $_POST['order'] ) ? sanitize_text_field( $_POST['order'] ) : 'date';
			$instance['number'] = isset( $new_instance['number'] ) ? intval( $new_instance['number'] ) : 5;
			$instance['ids'] = isset( $new_instance['ids'] ) ? sanitize_text_field( $new_instance['ids'] ) : '';
			$instance['comment_text_length'] = isset( $new_instance['comment_text_length'] ) ? esc_attr( $new_instance['comment_text_length'] ) : '';
			$instance['review_title_length'] = isset( $new_instance['review_title_length'] ) ? esc_attr( $new_instance['review_title_length'] ) : '';
			$instance['show_avatar'] = isset( $new_instance['show_avatar'] ) ? (bool) $new_instance['show_avatar'] : 0;
			$instance['show_name'] = isset( $new_instance['show_name'] ) ? (bool) $new_instance['show_name'] : 0;
			$instance['show_review_date'] = isset( $new_instance['show_review_date'] ) ? (bool) $new_instance['show_review_date'] : 0;
			$instance['show_review_title'] = isset( $new_instance['show_review_title'] ) ? (bool) $new_instance['show_review_title'] : 0;
			$instance['show_rating'] = isset( $new_instance['show_rating'] ) ? (bool) $new_instance['show_rating'] : 0;
			$instance['show_likes'] = isset( $new_instance['show_likes'] ) ? (bool) $new_instance['show_likes'] : 0;
			$instance['show_comment_text'] = isset( $new_instance['show_comment_text'] ) ? (bool) $new_instance['show_comment_text'] : 0;
			$instance['show_view_link'] = isset( $new_instance['show_view_link'] ) ? (bool) $new_instance['show_view_link'] : 0;
			$instance['show_post_title'] = isset( $new_instance['show_post_title'] ) ? (bool) $new_instance['show_post_title'] : 0;
			$instance['show_avg_rating'] = isset( $new_instance['show_avg_rating'] ) ? (bool) $new_instance['show_avg_rating'] : 0;
			return $instance;
		}

		function form( $instance ) {
		
			// Defaults
			$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
			$order = isset( $instance['order'] ) ? esc_attr( $instance['order'] ) : 'date';
			$number = isset( $instance['number'] ) ? intval( $instance['number'] ) : 5;
			$ids = isset( $instance['ids'] ) ? esc_attr( $instance['ids'] ) : '';
			$comment_text_length = isset( $instance['comment_text_length'] ) ? esc_attr( $instance['comment_text_length'] ) : '';
			$review_title_length = isset( $instance['review_title_length'] ) ? esc_attr( $instance['review_title_length'] ) : '';
			$show_avatar = isset( $instance['show_avatar'] ) ? (bool) $instance['show_avatar'] : 1;
			$show_name = isset( $instance['show_name'] ) ? (bool) $instance['show_name'] : 1;
			$show_review_date = isset( $instance['show_review_date'] ) ? (bool) $instance['show_review_date'] : 1;
			$show_review_title = isset( $instance['show_review_title'] ) ? (bool) $instance['show_review_title'] : 1;
			$show_rating = isset( $instance['show_rating'] ) ? (bool) $instance['show_rating'] : 1;
			$show_likes = isset( $instance['show_likes'] ) ? (bool) $instance['show_likes'] : 1;
			$show_comment_text = isset( $instance['show_comment_text'] ) ? (bool) $instance['show_comment_text'] : 1;
			$show_view_link = isset( $instance['show_view_link'] ) ? (bool) $instance['show_view_link'] : 1;
			$show_post_title = isset( $instance['show_post_title'] ) ? (bool) $instance['show_post_title'] : 1;
			$show_avg_rating = isset( $instance['show_avg_rating'] ) ? (bool) $instance['show_avg_rating'] : 0;
			
			?>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'gpur' ); ?></label><br/>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>" />
			</p>
						
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"><?php esc_html_e( 'Order:', 'gpur' ); ?></label><br/>
				<select id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>" name="order">
					<option value="date" <?php if ( 'date' === $order ) { echo 'selected="selected"'; } ?>><?php esc_html_e( 'Most Recent', 'gpur' ); ?></option>			
					<option value="top-rated" <?php if ( 'top-rated' === $order ) { echo 'selected="selected"'; } ?>><?php esc_html_e( 'Top Rated', 'gpur' ); ?></option> 			
					<option value="lowest-rated" <?php if ( 'lowest-rated' === $order ) { echo 'selected="selected"'; } ?>><?php esc_html_e( 'Lowest Rated', 'gpur' ); ?></option>
					<option value="most-helpful" <?php if ( 'most-helpful' === $order ) { echo 'selected="selected"'; } ?>><?php esc_html_e( 'Most Helpful', 'gpur' ); ?></option>
				</select>
			</p>	
					
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number:', 'gpur' ); ?></label><br/>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" value="<?php echo absint( $number ); ?>" />
			</p>	
					
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'ids' ) ); ?>"><?php esc_html_e( 'Post IDs:', 'gpur' ); ?></label><br/>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ids' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ids' ) ); ?>" value="<?php echo esc_attr( $ids ); ?>" />
			</p>
				
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'review_title_length' ) ); ?>"><?php esc_html_e( 'Review Title Length:', 'gpur' ); ?></label><br/>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'review_title_length' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'review_title_length' ) ); ?>" value="<?php echo esc_attr( $review_title_length ); ?>" />
				<small><?php esc_html_e( 'The number of characters in the review title. Leave empty to display all characters.', 'gpur' ); ?></small>
			</p>
					
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'comment_text_length' ) ); ?>"><?php esc_html_e( 'Comment Text Length:', 'gpur' ); ?></label><br/>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'comment_text_length' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'comment_text_length' ) ); ?>" value="<?php echo esc_attr( $comment_text_length ); ?>" />
				<small><?php esc_html_e( 'The number of characters in the comment text. Leave empty to display all characters.', 'gpur' ); ?></small>
			</p>
			
			<?php esc_html_e( 'Show:', 'gpur' ); ?>
			
			<ul>
				
				<li>
					<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_avatar' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_avatar' ) ); ?>" value="1" <?php checked( $show_avatar, true ); ?> /> <label for="<?php echo esc_attr( $this->get_field_id( 'show_avatar' ) ); ?>"><?php esc_html_e( 'Avatar', 'gpur' ); ?></label>
				</li>
			
				<li>
					<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_name' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_name' ) ); ?>" value="1" <?php checked( $show_name, true ); ?> /> <label for="<?php echo esc_attr( $this->get_field_id( 'show_name' ) ); ?>"><?php esc_html_e( 'Name', 'gpur' ); ?></label>
				</li>
			
				<li>
					<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_review_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_review_date' ) ); ?>" value="1" <?php checked( $show_review_date, true ); ?> /> <label for="<?php echo esc_attr( $this->get_field_id( 'show_review_date' ) ); ?>"><?php esc_html_e( 'Review Date', 'gpur' ); ?></label>
				</li>
			
				<li>
					<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_rating' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_rating' ) ); ?>" value="1" <?php checked( $show_rating, true ); ?> /> <label for="<?php echo esc_attr( $this->get_field_id( 'show_rating' ) ); ?>"><?php esc_html_e( 'Rating', 'gpur' ); ?></label>
				</li>
			
				<li>
					<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_review_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_review_title' ) ); ?>" value="1" <?php checked( $show_review_title, true ); ?> /> <label for="<?php echo esc_attr( $this->get_field_id( 'show_review_title' ) ); ?>"><?php esc_html_e( 'Review Title', 'gpur' ); ?></label>
				</li>
			
				<li>
					<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_likes' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_likes' ) ); ?>" value="1" <?php checked( $show_likes, true ); ?> /> <label for="<?php echo esc_attr( $this->get_field_id( 'show_likes' ) ); ?>"><?php esc_html_e( 'Likes', 'gpur' ); ?></label>
				</li>
			
				<li>
					<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_comment_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_comment_text' ) ); ?>" value="1" <?php checked( $show_comment_text, true ); ?> /> <label for="<?php echo esc_attr( $this->get_field_id( 'show_comment_text' ) ); ?>"><?php esc_html_e( 'Comment Text', 'gpur' ); ?></label>
				</li>
			
				<li>
					<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_view_link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_view_link' ) ); ?>" value="1" <?php checked( $show_view_link, true ); ?> /> <label for="<?php echo esc_attr( $this->get_field_id( 'show_view_link' ) ); ?>"><?php esc_html_e( 'View Link', 'gpur' ); ?></label>
				</li>
		
				<li>
					<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_post_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_post_title' ) ); ?>" value="1" <?php checked( $show_post_title, true ); ?> /> <label for="<?php echo esc_attr( $this->get_field_id( 'show_post_title' ) ); ?>"><?php esc_html_e( 'Post Title', 'gpur' ); ?></label>
				</li>
			
			</ul>

			<p>
				<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_avg_rating' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_avg_rating' ) ); ?>" value="1" <?php checked( $show_avg_rating, true ); ?> /> <label for="<?php echo esc_attr( $this->get_field_id( 'show_avg_rating' ) ); ?>"><?php esc_html_e( 'Show Average Rating', 'gpur' ); ?></label><br/>
				<small><?php esc_html_e( 'Show an average of the user\'s rating if it has multi criteria ratings.', 'gpur' ); ?></small>
			</p>
												
			<?php

		}
	}

}