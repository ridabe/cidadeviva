<?php if ( ! function_exists( 'gpur_global_setting_sections' ) ) {
	function gpur_global_setting_sections( $theme_slug = '' ) {	 

		$sections = array(
		
			$theme_slug . '_general' => array(
				'id' => $theme_slug . '_general',
				'title' => esc_html__( 'General', 'gpur' ),
				'subsections' => array(				
					$theme_slug . '_general' => array(
						'title' => esc_html__( 'General', 'gpur' ),
					),
				),	
			),	
			
			$theme_slug . '_comment_form' => array(
				'id' => $theme_slug . '_comment_form',
				'title' => esc_html__( 'Comments', 'gpur' ),
				'subsections' => array(				
					$theme_slug . '_comment_form' => array(
						'title' => esc_html__( 'Comment Form', 'gpur' ),
					),
					$theme_slug . '_comment_list' => array(
						'title' => esc_html__( 'Comment List', 'gpur' ),
					),
					$theme_slug . '_comment_summary' => array(
						'title' => esc_html__( 'Comment Summary', 'gpur' ),
					),
					$theme_slug . '_comment_ratings' => array(
						'title' => esc_html__( 'Comment Ratings', 'gpur' ),
					),
					$theme_slug . '_comment_udv' => array(
						'title' => esc_html__( 'Comment Up/Down Voting', 'gpur' ),
					),
				),
			),		

			$theme_slug . '_advanced' => array(
				'id' => $theme_slug . '_advanced',
				'title' => esc_html__( 'Advanced', 'gpur' ),
				'subsections' => array(
					$theme_slug . '_advanced' => array(
						'title' => esc_html__( 'Advanced', 'gpur' ),						
						'desc' => esc_html__( 'Advanced settings for the plugin.', 'gpur' ),
					),
				),
			),	
						
		);
				
		$sections = apply_filters( 'gpur_global_setting_sections', $sections, $theme_slug );
		
		return $sections;
				
	}
}		
		
