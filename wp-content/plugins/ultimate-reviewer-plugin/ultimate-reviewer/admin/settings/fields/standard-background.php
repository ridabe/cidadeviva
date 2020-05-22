<?php 

wp_enqueue_media();
wp_enqueue_script( 'wp-color-picker' );
wp_enqueue_script( 'wp-color-picker-alpha' );
wp_enqueue_script( 'ghostpool-color-field' );
wp_enqueue_script( 'ghostpool-media-field' );

$key_order = array(
	'background-color',
	'background-image',
	'background-repeat',
	'background-size',
	'background-attachment',
	'background-position',
	'background-clip',
	'background-origin',
);

$new_order = array();
foreach( $key_order as $key ) {
	if ( isset( $default[$key] ) ) {
		$new_order[$key] = $default[$key];
	}
}

if ( isset( $new_order ) ) {

	foreach( $new_order as $k => $v ) {				

		$new_id = $id . '-' . $k;
		$new_name = $name . '[' . $k . ']';
		$new_value = isset( $value[$k] ) ? $value[$k] : $v;
		$field_class = 'gp-' . $k . '-field';

		if ( 'background-color' === $k ) {

			echo '<span class="gp-color-picker-field gp-styling-field ' . $field_class . '">';
				
				echo '<label for="' . sanitize_html_class( $new_id ) . '" class="gp-label">' . esc_html__( 'Background Color', 'gpur' ) . '</label>';
			
				echo '<input type="text" id="' . sanitize_html_class( $new_id ) . '" class="gp-input-text" name="' . esc_attr( $new_name ) . '" value="' . esc_attr( $new_value ) . '" data-id="' . sanitize_html_class( $new_id ) . '" data-alpha="true" data-default-color="' . esc_attr( $v ) . '" />';

			echo '</span>';

		} elseif ( 'background-image' === $k ) {
		
			echo '<span class="gp-media-field gp-styling-field ' . $field_class . '" data-id="' . sanitize_html_class( $new_id ) . '">';
			
				echo '<label for="' . sanitize_html_class( $new_id ) . '" class="gp-label">' . esc_html__( 'Background Image', 'gpur' ) . '</label>';

				echo '<span id="gp-media-preview-' . sanitize_html_class( $new_id ) .'" class="gp-media-preview">';
					if ( $new_value ) {	
						if ( is_numeric( $new_value ) ) {					
							$media_thumb = wp_get_attachment_image_src( $new_value, 'thumbnail' );
							$media_thumb = $media_thumb[0];
						} else {
							$media_thumb = $new_value;
						}		
						echo '<img src="' . esc_url( $media_thumb ) . '" class="gp-image-thumbnail" alt="" />';
					}
				echo '</span>';

				$text = ( '' !== $new_value ) ? esc_html__( 'Change Image', 'gpur' ) : esc_html__( 'Add Image', 'gpur' );

				echo '<input type="button" id="gp-media-' . sanitize_html_class( $new_id ) . '" class="gp-media-button button button-primary" value="' . esc_attr( $text ) . '" data-add="' . esc_attr__( 'Add Image', 'gpur' ) . '" data-change="' . esc_attr__( 'Change Image', 'gpur' ) . '" />';

				$show_class = ( '' !== $new_value ) ? ' gp-show' : '';
				echo '<a class="gp-remove-media-button' . $show_class . '" id="gp-remove-media-' . sanitize_html_class( $new_id ) . '" href="#">' . esc_html__( 'Remove Image', 'gpur' ) . '</a>';
		
				echo '<input type="hidden" id="' . sanitize_html_class( $new_id ) . '" name="' . esc_attr( $new_name ) . '" value="' . esc_attr( $new_value ) . '" />';
			
			echo '</span>';	
										
		} elseif ( 'background-repeat' === $k ) {
	
			echo '<span class="gp-select-field gp-styling-field ' . $field_class . '">';
				echo '<label for="' . sanitize_html_class( $new_id ) . '" class="gp-label">' . esc_html__( 'Background Repeat', 'gpur' ) . '</label>';
				echo '<select id="' . sanitize_html_class( $new_id ) . '" class="post_form" name="' . esc_attr( $new_name ) . '">';
  					$option_values = array(
						'no-repeat' => esc_html__( 'No Repeat', 'gpur' ),
                        'repeat'    => esc_html__( 'Repeat All', 'gpur' ),
                        'repeat-x'  => esc_html__( 'Repeat Horizontally', 'gpur' ),
                        'repeat-y'  => esc_html__( 'Repeat Vertically', 'gpur' ),
                        'inherit'   => esc_html__( 'Inherit', 'gpur' ),
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
				
		} elseif ( 'background-size' === $k ) {
	
			echo '<span class="gp-select-field gp-styling-field ' . $field_class . '">';
				echo '<label for="' . sanitize_html_class( $new_id ) . '" class="gp-label">' . esc_html__( 'Background Size', 'gpur' ) . '</label>';
				echo '<select id="' . sanitize_html_class( $new_id ) . '" class="post_form" name="' . esc_attr( $new_name ) . '">';
  					$option_values = array(
						'inherit' => esc_html__( 'Inherit', 'gpur' ),
                        'cover'   => esc_html__( 'Cover', 'gpur' ),
                        'contain' => esc_html__( 'Contain', 'gpur' ),
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
										
		} elseif ( 'background-attachment' === $k ) {
	
			echo '<span class="gp-select-field gp-styling-field ' . $field_class . '">';
				echo '<label for="' . sanitize_html_class( $new_id ) . '" class="gp-label">' . esc_html__( 'Background Attachment', 'gpur' ) . '</label>';
				echo '<select id="' . sanitize_html_class( $new_id ) . '" class="post_form" name="' . esc_attr( $new_name ) . '">';
  					$option_values = array(
						'fixed'   => esc_html__( 'Fixed', 'gpur' ),
						'scroll'  => esc_html__( 'Scroll', 'gpur' ),
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
			
		} elseif ( 'background-position' === $k ) {
	
			echo '<span class="gp-select-field gp-styling-field ' . $field_class . '">';
				echo '<label for="' . sanitize_html_class( $new_id ) . '" class="gp-label">' . esc_html__( 'Background Position', 'gpur' ) . '</label>';
				echo '<select id="' . sanitize_html_class( $new_id ) . '" class="post_form" name="' . esc_attr( $new_name ) . '">';
  					$option_values = array(
						'left top'      => esc_html__( 'Left Top', 'gpur' ),
                        'left center'   => esc_html__( 'Left center', 'gpur' ),
                        'left bottom'   => esc_html__( 'Left Bottom', 'gpur' ),
                        'center top'    => esc_html__( 'Center Top', 'gpur' ),
                        'center center' => esc_html__( 'Center Center', 'gpur' ),
                        'center bottom' => esc_html__( 'Center Bottom', 'gpur' ),
                        'right top'     => esc_html__( 'Right Top', 'gpur' ),
                        'right center'  => esc_html__( 'Right Center', 'gpur' ),
                        'right bottom'  => esc_html__( 'Right Bottom', 'gpur' ),
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
			
		} elseif ( 'background-clip' === $k ) {
	
			echo '<span class="gp-select-field gp-styling-field ' . $field_class . '">';
				echo '<label for="' . sanitize_html_class( $new_id ) . '" class="gp-label">' . esc_html__( 'Background Clip', 'gpur' ) . '</label>';
				echo '<select id="' . sanitize_html_class( $new_id ) . '" class="post_form" name="' . esc_attr( $new_name ) . '">';
					echo '<option value=""></option>';
  					$option_values = array(
						'inherit'     => esc_html__( 'Inherit', 'gpur' ),
                        'border-box'  => esc_html__( 'Border Box', 'gpur' ),
                        'content-box' => esc_html__( 'Content Box', 'gpur' ),
                        'padding-box' => esc_html__( 'Padding Box', 'gpur' ),
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
			
		} elseif ( 'background-origin' === $k ) {
	
			echo '<span class="gp-select-field gp-styling-field ' . $field_class . '">';
				echo '<label for="' . sanitize_html_class( $new_id ) . '" class="gp-label">' . esc_html__( 'Background Origin', 'gpur' ) . '</label>';
				echo '<select id="' . sanitize_html_class( $new_id ) . '" class="post_form" name="' . esc_attr( $new_name ) . '">';
					echo '<option value=""></option>';
  					$option_values = array(
						'inherit'     => esc_html__( 'Inherit', 'gpur' ),
                        'border-box'  => esc_html__( 'Border Box', 'gpur' ),
                        'content-box' => esc_html__( 'Content Box', 'gpur' ),
                        'padding-box' => esc_html__( 'Padding Box', 'gpur' ),
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