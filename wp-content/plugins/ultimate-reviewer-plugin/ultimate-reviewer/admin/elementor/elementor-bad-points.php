<?php class GPUR_Elementor_Bad_Points_Widget extends Elementor\Widget_Base {

	public function get_name() {
		return 'gpur_bad_points';
	}

	public function get_title() {
		return esc_html__( 'Bad Points', 'gpur' );
	}

	public function get_icon() {
		return 'eicon-close';
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
			'_gpur_section_title',
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
					'default' => esc_html__( 'Bad', 'gpur' ),
				]
			);	
			
			$this->add_control(
				'title_color',
				[
					'label' => esc_html__( 'Text Color', 'gpur' ),
					'type' => \Elementor\Controls_Manager::COLOR,
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
					'selector' => '{{WRAPPER}} .gpur-element-title',
				]
			);
						
			$this->add_control(
				'title_extra_css',
				[
					'label' => esc_html__( 'Extra CSS', 'gpur' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,
					'selectors' => [
						'{{WRAPPER}} .gpur-element-title' => '{{VALUE}}',
					],
				]
			);
		
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
						'value' => 'fas fa-angle-right',
						'library' => 'solid',
					],
				]
			);
			
			$this->add_control(
				'icon_color',
				[
					'label' => esc_html__( 'Icon Color', 'gpur' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .gpur-bad-list li i:before' => 'color: {{VALUE}};',
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
						'size' => '',
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-bad-list li i:before' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
			
			$this->add_control(
				'icon_extra_css',
				[
					'label' => esc_html__( 'Extra CSS', 'gpur' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,
					'selectors' => [
						'{{WRAPPER}} .gpur-bad-list li i:before' => '{{VALUE}}',
					],
				]
			);
				
		$this->end_controls_section();
				
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
				'text_color',
				[
					'label' => esc_html__( 'Text Color', 'gpur' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .gpur-bad-list li' => 'color: {{VALUE}};',
					],
				]
			);
			
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'text_typography',
					'label' => esc_html__( 'Typography', 'gpur' ),
					'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_3,
					'default' => array(
						'font_weight' => '400',
					),
					'selector' => '{{WRAPPER}} .gpur-bad-list li',
				]
			);
			
			$this->add_control(
				'text_extra_css',
				[
					'label' => esc_html__( 'Extra CSS', 'gpur' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,
					'selectors' => [
						'{{WRAPPER}} .gpur-bad-list li' => '{{VALUE}}',
					],
				]
			);

		$this->end_controls_section();
		
	}

	protected function render() {
		
		$atts = $this->get_settings_for_display();
		extract( $atts );
		
		// Load template
		echo gpur_bad_points_template( array( 'builder' => 'elementor', 'atts' => $atts ) );

	}
		
}