<?php if ( ! function_exists( 'gpur_comparison_table_template' ) ) {
	function gpur_comparison_table_template( $args ) {
		
		// Load scripts
		wp_enqueue_script( 'gpur-comparison-table-sorting' );
		
		// Template variables	
		$defaults = array(
			'builder' => 'wpb',
			'atts' => array(),
		);
		$args = wp_parse_args( $args, $defaults );
		extract( $args );
		
		// Get attributes
		$atts_defaults = gpur_comparison_table_shortcode_atts();
		$atts = wp_parse_args( $atts, $atts_defaults );	
		extract( $atts );

		// Post types
		if ( ! is_array( $post_types ) && $post_types ) {
			$post_types = explode( ',', $post_types );
		}
	
		// Post/page IDs		
		if ( $ids ) {
			$ids = explode( ',', $ids );
		}

		// Fields
		if ( FALSE !== strpos( $fields, "\n" ) ) { // Elementor
			$fields = explode( "\n", $fields );	
		} else { // WPB
			$fields = explode( ',', $fields );
		}
		
		// Sorting values
		$sorting = gpur_sorting( $sort, $rating_range );

		// Query
		$args = array(
			'post_status' 	      => 'publish',
			'post_type'           => $post_types,
			'post__in' 			  => $ids,
			'category_name' 	  => $cats,
			'tag'			      => $tags,
			'orderby'             => $sorting['order_by'],
			'order'               => $sorting['order'],
			'meta_key' 		      => $sorting['meta_key'],
			'meta_query' 		  => $sorting['meta_query'],
			'posts_per_page'      => $number,
		);
		$query = new WP_Query( $args );	
		
		// Unique ID
		$unique_id = 'gpur-' . uniqid();

		// Get string of all shortcode attributes
		$shortcode_atts = '';
		if ( $atts ) {			
			foreach( $atts as $name => $value ) {
				if ( array_key_exists( $name, $atts_defaults ) ) {
					if ( is_array( $value ) ) {
						if ( isset( $value['unit'] ) ) {
							$value = $value['size'];
						} else {
							$value = implode( ',', $value );
						}	
					}
					$shortcode_atts .= $name . ':' . $value . '|';
				}			
			}
			$shortcode_atts = rtrim( $shortcode_atts, '|' );
		}
		
		// Classes
		$css_classes = array(
			$unique_id,
			'gpur-element-wrapper',
			'gpur-comparison-table-wrapper',
			'gpur-' . $table_format,
			1 == $remove_vertical_borders ? 'gpur-remove-vertical-borders' : '',
		);
		$css_classes = trim( implode( ' ', array_filter( array_unique( $css_classes ) ) ) );		
		$css = isset( $css ) ? $css : '';	
		$css_classes = $css_classes . gpur_custom_css_class( $css, ' ' );

		// Inline CSS
		if ( 'wpb' === $builder ) {
			
			$inline_css = '';
		
			// Heading background color
			if ( $heading_bg_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-th, .' . esc_attr( $unique_id ) . ' .gpur-th-inner {background-color: ' . esc_attr( $heading_bg_color ) . ';}';
			}	
			
			// Heading border color
			if ( $heading_border_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-th, .' . esc_attr( $unique_id ) . ' .gpur-th-inner, .' . esc_attr( $unique_id ) . ' .gpur-tr:last-child .gpur-th, .' . esc_attr( $unique_id ) . ' .gpur-tr:last-child .gpur-th-inner {border-color: ' . esc_attr( $heading_border_color ) . ';}';
			}	
			
			// Heading text color
			if ( $heading_text_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-th, .' . esc_attr( $unique_id ) . ' .gpur-th-inner, .' . esc_attr( $unique_id ) . ' .gpur-sort-button {color: ' . esc_attr( $heading_text_color ) . ';}';
			}	
			
			// Heading extra css
			if ( $heading_extra_css ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-th, .' . esc_attr( $unique_id ) . ' .gpur-th-inner {' . esc_attr( $heading_extra_css ) . '}';
			}	
			
			// Cell background color 1
			if ( $cell_bg_color_1 ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . '.gpur-format-vertical-grid .gpur-tr:nth-child(even) .gpur-td, .' . esc_attr( $unique_id ) . '.gpur-format-vertical-grid .gpur-tr:nth-child(even) .gpur-td-inner, .' . esc_attr( $unique_id ) . '.gpur-format-horizontal-grid .gpur-tr .gpur-td:nth-child(even), .' . esc_attr( $unique_id ) . '.gpur-format-horizontal-grid .gpur-tr .gpur-td-inner:nth-child(even) {background-color: ' . esc_attr( $cell_bg_color_1 ) . ';}';
			}		

			// Cell background color 2
			if ( $cell_bg_color_2 ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . '.gpur-format-vertical-grid .gpur-tr:nth-child(odd) .gpur-td, .' . esc_attr( $unique_id ) . '.gpur-format-vertical-grid .gpur-tr:nth-child(odd) .gpur-td-inner, .' . esc_attr( $unique_id ) . '.gpur-format-horizontal-grid .gpur-tr .gpur-td:nth-child(odd), .' . esc_attr( $unique_id ) . '.gpur-format-horizontal-grid .gpur-tr .gpur-td-inner:nth-child(odd) {background-color: ' . esc_attr( $cell_bg_color_2 ) . ';}';
			}	
						
			// Cell border color
			if ( $cell_border_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-td, .' . esc_attr( $unique_id ) . ' .gpur-td-inner, .' . esc_attr( $unique_id ) . ' .gpur-tr:last-child .gpur-td, .' . esc_attr( $unique_id ) . ' .gpur-td:last-child .gpur-td-inner {border-color: ' . esc_attr( $cell_border_color ) . ';}';
			}		
				
			// Cell text color
			if ( $cell_text_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-td, .' . esc_attr( $unique_id ) . ' .gpur-td-inner {color: ' . esc_attr( $cell_text_color ) . ';}';
			}	
				
			// Cell link color
			if ( $cell_link_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-td a, .' . esc_attr( $unique_id ) . ' .gpur-td-inner a {color: ' . esc_attr( $cell_link_color ) . ';}';
			}	
				
			// Cell link hover color
			if ( $cell_link_hover_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-td a:hover, .' . esc_attr( $unique_id ) . ' .gpur-td-inner a:hover {color: ' . esc_attr( $cell_link_hover_color ) . ';}';
			}			
				
			// Cell extra css
			if ( $cell_extra_css ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . ' .gpur-td, .' . esc_attr( $unique_id ) . ' .gpur-td-inner {' . esc_attr( $cell_extra_css ) . '}';
			}		
	
			// Review image cell width
			if ( $image_size ) {
	
				if ( is_array( gpur_image_dimensions( $image_size ) ) ) {
					$width = gpur_image_dimensions( $image_size );
					$width = $width[0];
				} else {
					if ( in_array( $image_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
						$width = get_option( "{$image_size}_size_w" );
					} else {
						global $_wp_additional_image_sizes;
						$width = $_wp_additional_image_sizes[ $_size ]['width'];
					}
				}	
		
				$inline_css .= '.' . esc_attr( $unique_id ) . '.gpur-format-vertical-grid .gpur-comparison-table-review-image-1, .' . esc_attr( $unique_id ) . '.gpur-format-vertical-grid .gpur-comparison-table-review-image-2, .' . esc_attr( $unique_id ) . '.gpur-format-vertical-grid .gpur-comparison-table-featured-image {max-width: ' . ghostpool_add_units( $width ) . ';min-width: ' . ghostpool_add_units( $width ) . ';}';
			}	
		
			wp_register_style( 'gpur-shortcodes', false );
			wp_enqueue_style( 'gpur-shortcodes' );
			wp_add_inline_style( 'gpur-shortcodes', $inline_css );
		
		} else {
		
			// Review image cell width
			$inline_css = '';
			if ( $image_size ) {
	
				if ( is_array( gpur_image_dimensions( $image_size ) ) ) {
					$width = gpur_image_dimensions( $image_size );
					$width = $width[0];
				} else {
					if ( in_array( $image_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
						$width = get_option( "{$image_size}_size_w" );
					} else {
						global $_wp_additional_image_sizes;
						$width = $_wp_additional_image_sizes[ $_size ]['width'];
					}
				}	
		
				$inline_css .= '.' . esc_attr( $unique_id ) . '.gpur-format-vertical-grid .gpur-comparison-table-review-image-1, .' . esc_attr( $unique_id ) . '.gpur-format-vertical-grid .gpur-comparison-table-review-image-2, .' . esc_attr( $unique_id ) . '.gpur-format-vertical-grid .gpur-comparison-table-featured-image {max-width: ' . ghostpool_add_units( $width ) . ';min-width: ' . ghostpool_add_units( $width ) . ';}';
			}	
		
			wp_register_style( 'gpur-shortcodes', false );
			wp_enqueue_style( 'gpur-shortcodes' );
			wp_add_inline_style( 'gpur-shortcodes', $inline_css );
			
		}
		
		if ( $query->have_posts() ) {

			include( dirname( plugin_dir_path( __FILE__ ) ) . '/templates/comparison-table-fields.php' );

			$output = '<div class="' . esc_attr( $css_classes ) . '">';
	
				$output .= '<div class="gpur-comparison-table gpur-default-sort-' . esc_attr( $sort ) . '" data-gpur-sorting-query="' . $shortcode_atts . '" gpur-sorting-builder="' . $builder . '" data-gpur-nonce="' . wp_create_nonce( 'gpur_comparison_table_sorting_nonce' ) . '">';

					$all_fields = array(
						'RANKING_NUMBERS' => array( 'RANKING_NUMBERS', 'ranking-numbers', $ranking_numbers_label, false ),
						'REVIEW_IMAGE_1' => array( 'REVIEW_IMAGE_1', 'review-image-1', $review_image_label, false ),
						'REVIEW_IMAGE_2' => array( 'REVIEW_IMAGE_2', 'review-image-2', $review_image_label, false ),
						'FEATURED_IMAGE' => array( 'FEATURED_IMAGE', 'featured-image', $review_image_label, false ),
						'POST_TITLE' => array( 'POST_TITLE', 'post-title', $post_title_label, true ),
						'POST_TITLE_NO_LINK' => array( 'POST_TITLE_NO_LINK', 'post-title-no-link', $post_title_label, true ),
						'POST_DATE' => array( 'POST_DATE', 'post-date', $post_date_label, true ),
						'POST_CATS' => array( 'POST_CATS', 'post-cats', $post_cats_label, false ),
						'POST_TAGS' => array( 'POST_TAGS', 'post-tags', $post_tags_label, false ),
						'SITE_RATING' => array( 'SITE_RATING', 'site-rating', $cell_site_rating_label, true ),
						'USER_RATING' => array( 'USER_RATING', 'user-rating', $user_rating_label, true ),
						'USER_VOTES' => array( 'USER_VOTES', 'user-votes', $user_votes_label, true ),
						'LIKES' => array( 'LIKES', 'likes', $likes_label, true ),
						'DISLIKES' => array( 'DISLIKES', 'dislikes', $dislikes_label, true ),
						'SUMMARY' => array( 'SUMMARY', 'summary', $summary_label, false ),
						'EXCERPT' => array( 'EXCERPT', 'excerpt', $excerpt_label, false ),
						'GOOD_POINTS' => array( 'GOOD_POINTS', 'good-points', $good_points_label, false ),
						'BAD_POINTS' => array( 'BAD_POINTS', 'bad-points', $bad_points_label, false ),
						'BUTTON' => array( 'BUTTON', 'button', $button_label, false ),
						'CUSTOM_FIELD' => array( 'CUSTOM_FIELD', 'custom-field', '', false ),
					);

					if ( 'format-vertical-grid' === $table_format ) {
						include( dirname( plugin_dir_path( __FILE__ ) ) . '/templates/vertical-grid.php' );
					} elseif ( 'format-horizontal-grid' === $table_format ) {
						$output .= '<div class="gpur-desktop-table">';
							include( dirname( plugin_dir_path( __FILE__ ) ) . '/templates/horizontal-grid.php' );
						$output .= '</div>';
						$output .= '<div class="gpur-mobile-table">';
							include( dirname( plugin_dir_path( __FILE__ ) ) . '/templates/vertical-grid.php' );
						$output .= '</div>';	
					}

				$output .= '</div>';	

			$output .= '</div>';	
		}	

		wp_reset_postdata();
	
		return $output;
		
	}		
}		