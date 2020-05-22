<?php 

wp_enqueue_style( 'select2css' );
wp_enqueue_script( 'select2js' );
wp_enqueue_style( 'wp-color-picker' );
wp_enqueue_script( 'wp-color-picker' );
wp_enqueue_script( 'ghostpool-color-field' );
wp_enqueue_script( 'ghostpool-typography-field' );

// Set order of variables
$key_order = array(
	'font-family',
	'font-backup',
	'font-size',
	'line-height',
	'color',
	'font-weight',
	'subsets',
	'letter-spacing',
	'word-spacing',
	'text-transform',
	'text-align',
	'text-decoration',
);
$new_order = array();
foreach( $key_order as $key ) {
	if ( isset( $default[$key] ) ) {
		$new_order[$key] = $default[$key];
	}
}

if ( isset( $new_order ) ) {
	
	$count = count( $default );
	
	foreach( $new_order as $key => $default_value ) {				

		$new_id = $id . '-' . $key;
		$new_name = $name . '[' . $key . ']';
		$new_value = isset( $value[$key] ) ? $value[$key] : $default_value;

		$field_class = 'gp-' . $key . '-field';

		if ( 1 === $count ) {
			$field_class .= ' gp-single-styling-field';
		}
		
		// Output units dropdown
		$units_selector = '<span class="gp-units">px</span>';
		/*$units_selector = '<span class="gp-units">';
			$my_units = isset( $default_value['units'] ) ? $default_value['units'] : array( 'px', 'em', '%' );
			if ( false !== $my_units ) {
				$units_selector .= '<select id="' . sanitize_html_class( $new_id ) . '-units" class="post_form" name="' . esc_attr( $new_name ) . '[units]">';
					foreach( $my_units as $unit ) {
						$unit_value = isset( $new_value['units'] ) ? $new_value['units'] : 'px'; // If no unit value is currently saved
						if ( $unit_value === $unit ) {
							$checked = ' selected="selected"';
						} else {
							$checked = '';
						}
						$units_selector .= '<option value="' . $unit . '"' . $checked . '>' . $unit . '</a>';
					}
				$units_selector .= '</select>';
			} else {
				$units_selector .= '<input type="hidden" id="' . sanitize_html_class( $new_id ) . '-units" name="' . esc_attr( $new_name ) . '[units]" value="px" />px';		
			}
		$units_selector .= '</span>';*/
		
		// Settings
		if ( 'font-size' === $key ) {
		
			echo '<span class="gp-text-field gp-styling-field ' . $field_class . '">';
				echo '<label for="' . sanitize_html_class( $new_id ) . '" class="gp-label">' . esc_html__( 'Font Size', 'gpur' ) . '</label>';
				echo '<input type="text" id="' . sanitize_html_class( $new_id ) . '" class="gp-input-text gp-small-text" name="' . esc_attr( $new_name ) . '[value]" value="' . esc_attr( $new_value['value'] ) . '" />' . $units_selector;		
			echo '</span>';

		} elseif ( 'line-height' === $key ) {

			echo '<span class="gp-text-field gp-styling-field ' . $field_class . '">';
				echo '<label for="' . sanitize_html_class( $new_id ) . '" class="gp-label">' . esc_html__( 'Line Height', 'gpur' ) . '</label>';
				echo '<input type="text" id="' . sanitize_html_class( $new_id ) . '" class="gp-input-text gp-small-text" name="' . esc_attr( $new_name ) . '[value]" value="' . esc_attr( $new_value['value'] ) . '" />' . $units_selector;
			echo '</span>';

		} elseif ( 'font-family' === $key ) {
		
			wp_enqueue_style( 'select2css' );
			wp_enqueue_script( 'select2js' );

			echo '<span class="gp-select-field gp-styling-field ' . $field_class . '">';
	
				echo '<label for="' . sanitize_html_class( $new_id ) . '" class="gp-label">' . esc_html__( 'Font Family', 'gpur' ) . '</label>';

				echo '<select id="' . sanitize_html_class( $new_id ) . '" class="post_form select2-field" name="' . esc_attr( $new_name ) . '">';
				
					if ( ghostpool_google_fonts_array() ) {
						foreach( ghostpool_google_fonts_array() as $font ) {
							if ( $new_value === $font ) {
								$checked = ' selected="selected"';
							} else {
								$checked = '';
							}
							echo '<option value="' . esc_attr( $font ) . '"' . $checked . '>' . esc_attr( $font ) . '</option>';
						}
					}
										
				echo '</select>';
			
			echo '</span>';

		} elseif ( 'font-backup' === $key ) {
	
			echo '<span class="gp-select-field gp-styling-field ' . $field_class . '">';
				echo '<label for="' . sanitize_html_class( $new_id ) . '" class="gp-label">' . esc_html__( 'Backup Font Family', 'gpur' ) . '</label>';
				echo '<select id="' . sanitize_html_class( $new_id ) . '" class="post_form" name="' . esc_attr( $new_name ) . '">';
					if ( ghostpool_backup_fonts_array() ) {
						foreach( ghostpool_backup_fonts_array() as $font ) {
							if ( $new_value === $font ) {
								$checked = ' selected="selected"';
							} else {
								$checked = '';
							}
							echo '<option value="' . esc_attr( $font ) . '" ' . $checked . '>' . esc_attr( $font ) . '</option>';
						}
					}	
				echo '</select>';
			echo '</span>';
		
		} elseif ( 'font-weight' === $key ) {

			echo '<span class="gp-select-field gp-styling-field ' . $field_class . '">';
				echo '<label for="' . sanitize_html_class( $new_id ) . '" class="gp-label">' . esc_html__( 'Font Variants', 'gpur' ) . '</label>';
				echo '<select id="' . sanitize_html_class( $new_id ) . '" class="post_form" name="' . esc_attr( $new_name ) . '">';
					$font_family = isset( $value['font-family'] ) ? $value['font-family'] : $default['font-family'];
					if ( ghostpool_google_font_variants_array( $font_family ) && is_array( ghostpool_google_font_variants_array( $font_family ) ) ) {
						foreach( ghostpool_google_font_variants_array( $font_family ) as $title => $key ) {
							if ( $new_value === $key ) {
								$checked = ' selected="selected"';
							} else {
								$checked = '';
							}
							echo '<option value="' . esc_attr( $key ) . '"' . $checked . '>' . esc_attr( $title ) . '</option>';
						}
					}	
				echo '</select>';
			echo '</span>';

		} elseif ( 'subsets' === $key ) {

			echo '<span class="gp-select-field gp-styling-field ' . $field_class . '">';
				echo '<label for="' . sanitize_html_class( $new_id ) . '" class="gp-label">' . esc_html__( 'Font Subsets', 'gpur' ) . '</label>';
				echo '<select id="' . sanitize_html_class( $new_id ) . '" class="post_form" name="' . esc_attr( $new_name ) . '">';
					$font_family = isset( $value['font-family'] ) ? $value['font-family'] : $default['font-family'];
					if ( ghostpool_google_font_subsets_array( $font_family ) && is_array( ghostpool_google_font_subsets_array( $font_family ) ) ) {
						foreach( ghostpool_google_font_subsets_array( $font_family ) as $key => $title ) {
							if ( $new_value === $key ) {
								$checked = ' selected="selected"';
							} else {
								$checked = '';
							}
							echo '<option value="' . esc_attr( $key ) . '"' . $checked . '>' . esc_attr( $title ) . '</option>';
						}
					}
				echo '</select>';
			echo '</span>';
		
		} elseif ( 'color' === $key ) {

			echo '<span class="gp-color-picker-field gp-styling-field ' . $field_class . '">';
				echo '<label for="' . sanitize_html_class( $new_id ) . '" class="gp-label">' . esc_html__( 'Color', 'gpur' ) . '</label>';
				echo '<input type="text" id="' . sanitize_html_class( $new_id ) . '" class="gp-input-text" name="' . esc_attr( $new_name ) . '" value="' . esc_attr( $new_value ) . '" data-id="' . sanitize_html_class( $new_id ) . '" />';
			echo '</span>';
		
		} elseif ( 'letter-spacing' === $key ) {

			echo '<span class="gp-text-field gp-styling-field ' . $field_class . '">';
				echo '<label for="' . sanitize_html_class( $new_id ) . '" class="gp-label">' . esc_html__( 'Letter Spacing', 'gpur' ) . '</label>';
				echo '<input type="text" id="' . sanitize_html_class( $new_id ) . '" class="gp-input-text gp-small-text" name="' . esc_attr( $new_name ) . '[value]" value="' . esc_attr( $new_value['value'] ) . '" />' . $units_selector;
			echo '</span>';
			
		} elseif ( 'word-spacing' === $key ) {

			echo '<span class="gp-text-field gp-styling-field ' . $field_class . '">';
				echo '<label for="' . sanitize_html_class( $new_id ) . '" class="gp-label">' . esc_html__( 'WordPress Spacing', 'gpur' ) . '</label>';
				echo '<input type="text" id="' . sanitize_html_class( $new_id ) . '" class="gp-input-text gp-small-text" name="' . esc_attr( $new_name ) . '[value]" value="' . esc_attr( $new_value['value'] ) . '" />' . $units_selector;
			echo '</span>';
				
		} elseif ( 'text-transform' === $key ) {
	
			echo '<span class="gp-select-field gp-styling-field ' . $field_class . '">';
				echo '<label for="' . sanitize_html_class( $new_id ) . '" class="gp-label">' . esc_html__( 'Text Transform', 'gpur' ) . '</label>';
				echo '<select id="' . sanitize_html_class( $new_id ) . '" class="post_form" name="' . esc_attr( $new_name ) . '">';
					echo '<option value=""></option>';
					$option_values = array(
						'none' => esc_html__( 'None', 'gpur' ),
						'capitalize' => esc_html__( 'Capitalize', 'gpur' ),
						'uppercase' => esc_html__( 'Uppercase', 'gpur' ),
						'lowercase' => esc_html__( 'Lowercase', 'gpur' ),
						'initial' => esc_html__( 'Initial', 'gpur' ),
						'inherit' => esc_html__( 'Inherit', 'gpur' ),
					);
					foreach( $option_values as $option_key => $option_value ) {
						if ( $new_value === $option_key ) {
							$checked = ' selected="selected"';
						} else {
							$checked = '';
						}
						echo '<option value="' . esc_attr( $option_key ) . '" ' . $checked . '>' . esc_attr( $option_value ) . '</option>';
					}
				echo '</select>';
			echo '</span>';
		
		} elseif ( 'text-align' === $key ) {
	
			echo '<span class="gp-select-field gp-styling-field ' . $field_class . '">';
				echo '<label for="' . sanitize_html_class( $new_id ) . '" class="gp-label">' . esc_html__( 'Text Align', 'gpur' ) . '</label>';
				echo '<select id="' . sanitize_html_class( $new_id ) . '" class="post_form" name="' . esc_attr( $new_name ) . '">';
					echo '<option value=""></option>';
					$option_values = array(
						'inherit' => esc_html__( 'Inherit', 'gpur' ),
						'left' => esc_html__( 'Left', 'gpur' ),
						'right' => esc_html__( 'Right', 'gpur' ),
						'center' => esc_html__( 'Center', 'gpur' ),
						'justify' => esc_html__( 'Justify', 'gpur' ),
						'initial' => esc_html__( 'Initial', 'gpur' ),
                	);
					foreach( $option_values as $option_key => $option_value ) {
						if ( $new_value === $option_key ) {
							$checked = ' selected="selected"';
						} else {
							$checked = '';
						}
						echo '<option value="' . esc_attr( $option_key ) . '" ' . $checked . '>' . esc_attr( $option_value ) . '</option>';
					}
				echo '</select>';
			echo '</span>';
							
		} elseif ( 'text-decoration' === $key ) {
	
			echo '<span class="gp-select-field gp-styling-field ' . $field_class . '">';
				echo '<label for="' . sanitize_html_class( $new_id ) . '" class="gp-label">' . esc_html__( 'Text Decoration', 'gpur' ) . '</label>';
				echo '<select id="' . sanitize_html_class( $new_id ) . '" class="post_form" name="' . esc_attr( $new_name ) . '">';
					echo '<option value=""></option>';
  					$option_values = array(
						'none' => esc_html__( 'None', 'gpur' ),
						'inherit' => esc_html__( 'Inherit', 'gpur' ),
						'underline' => esc_html__( 'Underline', 'gpur' ),
						'overline' => esc_html__( 'Overline', 'gpur' ),
						'line-through' => esc_html__( 'Line Through', 'gpur' ),
						'blink' => esc_html__( 'Blink', 'gpur' ),
					);
					foreach( $option_values as $option_key => $option_value ) {
						if ( $new_value === $option_key ) {
							$checked = ' selected="selected"';
						} else {
							$checked = '';
						}
						echo '<option value="' . esc_attr( $option_key ) . '" ' . $checked . '>' . esc_attr( $option_value ) . '</option>';
					}
				echo '</select>';
			echo '</span>';
			
		}	

	}

}