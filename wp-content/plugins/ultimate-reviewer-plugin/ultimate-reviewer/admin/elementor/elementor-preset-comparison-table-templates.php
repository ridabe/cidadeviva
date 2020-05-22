<?php

//delete_option( 'gpur_elementor_default_comparison_table_templates' );

if ( '1' !== get_option( 'gpur_elementor_default_comparison_table_templates' ) ) {

	// Comparison Table 1
	$args = array(
	  'post_title'    => esc_html__( 'Comparison Table 1', 'gpur' ),
	  'post_status'   => 'publish',
	  'post_type' => 'elementor_library',
	);
	$template_id = wp_insert_post( $args );	
	$content = '[{"id":"5971a71","elType":"section","settings":[],"elements":[{"id":"5c17236","elType":"column","settings":{"_column_size":100},"elements":[{"id":"9a074d3","elType":"widget","settings":{"fields":"RANKING_NUMBERS,REVIEW_IMAGE_1,POST_TITLE,SITE_RATING,USER_RATING,SUMMARY","post_title_label":"Title","post_date_label":"Date","post_cats_label":"Categories","post_tags_label":"Tags","cell_site_rating_label":"Site Rating","user_rating_label":"User Rating","user_votes_label":"User Votes","summary_label":"Summary","excerpt_label":"Excerpt","good_points_label":"Good Points","bad_points_label":"Bad Points","likes_label":"Likes","dislikes_label":"Dislikes","image_size":"thumbnail","site_rating_label":"Site Rating:","site_rating_ranges":"0-1.9:Awful, 2-2.9:Bad, 3-3.9:Average, 4-4.9:Good, 5-5:Amazing","avg_user_rating_label":"Average User Rating:","singular_vote_label":"vote","plural_vote_label":"votes","ind_user_rating_label":"Your Rating:","user_rating_ranges":"0-1.9:Awful, 2-2.9:Bad, 3-3.9:Average, 4-4.9:Good, 5-5:Amazing","button_text":"Button Text","summary_length":100},"elements":[],"widgetType":"gpur_comparison_table"}],"isInner":false}],"isInner":false}]';
	add_post_meta( $template_id, '_elementor_data', $content );
	add_post_meta( $template_id, '_elementor_edit_mode', 'builder' );		
	add_post_meta( $template_id, '_elementor_template_type', 'page' );	
	
	// Comparison Table 2
	$args = array(
	  'post_title'    => esc_html__( 'Comparison Table 2', 'gpur' ),
	  'post_status'   => 'publish',
	  'post_type' => 'elementor_library',
	);
	$template_id = wp_insert_post( $args );	
	$content = '[{"id":"8d7dd92","elType":"section","settings":[],"elements":[{"id":"f0f0ab7","elType":"column","settings":{"_column_size":100},"elements":[{"id":"b121479","elType":"widget","settings":{"fields":"REVIEW_IMAGE_1,POST_TITLE,SITE_RATING,USER_RATING,USER_VOTES,LIKES,BUTTON","table_format":"format-horizontal-grid","heading_bg_color":"#fff3df","heading_border_color":"#fff3df","heading_text_color":"#000000","cell_bg_color_1":"#ffffff","cell_bg_color_2":"#fff3df","remove_vertical_borders":"","cell_border_color":"#fff3df","cell_link_color":"#000000","cell_link_hover_color":"#ff5722","post_title_label":"Title","post_date_label":"Date","post_cats_label":"Categories","post_tags_label":"Tags","cell_site_rating_label":"Site Rating","user_rating_label":"User Rating","user_votes_label":"User Votes","summary_label":"Summary","excerpt_label":"Excerpt","good_points_label":"Good Points","bad_points_label":"Bad Points","likes_label":"Likes","dislikes_label":"Dislikes","number":5,"summary_length":100,"image_size":"thumbnail","site_rating_label":"Site Rating:","site_rating_ranges":"0-1.9:Awful, 2-2.9:Bad, 3-3.9:Average, 4-4.9:Good, 5-5:Amazing","avg_user_rating_label":"Average User Rating:","singular_vote_label":"vote","plural_vote_label":"votes","ind_user_rating_label":"Your Rating:","user_rating_ranges":"0-1.9:Awful, 2-2.9:Bad, 3-3.9:Average, 4-4.9:Good, 5-5:Amazing","button_text":"Buy","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":16,"sizes":[]},"background_background":"classic","background_color":"#ff5722","background_hover_background":"classic","background_hover_color":"#000000","border_radius":{"unit":"px","top":"5","right":"5","bottom":"5","left":"5","isLinked":true}},"elements":[],"widgetType":"gpur_comparison_table"}],"isInner":false}],"isInner":false}]';
	add_post_meta( $template_id, '_elementor_data', $content );
	add_post_meta( $template_id, '_elementor_edit_mode', 'builder' );		
	add_post_meta( $template_id, '_elementor_template_type', 'page' );	
	
	// Comparison Table 3
	$args = array(
	  'post_title'    => esc_html__( 'Comparison Table 3', 'gpur' ),
	  'post_status'   => 'publish',
	  'post_type' => 'elementor_library',
	);
	$template_id = wp_insert_post( $args );	
	$content = '[{"id":"36d0d66","elType":"section","settings":[],"elements":[{"id":"32e043c","elType":"column","settings":{"_column_size":100},"elements":[{"id":"d105b3a","elType":"widget","settings":{"fields":"REVIEW_IMAGE_1,POST_TITLE,GOOD_POINTS,BAD_POINTS,SITE_RATING,USER_RATING,BUTTON","heading_bg_color":"#ffda23","heading_border_color":"#ffda23","heading_text_color":"#000000","cell_bg_color_1":"#ffffff","cell_bg_color_2":"#ffffff","cell_link_color":"#000000","cell_link_hover_color":"#1e73be","post_title_label":"Title","post_date_label":"Date","post_cats_label":"Categories","post_tags_label":"Tags","cell_site_rating_label":"Site Rating","user_rating_label":"User Rating","user_votes_label":"User Votes","summary_label":"Summary","excerpt_label":"Excerpt","button_label":"Buy","good_points_label":"Good Points","bad_points_label":"Bad Points","likes_label":"Likes","dislikes_label":"Dislikes","sort":"site-rating-desc","user_sorting":"","image_size":"thumbnail","site_rating_max_rating":10,"site_rating_style":"style-gauge-circles-singular","site_rating_container_width":{"unit":"px","size":100,"sizes":[]},"site_rating_container_height":{"unit":"px","size":100,"sizes":[]},"site_rating_label":"Site Rating:","site_rating_typography_typography":"custom","site_rating_typography_font_size":{"unit":"px","size":30,"sizes":[]},"site_rating_ranges":"0-1.9:Awful, 2-2.9:Bad, 3-3.9:Average, 4-4.9:Good, 5-5:Amazing","user_rating_max_rating":10,"user_rating_style":"style-gauge-circles-singular","user_rating_container_width":{"unit":"px","size":100,"sizes":[]},"user_rating_container_height":{"unit":"px","size":100,"sizes":[]},"avg_user_rating_label":"Average User Rating:","singular_vote_label":"vote","plural_vote_label":"votes","ind_user_rating_label":"Your Rating:","user_rating_ranges":"0-1.9:Awful, 2-2.9:Bad, 3-3.9:Average, 4-4.9:Good, 5-5:Amazing","button_text":"Buy","button_text_color":"#1e73be","button_text_hover_color":"#1e73be","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":16,"sizes":[]},"background_background":"classic","background_color":"#ffffff","background_hover_background":"classic","background_hover_color":"#ffda23","border_border":"solid","border_width":{"unit":"px","top":"2","right":"2","bottom":"2","left":"2","isLinked":true},"border_color":"#1e73be","border_radius":{"unit":"px","top":"5","right":"5","bottom":"5","left":"5","isLinked":true},"border_hover_border":"solid","border_hover_color":"#ffda23","icon":{"value":"fas fa-check","library":"fa-solid"},"icon_color":"#1e73be","icon_size":{"unit":"px","size":14,"sizes":[]},"good_text_typography_typography":"custom","good_text_typography_font_size":{"unit":"px","size":14,"sizes":[]},"good_text_typography_line_height":{"unit":"px","size":"","sizes":[]},"bad_icon":{"value":"fas fa-times","library":"fa-solid"},"bad_icon_color":"#1e73be","bad_icon_size":{"unit":"px","size":14,"sizes":[]},"bad_text_typography_typography":"custom","bad_text_typography_font_size":{"unit":"px","size":14,"sizes":[]},"bad_text_typography_line_height":{"unit":"px","size":22,"sizes":[]},"avg_user_rating_typography_typography":"custom","avg_user_rating_typography_font_size":{"unit":"px","size":30,"sizes":[]},"site_rating_number_typography_typography":"custom","site_rating_number_typography_font_size":{"unit":"px","size":30,"sizes":[]},"avg_user_rating_number_typography_typography":"custom","avg_user_rating_number_typography_font_size":{"unit":"px","size":30,"sizes":[]}},"elements":[],"widgetType":"gpur_comparison_table"}],"isInner":false}],"isInner":false}]';
	add_post_meta( $template_id, '_elementor_data', $content );
	add_post_meta( $template_id, '_elementor_edit_mode', 'builder' );		
	add_post_meta( $template_id, '_elementor_template_type', 'page' );	
	
	// Comparison Table Template 4
	$args = array(
	  'post_title'    => esc_html__( 'Comparison Table 4', 'gpur' ),
	  'post_status'   => 'publish',
	  'post_type' => 'elementor_library',
	);
	$template_id = wp_insert_post( $args );	
	$content = '[{"id":"731580e","elType":"section","settings":[],"elements":[{"id":"12ae6a8","elType":"column","settings":{"_column_size":100},"elements":[{"id":"e578ff0","elType":"widget","settings":{"fields":"POST_TITLE,POST_DATE,LIKES,DISLIKES,SITE_RATING","heading_bg_color":"#ffffff","heading_border_color":"#eeeeee","heading_text_color":"#000000","cell_bg_color_1":"#ffffff","remove_vertical_borders":"","cell_link_color":"#1e73be","cell_link_hover_color":"#000000","post_title_label":"Title","post_date_label":"Date","post_cats_label":"Categories","post_tags_label":"Tags","cell_site_rating_label":"Site Rating","user_rating_label":"User Rating","user_votes_label":"User Votes","summary_label":"Summary","excerpt_label":"Excerpt","good_points_label":"Good Points","bad_points_label":"Bad Points","likes_label":"Likes","dislikes_label":"Dislikes","image_size":"thumbnail","site_rating_style":"style-hearts","site_rating_label":"Site Rating:","site_rating_ranges":"0-1.9:Awful, 2-2.9:Bad, 3-3.9:Average, 4-4.9:Good, 5-5:Amazing","user_rating_style":"style-hearts","avg_user_rating_label":"Average User Rating:","singular_vote_label":"vote","plural_vote_label":"votes","ind_user_rating_label":"Your Rating:","user_rating_ranges":"0-1.9:Awful, 2-2.9:Bad, 3-3.9:Average, 4-4.9:Good, 5-5:Amazing","button_text":"Buy","button_text_color":"#1e73be","button_text_hover_color":"#1e73be","button_typography_typography":"custom","button_typography_font_size":{"unit":"px","size":16,"sizes":[]},"background_background":"classic","background_color":"#ffffff","background_hover_background":"classic","background_hover_color":"#ffda23","border_border":"solid","border_width":{"unit":"px","top":"2","right":"2","bottom":"2","left":"2","isLinked":true},"border_color":"#1e73be","border_hover_border":"solid","border_hover_color":"#ffda23","box_shadow_hover_box_shadow_type":"yes"},"elements":[],"widgetType":"gpur_comparison_table"}],"isInner":false}],"isInner":false}]';
	add_post_meta( $template_id, '_elementor_data', $content );
	add_post_meta( $template_id, '_elementor_edit_mode', 'builder' );		
	add_post_meta( $template_id, '_elementor_template_type', 'page' );	

	// Update database
	update_option( 'gpur_elementor_default_comparison_table_templates', 1 );	
		
}				