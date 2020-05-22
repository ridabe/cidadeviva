<?php class GPUR_Elementor_Review_Button_Widget extends Elementor\Widget_Base {

	public function get_name() {
		return 'gpur_review_button';
	}

	public function get_title() {
		return esc_html__( 'Review Button', 'gpur' );
	}

	public function get_icon() {
		return 'eicon-button';
	}

	public function get_categories() {
		if ( 'gpur-template' === get_post_type() OR 'item' === get_post_meta( get_the_ID(), 'gp_template_type', true ) ) {
			return [ 'review' ];
		}
	}

	protected function _register_controls() {

		/*--------------------------------------------------------------
		Text
		--------------------------------------------------------------*/
	
		$this->start_controls_section(
			'_gpur_section_text',
			[
				'label' => esc_html__( 'Text', 'gpur' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);	
		
			$this->add_control(
				'text',
				[
					'label' => esc_html__( 'Text', 'gpur' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Button Text', 'gpur' ),
				]
			);
		
			$this->add_control(
				'link',
				[
					'label' => esc_html__( 'Link', 'gpur' ),
					'type' => \Elementor\Controls_Manager::URL,
				]
			);
			
			$this->add_control( 			
				'text_color',
				[
					'label' => esc_html__( 'Text Color', 'gpur' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#fff',
					'selectors' => [
						'{{WRAPPER}} .gpur-review-button .gpur-review-button-text' => 'color: {{VALUE}};',
					],
				]
			);
						
			$this->add_control(			
				'text_hover_color',
				[
					'label' => esc_html__( 'Hover Text Color', 'gpur' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#fff',
					'selectors' => [
						'{{WRAPPER}} .gpur-review-button:hover .gpur-review-button-text' => 'color: {{VALUE}};',
					],
				]
			);
			
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'typography',
					'label' => esc_html__( 'Typography', 'gpur' ),
					'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_3,
					'default' => array(
						'font_weight' => '400',
					),
					'selector' => '{{WRAPPER}} .gpur-review-button-text',
				]
			);
					
		$this->end_controls_section();	

		/*--------------------------------------------------------------
		Background
		--------------------------------------------------------------*/
	
		$this->start_controls_section(
			'_gpur_section_background',
			[
				'label' => esc_html__( 'Background', 'gpur' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);	

			$this->start_controls_tabs( '_gpur_tabs_background' );
			
				$this->start_controls_tab(
					'_gpur_tab_background_normal',
					[
						'label' => esc_html__( 'Normal', 'gpur' ),
					]
				);
					$this->add_group_control(
						\Elementor\Group_Control_Background::get_type(),
						[
							'name' => 'background',
							'fields_options' => [
								'color' => [
									'default' => '#000',
								],	
							],	
							'selector' => '{{WRAPPER}} .gpur-review-button',
						]
					);
				$this->end_controls_tab();
			
				$this->start_controls_tab(
					'_gpur_tab_background_hover',
					[
						'label' => esc_html__( 'Hover', 'gpur' ),
					]
				);
					$this->add_group_control(
						\Elementor\Group_Control_Background::get_type(),
						[
							'name' => 'background_hover',
							'fields_options' => [
								'color' => [
									'default' => '#333',
								],	
							],
							'selector' => '{{WRAPPER}} .gpur-review-button:hover',
						]
					);
				$this->end_controls_tab();
			
			$this->end_controls_tabs();	
			
		$this->end_controls_section();	
			
		/*--------------------------------------------------------------
		Border
		--------------------------------------------------------------*/
	
		$this->start_controls_section(
			'_gpur_section_border',
			[
				'label' => esc_html__( 'Border', 'gpur' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);			
			
			$this->start_controls_tabs( '_gpur_tabs_border' );
			
				$this->start_controls_tab(
					'_gpur_tab_border_normal',
					[
						'label' => esc_html__( 'Normal', 'gpur' ),
					]
				);
					$this->add_group_control(
						\Elementor\Group_Control_Border::get_type(),
						[
							'name' => 'border',
							'label' => esc_html__( 'Border', 'gpur' ),
							'selector' => '{{WRAPPER}} .gpur-review-button',
						]
					);
					$this->add_control(			
						'border_radius',
						[
							'label' => esc_html__( 'Border Radius', 'gpur' ),
							'type' => \Elementor\Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%' ],
							'selectors' => [
								'{{WRAPPER}} .gpur-review-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						\Elementor\Group_Control_Box_Shadow::get_type(),
						[
							'name' => 'box_shadow',
							'selector' => '{{WRAPPER}} .gpur-review-button',
						]
					);
				$this->end_controls_tab();

				$this->start_controls_tab(
					'_gpur_tab_border_hover',
					[
						'label' => esc_html__( 'Hover', 'gpur' ),
					]
				);			
					$this->add_group_control(
						\Elementor\Group_Control_Border::get_type(),
						[
							'name' => 'border_hover',
							'label' => esc_html__( 'Border Hover', 'gpur' ),
							'selector' => '{{WRAPPER}} .gpur-review-button:hover',
						]
					);						
					$this->add_control(			
						'border_radius_hover',
						[
							'label' => esc_html__( 'Border Radius', 'gpur' ),
							'type' => \Elementor\Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%' ],
							'selectors' => [
								'{{WRAPPER}} .gpur-review-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						\Elementor\Group_Control_Box_Shadow::get_type(),
						[
							'name' => 'box_shadow_hover',
							'selector' => '{{WRAPPER}} .gpur-review-button:hover',
						]
					);
				$this->end_controls_tab();
				
			$this->end_controls_tabs();	
			
		$this->end_controls_section();	

		/*--------------------------------------------------------------
		Icon
		--------------------------------------------------------------*/
	
		$this->start_controls_section(
			'_gpur_section_icon',
			[
				'label' => esc_html__( 'Icon', 'gpur' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);	
		
			$this->add_control(
				'icon',			
				[		
					'label' => esc_html__( 'Icon', 'gpur' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => '',
						'library' => 'solid',
					],
				]
			);
			
			$this->add_control(			
				'icon_color',
				[
					'label' => esc_html__( 'Icon Color', 'gpur' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#fff',
					'selectors' => [
						'{{WRAPPER}} .gpur-review-button i' => 'color: {{VALUE}};',
					],
				]
			);
			
			$this->add_control(			
				'icon_hover_color',
				[
					'label' => esc_html__( 'Icon Hover Color', 'gpur' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#fff',
					'selectors' => [
						'{{WRAPPER}} .gpur-review-button:hover i' => 'color: {{VALUE}};',
					],
				]
			);
			
			$this->add_control(
				'icon_size',
				[
					'label' => esc_html__( 'Icon Size', 'gpur' ),
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
						'size' => 20,
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-review-button i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
			
			$this->add_control(			
				'icon_alignment',
				[
					'label' => esc_html__( 'Alignment', 'gpur' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => array(
						'icon-left' => esc_html__( 'Left', 'gpur' ),
						'icon-right' => esc_html__( 'Right', 'gpur' ),
					),
					'default' => 'icon-left',
				]
			);
			
		$this->end_controls_section();
			
		/*--------------------------------------------------------------
		Advanced
		--------------------------------------------------------------*/
	
		$this->start_controls_section(
			'_gpur_section_advanced',
			[
				'label' => esc_html__( 'Advanced', 'gpur' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);	

			$this->add_control(			
				'button_alignment',
				[
					'label' => esc_html__( 'Alignment', 'gpur' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => array(
						'button-left' => esc_html__( 'Left', 'gpur' ),
						'button-center' => esc_html__( 'Center', 'gpur' ),
						'button-right' => esc_html__( 'Right', 'gpur' ),
					),
					'default' => 'button-left',
				]
			);
		
			$this->add_control(			
				'padding',
				[
					'label' => esc_html__( 'Padding', 'gpur' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'default' => [
						'top' => 10,
						'right' => 15,							
						'bottom' => 10,
						'left' => 15,
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-review-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			
		$this->end_controls_section();	
		
	}

	protected function render() {

		$atts = $this->get_settings_for_display();
		extract( $atts );
		
		// Load template
		echo gpur_review_button_template( array( 'builder' => 'elementor', 'atts' => $atts ) );
		
	}
		
}