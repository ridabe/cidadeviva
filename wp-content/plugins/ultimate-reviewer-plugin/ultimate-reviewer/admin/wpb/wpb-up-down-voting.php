<?php 

/**
 * Options
 *
 */
if ( ! function_exists( 'gpur_wpb_up_down_voting_options' ) ) {
	function gpur_wpb_up_down_voting_options() { 
	
		vc_map( array( 
			'name' => esc_html__( 'Up/Down Voting', 'gpur' ),
			'base' => 'gpur_up_down_voting',
			'description' => '',
			'class' => 'gpur-wpb-up-down-voting',
			'controls' => 'full',
			'icon' => 'gpur-icon-up-down-voting',
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
				Style
				--------------------------------------------------------------*/
										
				array( 
					'heading' => esc_html__( 'Style', 'gpur' ),
					'param_name' => 'style',
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Plain', 'gpur' ) => 'style-plain',
						esc_html__( 'Round Buttons', 'gpur' ) => 'style-round-buttons',
						esc_html__( 'Rounded Buttons', 'gpur' ) => 'style-rounded-buttons',
					),
					'group' => esc_html__( 'Style', 'gpur' ),
				),	
																
				array( 
					'heading' => esc_html__( 'Counter Position', 'gpur' ),
					'param_name' => 'counter_position',
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Top', 'gpur' ) => 'position-top',
						esc_html__( 'Bottom', 'gpur' ) => 'position-bottom',
						esc_html__( 'Left', 'gpur' ) => 'position-left',
						esc_html__( 'Right', 'gpur' ) => 'position-right',
						esc_html__( 'Left And Right', 'gpur' ) => 'position-left-right',
					),
					'std' => 'position-left-right',
					'group' => esc_html__( 'Style', 'gpur' ),
				),	
				
				/*--------------------------------------------------------------
				Up button 
				--------------------------------------------------------------*/

				array( 
					'heading' => esc_html__( 'Show', 'gpur' ),
					'param_name' => 'up_show',
					'type' => 'checkbox',
					'value' => array( '' => '1' ),
					'std' => '1',
					'group' => esc_html__( 'Up Icon', 'gpur' ),
				),
			
				array( 
					'heading' => esc_html__( 'Icon', 'gpur' ),
					'param_name' => 'up_icon',
					'type' => 'iconpicker',
					'value' => 'fa fa-thumbs-o-up',				
					'dependency' => array(
						'element' => 'up_show', 
						'not_empty' => true
					),
					'group' => esc_html__( 'Up Icon', 'gpur' ),
				),	
			
				array( 
					'heading' => esc_html__( 'Text', 'gpur' ),
					'param_name' => 'up_text',
					'type' => 'textfield',
					'value' => '',				
					'dependency' => array(
						'element' => 'up_show', 
						'not_empty' => true
					),
					'group' => esc_html__( 'Up Icon', 'gpur' ),
				),	
				array( 
					'heading' => esc_html__( 'Icon/Text Size (px)', 'gpur' ),
					'param_name' => 'up_icon_size',
					'type' => 'textfield',
					'value' => '',			
					'dependency' => array(
						'element' => 'up_show', 
						'not_empty' => true
					),
					'group' => esc_html__( 'Up Icon', 'gpur' ),
				),	
			
				array( 
					'heading' => esc_html__( 'Icon/Text Color', 'gpur' ),
					'param_name' => 'up_icon_color',
					'type' => 'colorpicker',
					'value' => '',				
					'dependency' => array(
						'element' => 'up_show', 
						'not_empty' => true
					),
					'group' => esc_html__( 'Up Icon', 'gpur' ),
				),
			
				array( 
					'heading' => esc_html__( 'Icon/Text Color (Voted)', 'gpur' ),
					'param_name' => 'up_icon_color_voted',
					'type' => 'colorpicker',
					'value' => '',				
					'dependency' => array(
						'element' => 'up_show', 
						'not_empty' => true
					),
					'group' => esc_html__( 'Up Icon', 'gpur' ),
				),		
					
				array( 
					'heading' => esc_html__( 'Button Size (px)', 'gpur' ),
					'param_name' => 'up_button_size',
					'type' => 'textfield',
					'value' => '',
					'dependency' => array(
						'element' => 'up_show', 
						'not_empty' => true
					),
					'group' => esc_html__( 'Up Icon', 'gpur' ),
				),	
			
				array( 
					'heading' => esc_html__( 'Button Color', 'gpur' ),
					'param_name' => 'up_button_color',
					'type' => 'colorpicker',
					'value' => '',
					'dependency' => array( 
						'element' => 'style', 
						'value' => array( 'style-round-buttons' , 'style-rounded-buttons' ),
					),
					'group' => esc_html__( 'Up Icon', 'gpur' ),
				),
			
				array( 
					'heading' => esc_html__( 'Button Color (Voted)', 'gpur' ),
					'param_name' => 'up_button_color_voted',
					'type' => 'colorpicker',
					'value' => '',
					'dependency' => array( 
						'element' => 'style', 
						'value' => array( 'style-round-buttons' , 'style-rounded-buttons' ),
					),
					'group' => esc_html__( 'Up Icon', 'gpur' ),
				),	
					
				array( 
					'heading' => esc_html__( 'Counter Size (px)', 'gpur' ),
					'param_name' => 'up_counter_size',
					'type' => 'textfield',
					'value' => '',			
					'dependency' => array(
						'element' => 'up_show', 
						'not_empty' => true
					),
					'group' => esc_html__( 'Up Icon', 'gpur' ),
				),
			
				array( 
					'heading' => esc_html__( 'Counter Color', 'gpur' ),
					'param_name' => 'up_counter_color',
					'type' => 'colorpicker',
					'value' => '',			
					'dependency' => array(
						'element' => 'up_show', 
						'not_empty' => true
					),
					'group' => esc_html__( 'Up Icon', 'gpur' ),
				),

				/*--------------------------------------------------------------
				Down button 
				--------------------------------------------------------------*/

				array( 
					'heading' => esc_html__( 'Show', 'gpur' ),
					'param_name' => 'down_show',
					'type' => 'checkbox',
					'value' => array( '' => '1' ),
					'std' => '1',
					'group' => esc_html__( 'Down Icon', 'gpur' ),
				),	
			
				array( 
					'heading' => esc_html__( 'Icon', 'gpur' ),
					'param_name' => 'down_icon',
					'type' => 'iconpicker',
					'value' => 'fa fa-thumbs-o-down',				
					'dependency' => array(
						'element' => 'down_show', 
						'not_empty' => true
					),
					'group' => esc_html__( 'Down Icon', 'gpur' ),
				),	
			
				array( 
					'heading' => esc_html__( 'Text', 'gpur' ),
					'param_name' => 'down_text',
					'type' => 'textfield',
					'value' => '',				
					'dependency' => array(
						'element' => 'down_show', 
						'not_empty' => true
					),
					'group' => esc_html__( 'Down Icon', 'gpur' ),
				),	
						
				array( 
					'heading' => esc_html__( 'Icon/Text Size (px)', 'gpur' ),
					'param_name' => 'down_icon_size',
					'type' => 'textfield',
					'value' => '',				
					'dependency' => array(
						'element' => 'down_show', 
						'not_empty' => true
					),
					'group' => esc_html__( 'Down Icon', 'gpur' ),
				),	
			
				array( 
					'heading' => esc_html__( 'Icon/Text Color', 'gpur' ),
					'param_name' => 'down_icon_color',
					'type' => 'colorpicker',
					'value' => '',				
					'dependency' => array(
						'element' => 'down_show', 
						'not_empty' => true
					),
					'group' => esc_html__( 'Down Icon', 'gpur' ),
				),
			
				array( 
					'heading' => esc_html__( 'Icon/Text Color (Voted)', 'gpur' ),
					'param_name' => 'down_icon_color_voted',
					'type' => 'colorpicker',
					'value' => '',				
					'dependency' => array(
						'element' => 'down_show', 
						'not_empty' => true
					),
					'group' => esc_html__( 'Down Icon', 'gpur' ),
				),
			
				array( 
					'heading' => esc_html__( 'Button Size (px)', 'gpur' ),
					'param_name' => 'down_button_size',
					'type' => 'textfield',
					'value' => '',
					'dependency' => array(
						'element' => 'down_show', 
						'not_empty' => true
					),
					'group' => esc_html__( 'Down Icon', 'gpur' ),
				),
			
				array( 
					'heading' => esc_html__( 'Button Color', 'gpur' ),
					'param_name' => 'down_button_color',
					'type' => 'colorpicker',
					'value' => '',
					'dependency' => array(
						'element' => 'down_show', 
						'not_empty' => true
					),
					'group' => esc_html__( 'Down Icon', 'gpur' ),
				),
			
				array( 
					'heading' => esc_html__( 'Button Color (Voted)', 'gpur' ),
					'param_name' => 'down_button_color_voted',
					'type' => 'colorpicker',
					'value' => '',
					'dependency' => array(
						'element' => 'down_show', 
						'not_empty' => true
					),
					'group' => esc_html__( 'Down Icon', 'gpur' ),
				),		
			
				array( 
					'heading' => esc_html__( 'Counter Size (px)', 'gpur' ),
					'param_name' => 'down_counter_size',
					'type' => 'textfield',
					'value' => '',				
					'dependency' => array(
						'element' => 'down_show', 
						'not_empty' => true
					),
					'group' => esc_html__( 'Down Icon', 'gpur' ),
				),
			
				array( 
					'heading' => esc_html__( 'Counter Color', 'gpur' ),
					'param_name' => 'down_counter_color',
					'type' => 'colorpicker',
					'value' => '',				
					'dependency' => array(
						'element' => 'down_show', 
						'not_empty' => true
					),
					'group' => esc_html__( 'Down Icon', 'gpur' ),
				),
			
				/*--------------------------------------------------------------
				Already Voted Text
				--------------------------------------------------------------*/

				array( 
					'heading' => esc_html__( 'Label', 'gpur' ),
					'param_name' => 'already_voted_label',
					'type' => 'textfield',
					'value' => esc_html__( 'You have already voted.', 'gpur' ),
					'group' => esc_html__( 'Already Voted Text', 'gpur' ),
				),
	
				array( 
					'heading' => esc_html__( 'Size (px)', 'gpur' ),
					'param_name' => 'already_voted_text_size',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Already Voted Text', 'gpur' ),
				),
				array( 
					'heading' => esc_html__( 'Color', 'gpur' ),
					'param_name' => 'already_voted_text_color',
					'type' => 'colorpicker',
					'value' => '',
					'group' => esc_html__( 'Already Voted Text', 'gpur' ),
				),
				array( 
					'heading' => esc_html__( 'Extra CSS', 'gpur' ),	
					'param_name' => 'already_voted_text_extra_css',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Already Voted Text', 'gpur' ),
				),

				/*--------------------------------------------------------------
				Permissions
				--------------------------------------------------------------*/
										
				array(  
					'param_name' => 'permissions',
					'heading' => esc_html__( 'Permissions', 'gpur' ),
					'description' => esc_html__( 'Choose which users or roles can submit user reviews.', 'gpur' ),
					'type' => 'dropdown',	
					'value' => array(
						esc_html__( 'All users', 'gpur' ) => 'all-users',
						esc_html__( 'Logged in users only', 'gpur' ) => 'logged-in-users',
						esc_html__( 'Specific roles only', 'gpur' ) => 'specific-roles',
					),
					'std' => 'all-users',
					'group' => esc_html__( 'Permissions', 'gpur' ),
				),			
				
				array(  
					'param_name' => 'permission_roles',
					'heading' => esc_html__( 'Roles', 'gpur' ),
					'type' => 'checkbox',
					'value' => GPUR_Page_Builder::gpur_elementor_permissions_roles(),
					'dependency' => array(
						'element' => 'permissions', 
						'value' => array( 'specific-roles' ),
					),
					'group' => esc_html__( 'Permissions', 'gpur' ),
				),
				
				array(	
					'param_name' => 'rich_snippets',
					'heading' => esc_html__( 'Rich Snippets', 'gpur' ),
					'description' => esc_html__( 'Allows search engines to read your rating data to display ratings in search results.', 'gpur' ),
					'type' => 'checkbox',
					'value' => array( '' => '1' ),
					'std' => '',
					'group' => esc_html__( 'Permissions', 'gpur' ),
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
add_action( 'vc_before_init', 'gpur_wpb_up_down_voting_options' );

/**
 * Shortcode
 *
 */
if ( ! function_exists( 'gpur_up_down_voting_shortcode' ) ) {
	 function gpur_up_down_voting_shortcode( $atts ) {
		
		$atts = shortcode_atts( gpur_up_down_voting_shortcode_atts(), $atts, 'gpur_up_down_voting_shortcode' );	
		
		// Extract attributes
		extract( $atts );

		ob_start();
							
		// Load template
		echo gpur_up_down_voting_template( 
			array(
				'post_id' => get_the_ID(), 
				'atts' => $atts, 
			)
		);

		$output = ob_get_contents();
		ob_end_clean();
		return $output;

	}
}
add_shortcode( 'gpur_up_down_voting', 'gpur_up_down_voting_shortcode' ); 