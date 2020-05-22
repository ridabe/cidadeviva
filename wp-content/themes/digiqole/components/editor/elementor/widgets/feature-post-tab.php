<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Digiqole_Feature_Post_Tab_Widget extends Widget_Base {

  public $base;

    public function get_name() {
        return 'digiqole-feature-post-tab';
    }

    public function get_title() {
        return esc_html__( 'Feature Post Tab', 'digiqole' );
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
        $this->add_control(
          'content_crop',
          [
            'label'         => esc_html__( 'Desc limit', 'digiqole' ),
            'type'          => Controls_Manager::NUMBER,
            'default'       => '8',
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
				'selectors' => [
					'{{WRAPPER}} .digiqole-feature-post-tab .video-item.ts-overlay-style' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
       );

       $this->add_responsive_control(
			'video_list_height',
			[
				'label' =>esc_html__( 'Feature list height', 'digiqole' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'selectors' => [
					'{{WRAPPER}} .digiqole-feature-post-tab .video-tab-list.bg-dark-item' => 'height: {{SIZE}}{{UNIT}};',
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
                'label' => esc_html__('Show View Count', 'digiqole'),
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

     //Title Style Section
		$this->start_controls_section(
			'section_v_list_style', [
				'label'	 => esc_html__( 'Feature list', 'digiqole' ),
				'tab'	    => Controls_Manager::TAB_STYLE,
			]
        );
     
      
      $this->add_control(
			'title_color', [

				'label'		 => esc_html__( 'Title color', 'digiqole' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [

               '{{WRAPPER}} .post-tab-list .post-content .post-title' => 'color: {{VALUE}};',
				],
			]
      );
 
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'title', 'digiqole' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            
               'selector' => '{{WRAPPER}} .post-tab-list .post-content .post-title',
			]
        );
         
        $this->end_controls_section();

        //Video detail Section
		$this->start_controls_section(
			'section_video_d_style', [
				'label'	 => esc_html__( 'Feature post details', 'digiqole' ),
				'tab'	    => Controls_Manager::TAB_STYLE,
			]
        );
        
      $this->add_control(
			'video_title_color', [

				'label'		 => esc_html__( 'Title color', 'digiqole' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [

               '{{WRAPPER}} .video-item .post-content .post-title a' => 'color: {{VALUE}};',
				],
			]
      );

      $this->add_control(
			'video_title_hv_color', [

				'label'		 => esc_html__( 'Title hover color ', 'digiqole' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [

               '{{WRAPPER}} .video-item .post-content .post-title:hover a' => 'color: {{VALUE}};',
				],
			]
      );
      $this->add_control(
			'desc_color', [

				'label'		 => esc_html__( 'Desc color ', 'digiqole' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [

               '{{WRAPPER}} .video-item .post-content p' => 'color: {{VALUE}};',
				],
			]
      );

      $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'video_title_typography',
				'label' => esc_html__( 'title', 'digiqole' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            
               'selector' => '{{WRAPPER}} .video-item .post-content .post-title',
			]
      );
      $this->add_responsive_control(
			'title_margin',
			[
				'label' => __( 'Feature title margin', 'digiqole' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px','%'],
				'selectors' => [
					'{{WRAPPER}} .video-item .post-content .post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

      $this->add_control(
			'video_footer_color', [

				'label'		 => esc_html__( 'meta color', 'digiqole' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
               '{{WRAPPER}} .video-item .post-content .post-meta-info li,{{WRAPPER}} .video-item .post-content .post-meta-info li i, {{WRAPPER}} .video-item .post-content .post-meta-info li a' => 'color: {{VALUE}};',
				],
			]
      );
      $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'meta_typography',
				'label' => esc_html__( 'Meta Typography ', 'digiqole' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            
               'selector' => '{{WRAPPER}} .post-content .post-meta-info li',
			]
      );
      $this->add_responsive_control(
			'meta_margin',
			[
				'label' => __( 'Feature meta margin', 'digiqole' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px','%'],
				'selectors' => [
					'{{WRAPPER}} .ts-overlay-style .post-meta-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->end_controls_section();
    }

    protected function render( ) { 
        $settings = $this->get_settings();
        $thumb 					= [600, 398];
        $post_title_crop =   $settings['post_title_crop'];
        $content_crop =   $settings['content_crop'];

        $sticky = get_option( 'sticky_posts' );
        $arg = [
            'post_type'   =>  'post',
            'post_status' => 'publish',
            'order' => $settings['post_order'],
            'posts_per_page' => $settings['post_count'],
            'category__in' => $settings['post_cats'],
            'tag__in' => $settings['post_tags'],
            'post__in'  => $sticky,
            'suppress_filters' => false,
        ];

        if($settings['ts_offset_enable']=='yes') {

         $arg['offset'] = $settings['ts_offset_item_num'];
         
       }

        switch($settings['post_sortby']){
         case 'popularposts':
             $arg['meta_key'] = 'newszone_post_views_count';
             $arg['orderby']  = 'meta_value_num';
         break;
         case 'mostdiscussed':
             $arg['orderby'] = 'comment_count';
         break;
         default:
             $arg['orderby'] = 'date';
         break;
     }
        $query = new \WP_Query( $arg ); ?>
        
        <?php if ( $query->have_posts() ) : ?>
            
            <div class="digiqole-feature-post-tab" >
                    <div class="tab-content clearfix">
                        <?php $i = 0; while ($query->have_posts()) : $query->the_post(); $i++; ?>
                            <div class="tab-pane fade <?php echo esc_attr(($i == 1) ? 'in show active' : ''); ?>" id="video-tab-<?php echo esc_attr($this->get_id()); ?>-<?php echo esc_attr($i); ?>">
                                <div class="video-item ts-overlay-style" style="background-image:url(<?php echo esc_attr(esc_url(get_the_post_thumbnail_url(null, 'post-thumbnail'))); ?>)">
                       
                                    <div class="grid_container">
                                       <?php require 'style/post-list/content-style3-e.php'; ?>
                                    </div>

                                </div>
                            </div>
                        <?php endwhile; 
                        wp_reset_postdata();?>
                    </div>
                
                <div class="grid_container1">
                     <div class="feature-tab-inner">
                     <div class="video-tab-list bg-dark-item video-tab-scrollbar">
                        <ul class="nav nav-pills post-tab-list">
                        <?php $i = 0; while ($query->have_posts()) : $query->the_post(); $i++; ?>
                            <li data-index="<?php echo esc_attr($i); ?>" class="<?php echo esc_attr(($i == 1) ? 'active' : ''); ?>">
                                <a href="#video-tab-<?php echo esc_attr($this->get_id()); ?>-<?php echo esc_attr($i); ?>" data-toggle="tab">
                                    <div class="post-content media">
                                        <div class="side-img d-flex ">
                                           <img class="sidebar-img" src="<?php echo esc_url(digiqole_post_thumbnail(get_the_ID(),null,null, 'digiqole-small')); ?>" alt="<?php echo esc_attr(digiqole_alt(get_the_ID())); ?>">
                                        </div>
                                        <div class="media-body align-self-center">
                                        <?php $cat = get_the_category(); ?> 
                                                <span class="post-cat only-color" >
                                                   <?php echo get_cat_name($cat[0]->term_id); ?>
                                                </span>
                                            <h4 class="post-title">
                                               <?php echo wp_trim_words(get_the_title(),$post_title_crop,''); ?>
                                            </h4>
                                            <ul class="post-meta-info">
                                                   <li class="post-date">
                                                      <i class="fa fa-clock-o"></i>
                                                      <?php echo get_the_date(get_option('date_format')); ?>
                                                   </li> 
                                             </ul> 
                                        </div>
                                    </div>
                                </a>
                            </li>
                        <?php endwhile; ?>
                        </ul>
                    </div>
                     </div>
                </div>
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