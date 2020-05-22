<?php class GPUR_Elementor_Add_User_Rating_Widget extends Elementor\Widget_Base {

	public function get_name() {
		return 'gpur_add_user_rating';
	}

	public function get_title() {
		return esc_html__( 'Add User Rating', 'gpur' );
	}

	public function get_icon() {
		return 'eicon-rating';
	}

	public function get_categories() {
		if ( 'gpur-template' === get_post_type() OR 'item' === get_post_meta( get_the_ID(), 'gp_template_type', true ) ) {
			return [ 'review' ];
		}
	}
	
	protected function _register_controls() {

		/*--------------------------------------------------------------
		Title
		--------------------------------------------------------------*/

		$this->start_controls_section(
			'_gpur_section_element_title',
			[
				'label' => esc_html__( 'Title', 'gpur' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
	
			$this->add_control(
				'title',
				[
					'label' => esc_html__( 'Title', 'gpur' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,
					'input_type' => 'text',
					'placeholder' => '',
					'default' => esc_html__( 'Add Rating', 'gpur' ),
				]
			);
			
			$this->add_control( 
				'title_color',
				[
					'label' => esc_html__( 'Text Color', 'gpur' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'condition' => [
						'title!' => '',
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-element-title' => 'color: {{VALUE}};',
					],
				]	
			);
			
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'label' => esc_html__( 'Typography', 'gpur' ),
					'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_3,
					'default' => array(
						'font_weight' => '400',
					),
					'condition' => [
						'title!' => '',
					],
					'selector' => '{{WRAPPER}} .gpur-element-title',
				]
			);
			
			$this->add_control( 
				'title_extra_css',
				[
					'label' => esc_html__( 'Extra CSS', 'gpur' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,
					'condition' => [
						'title!' => '',
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-element-title' => '{{VALUE}}',
					],
				]
			);
		
		$this->end_controls_section();
						
		/*--------------------------------------------------------------
		Rating Controls
		--------------------------------------------------------------*/

		$this->start_controls_section(
			'_gpur_section_rating_controls',
			[
				'label' => esc_html__( 'Rating Controls', 'gpur' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
							
			$this->add_control(
				'min_rating',
				[
					'label' => esc_html__( 'Minimum Rating', 'gpur' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'default' => 0,
				]
			);
						
			$this->add_control(
				'max_rating',
				[
					'label' => esc_html__( 'Maximum Rating', 'gpur' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'default' => 5,
				]
			);
				
			$this->add_control(
				'fractions',
				[
					'label' => esc_html__( 'Rating Fractions', 'gpur' ),
					'description' => esc_html__( 'The increments you can rate for each rating symbol.', 'gpur' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'default' => 1,
				]	
			);		
				
			$this->add_control(
				'step',
				[
					'label' => esc_html__( 'Rating Step', 'gpur' ),
					'description' => esc_html__( 'The rating range spans all the integers from minimum to max rating.', 'gpur' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'default' => 1,
				]
			);
			
		$this->end_controls_section();
		
		/*--------------------------------------------------------------
		Criteria
		--------------------------------------------------------------*/

		$this->start_controls_section(
			'_gpur_section_criteria',
			[
				'label' => esc_html__( 'Criteria', 'gpur' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
				
			$this->add_control(
				'criteria',
				[
					'label' => esc_html__( 'Criteria & Weights', 'gpur' ),
					'description' => esc_html__( 'Enter each criterion on a new line. To add weights add a colon and then the weight e.g.', 'gpur' ) . '<br/><code>' . esc_html__( 'Criterion 1:0.5', 'gpur' ) . '</code><br/><code>' . esc_html__( 'Criterion 2:0.75', 'gpur' ) . '</code>',
					'type' => \Elementor\Controls_Manager::TEXTAREA,
				]	
			);
				
			$this->add_control(
				'criteria_format',
				[
					'label' => esc_html__( 'Format', 'gpur' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => array(
						'format-column' => esc_html__( 'Column', 'gpur' ),
						'format-rows' => esc_html__( 'Rows', 'gpur' ),
					),
					'default' => 'format-column',
					'condition' => [
						'criteria!' => '',
					],
				]	
			);
			
			$this->add_control( 
				'criteria_title_color',
				[
					'label' => esc_html__( 'Text Color', 'gpur' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'condition' => [
						'criteria!' => '',
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-criterion-title' => 'color: {{VALUE}};',
					],
				]
			);
			
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'criteria_title_typography',
					'label' => esc_html__( 'Typography', 'gpur' ),
					'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_3,
					'default' => array(
						'font_weight' => '400',
					),
					'condition' => [
						'criteria!' => '',
					],
					'selector' => '{{WRAPPER}} .gpur-criterion-title',
				]
			);
						
			$this->add_control( 
				'criteria_title_extra_css',
				[
					'label' => esc_html__( 'Text Extra CSS', 'gpur' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,
					'condition' => [
						'criteria!' => '',
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-criterion-title' => '{{VALUE}}',
					],
				]
			);
			
			$this->add_control(
				'criterion_boxes',
				[
					'label' => esc_html__( 'Criterion Boxes', 'gpur' ),
					'description' => esc_html__( 'Add a full width box around each criterion rating.', 'gpur' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'return_value' => '1',
					'default' => '1',
					'condition' => [
						'criteria!' => '',
					],
				]
			);	

			$this->add_control( 
				'criterion_boxes_padding',
				[
					'label' => esc_html__( 'Padding', 'gpur' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'default' => [
						'top' => '',
						'right' => '',							
						'bottom' => '',
						'left' => '',
						'unit' => 'px',
					],
					'condition' => [
						'criterion_boxes' => '1',
						'criteria!' => '',
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-criterion-boxes .gpur-criterion' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]	
			);

			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => ' criterion_boxes_background_1',
					'condition' => [
						'criterion_boxes' => '1',
						'criteria!' => '',
					],
					'selector' => '{{WRAPPER}} .gpur-criterion-boxes .gpur-criterion:nth-child(odd)',
				]
			);
			
			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'criterion_boxes_background_2',
					'condition' => [
						'criterion_boxes' => '1',
						'criteria!' => '',
					],
					'selector' => '{{WRAPPER}} .gpur-criterion-boxes .gpur-criterion:nth-child(even)',
				]
			);			
			
			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'criterion_boxes_border',
					'label' => esc_html__( 'Border', 'gpur' ),
					'condition' => [
						'criterion_boxes' => '1',
						'criteria!' => '',
					],
					'selector' => '{{WRAPPER}} .gpur-criterion-boxes .gpur-criterion',
				]
			);
			
			$this->add_control( 
				'criterion_boxes_extra_css',
				[
					'label' => esc_html__( 'Boxes Extra CSS', 'gpur' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,		
					'condition' => [
						'criterion_boxes' => '1',
						'criteria!' => '',
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-criterion-boxes .gpur-criterion' => '{{VALUE}}',
					],
				]
			);
			
		$this->end_controls_section();
						
		/*--------------------------------------------------------------
		Rating Style
		--------------------------------------------------------------*/

		$this->start_controls_section(
			'_gpur_section_rating_style',
			[
				'label' => esc_html__( 'Rating Style', 'gpur' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
											
			$this->add_control(
				'style',
				[
					'label' => esc_html__( 'Style', 'gpur' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => array(
						'style-stars' => esc_html__( 'Stars', 'gpur' ),
						'style-hearts' => esc_html__( 'Hearts', 'gpur' ),
						'style-squares' => esc_html__( 'Squares', 'gpur' ),
						'style-circles' => esc_html__( 'Circles', 'gpur' ),
						'style-bars' => esc_html__( 'Bars', 'gpur' ),
						'style-icon' => esc_html__( 'Custom Icon', 'gpur' ),
						'style-image' => esc_html__( 'Custom Image', 'gpur' ),
					),
					'default' => 'style-stars',
				]
			);

			$this->add_control(
				'position',
				[
					'label' => esc_html__( 'Position', 'gpur' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => array(
						'position-left' => esc_html__( 'Left', 'gpur' ),
						'position-center' => esc_html__( 'Center', 'gpur' ),
						'position-right' => esc_html__( 'Right', 'gpur' ),
					),
					'default' => 'position-left',
				]
			);

			$this->add_control(
				'text_position',
				[
					'label' => esc_html__( 'Rating Text Position', 'gpur' ),
					'description' => '',
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => array(
						'position-text-top' => esc_html__( 'Top', 'gpur' ),
						'position-text-bottom' => esc_html__( 'Bottom', 'gpur' ),
						'position-text-left' => esc_html__( 'Left', 'gpur' ),
						'position-text-right' => esc_html__( 'Right', 'gpur' ),
					),
					'default' => 'position-text-bottom',
				]
			);

			$this->add_control(
				'rating_image',
				[
					'label' => esc_html__( 'Custom Image', 'gpur' ),
					'description' => esc_html__( 'Your image should include the filled and empty icons. For an example see the', 'gpur' ) . ' <a href="' . GPUR_URL . 'public/images/default-rating-image.png" target="_blank">' . esc_html__( 'default image', 'gpur' ) . '</a>.',
					'type' => \Elementor\Controls_Manager::MEDIA,
					'condition' => [
						'style' => 'style-image',
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-style-image .gpur-symbol-empty, {{WRAPPER}} .gpur-style-image .gpur-symbol-filled' => 'background-image: url("{{URL}}");',
					],
				]
			);
							
			$this->add_control(
				'empty_icon',
				[
					'label' => esc_html__( 'Empty Icon', 'gpur' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'fas fa-star',
						'library' => 'solid',
					],
					'condition' => [
						'style' => 'style-icon', 
					],
				]
			);	
					
			$this->add_control(
				'empty_icon_color',
				[
					'label' => esc_html__( 'Empty Icon Color', 'gpur' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'condition' => [
						'style' => array( 'style-stars', 'style-hearts', 'style-squares', 'style-circles', 'style-bars', 'style-icon' ), 
					],
					'selectors' => [
						'{{WRAPPER}} .rating-symbol-background' => 'color: {{VALUE}};',
						'{{WRAPPER}} .gpur-style-circles .gpur-symbol-empty, {{WRAPPER}} .gpur-style-squares .gpur-symbol-empty, {{WRAPPER}} .gpur-style-bars .gpur-symbol-empty' => 'background-color: {{VALUE}};',
					],
				]
			);
			
			$this->add_control(
				'filled_icon',
				[
					'label' => esc_html__( 'Filled Icon', 'gpur' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'fas fa-star',
						'library' => 'solid',
					],
					'condition' => [
						'style' => 'style-icon', 
					],
				]	
			);		
			
			$this->add_control(
				'filled_icon_color',
				[
					'label' => esc_html__( 'Filled Icon Color', 'gpur' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'condition' => [
						'style' => array( 'style-stars', 'style-hearts', 'style-squares', 'style-circles', 'style-bars', 'style-icon' ), 
					],
					'selectors' => [
						'{{WRAPPER}} .rating-symbol-foreground' => 'color: {{VALUE}};',
						'{{WRAPPER}} .gpur-style-circles .gpur-symbol-filled, {{WRAPPER}} .gpur-style-squares .gpur-symbol-filled, {{WRAPPER}} .gpur-style-bars .gpur-symbol-filled' => 'background-color: {{VALUE}};',
					],
				]	
			);		
								
			$this->add_control(
				'icon_width',
				[
					'label' => esc_html__( 'Width', 'gpur' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em' ],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 1000,
							'step' => 1,
						],	
						'%' => [
							'min' => 1,
							'max' => 1000,
							'step' => 1,
						],	
					],	
					'default' => [
						'unit' => 'px',
						'size' => '',
					],
					'condition' => [
						'style' => array( 'style-stars', 'style-hearts', 'style-squares', 'style-circles', 'style-icon', 'style-image' ), 
					],
					'selectors' => [
						'{{WRAPPER}} .rating-symbol' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .gpur-style-circles .gpur-symbol, {{WRAPPER}} .gpur-style-squares .gpur-symbol, .gpur-style-image .gpur-symbol' => 'width: {{SIZE}}{{UNIT}};',
					],	
				]	
			);
			
			$this->add_control(
				'icon_height',
				[
					'label' => esc_html__( 'Height', 'gpur' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em' ],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 1000,
							'step' => 1,
						],	
						'%' => [
							'min' => 1,
							'max' => 1000,
							'step' => 1,
						],	
					],	
					'default' => [
						'unit' => 'px',
						'size' => '',
					],
					'condition' => [
						'style' => array( 'style-squares', 'style-circles', 'style-bars', 'style-icon', 'style-image' ),
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-style-bars .gpur-symbol, {{WRAPPER}} .gpur-style-circles .gpur-symbol, {{WRAPPER}} .gpur-style-squares .gpur-symbol, .gpur-style-image .gpur-symbol' => 'height: {{SIZE}}{{UNIT}};',
					],	
				]	
			);

		$this->end_controls_section();

		/*--------------------------------------------------------------
		Rating Text
		--------------------------------------------------------------*/

		$this->start_controls_section(
			'_gpur_section_avg_user_rating_text',
			[
				'label' => esc_html__( 'Average User Rating Text', 'gpur' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
			$this->add_control(
				'show_avg_user_rating_text',
				[
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label' => esc_html__( 'Display', 'gpur' ),
					'return_value' => '1',
					'default' => '1',
				]
			);
											
			$this->add_control( '_gpur_divider_avg_user_rating_label', [ 
				'type' => \Elementor\Controls_Manager::DIVIDER, 					
				'condition' => [
					'show_avg_user_rating_text' => '1',
					'style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
				],
			] );
													
			// Average User Rating - Label
			$this->add_control(
				'_gpur_header_avg_user_rating_label',
				[
					'label' => esc_html__( 'Label', 'gpur' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'condition' => [
						'show_avg_user_rating_text' => '1',
						'style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
					],
				]	
			);						
			$this->add_control( 
				'avg_user_rating_label',
				[
					'label' => esc_html__( 'Label', 'gpur' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Average User Rating:', 'gpur' ),
					'condition' => [
						'show_avg_user_rating_text' => '1',
						'style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
					],
				]	
			);	
			$this->add_control( 
				'avg_user_rating_label_color',
				[
					'label' => esc_html__( 'Text Color', 'gpur' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'condition' => [
						'show_avg_user_rating_text' => '1',
						'style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-avg-user-rating-label' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'avg_user_rating_label_typography',
					'label' => esc_html__( 'Typography', 'gpur' ),
					'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_3,
					'default' => array(
						'font_weight' => '400',
					),
					'condition' => [
						'show_avg_user_rating_text' => '1',
						'style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
					],
					'selector' => '{{WRAPPER}} .gpur-avg-user-rating-label',
				]
			);		
			$this->add_control( 
				'avg_user_rating_label_extra_css',
				[
					'label' => esc_html__( 'Extra CSS', 'gpur' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,
					'condition' => [
						'show_avg_user_rating_text' => '1',
						'style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-avg-user-rating-label' => '{{VALUE}}',
					],
				]
			);	
			
			$this->add_control( '_gpur_divider_avg_user_rating_number', [ 
				'type' => \Elementor\Controls_Manager::DIVIDER, 						
				'condition' => [
					'show_avg_user_rating_text' => '1',
				], 
			] );
			
			// Average User Rating - Rating Number
			$this->add_control(
				'_gpur_header_avg_user_rating_number',
				[
					'label' => esc_html__( 'Rating Number', 'gpur' ),
					'type' => \Elementor\Controls_Manager::HEADING,
				]	
			);
			$this->add_control( 
				'avg_user_rating_number_color',
				[
					'label' => esc_html__( 'Text Color', 'gpur' ),	
					'type' => \Elementor\Controls_Manager::COLOR,
					'condition' => [
						'show_avg_user_rating_text' => '1',
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-avg-user-rating' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'avg_user_rating_number_typography',
					'label' => esc_html__( 'Typography', 'gpur' ),
					'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_3,
					'default' => array(
						'font_weight' => '400',
					),
					'condition' => [
						'show_avg_user_rating_text' => '1',
					],
					'selector' => '{{WRAPPER}} .gpur-avg-user-rating',
				]
			);
			$this->add_control( 
				'avg_user_rating_number_extra_css',
				[
					'label' => esc_html__( 'Extra CSS', 'gpur' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,
					'condition' => [
						'show_avg_user_rating_text' => '1',
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-avg-user-rating' => '{{VALUE}}',
					],
				]	
			);

			$this->add_control( '_gpur_divider_avg_user_max_rating_number', [ 
				'type' => \Elementor\Controls_Manager::DIVIDER,							
				'condition' => [
					'show_avg_user_rating_text' => '1',
				], 
			] );
			
			// Average User Rating - Maximum Rating Number
			$this->add_control(
				'_gpur_header_avg_user_rating_max_rating_number',
				[
					'label' => esc_html__( 'Maximum Rating Number', 'gpur' ),
					'type' => \Elementor\Controls_Manager::HEADING,
				]	
			);						
			$this->add_control(
				//formerly'show_max_rating_number',
				'show_avg_user_rating_max_rating_number',
				[
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label' => esc_html__( 'Display', 'gpur' ),				
					'return_value' => '1',
					'default' => '',
				]	
			);
			$this->add_control( 
				'avg_user_rating_max_rating_number_color',
				[
					'label' => esc_html__( 'Color', 'gpur' ),
					'type' => \Elementor\Controls_Manager::COLOR,					
					'condition' => [
						'show_avg_user_rating_max_rating_number' => '1',
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-avg-user-rating .gpur-max-rating' => 'color: {{VALUE}};',
					],	
				]	
			);
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'avg_user_rating_max_rating_number_typography',
					'label' => esc_html__( 'Typography', 'gpur' ),
					'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_3,
					'default' => array(
						'font_weight' => '400',
					),					
					'condition' => [
						'show_avg_user_rating_max_rating_number' => '1',
					],
					'selector' => '{{WRAPPER}} .gpur-avg-user-rating .gpur-max-rating',
				]
			);
			$this->add_control( 
				'avg_user_rating_max_rating_number_extra_css',
				[
					'label' => esc_html__( 'Extra CSS', 'gpur' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,					
					'condition' => [
						'show_avg_user_rating_max_rating_number' => '1',	
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-avg-user-rating .gpur-max-rating' => '{{VALUE}}',
					],	
				]	
			);						
			
		$this->end_controls_section();
		
		/*--------------------------------------------------------------
		User Votes Text
		--------------------------------------------------------------*/

		$this->start_controls_section(
			'_gpur_section_user_votes_text',
			[
				'label' => esc_html__( 'User Votes Text', 'gpur' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
			
			$this->add_control(
				'show_user_votes_text',
				[
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label' => esc_html__( 'Display', 'gpur' ),
					'return_value' => '1',
					'default' => '1',
				]
			);

			$this->add_control( 
				'singular_vote_label',
				[
					'label' => esc_html__( 'Label (Singular)', 'gpur' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'vote', 'gpur' ),
					'condition' => [
						'show_user_votes_text' => '1',
					],
				]	
			);
							
			$this->add_control( 
				'plural_vote_label',
				[
					'label' => esc_html__( 'Label (Plural)', 'gpur' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'votes', 'gpur' ),
					'condition' => [
						'show_user_votes_text' => '1',
					],
				]
			);
			
			$this->add_control( 
				'user_votes_text_color',
				[
					'label' => esc_html__( 'Text Color', 'gpur' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'condition' => [
						'show_user_votes_text' => '1',
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-user-votes' => 'color: {{VALUE}};',
					],
				]	
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'user_votes_text_typography',
					'label' => esc_html__( 'Typography', 'gpur' ),
					'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_3,
					'default' => array(
						'font_weight' => '400',
					),
					'condition' => [
						'show_user_votes_text' => '1',
					],
					'selector' => '{{WRAPPER}} .gpur-user-votes',
				]
			);
						
			$this->add_control( 
				'user_votes_text_extra_css',
				[
					'label' => esc_html__( 'Extra CSS', 'gpur' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,
					'condition' => [
						'show_user_votes_text' => '1',
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-user-votes' => '{{VALUE}}',
					],
				]	
			);
		
		$this->end_controls_section();
				
		/*--------------------------------------------------------------
		Individual User Rating Text
		--------------------------------------------------------------*/

		$this->start_controls_section(
			'_gpur_section_ind_user_rating_text',
			[
				'label' => esc_html__( 'Individual User Rating', 'gpur' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);		
		
			$this->add_control(
				//formely'show_your_user_rating_text',
				'show_ind_user_rating_text',
				[
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label' => esc_html__( 'Display', 'gpur' ),
					'return_value' => '1',
					'default' => '1',
				]
			);
			
			$this->add_control( '_gpur_divider_ind_user_rating_label', [ 
				'type' => \Elementor\Controls_Manager::DIVIDER,		
				'condition' => [
					'show_ind_user_rating_text' => '1',
				], 
			] );
				
			// Individual User Rating - Label
			$this->add_control(
				'_gpur_header_ind_user_rating_label',
				[
					'label' => esc_html__( 'Label', 'gpur' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'condition' => [
						'show_ind_user_rating_text' => '1',
					],
				]	
			);										
			$this->add_control( 
				//formely'your_user_rating_label',
				'ind_user_rating_label',
				[
					'label' => esc_html__( 'Label', 'gpur' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Your Rating:', 'gpur' ),
					'condition' => [
						'show_ind_user_rating_text' => '1',
					],
				]	
			);			
			$this->add_control(
				'ind_user_rating_label_color',
				[
					'label' => esc_html__( 'Text Color', 'gpur' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'condition' => [
						'show_ind_user_rating_text' => '1',
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-ind-user-rating-label' => 'color: {{VALUE}};',
					],
				]	
			);	
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'ind_user_rating_label_typography',
					'label' => esc_html__( 'Typography', 'gpur' ),
					'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_3,
					'default' => array(
						'font_weight' => '400',
					),
					'condition' => [
						'show_ind_user_rating_text' => '1',
					],
					'selector' => '{{WRAPPER}} .gpur-ind-user-rating-label',
				]
			);			
			$this->add_control(
				'ind_user_rating_label_extra_css',
				[
					'label' => esc_html__( 'Extra CSS', 'gpur' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,
					'condition' => [
						'show_ind_user_rating_text' => '1',
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-ind-user-rating-label' => '{{VALUE}}',
					],
				]	
			);
			
			$this->add_control( '_gpur_divider_ind_user_rating_number', [ 
				'type' => \Elementor\Controls_Manager::DIVIDER,
				'condition' => [
					'show_ind_user_rating_text' => '1',
				], 
			] );	
					
			// Individual User Rating - Rating Number
			$this->add_control(
				'_gpur_header_ind_user_rating_number',
				[
					'label' => esc_html__( 'Rating Number', 'gpur' ),
					'type' => \Elementor\Controls_Manager::HEADING,
				]	
			);
			$this->add_control( 
				'ind_user_rating_number_color',
				[
					'label' => esc_html__( 'Text Color', 'gpur' ),	
					'type' => \Elementor\Controls_Manager::COLOR,
					'condition' => [
						'show_ind_user_rating_text' => '1',
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-ind-user-rating' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'ind_user_rating_number_typography',
					'label' => esc_html__( 'Typography', 'gpur' ),
					'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_3,
					'default' => array(
						'font_weight' => '400',
					),
					'condition' => [
						'show_ind_user_rating_text' => '1',
					],
					'selector' => '{{WRAPPER}} .gpur-ind-user-rating',
				]
			);
			$this->add_control( 
				'ind_user_rating_number_extra_css',
				[
					'label' => esc_html__( 'Extra CSS', 'gpur' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,
					'condition' => [
						'show_ind_user_rating_text' => '1',
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-ind-user-rating' => '{{VALUE}}',
					],
				]	
			);
			
			$this->add_control( '_gpur_divider_ind_user_rating_max_rating_number', [ 
				'type' => \Elementor\Controls_Manager::DIVIDER, 					
				'condition' => [
					'show_ind_user_rating_text' => '1',
				],
			] );
			
			// Individual User Rating - Maximum Rating Number
			$this->add_control(
				'_gpur_header_ind_user_rating_max_rating_number',
				[
					'label' => esc_html__( 'Maximum Rating Number', 'gpur' ),
					'type' => \Elementor\Controls_Manager::HEADING,
				]	
			);						
			$this->add_control(
				//formerly'show_max_rating_number',
				'show_ind_user_rating_max_rating_number',
				[
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label' => esc_html__( 'Display', 'gpur' ),				
					'return_value' => '1',
					'default' => '',
				]	
			);
			$this->add_control( 
				'ind_user_rating_max_rating_number_color',
				[
					'label' => esc_html__( 'Color', 'gpur' ),
					'type' => \Elementor\Controls_Manager::COLOR,					
					'condition' => [
						'show_ind_user_rating_max_rating_number' => '1',
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-ind-user-rating .gpur-max-rating' => 'color: {{VALUE}};',
					],	
				]	
			);
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'ind_user_rating_max_rating_number_typography',
					'label' => esc_html__( 'Typography', 'gpur' ),
					'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_3,
					'default' => array(
						'font_weight' => '400',
					),					
					'condition' => [
						'show_ind_user_rating_max_rating_number' => '1',
					],
					'selector' => '{{WRAPPER}} .gpur-ind-user-rating .gpur-max-rating',
				]
			);
			$this->add_control( 
				'ind_user_rating_max_rating_number_extra_css',
				[
					'label' => esc_html__( 'Extra CSS', 'gpur' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,					
					'condition' => [
						'show_ind_user_rating_max_rating_number' => '1',	
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-ind-user-rating .gpur-max-rating' => '{{VALUE}}',
					],
				]	
			);			
			
		$this->end_controls_section();

		/*--------------------------------------------------------------
		Submit Button
		--------------------------------------------------------------*/

		$this->start_controls_section(
			'_gpur_section_submit_button',
			[
				'label' => esc_html__( 'Submit Button', 'gpur' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

			$this->add_control(
				'show_submit_button',
				[
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label' => esc_html__( 'Display', 'gpur' ),
					'return_value' => '1',
					'default' => '',
				]	
			);
			
			$this->add_control(
				'submit_button_label',
				[
					'label' => esc_html__( 'Label', 'gpur' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Submit Rating', 'gpur' ),
				]
			);	
								
			$this->add_control(
				'submit_button_text_color',
				[
					'label' => esc_html__( 'Text Color', 'gpur' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .gpur-submit-rating' => 'color: {{VALUE}};',
					],
				]
			);	
					
			$this->add_control(
				'submit_button_text_hover_color',
				[
					'label' => esc_html__( 'Text Hover Color', 'gpur' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .gpur-submit-rating:hover' => 'color: {{VALUE}};',
					],
				]
			);
			
			// Background
			$this->start_controls_tabs( '_gpur_tabs_submit_button_background' );
		
				$this->start_controls_tab(
					'_gpur_tab_submit_button_background_normal',
					[
						'label' => esc_html__( 'Normal', 'gpur' ),
					]
				);
					$this->add_group_control(
						\Elementor\Group_Control_Background::get_type(),
						[
							'name' => 'submit_button_background',
							'selector' => '{{WRAPPER}} .gpur-submit-rating',
						]
					);
				$this->end_controls_tab();
		
				$this->start_controls_tab(
					'_gpur_tab_submit_button_background_hover',
					[
						'label' => esc_html__( 'Hover', 'gpur' ),
					]
				);
					$this->add_group_control(
						\Elementor\Group_Control_Background::get_type(),
						[
							'name' => 'submit_button_background_hover',
							'selector' => '{{WRAPPER}} .gpur-submit-rating:hover',
						]
					);
				$this->end_controls_tab();
		
			$this->end_controls_tabs();	

			$this->start_controls_tabs( '_gpur_tabs_submit_button_border' );
		
				$this->start_controls_tab(
					'_gpur_tab_submit_button_border_normal',
					[
						'label' => esc_html__( 'Normal', 'gpur' ),
					]
				);
					$this->add_group_control(
						\Elementor\Group_Control_Border::get_type(),
						[
							'name' => 'submit_button_border',
							'label' => esc_html__( 'Border', 'gpur' ),
							'selector' => '{{WRAPPER}} .gpur-submit-rating',
						]
					);
					$this->add_control(			
						'submit_button_border_radius',
						[
							'label' => esc_html__( 'Border Radius', 'gpur' ),
							'type' => \Elementor\Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%' ],
							'selectors' => [
								'{{WRAPPER}} .gpur-submit-rating' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						\Elementor\Group_Control_Box_Shadow::get_type(),
						[
							'name' => 'submit_button_box_shadow',
							'selector' => '{{WRAPPER}} .gpur-submit-rating',
						]
					);
				$this->end_controls_tab();

				$this->start_controls_tab(
					'_gpur_tab_submit_button_border_hover',
					[
						'label' => esc_html__( 'Hover', 'gpur' ),
					]
				);			
					$this->add_group_control(
						\Elementor\Group_Control_Border::get_type(),
						[
							'name' => 'submit_button_border_hover',
							'label' => esc_html__( 'Border Hover', 'gpur' ),
							'selector' => '{{WRAPPER}} .gpur-submit-rating:hover',
						]
					);						
					$this->add_control(			
						'submit_button_border_radius_hover',
						[
							'label' => esc_html__( 'Border Radius', 'gpur' ),
							'type' => \Elementor\Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%' ],
							'selectors' => [
								'{{WRAPPER}} .gpur-submit-rating:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						\Elementor\Group_Control_Box_Shadow::get_type(),
						[
							'name' => 'submit_button_box_shadow_hover',
							'selector' => '{{WRAPPER}} .gpur-submit-rating:hover',
						]
					);
				$this->end_controls_tab();
			
			$this->end_controls_tabs();	

			$this->add_control(
				'submit_button_css',
				[
					'label' => esc_html__( 'Extra CSS', 'gpur' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,
					'selectors' => [
						'{{WRAPPER}} .gpur-submit-rating' => '{{VALUE}}',
					],
				]
			);		
			
		$this->end_controls_section();

		/*--------------------------------------------------------------
		Permissions
		--------------------------------------------------------------*/
	
		$this->start_controls_section(
			'_gpur_section_permissions',
			[
				'label' => esc_html__( 'Permissions', 'gpur' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
				
			$this->add_control(
				'permissions',
				[
					'label' => esc_html__( 'Permissions', 'gpur' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'placeholder' => '',
					'options' => array(
						'all-users' => esc_html__( 'All users', 'gpur' ),
						'logged-in-users' => esc_html__( 'Logged in users only', 'gpur' ),
						'specific-roles' => esc_html__( 'Specific roles only', 'gpur' ),
					),
					'default' => 'all-users',
				]
			);

			$this->add_control(
				'permission_roles',
				[
					'label' => esc_html__( 'Roles', 'gpur' ),
					'type' => \Elementor\Controls_Manager::SELECT2,
					'multiple' => true,
					'options' => GPUR_Elementor::gpur_elementor_permissions_roles(),
					'condition' => [
						'permissions' => array( 'specific-roles' ),
					],
				]
			);
			
		$this->end_controls_section();
			
		/*--------------------------------------------------------------
		Other
		--------------------------------------------------------------*/

		$this->start_controls_section(
			'_gpur_section_other',
			[
				'label' => esc_html__( 'Other', 'gpur' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
			$this->add_control(
				'logged_in_to_vote_label',
				[
					'label' => esc_html__( 'Logged In To Vote Label', 'gpur' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'You must be logged in to vote.', 'gpur' ),
				]
			);	
											
			$this->add_control(
				'single_success_message',
				[
					'label' => esc_html__( 'Success Message (Single Rating)', 'gpur' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Thanks for submitting your rating!', 'gpur' ),
				]
			);
							
			$this->add_control(
				'single_error_message',
				[
					'label' => esc_html__( 'Error Message (Single Rating)', 'gpur' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Please give a rating.', 'gpur' ),
				]
			);
							
			$this->add_control(
				'multi_success_message',
				[
					'label' => esc_html__( 'Success Message (Multi Rating)', 'gpur' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Thanks for submitting your ratings!', 'gpur' ),
				]
			);
							
			$this->add_control(
				'multi_error_message',
				[
					'label' => esc_html__( 'Error Message (Multi Rating)', 'gpur' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Please give a rating for each criterion.', 'gpur' ),
				]
			);
			
		$this->end_controls_section();
		
	}

	protected function render() {

		$atts = $this->get_settings_for_display();
		extract( $atts );
		
		// Load template
		echo gpur_add_user_ratings_template( 
			array(
				'post_id' => get_the_ID(),
				'builder' => 'elementor',
				'atts' => $atts,
			)
		);
			
	}
		
}