<?php if ( ! function_exists( 'gpur_summary_template' ) ) {
	function gpur_summary_template( $args ) {	

		// Template variables	
		$defaults = array(
			'builder' => 'wpb',
			'atts' => array(),
		);
		$args = wp_parse_args( $args, $defaults );
		extract( $args );

		// Get attributes	
		$atts_defaults = gpur_summary_shortcode_atts();
		$atts = wp_parse_args( $atts, $atts_defaults );
		extract( $atts );
		
		// Get correct meta key
		$summary_meta_key = gpur_get_summary( get_the_ID() );
			
		$unique_id = 'gpur-' . uniqid();
															
		// Classes
		$css_classes = array(
			$unique_id,
			'gpur-element-wrapper',
			'gpur-summary-wrapper',
		);
		$css_classes = trim( implode( ' ', array_filter( array_unique( $css_classes ) ) ) );
		$css = isset( $css ) ? $css : '';	
		$css_classes = $css_classes . gpur_custom_css_class( $css, ' ' );

		// Inline CSS
		if ( 'wpb' === $builder ) {
			
			$inline_css = '';
	
			// Title
			if ( $title_size ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-element-title {font-size: ' . ghostpool_add_units( $title_size ) . ';}';
			} 
			if ( $title_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-element-title {color: ' . esc_attr( $title_color ) . ';}';
			} 
			if ( $title_extra_css ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-element-title {' . esc_attr( $title_extra_css ) . '}';
			} 

			// Text
			if ( $text_size ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-summary-text {font-size: ' . ghostpool_add_units( $text_size ) . ';}';
			} 
			if ( $text_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-summary-text {color: ' . esc_attr( $text_color ) . ';}';
			} 
			if ( $text_extra_css ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-summary-text {' . esc_attr( $text_extra_css ) . '}';
			}
		
			wp_register_style( 'gpur-shortcodes', false );
			wp_enqueue_style( 'gpur-shortcodes' );
			wp_add_inline_style( 'gpur-shortcodes', $inline_css );
		
		}
		
		$output = '<div class="' . esc_attr( $css_classes ) . '">';
			
			if ( $title ) {
				$output .= '<h2 class="gpur-element-title">' . esc_attr( $title ) . '</h2>';
			}
			
			$output .= '<div class="gpur-summary-text">';
				$output .= wp_kses_post( get_post_meta( get_the_ID(), $summary_meta_key, true ) );
			$output .= '</div>';
			
		$output .= '</div>';
		
		return $output;

	}
}