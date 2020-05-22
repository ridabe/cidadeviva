<?php class GPUR_Elementor_Title_Widget extends Elementor\Widget_Base {

	public function get_name() {
		return 'gpur_title';
	}

	public function get_title() {
		return esc_html__( 'Title', 'gpur' );
	}

	public function get_icon() {
		return 'eicon-post-title';
	}

	public function get_categories() {
		if ( 'gpur-template' === get_post_type() OR 'item' === get_post_meta( get_the_ID(), 'gp_template_type', true ) ) {
			return [ 'review' ];
		}
	}

	protected function _register_controls() {
	
		$this->start_controls_section(
			'_gpur_section_post_title',
			[
				'label' => esc_html__( 'Title', 'gpur' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

			$this->add_control(
				'title_link',
				[
					'label' => esc_html__( 'Title Link', 'gpur' ),
					'description' => esc_html__( 'Link the title to the post.', 'gpur' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'return_value' => '1',
					'default' => '',
				]
			);
								
			$this->add_control( 
				'title_color',
				[
					'label' => esc_html__( 'Title Color', 'gpur' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .gpur-post-title, {{WRAPPER}} .gpur-post-title a' => 'color: {{VALUE}};',
					],
				]	
			);
								
			$this->add_control( 
				'title_hover_color',
				[
					'label' => esc_html__( 'Title Hover Color', 'gpur' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'condition' => [
						'title_link' => '1',
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-post-title a:hover' => 'color: {{VALUE}};',
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
					'selector' => '{{WRAPPER}} .gpur-post-title',
				]
			);
			
			$this->add_control( 
				'title_extra_css',
				[
					'label' => esc_html__( 'Extra CSS', 'gpur' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,
					'selectors' => [
						'{{WRAPPER}} .gpur-post-title' => '{{VALUE}}',
					],
				]	
			);
			
		$this->end_controls_section();
		
	}

	protected function render() {
		
		$atts = $this->get_settings_for_display();	
		extract( $atts );
				
		// Load template	
		echo gpur_title_template( array( 'builder' => 'elementor', 'atts' => $atts ) );
		
	}
		
}