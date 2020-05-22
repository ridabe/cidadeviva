<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Digiqole_Post_block_Widget extends Widget_Base {

  public $base;

    public function get_name() {
        return 'newszone-post-block';
    }

    public function get_title() {
        return esc_html__( 'Post Block ', 'digiqole' );
    }

    public function get_icon() { 
        return 'eicon-nav-menu';
    }

    public function get_categories() {
        return [ 'digiqole-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('Post', 'digiqole'),
            ]
        );
        $this->add_control(

         'block_style', [
             'label' => esc_html__('Choose Style', 'digiqole'),
             'type' => Custom_Controls_Manager::IMAGECHOOSE,
             'default' => 'style1',

             'options' => [
               'style1' => [
                        'title' =>esc_html__( 'Style 1', 'digiqole' ),
                        'imagesmall' => DIGIQOLE_IMG . '/elementor/post-block/style_min1.png',
                        'imagelarge' => DIGIQOLE_IMG . '/elementor/post-block/style1.png',
                        'width' => '50%',
               ],
               'style2' => [
                        'title' =>esc_html__( 'Style 2', 'digiqole' ),
                        'imagesmall' => DIGIQOLE_IMG . '/elementor/post-block/style_min2.png',
                        'imagelarge' => DIGIQOLE_IMG . '/elementor/post-block/style2.png',
                        'width' => '50%',
               ],
               'style3' => [
                        'title' =>esc_html__( 'Style 3', 'digiqole' ),
                        'imagesmall' => DIGIQOLE_IMG . '/elementor/post-block/style_min3.png',
                        'imagelarge' => DIGIQOLE_IMG . '/elementor/post-block/style1.png',
                        'width' => '50%',
               ],
               'style4' => [
                        'title' =>esc_html__( 'Style 4', 'digiqole' ),
                        'imagesmall' => DIGIQOLE_IMG . '/elementor/post-block/style_min4.png',
                        'imagelarge' => DIGIQOLE_IMG . '/elementor/post-block/style4.png',
                        'width' => '50%',
               ],

               'style5' => [
                        'title' =>esc_html__( 'Style 5', 'digiqole' ),
                        'imagesmall' => DIGIQOLE_IMG . '/elementor/post-block/style_min5.png',
                        'imagelarge' => DIGIQOLE_IMG . '/elementor/post-block/style5.png',
                        'width' => '50%',
               ],

               'style6' => [
                  '     title' =>esc_html__( 'Style 6', 'digiqole' ),
                        'imagesmall' => DIGIQOLE_IMG . '/elementor/post-block/style_min6.png',
                        'imagelarge' => DIGIQOLE_IMG . '/elementor/post-block/style6.png',
                        'width' => '50%',
               ],

               'style7' => [
                        'title' =>esc_html__( 'Style 7', 'digiqole' ),
                        'imagesmall' => DIGIQOLE_IMG . '/elementor/post-block/style_min7.png',
                        'imagelarge' => DIGIQOLE_IMG . '/elementor/post-block/style7.png',
                        'width' => '50%',
               ],
               'style8' => [
                    'title' =>esc_html__( 'Style 8', 'digiqole' ),
                    'imagesmall' => DIGIQOLE_IMG . '/elementor/post-block/style_min8.png',
                    'imagelarge' => DIGIQOLE_IMG . '/elementor/post-block/style8.png',
                    'width' => '50%',
               ],
               'style9' => [
                    'title' =>esc_html__( 'Style 9', 'digiqole' ),
                    'imagesmall' => DIGIQOLE_IMG . '/elementor/post-block/style_min9.png',
                    'imagelarge' => DIGIQOLE_IMG . '/elementor/post-block/style9.png',
                    'width' => '50%',
               ],
               'style10' => [
                    'title' =>esc_html__( 'Style 10', 'digiqole' ),
                    'imagesmall' => DIGIQOLE_IMG . '/elementor/post-block/style_min10.png',
                    'imagelarge' => DIGIQOLE_IMG . '/elementor/post-block/style10.png',
                    'width' => '50%',
               ],
               'style11' => [
                'title' =>esc_html__( 'Style 11', 'digiqole' ),
                'imagesmall' => DIGIQOLE_IMG . '/elementor/post-block/style11.png',
                'imagelarge' => DIGIQOLE_IMG . '/elementor/post-block/style11.png',
                'width' => '50%',
           ],
         
           ],

         ]
     ); 

        $this->add_control(
          'post_count',
          [
            'label'         => esc_html__( 'Post count', 'digiqole' ),
            'type'          => Controls_Manager::NUMBER,
            'default'       => '5',
          ]
        );

        $this->add_control(
			'grid_column',
			[
				'label'   => esc_html__( 'Number of Column', 'digiqole' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'6'     => esc_html__( '2', 'digiqole' ),
					'4'       => esc_html__( '3', 'digiqole' ),
					'3' => esc_html__( '4', 'digiqole' ),
				],
                'default' => '6',
				'condition' => ['block_style' => ['style8','style11']],
			]
		);

        $this->add_responsive_control(
			'thumbnail_height',
			[
				'label' =>esc_html__( 'Feature image height', 'digiqole' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 120,
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => 300,
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => 250,
					'unit' => 'px',
            ],
            'default' => [
					'unit' => 'px',
					'size' => 192,
				],
				'selectors' => [
					'{{WRAPPER}} .post-block-style .post-thumb .item, {{WRAPPER}} .ts-overlay-style' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
      );
      
        $this->add_control(
          'post_title_crop',
          [
            'label'         => esc_html__( 'Post title crop', 'digiqole' ),
            'type'          => Controls_Manager::NUMBER,
            'default'       => '10',
          ]
        );
        $this->add_control(
          'post_sm_title_crop',
          [
            'label'         => esc_html__( 'Post Small title crop', 'digiqole' ),
            'type'          => Controls_Manager::NUMBER,
            'default'       => '10',
            'condition' => [ 'block_style' => ['style3', 'style6', 'style1'] ]
          ]
        );
        $this->add_control(
          'feature_post_title_crop',
          [
            'label'         => esc_html__( 'Feature Post title crop', 'digiqole' ),
            'type'          => Controls_Manager::NUMBER,
            'default'       => '35',
            'condition' => [ 'block_style' => ['style4','style5'] ]
          ]
        );
        $this->add_control(
            'show_desc',
               [
                  'label' => esc_html__('Show post description', 'digiqole'),
                  'type' => Controls_Manager::SWITCHER,
                  'label_on' => esc_html__('Yes', 'digiqole'),
                  'label_off' => esc_html__('No', 'digiqole'),
                  'default' => 'yes',
                  'condition' => [ 'block_style' => ['style3', 'style6', 'style5','style8','style9','style10'] ]
               ]
        );

        $this->add_control(
         'post_content_crop',
         [
           'label'         => esc_html__( 'Post content crop', 'digiqole' ),
           'type'          => Controls_Manager::NUMBER,
           'default'       => '10',
           'condition' => [ 'block_style' => ['style1', 'style3','style6', 'style5','style8','style9','style10','style11'] ]
         ]
        );

        $this->add_control(
            'post_format',
            [
                'label' =>esc_html__('Select Post Format', 'digiqole'),
                'type'      => Controls_Manager::SELECT2,
                'options' => [
					'standard'  =>esc_html__( 'Standard', 'digiqole' ),
					'video' =>esc_html__( 'Video', 'digiqole' ),
				],
				'default' => [],
                'label_block' => true,
                'multiple'  => true,
            ]
        );
        $this->add_control(
            'show_rating',
               [
                  'label' => esc_html__('Show Rating', 'digiqole'),
                  'type' => Controls_Manager::SWITCHER,
                  'label_on' => esc_html__('Yes', 'digiqole'),
                  'label_off' => esc_html__('No', 'digiqole'),
                  'default' => 'no',
                  
               ]
         ); 
    

        $this->add_control(
            'post_cats',
            [
                'label' =>esc_html__('Select Categories', 'digiqole'),
                'type'      => Controls_Manager::SELECT2,
                'options'   => $this->post_category(),
                'label_block' => true,
                'multiple'  => true,
            ]
        );

        $this->add_control(
            'post_tags',
            [
               'label' =>esc_html__('Select tags', 'digiqole'),
               'type'      => Controls_Manager::SELECT2,
               'options'   => digiqole_post_tags(),
               'label_block' => true,
               'multiple'  => true,
            ]
        );

        $this->add_control(
         'show_author',
         [
             'label' => esc_html__('Show Author', 'digiqole'),
             'type' => Controls_Manager::SWITCHER,
             'label_on' => esc_html__('Yes', 'digiqole'),
             'label_off' => esc_html__('No', 'digiqole'),
             'default' => 'yes',
         ]
       );

       $this->add_control(
        'show_author_avator',
           [
              'label' => esc_html__('Show Author image', 'digiqole'),
              'type' => Controls_Manager::SWITCHER,
              'label_on'  => esc_html__('Yes', 'digiqole'),
              'label_off' => esc_html__('No', 'digiqole'),
              'default' => 'no',
           ]
       );
      
       $this->add_responsive_control(
        'author_avator_custom_dimension',
        [
           'label' =>esc_html__( 'Avatar image size', 'digiqole' ),
               'type' => \Elementor\Controls_Manager::SLIDER,
           'range' => [
              'px' => [
                 'min' => 0,
                 'max' => 100,
              ],
           ],
           'condition' => [ 'show_author_avator' => ['yes'] ],
           'devices' => [ 'desktop', 'tablet', 'mobile' ],
           'desktop_default' => [
              'size' => 45,
              'unit' => 'px',
           ],
           'tablet_default' => [
              'size' => 45,
              'unit' => 'px',
           ],
           'mobile_default' => [
              'size' => 45,
              'unit' => 'px',
           ],
           'default' => [
              'unit' => 'px',
              'size' => 45,
           ],
           'selectors' => [
              '{{WRAPPER}} .ts-author-avatar img' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};',
             
           ],
        ]
     );

    
     $this->add_control(
            'show_view_count',
            [
               'label' => esc_html__('Show view Count', 'digiqole'),
               'type' => Controls_Manager::SWITCHER,
               'label_on' => esc_html__('Yes', 'digiqole'),
               'label_off' => esc_html__('No', 'digiqole'),
               'default' => 'yes',
            ]
      );

        $this->add_control(
            'show_date',
            [
                'label' => esc_html__('Show Date', 'digiqole'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'digiqole'),
                'label_off' => esc_html__('No', 'digiqole'),
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_cat',
            [
                'label' => esc_html__('Show Category', 'digiqole'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'digiqole'),
                'label_off' => esc_html__('No', 'digiqole'),
                'default' => 'yes',
            ]
        );
   
        $this->add_control(
            'small_show_cat',
            [
                'label' => esc_html__('Show small post Category', 'digiqole'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'digiqole'),
                'label_off' => esc_html__('No', 'digiqole'),
                'default' => 'yes',
                'condition' => [ 'block_style' => ['style4', 'style3'] ]
            ]
        );
        $this->add_control(
         'post_readmore',
         [
            'label' => esc_html__('Read more', 'digiqole'),
            'type' => Controls_Manager::TEXT,
            'default' => esc_html__( 'read more', 'digiqole' ),
            'condition' => [ 'block_style' => ['style1','style3','style8','style10','style11'] ]
         ]
        );

        $this->add_control(
            'post_sortby',
            [
                'label'     =>esc_html__( 'Post sort by', 'digiqole' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'latestpost',
                'options'   => [
                        'latestpost'      =>esc_html__( 'Latest posts', 'digiqole' ),
                        'popularposts'    =>esc_html__( 'Popular posts', 'digiqole' ),
                        'mostdiscussed'    =>esc_html__( 'Most discussed', 'digiqole' ),
                    ],
            ]
        );
        $this->add_control(
            'post_order',
            [
                'label'     =>esc_html__( 'Post order', 'digiqole' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'DESC',
                'options'   => [
                        'DESC'      =>esc_html__( 'Descending', 'digiqole' ),
                        'ASC'       =>esc_html__( 'Ascending', 'digiqole' ),
                    ],
            ]
        );

        $this->add_control(
         'ts_offset_enable',
            [
               'label' => esc_html__('Post skip', 'digiqole'),
               'type' => Controls_Manager::SWITCHER,
               'label_on' => esc_html__('Yes', 'digiqole'),
               'label_off' => esc_html__('No', 'digiqole'),
               'default' => 'no',
               
            ]
      );
      
      $this->add_control(
         'ts_offset_item_num',
         [
         'label'         => esc_html__( 'Skip post count', 'digiqole' ),
         'type'          => Controls_Manager::NUMBER,
         'default'       => '1',
         'condition' => [ 'ts_offset_enable' => 'yes' ]

         ]
      );

        $this->add_control(
         'reverse_col',
         [
             'label' => esc_html__('Reverse Column', 'digiqole'),
             'type' => Controls_Manager::SWITCHER,
             'label_on' => esc_html__('Yes', 'digiqole'),
             'label_off' => esc_html__('No', 'digiqole'),
             'default' => 'no',
             'condition' => [ 'block_style' => ['style2','style3','style5'] ]
         ]
       );

        $this->end_controls_section();

        $this->start_controls_section('digiqole_style_block_section',
        [
           'label' => esc_html__( ' Post', 'digiqole' ),
           'tab' => Controls_Manager::TAB_STYLE,
        ]
       );
  
       $this->add_control(
           'block_title_color',
           [
              'label' => esc_html__('Feature Title color', 'digiqole'),
              'type' => Controls_Manager::COLOR,
              'default' => '',
            
              'selectors' => [
                 '{{WRAPPER}} .post-content .post-title a' => 'color: {{VALUE}};',
              ],
           ]
        );
  
        $this->add_control(
           'block_title_hv_color',
           [
              'label' => esc_html__('Title hover color', 'digiqole'),
              'type' => Controls_Manager::COLOR,
              'default' => '',
            
              'selectors' => [
                 '{{WRAPPER}} .post-content .post-title:hover a' => 'color: {{VALUE}};',
              ],
           ]
        );
        $this->add_control(
            'description_color',
            [
               'label' => esc_html__('Descrition Color', 'digiqole'),
               'type' => Controls_Manager::COLOR,
               'default' => '',
                'condition' => ['block_style' => 'style3','style11'],
               'selectors' => [
                  '{{WRAPPER}} .post-content p' => 'color: {{VALUE}};',
               ],
            ]
         );
        $this->add_control(
			'feature_post_title_head',
			[
				'label' => esc_html__( 'Feature title', 'digiqole' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_group_control(
           Group_Control_Typography::get_type(),
           [
              'name' => 'feature_post_title_typography',
              'label' => esc_html__( 'Typography', 'digiqole' ),
              'scheme' => Scheme_Typography::TYPOGRAPHY_1,
              'selector' => '{{WRAPPER}} .post-float .post-content .post-title,
                {{WRAPPER}} .post-block-style7 .ts-overlay-style .post-content .post-title,
                {{WRAPPER}} .bg-feature-post .ts-overlay-style .post-content .post-title,
                {{WRAPPER}} .post-block-item.block-item-post.style2 .ts-overlay-style .post-content .post-title,
                {{WRAPPER}} .post-block-item.block-item-post-tab.style3 .order-md-1 .post-content .post-title,
                {{WRAPPER}} .post-block-item.block-item-post.style4 .ts-overlay-style .post-content .post-title,
                {{WRAPPER}} .post-block-item.block-item-post.style6 .post-feature .post-block-style .post-content .post-title,
                {{WRAPPER}} .post-block-item.style3 .feature-grid-content .post-content .post-title,
                {{WRAPPER}} .post-block-item.style3 .feature-grid-content .post-content .post-title,
                {{WRAPPER}} .block-item-post .post-content .post-title,
                {{WRAPPER}} .block-item-post.style1 .post-content .post-title.md',
           ]
        );
        $this->add_control(
			'feature_title_margin',
			[
				'label' => esc_html__( 'feature title Margin', 'digiqole' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .post-float .post-content .post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .post-block-item.style3 .feature-grid-content .post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .post-block-style .post-content .post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .block-item-post .post-block-style .post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'post_title_typography_haed',
			[
				'label' => esc_html__( 'Small Title', 'digiqole' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_group_control(
         Group_Control_Typography::get_type(),
         [
            'name' => 'post_title_typography_small',
            'label' => esc_html__( 'Typography', 'digiqole' ),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .list-item .item .post-content .post-title,
            {{WRAPPER}} .post-block-item.style5 .post-block-style .post-content .post-title,
            {{WRAPPER}} .post-block-item.block-item-post.style2 .post-block-style .post-content .post-title,
            {{WRAPPER}} .post-block-item.block-item-post-tab.style3 .order-md-2 .post-content .post-title,
            {{WRAPPER}} .post-block-item.block-item-post.style4 .post-block-list .post-content .post-title,
            {{WRAPPER}} .post-block-item.block-item-post.style6 .post-block-style.style7 .post-content .post-title,
            {{WRAPPER}} .post-block-item.style3 .sm-grid-content .post-content .post-title,
            {{WRAPPER}} .block-item-post.style1 .post-block-list .post-block-style .post-title',
         ]
      );
      $this->add_control(
        'sm_title_margin',
        [
                'label' => esc_html__( 'Small title Margin', 'digiqole' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'condition' => ['block_style' => 'style3'],
                'selectors' => [
                    '{{WRAPPER}} .sm-grid-content .post-float .post-content .post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
           'block_meta_date_color',
           [
              'label' => esc_html__('Footer color', 'digiqole'),
              'type' => Controls_Manager::COLOR,
              'default' => '',
            
              'selectors' => [
                 '{{WRAPPER}} .post-content .post-meta span,{{WRAPPER}} .post-content .post-meta span a,{{WRAPPER}} .post-content .post-meta span i' => 'color: {{VALUE}};',
                 '{{WRAPPER}} .post-content .post-meta-info li,{{WRAPPER}} .post-content .post-meta-info li a,{{WRAPPER}} .post-content .post-meta-info li i' => 'color: {{VALUE}};',
              ],
           ]
        );

        
  
        $this->end_controls_section();

        $this->start_controls_section('digiqole_style_advance_section',
        [
           'label' => esc_html__( ' Advance', 'digiqole' ),
           'tab' => Controls_Manager::TAB_STYLE,
        ]
       );
       $this->add_responsive_control(
        'border_radius',
        [
           'label' => esc_html__( 'Border Radius', 'digiqole' ),
           'type' => Controls_Manager::DIMENSIONS,
               'size_units' => [ 'px','%'],
           'selectors' => [
              '{{WRAPPER}} .post-block-style .post-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
              '{{WRAPPER}} .ts-overlay-style::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
              '{{WRAPPER}} .ts-overlay-style .item, .ts-overlay-style.item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
           ],
        ]
       );

       $this->add_responsive_control(
        'content_padding',
        [
                'label' => esc_html__( 'Feature Content Padding', 'digiqole' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'condition' => [ 'block_style' => ['style2','style4','style5','style7','style9','style11'] ],

                'selectors' => [
                    '{{WRAPPER}} .ts-overlay-style .post-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

       $this->add_responsive_control(
        'block_post_margin',
        [
                'label' => esc_html__( 'Post Margin', 'digiqole' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'condition' => [ 'block_style' => ['style8','style9','style11'] ],
                'selectors' => [
                    '{{WRAPPER}} .post-block-item.style8 .post-block-style' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .block-item-post.style9 .post-block-style' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .block-item-post .post-block-style' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .block-item-post .ts-overlay-review-style ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_overlay',
				'label' => esc_html__( 'Background Overlay', 'digiqole' ),
				'types' => [ 'classic', 'gradient'],
                'selector' => '{{WRAPPER}} .ts-overlay-style::before',
                'condition' => [ 'block_style' => ['style2','style4','style5','style7'] ],
			]
		);

  

        $this->end_controls_section();
    }

    protected function render( ) { 

        $settings = $this->get_settings();
        $post_order         = $settings['post_order'];
        $post_sortby        = $settings['post_sortby'];
        $show_cat           = $settings['show_cat'];
        $small_show_cat     = $settings['small_show_cat'];
        $show_date          = $settings['show_date'];
        $show_desc          = $settings['show_desc'];
        $post_format        = $settings['post_format'];
        $post_title_crop    = $settings['post_title_crop'];
        $post_content_crop  = $settings['post_content_crop'];
        $post_number        = $settings['post_count'];
        $readmore           = $settings['post_readmore'];      
        $show_author        = $settings['show_author'];      
        $show_view_count    = $settings['show_view_count'];    
        $show_author_avator = isset($settings['show_author_avator'])?
                                $settings['show_author_avator'] 
                                :'no';   

        $grid_column = $settings['grid_column'];   

        $arg = [
            'post_type'   =>  'post',
            'post_status' => 'publish',
            'order' => $settings['post_order'],
            'posts_per_page' => $settings['post_count'],
            'category__in' => $settings['post_cats'],
            'tag__in' => $settings['post_tags'],
            'suppress_filters' => false,

        ];
        
        if($settings['ts_offset_enable']=='yes'){
         $arg['offset'] = $settings['ts_offset_item_num'];
       }


        if(in_array('video',$post_format) && !in_array('standard',$post_format)) {

         $arg['tax_query'] = array(
                  array(
                  'taxonomy' => 'post_format',
                  'field' => 'slug',
                  'terms' => array('post-format-video'),
                  'operator' => 'IN'
               ) 
           );

       } 

        switch($settings['post_sortby']){
         case 'popularposts':
             $arg['meta_key'] = 'newszone_post_views_count';
             $arg['orderby'] = 'meta_value_num';
         break;
         case 'mostdiscussed':
             $arg['orderby'] = 'comment_count';
         break;
         default:
             $arg['orderby'] = 'date';
         break;
     }

        $settings['ts_image_size'] = 'post-thumbnail';
        //$settings['show_author'] = 'no';
        $query = new \WP_Query( $arg ); ?>
        
         <?php if ( $query->have_posts() ) : ?>
            <?php if($settings['block_style']=="style1"): ?>  
              <?php  require 'style/post-grid/content-style1-a.php'; ?>
            <?php endif; ?>
            <?php if($settings['block_style']=="style2"): ?>  
                <?php  require 'style/post-grid/content-style1-b.php'; ?>
            <?php endif; ?>
            <?php if($settings['block_style']=="style3"): ?>  
                <?php  require 'style/post-grid/content-style1-c.php'; ?>
            <?php endif; ?>
            <?php if($settings['block_style']=="style4"): ?>  
                <?php  require 'style/post-grid/content-style1-d.php'; ?>
            <?php endif; ?>
            <?php if($settings['block_style']=="style5"): ?>  
            <?php  require 'style/post-grid/content-style4.php'; ?>
            <?php endif; ?>
            <?php if($settings['block_style']=="style6"): ?>  
            <?php  require 'style/post-grid/content-style1-f.php'; ?>
            <?php endif; ?>

            <?php if($settings['block_style']=="style7"): ?>  
            <?php  require 'style/post-grid/content-style1-g.php'; ?>
            <?php endif; ?>

              <?php if($settings['block_style']=="style8"): ?>  
                <?php  require 'style/post-grid/content-style1-i.php'; ?>
              <?php endif; ?>
              <?php if($settings['block_style']=="style9"): ?>  
                <?php  require 'style/post-grid/content-style1-j.php'; ?>
              <?php endif; ?>
              <?php if($settings['block_style']=="style10"): ?>  
                <?php  require 'style/post-grid/content-style1-k.php'; ?>
              <?php endif; ?>
              <?php if($settings['block_style']=="style11"): ?>  
                <?php  require 'style/post-grid/content-style1-l.php'; ?>
              <?php endif; ?>
             <?php wp_reset_postdata(); ?>
         <?php endif; ?>

      <?php  
    }
    protected function _content_template() { }

    public function post_category() {

        $terms = get_terms( array(
                'taxonomy'    => 'category',
                'hide_empty'  => false,
                'posts_per_page' => -1, 
            ) 
        );

      $cat_list = [];
      foreach($terms as $post) {
      $cat_list[$post->term_id]  = [$post->name];
      }
      return $cat_list;
   }
}