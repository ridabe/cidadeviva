<?php if ( ! class_exists( 'GPUR_Save_Site_Ratings' ) ) {
	class GPUR_Save_Site_Ratings {

		public function __construct() {
			add_action( 'save_post', array( $this, 'save_rating' ) );	
		}

		public function save_rating( $post_id ) {
		
			// Get site rating shortcode data
			$atts = gpur_get_review_template_data( $post_id );
			
			if ( $atts['site_criteria'] ) {
			
				// Get correct meta keys
				$site_rating_meta_key = gpur_get_site_rating( $post_id );
		
				$data = 'site-rating';
				$step = $atts['site_step'];
				$decimal_places = isset( $atts['decimal_places'] ) ? $atts['decimal_places'] : '';
				$criteria = implode( ',', $atts['site_criteria'] );
				$criteria = gpur_criteria( $criteria );
			
				$each_rating_value = 0;
				for( $i = 0; $i < $criteria['count']; $i++ ) {

					// Rating data		
					if ( 'yes' === $criteria['multi'] && $criteria['fields'] && 'site-rating' === $data ) {
						$criterion_slug = sanitize_title_with_dashes( $criteria['fields'][$i] );
						if ( get_post_meta( $post_id, 'gpur_criterion_' . $criterion_slug, true ) ) {
							$each_rating_value += get_post_meta( $post_id, 'gpur_criterion_' . $criterion_slug, true );
						}
					}
			
				}
		
				// Get an average of all multi ratings 
				if ( $each_rating_value > 0 && $criteria['count'] > 1 && 1 != get_post_meta( $post_id, 'gpur_manually_add_overall_rating', true ) ) {
					$updated_avg_rating_value = $each_rating_value / $criteria['count'];
					$updated_avg_rating_value = round( ( $updated_avg_rating_value / $step ), 3 ) * $step;		
					$old_avg_rating_value = get_post_meta( $post_id, $site_rating_meta_key, true );
					update_post_meta( $post_id, 'gpur_site_rating', $updated_avg_rating_value, $old_avg_rating_value );		
				}
				
			}	
	
		}

	}	
}
if ( is_admin() ) {
	new GPUR_Save_Site_Ratings();
}