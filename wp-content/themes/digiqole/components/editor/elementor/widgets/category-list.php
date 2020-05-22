<?php

namespace Elementor;

if (!defined('ABSPATH')) exit;

class Digiqole_Category_List_Widget extends Widget_Base
{

   public $base;

   public function get_name()
   {
      return 'newszone-category-list';
   }

   public function get_title()
   {
      return esc_html__('Category List', 'digiqole');
   }

   public function get_icon()
   {
      return 'eicon-post-list';
   }

   public function get_categories()
   {
      return ['digiqole-elements'];
   }

   protected function _register_controls()
   {

      $this->start_controls_section(
         'section_tab',
         [
            'label' => esc_html__('Category', 'digiqole'),
         ]
      );

      $this->add_control(

         'category_style',
         [
            'label' => esc_html__('Choose Style', 'digiqole'),
            'type' => Custom_Controls_Manager::IMAGECHOOSE,
            'default' => 'style1',
            'options' => [
               'style1' => [
                  'category' => esc_html__('Style 1', 'digiqole'),
                  'imagelarge' => DIGIQOLE_IMG . '/admin/category/category-style-1.png',
                  'imagesmall' => DIGIQOLE_IMG . '/admin/category/category-style-1.png',
                  'width' => '50%',
               ],
               'style2' => [
                  'category' => esc_html__('Style 2', 'digiqole'),
                  'imagelarge' => DIGIQOLE_IMG . '/admin/category/category-style-2.png',
                  'imagesmall' => DIGIQOLE_IMG . '/admin/category/category-style-2.png',
                  'width' => '50%',
               ],
               'style3' => [
                  'category' => esc_html__('Style 3', 'digiqole'),
                  'imagelarge' => DIGIQOLE_IMG . '/admin/category/category-style-3.png',
                  'imagesmall' => DIGIQOLE_IMG . '/admin/category/category-style-3.png',
                  'width' => '50%',
               ],

            ],

         ]
      );


      $this->add_control(
         'cat_title_color',
         [
            'label' => esc_html__('Title color', 'digiqole'),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
               '{{WRAPPER}} .ts-category-list li a' => 'color: {{VALUE}};',
            ],
         ]
      );

