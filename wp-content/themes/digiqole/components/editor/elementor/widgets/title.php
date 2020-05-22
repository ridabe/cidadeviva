<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;


class Digiqole_Title_Widget extends Widget_Base {


    public $base;

    public function get_name() {
        return 'newszone-title';
    }

    public function get_title() {
        return esc_html__( 'Title', 'digiqole' );
    }

    public function get_icon() { 
        return 'eicon-type-tool';
    }

    public function get_categories() {
        return [ 'digiqole-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('Title settings', 'digiqole'),
            ]
        );

        $this->add_control(

            'title_style', [
                'label' => esc_html__('Choose Style', 'digiqole'),
                'type' => Custom_Controls_Manager::IMAGECHOOSE,
                'default' => 'style1',
                'options' => [
                  'style1' => [
                     'title' =>esc_html__( 'Style 1', 'digiqole' ),
                           'imagelarge' => DIGIQOLE_IMG . '/admin/title/style-1.png',
                           'imagesmall' => DIGIQOLE_IMG . '/admin/title/style-1.png',
                           'width' => '50%',
                  ],
                  'style2' => [
                     'title' =>esc_html__( 'Style 2', 'digiqole' ),
                           'imagelarge' => DIGIQOLE_IMG . '/admin/title/style-2.png',
                           'imagesmall' => DIGIQOLE_IMG . '/admin/title/style-2.png',
                           'width' => '50%',
                  ],
                  'style3' => [
                     'title' =>esc_html__( 'Style 2', 'digiqole' ),
                           'imagelarge' => DIGIQOLE_IMG . '/admin/title/style-3.png',
                           'imagesmall' => DIGIQOLE_IMG . '/admin/title/style-3.png',
                           'width' => '50%',
                  ],
                  'style4' => [
                     'title' =>esc_html__( 'Style 2', 'digiqole' ),
                           'imagelarge' => DIGIQOLE_IMG . '/admin/title/style-4.png',
                           'imagesmall' => DIGIQOLE_IMG . '/admin/title/style-4.png',
                           'width' => '50%',
                  ],
				
				  ],

            ]
        ); 
     

      
        $this->add_control(
			'title', [
				'label'			  => esc_html__( 'Heading text', 'digiqole' ),
				'type'			  => Controls_Manager::TEXT,
				'label_block'	  => true,
				'placeholder'    => esc_html__( 'Heading text', 'digiqole' ),
				'default'	     => esc_html__( ' Life Style ', 'digiqole' ),
				
			]
      );

   
      
