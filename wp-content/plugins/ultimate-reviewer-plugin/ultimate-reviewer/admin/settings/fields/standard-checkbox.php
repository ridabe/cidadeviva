<?php

echo '<ul class="gp-checkbox-field" id="' . sanitize_html_class( $id ) . '">';	

	if ( isset( $options ) && ! empty( $options ) ) {

		if ( empty( $data ) ) {
		
			foreach ( $options as $option_key => $option_value ) {
			
				if ( isset( $value[$option_key] ) ) {
					$new_value = $value[$option_key];
				} else {
					$new_value = 0;	
				}

				echo '<li><input type="checkbox" name="' . esc_attr( $name ) . '[' . $option_key . ']" id="' . sanitize_html_class( $id ) . '-' . esc_attr( $option_key ) . '" value="1"' . checked( $new_value, 1, false ) . ' />' . esc_attr( $option_value ) . '</li>';
							
			}
			
		} else {
		
			foreach ( $options as $option_title => $option_value ) {

				$option_id = str_replace( ' ', '-', $option_title );
				$option_id = strtolower( $option_id );

				if ( in_array( $option_value, $value ) ) {
					$new_value = $option_value;
				} else {
					$new_value = '';
				}
				
				echo '<li><input type="checkbox" name="' . esc_attr( $name ) . '[' . $option_value . ']" id="' . sanitize_html_class( $id ) . '-' . esc_attr( $option_id ) . '" class="gp-data-checkbox" value="' . esc_attr( $option_value ) . '"' . checked( esc_attr( $new_value ), esc_attr( $option_value ), false ) . '/>' . esc_attr( $option_title ) . '</li>';

			}

		}	
		
		// Needed if all group checkboxes unchecked
		echo '<input name="' . esc_attr( $name ) . '[]" type="hidden" value="1" />'; //ADDED
									
	} else {
	
		echo '<li><input type="checkbox" name="' . esc_attr( $name ) . '" id="' . sanitize_html_class( $id ) . '" value="1"' . checked( $value, 1, false ) . '/></li>';			
		
	}
		
echo '</ul>';