<?php		

wp_enqueue_media();
wp_enqueue_script( 'ghostpool-gallery-field' );

echo '<div class="gp-gallery-field" data-id="' . sanitize_html_class( $id ) . '">';

	echo '<div id="gp-gallery-preview-' . sanitize_html_class( $id ) .'" class="gp-gallery-preview">';
	
		if ( is_array( $value ) ) {
			$value = implode( ',', $value );
		}
	
		if ( $value > 0 ) {

			$attachments = explode( ',', $value );
	
			foreach( $attachments as $attachment ) {
				$media_thumb = wp_get_attachment_image_src( $attachment, 'thumbnail' );
				$media_thumb = $media_thumb[0];
				echo '<img src="' . esc_url( $media_thumb ) . '" alt="" />';
			}	

		}	

	echo '</div>';	

	$text = ( $value > 0 ) ? esc_html__( 'Edit Gallery', 'aardvark' ) : esc_html__( 'Add Gallery', 'aardvark' );

	echo '<input type="button" id="gp-gallery-' . sanitize_html_class( $id ) . '" class="gp-media-button button button-primary" value="' . esc_attr( $text ) . '" data-add="' . esc_attr__( 'Add Gallery', 'aardvark' ) . '" data-change="' . esc_attr__( 'Edit Gallery', 'aardvark' ) . '" />';

	$show_class = ( $value > 0 ) ? ' gp-show' : '';
	
	echo '<a class="gp-remove-media-button' . $show_class . '" id="gp-remove-gallery-' . sanitize_html_class( $id ) . '" href="#">' . esc_html__( 'Remove Gallery', 'aardvark' ) . '</a>';

	echo '<input type="hidden" id="' . sanitize_html_class( $id ) . '" name="' . esc_attr( $name ) . '" value="' . esc_attr( $value ) . '" />';

echo '</div>';