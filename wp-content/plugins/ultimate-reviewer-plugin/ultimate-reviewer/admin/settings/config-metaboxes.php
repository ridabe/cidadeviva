<?php if ( ! function_exists( 'gpur_metaboxes_settings' ) ) {
	function gpur_metaboxes_settings() {

		$settings = array();
		
		if ( 'allowed' === gpur_permissions( 'specific-roles', array_filter( gpur_option( 'review_management' ) ) ) ) { 

			$last_post_id = get_user_option( 'dashboard_quick_press_last_post_id' ); // Get the last post ID
			$post_id = isset( $_GET['post'] ) ? absint( $_GET['post'] ) : absint( $last_post_id );
			
			if ( ! isset( $_GET['post_type'] ) OR ( isset( $_GET['post_type'] ) && 'gpur-template' !== $_GET['post_type'] ) ) {

				$template_data = gpur_get_review_template_data( $post_id );
				
				/**
				 * Review Settings
				 *
				 */
				$review = array();
				$review[] = array(
					'id' => 'gpur_show_review_template',
					'title' => esc_html__( 'Show Review Template', 'gpur' ),
					'desc' => esc_html__( 'Show the review template for this page if it has been automatically inserted.', 'gpur' ),
					'type' => 'radio',
					'options' => array(
						'enabled' => esc_html__( 'Enabled', 'gpur' ),
						'disabled' => esc_html__( 'Disabled', 'gpur' ),
					),
					'default' => 'enabled',
					'class' => '',
				);

				if ( 0 == $template_data['site_rating_max_rating'] ) {
				
					$review[] = array(
						'id' => 'gpur_error_no_review_template',
						'type' => 'message',
					);
					
				} else {
			
					// Loop through each criteria
					if ( is_array( $template_data['site_criteria'] ) ) {
						$criteria = implode( ',', $template_data['site_criteria'] );							
						$criteria = gpur_criteria( $criteria );	
					}
					if ( isset( $criteria ) && is_array( $criteria ) ) {
		
						for( $i = 0; $i < $criteria['count']; $i++ ) {
			
							$criterion_slug = sanitize_title_with_dashes( $criteria['fields'][$i] );
							$weight = isset( $criteria['weights'][$i] ) ? ' (' . esc_html( 'Weight:', 'gpur' ) . ' ' . $criteria['weights'][$i] . ')' : '';
							
							$review[] = array(
								'id' => 'gpur_criterion_' . $criterion_slug,
								'title' => $criteria['fields'][$i] . $weight,
								'type' => 'slider',
								'step' => $template_data['site_step'],
								'resolution' => 0.1,
								'min' => $template_data['site_min_rating'],
								'max' => $template_data['site_rating_max_rating'],
								'default' => 0,
							);	
						}

						$review[] = array(
							'id' => 'gpur_manually_add_overall_rating',
							'title' => esc_html__( 'Manually Add Overall Rating', 'gpur' ),
							'desc' => esc_html__( 'Manually add your own overall average rating.', 'gpur' ),
							'type' => 'checkbox',
							'default' => 0,
						);

					}
		
					if ( isset( $criteria ) && is_array( $criteria ) ) {
						$title = esc_html__( 'Overall Rating', 'gpur' );
						$conditions = array(
							'gpur_manually_add_overall_rating' => array(
								'operator' => 'not_empty',
							),
						);
					} else {
						$title = esc_html__( 'Rating', 'gpur' );
						$conditions = '';
					}
			
					$review[] = array( 
						'id' => 'gpur_site_rating',
						'title' => $title,
						'type' => 'slider',
						'step' => $template_data['site_step'],
						'min' => $template_data['site_min_rating'],
						'max' => $template_data['site_rating_max_rating'],
						'default' => '',		
						'conditions' => $conditions,			
					);
	
					$review[] = array(  
						'id' => 'gpur_excerpt',
						'title' => esc_html__( 'Excerpt', 'gpur' ),
						'description' => esc_html__( 'The text displayed in the Excerpt element.', 'gpur' ),
						'type' => 'textarea',
						'validate' => 'html_custom',
						'allowed_html' => array(
							'a' => array(
								'href' => array(),
								'title' => array()
							),
							'div' => array(
								'class' => array(),
							),
							'br' => array(),
							'em' => array(),
							'strong' => array()
						),
					);
																		
					$review[] = array(  
						'id' => 'gpur_summary',
						'title' => esc_html__( 'Summary', 'gpur' ),
						'description' => esc_html__( 'The text displayed in the Summary element.', 'gpur' ),
						'type' => 'textarea',
						'validate' => 'html_custom',
						'allowed_html' => array(
							'a' => array(
								'href' => array(),
								'title' => array()
							),
							'div' => array(
								'class' => array(),
							),
							'br' => array(),
							'em' => array(),
							'strong' => array()
						),
					);

					$review[] = array( 
						'id' => 'gpur_good_points',
						'title' => esc_html__( 'Good Points', 'gpur' ),
						'type' => 'multi_text',
						'add_text' => esc_html__( 'Add', 'gpur' ),
						'default' => '',
					);

					$review[] = array( 
						'id' => 'gpur_bad_points',
						'title' => esc_html__( 'Bad Points', 'gpur' ),
						'type' => 'multi_text',
						'add_text' => esc_html__( 'Add', 'gpur' ),
						'default' => '',
					);

					$review[] = array( 
						'id' => 'gpur_review_image_1',
						'title' => esc_html__( 'Review Image 1', 'gpur' ),
						'description' => esc_html__( 'This image is used when displaying images in review templates.', 'gpur' ),
						'type' => 'media',
						'format' => 'image',
						'default' => '',
					);

					$review[] = array( 
						'id' => 'gpur_review_image_2',
						'title' => esc_html__( 'Review Image 2', 'gpur' ),
						'description' => esc_html__( 'This is an alternative image is used when displaying images in review templates.', 'gpur' ),
						'type' => 'media',
						'format' => 'image',
						'default' => '',
					);

					$review[] = array( 
						'id' => 'gpur_review_button_text',
						'title' => esc_html__( 'Review Button Text', 'gpur' ),
						'description' => esc_html__( 'This is the text used for buttons in review templates - leave empty to use the text set in the Review Button element.', 'gpur' ),
						'type' => 'text',
						'default' => '',
					);

					$review[] = array( 
						'id' => 'gpur_review_button_link',
						'title' => esc_html__( 'Review Button Link', 'gpur' ),
						'description' => esc_html__( 'This is the link used for buttons in review templates - leave empty to use the link set in the Review Button element.', 'gpur' ),
						'type' => 'text',
						'default' => '',
					);
					
				}	
			
				$settings[] = array(
					'id' => 'gpur-review',
					'title' => esc_html__( 'Review Settings', 'gpur' ),
					'post_types' => array_filter( gpur_option( 'review_post_types' ) ),
					'position' => 'normal',
					'priority' => 'high',
					'section' => $review
				);
			
			}
					
			/**
			 * Template Settings
			 *
			 */	 
			$template = array(

				array(
					'id' => 'gpur_review_template_automatic_insertion',
					'title' => esc_html__( 'Automatic Insertion', 'gpur' ),
					'desc' => esc_html__( 'Choose which post types to automatically display this review template. You can also insert review templates manually using the Review Box page builder element.', 'gpur' ),
					'data' => 'post_types',
					'type' => 'checkbox',
				),
				
				array(
					'id' => 'gpur_review_template_automatic_insertion_ids',
					'title' => esc_html__( 'Post/Page IDs', 'gpur' ),
					'desc' => esc_html__( 'Enter the IDs of the post/pages you want to show this template on - separate each ID with a comma e.g. 123, 456, 789', 'gpur' ),
					'type' => 'text',
					'conditions' => array(
						'gpur_review_template_automatic_insertion' => array(
							'operator' => 'not_empty',
						),	
					),
				),
				
				array(
					'id' => 'gpur_review_template_automatic_insertion_cats',
					'title' => esc_html__( 'Categories', 'gpur' ),
					'desc' => esc_html__( 'Enter the category slugs for the posts you want to show this template on - separate slugs with a comma e.g. category-1, category-2, category-3', 'gpur' ),
					'type' => 'text',			
					'conditions' => array(
						'gpur_review_template_automatic_insertion' => array(
							'operator' => 'not_empty',
						),	
					),
				),
				
				array(
					'id' => 'gpur_review_template_automatic_insertion_tags',
					'title' => esc_html__( 'Tags', 'gpur' ),
					'desc' => esc_html__( 'Enter the tag slugs for the posts you want to show this template on - separate slugs with a comma e.g. tag-1, tag-2, tag-3.', 'gpur' ),
					'type' => 'text',			
					'conditions' => array(
						'gpur_review_template_automatic_insertion' => array(
							'operator' => 'not_empty',
						),	
					),
				),
				
				array(
					'id' => 'gpur_review_template_position',
					'title' => esc_html__( 'Position', 'gpur' ),
					'desc' => esc_html__( 'Choose where to display your review template if it\'s automatically inserted.', 'gpur' ),
					'type' => 'select',	
					'options' => array(
						'top' => esc_html__( 'Top', 'gpur' ),
						'bottom' => esc_html__( 'Bottom', 'gpur' ),
					),
					'default' => 'bottom',				
					'conditions' => array(
						'gpur_review_template_automatic_insertion' => array(
							'operator' => 'not_empty',
						),	
					),
				),					
			
			);
			$settings[] = array(
				'id' => 'gpur-template',
				'title' => esc_html__( 'Template Settings', 'gpur' ),
				'post_types' => array( 'gpur-template' ),
				'position' => 'side',
				'priority' => 'high',
				'section' => $template
			);
			
			$settings = apply_filters( 'gpur_metaboxes_settings', $settings );

			return $settings;

		}
		
	}					
}