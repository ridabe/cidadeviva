<?php

if ( 'comment' === $meta ) {
	$unique_id = 'comment-list .gpur-' . $post_id;
} elseif ( 'widget' === $meta ) {
	$unique_id = 'gpur-user-review .gpur-' . $post_id;
} elseif ( 'breakdown' === $meta ) {
	$unique_id = 'gpur-rating-summary .gpur-' . $post_id;
}
		
// Inline CSS
$inline_css = '';

// Title
if ( $title_size ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-element-title {font-size: ' . ghostpool_add_units( $title_size ) . ';}';
} 
if ( $title_color ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-element-title {color: ' . esc_attr( $title_color ) . ';}';
} 
if ( isset( $title_extra_css ) && $title_extra_css ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-element-title {' . esc_attr( $title_extra_css ) . '}';
}

// Rating image
if ( $rating_image ) { 
	if ( isset( $rating_image['id'] ) ) {
		$image_id = $rating_image['id'];
	} else {
		$image_id = $rating_image;
	}
	$rating_image_data = wp_get_attachment_image_src( $image_id );
	$inline_css .= '.' . esc_attr( $unique_id ) . '.gpur-style-image .gpur-symbol-empty, .' . esc_attr( $unique_id ) . '.gpur-style-image .gpur-symbol-filled {background-image:url(' . esc_attr( $rating_image_data[0] ) . '); width: ' . esc_attr( $rating_image_data[1] ) . 'px; height: ' . esc_attr( $rating_image_data[2] / 2 ) . 'px;
	}';
} 

// Rating icons
if ( $empty_icon_color ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .rating-symbol-background {color: ' . esc_attr( $empty_icon_color ) . ';}.' . esc_attr( $unique_id ) . '.gpur-style-circles .gpur-symbol-empty, .' . esc_attr( $unique_id ) . '.gpur-style-squares .gpur-symbol-empty, .' . esc_attr( $unique_id ) . '.gpur-style-bars .gpur-symbol-empty {background-color: ' . esc_attr( $empty_icon_color ) . ';}';
}
if ( $filled_icon_color ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .rating-symbol-foreground {color: ' . esc_attr( $filled_icon_color ) . ';}.' . esc_attr( $unique_id ) . '.gpur-style-circles .gpur-symbol-filled, .' . esc_attr( $unique_id ) . '.gpur-style-squares .gpur-symbol-filled, .' . esc_attr( $unique_id ) . '.gpur-style-bars .gpur-symbol-filled {background-color: ' . esc_attr( $filled_icon_color ) . ';}';
}
if ( $icon_width ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .rating-symbol {font-size: ' . ghostpool_add_units( $icon_width ) . ';}';
	$inline_css .= '.' . esc_attr( $unique_id ) . '.gpur-style-circles .gpur-symbol, .' . esc_attr( $unique_id ) . '.gpur-style-squares .gpur-symbol {width: ' . ghostpool_add_units( $icon_width ) . ';}';
}			
if ( $icon_height ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . '.gpur-style-bars .gpur-symbol, .' . esc_attr( $unique_id ) . '.gpur-style-circles .gpur-symbol, .' . esc_attr( $unique_id ) . '.gpur-style-squares .gpur-symbol {height: ' . ghostpool_add_units( $icon_height ) . ';}';
}

// Rating container
if ( $rating_container_width ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-rating-outer {width: ' . ghostpool_add_units( $rating_container_width ) . ';}';
}	
if ( $rating_container_height ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-rating-outer {height: ' . ghostpool_add_units( $rating_container_height ) . ';}';
}
if ( $rating_container_background_color ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-rating-inner {background-color: ' . esc_attr( $rating_container_background_color ) . ';}';
}			
if ( $rating_container_border_width ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-rating-inner {border-width: ' . ghostpool_add_units( $rating_container_border_width ) . ';}';
}			
if ( $rating_container_border_color ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-rating-inner {border-color: ' . esc_attr( $rating_container_border_color ) . ';}';
}
if ( $rating_container_extra_css ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-rating-outer {' . esc_attr( $rating_container_extra_css ) . '}';
}

// Site Rating - Label
if ( $site_rating_label_color ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-site-rating-label {color: ' . esc_attr( $site_rating_label_color ) . ';}';
}
if ( $site_rating_label_size ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-site-rating-label {font-size: ' . ghostpool_add_units( $site_rating_label_size ) . ';}';
}
if ( $site_rating_label_extra_css ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-site-rating-label {' . esc_attr( $site_rating_label_extra_css ) . '}';
}

// Site Rating - Rating Number
if ( $site_rating_number_color ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-site-rating .gpur-rating-value {color: ' . esc_attr( $site_rating_number_color ) . ';}';
}
if ( $site_rating_number_size ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-site-rating .gpur-rating-value {font-size: ' . ghostpool_add_units( $site_rating_number_size ) . ';}';
}
if ( $site_rating_number_extra_css ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-site-rating .gpur-rating-value {' . esc_attr( $site_rating_number_extra_css ) . '}';
}

