<?php 

wp_enqueue_script( 'wp-color-picker' );
wp_enqueue_script( 'wp-color-picker-alpha' );
wp_enqueue_script( 'ghostpool-color-field' );

$key_order = array(
	'border-width',
	'border-top',
	'border-right',
	'border-bottom',
	'border-left',
	'border-style',
	'border-color',
	'border-radius',
);

$new_order = array();
foreach( $key_order as $key ) {
	if ( isset( $default[$key] ) ) {
		$new_order[$key] = $default[$key];
	}
}

if ( isset( $new_order ) ) {
		
	$count = count( $new_order );

	foreach( $new_order as $k => $v ) {					

		$new_id = $id . '-' . $k;
		$new_name = $name . '[' . $k . ']';
		$new_value = isset( $value[$k] ) ? $value[$k] : $v;
		$field_class = 'gp-' . $k . '-field';

		if ( 'border-width' === $k OR 'border-top' === $k OR 'border-right' === $k OR 'border-bottom' === $k OR 'border-left' === $k ) {

			echo '<span class="gp-text-field gp-styling-field ' . $field_class . '">';
				if ( $count > 1 ) {
					echo '<label for="' . sanitize_html_class( $new_id ) . '" class="gp-label">' . esc_html__( 'Width', 'gpur' ) . '</label>';
				}	
				echo '<input type="text" id="' . sanitize_html_class( $new_id ) . '" class="gp-input-text gp-small-text" name="' . esc_attr( $new_name ) . '" value="' . esc_attr( $new_value ) . '" /><span class="gp-units">' . $units . '</span>';
			echo '</span>';
			
		}
			
		if ( 'border-style' === $k ) {

			echo '<span class="gp-select-field gp-styling-field ' . $field_class . '">';
				if ( $count > 1 ) {
					echo '<label for="' . sanitize_html_class( $new_id ) . '" class="gp-label">' . esc_html__( 'Style', 'gpur' ) . '</label>';
				}	
				echo '<select id="' . sanitize_html_class( $new_id ) . '" class="post_form" name="' . esc_attr( $new_name ) . '">';
					echo '<option value=""></option>';
					$option_values = array(
						'solid'  => esc_html__( 'Solid', 'gpur' ),
						'dashed' => esc_html__( 'Dashed', 'gpur' ),
						'dotted' => esc_html__( 'Dotted', 'gpur' ),
						'double' => esc_html__( 'Double', 'gpur' ),
						'none'   => esc_html__( 'None', 'gpur' ),
					);
					foreach( $option_values as $option_key => $option_value ) {
						if ( $new_value === $option_key ) {
							$checked = ' selected="selected"';
						} else {
							$checked = '';
						}
						echo '<option value="' . esc_attr( $option_key ) . '" ' . $checked . '>' . esc_attr( $option_value ). '</option>';
					}
				echo '</select>';
			echo '</span>';
			
		}
		
		if ( 'border-color' === $k ) {

			echo '<span class="gp-color-picker-field gp-styling-field ' . $field_class . '">';
				if ( $count > 1 ) {
					echo '<label for="' . sanitize_html_class( $new_id ) . '" class="gp-label">' . esc_html__( 'Color', 'gpur' ) . '</label>';
				}	
				echo '<input type="text" id="' . sanitize_html_class( $new_id ) . '" class="gp-input-text" name="' . esc_attr( $new_name ) . '" value="' . esc_attr( $new_value ) . '" data-id="' . sanitize_html_class( $new_id ) . '" data-alpha="true" data-default-color="' . esc_attr( $v ) . '" />';
			echo '</span>';
			
		}	
			
		if ( 'border-radius' === $k ) {

			echo '<span class="gp-text-field gp-styling-field ' . $field_class . '">';
				if ( $count > 1 ) {
					echo '<label for="' . sanitize_html_class( $new_id ) . '" class="gp-label">' . esc_html__( 'Radius', 'gpur' ) . '</label>';
				}	
				echo '<input type="text" id="' . sanitize_html_class( $new_id ) . '" class="gp-input-text gp-small-text" name="' . esc_attr( $new_name ) . '" value="' . esc_attr( $new_value ) . '" /><span class="gp-units">' . $units . '</span>';
			echo '</span>';
			
		}
		
	}
	
	echo '<div class="gp-clear"></div>';
	
}