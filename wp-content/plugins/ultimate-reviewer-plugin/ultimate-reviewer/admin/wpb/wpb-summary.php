<?php 

/**
 * Options
 *
 */
if ( ! function_exists( 'gpur_wpb_summary_options' ) ) {
	function gpur_wpb_summary_options() { 
	
		vc_map( array( 
			'name' => esc_html__( 'Summary', 'gpur' ),
			'base' => 'gpur_summary',
			'description' => '',
			'class' => 'gpur-wpb-summary',
			'controls' => 'full',
			'icon' => 'gpur-icon-summary',
			'category' => esc_html__( 'Review', 'gpur' ),
			'params' => array(	
	
				/*--------------------------------------------------------------
				Title
				--------------------------------------------------------------*/
			
				array( 
					'heading' => esc_html__( 'Title', 'gpur' ),
					'param_name' => 'title',
					'type' => 'textfield',
					'admin_label' => true,
					'value' => esc_html__( 'Summary', 'gpur' ),
					'group' => esc_html__( 'Title', 'gpur' ),
				),
				
				array( 
					'heading' => esc_html__( 'Color', 'gpur' ),
					'param_name' => 'title_color',
					'type' => 'colorpicker',
					'value' => '',
					'group' => esc_html__( 'Title', 'gpur' ),
				),
				
				array( 
					'heading' => esc_html__( 'Size (px)', 'gpur' ),
					'param_name' => 'title_size',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Title', 'gpur' ),
				),
				
				array( 
					'heading' => esc_html__( 'Extra CSS', 'gpur' ),
					'param_name' => 'title_extra_css',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Title', 'gpur' ),
				),
		
				/*--------------------------------------------------------------
				Text
				--------------------------------------------------------------*/
				
				array( 
					'heading' => esc_html__( 'Color', 'gpur' ),
					'param_name' => 'text_color',
					'type' => 'colorpicker',
					'value' => '',
					'group' => esc_html__( 'Text', 'gpur' ),
				),
				
				array( 
					'heading' => esc_html__( 'Size (px)', 'gpur' ),
					'param_name' => 'text_size',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Text', 'gpur' ),
				),
				
				array( 
					'heading' => esc_html__( 'Extra CSS', 'gpur' ),
					'param_name' => 'text_css',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Text', 'gpur' ),
				),	
				
				/*--------------------------------------------------------------
				Advanced
				--------------------------------------------------------------*/
		
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
add_action( 'vc_before_init', 'gpur_wpb_summary_options' );

/**
 * Shortcode
 *
 */
if ( ! function_exists( 'gpur_summary_shortcode' ) ) {
	function gpur_summary_shortcode( $atts ) {	
		
		$atts = shortcode_atts( gpur_summary_shortcode_atts(), $atts, 'gpur_summary_shortcode' );
		
		// Extract attributes
		extract( $atts );

		ob_start();
		
		// Load template
		echo gpur_summary_template( array( 'atts' => $atts ) );

		$output = ob_get_contents();
		ob_end_clean();
		return $output;

	}
}
add_shortcode( 'gpur_summary', 'gpur_summary_shortcode' );