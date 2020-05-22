<?php if ( ! function_exists( 'gpur_wpb_default_reviews_list_templates' ) ) {
	function gpur_wpb_default_reviews_list_templates() {

		// Reviews List 1
		$data = array();
		$data['name'] = esc_html__( 'Reviews List 1', 'gpur' );
		$data['weight'] = 0;
		$data['image_path'] = '';
		$data['custom_class'] = 'gpur-wpb-reviews-list-1';
		$data['content'] = <<<CONTENT
[gpur_reviews_list show_ranking="1" show_user_rating="" show_excerpt="" orderby="site-rating-desc"]		
CONTENT;
		vc_add_default_templates( $data );

		// Reviews List 2
		$data = array();
		$data['name'] = esc_html__( 'Reviews List 2', 'gpur' );
		$data['weight'] = 0;
		$data['image_path'] = '';
		$data['custom_class'] = 'gpur-wpb-reviews-list-2';
		$data['content'] = <<<CONTENT
[gpur_reviews_list show_name="" show_date="" show_user_rating="" image_size="100 x 100" excerpt_length="100" ratings_position="gpur-ratings-to-right" site_rating_max_rating="5" site_rating_decimal_places="1" site_rating_style="style-squares-singular" site_rating_position="position-right" site_rating_container_width="75px" site_rating_container_height="75px" site_rating_container_background_color="#1e73be" site_rating_number_size="40" user_rating_max_rating="5" user_rating_decimal_places="1" user_rating_style="style-squares-singular" position="position-right" site_rating_text_size="40px" posts_border_color="#ffffff"]		
CONTENT;
		vc_add_default_templates( $data );
		
		// Reviews List 3
		$data = array();
		$data['name'] = esc_html__( 'Reviews List 3', 'gpur' );
		$data['weight'] = 0;
		$data['image_path'] = '';
		$data['custom_class'] = 'gpur-wpb-reviews-list-3';
		$data['content'] = <<<CONTENT
[gpur_reviews_list number="6" post_format="gpur-format-columns-3" show_name="" show_date="" show_user_rating="" show_excerpt="" image_size="384 x 240" excerpt_length="" site_rating_empty_icon_color="#989898" site_rating_filled_icon_color="#000000" site_rating_icon_width="30px"]		
CONTENT;
		vc_add_default_templates( $data );
		
		// Reviews List 4
		$data = array();
		$data['name'] = esc_html__( 'Reviews List 4', 'gpur' );
		$data['weight'] = 0;
		$data['image_path'] = '';
		$data['custom_class'] = 'gpur-wpb-reviews-list-4';
		$data['content'] = <<<CONTENT
[gpur_reviews_list show_ranking="true" show_image="" show_name="" excerpt_length="150" ratings_position="gpur-ratings-to-right" site_rating_style="style-gauge-circles-singular" site_rating_position="position-right" site_rating_container_width="75px" site_rating_container_height="75px" site_rating_container_background_color="#000000" site_rating_container_border_width="3px" site_rating_container_border_color="#ffffff" site_rating_gauge_width="3px" site_rating_gauge_filled_color_1="#dd3333" site_rating_gauge_filled_color_2="#dd7133" site_rating_gauge_empty_color="#ffffff" site_rating_number_color="#ffffff" site_rating_number_size="26" user_rating_style="style-gauge-circles-singular" user_rating_position="position-right" user_rating_container_width="75px" user_rating_container_height="75px" user_rating_container_background_color="#000000" user_rating_container_border_width="3px" user_rating_container_border_color="#ffffff" user_rating_gauge_width="3px" user_rating_gauge_filled_color_1="#dd3333" user_rating_gauge_filled_color_2="#dd7133" user_rating_gauge_empty_color="#ffffff" avg_user_rating_number_color="#ffffff" avg_user_rating_number_size="26" show_avg_user_rating_max_rating_number="" position="position-right" site_rating_text_size="26px" site_rating_text_color="#ffffff" orderby="site-rating-desc"]		
CONTENT;
		vc_add_default_templates( $data );
		
		// Reviews List 5
		$data = array();
		$data['name'] = esc_html__( 'Reviews List 5', 'gpur' );
		$data['weight'] = 0;
		$data['image_path'] = '';
		$data['custom_class'] = 'gpur-wpb-reviews-list-5';
		$data['content'] = <<<CONTENT
[gpur_reviews_list show_user_rating="" image_size="100 x 100" excerpt_length="200" site_rating_style="style-hearts"]		
CONTENT;
		vc_add_default_templates( $data );						
	
	}
}	
add_action( 'vc_load_default_templates_action', 'gpur_wpb_default_reviews_list_templates' );