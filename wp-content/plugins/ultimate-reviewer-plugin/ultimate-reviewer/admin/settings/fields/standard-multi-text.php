<?php

wp_enqueue_script( 'ghostpool-multi-text-field' );

echo '<div class="gp-multi-text-field" data-id="' . sanitize_html_class( $id ) . '">';

	if ( $value && is_array( $value ) ) {

		foreach ( $value as $field ) {

			echo '<div class="gp-multi-text-input">';		
				echo '<input type="text" id="' . sanitize_html_class( $id ) . '" name="' . esc_attr( $name ) . '[]" value="' . esc_attr( $field ) . '" class="regular-text gp-input-text gp-multi-text-value" />';
				echo '<a id="gp-remove-row-' . sanitize_html_class( $id ) . '" class="gp-remove-row button button-small" href="#">' . esc_html__( 'Remove', 'gpur' ) . '</a>';
			echo '</div>';

		}

	} else {

		echo '<div class="gp-multi-text-input">';		
			echo '<input type="text" id="' . sanitize_html_class( $id ) . '" name="' . esc_attr( $name ) . '[]" value="" class="regular-text gp-input-text gp-multi-text-value" />';
			echo '<a id="gp-remove-row-' . sanitize_html_class( $id ) . '" class="gp-remove-row button button-small" href="#">' . esc_html__( 'Remove', 'gpur' ) . '</a>';
		echo '</div>';	

	}

	echo '<div class="gp-hide screen-reader-text gp-multi-text-input">';
		echo '<input type="text" id="' . sanitize_html_class( $id ) . '" name="' . esc_attr( $name ) . '[]" value="" class="regular-text gp-input-text" />';
		echo '<a id="gp-remove-row-' . sanitize_html_class( $id ) . '" class="gp-remove-row button button-small" href="#">' . esc_html__( 'Remove', 'gpur' ) . '</a>';
	echo '</div>';

	echo '<a id="gp-add-row-' . sanitize_html_class( $id ) . '" class="gp-add-row button button-primary" href="#">' . esc_html__( 'Add Another', 'gpur' ) . '</a>';

echo '</div>';