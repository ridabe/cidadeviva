<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Digiqole_Main_Slider_Widget extends Widget_Base {

  public $base;

    public function get_name() {
        return 'newszone-main-slider';
    }

    public function get_title() {
        return esc_html__( 'Post Main Slider', 'digiqole' );
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
                        'imagelarge' => DIGIQOLE_IMG . '/elementor/slider/style1.png',
                        'imagesmall' => DIGIQOLE_IMG . '/elementor/slider/style1.png',
                        'width' => '50%',
               ],
               'style2' => [
                  'title' =>esc_html__( 'Style 2', 'digiqole' ),
                        'imagelarge' => DIGIQOLE_IMG . '/elementor/slider/style3.png',
                        'imagesmall' => DIGIQOLE_IMG . '/elementor/slider/style3.png',
                        'width' => '50%',
               ],

               'style3' => [
                  'title' =>esc_html__( 'Style 3', 'digiqole' ),
                        'imagelarge' => DIGIQOLE_IMG . '/elementor/slider/slider-style4.png',
                        'imagesmall' => DIGIQOLE_IMG . '/elementor/slider/slider-style4.png',
                        'width' => '50%',
               ],
               'style4' => [
                  'title' =>esc_html__( 'Style 4', 'digiqole' ),
                  'imagelarge' => DIGIQOLE_IMG . '/elementor/slider/slider-style5.png',
                  'imagesmall' => DIGIQOLE_IMG . '/elementor/slider/slider-style5.png',
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
            'default'       => '1',
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
              'label' => esc_html__( 'Nav Show', 'digiqole' ),
              'type' => \Elementor\Controls_Manager::SWITCHER,
              'label_on' => esc_html__( 'Yes', 'digiqole' ),
              'label_off' => esc_html__( 'No', 'digiqole' ),
              'return_value' => 'yes',
              'default' => 'yes'
              ]
      );
      $this->add_control(
          'digiqole_slider_dot_show',
              [
              'label' => esc_html__( 'Dot Show', 'digiqole' ),
              'type' => \Elementor\Controls_Manager::SWITCHER,
              'label_on' => esc_html__( 'Yes', 'digiqole' ),
              'label_off' => esc_html__( 'No', 'digiqole' ),
              'return_value' => 'yes',
              'default' => 'yes'
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
         'show_desc',
         [
             'label' => esc_html__('Show post description', 'digiqole'),
             'type' => Controls_Manager::SWITCHER,
             'label_on' => esc_html__('Yes', 'digiqole'),
             'label_off' => esc_html__('No', 'digiqole'),
             'default' => 'yes',
            
         ]
         ); 
        $this->add_control(
         'post_content_crop',
         [
           'label'         => esc_html__( 'Post content crop', 'digiqole' ),
           'type'          => Controls_Manager::NUMBER,
           'default'       => '10',
           'condition' => [ 'show_desc' => ['yes'] ]
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
        'post_meta_style',
        [
            'label' => esc_html__( 'Post Meta title up/down', 'digiqole' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'meta_title_after',
            'options' => [
                'meta_title_before'  => esc_html__( 'Meta title before', 'digiqole' ),
                'meta_title_after' => esc_html__( 'Meta title after', 'digiqole' ),
        ],
        'condition' => [ 'block_style' => ['style2'] ]
        ]
    );

     $this->add_control(
      'post_readmore',
      [
         'label' => esc_html__('Read more', 'digiqole'),
         'type' => Controls_Manager::TEXT,
         'default' => esc_html__( 'read more', 'digiqole' ),
      
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
            'post_sortby',
            [
                'label'     =>esc_html__( 'Post sort by', 'digiqole' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'latestpost',
                'options'   => [
                        'latestpost'      =>esc_html__( 'Latest posts', 'digiqole' ),
                        'popularposts'    =>esc_html__( 'Popular posts', 'digiqole' ),
                        'mostdiscussed'    =>esc_html__( 'Most discussed', 'digiqole' ),
                        'featuredposts'    =>esc_html__( 'Featured posts', 'digiqole' ),
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
					'{{WRAPPER}} .main-slider .ts-overlay-style .item' => 'min-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .digiqole-main-slider .post-slide-item' => 'min-height: {{SIZE}}{{UNIT}};',
				],
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
           'content_box_bg_color',
           [
              'label' => esc_html__('Content Box BG color', 'digiqole'),
              'type' => Controls_Manager::COLOR,
              'default' => '',
            'condition' => ['block_style' => 'style1'],
              'selectors' => [
                 '{{WRAPPER}} .digiqole-main-slider .post-content' => 'background: {{VALUE}};',
              ],
           ]
        );
       $this->add_control(
           'block_title_color',
           [
              'label' => esc_html__('Title color', 'digiqole'),
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
  
        $this->add_group_control(
           Group_Control_Typography::get_type(),
           [
              'name' => 'post_title_typography',
              'label' => esc_html__( 'Typography', 'digiqole' ),
              'scheme' => Scheme_Typography::TYPOGRAPHY_1,
              'selector' => '{{WRAPPER}} .main-slider .post-content .post-title,{{WRAPPER}} .main-slide.style4 .digiqole-main-slider .post-content .post-title',
           ]
        );

        $this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Title margin', 'digiqole' ),
				'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px','%'],
				'selectors' => [
					'{{WRAPPER}} .main-slider .post-content .post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .main-slide.style4 .post-content .post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );
  
        
        $this->add_control(
           'desc_color',
           [
              'label' => esc_html__('Description color', 'digiqole'),
              'type' => Controls_Manager::COLOR,
              'default' => '',
              'condition' => [ 'show_desc' => ['yes'] ],
              'selectors' => [
                 '{{WRAPPER}} .main-slider .post-content p' => 'color: {{VALUE}};',
                 '{{WRAPPER}} .main-slide .post-content p' => 'color: {{VALUE}};',
               
              ],
           ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
               'name' => 'post_meta_typography',
               'label' => esc_html__( 'Meta Typography', 'digiqole' ),
               'scheme' => Scheme_Typography::TYPOGRAPHY_1,
               'selector' => '{{WRAPPER}} .main-slider .post-meta-info li,{{WRAPPER}} .main-slide .post-meta-info li',
               
            ]
         );

        $this->add_control(
           'block_meta_date_color',
           [
              'label' => esc_html__('meta color', 'digiqole'),
              'type' => Controls_Manager::COLOR,
              'default' => '',
            
              'selectors' => [
                 '{{WRAPPER}} .post-content .post-meta-info li' => 'color: {{VALUE}};',
                 '{{WRAPPER}} .post-content .post-meta-info li a' => 'color: {{VALUE}};',
                 '{{WRAPPER}} .ts-overlay-style .post-meta-info li.active i' => 'color: {{VALUE}};',
               
              ],
           ]
        );
        $this->add_control(
           'nav_arrow_prev_color',
           [
              'label' => esc_html__('Nav prev color', 'digiqole'),
              'type' => Controls_Manager::COLOR,
              'default' => '',
            
              'selectors' => [
                 '{{WRAPPER}} .main-slider .owl-prev' => 'background-color: {{VALUE}};',
               
              ],
           ]
        );
        $this->add_control(
           'nav_arrow_next_color',
           [
              'label' => esc_html__('Nav next color', 'digiqole'),
              'type' => Controls_Manager::COLOR,
              'default' => '',
            
              'selectors' => [
                 '{{WRAPPER}} .main-slider .owl-next' => 'background-color: {{VALUE}};',
               
              ],
           ]
        );

        $this->add_control(
            'slider_dot_color',
            [
               'label' => esc_html__('dot color', 'digiqole'),
               'type' => Controls_Manager::COLOR,
               'default' => '',
             
               'selectors' => [
                  '{{WRAPPER}} .main-slider .owl-dots .owl-dot span' => 'background-color: {{VALUE}};',
                
               ],
            ]
         );
        $this->add_control(
            'slider_dot_active_color',
            [
               'label' => esc_html__('dot Active color', 'digiqole'),
               'type' => Controls_Manager::COLOR,
               'default' => '',
             
               'selectors' => [
                  '{{WRAPPER}} .main-slider .owl-dots .owl-dot.active span' => 'background-color: {{VALUE}};',
                
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
					'size' => 50,
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => 50,
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => 50,
					'unit' => 'px',
            ],
            'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .main-slider .owl-dots' => 'left: {{SIZE}}{{UNIT}};',
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
						'min' => 0,
						'max' => 1000,
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 50,
					'unit' => '%',
				],
				'tablet_default' => [
					'size' => 50,
					'unit' => '%',
				],
				'mobile_default' => [
					'size' => 50,
					'unit' => '%',
            ],
            'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .main-slider .owl-dots' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
      );


        $this->add_responsive_control(
			'content_padding',
			[
				'label' => esc_html__( 'Content padding', 'digiqole' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px','%'],
				'selectors' => [
					'{{WRAPPER}} .main-slider .post-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .main-slide .post-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
			'desc_padding',
			[
				'label' => esc_html__( 'Description padding', 'digiqole' ),
				'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px','%'],
				'selectors' => [
					'{{WRAPPER}} .digiqole-main-slider .post-content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );
  
        $this->end_controls_section();

        $this->start_controls_section('digiqole_style_advance_section',
        [
           'label' => esc_html__( ' Advance', 'digiqole' ),
           'tab' => Controls_Manager::TAB_STYLE,
           'condition' => ['block_style' => 'style2']
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

        $settings           = $this->get_settings();
        $post_order         = $settings['post_order'];
        $post_sortby        = $settings['post_sortby'];
        $show_cat           = $settings['show_cat'];
        $show_date          = $settings['show_date'];
        $post_format        = $settings['post_format'];
        $post_title_crop    = $settings['post_title_crop'];
        $show_author        =  $settings['show_author']; 
        $post_content_crop  = $settings['post_content_crop'];
        $post_number        = $settings['post_count'];
        $readmore           = $settings['post_readmore'];      
        $post_meta_style    = $settings['post_meta_style'];      
          
        $show_view_count    = $settings['show_view_count']; 
        $slide_controls    = [
        
         'dot_nav_show'=>$settings['digiqole_slider_dot_nav_show'], 
         'slider_dot_show'=>$settings['digiqole_slider_dot_show'], 
         'auto_nav_slide'=>$settings['digiqole_slider_autoplay'], 
         'item_count'=>$settings['post_count'], 

       ];
   
     $slide_controls = \json_encode($slide_controls);      
        
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
         case 'featuredposts':
            $category          = get_category( get_query_var( 'cat' ) );
            $feature_post_show = digiqole_term_option($category->cat_ID,'block_featured_post', []); 
            if($feature_post_show == 'yes'){
               $arg = array(
                  'cat' => $category->term_id,
                  'posts_per_page' => $settings['post_count'],
                  'orderby'     =>  'date',
                  'order' => 'DESC', 
                  'suppress_filters' => true,
                  'meta_query' => array(
                     array(
                        'key' => 'digiqole_featured_post',
                        'value' => 'yes', 
                        
                     ),
                  ) ,
               );

            }else {
               break;
            }
        break;
         default:
             $arg['orderby'] = 'date';
         break;
     }


        //$settings['show_author'] = 'no';
        $query = new \WP_Query( $arg ); ?>
        
         <?php if ( $query->have_posts() ) : ?>
               <?php if($settings['block_style']=="style1"): ?>  
                  <div data-controls="<?php echo esc_attr($slide_controls); ?>" class="main-slider owl-carousel">
                     <?php while ($query->have_posts()) : $query->the_post();?>
                         <?php  require 'style/post-grid/slider-style1.php'; ?>
                     <?php endwhile; ?>
                  </div><!-- block-item6 -->
                  <?php wp_reset_postdata(); ?>
               <?php endif; ?>
               <?php if($settings['block_style']=="style2"): ?>  
                  <div data-controls="<?php echo esc_attr($slide_controls); ?>" class="main-slider owl-carousel">
                     <?php while ($query->have_posts()) : $query->the_post();?>
                        <?php  require 'style/post-grid/slider-style3.php'; ?>
                     <?php endwhile; ?>
                  </div><!-- block-item6 -->
                  <?php wp_reset_postdata(); ?>
               <?php endif; ?>  
               <?php if($settings['block_style']=="style3"): ?>  
                  <div data-controls="<?php echo esc_attr($slide_controls); ?>" class="main-slider style3 owl-carousel">
                     <?php while ($query->have_posts()) : $query->the_post();?>

                        <?php  require 'style/post-grid/slider-style4.php'; ?>
                   
                     <?php endwhile; ?>
                  </div><!-- block-item6 -->
                  <?php wp_reset_postdata(); ?>
               <?php endif; ?>  

               <?php if($settings['block_style']=="style4"): ?>  
                  <div data-controls="<?php echo esc_attr($slide_controls); ?>" class="main-slide style4 owl-carousel">
                     <?php while ($query->have_posts()) : $query->the_post();?>

                        <?php  require 'style/post-grid/slider-style4.php'; ?>
                   
                     <?php endwhile; ?>
                  </div><!-- block-item6 -->
                  <?php wp_reset_postdata(); ?>
               <?php endif; ?>  

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