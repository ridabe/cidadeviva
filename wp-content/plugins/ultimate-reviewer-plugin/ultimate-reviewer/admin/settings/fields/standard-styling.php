<?php

if ( isset( $styling ) ) {

	foreach( $styling as $k => $v ) {	
	
		$new_id = $id . '-' . $k;
		$new_name = $name . '[' . $k . ']';		
		$new_value = isset( $value[$k] ) ? $value[$k] : $v['default'];
		$title = isset( $v['title'] ) ? $v['title'] : '';

		if ( 'dimensions' === $v['type'] ) {

			if ( is_array( $v['default'] ) ) {

				foreach( $v['default'] as $k => $v ) {

					$new_id = $new_id . '-' . $k;
					$new_name = $new_name . '[' . $k . ']';
					$new_value = isset( $new_value[$k] ) ? $new_value[$k] : $v;
	
					echo '<span class="gp-styling-field gp-dimensions-field">';
						echo '<label for="' . sanitize_html_class( $new_id ) . '" class="gp-label">' . esc_attr( $title ) . '</label>';
						echo '<input type="text" id="' . sanitize_html_class( $new_id ) . '" class="gp-input-text gp-small-text" name="' . esc_attr( $new_name ) . '" value="' . esc_attr( $new_value ) . '" /><span class="gp-units">' . $units . '</span>';
					echo '</span>';
	
				}

			} else {
			
				echo '<span class="gp-styling-field gp-dimensions-field">';
					echo '<label for="' . sanitize_html_class( $new_id ) . '" class="gp-label">' . esc_attr( $title ) . '</label>';
					echo '<input type="text" id="' . sanitize_html_class( $new_id ) . '" class="gp-input-text gp-small-text" name="' . esc_attr( $new_name ) . '" value="' . esc_attr( $new_value ) . '" /><span class="gp-units">' . $units . '</span>';
				echo '</span>';
		
			}

		} elseif ( 'color' === $v['type'] ) {
			
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'wp-color-picker' );
			wp_enqueue_script( 'ghostpool-color-field' );
			
			echo '<span class="gp-styling-field gp-color-picker-field"><label for="' . sanitize_html_class( $new_id ) . '" class="gp-label">' . esc_attr( $title ) . '</label><input type="text" id="' . sanitize_html_class( $new_id ) . '" class="gp-input-text" name="' . esc_attr( $new_name ) . '" value="' . esc_attr( $new_value ) . '" data-id="' . sanitize_html_class( $new_id ) . '" /></span>';

		} elseif ( 'color_rgba' === $v['type'] ) {

			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'wp-color-picker' );
			wp_enqueue_script( 'wp-color-picker-alpha' );
			wp_enqueue_script( 'ghostpool-color-field' );
			
			echo '<span class="gp-styling-field gp-color-picker-field"><label for="' . sanitize_html_class( $new_id ) . '" class="gp-label">' . esc_attr( $title ) . '</label><input type="text" id="' . sanitize_html_class( $new_id ) . '" class="gp-input-text" name="' . esc_attr( $new_name ) . '" value="' . esc_attr( $new_value ) . '" data-id="' . sanitize_html_class( $new_id ) . '" data-alpha="true" data-default-color="' . esc_attr( $v['default'] ) . '" /></span>';
			
		} elseif ( 'icon' === $v['type'] ) {
		
			wp_enqueue_style( 'font-awesome' );
			wp_enqueue_style( 'fontawesome5' );
			wp_enqueue_script( 'ghostpool-icon-field' );

			echo '<span class="gp-styling-field gp-icon-field"><label for="' . sanitize_html_class( $new_id ) . '" class="gp-label">' . esc_attr( $title ) . '</label><span class="gp-icon-wrapper gp-closed">';
				
				$selected_icon = isset( $new_value ) ? '<i class="' . esc_attr( $new_value ) . '"></i>' : '';
				echo '<span class="gp-open-icons-box">' . wp_kses_post( $selected_icon ) . '<span class="gp-icon-box-arrow"></span></span>';

				echo '<span class="gp-icon-box">';
					
					foreach( ghostpool_icons() as $icon ) {		   
						echo '<a href="' . esc_attr( $icon ) . '" class="gp-icon-link"><i class="' . esc_attr( $icon ) . '"></i></a>';		
					}

				echo '</span>';

				echo '<input type="hidden" id="' . sanitize_html_class( $new_id ) . '"  class="gp-selected-icon" name="' . esc_attr( $new_name ) . '" value="' . esc_attr( $new_value ) . '" />';    

			echo '</span></span>';

		} elseif ( 'media' === $v['type'] ) {

			wp_enqueue_media();
			wp_enqueue_script( 'ghostpool-media-field' );
			
			echo '<span class="gp-styling-field gp-media-field" data-id="' . sanitize_html_class( $new_id ) . '">';
			
				echo '<label for="' . sanitize_html_class( $new_id ) . '" class="gp-label">' . esc_attr( $title ) . '</label>';
		
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
			
			echo '</span>';	
			echo '<input type="hidden" id="' . sanitize_html_class( $new_id ) . '" name="' . esc_attr( $new_name ) . '" value="' . esc_attr( $new_value ) . '" />';
			
		} elseif ( 'extra_css' === $v['type'] ) {

			echo '<span class="gp-styling-field gp-extra-css-field"><label for="' . sanitize_html_class( $new_id ) . '" class="gp-label">' . esc_attr( $title ) . '</label><input type="text" class="gp-input-text" id="' . sanitize_html_class( $new_id ) . '" name="' . esc_attr( $new_name ) . '" value="' . esc_attr( $new_value ) . '" /></span>';

		}
		
	}
	
	echo '<div class="gp-clear"></div>';
		
}		