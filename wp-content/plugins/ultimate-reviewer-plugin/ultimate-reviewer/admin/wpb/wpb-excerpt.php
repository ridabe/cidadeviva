<?php 

/**
 * Options
 *
 */
if ( ! function_exists( 'gpur_wpb_excerpt_options' ) ) {
	function gpur_wpb_excerpt_options() { 
	
		vc_map( array( 
			'name' => esc_html__( 'Excerpt', 'gpur' ),
			'base' => 'gpur_excerpt',
			'description' => '',
			'class' => 'gpur-wpb-excerpt',
			'controls' => 'full',
			'icon' => 'gpur-icon-excerpt',
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
					'heading' => esc_html__( 'Color', 'gpur' ),
					'param_name' => 'title_color',
					'type' => 'colorpicker',
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
					'param_name' => 'text_header',
					'heading' => esc_html__( 'Text', 'gpur' ),
					'type' => 'gpur_header',
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
					'heading' => esc_html__( 'Color', 'gpur' ),
					'param_name' => 'text_color',
					'type' => 'colorpicker',
					'value' => '',
					'group' => esc_html__( 'Text', 'gpur' ),
				),
				array( 
					'heading' => esc_html__( 'Extra CSS', 'gpur' ),
					'param_name' => 'text_extra_css',
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
add_action( 'vc_before_init', 'gpur_wpb_excerpt_options' );	

/**
 * Shortcode
 *
 */
if ( ! function_exists( 'gpur_excerpt_shortcode' ) ) {
	function gpur_excerpt_shortcode( $atts ) {	
		
		$atts = shortcode_atts( gpur_excerpt_shortcode_atts(), $atts, 'gpur_excerpt_shortcode' );
		
		// Extract attributes
		extract( $atts );

		ob_start();

		// Load template
		echo gpur_excerpt_template( array( 'atts' => $atts ) );

		$output = ob_get_contents();
		ob_end_clean();
		return $output;

	}
}
add_shortcode( 'gpur_excerpt', 'gpur_excerpt_shortcode' );