// Site Rating - Maximum Rating Number		
if ( $site_rating_max_rating_number_color ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-site-rating .gpur-max-rating {color: ' . esc_attr( $site_rating_max_rating_number_color ) . ';}';
}
if ( $site_rating_max_rating_number_size ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-site-rating .gpur-max-rating {font-size: ' . ghostpool_add_units( $site_rating_max_rating_number_size ) . ';}';
}
if ( $site_rating_max_rating_number_extra_css ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-site-rating .gpur-max-rating {' . esc_attr( $site_rating_max_rating_number_extra_css ) . '}';
}
				
// Average User Rating - Label
if ( $avg_user_rating_label_color ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-avg-user-rating-label {color: ' . esc_attr( $avg_user_rating_label_color ) . ';}';
}
if ( $avg_user_rating_label_size ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-avg-user-rating-label {font-size: ' . ghostpool_add_units( $avg_user_rating_label_size ) . ';}';
}
if ( $avg_user_rating_label_extra_css ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-avg-user-rating-label {' . esc_attr( $avg_user_rating_label_extra_css ) . '}';
}
					
// Average User Rating - Rating Number
if ( $avg_user_rating_number_size ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-avg-user-rating .gpur-rating-value {font-size: ' . ghostpool_add_units( $avg_user_rating_number_size ) . ';}';
}
if ( $avg_user_rating_number_color ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-avg-user-rating .gpur-rating-value {color: ' . esc_attr( $avg_user_rating_number_color ) . ';}';
}
if ( $avg_user_rating_number_extra_css ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-avg-user-rating .gpur-rating-value {' . esc_attr( $avg_user_rating_number_extra_css ) . '}';
}

// Average User Rating - Maximum Rating Number		
if ( $avg_user_rating_max_rating_number_color ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-avg-user-rating .gpur-max-rating {color: ' . esc_attr( $avg_user_rating_max_rating_number_color ) . ';}';
}
if ( $avg_user_rating_max_rating_number_size ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-avg-user-rating .gpur-max-rating {font-size: ' . ghostpool_add_units( $avg_user_rating_max_rating_number_size ) . ';}';
}
if ( $avg_user_rating_max_rating_number_extra_css ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-avg-user-rating .gpur-max-rating {' . esc_attr( $avg_user_rating_max_rating_number_extra_css ) . '}';
}
				
// Individual User Rating - Label
if ( $ind_user_rating_label_color ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-ind-user-rating-label {color: ' . esc_attr( $ind_user_rating_label_color ) . ';}';
}
if ( $ind_user_rating_label_size ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-ind-user-rating-label {font-size: ' . ghostpool_add_units( $ind_user_rating_label_size ) . ';}';
}
if ( $ind_user_rating_label_extra_css ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-ind-user-rating-label {' . esc_attr( $ind_user_rating_label_extra_css ) . '}';
}

// User Votes Text			
if ( $user_votes_text_color ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-user-votes {color: ' . esc_attr( $user_votes_text_color ) . ';}';
}
if ( $user_votes_text_size ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-user-votes {font-size: ' . ghostpool_add_units( $user_votes_text_size ) . ';}';
}
if ( $user_votes_text_extra_css ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-user-votes {' . esc_attr( $user_votes_text_extra_css ) . '}';
}

// Individual User Rating - Rating Number
if ( $ind_user_rating_number_size ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-ind-user-rating .gpur-rating-value {font-size: ' . ghostpool_add_units( $ind_user_rating_number_size ) . ';}';
}
if ( $ind_user_rating_number_color ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-ind-user-rating .gpur-rating-value {color: ' . esc_attr( $ind_user_rating_number_color ) . ';}';
}
if ( $ind_user_rating_number_extra_css ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-ind-user-rating .gpur-rating-value {' . esc_attr( $ind_user_rating_number_extra_css ) . '}';
}

// Individual User Rating - Maximum Rating Number		
if ( $ind_user_rating_max_rating_number_color ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-ind-user-rating .gpur-max-rating {color: ' . esc_attr( $ind_user_rating_max_rating_number_color ) . ';}';
}
if ( $ind_user_rating_max_rating_number_size ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-ind-user-rating .gpur-max-rating {font-size: ' . ghostpool_add_units( $ind_user_rating_max_rating_number_size ) . ';}';
}
if ( $ind_user_rating_max_rating_number_extra_css ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-ind-user-rating .gpur-max-rating {' . esc_attr( $ind_user_rating_max_rating_number_extra_css ) . '}';
}

