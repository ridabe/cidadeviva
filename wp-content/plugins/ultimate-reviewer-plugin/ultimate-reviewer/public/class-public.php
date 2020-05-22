<?php 

/**
 * Load public-facing functions
 */
require_once plugin_dir_path( __FILE__  ) . 'functions-public.php';

/**
 * Load comment form functions
 */
require_once plugin_dir_path( __FILE__ ) . 'class-comments-form.php';

/**
 * Load ajax comment functions
 */
require_once plugin_dir_path( __FILE__ ) . 'class-ajax-comments.php';

/**
 * Load ajax comparision table functions
 */
require_once plugin_dir_path( __FILE__ ) . 'class-ajax-comparison-table.php';

/**
 * Load ajax up down voting functions
 */
require_once plugin_dir_path( __FILE__ ) . 'class-ajax-up-down-voting.php';

/**
 * Load template files
*/
require_once( plugin_dir_path( __FILE__ ) . 'templates/add-user-ratings.php' );
require_once( plugin_dir_path( __FILE__ ) . 'templates/bad-points.php' );
require_once( plugin_dir_path( __FILE__ ) . 'templates/comparison-table.php' );
require_once( plugin_dir_path( __FILE__ ) . 'templates/excerpt.php' );
require_once( plugin_dir_path( __FILE__ ) . 'templates/good-points.php' );
require_once( plugin_dir_path( __FILE__ ) . 'templates/image.php' );
require_once( plugin_dir_path( __FILE__ ) . 'templates/reviews-list.php' );
require_once( plugin_dir_path( __FILE__ ) . 'templates/review-template.php' );
require_once( plugin_dir_path( __FILE__ ) . 'templates/review-button.php' );
require_once( plugin_dir_path( __FILE__ ) . 'templates/show-rating.php' );
require_once( plugin_dir_path( __FILE__ ) . 'templates/summary.php' );
require_once( plugin_dir_path( __FILE__ ) . 'templates/title.php' );
require_once( plugin_dir_path( __FILE__ ) . 'templates/up-down-voting.php' );


if ( ! class_exists( 'GPUR_Public' ) ) {
	class GPUR_Public {

		public function __construct() {
		
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		}

		/**
		 * Register the stylesheets for the public-facing side of the site.
		 *
		 */
		public function enqueue_styles() {

			$framework = gpur_framework_data();
			
			wp_enqueue_style( 'gpur', plugin_dir_url( __FILE__ ) . 'css/public.css', array(), $framework['the_version'], 'all' );
			wp_style_add_data( 'gpur', 'rtl', 'replace' );
			
			$options = get_option( $framework['option_name'] );
			if ( 'enabled' === $options['fontawesome5'] OR defined( 'ELEMENTOR_VERSION' ) ) {

				wp_deregister_style( 'font-awesome' );
				wp_enqueue_style( 'fontawesome5', $framework['font_uri'] . 'fontawesome5/css/all.min.css', array(), $framework['the_version'] );
		
			} else {
		
				if ( file_exists( plugin_dir_url( 'js_composer' ) . 'assets/lib/bower/font-awesome/css/font-awesome.min.css' ) ) {
					$font_url = plugin_dir_url( 'js_composer' ) . 'assets/lib/bower/font-awesome/css/font-awesome.min.css';
				} else {
					$font_url = plugin_dir_url( __FILE__ ) . 'fonts/font-awesome/css/font-awesome.min.css';
				}
				wp_enqueue_style( 'font-awesome', $font_url, array(), $framework['the_version'], 'all' );
			
			}
			
		}

		/**
		 * Register the JavaScript for the public-facing side of the site.
		 *
		 */
		public function enqueue_scripts() {

			// Get correct meta keys
			$ind_user_rating_meta_key = gpur_get_ind_user_rating( get_the_ID() );
			$user_votes_meta_key = gpur_get_user_votes( get_the_ID() );
			$user_sum_meta_key = gpur_get_user_sum( get_the_ID() );

			wp_register_script( 'bootstrap-rating', plugin_dir_url( __FILE__ ) . 'scripts/bootstrap-rating.min.js', array( 'jquery' ), GPUR_VERSION, false );
				
			wp_enqueue_script( 'gpur-comment-filtering', plugin_dir_url( __FILE__ ) . 'scripts/comment-filtering.js', array( 'jquery' ), GPUR_VERSION, false );
		
			wp_localize_script( 'gpur-comment-filtering', 'gpur_comment_filtering', array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'post_id' => get_the_ID(),
				'comment_count' => get_comment_pages_count(),
				'nonce' => wp_create_nonce( 'gpur_comment_filtering_nonce' ),
			) );
		
			wp_register_script( 'gpur-up-down-voting', plugin_dir_url( __FILE__ ) . 'scripts/up-down-voting.js', array( 'jquery' ), GPUR_VERSION, false );
		
			wp_localize_script( 'gpur-up-down-voting', 'gpur_up_down_voting', array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
			) );						
		
			wp_register_script( 'gpur-add-user-ratings', plugin_dir_url( __FILE__ ) . 'scripts/add-user-ratings.js', array( 'jquery' ), GPUR_VERSION, false );	
		
			wp_localize_script( 'gpur-add-user-ratings', 'gpur_add_user_ratings', array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'post_id' => get_the_ID(),		
				'user_rating' => get_user_meta( get_current_user_id(), $ind_user_rating_meta_key, true ),				
				'user_sum' => get_post_meta( get_the_ID(), $user_sum_meta_key, true ),
				'user_votes' => get_post_meta( get_the_ID(), $user_votes_meta_key, true ) ? get_post_meta( get_the_ID(), $user_votes_meta_key, true ) : 0,
				'review_title' => gpur_option( 'comment_form_review_title' ),
				'review_title_limit' => gpur_option( 'comment_form_title_length' ),
				'review_text_limit' => gpur_option( 'comment_form_text_length' ),
				'comment_rating_limit' => gpur_option( 'comment_form_comment_rating_limit' ),	
				'comment_form_min_rating' => gpur_option( 'comment_form_min_rating' ),
				'comment_form_max_rating' => gpur_option( 'comment_form_max_rating' ),
				'comment_form_fractions' => gpur_option( 'comment_form_fractions' ),	
				'comment_form_decimal_places' => gpur_option( 'comment_form_decimal_places' ) + 1,		
				'comment_form_single_error_message' => gpur_option( 'comment_form_single_error_message' ),
				'comment_form_single_duplicate_comments' => gpur_option( 'comment_form_single_duplicate_comments' ),
			) );
			
			wp_register_script( 'gpur-comparison-table-sorting', plugin_dir_url( __FILE__ ) . 'scripts/comparison-table-sorting.js', array( 'jquery' ), GPUR_VERSION, false );	
			
			wp_localize_script( 'gpur-comparison-table-sorting', 'gpur_comparison_table_sorting', array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
			) );
			
			wp_register_script( 'gpur-show-rating', plugin_dir_url( __FILE__ ) . 'scripts/show-rating.js', array( 'jquery' ), GPUR_VERSION, false );	
				
		}	
				
	}	
}
new GPUR_Public();