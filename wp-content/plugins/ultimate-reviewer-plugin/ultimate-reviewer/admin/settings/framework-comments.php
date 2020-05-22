<?php if ( ! class_exists( 'GPUR_Comments_Backend' ) ) {
	class GPUR_Comments_Backend {

		public function __construct() {
		
			global $pagenow;
			
			if ( 'edit-comments.php' === $pagenow ) {
				add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			}
			
			add_action( 'add_meta_boxes_comment', array( $this, 'register_metabox' ) );
			add_action( 'comment_post', array( $this, 'save_settings' ), 10, 2 );
			add_filter( 'preprocess_comment', array( $this, 'verify_settings' ) );
			add_action( 'edit_comment', array( $this, 'edit_settings' ) );	
			add_action( 'delete_comment', array( $this, 'delete_settings' ), 10, 2 );	
			add_filter( 'manage_edit-comments_columns', array( $this, 'columns' ) );		
			add_filter( 'manage_comments_custom_column', array( $this, 'rating_column' ), 10, 2 );
			add_action( 'comment_unapproved_to_approved', array( $this, 'unapproval_to_approval' ) );
			
		}

		public function enqueue_scripts() {

			wp_enqueue_style( 'gpur-comments', plugin_dir_url( __FILE__ ) . 'assets/framework-comments.css', array(), GPUR_VERSION );	

		}

		public function register_metabox() {
			add_meta_box( 'title', esc_html__( 'Review Details', 'gpur' ), array( $this, 'register_settings' ), 'comment', 'normal', 'high' );
		}
	
		public function register_settings( $comment ) {
		
			wp_nonce_field( 'gpur_update_comment', 'gpur_update_comment', false ); ?>
		
			<table id="gpur-review-details" class="form-table editcomment">
				<tbody>
		
					<?php if ( 'enabled' === gpur_option( 'comment_form_review_title' ) ) { ?>
						<tr>
							<td class="first">
								<label for="title"><?php echo gpur_option( 'comment_form_review_title_field_label' ); ?></label>
							</td>
							<td>	
								<input type="text" name="gpur_title" value="<?php echo esc_attr( get_comment_meta( $comment->comment_ID, 'gpur_title', true ) ); ?>" maxlength="<?php if ( gpur_option( 'comment_form_title_length' ) != '' ) { echo gpur_option( 'comment_form_title_length' ); } ?>" />
							</td>
						</tr>	
					<?php } ?>
		
					<tr>		
						<td class="first">
							<label for="rating"><?php esc_html_e( 'Individual Ratings', 'gpur' ); ?></label>
						</td>
						<td>	
							<input type="text" name="gpur_rating" value="<?php echo esc_attr( get_comment_meta( $comment->comment_ID, 'gpur_rating', true ) ); ?>" />
						</td>
					</tr>
					<tr>		
						<td class="first">
							<label for="rating"><?php esc_html_e( 'Overall Rating', 'gpur' ); ?></label>
						</td>
						<td>	
							<input type="text" name="gpur_avg_rating" value="<?php echo esc_attr( get_comment_meta( $comment->comment_ID, 'gpur_avg_rating', true ) ); ?>" />
						</td>
					</tr>					
					<tr>
						<td class="first">
							<label for="rating"><?php esc_html_e( 'Up Votes', 'gpur' ); ?></label>
						</td>
						<td>
							<input type="text" name="gpur_up_votes" value="<?php echo esc_attr( get_comment_meta( $comment->comment_ID, 'gpur_up_votes', true ) ); ?>" />
						</td>
					</tr>
					<tr>
						<td class="first">
							<label for="rating"><?php esc_html_e( 'Down Votes', 'gpur' ); ?></label>
						</td>
						<td>
							<input type="text" name="gpur_down_votes" value="<?php echo esc_attr( get_comment_meta( $comment->comment_ID, 'gpur_down_votes', true ) ); ?>" />
						</td>
					</tr>

				</tbody>		
			</table>
						
			<?php
		}

		public function save_settings( $comment_id, $comment_approved ) {
	
			$has_error = 'no';

			// Save review title
			if ( 'enabled' === gpur_option( 'comment_form_review_title' ) && ( isset( $_POST['gpur_title'] ) && '' !== $_POST['gpur_title'] ) ) {
				$title = sanitize_text_field( $_POST['gpur_title'] );
				add_comment_meta( $comment_id, 'gpur_title', $title );	
			}
	
			// Save single/multi ratings
			if ( isset( $_POST['gpur_rating'] ) ) {
		
				$rating_values = $_POST['gpur_rating'];
			
				foreach( $rating_values as $rating_value ) {

					// Set rating to zero if submitted and left empty
					if ( '' === $rating_value && 0 === gpur_option( 'comment_form_min_rating' ) ) {		
						$rating_value = 0;		
					}
		
					// Prevent rating lower than minimum
					if ( $rating_value < gpur_option( 'comment_form_min_rating' ) ) {
						$has_error = 'yes';
					}

					// Prevent rating higher than maximum
					if ( $rating_value > gpur_option( 'comment_form_max_rating' ) ) {
						$has_error = 'yes';
					}
	
					// Final check to make sure a valid rating is being submitted
					if ( ! is_numeric( $rating_value ) ) {
						$has_error = 'yes';
					}			
			
				}
				
				// If rating data is valid continue
				if ( 'no' === $has_error ) {		
					if ( is_array( $rating_values ) ) {
						$count = (int) count( $rating_values );
						$avg_rating_value = ( array_sum( $rating_values ) / $count );	
						$avg_rating_value = round( ( $avg_rating_value / gpur_option( 'comment_form_step' ) ), 3 ) * gpur_option( 'comment_form_step' );
						$rating_value = implode( ',', $rating_values );
					} else {
						$avg_rating_value = esc_attr( $rating_value );
					}
					add_comment_meta( $comment_id, 'gpur_rating', $rating_value );
					add_comment_meta( $comment_id, 'gpur_avg_rating', $avg_rating_value );			
				}
				
				// If comment is approved add rating data
				if ( 1 === $comment_approved ) {
				
					$comment = get_comment( $comment_id );
					$post_id = gpur_get_hub_id( $comment->comment_post_ID );

					// Get correct meta keys
					$avg_user_rating_meta_key = gpur_get_avg_user_rating( $post_id );
					$user_votes_meta_key = gpur_get_user_votes( $post_id );
					$user_sum_meta_key = gpur_get_user_sum( $post_id );
					$ind_user_rating_meta_key = gpur_get_ind_user_rating( $post_id );

					$rating_value = get_comment_meta( $comment_id, 'gpur_avg_rating', true ); // average of the values
					$multi_rating_values = get_comment_meta( $comment_id, 'gpur_rating', true ); // list of each value

					// Check if values already exist
					$avg_user_rating = get_post_meta( $post_id, $avg_user_rating_meta_key, true );
					if ( ! $avg_user_rating ) {
						$avg_user_rating = 0;
					}
					$user_votes = (int) get_post_meta( $post_id, $user_votes_meta_key, true );
					if ( ! $user_votes ) {
						$user_votes = 0;
					}
					$user_sum = get_post_meta( $post_id, $user_sum_meta_key, true );
					if ( ! $user_sum ) {
						$user_sum = 0;
					}   
					
					// Update values
					$updated_user_sum = floatval( $user_sum + $rating_value );
					$updated_user_votes = absint( $user_votes + 1 );
					$updated_avg_user_rating = floatval( number_format( ( $updated_user_sum ) / ( $updated_user_votes ), 1 ) + 0 );

					// Add updated post/user meta values to database
					update_post_meta( $post_id, $user_sum_meta_key, $updated_user_sum, $user_sum );
					update_post_meta( $post_id, $avg_user_rating_meta_key, $updated_avg_user_rating, $avg_user_rating );
					update_post_meta( $post_id, $user_votes_meta_key, $updated_user_votes, $user_votes );
					if ( is_user_logged_in() ) {
						$rating_value = floatval( $rating_value );
						if ( $multi_rating_values ) {
							update_user_meta( $comment->user_id, $ind_user_rating_meta_key, array( $multi_rating_values ) );
						} else {
							update_user_meta( $comment->user_id, $ind_user_rating_meta_key, $rating_value );
						}
					}
									
				}
										
			}
		
		}

		public function verify_settings( $commentdata ) {

			if ( 'disallowed' === gpur_permissions( gpur_option( 'comment_form_permissions' ), gpur_option( 'comment_form_permission_roles' ) ) ) {
			
				wp_die( esc_html__( 'Error: You do not have permission to comment.', 'gpur' ), 'Error', array( 'response' => 500, 'back_link' => true ) );
			
			// If comment support is enabled
			} elseif ( 'enabled' === gpur_option( 'comment_form_review_support' ) ) {

				$ind_user_rating_meta_key = gpur_get_ind_user_rating( $commentdata['comment_post_ID'] );
			
				// If comment has rating set comment type as review
				if ( isset( $_POST['gpur_rating'] ) ) {
					$commentdata['comment_type'] = 'review';
				}

				// Check review title field on normal comment review replies if required
				if ( ( 'enabled' === gpur_option( 'comment_form_review_title' ) && isset( $_POST['gpur_title'] ) && '' === $_POST['gpur_title'] ) && ( 'review ' !== $commentdata['comment_type'] && '0' !== $commentdata['comment_parent'] && 'review_replies' === gpur_option( 'comment_list_normal_comment_replies' ) ) ) {
				
					wp_die( esc_html__( 'Error: You must give a review title.', 'gpur' ), 'Error', array( 'response' => 500, 'back_link' => true ) );

				// Check review title field on review comment review replies if required
				} elseif ( ( 'enabled' === gpur_option( 'comment_form_review_title' ) && isset( $_POST['gpur_title'] ) && '' === $_POST['gpur_title'] ) && ( 'review ' === $commentdata['comment_type'] && '0' !== $commentdata['comment_parent'] && 'review_replies' === gpur_option( 'comment_list_review_comment_replies' ) ) ) {
				
					wp_die( esc_html__( 'Error: You must give a review title.', 'gpur' ), 'Error', array( 'response' => 500, 'back_link' => true ) );
					
				// Check review title field on top level comments
				} elseif ( 'enabled' === gpur_option( 'comment_form_review_title' ) && isset( $_POST['gpur_title'] ) && '' === $_POST['gpur_title'] ) {
			
					wp_die( esc_html__( 'Error: You must give a review title.', 'gpur' ), 'Error', array( 'response' => 500, 'back_link' => true ) );

				// Check rating field on normal comment review replies if required
				} elseif ( ( isset( $_POST['gpur_rating'] ) && 0 === $_POST['gpur_rating'] && gpur_option( 'comment_form_min_rating' ) > 0 ) && ( 'review ' !== $commentdata['comment_type'] && '0' !== $commentdata['comment_parent'] && 'review_replies' === gpur_option( 'comment_list_normal_comment_replies' ) ) ) {
				
					wp_die( esc_html__( 'Error: You must give a rating.', 'gpur' ), 'Error', array( 'response' => 500, 'back_link' => true ) );

				// Check rating field on review comment review replies if required
				} elseif ( ( isset( $_POST['gpur_rating'] ) && 0 === $_POST['gpur_rating'] && gpur_option( 'comment_form_min_rating' ) > 0 ) && ( 'review ' === $commentdata['comment_type'] && '0' !== $commentdata['comment_parent'] && 'review_replies' === gpur_option( 'comment_list_review_comment_replies' ) ) ) {
				
					wp_die( esc_html__( 'Error: You must give a rating.', 'gpur' ), 'Error', array( 'response' => 500, 'back_link' => true ) );
										
				// Check rating field on top level comments							
				} elseif ( isset( $_POST['gpur_rating'] ) && 0 === $_POST['gpur_rating'] && gpur_option( 'comment_form_min_rating' ) > 0 ) {
				
					wp_die( esc_html__( 'Error: You must give a rating.', 'gpur' ), 'Error', array( 'response' => 500, 'back_link' => true ) );

				// Check name field is not empty			
				} elseif ( isset( $_POST['author'] ) && '' === $_POST['author'] ) {
				
					wp_die( esc_html__( 'Error: You must enter a name.', 'gpur' ), 'Error', array( 'response' => 500, 'back_link' => true ) );

				// Check email field is not empty			
				} elseif ( isset( $_POST['email'] ) && '' === $_POST['email'] ) {
				
					wp_die( esc_html__( 'Error: You must enter an email.', 'gpur' ), 'Error', array( 'response' => 500, 'back_link' => true ) );
																			
				} elseif ( 'one-rating-one-comment' === gpur_option( 'comment_form_comment_rating_limit' ) && isset( $_POST['gpur_rating'] ) && ( ( isset( $_COOKIE['gpur_user_rating_' . $commentdata['comment_post_ID']] ) && ! is_user_logged_in() ) OR get_user_meta( get_current_user_id(), $ind_user_rating_meta_key, true ) ) ) {
					
					wp_die( esc_html__( 'Error: You cannot post another comment.', 'gpur' ), 'Error', array( 'response' => 500, 'back_link' => true ) );
					
				}
				
			}
					
			return $commentdata;
			
		}

		public function edit_settings( $comment_id ) {
	
			$has_error = 'no';

			if ( ! isset( $_POST['gpur_update_comment'] ) OR ! wp_verify_nonce( $_POST['gpur_update_comment'], 'gpur_update_comment' ) ) {
				return;
			}
	
			// Title
			if ( isset( $_POST['gpur_title'] ) && '' !== $_POST['gpur_title'] ) {
				$title = sanitize_text_field( $_POST['gpur_title'] );
				update_comment_meta( $comment_id, 'gpur_title', $title );
			} else {
				delete_comment_meta( $comment_id, 'gpur_title' );
			}

			// Rating
			if ( isset( $_POST['gpur_rating'] ) && '' !== $_POST['gpur_rating'] ) {
				$rating = floatval( $_POST['gpur_rating'] );
				$rating_values = explode( ',', $rating );
				if ( is_array( $rating_values ) ) {
					$count = (int) count( $rating_values );
					$avg_rating_value = ( array_sum( $rating_values ) / $count );	
					$avg_rating_value = round( $avg_rating_value / gpur_option( 'comment_form_step' ), 3 ) * gpur_option( 'comment_form_step' );
					$rating_value = implode( ',', $rating_values );
				} else {
					$avg_rating_value = $rating_value;
				}
				update_comment_meta( $comment_id, 'gpur_rating', $rating_value );
				update_comment_meta( $comment_id, 'gpur_avg_rating', $avg_rating_value );
			} else {
				delete_comment_meta( $comment_id, 'gpur_rating' );	
				delete_comment_meta( $comment_id, 'gpur_avg_rating' );	
			}

			// Up votes
			if ( ( isset( $_POST['gpur_up_votes'] ) ) && ( $_POST['gpur_up_votes'] != '' ) ) {
				$up_votes = (int) $_POST['gpur_up_votes'];
				update_comment_meta( $comment_id, 'gpur_up_votes', $up_votes );		
			} else {
				delete_comment_meta( $comment_id, 'gpur_up_votes' );	
			}

			// Down votes
			if ( ( isset( $_POST['gpur_down_votes'] ) ) && ( $_POST['gpur_down_votes'] != '' ) ) {
				$down_votes = floatval( $_POST['gpur_down_votes'] );
				update_comment_meta( $comment_id, 'gpur_down_votes', $down_votes );		
			} else {
				delete_comment_meta( $comment_id, 'gpur_down_votes' );	
			}
					
		}

		/**
		 * When deleting comment remove rating data from site
		 *
		 */	
		public function delete_settings( $comment_id ) {
	
			$comment = get_comment( $comment_id ); 
			$post_id = $comment->comment_post_ID;
			
			// Get correct meta keys
			$avg_user_rating_meta_key = gpur_get_avg_user_rating( $post_id );
			$user_votes_meta_key = gpur_get_user_votes( $post_id );
			$user_sum_meta_key = gpur_get_user_sum( $post_id );
			$ind_user_rating_meta_key = gpur_get_ind_user_rating( $post_id );
	
			// Get comment rating value
			$rating_value = get_comment_meta( $comment_id, 'gpur_avg_rating', true );
	
			if ( $rating_value ) {

				// Update user sum
				$user_sum = get_post_meta( $post_id, $user_sum_meta_key, true );
				$updated_user_sum = floatval( $user_sum - $rating_value );
				if ( $updated_user_sum < 0 ) { $updated_user_sum = 0; }
				update_post_meta( $post_id, $user_sum_meta_key, $updated_user_sum, $user_sum );
			
				// Update user votes
				$user_votes = (int) get_post_meta( $post_id, $user_votes_meta_key, true );
				$updated_user_votes = absint( $user_votes - 1 );
				if ( $updated_user_votes < 0 ) { $updated_user_votes = 0; }
				update_post_meta( $post_id, $user_votes_meta_key, $updated_user_votes, $user_votes );			
						
				// Update user average rating
				$avg_user_rating = get_post_meta( $post_id, $avg_user_rating_meta_key, true );
				if ( $updated_user_sum >= 0 && $updated_user_votes > 0 ) {
					$updated_avg_user_rating = floatval( number_format( ( $updated_user_sum ) / ( $updated_user_votes ), 1 ) + 0 );
					if ( $updated_avg_user_rating < 0 ) { $updated_avg_user_rating = 0; }
				} else {
					$updated_avg_user_rating = 0;
				}
				update_post_meta( $post_id, $avg_user_rating_meta_key, $updated_avg_user_rating, $avg_user_rating );
			
				// Remove user meta
				delete_user_meta( $comment->user_id, $ind_user_rating_meta_key );
				
			}	
	
		}

		/**
		 * Modify comment backend columns
		 *
		 */			
		public function columns( $columns ) {
			$columns = array(
				'cb' => $columns['cb'],
				'author' => esc_html__( 'Author', 'gpur' ),
				'comment' => esc_html__( 'Comment', 'gpur' ),
				'rating' => esc_html__( 'Rating', 'gpur' ),
				'response' => esc_html__( 'In Response To', 'gpur' ),
				'date' => esc_html__( 'Submitted On', 'gpur' ),
			);	
			return $columns;
		}

		/**
		 * Add rating score to rating column
		 *
		 */			
		public function rating_column( $column, $comment_ID ) {
			if ( $column === 'rating' ) {

				// Get rating
				$rating = '';
	
				echo '<p class="comment-rating">' . gpur_show_rating_template( 
					array(
						'post_id' => $comment_ID,
						'meta' => 'comment',
						'atts' => array(
							'data' => 'custom',
							'value' => get_comment_meta( $comment_ID, 'gpur_rating', true ),
							'criteria' => gpur_option( 'comment_form_criteria' ),
							'max_rating' => gpur_option( 'comment_form_max_rating' ),
							'fractions' => gpur_option( 'comment_form_fractions' ),
							'step' => gpur_option( 'comment_form_step' ),
							'decimal_places' => gpur_option( 'comment_form_decimal_places' ),
							'show_zero_rating' => gpur_option( 'comment_rating_show_zero_rating' ),
							'style' => 'style-stars',
							'site_rating_label' => '',
							'show_site_rating_max_rating_number' => '1',
							'show_ranges_text' => '0',		
							'criteria_format' => 'format-column',
						),
					) 
				). '</p>';
		
			}

		}
		
		/**
		 * Add comment rating to total user average when comment is approved
		 *
		 */
		public function unapproval_to_approval( $comment ) {
		
			if ( is_email( $comment->comment_author_email ) && get_comment_meta( $comment->comment_ID, 'gpur_avg_rating', true ) ) {

				// Get post ID from comment
				$post_id = $comment->comment_post_ID;

				// Get correct meta keys
				$avg_user_rating_meta_key = gpur_get_avg_user_rating( $post_id );
				$user_votes_meta_key = gpur_get_user_votes( $post_id );
				$user_sum_meta_key = gpur_get_user_sum( $post_id );
				$ind_user_rating_meta_key = gpur_get_ind_user_rating( $post_id );

				// Get comment rating or average of multi comment rating
				$rating_value = get_comment_meta( $comment->comment_ID, 'gpur_avg_rating', true );
				
				// Get array of multi comment ratings
				$multi_rating_values = get_comment_meta( $comment->comment_ID, 'gpur_rating', true );

				// Check if values already exist
				$avg_user_rating = get_post_meta( $post_id, $avg_user_rating_meta_key, true );
				if ( ! $avg_user_rating ) {
					$avg_user_rating = 0;
				}
				$user_votes = (int) get_post_meta( $post_id, $user_votes_meta_key, true );
				if ( ! $user_votes ) {
					$user_votes = 0;
				}
				$user_sum = get_post_meta( $post_id, $user_sum_meta_key, true );
				if ( ! $user_sum ) {
					$user_sum = 0;
				}   
					
				// Update values
				$updated_user_sum = floatval( $user_sum + $rating_value );
				$updated_user_votes = absint( $user_votes + 1 );
				$updated_avg_user_rating = floatval( number_format( ( $updated_user_sum ) / ( $updated_user_votes ), 1 ) + 0 );

				// Add updated post/user meta values to database
				update_post_meta( $post_id, $user_sum_meta_key, $updated_user_sum, $user_sum );
				update_post_meta( $post_id, $avg_user_rating_meta_key, $updated_avg_user_rating, $avg_user_rating );
				update_post_meta( $post_id, $user_votes_meta_key, $updated_user_votes, $user_votes );
				if ( is_user_logged_in() ) {
					$rating_value = floatval( $rating_value );
					if ( $multi_rating_values ) {
						update_user_meta( $comment->user_id, $ind_user_rating_meta_key, array( $multi_rating_values ) );
					} else {
						update_user_meta( $comment->user_id, $ind_user_rating_meta_key, $rating_value );
					}
				}	

			}
			
		}
				
	}
}
new GPUR_Comments_Backend();