      $this->add_control(
         'cat_number_color',
         [
            'label' => esc_html__('Number color', 'digiqole'),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
               '{{WRAPPER}} .ts-category-list li a span.category-count' => 'color: {{VALUE}};',
            ],
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
					'2' => esc_html__( '5', 'digiqole' ),
				],
            'default' => '6',
				'condition' => ['category_style' => ['style3']],
			]
      );
      

      $this->add_control(
         'category_count',
         [
            'label'         => esc_html__('Category count', 'digiqole'),
            'type'          => Controls_Manager::NUMBER,
            'default'       => '3',

         ]
      );

      $this->add_responsive_control(
         'thumbnail_height',
         [
            'label' => esc_html__('Image Height', 'digiqole'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
               'px' => [
                  'min' => 0,
                  'max' => 1000,
               ],
            ],
            'devices' => ['desktop', 'tablet', 'mobile'],
            'desktop_default' => [
               'size' => 50,
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
               '{{WRAPPER}} .ts-category-list li a, .ts-category-list-thumb .ts-category-list a' => 'min-height: {{SIZE}}{{UNIT}};',
            ],
         ]
      );
      $this->add_group_control(
         Group_Control_Typography::get_type(),
         [
            'name' => 'cat_title_typography',
            'label' => esc_html__('Category title', 'digiqole'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,

            'selector' => '{{WRAPPER}} .ts-category-list li a',
         ]
      );
      $this->add_control(
         'show_cat_selector',
         [
            'label' => esc_html__('Custom Category ', 'digiqole'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'digiqole'),
            'label_off' => esc_html__('No', 'digiqole'),
            'default' => 'yes',
         ]
      );
      $this->add_control(
         'cats',
         [
            'label' => esc_html__('Select Categories', 'digiqole'),
            'type'      => Custom_Controls_Manager::SELECT2,
            'options'   => $this->post_category(),
            'label_block' => true,
            'multiple'  => true,
            'condition' => ['show_cat_selector' => 'yes']
         ]
      );

      $this->add_control(
         'ts_offset_enable',
         [
            'label' => esc_html__('Enable category skip', 'digiqole'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'digiqole'),
            'label_off' => esc_html__('No', 'digiqole'),
            'default' => 'no',

         ]
      );

      $this->add_control(
         'ts_offset_item_num',
         [
            'label'         => esc_html__('Skip category count', 'digiqole'),
            'type'          => Controls_Manager::NUMBER,
            'default'       => '1',
            'condition' => ['ts_offset_enable' => 'yes']

         ]
      );

      $this->end_controls_section();
   }

   protected function render()
   {
      $settings = $this->get_settings();
      $grid_column = $settings['grid_column'];   

      $arg = [
         'orderby' => 'name',
         'number'   => $settings['category_count'],
         'order'   => 'ASC',
         'suppress_filters' => false,
      ];

      if ($settings['ts_offset_enable'] == 'yes') {
         $arg['offset'] = $settings['ts_offset_item_num'];
      }

      $categories = get_categories($arg);

?>

      <?php if ($settings['show_cat_selector'] == 'yes') : ?>

         <!-- style one -->
         <?php if ($settings['category_style'] == 'style1') { ?>
            <?php $categories = $settings['cats']; ?>
            <div class="ts-category ts-category-list-item">
               <ul class="ts-category-list">
                  <?php foreach ($categories as $cat) {
                     $category = get_category($cat);
                     $category_image = '';
                     if (defined('FW')) {
                        $category_featured_image = null;
                        if (isset($category->cat_ID) && !is_null($category->cat_ID)) {
                           $category_featured_image = fw_get_db_term_option($category->cat_ID, 'category', 'featured_upload_img');
                        }

                        if (isset($category_featured_image['url'])) {
                           $category_image = $category_featured_image['url'];
                           $category_image = 'style="background-image:url(' . esc_url($category_image) . ');"';
                        }
                     }


                  ?>
                     <?php if (!is_null($category)) { ?>
                        <li>
                           <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" <?php echo digiqole_kses($category_image); ?>>
                              <span> <?php echo esc_html($category->name); ?> </span>
                              <span class="bar"></span>
                              <?php if (isset($category->count)) : ?>
                                 <span class="category-count"><?php echo esc_html($category->count); ?></span>
                              <?php endif; ?>
                           </a>
                        </li>
                     <?php } ?>
                  <?php } ?>
               </ul>
            </div>
         <?php } 
         else if ($settings['category_style'] == 'style2') {     ?>
            <!-- style two -->
            <div class="ts-category ts-category-classic ts-category-list-item">
               <ul class="ts-category-list">
                  <?php foreach ($categories as $category) {
                     $category_image = '';

                     if (defined('FW')) {
                        $category_featured_image = fw_get_db_term_option($category->cat_ID, 'category', 'featured_upload_img');
                        if (isset($category_featured_image['url'])) {
                        }
                     }

                  ?>
                     <li>
                        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" <?php echo digiqole_kses($category_image); ?>>
                           <span> <?php echo esc_html($category->name); ?></span>
                           <span class="bar"></span>
                           <span class="category-count"><?php echo esc_html($category->count); ?></span>
                        </a>
                     </li>
                  <?php } ?>
               </ul>
            </div>

         <?php } 
         
         else if ($settings['category_style'] == 'style3') {     ?>
            <!-- style two -->
            <div class="ts-category style3 ts-category-list-item ts-category-list-thumb">
               <div class="ts-category-list">
                  <div class="row justify-content-lg-between">
                        <?php foreach ($categories as $cat) {
                           $category = get_category($cat);
                           $category_image = '';
                           if (defined('FW')) {
                              $category_featured_image = null;
                              if (isset($category->cat_ID) && !is_null($category->cat_ID)) {
                                 $category_featured_image = fw_get_db_term_option($category->cat_ID, 'category', 'featured_upload_img');
                              }

                              if (isset($category_featured_image['url'])) {
                                 $category_image = $category_featured_image['url'];
                                 $category_image = 'style="background-image:url(' . esc_url($category_image) . ');"';
                              }
                           }


                     ?>
                        <?php if (!is_null($category)) { ?>
                           <div class="col-lg col-md-<?php echo $grid_column; ?>">
                              <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" <?php echo digiqole_kses($category_image); ?>>
                                 <div class="category-details" style="<?php echo esc_attr(digiqole_cat_style($category->term_id, 'block_highlight_color','bg')); ?>">
                                 <h4> <?php echo esc_html($category->name); ?> </h4>
                                 <?php if (isset($category->count)) : ?>
                                    <span class="category-count"><?php echo esc_html($category->count); ?> Recipes</span>
                                 </div>
                                 <?php endif; ?>
                              </a>
                           </div>
                        <?php } ?>
                     <?php } ?>
                  </div>
               </div>
            </div>

         <?php }
         ?>
      <?php endif; ?>
<?php


   }
   protected function _content_template()
   {
   }

   public function post_category()
   {

      $terms = get_terms(array(
         'taxonomy'    => 'category',
         'hide_empty'  => false,
         'posts_per_page' => -1,
      ));

      $cat_list = [];
      foreach ($terms as $post) {
         $cat_list[$post->term_id]  = [$post->name];
      }
      return $cat_list;
   }
}
