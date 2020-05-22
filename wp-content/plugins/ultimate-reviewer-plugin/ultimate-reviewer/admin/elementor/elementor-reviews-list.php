<?php class GPUR_Elementor_Reviews_List_Widget extends Elementor\Widget_Base {

	public function get_name() {
		return 'gpur_reviews_list';
	}

	public function get_title() {
		return esc_html__( 'Reviews List', 'gpur' );
	}

	public function get_icon() {
		return 'eicon-bullet-list';
	}

	public function get_categories() {
		return [ 'review' ];
	}

	protected function _register_controls() {
					
		/*--------------------------------------------------------------
		Display
		--------------------------------------------------------------*/
		
		$this->start_controls_section(
			'_gpur_section_display',
			[
				'label' => esc_html__( 'Display', 'gpur' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
			
			$this->add_control(
				'title',
				[
					'label' => esc_html__( 'Title', 'gpur' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::TEXT,
				]
			);
				
			$this->add_control(
				'post_types',
				[
					'label' => esc_html__( 'Post Types', 'gpur' ),
					'label_block' => true,
					'type' => \Elementor\Controls_Manager::SELECT2,
					'multiple' => true,
					'options' => GPUR_Elementor::gpur_elementor_post_types(),
					'default' => 'post',
				]
			);
			
			$this->add_control(
				'ids',
				[
					'label' => esc_html__( 'Post/Page IDs', 'gpur' ),
					'label_block' => true,
					'description' => esc_html__( 'Enter the post/pages IDs you want to show - separate IDs with a comma e.g. 123, 456, 789', 'gpur' ),
					'type' => \Elementor\Controls_Manager::TEXT,
				]
			);
			
			$this->add_control(
				'cats',
				[
					'label' => esc_html__( 'Categories', 'gpur' ),
					'label_block' => true,
					'description' => esc_html__( 'Enter the category slugs you want to display posts from - separate slugs with a comma e.g. category-1, category-2, category-3', 'gpur' ),
					'type' => \Elementor\Controls_Manager::TEXT,
				]
			);
			
			$this->add_control(
				'tags',
				[
					'label' => esc_html__( 'Tags', 'gpur' ),
					'label_block' => true,
					'description' => esc_html__( 'Enter the tag slugs you want to display posts from - separate slugs with a comma e.g. tag-1, tag-2, tag-3', 'gpur' ),
					'type' => \Elementor\Controls_Manager::TEXT,
				]
			);
			
			$this->add_control(
				'current_tax',
				[
					'label' => esc_html__( 'Current Taxonomy', 'gpur' ),
					'description' => esc_html__( 'Only show posts from the current category/tag.', 'gpur' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
				]
			);
			
			$this->add_control(
				'exclude_current_item',
				[
					'label' => esc_html__( 'Exclude Current Item', 'gpur' ),
					'description' => esc_html__( 'Exclude the current post/page from showing in the review list.', 'gpur' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'return_value' => '1',
					'default' => '1',
				]
			);
			
			$this->add_control(
				'sort',
				[
					'label' => esc_html__( 'Sort', 'gpur' ),
					'options' => array(
						'post-date-desc' => esc_html__( 'Most Recent', 'gpur' ),
						'post-title-asc' => esc_html__( 'Alphabetical (A-Z)', 'gpur' ),
						'post-title-desc' => esc_html__( 'Alphabetical (Z-A)', 'gpur' ),
						'site-rating-desc' => esc_html__( 'Highest Site Rated', 'gpur' ),
						'site-rating-asc'=> esc_html__( 'Lowest Site Rated', 'gpur' ),
						'user-rating-desc'=> esc_html__( 'Highest User Rated', 'gpur' ),
						'user-rating-asc' => esc_html__( 'Lowest User Rated', 'gpur' ),
						'user-votes-desc' => esc_html__( 'Most User Votes', 'gpur' ),
						'likes-desc' => esc_html__( 'Most Likes', 'gpur' ),
						'random' => esc_html__( 'Random', 'gpur' ),
						'post-page-order' => esc_html__( 'Post/Page Order', 'gpur' ),
					),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'post-date-desc',
				]
			);
			
			$this->add_control(
				'number',
				[
					'label' => esc_html__( 'Number', 'gpur' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'default' => '5',
				]
			);
			
			$this->add_control(
				'rating_range',
				[
					'label' => esc_html__( 'Rating Range', 'gpur' ),
					'description' => esc_html__( 'Only display ratings within this range e.g. 1.0-3.5', 'gpur' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => '',
				]
			);
	
		$this->end_controls_section();
							
		/*--------------------------------------------------------------
		Posts
		--------------------------------------------------------------*/					

		$this->start_controls_section(
			'_gpur_section_posts',
			[
				'label' => __( 'Posts', 'gpur' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
				
			$this->add_control(
				'post_format',
				[
					'label' => esc_html__( 'Format', 'gpur' ),
					'options' => array(
						'gpur-format-list' => esc_html__( 'List', 'gpur' ),
						'gpur-format-columns-2' => esc_html__( '2 Columns', 'gpur' ), 
						'gpur-format-columns-3' => esc_html__( '3 Columns', 'gpur' ), 
						'gpur-format-columns-4' => esc_html__( '4 Columns', 'gpur' ),
					),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'gpur-format-list',
				]
			);
				
			// Post Data	
			$this->add_control(
				'_gpur_header_post_data',
				[
					'label' => esc_html__( 'Post Data', 'gpur' ),
					'type' => \Elementor\Controls_Manager::HEADING,
				]
			);
				$this->add_control(
				'show_ranking',
				[
					'label' => esc_html__( 'Ranking', 'gpur' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'return_value' => '1',
					'default' => '',
				]
			);
			$this->add_control(
				'show_image',
				[
					'label' => esc_html__( 'Image', 'gpur' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'return_value' => '1',
					'default' => '1',
				]
			);
			$this->add_control(
				'show_title',
				[
					'label' => esc_html__( 'Title', 'gpur' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'return_value' => '1',
					'default' => '1',
				]
			);
			$this->add_control(
				'show_name',
				[
					'label' => esc_html__( 'Author Name', 'gpur' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'return_value' => '1',
					'default' => '1',
				]
			);
			$this->add_control(
				'show_date',
				[
					'label' => esc_html__( 'Date', 'gpur' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'return_value' => '1',
					'default' => '1',
				]
			);
			$this->add_control(
				'show_comments',
				[
					'label' => esc_html__( 'Comments', 'gpur' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,						
					'return_value' => '1',
					'default' => '',
				]
			);
			$this->add_control(
				'show_likes',
				[
					'label' => esc_html__( 'Likes', 'gpur' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'return_value' => '1',
					'default' => '',
				]
			);
			$this->add_control(
				'show_site_rating',
				[
					'label' => esc_html__( 'Site Rating', 'gpur' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'return_value' => '1',
					'default' => '1',
				]
			);
			$this->add_control(
				'show_user_rating',
				[					
					'label' => esc_html__( 'User Rating', 'gpur' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'return_value' => '1',
					'default' => '1',
				]
			);
			$this->add_control(
				'show_excerpt',
				[
					'label' => esc_html__( 'Excerpt', 'gpur' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'return_value' => '1',
					'default' => '1',
				]
			);
			$this->add_control(
				'show_view_link',
				[
					'label' => esc_html__( 'View Link', 'gpur' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'return_value' => '1',
					'default' => '',
				]
			);

			$this->add_control(
				'image_source',
				[
					'label' => esc_html__( 'Image Source', 'gpur' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => array(
						'review-image-1' => esc_html__( 'Review Image 1', 'gpur' ),
						'review-image-2' => esc_html__( 'Review Image 2', 'gpur' ),
						'featured-image' => esc_html__( 'Featured Image', 'gpur' ),
					),
					'default' => 'featured-image',
				]
			);

			$this->add_control(
				'image_size',
				[
					'label' => esc_html__( 'Image Size', 'gpur' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => '160 x 160',
				]
			);

			$this->add_control(
				'title_length',
				[
					'label' => esc_html__( 'Title Length', 'gpur' ),
					'description' => esc_html__( 'The number of characters in the title. Leave empty to display all characters.', 'gpur' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
				]
			);

			$this->add_control(
				'excerpt_length',
				[
					'label' => esc_html__( 'Excerpt Length', 'gpur' ),
					'description' => esc_html__( 'The number of characters in the excerpt. Leave empty to display all characters.', 'gpur' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'default' => 200,
				]
			);

			$this->add_control(
				'ratings_position',
				[
					'label' => esc_html__( 'Ratings Position', 'gpur' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => array(
						'gpur-ratings-below' => esc_html__( 'Below', 'gpur' ),
						'gpur-ratings-to-right' => esc_html__( 'To Right', 'gpur' ),
						'gpur-ratings-over-image' => esc_html__( 'Over Image', 'gpur' ),
					),
					'default' => 'gpur-ratings-below',
				]
			);

			$this->add_control(
				'posts_border_color',
				[
					'label' => esc_html__( 'Post Divider Color', 'gpur' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'condition' => [
						'post_format' => 'gpur-format-list',
					],
					'selectors' => [
						'{{WRAPPER}} .gpur-format-list .gpur-reviews-list-item' => 'border-color: {{VALUE}};',
					],
				]
			);

		$this->end_controls_section();
			
		/*--------------------------------------------------------------
		Site Rating
		--------------------------------------------------------------*/					
		
		$this->start_controls_section(
			'_gpur_section_site_rating',
			[
				'label' => esc_html__( 'Site Rating', 'gpur' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);		

			// Site Rating - Rating Controls		
			$this->add_control(
				'_gpur_header_site_rating_controls',
				[
					'label' => esc_html__( 'Rating Controls', 'gpur' ),
					'type' => \Elementor\Controls_Manager::HEADING,
				]
			);		
				$this->add_control(
					'site_rating_max_rating',
					[					
						'label' => esc_html__( 'Maximum Rating', 'gpur' ),
						'type' => \Elementor\Controls_Manager::NUMBER,
						'default' => 5,
					]
				);	
				$this->add_control(
					'site_rating_decimal_places',
					[
						'label' => esc_html__( 'Decimal Places', 'gpur' ),
						'description' => esc_html__( 'The number of decimal places to show the rating to.', 'gpur' ),
						'type' => \Elementor\Controls_Manager::NUMBER,
						'default' => 1,
					]
				);	
				$this->add_control(
					'site_rating_show_zero_rating',
					[
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'label' => esc_html__( 'Zero Ratings', 'gpur' ),
						'return_value' => '1',
						'default' => '1',
					]
				);
				
			$this->add_control( '_gpur_divider_site_rating_style', [ 'type' => \Elementor\Controls_Manager::DIVIDER ] );	
				
			// Site Rating - Rating Style		
			$this->add_control(
				'_gpur_header_site_rating_style',
				[
					'label' => esc_html__( 'Rating Style', 'gpur' ),
					'type' => \Elementor\Controls_Manager::HEADING,
				]
			);	
											
				$this->add_control(
					'site_rating_style',
					[
						'label' => esc_html__( 'Style', 'gpur' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => array(
							'style-plain-singular' => esc_html__( 'Plain (Singular)', 'gpur' ),
							'style-squares-singular' => esc_html__( 'Squares (Singular)', 'gpur' ),
							'style-circles-singular' => esc_html__( 'Circles (Singular)', 'gpur' ),
							'style-gauge-circles-singular' => esc_html__( 'Gauge Circles (Singular)', 'gpur' ),
							'style-stars' => esc_html__( 'Stars', 'gpur' ),
							'style-hearts' => esc_html__( 'Hearts', 'gpur' ),
							'style-squares' => esc_html__( 'Squares', 'gpur' ),
							'style-circles' => esc_html__( 'Circles', 'gpur' ),
							'style-bars' => esc_html__( 'Bars', 'gpur' ),
							'style-icon' => esc_html__( 'Custom Icon', 'gpur' ),
							'style-image' => esc_html__( 'Custom Image', 'gpur' ),
						),
						'default' => 'style-stars',
					]
				);					
				$this->add_control(
					'site_rating_position',
					[
						'label' => esc_html__( 'Position', 'gpur' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => array(
							'position-left' => esc_html__( 'Left', 'gpur' ),
							'position-center' => esc_html__( 'Center', 'gpur' ),
							'position-right' => esc_html__( 'Right', 'gpur' ),
						),
						'default' => 'position-left',
					]	
				);
				$this->add_control(
					'site_rating_text_position',
					[
						'label' => esc_html__( 'Rating Text Position', 'gpur' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => array(
							'position-text-top' => esc_html__( 'Top', 'gpur' ),
							'position-text-bottom' => esc_html__( 'Bottom', 'gpur' ),
							'position-text-left' => esc_html__( 'Left', 'gpur' ),
							'position-text-right' => esc_html__( 'Right', 'gpur' ),
						),
						'default' => 'position-text-bottom',
						'condition' => [
							'site_rating_style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
						],
				
					]	
				);				
				$this->add_control(
					'site_rating_image',
					[
						'label' => esc_html__( 'Custom Image', 'gpur' ),
						'description' => esc_html__( 'Your image should include the filled and empty icons. For an example see the', 'gpur' ) . ' <a href="' . GPUR_URL . 'public/images/default-rating-image.png" target="_blank">' . esc_html__( 'default image', 'gpur' ) . '</a>.',
						'type' => \Elementor\Controls_Manager::MEDIA,
						'condition' => [
							'site_rating_style' => 'style-image',
						],
						'selectors' => [
							'{{WRAPPER}} .gpur-is-site-rating.gpur-style-image .gpur-symbol-empty, {{WRAPPER}} .gpur-is-site-rating.gpur-style-image .gpur-symbol-filled' => 'background-image: url("{{URL}}");',
						],
					]
				);		
				$this->add_control(
					'site_rating_empty_icon',
					[
						'label' => esc_html__( 'Empty Icon', 'gpur' ),
						'type' => \Elementor\Controls_Manager::ICONS,
						'default' => [
							'value' => 'fas fa-star',
							'library' => 'solid',
						],
						'condition' => [
							'site_rating_style' => 'style-icon', 
						],
					]
				);
				$this->add_control(
					'site_rating_empty_icon_color',
					[
						'label' => esc_html__( 'Empty Icon Color', 'gpur' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'condition' => [
							'site_rating_style' => array( 'style-stars', 'style-hearts', 'style-squares', 'style-circles', 'style-bars', 'style-icon' ), 
						],
						'selectors' => [
							'{{WRAPPER}} .gpur-is-site-rating .rating-symbol-background' => 'color: {{VALUE}};',
							'{{WRAPPER}} .gpur-is-site-rating.gpur-style-circles .gpur-symbol-empty, {{WRAPPER}} .gpur-is-site-rating.gpur-style-squares .gpur-symbol-empty, {{WRAPPER}} .gpur-is-site-rating.gpur-style-bars .gpur-symbol-empty' => 'background-color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'site_rating_filled_icon',
					[
						'label' => esc_html__( 'Filled Icon', 'gpur' ),
						'type' => \Elementor\Controls_Manager::ICONS,
						'default' => [
							'value' => 'fas fa-star',
							'library' => 'solid',
						],
						'condition' => [
							'site_rating_style' => 'style-icon', 
						],
					]	
				);
				$this->add_control(
					'site_rating_filled_icon_color',
					[
						'label' => esc_html__( 'Filled Icon Color', 'gpur' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'condition' => [
							'site_rating_style' => array( 'style-stars', 'style-hearts', 'style-squares', 'style-circles', 'style-bars', 'style-icon' ), 
						],
						'selectors' => [
							'{{WRAPPER}} .gpur-is-site-rating .rating-symbol-foreground' => 'color: {{VALUE}};',
							'{{WRAPPER}} .gpur-is-site-rating.gpur-style-circles .gpur-symbol-filled, {{WRAPPER}} .gpur-is-site-rating.gpur-style-squares .gpur-symbol-filled, {{WRAPPER}} .gpur-is-site-rating.gpur-style-bars .gpur-symbol-filled' => 'background-color: {{VALUE}};',
						],
					]	
				);		
				$this->add_control(
					'site_rating_icon_width',
					[
						'label' => esc_html__( 'Width', 'gpur' ),
						'type' => \Elementor\Controls_Manager::SLIDER,
						'size_units' => [ 'px', '%', 'em' ],
						'range' => [
							'px' => [
								'min' => 1,
								'max' => 1000,
								'step' => 1,
							],	
							'%' => [
								'min' => 1,
								'max' => 1000,
								'step' => 1,
							],	
						],	
						'default' => [
							'unit' => 'px',
							'size' => '',
						],
						'condition' => [
							'site_rating_style' => array( 'style-stars', 'style-hearts', 'style-squares', 'style-circles', 'style-icon', 'style-image' ), 
						],
						'selectors' => [
							'{{WRAPPER}} .gpur-is-site-rating .rating-symbol' => 'font-size: {{SIZE}}{{UNIT}};',
							'{{WRAPPER}} .gpur-is-site-rating.gpur-style-circles .gpur-symbol, {{WRAPPER}} .gpur-is-site-rating.gpur-style-squares .gpur-symbol, .gpur-style-image .gpur-symbol' => 'width: {{SIZE}}{{UNIT}};',
						],	
					]	
				);
				$this->add_control(
					'site_rating_icon_height',
					[
						'label' => esc_html__( 'Height', 'gpur' ),
						'type' => \Elementor\Controls_Manager::SLIDER,
						'size_units' => [ 'px', '%', 'em' ],
						'range' => [
							'px' => [
								'min' => 1,
								'max' => 1000,
								'step' => 1,
							],	
							'%' => [
								'min' => 1,
								'max' => 1000,
								'step' => 1,
							],	
						],	
						'default' => [
							'unit' => 'px',
							'size' => '',
						],
						'condition' => [
							'site_rating_style' => array( 'style-squares', 'style-circles', 'style-bars', 'style-icon', 'style-image' ),
						],
						'selectors' => [
							'{{WRAPPER}} .gpur-is-site-rating.gpur-style-bars .gpur-symbol, {{WRAPPER}} .gpur-is-site-rating.gpur-style-circles .gpur-symbol, {{WRAPPER}} .gpur-is-site-rating.gpur-style-squares .gpur-symbol, .gpur-style-image .gpur-symbol' => 'height: {{SIZE}}{{UNIT}};',
						],	
					]	
				);
			
			$this->add_control( '_gpur_divider_site_rating_container', [ 
				'type' => \Elementor\Controls_Manager::DIVIDER,
				'condition' => [
					'site_rating_style' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
				], 
			]);		
			
			// Site Rating - Rating Container								
			$this->add_control(
				'_gpur_header_site_rating_container',
				[
					'label' => esc_html__( 'Rating Container', 'gpur' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'condition' => [
						'site_rating_style' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
					],
				]	
			);
				$this->add_control(
					'site_rating_container_width',
					[
						'label' => esc_html__( 'Width', 'gpur' ),
						'type' => \Elementor\Controls_Manager::SLIDER,
						'size_units' => [ 'px', '%', 'em' ],
						'range' => [
							'px' => [
								'min' => 1,
								'max' => 1000,
								'step' => 1,
							],	
							'%' => [
								'min' => 1,
								'max' => 1000,
								'step' => 1,
							],	
						],	
						'default' => [
							'unit' => 'px',
							'size' => '',
						],
						'condition' => [
							'site_rating_style' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
						],
					'selectors' => [
						'{{WRAPPER}} .gpur-is-site-rating .gpur-rating-outer' => 'width: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .gpur-is-site-rating .gpur-small-rating .gpur-gauge-1' => 'clip: rect(0, {{SIZE}}{{UNIT}}, {{SIZE}}{{UNIT}}, calc({{SIZE}}{{UNIT}}/2));',
						'{{WRAPPER}} .gpur-is-site-rating .gpur-small-rating .gpur-gauge-2' => 'clip: rect(0, calc({{SIZE}}{{UNIT}}/2), {{SIZE}}{{UNIT}}, 0);',
					],
					]	
				);
				$this->add_control(
					'site_rating_container_height',
					[
						'label' => esc_html__( 'Height', 'gpur' ),
						'type' => \Elementor\Controls_Manager::SLIDER,
						'size_units' => [ 'px', '%', 'em' ],
						'range' => [
							'px' => [
								'min' => 1,
								'max' => 1000,
								'step' => 1,
							],	
							'%' => [
								'min' => 1,
								'max' => 1000,
								'step' => 1,
							],	
						],	
						'default' => [
							'unit' => 'px',
							'size' => '',
						],
						'condition' => [
							'site_rating_style' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
						],
					'selectors' => [
						'{{WRAPPER}} .gpur-is-site-rating .gpur-rating-outer' => 'height: {{SIZE}}{{UNIT}};',
					],
					]	
				);		
				$this->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					[
						'name' => 'site_rating_container_background',
						'condition' => [
							'site_rating_style' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
						],
						'selector' => '{{WRAPPER}} .gpur-is-site-rating .gpur-rating-inner',
					]
				);
				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'site_rating_container_border',
						'label' => esc_html__( 'Border', 'gpur' ),
						'condition' => [
							'site_rating_style' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
						],
						'selector' => '{{WRAPPER}} .gpur-is-site-rating .gpur-rating-inner',
					]
				);	
				$this->add_control(
					'site_rating_container_extra_css',
					[
						'label' => esc_html__( 'Extra CSS', 'gpur' ),
						'label_block' => true,
						'type' => \Elementor\Controls_Manager::TEXT,
						'condition' => [
							'site_rating_style' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
						],
						'selector' => '{{WRAPPER}} .gpur-is-site-rating .gpur-rating-inner',
					]	
				);	

			$this->add_control( '_gpur_divider_site_rating_gauge', [ 
				'type' => \Elementor\Controls_Manager::DIVIDER,
				'condition' => [
					'site_rating_style' => 'style-gauge-circles-singular', 
				],	
			] );	
				
			// Site Rating - Gauge				
			$this->add_control( 
				'_gpur_header_site_rating_gauge',
				[
					'label' => esc_html__( 'Gauge', 'gpur' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'condition' => [
						'site_rating_style' => 'style-gauge-circles-singular', 
					],
				]	
			);
				$this->add_control(
					'site_rating_gauge_width',
					[
						'label' => esc_html__( 'Width', 'gpur' ),
						'type' => \Elementor\Controls_Manager::SLIDER,
						'size_units' => [ 'px', '%', 'em' ],
						'range' => [
							'px' => [
								'min' => 1,
								'max' => 1000,
								'step' => 1,
							],	
							'%' => [
								'min' => 1,
								'max' => 1000,
								'step' => 1,
							],	
						],	
						'default' => [
							'unit' => 'px',
							'size' => '',
						],
						'condition' => [
							'site_rating_style' => 'style-gauge-circles-singular', 
						],
						'selectors' => [
							'{{WRAPPER}} .gpur-is-site-rating.gpur-style-gauge-circles-singular .gpur-rating-inner' => 'top: {{SIZE}}{{UNIT}}; right: {{SIZE}}{{UNIT}}; bottom: {{SIZE}}{{UNIT}}; left: {{SIZE}}{{UNIT}};',
						],
					]	
				);
				$this->add_control( 
					'site_rating_gauge_filled_color_1',
					[
						'label' => esc_html__( 'Filled Color 1', 'gpur' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'condition' => [
							'site_rating_style' => 'style-gauge-circles-singular', 
						],
					]	
				);
				$this->add_control( 
					'site_rating_gauge_filled_color_2',
					[
						'label' => esc_html__( 'Filled Color 2', 'gpur' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'condition' => [
							'site_rating_style' => 'style-gauge-circles-singular',
						],
					]
				);
				$this->add_control( 
					'site_rating_gauge_empty_color',
					[
						'label' => esc_html__( 'Empty Color', 'gpur' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'condition' => [
							'site_rating_style' => 'style-gauge-circles-singular', 
						],
						'selectors' => [
							'{{WRAPPER}} .gpur-is-site-rating.gpur-style-gauge-circles-singular .gpur-rating-outer' => 'background: {{VALUE}};',
						],
					]
				);
				
			$this->add_control( '_gpur_divider_site_rating_text', [ 
				'type' => \Elementor\Controls_Manager::DIVIDER,				
				'condition' => [
					'site_rating_style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),	
				],
			] );
			
			// Site Rating - Rating Text
			$this->add_control(
				'_gpur_header_site_rating_text',
				[
					'label' => esc_html__( 'Rating Text', 'gpur' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'condition' => [
						'site_rating_style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),	
					],
				]	
			);
				$this->add_control(
					'show_site_rating_text',
					[
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'label' => esc_html__( 'Display', 'gpur' ),
						'return_value' => '1',
						'default' => '',
						'condition' => [
							'site_rating_style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
						],
					]
				);	
			
			$this->add_control( '_gpur_divider_site_rating_label', [ 
				'type' => \Elementor\Controls_Manager::DIVIDER,			
				'condition' => [
					'show_site_rating_text' => '1',
					'site_rating_style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),	
				],	
			] );				
				
			// Site Rating - Label
			$this->add_control(
				'_gpur_header_site_rating_label',
				[
					'label' => esc_html__( 'Label', 'gpur' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'condition' => [
						'show_site_rating_text' => '1',
						'site_rating_style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),	
					],
				]	
			);											
				$this->add_control( 
					'site_rating_label',
					[
						'label' => esc_html__( 'Label', 'gpur' ),
						'label_block' => true,
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( 'Site Rating:', 'gpur' ),
						'condition' => [
							'show_site_rating_text' => '1',
							'site_rating_style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),	
						],
					]	
				);		
				$this->add_control(
					'site_rating_label_color',
					[
						'label' => esc_html__( 'Text Color', 'gpur' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'condition' => [
							'show_site_rating_text' => '1',
							'site_rating_style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),	
						],
						'selectors' => [
							'{{WRAPPER}} .gpur-site-rating-label' => 'color: {{VALUE}};',
						],
					]	
				);
				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'site_rating_label_typography',
						'label' => esc_html__( 'Typography', 'gpur' ),
						'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_3,
						'default' => array(
							'font_weight' => '400',
						),
						'condition' => [
							'show_site_rating_text' => '1',
							'site_rating_style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),	
						],
						'selector' => '{{WRAPPER}} .gpur-site-rating-label',
					]
				);		
				$this->add_control(
					'site_rating_label_extra_css',
					[
						'label' => esc_html__( 'Extra CSS', 'gpur' ),
						'label_block' => true,
						'type' => \Elementor\Controls_Manager::TEXT,
						'condition' => [
							'show_site_rating_text' => '1',
							'site_rating_style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),	
						],
						'selectors' => [
							'{{WRAPPER}} .gpur-site-rating-label' => '{{VALUE}}',
						],
					]	
				);				
			
			$this->add_control( '_gpur_divider_site_rating_number', [ 
				'type' => \Elementor\Controls_Manager::DIVIDER,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'show_site_rating_text',
							'value' => '1',
						],
						[
							'name' => 'site_rating_style',
							'operator' => 'in',
							'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
						],	
					],
				]	
			] );		
					
			// Site Rating - Rating Number
			$this->add_control(
				'_gpur_header_site_rating_number',
				[
					'label' => esc_html__( 'Rating Number', 'gpur' ),
					'type' => \Elementor\Controls_Manager::HEADING,					
					'conditions' => [
						'relation' => 'or',
						'terms' => [
							[
								'name' => 'show_site_rating_text',
								'value' => '1',
							],
							[
								'name' => 'site_rating_style',
								'operator' => 'in',
								'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
							],	
						],
					]
				]		
			);		
				$this->add_control(
					'site_rating_number_color',
					[
						'label' => esc_html__( 'Text Color', 'gpur' ),
						'type' => \Elementor\Controls_Manager::COLOR,					
						'conditions' => [
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'show_site_rating_text',
									'value' => '1',
								],
								[
									'name' => 'site_rating_style',
									'operator' => 'in',
									'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
								],	
							],
						],						
						'selectors' => [
							'{{WRAPPER}} .gpur-site-rating .gpur-rating-value' => 'color: {{VALUE}};',
						],	
					]	
				);
				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'site_rating_number_typography',
						'label' => esc_html__( 'Typography', 'gpur' ),
						'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_3,
						'default' => array(
							'font_weight' => '400',
						),				
						'conditions' => [
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'show_site_rating_text',
									'value' => '1',
								],
								[
									'name' => 'site_rating_style',
									'operator' => 'in',
									'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
								],	
							],	
						],
						'selector' => '{{WRAPPER}} .gpur-site-rating .gpur-rating-value',
					]
				);			
				$this->add_control(
					'site_rating_number_extra_css',
					[
						'label' => esc_html__( 'Extra CSS', 'gpur' ),
						'label_block' => true,
						'type' => \Elementor\Controls_Manager::TEXT,					
						'conditions' => [
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'show_site_rating_text',
									'value' => '1',
								],
								[
									'name' => 'site_rating_style',
									'operator' => 'in',
									'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
								],	
							],	
						],
						'selectors' => [
							'{{WRAPPER}} .gpur-site-rating .gpur-rating-value' => '{{VALUE}}',
						],
					]	
				);
			
			$this->add_control( '_gpur_divider_site_rating_max_rating_number', [ 
				'type' => \Elementor\Controls_Manager::DIVIDER, 
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'show_site_rating_text',
							'value' => '1',
						],
						[
							'name' => 'site_rating_style',
							'operator' => 'in',
							'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
						],	
					],	
				],	
			] );	
			
			// Site Rating - Maximum Rating Number
			$this->add_control(
				'_gpur_header_site_rating_max_rating_number',
				[
					'label' => esc_html__( 'Maximum Rating Number', 'gpur' ),
					'type' => \Elementor\Controls_Manager::HEADING,					
					'conditions' => [
						'relation' => 'or',
						'terms' => [
							[
								'name' => 'show_site_rating_text',
								'value' => '1',
							],
							[
								'name' => 'site_rating_style',
								'operator' => 'in',
								'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
							],	
						],	
					],
				]	
			);						
				$this->add_control(
					'show_site_rating_max_rating_number',
					[
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'label' => esc_html__( 'Display', 'gpur' ),				
						'return_value' => '1',
						'default' => '',					
						'conditions' => [
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'show_site_rating_text',
									'value' => '1',
								],
								[
									'name' => 'site_rating_style',
									'operator' => 'in',
									'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
								],	
							],	
						],
					]	
				);
				$this->add_control( 
					'site_rating_max_rating_number_color',
					[
						'label' => esc_html__( 'Color', 'gpur' ),
						'type' => \Elementor\Controls_Manager::COLOR,					
						'conditions' => [
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'show_site_rating_text',
									'value' => '1',
								],
								[
									'name' => 'site_rating_style',
									'operator' => 'in',
									'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
								],	
							],	
						],
						'selectors' => [
							'{{WRAPPER}} .gpur-site-rating .gpur-max-rating' => 'color: {{VALUE}};',
						],	
					]	
				);
				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'site_rating_max_rating_number_typography',
						'label' => esc_html__( 'Typography', 'gpur' ),
						'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_3,
						'default' => array(
							'font_weight' => '400',
						),			
						'conditions' => [
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'show_site_rating_text',
									'value' => '1',
								],
								[
									'name' => 'site_rating_style',
									'operator' => 'in',
									'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
								],	
							],	
						],
						'selector' => '{{WRAPPER}} .gpur-site-rating .gpur-max-rating',
					]
				);
				$this->add_control( 
					'site_rating_max_rating_number_extra_css',
					[
						'label' => esc_html__( 'Extra CSS', 'gpur' ),
						'label_block' => true,
						'type' => \Elementor\Controls_Manager::TEXT,					
						'conditions' => [
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'show_site_rating_text',
									'value' => '1',
								],
								[
									'name' => 'site_rating_style',
									'operator' => 'in',
									'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
								],	
							],	
						],
						'selectors' => [
							'{{WRAPPER}} .gpur-site-rating .gpur-max-rating' => '{{VALUE}}',
						],
					]	
				);			
					
			$this->add_control( '_gpur_divider_site_rating_criteria', [ 'type' => \Elementor\Controls_Manager::DIVIDER ] );		
						
			// Site Rating - Criteria
			$this->add_control(
				'_gpur_header_site_rating_criteria',
				[
					'label' => esc_html__( 'Criteria', 'gpur' ),
					'type' => \Elementor\Controls_Manager::HEADING,
				]
			);
				$this->add_control(
					'site_rating_criteria',
					[
						'label' => esc_html__( 'Criteria', 'gpur' ),					
						'description' => esc_html__( 'Enter each criterion on a new line or leave empty to display the average rating.', 'gpur' ),
						'type' => \Elementor\Controls_Manager::TEXTAREA,
					]
				);										
				$this->add_control( 
					'site_rating_criteria_title_color',
					[
						'label' => esc_html__( 'Text Color', 'gpur' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'condition' => [
							'site_rating_criteria!' => '',
						],
						'selectors' => [
							'{{WRAPPER}} .gpur-is-site-rating .gpur-criterion-title' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'site_rating_criteria_title_typography',
						'label' => esc_html__( 'Typography', 'gpur' ),
						'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_3,
						'default' => array(
							'font_weight' => '400',
						),
						'condition' => [
							'site_rating_criteria!' => '',
						],
						'selector' => '{{WRAPPER}} .gpur-is-site-rating .gpur-criterion-title',
					]
				);
						
				$this->add_control( 
					'site_rating_criteria_title_extra_css',
					[
						'label' => esc_html__( 'Text Extra CSS', 'gpur' ),
						'label_block' => true,
						'type' => \Elementor\Controls_Manager::TEXT,
						'condition' => [
							'site_rating_criteria!' => '',
						],
						'selectors' => [
							'{{WRAPPER}} .gpur-is-site-rating .gpur-criterion-title' => '{{VALUE}}',
						],
					]
				);
				
			$this->add_control( '_gpur_divider_site_rating_ranges_text', [ 'type' => \Elementor\Controls_Manager::DIVIDER ] );	
								
			// Site Rating - Ranges Text
			$this->add_control(
				'_gpur_header_site_rating_ranges_text',
				[
					'label' => esc_html__( 'Ranges Text', 'gpur' ),
					'type' => \Elementor\Controls_Manager::HEADING,
				]
			);	
				$this->add_control(
					'show_site_rating_ranges_text',
					[
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'label' => esc_html__( 'Display', 'gpur' ),
						'return_value' => '1',
						'default' => '',
					]	
				);							
				$this->add_control(
					'site_rating_ranges',
					[
						'label' => esc_html__( 'Rating Ranges', 'gpur' ),
						'label_block' => true,
						'description' => esc_html__( 'Set up your rating ranges in the follow way', 'gpur' ) . ' <code>' . esc_html__( 'Score 1-Score 2:Rating Text, Score 3-Score 4:Rating Text', 'gpur' ) . '</code>' . esc_html__( 'e.g.', 'gpur' ) . '<code>' . esc_html__( '0-2:Awful, 2.5-4:Bad, 4.5-6:Average, 6.5-8:Good, 8.5-10:Amazing', 'gpur' ) . '</code>',
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => '0-1.9:Awful, 2-2.9:Bad, 3-3.9:Average, 4-4.9:Good, 5-5:Amazing',
						'condition' => [
							'show_site_rating_ranges_text' => '1',
						],
					]
				);
				$this->add_control( 
					'site_rating_ranges_text_color',
					[
						'label' => esc_html__( 'Color', 'gpur' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'condition' => [
							'show_site_rating_ranges_text' => '1',
						],
						'selectors' => [
							'{{WRAPPER}} .gpur-is-site-rating .gpur-ranges-text' => 'color: {{VALUE}};',
						],
					]	
				);
				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'site_rating_ranges_typography',
						'label' => esc_html__( 'Typography', 'gpur' ),
						'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_3,
						'default' => array(
							'font_weight' => '400',
						),
						'condition' => [
							'show_site_rating_ranges_text' => '1',
						],
						'selector' => '{{WRAPPER}} .gpur-is-site-rating .gpur-ranges-text',
					]
				);
				$this->add_control( 
					'site_rating_ranges_text_extra_css',
					[
						'label' => esc_html__( 'Extra CSS', 'gpur' ),
						'label_block' => true,
						'type' => \Elementor\Controls_Manager::TEXT,
						'condition' => [
							'show_site_rating_ranges_text' => '1',
						],
						'selectors' => [
							'{{WRAPPER}} .gpur-is-site-rating .gpur-ranges-text' => '{{VALUE}}',
						],	
					]
				);			

				
		$this->end_controls_section();

		/*--------------------------------------------------------------
		User Rating
		--------------------------------------------------------------*/					
		
		$this->start_controls_section(
			'_gpur_section_user_rating',
			[
				'label' => esc_html__( 'User Rating', 'gpur' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);		

			// User Rating - Rating Controls		
			$this->add_control(
				'_gpur_header_user_rating_controls',
				[
					'label' => esc_html__( 'Rating Controls', 'gpur' ),
					'type' => \Elementor\Controls_Manager::HEADING,
				]
			);		
				$this->add_control(
					'user_rating_max_rating',
					[					
						'label' => esc_html__( 'Maximum Rating', 'gpur' ),
						'type' => \Elementor\Controls_Manager::NUMBER,
						'default' => '',
					]
				);	
				$this->add_control(
					'user_rating_decimal_places',
					[
						'label' => esc_html__( 'Decimal Places', 'gpur' ),
						'description' => esc_html__( 'The number of decimal places to show the rating to.', 'gpur' ),
						'type' => \Elementor\Controls_Manager::NUMBER,
						'default' => '',
					]
				);	
				$this->add_control(
					'user_rating_show_zero_rating',
					[
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'label' => esc_html__( 'Zero Ratings', 'gpur' ),
						'return_value' => '1',
						'default' => '1',
					]
				);
				
			$this->add_control( '_gpur_divider_user_rating_style', [ 'type' => \Elementor\Controls_Manager::DIVIDER ] );	
							
			// User Rating - Rating Style		
			$this->add_control(
				'_gpur_header_user_rating_style',
				[
					'label' => esc_html__( 'Rating Style', 'gpur' ),
					'type' => \Elementor\Controls_Manager::HEADING,
				]
			);	
											
				$this->add_control(
					'user_rating_style',
					[
						'label' => esc_html__( 'Style', 'gpur' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => array(
							'' => esc_html__( 'Default', 'gpur' ),
							'style-plain-singular' => esc_html__( 'Plain (Singular)', 'gpur' ),
							'style-squares-singular' => esc_html__( 'Squares (Singular)', 'gpur' ),
							'style-circles-singular' => esc_html__( 'Circles (Singular)', 'gpur' ),
							'style-gauge-circles-singular' => esc_html__( 'Gauge Circles (Singular)', 'gpur' ),
							'style-stars' => esc_html__( 'Stars', 'gpur' ),
							'style-hearts' => esc_html__( 'Hearts', 'gpur' ),
							'style-squares' => esc_html__( 'Squares', 'gpur' ),
							'style-circles' => esc_html__( 'Circles', 'gpur' ),
							'style-bars' => esc_html__( 'Bars', 'gpur' ),
							'style-icon' => esc_html__( 'Custom Icon', 'gpur' ),
							'style-image' => esc_html__( 'Custom Image', 'gpur' ),
						),
						'default' => '',
					]
				);				
				$this->add_control(
					'user_rating_position',
					[
						'label' => esc_html__( 'Position', 'gpur' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => array(
							'' => esc_html__( 'Default', 'gpur' ),
							'position-left' => esc_html__( 'Left', 'gpur' ),
							'position-center' => esc_html__( 'Center', 'gpur' ),
							'position-right' => esc_html__( 'Right', 'gpur' ),
						),
						'default' => '',
					]	
				);
				$this->add_control(
					'user_rating_text_position',
					[
						'label' => esc_html__( 'Rating Text Position', 'gpur' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => array(
							'' => esc_html__( 'Default', 'gpur' ),
							'position-text-top' => esc_html__( 'Top', 'gpur' ),
							'position-text-bottom' => esc_html__( 'Bottom', 'gpur' ),
							'position-text-left' => esc_html__( 'Left', 'gpur' ),
							'position-text-right' => esc_html__( 'Right', 'gpur' ),
						),
						'default' => '',
						'condition' => [
							'user_rating_style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
						],
				
					]	
				);						
				$this->add_control(
					'user_rating_image',
					[
						'label' => esc_html__( 'Custom Image', 'gpur' ),
						'description' => esc_html__( 'Your image should include the filled and empty icons. For an example see the', 'gpur' ) . ' <a href="' . GPUR_URL . 'public/images/default-rating-image.png" target="_blank">' . esc_html__( 'default image', 'gpur' ) . '</a>.',
						'type' => \Elementor\Controls_Manager::MEDIA,
						'condition' => [
							'user_rating_style' => 'style-image',
						],
						'selectors' => [
							'{{WRAPPER}} .gpur-style-image .gpur-symbol-empty, {{WRAPPER}} .gpur-style-image .gpur-symbol-filled' => 'background-image: url("{{URL}}");',
						],
					]
				);		
				$this->add_control(
					'user_rating_empty_icon',
					[
						'label' => esc_html__( 'Empty Icon', 'gpur' ),
						'type' => \Elementor\Controls_Manager::ICONS,
						'default' => [],
						'condition' => [
							'user_rating_style' => 'style-icon', 
						],
					]
				);	
				$this->add_control(
					'user_rating_empty_icon_color',
					[
						'label' => esc_html__( 'Empty Icon Color', 'gpur' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'condition' => [
							'user_rating_style' => array( 'style-stars', 'style-hearts', 'style-squares', 'style-circles', 'style-bars', 'style-icon' ), 
						],
						'selectors' => [
							'{{WRAPPER}} .gpur-is-user-rating .rating-symbol-background' => 'color: {{VALUE}};',
							'{{WRAPPER}} .gpur-is-user-rating.gpur-style-circles .gpur-symbol-empty, {{WRAPPER}} .gpur-is-user-rating.gpur-style-squares .gpur-symbol-empty, {{WRAPPER}} .gpur-is-user-rating.gpur-style-bars .gpur-symbol-empty' => 'background-color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'user_rating_filled_icon',
					[
						'label' => esc_html__( 'Filled Icon', 'gpur' ),
						'type' => \Elementor\Controls_Manager::ICONS,
						'default' => [],
						'condition' => [
							'user_rating_style' => 'style-icon', 
						],
					]	
				);
				$this->add_control(
					'user_rating_filled_icon_color',
					[
						'label' => esc_html__( 'Filled Icon Color', 'gpur' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'condition' => [
							'user_rating_style' => array( 'style-stars', 'style-hearts', 'style-squares', 'style-circles', 'style-bars', 'style-icon' ), 
						],
						'selectors' => [
							'{{WRAPPER}} .gpur-is-user-rating .rating-symbol-foreground' => 'color: {{VALUE}};',
							'{{WRAPPER}} .gpur-is-user-rating.gpur-style-circles .gpur-symbol-filled, {{WRAPPER}} .gpur-is-user-rating.gpur-style-squares .gpur-symbol-filled, {{WRAPPER}} .gpur-is-user-rating.gpur-style-bars .gpur-symbol-filled' => 'background-color: {{VALUE}};',
						],
					]	
				);		
				$this->add_control(
					'user_rating_icon_width',
					[
						'label' => esc_html__( 'Width', 'gpur' ),
						'type' => \Elementor\Controls_Manager::SLIDER,
						'size_units' => [ 'px', '%', 'em' ],
						'range' => [
							'px' => [
								'min' => 1,
								'max' => 1000,
								'step' => 1,
							],	
							'%' => [
								'min' => 1,
								'max' => 1000,
								'step' => 1,
							],	
						],	
						'default' => [
							'unit' => 'px',
							'size' => '',
						],
						'condition' => [
							'user_rating_style' => array( 'style-stars', 'style-hearts', 'style-squares', 'style-circles', 'style-icon', 'style-image' ), 
						],
						'selectors' => [
							'{{WRAPPER}} .gpur-is-user-rating .rating-symbol' => 'font-size: {{SIZE}}{{UNIT}};',
							'{{WRAPPER}} .gpur-is-user-rating .gpur-style-circles .gpur-symbol, {{WRAPPER}} .gpur-is-user-rating .gpur-style-squares .gpur-symbol, .gpur-style-image .gpur-symbol' => 'width: {{SIZE}}{{UNIT}};',
						],	
					]	
				);
				$this->add_control(
					'user_rating_icon_height',
					[
						'label' => esc_html__( 'Height', 'gpur' ),
						'type' => \Elementor\Controls_Manager::SLIDER,
						'size_units' => [ 'px', '%', 'em' ],
						'range' => [
							'px' => [
								'min' => 1,
								'max' => 1000,
								'step' => 1,
							],	
							'%' => [
								'min' => 1,
								'max' => 1000,
								'step' => 1,
							],	
						],	
						'default' => [
							'unit' => 'px',
							'size' => '',
						],
						'condition' => [
							'user_rating_style' => array( 'style-squares', 'style-circles', 'style-bars', 'style-icon', 'style-image' ),
						],
						'selectors' => [
							'{{WRAPPER}} .gpur-is-user-rating .gpur-style-bars .gpur-symbol, {{WRAPPER}} .gpur-is-user-rating .gpur-style-circles .gpur-symbol, {{WRAPPER}} .gpur-is-user-rating .gpur-style-squares .gpur-symbol, .gpur-style-image .gpur-symbol' => 'height: {{SIZE}}{{UNIT}};',
						],	
					]	
				);
				
			$this->add_control( '_gpur_divider_user_rating_container', [ 
				'type' => \Elementor\Controls_Manager::DIVIDER,
				'condition' => [
					'user_rating_style' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
				],
			] );
			
			// User Rating - Rating Container								
			$this->add_control(
				'_gpur_header_user_rating_container',
				[
					'label' => esc_html__( 'Rating Container', 'gpur' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'condition' => [
						'user_rating_style' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
					],
				]	
			);
				$this->add_control(
					'user_rating_container_width',
					[
						'label' => esc_html__( 'Width', 'gpur' ),
						'type' => \Elementor\Controls_Manager::SLIDER,
						'size_units' => [ 'px', '%', 'em' ],
						'range' => [
							'px' => [
								'min' => 1,
								'max' => 1000,
								'step' => 1,
							],	
							'%' => [
								'min' => 1,
								'max' => 1000,
								'step' => 1,
							],	
						],	
						'default' => [
							'unit' => 'px',
							'size' => '',
						],
						'condition' => [
							'user_rating_style' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
						],
						'selectors' => [
							'{{WRAPPER}} .gpur-is-user-rating .gpur-rating-outer' => 'width: {{SIZE}}{{UNIT}};',
							'{{WRAPPER}} .gpur-is-user-rating .gpur-small-rating .gpur-gauge-1' => 'clip: rect(0, {{SIZE}}{{UNIT}}, {{SIZE}}{{UNIT}}, calc({{SIZE}}{{UNIT}}/2));',
							'{{WRAPPER}} .gpur-is-user-rating .gpur-small-rating .gpur-gauge-2' => 'clip: rect(0, calc({{SIZE}}{{UNIT}}/2), {{SIZE}}{{UNIT}}, 0);',
						],
					]	
				);
				$this->add_control(
					'user_rating_container_height',
					[
						'label' => esc_html__( 'Height', 'gpur' ),
						'type' => \Elementor\Controls_Manager::SLIDER,
						'size_units' => [ 'px', '%', 'em' ],
						'range' => [
							'px' => [
								'min' => 1,
								'max' => 1000,
								'step' => 1,
							],	
							'%' => [
								'min' => 1,
								'max' => 1000,
								'step' => 1,
							],	
						],	
						'default' => [
							'unit' => 'px',
							'size' => '',
						],
						'condition' => [
							'user_rating_style' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
						],
						'selectors' => [
							'{{WRAPPER}} .gpur-is-user-rating .gpur-rating-outer' => 'height: {{SIZE}}{{UNIT}};',
						],
					]	
				);
				$this->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					[
						'name' => 'user_rating_container_background',
						'condition' => [
							'user_rating_style' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
						],						
						'selector' => '{{WRAPPER}} .gpur-is-user-rating .gpur-rating-inner',
					]
				);
				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'user_rating_container_border',
						'label' => esc_html__( 'Border', 'gpur' ),
						'condition' => [
							'user_rating_style' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
						],
						'selector' => '{{WRAPPER}} .gpur-is-user-rating .gpur-rating-inner',
					]
				);	
				$this->add_control(
					'user_rating_container_extra_css',
					[
						'label' => esc_html__( 'Extra CSS', 'gpur' ),
						'label_block' => true,
						'type' => \Elementor\Controls_Manager::TEXT,
						'condition' => [
							'user_rating_style' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
						],						
						'selectors' => [
							'{{WRAPPER}} .gpur-is-user-rating .gpur-rating-outer' => '{{VALUE}}',
						],
					]	
				);	
				
			$this->add_control( '_gpur_divider_user_rating_gauge', [ 
				'type' => \Elementor\Controls_Manager::DIVIDER, 
				'condition' => [
					'user_rating_style' => 'style-gauge-circles-singular', 
				],
			] );
							
			// User Rating - Gauge				
			$this->add_control( 
				'_gpur_header_user_rating_gauge',
				[
					'label' => esc_html__( 'Gauge', 'gpur' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'condition' => [
						'user_rating_style' => 'style-gauge-circles-singular', 
					],
				]	
			);
				$this->add_control(
					'user_rating_gauge_width',
					[
						'label' => esc_html__( 'Width', 'gpur' ),
						'type' => \Elementor\Controls_Manager::SLIDER,
						'size_units' => [ 'px', '%', 'em' ],
						'range' => [
							'px' => [
								'min' => 1,
								'max' => 1000,
								'step' => 1,
							],	
							'%' => [
								'min' => 1,
								'max' => 1000,
								'step' => 1,
							],	
						],	
						'default' => [
							'unit' => 'px',
							'size' => '',
						],
						'condition' => [
							'user_rating_style' => 'style-gauge-circles-singular', 
						],
						'selectors' => [
							'{{WRAPPER}} .gpur-is-user-rating.gpur-style-gauge-circles-singular .gpur-rating-inner' => 'top: {{SIZE}}{{UNIT}}; right: {{SIZE}}{{UNIT}}; bottom: {{SIZE}}{{UNIT}}; left: {{SIZE}}{{UNIT}};',
						],
					]	
				);
				$this->add_control( 
					'user_rating_gauge_filled_color_1',
					[
						'label' => esc_html__( 'Filled Color 1', 'gpur' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'condition' => [
							'user_rating_style' => 'style-gauge-circles-singular', 
						],
					]	
				);
				$this->add_control( 
					'user_rating_gauge_filled_color_2',
					[
						'label' => esc_html__( 'Filled Color 2', 'gpur' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'condition' => [
							'user_rating_style' => 'style-gauge-circles-singular',
						],
					]
				);
				$this->add_control( 
					'user_rating_gauge_empty_color',
					[
						'label' => esc_html__( 'Empty Color', 'gpur' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'condition' => [
							'user_rating_style' => 'style-gauge-circles-singular', 
						],
						'selectors' => [
							'{{WRAPPER}} .gpur-is-user-rating.gpur-style-gauge-circles-singular .gpur-rating-outer' => 'background: {{VALUE}};',
						],
					]
				);	
				
			$this->add_control( '_gpur_divider_user_rating_text', [ 'type' => \Elementor\Controls_Manager::DIVIDER ] );	

			// User Rating - User Rating Text
			$this->start_controls_tabs( '_gpur_tabs_user_rating_text' );

				// User Rating - Average User Rating Text
				$this->start_controls_tab(
					'_gpur_tab_avg_user_rating_text',
					[
						'label' => esc_html__( 'Average User Rating', 'gpur' ),
					]
				);
					$this->add_control(
						'show_avg_user_rating_text',
						[
							'type' => \Elementor\Controls_Manager::SWITCHER,
							'label' => esc_html__( 'Display', 'gpur' ),
							'return_value' => '1',
							'default' => '',
							'condition' => [
								'user_rating_style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
							],
						]
					);
											
					$this->add_control( '_gpur_divider_avg_user_rating_label', [ 
						'type' => \Elementor\Controls_Manager::DIVIDER, 					
						'condition' => [
							'show_avg_user_rating_text' => '1',
							'user_rating_style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
						],
					] );	
				
					// User Rating - Average User Rating - Label
					$this->add_control(
						'_gpur_header_avg_user_rating_label',
						[
							'label' => esc_html__( 'Label', 'gpur' ),
							'type' => \Elementor\Controls_Manager::HEADING,
							'condition' => [
								'show_avg_user_rating_text' => '1',
								'user_rating_style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
							],
						]	
					);						
						$this->add_control( 
							'avg_user_rating_label',
							[
								'label' => esc_html__( 'Label', 'gpur' ),
								'label_block' => true,
								'type' => \Elementor\Controls_Manager::TEXT,
								'default' => esc_html__( 'Average User Rating:', 'gpur' ),
								'condition' => [
									'show_avg_user_rating_text' => '1',
									'user_rating_style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
								],
							]	
						);	
						$this->add_control( 
							'avg_user_rating_label_color',
							[
								'label' => esc_html__( 'Text Color', 'gpur' ),
								'type' => \Elementor\Controls_Manager::COLOR,
								'condition' => [
									'show_avg_user_rating_text' => '1',
									'user_rating_style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
								],
								'selectors' => [
									'{{WRAPPER}} .gpur-avg-user-rating-label' => 'color: {{VALUE}};',
								],
							]
						);
						$this->add_group_control(
							\Elementor\Group_Control_Typography::get_type(),
							[
								'name' => 'avg_user_rating_label_typography',
								'label' => esc_html__( 'Typography', 'gpur' ),
								'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_3,
								'default' => array(
									'font_weight' => '400',
								),
								'condition' => [
									'show_avg_user_rating_text' => '1',
									'user_rating_style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
								],
								'selector' => '{{WRAPPER}} .gpur-avg-user-rating-label',
							]
						);		
						$this->add_control( 
							'avg_user_rating_label_extra_css',
							[
								'label' => esc_html__( 'Extra CSS', 'gpur' ),
								'label_block' => true,
								'type' => \Elementor\Controls_Manager::TEXT,
								'condition' => [
									'show_avg_user_rating_text' => '1',
									'user_rating_style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
								],
								'selectors' => [
									'{{WRAPPER}} .gpur-avg-user-rating-label' => '{{VALUE}}',
								],
							]
						);	

					$this->add_control( '_gpur_divider_avg_user_rating_number', [ 
						'type' => \Elementor\Controls_Manager::DIVIDER, 							
						'conditions' => [
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'show_avg_user_rating_text',
									'value' => '1',
								],
								[
									'name' => 'user_rating_style',
									'operator' => 'in',
									'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
								],	
							],
						]
					] );		

					// User Rating - Average User Rating - Rating Number
					$this->add_control(
						'_gpur_header_avg_user_rating_number',
						[
							'label' => esc_html__( 'Rating Number', 'gpur' ),
							'type' => \Elementor\Controls_Manager::HEADING,
							'conditions' => [
								'relation' => 'or',
								'terms' => [
									[
										'name' => 'show_avg_user_rating_text',
										'value' => '1',
									],
									[
										'name' => 'user_rating_style',
										'operator' => 'in',
										'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
									],	
								],
							]
						]	
					);
						$this->add_control( 
							'avg_user_rating_number_color',
							[
								'label' => esc_html__( 'Text Color', 'gpur' ),	
								'type' => \Elementor\Controls_Manager::COLOR,
								'selectors' => [
									'{{WRAPPER}} .gpur-avg-user-rating .gpur-rating-value' => 'color: {{VALUE}};',
								],
							]
						);
						$this->add_group_control(
							\Elementor\Group_Control_Typography::get_type(),
							[
								'name' => 'avg_user_rating_number_typography',
								'label' => esc_html__( 'Typography', 'gpur' ),
								'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_3,
								'default' => array(
									'font_weight' => '400',
								),
								'selector' => '{{WRAPPER}} .gpur-avg-user-rating .gpur-rating-value',							
								'conditions' => [
									'relation' => 'or',
									'terms' => [
										[
											'name' => 'show_avg_user_rating_text',
											'value' => '1',
										],
										[
											'name' => 'user_rating_style',
											'operator' => 'in',
											'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
										],	
									],
								]
							]
						);
						$this->add_control( 
							'avg_user_rating_number_extra_css',
							[
								'label' => esc_html__( 'Extra CSS', 'gpur' ),
								'label_block' => true,
								'type' => \Elementor\Controls_Manager::TEXT,
								'selectors' => [
									'{{WRAPPER}} .gpur-avg-user-rating .gpur-rating-value' => '{{VALUE}}',
								],							
								'conditions' => [
									'relation' => 'or',
									'terms' => [
										[
											'name' => 'show_avg_user_rating_text',
											'value' => '1',
										],
										[
											'name' => 'user_rating_style',
											'operator' => 'in',
											'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
										],	
									],
								]
							]	
						);
						
					$this->add_control( '_gpur_divider_avg_user_max_rating_number', [ 
						'type' => \Elementor\Controls_Manager::DIVIDER,							
						'conditions' => [
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'show_avg_user_rating_text',
									'value' => '1',
								],
								[
									'name' => 'user_rating_style',
									'operator' => 'in',
									'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
								],	
							],
						] 
					] );	

					// User Rating - Average User Rating - Maximum Rating Number
					$this->add_control(
						'_gpur_header_avg_user_rating_max_rating_number',
						[
							'label' => esc_html__( 'Maximum Rating Number', 'gpur' ),
							'type' => \Elementor\Controls_Manager::HEADING,							
							'conditions' => [
								'relation' => 'or',
								'terms' => [
									[
										'name' => 'show_avg_user_rating_text',
										'value' => '1',
									],
									[
										'name' => 'user_rating_style',
										'operator' => 'in',
										'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
									],	
								],
							]
						]	
					);						
						$this->add_control(
							'show_avg_user_rating_max_rating_number',
							[
								'type' => \Elementor\Controls_Manager::SWITCHER,
								'label' => esc_html__( 'Display', 'gpur' ),				
								'return_value' => '1',
								'default' => '',							
								'conditions' => [
									'relation' => 'or',
									'terms' => [
										[
											'name' => 'show_avg_user_rating_text',
											'value' => '1',
										],
										[
											'name' => 'user_rating_style',
											'operator' => 'in',
											'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
										],	
									],
								]
							]	
						);
						$this->add_control( 
							'avg_user_rating_max_rating_number_color',
							[
								'label' => esc_html__( 'Color', 'gpur' ),
								'type' => \Elementor\Controls_Manager::COLOR,					
								'condition' => [
									'show_avg_user_rating_max_rating_number' => '1',
								],
								'selectors' => [
									'{{WRAPPER}} .gpur-avg-user-rating .gpur-max-rating' => 'color: {{VALUE}};',
								],	
							]	
						);
						$this->add_group_control(
							\Elementor\Group_Control_Typography::get_type(),
							[
								'name' => 'avg_user_rating_max_rating_number_typography',
								'label' => esc_html__( 'Typography', 'gpur' ),
								'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_3,		
								'default' => array(
									'font_weight' => '400',
								),			
								'condition' => [
									'show_avg_user_rating_max_rating_number' => '1',
								],
								'selector' => '{{WRAPPER}} .gpur-avg-user-rating .gpur-max-rating',
							]
						);
						$this->add_control( 
							'avg_user_rating_max_rating_number_extra_css',
							[
								'label' => esc_html__( 'Extra CSS', 'gpur' ),
								'label_block' => true,
								'type' => \Elementor\Controls_Manager::TEXT,					
								'condition' => [
									'show_avg_user_rating_max_rating_number' => '1',	
								],
								'selectors' => [
									'{{WRAPPER}} .gpur-avg-user-rating .gpur-max-rating' => '{{VALUE}}',
								],	
							]	
						);						

				$this->end_controls_tab();		

				// User Rating - User Votes Text
				$this->start_controls_tab(
					'_gpur_tab_user_votes_text',
					[
						'label' => esc_html__( 'User Votes', 'gpur' ),
					]
				);
			
					$this->add_control(
						'show_user_votes_text',
						[
							'type' => \Elementor\Controls_Manager::SWITCHER,
							'label' => esc_html__( 'Display', 'gpur' ),
							'return_value' => '1',
							'default' => '',
						]
					);

					$this->add_control( 
						'singular_vote_label',
						[
							'label' => esc_html__( 'Label (Singular)', 'gpur' ),
							'type' => \Elementor\Controls_Manager::TEXT,
							'default' => esc_html__( 'vote', 'gpur' ),
							'condition' => [
								'show_user_votes_text' => '1',
							],
						]	
					);
							
					$this->add_control( 
						'plural_vote_label',
						[
							'label' => esc_html__( 'Label (Plural)', 'gpur' ),
							'type' => \Elementor\Controls_Manager::TEXT,
							'default' => esc_html__( 'votes', 'gpur' ),
							'condition' => [
								'show_user_votes_text' => '1',
							],
						]
					);
			
					$this->add_control( 
						'user_votes_text_color',
						[
							'label' => esc_html__( 'Text Color', 'gpur' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'condition' => [
								'show_user_votes_text' => '1',
							],
							'selectors' => [
								'{{WRAPPER}} .gpur-user-votes' => 'color: {{VALUE}};',
							],
						]	
					);

					$this->add_group_control(
						\Elementor\Group_Control_Typography::get_type(),
						[
							'name' => 'user_votes_text_typography',
							'label' => esc_html__( 'Typography', 'gpur' ),
							'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_3,
							'default' => array(
								'font_weight' => '400',
							),
							'condition' => [
								'show_user_votes_text' => '1',
							],
							'selector' => '{{WRAPPER}} .gpur-user-votes',
						]
					);
						
					$this->add_control( 
						'user_votes_text_extra_css',
						[
							'label' => esc_html__( 'Extra CSS', 'gpur' ),
							'label_block' => true,
							'type' => \Elementor\Controls_Manager::TEXT,
							'condition' => [
								'show_user_votes_text' => '1',
							],
							'selectors' => [
								'{{WRAPPER}} .gpur-user-votes' => '{{VALUE}}',
							],
						]	
					);		
			
				$this->end_controls_tab();	

				// User Rating - Individual User Rating Text
				$this->start_controls_tab(
					'_gpur_tab_ind_user_rating_text',
					[
						'label' => esc_html__( 'Individual User Rating', 'gpur' ),
						'condition' => [
							'user_rating_style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
						],
					]
				);
					$this->add_control(
						'show_ind_user_rating_text',
						[
							'type' => \Elementor\Controls_Manager::SWITCHER,
							'label' => esc_html__( 'Display', 'gpur' ),
							'return_value' => '1',
							'default' => '',
							'condition' => [
								'user_rating_style' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
							],
						]
					);
					
					$this->add_control( '_gpur_divider_ind_user_rating_label', [ 
						'type' => \Elementor\Controls_Manager::DIVIDER,		
						'condition' => [
							'show_ind_user_rating_text' => '1',
						], 
					] );	

					// Individual User Rating - Label
					$this->add_control(
						'_gpur_header_ind_user_rating_label',
						[
							'label' => esc_html__( 'Label', 'gpur' ),
							'type' => \Elementor\Controls_Manager::HEADING,
							'condition' => [
								'show_ind_user_rating_text' => '1',
							],
						]	
					);										
						$this->add_control( 
							//formely'your_user_rating_label',
							'ind_user_rating_label',
							[
								'label' => esc_html__( 'Label', 'gpur' ),
								'label_block' => true,
								'type' => \Elementor\Controls_Manager::TEXT,
								'default' => esc_html__( 'Your Rating:', 'gpur' ),
								'condition' => [
									'show_ind_user_rating_text' => '1',
								],
							]	
						);			
						$this->add_control(
							'ind_user_rating_label_color',
							[
								'label' => esc_html__( 'Text Color', 'gpur' ),
								'type' => \Elementor\Controls_Manager::COLOR,
								'condition' => [
									'show_ind_user_rating_text' => '1',
								],
								'selectors' => [
									'{{WRAPPER}} .gpur-ind-user-rating-label' => 'color: {{VALUE}};',
								],
							]	
						);	
						$this->add_group_control(
							\Elementor\Group_Control_Typography::get_type(),
							[
								'name' => 'ind_user_rating_label_typography',
								'label' => esc_html__( 'Typography', 'gpur' ),
								'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_3,
								'default' => array(
									'font_weight' => '400',
								),
								'condition' => [
									'show_ind_user_rating_text' => '1',
								],
								'selector' => '{{WRAPPER}} .gpur-ind-user-rating-label',
							]
						);			
						$this->add_control(
							'ind_user_rating_label_extra_css',
							[
								'label' => esc_html__( 'Extra CSS', 'gpur' ),
								'label_block' => true,
								'type' => \Elementor\Controls_Manager::TEXT,
								'condition' => [
									'show_ind_user_rating_text' => '1',
								],
								'selectors' => [
									'{{WRAPPER}} .gpur-ind-user-rating-label' => '{{VALUE}}',
								],
							]	
						);
					
					$this->add_control( '_gpur_divider_ind_user_rating_number', [ 
						'type' => \Elementor\Controls_Manager::DIVIDER,
						'condition' => [
							'show_ind_user_rating_text' => '1',
						], 
					] );	
			
					// User Rating - Individual User Rating - Rating Number
					$this->add_control(
						'_gpur_header_ind_user_rating_number',
						[
							'label' => esc_html__( 'Rating Number', 'gpur' ),
							'type' => \Elementor\Controls_Manager::HEADING,
							'condition' => [
								'show_ind_user_rating_text' => '1',
							],
						]	
					);
						$this->add_control( 
							'ind_user_rating_number_color',
							[
								'label' => esc_html__( 'Text Color', 'gpur' ),	
								'type' => \Elementor\Controls_Manager::COLOR,
								'condition' => [
									'show_ind_user_rating_text' => '1',
								],
								'selectors' => [
									'{{WRAPPER}} .gpur-ind-user-rating .gpur-rating-value' => 'color: {{VALUE}};',
								],
							]
						);
						$this->add_group_control(
							\Elementor\Group_Control_Typography::get_type(),
							[
								'name' => 'ind_user_rating_number_typography',
								'label' => esc_html__( 'Typography', 'gpur' ),
								'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_3,
								'default' => array(
									'font_weight' => '400',
								),
								'condition' => [
									'show_ind_user_rating_text' => '1',
								],
								'selector' => '{{WRAPPER}} .gpur-ind-user-rating .gpur-rating-value',
							]
						);
						$this->add_control( 
							'ind_user_rating_number_extra_css',
							[
								'label' => esc_html__( 'Extra CSS', 'gpur' ),
								'label_block' => true,
								'type' => \Elementor\Controls_Manager::TEXT,
								'condition' => [
									'show_ind_user_rating_text' => '1',
								],
								'selectors' => [
									'{{WRAPPER}} .gpur-ind-user-rating .gpur-rating-value' => '{{VALUE}}',
								],
							]	
						);

					$this->add_control( '_gpur_divider_ind_user_rating_max_rating_number', [ 
						'type' => \Elementor\Controls_Manager::DIVIDER, 					
						'condition' => [
							'show_ind_user_rating_text' => '1',
						],
					] );	
					
					// User Rating - Individual User Rating - Maximum Rating Number
					$this->add_control(
						'_gpur_header_ind_user_rating_max_rating_number',
						[
							'label' => esc_html__( 'Maximum Rating Number', 'gpur' ),
							'type' => \Elementor\Controls_Manager::HEADING,
							'condition' => [
								'show_ind_user_rating_text' => '1',
							],
						]	
					);						
						$this->add_control(
							'show_ind_user_rating_max_rating_number',
							[
								'type' => \Elementor\Controls_Manager::SWITCHER,
								'label' => esc_html__( 'Display', 'gpur' ),				
								'return_value' => '1',
								'default' => '',
								'condition' => [
									'show_ind_user_rating_text' => '1',
								],
							]	
						);
						$this->add_control( 
							'ind_user_rating_max_rating_number_color',
							[
								'label' => esc_html__( 'Color', 'gpur' ),
								'type' => \Elementor\Controls_Manager::COLOR,					
								'condition' => [
									'show_ind_user_rating_max_rating_number' => '1',
								],
								'selectors' => [
									'{{WRAPPER}} .gpur-ind-user-rating .gpur-max-rating' => 'color: {{VALUE}};',
								],	
							]	
						);
						$this->add_group_control(
							\Elementor\Group_Control_Typography::get_type(),
							[
								'name' => 'ind_user_rating_max_rating_number_typography',
								'label' => esc_html__( 'Typography', 'gpur' ),
								'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_3,	
								'default' => array(
									'font_weight' => '400',
								),				
								'condition' => [
									'show_ind_user_rating_max_rating_number' => '1',
								],
								'selector' => '{{WRAPPER}} .gpur-ind-user-rating .gpur-max-rating',
							]
						);
						$this->add_control( 
							'ind_user_rating_max_rating_number_extra_css',
							[
								'label' => esc_html__( 'Extra CSS', 'gpur' ),
								'label_block' => true,
								'type' => \Elementor\Controls_Manager::TEXT,					
								'condition' => [
									'show_ind_user_rating_max_rating_number' => '1',	
								],
								'selectors' => [
									'{{WRAPPER}} .gpur-ind-user-rating .gpur-max-rating' => '{{VALUE}}',
								],
							]	
						);
				
				$this->end_controls_tab();		
					
			$this->end_controls_tabs();			
			
			$this->add_control( '_gpur_divider_user_rating_criteria', [ 'type' => \Elementor\Controls_Manager::DIVIDER ] );	
			
			// User Rating - Criteria
			$this->add_control(
				'_gpur_header_user_rating_criteria',
				[
					'label' => esc_html__( 'Criteria', 'gpur' ),
					'type' => \Elementor\Controls_Manager::HEADING,
				]
			);
				$this->add_control(
					'user_rating_criteria',
					[
						'label' => esc_html__( 'Criteria', 'gpur' ),					
						'description' => esc_html__( 'Enter each criterion on a new line or leave empty to display the average rating.', 'gpur' ),
						'type' => \Elementor\Controls_Manager::TEXTAREA,
					]
				);										
				$this->add_control( 
					'user_rating_criteria_title_color',
					[
						'label' => esc_html__( 'Text Color', 'gpur' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'condition' => [
							'user_rating_criteria!' => '',
						],
						'selectors' => [
							'{{WRAPPER}} .gpur-is-user-rating .gpur-criterion-title' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'user_rating_criteria_title_typography',
						'label' => esc_html__( 'Typography', 'gpur' ),
						'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_3,
						'default' => array(
							'font_weight' => '400',
						),
						'condition' => [
							'user_rating_criteria!' => '',
						],
						'selector' => '{{WRAPPER}} .gpur-is-user-rating .gpur-criterion-title',
					]
				);		
				$this->add_control( 
					'user_rating_criteria_title_extra_css',
					[
						'label' => esc_html__( 'Text Extra CSS', 'gpur' ),
						'label_block' => true,
						'type' => \Elementor\Controls_Manager::TEXT,
						'condition' => [
							'user_rating_criteria!' => '',
						],
						'selectors' => [
							'{{WRAPPER}} .gpur-is-user-rating .gpur-criterion-title' => '{{VALUE}}',
						],
					]
				);	

			$this->add_control( '_gpur_divider_user_rating_ranges_text', [ 'type' => \Elementor\Controls_Manager::DIVIDER ] );	
						
			// User Rating - Ranges Text
			$this->add_control(
				'_gpur_header_user_rating_ranges_text',
				[
					'label' => esc_html__( 'Ranges Text', 'gpur' ),
					'type' => \Elementor\Controls_Manager::HEADING,
				]
			);	
				$this->add_control(
					'show_user_rating_ranges_text',
					[
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'label' => esc_html__( 'Display', 'gpur' ),
						'return_value' => '1',
						'default' => '',
					]	
				);							
				$this->add_control(
					'user_rating_ranges',
					[
						'label' => esc_html__( 'Rating Ranges', 'gpur' ),
						'label_block' => true,
						'description' => esc_html__( 'Set up your rating ranges in the follow way', 'gpur' ) . ' <code>' . esc_html__( 'Score 1-Score 2:Rating Text, Score 3-Score 4:Rating Text', 'gpur' ) . '</code>' . esc_html__( 'e.g.', 'gpur' ) . '<code>' . esc_html__( '0-2:Awful, 2.5-4:Bad, 4.5-6:Average, 6.5-8:Good, 8.5-10:Amazing', 'gpur' ) . '</code>',
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => '',
						'condition' => [
							'show_user_rating_ranges_text' => '1',
						],
					]
				);
				$this->add_control( 
					'user_rating_ranges_text_color',
					[
						'label' => esc_html__( 'Color', 'gpur' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'condition' => [
							'show_user_rating_ranges_text' => '1',
						],
						'selectors' => [
							'{{WRAPPER}} .gpur-is-user-rating .gpur-ranges-text' => 'color: {{VALUE}};',
						],
					]	
				);
				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'user_rating_ranges_typography',
						'label' => esc_html__( 'Typography', 'gpur' ),
						'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_3,
						'default' => array(
							'font_weight' => '400',
						),
						'condition' => [
							'show_user_rating_ranges_text' => '1',
						],
						'selector' => '{{WRAPPER}} .gpur-is-user-rating .gpur-ranges-text',
					]
				);
				$this->add_control( 
					'user_rating_ranges_text_extra_css',
					[
						'label' => esc_html__( 'Extra CSS', 'gpur' ),
						'label_block' => true,
						'type' => \Elementor\Controls_Manager::TEXT,
						'condition' => [
							'show_user_rating_ranges_text' => '1',
						],
						'selectors' => [
							'{{WRAPPER}} .gpur-is-user-rating .gpur-ranges-text' => '{{VALUE}}',
						],	
					]
				);			
		
		$this->end_controls_section();	
				
	}

	protected function render() {
		
		$atts = $this->get_settings_for_display();
		extract( $atts );
		
		// Load template
		echo gpur_reviews_list_template( array( 'builder' => 'elementor', 'atts' => $atts ) );
		
	}
		
}