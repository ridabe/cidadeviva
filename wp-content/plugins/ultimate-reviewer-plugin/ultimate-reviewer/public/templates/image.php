<?php if ( ! function_exists( 'gpur_image_template' ) ) {
	function gpur_image_template( $atts ) {	
	
		// Get attributes		
		extract( $atts );
		
		// Get image ID
		if ( 'review-image-1' === $image_source ) {
			$image_id = get_post_meta( get_the_ID(), 'gpur_review_image_1', true );
		} elseif ( 'review-image-2' === $image_source ) {
			$image_id = get_post_meta( get_the_ID(), 'gpur_review_image_2', true );
		} elseif ( 'featured-image' === $image_source ) {
			$image_id = get_post_thumbnail_id( get_the_ID() );
		}

		$style = '';
		$image = '';
		if ( $image_id > 0 ) {
			if ( 1 == $image_as_bg ) {
				$image_url = wp_get_attachment_image_src( $image_id, gpur_image_dimensions( $image_size ) );
				$style = ' style="background-image: url(' . $image_url[0] . ');"';
			} else {
				$image = wp_get_attachment_image( $image_id, gpur_image_dimensions( $image_size ) );
			}
		}
		
		$unique_id = 'gpur-' . uniqid();
												
		// Classes
		$css_classes = array(
			$unique_id,
			'gpur-element-wrapper',
			'gpur-image-wrapper',
			( 1 == $image_as_bg ) ? 'gpur-image-background' : '',
		);
		$css_classes = trim( implode( ' ', array_filter( array_unique( $css_classes ) ) ) );
		$css = isset( $css ) ? $css : '';	
		$css_classes = $css_classes . gpur_custom_css_class( $css, ' ' );

		$output = '<div class="' . esc_attr( $css_classes ) . '"' . wp_kses_post( $style ) . '>';
			
			if ( $image ) {
				$output .= '<div class="gpur-review-image">';
					$output .= wp_kses_post( $image );
				$output .= '</div>';
			}
						
		$output .= '</div>';
		
		return $output;

	}
}