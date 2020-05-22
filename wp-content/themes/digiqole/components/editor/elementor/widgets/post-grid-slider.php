<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Digiqole_Post_Grid_Slider_Widget extends Widget_Base {

  public $base;

    public function get_name() {
        return 'newszone-post-grid-slider';
    }

    public function get_title() {
        return esc_html__( 'Posts Grid Slider', 'digiqole' );
    }

    public function get_icon() { 
        return 'eicon-posts-grid';
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
                        'title' => esc_html__( 'Style 1', 'digiqole' ),
                              'imagelarge' => DIGIQOLE_IMG . '/elementor/post-grid/post-grid-slider.png',
                              'imagesmall' => DIGIQOLE_IMG . '/elementor/post-grid/post-grid-slider.png',
                              'width' => '50%',
                     ],
              	],
            ]
        ); 
       
   
      $this->add_control(
         'post_gradient',
             [
             'label' => esc_html__( 'Gradient Color', 'digiqole' ),
             'type' => \Elementor\Controls_Manager::SWITCHER,
             'label_on' => esc_html__( 'Yes', 'digiqole' ),
             'label_off' => esc_html__( 'No', 'digiqole' ),
             'return_value' => 'yes',
             'default' => 'no'
             ]
      );
      $this->add_control(
         'digiqole_slider_autoplay',
             [
             'label' => esc_html__( 'Autoplay', 'digiqole' ),
             'type' => \Elementor\Controls_Manager::SWITCHER,
             'label_on' => esc_html__( 'Yes', 'digiqole' ),
             'label_off' => esc_html__( 'No', 'digiqole' ),
             'return_value' => 'yes',
             'default' => 'no'
             ]
         );
 
      
      $this->add_control(
          'digiqole_slider_dot_nav_show',
              [
              'label' => esc_html__( 'Dot nav', 'digiqole' ),
              'type' => \Elementor\Controls_Manager::SWITCHER,
              'label_on' => esc_html__( 'Yes', 'digiqole' ),
              'label_off' => esc_html__( 'No', 'digiqole' ),
              'return_value' => 'yes',
              'default' => 'yes'
              ]
      );

      $this->add_control(
          'digiqole_slider_nav_show',
              [
              'label' => esc_html__( 'Nav Show', 'digiqole' ),
              'type' => \Elementor\Controls_Manager::SWITCHER,
              'label_on' => esc_html__( 'Yes', 'digiqole' ),
              'label_off' => esc_html__( 'No', 'digiqole' ),
              'return_value' => 'yes',
              'default' => 'no'
              ]
      );
      $this->add_control(
         'post_count_slider',
         [
           'label'         => esc_html__( 'Slider Post count', 'digiqole' ),
           'type'          => Controls_Manager::NUMBER,
           'default'       => '5',

         ]
       );

        $this->add_control(
            'post_bg_color',
            [
                'label' => esc_html__('Grid background color', 'digiqole'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'condition' => [ 'grid_style' => ['style2'] ],
                'selectors' => [
                    '{{WRAPPER}} .ts-grid-box' => 'background-color: {{VALUE}};',
                ],
            ]
        );
    
          $this->add_control(
            'post_text_color',
            [
                'label' => esc_html__('Text color', 'digiqole'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'condition' => [ 'grid_style' => ['style2'] ],
                'selectors' => [
                    '{{WRAPPER}} .post-title a:hover, {{WRAPPER}} .post-date-info, {{WRAPPER}} .post-content p, {{WRAPPER}} .post-title a' => 'color: {{VALUE}};',
                ],
            ]
        );
    
       
     $this->add_group_control(
        Group_Control_Background::get_type(),
        [
            'name' => 'background',
            'label' => esc_html__( 'Background', 'digiqole' ),
            'types' => [ 'gradient' ],
            'selector' => '{{WRAPPER}} .gradient-overlay',
            'condition' => [ 'grid_style' => ['style4'] ]
            ]
    );

    $this->add_control(
      'post_title_crop',
      [
        'label'         => esc_html__( 'Post Title limit', 'digiqole' ),
        'type'          => Controls_Manager::NUMBER,
        'default' => '35',
       
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
          'post_count',
          [
            'label'         => esc_html__( 'Post count', 'digiqole' ),
            'type'          => Controls_Manager::NUMBER,
            'default'       => '3',

          ]
    );

    $this->add_responsive_control(
			'thumbnail_height',
			[
				'label' =>esc_html__( 'Thumbnail Height', 'digiqole' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'default' => [
					'unit' => 'px',
					'size' => 100,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 300,
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => 250,
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => 250,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .featured-post .item' => 'min-height: {{SIZE}}{{UNIT}};',
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
                'default' => 'no',
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
                  'condition' => [ 'grid_style' => ['style1', 'style4'] ]
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
             'default' => 'no',
             'condition' => [ 'grid_style' => ['style4', 'style1'] ]
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
         'last_week_top',
         [
             'label' => esc_html__('Week end top', 'digiqole'),
             'type' => Controls_Manager::SWITCHER,
             'label_on' => esc_html__('Yes', 'digiqole'),
             'label_off' => esc_html__('No', 'digiqole'),
             'default' => 'no',
             'condition' => [ 'post_sortby' => ['popularposts', 'mostdiscussed'] ]
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
              'label' => esc_html__('Title color', 'digiqole'),
              'type' => Controls_Manager::COLOR,
              'default' => '',
            
              'selectors' => [
                 '{{WRAPPER}} .ts-overlay-style.featured-post .post-content .post-title a' => 'color: {{VALUE}};',
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
                 '{{WRAPPER}} .ts-overlay-style.featured-post .post-content .post-title:hover a' => 'color: {{VALUE}};',
              ],
           ]
        );
  
        $this->add_group_control(
           Group_Control_Typography::get_type(),
           [
              'name' => 'post_title_typography',
              'label' => esc_html__( 'Typography', 'digiqole' ),
              'scheme' => Scheme_Typography::TYPOGRAPHY_1,
              'selector' => '{{WRAPPER}} .ts-overlay-style.featured-post .post-content .post-title',
           ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__( 'Title Margin', 'digiqole' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px','%'],
                'selectors' => [
                    '{{WRAPPER}} .ts-overlay-style.featured-post .post-content .post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->add_control(
           'block_meta_date_color',
           [
              'label' => esc_html__('Footer content color', 'digiqole'),
              'type' => Controls_Manager::COLOR,
              'default' => '',
            
              'selectors' => [
                 '{{WRAPPER}} .ts-overlay-style.featured-post .post-content .post-meta-info li a,{{WRAPPER}} .ts-overlay-style.featured-post .post-content .post-meta-info li ' => 'color: {{VALUE}};',
              ],
           ]
        );
  
        $this->end_controls_section();
        
        $this->start_controls_section('digiqole_block_dot_slider_section',
        [
           'label' => esc_html__( ' Block slider color', 'digiqole' ),
           'tab' => Controls_Manager::TAB_STYLE,
        ]

       );
  
       $this->add_control(
            'block_slider_dot_border_color',
            [
            'label' => esc_html__('Dot bg color', 'digiqole'),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            
            'selectors' => [
                '{{WRAPPER}} .weekend-top .owl-dot span' => 'background-color: {{VALUE}};',
            ],
            ]
        );
        $this->add_control(
            'slider_dot_border_active_color',
            [
            'label' => esc_html__('Dot border active color', 'digiqole'),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            
            'selectors' => [
                '{{WRAPPER}} .weekend-top .owl-dot.active span' => 'border-color: {{VALUE}} !important;',
                '{{WRAPPER}} .weekend-top .owl-dot.active span' => 'background-color: {{VALUE}} !important;',
            ],
            ]
        );
        $this->add_responsive_control(
			'slider_dot_position_x',
			[
				'label' =>esc_html__( 'Slider Dot Position X', 'digiqole' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 0,
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => 0,
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => 0,
					'unit' => 'px',
            ],
            'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .weekend-top .owl-dots' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
      );
        $this->add_responsive_control(
			'slider_dot_position_Y',
			[
				'label' =>esc_html__( 'Slider Dot Position Y', 'digiqole' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -500,
						'max' => 500,
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => -40,
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => -40,
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => -40,
					'unit' => 'px',
            ],
            'default' => [
					'unit' => 'px',
					'size' => -40,
				],
				'selectors' => [
					'{{WRAPPER}} .weekend-top .owl-dots' => 'top: {{SIZE}}{{UNIT}};',
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
        'content_padding',
        [
            'label' => esc_html__( 'Content padding', 'digiqole' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px','%'],
            'selectors' => [
                '{{WRAPPER}} .ts-overlay-style .post-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				],
			]
        );
        $this->end_controls_section();

    }

    protected function render( ) { 
        $settings = $this->get_settings();
        $post_gradient = $settings['post_gradient'];
     
        $slide_controls    = [
        
         'dot_nav_show'=>$settings['digiqole_slider_dot_nav_show'], 
         'nav_show'=>$settings['digiqole_slider_nav_show'], 
         'auto_nav_slide'=>$settings['digiqole_slider_autoplay'], 
         'item_count'=>$settings['post_count_slider'], 

       ];
   
     $slide_controls = \json_encode($slide_controls); 
        $arg = [
            'post_type'   =>  'post',
            'post_status' => 'publish',
            'order' => $settings['post_order'],
            'posts_per_page' => $settings['post_count'],
            'tag__in' => $settings['post_tags'],
            'suppress_filters' => false,
          
        ];

        if($settings['ts_offset_enable']=='yes'){
         $arg['offset'] = $settings['ts_offset_item_num'];
       }


        if($settings['post_cats'] !=''){

         $arg['tax_query'] = array(
                array(
                    'taxonomy' => 'category',
                    'terms'    => $settings['post_cats'],
                    'field' => 'id',
                    'include_children' => true,
                    'operator' => 'IN'
                ),
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

        if($settings['last_week_top']=='yes'):

            $arg['date_query'] = array(
                array(
                    'after' => '1 week ago'
                )
            );
               
        endif;

        $query = new \WP_Query( $arg ); ?>
        
        <?php if ( $query->have_posts() ) : ?>
              <div data-controls="<?php echo esc_attr($slide_controls); ?>" class="weekend-top owl-carousel owl-theme <?php echo esc_attr(($post_gradient=='yes') ? 'post-gradient': ''); ?>">
                  <?php while ($query->have_posts()) : $query->the_post(); ?>
                  
                        <?php switch($settings['grid_style']){  

                                case 'style1': ?>
                                    <?php require 'style/post-grid/content-style1.php'; ?>
                                <?php break; ?>
            
                                <?php } ?>
                        
                     <?php endwhile; ?>
               </div>

        <?php endif; ?>

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