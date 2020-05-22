<?php

/**
 * Add User Ratings
 *
 */
if ( ! function_exists( 'gpur_add_user_ratings_shortcode_atts' ) ) {
	function gpur_add_user_ratings_shortcode_atts() {

		return array(
			'title' => esc_html__( 'Add Rating', 'gpur' ),	
			'title_size' => '',
			'title_color' => '',
			'title_extra_css' => '',	
			
			'min_rating' => 0,
			'max_rating' => 5,
			'fractions' => 1,
			'step' => 1,	
		
			'style' => 'style-stars',
			'position' => 'position-left',
			'text_position' => 'position-text-bottom',
			'rating_image' => '',
			'empty_icon' => 'fa fa-star',
			'empty_icon_color' => '',
			'filled_icon' => 'fa fa-star',
			'filled_icon_color' => '',
			'icon_width' => '',
			'icon_height' => '',
			
			'show_avg_user_rating_text' => '1',
			'avg_user_rating_label' => esc_html__( 'Average User Rating:', 'gpur' ),
			'avg_user_rating_label_size' => '',
			'avg_user_rating_label_color' => '',
			'avg_user_rating_label_extra_css' => '',
			'avg_user_rating_number_size' => '',
			'avg_user_rating_number_color' => '',
			'avg_user_rating_number_extra_css' => '',
			'show_avg_user_rating_max_rating_number' => '',
			'avg_user_rating_max_rating_number_size' => '',
			'avg_user_rating_max_rating_number_color' => '',
			'avg_user_rating_max_rating_number_extra_css' => '',

			'show_user_votes_text' => '1',
			'singular_vote_label' => esc_html__( 'vote', 'gpur' ),
			'plural_vote_label' => esc_html__( 'votes', 'gpur' ),	
			'user_votes_text_size' => '',
			'user_votes_text_color' => '',
			'user_votes_text_extra_css' => '',				
		
			'show_ind_user_rating_text' => '1',
			'ind_user_rating_label' => esc_html__( 'Your Rating:', 'gpur' ),
			'ind_user_rating_label_size' => '',
			'ind_user_rating_label_color' => '',
			'ind_user_rating_label_extra_css' => '',
			'ind_user_rating_number_size' => '',
			'ind_user_rating_number_color' => '',
			'ind_user_rating_number_extra_css' => '',
			'show_ind_user_rating_max_rating_number' => '',
			'ind_user_rating_max_rating_number_size' => '',
			'ind_user_rating_max_rating_number_color' => '',
			'ind_user_rating_max_rating_number_extra_css' => '',
			
			'criteria' => '',
			'criteria_format' => 'format-column',
			'criteria_title_size' => '',
			'criteria_title_color' => '',
			'criteria_title_extra_css' => '',
			'criterion_boxes' => '',
			'criterion_boxes_padding' => '',
			'criterion_boxes_bg_color_1' => '',
			'criterion_boxes_bg_color_2' => '',
			'criterion_boxes_border_width' => '',
			'criterion_boxes_border_color' => '',
			'criterion_boxes_extra_css' => '',	

			'show_submit_button' => '',
			'submit_button_label' => esc_html__( 'Submit Rating', 'gpur' ),
			'submit_button_text_color' => '',
			'submit_button_text_hover_color' => '',
			'submit_button_border_color' => '',
			'submit_button_border_hover_color' => '',
			'submit_button_bg_color' => '',
			'submit_button_bg_hover_color' => '',
			'submit_button_css' => '',
															
			'permissions' => 'all-users',
			'permission_roles' => '',

			'logged_in_to_vote_label' => esc_html__( 'You must be logged in to vote.', 'gpur' ),
			'single_success_message' => esc_html__( 'Thanks for submitting your rating!', 'gpur' ),
			'single_error_message' => esc_html__( 'Please give a rating.', 'gpur' ),
			'multi_success_message' => esc_html__( 'Thanks for submitting your ratings!', 'gpur' ),
			'multi_error_message' => esc_html__( 'Please give a rating for each criterion.', 'gpur' ),
			
			'css' => '',
			
		);
	
	}
}	

/**
 * Bad Points
 *
 */
