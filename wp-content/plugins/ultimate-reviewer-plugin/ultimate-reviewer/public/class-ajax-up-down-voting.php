<?php if ( ! class_exists( 'GPUR_Ajax_Up_Down_Voting' ) ) {
	class GPUR_Ajax_Up_Down_Voting {

		public function __construct() {		
			add_action( 'wp_ajax_gpur_up_down_voting_callback', array( $this, 'gpur_up_down_voting_callback' ) );
			add_action( 'wp_ajax_nopriv_gpur_up_down_voting_callback', array( $this, 'gpur_up_down_voting_callback' ) );
		}

		public function gpur_up_down_voting_callback() {

			// Check the nonce
			check_ajax_referer( 'gpur_up_down_voting_nonce', 'nonce' );

			// Get the POST values
			$post_id = absint( $_POST['postID'] );
			$type = sanitize_text_field( $_POST['type'] );
			$meta = sanitize_text_field( $_POST['meta'] );

			// Check the vote type
			if ( 'up' === $type ) {
				$meta_name = 'gpur_up_votes';
			} elseif ( 'down' === $type ) {
				$meta_name = 'gpur_down_votes';
			}

			// Get vote count if it already exists
			if ( 'comment' === $meta ) {
				$votes = get_comment_meta( $post_id, $meta_name, true ) != '' ? get_comment_meta( $post_id, $meta_name, true ) : 0;
			} else {
				$votes = get_post_meta( $post_id, $meta_name, true ) != '' ? get_post_meta( $post_id, $meta_name, true ) : 0;			
			}	
			
			// Add 1 to vote count
			$votes = $votes + 1;

			// Update vote count
			if ( 'comment' === $meta ) {
				update_comment_meta( $post_id, $meta_name, (int) $votes );
			} else {
				update_post_meta( $post_id, $meta_name, (int) $votes );
			}

			die();

		}

	}	
} 
new GPUR_Ajax_Up_Down_Voting();