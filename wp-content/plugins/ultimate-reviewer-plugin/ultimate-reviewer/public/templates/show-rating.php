<?php if ( ! function_exists( 'gpur_show_rating_template' ) ) {
	function gpur_show_rating_template( $args ) {
		
		// Load scripts
		wp_enqueue_script( 'bootstrap-rating' );
		wp_enqueue_script( 'gpur-show-rating' );
		
		// Template variables	
		$defaults = array(
			'post_id' => get_the_ID(),
			'comment_id' => '',
			'meta' => 'post',
			'builder' => 'wpb',
			'run_once' => true,
			'atts' => array(),
		);
		$args = wp_parse_args( $args, $defaults );
		extract( $args );

		// Get attributes
		$atts_defaults = gpur_show_rating_shortcode_atts();
		$atts = wp_parse_args( $atts, $atts_defaults );	
		extract( $atts );

		// Get post ID
		$post_id = gpur_get_hub_id( $post_id );

		// Get correct meta keys
		$site_rating_meta_key = gpur_get_site_rating( $post_id );
		$avg_user_rating_meta_key = gpur_get_avg_user_rating( $post_id );
		$ind_user_rating_meta_key = gpur_get_ind_user_rating( $post_id );
		$user_votes_meta_key = gpur_get_user_votes( $post_id );
		$user_sum_meta_key = gpur_get_user_sum( $post_id );
		$summary_meta_key = gpur_get_summary( $post_id );
		$excerpt_meta_key = gpur_get_excerpt( $post_id );
		
		// Load style function
		$style = gpur_rating_styles( $style, $empty_icon, $filled_icon );

		// Load criteria function
		$criteria = gpur_criteria( $criteria );

		// Get rating data 
		$avg_user_rating_value = 0;
		if ( 'site-rating' === $data ) {
			$rating_value = get_post_meta( $post_id, $site_rating_meta_key, true );
		} elseif ( 'user-rating' === $data ) {
			$rating_value = get_post_meta( $post_id, $avg_user_rating_meta_key, true );
			$avg_user_rating_value = $rating_value;
		} elseif ( 'comment-rating' === $data ) {
			if ( 'yes' === $criteria['multi'] ) {
				$rating_value = get_comment_meta( $comment_id, 'gpur_rating', true );		
				$rating_value = array_map( 'intval', explode(',', $rating_value ) );
			} else {
				$rating_value = get_comment_meta( $comment_id, 'gpur_avg_rating', true );
			}
		} elseif ( 'custom' === $data ) {
			if ( strpos( $value, ',' ) ) {
				$rating_value = array_map( 'intval', explode( ',', $value ) );
			} else {
				$rating_value = $value;
			}
		}
		
		if ( ! is_array( $rating_value ) ) {
			$rating_value = array( $rating_value );
		}
	
		// End here if item has no rating value and zero ratings disabled
		if ( 1 != $show_zero_rating && empty( $rating_value ) && 'no' === $criteria['multi'] ) {
			return;
		}

		// Display labels
		$display_site_rating_label = '';
		if ( 1 == $show_site_rating_text && 'user-rating' !== $data && 'gpur-linear' === $style['linear_class'] ) {
			$display_site_rating_label = '' !== $site_rating_label ? '<span class="gpur-site-rating-label">' . $site_rating_label . '</span>' : '';
		}					
		$display_avg_user_rating_label = '';
		if ( 1 == $show_avg_user_rating_text && 'user-rating' === $data && 'gpur-linear' === $style['linear_class'] ) {
			$display_avg_user_rating_label = '' !== $avg_user_rating_label ? '<span class="gpur-avg-user-rating-label">' . $avg_user_rating_label . '</span>' : '';
		}
		$display_ind_user_rating_label = '';
		if ( 1 == $show_ind_user_rating_text && ( 'user-rating' === $data OR 'comment-rating' === $data ) && 'gpur-linear' === $style['linear_class'] ) {
			$display_ind_user_rating_label = '' !== $ind_user_rating_label ? '<span class="gpur-ind-user-rating-label">' . $ind_user_rating_label . '</span>' : '';
		}	

		// Display maximum ratings
		$display_site_rating_max_rating = '';
		if ( 1 == $show_site_rating_max_rating_number ) {
			$display_site_rating_max_rating = '<div class="gpur-max-rating">' . $max_rating . '</div>';
		}
		$display_avg_user_rating_max_rating = '';
		if ( 1 == $show_avg_user_rating_max_rating_number ) {
			$display_avg_user_rating_max_rating = '<div class="gpur-max-rating">' . $max_rating . '</div>';
		}
		$display_ind_user_rating_max_rating = '';
		if ( 1 == $show_ind_user_rating_max_rating_number ) {
			$display_ind_user_rating_max_rating = '<div class="gpur-max-rating">' . $max_rating . '</div>';
		}		
	
		// Display user votes
		$output_user_votes = '';
		if ( 1 == $show_user_votes_text && 'user-rating' === $data ) {
			$user_votes = (int) get_post_meta( $post_id, $user_votes_meta_key, true );
			if ( '' === $user_votes ) {
				$user_votes =  '<span class="gpur-user-votes-number">0</span><span class="gpur-user-votes-text">' . $plural_vote_label . '</span>';
			} elseif ( 1 == $user_votes ) {
				$user_votes = '<span class="gpur-user-votes-number">' . $user_votes . '</span><span class="gpur-user-votes-text">' . $singular_vote_label . '</span>';
			} else {
				$user_votes = '<span class="gpur-user-votes-number">' . $user_votes . '</span><span class="gpur-user-votes-text">' . $plural_vote_label . '</span>';
			}	
			$output_user_votes = '<div class="gpur-user-votes">' . $user_votes . '</div>';
		}
	
		// Get your user rating value
		if ( 'comment' === $meta ) {
			$your_user_rating_value = 0;
		} elseif ( get_user_meta( get_current_user_id(), $ind_user_rating_meta_key, true ) ) {
			$your_user_rating_value = get_user_meta( get_current_user_id(), $ind_user_rating_meta_key, true );
		} elseif ( isset( $_COOKIE['gpur_user_rating_' . $post_id] ) && ! is_user_logged_in() ) {
			$your_user_rating_value = $_COOKIE['gpur_user_rating_' . $post_id];
		} else {
			$your_user_rating_value = 0;
		}

		// Convert rating values to an array				
		if ( is_array( $your_user_rating_value ) ) {
			$your_user_rating_value = is_array( $your_user_rating_value[0] ) ? array_values( $your_user_rating_value[0] ) : $your_user_rating_value[0];
		} elseif ( ! is_array( $your_user_rating_value ) && false !== strpos( $your_user_rating_value, ',' ) ) {
			$your_user_rating_value = explode( ',', $your_user_rating_value );
		} else {
			$your_user_rating_value = array( $your_user_rating_value );
		}
				
		// Ranges text
		$ranges_chunks = '';
		if ( 1 == $show_ranges_text && $rating_ranges ) {
			$ranges = str_replace( '-', ',', $rating_ranges );
			$ranges = str_replace( ':', ',', $ranges );
			$ranges_array = explode( ',',  $ranges );
			$ranges_chunks = array_chunk( $ranges_array, 3 );
		}	
					
		// Loop through multi ratings
		$each_rating_value = 0;
		for( $i = 0; $i < $criteria['count']; $i++ ) {	
		
			// Set all criteria values to zero
			if ( ! isset ( $your_user_rating_value[$i] ) ) {
				$your_user_rating_value[$i] = 0;
			}	

			// Multi rating data		
			if ( 'yes' === $criteria['multi'] && $criteria['fields'] ) {
				
				$criterion_slug = sanitize_title_with_dashes( $criteria['fields'][$i] );
				$weight = isset( $criteria['weights'][$i] ) ? $criteria['weights'][$i] : 1;
				
				if ( 'custom' === $data && isset( $rating_value[$i] ) && '' !== $rating_value[$i] )  {
					
					$rating = $rating_value[$i];
				
				} elseif ( get_post_meta( $post_id, 'gpur_criterion_' . $criterion_slug, true ) && 'site-rating' === $data ) {
					
					$rating = get_post_meta( $post_id, 'gpur_criterion_' . $criterion_slug, true );
				
				} elseif ( get_post_meta( $post_id, 'gpur_multi_avg_user_rating', true ) && 'user-rating' === $data ) {
					
					// Average rating of each user criteria
					$multi_avg_user_ratings = get_post_meta( $post_id, 'gpur_multi_avg_user_rating', true );
					$rating = isset( $multi_avg_user_ratings[$i] ) ? $multi_avg_user_ratings[$i] : 0;	
					
					// Individual rating of each  user criteria
					//$ind_user_ratings = get_user_meta( get_current_user_id(), $ind_user_rating_meta_key, true );
					//$your_user_rating_value = is_array( $ind_user_ratings[0] ) ? array_values( $ind_user_ratings[0] ) : $ind_user_ratings[0];	
					
				} elseif ( isset( $rating_value[$i] ) && '' !== $rating_value[$i] )  {
					
					$rating = $rating_value[$i];
				
				} else {
					
					$rating = 0;
				
				}
				
				$each_rating_value += $rating * $weight;
				$rating_value[$i] = $rating;
				
			} else {
	
				// Get your user rating value
				if ( 'comment' === $meta ) {
					$your_user_rating_value = 0;
				} elseif ( get_user_meta( get_current_user_id(), $ind_user_rating_meta_key, true ) ) {
					$your_user_rating_value = get_user_meta( get_current_user_id(), $ind_user_rating_meta_key, true );
				} elseif ( isset( $_COOKIE['gpur_user_rating_' . $post_id] ) && ! is_user_logged_in() ) {
					$your_user_rating_value = $_COOKIE['gpur_user_rating_' . $post_id];
				} else {
					$your_user_rating_value = 0;
				}

				// Convert rating values to an array				
				if ( is_array( $your_user_rating_value ) ) {
					$your_user_rating_value = is_array( $your_user_rating_value[0] ) ? array_values( $your_user_rating_value[0] ) : $your_user_rating_value[0];
				} elseif ( ! is_array( $your_user_rating_value ) && false !== strpos( $your_user_rating_value, ',' ) ) {
					$your_user_rating_value = explode( ',', $your_user_rating_value );
				} else {
					$your_user_rating_value = array( $your_user_rating_value );
				}
						
			}

			// Show rating if has no value
			if ( 1 != $show_zero_rating && empty( $rating_value[$i] ) && 'yes' === $criteria['multi'] ) {
				return;
			} elseif ( 1 == $show_zero_rating && ( empty( $rating_value[$i] ) OR 0 === $rating_value[$i] ) ) {
				$rating_value[$i] = 0;
			}

			// Display site ratings
			$output_site_rating = '';
			if ( ( 1 == $show_site_rating_text OR in_array( $style['class'], array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ) ) ) && ( 'site-rating' === $data OR 'custom' === $data ) ) {
				$output_site_rating = $display_site_rating_label . '<div class="gpur-site-rating"><div class="gpur-rating-value">' . round( $rating_value[$i], $decimal_places ) . '</div>' . $display_site_rating_max_rating . '</div>';
			}

			// Display average user rating
			$output_avg_user_rating = '';
			if ( ( 1 == $show_avg_user_rating_text OR in_array( $style['class'], array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ) ) ) && 'user-rating' === $data ) {
				$output_avg_user_rating = $display_avg_user_rating_label . '<div class="gpur-avg-user-rating"><div class="gpur-rating-value">' . $rating_value[$i] . '</div>' . $display_avg_user_rating_max_rating . '</div>';
			}
		
			// Display individual user ratings
			$output_ind_user_rating = '';
			if ( ( 'user-rating' === $data OR 'comment-rating' === $data ) && ( ( 1 == $show_ind_user_rating_text && in_array( $style['class'], array(  'style-stars', 'style-hearts', 'style-squares', 'style-circles', 'style-bars', 'style-icon', 'style-image' ) ) ) OR ( ( 'comment' === $meta OR 'widget' === $meta ) && in_array( $style['class'], array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ) ) ) ) ) {
				$output_ind_user_rating = $display_ind_user_rating_label . '<div class="gpur-ind-user-rating"><div class="gpur-rating-value">' . $your_user_rating_value[$i] . '</div>' . $display_ind_user_rating_max_rating . '</div>';
			}
				
			// Display ranges text
			$range_text[$i] = '';
			if ( 1 == $show_ranges_text && is_array( $ranges_chunks ) ) {
				foreach( $ranges_chunks as $ranges_chunk ) {
					if ( $rating_value[$i] >= $ranges_chunk[0] && $rating_value[$i] <= $ranges_chunk[1] ) {
						$range_text[$i] = $ranges_chunk[2];
					}
				}
			}
			$output_ranges_text = '';
			if ( 1 == $show_ranges_text ) {		
				$output_ranges_text = '<div class="gpur-ranges-text">' . esc_attr( $range_text[$i] ) . '</div>';
			}

			// Rating gauge circle degrees class
			$degrees_class[$i] = '';	
			if ( 'style-gauge-circles-singular' === $style['class'] ) {

				// Value
				$degrees[$i] = 0;
				if ( '' !== $rating_value[$i] && $max_rating ) {
					$degrees[$i] = ( 360 * ( $rating_value[$i] / $max_rating ) );
				}

				// Class
				if ( $degrees[$i] < 180 ) {
					$degrees_class[$i] = ' gpur-small-rating';
				} elseif ( $degrees[$i] >= 360 ) {
					$degrees_class[$i] = ' gpur-large-rating gpur-full-gauge-rating';	
				} else {
					$degrees_class[$i] = ' gpur-large-rating';
				}

			}
					
			// Output rating data
			$output_rating[$i] = '';
			if ( $output_site_rating OR $output_avg_user_rating OR $output_user_votes OR $output_ind_user_rating OR $output_ranges_text ) {
				$output_rating[$i] = '<div class="gpur-rating-data">' . $output_site_rating . $output_avg_user_rating . $output_user_votes . $output_ind_user_rating . $output_ranges_text . '</div>';
			}

		} // end multi rating loop
		
		// Rich snippets
		if ( 1 == $rich_snippets && true === $run_once ) {
			gpur_rich_snippets( $post_id, $data, $max_rating, $value );
		}
		
		// Unique ID
		if ( 'post' === $meta ) {
			$unique_id = 'gpur-' . uniqid();
		} else {
			$unique_id = 'gpur-' . $post_id;
		}
																									
		// Classes
		$css_classes = array(
			$unique_id,
			'gpur-element-wrapper',
			'gpur-show-rating-wrapper',
			'gpur-' . $style['class'],
			'gpur-is-' . $data,
			( 1 == $criterion_boxes ) ? 'gpur-criterion-boxes' : '',
			'gpur-' . $position,
			$text_position ? 'gpur-' . $text_position : 'gpur-position-text-bottom',
			$style['linear_class'],
			'gpur-' . $criteria_format,
			$criteria['class'],
		);
		$css_classes = trim( implode( ' ', array_filter( array_unique( $css_classes ) ) ) );	
		$css = isset( $css ) ? $css : '';	
		$css_classes = $css_classes . gpur_custom_css_class( $css, ' ' );
			
		// Inline CSS			
		if ( true === $run_once ) {
			if ( 'wpb' === $builder ) {
				include( GPUR_PATH . 'public/templates/show-rating-css.php' );
			} else {
				$inline_css = '';
				if ( $gauge_filled_color_1 OR $gauge_filled_color_2 ) {
					$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-small-rating .gpur-gauge-spinner {background: ' . esc_attr( $gauge_filled_color_1 ) . '; background:-webkit-linear-gradient(' . esc_attr( $gauge_filled_color_1 ) . ' 0%,' . esc_attr( $gauge_filled_color_2 ) . ' 70%); background:linear-gradient(' . esc_attr( $gauge_filled_color_1 ) . ' 0%,' . esc_attr( $gauge_filled_color_2 ) . ' 70%);}.' . esc_attr( $unique_id ) . ' .gpur-large-rating .gpur-gauge-spinner {background: ' . esc_attr( $gauge_filled_color_1 ) . ';}.' . esc_attr( $unique_id ) . ' .gpur-gauge-filler {background: ' . esc_attr( $gauge_filled_color_1 ) . '; background:-webkit-linear-gradient(' . esc_attr( $gauge_filled_color_2 ) . ' 0%,' . esc_attr( $gauge_filled_color_1 ) . ' 70%); background:linear-gradient(' . esc_attr( $gauge_filled_color_2 ) . ' 0%,' . esc_attr( $gauge_filled_color_1 ) . ' 70%);}.' . esc_attr( $unique_id ) . '.gpur-style-gauge-circles-singular .gpur-rating-outer.gpur-full-gauge-rating {background: ' . esc_attr( $gauge_filled_color_1 ) . ';}';
					wp_register_style( 'gpur-shortcodes', false );
					wp_enqueue_style( 'gpur-shortcodes' );
					wp_add_inline_style( 'gpur-shortcodes', $inline_css );
				}
			}		
		}	
		
		$output = '<div class="' . esc_attr( $css_classes ) . '">';

			if ( $title ) {
				$output .= '<h2 class="gpur-element-title">' . esc_attr( $title ) . '</h2>';
			}

			// Set counter to 0
			$i = 0;

			if ( 'yes' === $criteria['multi'] ) {

				foreach( $criteria['fields'] as $criterion ) {
		
					include( plugin_dir_path( __FILE__ ) . 'show-rating-template.php' );
			
				}	

			} else { 

				include( plugin_dir_path( __FILE__ ) . 'show-rating-template.php' );

			}

		$output .= '</div><div class="gpur-clear"></div>';
		
		return $output;

	}	
}	