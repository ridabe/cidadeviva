<?php 

/**
 * Options
 *
 */
 if ( ! function_exists( 'gpur_wpb_review_template_options' ) ) {
	function gpur_wpb_review_template_options() { 
	
		vc_map( array( 
			'name' => esc_html__( 'Review Template', 'gpur' ),
			'base' => 'gpur_review_template',
			'class' => 'gpur-wpb-review-template',
			'controls' => 'full',
			'icon' => 'gpur-icon-review-template',
			'category' => esc_html__( 'Review', 'gpur' ),
			'params' => array(		

				array( 
					'heading' => esc_html__( 'Template', 'gpur' ),
					'description' => esc_html__( 'Select the template you want to display.', 'gpur' ),
					'param_name' => 'template_id',
					'admin_label' => true,
					'value' => gpur_templates_dropdown_values(),
					'type' => 'dropdown',
				),
					
				array( 
					'heading' => esc_html__( 'Extra Class Name', 'gpur' ),
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'gpur' ),
					'param_name' => 'classes',
					'type' => 'textfield',
				),	
																																													
			 )
		) );
		
	}		
} 
add_action( 'vc_before_init', 'gpur_wpb_review_template_options' );

/**
 * Shortcode
 *
 */
if ( ! function_exists( 'gpur_review_template_shortcode' ) ) {
	function gpur_review_template_shortcode( $atts ) {	

		$atts = shortcode_atts( gpur_review_template_shortcode_atts(), $atts, 'gpur_review_template_shortcode' );
		
		// Extract attributes
		extract( $atts );
		
		ob_start();
		
		// Load template
		echo gpur_review_template( array( 'atts' => $atts ) );
		
		$output = ob_get_contents();
		ob_end_clean();
		return $output;

	}
}
add_shortcode( 'gpur_review_template', 'gpur_review_template_shortcode' );