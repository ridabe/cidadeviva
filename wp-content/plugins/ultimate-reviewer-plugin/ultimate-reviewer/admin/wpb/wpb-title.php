<?php 

/**
 * Options
 *
 */
if ( ! function_exists( 'gpur_wpb_title_options' ) ) {
	function gpur_wpb_title_options() { 
	
		vc_map( array( 
			'name' => esc_html__( 'Title', 'gpur' ),
			'base' => 'gpur_title',
			'description' => '',
			'class' => 'gpur-wpb-title',
			'controls' => 'full',
			'icon' => 'gpur-icon-title',
			'category' => esc_html__( 'Review', 'gpur' ),
			'params' => array(	
			
				/*--------------------------------------------------------------
				Title
				--------------------------------------------------------------*/
	
				array(	
					'param_name' => 'title_link',
					'heading' => esc_html__( 'Title Link', 'gpur' ),
					'description' => esc_html__( 'Link the title to the post.', 'gpur' ),
					'type' => 'checkbox',
					'value' => array( '' => '1' ),
					'std' => '',
					'group' => esc_html__( 'Title', 'gpur' ),
				),
					
				array( 
					'heading' => esc_html__( 'Title Size (px)', 'gpur' ),
					'param_name' => 'title_size',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Title', 'gpur' ),
				),
				array( 
					'heading' => esc_html__( 'Title Color', 'gpur' ),
					'param_name' => 'title_color',
					'type' => 'colorpicker',
					'value' => '',
					'group' => esc_html__( 'Title', 'gpur' ),
				),
				array( 
					'heading' => esc_html__( 'Title Hover Color', 'gpur' ),
					'param_name' => 'title_hover_color',
					'type' => 'colorpicker',
					'value' => '',
					'dependency' => array( 
						'element' => 'title_link', 
						'not_empty' => true,
					),
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
add_action( 'vc_before_init', 'gpur_wpb_title_options' );	

/**
 * Shortcode
 *
 */
if ( ! function_exists( 'gpur_title_shortcode' ) ) {
	function gpur_title_shortcode( $atts ) {	
		
		$atts = shortcode_atts( gpur_title_shortcode_atts(), $atts, 'gpur_title_shortcode' );
		
		// Extract attributes
		extract( $atts );

		ob_start();

		// Load template
		echo gpur_title_template( array( 'atts' => $atts ) );

		$output = ob_get_contents();
		ob_end_clean();
		return $output;

	}
}
add_shortcode( 'gpur_title', 'gpur_title_shortcode' );