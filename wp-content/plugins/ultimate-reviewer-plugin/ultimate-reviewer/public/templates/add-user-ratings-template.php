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

$output .= '<' . esc_attr( $container_tag ) . ' class="gpur-criterion' . esc_attr( $order_class ) . '">';
		
	if ( isset( $criterion ) && $criterion ) {
	
		if ( ( isset( $criterion ) && $criterion ) && 1 == $show_ind_user_rating_text  && 'position-text-top' === $text_position ) {
			$output .= '<' . esc_attr( $container_tag ) . ' class="gpur-title-with-top-text">';
		}
	
			$output .= '<' . esc_attr( $container_tag ) . ' class="gpur-criterion-title">' . esc_attr( $criterion ) . '</' . esc_attr( $container_tag ) . '>';
		
	}
	
		if ( ( 1 == $show_avg_user_rating_text OR 1 == $show_ind_user_rating_text ) && 'position-text-bottom' !== $text_position ) {
			$output .= wp_kses_post( $output_rating[$counter] );
		}	
	
	if ( ( isset( $criterion ) && $criterion ) && 1 == $show_ind_user_rating_text && 'position-text-top' === $text_position ) {
		$output .= '</' . esc_attr( $container_tag ) . '>';
	}	

	$input_class = '';
	if ( 'comment' === $meta ) {
		$input_class = ' gpur-comment-rating';
	}	
	
	$data_readonly = '';
	if ( 'yes' === $is_rated ) {
		$data_readonly = ' data-readonly ';
	}	
	
	$weights = '';
	if ( isset( $criteria['weights'][$counter] ) ) { 
		$weights = floatval( $criteria['weights'][$counter] );	
	}	

	$output .= '<input type="hidden" 
	name="gpur_rating[]" 
	class="rating gpur-user-rating' . esc_attr( $input_class ) . '" 
	data-post-id="' . get_the_ID() . '"
	data-nonce="' . wp_create_nonce( 'gpur_save_rating_nonce' ) . '"
	data-weight="' . $weights . '" 
	data-filled="' . esc_attr( $style['filled'] ) . '" 
	data-empty="' . esc_attr( $style['empty'] ) . '" 
	data-start="0"
	data-min-rating="' . esc_attr( $min_rating ) . '" 
	data-stop="' . esc_attr( $max_rating ) . '"
	data-fractions="' . esc_attr( $fractions ) . '" 
	data-step="' . esc_attr( $step ) . '" 
	value="' . esc_attr( $your_user_rating_value[$counter] ) . '"' 
	. $data_readonly . '/>';

	if ( ( 1 == $show_avg_user_rating_text OR 1 == $show_ind_user_rating_text ) && 'position-text-bottom' === $text_position ) {
		$output .= wp_kses_post( $output_rating[$counter] );
	}
	
$output .= '</' . esc_attr( $container_tag ) . '>';

if ( 'format-column' === $criteria_format && 1 != $criterion_boxes ) {
	$output .= '<' . esc_attr( $container_tag ) . ' class="gpur-clear"></' . esc_attr( $container_tag ) . '>';
}