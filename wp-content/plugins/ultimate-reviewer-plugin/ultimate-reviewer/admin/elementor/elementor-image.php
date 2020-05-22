<?php class GPUR_Elementor_Image_Widget extends Elementor\Widget_Base {

	public function get_name() {
		return 'gpur_image';
	}

	public function get_title() {
		return esc_html__( 'Image', 'gpur' );
	}

	public function get_icon() {
		return 'eicon-image';
	}

	public function get_categories() {
		if ( 'gpur-template' === get_post_type() OR 'item' === get_post_meta( get_the_ID(), 'gp_template_type', true ) ) {
			return [ 'review' ];
		}
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'gpur' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
			$this->add_control(
				'image_size',
				[
					'label' => esc_html__( 'Image Size', 'gpur' ),
					'description' => esc_html__( 'Enter image size e.g. "thumbnail", "medium", "large", "full" or enter size in pixels e.g. 200 x 100 (width x height).', 'gpur' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => 'thumbnail',
				]
			);
		
			$this->add_control(
				'image_source',
				[
					'label' => esc_html__( 'Image Source', 'gpur' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => array(
						'review-image-1' => esc_html__( 'Review Image 1', 'gpur' ),
						'review-image-2' => esc_html__( 'Review Image 2', 'gpur' ),
						'featured-image' => esc_html__( 'Featured Image', 'gpur' ),
					),
					'default' => 'review-image-1',
				]
			);
		
			$this->add_control(
				'image_as_bg',
				[
					'label' => esc_html__( 'Image As Background', 'gpur' ),
					'description' => esc_html__( 'Your featured or review image will be used as the background for this row.', 'gpur' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'return_value' => '1',
					'default' => '1',
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'image_bg_properties',
					'types' => [ 'classic' ],
					'selector' => '{{WRAPPER}} .gpur-image-wrapper',
					'exclude' => [ 'color', 'image' ],
					'fields_options' => [
						'position' => [
							'label' => _x( 'Position', 'Background Control', 'gpur' ),
							'type' => \Elementor\Controls_Manager::SELECT,
							'default' => '',
							'responsive' => true,
							'options' => [
								'' => _x( 'Default', 'Background Control', 'gpur' ),
								'top left' => _x( 'Top Left', 'Background Control', 'gpur' ),
								'top center' => _x( 'Top Center', 'Background Control', 'gpur' ),
								'top right' => _x( 'Top Right', 'Background Control', 'gpur' ),
								'center left' => _x( 'Center Left', 'Background Control', 'gpur' ),
								'center center' => _x( 'Center Center', 'Background Control', 'gpur' ),
								'center right' => _x( 'Center Right', 'Background Control', 'gpur' ),
								'bottom left' => _x( 'Bottom Left', 'Background Control', 'gpur' ),
								'bottom center' => _x( 'Bottom Center', 'Background Control', 'gpur' ),
								'bottom right' => _x( 'Bottom Right', 'Background Control', 'gpur' ),
								'initial' => _x( 'Custom', 'Background Control', 'gpur' ),
							],
							'selectors' => [
								'{{SELECTOR}}' => 'background-position: {{VALUE}};',
							],
							'condition' => [
								'background' => [ 'classic' ],
							],
						],
						'repeat' => [
							'label' => _x( 'Repeat', 'Background Control', 'gpur' ),
							'type' => \Elementor\Controls_Manager::SELECT,
							'default' => '',
							'responsive' => true,
							'options' => [
								'' => _x( 'Default', 'Background Control', 'gpur' ),
								'no-repeat' => _x( 'No-repeat', 'Background Control', 'gpur' ),
								'repeat' => _x( 'Repeat', 'Background Control', 'gpur' ),
								'repeat-x' => _x( 'Repeat-x', 'Background Control', 'gpur' ),
								'repeat-y' => _x( 'Repeat-y', 'Background Control', 'gpur' ),
							],
							'selectors' => [
								'{{SELECTOR}}' => 'background-repeat: {{VALUE}};',
							],
							'condition' => [
								'background' => [ 'classic' ],
							],
						],
						'size' => [
							'label' => esc_html__( 'Size', 'Background Control', 'gpur' ),
							'type' => \Elementor\Controls_Manager::SELECT,
							'responsive' => true,
							'default' => '',
							'options' => [
								'' => _x( 'Default', 'Background Control', 'gpur' ),
								'auto' => _x( 'Auto', 'Background Control', 'gpur' ),
								'cover' => _x( 'Cover', 'Background Control', 'gpur' ),
								'contain' => _x( 'Contain', 'Background Control', 'gpur' ),
								'initial' => _x( 'Custom', 'Background Control', 'gpur' ),
							],
							'selectors' => [
								'{{SELECTOR}}' => 'background-size: {{VALUE}};',
							],
							'condition' => [
								'background' => [ 'classic' ],
							],
						],

					],
				]
			);
					
		$this->end_controls_section();
		
	}

	protected function render() {
	
		$atts = $this->get_settings_for_display();		
		extract( $atts );
	
		// Add custom class to SWITCHER element
		$this->add_render_attribute(
			'_wrapper', 
			[
				'class' => 1 == $image_as_bg ? 'gpur-image-background' : '',
			]
		);
		
		// Load template
		echo gpur_image_template( $atts );
		
	}
		
}