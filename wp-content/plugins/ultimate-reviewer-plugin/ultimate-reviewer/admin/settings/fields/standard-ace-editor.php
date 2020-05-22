<?php

wp_enqueue_script( 'ace-editor' );
wp_enqueue_script( 'ace-editor-mode-' . $format );
wp_enqueue_script( 'ghostpool-ace-editor-field' );

echo '<div class="gp-ace-editor-field">';

	echo '<div id="' . sanitize_html_class( $id ) . '" class="gp-ace-editor" data-editor="' . sanitize_html_class( $id ) . '" data-mode="' . esc_attr( $format ) . '"></div>';

	echo '<textarea id="' . sanitize_html_class( $id ) . '-textarea" class="gp-ace-textarea" name="' . esc_attr( $name ) . '" data-textarea="' . sanitize_html_class( $id ) . '-textarea">' . $value . '</textarea>';

echo '</div>';