<?php 

/**
 * Options
 *
 */
if ( ! function_exists( 'gpur_wpb_image_options' ) ) {
	function gpur_wpb_image_options() { 
	
		vc_map( array( 
			'name' => esc_html__( 'Image', 'gpur' ),
			'base' => 'gpur_image',
			'description' => '',
			'class' => 'gpur-wpb-image',
			'controls' => 'full',
			'icon' => 'gpur-icon-image',
			'category' => esc_html__( 'Review', 'gpur' ),
			'params' => array(
		
				array( 
					'param_name' => 'image_size',
					'heading' => esc_html__( 'Image Size', 'gpur' ),
					'description' => esc_html__( 'Enter image size e.g. "thumbnail", "medium", "large", "full" or enter size in pixels e.g. 200 x 100 (width x height).', 'gpur' ),
					'type' => 'textfield',
					'value' => 'thumbnail',
				),				
				
				array( 
					'heading' => esc_html__( 'Image Source', 'gpur' ),
					'param_name' => 'image_source',
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Review Image 1', 'gpur' ) => 'review-image-1',
						esc_html__( 'Review Image 2', 'gpur' ) => 'review-image-2',
						esc_html__( 'Featured Image', 'gpur' ) => 'featured-image',
					),
				),	
				
				array(	
					'param_name' => 'image_as_bg',
					'heading' => esc_html__( 'Image As Background', 'gpur' ),
					'description' => esc_html__( 'Your featured or review image will be used as the background for this row.', 'gpur' ),
					'type' => 'checkbox',
					'value' => array( '' => '1' ),
					'std' => '',
				),
							
				array(
					'heading' => esc_html__( 'CSS', 'gpur' ),
					'type' => 'css_editor',
					'param_name' => 'css',
					'group' => esc_html__( 'Advanced', 'gpur' ),
				),
																																													
			 )
		) );
		
	}		
} 
add_action( 'vc_before_init', 'gpur_wpb_image_options' );

/**
 * Shortcode
 *
 */
if ( ! function_exists( 'gpur_image_shortcode' ) ) {
	function gpur_image_shortcode( $atts ) {	
		
		$atts = shortcode_atts( array(
			'image_size' => 'thumbnail',
			'image_source' => 'review-image-1',
			'image_as_bg' => '',
			'css' => '',
		), $atts, 'gpur_image_shortcode' );
		
		// Extract attributes
		extract( $atts );

		ob_start();
		
		// Load template
		echo gpur_image_template( $atts );

		$output = ob_get_contents();
		ob_end_clean();
		return $output;

	}
}
add_shortcode( 'gpur_image', 'gpur_image_shortcode' );