if ( ! function_exists( 'gpur_bad_points_shortcode_atts' ) ) {
	function gpur_bad_points_shortcode_atts() {
		
		return array(			
			'title' => esc_html__( 'Bad', 'gpur' ),
			'title_size' => '',
			'title_color' => '',
			'title_extra_css' => '',
			'icon' => 'fa fa-angle-right',
			'icon_size' => '',
			'icon_color' => '',
			'icon_extra_css' => '',
			'text_size' => '',
			'text_color' => '',
			'text_extra_css' => '',
			'css' => '',
		);

	}		
}

/**
 * Comparison Table
 *
 */
if ( ! function_exists( 'gpur_comparison_table_shortcode_atts' ) ) {
	function gpur_comparison_table_shortcode_atts() {

		return array(
			'fields' => <<<CONTENT
REVIEW_IMAGE_1
POST_TITLE
SITE_RATING
USER_RATING
SUMMARY
CONTENT
,			'table_format' => 'format-vertical-grid',
			'heading_bg_color' => '#333333',
			'heading_border_color' => '#333333333',
			'heading_text_color' => '#ffffff',
			'heading_extra_css' => '',
			'cell_bg_color_1' => '',
			'cell_bg_color_2' => '#f8f8f8',
			'remove_vertical_borders' => '1',
			'cell_border_color' => '#eeeeee',
			'cell_text_color' => '',
			'cell_link_color' => '',
			'cell_link_hover_color' => '',
			'cell_extra_css' => '',
			
			'post_types' => 'post',
			'ids' => '',
			'cats' => '',
			'tags' => '',
			'sort' => 'post-date-desc',
			'user_sorting' => '1',
			'number' => 10,
			'rating_range' => '',
			
			'summary_length' => '',
			'excerpt_length' => '',
			'image_size' => 'thumbnail',	
		
			'site_rating_max_rating' => 5,
			'site_rating_decimal_places' => 1,
			'site_rating_show_zero_rating' => '1',
			'site_rating_style' => 'style-stars',
			'site_rating_image' => '',
			'site_rating_empty_icon' => 'fa fa-star',
			'site_rating_empty_icon_color' => '',
			'site_rating_filled_icon' => 'fa fa-star',
			'site_rating_filled_icon_color' => '',
			'site_rating_icon_width' => '',
			'site_rating_icon_height' => '',
			'site_rating_container_width' => '',
			'site_rating_container_height' => '',
			'site_rating_container_background_color' => '',
			'site_rating_container_border_width' => '',
			'site_rating_container_border_color' => '',
			'site_rating_container_extra_css' => '',
			'show_site_rating_text' => '',
			'site_rating_label' => esc_html__( 'Site Rating:', 'gpur' ),
			'site_rating_label_color' => '',
			'site_rating_label_size' => '',
			'site_rating_label_extra_css' => '',
			'site_rating_number_color' => '',
			'site_rating_number_size' => '',
			'site_rating_number_extra_css' => '',
			'show_site_rating_max_rating_number' => '',
			'site_rating_max_rating_number_color' => '',
			'site_rating_max_rating_number_size' => '',
			'site_rating_max_rating_number_extra_css' => '',
			'site_rating_gauge_width' => '',
			'site_rating_gauge_filled_color_1' => '',
			'site_rating_gauge_filled_color_2' => '',
			'site_rating_gauge_empty_color' => '',
			'site_rating_criteria' => '',
			'site_rating_criteria_title_color' => '',
			'site_rating_criteria_title_size' => '',
			'site_rating_criteria_title_extra_css' => '',
			'show_site_rating_ranges_text' => '',
			'site_rating_ranges' => '0-1.9:Awful, 2-2.9:Bad, 3-3.9:Average, 4-4.9:Good, 5-5:Amazing',
			'site_rating_ranges_text_color' => '',
			'site_rating_ranges_text_size' => '',
			'site_rating_ranges_text_extra_css' => '',

			'user_rating_max_rating' => '',
			'user_rating_decimal_places' => '',
			'user_rating_show_zero_rating' => '1',
			'user_rating_style' => '',
			'user_rating_image' => '',
			'user_rating_empty_icon' => '',
			'user_rating_empty_icon_color' => '',
			'user_rating_filled_icon' => '',
			'user_rating_filled_icon_color' => '',
			'user_rating_icon_width' => '',
			'user_rating_icon_height' => '',
			'user_rating_container_width' => '',
			'user_rating_container_height' => '',
			'user_rating_container_background_color' => '',
			'user_rating_container_border_width' => '',
			'user_rating_container_border_color' => '',
			'user_rating_container_extra_css' => '',
			
			'show_avg_user_rating_text' => '',
			'avg_user_rating_label' => esc_html__( 'Average User Rating:', 'gpur' ),
			'avg_user_rating_label_color' => '',
			'avg_user_rating_label_size' => '',
			'avg_user_rating_label_extra_css' => '',
			'avg_user_rating_number_color' => '',
			'avg_user_rating_number_size' => '',
			'avg_user_rating_number_extra_css' => '',
			'show_avg_user_rating_max_rating_number' => '',
			'avg_user_rating_max_rating_number_color' => '',
			'avg_user_rating_max_rating_number_size' => '',
			'avg_user_rating_max_rating_number_extra_css' => '',
			
			'show_user_votes_text' => '',
			'singular_vote_label' => esc_html__( 'vote', 'gpur' ),
			'plural_vote_label' => esc_html__( 'votes', 'gpur' ),	
			'user_votes_text_color' => '',
			'user_votes_text_size' => '',
			'user_votes_text_extra_css' => '',
			
			'show_ind_user_rating_text' => '',
			'ind_user_rating_label' => esc_html__( 'Your Rating:', 'gpur' ),
			'ind_user_rating_label_color' => '',
			'ind_user_rating_label_size' => '',
			'ind_user_rating_label_extra_css' => '',
			'ind_user_rating_number_color' => '',
			'ind_user_rating_number_size' => '',
			'ind_user_rating_number_extra_css' => '',
			'show_ind_user_rating_max_rating_number' => '',
			'ind_user_rating_max_rating_number_color' => '',
			'ind_user_rating_max_rating_number_size' => '',
			'ind_user_rating_max_rating_number_extra_css' => '',
			
			'user_rating_gauge_width' => '',
			'user_rating_gauge_filled_color_1' => '',
			'user_rating_gauge_filled_color_2' => '',
			'user_rating_gauge_empty_color' => '',
			'user_rating_criteria' => '',
			'user_rating_criteria_title_color' => '',
			'user_rating_criteria_title_size' => '',
			'user_rating_criteria_title_extra_css' => '',
			
			'show_user_rating_ranges_text' => '',
			'user_rating_ranges' => '',
			'user_rating_ranges_text_color' => '',
			'user_rating_ranges_text_size' => '',
			'user_rating_ranges_text_extra_css' => '',
						
			'button_text' => esc_html__( 'Button Text', 'gpur' ),
			'button_padding_width' => '15px',
			'button_padding_height' => '10px',
			'button_color' => '#000',
			'button_hover_color' => '#333333',
			'button_text_size' => '20px',
			'button_text_color' => '#ffffff',
			'button_text_hover_color' => '#ffffff',
			'button_border_width' => '',
			'button_border_radius' => '',
			'button_border_color' => '',
			'button_border_hover_color' => '',
			'button_icon' => '',
			'button_icon_size' => '20px',
			'button_icon_color' => '#ffffff',
			'button_icon_hover_color' => '#ffffff',
			'button_icon_alignment' => 'icon-left',
			
			'good_icon' => 'fa fa-angle-right',
			'good_icon_size' => '',
			'good_icon_color' => '',
			'good_icon_extra_css' => '',
			'good_text_size' => '',
			'good_text_color' => '',
			'good_text_extra_css' => '',			
			
			'bad_icon' => 'fa fa-angle-right',
			'bad_icon_size' => '',
			'bad_icon_color' => '',
			'bad_icon_extra_css' => '',
			'bad_text_size' => '',
			'bad_text_color' => '',
			'bad_text_extra_css' => '',
			
			'ranking_numbers_label' => '',
			'review_image_label' => '',
			'post_title_label' => esc_html( 'Title', 'gpur' ),
			'post_date_label' => esc_html( 'Date', 'gpur' ),
			'post_cats_label' => esc_html( 'Categories', 'gpur' ),
			'post_tags_label' => esc_html( 'Tags', 'gpur' ),
			'cell_site_rating_label' => esc_html( 'Site Rating', 'gpur' ),
			'user_rating_label' => esc_html( 'User Rating', 'gpur' ),
			'user_votes_label' => esc_html( 'User Votes', 'gpur' ),
			'summary_label' => esc_html( 'Summary', 'gpur' ),
			'excerpt_label' => esc_html( 'Excerpt', 'gpur' ),
			'button_label' => '',
			'good_points_label' => esc_html( 'Good Points', 'gpur' ),
			'bad_points_label' => esc_html( 'Bad Points', 'gpur' ),
			'likes_label' => esc_html( 'Likes', 'gpur' ),
			'dislikes_label' => esc_html( 'Dislikes', 'gpur' ),
			
			'css' => '',

		);
		
	}		
}	

