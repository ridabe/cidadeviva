<?php

wp_enqueue_script( 'ghostpool-image-select-field' );

echo '<ul id="' . sanitize_html_class( $id ) . '" class="gp-image-select-field">';

	foreach( $options as $option_value => $option ) {	

		$img_class = 'gp-image-select';
		$checked = '';
		if ( ! isset( $value ) && $default === $option_value ) {
			$img_class .= ' gp-active';
			$checked = ' checked="checked" ';
		} elseif ( isset( $value ) && $value === $option_value ) {
			$img_class .= ' gp-active';
			$checked = ' checked="checked" ';
		}	
		
		echo '<li><img src="' .  esc_url( $option['img'] ) . '" class="' . $img_class . '" alt="' .  esc_attr( $option[0] ) . '" /><input type="radio" name="' . esc_attr( $name ) . '" value="' . esc_attr( $option_value ) . '"' . $checked . '/>' . esc_attr( $option[0] )  . '</li>';
	}

echo '</ul>';	