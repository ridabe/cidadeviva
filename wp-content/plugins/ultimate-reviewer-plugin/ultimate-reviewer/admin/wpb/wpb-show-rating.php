<?php 

/**
 * Options
 *
 */
if ( ! function_exists( 'gpur_wpb_show_rating_options' ) ) {
	function gpur_wpb_show_rating_options() { 

		global $gpur_show_rating_params;
		$gpur_show_rating_params = apply_filters( 'gpur_show_rating_params', array(
			
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
				'heading' => esc_html__( 'Color', 'gpur' ),
				'param_name' => 'title_color',
				'type' => 'colorpicker',
				'value' => '',
				'dependency' => array( 
					'element' => 'title', 
					'not_empty' => true,
				),
				'group' => esc_html__( 'Title', 'gpur' ),
			),
			
			array( 
				'heading' => esc_html__( 'Size (px)', 'gpur' ),
				'param_name' => 'title_size',
				'type' => 'textfield',
				'value' => '',
				'dependency' => array( 
					'element' => 'title', 
					'not_empty' => true,
				),
				'group' => esc_html__( 'Title', 'gpur' ),
			),
																			
			array( 
				'heading' => esc_html__( 'Extra CSS', 'gpur' ),
				'param_name' => 'title_extra_css',
				'type' => 'textfield',
				'value' => '',
				'dependency' => array( 
					'element' => 'title', 
					'not_empty' => true,
				),
				'group' => esc_html__( 'Title', 'gpur' ),
			),
			
			/*--------------------------------------------------------------
			Rating Controls
			--------------------------------------------------------------*/

			array( 
				'heading' => esc_html__( 'Rating Data', 'gpur' ),
				'param_name' => 'data',
				'type' => 'dropdown',
				'admin_label' => true,
				'value' => array(
					esc_html__( 'Site Rating', 'gpur' ) => 'site-rating',
					esc_html__( 'User Rating', 'gpur' ) => 'user-rating',
					esc_html__( 'Custom', 'gpur' ) => 'custom',
				),
				'group' => esc_html__( 'Rating Controls', 'gpur' ),
			),	
									
			array( 
				'heading' => esc_html__( 'Value', 'gpur' ),
				'description' => esc_html__( 'Add your own custom ratings that will overwrite ratings on posts/pages. To add multiple ratings separate each rating with a comma e.g. 5,8,10', 'gpur' ),
				'param_name' => 'value',
				'type' => 'textfield',
				'value' => '',
				'dependency' => array( 
					'element' => 'data', 
					'value' => 'custom' 
				),
				'group' => esc_html__( 'Rating Controls', 'gpur' ),
			),
			
			array( 
				'heading' => esc_html__( 'Maximum Rating', 'gpur' ),
				'param_name' => 'max_rating',
				'type' => 'textfield',
				'value' => 5,
				'group' => esc_html__( 'Rating Controls', 'gpur' ),
			),
			
			array( 
				'param_name' => 'fractions',
				'heading' => esc_html__( 'Rating Fractions', 'gpur' ),
				'description' => esc_html__( 'The increments you can rate for each rating symbol.', 'gpur' ),
				'type' => 'textfield',
				'value' => 1,
				'group' => esc_html__( 'Rating Controls', 'gpur' ),
			),	
									
			array( 
				'param_name' => 'step',
				'heading' => esc_html__( 'Rating Step', 'gpur' ),
				'description' => esc_html__( 'The rating range spans all the integers from minimum to maximum rating.', 'gpur' ),
				'type' => 'textfield',
				'value' => 1,
				'group' => esc_html__( 'Rating Controls', 'gpur' ),
			),
					
			array( 
				'param_name' => 'decimal_places',
				'heading' => esc_html__( 'Decimal Places', 'gpur' ),
				'description' => esc_html__( 'The number of decimal places to show the rating to.', 'gpur' ),
				'type' => 'textfield',
				'value' => 1,
				'group' => esc_html__( 'Rating Controls', 'gpur' ),
			),
						
			array(
				'param_name' => 'show_zero_rating',
				'heading' => esc_html__( 'Zero Ratings', 'gpur' ),
				'type' => 'checkbox',
				'value' => array( '' => 1 ),
				'std' => '1',
				'group' => esc_html__( 'Rating Controls', 'gpur' ),
			),
			
			array(	
				'param_name' => 'rich_snippets',
				'heading' => esc_html__( 'Rich Snippets', 'gpur' ),
				'description' => esc_html__( 'Allows search engines to read your rating data to display ratings in search results.', 'gpur' ),
				'type' => 'checkbox',
				'value' => array( '' => '1' ),
				'std' => '',
				'group' => esc_html__( 'Rating Controls', 'gpur' ),
			),
				
			/*--------------------------------------------------------------
			Rating Style
			--------------------------------------------------------------*/							
											
			array( 
				'heading' => esc_html__( 'Style', 'gpur' ),
				'param_name' => 'style',
				'type' => 'dropdown',
				'admin_label' => true,
				'value' => array(
					esc_html__( 'Plain (Singular)', 'gpur' ) => 'style-plain-singular',
					esc_html__( 'Squares (Singular)', 'gpur' ) => 'style-squares-singular',
					esc_html__( 'Circles (Singular)', 'gpur' ) => 'style-circles-singular',
					esc_html__( 'Gauge Circles (Singular)', 'gpur' ) => 'style-gauge-circles-singular',
					esc_html__( 'Stars', 'gpur' ) => 'style-stars',
					esc_html__( 'Hearts', 'gpur' ) => 'style-hearts',
					esc_html__( 'Squares', 'gpur' ) => 'style-squares',
					esc_html__( 'Circles', 'gpur' ) => 'style-circles',
					esc_html__( 'Bars', 'gpur' ) => 'style-bars',
					esc_html__( 'Custom Icon', 'gpur' ) => 'style-icon',
					esc_html__( 'Custom Image', 'gpur' ) => 'style-image',
				),
				'group' => esc_html__( 'Rating Style', 'gpur' ),
			),
			
			array( 
				'heading' => esc_html__( 'Position', 'gpur' ),
				'param_name' => 'position',
				'type' => 'dropdown',
				'value' => array(
					esc_html__( 'Left', 'gpur' ) => 'position-left',
					esc_html__( 'Center', 'gpur' ) => 'position-center',
					esc_html__( 'Right', 'gpur' ) => 'position-right',
				),
				'std' => 'position-left',
				'group' => esc_html__( 'Rating Style', 'gpur' ),
			),		

			array( 
				'param_name' => 'text_position',
				'heading' => esc_html__( 'Rating Text Position', 'gpur' ),
				'type' => 'dropdown',
				'value' => array(
					esc_html__( 'Top', 'gpur' ) => 'position-text-top', 
					esc_html__( 'Bottom', 'gpur' ) => 'position-text-bottom', 
					esc_html__( 'Left', 'gpur' ) => 'position-text-left', 
					esc_html__( 'Right', 'gpur' ) => 'position-text-right', 
				),
				'std' => 'position-text-bottom',					
				'dependency' => array(
					'element' => 'style', 
					'value' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
				),
				'group' => esc_html__( 'Rating Style', 'gpur' ),
			),
			
			array( 
				'heading' => esc_html__( 'Custom Image', 'gpur' ),
				'description' => esc_html__( 'Your image should include the filled and empty icons. For an example see the', 'gpur' ) . ' <a href="' . GPUR_URL . 'public/images/default-rating-image.png" target="_blank">' . esc_html__( 'default image', 'gpur' ) . '</a>.',
				'param_name' => 'rating_image',
				'type' => 'attach_image',
				'value' => '',
				'dependency' => array( 
					'element' => 'style', 
					'value' => 'style-image' 
				),
				'group' => esc_html__( 'Rating Style', 'gpur' ),
			),
				
			array( 
				'heading' => esc_html__( 'Empty Icon', 'gpur' ),
				'param_name' => 'empty_icon',
				'type' => 'iconpicker',
				'value' => 'fa fa-star',
				'dependency' => array( 
					'element' => 'style', 
					'value' => 'style-icon' ,
				),
				'group' => esc_html__( 'Rating Style', 'gpur' ),
			),	
										
			array( 
				'heading' => esc_html__( 'Empty Icon Color', 'gpur' ),
				'param_name' => 'empty_icon_color',
				'type' => 'colorpicker',
				'value' => '',
				'dependency' => array( 
					'element' => 'style', 
					'value' => array( 'style-stars', 'style-hearts', 'style-squares', 'style-circles', 'style-bars', 'style-icon' ), 
				),
				'group' => esc_html__( 'Rating Style', 'gpur' ),
			),	
				
			array( 
				'heading' => esc_html__( 'Filled Icon', 'gpur' ),
				'param_name' => 'filled_icon',
				'type' => 'iconpicker',
				'value' => 'fa fa-star',
				'dependency' => array( 
					'element' => 'style', 
					'value' => 'style-icon',
				),
				'group' => esc_html__( 'Rating Style', 'gpur' ),
			),	
				
			array( 
				'heading' => esc_html__( 'Filled Icon Color', 'gpur' ),
				'param_name' => 'filled_icon_color',
				'type' => 'colorpicker',
				'value' => '',
				'group' => esc_html__( 'Rating Style', 'gpur' ),
				'dependency' => array( 
					'element' => 'style', 
					'value' => array( 'style-stars', 'style-hearts', 'style-squares', 'style-circles', 'style-bars', 'style-icon' ), 
				),
			),	
									
			array( 
				'heading' => esc_html__( 'Width (px)', 'gpur' ),
				'description' => '',
				'param_name' => 'icon_width',
				'type' => 'textfield',
				'value' => '',
				'group' => esc_html__( 'Rating Style', 'gpur' ),
				'dependency' => array( 
					'element' => 'style', 
					'value' => array( 'style-stars', 'style-hearts', 'style-squares', 'style-circles', 'style-icon', 'style-image' ), 
				),
			),
			
			array( 
				'heading' => esc_html__( 'Height (px)', 'gpur' ),
				'description' => '',
				'param_name' => 'icon_height',
				'type' => 'textfield',
				'value' => '',
				'dependency' => array( 
					'element' => 'style', 
					'value' => array( 'style-squares', 'style-circles', 'style-bars', 'style-icon', 'style-image' ), 
				),
				'group' => esc_html__( 'Rating Style', 'gpur' ),
			),					

			/*--------------------------------------------------------------
			Rating Container
			--------------------------------------------------------------*/
											
			array( 
				'heading' => esc_html__( 'Width (px)', 'gpur' ),
				'description' => '',
				'param_name' => 'rating_container_width',
				'type' => 'textfield',
				'value' => '',
				'group' => esc_html__( 'Rating Container', 'gpur' ),
				'dependency' => array( 
					'element' => 'style', 
					'value' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
				),
			),

			array( 
				'heading' => esc_html__( 'Height (px)', 'gpur' ),
				'description' => '',
				'param_name' => 'rating_container_height',
				'type' => 'textfield',
				'value' => '',
				'group' => esc_html__( 'Rating Container', 'gpur' ),
				'dependency' => array( 
					'element' => 'style', 
					'value' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
				),
			),
			
			array( 
				'heading' => esc_html__( 'Background Color', 'gpur' ),
				'param_name' => 'rating_container_background_color',
				'type' => 'colorpicker',
				'value' => '',				
				'dependency' => array( 
					'element' => 'style', 
					'value' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
				),
				'group' => esc_html__( 'Rating Container', 'gpur' ),
			),
						
			array( 
				'heading' => esc_html__( 'Border Width (px)', 'gpur' ),
				'param_name' => 'rating_container_border_width',
				'type' => 'textfield',
				'value' => '',				
				'dependency' => array( 
					'element' => 'style', 
					'value' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
				),
				'group' => esc_html__( 'Rating Container', 'gpur' ),
			),	
			
			array( 
				'heading' => esc_html__( 'Border Color', 'gpur' ),
				'param_name' => 'rating_container_border_color',
				'type' => 'colorpicker',
				'value' => '',				
				'dependency' => array( 
					'element' => 'style', 
					'value' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
				),
				'group' => esc_html__( 'Rating Container', 'gpur' ),
			),	
				
			array( 
				'heading' => esc_html__( 'Extra CSS', 'gpur' ),
				'param_name' => 'rating_container_extra_css',
				'type' => 'textfield',
				'value' => '',		
				'dependency' => array( 
					'element' => 'style', 
					'value' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
				),
				'group' => esc_html__( 'Rating Container', 'gpur' ),
			),

			/*--------------------------------------------------------------
			Gauge
			--------------------------------------------------------------*/

			array( 
				'heading' => esc_html__( 'Width (px)', 'gpur' ),
				'param_name' => 'gauge_width',
				'type' => 'textfield',
				'value' => '',
				'dependency' => array( 
					'element' => 'style', 
					'value' => 'style-gauge-circles-singular' 
				),
				'group' => esc_html__( 'Gauge', 'gpur' ),
			),
			
			array( 
				'heading' => esc_html__( 'Filled Color 1', 'gpur' ),
				'param_name' => 'gauge_filled_color_1',
				'type' => 'colorpicker',
				'value' => '',
				'dependency' => array( 
					'element' => 'style', 
					'value' => 'style-gauge-circles-singular' 
				),
				'group' => esc_html__( 'Gauge', 'gpur' ),
			),
			
			array( 
				'heading' => esc_html__( 'Filled Color 2', 'gpur' ),
				'param_name' => 'gauge_filled_color_2',
				'type' => 'colorpicker',
				'value' => '',
				'dependency' => array( 
					'element' => 'style', 
					'value' => 'style-gauge-circles-singular' 
				),
				'group' => esc_html__( 'Gauge', 'gpur' ),
			),
			
			array( 
				'heading' => esc_html__( 'Empty Color', 'gpur' ),
				'param_name' => 'gauge_empty_color',
				'type' => 'colorpicker',
				'value' => '',
				'dependency' => array( 
					'element' => 'style', 
					'value' => 'style-gauge-circles-singular' 
				),
				'group' => esc_html__( 'Gauge', 'gpur' ),
			),
						
			/*--------------------------------------------------------------
			Site Rating Text
			--------------------------------------------------------------*/
			
			array(	
				'param_name' => 'show_site_rating_text',
				'heading' => esc_html__( 'Display', 'gpur' ),
				'type' => 'checkbox',
				'value' => array( '' => '1' ),
				'std' => '1',
				'dependency' => array( 
					'element' => 'style', 
					'value' => array( 'style-stars', 'style-hearts', 'style-squares', 'style-circles', 'style-bars', 'style-icon', 'style-image' ), 
				),
				'group' => esc_html__( 'Site Rating Text', 'gpur' ),
			),
			
			// Site Rating - Label
			array( 
				'param_name' => '_gpur_header_site_rating_label',
				'heading' => esc_html__( 'Label', 'gpur' ),
				'type' => 'gpur_header',				
				'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
				'dependency' => array( 
					'element' => 'show_site_rating_text', 
					'not_empty' => true,
				),
				'group' => esc_html__( 'Site Rating Text', 'gpur' ),
			),
				array(
					'heading' => esc_html__( 'Label', 'gpur' ),
					'param_name' => 'site_rating_label',
					'type' => 'textfield',
					'value' => esc_html__( 'Site Rating:', 'gpur' ),
					'dependency' => array( 
						'element' => 'show_site_rating_text', 
						'not_empty' => true,
					),
					'group' => esc_html__( 'Site Rating Text', 'gpur' ),
				),	
				array( 
					'heading' => esc_html__( 'Text Color', 'gpur' ),	
					'param_name' => 'site_rating_label_color',
					'type' => 'colorpicker',
					'value' => '',
					'dependency' => array( 
						'element' => 'show_site_rating_text', 
						'not_empty' => true, 
					),
					'group' => esc_html__( 'Site Rating Text', 'gpur' ),
				),			
				array( 
					'heading' => esc_html__( 'Size (px)', 'gpur' ),	
					'param_name' => 'site_rating_label_size',
					'type' => 'textfield',
					'value' => '',
					'dependency' => array( 
						'element' => 'show_site_rating_text', 
						'not_empty' => true, 
					),
					'group' => esc_html__( 'Site Rating Text', 'gpur' ),
				),
				array( 
					'heading' => esc_html__( 'Extra CSS', 'gpur' ),	
					'param_name' => 'site_rating_label_extra_css',
					'type' => 'textfield',
					'value' => '',
					'dependency' => array( 
						'element' => 'show_site_rating_text', 
						'not_empty' => true, 
					),
					'group' => esc_html__( 'Site Rating Text', 'gpur' ),
				),
				
			// Site Rating - Rating Number
			array( 
				'param_name' => '_gpur_header_site_rating_number',
				'heading' => esc_html__( 'Rating Number', 'gpur' ),
				'type' => 'gpur_header',
				'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
				'group' => esc_html__( 'Site Rating Text', 'gpur' ),
			),
				array( 
					'heading' => esc_html__( 'Text Color', 'gpur' ),	
					'param_name' => 'site_rating_number_color',
					'type' => 'colorpicker',
					'value' => '',
					'group' => esc_html__( 'Site Rating Text', 'gpur' ),
				),			
				array( 
					'heading' => esc_html__( 'Size (px)', 'gpur' ),	
					'param_name' => 'site_rating_number_size',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Site Rating Text', 'gpur' ),
				),
				array( 
					'heading' => esc_html__( 'Extra CSS', 'gpur' ),	
					'param_name' => 'site_rating_number_extra_css',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Site Rating Text', 'gpur' ),
				),
					
			// Site Rating - Maximum Rating Number											
			array( 
				'param_name' => '_gpur_header_site_rating_max_rating_number',
				'heading' => esc_html__( 'Maximum Rating Number', 'gpur' ),
				'type' => 'gpur_header',
				'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
				'group' => esc_html__( 'Site Rating Text', 'gpur' ),
			),			
				array(	
					'param_name' => 'show_site_rating_max_rating_number',
					'heading' => esc_html__( 'Display', 'gpur' ),
					'type' => 'checkbox',
					'value' => array( '' => '1' ),
					'std' => '',
					'group' => esc_html__( 'Site Rating Text', 'gpur' ),
				),
				array( 
					'heading' => esc_html__( 'Text Color', 'gpur' ),	
					'param_name' => 'site_rating_max_rating_number_color',
					'type' => 'colorpicker',
					'value' => '',
					'dependency' => array( 
						'element' => 'show_site_rating_max_rating_number', 
						'not_empty' => true, 
					),
					'group' => esc_html__( 'Site Rating Text', 'gpur' ),
				),			
				array( 
					'heading' => esc_html__( 'Size (px)', 'gpur' ),	
					'param_name' => 'site_rating_max_rating_number_size',
					'type' => 'textfield',
					'value' => '',
					'dependency' => array( 
						'element' => 'show_site_rating_max_rating_number', 
						'not_empty' => true, 
					),
					'group' => esc_html__( 'Site Rating Text', 'gpur' ),
				),
				array( 
					'heading' => esc_html__( 'Extra CSS', 'gpur' ),	
					'param_name' => 'site_rating_max_rating_number_extra_css',
					'type' => 'textfield',
					'value' => '',
					'dependency' => array( 
						'element' => 'show_site_rating_max_rating_number', 
						'not_empty' => true, 
					),
					'group' => esc_html__( 'Site Rating Text', 'gpur' ),
				),	

			/*--------------------------------------------------------------
			User Rating Text
			--------------------------------------------------------------*/

			// Average User Rating Text 
			array( 
				'param_name' => '_gpur_tab_avg_user_rating_text',
				'heading' => esc_html__( 'Average User Rating Text', 'gpur' ),
				'type' => 'gpur_tab',
				'group' => esc_html__( 'User Rating Text', 'gpur' ),
			),	
			
			array(	
				'param_name' => 'show_avg_user_rating_text',
				'heading' => esc_html__( 'Display', 'gpur' ),
				'type' => 'checkbox',
				'value' => array( '' => '1' ),
				'std' => '1',
				'dependency' => array( 
					'element' => 'style', 
					'value' => array( 'style-stars', 'style-hearts', 'style-squares', 'style-circles', 'style-bars', 'style-icon', 'style-image' ), 
				),
				'group' => esc_html__( 'User Rating Text', 'gpur' ),
			),
			
			// Average User Rating - Label
			array( 
				'param_name' => '_gpur_header_avg_user_rating_label',
				'heading' => esc_html__( 'Label', 'gpur' ),
				'type' => 'gpur_header',
				'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
				'dependency' => array( 
					'element' => 'show_avg_user_rating_text', 
					'not_empty' => true,
				),
				'group' => esc_html__( 'User Rating Text', 'gpur' ),
			),
				array(
					'heading' => esc_html__( 'Label', 'gpur' ),
					'param_name' => 'avg_user_rating_label',
					'type' => 'textfield',
					'value' => esc_html__( 'Average User Rating:', 'gpur' ),
					'dependency' => array( 
						'element' => 'show_avg_user_rating_text', 
						'not_empty' => true,
					),
					'group' => esc_html__( 'User Rating Text', 'gpur' ),
				),	
				array( 
					'heading' => esc_html__( 'Text Color', 'gpur' ),	
					'param_name' => 'avg_user_rating_label_color',
					'type' => 'colorpicker',
					'value' => '',
					'dependency' => array( 
						'element' => 'show_avg_user_rating_text', 
						'not_empty' => true, 
					),
					'group' => esc_html__( 'User Rating Text', 'gpur' ),
				),			
				array( 
					'heading' => esc_html__( 'Size (px)', 'gpur' ),	
					'param_name' => 'avg_user_rating_label_size',
					'type' => 'textfield',
					'value' => '',
					'dependency' => array( 
						'element' => 'show_avg_user_rating_text', 
						'not_empty' => true, 
					),
					'group' => esc_html__( 'User Rating Text', 'gpur' ),
				),
				array( 
					'heading' => esc_html__( 'Extra CSS', 'gpur' ),	
					'param_name' => 'avg_user_rating_label_extra_css',
					'type' => 'textfield',
					'value' => '',
					'dependency' => array( 
						'element' => 'show_avg_user_rating_text', 
						'not_empty' => true, 
					),
					'group' => esc_html__( 'User Rating Text', 'gpur' ),
				),
				
			// Average User Rating - Rating Number
			array( 
				'param_name' => '_gpur_header_avg_user_rating_number',
				'heading' => esc_html__( 'Rating Number', 'gpur' ),
				'type' => 'gpur_header',
				'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
				/*'dependency' => array( 
					'element' => 'show_avg_user_rating_text', 
					'not_empty' => true,
				),*/
				'group' => esc_html__( 'User Rating Text', 'gpur' ),
			),
				array( 
					'heading' => esc_html__( 'Text Color', 'gpur' ),	
					'param_name' => 'avg_user_rating_number_color',
					'type' => 'colorpicker',
					'value' => '',
					/*'dependency' => array( 
						'element' => 'show_avg_user_rating_text', 
						'not_empty' => true, 
					),*/
					'group' => esc_html__( 'User Rating Text', 'gpur' ),
				),			
				array( 
					'heading' => esc_html__( 'Size (px)', 'gpur' ),	
					'param_name' => 'avg_user_rating_number_size',
					'type' => 'textfield',
					'value' => '',
					/*'dependency' => array( 
						'element' => 'show_avg_user_rating_text', 
						'not_empty' => true, 
					),*/
					'group' => esc_html__( 'User Rating Text', 'gpur' ),
				),
				array( 
					'heading' => esc_html__( 'Extra CSS', 'gpur' ),	
					'param_name' => 'avg_user_rating_number_extra_css',
					'type' => 'textfield',
					'value' => '',
					/*'dependency' => array( 
						'element' => 'show_avg_user_rating_text', 
						'not_empty' => true, 
					),*/
					'group' => esc_html__( 'User Rating Text', 'gpur' ),
				),
					
			// Average User Rating - Maximum Rating Number											
			array( 
				'param_name' => '_gpur_header_avg_user_rating_max_rating_number',
				'heading' => esc_html__( 'Maximum Rating Number', 'gpur' ),
				'type' => 'gpur_header',
				'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
				'group' => esc_html__( 'User Rating Text', 'gpur' ),
			),			
				array(	
					'param_name' => 'show_avg_user_rating_max_rating_number',
					'heading' => esc_html__( 'Display', 'gpur' ),
					'type' => 'checkbox',
					'value' => array( '' => '1' ),
					'std' => '',
					'group' => esc_html__( 'User Rating Text', 'gpur' ),
				),
				array( 
					'heading' => esc_html__( 'Text Color', 'gpur' ),	
					'param_name' => 'avg_user_rating_max_rating_number_color',
					'type' => 'colorpicker',
					'value' => '',
					'dependency' => array( 
						'element' => 'show_avg_user_rating_max_rating_number', 
						'not_empty' => true, 
					),
					'group' => esc_html__( 'User Rating Text', 'gpur' ),
				),			
				array( 
					'heading' => esc_html__( 'Size (px)', 'gpur' ),	
					'param_name' => 'avg_user_rating_max_rating_number_size',
					'type' => 'textfield',
					'value' => '',
					'dependency' => array( 
						'element' => 'show_avg_user_rating_max_rating_number', 
						'not_empty' => true, 
					),
					'group' => esc_html__( 'User Rating Text', 'gpur' ),
				),
				array( 
					'heading' => esc_html__( 'Extra CSS', 'gpur' ),	
					'param_name' => 'avg_user_rating_max_rating_number_extra_css',
					'type' => 'textfield',
					'value' => '',
					'dependency' => array( 
						'element' => 'show_avg_user_rating_max_rating_number', 
						'not_empty' => true, 
					),
					'group' => esc_html__( 'User Rating Text', 'gpur' ),
				),	
				
			// User Votes Text															
			array( 
				'param_name' => '_gpur_tab_user_votes_text',
				'heading' => esc_html__( 'User Votes Text', 'gpur' ),
				'type' => 'gpur_tab',				
				'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
				'dependency' => array( 
					'element' => 'data', 
					'value' => 'user-rating' 
				),
				'group' => esc_html__( 'User Rating Text', 'gpur' ),
			),
				array(
					'param_name' => 'show_user_votes_text',
					'heading' => esc_html__( 'Display', 'gpur' ),
					'type' => 'checkbox',
					'value' => array( '' => '1' ),
					'std' => '1',
					'dependency' => array( 
						'element' => 'data', 
						'value' => 'user-rating' 
					),
					'group' => esc_html__( 'User Rating Text', 'gpur' ),
				),
				array( 
					'heading' => esc_html__( 'User Votes Label (Singular)', 'gpur' ),
					'param_name' => 'singular_vote_label',
					'type' => 'textfield',
					'value' => esc_html__( 'vote', 'gpur' ),
					'dependency' => array( 
						'element' => 'show_user_votes_text', 
						'not_empty' => true,
					),
					'group' => esc_html__( 'User Rating Text', 'gpur' ),
				),			
				array( 
					'heading' => esc_html__( 'User Votes Label (Plural)', 'gpur' ),
					'param_name' => 'plural_vote_label',
					'type' => 'textfield',
					'value' => esc_html__( 'votes', 'gpur' ),
					'dependency' => array( 
						'element' => 'show_user_votes_text', 
						'not_empty' => true,
					),
					'group' => esc_html__( 'User Rating Text', 'gpur' ),
				),	
				array( 
					'heading' => esc_html__( 'Text Color', 'gpur' ),	
					'param_name' => 'user_votes_text_color',
					'type' => 'colorpicker',
					'value' => '',
					'dependency' => array( 
						'element' => 'show_user_votes_text', 
						'not_empty' => true,
					),
					'group' => esc_html__( 'User Rating Text', 'gpur' ),
				),		
				array( 
					'heading' => esc_html__( 'Size (px)', 'gpur' ),	
					'param_name' => 'user_votes_text_size',
					'type' => 'textfield',
					'value' => '',
					'dependency' => array( 
						'element' => 'show_user_votes_text', 
						'not_empty' => true, 
					),
					'group' => esc_html__( 'User Rating Text', 'gpur' ),
				),
				array( 
					'heading' => esc_html__( 'Extra CSS', 'gpur' ),	
					'param_name' => 'user_votes_text_extra_css',
					'type' => 'textfield',
					'value' => '',
					'dependency' => array( 
						'element' => 'show_user_votes_text', 
						'not_empty' => true,
					),
					'group' => esc_html__( 'User Rating Text', 'gpur' ),
				),

			// Individual User Rating Text
			array( 
				'param_name' => '_gpur_tab_ind_user_rating_text',
				'heading' => esc_html__( 'Individual User Rating Text', 'gpur' ),
				'type' => 'gpur_tab',				
				'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
				'dependency' => array( 
					'element' => 'style', 
					'value' => array( 'style-stars', 'style-hearts', 'style-squares', 'style-circles', 'style-bars', 'style-icon', 'style-image' ), 
				),
				'group' => esc_html__( 'User Rating Text', 'gpur' ),
			),	
				array(
					'param_name' => 'show_ind_user_rating_text',
					'heading' => esc_html__( 'Display', 'gpur' ),
					'type' => 'checkbox',
					'value' => array( '' => '1' ),
					'std' => '1',
					'dependency' => array( 
						'element' => 'style', 
						'value' => array( 'style-stars', 'style-hearts', 'style-squares', 'style-circles', 'style-bars', 'style-icon', 'style-image' ), 
					),
					'group' => esc_html__( 'User Rating Text', 'gpur' ),
				),	
								
				// Individual User Rating - Label
				array( 
					'param_name' => '_gpur_header_ind_user_rating_label',
					'heading' => esc_html__( 'Label', 'gpur' ),
					'type' => 'gpur_header',
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'dependency' => array( 
						'element' => 'show_ind_user_rating_text', 
						'not_empty' => true,
					),
					'group' => esc_html__( 'User Rating Text', 'gpur' ),
				),
					array(
						'heading' => esc_html__( 'Label', 'gpur' ),
						'param_name' => 'ind_user_rating_label',
						'type' => 'textfield',
						'value' => esc_html__( 'Your Rating:', 'gpur' ),
						'dependency' => array( 
							'element' => 'show_ind_user_rating_text', 
							'not_empty' => true,
						),
					'group' => esc_html__( 'User Rating Text', 'gpur' ),
					),	
					array( 
						'heading' => esc_html__( 'Text Color', 'gpur' ),	
						'param_name' => 'ind_user_rating_label_color',
						'type' => 'colorpicker',
						'value' => '',
						'dependency' => array( 
							'element' => 'show_ind_user_rating_text', 
							'not_empty' => true, 
						),
						'group' => esc_html__( 'User Rating Text', 'gpur' ),
					),			
					array( 
						'heading' => esc_html__( 'Size (px)', 'gpur' ),	
						'param_name' => 'ind_user_rating_label_size',
						'type' => 'textfield',
						'value' => '',
						'dependency' => array( 
							'element' => 'show_ind_user_rating_text', 
							'not_empty' => true, 
						),
						'group' => esc_html__( 'User Rating Text', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Extra CSS', 'gpur' ),	
						'param_name' => 'ind_user_rating_label_extra_css',
						'type' => 'textfield',
						'value' => '',
						'dependency' => array( 
							'element' => 'show_ind_user_rating_text', 
							'not_empty' => true, 
						),
						'group' => esc_html__( 'User Rating Text', 'gpur' ),
					),
				
				// Individual User Rating - Rating Number
				array( 
					'param_name' => '_gpur_header_ind_user_rating_number',
					'heading' => esc_html__( 'Rating Number', 'gpur' ),
					'type' => 'gpur_header',	
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',	
					'dependency' => array( 
						'element' => 'show_ind_user_rating_text', 
						'not_empty' => true, 
					),
					'group' => esc_html__( 'User Rating Text', 'gpur' ),
				),
					array( 
						'heading' => esc_html__( 'Text Color', 'gpur' ),	
						'param_name' => 'ind_user_rating_number_color',
						'type' => 'colorpicker',
						'value' => '',
						'dependency' => array( 
							'element' => 'show_ind_user_rating_text', 
							'not_empty' => true, 
						),
						'group' => esc_html__( 'User Rating Text', 'gpur' ),
					),			
					array( 
						'heading' => esc_html__( 'Size (px)', 'gpur' ),	
						'param_name' => 'ind_user_rating_number_size',
						'type' => 'textfield',
						'value' => '',
						'dependency' => array( 
							'element' => 'show_ind_user_rating_text', 
							'not_empty' => true, 
						),
						'group' => esc_html__( 'User Rating Text', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Extra CSS', 'gpur' ),	
						'param_name' => 'ind_user_rating_number_extra_css',
						'type' => 'textfield',
						'value' => '',
						'dependency' => array( 
							'element' => 'show_ind_user_rating_text', 
							'not_empty' => true, 
						),
						'group' => esc_html__( 'User Rating Text', 'gpur' ),
					),
					
				// Individual User Rating - Maximum Rating Number											
				array( 
					'param_name' => '_gpur_header_ind_user_rating_max_rating_number',
					'heading' => esc_html__( 'Maximum Rating Number', 'gpur' ),
					'type' => 'gpur_header',
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'dependency' => array( 
						'element' => 'show_ind_user_rating_text', 
						'not_empty' => true, 
					),
					'group' => esc_html__( 'User Rating Text', 'gpur' ),
				),			
					array(	
						'param_name' => 'show_ind_user_rating_max_rating_number',
						'heading' => esc_html__( 'Display', 'gpur' ),
						'type' => 'checkbox',
						'value' => array( '' => '1' ),
						'std' => '',	
						'dependency' => array( 
							'element' => 'show_ind_user_rating_text', 
							'not_empty' => true, 
						),
						'group' => esc_html__( 'User Rating Text', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Color', 'gpur' ),	
						'param_name' => 'ind_user_rating_max_rating_number_color',
						'type' => 'colorpicker',
						'value' => '',
						'dependency' => array( 
							'element' => 'show_ind_user_rating_max_rating_number', 
							'not_empty' => true, 
						),
						'group' => esc_html__( 'User Rating Text', 'gpur' ),
					),			
					array( 
						'heading' => esc_html__( 'Size (px)', 'gpur' ),	
						'param_name' => 'ind_user_rating_max_rating_number_size',
						'type' => 'textfield',
						'value' => '',
						'dependency' => array( 
							'element' => 'show_ind_user_rating_max_rating_number', 
							'not_empty' => true, 
						),
						'group' => esc_html__( 'User Rating Text', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Extra CSS', 'gpur' ),	
						'param_name' => 'ind_user_rating_max_rating_number_extra_css',
						'type' => 'textfield',
						'value' => '',
						'dependency' => array( 
							'element' => 'show_ind_user_rating_max_rating_number', 
							'not_empty' => true, 
						),
						'group' => esc_html__( 'User Rating Text', 'gpur' ),
					),	
		
			/*--------------------------------------------------------------
			Criteria
			--------------------------------------------------------------*/
	
			array( 
				'heading' => esc_html__( 'Criteria', 'gpur' ),					
				'description' => esc_html__( 'Enter each criterion on a new line.', 'gpur' ),
				'param_name' => 'criteria',
				'type' => 'exploded_textarea',
				'value' => '',
				/*REMOVE'dependency' => array( 
					'element' => 'data', 
					'value' => array( 'site-rating', 'custom' ), 
				),*/
				'group' => esc_html__( 'Criteria', 'gpur' ),
			),
												
			array( 
				'heading' => esc_html__( 'Format', 'gpur' ),
				'param_name' => 'format',
				'type' => 'dropdown',
				'value' => array(
					esc_html__( 'Column', 'gpur' ) => 'format-column',
					esc_html__( 'Rows', 'gpur' ) => 'format-rows',
				),
				'std' => 'format-rows',
				'group' => esc_html__( 'Criteria', 'gpur' ),
			),
			
			// Criteria Title
			array( 
				'param_name' => '_gpur_header_criteria_title',
				'heading' => esc_html__( 'Criteria Title', 'gpur' ),
				'type' => 'gpur_header',
				'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
				'group' => esc_html__( 'Criteria', 'gpur' ),
			),	
			
			array( 
				'heading' => esc_html__( 'Color', 'gpur' ),
				'param_name' => 'criteria_title_color',
				'type' => 'colorpicker',
				'value' => '',
				'group' => esc_html__( 'Criteria', 'gpur' ),
			),	
						
			array( 
				'heading' => esc_html__( 'Size (px)', 'gpur' ),
				'param_name' => 'criteria_title_size',
				'type' => 'textfield',
				'value' => '',
				'group' => esc_html__( 'Criteria', 'gpur' ),
			),
					
			array( 
				'heading' => esc_html__( 'Extra CSS', 'gpur' ),
				'param_name' => 'criteria_title_extra_css',
				'type' => 'textfield',
				'value' => '',
				'group' => esc_html__( 'Criteria', 'gpur' ),
			),
									
			// Criteria Boxes
			array( 
				'param_name' => '_gpur_header_criteria_boxes',
				'heading' => esc_html__( 'Criteria Boxes', 'gpur' ),
				'type' => 'gpur_header',
				'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
				'dependency' => array( 
					'element' => 'style', 
					'value' => array( 'style-stars', 'style-hearts', 'style-squares', 'style-circles', 'style-bars', 'style-icon', 'style-image' ), 
				),
				'group' => esc_html__( 'Criteria', 'gpur' ),
			),			
			
			array(	
				'param_name' => 'criterion_boxes',
				'heading' => esc_html__( 'Display', 'gpur' ),
				'description' => esc_html__( 'Add a full width box around each criterion rating.', 'gpur' ),
				'type' => 'checkbox',
				'value' => array( '' => '1' ),
				'std' => '',			
				'dependency' => array( 
					'element' => 'style', 
					'value' => array( 'style-stars', 'style-hearts', 'style-squares', 'style-circles', 'style-bars', 'style-icon', 'style-image' ), 
				),
				'group' => esc_html__( 'Criteria', 'gpur' ),
			),
		
			array( 
				'heading' => esc_html__( 'Padding (px)', 'gpur' ),
				'param_name' => 'criterion_boxes_padding',
				'type' => 'textfield',
				'value' => '',				
				'dependency' => array( 
					'element' => 'criterion_boxes', 
					'not_empty' => true,
				),
				'group' => esc_html__( 'Criteria', 'gpur' ),
			),
			
			array( 
				'heading' => esc_html__( 'Background Color 1', 'gpur' ),
				'param_name' => 'criterion_boxes_bg_color_1',
				'type' => 'colorpicker',
				'value' => '',		
				'dependency' => array( 
					'element' => 'criterion_boxes', 
					'not_empty' => true,
				),
				'group' => esc_html__( 'Criteria', 'gpur' ),
			),	
			
			array( 
				'heading' => esc_html__( 'Background Color 2', 'gpur' ),
				'param_name' => 'criterion_boxes_bg_color_2',
				'type' => 'colorpicker',
				'value' => '',			
				'dependency' => array( 
					'element' => 'criterion_boxes', 
					'not_empty' => true,
				),
				'group' => esc_html__( 'Criteria', 'gpur' ),
			),		
			
			array( 
				'heading' => esc_html__( 'Border Width (px)', 'gpur' ),
				'param_name' => 'criterion_boxes_border_width',
				'type' => 'textfield',
				'value' => '',				
				'dependency' => array( 
					'element' => 'criterion_boxes', 
					'not_empty' => true,
				),
				'group' => esc_html__( 'Criteria', 'gpur' ),
			),	
			
			array( 
				'heading' => esc_html__( 'Border Color', 'gpur' ),
				'param_name' => 'criterion_boxes_border_color',
				'type' => 'colorpicker',
				'value' => '',				
				'dependency' => array( 
					'element' => 'criterion_boxes', 
					'not_empty' => true,
				),
				'group' => esc_html__( 'Criteria', 'gpur' ),
			),		
			
			array( 
				'heading' => esc_html__( 'Extra CSS', 'gpur' ),
				'param_name' => 'criterion_boxes_extra_css',
				'type' => 'textfield',
				'value' => '',				
				'dependency' => array( 
					'element' => 'criterion_boxes', 
					'not_empty' => true,
				),
				'group' => esc_html__( 'Criteria', 'gpur' ),
			),
				
			/*--------------------------------------------------------------
			Ranges Text
			--------------------------------------------------------------*/
		
			array(
				'param_name' => 'show_ranges_text',
				'heading' => esc_html__( 'Display', 'gpur' ),
				'type' => 'checkbox',
				'value' => array( '' => '1' ),
				'std' => '1',
				'group' => esc_html__( 'Ranges Text', 'gpur' ),
			),

			array(
				'heading' => esc_html__( 'Rating Ranges', 'gpur' ),
				'description' => esc_html__( 'Set up your rating ranges in the follow way', 'gpur' ) . ' <code>' . esc_html__( 'Score 1-Score 2:Rating Text, Score 3-Score 4:Rating Text', 'gpur' ) . '</code>' . esc_html__( 'e.g.', 'gpur' ) . '<code>' . esc_html__( '0-2:Awful, 2.5-4:Bad, 4.5-6:Average, 6.5-8:Good, 8.5-10:Amazing', 'gpur' ) . '</code>',
				'param_name' => 'rating_ranges',
				'type' => 'textfield',
				'value' => '0-1.9:Awful, 2-2.9:Bad, 3-3.9:Average, 4-4.9:Good, 5-5:Amazing',
				'dependency' => array( 
					'element' => 'show_ranges_text', 
					'not_empty' => true,
				),
				'group' => esc_html__( 'Ranges Text', 'gpur' ),
			),								
		
			array( 
				'heading' => esc_html__( 'Color', 'gpur' ),	
				'param_name' => 'ranges_text_color',
				'type' => 'colorpicker',
				'value' => '',
				'dependency' => array( 
					'element' => 'show_ranges_text', 
					'not_empty' => true,
				),
				'group' => esc_html__( 'Ranges Text', 'gpur' ),
			),
			
			array( 
				'heading' => esc_html__( 'Size (px)', 'gpur' ),	
				'param_name' => 'ranges_text_size',
				'type' => 'textfield',
				'value' => '',
				'dependency' => array( 
					'element' => 'show_ranges_text', 
					'not_empty' => true,
				),
				'group' => esc_html__( 'Ranges Text', 'gpur' ),
			),
			
			array( 
				'heading' => esc_html__( 'Extra CSS', 'gpur' ),	
				'param_name' => 'ranges_text_extra_css',
				'type' => 'textfield',
				'value' => '',
				'dependency' => array( 
					'element' => 'show_ranges_text', 
					'not_empty' => true,
				),
				'group' => esc_html__( 'Ranges Text', 'gpur' ),
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
				
		) );	
					
		vc_map( array( 
			'name' => esc_html__( 'Show Rating', 'gpur' ),
			'base' => 'gpur_show_rating',
			'description' => '',
			'class' => 'gpur-wpb-show-rating',
			'controls' => 'full',
			'icon' => 'gpur-icon-show-rating',
			'category' => esc_html__( 'Review', 'gpur' ),
			'params' => $gpur_show_rating_params,
		) );
		
	}		
} 
add_action( 'vc_before_init', 'gpur_wpb_show_rating_options' );	
		
/**
 * Shortcode
 *
 */
if ( ! function_exists( 'gpur_show_rating_shortcode' ) ) {
	function gpur_show_rating_shortcode( $atts ) {

		$atts = shortcode_atts( gpur_show_rating_shortcode_atts(), $atts, 'gpur_show_rating_shortcode' );
		
		// Extract attributes
		extract( $atts );

		ob_start();
		
		// Load template
		echo gpur_show_rating_template( 
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
add_shortcode( 'gpur_show_rating', 'gpur_show_rating_shortcode' ); 