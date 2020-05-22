<?php if ( ! function_exists( 'gpur_review_button_template' ) ) {
	function gpur_review_button_template( $args ) {

		// Template variables	
		$defaults = array(
			'builder' => 'wpb',
			'atts' => array(),
		);
		$args = wp_parse_args( $args, $defaults );
		extract( $args );

		// Get attributes	
		$atts_defaults = gpur_review_button_shortcode_atts();
		$atts = wp_parse_args( $atts, $atts_defaults );	
		extract( $atts );
		
		// Button Text
		if ( get_post_meta( get_the_ID(), 'gpur_review_button_text', true ) ) {
			$text = get_post_meta( get_the_ID(), 'gpur_review_button_text', true );
		}
		$text = '<span class="gpur-review-button-text">' . $text . '</span>';
		
		// Button Link
		if ( get_post_meta( get_the_ID(), 'gpur_review_button_link', true ) ) {
			$url = get_post_meta( get_the_ID(), 'gpur_review_button_link', true );
			$nofollow = '';
		} elseif ( is_array( $link ) ) { // Elementor
			$url = $link['url'];
			$is_external = $link['is_external'];
			$nofollow = $link['nofollow'];
		} else { // WPB
			$url = $link;
			$is_external = '1' == $is_external ? ' target="_blank"' : '';
			$nofollow = '1' == $nofollow ? ' rel="nofollow"' : '';
		}
		
		// Icon
		$icon_display = '';
		if ( isset( $icon['value'] ) && '' != $icon['value'] ) { // Elementor
			$icon_display = '<i class="' . $icon['value'] . '"></i>';
		} elseif ( ! is_array( $icon ) && '' != $icon ) { // WPB
			$icon_display = '<i class="' . $icon . '"></i>';
		}
		
		$unique_id = 'gpur-' . uniqid();
																							
		// Classes
		$css_classes = array(
			$unique_id,
			'gpur-button-wrapper',
			'gpur-' . $button_alignment,
			'gpur-' . $icon_alignment,
		);
		$css_classes = trim( implode( ' ', array_filter( array_unique( $css_classes ) ) ) );		
		$css = isset( $css ) ? $css : '';	
		$css_classes = $css_classes . gpur_custom_css_class( $css, ' ' );
	
		// Inline CSS
		if ( 'wpb' === $builder ) {
			
			$inline_css = '';
	
			// Button padding width
			if ( $button_padding_width ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-review-button {padding-left: ' . ghostpool_add_units( $button_padding_width ) . '; padding-right: ' . ghostpool_add_units( $button_padding_width ) . ';}';
			}

			// Button padding height
			if ( $button_padding_height ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-review-button {padding-top: ' . ghostpool_add_units( $button_padding_height ) . '; padding-bottom: ' . ghostpool_add_units( $button_padding_height ) . ';}';
			}
					
			// Button color
			if ( $button_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-review-button {background-color: ' . esc_attr( $button_color ) . ';}';
			}
	
			// Button hover color
			if ( $button_hover_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-review-button:hover {background-color: ' . esc_attr( $button_hover_color ) . ';}';
			}
	
			// Text size
			if ( $text_size ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-review-button-text {font-size: ' . ghostpool_add_units( $text_size ) . ';}';
			}
	
			// Text color
			if ( $text_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-review-button .gpur-review-button-text {color: ' . esc_attr( $text_color ) . ';}';
			}
	
			// Text hover color
			if ( $text_hover_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-review-button:hover .gpur-review-button-text {color: ' . esc_attr( $text_hover_color ) . ';}';
			}
	
			// Border width
			if ( $border_width ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-review-button {border-width: ' . ghostpool_add_units( $border_width ) . ';}';
			}
	
			// Border radius
			if ( $border_radius ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-review-button {border-radius: ' . ghostpool_add_units( $border_radius ) . ';}';
			}
	
			// Border color
			if ( $border_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-review-button {border-color: ' . esc_attr( $border_color ) . ';}';
			}
	
			// Border hover color
			if ( $border_hover_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-review-button:hover {border-color: ' . esc_attr( $border_hover_color ) . ';}';
			}
	
			// Icon size
			if ( $icon_size ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-review-button i {font-size: ' . esc_attr( $icon_size ) . ';}';
			}
	
			// Icon color
			if ( $icon_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-review-button i {color: ' . esc_attr( $icon_color ) . ';}';
			}
	
			// Icon hover color
			if ( $icon_hover_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-review-button:hover i {color: ' . esc_attr( $icon_hover_color ) . ';}';
			}
		
			wp_register_style( 'gpur-shortcodes', false );
			wp_enqueue_style( 'gpur-shortcodes' );
			wp_add_inline_style( 'gpur-shortcodes', $inline_css );
		
		}
				
		$output = '<div class="' . esc_attr( $css_classes ) . '">';
		
			if ( $url ) {
				$output .= '<a href="' . esc_url( $url ) . '" class="gpur-review-button"' . $nofollow . $is_external . '>' . wp_kses_post( $icon_display . $text ) . '</a>';
			} else {
				$output .= '<div class="gpur-review-button">' . wp_kses_post( $icon_display . $text ) . '</div>';
			}
		
		$output .= '</div><div class="gp-clear"></div>';

		return $output;

	}
}