/**
 * Excerpt
 *
 */
if ( ! function_exists( 'gpur_excerpt_shortcode_atts' ) ) {
	function gpur_excerpt_shortcode_atts() {
		
		return array(			
			'title' => '',
			'title_size' => '',
			'title_color' => '',
			'title_extra_css' => '',
			'text_size' => '',
			'text_color' => '',
			'text_extra_css' => '',
			'css' => '',
		);

	}		
}	

/**
 * Good Points
 *
 */
if ( ! function_exists( 'gpur_good_points_shortcode_atts' ) ) {
	function gpur_good_points_shortcode_atts() {
		
		return array(			
			'title' => esc_html__( 'Good', 'gpur' ),
			'title_size' => '',
			'title_color' => '',
			'title_extra_css' => '',
			'icon' => 'fa fa-angle-right',
			'icon_size' => '',
			'icon_color' => '',
			'icon_extra_css' => '',
			'text_size' => '',
			'text_color' => '',
			'text_extra_css' => '',
			'css' => '',
		);

	}		
}		


/**
 * Shortcode defaults
 *
 */
if ( ! function_exists( 'gpur_review_button_shortcode_atts' ) ) {
	function gpur_review_button_shortcode_atts() {
		
		return array(			
			'text' => esc_html__( 'Button Text', 'gpur' ),
			'link' => '',
			'is_external' => '',
			'nofollow' => '',
			'button_alignment' => 'button-left',
			'button_padding_width' =>'15px',
			'button_padding_height' =>'10px',
			'button_color' => '#000',
			'button_hover_color' => '#333',
			'text_size' => '20px',
			'text_color' => '#fff',
			'text_hover_color' => '#fff',
			'border_width' => '',
			'border_radius' => '',
			'border_color' => '',
			'border_hover_color' => '',
			'icon' => '',
			'icon_size' => '20px',
			'icon_color' => '#fff',
			'icon_hover_color' => '#fff',
			'icon_alignment' => 'icon-left',
			'css' => '',
		);

	}		
}		