// Gauge
if ( $gauge_width ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . '.gpur-style-gauge-circles-singular .gpur-rating-inner {top: ' . ghostpool_add_units( $gauge_width ) . '; bottom: ' . ghostpool_add_units( $gauge_width ) . '; left: ' . ghostpool_add_units( $gauge_width ) . '; right: ' . ghostpool_add_units( $gauge_width ) . ';}';
} 
if ( $gauge_filled_color_1 OR $gauge_filled_color_2 ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-small-rating .gpur-gauge-spinner {background: ' . esc_attr( $gauge_filled_color_1 ) . '; background:-webkit-linear-gradient(' . esc_attr( $gauge_filled_color_1 ) . ' 0%,' . esc_attr( $gauge_filled_color_2 ) . ' 70%); background:linear-gradient(' . esc_attr( $gauge_filled_color_1 ) . ' 0%,' . esc_attr( $gauge_filled_color_2 ) . ' 70%);}.' . esc_attr( $unique_id ) . ' .gpur-large-rating .gpur-gauge-spinner {background: ' . esc_attr( $gauge_filled_color_1 ) . ';}.' . esc_attr( $unique_id ) . ' .gpur-gauge-filler {background: ' . esc_attr( $gauge_filled_color_1 ) . '; background:-webkit-linear-gradient(' . esc_attr( $gauge_filled_color_2 ) . ' 0%,' . esc_attr( $gauge_filled_color_1 ) . ' 70%); background:linear-gradient(' . esc_attr( $gauge_filled_color_2 ) . ' 0%,' . esc_attr( $gauge_filled_color_1 ) . ' 70%);}.' . esc_attr( $unique_id ) . '.gpur-style-gauge-circles-singular .gpur-rating-outer.gpur-full-gauge-rating {background: ' . esc_attr( $gauge_filled_color_1 ) . ';}';
}
if ( $gauge_empty_color ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . '.gpur-style-gauge-circles-singular .gpur-rating-outer {background: ' . esc_attr( $gauge_empty_color ) . ';}';
}
if ( $rating_container_width ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-small-rating .gpur-gauge-1 {clip: rect(0, ' . ghostpool_add_units( $rating_container_width ) . ', ' . ghostpool_add_units( $rating_container_width ) . ', ' . ghostpool_add_units( ghostpool_remove_units( $rating_container_width ) / 2 ) . ');}';
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-small-rating .gpur-gauge-2 {clip: rect(0, ' . ghostpool_add_units( ghostpool_remove_units( $rating_container_width ) / 2 ) . ', ' . ghostpool_add_units( $rating_container_width ) . ', 0);}';
}
				
// Criterion boxes
if ( $criterion_boxes_padding ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . '.gpur-criterion-boxes .gpur-criterion {padding: ' . ghostpool_add_units( $criterion_boxes_padding ) . ';}';
}	
if ( $criterion_boxes_bg_color_1 ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . '.gpur-criterion-boxes .gpur-criterion:nth-child(odd) {background-color: ' . esc_attr( $criterion_boxes_bg_color_1 ) . ';}';
}	
if ( $criterion_boxes_bg_color_2 ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . '.gpur-criterion-boxes .gpur-criterion:nth-child(even) {background-color: ' . esc_attr( $criterion_boxes_bg_color_2 ) . ';}';
}	
if ( $criterion_boxes_border_width ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . '.gpur-criterion-boxes .gpur-criterion {border-top-width: ' . ghostpool_add_units( $criterion_boxes_border_width ) . ';}';
}	
if ( $criterion_boxes_border_color ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . '.gpur-criterion-boxes .gpur-criterion {border-color: ' . esc_attr( $criterion_boxes_border_color ) . ';}';
}		
if ( $criterion_boxes_extra_css ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . '.gpur-criterion-boxes .gpur-criterion {' . esc_attr( $criterion_boxes_extra_css ) . '}';
}				

// Criteria Title
if ( $criteria_title_color ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-criterion-title {color: ' . esc_attr( $criteria_title_color ) . ';}';
} 
if ( $criteria_title_size ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-criterion-title {font-size: ' . ghostpool_add_units( $criteria_title_size ) . ';}';
} 
if ( $criteria_title_extra_css ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-criterion-title {' . esc_attr( $criteria_title_extra_css ) . '}';
} 

// Ranges Text
if ( $ranges_text_size ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-ranges-text {font-size: ' . ghostpool_add_units( $ranges_text_size ) . ';}';
}
if ( $ranges_text_color ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-ranges-text {color: ' . esc_attr( $ranges_text_color ) . ';}';
}
if ( $ranges_text_extra_css ) {
	$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-ranges-text {' . ghostpool_add_units( $ranges_text_extra_css ) . '}';
}

wp_register_style( 'gpur-shortcodes', false );
wp_enqueue_style( 'gpur-shortcodes' );
wp_add_inline_style( 'gpur-shortcodes', $inline_css );