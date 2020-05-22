<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Digiqole_Editor_Pick_Post_Slider_Widget extends Widget_Base {

  public $base;

    public function get_name() {
        return 'newszone-editor-pick-post-slider';
    }

    public function get_title() {
        return esc_html__( 'Editor Pick Post Slider', 'digiqole' );
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
         'post_pick_by',
         [
             'label'     => esc_html__( 'Post pick by', 'digiqole' ),
             'type'      => Controls_Manager::SELECT,
            
             'default'   => 'author',
             'options'   => [
                     'category'      =>esc_html__( 'Category', 'digiqole' ),
                     'stickypost'    =>esc_html__( 'Sticky posts', 'digiqole' ),
                     'post'    =>esc_html__( 'Post id', 'digiqole' ),
                     'author'    =>esc_html__( 'Author', 'digiqole' ),
                 ],
         ]
       ); 
       
       $this->add_control(
			'author_id',
			[
				'label' => esc_html__( 'Author id', 'digiqole' ),
				'type' => \Elementor\Controls_Manager::TEXT,
            'placeholder' => esc_html__( '1,2,3', 'digiqole' ),
            'condition' => [ 'post_pick_by' => ['author'] ]
			]
       );
       $this->add_control(
			'post_id',
			[
				'label' => esc_html__( 'Post id', 'digiqole' ),
				'type' => \Elementor\Controls_Manager::TEXT,
            'placeholder' => esc_html__( '1,2,3', 'digiqole' ),
            'condition' => [ 'post_pick_by' => ['post'] ]
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
             'condition' => [ 'post_pick_by' => ['category'] ]
         ]
       );
      
       $this->add_control(
         'post_count',
         [
           'label'         => esc_html__( 'Post count', 'digiqole' ),
           'type'          => Controls_Manager::NUMBER,
           'default'       => '3',
           'condition' => [ 'post_pick_by' => ['category','stickypost','author'] ]
         ]
       );
       $this->add_control(
         'post_order',
         [
             'label'     =>esc_html__( 'Post order', 'digiqole' ),
             'type'      => Controls_Manager::SELECT,
             'default'   => 'DESC',
             'condition' => [ 'post_pick_by' => ['category','stickypost','author'] ],
             'options'   => [
                     'DESC'      =>esc_html__( 'Descending', 'digiqole' ),
                     'ASC'       =>esc_html__( 'Ascending', 'digiqole' ),
                 ],
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
          'post_title_crop',
          [
            'label'         => esc_html__( 'Post title crop', 'digiqole' ),
            'type'          => Controls_Manager::NUMBER,
            'default'       => '10',
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
      'post_readmore',
      [
         'label' => esc_html__('Read more', 'digiqole'),
         'type' => Controls_Manager::TEXT,
         'default' => esc_html__( 'Read more', 'digiqole' ),
      
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
                'default' => 'yes',
            ]
        );

        
        $this->add_control(
         'ts_offset_enable',
            [
               'label' => esc_html__('Enable post skip', 'digiqole'),
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
           'label' => esc_html__('Post', 'digiqole' ),
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
              'selector' => '{{WRAPPER}} .post-content .post-title a',
           ]
        );
  
        
        $this->add_control(
           'block_meta_date_color',
           [
              'label' => esc_html__('Footer color', 'digiqole'),
              'type' => Controls_Manager::COLOR,
              'default' => '',
            
              'selectors' => [
                 '{{WRAPPER}} .post-content .post-meta-info li,{{WRAPPER}} .post-content .post-meta-info li i,{{WRAPPER}} .post-content .post-meta-info li a' => 'color: {{VALUE}}',
               
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
        $show_author        = $settings['show_author']; 
        $post_content_crop  = $settings['post_content_crop'];
        $readmore           = $settings['post_readmore'];      
        $show_view_count    = $settings['show_view_count']; 
        $post_count         = $settings['post_count']; 
        $slide_controls     = [
        
         'dot_nav_show'=>false, 
         'nav_show'=>$settings['digiqole_slider_nav_show'], 
         'auto_nav_slide'=>$settings['digiqole_slider_autoplay'], 
         'item_count'=>1, 

       ];
   
       $slide_controls = \json_encode($slide_controls);      
        
      $arg = [
            'post_type'   =>  'post',
            'post_status' => 'publish',
            'order' => $settings['post_order'],
            'orderby' => 'publish_date',
            'posts_per_page'=>$post_count
           
      ];

        if($settings['ts_offset_enable']=='yes'){
          $arg['offset'] = $settings['ts_offset_item_num'];
        }
        
        if($settings['post_pick_by']=='stickypost'){
           $arg['post__in'] = get_option( 'sticky_posts' );
           $arg['ignore_sticky_posts'] = 1;
        }

        if($settings['post_pick_by']=='category') {
           $arg['category__in'] = $settings['post_cats'];
        }

        if($settings['post_pick_by']=='post') {
           $digiqole_posts = explode(',',$settings['post_id']);
           $arg['post__in'] = $digiqole_posts;
           $arg['posts_per_page'] = count($digiqole_posts);
        }

        if($settings['post_pick_by']=='author') {
         $digiqole_authors = explode(',',$settings['author_id']);
         $arg['author__in'] = $digiqole_authors;
        }
   
     
        $query = new \WP_Query( $arg ); ?>
        
         <?php if ( $query->have_posts() ) : ?>
           
                  <div data-controls="<?php echo esc_attr($slide_controls); ?>" class="editor-pick-post-slider owl-carousel">
                        
                     <?php while ($query->have_posts()) : $query->the_post();?>
                         <?php  require 'style/post-grid/slider-style2.php'; ?>
                        
                     <?php endwhile; ?>
                        
                  </div><!-- block-item6 -->
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
            'suppress_filters' => false,
      ) );

      $cat_list = [];
      foreach($terms as $post) {
      $cat_list[$post->term_id]  = [$post->name];
      }
      return $cat_list;
   }

  
}