/**
 * Reviews List
 *
 */
if ( ! function_exists( 'gpur_reviews_list_shortcode_atts' ) ) {
	function gpur_reviews_list_shortcode_atts() {
		
		return array(			
			'title' => '',
			
			'post_types' => 'post',
			'ids' => '',
			'cats' => '',
			'tags' => '',
			'current_tax' => '',
			'sort' => 'post-date-desc',
			'number' => 5,
			'exclude_current_item' => '',
			'rating_range' => '',
			
			'post_format' => 'gpur-format-list',
			'show_ranking' => '',
			'show_image' => '1',
			'show_title' => '1',
			'show_name' => '1',
			'show_date' => '1',
			'show_comments' => '',
			'show_likes' => '',
			'show_site_rating' => '1',
			'show_user_rating' => '1',
			'show_excerpt' => '1',
			'show_view_link' => '',
			'image_source' => 'featured-image',
			'image_size' => '75 x 75',
			'title_length' => '',
			'excerpt_length' => 200,
			'ratings_position' => 'gpur-ratings-below',
			'posts_border_color' => '',
			
			'site_rating_max_rating' => 5,
			'site_rating_decimal_places' => 1,
			'site_rating_show_zero_rating' => '1',
			'site_rating_style' => 'style-stars',
			'site_rating_position' => 'position-left',
			'site_rating_text_position' => 'position-text-bottom',
			'site_rating_image' => '',
			'site_rating_empty_icon' => 'fa fa-star',
			'site_rating_empty_icon_color' => '',
			'site_rating_filled_icon' => 'fa fa-star',
			'site_rating_filled_icon_color' => '',
			'site_rating_icon_width' => '',
			'site_rating_icon_height' => '',
			'site_rating_container_width' => '',
			'site_rating_container_height' => '',
			'site_rating_container_background_color' => '',
			'site_rating_container_border_width' => '',
			'site_rating_container_border_color' => '',
			'site_rating_container_extra_css' => '',
			'site_rating_gauge_width' => '',
			'site_rating_gauge_filled_color_1' => '',
			'site_rating_gauge_filled_color_2' => '',
			'site_rating_gauge_empty_color' => '',
			'show_site_rating_text' => '',
			'site_rating_label' => esc_html__( 'Site Rating:', 'gpur' ),
			'site_rating_label_color' => '',
			'site_rating_label_size' => '',
			'site_rating_label_extra_css' => '',
			'site_rating_number_color' => '',
			'site_rating_number_size' => '',
			'site_rating_number_extra_css' => '',
			'show_site_rating_max_rating_number' => '',
			'site_rating_max_rating_number_color' => '',
			'site_rating_max_rating_number_size' => '',
			'site_rating_max_rating_number_extra_css' => '',
			'site_rating_criteria' => '',
			'site_rating_criteria_title_color' => '',
			'site_rating_criteria_title_size' => '',
			'site_rating_criteria_title_extra_css' => '',
			'show_site_rating_ranges_text' => '',
			'site_rating_ranges' => '0-1.9:Awful, 2-2.9:Bad, 3-3.9:Average, 4-4.9:Good, 5-5:Amazing',
			'site_rating_ranges_text_color' => '',
			'site_rating_ranges_text_size' => '',
			'site_rating_ranges_text_extra_css' => '',

			'user_rating_max_rating' => '',
			'user_rating_decimal_places' => '',
			'user_rating_show_zero_rating' => '1',
			'user_rating_style' => '',
			'user_rating_image' => '',
			'user_rating_position' => '',
			'user_rating_text_position' => '',
			'user_rating_empty_icon' => '',
			'user_rating_empty_icon_color' => '',
			'user_rating_filled_icon' => '',
			'user_rating_filled_icon_color' => '',
			'user_rating_icon_width' => '',
			'user_rating_icon_height' => '',
			'user_rating_container_width' => '',
			'user_rating_container_height' => '',
			'user_rating_container_background_color' => '',
			'user_rating_container_border_width' => '',
			'user_rating_container_border_color' => '',
			'user_rating_container_extra_css' => '',
			
			'user_rating_gauge_width' => '',
			'user_rating_gauge_filled_color_1' => '',
			'user_rating_gauge_filled_color_2' => '',
			'user_rating_gauge_empty_color' => '',
			
			'show_avg_user_rating_text' => '',
			'avg_user_rating_label' => esc_html__( 'Average User Rating:', 'gpur' ),
			'avg_user_rating_label_color' => '',
			'avg_user_rating_label_size' => '',
			'avg_user_rating_label_extra_css' => '',
			'avg_user_rating_number_color' => '',
			'avg_user_rating_number_size' => '',
			'avg_user_rating_number_extra_css' => '',
			'show_avg_user_rating_max_rating_number' => '',
			'avg_user_rating_max_rating_number_color' => '',
			'avg_user_rating_max_rating_number_size' => '',
			'avg_user_rating_max_rating_number_extra_css' => '',
			
			'show_user_votes_text' => '',
			'singular_vote_label' => esc_html__( 'vote', 'gpur' ),
			'plural_vote_label' => esc_html__( 'votes', 'gpur' ),	
			'user_votes_text_color' => '',
			'user_votes_text_size' => '',
			'user_votes_text_extra_css' => '',
			
			'show_ind_user_rating_text' => '',
			'ind_user_rating_label' => esc_html__( 'Your Rating:', 'gpur' ),
			'ind_user_rating_label_color' => '',
			'ind_user_rating_label_size' => '',
			'ind_user_rating_label_extra_css' => '',
			'ind_user_rating_number_color' => '',
			'ind_user_rating_number_size' => '',
			'ind_user_rating_number_extra_css' => '',
			'show_ind_user_rating_max_rating_number' => '',
			'ind_user_rating_max_rating_number_color' => '',
			'ind_user_rating_max_rating_number_size' => '',
			'ind_user_rating_max_rating_number_extra_css' => '',
			
			'user_rating_criteria' => '',
			'user_rating_criteria_title_color' => '',
			'user_rating_criteria_title_size' => '',
			'user_rating_criteria_title_extra_css' => '',
			
			'show_user_rating_ranges_text' => '',
			'user_rating_ranges' => '',
			'user_rating_ranges_text_color' => '',
			'user_rating_ranges_text_size' => '',
			'user_rating_ranges_text_extra_css' => '',

			'css' => '',
		);

	}		
}	

