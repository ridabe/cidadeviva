<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Digiqole_Post_List_Widget extends Widget_Base {

  public $base;

    public function get_name() {
        return 'newszone-post-list';
    }

    public function get_title() {
        return esc_html__( 'Post List', 'digiqole' );
    }

    public function get_icon() { 
        return 'eicon-post-list';
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

            'grid_style', [
                'label' => esc_html__('Choose Style', 'digiqole'),
                'type' => Custom_Controls_Manager::IMAGECHOOSE,
                'default' => 'style1',
                'options' => [
                  'style1' => [
                     'title' =>esc_html__( 'Style 1', 'digiqole' ),
                           'imagelarge' => DIGIQOLE_IMG . '/elementor/post-list/style1-l.png',
                           'imagesmall' => DIGIQOLE_IMG . '/elementor/post-list/style1-l.png',
                           'width' => '50%',
                  ],
                  'style2' => [
                     'title' =>esc_html__( 'Style 2', 'digiqole' ),
                           'imagelarge' => DIGIQOLE_IMG . '/elementor/post-list/style2.png',
                           'imagesmall' => DIGIQOLE_IMG . '/elementor/post-list/style2.png',
                           'width' => '50%',
                  ],

                  'style3' => [
                     'title' =>esc_html__( 'Style 3', 'digiqole' ),
                           'imagelarge' => DIGIQOLE_IMG . '/elementor/post-list/style3.png',
                           'imagesmall' => DIGIQOLE_IMG . '/elementor/post-list/style3.png',
                           'width' => '50%',
                  ],

                  'style4' => [
                     'title' =>esc_html__( 'Style 4', 'digiqole' ),
                           'imagelarge' => DIGIQOLE_IMG . '/elementor/post-list/style4.png',
                           'imagesmall' => DIGIQOLE_IMG . '/elementor/post-list/style4.png',
                           'width' => '50%',
                  ],
                  'style5' => [
                     'title' =>esc_html__( 'Style 5', 'digiqole' ),
                           'imagelarge' => DIGIQOLE_IMG . '/elementor/post-list/style-6-a.png',
                           'imagesmall' => DIGIQOLE_IMG . '/elementor/post-list/style-6-a.png',
                           'width' => '50%',
                  ],

                  'style6' => [
                     'title' =>esc_html__( 'Style 6', 'digiqole' ),
                           'imagelarge' => DIGIQOLE_IMG . '/elementor/post-list/style7-a.png',
                           'imagesmall' => DIGIQOLE_IMG . '/elementor/post-list/style7-a.png',
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
            'default'       => '3',

          ]
        );

        $this->add_control(
         'post_title_crop',
         [
           'label'         => esc_html__( 'Post title crop', 'digiqole' ),
           'type'          => Controls_Manager::NUMBER,
           'default'       => '100',
          
         ]
       );

       $this->add_responsive_control(
			'thumbnail_height',
			[
				'label' =>esc_html__( 'Image height', 'digiqole' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				           
            'condition' => [ 'grid_style' => ['style6', 'style2'] ],
				'selectors' => [
					'{{WRAPPER}} .ts-grid-item-3 .ts-overlay-style .item, {{WRAPPER}} .ts-overlay-style' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
      );
 
        $this->add_control(
         'show_desc',
         [
             'label' => esc_html__('Show post description', 'digiqole'),
             'type' => Controls_Manager::SWITCHER,
             'label_on' => esc_html__('Yes', 'digiqole'),
             'label_off' => esc_html__('No', 'digiqole'),
             'default' => 'no',
             'condition' => [ 'grid_style' => ['style3','style4','style5', 'style6'] ]
         ]
         ); 
         $this->add_control(
            'post_content_crop',
            [
              'label'         => esc_html__( 'Post content crop', 'digiqole' ),
              'type'          => Controls_Manager::NUMBER,
              'default'       => '10',
              'condition' => [ 'show_desc' => ['yes'],'grid_style' => ['style3','style4','style5', 'style6'] ]
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
            'show_author',
                  [
                     'label' => esc_html__('Show Author', 'digiqole'),
                     'type' => Controls_Manager::SWITCHER,
                     'label_on' => esc_html__('Yes', 'digiqole'),
                     'label_off' => esc_html__('No', 'digiqole'),
                     'default' => 'no',
                     
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
            'post_cats',
            [
                'label' =>esc_html__('Select Categories', 'digiqole'),
                'type'      => Custom_Controls_Manager::SELECT2,
                'options'   =>$this->post_category(),
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
			'post_meta_style',
			[
				'label' => esc_html__( 'Post Meta title up/down', 'digiqole' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'meta_title_after',
				'options' => [
					'meta_title_before'  => esc_html__( 'Meta title before', 'digiqole' ),
					'meta_title_after' => esc_html__( 'Meta title after', 'digiqole' ),
            ],
            'condition' => [ 'grid_style' => ['style3'] ]
			]
		);

      $this->add_control(
            'show_overlay_style',
            [
                'label' => esc_html__('Show Overlay Style', 'digiqole'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'digiqole'),
                'label_off' => esc_html__('No', 'digiqole'),
                'default' => 'no',
                'condition' => [ 'grid_style' => ['style2'] ]

            ]
      );

      $this->add_control(
            'show_view_count',
            [
                'label' => esc_html__('Show view Count', 'digiqole'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'digiqole'),
                'label_off' => esc_html__('No', 'digiqole'),
                'default' => 'no',
                'condition' => [ 'grid_style' => ['style2','style3','style4'] ]

            ]
        );
      $this->add_control(
            'col_reverse',
            [
                'label' => esc_html__('Column Reverse', 'digiqole'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'digiqole'),
                'label_off' => esc_html__('No', 'digiqole'),
                'default' => 'no',
                'condition' => [ 'grid_style' => ['style4'] ]
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
               'condition' => [ 'grid_style' => ['style1','style2'] ]

            ]
      ); 
        
        $this->add_control(
         'post_readmore',
         [
            'label' => esc_html__('Read more', 'digiqole'),
            'type' => Controls_Manager::TEXT,
            'default' => esc_html__( 'read more', 'digiqole' ),
            'condition' => [ 'grid_style' => ['style4','style6'] ]
         ]
        );
      
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_title_typography',
				'label' => esc_html__( 'Big Post Typography', 'digiqole' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .post-list-2 .item .post-content .post-title',
                'condition' => [ 'show_overlay_style' => ['yes'] ],

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

        $this->end_controls_section();

      $this->start_controls_section('digiqole_style_block_feature_section',
         [
            'label' => esc_html__( ' Post feature', 'digiqole' ),
            'tab' => Controls_Manager::TAB_STYLE,
         ]
     );

     $this->add_control(
      'feature_title_color',
         [
            'label' => esc_html__('Feature Title color', 'digiqole'),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'condition' => [ 'grid_style' => ['style2','style3'] ],
            'selectors' => [
         
               '{{WRAPPER}} .post-list-2 .feature-item .post-content .post-title a' => 'color: {{VALUE}};',
               '{{WRAPPER}} .post-list-3 .feature-item .post-content .post-title a' => 'color: {{VALUE}};',
            ],
         ]
   );

   $this->add_control(
      'feature_title_hv_color',
         [
            'label' => esc_html__('Feature Title hover', 'digiqole'),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'condition' => [ 'grid_style' => ['style2','style3'] ],
            'selectors' => [
         
               '{{WRAPPER}} .post-list-2 .feature-item .post-content .post-title:hover a' => 'color: {{VALUE}};',
               '{{WRAPPER}} .post-list-3 .feature-item .post-content .post-title:hover a' => 'color: {{VALUE}};',
            ],
         ]
   );

   $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
         'name' => 'feature_post_title_typography',
         'label' => esc_html__( 'Typography feature title ', 'digiqole' ),
         'scheme' => Scheme_Typography::TYPOGRAPHY_1,
         'condition' => [ 'grid_style' => ['style2','style3'] ],
          'selector' => '{{WRAPPER}} .post-list-2 .feature-item .post-content .post-title, {{WRAPPER}} .post-list-3 .feature-item .post-content .post-title',
      ]
     );

     $this->add_responsive_control(
      'title_margin',
      [
         'label' => esc_html__( 'Title margin', 'digiqole' ),
         'type' => Controls_Manager::DIMENSIONS,
             'size_units' => [ 'px','%'],
         'selectors' => [
            '{{WRAPPER}} .feature-item .post-content .post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            '{{WRAPPER}} .ts-grid-item-4.post-list-4 .post-content .post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
         ],
      ]
     );

     $this->add_control(
      'feature_block_meta_date_color',
      [
         'label' => esc_html__('Meta color', 'digiqole'),
         'type' => Controls_Manager::COLOR,
         'default' => '',
         'condition' => [ 'grid_style' => ['style2','style3'] ],
         'selectors' => [
           
            '{{WRAPPER}} .post-list-2 .feature-item .post-content .post-meta-info li' => 'color: {{VALUE}};',
            '{{WRAPPER}} .post-list-2 .feature-item .post-content .post-meta-info li a' => 'color: {{VALUE}};',
            '{{WRAPPER}} .post-list-2 .feature-item .post-content .post-meta-info li i' => 'color: {{VALUE}};',
            '{{WRAPPER}} .post-list-3 .feature-item .post-content .post-meta span ' => 'color: {{VALUE}};',
            '{{WRAPPER}} .post-list-3 .feature-item .post-content .post-meta span a' => 'color: {{VALUE}};',
            '{{WRAPPER}} .post-list-3 .feature-item .post-content .post-meta span' => 'color: {{VALUE}};',
            '{{WRAPPER}} .post-list-3 .feature-item .post-content .post-meta span > i' => 'color: {{VALUE}} !important;',
         
         ],
      ]
   );
   $this->end_controls_section();

   $this->start_controls_section('digiqole_style_block_section',
         [
            'label' => esc_html__( 'Post', 'digiqole' ),
            'tab' => Controls_Manager::TAB_STYLE,
         ]
   );

   $this->add_control(
      'block_title_color',
         [
            'label' => esc_html__('Title color', 'digiqole'),
            'type' => Controls_Manager::COLOR,
            'default' => '',
          
            'selectors' => [
               '{{WRAPPER}} .ts-grid-item-2 .post-content .post-title a' => 'color: {{VALUE}};',
               '{{WRAPPER}} .post-list-2 > .item .post-content .post-title a' => 'color: {{VALUE}};',
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
               '{{WRAPPER}} .ts-grid-item-2 .post-content .post-title:hover a' => 'color: {{VALUE}};',
               '{{WRAPPER}} .post-list-2 > .item .post-content .post-title:hover a' => 'color: {{VALUE}};',
               '{{WRAPPER}} .post-content .post-title:hover a' => 'color: {{VALUE}};',
            ],
         ]
      );

      $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'post_title_typography',
				'label' => esc_html__( 'Typography title ', 'digiqole' ),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
             'selector' => '{{WRAPPER}} .ts-grid-item-2 .post-content .post-title,{{WRAPPER}} .post-list-2 > .item .post-content .post-title,
             {{WRAPPER}} .post-list-3 .post-block-list .post-content .post-title,
             {{WRAPPER}} .post-list-4 .post-block-style .post-content .post-title,
             {{WRAPPER}} .post-list-5 .post-block-style .post-content .post-title,
             {{WRAPPER}} .post-list-6 .post-block-style .post-content .post-title ',
			]
        );
      
        $this->add_control(
         'block_content_color',
         [
            'label' => esc_html__('Content color', 'digiqole'),
            'type' => Controls_Manager::COLOR,
            'default' => '',
          
            'selectors' => [
               '{{WRAPPER}} .ts-grid-item-2 .post-content p' => 'color: {{VALUE}};',
               '{{WRAPPER}} .post-list-2 > .item .post-content p' => 'color: {{VALUE}};',
               '{{WRAPPER}} .post-content p' => 'color: {{VALUE}};',
            ],
         ]
      );

      $this->add_group_control(
      Group_Control_Typography::get_type(),
         [
            'name' => 'post_content_typography',
            'label' => esc_html__( 'Typography content ', 'digiqole' ),
            'scheme' => Scheme_Typography::TYPOGRAPHY_3,
            'selector' => '{{WRAPPER}} .post-content p',
         ]
      );
      $this->add_control(
         'block_meta_date_color',
         [
            'label' => esc_html__('Meta color', 'digiqole'),
            'type' => Controls_Manager::COLOR,
            'default' => '',
          
            'selectors' => [
               '{{WRAPPER}} .ts-grid-item-2 .post-content span' => 'color: {{VALUE}};',
               '{{WRAPPER}} .post-list-2 > .item .post-content span' => 'color: {{VALUE}};',
               '{{WRAPPER}} .post-content span' => 'color: {{VALUE}};',
               '{{WRAPPER}} .post-content span i,{{WRAPPER}} .post-content span i,{{WRAPPER}} .post-content span a' => 'color: {{VALUE}};',
               '{{WRAPPER}} .post-content .post-meta span i,{{WRAPPER}} .post-content .post-meta span i,{{WRAPPER}} .post-content .post-meta span a' => 'color: {{VALUE}} !important;',
             
            ],
         ]
      );

      $this->add_responsive_control(
			'content_padding',
			[
				'label' => esc_html__( 'Content Padding', 'digiqole' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px','%'],
				'selectors' => [
					'{{WRAPPER}} .ts-grid-item-3 .ts-overlay-style .post-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ts-grid-item-4 .post-block-style' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

      $this->end_controls_section();
      
   $this->start_controls_section('post_border_style',
         [
            'label' => esc_html__( 'Advance', 'digiqole' ),
            'tab' => Controls_Manager::TAB_STYLE,
            'condition' => [ 'grid_style' => ['style4'] ],
         ]
      );
      $this->add_control(
         'show_border',
         [
             'label' => esc_html__('Show border', 'digiqole'),
             'type' => Controls_Manager::SWITCHER,
             'label_on' => esc_html__('Yes', 'digiqole'),
             'label_off' => esc_html__('No', 'digiqole'),
             'default' => 'yes',
         ]
         ); 

      $this->add_control(
         'post_border_color',
         [
            'label' => esc_html__('Post border color', 'digiqole'),
            'type' => Controls_Manager::COLOR,
            'default' => '',
          
            'selectors' => [
               '{{WRAPPER}} .ts-grid-item-4 .post-block-style:not(:last-child):after' => 'background-color: {{VALUE}};',
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
               '{{WRAPPER}} .ts-overlay-style::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ts-overlay-style .item, .ts-overlay-style.item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
               '{{WRAPPER}} .post-block-style .post-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
         ]
         );
         $this->end_controls_section();

         
    }

    protected function render( ) { 
        $settings = $this->get_settings();
        
        $show_cat           = $settings['show_cat'];
        $show_date          = $settings['show_date'];
        $post_title_crop    = $settings['post_title_crop'];
        $post_content_crop  = $settings['post_content_crop'];
        $show_author        = $settings['show_author'];      
        $show_view_count    = $settings['show_view_count'];
        $post_meta_style    = $settings['post_meta_style'];
        $show_border        = $settings['show_border'];
        $col_reverse        = $settings['col_reverse'];
        $readmore           = ''; 

        $arg = [
            'post_type'   =>  'post',
            'post_status' => 'publish',
            'order'       => $settings['post_order'],
            'posts_per_page' => $settings['post_count'],
            'category__in'   => $settings['post_cats'],
            'tag__in'        => $settings['post_tags'],
            'suppress_filters' => false,
        ];

        if($settings['ts_offset_enable']=='yes'){
         $arg['offset'] = $settings['ts_offset_item_num'];
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
        $query = new \WP_Query( $arg ); ?>
     
         <?php if($settings['grid_style'] =='style1'): ?>  
           
               <div class="ts-grid-item-2">
                  <?php while ($query->have_posts()) : $query->the_post(); ?>
                     
                     <?php require 'style/post-list/content-style1.php'; ?>
                     
                  <?php endwhile; ?>
               </div>
               
         <?php elseif($settings['grid_style'] =='style2'): ?>  
               <div class="ts-grid-item-3 post-list-2">
                  <?php while ($query->have_posts()) : $query->the_post(); ?>
                          <?php if ( $query->current_post == 0 ): ?>
                              <div class="feature-item">
                                 <?php require 'style/post-grid/content-style1.php'; ?>
                              </div>
                          <?php else: ?>
                             <?php require 'style/post-list/content-style1.php'; ?>
                          <?php endif ?> 
                  <?php endwhile; ?>
               </div>  
         <?php elseif($settings['grid_style'] =='style3'): ?>  
               <div class="ts-grid-item-3 post-list-3">
                  <?php $settings['show_author'] = 'no'; ?>
                     <?php while ($query->have_posts()) : $query->the_post(); ?>
                           <?php if ( $query->current_post == 0 ): ?>
                                 <div class="feature-item  post-block-style">
                                    <?php  require 'style/post-grid/content-style3.php'; ?>
                                 </div>
                           <?php else: ?>
                           <?php  require 'style/post-list/content-style3.php'; ?>
                           <?php endif ?> 
                     <?php endwhile; ?>
               </div>    
         <?php elseif($settings['grid_style'] =='style4'): ?>  
            <div class="ts-grid-item-4 post-list-4  <?php echo esc_attr(($show_border == 'yes')? 'show-border' : ''); ?>">
               <?php while ($query->have_posts()) : $query->the_post(); ?>
                        
                  <?php  require 'style/post-list/content-style4.php'; ?>
                     
               <?php endwhile; ?>
            </div>   
         <?php elseif($settings['grid_style'] =='style5'): ?>  
            <div class="ts-grid-item-4 post-list-5">
               <?php while ($query->have_posts()) : $query->the_post(); ?>
                        
                  <?php  require DIGIQOLE_EDITOR_ELEMENTOR. '/widgets/style/post-list/content-style5.php'; ?>
                     
               <?php endwhile; ?>
            </div>
         <?php elseif($settings['grid_style'] =='style6'): ?>  
            <div class="ts-grid-item-4 post-list-6">
               <div class="row"> 
                  <?php while ($query->have_posts()) : $query->the_post(); ?>
                        <div class="col-lg-6">
                        <?php  require 'style/post-list/content-style4.php'; ?>
                        </div>  
                  <?php endwhile; ?>
               </div>
            </div>   
         <?php endif; wp_reset_postdata(); ?>    
                             
         <?php
    }
    protected function _content_template() { }

    public function post_category() {

      $terms = get_terms( array(
            'taxonomy'    => 'category',
            'hide_empty'  => false,
            'posts_per_page' => -1, 
      ) );

      $cat_list = [];
      foreach($terms as $post) {
      $cat_list[$post->term_id]  = [$post->name];
      }
      return $cat_list;
   }
}
