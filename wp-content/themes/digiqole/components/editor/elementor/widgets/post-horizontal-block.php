<?php

namespace Elementor;

if (!defined('ABSPATH')) exit;

class Digiqole_Horizonal_Post_Block_Widget extends Widget_Base
{

    public $base;

    public function get_name()
    {
        return 'horizontal-post-block';
    }

    public function get_title()
    {
        return esc_html__('Horizontal post block', 'digiqole');
    }

    public function get_icon()
    {
        return 'eicon-nav-menu';
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
                'label' => esc_html__('Post', 'digiqole'),
            ]
        );


        $this->add_control(
            'post_count',
            [
                'label'         => esc_html__('Post count', 'digiqole'),
                'type'          => Controls_Manager::NUMBER,
                'default'       => '5',
            ]
        );
        
        $this->add_responsive_control(
			'thumbnail_height',
			[
				'label' =>esc_html__( 'Image Height', 'digiqole' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 350,
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => 300,
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => 300,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .horizontal-post-block .post-block-style .post-thumb img' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
			]
      );

        $this->add_control(
            'post_title_crop',
            [
                'label'         => esc_html__('Post title crop', 'digiqole'),
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
                'label'         => esc_html__('Post content crop', 'digiqole'),
                'type'          => Controls_Manager::NUMBER,
                'default'       => '10',
                'condition' => ['show_desc' => ['yes']]
            ]
        );




        $this->add_control(
            'post_format',
            [
                'label' => esc_html__('Select Post Format', 'digiqole'),
                'type'      => Controls_Manager::SELECT2,
                'options' => [
                    'standard'  => esc_html__('Standard', 'digiqole'),
                    'video' => esc_html__('Video', 'digiqole'),
                ],
                'default' => [],
                'label_block' => true,
                'multiple'  => true,
            ]
        );

        $this->add_control(
            'post_cats',
            [
                'label' => esc_html__('Select Categories', 'digiqole'),
                'type'      => Controls_Manager::SELECT2,
                'options'   => $this->post_category(),
                'label_block' => true,
                'multiple'  => true,
            ]
        );


        $this->add_control(
            'post_tags',
            [
                'label' => esc_html__('Select tags', 'digiqole'),
                'type'      => Controls_Manager::SELECT2,
                'options'   => digiqole_post_tags(),
                'label_block' => true,
                'multiple'  => true,
            ]
        );


        $this->add_control(
            'show_view_count',
            [
                'label' => esc_html__('Show view Count', 'digiqole'),
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
                'default' => 'yes',
            ]
        );


        $this->add_control(
            'post_sortby',
            [
                'label'     => esc_html__('Post sort by', 'digiqole'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'latestpost',
                'options'   => [
                    'latestpost'      => esc_html__('Latest posts', 'digiqole'),
                    'popularposts'    => esc_html__('Popular posts', 'digiqole'),
                    'mostdiscussed'    => esc_html__('Most discussed', 'digiqole'),
                ],
            ]
        );
        

        $this->add_control(
            'post_order',
            [
                'label'     => esc_html__('Post order', 'digiqole'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'DESC',
                'options'   => [
                    'DESC'      => esc_html__('Descending', 'digiqole'),
                    'ASC'       => esc_html__('Ascending', 'digiqole'),
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
                'label'         => esc_html__('Skip post count', 'digiqole'),
                'type'          => Controls_Manager::NUMBER,
                'default'       => '1',
                'condition' => ['ts_offset_enable' => 'yes']

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'digiqole_style_block_section',
            [
                'label' => esc_html__(' Post', 'digiqole'),
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
                'label' => esc_html__('Typography', 'digiqole'),
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
                    '{{WRAPPER}} .post-content .post-meta span,{{WRAPPER}} .post-content .post-meta span i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
			'post_margin',
			[
				'label' =>esc_html__( 'margin', 'digiqole' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .horizontal-post-block .post-block-style' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
      );
      

        $this->end_controls_section();
    }

    protected function render()
    {

        $settings = $this->get_settings();
        $post_order         = $settings['post_order'];
        $post_sortby        = $settings['post_sortby'];
        $show_cat           = $settings['show_cat'];
        $show_date          = $settings['show_date'];
        $post_format        = $settings['post_format'];
        $post_title_crop    = $settings['post_title_crop'];
        $post_number        = $settings['post_count'];
        $show_view_count    = $settings['show_view_count'];
        $post_content_crop    = $settings['post_content_crop'];
        $show_desc    = $settings['show_desc'];


        $arg = [
            'post_type'   =>  'post',
            'post_status' => 'publish',
            'order' => $settings['post_order'],
            'posts_per_page' => $settings['post_count'],
            'category__in' => $settings['post_cats'],
            'tag__in' => $settings['post_tags'],
            'suppress_filters' => false,

        ];

        if ($settings['ts_offset_enable'] == 'yes') {
            $arg['offset'] = $settings['ts_offset_item_num'];
        }


        if (in_array('video', $post_format) && !in_array('standard', $post_format)) {

            $arg['tax_query'] = array(
                array(
                    'taxonomy' => 'post_format',
                    'field' => 'slug',
                    'terms' => array('post-format-video'),
                    'operator' => 'IN'
                )
            );
        }

        switch ($settings['post_sortby']) {
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

        //$settings['show_author'] = 'no';
        $queryd = new \WP_Query($arg); ?>

        <?php if ($queryd->have_posts()) : ?>
            <div class="horizontal-post-block">
                <?php
                $i = 0;
                while ($queryd->have_posts()) : $queryd->the_post();
                ?>
                    <?php $cat = get_the_category(); ?>

                    <?php if ($i % 2 == 0) { ?>

                        <div class="post-block-style post-float align-items-center row">
                            <div class="col-lg-6">
                                <div class="post-thumb d-flex">
                                    <a href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('digiqole-small'); ?></a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="post-content media-body align-self-center">
                                    <?php if ($show_cat == 'yes') : ?>
                                        <a class="post-cat" href="<?php echo get_category_link($cat[0]->term_id); ?>">
                                            <?php echo esc_html(get_cat_name($cat[0]->term_id)); ?>
                                        </a>
                                    <?php endif; ?>
                                    <h4 class="post-title"><a href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php echo esc_html(wp_trim_words(get_the_title(), $post_title_crop, ''));  ?></a></h4>
                                    <div class="post-meta">
                                        <?php if ($show_date == 'yes') { ?>
                                            <span class="post-date"><i class="fa fa-clock-o"></i> <?php echo get_the_date(get_option('date_format')); ?></span>

                                        <?php } ?>
                                        <?php if ($show_view_count == 'yes') { ?>
                                            <span class="post-view">
                                                <i class="icon icon-fire"></i>
                                                <?php echo digiqole_get_postview(get_the_ID()); ?>
                                            </span>
                                        <?php } ?>
                                    </div>
                                    <?php if ($show_desc == 'yes') : ?>
                                        <p>
                                            <?php echo esc_html(wp_trim_words(get_the_content(), $post_content_crop, '')); ?>
                                        </p>
                                    <?php endif; ?>

                                    <a class="post-readmore" href="<?php echo esc_url(get_permalink()); ?>"> <?php echo esc_html__('Read More', 'digiqole'); ?> <i class="icon icon-arrow-right"></i> </a>

                                </div><!-- Post content end -->
                            </div>

                        </div><!-- Post block style end -->
                    <?php } else { ?>
                        <div class="post-block-style post-float row align-items-center">
                            <div class="col-lg-6">
                                <div class="post-content media-body align-self-center">
                                    <?php if ($show_cat == 'yes') : ?>
                                        <a class="post-cat" href="<?php echo get_category_link($cat[0]->term_id); ?>">
                                            <?php echo esc_html(get_cat_name($cat[0]->term_id)); ?>
                                        </a>
                                    <?php endif; ?>
                                    <h4 class="post-title"><a href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php echo esc_html(wp_trim_words(get_the_title(), $post_title_crop, ''));  ?></a></h4>
                                    <div class="post-meta">
                                        <?php if ($show_date == 'yes') { ?>
                                            <span class="post-date"><i class="fa fa-clock-o"></i> <?php echo get_the_date(get_option('date_format')); ?></span>

                                        <?php } ?>
                                        <?php if ($show_view_count == 'yes') { ?>
                                            <span class="post-view">
                                                <i class="icon icon-fire"></i>
                                                <?php echo digiqole_get_postview(get_the_ID()); ?>
                                            </span>
                                        <?php } ?>
                                    </div>
                                    <?php if ($show_desc == 'yes') : ?>
                                        <p>
                                            <?php echo esc_html(wp_trim_words(get_the_content(), $post_content_crop, '')); ?>
                                        </p>
                                    <?php endif; ?>

                                    <a class="post-readmore" href="<?php echo esc_url(get_permalink()); ?>"> <?php echo esc_html__('Read More', 'digiqole'); ?> <i class="icon icon-arrow-right"></i> </a>

                                </div><!-- Post content end -->
                            </div>
                            <div class="col-lg-6">
                                <div class="post-thumb d-flex">
                                    <a href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('digiqole-small'); ?></a>
                                </div>
                            </div>


                        </div><!-- Post block style end -->
                    <?php } ?>
                <?php
                    $i++;
                endwhile; ?>

            </div><!-- block-item6 -->
            <?php wp_reset_postdata(); ?>
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
