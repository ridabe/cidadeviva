<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Digiqole_post_tab_widget extends Widget_Base {

	public function get_name() {
		return 'newszone-post-tab';
	}

	public function get_title() {
		return __( 'Post tab', 'digiqole' );
	}

	public function get_icon() {
		return 'eicon-gallery-group';
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
      'block_title_show',
      [
            'label' => esc_html__('Show block title', 'digiqole'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'digiqole'),
            'label_off' => esc_html__('No', 'digiqole'),
            'default' => 'yes',
      ]
   );



   $this->add_control(
      'title_style',
      [
            'label'     =>esc_html__( 'Block title markup', 'digiqole' ),
            'type'      => Controls_Manager::SELECT,
            'default'   => 'style1',
            'options'   => [
                  'style1'      =>esc_html__( 'Style 1', 'digiqole' ),
                  'style2'      =>esc_html__( 'Style 2', 'digiqole' ),
               ],
            'condition' => [ 'block_title_show' => ['yes'] ]
      ]
   );

   $this->add_control(
      'block_title_markup',
      [
            'label'     =>esc_html__( 'Block title markup', 'digiqole' ),
            'type'      => Controls_Manager::SELECT,
            'default'   => 'h2',
            'options'   => [
                  'h1'      =>esc_html__( 'H1', 'digiqole' ),
                  'h2'      =>esc_html__( 'H2', 'digiqole' ),
                  'h3'      =>esc_html__( 'H3', 'digiqole' ),
                  'h4'      =>esc_html__( 'H4', 'digiqole' ),
                  'h5'      =>esc_html__( 'H5', 'digiqole' ),
               ],
            'condition' => [ 'block_title_show' => ['yes'] ]
      ]
   );

   $this->add_control(
      'block_title_text',
      [
            'label' => esc_html__('Block title', 'digiqole'),
            'type' => Controls_Manager::TEXT,
            'default' => esc_html__( 'Post Slider', 'digiqole' ),
            'condition' => [ 'block_title_show' => ['yes'] ]
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
         'label'         => esc_html__( 'Feature Post title crop', 'digiqole' ),
         'type'          => Controls_Manager::NUMBER,
         'default'       => '50',
       ]
   );

   $this->add_control(
       'sm_title_crop',
       [
         'label'         => esc_html__( 'Small Post title crop', 'digiqole' ),
         'type'          => Controls_Manager::NUMBER,
         'default'       => '50',
       ]
   );

   $this->add_control(
      'post_content_crop',
      [
        'label'         => esc_html__( 'Post content crop', 'digiqole' ),
        'type'          => Controls_Manager::NUMBER,
        'default'       => '10',
      ]
   );

   $this->add_control(
            'post_format',
            [
               'label' =>esc_html__('Select Post Format', 'digiqole'),
               'type'      => Custom_Controls_Manager::SELECT2,
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
         'tabs',
         [
             'label' => esc_html__('Tabs', 'digiqole'),
             'type' => Controls_Manager::REPEATER,
             'default' => [
                 [
                     'tab_title' => esc_html__('Add Label', 'digiqole'),
                     'post_cats' => 1,
                 ],
             ],
             'fields' => [
                 [   'name' => 'post_cats',
                     'label' =>esc_html__('Select Categories', 'digiqole'),
                     'type'      => Controls_Manager::SELECT2,
                     'options'   => $this->post_category(),
                     'label_block' => true,
                     'multiple'  => true,
                 ],
                 [ 
                  'name' => 'post_tags',
                  'label' =>esc_html__('Select tags', 'digiqole'),
                  'type'      => Controls_Manager::SELECT2,
                  'options'   => digiqole_post_tags(),
                  'label_block' => true,
                  'multiple'  => true,
                 ],
                 [   'name' => 'tab_title',
                     'label'         => esc_html__( 'Tab title', 'digiqole' ),
                     'type'          => Controls_Manager::TEXT,
                     'default'       => 'Add Label',
               ],
               [   
                  'name' => 'ts_offset_enable',
                  'label'         => esc_html__( 'Post Skip', 'digiqole' ),
                  'type' => Controls_Manager::SWITCHER,
                  'label_on' => esc_html__('Yes', 'digiqole'),
                  'label_off' => esc_html__('No', 'digiqole'),
               ],
               [  
                   'name' => 'ts_offset_item_num',
                   'label'         => esc_html__( 'Skip post count', 'digiqole' ),
                   'type'          => Controls_Manager::NUMBER,
                   'default'       => '1',
                   'condition' => [ 'ts_offset_enable' => 'yes' ]
               ],
             ],
         ]
     );

     $this->end_controls_section();

     $this->start_controls_section('digiqole_style_block_section',
      [
         'label' => esc_html__( 'Block Title', 'digiqole' ),
         'tab' => Controls_Manager::TAB_STYLE,
      ]
     );

     $this->add_control(
      'block_title_color',
      [
         'label' => esc_html__('Block title color', 'digiqole'),
         'type' => Controls_Manager::COLOR,
         'default' => '',
         'condition' => [ 'block_title_show' => ['yes'] ],
         'selectors' => [
            '{{WRAPPER}} .featured-tab .block-title' => 'color: {{VALUE}};',
            '{{WRAPPER}} .heading-style3 .block-title' => 'color: {{VALUE}};',
            '{{WRAPPER}} .heading-style3 .block-title .title-angle-shap:before, .heading-style3 .block-title .title-angle-shap:after' => 'background-color: {{VALUE}};',
         ],
      ]
   );

   $this->add_control(
      'block_title_background',
      [
         'label' => esc_html__('Title seperator background', 'digiqole'),
         'type' => Controls_Manager::COLOR,
         'default' => '',
         'condition' => [ 'block_title_show' => ['yes'] ],
         'selectors' => [

            '{{WRAPPER}} .featured-tab .block-title > span.title-bg,{{WRAPPER}} .featured-tab .block-title > span.title-bg:before ' => 'background-color: {{VALUE}};',

            '{{WRAPPER}} .featured-tab .block-title > span.title-bg:after' => 'border-left-color: {{VALUE}};',
        
           
         ],
      ]
   );
   $this->add_control(
      'block_title_border',
      [
         'label' => esc_html__('Title border color', 'digiqole'),
         'type' => Controls_Manager::COLOR,
         'default' => '',
         'condition' => [ 'block_title_show' => ['yes'] ],
         'selectors' => [
            
            '{{WRAPPER}} .featured-tab .block-title.title-border' => 'border-bottom: 2px solid {{VALUE}};',
        
           
         ],
      ]
   );

   $this->add_group_control(
         Group_Control_Typography::get_type(),
         [
            'name' => 'block',
            'label' => __( 'Typography', 'digiqole' ),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .featured-tab .block-title span.title-bg',
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

  

     $this->start_controls_section('tab_menu_section',
      [
         'label' => esc_html__( 'Tab Menu', 'digiqole' ),
         'tab' => Controls_Manager::TAB_STYLE,
      ]
     );
     $this->add_control(
      'tab_menu_color',
      [
         'label' => esc_html__('Tab menu color', 'digiqole'),
         'type' => Controls_Manager::COLOR,
         'default' => '',
         'selectors' => [
            '{{WRAPPER}} .featured-tab-item .nav-tabs .nav-link .tab-head > span.tab-text-title' => 'color: {{VALUE}};',
         ],
      ]
     ); 
     $this->add_control(
      'tab_menu_active_color',
      [
         'label' => esc_html__('Tab menu active color', 'digiqole'),
         'type' => Controls_Manager::COLOR,
         'default' => '',
         'selectors' => [
            '{{WRAPPER}} .featured-tab-item .nav-tabs .nav-link.active .tab-head > span.tab-text-title' => 'color: {{VALUE}};',
            '{{WRAPPER}} .featured-tab-item .nav-tabs .nav-link.active:before' => 'background-color: {{VALUE}};',
         ],
      ]
     ); 

     
     $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
         'name' => 'post_tab_menu_typography',
         'label' => __( 'Tab Menu Typography', 'digiqole' ),
         'scheme' => Scheme_Typography::TYPOGRAPHY_1,
         'selector' => '{{WRAPPER}} .featured-tab-item .nav-tabs .nav-link .tab-head > span.tab-text-title',
      ]
   );

     $this->end_controls_section();


     $this->start_controls_section('digiqole_style_section',
      [
         'label' => esc_html__( 'Post Title', 'digiqole' ),
         'tab' => Controls_Manager::TAB_STYLE,
      ]
     );

     $this->add_control(
      'post_title_color',
      [
         'label' => esc_html__('Post  color', 'digiqole'),
         'type' => Controls_Manager::COLOR,
         'default' => '',
         'selectors' => [
            '{{WRAPPER}} .featured-tab .post-content .post-title a' => 'color: {{VALUE}};',
         ],
      ]
     ); 
     $this->add_control(
      'post_title_color_hv',
      [
         'label' => esc_html__('Post hover', 'digiqole'),
         'type' => Controls_Manager::COLOR,
         'default' => '',
         'selectors' => [
            '{{WRAPPER}} .featured-tab .post-content .post-title:hover a' => 'color: {{VALUE}};',
         ],
      ]
      );

      $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'post_title_typography',
				'label' => __( 'Feature Title Typography', 'digiqole' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .featured-tab .post-content .post-title',
			]
		);
      $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sm_post_title_typography',
				'label' => __( 'Small Title Typography', 'digiqole' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .post-block-list .post-block-style .post-title.title-small',
			]
		);
     $this->end_controls_section();

     $this->start_controls_section('digiqole_style_pcontent_section',
     [
        'label' => esc_html__( 'Post content', 'digiqole' ),
        'tab' => Controls_Manager::TAB_STYLE,
     ]
    );

    $this->add_control(
      'post_meta_color',
      [
         'label' => esc_html__('Author and date color', 'digiqole'),
         'type' => Controls_Manager::COLOR,
         'default' => '',
         'selectors' => [
            '{{WRAPPER}} .featured-tab .post-content .post-meta .post-author a , .featured-tab .post-content .post-meta .post-date' => 'color: {{VALUE}};',
         ],
      ]
      ); 
    $this->add_control(
     'post_content_color',
     [
        'label' => esc_html__('Color', 'digiqole'),
        'type' => Controls_Manager::COLOR,
        'default' => '',
        'selectors' => [
           '{{WRAPPER}} .featured-tab .post-content  p' => 'color: {{VALUE}};',
        ],
     ]
     ); 
     $this->add_control(
      'content_lebel',
      [
         'label' => __( 'Content ', 'digiqole' ),
         'type' => \Elementor\Controls_Manager::HEADING,
         'separator' => 'after',
      ]
     );
     $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
           'name' => 'post_content_typography',
           'label' => __( 'Typography', 'digiqole' ),
           'scheme' => Scheme_Typography::TYPOGRAPHY_1,
           'selector' => '{{WRAPPER}} .featured-tab .post-content p',
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
        'label' => __( 'Border Radius', 'digiqole' ),
        'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px','%'],
        'selectors' => [
           '{{WRAPPER}} .post-block-style .post-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
      $sm_title_crop      = $settings['sm_title_crop'];
      $post_content_crop  = $settings['post_content_crop'];
      $post_number        = $settings['post_count'];

      $title_style        = $settings['title_style'];
      $block_title_show   = $settings['block_title_show'];
      $block_title_text   = $settings['block_title_text'];
      $block_title_markup = $settings['block_title_markup'];

      $show_author        = $settings['show_author'];     
      $tabs               = $settings['tabs'];
      $post_count         = count($tabs);
      $show_author_avator = isset($settings['show_author_avator'])?
      $settings['show_author_avator'] 
      :'no';
    
	?>

    
      <div class="featured-tab-item">
            <div class="post-block-element featured-tab">
                  <?php if($block_title_show=="yes"): ?>
                     <?php if( $title_style == 'style1'): ?>
                        <<?php echo esc_attr($block_title_markup); ?> class="block-title title-border">
                              <span class="title-bg">
                                  <?php echo esc_html($block_title_text); ?>
                              </span>   
                        </<?php echo esc_attr($block_title_markup); ?>>
                     <?php endif; ?>
                     <?php if( $title_style == 'style2'): ?>
                        <div class="section-heading heading-style3">
                           <<?php echo esc_attr($block_title_markup); ?> class="block-title">
                              <span class="title-angle-shap">
                                 <?php echo esc_html($block_title_text); ?>
                              </span>
                           </<?php echo esc_attr($block_title_markup); ?>>
                        </div>
                     <?php endif; ?>
                     
                  <?php endif; ?>
                    <ul class="nav nav-tabs" role="tablist">
                        <?php
                              foreach ( $tabs as $tab_key=>$value ) {
                                       
                                    if( $tab_key == 0 ){
                                          echo '<li class="nav-item"><a class="nav-link active" href="#'.$this->get_id().$value['_id'].'" data-toggle="tab"><h3 class="tab-head"><span class="tab-text-title">'.$value['tab_title'].'</span></h3></a></li>';
                                    } else {
                                          echo '<li class="nav-item"><a class="nav-link" href="#'.$this->get_id().$value['_id'].'" data-toggle="tab"><h3 class="tab-head"><span class="tab-text-title">'.$value['tab_title'].'</span></h3></a></li>';
                                    }
                                 
                              }
                        ?>
                    </ul>

                    <div class="tab-content">

                     <?php
                     
                     foreach ($tabs as $content_key=>$value) {
                      
                        if( $content_key == 0){
                           echo '<div role="tabpanel" class="tab-pane fade active show" id="'.$this->get_id().$value['_id'].'">';
                        } else {
                           echo '<div role="tabpanel" class="tab-pane fade" id="'.$this->get_id().$value['_id'].'">';
                        }
                        
                        $arg = array(
                           'post_type'   =>  'post',
                           'post_status' => 'publish',
                           'posts_per_page' => $post_number,
                           'order' => $post_order,
                           'orderby' => 'publish_date',
                           'category__in' => $value['post_cats'],
                           'tag__in' => $value['post_tags'],
                           'suppress_filters' => false,
                        );

                        if($post_sortby=='popularposts'){
                         
                           $arg['meta_key'] = 'newszone_post_views_count';
                           $arg['orderby'] = 'meta_value_num';
                        }

                        if($post_sortby=='mostdiscussed'){
                           $arg['orderby'] = 'comment_count';
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
                   
                         if($value['ts_offset_enable']=='yes') {
                            $arg['offset'] = $value['ts_offset_item_num'];
                        }
                   
                       $queryd = new \WP_Query( $arg );
                     
                     ?>

                     <?php if ( $queryd->have_posts() ) : ?>
                        <div class="block-tab-item">
                              <div class="row">
                                 <?php while ($queryd->have_posts()) : $queryd->the_post();?>
                                    <?php if ( $queryd->current_post == 0 ): ?>
                                       <div class="col-md-6 col-sm-6">
                                             <div class="post-block-style big-block">
                                                <?php if (  (has_post_thumbnail() )  ) { 
                                                   ?>
                                                   <div class="post-thumb ts-resize">
                                                         <?php if(get_post_format()=='video'): ?>
                                                         <?php $video = digiqole_meta_option($queryd->posts[0]->ID,'featured_video','#');  
                                                         ?>
                                                            <div class="post-video-content">
                                                               <a href="<?php echo esc_url($video); ?>" class="ts-play-btn">
                                                                  <i class="fa fa-play" aria-hidden="true"></i>
                                                               </a>
                                                            </div> 
                                                         <?php endif; ?> 
                                                  
                                                         <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('digiqole-medium'); ?></a>
                                                         <?php if($show_cat == 'yes'):  ?> 
                                                         <div class="grid-cat">
                                                             <?php require DIGIQOLE_THEME_DIR . '/template-parts/blog/category/parts/cat-style.php'; ?>

                                                         </div>
                                                         <?php  endif; ?>
                                                 </div>
                                                <?php } else { ?>
                                                   <div class="post-thumb block6img-blank"></div>
                                                <?php } ?>
                                                <div class="post-content">
                                                    
                                                         <h4 class="post-title md"><a href="<?php echo esc_url( get_permalink()); ?>" rel="bookmark" title="<?php echo esc_attr( get_the_title() ); ?>"><?php echo wp_trim_words( get_the_title() ,$post_title_crop,''); ?></a></h4>
                                               
                                                   <div class="post-meta <?php echo esc_attr($show_author_avator == 'yes'?'ts-avatar-container':''); ?> ">
                                                        <?php if($show_author_avator=='yes'): ?>
                                                            <?php printf('<span class="ts-author-avatar">%1$s<a href="%2$s">%3$s</a></span>',
                                                                  get_avatar( get_the_author_meta( 'ID' ), 45 ), 
                                                                  esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), 
                                                                  get_the_author()
                                                               ); ?>
                                                         <?php endif; ?> 
                                                         <?php if( $show_author == 'yes') { ?>
                                                            <?php if ( get_the_author_meta('first_name') != "" || get_the_author_meta('last_name') != "" ) { ?>
                                                               <span class="post-author">
                                                             <i class="fa fa-user"></i>  
                                                               <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo get_the_author_meta('first_name');?> <?php echo get_the_author_meta('last_name');?></a></span>
                                                            <?php } else { ?>
                                                                
                                                               <span class="post-author">  <i class="fa fa-user"></i> 
                                                               <?php the_author_posts_link() ?>
                                                            </span>
                                                            <?php }?>
                                                         <?php } ?>
                                                         <?php if($show_date == 'yes') { ?>
                                                            <span class="post-date">
                                                            <i class="fa fa-clock-o"></i>
                                                            <?php echo get_the_date(get_option('date_format')); ?>
                                                         </span>
                                                         <?php } ?>
                                                   </div>
                                                   <p><?php echo esc_html( wp_trim_words(get_the_excerpt(),$post_content_crop,'') );?></p>
                                                  
                                                </div><!-- Post content end -->
                                             </div><!-- Post Block style end -->
                                       </div><!-- Col end -->
                                    <?php else: ?>
                                       <?php if ( $queryd->current_post == 1 ): ?>
                                          <div class="col-md-6 col-sm-6 second">
                                             <div class="post-block-list">
                                                <ul class="list-post">
                                       <?php endif; ?>    
                                                <li>
                                                      <div class="post-block-style post-float media">
                                                         <div class="post-thumb d-flex">
                                                            <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('digiqole-small'); ?></a>
                                                         </div>
                                                         <div class="post-content media-body">
                                                                 <?php if($show_cat == 'yes'):  ?> 
                                                                         <?php require DIGIQOLE_THEME_DIR . '/template-parts/blog/category/parts/cat-style2.php'; ?>
                                                                  <?php  endif; ?>
                                                          
                                                                  <h4 class="post-title title-small"><a href="<?php echo esc_url( get_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php echo esc_html(wp_trim_words( get_the_title() ,$sm_title_crop,'') );  ?></a></h4>
                                                          
                                                            <?php if($show_date == 'yes') { ?>
                                                                  <div class="post-meta">
                                                                     <span class="post-date"> <i class="fa fa-clock-o"></i> <?php echo get_the_date(get_option('date_format')); ?></span>
                                                                  </div>
                                                                
                                                            <?php } ?>
                                                         </div><!-- Post content end -->
                                                      </div><!-- Post block style end -->
                                                </li><!-- Li 4 end -->
                                       <?php if (($queryd->current_post + 1) == ($queryd->post_count)) {?>
                                             </ul><!-- List post end -->
                                          </div><!-- List post block end -->
                                       </div><!-- List post Col end -->
                                       <?php } ?> 
                                    <?php endif ?>

                                    <?php 
                                    endwhile; ?>
                              </div><!-- Tab pane Row 1 end -->
                           </div><!-- block-item6 -->
                        <?php wp_reset_postdata(); ?>
                     <?php endif; ?>
                     </div><!-- Tab pane 1 end -->
                     <?php } ?>
                </div><!-- Tab content-->
          </div><!--/.post-block6-element-->
      </div><!--/.post-block6-warp-->

	<?php }
   protected function _content_template() { 

   }
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

