<?php if ( ! function_exists( 'gpur_update_database' ) ) {	
	function gpur_update_database() {

		// If this is a new installation do not update the database 
		if ( ! get_option( 'gpur_db_version' ) ) {
			update_option( 'gpur_db_version', '2.1' ); // Update database version to latest version and then exit
			return;
		}
						
		/**
		 * Updating to v1.1
		 *
		 */			
		if ( version_compare( get_option( 'gpur_db_version' ), '1.1', '<' ) ) {

			// Update theme options keys/values
			$options = get_option( 'gpur_settings' );
			if ( $options ) {								
				foreach ( $options as $key => $option ) {
					
					if ( 'review_post_types' === $key ) {
						$post_types = array_search( 'true', $option );
						if ( $post_types ) {
							$options['review_post_types'] = $post_types;
						}	
					}	
					
					if ( 'review_management' === $key ) {
						$roles = array_search( 'true', $option );
						if ( $roles ) {
							$options['review_management'] = $roles;
						}	
					}	
					
				}
				update_option( 'gpur_settings', $options );
			}
			
			update_option( 'gpur_db_version', '1.1' );
			
		}	
				
		/**
		 * Updating to v1.4
		 *
		 */
		if ( version_compare( get_option( 'gpur_db_version' ), '1.4', '<' ) ) {

			// Update theme options keys/values
			$options = get_option( 'gpur_settings' );
			if ( $options ) {						
			
				foreach ( $options as $key => $value ) {
				
					if ( is_array( $options[$key] ) ) { 
					
						foreach( $options[$key] as $var_key => $var_value ) {
				
							if ( $var_key && strpos( $var_key, '_px' ) ) {
								$new_var_key = str_replace( '_px', '', $var_key );
								$options[$key][$new_var_key] = $var_value;
							}	
						
						}	
						
					}	
					
				}
				
				update_option( 'gpur_settings', $options );
			}
			
			update_option( 'gpur_db_version', '1.4' );
			
		}
		
		/**
		 * Updating to v1.5.2
		 *
		 */
		if ( version_compare( get_option( 'gpur_db_version' ), '1.5.2', '<' ) ) {

			// Add new default option values
			$options = get_option( 'gpur_settings' );
			
			if ( $options ) {						
			
				if ( ! isset( $options['fontawesome5'] ) ) {		
					$options['fontawesome5'] = 'disabled';
				}
								
				update_option( 'gpur_settings', $options );
				
			}
			
			update_option( 'gpur_db_version', '1.5.2' );
			
		}	
		
		/**
		 * Updating to v2.0
		 *
		 */
		if ( version_compare( get_option( 'gpur_db_version' ), '2.0', '<' ) ) {

			global $wpdb;

			// Update theme options keys/values
			$options = get_option( 'gpur_settings' );
			if ( $options ) {								
				foreach ( $options as $key => $option ) {
				
					if ( 'comment_form_your_user_rating_label' === $key ) {
						$options['comment_form_ind_user_rating_label_text'] = $option;
						unset( $key );
					} elseif ( 'comment_form_your_user_rating_text' === $key ) {
						$options['comment_form_ind_user_rating_label'] = $option;
						$options['comment_form_ind_user_rating_number'] = $option;
						$options['comment_form_ind_user_rating_max_rating_number'] = $option;
						unset( $key );
					} elseif ( 'comment_form_show' === $key ) {
						if ( isset( $option['your_user_rating_text'] ) ) {
							$options['comment_form_show_ind_user_rating_text'] = $option['your_user_rating_text'];
						}	
						if ( isset( $option['maximum_rating_text'] ) ) {
							$options['comment_form_show_ind_user_rating_max_rating_number'] = $option['maximum_rating_text'];
						}
						unset( $key );							
							
					} elseif ( 'comment_summary_avg_show' === $key ) {
						if ( isset( $option['zero_ratings'] ) ) {
							$options['comment_summary_avg_show_zero_rating'] = $option['zero_ratings'];
						}
						if ( isset( $option['average_user_rating_text'] ) ) {	
							$options['comment_summary_show_avg_user_rating_text'] = $option['average_user_rating_text'];
						}
						if ( isset( $option['maximum_rating_text'] ) ) {	
							$options['comment_summary_avg_show_avg_user_rating_max_rating_number'] = $option['maximum_rating_text'];
						}
						if ( isset( $option['user_votes_text'] ) ) {	
							$options['comment_summary_avg_show_user_votes_text'] = $option['user_votes_text'];
						}	
						unset( $key );
					} elseif ( 'comment_summary_avg_avg_user_rating_label' === $key ) {
						$options['comment_summary_avg_avg_user_rating_label_text'] = $option;
						unset( $key );
					} elseif ( 'comment_summary_avg_average_user_rating_text' === $key ) {
						$options['comment_summary_avg_avg_user_rating_label'] = $options;
						$options['comment_summary_avg_avg_user_rating_number'] = $option;
						$options['comment_summary_avg_avg_user_rating_max_rating_number'] = $option;
						unset( $key );
					} elseif ( 'comment_summary_avg_rating_container' === $key ) {
						if ( isset( $option['text_color'] ) ) {
							$options['comment_summary_avg_avg_user_rating_number']['color'] = $option['text_color'];
						}
						if ( isset( $option['text_size'] ) ) {
							$options['comment_summary_avg_avg_user_rating_number']['size'] = $option['text_size'];
						}
					} elseif ( 'comment_form_format' === $key ) {
						$options['comment_form_criteria_format'] = $option;
						unset( $key );		

					} elseif ( 'comment_rating_show' === $key ) {
						if ( isset( $option['zero_ratings'] ) ) {
							$options['comment_rating_show_zero_rating'] = $option['zero_ratings'];
						}
						if ( isset( $option['your_user_rating_text'] ) ) {
							$options['comment_rating_show_ind_user_rating_text'] = $option['your_user_rating_text'];	
						}
						if ( isset( $option['maximum_rating_text'] ) ) {
							$options['comment_rating_show_ind_ind_user_rating_max_rating_number'] = $option['maximum_rating_text'];
						}
						unset( $key );
					} elseif ( 'comment_rating_your_user_rating_label' === $key ) {
						$options['comment_rating_ind_user_rating_label_text'] = $option;	
						unset( $key );
					} elseif ( 'comment_rating_your_user_rating_text' === $key ) {
						$options['comment_rating_ind_user_rating_label'] = $option;
						$options['comment_rating_ind_user_rating_number'] = $option;
						$options['comment_rating_ind_user_rating_max_rating_number'] = $option;
						unset( $key );
					} elseif ( 'comment_rating_rating_container' === $key ) {
						if ( isset( $option['text_color'] ) ) {
							$options['comment_rating_ind_user_rating_number']['color'] = $option['text_color'];
						}
						if ( isset( $option['text_size'] ) ) {
							$options['comment_rating_ind_user_rating_number']['size'] = $option['text_size'];
						}	
					} elseif ( 'comment_rating_format' === $key ) {
						$options['comment_rating_criteria_format'] = $option;			
					}							
							
				}
				
				// New Options
				if ( ! isset( $options['comment_rating_gauge'] ) ) {		
					$options['comment_rating_gauge']['width'] = '';	
					$options['comment_rating_gauge']['filled_color_1'] = '';	
					$options['comment_rating_gauge']['filled_color_2'] = '';	
					$options['comment_rating_gauge']['empty_color'] = '';
				}

				update_option( 'gpur_settings', $options );
				
			}
			
			// Review Template shortcode
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type != 'gpur-template'", '[gpur_review_template id=', '[gpur_review_template template_id=' ) );	
			
			// Show Rating/Add User Ratings shortcode
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type = 'gpur-template'", ' rating_width=', ' rating_container_width=' ) );	
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type = 'gpur-template'", ' rating_height=', ' rating_container_height=' ) );	
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type = 'gpur-template'", ' rating_background_color=', ' rating_container_background_color=' ) );	
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type = 'gpur-template'", ' rating_border_width=', ' rating_container_border_width=' ) );	
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type = 'gpur-template'", ' rating_border_color=', ' rating_container_border_color=' ) );	
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type = 'gpur-template'", ' rating_extra_css=', ' rating_container_extra_css=' ) );
			
			//$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type = 'gpur-template'", ' show_your_user_rating_text=', ' show_site_rating_text=' ) );
				
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type = 'gpur-template'", ' rating_text_color=', ' site_rating_number_color=' ) );	
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type = 'gpur-template'", ' rating_text_size=', ' site_rating_number_size=' ) );		
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type = 'gpur-template'", ' rating_text_extra_css=', ' site_rating_number_extra_css=' ) );
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type = 'gpur-template'", ' show_max_rating_text=', ' show_site_rating_max_rating_number=' ) );
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type = 'gpur-template'", ' maximum_rating_text_color=', ' site_rating_max_rating_number_color=' ) );	
						
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type = 'gpur-template'", ' maximum_rating_text_size=', ' site_rating_max_rating_number_size=' ) );	
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type = 'gpur-template'", ' maximum_rating_number_extra_css=', ' site_rating_max_rating_number_extra_css=' ) );
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type = 'gpur-template'", ' show_your_user_rating_text=', ' show_ind_user_rating_text=' ) );	
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type = 'gpur-template'", ' your_user_rating_label=', ' ind_user_rating_label=' ) );	
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type = 'gpur-template'", ' your_user_rating_text_color=', ' ind_user_rating_number_color=' ) );
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type = 'gpur-template'", ' your_user_rating_text_size=', ' ind_user_rating_number_size=' ) );
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type = 'gpur-template'", ' your_user_rating_number_extra_css=', ' ind_user_rating_number_extra_css=' ) );
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type = 'gpur-template'", ' format=', ' criteria_format=' ) );	

			// Comparison Table/Review List shortcodes
			$styles = array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular', 'style-stars', 'style-hearts', 'style-squares', 'style-circles', 'style-bars', 'style-icon', 'style-image' );
			foreach( $styles as $style ) {
				$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type != 'gpur-template'", ' style="' . $style . '"', ' site_rating_style="' . $style . '" user_rating_style="' . $style . '"' ) );	
			}
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type != 'gpur-template'", ' site_max_rating', ' site_rating_max_rating' ) );	
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type != 'gpur-template'", ' site_criteria', ' site_rating_criteria' ) );	
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type != 'gpur-template'", ' user_criteria', ' user_rating_criteria' ) );	
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type != 'gpur-template'", ' user_max_rating', ' user_rating_max_rating' ) );	
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type != 'gpur-template'", ' decimal_places', ' site_rating_decimal_places' ) );	

			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type != 'gpur-template'", ' show_max_rating_text', ' show_site_rating_max_rating_text' ) );
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type != 'gpur-template'", ' show_zero_rating=""', ' site_rating_show_zero_rating="" user_rating_show_zero_rating=""' ) );	
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type != 'gpur-template'", ' rating_image', ' site_rating_image' ) );	
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type != 'gpur-template'", ' empty_icon', ' site_rating_empty_icon' ) );	
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type != 'gpur-template'", ' empty_icon_color', 'site_rating_empty_icon_color' ) );	
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type != 'gpur-template'", ' filled_icon', ' site_rating_filled_icon' ) );	
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type != 'gpur-template'", ' filled_icon_color', ' site_rating_filled_icon_color' ) );	
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type != 'gpur-template'", ' icon_width', ' site_rating_icon_width' ) );	
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type != 'gpur-template'", ' icon_height', ' site_rating_icon_height' ) );	
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type != 'gpur-template'", ' rating_width', ' site_rating_container_width' ) );	
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type != 'gpur-template'", ' rating_height', ' site_rating_container_height' ) );	
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type != 'gpur-template'", ' rating_background_color', ' site_rating_container_background_color' ) );	
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type != 'gpur-template'", ' rating_border_width', ' site_rating_container_border_width' ) );	
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type != 'gpur-template'", ' rating_border_color', ' site_rating_container_border_color' ) );	
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type != 'gpur-template'", ' rating_extra_css', ' site_rating_container_extra_css' ) );
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type != 'gpur-template'", ' rating_text_size', ' site_rating_number_size' ) );	
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type != 'gpur-template'", ' rating_text_color', ' site_rating_number_color' ) );
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type != 'gpur-template'", ' gauge_width', ' site_rating_gauge_width' ) );	
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type != 'gpur-template'", ' gauge_filled_color_1', ' site_rating_gauge_filled_color_1' ) );	
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type != 'gpur-template'", ' gauge_filled_color_2', ' site_rating_gauge_filled_color_2' ) );	
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type != 'gpur-template'", ' gauge_empty_color', ' site_rating_gauge_empty_color' ) );	
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type != 'gpur-template'", ' criteria_title_size', ' site_rating_criteria_title_size' ) );	
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type != 'gpur-template'", ' criteria_title_color', ' site_rating_criteria_title_color' ) );	
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type != 'gpur-template'", ' criteria_title_extra_css', ' site_rating_criteria_title_extra_css' ) );	
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type != 'gpur-template'", ' maximum_rating_text_size', ' site_rating_max_rating_number_size' ) );	
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type != 'gpur-template'", ' maximum_rating_text_color', ' site_rating_max_rating_number_color' ) );	
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE( post_content, %s, %s ) WHERE post_type != 'gpur-template'", ' maximum_rating_number_extra_css', ' site_rating_max_rating_number_extra_css' ) );
			
			update_option( 'gpur_db_version', '2.0' ); // remember to add this version to the top of page as well
			
		}	
		
		/**
		 * Updating to v2.1
		 *
		 */
		if ( version_compare( get_option( 'gpur_db_version' ), '2.1', '<' ) ) {

			global $wpdb;
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->postmeta wm JOIN $wpdb->posts wp ON wm.post_id = wp.ID SET wm.meta_value = REPLACE( wm.meta_value, %s, %s ) WHERE wm.meta_key = %s AND wp.post_type = %s", '"widgetType":"add_user_rating"', '"widgetType":"gpur_add_user_rating"', '_elementor_data', 'gpur-template' ) );
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->postmeta wm JOIN $wpdb->posts wp ON wm.post_id = wp.ID SET wm.meta_value = REPLACE( wm.meta_value, %s, %s ) WHERE wm.meta_key = %s AND wp.post_type = %s", '"widgetType":"bad_points"', '"widgetType":"gpur_bad_points"', '_elementor_data', 'gpur-template' ) );
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->postmeta wm JOIN $wpdb->posts wp ON wm.post_id = wp.ID SET wm.meta_value = REPLACE( wm.meta_value, %s, %s ) WHERE wm.meta_key = %s AND wp.post_type = %s", '"widgetType":"comparison_table"', '"widgetType":"gpur_comparison_table"', '_elementor_data', 'gpur-template' ) );
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->postmeta wm JOIN $wpdb->posts wp ON wm.post_id = wp.ID SET wm.meta_value = REPLACE( wm.meta_value, %s, %s ) WHERE wm.meta_key = %s AND wp.post_type = %s", '"widgetType":"excerpt"', '"widgetType":"gpur_excerpt"', '_elementor_data', 'gpur-template' ) );
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->postmeta wm JOIN $wpdb->posts wp ON wm.post_id = wp.ID SET wm.meta_value = REPLACE( wm.meta_value, %s, %s ) WHERE wm.meta_key = %s AND wp.post_type = %s", '"widgetType":"good_points"', '"widgetType":"gpur_good_points"', '_elementor_data', 'gpur-template' ) );
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->postmeta wm JOIN $wpdb->posts wp ON wm.post_id = wp.ID SET wm.meta_value = REPLACE( wm.meta_value, %s, %s ) WHERE wm.meta_key = %s AND wp.post_type = %s", '"widgetType":"image"', '"widgetType":"gpur_image"', '_elementor_data', 'gpur-template' ) );
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->postmeta wm JOIN $wpdb->posts wp ON wm.post_id = wp.ID SET wm.meta_value = REPLACE( wm.meta_value, %s, %s ) WHERE wm.meta_key = %s AND wp.post_type = %s", '"widgetType":"review_button"', '"widgetType":"gpur_review_button"', '_elementor_data', 'gpur-template' ) );
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->postmeta wm JOIN $wpdb->posts wp ON wm.post_id = wp.ID SET wm.meta_value = REPLACE( wm.meta_value, %s, %s ) WHERE wm.meta_key = %s AND wp.post_type = %s", '"widgetType":"review_template"', '"widgetType":"gpur_review_template"', '_elementor_data', 'gpur-template' ) );
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->postmeta wm JOIN $wpdb->posts wp ON wm.post_id = wp.ID SET wm.meta_value = REPLACE( wm.meta_value, %s, %s ) WHERE wm.meta_key = %s AND wp.post_type = %s", '"widgetType":"reviews_list"', '"widgetType":"gpur_reviews_list"', '_elementor_data', 'gpur-template' ) );
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->postmeta wm JOIN $wpdb->posts wp ON wm.post_id = wp.ID SET wm.meta_value = REPLACE( wm.meta_value, %s, %s ) WHERE wm.meta_key = %s AND wp.post_type = %s", '"widgetType":"show_rating"', '"widgetType":"gpur_show_rating"', '_elementor_data', 'gpur-template' ) );
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->postmeta wm JOIN $wpdb->posts wp ON wm.post_id = wp.ID SET wm.meta_value = REPLACE( wm.meta_value, %s, %s ) WHERE wm.meta_key = %s AND wp.post_type = %s", '"widgetType":"summary"', '"widgetType":"gpur_summary"', '_elementor_data', 'gpur-template' ) );
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->postmeta wm JOIN $wpdb->posts wp ON wm.post_id = wp.ID SET wm.meta_value = REPLACE( wm.meta_value, %s, %s ) WHERE wm.meta_key = %s AND wp.post_type = %s", '"widgetType":"title"', '"widgetType":"gpur_title"', '_elementor_data', 'gpur-template' ) );
			
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->postmeta wm JOIN $wpdb->posts wp ON wm.post_id = wp.ID SET wm.meta_value = REPLACE( wm.meta_value, %s, %s ) WHERE wm.meta_key = %s AND wp.post_type = %s", '"widgetType":"up_down_voting"', '"widgetType":"gpur_up_down_voting"', '_elementor_data', 'gpur-template' ) );

			update_option( 'gpur_db_version', '2.1' ); // remember to add this version to the top of page as well
			
		}			
				
	}	
}
add_action( 'init', 'gpur_update_database' );