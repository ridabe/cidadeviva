<?php 

wp_enqueue_media();
wp_enqueue_script( 'ghostpool-media-field' );

echo '<div class="gp-media-field" data-id="' . sanitize_html_class( $id ) . '">';
		
	if ( 'audio' === $format ) {			

		echo '<div id="gp-media-preview-' . sanitize_html_class( $id ) .'" class="gp-media-preview">';
			if ( $value > 0 ) {
				echo '<img src="' . includes_url( '/images/media/audio.png' ) . '" class="gp-audio-video-thumbnail" alt="" />';
				echo '<strong>' . basename( get_attached_file( $value ) ) . '</strong>';
			}
		echo '</div>';

		$text = ( $value > 0 ) ? esc_html__( 'Change Audio', 'gpur' ) : esc_html__( 'Add Audio', 'gpur' );

		echo '<input type="button" id="gp-media-' . sanitize_html_class( $id ) . '" class="gp-media-button button button-primary" value="' . esc_attr( $text ) . '" data-add="' . esc_attr__( 'Add Audio', 'gpur' ) . '" data-change="' . esc_attr__( 'Change Audio', 'gpur' ) . '" />';

		$show_class = ( $value > 0 ) ? ' gp-show' : '';
		echo '<a class="gp-remove-media-button' . $show_class . '" id="gp-remove-media-' . sanitize_html_class( $id ) . '" href="#">' . esc_html__( 'Remove Audio', 'gpur' ) . '</a>';

	} elseif ( 'video' === $format ) {			

		echo '<div id="gp-media-preview-' . sanitize_html_class( $id ) .'" class="gp-media-preview">';
			if ( $value > 0 ) {
				echo '<img src="' . includes_url( '/images/media/video.png' ) . '" class="gp-audio-video-thumbnail" alt="" />';
				echo '<strong>' . basename( get_attached_file( $value ) ) . '</strong>';
			}
		echo '</div>';

		$text = ( $value > 0 ) ? esc_html__( 'Change Video', 'gpur' ) : esc_html__( 'Add Video', 'gpur' );

		echo '<input type="button" id="gp-media-' . sanitize_html_class( $id ) . '" class="gp-media-button button button-primary" value="' . esc_attr( $text ) . '" data-add="' . esc_attr__( 'Add Video', 'gpur' ) . '" data-change="' . esc_attr__( 'Change Video', 'gpur' ) . '" />';

		$show_class = ( $value > 0 ) ? ' gp-show' : '';
		echo '<a class="gp-remove-media-button' . $show_class . '" id="gp-remove-media-' . sanitize_html_class( $id ) . '" href="#">' . esc_html__( 'Remove Video', 'gpur' ) . '</a>';

	} else {			
	
		echo '<div id="gp-media-preview-' . sanitize_html_class( $id ) .'" class="gp-media-preview">';	
			if ( $value ) {							
				if ( is_numeric( $value ) ) {			
					$media_thumb = wp_get_attachment_image_src( $value, 'thumbnail' );
					$media_thumb = $media_thumb[0];
				} else {
					$media_thumb = $value;
				}		
				echo '<img src="' . esc_url( $media_thumb ) . '" class="gp-image-thumbnail" alt="" />';
			} elseif ( '' !== $default && ! is_numeric( $default ) ) {
				echo '<img src="' . esc_url( $default ) . '" class="gp-image-thumbnail" alt="" />';
			}
		echo '</div>';

		$text = ( '' !== $value ) ? esc_html__( 'Change Image', 'gpur' ) : esc_html__( 'Add Image', 'gpur' );

		echo '<input type="button" id="gp-media-' . sanitize_html_class( $id ) . '" class="gp-media-button button button-primary" value="' . esc_attr( $text ) . '" data-add="' . esc_attr__( 'Add Image', 'gpur' ) . '" data-change="' . esc_attr__( 'Change Image', 'gpur' ) . '" />';

		$show_class = ( '' !== $value ) ? ' gp-show' : '';
		echo '<a class="gp-remove-media-button' . $show_class . '" id="gp-remove-media-' . sanitize_html_class( $id ) . '" href="#">' . esc_html__( 'Remove Image', 'gpur' ) . '</a>';
		
	}
	echo '<input type="hidden" id="' . sanitize_html_class( $id ) . '" name="' . esc_attr( $name ) . '" value="' . esc_attr( $value ) . '" />';
	
echo '</div>';	
