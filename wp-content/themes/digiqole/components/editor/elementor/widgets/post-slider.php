<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Digiqole_Post_Slider_Widget extends Widget_Base {

  public $base;

    public function get_name() {
        return 'newszone-post-slider';
    }

    public function get_title() {
        return esc_html__( 'Post Slider', 'digiqole' );
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
                        'imagelarge' => DIGIQOLE_IMG . '/elementor/slider/style2.png',
                        'imagesmall' => DIGIQOLE_IMG . '/elementor/slider/style2.png',
                        'width' => '50%',
               ],
               'style2' => [
                  'title' =>esc_html__( 'Style 2', 'digiqole' ),
                        'imagelarge' => DIGIQOLE_IMG . '/elementor/slider/style4.png',
                        'imagesmall' => DIGIQOLE_IMG . '/elementor/slider/style4.png',
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
            'default'       => 5,
          ]
        );

        $this->add_control(
         'post_show',
         [
           'label'         => esc_html__( 'Post show', 'digiqole' ),
           'type'          => Controls_Manager::NUMBER,
           'default'       => 5,
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
              'label' => esc_html__( 'Dot Nav', 'digiqole' ),
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
             'label' => esc_html__( 'Nav', 'digiqole' ),
             'type' => \Elementor\Controls_Manager::SWITCHER,
             'label_on' => esc_html__( 'Yes', 'digiqole' ),
             'label_off' => esc_html__( 'No', 'digiqole' ),
             'return_value' => 'yes',
             'default' => 'yes'
             ]
     );


      $this->add_control(
         'nav_top',
         [
             'label' => esc_html__('Nav top', 'digiqole'),
             'type' => Controls_Manager::SWITCHER,
             'label_on' => esc_html__('Yes', 'digiqole'),
             'label_off' => esc_html__('No', 'digiqole'),
             'default' => 'no',
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
             'condition' => [ 'block_style' => ['style2'] ]
            
         ]
         ); 
      $this->add_control(
         'post_content_crop',
         [
           'label'         => esc_html__( 'Post content crop', 'digiqole' ),
           'type'          => Controls_Manager::NUMBER,
           'default'       => '10',
           'condition' => [ 'block_style' => ['style2'] ]
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

        $this->add_responsive_control(
         'thumbnail_height',
         [
            'label' =>esc_html__( 'Thumbnail height', 'digiqole' ),
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
            'selectors' => [
               '{{WRAPPER}} .item' => 'min-height: {{SIZE}}{{UNIT}};',
            ],
         ]
       );
       $this->add_control(
         'post_margin',
         [
           'label'         => esc_html__( 'Post slider margin', 'digiqole' ),
           'type'          => Controls_Manager::NUMBER,
           'default'       => '10',
         ]
       );
       $this->add_control(
         'show_gradient',
            [
               'label' => esc_html__('Show gradient color', 'digiqole'),
               'type' => Controls_Manager::SWITCHER,
               'label_on' => esc_html__('Yes', 'digiqole'),
               'label_off' => esc_html__('No', 'digiqole'),
               'default' => 'no',
               'condition' => [ 'block_style' => ['style1'] ],
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
              'selector' => '{{WRAPPER}} .post-content .post-title',
           ]
        );
        $this->add_responsive_control(
			'title_margin',
			[
				'label' => __( 'Title Margin', 'digiqole' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px','%'],
				'selectors' => [
					'{{WRAPPER}} .post-slider .post-content .post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                 '{{WRAPPER}} .post-content .post-meta span,{{WRAPPER}} .post-content .post-meta span i,{{WRAPPER}} .post-content .post-meta span a' => 'color: {{VALUE}} !important;',
               
              ],
           ]
        );

        $this->add_responsive_control(
			'content_padding',
			[
				'label' => __( 'Content Padding', 'digiqole' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px','%'],
				'selectors' => [
					'{{WRAPPER}} .post-slider .ts-overlay-style .post-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

  
        $this->add_responsive_control(
            'nav_arrow_position',
            [
               'label' =>esc_html__( 'Nav arrow Vertical position', 'digiqole' ),
                   'type' => \Elementor\Controls_Manager::SLIDER,
               'range' => [
                  'px' => [
                     'min' => -200,
                     'max' => 200,
                  ],
               ],
               'devices' => [ 'desktop', 'tablet', 'mobile' ],
               'desktop_default' => [
                  'size' => -50,
                  'unit' => 'px',
               ],
               'tablet_default' => [
                  'size' => -50,
                  'unit' => 'px',
               ],
               'mobile_default' => [
                  'size' => -50,
                  'unit' => 'px',
               ],
               'selectors' => [
                  '{{WRAPPER}} .post-slider.style1 .owl-nav' => 'top: {{SIZE}}{{UNIT}};',
               ],
            ]
          );

        $this->add_responsive_control(
            'nav_arrow_h_position',
            [
               'label' =>esc_html__( 'Nav arrow Horizontal position', 'digiqole' ),
                   'type' => \Elementor\Controls_Manager::SLIDER,
               'range' => [
                  'px' => [
                     'min' => -200,
                     'max' => 200,
                  ],
               ],
               'devices' => [ 'desktop', 'tablet', 'mobile' ],
               'desktop_default' => [
                  'size' => 30,
                  'unit' => 'px',
               ],
               'tablet_default' => [
                  'size' => 30,
                  'unit' => 'px',
               ],
               'mobile_default' => [
                  'size' => 30,
                  'unit' => 'px',
               ],
               'selectors' => [
                  '{{WRAPPER}} .post-slider.style1 .owl-nav' => 'right: {{SIZE}}{{UNIT}};',
               ],
            ]
          );
          $this->add_control(
            'nav_arrow_hover_color',
            [
               'label' => esc_html__('Nav Arrow color', 'digiqole'),
               'type' => Controls_Manager::COLOR,
               'default' => '',
             
               'selectors' => [
                  '{{WRAPPER}} .post-slider.style1 .owl-prev' => 'background-color: {{VALUE}};',
                  '{{WRAPPER}} .post-slider.style1 .owl-next' => 'background-color: {{VALUE}};',
                  '{{WRAPPER}} .post-slider .owl-prev' => 'background-color: {{VALUE}};',
                  '{{WRAPPER}} .post-slider .owl-next' => 'background-color: {{VALUE}};',
               ],
            ]
         );
         $this->add_responsive_control(
            'border_radius',
            [
               'label' => __( 'post border radius', 'digiqole' ),
               'type' => Controls_Manager::DIMENSIONS,
                   'size_units' => [ 'px','%'],
               'selectors' => [
                  '{{WRAPPER}} .post-slider .ts-overlay-style .item, .ts-overlay-style.item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                  '{{WRAPPER}} .post-slider .post-block-style .post-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                  '{{WRAPPER}} .ts-overlay-style::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
               ],
            ]
           );
   

        $this->end_controls_section();
    }

    protected function render( ) { 
        $settings = $this->get_settings();
        $post_order         = $settings['post_order'];
        $show_gradient      = $settings['show_gradient'];
        $post_sortby        = $settings['post_sortby'];
        $show_cat           = $settings['show_cat'];
        $show_date          = $settings['show_date'];
        $post_format        = $settings['post_format'];
        $post_title_crop    = $settings['post_title_crop'];
        $show_author        = $settings['show_author']; 
        $post_content_crop  = $settings['post_content_crop'];
        $post_number        = $settings['post_count'];
        $nav_top            = $settings['nav_top']=='yes'?'style1':'';      
          
        $show_view_count    = $settings['show_view_count']; 
        $slide_controls    = [
        
         'dot_nav_show' => $settings['digiqole_slider_dot_nav_show'], 
         'nav_show' => $settings['digiqole_slider_nav_show'], 
         'auto_nav_slide' => $settings['digiqole_slider_autoplay'], 
         'item_count' => $settings['post_show'], 
         'margin' => $settings['post_margin'], 

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
         default:
             $arg['orderby'] = 'date';
         break;
     }
     $settings['ts_image_size'] = 'post-thumbnail';

        //$settings['show_author'] = 'no';
        $query = new \WP_Query( $arg ); ?>
        
         <?php if ( $query->have_posts() ) : ?>
               <?php if($settings['block_style']=="style1"): ?>  
                  <div data-controls="<?php echo esc_attr($slide_controls); ?>" class="post-slider <?php echo esc_attr($nav_top); ?> <?php echo esc_attr(( $show_gradient =='yes' ) ? 'post-gradient': ''); ?> owl-carousel ">
                        
                     <?php while ($query->have_posts()) : $query->the_post();?>
                         <?php  require 'style/post-grid/content-style2-lg.php'; ?>
                     <?php endwhile; ?>
                        
                  </div><!-- block-item6 -->
                  <?php wp_reset_postdata(); ?>
               <?php endif; ?>  

               <?php if($settings['block_style']=="style2"): ?>  
                  <div data-controls="<?php echo esc_attr($slide_controls); ?>" class="post-slider <?php echo esc_attr($nav_top); ?> owl-carousel ">
                        
                     <?php while ($query->have_posts()) : $query->the_post();?>
                        <?php  require DIGIQOLE_EDITOR_ELEMENTOR. '/widgets/style/post-grid/content-style-2-a.php'; ?>
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
            'suppress_filters' => false, 
      ) );

      $cat_list = [];
      foreach($terms as $post) {
      $cat_list[$post->term_id]  = [$post->name];
      }
      return $cat_list;
   }
}