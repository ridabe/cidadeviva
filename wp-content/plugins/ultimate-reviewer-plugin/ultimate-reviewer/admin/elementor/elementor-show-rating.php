<?php class GPUR_Elementor_Show_Rating_Widget extends Elementor\Widget_Base {

	public function get_name() {
		return 'gpur_show_rating';
	}

	public function get_title() {
		return esc_html__( 'Show Rating', 'gpur' );
	}

	public function get_icon() {
		return 'eicon-star';
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
						'font_weight' => '700',
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
				'data',
				[
					'label' => esc_html__( 'Rating Data', 'gpur' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'placeholder' => '',
					'options' => array(
						'site-rating' => esc_html__( 'Site Rating', 'gpur' ),
						'user-rating' => esc_html__( 'User Rating', 'gpur' ),
						'custom' => esc_html__( 'Custom', 'gpur' ),
					),
					'default' => 'site-rating',
				]
			);

			$this->add_control(
				'value',
				[
					'label' => esc_html__( 'Value', 'gpur' ),
					'description' => esc_html__( 'Add your own custom ratings that will overwrite ratings on posts/pages. To add multiple ratings separate each rating with a comma e.g. 5,8,10', 'gpur' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'condition' => [
						'data' => 'custom',
					],
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
					'description' => esc_html__( 'The rating range spans all the integers from minimum to maximum rating.', 'gpur' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'default' => 1,
				]
			);
					
			$this->add_control(
				'decimal_places',
				[
					'label' => esc_html__( 'Decimal Places', 'gpur' ),
					'description' => esc_html__( 'The number of decimal places to show the rating to.', 'gpur' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'default' => 1,
				]
			);	
			
			$this->add_control(
				'show_zero_rating',
				[
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label' => esc_html__( 'Zero Ratings', 'gpur' ),
					'return_value' => '1',
					'default' => '1',
				]
			);
									
			$this->add_control(
				'rich_snippets',
				[
					'label' => esc_html__( 'Rich Snippets', 'gpur' ),
					'description' => esc_html__( 'Allows search engines to read your rating data to display ratings in search results.', 'gpur' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'return_value' => '1',
					'default' => '1',
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
						'style-plain-singular' => esc_html__( 'Plain (Singular)', 'gpur' ),
						'style-squares-singular' => esc_html__( 'Squares (Singular)', 'gpur' ),
						'style-circles-singular' => esc_html__( 'Circles (Singular)', 'gpur' ),
						'style-gauge-circles-singular' => esc_html__( 'Gauge Circles (Singular)', 'gpur' ),
						'style-stars' => esc_html__( 'Stars', 'gpur' ),
						'style-hearts' => esc_html__( 'Hearts', 'gpur' ),
						'style-squares' => esc_html__( 'Squares', 'gpur' ),
						'style-circles' => esc_html__( 'Circles', 'gpur' ),
						'style-bars' => esc_html__( 'Bars', 'gpur' ),
						'style-icon' => esc_html__( 'Custom Icon', 'gpur' ),
						'style-image' => esc_html__( 'Custom Image', 'gpur' ),
					),
					'default' => 'style-plain-singular',
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
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => array(
						'position-text-top' => esc_html__( 'Top', 'gpur' ),
						'position-text-bottom' => esc_html__( 'Bottom', 'gpur' ),
						'position-text-left' => esc_html__( 'Left', 'gpur' ),
						'position-text-right' => esc_html__( 'Right', 'gpur' ),
					),
					'default' => 'position-text-bottom',
					'condition' => [
						'style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
					],
				
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
					'default' => '',
					'condition' => [
						'style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon' ),
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
						'style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon' ),
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
		Rating Container
		--------------------------------------------------------------*/

		$this->start_controls_section(
			'_gpur_section_rating_container',
			[
				'label' => esc_html__( 'Rating Container', 'gpur' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'style' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
				],
			]
		);
			
			// Rating Container - Container
			$this->add_control(
				'_gpur_header_container',
				[
					'label' => esc_html__( 'Container', 'gpur' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'condition' => [
						'style' => 'style-gauge-circles-singular', 
					],
				]	
			);
				$this->add_control(
					'rating_container_width',
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
							'style' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
						],
						'selectors' => [
							'{{WRAPPER}} .gpur-rating-outer' => 'width: {{SIZE}}{{UNIT}};',
							'{{WRAPPER}} .gpur-small-rating .gpur-gauge-1' => 'clip: rect(0, {{SIZE}}{{UNIT}}, {{SIZE}}{{UNIT}}, calc({{SIZE}}{{UNIT}}/2));',
							'{{WRAPPER}} .gpur-small-rating .gpur-gauge-2' => 'clip: rect(0, calc({{SIZE}}{{UNIT}}/2), {{SIZE}}{{UNIT}}, 0);',
						],
					
					]	
				);
				$this->add_control(
					'rating_container_height',
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
							'style' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
						],
						'selectors' => [
							'{{WRAPPER}} .gpur-rating-outer' => 'height: {{SIZE}}{{UNIT}};',
						],
					]	
				);
				$this->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					[
						'name' => 'rating_container_background',
						'condition' => [
							'style' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
						],
						'selector' => '{{WRAPPER}} .gpur-rating-inner',
					]
				);
				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'rating_container_border',
						'label' => esc_html__( 'Border', 'gpur' ),
						'condition' => [
							'style' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
						],
						'selector' =>'{{WRAPPER}} .gpur-rating-inner',
					]
				);
				$this->add_control(
					'rating_container_extra_css',
					[
						'label' => esc_html__( 'Extra CSS', 'gpur' ),
						'label_block' => true,
						'type' => \Elementor\Controls_Manager::TEXT,
						'condition' => [
							'style' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
						],
						'selectors' => [
							'{{WRAPPER}} .gpur-rating-outer' => '{{VALUE}}',
						],
					]	
				);	

			$this->add_control( '_gpur_divider_gauge_width', [ 
				'type' => \Elementor\Controls_Manager::DIVIDER,		
					'condition' => [
						'style' => 'style-gauge-circles-singular', 
					],
			] );	
							
			// Rating Container - Gauge
			$this->add_control(
				'_gpur_header_gauge',
				[
					'label' => esc_html__( 'Gauge', 'gpur' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'condition' => [
						'style' => 'style-gauge-circles-singular', 
					],
				]	
			);
				$this->add_control(
					'gauge_width',
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
							'style' => 'style-gauge-circles-singular', 
						],
						'selectors' => [
							'{{WRAPPER}} .gpur-style-gauge-circles-singular .gpur-rating-inner' => 'top: {{SIZE}}{{UNIT}}; right: {{SIZE}}{{UNIT}}; bottom: {{SIZE}}{{UNIT}}; left: {{SIZE}}{{UNIT}};',
						],
					]	
				);
				$this->add_control( 
					'gauge_filled_color_1',
					[
						'label' => esc_html__( 'Filled Color 1', 'gpur' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'condition' => [
							'style' => 'style-gauge-circles-singular', 
						],
					]
				);
				$this->add_control( 
					'gauge_filled_color_2',
					[
						'label' => esc_html__( 'Filled Color 2', 'gpur' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'condition' => [
							'style' => 'style-gauge-circles-singular', 
						],
					]
				);					
				$this->add_control( 
					'gauge_empty_color',
					[
						'label' => esc_html__( 'Empty Color', 'gpur' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'condition' => [
							'style' => 'style-gauge-circles-singular', 
						],
						'selectors' => [
							'{{WRAPPER}} .gpur-style-gauge-circles-singular .gpur-rating-outer' => 'background: {{VALUE}};',
						],
					]
				);
			
		$this->end_controls_section();
				
		/*--------------------------------------------------------------
		Site Rating Text
		--------------------------------------------------------------*/

		$this->start_controls_section(
			'_gpur_section_site_rating_text',
			[
				'label' => esc_html__( 'Rating Text', 'gpur' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'data' => array( 'site-rating', 'custom' ),
				],
			]
		);			
	
			$this->add_control(
				'show_site_rating_text',
				[
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label' => esc_html__( 'Display', 'gpur' ),
					'return_value' => '1',
					'default' => '1',
					'condition' => [
						'style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
					],
				]
			);		
				
			$this->add_control( '_gpur_divider_site_rating_label', [ 
				'type' => \Elementor\Controls_Manager::DIVIDER,			
				'condition' => [
					'show_site_rating_text' => '1',
					'style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),	
				],	
			] );	
							
			// Site Rating - Label
			$this->add_control(
				'_gpur_header_site_rating_label',
				[
					'label' => esc_html__( 'Label', 'gpur' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'condition' => [
						'show_site_rating_text' => '1',
						'style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),	
					],
				]	
			);
														
			$this->add_control( 
				'site_rating_label',
				[
					'label' => esc_html__( 'Label', 'gpur' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Site Rating:', 'gpur' ),
					'condition' => [
						'show_site_rating_text' => '1',
						'style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),	
					],
				]	
			);	
						
			$this->add_control(
				'site_rating_label_color',
				[
					'label' => esc_html__( 'Text Color', 'gpur' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'condition' => [
						'show_site_rating_text' => '1',
						'style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),	
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-site-rating-label' => 'color: {{VALUE}};',
					],
				]	
			);	
			
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'site_rating_label_typography',
					'label' => esc_html__( 'Typography', 'gpur' ),
					'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_3,
					'default' => array(
						'font_weight' => '400',
					),
					'condition' => [
						'show_site_rating_text' => '1',
						'style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),	
					],
					'selector' => '{{WRAPPER}} .gpur-site-rating-label',
				]
			);	
						
			$this->add_control(
				'site_rating_label_extra_css',
				[
					'label' => esc_html__( 'Extra CSS', 'gpur' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,
					'condition' => [
						'show_site_rating_text' => '1',
						'style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),	
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-site-rating-label' => '{{VALUE}}',
					],
				]	
			);
			
			$this->add_control( '_gpur_divider_site_rating_number', [ 
				'type' => \Elementor\Controls_Manager::DIVIDER,
				'condition' => [
					'show_site_rating_text' => '1',
					'style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),	
				],
			] );
								
			// Rating Number
			$this->add_control(
				'_gpur_header_site_rating_number',
				[
					'label' => esc_html__( 'Rating Number', 'gpur' ),
					'type' => \Elementor\Controls_Manager::HEADING,				
					'conditions' => [
						'relation' => 'or',
						'terms' => [
							[
								'name' => 'show_site_rating_text',
								'value' => '1',
							],
							[
								'name' => 'style',
								'operator' => 'in',
								'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
							],	
						],
					]
				]	
			);		
				$this->add_control(
					'site_rating_number_color',
					[
						'label' => esc_html__( 'Text Color', 'gpur' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .gpur-site-rating .gpur-rating-value' => 'color: {{VALUE}};',
						],				
						'conditions' => [
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'show_site_rating_text',
									'value' => '1',
								],
								[
									'name' => 'style',
									'operator' => 'in',
									'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
								],	
							],
						]
					]	
				);
				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'site_rating_number_typography',
						'label' => esc_html__( 'Typography', 'gpur' ),
						'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_3,
						'default' => array(
							'font_weight' => '400',
						),
						'selector' => '{{WRAPPER}} .gpur-site-rating .gpur-rating-value',				
						'conditions' => [
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'show_site_rating_text',
									'value' => '1',
								],
								[
									'name' => 'style',
									'operator' => 'in',
									'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
								],	
							],
						]
					]
				);							
				$this->add_control(
					'site_rating_number_extra_css',
					[
						'label' => esc_html__( 'Extra CSS', 'gpur' ),
						'label_block' => true,
						'type' => \Elementor\Controls_Manager::TEXT,
						'selectors' => [
							'{{WRAPPER}} .gpur-site-rating .gpur-rating-value' => '{{VALUE}}',
						],				
						'conditions' => [
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'show_site_rating_text',
									'value' => '1',
								],
								[
									'name' => 'style',
									'operator' => 'in',
									'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
								],	
							],
						]
					]	
				);
			
			$this->add_control( '_gpur_divider_site_rating_max_rating_number', [ 
				'type' => \Elementor\Controls_Manager::DIVIDER, 
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'show_site_rating_text',
							'value' => '1',
						],
						[
							'name' => 'style',
							'operator' => 'in',
							'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
						],	
					],	
				],	
			] );
						
			// Maximum Rating Number
			$this->add_control(
				'_gpur_header_site_rating_max_rating_number',
				[
					'label' => esc_html__( 'Maximum Rating Number', 'gpur' ),
					'type' => \Elementor\Controls_Manager::HEADING,					
					'conditions' => [
						'relation' => 'or',
						'terms' => [
							[
								'name' => 'show_site_rating_text',
								'value' => '1',
							],
							[
								'name' => 'style',
								'operator' => 'in',
								'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
							],	
						],	
					],
				]	
			);						
				$this->add_control(
					'show_site_rating_max_rating_number',
					[
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'label' => esc_html__( 'Display', 'gpur' ),				
						'return_value' => '1',
						'default' => '',					
						'conditions' => [
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'show_site_rating_text',
									'value' => '1',
								],
								[
									'name' => 'style',
									'operator' => 'in',
									'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
								],	
							],	
						],
					]	
				);
				$this->add_control( 
					'site_rating_max_rating_number_color',
					[
						'label' => esc_html__( 'Text Color', 'gpur' ),
						'type' => \Elementor\Controls_Manager::COLOR,					
						'conditions' => [
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'show_site_rating_text',
									'value' => '1',
								],
								[
									'name' => 'style',
									'operator' => 'in',
									'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
								],	
							],	
						],
						'selectors' => [
							'{{WRAPPER}} .gpur-site-rating .gpur-max-rating' => 'color: {{VALUE}};',
						],	
					]	
				);
				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'site_rating_max_rating_number_typography',
						'label' => esc_html__( 'Typography', 'gpur' ),
						'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_3,		
						'default' => array(
							'font_weight' => '400',
						),			
						'conditions' => [
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'show_site_rating_text',
									'value' => '1',
								],
								[
									'name' => 'style',
									'operator' => 'in',
									'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
								],	
							],	
						],
						'selector' => '{{WRAPPER}} .gpur-site-rating .gpur-max-rating',
					]
				);
				$this->add_control( 
					'site_rating_max_rating_number_extra_css',
					[
						'label' => esc_html__( 'Extra CSS', 'gpur' ),
						'label_block' => true,
						'type' => \Elementor\Controls_Manager::TEXT,					
						'conditions' => [
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'show_site_rating_text',
									'value' => '1',
								],
								[
									'name' => 'style',
									'operator' => 'in',
									'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
								],	
							],	
						],
						'selectors' => [
							'{{WRAPPER}} .gpur-site-rating .gpur-max-rating' => '{{VALUE}}',
						],
					]	
				);			
					
		$this->end_controls_section();
		
		/*--------------------------------------------------------------
		User Rating Text
		--------------------------------------------------------------*/

		$this->start_controls_section(
			'_gpur_section_user_rating_text',
			[
				'label' => esc_html__( 'Rating Text', 'gpur' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'data' => 'user-rating',
				],
			]
		);

		$this->start_controls_tabs( '_gpur_tabs_user_rating_text' );

		// Average User Rating Text
		$this->start_controls_tab(
			'_gpur_tab_avg_user_rating_text',
			[
				'label' => esc_html__( 'Average User Rating', 'gpur' ),
			]
		);
				
			$this->add_control(
				'show_avg_user_rating_text',
				[
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label' => esc_html__( 'Display', 'gpur' ),
					'return_value' => '1',
					'default' => '1',		
					'condition' => [
						'style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
					],
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
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'show_avg_user_rating_text',
							'value' => '1',
						],
						[
							'name' => 'style',
							'operator' => 'in',
							'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
						],	
					],
				]
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
					'selectors' => [
						'{{WRAPPER}} .gpur-avg-user-rating .gpur-rating-value' => 'color: {{VALUE}};',
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
					'selector' => '{{WRAPPER}} .gpur-avg-user-rating .gpur-rating-value',
				]
			);
			$this->add_control( 
				'avg_user_rating_number_extra_css',
				[
					'label' => esc_html__( 'Extra CSS', 'gpur' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,
					'selectors' => [
						'{{WRAPPER}} .gpur-avg-user-rating .gpur-rating-value' => '{{VALUE}}',
					],
				]	
			);

			$this->add_control( '_gpur_divider_avg_user_max_rating_number', [ 
				'type' => \Elementor\Controls_Manager::DIVIDER,							
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'show_avg_user_rating_text',
							'value' => '1',
						],
						[
							'name' => 'style',
							'operator' => 'in',
							'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
						],	
					],
				] 
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
					'label' => esc_html__( 'Text Color', 'gpur' ),
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

		$this->end_controls_tab();		

		// User Votes Text
		$this->start_controls_tab(
			'_gpur_tab_user_votes_text',
			[
				'label' => esc_html__( 'User Votes', 'gpur' ),
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
			
		$this->end_controls_tab();	

		// Individual User Rating Text
		$this->start_controls_tab(
			'_gpur_tab_ind_user_rating_text',
			[
				'label' => esc_html__( 'Individual User Rating', 'gpur' ),
				'condition' => [
					'style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
				],
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
					'condition' => [
						'style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
					],
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
						'{{WRAPPER}} .gpur-ind-user-rating .gpur-rating-value' => 'color: {{VALUE}};',
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
					'selector' => '{{WRAPPER}} .gpur-ind-user-rating .gpur-rating-value',
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
						'{{WRAPPER}} .gpur-ind-user-rating .gpur-rating-value' => '{{VALUE}}',
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
					'label' => esc_html__( 'Text Color', 'gpur' ),
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
						
		$this->end_controls_tab();		
					
		$this->end_controls_tabs();	
		
		$this->end_controls_section();
						
		/*--------------------------------------------------------------
		Criteria
		--------------------------------------------------------------*/

		$this->start_controls_section(
			'_gpur_section_criteria',
			[
				'label' => esc_html__( 'Criteria', 'gpur' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'data' => array( 'site-rating', 'custom' ),
				],
			]
		);
			
			$this->add_control(
				'criteria',
				[
					'label' => esc_html__( 'Criteria', 'gpur' ),					
					'description' => esc_html__( 'Enter each criterion on a new line.', 'gpur' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
				]
			);
		
			$this->add_control(
				'criteria_format',
				[
					'label' => esc_html__( 'Format', 'gpur' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'placeholder' => '',
					'options' => array(
						'format-column' => esc_html__( 'Column', 'gpur' ),
						'format-rows' => esc_html__( 'Rows', 'gpur' ),
					),
					'default' => 'format-rows',
					'condition' => [
						'criteria!' => '',
					],
				]
			);
			
			$this->add_control( '_gpur_divider_criteria', [ 
				'type' => \Elementor\Controls_Manager::DIVIDER,
				'condition' => [
					'criteria!' => '',
				],
				 
			] );	
						
			// Criterion Title
			$this->add_control(
				'_gpur_header_criterion_title',
				[
					'label' => esc_html__( 'Criterion Title', 'gpur' ),
					'type' => \Elementor\Controls_Manager::HEADING,
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
						'font_weight' => '700',
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
					'label' => esc_html__( 'Extra CSS', 'gpur' ),
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
			
			$this->add_control( '_gpur_divider_criterion_boxes', [ 
				'type' => \Elementor\Controls_Manager::DIVIDER, 
				'condition' => [
					'criteria!' => '',
					'style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
				],
			] );	
			
			// Criterion Boxes
			$this->add_control(
				'_gpur_header_criterion_boxes',
				[
					'label' => esc_html__( 'Criterion Boxes', 'gpur' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'condition' => [
						'criteria!' => '',
						'style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
					],
				]	
			);
																													
			$this->add_control(
				'criterion_boxes',
				[
					'label' => esc_html__( 'Display', 'gpur' ),
					'description' => esc_html__( 'Add a full width box around each criterion rating.', 'gpur' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'return_value' => '1',
					'default' => '',				
					'condition' => [
						'criteria!' => '',
						'style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
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
						'style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-criterion-boxes .gpur-criterion' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]	
			);
	
			$this->start_controls_tabs( '_gpur_tabs_criterion_boxes_background' );

			$this->start_controls_tab(
				'_gpur_tab_criterion_boxes_background_1',
				[
					'label' => esc_html__( 'Background 1', 'gpur' ),
					'condition' => [
						'criterion_boxes' => '1',
						'criteria!' => '',
						'style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
					],
				]
			);

				$this->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					[
						'name' => 'criterion_boxes_background_1',
						'condition' => [
							'criterion_boxes' => '1',
							'criteria!' => '',
							'style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
						],
						'selector' => '{{WRAPPER}} .gpur-criterion-boxes .gpur-criterion:nth-child(odd)',
					]
				);
			
			$this->end_controls_tab();
			
			$this->start_controls_tab(
				'_gpur_tab_criterion_boxes_background_2',
				[
					'label' => esc_html__( 'Background 2', 'gpur' ),
					'condition' => [						
						'criterion_boxes' => '1',
						'criteria!' => '',
						'style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
					],
				]
			);
			
				$this->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					[
						'name' => 'criterion_boxes_background_2',
						'condition' => [
							'criterion_boxes' => '1',
							'criteria!' => '',
							'style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
						],
						'selector' => '{{WRAPPER}} .gpur-criterion-boxes .gpur-criterion:nth-child(even)',
					]
				);			
				
			$this->end_controls_tab();
			
			$this->end_controls_tabs();	
			
			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'criterion_boxes_border',
					'label' => esc_html__( 'Border', 'gpur' ),
					'condition' => [
						'criterion_boxes' => '1',
						'criteria!' => '',
						'style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
					],
					'selector' => '{{WRAPPER}} .gpur-criterion-boxes .gpur-criterion',
				]
			);
			
			$this->add_control( 
				'criterion_boxes_extra_css',
				[
					'label' => esc_html__( 'Extra CSS', 'gpur' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,		
					'condition' => [
						'criterion_boxes' => '1',
						'criteria!' => '',
						'style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-criterion-boxes .gpur-criterion' => '{{VALUE}}',
					],
				]
			);
			
		$this->end_controls_section();
				
		/*--------------------------------------------------------------
		Ranges Text
		--------------------------------------------------------------*/

		$this->start_controls_section(
			'_gpur_section_ranges_text',
			[
				'label' => esc_html__( 'Ranges Text', 'gpur' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
					
			$this->add_control(
				'show_ranges_text',
				[
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label' => esc_html__( 'Display', 'gpur' ),
					'return_value' => '1',
					'default' => '1',
				]	
			);
											
			$this->add_control(
				'rating_ranges',
				[
					'label' => esc_html__( 'Rating Ranges', 'gpur' ),
					'label_block' => true,
					'description' => esc_html__( 'Set up your rating ranges in the follow way', 'gpur' ) . ' <code>' . esc_html__( 'Score 1-Score 2:Rating Text, Score 3-Score 4:Rating Text', 'gpur' ) . '</code>' . esc_html__( 'e.g.', 'gpur' ) . '<code>' . esc_html__( '0-2:Awful, 2.5-4:Bad, 4.5-6:Average, 6.5-8:Good, 8.5-10:Amazing', 'gpur' ) . '</code>',
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => '0-1.9:Awful, 2-2.9:Bad, 3-3.9:Average, 4-4.9:Good, 5-5:Amazing',
					'condition' => [
						'show_ranges_text' => '1',
					],
				]
			);
			
			$this->add_control( 
				'ranges_text_color',
				[
					'label' => esc_html__( 'Text Color', 'gpur' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'condition' => [
						'show_ranges_text' => '1',
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-ranges-text' => 'color: {{VALUE}};',
					],
				]	
			);
			
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'ranges_typography',
					'label' => esc_html__( 'Typography', 'gpur' ),
					'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_3,
					'default' => array(
						'font_weight' => '700',
					),
					'condition' => [
						'show_ranges_text' => '1',
					],
					'selector' => '{{WRAPPER}} .gpur-ranges-text',
				]
			);
			
			$this->add_control( 
				'ranges_text_extra_css',
				[
					'label' => esc_html__( 'Extra CSS', 'gpur' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,
					'condition' => [
						'show_ranges_text' => '1',
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-ranges-text' => '{{VALUE}}',
					],	
				]
			);
					
		$this->end_controls_section();
					
	}

	protected function render() {

		$atts = $this->get_settings_for_display();
		extract( $atts );
				
		// Load template
		echo gpur_show_rating_template( 
			array( 
				'post_id' => get_the_ID(),
				'builder' => 'elementor', 
				'atts' => $atts, 
			) 
		);

	}
		
}
