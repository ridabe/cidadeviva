<?php

//delete_option( 'gpur_elementor_default_reviews_list_templates' );

if ( '1' !== get_option( 'gpur_elementor_default_reviews_list_templates' ) ) {

	// Reviews List 1
	$args = array(
	  'post_title'    => esc_html__( 'Reviews List 1', 'gpur' ),
	  'post_status'   => 'publish',
	  'post_type' => 'elementor_library',
	);
	$template_id = wp_insert_post( $args );	
	$content = '[{"id":"53bd7e8","elType":"section","settings":[],"elements":[{"id":"44509d2","elType":"column","settings":{"_column_size":100},"elements":[{"id":"c142d7a","elType":"widget","settings":{"show_ranking":"1","show_user_rating":"","image_size":"75 x 75","site_rating_label":"Site Rating:","site_rating_ranges":"0-1.9:Awful, 2-2.9:Bad, 3-3.9:Average, 4-4.9:Good, 5-5:Amazing","avg_user_rating_label":"Average User Rating:","singular_vote_label":"vote","plural_vote_label":"votes","ind_user_rating_label":"Your Rating:","user_rating_ranges":"0-1.9:Awful, 2-2.9:Bad, 3-3.9:Average, 4-4.9:Good, 5-5:Amazing"},"elements":[],"widgetType":"gpur_reviews_list"}],"isInner":false}],"isInner":false}]';
	add_post_meta( $template_id, '_elementor_data', $content );

	// Reviews List 2
	$args = array(
	  'post_title'    => esc_html__( 'Reviews List 2', 'gpur' ),
	  'post_status'   => 'publish',
	  'post_type' => 'elementor_library',
	);
	$template_id = wp_insert_post( $args );	
	$content = '[{"id":"8ff1f09","elType":"section","settings":[],"elements":[{"id":"7a88304","elType":"column","settings":{"_column_size":100},"elements":[{"id":"27f9bda","elType":"widget","settings":{"show_name":"","show_date":"","show_user_rating":"","image_size":"100 x 100","excerpt_length":100,"ratings_position":"gpur-ratings-to-right","posts_border_color":"#ffffff","site_rating_style":"style-squares-singular","site_rating_position":"position-right","site_rating_container_width":{"unit":"px","size":75,"sizes":[]},"site_rating_container_height":{"unit":"px","size":75,"sizes":[]},"site_rating_container_background_background":"classic","site_rating_container_background_color":"#1e73be","site_rating_label":"Site Rating:","site_rating_number_typography_typography":"custom","site_rating_number_typography_font_size":{"unit":"px","size":40,"sizes":[]},"site_rating_ranges":"0-1.9:Awful, 2-2.9:Bad, 3-3.9:Average, 4-4.9:Good, 5-5:Amazing","avg_user_rating_label":"Average User Rating:","singular_vote_label":"vote","plural_vote_label":"votes","ind_user_rating_label":"Your Rating:","user_rating_ranges":"0-1.9:Awful, 2-2.9:Bad, 3-3.9:Average, 4-4.9:Good, 5-5:Amazing"},"elements":[],"widgetType":"gpur_reviews_list"}],"isInner":false}],"isInner":false}]';
	add_post_meta( $template_id, '_elementor_data', $content );
		
	// Reviews List 3
	$args = array(
	  'post_title'    => esc_html__( 'Reviews List 3', 'gpur' ),
	  'post_status'   => 'publish',
	  'post_type' => 'elementor_library',
	);
	$template_id = wp_insert_post( $args );	
	$content = '[{"id":"68533d9","elType":"section","settings":[],"elements":[{"id":"7cb1b51","elType":"column","settings":{"_column_size":100},"elements":[{"id":"3ee0b85","elType":"widget","settings":{"number":6,"post_format":"gpur-format-columns-3","show_name":"","show_date":"","show_excerpt":"","image_size":"384 x 240","site_rating_empty_icon_color":"#989898","site_rating_filled_icon_color":"#000000","site_rating_icon_width":{"unit":"px","size":30,"sizes":[]},"site_rating_label":"Site Rating:","site_rating_ranges":"0-1.9:Awful, 2-2.9:Bad, 3-3.9:Average, 4-4.9:Good, 5-5:Amazing","avg_user_rating_label":"Average User Rating:","singular_vote_label":"vote","plural_vote_label":"votes","ind_user_rating_label":"Your Rating:","user_rating_ranges":"0-1.9:Awful, 2-2.9:Bad, 3-3.9:Average, 4-4.9:Good, 5-5:Amazing","show_user_rating":""},"elements":[],"widgetType":"gpur_reviews_list"}],"isInner":false}],"isInner":false}]';
	add_post_meta( $template_id, '_elementor_data', $content );

	// Reviews List 4
	$args = array(
	  'post_title'    => esc_html__( 'Reviews List 4', 'gpur' ),
	  'post_status'   => 'publish',
	  'post_type' => 'elementor_library',
	);
	$template_id = wp_insert_post( $args );	
	$content = '[{"id":"fcbe714","elType":"section","settings":[],"elements":[{"id":"3a0ccbc","elType":"column","settings":{"_column_size":100},"elements":[{"id":"32ab2fe","elType":"widget","settings":{"show_image":"","show_name":"","image_size":"160 x 160","excerpt_length":150,"ratings_position":"gpur-ratings-to-right","site_rating_style":"style-gauge-circles-singular","site_rating_position":"position-right","site_rating_container_width":{"unit":"px","size":75,"sizes":[]},"site_rating_container_height":{"unit":"px","size":75,"sizes":[]},"site_rating_container_background_background":"classic","site_rating_container_background_color":"#000000","site_rating_container_border_border":"solid","site_rating_container_border_width":{"unit":"px","top":"3","right":"3","bottom":"3","left":"3","isLinked":true},"site_rating_container_border_color":"#ffffff","site_rating_gauge_width":{"unit":"px","size":3,"sizes":[]},"site_rating_gauge_filled_color_1":"#dd3333","site_rating_gauge_filled_color_2":"#dd7133","site_rating_gauge_empty_color":"#ffffff","site_rating_label":"Site Rating:","site_rating_number_color":"#ffffff","site_rating_number_typography_typography":"custom","site_rating_number_typography_font_size":{"unit":"px","size":26,"sizes":[]},"site_rating_ranges":"0-1.9:Awful, 2-2.9:Bad, 3-3.9:Average, 4-4.9:Good, 5-5:Amazing","user_rating_style":"style-gauge-circles-singular","user_rating_position":"position-right","user_rating_container_width":{"unit":"px","size":75,"sizes":[]},"user_rating_container_height":{"unit":"px","size":75,"sizes":[]},"user_rating_container_background_background":"classic","user_rating_container_background_color":"#000000","user_rating_container_border_border":"solid","user_rating_container_border_width":{"unit":"px","top":"3","right":"3","bottom":"3","left":"3","isLinked":true},"user_rating_container_border_color":"#ffffff","user_rating_gauge_width":{"unit":"px","size":3,"sizes":[]},"user_rating_gauge_filled_color_1":"#dd3333","user_rating_gauge_filled_color_2":"#dd7133","user_rating_gauge_empty_color":"#ffffff","avg_user_rating_label":"Average User Rating:","avg_user_rating_number_color":"#ffffff","avg_user_rating_number_typography_typography":"custom","avg_user_rating_number_typography_font_size":{"unit":"px","size":26,"sizes":[]},"singular_vote_label":"vote","plural_vote_label":"votes","ind_user_rating_label":"Your Rating:","user_rating_ranges":"0-1.9:Awful, 2-2.9:Bad, 3-3.9:Average, 4-4.9:Good, 5-5:Amazing","number":5},"elements":[],"widgetType":"gpur_reviews_list"}],"isInner":false}],"isInner":false}]';
	add_post_meta( $template_id, '_elementor_data', $content );
	
	// Reviews List 5
	$args = array(
	  'post_title'    => esc_html__( 'Reviews List 5', 'gpur' ),
	  'post_status'   => 'publish',
	  'post_type' => 'elementor_library',
	);
	$template_id = wp_insert_post( $args );	
	$content = '[{"id":"060706b","elType":"section","settings":[],"elements":[{"id":"df06321","elType":"column","settings":{"_column_size":100},"elements":[{"id":"11a5a39","elType":"widget","settings":{"number":5,"show_user_rating":"","image_size":"100 x 100","site_rating_style":"style-hearts","site_rating_label":"Site Rating:","site_rating_ranges":"0-1.9:Awful, 2-2.9:Bad, 3-3.9:Average, 4-4.9:Good, 5-5:Amazing","avg_user_rating_label":"Average User Rating:","singular_vote_label":"vote","plural_vote_label":"votes","ind_user_rating_label":"Your Rating:","user_rating_ranges":"0-1.9:Awful, 2-2.9:Bad, 3-3.9:Average, 4-4.9:Good, 5-5:Amazing"},"elements":[],"widgetType":"gpur_reviews_list"}],"isInner":false}],"isInner":false}]';
	add_post_meta( $template_id, '_elementor_data', $content );		

	// Update database			
	update_option( 'gpur_elementor_default_reviews_list_templates', 1 );
	
}