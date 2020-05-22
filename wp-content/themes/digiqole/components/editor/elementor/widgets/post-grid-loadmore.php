<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Digiqole_Post_Grid_Loadmore_Widget extends Widget_Base {

  public $base;

    public function get_name() {
        return 'newszone-post-grid-loadmore';
    }

    public function get_title() {
        return esc_html__( 'Posts Grid Loadmore', 'digiqole' );
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
                'label' => esc_html__('Post loadmore', 'digiqole'),
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
                              'imagelarge' => DIGIQOLE_IMG . '/elementor/post-grid-loadmore/style1.png',
                              'imagesmall' => DIGIQOLE_IMG . '/elementor/post-grid-loadmore/style_min1.png',
                              'width' => '50%',
                     ],
                     'style2' => [
                        'title' => esc_html__( 'Style 2', 'digiqole' ),
                              'imagelarge' => DIGIQOLE_IMG . '/elementor/post-grid-loadmore/style2.png',
                              'imagesmall' => DIGIQOLE_IMG . '/elementor/post-grid-loadmore/style_min2.png',
                              'width' => '50%',
                     ],
                     'style3' => [
                        'title' => esc_html__( 'Style 3', 'digiqole' ),
                              'imagelarge' => DIGIQOLE_IMG . '/elementor/post-grid-loadmore/style3.png',
                              'imagesmall' => DIGIQOLE_IMG . '/elementor/post-grid-loadmore/style3.png',
                              'width' => '50%',
                     ],
					
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
      'show_loadmore',
       [
          'label' => esc_html__('Show loadmore', 'digiqole'),
          'type' => Controls_Manager::SWITCHER,
          'label_on' => esc_html__('Yes', 'digiqole'),
          'label_off' => esc_html__('No', 'digiqole'),
          'default' => 'yes',
         
       ]
      );
      $this->add_control(
        'show_rating',
           [
              'label' => esc_html__('Show rating', 'digiqole'),
              'type' => Controls_Manager::SWITCHER,
              'label_on' => esc_html__('Yes', 'digiqole'),
              'label_off' => esc_html__('No', 'digiqole'),
              'default' => 'no',
              
           ]
        );  
      $this->add_control(
        'show_desc',
           [
              'label' => esc_html__('Show desc', 'digiqole'),
              'type' => Controls_Manager::SWITCHER,
              'label_on' => esc_html__('Yes', 'digiqole'),
              'label_off' => esc_html__('No', 'digiqole'),
              'default' => 'no',
              
           ]
        );  
      
      $this->add_control(
         'desc_limit',
         [
           'label'         => esc_html__( 'Description limit', 'digiqole' ),
           'type'          => Controls_Manager::NUMBER,
           'default' => '35',
           'condition' => [ 'show_desc' => ['yes'] ],
         
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
               'condition' => [ 'grid_style' => ['style1'] ]
			]
      );
      $this->add_responsive_control(
			'grid_margin',
			[
				'label' =>esc_html__( 'margin', 'digiqole' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .grid-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            'show_gradient',
            [
                'label' => esc_html__('Show gradient color', 'digiqole'),
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
                 '{{WRAPPER}} .post-block-style .post-content .post-title a' => 'color: {{VALUE}};',
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
                 '{{WRAPPER}} .post-block-style .post-content .post-title a:hover' => 'color: {{VALUE}};',
              ],
           ]
        );
  
        $this->add_group_control(
           Group_Control_Typography::get_type(),
           [
              'name' => 'post_title_typography',
              'label' => esc_html__( 'Typography', 'digiqole' ),
              'scheme' => Scheme_Typography::TYPOGRAPHY_1,
              'selector' => '{{WRAPPER}} .ts-overlay-style.featured-post .post-content .post-title, {{WRAPPER}} .post-block-style .post-content .post-title',
           ]
        );
  
        
        $this->add_control(
           'block_meta_date_color',
           [
              'label' => esc_html__('Meta content color', 'digiqole'),
              'type' => Controls_Manager::COLOR,
              'default' => '',
            
              'selectors' => [
                 '{{WRAPPER}} .post-content .post-meta-info li a,{{WRAPPER}} .post-content .post-meta-info li ' => 'color: {{VALUE}};',
              ],
           ]
        );

        $this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Title margin', 'digiqole' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px','%'],
				'selectors' => [
					'{{WRAPPER}} .grid-loadmore-content .ts-overlay-style.featured-post .post-content .post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .post-block-style .post-content .post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .grid-loadmore-content .ts-overlay-style .post-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
        $show_gradient= $settings['show_gradient'];
        $show_author_avator = isset($settings['show_author_avator'])?
                              $settings['show_author_avator'] 
                                :'no'; 
        
        $arg = [
            'post_type'   =>  'post',
            'post_status' => 'publish',
            'order' => $settings['post_order'],
            'posts_per_page' => $settings['post_count'],
            'tag__in' => $settings['post_tags'],
            'suppress_filters' => false,
          
        ];

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
        
       
        $query = new \WP_Query( $arg );

        $ajax_json_data = [
         'order' => $settings['post_order'],
         'posts_per_page' => $settings['post_count'],
         'terms'          => $settings['post_cats'],
         'tags'           => $settings['post_tags'],
         'post_sortby'    => $settings['post_sortby'],
         'total_post'     => $query->found_posts,
         'grid_style'     => $settings['grid_style'],
         'show_view_count'    => $settings['show_view_count'],
         'show_cat'       => $settings['show_cat'],
         'show_author'    => $settings['show_author'],
         'show_date'      => $settings['show_date'],
         'desc_limit'     => $settings['desc_limit'],
         'post_title_crop'    => $settings['post_title_crop'],
         'show_gradient'      => $settings['show_gradient'],
         'show_author_avator' => $show_author_avator,
         
        ];
        
        $ajax_json_data = json_encode($ajax_json_data);
        $loadmore_class = 'post-grid-loadmore';
        
        ?>

        
        <?php if ( $query->have_posts() ) : ?>
            <div  class="grid-loadmore-content row">
               <?php while ($query->have_posts()) : $query->the_post(); ?>
                     
                    <?php switch($settings['grid_style']){  

                            case 'style1': ?>
                                <div class="col-md-6 grid-item <?php echo esc_attr(( $show_gradient =='yes' ) ? 'gradient-post': ''); ?>">
                                     <?php  require 'style/post-grid/content-style1.php'; ?>
                                </div>
                                <?php
                            break;
                              
                            case 'style2':
                                ?>
                                <div class="col-md-6 grid-item">
                                    <?php   require 'style/post-grid/content-style-2-a.php';  ?>
                                </div>
                                <?php
                            break;
                            case 'style3':
                                ?>
                                <div class="grid-item">
                                    <?php    require 'style/post-list/content-style4-a.php';  ?>
                                </div>
                                <?php
                            break;

                             ?>
                     
                    <?php } ?>

                   
                  <?php endwhile; ?>
               </div>   
               <?php if($settings['show_loadmore']=='yes'): ?> 
                  <?php  if (  $query->max_num_pages > 1 ) ?>

                     <div class="load-more-btn text-center">
                     <button class="digiqole-post-grid-loadmore" data-json_grid_meta="<?php echo esc_attr($ajax_json_data); ?>">
                        
                        <?php echo esc_html__('Load More','digiqole'); ?>
                     
                     </button>
                     </div>
                     
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