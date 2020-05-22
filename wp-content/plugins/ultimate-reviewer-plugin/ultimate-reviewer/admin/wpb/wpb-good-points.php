<?php 

/**
 * Options
 *
 */
if ( ! function_exists( 'gpur_wpb_good_points_options' ) ) {
	function gpur_wpb_good_points_options() { 
	
		vc_map( array( 
			'name' => esc_html__( 'Good Points', 'gpur' ),
			'base' => 'gpur_good_points',
			'description' => '',
			'class' => 'gpur-wpb-good-points',
			'controls' => 'full',
			'icon' => 'gpur-icon-good-points',
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
					'value' => esc_html__( 'Good', 'gpur' ),
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
				Icon
				--------------------------------------------------------------*/

				array( 
					'heading' => esc_html__( 'Icon', 'gpur' ),
					'param_name' => 'icon',
					'type' => 'iconpicker',
					'value' => 'fa fa-angle-right',
					'group' => esc_html__( 'Icon', 'gpur' ),
				),
				
				array( 
					'heading' => esc_html__( 'Icon Color', 'gpur' ),
					'param_name' => 'icon_color',
					'type' => 'colorpicker',
					'value' => '',
					'group' => esc_html__( 'Icon', 'gpur' ),
				),
				
				array( 
					'heading' => esc_html__( 'Icon Size (px)', 'gpur' ),
					'param_name' => 'icon_size',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Icon', 'gpur' ),
				),
				
				array( 
					'heading' => esc_html__( 'Extra CSS', 'gpur' ),
					'param_name' => 'icon_extra_css',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Icon', 'gpur' ),
				),
		
				/*--------------------------------------------------------------
				Text
				--------------------------------------------------------------*/

				array( 
					'heading' => esc_html__( 'Text Color', 'gpur' ),
					'param_name' => 'text_color',
					'type' => 'colorpicker',
					'value' => '',
					'group' => esc_html__( 'Text', 'gpur' ),
				),
				
				array( 
					'heading' => esc_html__( 'Text Size (px)', 'gpur' ),
					'param_name' => 'text_size',
					'type' => 'textfield',
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
add_action( 'vc_before_init', 'gpur_wpb_good_points_options' );

/**
 * Shortcode
 *
 */
 if ( ! function_exists( 'gpur_good_points_shortcode' ) ) {
	function gpur_good_points_shortcode( $atts ) {	
		
		$atts = shortcode_atts( gpur_good_points_shortcode_atts(), $atts, 'gpur_good_points_shortcode' );
		
		// Extract attributes
		extract( $atts );
		
		ob_start();
		
		// Load template
		echo gpur_good_points_template( array( 'atts' => $atts ) );

		$output = ob_get_contents();
		ob_end_clean();
		return $output;

	}
}
add_shortcode( 'gpur_good_points', 'gpur_good_points_shortcode' );