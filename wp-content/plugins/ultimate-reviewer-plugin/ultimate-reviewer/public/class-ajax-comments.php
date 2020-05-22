<?php if ( ! class_exists( 'GPUR_Ajax_Comments' ) ) {
	class GPUR_Ajax_Comments {

		public function __construct() {
			add_filter( 'admin_comment_types_dropdown', array( $this, 'comment_types_dropdown' ) );
			add_action( 'wp_ajax_gpur_comment_filtering', array( $this, 'comment_filtering' ) );
			add_action( 'wp_ajax_nopriv_gpur_comment_filtering', array( $this, 'comment_filtering' ) );
		}
			
		/**
		 * Add reviews to comment type dropdown menu filter
		 *
		 */
		public function comment_types_dropdown( $comment_types ) {
			$comment_types['review'] = esc_html__( 'Reviews', 'gpur' );
			return $comment_types;
		}
	
		/**
		 * Display comment count text
		 *
		 */		
		public static function gpur_display_comment_count( $comments_number ) {	

			$output = '<div class="gpur-comment-count">';
		
				if ( 1 === $comments_number ) {
			
					$output .= sprintf( _x( 'Showing %s review', 'comment count', 'gpur' ), '<span class="gpur-comment-count-number">' . $comments_number . '</span>' );
				
				} else {
			
					$output .= sprintf( _x( 'Showing %s reviews', 'comment count', 'gpur' ), '<span class="gpur-comment-count-number">' . $comments_number . '</span>' );
				
				} 
			
			$output .= '</div><div class="gpur-clear"></div>';
		
			return $output;
		
		}

		/**
		 * Dropdown comment filters
		 *
		 */
		public static function gpur_comment_rating_summary( $post_id ) {	
			
			$output = '';
			
			if ( 'enabled' === gpur_option( 'comment_list_show_title' ) ) {
				$output .= '<h3 class="comments-title">' . gpur_option( 'comment_list_title' ) . '</h3>';
			}
			
			if ( 'enabled' === gpur_option( 'comment_summary' ) ) {
				$output .= GPUR_Comments_Form::gpur_display_rating_summary( $post_id ); 
			}

			return $output;
			
		}
					
		/**
		 * Dropdown comment filters
		 *
		 */
		public static function gpur_comment_dropdown_filters( $post_id ) {	
			
			$output = '';

			if ( 'enabled' === gpur_option( 'comment_list_order_dropdown' ) OR 'enabled' === gpur_option( 'comment_list_rating_dropdown' ) ) {	
				
				$output .= '<div class="gpur-comment-filters">';

					if ( 'enabled' === gpur_option( 'comment_list_order_dropdown' ) ) {
						$output .= '<select name="gpur-comment-list-order-dropdown">
							<option value="post-date-desc">' . esc_html__( 'Most Recent', 'gpur' ) . '</option>
							<option value="user-rating-desc">' . esc_html__( 'Top Rated', 'gpur' ) . '</option>
							<option value="likes-desc">' . esc_html__( 'Most Helpful', 'gpur' ) . '</option>
							<option value="user-rating-asc">' . esc_html__( 'Lowest Rated', 'gpur' ) . '</option>
						</select>';
					}
			
					if ( 'enabled' === gpur_option( 'comment_list_rating_dropdown' ) ) {	
						$fractions = ( 1 / gpur_option( 'comment_form_fractions' ) );
						$output .= '<select name="gpur-comment-list-rating-dropdown">
							<option value="">' . esc_html__( 'All Ratings', 'gpur' ) . '</option>';
							for( $i = gpur_option( 'comment_form_max_rating' ); $i >= gpur_option( 'comment_form_min_rating' ); $i -= $fractions ) {
								$output .= '<option value="' . floatval( $i ) . '">' . floatval( $i ) . '</option>';
							}
						$output .= '</select>';
					}
			
				$output .= '</div><div class="gpur-clear"></div>';
				
			} 
			
			return $output;
			
		}
			
		/**
		 * Filter comment list
		 *
		 */
		public function comment_filtering() {	
	
			if ( isset( $_GET['action'] ) && 'gpur_comment_filtering' === $_GET['action'] ) {
	
				// Check the nonce
				check_ajax_referer( 'gpur_comment_filtering_nonce', 'nonce' );
					
				global $wp_query;
	
				// Set as singular
				$wp_query->is_singular = true;
		
				// Comment order
				if ( 'user-rating-desc' === $_GET['order'] ) {
					$meta_key = 'gpur_avg_rating';
					$order_by = 'meta_value_num';
					$order = 'desc';
				} elseif ( 'user-rating-asc' === $_GET['order'] ) {
					$meta_key = 'gpur_avg_rating';
					$order_by = 'meta_value_num';
					$order = 'asc';
				} elseif ( 'likes-desc' === $_GET['order'] ) {
					$meta_key = 'gpur_up_votes';
					$order_by = 'meta_value_num';
					$order = 'desc';
				} else {
					$meta_key = '';
					$order_by = 'date';
					$order = 'desc';
				}
			
				// Comment rating	
				if ( '' !== $_GET['rating'] ) {
					$meta_key = 'gpur_avg_rating';
					$meta_value = $_GET['rating'];
					$compare = '=';
				} else {
					$meta_value = 0;
					$compare = '>=';
				}
				
				// Pagination
				$per_page = get_option( 'comments_per_page' );
				$paged = '' === $_GET['pageNumber'] ? 1 : $_GET['pageNumber'];

				// Display numbers of reviews from the following query
				if ( 'post-date-desc' !== $meta_key ) {
					$meta_query = array(
						'key' => $meta_key,
						'value' => $meta_value,
						'compare' => $compare,
						'type' => 'NUMERIC',
					);
				} else {
					$meta_query = array();
				}		
						
				$args = array(
					'post_id' => $_GET['post_id'],
					'meta_key' => $meta_key,
					'meta_query' => $meta_query,
					'orderby' => $order_by,
					'order' => $order,
				);
				$comment_numbers_query = new WP_Comment_Query;					
				$comment_numbers = $comment_numbers_query->query( $args );
				
				// Calculate offset				
				if ( '' === $_GET['pageNumber'] && 'desc' === get_option( 'comment_order' ) ) {
					$paged = get_comment_pages_count( $comment_numbers );
				}

				$comment_count = count( $comment_numbers );

				$offset = $comment_count - ( $per_page * $paged );

				// Calculate offset for last page (to prevent comments being shown twice)
				if ( $offset < 0 ) {
				
					// Calculate remaining amount of comments (always less than 5)
					$comments_last_page = $comment_count % $per_page;

					// New offset calculated from the amount of remaining comments
					$offset = $offset + $per_page - $comments_last_page;

					// Set how many comments the last page shows
					$number = $comments_last_page; 
				
				} else {
			
					$number = $per_page; 
				}
							
				// Display ajax comments from the following query
				if ( 'post-date-desc' !== $meta_key ) {
					$meta_query = array(
						'key' => $meta_key,
						'value' => $meta_value,
						'compare' => $compare,
						'type' => 'NUMERIC',
					);
				} else {
					$meta_query = array();
				}		
					
				$args = array(
					'post_id' => $_GET['post_id'],
					'meta_key' => $meta_key,
					'meta_query' => $meta_query,
					'orderby' => $order_by,
					'order' => $order,
					'number' => $number,
					'offset' => $offset,
				);
			
				$comments_query = new WP_Comment_Query;					
				$comments = $comments_query->query( $args );

				$args = array(
					'style' => 'ol',
					'max_depth' => get_option( 'thread_comments_depth' ),
					'avatar_size' => 48,
				);
				
				$depth = isset( $GLOBALS['comment_depth'] ) ? $GLOBALS['comment_depth'] : '';
						
				// Show reviews text
				echo GPUR_Ajax_Comments::gpur_display_comment_count( $comment_count );

				// Comment Loop
				if ( $comments ) {
				
					// User defined comment template
					if ( file_exists( get_stylesheet_directory() . '/gpur/comments-list.php' ) ) {
				
						$template_url = get_stylesheet_directory() . '/gpur/';			
			
					// Use Aardvark template
					} elseif ( defined( 'AARDVARK_THEME_VERSION' ) ) {
				
						$template_url = plugin_dir_path( __FILE__ ) . '/templates/aardvark/';
			
					// Use default plugin template
					} else {
				
						$template_url = plugin_dir_path( __FILE__ ) . '/templates/default/';
			
					}
			
					foreach( $comments as $comment ) {
						include( esc_url( $template_url ) . 'comments-list.php' );
					}
					
					if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
						<div class="gpur-pagination gpur-pagination-numbers gpur-standard-pagination">
							<?php paginate_comments_links( array( 
								'base' => add_query_arg( 'cpage', '%#%' ),
								'type' => 'list', 
								'next_text' => '&raquo;', 
								'prev_text' => '&laquo;' ,
								'total' => get_comment_pages_count( $comments_query->query( $args ) ),
								'current' => $paged,
								'echo' => true,
								'add_fragment' => '#comments',
							) ); ?>
						</div>
					<?php }
					
				} else {
		
					echo '<p class="no-comments">' . esc_html__( 'No comments found.', 'gpur' ) . '</p>';
			
				}
		
				die();

			}
			
		}	
	
	}
}
new GPUR_Ajax_Comments();