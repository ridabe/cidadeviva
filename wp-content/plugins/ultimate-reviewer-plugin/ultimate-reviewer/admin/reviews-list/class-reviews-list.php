<?php 

if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

if ( ! class_exists( 'GPUR_Reviews_List_Page' ) ) {
	class GPUR_Reviews_List_Page {	
	
		protected static $instance = null;
		
		public function __construct() {		
		
			if ( isset( $_GET['page'] ) && 'gpur-reviews-list' === $_GET['page'] ) {
				add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts') );
			}
			
			add_action( 'admin_menu', array( $this, 'add_menu_page' ) );
			add_action( 'wp_ajax_gpur_delete_site_rating', array( $this, 'gpur_delete_site_rating') );			
			add_action( 'wp_ajax_nopriv_gpur_delete_site_rating', array( $this, 'gpur_delete_site_rating' ) );
			add_action( 'wp_ajax_gpur_reset_user_ratings', array( $this, 'gpur_reset_user_ratings' ) );			
			add_action( 'wp_ajax_nopriv_gpur_reset_user_ratings', array( $this, 'gpur_reset_user_ratings' ) );
			
		}
	
		// Sub menu
		public function add_menu_page() {

			add_submenu_page( 
				'gpur-templates-page',
				esc_html__( 'Reviews List', 'gpur' ),
				esc_html__( 'Reviews List', 'gpur' ), 
				'manage_options', 
				'gpur-reviews-list',
				array( $this, 'reviews_list_page' )
			);	
		
		} 

		public function enqueue_scripts() {
			
			wp_enqueue_style( 'gpur-review-list', plugin_dir_url( __FILE__ ) . 'assets/reviews-list.css', array(), GPUR_VERSION );
		
			wp_enqueue_script( 'gpur-reviews-list', plugin_dir_url( __FILE__ ) . 'assets/reviews-list.js', array( 'jquery' ), GPUR_VERSION, false );
			
			$action_name = 'gpur_reset_user_ratings';
			wp_localize_script( 'gpur-reviews-list', 'gpur_reset_user_ratings', array(
				'ajax_nonce' => wp_create_nonce( $action_name ), 
				'ajax_url' => admin_url( 'admin-ajax.php' ), 
				'action' => $action_name,
			) );
	
			$action_name = 'gpur_delete_site_rating';
			wp_localize_script( 'gpur-reviews-list', 'gpur_delete_site_rating', 
				array(
					'ajax_nonce' => wp_create_nonce( $action_name ), 
					'ajax_url' => admin_url( 'admin-ajax.php' ), 
					'action' => $action_name, 
				)
			);
			
		}

		public static function gpur_delete_site_rating() {
		
			global $wpdb;
			
			$post_id = absint( $_POST['postID'] );
			
			// Get correct meta keys
			$site_rating_meta_key = gpur_get_site_rating( $post_id );
		
			delete_post_meta( $post_id, $site_rating_meta_key );
			
			$wpdb->query( 
				$wpdb->prepare( "DELETE FROM $wpdb->postmeta WHERE post_id = %d AND meta_key LIKE %s", $post_id, 'gpur_criterion_%' )
			);
			
		}
	
		public static function gpur_reset_user_ratings() {
		
			$post_id = absint( $_POST['postID'] );
			
			// Get correct meta keys
			$avg_user_rating_meta_key = gpur_get_avg_user_rating( $post_id );
			$user_votes_meta_key = gpur_get_user_votes( $post_id );
			$user_sum_meta_key = gpur_get_user_sum( $post_id );
			$ind_user_rating_meta_key = gpur_get_ind_user_rating( $post_id );
			
			// Remove average user rating for this post
			delete_post_meta( $post_id, $avg_user_rating_meta_key );
			delete_post_meta( $post_id, $user_sum_meta_key );
			delete_post_meta( $post_id, $user_votes_meta_key );
			delete_post_meta( $post_id, 'gpur_multi_avg_user_rating' );
			delete_post_meta( $post_id, 'gpur_multi_user_sum' );
			
			// Remove user meta rating data for this post
			delete_metadata( 'user', 0, $ind_user_rating_meta_key, '', true );
			
			// Remove comment ratings and up/down votes for this post
			$comments = get_comments( 'post_id=' . $post_id );
  			if ( $comments ) {
  				foreach( $comments as $comment ) {
  					delete_comment_meta( $comment->comment_ID, 'gpur_avg_rating' );
  					delete_comment_meta( $comment->comment_ID, 'gpur_rating' );
					delete_comment_meta( $comment->comment_ID, 'gpur_up_votes' );					
					delete_comment_meta( $comment->comment_ID, 'gpur_down_votes' );
  				}
  			}
		}
	
		public function reviews_list_page() { ?>

			<div class="wrap">
		
				<h2><?php esc_html_e( 'Reviews List', 'gpur' ); ?></h2>
		
				<?php
				$reviews = $this->get_reviews();
				$reviews_table = new GPUR_Reviews_List_Table( $reviews );
				$reviews_table->prepare_items();
				$reviews_table->display();
				?>

			</div>
	
		<?php }

		public static function get_instance() 
		{
			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
		}

		public function get_reviews() {
				
			$result = array();

			$args = array(
				'post_status' 	      => 'publish',
				'post_type'           => 'any',
				'orderby'             => 'date',
				'order'               => 'desc',
				'meta_query' 		  => array(
					'relation' => 'OR',
					array(
						'key' => 'gpur_site_rating',
						'compare' => 'EXISTS',
					),
					array(
						'key' => 'gpur_avg_user_rating',
						'compare' => 'EXISTS',
					),
				),
				'posts_per_page'  => -1,
			);
			$query = new WP_Query( $args );
			
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					$review['gpur_id'] = get_the_ID();
					$review['gpur_title'] = get_the_title();
					
					// Get correct meta keys
					$site_rating_meta_key = gpur_get_site_rating( get_the_ID() );
					$avg_user_rating_meta_key = gpur_get_avg_user_rating( get_the_ID() );
					$user_votes_meta_key = gpur_get_user_votes( get_the_ID() );
					$user_sum_meta_key = gpur_get_user_sum( get_the_ID() );
					
					if ( get_post_meta( get_the_ID(), $site_rating_meta_key, true ) OR ( null !== get_post_meta( get_the_ID(), $site_rating_meta_key, true ) && 0 === get_post_meta( get_the_ID(), $site_rating_meta_key, true ) ) ) { 
						$review['gpur_site_rating'] = get_post_meta( get_the_ID(), $site_rating_meta_key, true );
					} else {
						$review['gpur_site_rating'] = '-';
					}
						
					if ( get_post_meta( get_the_ID(), $avg_user_rating_meta_key, true ) OR ( null !== get_post_meta( get_the_ID(), $avg_user_rating_meta_key, true ) && 0 === get_post_meta( get_the_ID(), $avg_user_rating_meta_key, true ) ) ) {
						$review['gpur_user_rating'] = get_post_meta( get_the_ID(), $avg_user_rating_meta_key, true );
					} else {
						$review['gpur_user_rating'] = '-';
					}
					
					$review['gpur_user_votes'] = get_post_meta( get_the_ID(), $user_votes_meta_key, true ) ? get_post_meta( get_the_ID(), $user_votes_meta_key, true ) : '-';
					$review['gpur_date'] = get_the_date();
					$result[] = $review;
				}				
				wp_reset_postdata();
			}
			
			return $result;

		}		
		
	}
}
new GPUR_Reviews_List_Page();
  
