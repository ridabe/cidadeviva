<?php if ( ! function_exists( 'gpur_review_template' ) ) {
	function gpur_review_template( $args ) {	

		// Template variables	
		$defaults = array(
			'builder' => 'wpb',
			'atts' => array(),
		);
		$args = wp_parse_args( $args, $defaults );
		extract( $args );
				
		// Get attributes
		$atts_defaults = gpur_review_template_shortcode_atts();
		$atts = wp_parse_args( $atts, $atts_defaults );
		extract( $atts );
		
		// If there's no review ID, bail
		if ( ! $template_id ) {
			return;
		}
		
		// If it's not a review template, bail
		if ( 'gpur-template' !== get_post_type( $template_id ) ) {
			return;
		}
		
		if ( 'wpb' === $builder ) {
		
			// Get review template data
			$post = get_post( $template_id );
				
			// Load custom CSS from review template	
			$inline_css = get_post_meta( $post->ID, '_wpb_shortcodes_custom_css', true );	
			wp_register_style( 'gpur-shortcodes', false );
			wp_enqueue_style( 'gpur-shortcodes' );
			wp_add_inline_style( 'gpur-shortcodes', $inline_css );
		
		}
				
		$unique_id = 'gpur-' . uniqid();
						
		// Classes
		$css_classes = array(
			$unique_id,
			'gpur-element-wrapper',
			'gpur-review-template-wrapper',
			$classes,
		);
		$css_classes = trim( implode( ' ', array_filter( array_unique( $css_classes ) ) ) );		
		$css = isset( $css ) ? $css : '';	
		$css_classes = $css_classes . gpur_custom_css_class( $css, ' ' );

		$output = '<div class="' . esc_attr( $css_classes ) . '">';
		
			if ( 'wpb' === $builder ) {
				$output .= do_shortcode( $post->post_content );
			} elseif ( defined( 'ELEMENTOR_VERSION' ) ) {
				$output .= \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $template_id );
			}
						
		$output .= '</div>';
		
		return $output;

		wp_reset_postdata();

	}
}