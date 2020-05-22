<?php class GPUR_Elementor_Up_Down_Voting_Widget extends Elementor\Widget_Base {

	public function get_name() {
		return 'gpur_up_down_voting';
	}

	public function get_title() {
		return esc_html__( 'Up/Down Voting', 'gpur' );
	}

	public function get_icon() {
		return 'eicon-facebook-like-box';
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
				'label' => __( 'Title', 'gpur' ),
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
					'default' => '',
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
		Style
		--------------------------------------------------------------*/

		$this->start_controls_section(
			'_gpur_section_style',
			[
				'label' => esc_html__( 'Style', 'gpur' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);	
	
			$this->add_control(
				'style',
				[
					'label' => esc_html__( 'Style', 'gpur' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => array(
						'style-plain' => esc_html__( 'Plain', 'gpur' ),
						'style-round-buttons' => esc_html__( 'Round Buttons', 'gpur' ),
						'style-rounded-buttons' => esc_html__( 'Rounded Buttons', 'gpur' ),
					),
					'default' => 'style-plain',
				]
			);
			
			$this->add_control(
				'counter_position',
				[
					'label' => esc_html__( 'Counter Position', 'gpur' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => array(
						'position-top' => esc_html__( 'Top', 'gpur' ),
						'position-bottom' => esc_html__( 'Bottom', 'gpur' ),
						'position-left' => esc_html__( 'Left', 'gpur' ),
						'position-right' => esc_html__( 'Right', 'gpur' ),
						'position-left-right' => esc_html__( 'Left And Right', 'gpur' ),
					),
					'default' => 'position-left-right',
				]
			);
	
		$this->end_controls_section();	
						
		/*--------------------------------------------------------------
		Up Icon
		--------------------------------------------------------------*/

		$this->start_controls_section(
			'_gpur_section_up_icon',
			[
				'label' => esc_html__( 'Up Icon', 'gpur' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);	
			
			$this->add_control(
				'up_show',
				[
					'label' => esc_html__( 'Show', 'gpur' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'return_value' => '1',
					'default' => '1',
				]
			);			
			
			$this->add_control(
				'up_icon',
				[
					'label' => esc_html__( 'Icon', 'gpur' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'far fa-thumbs-up',
						'library' => 'solid',
					],				
					'condition' => [
						'up_show' => '1',
					],
				]
			);	
					
			$this->add_control(
				'up_text',
				[
					'label' => esc_html__( 'Text', 'gpur' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,		
					'condition' => [
						'up_show' => '1',
					],
				]
			);	
					
			$this->add_control(
				'up_icon_size',
				[
					'label' => esc_html__( 'Icon/Text Size', 'gpur' ),
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
						'up_show' => '1',
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-up-vote .gpur-vote-text, {{WRAPPER}} .gpur-up-vote .gpur-vote-icon:before' => 'font-size: {{SIZE}}{{UNIT}};',
					],	
				]
			);
			
			$this->add_control(
				'up_icon_color',
				[
					'label' => esc_html__( 'Icon/Text Color', 'gpur' ),
					'type' => \Elementor\Controls_Manager::COLOR,			
					'condition' => [
						'up_show' => '1',
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-up-vote .gpur-vote-icon:before' => 'color: {{VALUE}};',
					],
				]
			);
			
			$this->add_control(
				'up_icon_color_voted',
				[
					'label' => esc_html__( 'Icon/Text Color (Voted)', 'gpur' ),
					'type' => \Elementor\Controls_Manager::COLOR,						
					'condition' => [
						'up_show' => '1',
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-up-vote.gpur-voted .gpur-vote-icon:before, {{WRAPPER}} .gpur-up-vote .gpur-vote-icon:hover:before' => 'color: {{VALUE}};',
					],
				]
			);
			
			$this->add_control(
				'up_button_size',
				[
					'label' => esc_html__( 'Button Size', 'gpur' ),
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
						'up_show' => '1',
						'style' => array( 'style-round-buttons' , 'style-rounded-buttons' ),
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-style-round-buttons .gpur-up-vote .gpur-vote-icon, {{WRAPPER}} .gpur-style-rounded-buttons .gpur-up-vote.gpur-vote-button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					],	
				]
			);
			
			$this->add_control(
				'up_button_color',
				[
					'label' => esc_html__( 'Button Color', 'gpur' ),
					'type' => \Elementor\Controls_Manager::COLOR,		
					'condition' => [
						'up_show' => '1',
						'style' => array( 'style-round-buttons' , 'style-rounded-buttons' ),
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-style-round-buttons .gpur-up-vote .gpur-vote-icon, {{WRAPPER}} .gpur-style-rounded-buttons .gpur-up-vote.gpur-vote-button' => 'color: {{VALUE}};',
					],
				]
			);
			
			$this->add_control(
				'up_button_color_voted',
				[
					'label' => esc_html__( 'Button Color (Voted)', 'gpur' ),
					'type' => \Elementor\Controls_Manager::COLOR,								
					'condition' => [
						'up_show' => '1',
						'style' => array( 'style-round-buttons' , 'style-rounded-buttons' ),
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-style-round-buttons .gpur-up-vote.gpur-voted .gpur-vote-icon, {{WRAPPER}} .gpur-style-round-buttons .gpur-up-vote .gpur-vote-icon:hover, {{WRAPPER}} .gpur-style-rounded-buttons .gpur-voting-container:not(.gpur-voted) .gpur-up-vote.gpur-vote-button:hover, {{WRAPPER}} .gpur-style-rounded-buttons .gpur-up-vote.gpur-vote-button.gpur-voted' => 'color: {{VALUE}};',
					],
				]
			);
			
			$this->add_control(
				'up_counter_size',
				[
					'label' => esc_html__( 'Counter Size', 'gpur' ),
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
						'up_show' => '1',
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-up-vote .gpur-vote-count' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
			
			$this->add_control(
				'up_counter_color',
				[
					'label' => esc_html__( 'Counter Color', 'gpur' ),
					'type' => \Elementor\Controls_Manager::COLOR,		
					'condition' => [
						'up_show' => '1',
					],	
					'selectors' => [
						'{{WRAPPER}} .gpur-up-vote .gpur-vote-count' => 'color: {{VALUE}};',
					],
				]
			);
			
		$this->end_controls_section();
				
		/*--------------------------------------------------------------
		Down Icon
		--------------------------------------------------------------*/

		$this->start_controls_section(
			'_gpur_section_down_icon',
			[
				'label' => esc_html__( 'Down Icon', 'gpur' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);	
		
			$this->add_control(
				'down_show',
				[
					'label' => esc_html__( 'Show', 'gpur' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'return_value' => '1',
					'default' => '1',
				]
			);
			
			$this->add_control(
				'down_icon',
				[
					'label' => esc_html__( 'Icon', 'gpur' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'far fa-thumbs-down',
						'library' => 'solid',
					],				
					'condition' => [
						'down_show' => '1',
					],
				]
			);	
					
			$this->add_control(
				'down_text',
				[
					'label' => esc_html__( 'Text', 'gpur' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,		
					'condition' => [
						'down_show' => '1',
					],
				]
			);	
					
			$this->add_control(
				'down_icon_size',
				[
					'label' => esc_html__( 'Icon/Text Size', 'gpur' ),
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
						'down_show' => '1',
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-down-vote .gpur-vote-text, {{WRAPPER}} .gpur-down-vote .gpur-vote-icon:before' => 'font-size: {{SIZE}}{{UNIT}};',
					],	
				]
			);
			
			$this->add_control(
				'down_icon_color',
				[
					'label' => esc_html__( 'Icon/Text Color', 'gpur' ),
					'type' => \Elementor\Controls_Manager::COLOR,			
					'condition' => [
						'down_show' => '1',
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-down-vote .gpur-vote-icon:before' => 'color: {{VALUE}};',
					],
				]
			);
			
			$this->add_control(
				'down_icon_color_voted',
				[
					'label' => esc_html__( 'Icon/Text Color (Voted)', 'gpur' ),
					'type' => \Elementor\Controls_Manager::COLOR,						
					'condition' => [
						'down_show' => '1',
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-down-vote.gpur-voted .gpur-vote-icon:before, {{WRAPPER}} .gpur-down-vote .gpur-vote-icon:hover:before' => 'color: {{VALUE}};',
					],
				]
			);
			
			$this->add_control(
				'down_button_size',
				[
					'label' => esc_html__( 'Button Size', 'gpur' ),
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
						'down_show' => '1',
						'style' => array( 'style-round-buttons' , 'style-rounded-buttons' ),
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-style-round-buttons .gpur-down-vote .gpur-vote-icon, {{WRAPPER}} .gpur-style-rounded-buttons .gpur-down-vote.gpur-vote-button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					],	
				]
			);
			
			$this->add_control(
				'down_button_color',
				[
					'label' => esc_html__( 'Button Color', 'gpur' ),
					'type' => \Elementor\Controls_Manager::COLOR,		
					'condition' => [
						'down_show' => '1',
						'style' => array( 'style-round-buttons' , 'style-rounded-buttons' ),
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-style-round-buttons .gpur-down-vote .gpur-vote-icon, {{WRAPPER}} .gpur-style-rounded-buttons .gpur-down-vote.gpur-vote-button' => 'color: {{VALUE}};',
					],
				]
			);
			
			$this->add_control(
				'down_button_color_voted',
				[
					'label' => esc_html__( 'Button Color (Voted)', 'gpur' ),
					'type' => \Elementor\Controls_Manager::COLOR,								
					'condition' => [
						'down_show' => '1',
						'style' => array( 'style-round-buttons' , 'style-rounded-buttons' ),
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-style-round-buttons .gpur-down-vote.gpur-voted .gpur-vote-icon, {{WRAPPER}} .gpur-style-round-buttons .gpur-down-vote .gpur-vote-icon:hover, {{WRAPPER}} .gpur-style-rounded-buttons .gpur-voting-container:not(.gpur-voted) .gpur-down-vote.gpur-vote-button:hover, {{WRAPPER}} .gpur-style-rounded-buttons .gpur-down-vote.gpur-vote-button.gpur-voted' => 'color: {{VALUE}};',
					],
				]
			);
			
			$this->add_control(
				'down_counter_size',
				[
					'label' => esc_html__( 'Counter Size', 'gpur' ),
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
						'down_show' => '1',
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-down-vote .gpur-vote-count' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
			
			$this->add_control(
				'down_counter_color',
				[
					'label' => esc_html__( 'Counter Color', 'gpur' ),
					'type' => \Elementor\Controls_Manager::COLOR,		
					'condition' => [
						'down_show' => '1',
					],	
					'selectors' => [
						'{{WRAPPER}} .gpur-down-vote .gpur-vote-count' => 'color: {{VALUE}};',
					],
				]
			);
			
		$this->end_controls_section();
				
		/*--------------------------------------------------------------
		Already Voted Text
		--------------------------------------------------------------*/

		$this->start_controls_section(
			'_gpur_section_already_voted_text',
			[
				'label' => esc_html__( 'Already Voted Text', 'gpur' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);	
				
			$this->add_control(
				'already_voted_label',
				[
					'label' => esc_html__( 'Label', 'gpur' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'You have already voted.', 'gpur' ),
				]
			);
		
			$this->add_control(
				'already_voted_text_color',
				[
					'label' => esc_html__( 'Text Color', 'gpur' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .gpur-error' => 'color: {{VALUE}};',
					],
				]
			);
			
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'already_voted_typography',
					'label' => esc_html__( 'Typography', 'gpur' ),
					'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_3,
					'default' => array(
						'font_weight' => '400',
					),
					'selector' => '{{WRAPPER}} .gpur-error',
				]
			);
			
			$this->add_control(
				'already_voted_text_extra_css',
				[
					'label' => esc_html__( 'Extra CSS', 'gpur' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,
					'selectors' => [
						'{{WRAPPER}} .gpur-error' => '{{VALUE}}',
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
			
			$this->add_control(
				'rich_snippets',
				[
					'label' => esc_html__( 'Rich Snippets', 'gpur' ),
					'description' => esc_html__( 'Allows search engines to read your rating data to display ratings in search results.', 'gpur' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'return_value' => '1',
					'default' => '',
				]
			);
				
		$this->end_controls_section();				

	}

	protected function render() {
		
		$atts = $this->get_settings_for_display();
		extract( $atts );
		
		// Load template
		echo gpur_up_down_voting_template( 
			array(
				'builder' => 'elementor',
				'post_id' => get_the_ID(),
				'atts' => $atts, 
			)
		);
		
	}
		
}
		