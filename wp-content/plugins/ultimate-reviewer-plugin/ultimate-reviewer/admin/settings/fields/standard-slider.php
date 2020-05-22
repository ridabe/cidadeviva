<?php

wp_enqueue_style( 'jquery-ui-theme-smoothness' );
wp_enqueue_script( 'jquery-ui-slider' );
wp_enqueue_script( 'ghostpool-slider-field' );

echo '<div class="gp-slider-field" data-id="' . sanitize_html_class( $id ) . '" data-value="' . floatval( $value ) . '" data-step="' . floatval( $step ) . '" data-min="' . floatval( $min ) . '" data-max="' . floatval( $max ) . '">';
	echo '<input type="text" id="' . sanitize_html_class( $id ) . '" class="gp-input-text gp-small-text" name="' . esc_attr( $name ) . '" value="' . floatval( $value ) . '" />';
	echo '<div id="gp-slider-' . sanitize_html_class( $id ) . '" class="gp-slider"></div>';
echo '</div>';
