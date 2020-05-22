<?php

namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) exit;

require_once('classes/settings.php');

class Digiqole_Widget_Instagram_Feed extends Widget_Base {

	private $ekit_ins_follow 	= 'https://www.instagram.com/xpeeder/';

	public $base;

    public function get_name() {
        return 'digiqole-instagram-feed';
    }

    public function get_title() {
        return esc_html__( 'Digiqole Instagram Feed', 'digiqole' );
    }

    public function get_icon() {
        return 'eicon-instagram-gallery';
    }

    public function get_categories() {
    	return [ 'digiqole-elements' ];
    }


	protected function _register_controls() {

		/*Layout Settings*/
		$this->start_controls_section(
            'ekit_instagram_feed_layout_settings', [
                'label' => esc_html__( 'Layout Settings ', 'digiqole' ),
            ]
        );

		$this->add_control(
            'ekit_instagram_feed_column_grid',
            [
                'label' => esc_html__( 'Columns Grid', 'digiqole' ),
                'type' =>  Controls_Manager::SELECT,
                'default' => 'ekit-insta-col-3',
                'options' => [
                    'ekit-insta-col-6'  => esc_html__( '2 Columns', 'digiqole' ),
                    'ekit-insta-col-4' => esc_html__( '3 Columns', 'digiqole' ),
                    'ekit-insta-col-3' => esc_html__( '4 Columns', 'digiqole' ),
                ],
				'separator' => 'after',
            ]
        );

        $this->add_control(
			'ekit_instagram_feed_style',
			[
				'label' => esc_html__( 'Feed Style', 'digiqole' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'digiqole' ),
				'label_off' => esc_html__( 'Hide', 'digiqole' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
            'ekit_instagram_feed_ins_limit',
            [
                'label' => esc_html__( 'Show Post', 'digiqole' ),
                'type' => Controls_Manager::NUMBER,
                'default' 		=> 6,
				'min' 			=> 1,
				'max' 			=> 100,
				'step' 			=> 1,
            ]
        );


		$this->end_controls_section();
		/* End layout settings*/


		$this->start_controls_section(
            'ekit_instagram_feed_display_settings', [
                'label' => esc_html__( 'Display Settings ', 'digiqole' ),
            ]
        );

		$this->add_control(
            'ekit_instagram_feed_show_profile_header',
            [
                'label' => esc_html__( 'Profile Header', 'digiqole' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'digiqole' ),
                'label_off' => esc_html__( 'Hide', 'digiqole' ),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                    'ekit_instagram_feed_style!' => 'yes'
                ]
            ]
        );
		$this->add_control(
            'ekit_instagram_feed_profile_settings',
            [
                'label' => esc_html__( 'Profile Settings', 'digiqole' ),
                'type' =>  Controls_Manager::SELECT,
                'default' => 'both',
                'options' => [
                    'only-profile'  => esc_html__( 'Only Profile Image', 'digiqole' ),
                    'only-name' => esc_html__( 'Only Name', 'digiqole' ),
                    'both' => esc_html__( 'Both', 'digiqole' ),
                ],
				'condition' => [
                    'ekit_instagram_feed_show_profile_header' => 'yes',
                    'ekit_instagram_feed_style!' => 'yes'
                ]
            ]
        );
		$this->add_control(
            'ekit_instagram_feed_show_profile_style',
            [
                'label' => esc_html__( 'Profile Style', 'digiqole' ),
                'type' =>  Controls_Manager::SELECT,
                'default' => 'circle',
                'options' => [
                    'circle'  => esc_html__( 'Circle', 'digiqole' ),
                    'square' => esc_html__( 'Square', 'digiqole' ),
                ],
				'condition' => ['ekit_instagram_feed_profile_settings!' => 'only-name',
                                'ekit_instagram_feed_show_profile_header' => 'yes',
                                'ekit_instagram_feed_style!' => 'yes'
                            ],

            ]
        );

		$this->add_control(
            'ekit_instagram_feed_show_post_date',
            [
                'label' => esc_html__( 'Show Date', 'digiqole' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'digiqole' ),
                'label_off' => esc_html__( 'Hide', 'digiqole' ),
                'return_value' => 'yes',
                'default' => 'yes',
				'condition' => [
                    'ekit_instagram_feed_show_profile_header' => 'yes',
                    'ekit_instagram_feed_style!' => 'yes'
                    ]
            ]
        );
		$this->add_control(
            'ekit_instagram_feed_show_ins_view',
            [
                'label' => esc_html__( 'Show Icon', 'digiqole' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'digiqole' ),
                'label_off' => esc_html__( 'Hide', 'digiqole' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'after',
				'condition' => [
                    'ekit_instagram_feed_show_profile_header' => 'yes',
                    'ekit_instagram_feed_style!' => 'yes'
                    ]
            ]
        );
		$this->add_control(
            'ekit_instagram_feed_show_comments_box',
            [
                'label' => esc_html__( 'Show Comment Box', 'digiqole' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'digiqole' ),
                'label_off' => esc_html__( 'Hide', 'digiqole' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

		$this->add_control(
            'ekit_instagram_feed_show_caption_box',
            [
                'label' => esc_html__( 'Show Caption', 'digiqole' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'digiqole' ),
                'label_off' => esc_html__( 'Hide', 'digiqole' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );


		$this->add_control(
            'ekit_instagram_feed_enable_follow',
            [
                'label' => esc_html__( 'Enable Follow Button', 'digiqole' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'digiqole' ),
                'label_off' => esc_html__( 'Hide', 'digiqole' ),
                'return_value' => 'yes',
                'default' => 'no',
				'separator' => 'before',
            ]
		);
		
		$this->add_control(
            'ekit_instagram_feed_ins_follow_text_identify',
            [
                'label' => esc_html__( 'Social Title', 'digiqole' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Instagram', 'digiqole' ),
				'placeholder' => esc_html__( 'Instagram', 'digiqole' ),
				'label_block'	 => true,
				'dynamic' => [
                    'active' => true,
                ],
				'condition' => ['ekit_instagram_feed_enable_follow' => 'yes'],
            ]
        );
		$this->add_control(
            'ekit_instagram_feed_ins_follow_link',
            [
                'label' => esc_html__( 'Follow link', 'digiqole' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( $this->ekit_ins_follow, 'digiqole' ),
				'placeholder' => esc_html__( 'Follow Link', 'digiqole' ),
				'label_block'	 => true,
				'dynamic' => [
                    'active' => true,
                ],
				'condition' => ['ekit_instagram_feed_enable_follow' => 'yes'],
            ]
        );

		$this->add_responsive_control(
			'ekit_instagram_feed_btn_alignment',
			[
				'label' => esc_html__( 'Alignment', 'digiqole' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'digiqole' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'digiqole' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'digiqole' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'left',
                'toggle' => true,
                'condition' => ['ekit_instagram_feed_enable_follow' => 'yes'],
                'selectors' => [
                    '{{WRAPPER}} .insta-follow-btn-area' => 'text-align: {{VALUE}};',
                ],
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
			'ekit_instagram_feed_conainer_tab_style',
			[
				'label' => esc_html__( 'Container', 'digiqole' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
        );

       $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ekit_instagram_feed_conainer_background',
				'label' => esc_html__( 'Background', 'digiqole' ),
                'types' => [ 'classic', 'gradient', ],
                'default' => '#FFFFFF',
                'exclude' => [
                    'image'
                ],
                'selector' => '{{WRAPPER}} .ekit-insta-content-holder.ekit-insta-style-classic',
                'condition' => [
                    'ekit_instagram_feed_style!' => 'yes'
                ]
			]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'ekit_instagram_feed_conainer_border',
				'label' => esc_html__( 'Border', 'digiqole' ),
                'selector' => '{{WRAPPER}} .ekit-insta-content-holder.ekit-insta-style-classic',
                'condition' => [
                    'ekit_instagram_feed_style!' => 'yes'
                ]
			]
        );

        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'ekit_instagram_feed_conainer_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'digiqole' ),
				'selector' => '{{WRAPPER}} .ekit-insta-content-holder',
			]
        );

        $this->add_responsive_control(
			'ekit_instagram_feed_conainer_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'digiqole' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ekit-insta-content-holder' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
			'ekit_instagram_feed_main_conainer_margin_bottom',
			[
				'label' => esc_html__( 'Margin Bottom', 'digiqole' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors' => [
					'{{WRAPPER}} .ekit-insta-content-holder' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
			'ekit_instagram_feed_conainer_lay_out_grid_gutter',
			[
				'label' => esc_html__( 'Gutter', 'digiqole' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .layout-grid .ekit-ins-feed' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .layout-grid.ekit-insta-row' => 'margin-left: -{{SIZE}}{{UNIT}}; margin-right: -{{SIZE}}{{UNIT}};',
                ],
			]
		);

        $this->add_responsive_control(
			'ekit_instagram_feed_conainer_lay_out_grid_container_spacing',
			[
				'label' => esc_html__( 'Container Spacing', 'digiqole' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .ekit-instagram-area' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}};',
                ],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
			'ekit_instagram_feed_header_style_tab',
			[
				'label' => esc_html__( 'Header', 'digiqole' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'ekit_instagram_feed_header_padding',
			[
				'label' => esc_html__( 'Padding', 'digiqole' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ekit-nsta-user-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->start_controls_tabs(
            'ekit_instagram_feed_header_username_and_date_normal_and_hover_tabs'
        );
        $this->start_controls_tab(
            'ekit_instagram_feed_header_username_and_date_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'digiqole' ),
            ]
        );

        $this->add_responsive_control(
			'ekit_instagram_feed_header_username_headeing_normal',
			[
				'label' => esc_html__( 'Name', 'digiqole' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'ekit_instagram_feed_header_username_normal_color',
			[
				'label' => esc_html__( 'Color', 'digiqole' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .ekit-insta-user-details' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_responsive_control(
			'ekit_instagram_feed_header_date_headeing_normal',
			[
				'label' => esc_html__( 'Date', 'digiqole' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'ekit_instagram_feed_header_date_normal_color',
			[
				'label' => esc_html__( 'Color', 'digiqole' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(0, 0, 0, 0.6)',
				'selectors' => [
					'{{WRAPPER}} .ekit-insta-user-details .ekit-insta-dataandtime' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_responsive_control(
			'ekit_instagram_feed_header_icon_headeing_normal',
			[
				'label' => esc_html__( 'Icon', 'digiqole' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'ekit_instagram_feed_header_icon_normal_color',
			[
				'label' => esc_html__( 'Color', 'digiqole' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .ekit-instagram-feed-item-source-icon svg path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

        $this->start_controls_tab(
            'ekit_instagram_feed_header_username_and_date_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'digiqole' ),
            ]
		);

		$this->add_control(
			'ekit_instagram_feed_header_username_headeing_hover',
			[
				'label' => esc_html__( 'Name', 'digiqole' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'ekit_instagram_feed_header_username_hover_color',
			[
				'label' => esc_html__( 'Color', 'digiqole' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#e1306c',
				'selectors' => [
					'{{WRAPPER}} .ekit-insta-user-details:hover .ekit-insta-user-name' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_control(
			'ekit_instagram_feed_header_date_headeing_hover',
			[
				'label' => esc_html__( 'Date', 'digiqole' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'ekit_instagram_feed_header_date_hover_color',
			[
				'label' => esc_html__( 'Color', 'digiqole' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#833ab4',
				'selectors' => [
					'{{WRAPPER}} .ekit-insta-user-details:hover .ekit-insta-dataandtime' => 'color: {{VALUE}}',
				],
			]
        );

        $this->add_control(
			'ekit_instagram_feed_header_icon_headeing_hover',
			[
				'label' => esc_html__( 'Icon', 'digiqole' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'ekit_instagram_feed_header_icon_hover_color',
			[
				'label' => esc_html__( 'Color', 'digiqole' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#f56040',
				'selectors' => [
					'{{WRAPPER}} .ekit-instagram-feed-item-source-icon:hover svg path' => 'fill: {{VALUE}}',
				],
			]
		);

        $this->end_controls_tab();

		$this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
			'ekit_instagram_feed_footer_style_tab',
			[
				'label' => esc_html__( 'Footer', 'digiqole' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'ekit_instagram_feed_footer_style_padding',
			[
				'label' => esc_html__( 'Padding', 'digiqole' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ekit-instagram-feed-posts-item-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
			'ekit_instagram_feed_footer_style_margin_bottom',
			[
				'label' => esc_html__( 'Margin Bottom', 'digiqole' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px',],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 12,
				],
				'selectors' => [
					'{{WRAPPER}} .ekit-insta-captions-box' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'ekit_instagram_feed_footer_style_item_margin_right',
			[
				'label' => esc_html__( 'Margin Right', 'digiqole' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px',],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .ekit-insta-statics-count:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);


        $this->start_controls_tabs(
            'ekit_instagram_feed_header_comment_and_like_hover_tabs'
        );
        $this->start_controls_tab(
            'ekit_instagram_feed_header_comment_tab',
            [
                'label' => esc_html__( 'Normal', 'digiqole' ),
            ]
        );

        $this->add_control(
			'ekit_instagram_feed_header_favourite_headeing_normal',
			[
				'label' => esc_html__( 'Favourite', 'digiqole' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'ekit_instagram_feed_header_style_classic_favourite_normal_color',
			[
				'label' => esc_html__( 'Color', 'digiqole' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .ekit-insta-style-classic .ekit-insta-statics-favourite' => 'color: {{VALUE}}',
					'{{WRAPPER}} .ekit-insta-style-classic .ekit-insta-statics-favourite > svg path' => 'fill: {{VALUE}}',
                ],
                'condition' => [
                    'ekit_instagram_feed_style!' => 'yes'
                ]
			]
        );

		$this->add_responsive_control(
			'ekit_instagram_feed_header_style_tiles_favourite_normal_color',
			[
				'label' => esc_html__( 'Color', 'digiqole' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .ekit-insta-style-tiles .ekit-insta-statics-favourite' => 'color: {{VALUE}}',
					'{{WRAPPER}} .ekit-insta-style-tiles .ekit-insta-statics-favourite > svg path' => 'fill: {{VALUE}}',
                ],
                'condition' => [
                    'ekit_instagram_feed_style' => 'yes'
                ]
			]
		);

        $this->add_control(
			'ekit_instagram_feed_header_comment_headeing_normal',
			[
				'label' => esc_html__( 'Comment', 'digiqole' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'ekit_instagram_feed_header_style_classic_comment_normal_color',
			[
				'label' => esc_html__( 'Color', 'digiqole' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .ekit-insta-style-classic .ekit-insta-statics-comment' => 'color: {{VALUE}}',
					'{{WRAPPER}} .ekit-insta-style-classic .ekit-insta-statics-comment > svg path' => 'fill: {{VALUE}}',
                ],
                'condition' => [
                    'ekit_instagram_feed_style!' => 'yes'
                ]
			]
        );

		$this->add_responsive_control(
			'ekit_instagram_feed_header_style_tiles_comment_normal_color',
			[
				'label' => esc_html__( 'Color', 'digiqole' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .ekit-insta-style-tiles .ekit-insta-statics-comment' => 'color: {{VALUE}}',
					'{{WRAPPER}} .ekit-insta-style-tiles .ekit-insta-statics-comment > svg path' => 'fill: {{VALUE}}',
                ],
                'condition' => [
                    'ekit_instagram_feed_style' => 'yes'
                ]
			]
        );

        $this->add_control(
			'ekit_instagram_feed_header_content_headeing_normal',
			[
				'label' => esc_html__( 'Content', 'digiqole' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'ekit_instagram_feed_header_style_classic_content_normal_color',
			[
				'label' => esc_html__( 'Color', 'digiqole' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .ekit-insta-style-classic .ekit-insta-captions' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'ekit_instagram_feed_style!' => 'yes'
                ]
			]
        );

		$this->add_responsive_control(
			'ekit_instagram_feed_header_style_tyles_content_normal_color',
			[
				'label' => esc_html__( 'Color', 'digiqole' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .ekit-insta-style-tiles .ekit-insta-captions' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'ekit_instagram_feed_style' => 'yes'
                ]
			]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ekit_instagram_feed_header_content_normal_content_typography',
				'label' => esc_html__( 'Typography', 'digiqole' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .ekit-insta-captions',
			]
		);

		$this->end_controls_tab();

        $this->start_controls_tab(
            'ekit_instagram_feed_header_comment_and_favourite_tab',
            [
                'label' => esc_html__( 'Hover', 'digiqole' ),
            ]
        );

        $this->add_control(
			'ekit_instagram_feed_header_favourite_headeing_hover',
			[
				'label' => esc_html__( 'Favourite', 'digiqole' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'ekit_instagram_feed_header_style_classic_favourite_hover_color',
			[
				'label' => esc_html__( 'Color', 'digiqole' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#833ab4',
				'selectors' => [
					'{{WRAPPER}} .ekit-insta-style-classic .ekit-insta-statics-favourite:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .ekit-insta-style-classic .ekit-insta-statics-favourite:hover > svg path' => 'fill: {{VALUE}}',
                ],
                'condition' => [
                    'ekit_instagram_feed_style!' => 'yes'
                ]
			]
        );

		$this->add_responsive_control(
			'ekit_instagram_feed_header_style_tyles_favourite_hover_color',
			[
				'label' => esc_html__( 'Color', 'digiqole' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#833ab4',
				'selectors' => [
					'{{WRAPPER}} .ekit-insta-style-tiles .ekit-insta-statics-favourite:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .ekit-insta-style-tiles .ekit-insta-statics-favourite:hover > svg path' => 'fill: {{VALUE}}',
                ],
                'condition' => [
                    'ekit_instagram_feed_style' => 'yes'
                ]
			]
        );

        $this->add_control(
			'ekit_instagram_feed_header_comment_headeing_hover',
			[
				'label' => esc_html__( 'Comment', 'digiqole' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'ekit_instagram_feed_header_style_classic_comment_hover_color',
			[
				'label' => esc_html__( 'Color', 'digiqole' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#f56040',
				'selectors' => [
					'{{WRAPPER}} .ekit-insta-style-classic .ekit-insta-statics-comment:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .ekit-insta-style-classic .ekit-insta-statics-comment:hover > svg path' => 'fill: {{VALUE}}',
                ],
                'condition' => [
                    'ekit_instagram_feed_style!' => 'yes'
                ]
			]
		);

		$this->add_responsive_control(
			'ekit_instagram_feed_header_style_tyles_comment_hover_color',
			[
				'label' => esc_html__( 'Color', 'digiqole' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#f56040',
				'selectors' => [
					'{{WRAPPER}} .ekit-insta-style-tiles .ekit-insta-statics-comment:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .ekit-insta-style-tiles .ekit-insta-statics-comment:hover > svg path' => 'fill: {{VALUE}}',
                ],
                'condition' => [
                    'ekit_instagram_feed_style' => 'yes'
                ]
			]
		);

        $this->end_controls_tab();

		$this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
			'ekit_instagram_feed_media_style_tab',
			[
				'label' => esc_html__( 'Media', 'digiqole' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'ekit_instagram_feed_style' => 'yes'
                ]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ekit_instagram_feed_media_overlay_background',
				'label' => esc_html__( 'Background', 'digiqole' ),
				'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .ekit-insta-content-holder:hover .ekit-insta-hover-overlay',
                'exclude' => [
                    'image'
                ]
			]
        );

        $this->add_responsive_control(
			'ekit_instagram_feed_media_scale',
			[
				'label' => esc_html__( 'Scale', 'digiqole' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 3,
						'step' => .1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 1.1,
				],
				'selectors' => [
					'{{WRAPPER}} .ekit-insta-content-holder.ekit-insta-style-tiles:hover .insta-media .photo-thumb' => 'transform: scale({{SIZE}});',
				],
			]
		);

        $this->add_responsive_control(
			'ekit_instagram_feed_media_grayscale',
			[
				'label' => esc_html__( 'Grayscale', 'digiqole' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .ekit-insta-content-holder.ekit-insta-style-tiles:hover .insta-media .photo-thumb' => 'filter: grayscale({{SIZE}}{{UNIT}});',
				],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
			'ekit_instagram_feed_button_style_tab',
			[
				'label' => esc_html__( 'Button', 'digiqole' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'ekit_instagram_feed_enable_follow' => 'yes'
                ]
			]
		);

        $this->add_responsive_control(
			'ekit_btn_text_padding',
			[
				'label' =>esc_html__( 'Padding', 'digiqole' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .insta-follow-btn-area .instagram-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_btn_border_radius',
			[
				'label' =>esc_html__( 'Border Radius', 'digiqole' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors' => [
					'{{WRAPPER}} .insta-follow-btn-area .instagram-btn' =>  'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ekit_btn_typography',
				'label' =>esc_html__( 'Typography', 'digiqole' ),
				'selector' => '{{WRAPPER}} .insta-follow-btn-area .instagram-btn',
			]
		);

        $this->add_group_control(
        	Group_Control_Text_Shadow::get_type(),
        	[
        		'name' => 'ekit_btn_shadow',
        		'selector' => '{{WRAPPER}} .insta-follow-btn-area .instagram-btn',
        	]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'ekit_btn_shadow_border',
				'label' => esc_html__( 'Border', 'digiqole' ),
				'selector' => '{{WRAPPER}} .insta-follow-btn-area .instagram-btn',
			]
		);

		$this->start_controls_tabs( 'ekit_btn_tabs_style' );

		$this->start_controls_tab(
			'ekit_btn_tabnormal',
			[
				'label' =>esc_html__( 'Normal', 'digiqole' ),
			]
		);

		$this->add_responsive_control(
			'ekit_btn_text_color',
			[
				'label' =>esc_html__( 'Text Color', 'digiqole' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .insta-follow-btn-area .instagram-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_btn_text_background_color',
			[
				'label' =>esc_html__( 'Background Color', 'digiqole' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#f56040',
				'selectors' => [
					'{{WRAPPER}} .insta-follow-btn-area .instagram-btn' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'ekit_btn_text_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'digiqole' ),
				'selector' => '{{WRAPPER}} .insta-follow-btn-area .instagram-btn',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'ekit_btn_tab_button_hover',
			[
				'label' =>esc_html__( 'Hover', 'digiqole' ),
			]
		);

		$this->add_responsive_control(
			'ekit_btn_hover_color',
			[
				'label' =>esc_html__( 'Text Color', 'digiqole' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .insta-follow-btn-area .instagram-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_btn_text_background_color_hover',
			[
				'label' =>esc_html__( 'Background Color', 'digiqole' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .insta-follow-btn-area .instagram-btn:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_btn_hover_border_color',
			[
				'label' =>esc_html__( 'Border Color', 'digiqole' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .insta-follow-btn-area .instagram-btn:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'ekit_btn_text_box_shadow_hover',
				'label' => esc_html__( 'Box Shadow', 'digiqole' ),
				'selector' => '{{WRAPPER}} .insta-follow-btn-area .instagram-btn:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'instagram_title_style_tab_section',
			[
				'label' => esc_html__( 'Title', 'digiqole' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => ['ekit_instagram_feed_enable_title' => 'yes'],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'instagram_title__typography',
				'label' => esc_html__( 'Typography', 'digiqole' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .xs_instafeed_title_container .xs_instafeed_title',
			]
		);

		$this->add_responsive_control(
			'instagram_title___color',
			[
				'label' => esc_html__( 'Title Color', 'digiqole' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .xs_instafeed_title_container .xs_instafeed_title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'instagram_sub_title__typography',
				'label' => esc_html__( 'Typography', 'digiqole' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .xs_instafeed_subtitle',
			]
		);

		$this->add_responsive_control(
			'instagram_sub_title___color',
			[
				'label' => esc_html__( 'Sub Title Color', 'digiqole' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .xs_instafeed_subtitle' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'instagram_title_wraper_spacing',
			[
				'label' => esc_html__( 'Margin', 'digiqole' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .xs_instafeed_title_container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function unit_converter($unit) {
		$convert_reaction = 0;
		$reaction_suffix = '';

		if ($unit >= 0 && $unit < 10000) {
			$convert_reaction = number_format($unit);
		}else if ($unit >= 10000 && $unit < 1000000) {
			$convert_reaction = round(floor($unit / 1000), 1);
			$reaction_suffix = 'K';
		}else if ($unit >= 1000000 && $unit < 100000000) {
			$convert_reaction = round(($unit / 1000000), 1);
			$reaction_suffix = 'M';
		}else if ($unit >= 100000000 && $unit < 1000000000) {
			$convert_reaction = round(floor($unit / 100000000), 1);
			$reaction_suffix = 'B';
		}else if($unit >= 1000000000){
			$convert_reaction = round(floor($unit / 1000000000), 1);
			$reaction_suffix = 'T';
		}

		return $convert_reaction.''.$reaction_suffix;
	}

	protected function render( ) {
        echo '<div class="ekit-wid-con" >';
            $this->render_raw();
        echo '</div>';
    }

    protected function render_raw( ) {
		$settings = $this->get_settings_for_display();
		extract($settings);

		$instagram_user_id = digiqole_option('instgram_user_id');
		$instagram_access_token = digiqole_option('instagram_access_token');

		$config = [
			'user_id' => esc_attr($instagram_user_id),
			'token' => esc_attr($instagram_access_token),
		];

		$setting = new \Digiqole_instagram_settings(  );
		$setting->setup($config);

		$limit = $ekit_instagram_feed_ins_limit;

		$response = $setting->get_feed($limit);

		$ins_user_link = strlen($ekit_instagram_feed_ins_follow_link) > 2 ? $ekit_instagram_feed_ins_follow_link : $this->ekit_ins_follow;
	?>

		<div class="ekit-instagram-area">
			<div class="ekit-insta-row layout-grid">
			
				<?php
				if(isset( $response->data ) && sizeof($response->data) ):
					foreach ($response->data as $ins_post) {

					$userInfo = $ins_post->user;
					$imagesInfo = $ins_post->images;
					$captionInfo = $ins_post->caption;

					$captionText = isset($captionInfo->text) ? $captionInfo->text : '';

					$pic_link = $ins_post->link;

					$pic_like_count = $ins_post->likes->count;
					$pic_comment_count = $ins_post->comments->count;

					$pic_src = str_replace("http://", "https://", $imagesInfo->standard_resolution->url);
					$pic_created_time = '';
					if(isset($ins_post->caption->created_time)){
						$pic_created_time = date("F j, Y", $ins_post->caption->created_time);
						$pic_created_time = date("F j, Y", strtotime($pic_created_time . " +1 days"));
					}
				?>
					<div class="ekit-ins-feed <?php echo esc_attr($ekit_instagram_feed_column_grid); ?>">
						<div class="ekit-insta-content-holder <?php if($ekit_instagram_feed_style == 'yes') : ?>ekit-insta-style-tiles<?php endif;?> <?php if($ekit_instagram_feed_style != 'yes') : ?>ekit-insta-style-classic<?php endif;?>">
							<?php if(($ekit_instagram_feed_show_profile_header == 'yes') && ($ekit_instagram_feed_style != 'yes')): ?>
							<div class="ekit-nsta-user-info">
								<a class="ekit-insta-user-details" href="https://www.instagram.com/<?php echo esc_url($userInfo->username); ?>">
									<?php if( in_array($ekit_instagram_feed_profile_settings, ['both', 'only-profile']) ):?>
									<div class="ekit-insta-user-image <?php echo esc_attr($ekit_instagram_feed_show_profile_style); ?>">
										<img src="<?php echo esc_url($userInfo->profile_picture);?>" alt="<?php echo esc_attr($userInfo->username); ?>" >
									</div>
									<?php endif; ?>
									<div class="ekit-insta-username-and-time">
										<?php if( in_array($ekit_instagram_feed_profile_settings, ['both', 'only-name']) ): ?>
										<span class="ekit-insta-user-name"> <?php echo esc_html($userInfo->username); ?> </span>
										<?php endif; if( $ekit_instagram_feed_show_post_date == 'yes' ): ?>
										<span class="ekit-insta-dataandtime"><?php echo esc_html($pic_created_time) ;?></span>
										<?php endif; ?>
									</div>
								</a>
								<?php if($ekit_instagram_feed_show_ins_view == 'yes'): ?>
								<a class="ekit-instagram-feed-item-source-icon" href="<?php echo esc_url($pic_link); ?>">
								<svg viewBox="0 0 24 24" width="24" height="24"><path d="M17.1,1H6.9C3.7,1,1,3.7,1,6.9v10.1C1,20.3,3.7,23,6.9,23h10.1c3.3,0,5.9-2.7,5.9-5.9V6.9C23,3.7,20.3,1,17.1,1zM21.5,17.1c0,2.4-2,4.4-4.4,4.4H6.9c-2.4,0-4.4-2-4.4-4.4V6.9c0-2.4,2-4.4,4.4-4.4h10.3c2.4,0,4.4,2,4.4,4.4V17.1z"></path><path d="M16.9,11.2c-0.2-1.1-0.6-2-1.4-2.8c-0.8-0.8-1.7-1.2-2.8-1.4c-0.5-0.1-1-0.1-1.4,0C10,7.3,8.9,8,8.1,9S7,11.4,7.2,12.7C7.4,14,8,15.1,9.1,15.9c0.9,0.6,1.9,1,2.9,1c0.2,0,0.5,0,0.7-0.1c1.3-0.2,2.5-0.9,3.2-1.9C16.8,13.8,17.1,12.5,16.9,11.2zM12.6,15.4c-0.9,0.1-1.8-0.1-2.6-0.6c-0.7-0.6-1.2-1.4-1.4-2.3c-0.1-0.9,0.1-1.8,0.6-2.6c0.6-0.7,1.4-1.2,2.3-1.4c0.2,0,0.3,0,0.5,0s0.3,0,0.5,0c1.5,0.2,2.7,1.4,2.9,2.9C15.8,13.3,14.5,15.1,12.6,15.4z"></path><path d="M18.4,5.6c-0.2-0.2-0.4-0.3-0.6-0.3s-0.5,0.1-0.6,0.3c-0.2,0.2-0.3,0.4-0.3,0.6s0.1,0.5,0.3,0.6c0.2,0.2,0.4,0.3,0.6,0.3s0.5-0.1,0.6-0.3c0.2-0.2,0.3-0.4,0.3-0.6C18.7,5.9,18.6,5.7,18.4,5.6z"></path></svg>
								</a>
								<?php endif;?>
							</div>
							<?php endif;?>
							<div class="insta-media">
								<a href="<?php echo esc_url($pic_link) ?>" target="_blank">
									<img class="img-responsive photo-thumb" src="<?php echo esc_url($pic_src);?>" alt="<?php echo esc_attr($userInfo->username); ?>" >
								</a>
							</div>
							<?php if(($ekit_instagram_feed_show_comments_box == 'yes') || ($ekit_instagram_feed_show_caption_box == 'yes')): ?>
							<div class="ekit-instagram-feed-posts-item-content">
								<?php if($ekit_instagram_feed_show_comments_box == 'yes'): ?>
								<div class="ekit-insta-comments-box">
									<a  href="<?php echo esc_url($pic_link) ?>" target="_blank" class="ekit-insta-statics-count ekit-insta-statics-favourite"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.1 21"><path d="M17.7 0c-2 0-3.3.5-4.9 2.1l-.7.7-.7-.7C9.8.5 8.4 0 6.4 0 2.6 0 0 3.1 0 6.8c0 4.2 3.4 7.1 8.6 11.5.9.8 1.9 1.6 2.9 2.5.1.1.3.2.5.2s.3-.1.5-.2c1.1-1 2.1-1.8 3.1-2.7 4.8-4.1 8.5-7.1 8.5-11.4C24 3.1 21.4 0 17.7 0zm-3.1 17.1c-.8.7-1.7 1.5-2.6 2.3-.9-.7-1.7-1.4-2.5-2.1-5-4.2-8.1-6.9-8.1-10.5 0-3.1 2.1-5.5 4.9-5.5 1.5 0 2.6.3 3.8 1.5L11.3 4c.3.4.4.5.7.6.3 0 .5-.2.7-.4 0 0 .2-.2 1.2-1.3 1.3-1.3 2.1-1.5 3.8-1.5 2.8 0 4.9 2.4 4.9 5.5 0 3.5-3.2 6.2-8 10.2z"/></svg> <span class="ekit-insta-statics-value"><?php echo esc_html($this->unit_converter($pic_like_count));?></span> </a>
									<a  href="<?php echo esc_url($pic_link) ?>" target="_blank" class="ekit-insta-statics-count ekit-insta-statics-comment"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22.2 22"><path d="M0 10.9C0 16.9 4.8 22 11 22c1.9 0 3.7-1 5.3-1.8l5 1.3h.2c.4 0 .6-.3.6-.6v-.2l-1.3-4.9c.9-1.6 1.4-2.9 1.4-4.8C22 4.8 17 0 11 0 4.9 0 0 4.9 0 10.9zm1.4 0c0-5.2 4.3-9.5 9.5-9.5 5.3 0 9.6 4.2 9.6 9.5 0 1.7-.5 3-1.3 4.4-.1.1-.1.2-.1.3v.1l1.1 4.1-4.1-1.1h-.2c-.1 0-.2 0-.3.1-1.4.8-3.1 1.8-4.8 1.8-5.1 0-9.4-4.4-9.4-9.7z"/></svg> <span class="ekit-insta-statics-value"><?php echo esc_html($this->unit_converter($pic_comment_count));?></span> </a>
								</div>
								<?php endif;?>
								<?php if(($ekit_instagram_feed_show_caption_box == 'yes') && $captionText != ''): ?>
								<div class="ekit-insta-captions-box">
									<p class="ekit-insta-captions"><?php echo esc_html($captionText);?> </p>
								</div>
								<?php endif;?>
							</div>
							<?php endif;?>
							<?php if($ekit_instagram_feed_style == 'yes') : ?>
								<div class="ekit-insta-hover-overlay">
									<?php if($ekit_instagram_feed_enable_follow == 'yes' && defined('FW')) { ?>
										<div class="ekit-ins-feed align-self-center text-center">
											<div class="btn-wrapper">
												<a class="instagram-btn" href="<?php echo esc_url($ins_user_link); ?>" target="_blank">
													<i class="fab fa-instagram"></i>
													<?php echo esc_html($ekit_instagram_feed_ins_follow_text_identify); ?>
												</a>
											</div>
										</div>
									<?php };?>
								</div>
							<?php endif;?>
						</div>
					</div>
					
				<?php
					}
				endif;?>
            </div>
		</div>
	<?php

	}
}