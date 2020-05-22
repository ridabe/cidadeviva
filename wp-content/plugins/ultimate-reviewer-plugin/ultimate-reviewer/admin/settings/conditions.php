<?php if ( ! function_exists( 'ghostpool_conditions' ) ) {
	function ghostpool_conditions( $option_type, $settings, $all_options ) {
	
		extract( $settings );

		// If default is an array, implode values
		$default_string = '';
		if ( is_array( $default ) && 'typography' !== $type ) {
			$default_string = implode( ',', $default );
		}		

		$output = '<input type="hidden" class="' . esc_attr( $id ) . ' gp-option-id" value="' . esc_attr( $id ) . '" data-default="' . $default_string . '" />';
		
		if ( isset( $conditions ) && ! empty( $conditions ) ) {
			if ( is_array( $conditions ) ) {
				foreach( $conditions as $target_id => $desired ) {
					
					// Get desired value
					if ( is_array( $desired ) && isset( $desired['value'] ) ) {
						$desired_value = $desired['value'];
					} elseif ( $desired ) {
						$desired_value = $desired;
					} else {
						$desired_value = '';
					}	
					
					// If value is an array, implode values
					if ( is_array( $desired_value ) ) {
						$desired_value = implode( ',', $desired_value );
					}
					
					// Get target's current value
					if ( 'global' === $option_type ) {
						$target_value = isset( $all_options[$target_id] ) ? $all_options[$target_id] : '';
					} elseif ( 'metaboxes' === $option_type ) {
						$target_value = get_post_meta( $all_options, $target_id, true );
					} elseif ( 'taxonomies' === $option_type ) {
						$target_value = isset( $all_options[$target_id] ) ? $all_options[$target_id] : '';
					}
					
					if ( $target_value ) {
						if ( is_array( $target_value ) ) {
							$target_value = implode( ',', $target_value );
							if ( '1' == $target_value ) {
								$target_value = '';
							}
						}
					} else {
						$target_value = '';
					}	
									
					// Get operator
					if ( is_array( $desired ) && isset( $desired['operator'] ) ) {
						$operator = $desired['operator'];
					} elseif ( is_array( $desired ) ) {
						$operator = 'in_array';
					} else {
						$operator = '=';
					}
					
					$output .= '<input 
					type="hidden" 
					class="gp-conditions"
					value="' . esc_attr( $target_value ) . '"
					data-target-id="' . esc_attr( $target_id ) . '"
					data-desired-value="' . esc_attr( $desired_value ) . '"
					data-operator="' . esc_attr( $operator ) . '" 
					/>';
					
				}	
			}
		}
		
		echo $output;
			
	}
}