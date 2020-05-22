<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Digiqole_Video_Post_Slider2_Widget extends Widget_Base {

  public $base;

    public function get_name() {
        return 'newszone-video-post-slider2';
    }

    public function get_title() {
        return esc_html__( 'Video Post Slider2', 'digiqole' );
    }

    public function get_icon() { 
        return 'eicon-thumbnails-right';
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
          'post_count',
          [
            'label'         => esc_html__( 'Post count', 'digiqole' ),
            'type'          => Controls_Manager::NUMBER,
            'default'       => '8',
          ]
        );
        $this->add_control(
          'post_title_crop',
          [
            'label'         => esc_html__( 'Post title crop', 'digiqole' ),
            'type'          => Controls_Manager::NUMBER,
            'default'       => '8',
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
					'{{WRAPPER}} .video-item.ts-overlay-style' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
              
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

        $this->end_controls_section();

      //   tab style

        $this->start_controls_section('digiqole_block_feature_section',
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
            'selectors' => [
            
               '{{WRAPPER}} .video-sync-slider .ts-overlay-style .post-title a' => 'color: {{VALUE}};',
            ],
         ]
      );

      $this->add_control(
         'feature_title_hv_color',
         [
            'label' => esc_html__('Feature Title hover', 'digiqole'),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
            
               '{{WRAPPER}} .video-sync-slider .ts-overlay-style .post-title a' => 'color: {{VALUE}};',
            ],
         ]
      );

      $this->add_group_control(
         Group_Control_Typography::get_type(),
         [
            'name' => 'feature_post_title_typography',
            'label' => __( 'Typography feature title ', 'digiqole' ),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
               'selector' => '{{WRAPPER}} .video-sync-slider .ts-overlay-style .post-title',
         ]
         );

         $this->add_responsive_control(
         'title_margin',
         [
            'label' => __( 'Title margin Padding', 'digiqole' ),
            'type' => Controls_Manager::DIMENSIONS,
                  'size_units' => [ 'px','%'],
            'selectors' => [
               '{{WRAPPER}} .video-sync-slider .ts-overlay-style .post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
         ]
         );

         $this->add_control(
         'feature_block_meta_date_color',
         [
            'label' => esc_html__('Meta color', 'digiqole'),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
               '{{WRAPPER}} .video-sync-slider .ts-overlay-style .post-meta-info li' => 'color: {{VALUE}};',
               '{{WRAPPER}} .video-sync-slider .ts-overlay-style .post-meta-info li a' => 'color: {{VALUE}};',
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
               '{{WRAPPER}} .video-sync-slider .ts-overlay-style .post-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
         ]
         );
      $this->end_controls_section();

      $this->start_controls_section('digiqole_block_post_section',
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
                  '{{WRAPPER}} .video-sync-slider2 .post-content .post-title' => 'color: {{VALUE}};',
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
                  '{{WRAPPER}} .video-sync-slider2 .post-content .post-title:hover' => 'color: {{VALUE}};',
               ],
            ]
         );

         $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
               'name' => 'post_title_typography',
               'label' => __( 'Typography title ', 'digiqole' ),
               'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                  'selector' => '{{WRAPPER}} .video-sync-slider2 .post-content .post-title',
            ]
            );
      

     $this->end_controls_section();


    }

    protected function render( ) { 
        $settings = $this->get_settings();
        $post_title_crop = $settings['post_title_crop'];
        $thumb 					= [600, 398];
        $arg = [
            'post_type'   =>  'post',
            'post_status' => 'publish',
            'order'       => $settings['post_order'],
            'posts_per_page' => $settings['post_count'],
            'category__in' => $settings['post_cats'],
            'tag__in' => $settings['post_tags'],
            'suppress_filters' => false,
            'tax_query' => [
                [
                    'taxonomy' => 'post_format',
                    'field' => 'slug',
                    'terms' => 'post-format-video'
                ]
            ]
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
        $settings['show_author'] = 'no';
        $query = new \WP_Query( $arg ); ?>
        
        <?php if ( $query->have_posts() ) : ?>

            <div id="video-sync-slider1" class="video-sync-slider owl-carousel owl-theme">
               <?php  while ($query->have_posts()) : $query->the_post();?>
                     <div class="item">
                        <div class="video-item item ts-overlay-style" style="background-image:url(<?php echo esc_attr(esc_url(get_the_post_thumbnail_url(null, 'post-thumbnail'))); ?>)">
                           <?php require 'style/post-list/content-style3-d.php'; ?>
                        </div>
                     </div>
               <?php endwhile; 
                  wp_reset_postdata();?>
            </div>

            <div id="video-sync-slider2" class="video-sync-slider2 owl-carousel owl-theme">
            <?php  while ($query->have_posts()) : $query->the_post();?>
                  <div class="item">
                     <div class="post-thumb">
                        <?php the_post_thumbnail('digiqole-small'); ?>
                     </div>
                     <div class="post-content media">
                        <span class="ts-play-btn d-flex align-self-center">
                              <i class="fa fa-play" aria-hidden="true"></i>
                        </span>
                        <h4 class="post-title media-body ">
                            <?php echo esc_html(wp_trim_words( get_the_title() ,$post_title_crop,'') );  ?>
                        </h4>
                     </div>
                  </div>
               <?php endwhile; 
               wp_reset_postdata();?>
                  
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
            'suppress_filters' => false,
      ) );

      $cat_list = [];
      foreach($terms as $post) {
      $cat_list[$post->term_id]  = [$post->name];
      }
      return $cat_list;
   }
}