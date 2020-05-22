<?php			

echo '<span class="gp-textarea-field">';
	echo '<textarea id="' . sanitize_html_class( $id ) . '" name="' . esc_attr( $name ) . '" type="textarea" cols="" rows="5" class="large-text gp-input-text">' . esc_textarea( $value ) . '</textarea>';
echo '</span>';