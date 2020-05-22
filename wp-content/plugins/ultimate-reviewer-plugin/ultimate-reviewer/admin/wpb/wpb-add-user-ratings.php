<?php 

/**
 * Options
 *
 */
if ( ! function_exists( 'gpur_wpb_add_user_rating_options' ) ) {
	function gpur_wpb_add_user_rating_options() { 
	
		vc_map( array( 
			'name' => esc_html__( 'Add User Rating', 'gpur' ),
			'base' => 'gpur_add_user_ratings',
			'description' => '',
			'class' => 'gpur-wpb-add-user-ratings',
			'controls' => 'full',
			'icon' => 'gpur-icon-add-user-ratings',
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
					'value' => esc_html__( 'Add Rating', 'gpur' ),
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
					'heading' => esc_html__( 'Minimum Rating', 'gpur' ),
					'param_name' => 'min_rating',
					'type' => 'textfield',
					'value' => 0,
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
				
				/*--------------------------------------------------------------
				Criteria
				--------------------------------------------------------------*/

				array( 
					'heading' => esc_html__( 'Criteria & Weights', 'gpur' ),
					'description' => esc_html__( 'Enter each criterion on a new line. To add weights add a colon and then the weight e.g.', 'gpur' ) . '<br/><code>' . esc_html__( 'Criterion 1:0.5', 'gpur' ) . '</code><br/><code>' . esc_html__( 'Criterion 2:0.75', 'gpur' ) . '</code>',
					'param_name' => 'criteria',
					'type' => 'exploded_textarea',
					'value' => '',
					'group' => esc_html__( 'Criteria', 'gpur' ),
				),
												
				array( 
					'heading' => esc_html__( 'Format', 'gpur' ),
					'param_name' => 'criteria_format',
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Column', 'gpur' ) => 'format-column',
						esc_html__( 'Rows', 'gpur' ) => 'format-rows',
					),
					'std' => 'format-column',
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
				Rating Style
				--------------------------------------------------------------*/							
				
				array( 
					'heading' => esc_html__( 'Style', 'gpur' ),
					'param_name' => 'style',
					'type' => 'dropdown',
					'admin_label' => true,
					'value' => array(
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
				Rating Text
				--------------------------------------------------------------*/

				// Average User Rating Text 
				array( 
					'param_name' => '_gpur_tab_avg_user_rating_text',
					'heading' => esc_html__( 'Average User Rating Text', 'gpur' ),
					'type' => 'gpur_tab',
					'dependency' => array( 
						'element' => 'data', 
						'value' => 'user-rating' 
					),
					'group' => esc_html__( 'Rating Text', 'gpur' ),
				),	
			
				array(	
					'param_name' => 'show_avg_user_rating_text',
					'heading' => esc_html__( 'Display', 'gpur' ),
					'type' => 'checkbox',
					'value' => array( '' => '1' ),
					'std' => '1',
					'dependency' => array( 
						'element' => 'data', 
						'value' => 'user-rating' 
					),
					'group' => esc_html__( 'Rating Text', 'gpur' ),
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
					'group' => esc_html__( 'Rating Text', 'gpur' ),
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
						'group' => esc_html__( 'Rating Text', 'gpur' ),
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
						'group' => esc_html__( 'Rating Text', 'gpur' ),
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
						'group' => esc_html__( 'Rating Text', 'gpur' ),
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
						'group' => esc_html__( 'Rating Text', 'gpur' ),
					),
				
				// Average User Rating - Rating Number
				array( 
					'param_name' => '_gpur_header_avg_user_rating_number',
					'heading' => esc_html__( 'Rating Number', 'gpur' ),
					'type' => 'gpur_header',
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'dependency' => array( 
						'element' => 'show_avg_user_rating_text', 
						'not_empty' => true,
					),
					'group' => esc_html__( 'Rating Text', 'gpur' ),
				),
					array( 
						'heading' => esc_html__( 'Text Color', 'gpur' ),	
						'param_name' => 'avg_user_rating_number_color',
						'type' => 'colorpicker',
						'value' => '',
						'dependency' => array( 
							'element' => 'show_avg_user_rating_text', 
							'not_empty' => true, 
						),
						'group' => esc_html__( 'Rating Text', 'gpur' ),
					),			
					array( 
						'heading' => esc_html__( 'Size (px)', 'gpur' ),	
						'param_name' => 'avg_user_rating_number_size',
						'type' => 'textfield',
						'value' => '',
						'dependency' => array( 
							'element' => 'show_avg_user_rating_text', 
							'not_empty' => true, 
						),
						'group' => esc_html__( 'Rating Text', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Extra CSS', 'gpur' ),	
						'param_name' => 'avg_user_rating_number_extra_css',
						'type' => 'textfield',
						'value' => '',
						'dependency' => array( 
							'element' => 'show_avg_user_rating_text', 
							'not_empty' => true, 
						),
						'group' => esc_html__( 'Rating Text', 'gpur' ),
					),
					
				// Average User Rating - Maximum Rating Number											
				array( 
					'param_name' => '_gpur_header_avg_user_rating_max_rating_number',
					'heading' => esc_html__( 'Maximum Rating Number', 'gpur' ),
					'type' => 'gpur_header',
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'dependency' => array( 
						'element' => 'show_avg_user_rating_text', 
						'not_empty' => true,
					),
					'group' => esc_html__( 'Rating Text', 'gpur' ),
				),			
					array(	
						'param_name' => 'show_avg_user_rating_max_rating_number',
						'heading' => esc_html__( 'Display', 'gpur' ),
						'type' => 'checkbox',
						'value' => array( '' => '1' ),
						'std' => '',
						'dependency' => array( 
							'element' => 'show_avg_user_rating_text', 
							'not_empty' => true,
						),
						'group' => esc_html__( 'Rating Text', 'gpur' ),
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
						'group' => esc_html__( 'Rating Text', 'gpur' ),
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
						'group' => esc_html__( 'Rating Text', 'gpur' ),
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
						'group' => esc_html__( 'Rating Text', 'gpur' ),
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
					'group' => esc_html__( 'Rating Text', 'gpur' ),
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
						'group' => esc_html__( 'Rating Text', 'gpur' ),
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
						'group' => esc_html__( 'Rating Text', 'gpur' ),
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
						'group' => esc_html__( 'Rating Text', 'gpur' ),
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
						'group' => esc_html__( 'Rating Text', 'gpur' ),
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
						'group' => esc_html__( 'Rating Text', 'gpur' ),
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
						'group' => esc_html__( 'Rating Text', 'gpur' ),
					),

				// Individual User Rating Text
				array( 
					'param_name' => '_gpur_tab_ind_user_rating_text',
					'heading' => esc_html__( 'Individual User Rating Text', 'gpur' ),
					'type' => 'gpur_tab',				
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'dependency' => array( 
						'element' => 'data', 
						'value' => 'user-rating' 
					),
					'group' => esc_html__( 'Rating Text', 'gpur' ),
				),	
					array(
						'param_name' => 'show_ind_user_rating_text',
						'heading' => esc_html__( 'Display', 'gpur' ),
						'type' => 'checkbox',
						'value' => array( '' => '1' ),
						'std' => '1',
						'dependency' => array( 
							'element' => 'data', 
							'value' => 'user-rating' 
						),
						'group' => esc_html__( 'Rating Text', 'gpur' ),
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
						'group' => esc_html__( 'Rating Text', 'gpur' ),
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
						'group' => esc_html__( 'Rating Text', 'gpur' ),
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
							'group' => esc_html__( 'Rating Text', 'gpur' ),
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
							'group' => esc_html__( 'Rating Text', 'gpur' ),
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
							'group' => esc_html__( 'Rating Text', 'gpur' ),
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
						'group' => esc_html__( 'Rating Text', 'gpur' ),
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
							'group' => esc_html__( 'Rating Text', 'gpur' ),
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
							'group' => esc_html__( 'Rating Text', 'gpur' ),
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
							'group' => esc_html__( 'Rating Text', 'gpur' ),
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
						'group' => esc_html__( 'Rating Text', 'gpur' ),
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
							'group' => esc_html__( 'Rating Text', 'gpur' ),
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
							'group' => esc_html__( 'Rating Text', 'gpur' ),
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
							'group' => esc_html__( 'Rating Text', 'gpur' ),
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
							'group' => esc_html__( 'Rating Text', 'gpur' ),
						),	

				/*--------------------------------------------------------------
				Submit Button
				--------------------------------------------------------------*/
				
				array(
					'param_name' => 'show_submit_button',
					'heading' => esc_html__( 'Display', 'gpur' ),
					'type' => 'checkbox',
					'value' => array( '' => '1' ),
					'std' => '',
					'group' => esc_html__( 'Submit Button', 'gpur' ),
				),
				
				array( 
					'heading' => esc_html__( 'Label', 'gpur' ),
					'param_name' => 'submit_button_label',
					'type' => 'textfield',
					'value' => esc_html__( 'Submit Rating', 'gpur' ),
					'group' => esc_html__( 'Submit Button', 'gpur' ),
				),
				
				array( 
					'heading' => esc_html__( 'Text Color', 'gpur' ),
					'param_name' => 'submit_button_text_color',
					'type' => 'colorpicker',
					'value' => '',
					'group' => esc_html__( 'Submit Button', 'gpur' ),
				),		
						
				array( 
					'heading' => esc_html__( 'Text Hover Color', 'gpur' ),
					'param_name' => 'submit_button_text_hover_color',
					'type' => 'colorpicker',
					'value' => '',
					'group' => esc_html__( 'Submit Button', 'gpur' ),
				),
				
				array( 
					'heading' => esc_html__( 'Border Color', 'gpur' ),
					'param_name' => 'submit_button_border_color',
					'type' => 'colorpicker',
					'value' => '',
					'group' => esc_html__( 'Submit Button', 'gpur' ),
				),
				
				array( 
					'heading' => esc_html__( 'Border Hover Color', 'gpur' ),
					'param_name' => 'submit_button_border_hover_color',
					'type' => 'colorpicker',
					'value' => '',
					'group' => esc_html__( 'Submit Button', 'gpur' ),
				),
				
				array( 
					'heading' => esc_html__( 'Background Color', 'gpur' ),
					'param_name' => 'submit_button_bg_color',
					'type' => 'colorpicker',
					'value' => '',
					'group' => esc_html__( 'Submit Button', 'gpur' ),
				),
				
				array( 
					'heading' => esc_html__( 'Background Hover Color', 'gpur' ),
					'param_name' => 'submit_button_bg_hover_color',
					'type' => 'colorpicker',
					'value' => '',
					'group' => esc_html__( 'Submit Button', 'gpur' ),
				),
				
				array( 
					'heading' => esc_html__( 'Extra CSS', 'gpur' ),
					'param_name' => 'submit_button_css',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Submit Button', 'gpur' ),
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
								
				/*--------------------------------------------------------------
				Other
				--------------------------------------------------------------*/
				
				array( 
					'heading' => esc_html__( 'Logged In To Vote Label', 'gpur' ),
					'param_name' => 'logged_in_to_vote_label',
					'type' => 'textfield',
					'value' => esc_html__( 'You must be logged in to vote.', 'gpur' ),
					'group' => esc_html__( 'Other', 'gpur' ),
				),	
											
				array( 
					'heading' => esc_html__( 'Success Message (Single Rating)', 'gpur' ),
					'param_name' => 'single_success_message',
					'type' => 'textfield',
					'value' => esc_html__( 'Thanks for submitting your rating!', 'gpur' ),
					'group' => esc_html__( 'Other', 'gpur' ),
				),	
							
				array( 
					'heading' => esc_html__( 'Error Message (Single Rating)', 'gpur' ),
					'param_name' => 'single_error_message',
					'type' => 'textfield',
					'value' => esc_html__( 'Please give a rating.', 'gpur' ),
					'group' => esc_html__( 'Other', 'gpur' ),
				),
							
				array( 
					'heading' => esc_html__( 'Success Message (Multi Rating)', 'gpur' ),
					'param_name' => 'multi_success_message',
					'type' => 'textfield',
					'value' => esc_html__( 'Thanks for submitting your ratings!', 'gpur' ),
					'group' => esc_html__( 'Other', 'gpur' ),
				),
							
				array( 
					'heading' => esc_html__( 'Error Message (Multi Rating)', 'gpur' ),
					'description' => '',
					'param_name' => 'multi_error_message',
					'type' => 'textfield',
					'value' => esc_html__( 'Please give a rating for each criterion.', 'gpur' ),
					'group' => esc_html__( 'Other', 'gpur' ),
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
add_action( 'vc_before_init', 'gpur_wpb_add_user_rating_options' );
	
/**
 * Shortcode
 *
 */
if ( ! function_exists( 'gpur_add_user_ratings_shortcode' ) ) {
	function gpur_add_user_ratings_shortcode( $atts ) {
		
		$atts = shortcode_atts( gpur_add_user_ratings_shortcode_atts(), $atts, 'gpur_add_user_ratings_shortcode' );

		// Extract attributes
		extract( $atts );

		ob_start();
		
		// Load template
		echo gpur_add_user_ratings_template(
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
add_shortcode( 'gpur_add_user_ratings', 'gpur_add_user_ratings_shortcode' );