if ( ! class_exists( 'GPUR_Reviews_List_Table' ) ) {
	class GPUR_Reviews_List_Table extends WP_List_Table {

		public $reviews;
	
		// Construct
		function __construct( $reviews ) {
				
			// Set parent defaults
			parent::__construct( array(
				'singular'  => 'review',     //singular name of the listed records
				'plural'    => 'reviews',    //plural name of the listed records
				'ajax'      => false        //does this table support ajax?
			) );
		
			$this->reviews = $reviews;
		
		}

		// Default method called when a specific column rendering method is not set
		public function column_default( $item, $column_name ) {
			switch( $column_name ) {
				case 'gpur_date':
				case 'gpur_title':
				case 'gpur_site_rating':
				case 'gpur_user_rating':
				case 'gpur_user_votes':
					return $item[ $column_name ];
				case 'gpur_actions':
				default:
					return '';
			}
		}
		
		// Get table columns
		function get_columns() {
			$columns = array(      
				'cb'        => '<input type="checkbox" />',  
				'gpur_title'       => esc_html__( 'Item', 'gpur' ),
				'gpur_site_rating' => esc_html__( 'Site Rating(s)', 'gpur' ),
				'gpur_user_rating' => esc_html__( 'Avg User Rating', 'gpur' ),
				'gpur_user_votes' => esc_html__( 'User Votes', 'gpur' ),
				'gpur_date' => esc_html__( 'Date', 'gpur' ),
				'gpur_actions'	  => esc_html__( 'Actions', 'gpur' ),
			);
			return $columns;
		} 
    		
		function get_sortable_columns() {
			$sortable_columns = array(				
				'gpur_title' => array( 'gpur_title', false ),
				'gpur_site_rating' => array( 'gpur_site_rating', false ),
				'gpur_user_rating' => array( 'gpur_user_rating', false ),
				'gpur_user_votes' => array( 'gpur_user_votes', false ),
				'gpur_date' => array( 'gpur_date', false )
			);        
			return $sortable_columns;
		} 

		function get_bulk_actions() {
			$actions = array(
				'delete'    => 'Delete'
			);
			return $actions;
		}
		
 		// Checkbox column
		function column_cb( $item ) {
			return sprintf( '<input type="checkbox" name="review[]" value="%s" />', $item['gpur_id'] );    
		}
		  
		// Title column
		function column_gpur_title( $item ) {
			$title = '<a href="'. esc_url( get_edit_post_link( $item['gpur_id'] ) ) .'">'. esc_html( $item['gpur_title'] ) . '</a>';
			$actions = array(
				'edit'      => '<a href="' . esc_url( get_edit_post_link( $item['gpur_id'] ) ) . '">Edit</a>',
				'view'      => '<a href="' . esc_url( get_permalink( $item['gpur_id'] ) ) . '">View</a>',
			);
			return sprintf( '%1$s %2$s', $title, $this->row_actions( $actions ) );
		}

		// Site rating column
		function column_gpur_site_rating( $item ) {
			$data = gpur_get_review_template_data( $item['gpur_id'] );
			if ( $item['gpur_site_rating'] != '-' ) {
				return $item['gpur_site_rating'] .' / ' . $data['site_rating_max_rating'];
			} else {
				return $item['gpur_site_rating'];
			}	
		}

		// User rating column
		function column_gpur_user_rating( $item ) {
			
			if ( 'enabled' === gpur_option( 'comment_form_review_support' ) ) {
				$max_rating = gpur_option( 'comment_form_max_rating' );
				$decimal_places = gpur_option( 'comment_form_decimal_places' );
			} else {
				$data = gpur_get_review_template_data( $item['gpur_id'] );
				$max_rating = $data['user_max_rating'];
			}
			
			if ( $item['gpur_user_rating'] != '-' ) {
				return round( $item['gpur_user_rating'], $decimal_places ) . ' / ' . $max_rating;
			} else {
				return round( $item['gpur_user_rating'], $decimal_places );
			}	
		}
		     
		// Actions column
		function column_gpur_actions( $item ) {
			
			$html = '';
       		
       		if ( $item['gpur_site_rating'] != '-' ) {
				$html .= '<a class="gpur-action-button gpur-delete-site-rating-button" href="#" data-post-id="' . absint( $item['gpur_id'] ) . '" data-confirm-msg="'. esc_attr__( 'Are you sure you want to delete this item\'s site rating(s).', 'gpur' ) .'" data-res-msg="'. esc_attr__( 'Review deleted', 'gpur' ) .'">'. esc_html__( 'Delete Site Rating', 'gpur' ) .'</a>';
			}
		
			if ( $item['gpur_user_rating'] != '-' ) {
				$html .= '<a class="gpur-action-button gpur-reset-user-ratings-button" href="#" data-post-id="' .  absint( $item['gpur_id'] ) . '" data-confirm-msg="' . esc_attr__( 'Are you sure you want to delete this item\'s user ratings? This will delete the average user rating, all individual user ratings, comment ratings and up/down votes for this item.', 'gpur' ) .'" data-completed-msg="'. esc_attr__( 'User ratings reset.', 'gpur' ) .'">'. esc_html__( 'Reset User Ratings', 'gpur' ) . '</a>';
       		}
						
			$html .= '<img class="gpur-loader" src="'. admin_url( 'images/spinner.gif' ) . '" alt="'. esc_attr__( 'Loading', 'gpur' ). '" />';
			
			return $html;
		}

		// Prepare the items for the table
		function prepare_items() {
	
			// Records per table page
			$per_page = apply_filters( 'gpur_review_list_per_page', 20 );
		
			// Define column headers
			$columns = $this->get_columns();
			$hidden = array();
			$sortable = $this->get_sortable_columns();
		
			// Build column headers
			$this->_column_headers = array( $columns, $hidden, $sortable );

			$data = ( empty( $this->reviews ) ) ? array() : $this->reviews;
	
			// Sort Data
			function _usort_reorder($a,$b){
				$orderby = ( ! empty( $_REQUEST['orderby'] ) ) ? $_REQUEST['orderby'] : 'date'; // If no sort, default to date
				$order = ( !empty( $_REQUEST['order'] ) ) ? $_REQUEST['order'] : 'desc'; // If no order, default to desc
				$result = ( isset( $a[$orderby] ) && isset( $b[$orderby] ) ) ? strcmp( $a[$orderby], $b[$orderby] ) : -1; // Determine sort order
				return ( 'asc' === $order ) ? $result : -$result; // Send final sort direction to usort
			}
			
			usort( $data, '_usort_reorder' );
		
			// Pagination. Let's figure out what page the user is currently looking at. 
			$current_page = $this->get_pagenum();
		
			// Pagination. Let's check how many items are in our data array. 
			$total_items = count( $data );
		
			// Data Paginations
			$data = array_slice( $data, ( ( $current_page-1 ) * $per_page ), $per_page );
		
			// Add Data to the core class
			$this->items = $data;
		
			// Register pagination options
			$this->set_pagination_args( array(
				'total_items' => $total_items,
				'per_page'    => $per_page,
				'total_pages' => ceil( $total_items / $per_page ),
			) );
		
		}  

	}
}