/**
 * Reviews Template
 *
 */
if ( ! function_exists( 'gpur_review_template_shortcode_atts' ) ) {
	function gpur_review_template_shortcode_atts() {
		
		return array(			
			'template_id' => '',
			'classes' => '',
		);

	}		
}	

/**
 * Show Rating
 *
 */
if ( ! function_exists( 'gpur_show_rating_shortcode_atts' ) ) {
	function gpur_show_rating_shortcode_atts() {

		return array(
			'title' => '',
			'title_size' => '',
			'title_color' => '',
			'title_extra_css' => '',		
			
			'data' => 'site-rating',
			'value' => '',
			'max_rating' => 5,
			'fractions' => 1,
			'step' => 1,
			'decimal_places' => 1,
			'show_zero_rating' => '1',
			'rich_snippets' => '',
			
			'style' => 'style-plain-singular',
			'position' => 'position-left',
			'text_position' => 'position-text-bottom',
			'rating_image' => '',
			'empty_icon' => 'fa fa-star',
			'empty_icon_color' => '',
			'filled_icon' => 'fa fa-star',
			'filled_icon_color' => '',
			'icon_width' => '',
			'icon_height' => '',
			
			'rating_container_width' => '',
			'rating_container_height' => '',
			'rating_container_background_color' => '',			
			'rating_container_border_width' => '',	
			'rating_container_border_color' => '',
			'rating_container_extra_css' => '',

			'gauge_width' => '',
			'gauge_filled_color_1' => '',
			'gauge_filled_color_2' => '',
			'gauge_empty_color' => '',	

			'show_site_rating_text' => '1',
			'site_rating_label' => esc_html__( 'Site Rating:', 'gpur' ),
			'site_rating_label_color' => '',
			'site_rating_label_size' => '',
			'site_rating_label_extra_css' => '',
			'site_rating_number_size' => '',
			'site_rating_number_color' => '',
			'site_rating_number_extra_css' => '',
			'show_site_rating_max_rating_number' => '',
			'site_rating_max_rating_number_color' => '',
			'site_rating_max_rating_number_size' => '',
			'site_rating_max_rating_number_extra_css' => '',
			
			'show_avg_user_rating_text' => '1',
			'avg_user_rating_label' => esc_html__( 'Average User Rating:', 'gpur' ),
			'avg_user_rating_label_size' => '',
			'avg_user_rating_label_color' => '',
			'avg_user_rating_label_extra_css' => '',
			'avg_user_rating_number_size' => '',
			'avg_user_rating_number_color' => '',
			'avg_user_rating_number_extra_css' => '',
			'show_avg_user_rating_max_rating_number' => '',
			'avg_user_rating_max_rating_number_size' => '',
			'avg_user_rating_max_rating_number_color' => '',
			'avg_user_rating_max_rating_number_extra_css' => '',

			'show_user_votes_text' => '1',
			'singular_vote_label' => esc_html__( 'vote', 'gpur' ),
			'plural_vote_label' => esc_html__( 'votes', 'gpur' ),	
			'user_votes_text_size' => '',
			'user_votes_text_color' => '',
			'user_votes_text_extra_css' => '',				
		
			'show_ind_user_rating_text' => '1',
			'ind_user_rating_label' => esc_html__( 'Your Rating:', 'gpur' ),
			'ind_user_rating_label_size' => '',
			'ind_user_rating_label_color' => '',
			'ind_user_rating_label_extra_css' => '',
			'ind_user_rating_number_size' => '',
			'ind_user_rating_number_color' => '',
			'ind_user_rating_number_extra_css' => '',
			'show_ind_user_rating_max_rating_number' => '',
			'ind_user_rating_max_rating_number_size' => '',
			'ind_user_rating_max_rating_number_color' => '',
			'ind_user_rating_max_rating_number_extra_css' => '',
			
			'criteria' => '',
			'criteria_format' => 'format-rows',
			'criteria_title_size' => '',
			'criteria_title_color' => '',
			'criteria_title_extra_css' => '',
			'criterion_boxes' => '',
			'criterion_boxes_padding' => '',
			'criterion_boxes_bg_color_1' => '',
			'criterion_boxes_bg_color_2' => '',
			'criterion_boxes_border_width' => '',
			'criterion_boxes_border_color' => '',
			'criterion_boxes_extra_css' => '',		
							
			'show_ranges_text' => '1',
			'rating_ranges' => '0-1.9:Awful, 2-2.9:Bad, 3-3.9:Average, 4-4.9:Good, 5-5:Amazing',
			'ranges_text_size' => '',
			'ranges_text_color' => '',
			'ranges_text_extra_css' => '',
			
			'css' => ''
		
		);
		
	}		
}	

