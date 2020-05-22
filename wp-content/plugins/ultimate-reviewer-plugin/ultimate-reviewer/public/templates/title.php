<?php if ( ! function_exists( 'gpur_title_template' ) ) {
	function gpur_title_template( $args ) {	

		// Template variables	
		$defaults = array(
			'builder' => 'wpb',
			'atts' => array(),
		);
		$args = wp_parse_args( $args, $defaults );
		extract( $args );

		// Get attributes	
		$atts_defaults = gpur_title_shortcode_atts();
		$atts = wp_parse_args( $atts, $atts_defaults );		
		extract( $atts );
			
		$unique_id = 'gpur-' . uniqid();
					
		// Classes
		$css_classes = array(
			$unique_id,
			'gpur-element-wrapper',
			'gpur-title-wrapper',
		);
		$css_classes = trim( implode( ' ', array_filter( array_unique( $css_classes ) ) ) );
		$css = isset( $css ) ? $css : '';	
		$css_classes = $css_classes . gpur_custom_css_class( $css, ' ' );
				
		// Inline CSS
		if ( 'wpb' === $builder ) {
			
			$inline_css = '';
			
			// Title
			if ( $title_size ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-post-title {font-size: ' . ghostpool_add_units( $title_size ) . ';}';
			} 
			if ( $title_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-post-title, .' . esc_attr( $unique_id ) . ' .gpur-post-title a {color: ' . esc_attr( $title_color ) . ';}';
			}
			if ( $title_hover_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-post-title a:hover {color: ' . esc_attr( $title_hover_color ) . ';}';
			} 
			if ( $title_extra_css ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-post-title {' . esc_attr( $title_extra_css ) . '}';
			}
			
			wp_register_style( 'gpur-shortcodes', false );
			wp_enqueue_style( 'gpur-shortcodes' );
			wp_add_inline_style( 'gpur-shortcodes', $inline_css );
		
		}
		
		$output = '<div class="' . esc_attr( $css_classes ) . '">';

			$output .= '<h3 class="gpur-post-title">';
			
				if ( '1' == $title_link ) {
					$output .= '<a href="' . get_permalink() . '">' . get_the_title() . '</a>';
				} else {
					$output .= get_the_title();
				}
				
			$output .= '</h3>';
			
		$output .= '</div>';
		
		return $output;

	}
}