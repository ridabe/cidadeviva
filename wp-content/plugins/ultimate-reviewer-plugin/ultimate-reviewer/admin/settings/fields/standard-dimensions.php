<?php
	
if ( isset( $default ) ) {

	$count = 1;

	if ( is_array( $default ) ) {
		
		$count = count( $default );
	
		foreach( $default as $k => $v ) {

			$new_id = $id . '-' . $k;
			$new_name = $name . '[' . $k . ']';
			$new_value = isset( $value[$k] ) ? $value[$k] : $v;
			
			$field_class = 'gp-' . $k . '-field';

			if ( 1 === $count ) {
				$field_class .= ' gp-single-styling-field';
			}

			if ( 'height' === $k ) {
				$title = esc_html__( 'Height', 'gpur' );
			} elseif ( 'width' === $k ) {
				$title = esc_html__( 'Width', 'gpur' );
			}
		
			echo '<span class="gp-styling-field gp-dimensions-field ' . $field_class . '">';
				if ( $count > 1 ) {
					echo '<label for="' . sanitize_html_class( $new_id ) . '" class="gp-label">' . $title . '</label>';
				}	
				echo '<input type="text" id="' . sanitize_html_class( $new_id ) . '" class="gp-input-text gp-small-text" name="' . esc_attr( $new_name ) . '" value="' . esc_attr( $new_value ) . '" /><span class="gp-units">' . $units . '</span>';
			echo '</span>';
		
		}
	
		echo '<div class="gp-clear"></div>';

	}
		
}	