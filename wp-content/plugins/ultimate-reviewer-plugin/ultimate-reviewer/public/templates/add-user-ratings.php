<?php if ( ! function_exists( 'gpur_add_user_ratings_template' ) ) {
	function gpur_add_user_ratings_template( $args ) {
	
		// Load scripts
		wp_enqueue_script( 'bootstrap-rating' );
		wp_enqueue_script( 'gpur-add-user-ratings' );
		
		// Template variables	
		$defaults = array(
			'post_id' => '',
			'meta' => 'post',
			'builder' => 'wpb',
			'container_tag' => 'div',
			'atts' => array(),
		);
		$args = wp_parse_args( $args, $defaults );
		extract( $args );

		// Get attributes		
		$atts_defaults = gpur_add_user_ratings_shortcode_atts();
		$atts = wp_parse_args( $atts, $atts_defaults );	
		extract( $atts );

		// Get post ID
		$post_id = gpur_get_hub_id( $post_id );

		// Get correct meta keys
		$avg_user_rating_meta_key = gpur_get_avg_user_rating( $post_id );
		$user_votes_meta_key = gpur_get_user_votes( $post_id );
		$ind_user_rating_meta_key = gpur_get_ind_user_rating( $post_id );

		// Load style function
		$style = gpur_rating_styles( $style, $empty_icon, $filled_icon );

		// Load criteria function
		$criteria = gpur_criteria( $criteria );

		// Show different messages depending on single or multi rating
		if ( 'yes' === $criteria['multi'] ) {
			$success_message = $multi_success_message;
			$error_message = $multi_error_message;
		} else {
			$success_message = $single_success_message;
			$error_message = $single_error_message;
		}

		// Get average user rating value
		if ( get_post_meta( $post_id, $avg_user_rating_meta_key, true ) ) {
			$avg_user_rating_value = get_post_meta( $post_id, $avg_user_rating_meta_key, true );
		} else {
			$avg_user_rating_value = 0;
		}

		// Display labels		
		$display_avg_user_rating_label = '';
		if ( 1 == $show_avg_user_rating_text && 'post' === $meta ) {
			$display_avg_user_rating_label = '' !== $avg_user_rating_label ? '<' . esc_attr( $container_tag ) . ' class="gpur-avg-user-rating-label">' . $avg_user_rating_label . '</' . esc_attr( $container_tag ) . '>' : '';
		}
		$display_ind_user_rating_label = '';
		if ( 1 == $show_ind_user_rating_text && 'post' === $meta ) {
			$display_ind_user_rating_label = '' !== $ind_user_rating_label ? '<' . esc_attr( $container_tag ) . ' class="gpur-ind-user-rating-label">' . $ind_user_rating_label . '</' . esc_attr( $container_tag ) . '>' : '';
		}	

		// Display maximum ratings
		$display_avg_user_rating_max_rating = '';
		if ( 1 == $show_avg_user_rating_max_rating_number ) {
			$display_avg_user_rating_max_rating = '<' . esc_attr( $container_tag ) . ' class="gpur-max-rating">' . $max_rating . '</' . esc_attr( $container_tag ) . '>';
		}
		$display_ind_user_rating_max_rating = '';
		if ( 1 == $show_ind_user_rating_max_rating_number ) {
			$display_ind_user_rating_max_rating = '<' . esc_attr( $container_tag ) . ' class="gpur-max-rating">' . $max_rating . '</' . esc_attr( $container_tag ) . '>';
		}	

		// Display user votes
		$output_user_votes = '';
		if ( 1 == $show_user_votes_text && 'post' === $meta ) {
			$user_votes = (int) get_post_meta( $post_id, $user_votes_meta_key, true );
			if ( '' === $user_votes ) {
				$user_votes =  '<span class="gpur-user-votes-number">0</span><span class="gpur-user-votes-text">' . $plural_vote_label . '</span>';
			} elseif ( 1 == $user_votes ) {
				$user_votes = '<span class="gpur-user-votes-number">' . $user_votes . '</span><span class="gpur-user-votes-text">' . $singular_vote_label . '</span>';
			} else {
				$user_votes = '<span class="gpur-user-votes-number">' . $user_votes . '</span><span class="gpur-user-votes-text">' . $plural_vote_label . '</span>';
			}	
			$output_user_votes = '<' . esc_attr( $container_tag ) . ' class="gpur-user-votes">' . $user_votes . '</' . esc_attr( $container_tag ) . '>';
		}	

		// Display average user rating
		$output_avg_user_rating = '';
		if ( 1 == $show_avg_user_rating_text && 'post' === $meta ) {
			$output_avg_user_rating = $display_avg_user_rating_label . '<' . esc_attr( $container_tag ) . ' class="gpur-avg-user-rating"><' . esc_attr( $container_tag ) . ' class="gpur-rating-value">' . $avg_user_rating_value . '</' . esc_attr( $container_tag ) . '>' . $display_avg_user_rating_max_rating . '</' . esc_attr( $container_tag ) . '>';
		}

		// Get your user rating value
		if ( 'comment' === $meta ) {
			$your_user_rating_value = 0;
			$is_rated = 'no';
		} elseif ( get_user_meta( get_current_user_id(), $ind_user_rating_meta_key, true ) ) {
			$your_user_rating_value = get_user_meta( get_current_user_id(), $ind_user_rating_meta_key, true );
			$is_rated = 'yes';
		} elseif ( isset( $_COOKIE['gpur_user_rating_' . $post_id] ) && ! is_user_logged_in() ) {
			$your_user_rating_value = $_COOKIE['gpur_user_rating_' . $post_id];
			$is_rated = 'yes';
		} else {
			$your_user_rating_value = 0;
			$is_rated = 'no';
		}

		// Convert rating values to an array				
		if ( is_array( $your_user_rating_value ) ) {
			$your_user_rating_value = is_array( $your_user_rating_value[0] ) ? array_values( $your_user_rating_value[0] ) : $your_user_rating_value[0];
		} elseif ( ! is_array( $your_user_rating_value ) && false !== strpos( $your_user_rating_value, ',' ) ) {
			$your_user_rating_value = explode( ',', $your_user_rating_value );
		} else {
			$your_user_rating_value = array( $your_user_rating_value );
		}

		// Loop through multi ratings
		for( $i = 0; $i < $criteria['count']; $i++ ) {

			// Set all criteria values to zero
			if ( ! isset ( $your_user_rating_value[$i] ) ) {
				$your_user_rating_value[$i] = 0;
			}
	
			// Display your user rating
			$output_ind_user_rating = '';
			if ( 1 == $show_ind_user_rating_text ) {
				$output_ind_user_rating = $display_ind_user_rating_label . '<' . esc_attr( $container_tag ) . ' class="gpur-ind-user-rating"><' . esc_attr( $container_tag ) . ' class="gpur-rating-value">' . $your_user_rating_value[$i] . '</' . esc_attr( $container_tag ) . '>' . $display_ind_user_rating_max_rating . '</' . esc_attr( $container_tag ) . '>';
			}

			// Output rating data
			$output_rating[$i] = '';
			if ( 'yes' === $criteria['multi'] && $output_ind_user_rating ) {
				$output_rating[$i] = '<' . esc_attr( $container_tag ) . ' class="gpur-rating-data">' . $output_ind_user_rating . '</' . esc_attr( $container_tag ) . '>';
			} elseif ( 'no' === $criteria['multi'] && ( $output_avg_user_rating OR $output_user_votes OR $output_ind_user_rating ) ) {
				if ( $output_avg_user_rating && $output_ind_user_rating && 'position-text-bottom' === $text_position ) {
					$divider = '<' . esc_attr( $container_tag ) . ' class="gpur-clear"></' . esc_attr( $container_tag ) . '>';
				} else {
					$divider = '';
				}				
				$output_rating[$i] = '<' . esc_attr( $container_tag ) . ' class="gpur-rating-data">' . $output_avg_user_rating . $output_user_votes . $divider . $output_ind_user_rating . '</' . esc_attr( $container_tag ) . '>';
			}

		}
		
		$unique_id = 'gpur-' . uniqid();

		// Classes
		$css_classes = array(
			$unique_id,
			'gpur-element-wrapper',
			'gpur-add-user-ratings-wrapper',
			'gpur-' . $style['class'],
			( 1 == $criterion_boxes ) ? 'gpur-criterion-boxes' : '',
			'gpur-' . $criteria_format,
			'gpur-' . $position,
			'gpur-' . $text_position,
			'gpur-in-' . $meta,
			$style['linear_class'],
			$criteria['class'],
			'yes' === $is_rated ? 'gpur-rated' : 'gpur-unrated',
			( 1 == $show_submit_button OR 'yes' === $criteria['multi'] ) ? 'gpur-has-submit-button' : 'gpur-no-submit-button',
		);
		$css_classes = trim( implode( ' ', array_filter( array_unique( $css_classes ) ) ) );
		$css = isset( $css ) ? $css : '';	
		$css_classes = $css_classes . gpur_custom_css_class( $css, ' ' );
	
		// Inline CSS
		if ( 'wpb' === $builder ) {
			
			$inline_css = '';

			// Title
			if ( $title_size ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-element-title {font-size: ' . ghostpool_add_units( $title_size ) . ';}';
			} 
			if ( $title_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-element-title {color: ' . esc_attr( $title_color ) . ';}';
			} 
			if ( isset( $title_extra_css ) && $title_extra_css ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-element-title {' . esc_attr( $title_extra_css ) . '}';
			}
		
			// Rating image
			if ( $rating_image ) { 
				if ( isset( $rating_image['id'] ) ) {
					$image_id = $rating_image['id'];
				} else {
					$image_id = $rating_image;
				}
				$rating_image_data = wp_get_attachment_image_src( $image_id );
				$inline_css .= '.' . esc_attr( $unique_id ) . '.gpur-style-image .gpur-symbol-empty, .' . esc_attr( $unique_id ) . '.gpur-style-image .gpur-symbol-filled {background-image:url(' . esc_attr( $rating_image_data[0] ) . '); width: ' . esc_attr( $rating_image_data[1] ) . 'px; height: ' . esc_attr( $rating_image_data[2] / 2 ) . 'px;
				}';
			} 				

			// Rating icons
			if ( $empty_icon_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .rating-symbol-background {color: ' . esc_attr( $empty_icon_color ) . ';}.' . esc_attr( $unique_id ) . '.gpur-style-circles .gpur-symbol-empty, .' . esc_attr( $unique_id ) . '.gpur-style-squares .gpur-symbol-empty, .' . esc_attr( $unique_id ) . '.gpur-style-bars .gpur-symbol-empty {background-color: ' . esc_attr( $empty_icon_color ) . ';}';
			}
			if ( $filled_icon_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .rating-symbol-foreground {color: ' . esc_attr( $filled_icon_color ) . ';}.' . esc_attr( $unique_id ) . '.gpur-style-circles .gpur-symbol-filled, .' . esc_attr( $unique_id ) . '.gpur-style-squares .gpur-symbol-filled, .' . esc_attr( $unique_id ) . '.gpur-style-bars .gpur-symbol-filled {background-color: ' . esc_attr( $filled_icon_color ) . ';}';
			}
			if ( $icon_width ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .rating-symbol {font-size: ' . ghostpool_add_units( $icon_width ) . ';}';
				$inline_css .= '.' . esc_attr( $unique_id ) . '.gpur-style-circles .gpur-symbol, .' . esc_attr( $unique_id ) . '.gpur-style-squares .gpur-symbol {width: ' . ghostpool_add_units( $icon_width ) . ';}';
			}			
			if ( $icon_height ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . '.gpur-style-bars .gpur-symbol, .' . esc_attr( $unique_id ) . '.gpur-style-circles .gpur-symbol, .' . esc_attr( $unique_id ) . '.gpur-style-squares .gpur-symbol {height: ' . ghostpool_add_units( $icon_height ) . ';}';
			}

			// Criteria Title
			if ( $criteria_title_size ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-criterion-title {font-size: ' . ghostpool_add_units( $criteria_title_size ) . ';}';
			} 
			if ( $criteria_title_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-criterion-title {color: ' . esc_attr( $criteria_title_color ) . ';}';
			} 
			if ( $criteria_title_extra_css ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-criterion-title {' . esc_attr( $criteria_title_extra_css ) . '}';
			} 

			// Criterion boxes
			if ( $criterion_boxes_padding ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . '.gpur-criterion-boxes .gpur-criterion {padding: ' . ghostpool_add_units( $criterion_boxes_padding ) . ';}';
			}	
			if ( $criterion_boxes_bg_color_1 ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . '.gpur-criterion-boxes .gpur-criterion:nth-child(odd) {background-color: ' . esc_attr( $criterion_boxes_bg_color_1 ) . ';}';
			}	
			if ( $criterion_boxes_bg_color_2 ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . '.gpur-criterion-boxes .gpur-criterion:nth-child(even) {background-color: ' . esc_attr( $criterion_boxes_bg_color_2 ) . ';}';
			}	
			if ( $criterion_boxes_border_width ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . '.gpur-criterion-boxes .gpur-criterion {border-top-width: ' . ghostpool_add_units( $criterion_boxes_border_width ) . ';}';
			}	
			if ( $criterion_boxes_border_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . '.gpur-criterion-boxes .gpur-criterion {border-color: ' . esc_attr( $criterion_boxes_border_color ) . ';}';
			}		
			if ( $criterion_boxes_extra_css ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . '.gpur-criterion-boxes .gpur-criterion {' . esc_attr( $criterion_boxes_extra_css ) . '}';
			}

			// Average User Rating - Label
			if ( $avg_user_rating_label_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-avg-user-rating-label {color: ' . esc_attr( $avg_user_rating_label_color ) . ';}';
			}
			if ( $avg_user_rating_label_size ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-avg-user-rating-label {font-size: ' . ghostpool_add_units( $avg_user_rating_label_size ) . ';}';
			}
			if ( $avg_user_rating_label_extra_css ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-avg-user-rating-label {' . esc_attr( $avg_user_rating_label_extra_css ) . '}';
			}
							
			// Average User Rating - Rating Number
			if ( $avg_user_rating_number_size ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-avg-user-rating {font-size: ' . ghostpool_add_units( $avg_user_rating_number_size ) . ';}';
			}
			if ( $avg_user_rating_number_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-avg-user-rating {color: ' . esc_attr( $avg_user_rating_number_color ) . ';}';
			}
			if ( $avg_user_rating_number_extra_css ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-avg-user-rating {' . esc_attr( $avg_user_rating_number_extra_css ) . '}';
			}

			// Average User Rating - Maximum Rating Number		
			if ( $avg_user_rating_max_rating_number_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-avg-user-rating .gpur-max-rating {color: ' . esc_attr( $avg_user_rating_max_rating_number_color ) . ';}';
			}
			if ( $avg_user_rating_max_rating_number_size ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-avg-user-rating .gpur-max-rating {font-size: ' . ghostpool_add_units( $avg_user_rating_max_rating_number_size ) . ';}';
			}
			if ( $avg_user_rating_max_rating_number_extra_css ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-avg-user-rating .gpur-max-rating {' . esc_attr( $avg_user_rating_max_rating_number_extra_css ) . '}';
			}
						
			// Individual User Rating - Label
			if ( $ind_user_rating_label_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-ind-user-rating-label {color: ' . esc_attr( $ind_user_rating_label_color ) . ';}';
			}
			if ( $ind_user_rating_label_size ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-ind-user-rating-label {font-size: ' . ghostpool_add_units( $ind_user_rating_label_size ) . ';}';
			}
			if ( $ind_user_rating_label_extra_css ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-ind-user-rating-label {' . esc_attr( $ind_user_rating_label_extra_css ) . '}';
			}
	
			// User Votes Text			
			if ( $user_votes_text_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-user-votes {color: ' . esc_attr( $user_votes_text_color ) . ';}';
			}
			if ( $user_votes_text_size ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-user-votes {font-size: ' . ghostpool_add_units( $user_votes_text_size ) . ';}';
			}
			if ( $user_votes_text_extra_css ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-user-votes {' . esc_attr( $user_votes_text_extra_css ) . '}';
			}
		
			// Individual User Rating - Rating Number
			if ( $ind_user_rating_number_size ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-ind-user-rating-label, .' . esc_attr( $unique_id ) . ' .gpur-ind-user-rating {font-size: ' . ghostpool_add_units( $ind_user_rating_number_size ) . ';}';
			}
			if ( $ind_user_rating_number_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-ind-user-rating-label, .' . esc_attr( $unique_id ) . ' .gpur-ind-user-rating {color: ' . esc_attr( $ind_user_rating_number_color ) . ';}';
			}
			if ( $ind_user_rating_number_extra_css ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-ind-user-rating-label, .' . esc_attr( $unique_id ) . ' .gpur-ind-user-rating {' . esc_attr( $ind_user_rating_number_extra_css ) . '}';
			}
		
			// Individual User Rating - Maximum Rating Number		
			if ( $ind_user_rating_max_rating_number_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-ind-user-rating .gpur-max-rating {color: ' . esc_attr( $ind_user_rating_max_rating_number_color ) . ';}';
			}
			if ( $ind_user_rating_max_rating_number_size ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-ind-user-rating .gpur-max-rating {font-size: ' . ghostpool_add_units( $ind_user_rating_max_rating_number_size ) . ';}';
			}
			if ( $ind_user_rating_max_rating_number_extra_css ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-ind-user-rating .gpur-max-rating {' . esc_attr( $ind_user_rating_max_rating_number_extra_css ) . '}';
			}

			// Submit button
			if ( $submit_button_text_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-submit-rating {color: ' . esc_attr( $submit_button_text_color ) . ';}';
			}			
			if ( $submit_button_text_hover_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-submit-rating:hover {color: ' . esc_attr( $submit_button_text_hover_color ) . ';}';
			}
			if ( $submit_button_border_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-submit-rating {border-color: ' . esc_attr( $submit_button_border_color ) . ';}';
			}
			if ( $submit_button_border_hover_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-submit-rating:hover {border-color: ' . esc_attr( $submit_button_border_hover_color ) . ';}';
			}
			if ( $submit_button_bg_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-submit-rating {background-color: ' . esc_attr( $submit_button_bg_color ) . ';}';
			}
			if ( $submit_button_bg_hover_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-submit-rating:hover {background-color: ' . esc_attr( $submit_button_bg_hover_color ) . ';}';
			}
			if ( $submit_button_css ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-submit-rating {' . esc_attr( $submit_button_css ) . ';}';
			}

			wp_register_style( 'gpur-shortcodes', false );
			wp_enqueue_style( 'gpur-shortcodes' );
			wp_add_inline_style( 'gpur-shortcodes', $inline_css );
		
		}
				
		$output = '<' . esc_attr( $container_tag ) . ' class="' . esc_attr( $css_classes ) . '">';

			if ( $title ) {
				if ( 'comment' === $meta ) {
					$output .= '<label for="rating">' . esc_attr( $title ) . '</label>';
				} else {
					$output .= '<h2 class="gpur-element-title">' . esc_attr( $title ) . '</h2>';
				}
			}

			if ( 'allowed' === gpur_permissions( $permissions, $permission_roles ) ) {

				// Set counter to 0
				$i = 0;

				if ( 'yes' === $criteria['multi'] ) {

					foreach( $criteria['fields'] as $criterion ) {
		
						include( plugin_dir_path( __FILE__ ) . 'add-user-ratings-template.php' );
				
					}

				} else {

					include( plugin_dir_path( __FILE__ ) . 'add-user-ratings-template.php' );
	
				}

				if ( 'yes' === $criteria['multi'] && 'post' === $meta && ( $output_avg_user_rating OR $output_user_votes ) ) {
					$output .= '<' . esc_attr( $container_tag ) . ' class="gpur-rating-data gpur-average-data">' . wp_kses_post( $output_avg_user_rating . $output_user_votes ) . '</' . esc_attr( $container_tag ) . '>';
				}
							
				if ( 'post' === $meta && 'no' === $is_rated && ( 'yes' === $criteria['multi'] OR ( 1 == $show_submit_button && 'no' === $criteria['multi'] ) ) ) {
					$output .= '<' . esc_attr( $container_tag ) . ' class="gpur-clear"></' . esc_attr( $container_tag ) . '>
					<' . esc_attr( $container_tag ) . ' class="gpur-submit-rating">' . esc_attr( $submit_button_label ) . '</' . esc_attr( $container_tag ) . '>
					<' . esc_attr( $container_tag ) . ' class="gpur-success">' . esc_attr( $success_message ) . '</' . esc_attr( $container_tag ) . '>
					<' . esc_attr( $container_tag ) . ' class="gpur-error">' . esc_attr( $error_message ) . '</' . esc_attr( $container_tag ) . '>';
				}	
		
			} else {

				$output .= esc_attr( $logged_in_to_vote_label );

			}
					
		$output .= '</' . esc_attr( $container_tag ) . '>';

		return $output;
		
	}		
}		