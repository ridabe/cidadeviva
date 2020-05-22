<?php 

if ( isset( $select2 ) && true === $select2 ) {
	wp_enqueue_style( 'select2css' );
	wp_enqueue_script( 'select2js' );
	$select2_class = ' select2-field';
} else {
	$select2_class = '';
}

if ( ! isset( $link ) ) {
	$link = '';
}

echo '<span class="gp-select-field">';
	
	if ( 'multi' !== $format ) {

		echo '<select id="' . sanitize_html_class( $id ) . '" class="post_form' . $select2_class . '" name="' . esc_attr( $name ) . '"' . $link . '>';
			foreach( $options as $option_value => $option_title ) {	
				if ( $value == $option_value ) {
					$checked = ' selected="selected"';
				} elseif ( FALSE == $value && $default == $option_value ) {
					$checked = ' selected="selected"';
				} else {
					$checked = '';
				}
				echo '<option value="' . esc_attr( $option_value ) . '"' . $checked . '>' . esc_attr( $option_title ) . '</option>';
			}	
		echo '</select>';

	} else {

		echo '<select id="' . sanitize_html_class( $id ) . '" class="post_form' . $select2_class . '" name="' . esc_attr( $name ) . '[]" multiple' . $link . '>';
			foreach( $options as $option_value => $option_title ) {	
				if ( is_array( $value ) && in_array( $option_value, $value ) ) {
					$checked = ' selected="selected"';
				} elseif ( FALSE == $value && is_array( $default ) && in_array( $option_value, $default ) ) {
					$checked = ' selected="selected"';
				} else {
					$checked = '';
				}
				echo '<option value="' . esc_attr( $option_value ) . '"' . $checked . '>' . esc_attr( $option_title ) . '</option>';
			}	
		echo '</select>';

	}

echo '</span>';