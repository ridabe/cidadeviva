<?php class GPUR_Elementor_Review_Template_Widget extends Elementor\Widget_Base {

	public function get_name() {
		return 'gpur_review_template';
	}

	public function get_title() {
		return esc_html__( 'Review Template', 'gpur' );
	}

	public function get_icon() {
		return 'eicon-star-o';
	}

	public function get_categories() {
		if ( 'gpur-template' !== get_post_type() ) {
			return [ 'review' ];
		}	
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'gpur' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
				
			$this->add_control(
				'template_id',
				[
					'label' => esc_html__( 'Template', 'gpur' ),
					'description' => esc_html__( 'Select the template you want to display.', 'gpur' ),
					'options' => gpur_templates_dropdown_values( true ),
					'type' => \Elementor\Controls_Manager::SELECT,
				]
			);
		
			$this->add_control(
				'classes',
				[
					'label' => esc_html__( 'Extra Class Name', 'gpur' ),
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'gpur' ),
					'type' => \Elementor\Controls_Manager::TEXT,
				]
			);
					
		$this->end_controls_section();
		
	}

	protected function render() {

		$atts = $this->get_settings_for_display();
		extract( $atts );
				
		// Load template	
		echo gpur_review_template( array( 'builder' => 'elementor', 'atts' => $atts ) );
				
	}
		
}