/**
 * Summary
 *
 */
if ( ! function_exists( 'gpur_summary_shortcode_atts' ) ) {
	function gpur_summary_shortcode_atts() {
		
		return array(			
			'title' => esc_html__( 'Summary', 'gpur' ),
			'title_size' => '',
			'title_color' => '',
			'title_extra_css' => '',
			'text_size' => '',
			'text_color' => '',
			'text_extra_css' => '',
			'css' => '',
		);

	}		
}		

/**
 * Title
 *
 */
if ( ! function_exists( 'gpur_title_shortcode_atts' ) ) {
	function gpur_title_shortcode_atts() {
		
		return array(	
			'title_link' => '',		
			'title_size' => '',
			'title_color' => '',
			'title_hover_color' => '',
			'title_extra_css' => '',
		);

	}		
}

/**
 * Up/Down Voting
 *
 */
if ( ! function_exists( 'gpur_up_down_voting_shortcode_atts' ) ) {
	function gpur_up_down_voting_shortcode_atts() {

		return array(
			'title' => '',
			'title_size' => '',
			'title_color' => '',
			'title_extra_css' => '',
			'style' => 'style-plain',
			'counter_position' => 'position-left-right',
			'up_show' => '1',
			'up_icon' => 'fa fa-thumbs-o-up',
			'up_text' => '',
			'up_icon_size' => '',
			'up_icon_color' => '',
			'up_icon_color_voted' => '',
			'up_button_size' => '',
			'up_button_color' => '',
			'up_button_color_voted' => '',
			'up_counter_size' => '',
			'up_counter_color' => '',
			'down_show' => '1',
			'down_icon' => 'fa fa-thumbs-o-down',
			'down_text' => '',
			'down_icon_size' => '',
			'down_icon_color' => '',
			'down_icon_color_voted' => '',
			'down_button_size' => '',
			'down_button_color' => '',
			'down_button_color_voted' => '',
			'down_counter_size' => '',
			'down_counter_color' => '',
			'already_voted_text_size' => '',
			'already_voted_text_color' => '',
			'already_voted_text_extra_css' => '',
			'already_voted_label' => esc_html__( 'You have already voted.', 'gpur' ),			
			'permissions' => 'all-users',
			'permission_roles' => '',
			'rich_snippets' => '',
			'css' => '',
		);
		
	}		
}