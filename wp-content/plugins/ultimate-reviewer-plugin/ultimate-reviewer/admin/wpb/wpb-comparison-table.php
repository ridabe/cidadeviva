<?php 

/**
 * Options
 *
 */
if ( ! function_exists( 'gpur_wpb_comparison_table_options' ) ) {
	function gpur_wpb_comparison_table_options() { 
	
		vc_map( array( 
			'name' => esc_html__( 'Comparison Table', 'gpur' ),
			'base' => 'gpur_comparison_table',
			'description' => '',
			'class' => 'gpur-wpb-comparison-table',
			'controls' => 'full',
			'icon' => 'gpur-icon-comparison-table',
			'category' => esc_html__( 'Review', 'gpur' ),
			'params' => array(
			
				/*--------------------------------------------------------------
				Table
				--------------------------------------------------------------*/

				array( 
					'param_name' => 'fields',
					'heading' => esc_html__( 'Fields', 'gpur' ),
					'description' => esc_html__( 'Enter each field on a new line. Available fields:', 'gpur' ) . ' <code>RANKING_NUMBERS</code> <code>REVIEW_IMAGE_1</code> <code>REVIEW_IMAGE_2</code> <code>FEATURED_IMAGE</code> <code>POST_TITLE</code> <code>POST_TITLE_NO_LINK</code> <code>POST_DATE</code> <code>POST_CATS</code> <code>POST_TAGS</code> <code>SITE_RATING</code> <code>USER_RATING</code> <code>USER_VOTES</code> <code>LIKES</code> <code>DISLIKES</code> <code>SUMMARY</code> <code>EXCERPT</code> <code>GOOD_POINTS</code> <code>BAD_POINTS</code> <code>BUTTON</code> <code>CUSTOM_FIELD:field_name:Field Title</code>',
					'type' => 'exploded_textarea',
					'group' => esc_html__( 'Table', 'gpur' ),
					'value' => <<<CONTENT
REVIEW_IMAGE_1
POST_TITLE
SITE_RATING
USER_RATING
SUMMARY
CONTENT
				),
																			
				array( 
					'param_name' => 'table_format',
					'heading' => esc_html__( 'Format', 'gpur' ),
					'type' => 'dropdown',
					'admin_label' => true,
					'value' => array(
						esc_html__( 'Vertical Grid', 'gpur' ) => 'format-vertical-grid',
						esc_html__( 'Horizontal Grid', 'gpur' ) => 'format-horizontal-grid',
					),
					'std' => 'format-vertical-grid',
					'group' => esc_html__( 'Table', 'gpur' ),
				),	
													
				// Heading Cells
				array( 
					'param_name' => '_gpur_header_heading_cells',
					'heading' => esc_html__( 'Heading Cells', 'gpur' ),
					'type' => 'gpur_header',
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'group' => esc_html__( 'Table', 'gpur' ),
				),
					array( 
						'heading' => esc_html__( 'Background Color', 'gpur' ),
						'param_name' => 'heading_bg_color',
						'type' => 'colorpicker',
						'value' => '#333333',
						'group' => esc_html__( 'Table', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Border Color', 'gpur' ),
						'param_name' => 'heading_border_color',
						'type' => 'colorpicker',
						'value' => '#333333',
						'group' => esc_html__( 'Table', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Text Color', 'gpur' ),
						'param_name' => 'heading_text_color',
						'type' => 'colorpicker',
						'value' => '#ffffff',
						'group' => esc_html__( 'Table', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Extra CSS', 'gpur' ),
						'param_name' => 'heading_extra_css',
						'type' => 'textfield',
						'value' => '',
						'group' => esc_html__( 'Table', 'gpur' ),
					),			
									
				// Body Cells
				array( 
					'param_name' => '_gpur_header_body_cells',
					'heading' => esc_html__( 'Body Cells', 'gpur' ),
					'type' => 'gpur_header',
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'group' => esc_html__( 'Table', 'gpur' ),
				),
					array( 
						'heading' => esc_html__( 'Background Color 1', 'gpur' ),
						'param_name' => 'cell_bg_color_1',
						'type' => 'colorpicker',
						'value' => '',
						'group' => esc_html__( 'Table', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Background Color 2', 'gpur' ),
						'param_name' => 'cell_bg_color_2',
						'type' => 'colorpicker',
						'value' => '#f8f8f8',
						'group' => esc_html__( 'Table', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Remove Vertical Borders', 'gpur' ),
						'param_name' => 'remove_vertical_borders',
						'type' => 'checkbox',
						'value' => array( '' => '1' ),
						'std' => '1',
						'group' => esc_html__( 'Table', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Border Color', 'gpur' ),
						'param_name' => 'cell_border_color',
						'type' => 'colorpicker',
						'value' => '#eeeeee',
						'group' => esc_html__( 'Table', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Text Color', 'gpur' ),
						'param_name' => 'cell_text_color',
						'type' => 'colorpicker',
						'value' => '',
						'group' => esc_html__( 'Table', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Link Color', 'gpur' ),
						'param_name' => 'cell_link_color',
						'type' => 'colorpicker',
						'value' => '',
						'group' => esc_html__( 'Table', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Link Hover Color', 'gpur' ),
						'param_name' => 'cell_link_hover_color',
						'type' => 'colorpicker',
						'value' => '',
						'group' => esc_html__( 'Table', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Extra CSS', 'gpur' ),
						'param_name' => 'cell_extra_css',
						'type' => 'textfield',
						'value' => '',
						'group' => esc_html__( 'Table', 'gpur' ),
					),	

				// Cell Titles
				array( 
					'param_name' => '_gpur_header_cell_titles',
					'heading' => esc_html__( 'Cell Titles', 'gpur' ),
					'type' => 'gpur_header',
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'group' => esc_html__( 'Table', 'gpur' ),
				),
					array( 
						'heading' => esc_html__( 'Ranking Numbers Title', 'gpur' ),
						'param_name' => 'ranking_numbers_label',
						'type' => 'textfield',
						'value' => '',
						'group' => esc_html__( 'Table', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Post Title Title', 'gpur' ),
						'param_name' => 'post_title_label',
						'type' => 'textfield',
						'value' => esc_html__( 'Title', 'gpur' ),
						'group' => esc_html__( 'Table', 'gpur' ),
					),		
					array( 
						'heading' => esc_html__( 'Post Date Title', 'gpur' ),
						'param_name' => 'post_date_label',
						'type' => 'textfield',
						'value' => esc_html__( 'Date', 'gpur' ),
						'group' => esc_html__( 'Table', 'gpur' ),
					),	
					array( 
						'heading' => esc_html__( 'Post Categories Title', 'gpur' ),
						'param_name' => 'post_cats_label',
						'type' => 'textfield',
						'value' => esc_html__( 'Categories', 'gpur' ),
						'group' => esc_html__( 'Table', 'gpur' ),
					),	
					array( 
						'heading' => esc_html__( 'Post Tags Title', 'gpur' ),
						'param_name' => 'post_tags_label',
						'type' => 'textfield',
						'value' => esc_html__( 'Tags', 'gpur' ),
						'group' => esc_html__( 'Table', 'gpur' ),
					),	
					array( 
						'heading' => esc_html__( 'Site Rating Title', 'gpur' ),
						'param_name' => 'cell_site_rating_label',
						'type' => 'textfield',
						'value' => esc_html__( 'Site Rating', 'gpur' ),
						'group' => esc_html__( 'Table', 'gpur' ),
					),	
					array( 
						'heading' => esc_html__( 'User Rating Title', 'gpur' ),
						'param_name' => 'user_rating_label',
						'type' => 'textfield',
						'value' => esc_html__( 'User Rating', 'gpur' ),
						'group' => esc_html__( 'Table', 'gpur' ),
					),		
					array( 
						'heading' => esc_html__( 'User Votes Title', 'gpur' ),
						'param_name' => 'user_votes_label',
						'type' => 'textfield',
						'value' => esc_html__( 'User Votes', 'gpur' ),
						'group' => esc_html__( 'Table', 'gpur' ),
					),	
					array( 
						'heading' => esc_html__( 'Summary Title', 'gpur' ),
						'param_name' => 'summary_label',
						'type' => 'textfield',
						'value' => esc_html__( 'Summary', 'gpur' ),
						'group' => esc_html__( 'Table', 'gpur' ),
					),
					
					array( 
						'heading' => esc_html__( 'Excerpt Title', 'gpur' ),
						'param_name' => 'excerpt_label',
						'type' => 'textfield',
						'value' => esc_html__( 'Excerpt', 'gpur' ),
						'group' => esc_html__( 'Table', 'gpur' ),
					),			
					array( 
						'heading' => esc_html__( 'Review Image Title', 'gpur' ),
						'param_name' => 'review_image_label',
						'type' => 'textfield',
						'value' => '',
						'group' => esc_html__( 'Table', 'gpur' ),
					),	
					array( 
						'heading' => esc_html__( 'Button Title', 'gpur' ),
						'param_name' => 'button_label',
						'type' => 'textfield',
						'value' => '',
						'group' => esc_html__( 'Table', 'gpur' ),
					),							
					array( 
						'heading' => esc_html__( 'Good Points Title', 'gpur' ),
						'param_name' => 'good_points_label',
						'type' => 'textfield',
						'value' => esc_html__( 'Good Points', 'gpur' ),
						'group' => esc_html__( 'Table', 'gpur' ),
					),								
					array( 
						'heading' => esc_html__( 'Bad Points Title', 'gpur' ),
						'param_name' => 'bad_points_label',
						'type' => 'textfield',
						'value' => esc_html__( 'Bad Points', 'gpur' ),
						'group' => esc_html__( 'Table', 'gpur' ),
					),						
					array( 
						'heading' => esc_html__( 'Likes Title', 'gpur' ),
						'param_name' => 'likes_label',
						'type' => 'textfield',
						'value' => esc_html__( 'Likes', 'gpur' ),
						'group' => esc_html__( 'Table', 'gpur' ),
					),		
					array( 
						'heading' => esc_html__( 'Dislikes Title', 'gpur' ),
						'param_name' => 'dislikes_label',
						'type' => 'textfield',
						'value' => esc_html__( 'Dislikes', 'gpur' ),
						'group' => esc_html__( 'Table', 'gpur' ),
					),

				/*--------------------------------------------------------------
				Items
				--------------------------------------------------------------*/
								
				array( 
					'param_name' => 'post_types',
					'heading' => esc_html__( 'Post Types', 'gpur' ),
					'type' => 'posttypes',
					'std' => 'post',
					'group' => esc_html__( 'Items', 'gpur' ),
				),	
				
				array( 
					'param_name' => 'ids',
					'heading' => esc_html__( 'Post/Page IDs', 'gpur' ),
					'description' => esc_html__( 'Enter the post/pages IDs you want to show - separate IDs with a comma e.g. 123, 456, 789', 'gpur' ),
					'type' => 'textfield',
					'group' => esc_html__( 'Items', 'gpur' ),
				),	
								
				array( 
					'param_name' => 'cats',
					'heading' => esc_html__( 'Categories', 'gpur' ),
					'description' => esc_html__( 'Enter the category slugs you want to display posts from - separate slugs with a comma e.g. category-1, category-2, category-3', 'gpur' ),
					'type' => 'textfield',
					'group' => esc_html__( 'Items', 'gpur' ),
				),		

				array( 
					'param_name' => 'tags',
					'heading' => esc_html__( 'Tags', 'gpur' ),
					'description' => esc_html__( 'Enter the tag slugs you want to display posts from - separate slugs with a comma e.g. tag-1, tag-2, tag-3', 'gpur' ),
					'type' => 'textfield',
					'group' => esc_html__( 'Items', 'gpur' ),
				),

				array( 
					'heading' => esc_html__( 'Sort', 'gpur' ),
					'param_name' => 'sort',
					'type' => 'dropdown',
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
					'group' => esc_html__( 'Items', 'gpur' ),
				),	

				array( 
					'param_name' => 'user_sorting',	
					'heading' => esc_html__( 'User Sorting', 'gpur' ),
					'description' => esc_html__( 'Allow users to change the order of the table.', 'gpur' ),
					'type' => 'checkbox',
					'value' => array( '' => '1' ),
					'std' => '1',
					'group' => esc_html__( 'Items', 'gpur' ),
				),	
								
				array( 
					'param_name' => 'number',
					'heading' => esc_html__( 'Number', 'gpur' ),
					'type' => 'textfield',
					'value' => '10',
					'group' => esc_html__( 'Items', 'gpur' ),
				),		
				
				array( 
					'heading' => esc_html__( 'Rating Range', 'gpur' ),
					'description' => esc_html__( 'Only display ratings within this range e.g. 1.0-3.5', 'gpur' ),
					'param_name' => 'rating_range',
					'type' => 'textfield',
					'value' => '',
				),
																									
				/*--------------------------------------------------------------
				Summary
				--------------------------------------------------------------*/
																		
				array( 
					'heading' => esc_html__( 'Summary Length', 'gpur' ),
					'description' => esc_html__( 'The number of characters in the summary. Leave empty to display all characters.', 'gpur' ),
					'param_name' => 'summary_length',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Summary', 'gpur' ),
				),		
				
				/*--------------------------------------------------------------
				Excerpt
				--------------------------------------------------------------*/

				array( 
					'heading' => esc_html__( 'Excerpt Length', 'gpur' ),
					'description' => esc_html__( 'The number of characters in the excerpt. Leave empty to display all characters.', 'gpur' ),
					'param_name' => 'excerpt_length',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Excerpt', 'gpur' ),
				),	
					
				/*--------------------------------------------------------------
				Image
				--------------------------------------------------------------*/
								
				array( 
					'param_name' => 'image_size',
					'heading' => esc_html__( 'Image Size', 'gpur' ),
					'description' => esc_html__( 'Enter image size e.g. "thumbnail", "medium", "large", "full" or enter size in pixels e.g. 200 x 100 (width x height).', 'gpur' ),
					'type' => 'textfield',
					'value' => 'thumbnail',
					'group' => esc_html__( 'Image', 'gpur' ),
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
								'dependency' => array( 
									'element' => 'show_ind_user_rating_text', 
									'not_empty' => true, 
								),
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
								'std' => '',
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
				Button
				--------------------------------------------------------------*/

				array( 
					'param_name' => '_gpur_header_button_text',
					'heading' => esc_html__( 'Text', 'gpur' ),
					'type' => 'gpur_header',
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'group' => esc_html__( 'Button', 'gpur' ),
				),					
					array( 
						'heading' => esc_html__( 'Button Text', 'gpur' ),	
						'param_name' => 'button_text',
						'type' => 'textfield',
						'value' => esc_html__( 'Button Text', 'gpur' ),
						'group' => esc_html__( 'Button', 'gpur' ),
					),			
					array( 
						'heading' => esc_html__( 'Text Color', 'gpur' ),
						'param_name' => 'button_text_color',
						'type' => 'colorpicker',
						'value' => '#ffffff',
						'group' => esc_html__( 'Button', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Size (px)', 'gpur' ),
						'param_name' => 'button_text_size',
						'type' => 'textfield',
						'value' => '20px',
						'group' => esc_html__( 'Button', 'gpur' ),
					),	
					array( 
						'heading' => esc_html__( 'Hover Color', 'gpur' ),
						'param_name' => 'button_text_hover_color',
						'type' => 'colorpicker',
						'value' => '#ffffff',
						'group' => esc_html__( 'Button', 'gpur' ),
					),	

				array( 
					'param_name' => '_gpur_header_button_advanced',
					'heading' => esc_html__( 'Advanced', 'gpur' ),
					'type' => 'gpur_header',
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'group' => esc_html__( 'Button', 'gpur' ),
				),				
					array( 
						'heading' => esc_html__( 'Padding Width (px)', 'gpur' ),
						'param_name' => 'button_padding_width',
						'type' => 'textfield',
						'value' => '15px',
						'group' => esc_html__( 'Button', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Padding Height (px)', 'gpur' ),
						'param_name' => 'button_padding_height',
						'type' => 'textfield',
						'value' => '10px',
						'group' => esc_html__( 'Button', 'gpur' ),
					),

				array( 
					'param_name' => '_gpur_header_button_background',
					'heading' => esc_html__( 'Background', 'gpur' ),
					'type' => 'gpur_header',
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'group' => esc_html__( 'Button', 'gpur' ),
				),							
					array( 
						'heading' => esc_html__( 'Background Color', 'gpur' ),
						'param_name' => 'button_color',
						'type' => 'colorpicker',
						'value' => '#000',
						'group' => esc_html__( 'Button', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Background Hover Color', 'gpur' ),
						'param_name' => 'button_hover_color',
						'type' => 'colorpicker',
						'value' => '#333333',
						'group' => esc_html__( 'Button', 'gpur' ),
					),
				
				array( 
					'param_name' => 'border_header',
					'heading' => esc_html__( 'Border', 'gpur' ),
					'type' => 'gpur_header',
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'group' => esc_html__( 'Button', 'gpur' ),
				),
					array( 
						'heading' => esc_html__( 'Border Width (px)', 'gpur' ),
						'param_name' => 'button_border_width',
						'type' => 'textfield',
						'value' => '',
						'group' => esc_html__( 'Button', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Border Radius (px)', 'gpur' ),
						'param_name' => 'button_border_radius',
						'type' => 'textfield',
						'value' => '',
						'group' => esc_html__( 'Button', 'gpur' ),
					),	
					array( 
						'heading' => esc_html__( 'Border Color', 'gpur' ),
						'param_name' => 'button_border_color',
						'type' => 'colorpicker',
						'value' => '',
						'group' => esc_html__( 'Button', 'gpur' ),
					),	
					array( 
						'heading' => esc_html__( 'Border Hover Color', 'gpur' ),
						'param_name' => 'button_border_hover_color',
						'type' => 'colorpicker',
						'value' => '',
						'group' => esc_html__( 'Button', 'gpur' ),
					),
						
				array( 
					'param_name' => '_gpur_header_button_icon',
					'heading' => esc_html__( 'Icon', 'gpur' ),
					'type' => 'gpur_header',
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'group' => esc_html__( 'Button', 'gpur' ),
				),
					array( 
						'heading' => esc_html__( 'Icon', 'gpur' ),
						'param_name' => 'button_icon',
						'type' => 'iconpicker',
						'value' => '',
						'group' => esc_html__( 'Button', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Icon Size', 'gpur' ),
						'param_name' => 'button_icon_size',
						'type' => 'textfield',
						'value' => '20px',
						'group' => esc_html__( 'Button', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Icon Color', 'gpur' ),
						'param_name' => 'button_icon_color',
						'type' => 'colorpicker',
						'value' => '#ffffff',
						'group' => esc_html__( 'Button', 'gpur' ),
					),	
					array( 
						'heading' => esc_html__( 'Icon Hover Color', 'gpur' ),
						'param_name' => 'button_icon_hover_color',
						'type' => 'colorpicker',
						'value' => '#ffffff',
						'group' => esc_html__( 'Button', 'gpur' ),
					),	
					array( 
						'heading' => esc_html__( 'Alignment', 'gpur' ),
						'param_name' => 'button_icon_alignment',
						'type' => 'dropdown',
						'value' => array(
							esc_html__( 'Left', 'gpur' ) => 'icon-left',
							esc_html__( 'Right', 'gpur' ) => 'icon-right',
						),
						'std' => 'icon-left',
						'group' => esc_html__( 'Button', 'gpur' ),
					),
				
				/*--------------------------------------------------------------
				Good Points
				--------------------------------------------------------------*/
					
				array( 
					'param_name' => '_gpur_header_good_points_icon',
					'heading' => esc_html__( 'Icon', 'gpur' ),
					'type' => 'gpur_header',
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'group' => esc_html__( 'Good Points', 'gpur' ),
				),
					array( 
						'heading' => esc_html__( 'Icon', 'gpur' ),
						'param_name' => 'good_icon',
						'type' => 'iconpicker',
						'value' => 'fa fa-angle-right',
						'group' => esc_html__( 'Good Points', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Size (px)', 'gpur' ),
						'param_name' => 'good_icon_size',
						'type' => 'textfield',
						'value' => '',
						'group' => esc_html__( 'Good Points', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Color', 'gpur' ),
						'param_name' => 'good_icon_color',
						'type' => 'colorpicker',
						'value' => '',
						'group' => esc_html__( 'Good Points', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Extra CSS', 'gpur' ),
						'param_name' => 'good_icon_extra_css',
						'type' => 'textfield',
						'value' => '',
						'group' => esc_html__( 'Good Points', 'gpur' ),
					),
				
				array( 
					'param_name' => '_gpur_header_good_points_text',
					'heading' => esc_html__( 'Text', 'gpur' ),
					'type' => 'gpur_header',
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'group' => esc_html__( 'Good Points', 'gpur' ),
				),
					array( 
						'heading' => esc_html__( 'Size (px)', 'gpur' ),
						'param_name' => 'good_text_size',
						'type' => 'textfield',
						'value' => '',
						'group' => esc_html__( 'Good Points', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Color', 'gpur' ),
						'param_name' => 'good_text_color',
						'type' => 'colorpicker',
						'value' => '',
						'group' => esc_html__( 'Good Points', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Extra CSS', 'gpur' ),
						'param_name' => 'good_text_extra_css',
						'type' => 'textfield',
						'value' => '',
						'group' => esc_html__( 'Good Points', 'gpur' ),
					),	
				
				/*--------------------------------------------------------------
				Bad Points
				--------------------------------------------------------------*/
							
				array( 
					'param_name' => '_gpur_header_bad_points_icon',
					'heading' => esc_html__( 'Icon', 'gpur' ),
					'type' => 'gpur_header',
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'group' => esc_html__( 'Bad Points', 'gpur' ),
				),
					array( 
						'heading' => esc_html__( 'Icon', 'gpur' ),
						'param_name' => 'bad_icon',
						'type' => 'iconpicker',
						'value' => 'fa fa-angle-right',
						'group' => esc_html__( 'Bad Points', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Icon Color', 'gpur' ),
						'param_name' => 'bad_icon_color',
						'type' => 'colorpicker',
						'value' => '',
						'group' => esc_html__( 'Bad Points', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Icon Size (px)', 'gpur' ),
						'param_name' => 'bad_icon_size',
						'type' => 'textfield',
						'value' => '',
						'group' => esc_html__( 'Bad Points', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Extra CSS', 'gpur' ),
						'param_name' => 'bad_icon_extra_css',
						'type' => 'textfield',
						'value' => '',
						'group' => esc_html__( 'Bad Points', 'gpur' ),
					),

				array( 
					'param_name' => '_gpur_header_bad_points_text',
					'heading' => esc_html__( 'Text', 'gpur' ),
					'type' => 'gpur_header',
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'group' => esc_html__( 'Bad Points', 'gpur' ),
				),
					array( 
						'heading' => esc_html__( 'Text Color', 'gpur' ),
						'param_name' => 'bad_text_color',
						'type' => 'colorpicker',
						'value' => '',
						'group' => esc_html__( 'Bad Points', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Text Size (px)', 'gpur' ),
						'param_name' => 'bad_text_size',
						'type' => 'textfield',
						'value' => '',
						'group' => esc_html__( 'Bad Points', 'gpur' ),
					),
					array( 
						'heading' => esc_html__( 'Extra CSS', 'gpur' ),
						'param_name' => 'bad_text_extra_css',
						'type' => 'textfield',
						'value' => '',
						'group' => esc_html__( 'Bad Points', 'gpur' ),
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
																																													
			 )
		) );
		
	}		
} 
add_action( 'vc_before_init', 'gpur_wpb_comparison_table_options' );

/**
 * Shortcode
 *
 */
if ( ! function_exists( 'gpur_comparison_table_shortcode' ) ) {
	function gpur_comparison_table_shortcode( $atts ) {

		$atts = shortcode_atts( gpur_comparison_table_shortcode_atts(), $atts, 'gpur_comparison_table_shortcode' );
		
		// Extract attributes
		extract( $atts );
			
		ob_start();

		// Load template
		echo gpur_comparison_table_template( array( 'atts' => $atts ) );	
	
		$output = ob_get_contents();
		ob_end_clean();
		return $output;

	}
}
add_shortcode( 'gpur_comparison_table', 'gpur_comparison_table_shortcode' );