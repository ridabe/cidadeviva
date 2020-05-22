<?php 

// Validation
if ( 'url' === $validate ) {
	$value = esc_url( $value );
} else {
	$value = esc_attr( $value );
}

echo '<span class="gp-text-field">';
	echo '<input type="text" id="' . sanitize_html_class( $id ) . '" name="' . esc_attr( $name ) . '" value="' . $value . '" class="large-text gp-input-text" />';
echo '</span>';