if ( ! function_exists( 'gpur_global_settings' ) ) {
	function gpur_global_settings( $theme_slug = '' ) {

		$settings = array(

			/**
			 * General tab
			 *
			 */
			array(
				'id' => 'review_post_types',
				'title' => esc_html__( 'Review Post Types', 'gpur' ),
				'section' => $theme_slug . '_general',
				'desc' => esc_html__( 'Choose which post types can have reviews.', 'gpur' ),
				'type' => 'checkbox',
				'data' => 'post_types',
				'default' => array( 'post' => 'post', 'page' => 'page' ),
			),

			array(
				'id' => 'review_management',
				'title' => esc_html__( 'Review Management', 'gpur' ),
				'section' => $theme_slug . '_general',
				'desc' => esc_html__( 'Choose which roles can add review data e.g. site ratings, summaries, good and bad points etc.', 'gpur' ),
				'type' => 'checkbox',
				'data' => 'roles',
				'default' => array( 'administrator' => 'administrator' ),
			),

			/**
			 * Comment Form
			 *
			 */

			// Comment Form - Rating Field				
			array(
				'id' => '_gpur_section_comment_form_general',
				'title' => esc_html__( 'General', 'gpur' ),
				'section' => $theme_slug . '_comment_form',
				'label_for' => 'gp-section-header',	
				'type' => 'section-header',
				'class' => 'gp-setting gp-setting-begin',	
			),			
				array(
					'id' => 'comment_form_review_support',
					'title' => esc_html__( 'Review Support', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'type' => 'radio',
					'desc' => esc_html__( 'Choose to add review features to your theme comments.', 'gpur' ),
					'options' => array(
						'enabled' => esc_html__( 'Enabled', 'gpur' ),
						'disabled' => esc_html__( 'Disabled', 'gpur' ),
					),
					'default' => 'enabled',
				),
				array(
					'id' => 'comment_form_post_types',
					'title' => esc_html__( 'Post Types', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'desc' => esc_html__( 'Choose which post types can have review comments.', 'gpur' ),
					'type' => 'checkbox',
					'data' => 'post_types',
					'default' => array( 'post' => 'post' ),
					'conditions' => array(
						'comment_form_review_support' =>'enabled',
					),
				),				
				array(
					'id' => 'comment_form_ids',
					'title' => esc_html__( 'Post/Page IDs', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'desc' => esc_html__( 'Enter the IDs of the post/pages that can have review comments - separate each ID with a comma e.g. 123, 456, 789', 'gpur' ),
					'type' => 'text',
					'conditions' => array(
						'comment_form_review_support' =>'enabled',
					),
				),
				array(
					'id' => 'comment_form_cats',
					'title' => esc_html__( 'Categories', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'desc' => esc_html__( 'Enter the category slugs for the posts that can have review comments - separate slugs with a comma e.g. category-1, category-2, category-3', 'gpur' ),
					'type' => 'text',		
					'conditions' => array(
						'comment_form_review_support' =>'enabled',
					),
				),
				array(
					'id' => 'comment_form_tags',
					'title' => esc_html__( 'Tags', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'desc' => esc_html__( 'Enter the tag slugs for the posts that can have review comments - separate slugs with a comma e.g. tag-1, tag-2, tag-3.', 'gpur' ),
					'type' => 'text',
					'conditions' => array(
						'comment_form_review_support' =>'enabled',
					),
				),
						
			// Comment Form - Review Fields
			array(
				'id' => '_gpur_section_comment_form_review_fields',
				'title' => esc_html__( 'Review Fields', 'gpur' ),
				'section' => $theme_slug . '_comment_form',
				'label_for' => 'gp-section-header',	
				'type' => 'section-header',
				'class' => 'gp-setting gp-setting-begin',
				'conditions' => array(
					'comment_form_review_support' =>'enabled',
				),
			),	
				array(
					'id' => 'comment_form_review_title',
					'title' => esc_html__( 'Review Title', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'type' => 'radio',
					'options' => array(
						'enabled' => esc_html__( 'Enabled', 'gpur' ),
						'disabled' => esc_html__( 'Disabled', 'gpur' ),
					),
					'default' => 'enabled',
					'conditions' => array(
						'comment_form_review_support' => 'enabled',
					),	
				),
				array(
					'id' => 'comment_form_review_title_field_label',
					'title' => esc_html__( 'Review Title Field Label', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'type' => 'text',
					'default' => esc_html__( 'Review Title', 'gpur' ),
					'conditions' => array(
						'comment_form_review_title' => 'enabled',
						'comment_form_review_support' => 'enabled',
					),
				),	
				array(
					'id' => 'comment_form_review_text_field_label',
					'title' => esc_html__( 'Review Text Field Label', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'type' => 'text',
					'default' => esc_html__( 'Comment', 'gpur' ),
					'conditions' => array(
						'comment_form_review_support' => 'enabled',
					),
				),	
				array(
					'id' => 'comment_form_title_length',
					'title' => esc_html__( 'Review Title Length', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'type' => 'text',
					'desc' => esc_html__( 'The number of characters allowed. Leave empty to display all characters.', 'gpur' ),
					'default' => '',
					'conditions' => array(
						'comment_form_review_title' => 'enabled',
						'comment_form_review_support' => 'enabled',
					),
				),					
				array(
					'id' => 'comment_form_text_length',
					'title' => esc_html__( 'Review Text Length', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'type' => 'text',
					'desc' => esc_html__( 'The number of characters allowed. Leave empty to display all characters.', 'gpur' ),
					'default' => '',
					'conditions' => array(
						'comment_form_review_support' => 'enabled',
					),
				),
				array(
					'id' => 'comment_form_character_limit_label',
					'title' => esc_html__( 'Character Limit Label', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'type' => 'text',
					'desc' => '<code>%NUMBER%</code>' . esc_html__( 'represents the character limit set above.', 'gpur' ),
					'default' => esc_html__( '%NUMBER% characters remaining.', 'gpur' ),
					'conditions' => array(
						'comment_form_review_support' => 'enabled',
					),
				),
				
			// Comment Form - Rating Field				
			array(
				'id' => '_gpur_section_comment_form_rating_field',
				'title' => esc_html__( 'Rating Field', 'gpur' ),
				'section' => $theme_slug . '_comment_form',
				'label_for' => 'gp-section-header',	
				'type' => 'section-header',
				'class' => 'gp-setting gp-setting-begin',	
				'conditions' => array(
					'comment_form_review_support' => 'enabled',
				),
			),
				array(
					'id' => 'comment_form_comment_rating_limit',
					'title' => esc_html__( 'Comment/Rating Limit', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'type' => 'select',
					'desc' => esc_html__( 'Choose whether uses can rate and comment multiple times.', 'gpur' ),
					'options' => array(
						'one-rating-one-comment' => esc_html__( 'One rating / One comment', 'gpur' ),
						'one-rating-multi-comments' => esc_html__( 'One rating / Multiple comments', 'gpur' ),
						'multi-ratings-multi-comments' => esc_html__( 'Multiple ratings / Multiple comments', 'gpur' ),
					),
					'default' => 'one-rating-one-comment',
					'conditions' => array(
						'comment_form_review_support' => 'enabled',
					),
				
				),		
				array(
					'id' => 'comment_form_rating_field_label',
					'title' => esc_html__( 'Rating Field Label', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'type' => 'text',
					'default' => esc_html__( 'Your Review', 'gpur' ),
					'conditions' => array(
						'comment_form_review_support' => 'enabled',
					),
				),
				array(
					'id' => 'comment_form_min_rating',
					'title' => esc_html__( 'Minimum Rating', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'type' => 'text',
					'default' => 0,
					'conditions' => array(
						'comment_form_review_support' => 'enabled',
					),

				),
				array(
					'id' => 'comment_form_max_rating',
					'title' => esc_html__( 'Maximum Rating', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'type' => 'text',
					'default' => 5,
					'conditions' => array(
						'comment_form_review_support' => 'enabled',
					),
				),
				array(
					'id' => 'comment_form_fractions',
					'title' => esc_html__( 'Rating Fractions', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'type' => 'text',
					'desc' => esc_html__( 'The increments you can rate for each rating symbol.', 'gpur' ),
					'default' => 1,
					'conditions' => array(
						'comment_form_review_support' => 'enabled',
					),
				),
				array(
					'id' => 'comment_form_step',
					'title' => esc_html__( 'Rating Step', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'type' => 'text',
					'desc' => esc_html__( 'The rating range spans all the integers from minimum to maximum rating.', 'gpur' ),
					'default' => 1,
					'conditions' => array(
						'comment_form_review_support' => 'enabled',
					),
				),
				array(
					'id' => 'comment_form_decimal_places',
					'title' => esc_html__( 'Decimal Places', 'gpur' ),
					'desc' => esc_html__( 'The number of decimal places to show the rating to.', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'type' => 'text',
					'default' => 1,
					'conditions' => array(
						'comment_form_review_support' => 'enabled',
					),
				),
				array(
					'id' => 'comment_form_criteria',
					'title' => esc_html__( 'Criteria & Weights', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'type' => 'textarea',
					'desc' => esc_html__( 'Enter each criterion on a new line. To add weights add a colon and then the weight e.g.', 'gpur' ) . '<br/><code>' . esc_html__( 'Criterion 1:0.5', 'gpur' ) . '</code><br/><code>' . esc_html__( 'Criterion 2:0.75', 'gpur' ) . '</code>',
					'conditions' => array(
						'comment_form_review_support' => 'enabled',
					),
				),
				array(
					'id' => 'comment_form_criteria_format',
					'title' => esc_html__( 'Criteria Format', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'type' => 'select',
					'options' => array(
						'format-column' => esc_html__( 'Column', 'gpur' ),
						'format-rows' => esc_html__( 'Rows', 'gpur' ),
					),
					'default' => 'format-rows',
					'conditions' => array(
						'comment_form_criteria' => array(
							'operator' => 'not_empty',
						),
						'comment_form_review_support' => 'enabled',
					),
				),	
				array(
					'id' => 'comment_form_criteria_title',
					'title' => esc_html__( 'Criteria Title', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'type' => 'styling',
					'styling' => array(
						'color' => array(
							'title' => esc_html__( 'Color', 'gpur' ),
							'type' => 'color',
							'default' => '',
						),
						'size' => array(
							'title' => esc_html__( 'Size', 'gpur' ),
							'type' => 'dimensions',
							'default' => '',
						),
						'extra_css' => array(
							'title' => esc_html__( 'Extra CSS', 'gpur' ),
							'type' => 'extra_css',
							'default' => '',
						),
					),
					'conditions' => array(
						'comment_form_criteria' => array(
							'operator' => 'not_empty',
						),
						'comment_form_review_support' => 'enabled',
					),	
				),				
				array(
					'id' => 'comment_form_style',
					'title' => esc_html__( 'Style', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'type' => 'select',
						'options' => array(
						'style-stars' => esc_html__( 'Stars', 'gpur' ), 
						'style-hearts' => esc_html__( 'Hearts', 'gpur' ),
						'style-squares' => esc_html__( 'Squares', 'gpur' ),
						'style-circles' => esc_html__( 'Circles', 'gpur' ),
						'style-bars' => esc_html__( 'Bars', 'gpur' ),
						'style-icon' => esc_html__( 'Custom Icon', 'gpur' ),
						'style-image' => esc_html__( 'Custom Image', 'gpur' ),
					),
					'default' => 'style-stars',
					'conditions' => array(
						'comment_form_review_support' => 'enabled',
					),
				),
				array(
					'id' => 'comment_form_rating_image',
					'title' => esc_html__( 'Custom Image', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'type' => 'media',
					'format' => 'image',
					'desc' => esc_html__( 'Your image should include the filled and empty icons. For an example see the', 'gpur' ) . ' <a href="' . GPUR_URL . 'public/images/default-rating-image.png" target="_blank">' . esc_html__( 'default image', 'gpur' ) . '</a>.',
					'conditions' => array(
						'comment_form_style' => 'style-image',
						'comment_form_review_support' => 'enabled',
					),

				),
				array(
					'id' => 'comment_form_icons',
					'title' => esc_html__( 'Icons', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'type' => 'styling',
					'styling' => array(
						'empty_icon' => array(
							'title' => esc_html__( 'Empty Icon', 'gpur' ),
							'type' => 'icon',
							'default' => gpur_fontawesome_icons( 'fa fa-star' ),
						),
						'filled_icon' => array(
							'title' => esc_html__( 'Filled Icon', 'gpur' ),
							'type' => 'icon',
							'default' => gpur_fontawesome_icons( 'fa fa-star' ),
						),
					),
					'conditions' => array(
						'comment_form_style' => 'style-icon',
						'comment_form_review_support' => 'enabled',
					),
				),
				array(
					'id' => 'comment_form_icon_styling',
					'title' => esc_html__( 'Icon Styling', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'type' => 'styling',
					'styling' => array(
						'icon_width' => array(
							'title' => esc_html__( 'Icon Width', 'gpur' ),
							'type' => 'dimensions',
							'default' => '',
						),
						'icon_height' => array(
							'title' => esc_html__( 'Icon Height', 'gpur' ),
							'type' => 'dimensions',
							'default' => '',
						),
						'empty_icon_color' => array(
							'title' => esc_html__( 'Empty Icon Color', 'gpur' ),
							'type' => 'color',
							'default' => '',
						),
						'filled_icon_color' => array(
							'title' => esc_html__( 'Filled Icon Color', 'gpur' ),
							'type' => 'color',
							'default' => '',
						),
					),
					'conditions' => array(
						'comment_form_review_support' => 'enabled',
					),			
				),
				array(
					'id' => 'comment_form_show_ind_user_rating_text',
					'title' => esc_html__( 'Display Rating Text', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'type' => 'checkbox',
					'default' => '',
					'conditions' => array(
						'comment_form_review_support' => 'enabled',
					),
				),
				array(
					'id' => 'comment_form_text_position',
					'title' => esc_html__( 'Rating Text Position', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'type' => 'select',
					'options' => array(
						'position-text-top' => esc_html__( 'Top', 'gpur' ), 
						'position-text-bottom' => esc_html__( 'Bottom', 'gpur' ),
						'position-text-left' => esc_html__( 'Left', 'gpur' ),
						'position-text-right' => esc_html__( 'Right', 'gpur' ),
					),
					'default' => 'position-text-bottom',
					'conditions' => array(
						'comment_form_show_ind_user_rating_text' => array(
							'operator' => 'not_empty',
						),	
						'comment_form_review_support' => 'enabled',
					),
				),
				array(
					'id' => 'comment_form_ind_user_rating_label_text',
					'title' => esc_html__( 'Label Text', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'type' => 'text',
					'default' => esc_html__( 'Your Rating:', 'gpur' ),
					'conditions' => array(
						'comment_form_show_ind_user_rating_text' => array(
							'operator' => 'not_empty',
						),	
						'comment_form_review_support' => 'enabled',
					),

				),	
				array(
					'id' => 'comment_form_ind_user_rating_label',
					'title' => esc_html__( 'Label Styling', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'type' => 'styling',
					'styling' => array( 
						'color' => array(
							'title' => esc_html__( 'Color', 'gpur' ),
							'type' => 'color',
							'default' => '',
						),
						'size' => array(
							'title' => esc_html__( 'Size', 'gpur' ),
							'type' => 'dimensions',
							'default' => '',
						),
						'extra_css' => array(
							'title' => esc_html__( 'Extra CSS', 'gpur' ),
							'type' => 'extra_css',
							'default' => '',
						),
					),
					'conditions' => array(
						'comment_form_show_ind_user_rating_text' => array(
							'operator' => 'not_empty',
						),	
						'comment_form_review_support' => 'enabled',
					),
				),		
				array(
					'id' => 'comment_form_ind_user_rating_number',
					'title' => esc_html__( 'Rating Number Styling', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'type' => 'styling',
					'styling' => array( 
						'color' => array(
							'title' => esc_html__( 'Color', 'gpur' ),
							'type' => 'color',
							'default' => '',
						),
						'size' => array(
							'title' => esc_html__( 'Size', 'gpur' ),
							'type' => 'dimensions',
							'default' => '',
						),
						'extra_css' => array(
							'title' => esc_html__( 'Extra CSS', 'gpur' ),
							'type' => 'extra_css',
							'default' => '',
						),
					),
					'conditions' => array(
						'comment_form_show_ind_user_rating_text' => array(
							'operator' => 'not_empty',
						),	
						'comment_form_review_support' => 'enabled',
					),
				),
				array(
					'id' => 'comment_form_show_ind_user_rating_max_rating_number',
					'title' => esc_html__( 'Display Maximum Rating Number', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'type' => 'checkbox',
					'default' => '',
					'conditions' => array(
						'comment_form_show_ind_user_rating_text' => array(
							'operator' => 'not_empty',
						),	
						'comment_form_review_support' => 'enabled',
					),
				),
				array(
					'id' => 'comment_form_ind_user_rating_max_rating_number',
					'title' => esc_html__( 'Maximum Rating Number Styling', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'type' => 'styling',
					'styling' => array(
						'color' => array(
							'title' => esc_html__( 'Color', 'gpur' ),
							'type' => 'color',
							'default' => '',
						),
						'size' => array(
							'title' => esc_html__( 'Size', 'gpur' ),
							'type' => 'dimensions',
							'default' => '',
						),
						'extra_css' => array(
							'title' => esc_html__( 'Extra CSS', 'gpur' ),
							'type' => 'extra_css',
							'default' => '',
						),
					),
					'conditions' => array(
						'comment_form_show_ind_user_rating_text' => array(
							'operator' => 'not_empty',
						),
						'comment_form_show_ind_user_rating_max_rating_number' => array(
							'operator' => 'not_empty',
						),
						'comment_form_review_support' => 'enabled',
					),		
				),
						
			// Comment Form - Permissions
			array(
				'id' => '_gpur_section_comment_form_permissions',
				'title' => esc_html__( 'Permissions', 'gpur' ),
				'section' => $theme_slug . '_comment_form',
				'label_for' => 'gp-section-header',	
				'type' => 'section-header',
				'class' => 'gp-setting gp-setting-begin',	
			),																		 
				array(
					'id' => 'comment_form_permissions',
					'title' => esc_html__( 'Comment Permissions', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'type' => 'select',
					'desc' => esc_html__( 'Choose which users or roles can submit comments.', 'gpur' ),
					'options' => array(
						'all-users' => esc_html__( 'All users', 'gpur' ),
						'logged-in-users' => esc_html__( 'Logged in users only', 'gpur' ),
						'specific-roles' => esc_html__( 'Specific roles only', 'gpur' ),
					),
					'default' => 'all-users',
				),
				array(
					'id' => 'comment_form_permission_roles',
					'title' => esc_html__( 'Roles', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'type' => 'checkbox',
					'data' => 'roles',
					'default' => array( 'administrator' => 'administrator' ),
					'conditions' => array(
						'comment_form_permissions' => 'specific-roles',
					),
				),			
				array(
					'id' => 'comment_form_rating_permissions',
					'title' => esc_html__( 'Rating Permissions', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'type' => 'select',
						'desc' => esc_html__( 'Choose which users or roles can submit ratings within comments.', 'gpur' ),
						'options' => array(
							'all-users' => esc_html__( 'All users', 'gpur' ),
							'logged-in-users' => esc_html__( 'Logged in users only', 'gpur' ),
							'specific-roles' => esc_html__( 'Specific roles only', 'gpur' ),
						),
						'default' => 'all-users',
				),
				array(
					'id' => 'comment_form_rating_permission_roles',
					'title' => esc_html__( 'Roles', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'type' => 'checkbox',
					'data' => 'roles',
					'default' => array( 'administrator' => 'administrator' ),						
					'conditions' => array(
						'comment_form_rating_permissions' => 'specific-roles',
					),
				),
				
			// Comment Form - Other
			array(
				'id' => '_gpur_section_comment_form_other',
				'title' => esc_html__( 'Other', 'gpur' ),
				'section' => $theme_slug . '_comment_form',
				'label_for' => 'gp-section-header',	
				'type' => 'section-header',
				'class' => 'gp-setting gp-setting-begin',	
			),	
				array(
					'id' => 'comment_form_already_voted_label',
					'title' => esc_html__( 'Already Commented/Voted Label', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'type' => 'text',
					'default' => esc_html__( 'You have already reviewed this post.', 'gpur' ),
				),		
				array(
					'id' => 'comment_form_logged_in_to_vote_label',
					'title' => esc_html__( 'Logged In To Vote Label', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'type' => 'text',
					'default' => esc_html__( 'You must be logged in to vote.', 'gpur' ),
				),
				array(
					'id' => 'comment_form_single_success_message',
					'title' => esc_html__( 'Success Message', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'type' => 'text',
					'default' => esc_html__( 'Thanks for submitting your comment!', 'gpur' ),
				),
				array(
					'id' => 'comment_form_single_error_message',
					'title' => esc_html__( 'Error Message', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'type' => 'text',
					'default' => esc_html__( 'These fields are required.', 'gpur' ),
				),
				array(
					'id' => 'comment_form_single_duplicate_comments',
					'title' => esc_html__( 'Duplicate Comments Error Message', 'gpur' ),
					'section' => $theme_slug . '_comment_form',
					'type' => 'text',
					'default' => esc_html__( 'You cannot post duplicate comments.', 'gpur' ),
				),
																						
			/**
			 * Comment list
			 *
			 */
			array(
				'id' => 'comment_list_show_title',
				'title' => esc_html__( 'Show Title', 'gpur' ),
				'section' => $theme_slug . '_comment_list',
				'type' => 'radio',
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gpur' ),
					'disabled' => esc_html__( 'Disabled', 'gpur' ),
				),	
				'default' => 'enabled',
			),
			
			array(
				'id' => 'comment_list_title',
				'title' => esc_html__( 'Title', 'gpur' ),
				'section' => $theme_slug . '_comment_list',
				'type' => 'text',
				'default' => esc_html__( 'Customer Reviews', 'gpur' ),		
				'conditions' => array(
					'comment_list_show_title' => 'enabled',
				),
			),

			array(
				'id' => 'comment_list_normal_comment_replies',
				'title' => esc_html__( 'Normal Comment Replies', 'gpur' ),
				'section' => $theme_slug . '_comment_list',
				'type' => 'radio',
				'options' => array(
					'normal_replies' => esc_html__( 'Normal Replies', 'gpur' ),
					'review_replies' => esc_html__( 'Review Replies', 'gpur' ),
					'disabled' => esc_html__( 'No Replies', 'gpur' ),
				),	
				'default' => 'normal_replies',		
			),

			array(
				'id' => 'comment_list_review_comment_replies',
				'title' => esc_html__( 'Review Comment Replies', 'gpur' ),
				'section' => $theme_slug . '_comment_list',
				'type' => 'radio',
				'options' => array(
					'normal_replies' => esc_html__( 'Normal Replies', 'gpur' ),
					'review_replies' => esc_html__( 'Review Replies', 'gpur' ),
					'disabled' => esc_html__( 'No Replies', 'gpur' ),
				),	
				'default' => 'normal_replies',		
			),
				
			array(
				'id' => 'comment_list_order_dropdown',
				'title' => esc_html__( 'Order Dropdown Menu', 'gpur' ),
				'section' => $theme_slug . '_comment_list',
				'type' => 'radio',
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gpur' ),
					'disabled' => esc_html__( 'Disabled', 'gpur' ),
				),	
				'default' => 'enabled',
			),

			array(
				'id' => 'comment_list_rating_dropdown',
				'title' => esc_html__( 'Rating Dropdown Menu', 'gpur' ),
				'section' => $theme_slug . '_comment_list',
				'type' => 'radio',
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gpur' ),
					'disabled' => esc_html__( 'Disabled', 'gpur' ),
				),	
				'default' => 'enabled',		
			),
																			
			/**
			 * Comment Summary
			 *
			 */

			// General
			array(
				'id' => '_gpur_section_comment_summary_general',
				'title' => esc_html__( 'General', 'gpur' ),
				'section' => $theme_slug . '_comment_summary',
				'type' => 'section-header',
				'class' => 'gp-setting gp-setting-begin',
			),	
			
				array(
					'id' => 'comment_summary',
					'title' => esc_html__( 'Summary', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
						'type' => 'radio',
						'desc' => esc_html__( 'Displays a summary of the percentage of each rating e.g. the number of 5, 4, 3, 2 and 1 star ratings.', 'gpur' ),
						'options' => array(
							'enabled' => esc_html__( 'Enabled', 'gpur' ),
							'disabled' => esc_html__( 'Disabled', 'gpur' ),
						),	
						'default' => 'enabled',
				),

			// Summary average
			array(
				'id' => '_gpur_section_comment_summary_average',
				'title' => esc_html__( 'Average Rating', 'gpur' ),
				'section' => $theme_slug . '_comment_summary',
				'type' => 'section-header',
				'class' => 'gp-setting gp-setting-begin',				
				'conditions' => array(
					'comment_summary' => 'enabled',
				),

			),
				array(
					'id' => 'comment_summary_avg_show_zero_rating',
					'title' => esc_html__( 'Display Zero Rating', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
					'type' => 'checkbox',
					'default' => '0',			
					'conditions' => array(
						'comment_summary' => 'enabled',
					),
				),
				array(
					'id' => 'comment_summary_avg_style',
					'title' => esc_html__( 'Style', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
					'type' => 'select',
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
					'conditions' => array(
						'comment_summary' => 'enabled',
					),
				),
				array(
					'id' => 'comment_summary_avg_image',
					'title' => esc_html__( 'Custom Image', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
					'type' => 'media',
					'format' => 'image',
					'conditions' => array(
						'comment_summary_avg_style' => 'style-image',			
						'comment_summary' => 'enabled',
					),
				),
				array(
					'id' => 'comment_summary_avg_icons',
					'title' => esc_html__( 'Icons', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
					'type' => 'styling',
					'styling' => array(
						'empty_icon' => array(
							'title' => esc_html__( 'Empty Icon', 'gpur' ),
							'type' => 'icon',
							'default' => gpur_fontawesome_icons( 'fa fa-star' ),
						),
						'filled_icon' => array(
							'title' => esc_html__( 'Filled Icon', 'gpur' ),
							'type' => 'icon',
							'default' => gpur_fontawesome_icons( 'fa fa-star' ),
						),
					),
					'conditions' => array(
						'comment_summary_avg_style' => 'style-icon',			
						'comment_summary' => 'enabled',
					),
				),
				array(
					'id' => 'comment_summary_avg_icon_styling',
					'title' => esc_html__( 'Icon Styling', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
					'type' => 'styling',
					'styling' => array(
						'icon_width' => array(
							'title' => esc_html__( 'Icon Width', 'gpur' ),
							'type' => 'dimensions',
							'default' => '',
						),
						'icon_height' => array(
							'title' => esc_html__( 'Icon Height', 'gpur' ),
							'type' => 'dimensions',
							'default' => '',
						),
						'empty_icon_color' => array(
							'title' => esc_html__( 'Empty Icon Color', 'gpur' ),
							'type' => 'color',
							'default' => '',
						),
						'filled_icon_color' => array(
							'title' => esc_html__( 'Filled Icon Color', 'gpur' ),
							'type' => 'color',
							'default' => '',
						),
					),			
					'conditions' => array(
						'comment_summary' => 'enabled',
					),
				),
				array(
					'id' => 'comment_summary_avg_rating_container',
					'title' => esc_html__( 'Rating Container Styling', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
					'type' => 'styling',
					'styling' => array(
						'width' => array(
							'title' => esc_html__( 'Width', 'gpur' ),
							'type' => 'dimensions',
							'default' => '',
						),
						'height' => array(
							'title' => esc_html__( 'Height', 'gpur' ),
							'type' => 'dimensions',
							'default' => '',
						),
						'background_color' => array(
							'title' => esc_html__( 'Background Color', 'gpur' ),
							'type' => 'color',
							'default' => '',
						),
						'border_width' => array(
							'title' => esc_html__( 'Border Width', 'gpur' ),
							'type' => 'dimensions',
							'default' => '',
						),
						'border_color' => array(
							'title' => esc_html__( 'Border Color', 'gpur' ),
							'type' => 'color',
							'default' => '',
						),
						'container_extra_css' => array(
							'title' => esc_html__( 'Container Extra CSS', 'gpur' ),
							'type' => 'extra_css',
							'default' => '',
						),
						'extra_css' => array(
							'title' => esc_html__( 'Text Extra CSS', 'gpur' ),
							'type' => 'extra_css',
							'default' => '',
						),
					),
					'conditions' => array(
						'comment_summary_avg_style' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
						'comment_summary' => 'enabled',
					),
				),
				array(
					'id' => 'comment_summary_avg_gauge',
					'title' => esc_html__( 'Gauge Styling', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
					'type' => 'styling',
					'styling' => array(
						'width' => array(
							'title' => esc_html__( 'Width', 'gpur' ),
							'type' => 'dimensions',
							'default' => '',
						),
						'filled_color_1' => array(
							'title' => esc_html__( 'Filled Color 1', 'gpur' ),
							'type' => 'empty_color',
							'default' => '',
						),
						'filled_color_2' => array(
							'title' => esc_html__( 'Filled Color 2', 'gpur' ),
							'type' => 'color',
							'default' => '',
						),
						'empty_color' => array(
							'title' => esc_html__( 'Empty Color', 'gpur' ),
							'type' => 'color',
							'default' => '',
						),
					),
					'conditions' => array(
						'comment_summary_avg_style' => 'style-gauge-circles-singular', 
						'comment_summary' => 'enabled',
					),
				),

				// Average User Rating Text
				array(
					'id' => 'comment_summary_avg_show_avg_user_rating_text',
					'title' => esc_html__( 'Display Rating Text', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
					'type' => 'checkbox',
					'default' => '0',
					'conditions' => array(
						'comment_summary' => 'enabled',
					),
				),
				array(
					'id' => 'comment_summary_avg_avg_user_rating_label_text',
					'title' => esc_html__( 'Label Text', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
					'type' => 'text',
					'default' => esc_html__( 'Average User Rating:', 'gpur' ),				
					'conditions' => array(
						'comment_summary_avg_show_avg_user_rating_text' => array(
							'operator' => 'not_empty',
						),
						'comment_summary' => 'enabled',
					),
				),				
				array(
					'id' => 'comment_summary_avg_avg_user_rating_label',
					'title' => esc_html__( 'Label Styling', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
					'type' => 'styling',
					'styling' => array( 
						'color' => array(
							'title' => esc_html__( 'Color', 'gpur' ),
							'type' => 'color',
							'default' => '',
						),
						'size' => array(
							'title' => esc_html__( 'Size', 'gpur' ),
							'type' => 'dimensions',
							'default' => '',
						),
						'extra_css' => array(
							'title' => esc_html__( 'Extra CSS', 'gpur' ),
							'type' => 'extra_css',
							'default' => '',
						),
					),			
					'conditions' => array(
						'comment_summary_avg_show_avg_user_rating_text' => array(
							'operator' => 'not_empty',
						),
						'comment_summary' => 'enabled',
					),
				),
				array(
					'id' => 'comment_summary_avg_avg_user_rating_number',
					'title' => esc_html__( 'Rating Number Styling', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
					'type' => 'styling',
					'styling' => array(
						'color' => array(
							'title' => esc_html__( 'Color', 'gpur' ),
							'type' => 'color',
							'default' => '',
						),
						'size' => array(
							'title' => esc_html__( 'Size', 'gpur' ),
							'type' => 'dimensions',
							'default' => '',
						),
						'extra_css' => array(
							'title' => esc_html__( 'Extra CSS', 'gpur' ),
							'type' => 'extra_css',
							'default' => '',
						),
					),				
					'conditions' => array(
						'comment_summary' => 'enabled',
					),
				),
				array(
					'id' => 'comment_summary_avg_show_avg_user_rating_max_rating_number',
					'title' => esc_html__( 'Display Maximum Rating Number', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
					'type' => 'checkbox',
					'default' => '0',
					'conditions' => array(
						'comment_summary' => 'enabled',
					),
				),
				array(
					'id' => 'comment_summary_avg_avg_user_rating_max_rating_number',
					'title' => esc_html__( 'Maximum Rating Number Styling', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
					'type' => 'styling',
					'styling' => array(
						'color' => array(
							'title' => esc_html__( 'Color', 'gpur' ),
							'type' => 'color',
							'default' => '',
						),
						'size' => array(
							'title' => esc_html__( 'Size', 'gpur' ),
							'type' => 'dimensions',
							'default' => '',
						),
						'extra_css' => array(
							'title' => esc_html__( 'Extra CSS', 'gpur' ),
							'type' => 'extra_css',
							'default' => '',
						),
					),		
					'conditions' => array(
						'comment_summary_avg_show_avg_user_rating_max_rating_number' => array(
							'operator' => 'not_empty',
						),
						'comment_summary' => 'enabled',
					),
				),
				
				// User Votes Text
				array(
					'id' => 'comment_summary_avg_show_user_votes_text',
					'title' => esc_html__( 'Display User Votes Text', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
					'type' => 'checkbox',
					'default' => '0',	
					'conditions' => array(
						'comment_summary' => 'enabled',
					),
				),
				array(
					'id' => 'comment_summary_avg_singular_vote_label',
					'title' => esc_html__( 'User Votes Label (Singular)', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
					'type' => 'text',
					'default' => esc_html__( 'vote', 'gpur' ),	
					'conditions' => array(
						'comment_summary_avg_show_user_votes_text' => array(
							'operator' => 'not_empty',
						),
						'comment_summary' => 'enabled',
					),
				),
				array(
					'id' => 'comment_summary_avg_plural_vote_label',
					'title' => esc_html__( 'User Votes Label (Plural)', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
					'type' => 'text',
					'default' => esc_html__( 'votes', 'gpur' ),
					'conditions' => array(
						'comment_summary_avg_show_user_votes_text' => array(
							'operator' => 'not_empty',
						),
						'comment_summary' => 'enabled',
					),
				),
				array(
					'id' => 'comment_summary_avg_user_votes_text',
					'title' => esc_html__( 'User Votes Text Styling', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
					'type' => 'styling',
					'styling' => array(
						'color' => array(
							'title' => esc_html__( 'Color', 'gpur' ),
							'type' => 'color',
							'default' => '',
						),
						'size' => array(
							'title' => esc_html__( 'Size', 'gpur' ),
							'type' => 'dimensions',
							'default' => '',
						),
						'extra_css' => array(
							'title' => esc_html__( 'Extra CSS', 'gpur' ),
							'type' => 'extra_css',
							'default' => '',
						),
					),
					'conditions' => array(
						'comment_summary_avg_show_user_votes_text' => array(
							'operator' => 'not_empty',
						),
						'comment_summary' => 'enabled',
					),
				),
	
			// Comment summary breakdown
			array(
				'id' => '_gpur_section_comment_summary_breakdown',
				'title' => esc_html__( 'Rating Breakdown', 'gpur' ),
				'section' => $theme_slug . '_comment_summary',
				'type' => 'section-header',
				'class' => 'gp-setting gp-setting-begin',
				'conditions' => array(
					'comment_summary' => 'enabled',
				),
			),
				array(
					'id' => 'comment_summary_breakdown_style',
					'title' => esc_html__( 'Summary Style', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
					'type' => 'select',
					'options' => array(
						'style-stars' => esc_html__( 'Stars', 'gpur' ), 
						'style-hearts' => esc_html__( 'Hearts', 'gpur' ),
						'style-squares' => esc_html__( 'Squares', 'gpur' ),
						'style-circles' => esc_html__( 'Circles', 'gpur' ),
						'style-bars' => esc_html__( 'Bars', 'gpur' ),
						'style-icon' => esc_html__( 'Custom Icon', 'gpur' ),
						'style-image' => esc_html__( 'Custom Image', 'gpur' ),
					),
					'default' => 'style-bars',
					'conditions' => array(
						'comment_summary' => 'enabled',
					),
				),
				array(
					'id' => 'comment_summary_breakdown_image',
					'title' => esc_html__( 'Custom Image', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
					'type' => 'media',
					'format' => 'image',
					'conditions' => array(
						'comment_summary_breakdown_style' => 'style-image',
						'comment_summary' => 'enabled',
					),
				),
				array(
					'id' => 'comment_summary_breakdown_icons',
					'title' => esc_html__( 'Icons', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
					'type' => 'styling',
					'styling' => array(
						'empty_icon' => array(
							'title' => esc_html__( 'Empty Icon', 'gpur' ),
							'type' => 'icon',
							'default' => gpur_fontawesome_icons( 'fa fa-star' ),
						),
						'filled_icon' => array(
							'title' => esc_html__( 'Filled Icon', 'gpur' ),
							'type' => 'icon',
							'default' => gpur_fontawesome_icons( 'fa fa-star' ),
						),
					),
					'conditions' => array(
						'comment_summary_breakdown_style' => 'style-icon',
						'comment_summary' => 'enabled',
					),
				),
				array(
					'id' => 'comment_summary_breakdown_icon_styling',
					'title' => esc_html__( 'Icon Styling', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
					'type' => 'styling',
					'styling' => array(
						'icon_width' => array(
							'title' => esc_html__( 'Icon Width', 'gpur' ),
							'type' => 'dimensions',
							'default' => '',
						),
						'icon_height' => array(
							'title' => esc_html__( 'Icon Height', 'gpur' ),
							'type' => 'dimensions',
							'default' => '',
						),
						'empty_icon_color' => array(
							'title' => esc_html__( 'Empty Icon Color', 'gpur' ),
							'type' => 'color',
							'default' => '',
						),
						'filled_icon_color' => array(
							'title' => esc_html__( 'Filled Icon Color', 'gpur' ),
							'type' => 'color',
							'default' => '',
						),
					),
					'conditions' => array(
						'comment_summary' => 'enabled',
					),
				),

			/**
			 * Comment ratings
			 *
			 */
			// Rating Controls
			array(
				'id' => '_gpur_section_comment_rating_rating_controls',
				'title' => esc_html__( 'Rating Controls', 'gpur' ),
				'section' => $theme_slug . '_comment_ratings',
				'type' => 'section-header',
				'class' => 'gp-setting gp-setting-begin',
			),	
			
				array(
					'id' => 'comment_rating_rich_snippets', //comment_summary_avg_rich_snippets
					'title' => esc_html__( 'Rich Snippets', 'gpur' ),
					'section' => $theme_slug . '_comment_ratings',
					'type' => 'checkbox',
					'desc' => esc_html__( 'Allows search engines to read your rating data to display ratings in search results.', 'gpur' ),
					'default' => '0',
				),

				array(
					'id' => 'comment_rating_rich_snippets_site_rating_type',
					'title' => esc_html__( 'Rich Snippets Site Rating Type', 'gpur' ),
					'section' => $theme_slug . '_comment_ratings',
					'type' => 'text',
					'desc' => esc_html__( 'The rich snippet type for single site rating - accepted types', 'gpur' ) . ' <a href="https://developers.google.com/search/docs/data-types/review-snippet" target="_blank">' . esc_html__( 'here', 'gpur' ) . '</a>.',
					'default' => 'Game',
					'conditions' => array(
						'comment_rating_rich_snippets' => array(
							'operator' => 'not_empty',
						),
					),
				),

				array(
					'id' => 'comment_rating_rich_snippets_user_rating_type',
					'title' => esc_html__( 'Rich Snippets User Rating Type', 'gpur' ),
					'section' => $theme_slug . '_comment_ratings',
					'type' => 'text',
					'desc' => esc_html__( 'The rich snippet type for aggregrated user ratings - accepted types', 'gpur' ) . ' <a href="https://developers.google.com/search/docs/data-types/review-snippet" target="_blank">' . esc_html__( 'here', 'gpur' ) . '</a>.',
					'default' => 'Product',
					'conditions' => array(
						'comment_rating_rich_snippets' => array(
							'operator' => 'not_empty',
						),
					),
				),
					
														 
				array(
					'id' => 'comment_rating_show_zero_rating',
					'title' => esc_html__( 'Display Zero Rating', 'gpur' ),
					'section' => $theme_slug . '_comment_ratings',
					'type' => 'checkbox',
					'default' => '0',
				),	
				
			// Rating Style
			array(
				'id' => '_gpur_section_comment_rating_rating_style',
				'title' => esc_html__( 'Rating Style', 'gpur' ),
				'section' => $theme_slug . '_comment_ratings',
				'type' => 'section-header',
				'class' => 'gp-setting gp-setting-begin',
			),	
				array(
					'id' => 'comment_rating_style',
					'title' => esc_html__( 'Style', 'gpur' ),
					'section' => $theme_slug . '_comment_ratings',
					'type' => 'select',
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
				
				),
				array(
					'id' => 'comment_rating_image',
					'title' => esc_html__( 'Custom Image', 'gpur' ),
					'section' => $theme_slug . '_comment_ratings',
					'type' => 'media',
					'format' => 'image',
					'conditions' => array(
						'comment_rating_style' => 'style-image',
					),
				),
				array(
					'id' => 'comment_rating_icons',
					'title' => esc_html__( 'Icons', 'gpur' ),
					'section' => $theme_slug . '_comment_ratings',
					'type' => 'styling',
					'styling' => array(
						'empty_icon' => array(
							'title' => esc_html__( 'Empty Icon', 'gpur' ),
							'type' => 'icon',
							'default' => gpur_fontawesome_icons( 'fa fa-star' ),
						),
						'filled_icon' => array(
							'title' => esc_html__( 'Filled Icon', 'gpur' ),
							'type' => 'icon',
							'default' => gpur_fontawesome_icons( 'fa fa-star' ),
						),
					),
					'conditions' => array(
						'comment_rating_style' => 'style-icon',
					),
				),
				array(
					'id' => 'comment_rating_icon_styling',
					'title' => esc_html__( 'Icon Styling', 'gpur' ),
					'section' => $theme_slug . '_comment_ratings',
					'type' => 'styling',
					'styling' => array(
						'icon_width' => array(
							'title' => esc_html__( 'Icon Width', 'gpur' ),
							'type' => 'dimensions',
							'default' => '',
						),
						'icon_height' => array(
							'title' => esc_html__( 'Icon Height', 'gpur' ),
							'type' => 'dimensions',
							'default' => '',
						),
						'empty_icon_color' => array(
							'title' => esc_html__( 'Empty Icon Color', 'gpur' ),
							'type' => 'color',
							'default' => '',
						),
						'filled_icon_color' => array(
							'title' => esc_html__( 'Filled Icon Color', 'gpur' ),
							'type' => 'color',
							'default' => '',
						),
					),
				),
				
			// Rating Container
			array(
				'id' => '_gpur_section_comment_rating_rating_container',
				'title' => esc_html__( 'Rating Container', 'gpur' ),
				'section' => $theme_slug . '_comment_ratings',
				'type' => 'section-header',
				'class' => 'gp-setting gp-setting-begin',
				'conditions' => array(
					'comment_rating_style' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
				),
			),	
				array(
					'id' => 'comment_rating_rating_container',
					'title' => esc_html__( 'Container Styling', 'gpur' ),
					'section' => $theme_slug . '_comment_ratings',
					'type' => 'styling',
					'styling' => array(
						'width' => array(
							'title' => esc_html__( 'Width', 'gpur' ),
							'type' => 'dimensions',
							'default' => '',
						),
						'height' => array(
							'title' => esc_html__( 'Height', 'gpur' ),
							'type' => 'dimensions',
							'default' => '',
						),
						'background_color' => array(
							'title' => esc_html__( 'Background Color', 'gpur' ),
							'type' => 'color',
							'default' => '',
						),
						'border_width' => array(
							'title' => esc_html__( 'Border Width', 'gpur' ),
							'type' => 'dimensions',
							'default' => '',
						),
						'border_color' => array(
							'title' => esc_html__( 'Border Color', 'gpur' ),
							'type' => 'color',
							'default' => '',
						),
						'extra_css' => array(
							'title' => esc_html__( 'Extra CSS', 'gpur' ),
							'type' => 'extra_css',
							'default' => '',
						),
					),
					'conditions' => array(
						'comment_rating_style' => array( 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
					),
				),
				array(
					'id' => 'comment_rating_gauge',
					'title' => esc_html__( 'Gauge Styling', 'gpur' ),
					'section' => $theme_slug . '_comment_ratings',
					'type' => 'styling',
					'styling' => array(
						'width' => array(
							'title' => esc_html__( 'Width', 'gpur' ),
							'type' => 'dimensions',
							'default' => '',
						),
						'filled_color_1' => array(
							'title' => esc_html__( 'Filled Color 1', 'gpur' ),
							'type' => 'color',
							'default' => '',
						),
						'filled_color_2' => array(
							'title' => esc_html__( 'Filled Color 2', 'gpur' ),
							'type' => 'color',
							'default' => '',
						),
						'empty_color' => array(
							'title' => esc_html__( 'Empty Color', 'gpur' ),
							'type' => 'color',
							'default' => '',
						),
					),
					'conditions' => array(
						'comment_rating_style' => 'style-gauge-circles-singular',
					),
				),
						
				// Rating Text
				array(
					'id' => '_gpur_section_comment_rating_rating_text',
					'title' => esc_html__( 'Rating Text', 'gpur' ),
					'section' => $theme_slug . '_comment_ratings',
					'type' => 'section-header',
					'class' => 'gp-setting gp-setting-begin',
				),	
					array(
						'id' => 'comment_rating_show_ind_user_rating_text',
						'title' => esc_html__( 'Display Rating Text', 'gpur' ),
						'section' => $theme_slug . '_comment_ratings',
						'type' => 'checkbox',
						'default' => '0',
					),
					array(
						'id' => 'comment_rating_text_position',
						'title' => esc_html__( 'Rating Text Position', 'gpur' ),
						'section' => $theme_slug . '_comment_ratings',
						'type' => 'select',
							'options' => array(
								'position-text-top' => esc_html__( 'Top', 'gpur' ), 
								'position-text-bottom' => esc_html__( 'Bottom', 'gpur' ),
								'position-text-left' => esc_html__( 'Left', 'gpur' ),
								'position-text-right' => esc_html__( 'Right', 'gpur' ),
							),
						'default' => 'position-text-bottom',
					),
					array(
						'id' => 'comment_rating_ind_user_rating_label_text',
						'title' => esc_html__( 'Label', 'gpur' ),
						'section' => $theme_slug . '_comment_ratings',
						'type' => 'text',
						'default' => esc_html__( 'Your Rating:', 'gpur' ),						
						'conditions' => array(
							'comment_rating_show_ind_user_rating_text' => array(
								'operator' => 'not_empty',
							),
						),
					),				
					array(
						'id' => 'comment_rating_ind_user_rating_label',
						'title' => esc_html__( 'Label Styling', 'gpur' ),
						'section' => $theme_slug . '_comment_ratings',
						'type' => 'styling',
						'styling' => array( 
							'color' => array(
								'title' => esc_html__( 'Color', 'gpur' ),
								'type' => 'color',
								'default' => '',
							),
							'size' => array(
								'title' => esc_html__( 'Size', 'gpur' ),
								'type' => 'dimensions',
								'default' => '',
							),
							'extra_css' => array(
								'title' => esc_html__( 'Extra CSS', 'gpur' ),
								'type' => 'extra_css',
								'default' => '',
							),
						),						
						'conditions' => array(
							'comment_rating_show_ind_user_rating_text' => array(
								'operator' => 'not_empty',
							),
						),
					),
					array(
						'id' => 'comment_rating_ind_user_rating_number',
						'title' => esc_html__( 'Rating Number Styling', 'gpur' ),
						'section' => $theme_slug . '_comment_ratings',
						'type' => 'styling',
						'styling' => array(
							'color' => array(
								'title' => esc_html__( 'Color', 'gpur' ),
								'type' => 'color',
								'default' => '',
							),
							'size' => array(
								'title' => esc_html__( 'Size', 'gpur' ),
								'type' => 'dimensions',
								'default' => '',
							),
							'extra_css' => array(
								'title' => esc_html__( 'Extra CSS', 'gpur' ),
								'type' => 'extra_css',
								'default' => '',
							),
						),
					),
					array(
						'id' => 'comment_rating_show_ind_user_rating_max_rating_number',
						'title' => esc_html__( 'Display Maximum Rating Number', 'gpur' ),
						'section' => $theme_slug . '_comment_ratings',
						'type' => 'checkbox',
						'default' => '0',
					),		
					array(
						'id' => 'comment_rating_ind_user_rating_max_rating_number',
						'title' => esc_html__( 'Maximum Rating Number Styling', 'gpur' ),
						'section' => $theme_slug . '_comment_ratings',
						'type' => 'styling',
						'styling' => array(
							'color' => array(
								'title' => esc_html__( 'Color', 'gpur' ),
								'type' => 'color',
								'default' => '',
							),
							'size' => array(
								'title' => esc_html__( 'Size', 'gpur' ),
								'type' => 'dimensions',
								'default' => '',
							),
							'extra_css' => array(
								'title' => esc_html__( 'Extra CSS', 'gpur' ),
								'type' => 'extra_css',
								'default' => '',
							),
						),						
						'conditions' => array(
							'comment_rating_show_ind_user_rating_max_rating_number' => array(
								'operator' => 'not_empty'
							),
						),
					),

			// Criteria
			array(
				'id' => '_gpur_section_comment_rating_criteria',
				'title' => esc_html__( 'Criteria', 'gpur' ),
				'section' => $theme_slug . '_comment_ratings',
				'type' => 'section-header',
				'class' => 'gp-setting gp-setting-begin',				
				'conditions' => array(
					'comment_form_criteria' => array(
						'operator' => 'not_empty',
					),
				),
			),							 
				array(
					'id' => 'comment_rating_criteria_format',
					'title' => esc_html__( 'Format', 'gpur' ),
					'section' => $theme_slug . '_comment_ratings',
					'type' => 'select',
					'options' => array(
						'format-column' => esc_html__( 'Column', 'gpur' ),
						'format-rows' => esc_html__( 'Rows', 'gpur' ),
					),
					'default' => 'format-rows',						
					'conditions' => array(
						'comment_form_criteria' => array(
							'operator' => 'not_empty',
						),
					),
				),
				array(
					'id' => 'comment_rating_criteria_title',
					'title' => esc_html__( 'Criteria Title', 'gpur' ),
					'section' => $theme_slug . '_comment_ratings',
					'type' => 'styling',
					'styling' => array(
						'color' => array(
							'title' => esc_html__( 'Color', 'gpur' ),
							'type' => 'color',
							'default' => '',
						),
						'size' => array(
							'title' => esc_html__( 'Size', 'gpur' ),
							'type' => 'dimensions',
							'default' => '',
						),
						'extra_css' => array(
							'title' => esc_html__( 'Extra CSS', 'gpur' ),
							'type' => 'extra_css',
							'default' => '',
						),
					),		
					'conditions' => array(
						'comment_form_criteria' => array(
							'operator' => 'not_empty',
						),
					),
				),	
	
			// Other
			array(
				'id' => '_gpur_section_comment_rating_other',
				'title' => esc_html__( 'Other', 'gpur' ),
				'section' => $theme_slug . '_comment_ratings',
				'type' => 'section-header',
				'class' => 'gp-setting gp-setting-begin',
			),				
				array(
					'id' => 'comment_rating_comment_divider',
					'title' => esc_html__( 'Comment Divider', 'gpur' ),
					'section' => $theme_slug . '_comment_ratings',
					'type' => 'color',
					'default' => '',
				),

			/**
			 * Comment up/down rating
			 *
			 */
			array(
				'id' => 'comment_udv_support',
				'title' => esc_html__( 'Support', 'gpur' ),
				'section' => $theme_slug . '_comment_udv',
				'type' => 'radio',
					'desc' => esc_html__( 'Choose to add up/down voting to your theme comments.', 'gpur' ),
					'options' => array(
						'enabled' => esc_html__( 'Enabled', 'gpur' ),
						'disabled' => esc_html__( 'Disabled', 'gpur' ),
					),	
					'default' => 'enabled',
				
			),
			
			array(
				'id' => 'comment_udv_style',
				'title' => esc_html__( 'Style', 'gpur' ),
				'section' => $theme_slug . '_comment_udv',
				'type' => 'select',
				'options' => array(
					'style-plain' => esc_html__( 'Plain', 'gpur' ), 
					'style-round-buttons' => esc_html__( 'Round Buttons', 'gpur' ),
					'style-rounded-buttons' => esc_html__( 'Rounded Buttons', 'gpur' ),
				),
				'default' => 'style-plain',			
				'conditions' => array(
					'comment_udv_support' => 'enabled',
				),
			),

			array(
				'id' => 'comment_udv_counter_position',
				'title' => esc_html__( 'Counter Position', 'gpur' ),
				'section' => $theme_slug . '_comment_udv',
				'type' => 'select',
				'options' => array(
					'position-top' => esc_html__( 'Top', 'gpur' ),
					'position-bottom' => esc_html__( 'Bottom', 'gpur' ),
					'position-left' => esc_html__( 'Left', 'gpur' ),
					'position-right' => esc_html__( 'Right', 'gpur' ),
					'position-left-right' => esc_html__( 'Left And Right', 'gpur' ),
				),
				'default' => 'position-left-right',		
				'conditions' => array(
					'comment_udv_support' => 'enabled',
				),
			),

			array(
				'id' => 'comment_udv_up_icon',
				'title' => esc_html__( 'Up Icon Styling', 'gpur' ),
				'section' => $theme_slug . '_comment_udv',
				'type' => 'styling',			
				'styling' => array(
					'icon' => array(
						'title' => esc_html__( 'Icon', 'gpur' ),
						'type' => 'icon',
						'default' => gpur_fontawesome_icons( 'fa fa-thumbs-o-up' ),
					),
					'icon_size' => array(
						'title' => esc_html__( 'Icon Size', 'gpur' ),
						'type' => 'dimensions',
						'default' => '',
					),
					'icon_color' => array(
						'title' => esc_html__( 'Icon Color', 'gpur' ),
						'type' => 'color',
						'default' => '',
					),
					'icon_color_voted' => array(
						'title' => esc_html__( 'Icon Color (Voted)', 'gpur' ),
						'type' => 'color',
						'default' => '',
					),
					'background_color' => array(
						'title' => esc_html__( 'Background Color', 'gpur' ),
						'type' => 'color',
						'default' => '',
					),
					'background_color_voted' => array(
						'title' => esc_html__( 'Background Color (Voted)', 'gpur' ),
						'type' => 'color',
						'default' => '',
					),
					'counter_size' => array(
						'title' => esc_html__( 'Counter Size', 'gpur' ),
						'type' => 'dimensions',
						'default' => '',
					),
					'counter_color' => array(
						'title' => esc_html__( 'Counter Color', 'gpur' ),
						'type' => 'color',
						'default' => '',
					),
				),
				'conditions' => array(
					'comment_udv_support' => 'enabled',
				),
			),

			array(
				'id' => 'comment_udv_down_icon',
				'title' => esc_html__( 'Down Icon Styling', 'gpur' ),
				'section' => $theme_slug . '_comment_udv',
				'type' => 'styling',
				'styling' => array(
					'icon' => array(
						'title' => esc_html__( 'Icon', 'gpur' ),
						'type' => 'icon',
						'default' => gpur_fontawesome_icons( 'fa fa-thumbs-o-down' ),
					),
					'icon_size' => array(
						'title' => esc_html__( 'Icon Size', 'gpur' ),
						'type' => 'dimensions',
						'default' => '',
					),
					'icon_color' => array(
						'title' => esc_html__( 'Icon Color', 'gpur' ),
						'type' => 'color',
						'default' => '',
					),
					'icon_color_voted' => array(
						'title' => esc_html__( 'Icon Color (Voted)', 'gpur' ),
						'type' => 'color',
						'default' => '',
					),
					'background_color' => array(
						'title' => esc_html__( 'Background Color', 'gpur' ),
						'type' => 'color',
						'default' => '',
					),
					'background_color_voted' => array(
						'title' => esc_html__( 'Background Color (Voted)', 'gpur' ),
						'type' => 'color',
						'default' => '',
					),
					'counter_size' => array(
						'title' => esc_html__( 'Counter Size', 'gpur' ),
						'type' => 'dimensions',
						'default' => '',
					),
					'counter_color' => array(
						'title' => esc_html__( 'Counter Color', 'gpur' ),
						'type' => 'color',
						'default' => '',
					),
				),
				'conditions' => array(
					'comment_udv_support' => 'enabled',
				),
			),

			array(
				'id' => 'comment_udv_permissions',
				'title' => esc_html__( 'Permissions', 'gpur' ),
				'section' => $theme_slug . '_comment_udv',
				'type' => 'select',
				'desc' => esc_html__( 'Choose which users or roles can up/down vote comments.', 'gpur' ),
				'options' => array(
					'all-users' => esc_html__( 'All users', 'gpur' ),
					'logged-in-users' => esc_html__( 'Logged in users only', 'gpur' ),
					'specific-roles' => esc_html__( 'Specific roles only', 'gpur' ),
				),
				'default' => 'all-users',
				'conditions' => array(
					'comment_udv_support' => 'enabled',
				),
			),

			array(
				'id' => 'comment_udv_permission_roles',
				'title' => esc_html__( 'Roles', 'gpur' ),
				'section' => $theme_slug . '_comment_udv',
				'type' => 'checkbox',
				'data' => 'roles',
				'default' => array( 'administrator' => 'administrator' ),
				'conditions' => array(
					'comment_udv_permissions' => 'specific-roles',
					'comment_udv_support' => 'enabled',
				),
				
			),

			array(
				'id' => 'comment_udv_already_voted_label',
				'title' => esc_html__( 'Already Voted Label', 'gpur' ),
				'section' => $theme_slug . '_comment_udv',
				'type' => 'text',
				'default' => esc_html__( 'You have already voted!', 'gpur' ),		
				'conditions' => array(
					'comment_udv_support' => 'enabled',
				),
			),

			array(
				'id' => 'comment_udv_already_voted_text',
				'title' => esc_html__( 'Already Voted Text Styling', 'gpur' ),
				'section' => $theme_slug . '_comment_udv',
				'type' => 'styling',
				'styling' => array(
					'color' => array(
						'title' => esc_html__( 'Color', 'gpur' ),
						'type' => 'color',
						'default' => '',
					),
					'size' => array(
						'title' => esc_html__( 'Size', 'gpur' ),
						'type' => 'dimensions',
						'default' => '',
					),
					'extra_css' => array(
						'title' => esc_html__( 'Extra CSS', 'gpur' ),
						'type' => 'extra_css',
						'default' => '',
					),
				),
				'conditions' => array(
					'comment_udv_support' => 'enabled',
				),
			),

			/**
			 * Advanced
			 *
			 */
			// General
			array(
				'id' => '_gpur_section_advanced',
				'title' => esc_html__( 'General', 'gpur' ),
				'section' => $theme_slug . '_advanced',
				'label_for' => 'gp-section-header',	
				'type' => 'section-header',
				'class' => 'gp-setting gp-setting-begin',	
			),	

				array(  
					'id' => 'fontawesome5',
					'title' => esc_html__( 'FontAwesome 5', 'gpur' ),
					'section' => $theme_slug . '_advanced',
					'type'  => 'radio',
					'desc' => esc_html__( 'Use FontAwesome 5 instead of FontAwesome 4. Please note WPBakery Page Builder plugin still uses FontAwesome 4, so enabling this will stop their FontAwesome icons from working.', 'gpur' ),
					'options'   => array(
						'enabled' => esc_html__( 'Enabled', 'gpur' ),
						'disabled' => esc_html__( 'Disabled', 'gpur' ),
					),	
					'default' => 'disabled',
				),
				
			// Import/Export
			array(
				'id' => '_gpur_section_import_export',
				'title' => esc_html__( 'Import/Export', 'gpur' ),
				'section' => $theme_slug . '_advanced',
				'label_for' => 'gp-setting-title',	
				'type' => 'section-header',
				'class' => 'gp-setting gp-setting-begin',
			),	
			
				array(
					'id' => 'import_settings',
					'title' => esc_html__( 'Import', 'gpur' ),
					'section' => $theme_slug . '_advanced',
					'desc' => esc_html__( 'Upload your plugin settings file with a .txt extension.', 'gpur' ),
					'type' => 'import',
				),
				
				array(
					'id' => 'export_settings',
					'title' => esc_html__( 'Export', 'gpur' ),
					'section' => $theme_slug . '_advanced',
					'desc' => esc_html__( 'Downloads a .txt file that contains all your plugin settings data.', 'gpur' ),
					'type' => 'export',
				),	
				
		);
	
		$settings = apply_filters( 'gpur_global_settings', $settings, $theme_slug );

		return $settings;
		
	}
}	