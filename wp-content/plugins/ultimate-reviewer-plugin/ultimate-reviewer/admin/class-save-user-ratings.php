<?php if ( ! class_exists( 'GPUR_User_Ratings' ) ) {
	class GPUR_User_Ratings {

		public function __construct() {
			add_action( 'wp_ajax_gpur_save_rating', array( $this, 'gpur_save_rating' ) );
			add_action( 'wp_ajax_nopriv_gpur_save_rating', array( $this, 'gpur_save_rating' ) );
		}

		public function gpur_save_rating() {
	
			// Add ajax nonce to JQuery
			check_ajax_referer( 'gpur_save_rating_nonce', 'nonce' );

			// Get values from ajax
			$post_id = isset( $_POST['postID'] ) ? absint( $_POST['postID'] ) : 0;
						
			// Get correct meta keys
			$avg_user_rating_meta_key = gpur_get_avg_user_rating( $post_id );
			$user_votes_meta_key = gpur_get_user_votes( $post_id );
			$user_sum_meta_key = gpur_get_user_sum( $post_id );
			$ind_user_rating_meta_key = gpur_get_ind_user_rating( $post_id );

			$has_error = 'no';
	
			// Check if item has been rated, if so exit
			if ( ( isset( $_COOKIE['gpur_user_rating_' . $post_id] ) && ! is_user_logged_in() ) OR get_user_meta( get_current_user_id(), $ind_user_rating_meta_key, true ) ) {
				$has_error = 'yes';
			}
		
			if ( 'no' === $has_error ) {
			
				$rating_value = isset( $_POST['ratingValue'] ) ? $_POST['ratingValue'] : '';
				$multi_rating_values = isset( $_POST['multiRatingValues'] ) ? $_POST['multiRatingValues'] : 0;
				$min_rating = isset( $_POST['minRating'] ) ? sanitize_text_field( $_POST['minRating'] ) : 0;
				$max_rating = isset( $_POST['maxRating'] ) ? sanitize_text_field( $_POST['maxRating'] ) : 0;
							
				// Set rating to zero if submitted and left empty
				if ( isset( $rating_value ) && '' === $rating_value && 0 === $min_rating ) {		
					$rating_value = 0;		
				}
						
				// Prevent rating lower than minimum
				if ( $rating_value < $min_rating ) {
					$has_error = 'yes';
				}
	
				// Prevent rating higher than maximum
				if ( $rating_value > $max_rating ) {
					$has_error = 'yes';
				}
		
				// Final check to make sure a valid rating is being submitted
				if ( ! is_numeric( $rating_value ) ) {
					$has_error = 'yes';
				}
				
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

				$multi_avg_user_rating = get_post_meta( $post_id, 'gpur_multi_avg_user_rating', true );
				if ( ! $multi_avg_user_rating ) {
					$multi_avg_user_rating = 0;
				}
				$multi_user_sum = get_post_meta( $post_id, 'gpur_multi_user_sum', true );
				if ( ! $multi_user_sum ) {
					$multi_user_sum = 0;
				}    
							
				// If rating data is valid continue
				if ( 'no' === $has_error ) {				

					// Update values
					$updated_user_sum = (int) floatval( $user_sum + $rating_value );
					$updated_user_votes = absint( $user_votes + 1 );
					$updated_avg_user_rating = (int) floatval( number_format( ( $updated_user_sum ) / ( $updated_user_votes ), 1 ) );

					// Add updated post/user meta values to database
					update_post_meta( $post_id, $user_sum_meta_key, $updated_user_sum, $user_sum );
					update_post_meta( $post_id, $avg_user_rating_meta_key, $updated_avg_user_rating, $avg_user_rating );
					update_post_meta( $post_id, $user_votes_meta_key, $updated_user_votes, $user_votes );
					if ( is_user_logged_in() ) {
						$rating_value = $rating_value;
						if ( $multi_rating_values ) {
							update_user_meta( get_current_user_id(), $ind_user_rating_meta_key, array( $multi_rating_values ) );
						} else {
							update_user_meta( get_current_user_id(), $ind_user_rating_meta_key, $rating_value );
						}
					}
					
					// Multi user ratings
					if ( $multi_rating_values ) {
						
						if ( ! $updated_multi_user_sum ) {
							$updated_multi_user_sum = array();
						}
						if ( ! $updated_multi_avg_user_rating ) {
							$updated_multi_avg_user_rating = array();
						}
						$user_sum_count = 0;
						foreach( $multi_rating_values as $each_rating_value ) {
						
							// Update values
							$this_user_sum = floatval( $multi_user_sum[$user_sum_count] + $each_rating_value );
							$updated_multi_user_sum[] = $this_user_sum;
							$updated_user_votes = absint( $user_votes + 1 );
							$updated_multi_avg_user_rating[] = floatval( number_format( ( $this_user_sum ) / ( $updated_user_votes ), 1 ) );
							
							$user_sum_count++;
					
						}	
						
						// Add updated post/user meta values to database
						update_post_meta( $post_id, 'gpur_multi_user_sum', $updated_multi_user_sum, $multi_user_sum );
						update_post_meta( $post_id, 'gpur_multi_avg_user_rating', $updated_multi_avg_user_rating, $multi_avg_user_rating );
						
					}	
				
				}
		
			}
								
			wp_die();      

		}
	
	}	
}
new GPUR_User_Ratings();