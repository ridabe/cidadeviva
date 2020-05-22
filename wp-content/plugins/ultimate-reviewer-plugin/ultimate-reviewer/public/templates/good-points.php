<?php if ( ! function_exists( 'gpur_good_points_template' ) ) {
	function gpur_good_points_template( $args ) {	
		
		// Template variables	
		$defaults = array(
			'builder' => 'wpb',
			'atts' => array(),
		);
		$args = wp_parse_args( $args, $defaults );
		extract( $args );

		// Get attributes	
		$atts_defaults = gpur_good_points_shortcode_atts();
		$atts = wp_parse_args( $atts, $atts_defaults );	
		extract( $atts );
		
		// Get correct meta key
		$good_point_meta_key = gpur_get_good_points( get_the_ID() );
					
		// Get icon
		if ( isset( $icon['value'] ) ) { // Elementor
			$icon = $icon['value'];
		}
			
		$unique_id = 'gpur-' . uniqid();
							
		// Classes
		$css_classes = array(
			$unique_id,
			'gpur-element-wrapper',
			'gpur-good-points-wrapper',
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

			// Icon
			if ( $icon_size ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-good-list li i:before {font-size: ' . ghostpool_add_units( $icon_size ) . ';}';
			} 
			if ( $icon_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-good-list li i:before {color: ' . esc_attr( $icon_color ) . ';}';
			} 
			if ( $icon_extra_css ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-good-list li i:before {' . esc_attr( $icon_extra_css ) . '}';
			} 

			// Text
			if ( $text_size ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-good-list li {font-size: ' . ghostpool_add_units( $text_size ) . ';}';
			} 
			if ( $text_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-good-list li {color: ' . esc_attr( $text_color ) . ';}';
			} 
			if ( $text_extra_css ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-good-list li {' . esc_attr( $text_extra_css ) . '}';
			}
					
			wp_register_style( 'gpur-shortcodes', false );
			wp_enqueue_style( 'gpur-shortcodes' );
			wp_add_inline_style( 'gpur-shortcodes', $inline_css );	
		
		}
					
		$output = '<div class="' . esc_attr( $css_classes ) . '">';
			
			if ( $title ) {
				$output .= '<h2 class="gpur-element-title">' . esc_attr( $title ) . '</h2>';
			}
			
			$good_points = get_post_meta( get_the_ID(), $good_point_meta_key, true );
			
			if ( isset( $good_points[0] ) && ! empty( $good_points[0] ) ) {
			
				$output .= '<ul class="gpur-good-list">';
				
					foreach( $good_points as $good_point ) {
						$output .= '<li><i class="' . esc_attr( $icon ) . '"></i>' . esc_attr( $good_point ) . '</li>';
					}
				
				$output .= '</ul>';
				
			}

		$output .= '</div>';
		
		return $output;
		
	}
}