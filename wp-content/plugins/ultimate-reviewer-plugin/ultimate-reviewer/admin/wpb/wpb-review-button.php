<?php

/**
 * Options
 *
 */ 
 if ( ! function_exists( 'gpur_wpb_review_button_options' ) ) {
	function gpur_wpb_review_button_options() { 
	
		vc_map( array( 
			'name' => esc_html__( 'Review Button', 'gpur' ),
			'base' => 'gpur_review_button',
			'description' => '',
			'class' => 'gpur-wpb-review-button',
			'controls' => 'full',
			'icon' => 'gpur-icon-review-button',
			'category' => esc_html__( 'Review', 'gpur' ),
			'params' => array(	
		
				/*--------------------------------------------------------------
				Text
				--------------------------------------------------------------*/
					
				array( 
					'param_name' => 'text',
					'heading' => esc_html__( 'Text', 'gpur' ),
					'type' => 'textfield',
					'admin_label' => true,
					'value' => esc_html__( 'Button Text', 'gpur' ),
					'group' => esc_html__( 'Text', 'gpur' ),
				),
											
				array(
					'param_name' => 'link',
					'heading' => esc_html__( 'Link', 'gpur' ),
					'type' => 'textfield',
					'group' => esc_html__( 'Text', 'gpur' ),
				),

				array(	
					'param_name' => 'is_external',
					'heading' => esc_html__( 'Open in new window', 'gpur' ),
					'type' => 'checkbox',
					'value' => array( '' => '1' ),
					'std' => '',
					'group' => esc_html__( 'Text', 'gpur' ),
				),

				array(	
					'param_name' => 'nofollow',
					'heading' => esc_html__( 'Add nofollow', 'gpur' ),
					'type' => 'checkbox',
					'value' => array( '' => '1' ),
					'std' => '',
					'group' => esc_html__( 'Text', 'gpur' ),
				),
							
				array( 
					'heading' => esc_html__( 'Color', 'gpur' ),
					'param_name' => 'text_color',
					'type' => 'colorpicker',
					'value' => '#fff',
					'group' => esc_html__( 'Text', 'gpur' ),
				),	
				
				array( 
					'heading' => esc_html__( 'Hover Color', 'gpur' ),
					'param_name' => 'text_hover_color',
					'type' => 'colorpicker',
					'value' => '#fff',
					'group' => esc_html__( 'Text', 'gpur' ),
				),	

				array( 
					'heading' => esc_html__( 'Size (px)', 'gpur' ),
					'param_name' => 'text_size',
					'type' => 'textfield',
					'value' => '20px',
					'group' => esc_html__( 'Text', 'gpur' ),
				),
						
				/*--------------------------------------------------------------
				Background
				--------------------------------------------------------------*/
	
				array( 
					'heading' => esc_html__( 'Background Color', 'gpur' ),
					'param_name' => 'button_color',
					'type' => 'colorpicker',
					'value' => '#000',
					'group' => esc_html__( 'Background', 'gpur' ),
				),
				
				array( 
					'heading' => esc_html__( 'Background Hover Color', 'gpur' ),
					'param_name' => 'button_hover_color',
					'type' => 'colorpicker',
					'value' => '#333',
					'group' => esc_html__( 'Background', 'gpur' ),
				),	
							
				/*--------------------------------------------------------------
				Border
				--------------------------------------------------------------*/

				array( 
					'heading' => esc_html__( 'Border Width (px)', 'gpur' ),
					'param_name' => 'border_width',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Border', 'gpur' ),
				),
				array( 
					'heading' => esc_html__( 'Border Radius (px)', 'gpur' ),
					'param_name' => 'border_radius',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Border', 'gpur' ),
				),	
				array( 
					'heading' => esc_html__( 'Border Color', 'gpur' ),
					'param_name' => 'border_color',
					'type' => 'colorpicker',
					'value' => '',
					'group' => esc_html__( 'Border', 'gpur' ),
				),	
				array( 
					'heading' => esc_html__( 'Border Hover Color', 'gpur' ),
					'param_name' => 'border_hover_color',
					'type' => 'colorpicker',
					'value' => '',
					'group' => esc_html__( 'Border', 'gpur' ),
				),
				
				/*--------------------------------------------------------------
				Icon
				--------------------------------------------------------------*/
		
				array( 
					'heading' => esc_html__( 'Icon', 'gpur' ),
					'param_name' => 'icon',
					'type' => 'iconpicker',
					'value' => '',
					'group' => esc_html__( 'Icon', 'gpur' ),
				),
				
				array( 
					'heading' => esc_html__( 'Icon Size', 'gpur' ),
					'param_name' => 'icon_size',
					'type' => 'textfield',
					'value' => '20px',
					'group' => esc_html__( 'Icon', 'gpur' ),
				),
				
				array( 
					'heading' => esc_html__( 'Icon Color', 'gpur' ),
					'param_name' => 'icon_color',
					'type' => 'colorpicker',
					'value' => '#fff',
					'group' => esc_html__( 'Icon', 'gpur' ),
				),
					
				array( 
					'heading' => esc_html__( 'Icon Hover Color', 'gpur' ),
					'param_name' => 'icon_hover_color',
					'type' => 'colorpicker',
					'value' => '#fff',
					'group' => esc_html__( 'Icon', 'gpur' ),
				),	
				
				array( 
					'heading' => esc_html__( 'Alignment', 'gpur' ),
					'param_name' => 'icon_alignment',
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Left', 'gpur' ) => 'icon-left',
						esc_html__( 'Right', 'gpur' ) => 'icon-right',
					),
					'std' => 'icon-left',
					'group' => esc_html__( 'Icon', 'gpur' ),
				),	
					
				/*--------------------------------------------------------------
				Advanced
				--------------------------------------------------------------*/
	
				array( 
					'heading' => esc_html__( 'Alignment', 'gpur' ),
					'param_name' => 'button_alignment',
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Left', 'gpur' ) => 'button-left',
						esc_html__( 'Center', 'gpur' ) => 'button-center',
						esc_html__( 'Right', 'gpur' ) => 'button-right',
					),
					'std' => 'button-left',
					'group' => esc_html__( 'Advanced', 'gpur' ),
				),
				
				array( 
					'heading' => esc_html__( 'Padding Width (px)', 'gpur' ),
					'param_name' => 'button_padding_width',
					'type' => 'textfield',
					'value' => '15px',
					'group' => esc_html__( 'Advanced', 'gpur' ),
				),
				
				array( 
					'heading' => esc_html__( 'Padding Height (px)', 'gpur' ),
					'param_name' => 'button_padding_height',
					'type' => 'textfield',
					'value' => '10px',
					'group' => esc_html__( 'Advanced', 'gpur' ),
				),

			 )
		) );
		
	}		
} 
add_action( 'vc_before_init', 'gpur_wpb_review_button_options' );

/**
 * Shortcode
 *
 */
 if ( ! function_exists( 'gpur_review_button_shortcode' ) ) {
	function gpur_review_button_shortcode( $atts ) {
		
		$atts = shortcode_atts( gpur_review_button_shortcode_atts(), $atts, 'gpur_review_button_shortcode' );
		
		// Extract attributes
		extract( $atts );
																			
		ob_start();
		
		// Load template
		echo gpur_review_button_template( array( 'atts' => $atts ) );	
					
		$output = ob_get_contents();
		ob_end_clean();
		return $output;

	}
}
add_shortcode( 'gpur_review_button', 'gpur_review_button_shortcode' );