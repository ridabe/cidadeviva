<?php 

/**
 * Options
 *
 */
if ( ! function_exists( 'gpur_wpb_reviews_list_options' ) ) {
	function gpur_wpb_reviews_list_options() { 
		
		vc_map( array( 
			'name' => esc_html__( 'Review List', 'gpur' ),
			'base' => 'gpur_reviews_list',
			'description' => '',
			'class' => 'gpur-wpb-reviews-list',
			'controls' => 'full',
			'icon' => 'gpur-icon-reviews-list',
			'category' => esc_html__( 'Review', 'gpur' ),
			'params' => array(
		
				/*--------------------------------------------------------------
				Display
				--------------------------------------------------------------*/
					
				array( 
					'heading' => esc_html__( 'Title', 'gpur' ),
					'param_name' => 'title',
					'type' => 'textfield',
					'admin_label' => true,
					'value' => '',
				),	
				
				array( 
					'heading' => esc_html__( 'Post Types', 'gpur' ),
					'param_name' => 'post_types',
					'type' => 'posttypes',
					'std' => 'post',
				),
						
				array( 
					'heading' => esc_html__( 'Post/Page IDs', 'gpur' ),
					'description' => esc_html__( 'Enter the post/pages IDs you want to show - separate IDs with a comma e.g. 123, 456, 789', 'gpur' ),
					'param_name' => 'ids',
					'type' => 'textfield',
				),	
						
				array( 
					'heading' => esc_html__( 'Categories', 'gpur' ),
					'description' => esc_html__( 'Enter the category slugs you want to display posts from - separate slugs with a comma e.g. category-1, category-2, category-3', 'gpur' ),
					'param_name' => 'cats',
					'type' => 'textfield',
				),
					
				array( 
					'heading' => esc_html__( 'Tags', 'gpur' ),
					'description' => esc_html__( 'Enter the tag slugs you want to display posts from - separate slugs with a comma e.g. tag-1, tag-2, tag-3', 'gpur' ),
					'param_name' => 'tags',
					'type' => 'textfield',
				),							
					
				array( 
					'heading' => esc_html__( 'Current Taxonomy', 'gpur' ),
					'description' => esc_html__( 'Only show posts from the current category/tag.', 'gpur' ),
					'param_name' => 'current_tax',
					'type' => 'checkbox',
				),	
							
				array( 
					'heading' => esc_html__( 'Sort', 'gpur' ),
					'param_name' => 'sort',
					'value' => array(
						esc_html__( 'Most Recent', 'gpur' ) => 'post-date-desc',
						esc_html__( 'Alphabetical (A-Z)', 'gpur' ) => 'post-title-asc',
						esc_html__( 'Alphabetical (Z-A)', 'gpur' ) => 'post-title-desc',
						esc_html__( 'Highest Site Rated', 'gpur' ) => 'site-rating-desc',
						esc_html__( 'Lowest Site Rated', 'gpur' ) => 'site-rating-asc',
						esc_html__( 'Highest User Rated', 'gpur' ) => 'user-rating-desc',
						esc_html__( 'Lowest User Rated', 'gpur' ) => 'user-rating-asc',
						esc_html__( 'Most User Votes', 'gpur' ) => 'user-votes-desc',
						esc_html__( 'Most Likes', 'gpur' ) => 'likes-desc',
						esc_html__( 'Random', 'gpur' ) => 'random',
						esc_html__( 'Post/Page Order', 'gpur' ) => 'post-page-order',	
					),
					'type' => 'dropdown',
				),	
				
				array( 
					'heading' => esc_html__( 'Number', 'gpur' ),
					'param_name' => 'number',
					'type' => 'textfield',
					'value' => '5',
				),						
					
				array( 
					'heading' => esc_html__( 'Exclude Current Item', 'gpur' ),
					'description' => esc_html__( 'Exclude the current post/page from showing in the review list.', 'gpur' ),
					'param_name' => 'exclude_current_item',
					'type' => 'checkbox',
					'value' => array( esc_html__( 'Yes', 'gpur' ) => 1 ),
					'std' => '',
				),		
				
				array( 
					'heading' => esc_html__( 'Rating Range', 'gpur' ),
					'description' => esc_html__( 'Only display ratings within this range e.g. 1.0-3.5', 'gpur' ),
					'param_name' => 'rating_range',
					'type' => 'textfield',
					'value' => '',
				),							
					
				/*--------------------------------------------------------------
				Posts
				--------------------------------------------------------------*/						

				array( 
					'heading' => esc_html__( 'Format', 'gpur' ),
					'param_name' => 'post_format',
					'value' => array(
						esc_html__( 'List', 'gpur' ) => 'gpur-format-list',
						esc_html__( '2 Columns', 'gpur' ) => 'gpur-format-columns-2', 
						esc_html__( '3 Columns', 'gpur' ) => 'gpur-format-columns-3', 
						esc_html__( '4 Columns', 'gpur' ) => 'gpur-format-columns-4',
					),
					'type' => 'dropdown',
					'group' => esc_html__( 'Posts', 'gpur' ),
				),
								
				array( 
					'param_name' => 'meta_header',
					'heading' => esc_html__( 'Show', 'gpur' ),
					'type' => 'gpur_header',
					'group' => esc_html__( 'Posts', 'gpur' ),
				),
					array( 
						'param_name' => 'show_ranking',
						'type' => 'checkbox',
						'value' => array( esc_html__( 'Ranking', 'gpur' ) => '1' ),
						'std' => '',
						'group' => esc_html__( 'Posts', 'gpur' ),
					),					
					array( 
						'param_name' => 'show_image',
						'type' => 'checkbox',
						'value' => array( esc_html__( 'Image', 'gpur' ) => '1' ),
						'std' => '1',
						'group' => esc_html__( 'Posts', 'gpur' ),
					),	
					array( 
						'param_name' => 'show_title',
						'type' => 'checkbox',
						'value' => array( esc_html__( 'Title', 'gpur' ) => '1' ),
						'std' => '1',
						'group' => esc_html__( 'Posts', 'gpur' ),
					),						
					array(
						'param_name' => 'show_name',
						'type' => 'checkbox',
						'value' => array( esc_html__( 'Name', 'gpur' ) => '1' ),
						'std' => '1',
						'group' => esc_html__( 'Posts', 'gpur' ),
					),	
					array( 
						'param_name' => 'show_date',
						'type' => 'checkbox',
						'value' => array( esc_html__( 'Date', 'gpur' ) => '1' ),
						'std' => '1',
						'group' => esc_html__( 'Posts', 'gpur' ),
					),	
					array( 
						'param_name' => 'show_comments',
						'type' => 'checkbox',
						'value' => array( esc_html__( 'Comments', 'gpur' ) => '1' ),
						'std' => '',
						'group' => esc_html__( 'Posts', 'gpur' ),
					),	
					array( 
						'param_name' => 'show_likes',
						'type' => 'checkbox',
						'value' => array( esc_html__( 'Likes', 'gpur' ) => '1' ),
						'std' => '',
						'group' => esc_html__( 'Posts', 'gpur' ),
					),	
					array(
						'param_name' => 'show_site_rating',
						'type' => 'checkbox',
						'value' => array( esc_html__( 'Site Rating', 'gpur' ) => '1' ),
						'std' => '1',
						'group' => esc_html__( 'Posts', 'gpur' ),
					),	
					array( 
						'param_name' => 'show_user_rating',
						'type' => 'checkbox',
						'value' => array( esc_html__( 'User Rating', 'gpur' ) => '1' ),
						'std' => '1',
						'group' => esc_html__( 'Posts', 'gpur' ),
					),	
					array( 
						'param_name' => 'show_excerpt',
						'type' => 'checkbox',
						'value' => array( esc_html__( 'Excerpt', 'gpur' ) => '1' ),
						'std' => '1',
						'group' => esc_html__( 'Posts', 'gpur' ),
					),	
					array( 
						'param_name' => 'show_view_link',
						'type' => 'checkbox',
						'value' => array( esc_html__( 'View Link', 'gpur' ) => '1' ),
						'std' => '',
						'group' => esc_html__( 'Posts', 'gpur' ),
					),
				
				array( 
					'heading' => esc_html__( 'Image Source', 'gpur' ),
					'param_name' => 'image_source',
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Review Image 1', 'gpur' ) => 'review-image-1',
						esc_html__( 'Review Image 2', 'gpur' ) => 'review-image-2',
						esc_html__( 'Featured Image', 'gpur' ) => 'featured-image',
					),
					'std' => 'featured-image',
					'group' => esc_html__( 'Posts', 'gpur' ),
				),	
								
				array(
					'heading' => esc_html__( 'Image Size', 'gpur' ),
					'param_name' => 'image_size',
					'type' => 'textfield',
					'value' => '160 x 160',
					'group' => esc_html__( 'Posts', 'gpur' ),
				),								
				
				array( 
					'heading' => esc_html__( 'Title Length', 'gpur' ),
					'description' => esc_html__( 'The number of characters in the title. Leave empty to display all characters.', 'gpur' ),
					'param_name' => 'title_length',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Posts', 'gpur' ),
				),								
				
				array( 
					'heading' => esc_html__( 'Excerpt Length', 'gpur' ),
					'description' => esc_html__( 'The number of characters in the excerpt. Leave empty to display all characters.', 'gpur' ),
					'param_name' => 'excerpt_length',
					'type' => 'textfield',
					'value' => 200,
					'group' => esc_html__( 'Posts', 'gpur' ),
				),		

				array( 
					'param_name' => 'ratings_position',
					'heading' => esc_html__( 'Ratings Position', 'gpur' ),			
					'description' => esc_html__( 'Choose whether to show the ratings below or to the right of the post content.', 'gpur' ),
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Below', 'gpur' ) => 'gpur-ratings-below',
						esc_html__( 'To Right', 'gpur' ) => 'gpur-ratings-to-right',
						esc_html__( 'Over Image', 'gpur' ) => 'gpur-ratings-over-image',
					),
					'std' => 'gpur-ratings-below',
					'group' => esc_html__( 'Posts', 'gpur' ),
				),

				array( 
					'param_name' => 'posts_border_color',
					'heading' => esc_html__( 'Border Color', 'gpur' ),
					'type' => 'colorpicker',
					'dependency' => array( 
						'element' => 'post_format', 
						'value' => 'gpur-format-list' ,
					),
					'group' => esc_html__( 'Posts', 'gpur' ),
				),			
													
				/*--------------------------------------------------------------
				Site Rating
				--------------------------------------------------------------*/					
				
				// Site Rating - Rating Controls
				array( 
					'param_name' => '_gpur_tab_site_rating_controls',
					'heading' => esc_html__( 'Rating Controls', 'gpur' ),
					'type' => 'gpur_tab',
					'group' => esc_html__( 'Site Rating', 'gpur' ),
				),
					array( 
						'heading' => esc_html__( 'Maximum Rating', 'gpur' ),
						'param_name' => 'site_rating_max_rating',
						'type' => 'textfield',
						'value' => 5,
						'group' => esc_html__( 'Site Rating', 'gpur' ),
					),
					array( 
						'param_name' => 'site_rating_decimal_places',
						'heading' => esc_html__( 'Decimal Places', 'gpur' ),
						'description' => esc_html__( 'The number of decimal places to show the rating to.', 'gpur' ),
						'type' => 'textfield',
						'value' => 1,
						'group' => esc_html__( 'Site Rating', 'gpur' ),
					),
					array(
						'param_name' => 'site_rating_show_zero_rating',
						'heading' => esc_html__( 'Zero Ratings', 'gpur' ),
						'type' => 'checkbox',
						'value' => array( '' => 1 ),
						'std' => '1',
						'group' => esc_html__( 'Site Rating', 'gpur' ),
					),
				
				// Site Rating - Rating Style
				array( 
					'param_name' => '_gpur_tab_site_rating_style',
					'heading' => esc_html__( 'Rating Style', 'gpur' ),
					'type' => 'gpur_tab',
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'group' => esc_html__( 'Site Rating', 'gpur' ),
				),							
					array( 
						'heading' => esc_html__( 'Style', 'gpur' ),
						'param_name' => 'site_rating_style',
						'type' => 'dropdown',
						'admin_label' => true,
						'value' => array(
							esc_html__( 'Plain (Singular)', 'gpur' ) => 'style-plain-singular',
							esc_html__( 'Squares (Singular)', 'gpur' ) => 'style-squares-singular',
							esc_html__( 'Circles (Singular)', 'gpur' ) => 'style-circles-singular',
							esc_html__( 'Gauge Circles (Singular)', 'gpur' ) => 'style-gauge-circles-singular',
							esc_html__( 'Stars', 'gpur' ) => 'style-stars',
							esc_html__( 'Hearts', 'gpur' ) => 'style-hearts',
							esc_html__( 'Squares', 'gpur' ) => 'style-squares',
							esc_html__( 'Circles', 'gpur' ) => 'style-circles',
							esc_html__( 'Bars', 'gpur' ) => 'style-bars',
							esc_html__( 'Custom Icon', 'gpur' ) => 'style-icon',
							esc_html__( 'Custom Image', 'gpur' ) => 'style-image',
						),
						'std' => 'style-stars',
						'group' => esc_html__( 'Site Rating', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Custom Image', 'gpur' ),
						'description' => esc_html__( 'Your image should include the filled and empty icons. For an example see the', 'gpur' ) . ' <a href="' . GPUR_URL . 'public/images/default-rating-image.png" target="_blank">' . esc_html__( 'default image', 'gpur' ) . '</a>.',
						'param_name' => 'site_rating_image',
						'type' => 'attach_image',
						'value' => '',
						'dependency' => array( 
							'element' => 'site_rating_style', 
							'value' => 'style-image' 
						),
						'group' => esc_html__( 'Site Rating', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Position', 'gpur' ),
						'param_name' => 'site_rating_position',
						'type' => 'dropdown',
						'value' => array(
							esc_html__( 'Left', 'gpur' ) => 'position-left',
							esc_html__( 'Center', 'gpur' ) => 'position-center',
							esc_html__( 'Right', 'gpur' ) => 'position-right',
						),
						'std' => 'position-left',
						'group' => esc_html__( 'Site Rating', 'gpur' ),
					),
					array( 
						'param_name' => 'site_rating_text_position',
						'heading' => esc_html__( 'Rating Text Position', 'gpur' ),
						'type' => 'dropdown',
						'value' => array(
							esc_html__( 'Top', 'gpur' ) => 'position-text-top', 
							esc_html__( 'Bottom', 'gpur' ) => 'position-text-bottom', 
							esc_html__( 'Left', 'gpur' ) => 'position-text-left', 
							esc_html__( 'Right', 'gpur' ) => 'position-text-right', 
						),
						'std' => 'position-text-bottom',					
						'dependency' => array(
							'element' => 'site_rating_style', 
							'value' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
						),
						'group' => esc_html__( 'Site Rating', 'gpur' ),
					),					
					array( 
						'heading' => esc_html__( 'Empty Icon', 'gpur' ),
						'param_name' => 'site_rating_empty_icon',
						'type' => 'iconpicker',
						'value' => 'fa fa-star',
						'dependency' => array( 
							'element' => 'site_rating_style', 
							'value' => 'style-icon' ,
						),
						'group' => esc_html__( 'Site Rating', 'gpur' ),
					),						
					array( 
						'heading' => esc_html__( 'Empty Icon Color', 'gpur' ),
						'param_name' => 'site_rating_empty_icon_color',
						'type' => 'colorpicker',
						'value' => '',
						'dependency' => array( 
							'element' => 'site_rating_style', 
							'value' => array( 'style-stars', 'style-hearts', 'style-squares', 'style-circles', 'style-bars', 'style-icon' ), 
						),
						'group' => esc_html__( 'Site Rating', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Filled Icon', 'gpur' ),
						'param_name' => 'site_rating_filled_icon',
						'type' => 'iconpicker',
						'value' => 'fa fa-star',
						'dependency' => array( 
							'element' => 'site_rating_style', 
							'value' => 'style-icon',
						),
						'group' => esc_html__( 'Site Rating', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Filled Icon Color', 'gpur' ),
						'param_name' => 'site_rating_filled_icon_color',
						'type' => 'colorpicker',
						'value' => '',
						'group' => esc_html__( 'Site Rating', 'gpur' ),
						'dependency' => array( 
							'element' => 'site_rating_style', 
							'value' => array( 'style-stars', 'style-hearts', 'style-squares', 'style-circles', 'style-bars', 'style-icon' ), 
						),
					),				
					array( 
						'heading' => esc_html__( 'Width (px)', 'gpur' ),
						'description' => '',
						'param_name' => 'site_rating_icon_width',
						'type' => 'textfield',
						'value' => '',
						'group' => esc_html__( 'Site Rating', 'gpur' ),
						'dependency' => array( 
							'element' => 'site_rating_style', 
							'value' => array( 'style-stars', 'style-hearts', 'style-squares', 'style-circles', 'style-icon', 'style-image' ), 
						),
					),
					array( 
						'heading' => esc_html__( 'Height (px)', 'gpur' ),
						'description' => '',
						'param_name' => 'site_rating_icon_height',
						'type' => 'textfield',
						'value' => '',
						'dependency' => array( 
							'element' => 'site_rating_style', 
							'value' => array( 'style-squares', 'style-circles', 'style-bars', 'style-icon', 'style-image' ), 
						),
						'group' => esc_html__( 'Site Rating', 'gpur' ),
					),					

				// Site Rating - Rating Container
				array( 
					'param_name' => '_gpur_tab_site_rating_container',
					'heading' => esc_html__( 'Rating Container', 'gpur' ),
					'type' => 'gpur_tab',
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'dependency' => array( 
						'element' => 'site_rating_style', 
						'value' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
					),
					'group' => esc_html__( 'Site Rating', 'gpur' ),
				),							
					array( 
						'heading' => esc_html__( 'Width (px)', 'gpur' ),
						'description' => '',
						'param_name' => 'site_rating_container_width',
						'type' => 'textfield',
						'value' => '',
						'group' => esc_html__( 'Site Rating', 'gpur' ),
						'dependency' => array( 
							'element' => 'site_rating_style', 
							'value' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
						),
					),
					array( 
						'heading' => esc_html__( 'Height (px)', 'gpur' ),
						'description' => '',
						'param_name' => 'site_rating_container_height',
						'type' => 'textfield',
						'value' => '',
						'group' => esc_html__( 'Site Rating', 'gpur' ),
						'dependency' => array( 
							'element' => 'site_rating_style', 
							'value' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
						),
					),
					array( 
						'heading' => esc_html__( 'Background Color', 'gpur' ),
						'param_name' => 'site_rating_container_background_color',
						'type' => 'colorpicker',
						'value' => '',				
						'dependency' => array( 
							'element' => 'site_rating_style', 
							'value' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
						),
						'group' => esc_html__( 'Site Rating', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Border Width (px)', 'gpur' ),
						'param_name' => 'site_rating_container_border_width',
						'type' => 'textfield',
						'value' => '',				
						'dependency' => array( 
							'element' => 'site_rating_style', 
							'value' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
						),
						'group' => esc_html__( 'Site Rating', 'gpur' ),
					),	
					array( 
						'heading' => esc_html__( 'Border Color', 'gpur' ),
						'param_name' => 'site_rating_container_border_color',
						'type' => 'colorpicker',
						'value' => '',				
						'dependency' => array( 
							'element' => 'site_rating_style', 
							'value' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
						),
						'group' => esc_html__( 'Site Rating', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Extra CSS', 'gpur' ),
						'param_name' => 'site_rating_container_extra_css',
						'type' => 'textfield',
						'value' => '',		
						'dependency' => array( 
							'element' => 'site_rating_style', 
							'value' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
						),
						'group' => esc_html__( 'Site Rating', 'gpur' ),
					),	
					
				// Site Rating - Gauge
				array( 
					'param_name' => '_gpur_tab_site_rating_gauge',
					'heading' => esc_html__( 'Gauge', 'gpur' ),
					'type' => 'gpur_tab',
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'dependency' => array( 
						'element' => 'site_rating_style', 
						'value' => 'style-gauge-circles-singular' 
					),
					'group' => esc_html__( 'Site Rating', 'gpur' ),
				),
					array( 
						'heading' => esc_html__( 'Width (px)', 'gpur' ),
						'param_name' => 'site_rating_gauge_width',
						'type' => 'textfield',
						'value' => '',
						'dependency' => array( 
							'element' => 'site_rating_style', 
							'value' => 'style-gauge-circles-singular' 
						),
						'group' => esc_html__( 'Site Rating', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Filled Color 1', 'gpur' ),
						'param_name' => 'site_rating_gauge_filled_color_1',
						'type' => 'colorpicker',
						'value' => '',
						'dependency' => array( 
							'element' => 'site_rating_style', 
							'value' => 'style-gauge-circles-singular' 
						),
						'group' => esc_html__( 'Site Rating', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Filled Color 2', 'gpur' ),
						'param_name' => 'site_rating_gauge_filled_color_2',
						'type' => 'colorpicker',
						'value' => '',
						'dependency' => array( 
							'element' => 'site_rating_style', 
							'value' => 'style-gauge-circles-singular' 
						),
						'group' => esc_html__( 'Site Rating', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Empty Color', 'gpur' ),
						'param_name' => 'site_rating_gauge_empty_color',
						'type' => 'colorpicker',
						'value' => '',
						'dependency' => array( 
							'element' => 'site_rating_style', 
							'value' => 'style-gauge-circles-singular' 
						),
						'group' => esc_html__( 'Site Rating', 'gpur' ),
					),

				// Site Rating - Site Rating Text
				array( 
					'param_name' => '_gpur_tab_site_rating_text',
					'heading' => esc_html__( 'Rating Text', 'gpur' ),
					'type' => 'gpur_tab',
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'group' => esc_html__( 'Site Rating', 'gpur' ),
				),
				
					array(	
						'param_name' => 'show_site_rating_text',
						'heading' => esc_html__( 'Display', 'gpur' ),
						'type' => 'checkbox',
						'value' => array( '' => '1' ),
						'std' => '',
						'group' => esc_html__( 'Site Rating', 'gpur' ),
					),
										
					// Site Rating - Label
					array( 
						'param_name' => '_gpur_header_site_rating_label',
						'heading' => esc_html__( 'Label', 'gpur' ),
						'type' => 'gpur_header',				
						'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
						'dependency' => array( 
							'element' => 'show_site_rating_text', 
							'not_empty' => true,
						),
						'group' => esc_html__( 'Site Rating', 'gpur' ),
					),
						array(
							'heading' => esc_html__( 'Label', 'gpur' ),
							'param_name' => 'site_rating_label',
							'type' => 'textfield',
							'value' => esc_html__( 'Site Rating:', 'gpur' ),
							'dependency' => array( 
								'element' => 'show_site_rating_text', 
								'not_empty' => true,
							),
							'group' => esc_html__( 'Site Rating', 'gpur' ),
						),	
						array( 
							'heading' => esc_html__( 'Text Color', 'gpur' ),	
							'param_name' => 'site_rating_label_color',
							'type' => 'colorpicker',
							'value' => '',
							'dependency' => array( 
								'element' => 'show_site_rating_text', 
								'not_empty' => true, 
							),
							'group' => esc_html__( 'Site Rating', 'gpur' ),
						),			
						array( 
							'heading' => esc_html__( 'Size (px)', 'gpur' ),	
							'param_name' => 'site_rating_label_size',
							'type' => 'textfield',
							'value' => '',
							'dependency' => array( 
								'element' => 'show_site_rating_text', 
								'not_empty' => true, 
							),
							'group' => esc_html__( 'Site Rating', 'gpur' ),
						),
						array( 
							'heading' => esc_html__( 'Extra CSS', 'gpur' ),	
							'param_name' => 'site_rating_label_extra_css',
							'type' => 'textfield',
							'value' => '',
							'dependency' => array( 
								'element' => 'show_site_rating_text', 
								'not_empty' => true, 
							),
							'group' => esc_html__( 'Site Rating', 'gpur' ),
						),
				
					// Site Rating - Rating Number
					array( 
						'param_name' => '_gpur_header_site_rating_number',
						'heading' => esc_html__( 'Rating Number', 'gpur' ),
						'type' => 'gpur_header',
						'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
						'group' => esc_html__( 'Site Rating', 'gpur' ),
					),
						array( 
							'heading' => esc_html__( 'Text Color', 'gpur' ),	
							'param_name' => 'site_rating_number_color',
							'type' => 'colorpicker',
							'value' => '',
							'group' => esc_html__( 'Site Rating', 'gpur' ),
						),			
						array( 
							'heading' => esc_html__( 'Size (px)', 'gpur' ),	
							'param_name' => 'site_rating_number_size',
							'type' => 'textfield',
							'value' => '',
							'group' => esc_html__( 'Site Rating', 'gpur' ),
						),
						array( 
							'heading' => esc_html__( 'Extra CSS', 'gpur' ),	
							'param_name' => 'site_rating_number_extra_css',
							'type' => 'textfield',
							'value' => '',
							'group' => esc_html__( 'Site Rating', 'gpur' ),
						),
					
					// Site Rating - Maximum Rating Number											
					array( 
						'param_name' => '_gpur_header_site_rating_max_rating_number',
						'heading' => esc_html__( 'Maximum Rating Number', 'gpur' ),
						'type' => 'gpur_header',
						'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
						'group' => esc_html__( 'Site Rating', 'gpur' ),
					),			
						array(	
							'param_name' => 'show_site_rating_max_rating_number',
							'heading' => esc_html__( 'Display', 'gpur' ),
							'type' => 'checkbox',
							'value' => array( '' => '1' ),
							'std' => '',
							'group' => esc_html__( 'Site Rating', 'gpur' ),
						),
						array( 
							'heading' => esc_html__( 'Text Color', 'gpur' ),	
							'param_name' => 'site_rating_max_rating_number_color',
							'type' => 'colorpicker',
							'value' => '',
							'dependency' => array( 
								'element' => 'show_site_rating_max_rating_number', 
								'not_empty' => true, 
							),
							'group' => esc_html__( 'Site Rating', 'gpur' ),
						),			
						array( 
							'heading' => esc_html__( 'Size (px)', 'gpur' ),	
							'param_name' => 'site_rating_max_rating_number_size',
							'type' => 'textfield',
							'value' => '',
							'dependency' => array( 
								'element' => 'show_site_rating_max_rating_number', 
								'not_empty' => true, 
							),
							'group' => esc_html__( 'Site Rating', 'gpur' ),
						),
						array( 
							'heading' => esc_html__( 'Extra CSS', 'gpur' ),	
							'param_name' => 'site_rating_max_rating_number_extra_css',
							'type' => 'textfield',
							'value' => '',
							'dependency' => array( 
								'element' => 'show_site_rating_max_rating_number', 
								'not_empty' => true, 
							),
							'group' => esc_html__( 'Site Rating', 'gpur' ),
						),	

				// Site Rating - Criteria
				array( 
					'param_name' => '_gpur_tab_site_rating_criteria',
					'heading' => esc_html__( 'Criteria', 'gpur' ),
					'type' => 'gpur_tab',
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'group' => esc_html__( 'Site Rating', 'gpur' ),
				),
					array( 
						'heading' => esc_html__( 'Criteria', 'gpur' ),					
						'description' => esc_html__( 'Enter each criterion on a new line.', 'gpur' ),
						'param_name' => 'site_rating_criteria',
						'type' => 'exploded_textarea',
						'value' => '',
						'group' => esc_html__( 'Site Rating', 'gpur' ),
					),										
					array( 
						'heading' => esc_html__( 'Color', 'gpur' ),
						'param_name' => 'site_rating_criteria_title_color',
						'type' => 'colorpicker',
						'value' => '',
						'group' => esc_html__( 'Site Rating', 'gpur' ),
					),		
					array( 
						'heading' => esc_html__( 'Size (px)', 'gpur' ),
						'param_name' => 'site_rating_criteria_title_size',
						'type' => 'textfield',
						'value' => '',
						'group' => esc_html__( 'Site Rating', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Extra CSS', 'gpur' ),
						'param_name' => 'site_rating_criteria_title_extra_css',
						'type' => 'textfield',
						'value' => '',
						'group' => esc_html__( 'Site Rating', 'gpur' ),
					),
									
				// Site Rating - Ranges Text
				array( 
					'param_name' => '_gpur_tab_site_rating_ranges_text',
					'heading' => esc_html__( 'Ranges Text', 'gpur' ),
					'type' => 'gpur_tab',
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'group' => esc_html__( 'Site Rating', 'gpur' ),
				),
					array(
						'param_name' => 'show_site_rating_ranges_text',
						'heading' => esc_html__( 'Display', 'gpur' ),
						'type' => 'checkbox',
						'value' => array( '' => '1' ),
						'std' => '',
						'group' => esc_html__( 'Site Rating', 'gpur' ),
					),
					array(
						'heading' => esc_html__( 'Rating Ranges', 'gpur' ),
						'description' => esc_html__( 'Set up your rating ranges in the follow way', 'gpur' ) . ' <code>' . esc_html__( 'Score 1-Score 2:Rating Text, Score 3-Score 4:Rating Text', 'gpur' ) . '</code>' . esc_html__( 'e.g.', 'gpur' ) . '<code>' . esc_html__( '0-2:Awful, 2.5-4:Bad, 4.5-6:Average, 6.5-8:Good, 8.5-10:Amazing', 'gpur' ) . '</code>',
						'param_name' => 'site_rating_ranges',
						'type' => 'textfield',
						'value' => '0-1.9:Awful, 2-2.9:Bad, 3-3.9:Average, 4-4.9:Good, 5-5:Amazing',
						'dependency' => array( 
							'element' => 'show_site_ranges_text', 
							'not_empty' => true,
						),
						'group' => esc_html__( 'Site Rating', 'gpur' ),
					),										
					array( 
						'heading' => esc_html__( 'Color', 'gpur' ),	
						'param_name' => 'site_rating_ranges_text_color',
						'type' => 'colorpicker',
						'value' => '',
						'dependency' => array( 
							'element' => 'show_site_rating_ranges_text', 
							'not_empty' => true,
						),
						'group' => esc_html__( 'Site Rating', 'gpur' ),
					),			
					array( 
						'heading' => esc_html__( 'Size (px)', 'gpur' ),	
						'param_name' => 'site_rating_ranges_text_size',
						'type' => 'textfield',
						'value' => '',
						'dependency' => array( 
							'element' => 'show_site_rating_ranges_text', 
							'not_empty' => true,
						),
						'group' => esc_html__( 'Site Rating', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Extra CSS', 'gpur' ),	
						'param_name' => 'site_rating_ranges_text_extra_css',
						'type' => 'textfield',
						'value' => '',
						'dependency' => array( 
							'element' => 'show_site_rating_ranges_text', 
							'not_empty' => true,
						),
						'group' => esc_html__( 'Site Rating', 'gpur' ),
					),

				/*--------------------------------------------------------------
				User Rating
				--------------------------------------------------------------*/					
				
				// User Rating - Rating Controls
				array( 
					'param_name' => '_gpur_tab_user_rating_controls',
					'heading' => esc_html__( 'Rating Controls', 'gpur' ),
					'type' => 'gpur_tab',
					'group' => esc_html__( 'User Rating', 'gpur' ),
				),
					array( 
						'heading' => esc_html__( 'Maximum Rating', 'gpur' ),
						'param_name' => 'user_rating_max_rating',
						'type' => 'textfield',
						'value' => '',
						'group' => esc_html__( 'User Rating', 'gpur' ),
					),
					array( 
						'param_name' => 'user_rating_decimal_places',
						'heading' => esc_html__( 'Decimal Places', 'gpur' ),
						'description' => esc_html__( 'The number of decimal places to show the rating to.', 'gpur' ),
						'type' => 'textfield',
						'value' => '',
						'group' => esc_html__( 'User Rating', 'gpur' ),
					),
					array(
						'param_name' => 'user_rating_show_zero_rating',
						'heading' => esc_html__( 'Zero Ratings', 'gpur' ),
						'type' => 'checkbox',
						'value' => array( '' => 1 ),
						'std' => '1',
						'group' => esc_html__( 'User Rating', 'gpur' ),
					),
				
				// Site Rating - Rating Style
				array( 
					'param_name' => '_gpur_tab_user_rating_style',
					'heading' => esc_html__( 'Rating Style', 'gpur' ),
					'type' => 'gpur_tab',
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'group' => esc_html__( 'User Rating', 'gpur' ),
				),							
					array( 
						'heading' => esc_html__( 'Style', 'gpur' ),
						'param_name' => 'user_rating_style',
						'type' => 'dropdown',
						'admin_label' => true,
						'value' => array(
							esc_html__( 'Default', 'gpur' ) => '',
							esc_html__( 'Plain (Singular)', 'gpur' ) => 'style-plain-singular',
							esc_html__( 'Squares (Singular)', 'gpur' ) => 'style-squares-singular',
							esc_html__( 'Circles (Singular)', 'gpur' ) => 'style-circles-singular',
							esc_html__( 'Gauge Circles (Singular)', 'gpur' ) => 'style-gauge-circles-singular',
							esc_html__( 'Stars', 'gpur' ) => 'style-stars',
							esc_html__( 'Hearts', 'gpur' ) => 'style-hearts',
							esc_html__( 'Squares', 'gpur' ) => 'style-squares',
							esc_html__( 'Circles', 'gpur' ) => 'style-circles',
							esc_html__( 'Bars', 'gpur' ) => 'style-bars',
							esc_html__( 'Custom Icon', 'gpur' ) => 'style-icon',
							esc_html__( 'Custom Image', 'gpur' ) => 'style-image',
						),
						'std' => '',
						'group' => esc_html__( 'User Rating', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Custom Image', 'gpur' ),
						'description' => esc_html__( 'Your image should include the filled and empty icons. For an example see the', 'gpur' ) . ' <a href="' . GPUR_URL . 'public/images/default-rating-image.png" target="_blank">' . esc_html__( 'default image', 'gpur' ) . '</a>.',
						'param_name' => 'user_rating_image',
						'type' => 'attach_image',
						'value' => '',
						'dependency' => array( 
							'element' => 'user_rating_style', 
							'value' => 'style-image' 
						),
						'group' => esc_html__( 'User Rating', 'gpur' ),
					),					
					array( 
						'heading' => esc_html__( 'Position', 'gpur' ),
						'param_name' => 'user_rating_position',
						'type' => 'dropdown',
						'value' => array(
							esc_html__( 'Default', 'gpur' ) => '',
							esc_html__( 'Left', 'gpur' ) => 'position-left',
							esc_html__( 'Center', 'gpur' ) => 'position-center',
							esc_html__( 'Right', 'gpur' ) => 'position-right',
						),
						'std' => '',
						'group' => esc_html__( 'User Rating', 'gpur' ),
					),
					array( 
						'param_name' => 'user_rating_text_position',
						'heading' => esc_html__( 'Rating Text Position', 'gpur' ),
						'type' => 'dropdown',
						'value' => array(
							esc_html__( 'Default', 'gpur' ) => '',
							esc_html__( 'Top', 'gpur' ) => 'position-text-top', 
							esc_html__( 'Bottom', 'gpur' ) => 'position-text-bottom', 
							esc_html__( 'Left', 'gpur' ) => 'position-text-left', 
							esc_html__( 'Right', 'gpur' ) => 'position-text-right', 
						),
						'std' => '',					
						'dependency' => array(
							'element' => 'user_rating_style', 
							'value' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
						),
						'group' => esc_html__( 'User Rating', 'gpur' ),
					),	
					array( 
						'heading' => esc_html__( 'Empty Icon', 'gpur' ),
						'param_name' => 'user_rating_empty_icon',
						'type' => 'iconpicker',
						'value' => '',
						'dependency' => array( 
							'element' => 'user_rating_style', 
							'value' => 'style-icon' ,
						),
						'group' => esc_html__( 'User Rating', 'gpur' ),
					),						
					array( 
						'heading' => esc_html__( 'Empty Icon Color', 'gpur' ),
						'param_name' => 'user_rating_empty_icon_color',
						'type' => 'colorpicker',
						'value' => '',
						'dependency' => array( 
							'element' => 'user_rating_style', 
							'value' => array( 'style-stars', 'style-hearts', 'style-squares', 'style-circles', 'style-bars', 'style-icon' ), 
						),
						'group' => esc_html__( 'User Rating', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Filled Icon', 'gpur' ),
						'param_name' => 'user_rating_filled_icon',
						'type' => 'iconpicker',
						'value' => '',
						'dependency' => array( 
							'element' => 'user_rating_style', 
							'value' => 'style-icon',
						),
						'group' => esc_html__( 'User Rating', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Filled Icon Color', 'gpur' ),
						'param_name' => 'user_rating_filled_icon_color',
						'type' => 'colorpicker',
						'value' => '',
						'group' => esc_html__( 'User Rating', 'gpur' ),
						'dependency' => array( 
							'element' => 'user_rating_style', 
							'value' => array( 'style-stars', 'style-hearts', 'style-squares', 'style-circles', 'style-bars', 'style-icon' ), 
						),
					),				
					array( 
						'heading' => esc_html__( 'Width (px)', 'gpur' ),
						'description' => '',
						'param_name' => 'user_rating_icon_width',
						'type' => 'textfield',
						'value' => '',
						'group' => esc_html__( 'User Rating', 'gpur' ),
						'dependency' => array( 
							'element' => 'user_rating_style', 
							'value' => array( 'style-stars', 'style-hearts', 'style-squares', 'style-circles', 'style-icon', 'style-image' ), 
						),
					),
					array( 
						'heading' => esc_html__( 'Height (px)', 'gpur' ),
						'description' => '',
						'param_name' => 'user_rating_icon_height',
						'type' => 'textfield',
						'value' => '',
						'dependency' => array( 
							'element' => 'user_rating_style', 
							'value' => array( 'style-squares', 'style-circles', 'style-bars', 'style-icon', 'style-image' ), 
						),
						'group' => esc_html__( 'User Rating', 'gpur' ),
					),					

				// User Rating - Rating Container
				array( 
					'param_name' => '_gpur_tab_user_rating_container',
					'heading' => esc_html__( 'Rating Container', 'gpur' ),
					'type' => 'gpur_tab',
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'dependency' => array( 
						'element' => 'site_rating_style', 
						'value' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
					),
					'group' => esc_html__( 'User Rating', 'gpur' ),
				),							
					array( 
						'heading' => esc_html__( 'Width (px)', 'gpur' ),
						'description' => '',
						'param_name' => 'user_rating_container_width',
						'type' => 'textfield',
						'value' => '',
						'group' => esc_html__( 'User Rating', 'gpur' ),
						'dependency' => array( 
							'element' => 'user_rating_style', 
							'value' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
						),
					),
					array( 
						'heading' => esc_html__( 'Height (px)', 'gpur' ),
						'description' => '',
						'param_name' => 'user_rating_container_height',
						'type' => 'textfield',
						'value' => '',
						'group' => esc_html__( 'User Rating', 'gpur' ),
						'dependency' => array( 
							'element' => 'user_rating_style', 
							'value' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
						),
					),
					array( 
						'heading' => esc_html__( 'Background Color', 'gpur' ),
						'param_name' => 'user_rating_container_background_color',
						'type' => 'colorpicker',
						'value' => '',				
						'dependency' => array( 
							'element' => 'user_rating_style', 
							'value' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
						),
						'group' => esc_html__( 'User Rating', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Border Width (px)', 'gpur' ),
						'param_name' => 'user_rating_container_border_width',
						'type' => 'textfield',
						'value' => '',				
						'dependency' => array( 
							'element' => 'user_rating_style', 
							'value' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
						),
						'group' => esc_html__( 'User Rating', 'gpur' ),
					),	
					array( 
						'heading' => esc_html__( 'Border Color', 'gpur' ),
						'param_name' => 'user_rating_container_border_color',
						'type' => 'colorpicker',
						'value' => '',				
						'dependency' => array( 
							'element' => 'user_rating_style', 
							'value' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
						),
						'group' => esc_html__( 'User Rating', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Extra CSS', 'gpur' ),
						'param_name' => 'user_rating_container_extra_css',
						'type' => 'textfield',
						'value' => '',		
						'dependency' => array( 
							'element' => 'user_rating_style', 
							'value' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
						),
						'group' => esc_html__( 'User Rating', 'gpur' ),
					),	
				
				// User Rating - Gauge
				array( 
					'param_name' => '_gpur_tab_user_rating_gauge',
					'heading' => esc_html__( 'Gauge', 'gpur' ),
					'type' => 'gpur_tab',
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'dependency' => array( 
						'element' => 'user_rating_style', 
						'value' => 'style-gauge-circles-singular' 
					),
					'group' => esc_html__( 'User Rating', 'gpur' ),
				),
					array( 
						'heading' => esc_html__( 'Width (px)', 'gpur' ),
						'param_name' => 'user_rating_gauge_width',
						'type' => 'textfield',
						'value' => '',
						'dependency' => array( 
							'element' => 'user_rating_style', 
							'value' => 'style-gauge-circles-singular' 
						),
						'group' => esc_html__( 'User Rating', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Filled Color 1', 'gpur' ),
						'param_name' => 'user_rating_gauge_filled_color_1',
						'type' => 'colorpicker',
						'value' => '',
						'dependency' => array( 
							'element' => 'user_rating_style', 
							'value' => 'style-gauge-circles-singular' 
						),
						'group' => esc_html__( 'User Rating', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Filled Color 2', 'gpur' ),
						'param_name' => 'user_rating_gauge_filled_color_2',
						'type' => 'colorpicker',
						'value' => '',
						'dependency' => array( 
							'element' => 'user_rating_style', 
							'value' => 'style-gauge-circles-singular' 
						),
						'group' => esc_html__( 'User Rating', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Empty Color', 'gpur' ),
						'param_name' => 'user_rating_gauge_empty_color',
						'type' => 'colorpicker',
						'value' => '',
						'dependency' => array( 
							'element' => 'user_rating_style', 
							'value' => 'style-gauge-circles-singular' 
						),
						'group' => esc_html__( 'User Rating', 'gpur' ),
					),
								
				// User Rating - Average User Rating Text
				array( 
					'param_name' => '_gpur_tab_user_rating_text',
					'heading' => esc_html__( 'Average User Rating Text', 'gpur' ),
					'type' => 'gpur_tab',
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'group' => esc_html__( 'User Rating', 'gpur' ),
				),
				
					array(	
						'param_name' => 'show_avg_user_rating_text',
						'heading' => esc_html__( 'Display', 'gpur' ),
						'type' => 'checkbox',
						'value' => array( '' => '1' ),
						'std' => '',
						'dependency' => array( 
							'element' => 'data', 
							'value' => 'user-rating' 
						),
						'group' => esc_html__( 'User Rating', 'gpur' ),
					),
			
					// Average User Rating - Label
					array( 
						'param_name' => '_gpur_header_avg_user_rating_label',
						'heading' => esc_html__( 'Label', 'gpur' ),
						'type' => 'gpur_header',
						'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
						'dependency' => array( 
							'element' => 'show_avg_user_rating_text', 
							'not_empty' => true,
						),
						'group' => esc_html__( 'User Rating', 'gpur' ),
					),
						array(
							'heading' => esc_html__( 'Label', 'gpur' ),
							'param_name' => 'avg_user_rating_label',
							'type' => 'textfield',
							'value' => esc_html__( 'Average User Rating:', 'gpur' ),
							'dependency' => array( 
								'element' => 'show_avg_user_rating_text', 
								'not_empty' => true,
							),
							'group' => esc_html__( 'User Rating', 'gpur' ),
						),	
						array( 
							'heading' => esc_html__( 'Text Color', 'gpur' ),	
							'param_name' => 'avg_user_rating_label_color',
							'type' => 'colorpicker',
							'value' => '',
							'dependency' => array( 
								'element' => 'show_avg_user_rating_text', 
								'not_empty' => true, 
							),
							'group' => esc_html__( 'User Rating', 'gpur' ),
						),			
						array( 
							'heading' => esc_html__( 'Size (px)', 'gpur' ),	
							'param_name' => 'avg_user_rating_label_size',
							'type' => 'textfield',
							'value' => '',
							'dependency' => array( 
								'element' => 'show_avg_user_rating_text', 
								'not_empty' => true, 
							),
							'group' => esc_html__( 'User Rating', 'gpur' ),
						),
						array( 
							'heading' => esc_html__( 'Extra CSS', 'gpur' ),	
							'param_name' => 'avg_user_rating_label_extra_css',
							'type' => 'textfield',
							'value' => '',
							'dependency' => array( 
								'element' => 'show_avg_user_rating_text', 
								'not_empty' => true, 
							),
							'group' => esc_html__( 'User Rating', 'gpur' ),
						),
				
					// Average User Rating - Rating Number
					array( 
						'param_name' => '_gpur_header_avg_user_rating_number',
						'heading' => esc_html__( 'Rating Number', 'gpur' ),
						'type' => 'gpur_header',
						'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
						'group' => esc_html__( 'User Rating', 'gpur' ),
					),
						array( 
							'heading' => esc_html__( 'Text Color', 'gpur' ),	
							'param_name' => 'avg_user_rating_number_color',
							'type' => 'colorpicker',
							'value' => '',
							'group' => esc_html__( 'User Rating', 'gpur' ),
						),			
						array( 
							'heading' => esc_html__( 'Size (px)', 'gpur' ),	
							'param_name' => 'avg_user_rating_number_size',
							'type' => 'textfield',
							'value' => '',
							'group' => esc_html__( 'User Rating', 'gpur' ),
						),
						array( 
							'heading' => esc_html__( 'Extra CSS', 'gpur' ),	
							'param_name' => 'avg_user_rating_number_extra_css',
							'type' => 'textfield',
							'value' => '',
							'group' => esc_html__( 'User Rating', 'gpur' ),
						),
					
					// Average User Rating - Maximum Rating Number											
					array( 
						'param_name' => '_gpur_header_avg_user_rating_max_rating_number',
						'heading' => esc_html__( 'Maximum Rating Number', 'gpur' ),
						'type' => 'gpur_header',
						'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
						'group' => esc_html__( 'User Rating', 'gpur' ),
					),			
						array(	
							'param_name' => 'show_avg_user_rating_max_rating_number',
							'heading' => esc_html__( 'Display', 'gpur' ),
							'type' => 'checkbox',
							'value' => array( '' => '1' ),
							'std' => '',
							'group' => esc_html__( 'User Rating', 'gpur' ),
						),
						array( 
							'heading' => esc_html__( 'Text Color', 'gpur' ),	
							'param_name' => 'avg_user_rating_max_rating_number_color',
							'type' => 'colorpicker',
							'value' => '',
							'dependency' => array( 
								'element' => 'show_avg_user_rating_max_rating_number', 
								'not_empty' => true, 
							),
							'group' => esc_html__( 'User Rating', 'gpur' ),
						),			
						array( 
							'heading' => esc_html__( 'Size (px)', 'gpur' ),	
							'param_name' => 'avg_user_rating_max_rating_number_size',
							'type' => 'textfield',
							'value' => '',
							'dependency' => array( 
								'element' => 'show_avg_user_rating_max_rating_number', 
								'not_empty' => true, 
							),
							'group' => esc_html__( 'User Rating', 'gpur' ),
						),
						array( 
							'heading' => esc_html__( 'Extra CSS', 'gpur' ),	
							'param_name' => 'avg_user_rating_max_rating_number_extra_css',
							'type' => 'textfield',
							'value' => '',
							'dependency' => array( 
								'element' => 'show_avg_user_rating_max_rating_number', 
								'not_empty' => true, 
							),
							'group' => esc_html__( 'User Rating', 'gpur' ),
						),	
				
					// User Rating - User Votes Text															
					array( 
						'param_name' => '_gpur_tab_user_votes_text',
						'heading' => esc_html__( 'User Votes Text', 'gpur' ),
						'type' => 'gpur_tab',				
						'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
						'dependency' => array( 
							'element' => 'data', 
							'value' => 'user-rating' 
						),
						'group' => esc_html__( 'User Rating', 'gpur' ),
					),
						array(
							'param_name' => 'show_user_votes_text',
							'heading' => esc_html__( 'Display', 'gpur' ),
							'type' => 'checkbox',
							'value' => array( '' => '1' ),
							'std' => '',
							'dependency' => array( 
								'element' => 'data', 
								'value' => 'user-rating' 
							),
							'group' => esc_html__( 'User Rating', 'gpur' ),
						),
						array( 
							'heading' => esc_html__( 'User Votes Label (Singular)', 'gpur' ),
							'param_name' => 'singular_vote_label',
							'type' => 'textfield',
							'value' => esc_html__( 'vote', 'gpur' ),
							'dependency' => array( 
								'element' => 'show_user_votes_text', 
								'not_empty' => true,
							),
							'group' => esc_html__( 'User Rating', 'gpur' ),
						),			
						array( 
							'heading' => esc_html__( 'User Votes Label (Plural)', 'gpur' ),
							'param_name' => 'plural_vote_label',
							'type' => 'textfield',
							'value' => esc_html__( 'votes', 'gpur' ),
							'dependency' => array( 
								'element' => 'show_user_votes_text', 
								'not_empty' => true,
							),
							'group' => esc_html__( 'User Rating', 'gpur' ),
						),	
						array( 
							'heading' => esc_html__( 'Text Color', 'gpur' ),	
							'param_name' => 'user_votes_text_color',
							'type' => 'colorpicker',
							'value' => '',
							'dependency' => array( 
								'element' => 'show_user_votes_text', 
								'not_empty' => true,
							),
							'group' => esc_html__( 'User Rating', 'gpur' ),
						),		
						array( 
							'heading' => esc_html__( 'Size (px)', 'gpur' ),	
							'param_name' => 'user_votes_text_size',
							'type' => 'textfield',
							'value' => '',
							'dependency' => array( 
								'element' => 'show_user_votes_text', 
								'not_empty' => true, 
							),
							'group' => esc_html__( 'User Rating', 'gpur' ),
						),
						array( 
							'heading' => esc_html__( 'Extra CSS', 'gpur' ),	
							'param_name' => 'user_votes_text_extra_css',
							'type' => 'textfield',
							'value' => '',
							'dependency' => array( 
								'element' => 'show_user_votes_text', 
								'not_empty' => true,
							),
							'group' => esc_html__( 'User Rating', 'gpur' ),
						),

					// Individual User Rating Text
					array( 
						'param_name' => '_gpur_tab_ind_user_rating_text',
						'heading' => esc_html__( 'Individual User Rating Text', 'gpur' ),
						'type' => 'gpur_tab',				
						'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
						'dependency' => array( 
							'element' => 'data', 
							'value' => 'user-rating' 
						),
						'group' => esc_html__( 'User Rating', 'gpur' ),
					),	
						array(
							'param_name' => 'show_ind_user_rating_text',
							'heading' => esc_html__( 'Display', 'gpur' ),
							'type' => 'checkbox',
							'value' => array( '' => '1' ),
							'std' => '',
							'dependency' => array( 
								'element' => 'data', 
								'value' => 'user-rating' 
							),
							'group' => esc_html__( 'User Rating', 'gpur' ),
						),	
								
						// Individual User Rating - Label
						array( 
							'param_name' => '_gpur_header_ind_user_rating_label',
							'heading' => esc_html__( 'Label', 'gpur' ),
							'type' => 'gpur_header',
							'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
							'dependency' => array( 
								'element' => 'show_ind_user_rating_text', 
								'not_empty' => true,
							),
							'group' => esc_html__( 'User Rating', 'gpur' ),
						),
							array(
								'heading' => esc_html__( 'Label', 'gpur' ),
								'param_name' => 'ind_user_rating_label',
								'type' => 'textfield',
								'value' => esc_html__( 'Your Rating:', 'gpur' ),
								'dependency' => array( 
									'element' => 'show_ind_user_rating_text', 
									'not_empty' => true,
								),
							'group' => esc_html__( 'User Rating', 'gpur' ),
							),	
							array( 
								'heading' => esc_html__( 'Text Color', 'gpur' ),	
								'param_name' => 'ind_user_rating_label_color',
								'type' => 'colorpicker',
								'value' => '',
								'dependency' => array( 
									'element' => 'show_ind_user_rating_text', 
									'not_empty' => true, 
								),
								'group' => esc_html__( 'User Rating', 'gpur' ),
							),			
							array( 
								'heading' => esc_html__( 'Size (px)', 'gpur' ),	
								'param_name' => 'ind_user_rating_label_size',
								'type' => 'textfield',
								'value' => '',
								'dependency' => array( 
									'element' => 'show_ind_user_rating_text', 
									'not_empty' => true, 
								),
								'group' => esc_html__( 'User Rating', 'gpur' ),
							),
							array( 
								'heading' => esc_html__( 'Extra CSS', 'gpur' ),	
								'param_name' => 'ind_user_rating_label_extra_css',
								'type' => 'textfield',
								'value' => '',
								'dependency' => array( 
									'element' => 'show_ind_user_rating_text', 
									'not_empty' => true, 
								),
								'group' => esc_html__( 'User Rating', 'gpur' ),
							),
				
						// Individual User Rating - Rating Number
						array( 
							'param_name' => '_gpur_header_ind_user_rating_number',
							'heading' => esc_html__( 'Rating Number', 'gpur' ),
							'type' => 'gpur_header',	
							'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',	
							'group' => esc_html__( 'User Rating', 'gpur' ),
						),
							array( 
								'heading' => esc_html__( 'Text Color', 'gpur' ),	
								'param_name' => 'ind_user_rating_number_color',
								'type' => 'colorpicker',
								'value' => '',
								'group' => esc_html__( 'User Rating', 'gpur' ),
							),			
							array( 
								'heading' => esc_html__( 'Size (px)', 'gpur' ),	
								'param_name' => 'ind_user_rating_number_size',
								'type' => 'textfield',
								'value' => '',
								'group' => esc_html__( 'User Rating', 'gpur' ),
							),
							array( 
								'heading' => esc_html__( 'Extra CSS', 'gpur' ),	
								'param_name' => 'ind_user_rating_number_extra_css',
								'type' => 'textfield',
								'value' => '',
								'group' => esc_html__( 'User Rating', 'gpur' ),
							),
					
						// Individual User Rating - Maximum Rating Number											
						array( 
							'param_name' => '_gpur_header_ind_user_rating_max_rating_number',
							'heading' => esc_html__( 'Maximum Rating Number', 'gpur' ),
							'type' => 'gpur_header',
							'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
							'group' => esc_html__( 'User Rating', 'gpur' ),
						),			
							array(	
								'param_name' => 'show_ind_user_rating_max_rating_number',
								'heading' => esc_html__( 'Display', 'gpur' ),
								'type' => 'checkbox',
								'value' => array( '' => '1' ),
								'std' => '1',
								'group' => esc_html__( 'User Rating', 'gpur' ),
							),
							array( 
								'heading' => esc_html__( 'Color', 'gpur' ),	
								'param_name' => 'ind_user_rating_max_rating_number_color',
								'type' => 'colorpicker',
								'value' => '',
								'dependency' => array( 
									'element' => 'show_ind_user_rating_max_rating_number', 
									'not_empty' => true, 
								),
								'group' => esc_html__( 'User Rating', 'gpur' ),
							),			
							array( 
								'heading' => esc_html__( 'Size (px)', 'gpur' ),	
								'param_name' => 'ind_user_rating_max_rating_number_size',
								'type' => 'textfield',
								'value' => '',
								'dependency' => array( 
									'element' => 'show_ind_user_rating_max_rating_number', 
									'not_empty' => true, 
								),
								'group' => esc_html__( 'User Rating', 'gpur' ),
							),
							array( 
								'heading' => esc_html__( 'Extra CSS', 'gpur' ),	
								'param_name' => 'ind_user_rating_max_rating_number_extra_css',
								'type' => 'textfield',
								'value' => '',
								'dependency' => array( 
									'element' => 'show_ind_user_rating_max_rating_number', 
									'not_empty' => true, 
								),
								'group' => esc_html__( 'User Rating', 'gpur' ),
							),	

				// User Rating - Criteria
				array( 
					'param_name' => '_gpur_tab_user_rating_criteria',
					'heading' => esc_html__( 'Criteria', 'gpur' ),
					'type' => 'gpur_tab',
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'group' => esc_html__( 'User Rating', 'gpur' ),
				),
					array( 
						'heading' => esc_html__( 'Criteria', 'gpur' ),					
						'description' => esc_html__( 'Enter each criterion on a new line.', 'gpur' ),
						'param_name' => 'user_rating_criteria',
						'type' => 'exploded_textarea',
						'value' => '',
						'group' => esc_html__( 'User Rating', 'gpur' ),
					),		
					array( 
						'heading' => esc_html__( 'Color', 'gpur' ),
						'param_name' => 'user_rating_criteria_title_color',
						'type' => 'colorpicker',
						'value' => '',
						'group' => esc_html__( 'User Rating', 'gpur' ),
					),		
					array( 
						'heading' => esc_html__( 'Size (px)', 'gpur' ),
						'param_name' => 'user_rating_criteria_title_size',
						'type' => 'textfield',
						'value' => '',
						'group' => esc_html__( 'User Rating', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Extra CSS', 'gpur' ),
						'param_name' => 'user_rating_criteria_title_extra_css',
						'type' => 'textfield',
						'value' => '',
						'group' => esc_html__( 'User Rating', 'gpur' ),
					),
									
				// User Rating - Ranges Text
				array( 
					'param_name' => '_gpur_tab_user_rating_ranges_text',
					'heading' => esc_html__( 'Ranges Text', 'gpur' ),
					'type' => 'gpur_tab',
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'group' => esc_html__( 'User Rating', 'gpur' ),
				),
					array(
						'param_name' => 'show_user_rating_ranges_text',
						'heading' => esc_html__( 'Display', 'gpur' ),
						'type' => 'checkbox',
						'value' => array( '' => '1' ),
						'std' => '',
						'group' => esc_html__( 'User Rating', 'gpur' ),
					),
					array(
						'heading' => esc_html__( 'Rating Ranges', 'gpur' ),
						'description' => esc_html__( 'Set up your rating ranges in the follow way', 'gpur' ) . ' <code>' . esc_html__( 'Score 1-Score 2:Rating Text, Score 3-Score 4:Rating Text', 'gpur' ) . '</code>' . esc_html__( 'e.g.', 'gpur' ) . '<code>' . esc_html__( '0-2:Awful, 2.5-4:Bad, 4.5-6:Average, 6.5-8:Good, 8.5-10:Amazing', 'gpur' ) . '</code>',
						'param_name' => 'user_rating_ranges',
						'type' => 'textfield',
						'value' => '',
						'dependency' => array( 
							'element' => 'show_user_rating_ranges_text', 
							'not_empty' => true,
						),
						'group' => esc_html__( 'User Rating', 'gpur' ),
					),										
					array( 
						'heading' => esc_html__( 'Color', 'gpur' ),	
						'param_name' => 'user_rating_ranges_text_color',
						'type' => 'colorpicker',
						'value' => '',
						'dependency' => array( 
							'element' => 'show_user_rating_ranges_text', 
							'not_empty' => true,
						),
						'group' => esc_html__( 'User Rating', 'gpur' ),
					),			
					array( 
						'heading' => esc_html__( 'Size (px)', 'gpur' ),	
						'param_name' => 'user_rating_ranges_text_size',
						'type' => 'textfield',
						'value' => '',
						'dependency' => array( 
							'element' => 'show_user_rating_ranges_text', 
							'not_empty' => true,
						),
						'group' => esc_html__( 'User Rating', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Extra CSS', 'gpur' ),	
						'param_name' => 'user_rating_ranges_text_extra_css',
						'type' => 'textfield',
						'value' => '',
						'dependency' => array( 
							'element' => 'show_user_rating_ranges_text', 
							'not_empty' => true,
						),
						'group' => esc_html__( 'User Rating', 'gpur' ),
					),
					
				/*--------------------------------------------------------------
				Advanced
				--------------------------------------------------------------*/
		
				array(
					'heading' => esc_html__( 'CSS', 'gpur' ),
					'type' => 'css_editor',
					'param_name' => 'css',
					'group' => esc_html__( 'Advanced', 'gpur' ),
				),
						
			),
			
		) );
		
	}		
} 
add_action( 'vc_before_init', 'gpur_wpb_reviews_list_options' );	

/**
 * Shortcodes
 *
 */
if ( ! function_exists( 'gpur_reviews_list_shortcode' ) ) {
	function gpur_reviews_list_shortcode( $atts ) {

		$atts = shortcode_atts( gpur_reviews_list_shortcode_atts(), $atts, 'gpur_reviews_list_shortcode' );
		
		// Extract attributes
		extract( $atts );

		ob_start();
		
		// Load template
		echo gpur_reviews_list_template( array(	'atts' => $atts ) );
		
		$output = ob_get_contents();
		ob_end_clean();
		return $output;

	}		
}
add_shortcode( 'gpur_reviews_list', 'gpur_reviews_list_shortcode' );