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
				
			if ( 'padding-top' === $k ) {
				$title = esc_html__( 'Top', 'gpur' );
			} elseif ( 'padding-right' === $k ) {
				$title = esc_html__( 'Right', 'gpur' );
			} elseif ( 'padding-bottom' === $k ) {
				$title = esc_html__( 'Bottom', 'gpur' );
			} elseif ( 'padding-left' === $k ) {
				$title = esc_html__( 'Left', 'gpur' );
			} elseif ( 'margin-top' === $k ) {
				$title = esc_html__( 'Top', 'gpur' );
			} elseif ( 'margin-right' === $k ) {
				$title = esc_html__( 'Right', 'gpur' );
			} elseif ( 'margin-bottom' === $k ) {
				$title = esc_html__( 'Bottom', 'gpur' );
			} elseif ( 'margin-left' === $k ) {
				$title = esc_html__( 'Left', 'gpur' );
			}
			
			echo '<span class="gp-styling-field gp-dimensions-field ' . $field_class . '">';
				if ( $count > 1 ) {
					echo '<label for="' . sanitize_html_class( $new_id ) . '" class="gp-label">' . $title . '</label>';
				}	
				echo '<input type="text" id="' . sanitize_html_class( $new_id ) . '" name="' . $new_name . '" class="gp-input-text gp-small-text" value="' . esc_attr( $new_value ) . '" /><span class="gp-units">' . esc_attr( $units ) . '</span>';
			echo '</span>';
				
		}
	
		echo '<div class="gp-clear"></div>';
	
	}		
	
}