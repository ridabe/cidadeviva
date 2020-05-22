<?php 

$counter = $i++; 
if ( is_array( $criteria['fields'] ) ) {
	$length = count( $criteria['fields'] );
} else {
	$length = 0;
}

$order_class = '';
if ( 0 === $counter ) {
	$order_class = ' gpur-first';
} elseif ( ( $length - 1 ) === $counter ) {
	$order_class = ' gpur-last';
}

$output .= '<div class="gpur-criterion' . esc_attr( $order_class ) . '">';

	if ( isset( $criterion ) && $criterion ) {
	
		if ( ( isset( $criterion ) && $criterion ) && ( 1 == $show_site_rating_text OR 1 == $show_avg_user_rating_text OR 1 == $show_ind_user_rating_text ) && 'position-text-top' === $text_position ) {
			$output .= '<div class="gpur-title-with-top-text">';
		}	
	
			$output .= '<div class="gpur-criterion-title">' . esc_attr( $criterion ) . '</div>';
		
	 }
	
	if ( 'style-stars' === $style['class'] OR 'style-squares' === $style['class'] OR 'style-circles' === $style['class'] OR 'style-hearts' === $style['class'] OR 'style-bars' === $style['class'] OR 'style-icon' === $style['class'] OR 'style-image' === $style['class'] ) {

			if ( ( 1 == $show_site_rating_text OR 1 == $show_avg_user_rating_text OR 1 == $show_ind_user_rating_text OR 1 == $show_ranges_text ) && $text_position != 'position-text-bottom' ) {
				$output .= wp_kses_post( $output_rating[$counter] );
			}	
	
		if ( ( isset( $criterion ) && $criterion ) && ( 1 == $show_site_rating_text OR 1 == $show_avg_user_rating_text OR 1 == $show_ind_user_rating_text ) && 'position-text-top' === $text_position ) {
			$output .= '</div>';
		}
		
		$output .= '<input type="hidden" class="rating gpur-user-rating" 
		data-filled="' . esc_attr( $style['filled'] ) . '" 
		data-empty="' . esc_attr( $style['empty'] ) . '" 
		data-start="0" 
		data-stop="' . esc_attr( $max_rating ) . '"
		data-fractions="' . esc_attr( $fractions ) . '"  
		data-step="' . esc_attr( $step ) . '" 
		value="' . floatval( $rating_value[$counter] ) . '" 
		data-readonly />';

		if ( ( 1 == $show_site_rating_text OR 1 == $show_avg_user_rating_text OR 1 == $show_ind_user_rating_text OR 1 == $show_ranges_text ) && 'position-text-bottom' === $text_position ) {
			$output .= wp_kses_post( $output_rating[$counter] );
		}
	
	} else {
	
		$output .= '<div class="gpur-rating-outer' . esc_attr( $degrees_class[$counter] ) . '">';
	
			if ( 'style-gauge-circles-singular' === $style['class'] ) {
				$output .= '<div class="gpur-gauge-circle gpur-gauge-1">
					<div class="gpur-gauge-spinner"' . ' style="-webkit-transform:rotate(' . absint( $degrees[$counter] ) . 'deg);transform:rotate(' . absint( $degrees[$counter] ) . 'deg);"' . '></div>
				</div>
				<div class="gpur-gauge-circle gpur-gauge-2">
					<div class="gpur-gauge-filler"></div>
				</div>';
			}
	
			$output .= '<div class="gpur-rating-inner">' . wp_kses_post( $output_rating[$counter] ) . '</div>';

		$output .= '</div>';

	}
	
$output .= '</div>';

if ( 'format-column' === $criteria_format && 1 != $criterion_boxes ) {
	$output .= '<div class="gpur-clear"></div>';
}