      $this->add_control(
        'heading_type',
        [
            'label' => __( 'Heading type', 'digiqole' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'h2',
            'options' => [
                'h1'  => __( 'H1', 'digiqole' ),
                'h2' => __( 'H2', 'digiqole' ),
                'h3' => __( 'H3', 'digiqole' ),
                'h4' => __( 'H4', 'digiqole' ),
                'h5' => __( 'H5', 'digiqole' ),
                'h6' => __( 'H6', 'digiqole' ),
                'p' => __( 'P', 'digiqole' ),
            ],
        ]
    );

     
        
        $this->add_responsive_control(
			'title_align', [
				'label'			 => esc_html__( 'Alignment', 'digiqole' ),
				'type'			 => Controls_Manager::CHOOSE,
				'options'		 => [

               'left'		 => [
                  
                  'title'	 => esc_html__( 'left', 'digiqole' ),
						'icon'	 => 'fa fa-align-left',
               
               ],
				'center'	     => [
                  
                  'title'	 => esc_html__( 'Center', 'digiqole' ),
						'icon'	 => 'fa fa-align-center',
               
               ],
				'right'		 => [

						'title'	 => esc_html__( 'Right', 'digiqole' ),
                  'icon'	 => 'fa fa-align-right',
                  
					],
				'justify'	 => [

						'title'	 => esc_html__( 'Justified', 'digiqole' ),
                  'icon'	 => 'fa fa-align-justify',
                  
					],
				],
            'default'		 => 'left',
            
                'selectors' => [
                     '{{WRAPPER}}  .section-heading .block-title' => 'text-align: {{VALUE}};',

				],
			]
        );//Responsive control end
        $this->add_control(
			'show_title_left_border',
			[
				'label' => __( 'Show Title Left Border', 'digiqole' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'digiqole' ),
				'label_off' => __( 'Hide', 'digiqole' ),
				'return_value' => 'yes',
                'default' => 'yes',
                'condition' => ['title_style' => 'style1'],
			]
        );
  

        $this->end_controls_section();

       
        
        //Title Style Section
		$this->start_controls_section(
			'section_title_style', [
				'label'	 => esc_html__( 'Title', 'digiqole' ),
				'tab'	    => Controls_Manager::TAB_STYLE,
			]
        );
     
      $this->add_control(
         'title_bg_color', [
 
             'label'		 => esc_html__( 'Title Background', 'digiqole' ),
             'type'		 => Controls_Manager::COLOR,
             'condition' => ['title_style' => ['style1', 'style2', 'style4']],

             'selectors'	 => [
            '{{WRAPPER}} .block-title > span.title-bg,
            {{WRAPPER}}  .block-title > span.title-bg:before ' => 'background-color: {{VALUE}};',

            '{{WRAPPER}} .block-title > span.title-bg:after' => 'border-left-color: {{VALUE}};',
            
             ],
         ]
 
      );

      $this->add_control(
        'title_border_color', [

            'label'		 => esc_html__( 'Title border style color', 'digiqole' ),
            'type'		 => Controls_Manager::COLOR,
            'condition' => ['title_style' => ['style1', 'style2', 'style4']],

            'selectors'	 => [
               '{{WRAPPER}} .block-title.title-border' => 'border-bottom: 2px solid {{VALUE}};',
               '{{WRAPPER}} .heading-style2 .block-title.title-border:before' => 'background-color: {{VALUE}};',
               '{{WRAPPER}} .heading-style4 .block-title.title-border:before' => 'background-color: {{VALUE}};',
            ],
        ]

      );
   
      $this->add_responsive_control(
            'title_border_height',
            [
                'label' =>esc_html__( 'Border Height', 'digiqole' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'condition' => ['title_style' => ['style1', 'style2', 'style4']],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => [
                    'size' => 2,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'size' => 2,
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'size' => 2,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .heading-style2 .block-title.title-border:before' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .heading-style4 .block-title.title-border:before' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .block-title.title-border' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
            
            ]
    );
            
        
        $this->add_control(
			'title_color', [

				'label'		 => esc_html__( 'Title color', 'digiqole' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [

               '{{WRAPPER}}  .section-heading .block-title' => 'color: {{VALUE}};',
               '{{WRAPPER}}  .heading-style3 .block-title .title-angle-shap:before' => 'background: {{VALUE}};',
               '{{WRAPPER}}  .heading-style3 .block-title .title-angle-shap:after' => 'background: {{VALUE}};',
				],
			]
        );



        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Main title', 'digiqole' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            
               'selector' => '{{WRAPPER}} .section-heading .block-title',
			]
        );
        $this->add_responsive_control(
			'title_padding',
			[
				'label' => __( 'Title Text Padding', 'digiqole' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px','%'],
				'selectors' => [
					'{{WRAPPER}} .block-title.title-border .title-bg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .heading-style3 .block-title .title-angle-shap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );
        $this->add_responsive_control(
			'title_margin',
			[
				'label' => __( 'Title Margin', 'digiqole' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px','%'],
				'selectors' => [
					'{{WRAPPER}} .block-title.title-border' => 'Margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .heading-style3 .block-title' => 'Margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
			'title_angle_shap', [
				'label'	 => esc_html__( 'Title Shap', 'digiqole' ),
                'tab'	    => Controls_Manager::TAB_STYLE,
                'condition' => [ 'title_style' => ['style1'] ],
			]
        );
        $this->add_control(
			'show_title_shap',
			[
				'label' => __( 'Show Title shap', 'digiqole' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'digiqole' ),
				'label_off' => __( 'Hide', 'digiqole' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->add_responsive_control(
			'border_title_shap',
			[
				'label' => __( 'Border', 'digiqole' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'allowed_dimensions' => ['top', 'left'],
				'selectors' => [
					'{{WRAPPER}} .block-title.title-border .title-bg:after' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );
        
        $this->add_responsive_control(
			'border_title_shap_position',
			[
				'label' => __( 'Angle Shap Position', 'digiqole' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 200,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => -15,
				],
				'selectors' => [
					'{{WRAPPER}} .block-title.title-border .title-bg:after' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);


        $this->end_controls_section();

    } //Register control end

    protected function render( ) { 

		$settings = $this->get_settings();
		$title_style    = $settings['title_style'];
		$title    = $settings['title'];
		$show_title_shap    = $settings['show_title_shap'];
		$heading_type    = $settings['heading_type'];
		$show_title_left_border    = $settings['show_title_left_border'];
        

      $title_1  = str_replace(['{', '}'], ['<span>', '</span>'], $title); 
      
    ?>
        <?php if($title_style  == 'style1'): ?>
         <div class="section-heading <?php echo esc_attr(($show_title_shap=='yes')? '': 'no-title-shap'); ?>">
            <<?php echo esc_attr($heading_type); ?> class="block-title title-border <?php echo esc_attr(($show_title_left_border== 'yes')? '': 'no-left-border'); ?>">
                  
                  <span class="title-bg">
                    <?php echo esc_html($title); ?>
                  </span>   
                

            </<?php echo esc_attr($heading_type); ?>>
         </div><!-- Section title -->		
        <?php elseif ($title_style  == 'style2'): ?>
            <div class="section-heading heading-style2">
            <<?php echo esc_attr($heading_type); ?> class="block-title title-border">
                  <span class="title-bg">
                      <?php echo esc_html($title); ?>
                  </span>   

            </<?php echo esc_attr($heading_type); ?>>
         </div><!-- Section title -->	

        <?php elseif ($title_style  == 'style3'): ?>
            <div class="section-heading heading-style3">
            <<?php echo esc_attr($heading_type); ?> class="block-title">
                <span class="title-angle-shap">
                     <?php echo esc_html($title); ?>
                </span>
            </<?php echo esc_attr($heading_type); ?>>
         </div>


        <?php elseif ($title_style  == 'style4'): ?>
            <div class="section-heading heading-style4">
            <<?php echo esc_attr($heading_type); ?> class="block-title title-border">
                <span class="title-bg">
                     <?php echo esc_html($title); ?>
                </span>
            </<?php echo esc_attr($heading_type); ?>>
         </div>
        <?php  endif; ?>

     
    <?php  

    }
    
    protected function _content_template() { }
}