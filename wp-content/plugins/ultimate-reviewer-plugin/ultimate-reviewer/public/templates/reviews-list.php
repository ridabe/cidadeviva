<?php if ( ! function_exists( 'gpur_reviews_list_template' ) ) {
	function gpur_reviews_list_template( $args ) {	

		// Template variables	
		$defaults = array(
			'builder' => 'wpb',
			'atts' => array(),
		);
		$args = wp_parse_args( $args, $defaults );
		extract( $args );

		// Get attributes
		$atts_defaults = gpur_reviews_list_shortcode_atts();
		$atts = wp_parse_args( $atts, $atts_defaults );
		extract( $atts );
		
		// Get correct meta keys
		$avg_user_rating_meta_key = gpur_get_avg_user_rating( get_the_ID() );
		$user_votes_meta_key = gpur_get_user_votes( get_the_ID() );
		$user_sum_meta_key = gpur_get_user_sum( get_the_ID() );
		$summary_meta_key = gpur_get_summary( get_the_ID() );
		$excerpt_meta_key = gpur_get_excerpt( get_the_ID() );
		$up_votes_meta_key = gpur_get_up_votes( get_the_ID() );
		$down_votes_meta_key = gpur_get_down_votes( get_the_ID() );			
			
		// Post types
		if ( ! is_array( $post_types ) && $post_types ) {
			$post_types = explode( ',', $post_types );
		}			

		// Post/page IDs
		if ( $ids ) {
			$ids = explode( ',', $ids );
		}
	
		// Sorting values
		$sorting = gpur_sorting( $sort, $rating_range );
				
		// Exclude current item
		$excluded_post_id = null;
		if ( 1 == $exclude_current_item ) {
			if ( is_singular() ) {
				$excluded_post_id = array( get_the_ID() );
			}
		}
		
		// Show current category/tag posts only
		if ( 1 == $current_tax ) {
		
			if ( is_singular() ) {
				$categories = get_the_category();
				if ( $categories ) {
					foreach ( $categories as $category ) {
						$cat_id[] = $category->cat_ID;	
					}					
					$cats = $cat_id;
				}	
			} elseif ( is_category() ) {
				$category = get_queried_object();
				if ( $category ) {
					$cat_id = $category->slug;
					$cats = $cat_id;
				}	
			} elseif ( is_tag() ) {
				$tags = get_queried_object();
				if ( $tags ) {
					$tag_id = $tag->slug;
					$tags = $tag_id;
				}	
			}
			
		}
		
		// Query						
		$query_args = array(
			'post_status'		=> 'publish',
			'post_type' 		=> $post_types,
			'post__in'	    	=> $ids,
			'post__not_in'      => $excluded_post_id,
			'category_name' 	=> $cats,
			'tag'			    => $tags,
			'orderby' 			=> $sorting['order_by'],
			'order' 	    	=> $sorting['order'],
			'meta_key' 			=> $sorting['meta_key'],
			'meta_query' 		=> $sorting['meta_query'],
			'posts_per_page'	=> $number,
			'no_found_rows'     => true,
		);			
		$query = new WP_Query( apply_filters( 'gpur_reviews_list_query', $query_args, $atts ) );
			
		$unique_id = 'gpur-' . uniqid();
							
		// Classes
		$css_classes = array(
			$unique_id,
			'gpur-element-wrapper',
			'gpur-reviews-list-wrapper',
			$post_format,
		);
		$css_classes = trim( implode( ' ', array_filter( array_unique( $css_classes ) ) ) );		
		$css = isset( $css ) ? $css : '';	
		$css_classes = $css_classes . gpur_custom_css_class( $css, ' ' );
	
		// Inline CSS
		if ( 'wpb' === $builder ) {
		
			$inline_css = '';

			// Border color
			if ( $posts_border_color ) {
				$inline_css .= '.' . esc_attr( $unique_id ) . '.gpur-format-list .gpur-reviews-list-item{border-color: ' . $posts_border_color . ';}';
			}
		
			wp_register_style( 'gpur-shortcodes', false );
			wp_enqueue_style( 'gpur-shortcodes' );
			wp_add_inline_style( 'gpur-shortcodes', $inline_css );

		}
		
		$output = '<div class="' . esc_attr( $css_classes ) . '">';
		
			if ( $title ) {
				$output .= '<h2 class="gpur-element-title">' . esc_attr( $title ) . '</h2>';
			}	
						
			if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();

				$output_ratings = '';
				$linear_class = '';	
				
				if ( 1 == $show_site_rating OR 1 == $show_user_rating ) {
				
					$output_ratings .= '<div class="gpur-reviews-list-ratings">';
				
						if ( 1 == $show_site_rating ) {	

							$output_ratings .= gpur_show_rating_template(
								array(
									'post_id' => get_the_ID(),
									'builder' => $builder,
									'atts' => array(
										'data' => 'site-rating',
										'max_rating' => $site_rating_max_rating,
										'decimal_places' => $site_rating_decimal_places,
										'show_zero_rating' => $site_rating_show_zero_rating,
				
										'style' => $site_rating_style,
										'position' => $site_rating_position,
										'text_position' => $site_rating_text_position,
										'rating_image' => $site_rating_image,
										'empty_icon' => $site_rating_empty_icon,
										'empty_icon_color' => $site_rating_empty_icon_color,
										'filled_icon' => $site_rating_filled_icon,
										'filled_icon_color' => $site_rating_filled_icon_color,
										'icon_width' => $site_rating_icon_width,
										'icon_height' => $site_rating_icon_height,
				
										'rating_container_width' => $site_rating_container_width,
										'rating_container_height' => $site_rating_container_height,
										'rating_container_background_color' => $site_rating_container_background_color,			
										'rating_container_border_width' => $site_rating_container_border_width,	
										'rating_container_border_color' => $site_rating_container_border_color,
										'rating_container_extra_css' => $site_rating_container_extra_css,

										'gauge_width' => $site_rating_gauge_width,
										'gauge_filled_color_1' => $site_rating_gauge_filled_color_1,
										'gauge_filled_color_2' => $site_rating_gauge_filled_color_2,
										'gauge_empty_color' => $site_rating_gauge_empty_color,	

										'show_site_rating_text' => $show_site_rating_text,
										'site_rating_label' => $site_rating_label,
										'site_rating_label_size' => $site_rating_label_size,
										'site_rating_label_color' => $site_rating_label_color,
										'site_rating_label_extra_css' => $site_rating_label_extra_css,
										'site_rating_number_size' => $site_rating_number_size,
										'site_rating_number_color' => $site_rating_number_color,
										'site_rating_number_extra_css' => $site_rating_number_extra_css,
										'show_site_rating_max_rating_number' => $show_site_rating_max_rating_number,
										'site_rating_max_rating_number_color' => $site_rating_max_rating_number_color,
										'site_rating_max_rating_number_size' => $site_rating_max_rating_number_size,
										'site_rating_max_rating_number_extra_css' => $site_rating_max_rating_number_extra_css,
				
										'criteria' => $site_rating_criteria,
										'criteria_format' => 'format-column',
										'criteria_title_size' => $site_rating_criteria_title_size,
										'criteria_title_color' => $site_rating_criteria_title_color,
										'criteria_title_extra_css' => $site_rating_criteria_title_extra_css,

										'show_ranges_text' => $show_site_rating_ranges_text,
										'rating_ranges' => $site_rating_ranges,
										'ranges_text_size' => $site_rating_ranges_text_size,
										'ranges_text_color' => $site_rating_ranges_text_color,
										'ranges_text_extra_css' => $site_rating_ranges_text_extra_css,				
									),
								)	
							);					

							if ( 'style-stars' === $site_rating_style OR 'style-hearts' === $site_rating_style OR 'style-squares' === $site_rating_style OR 'style-circles' === $site_rating_style OR 'style-bars' === $site_rating_style OR 'style-icon' === $site_rating_style OR 'style-image' === $site_rating_style ) {
								$linear_class = 'gpur-linear';	
							} else {
								$linear_class = 'gpur-non-linear';	
							}
					
						}	

						if ( 1 == $show_user_rating ) {
						
							$output_ratings .= gpur_show_rating_template(
								array(
									'post_id' => get_the_ID(),
									'builder' => $builder,
									'atts' => array(
										'data' => 'user-rating',
										'max_rating' => $user_rating_max_rating ? $user_rating_max_rating : $site_rating_max_rating,
										'decimal_places' => $user_rating_decimal_places ? $user_rating_decimal_places : $site_rating_decimal_places,
										'show_zero_rating' => $user_rating_show_zero_rating,
				
										'style' => $user_rating_style ? $user_rating_style : $site_rating_style,
										'position' => $user_rating_position ? $user_rating_position : $site_rating_position,
										'text_position' => $user_rating_text_position ? $user_rating_text_position : $site_rating_text_position,
										'rating_image' => $user_rating_image ? $user_rating_image : $site_rating_image,
										'empty_icon' => $user_rating_empty_icon ? $user_rating_empty_icon : $site_rating_empty_icon,
										'empty_icon_color' => $user_rating_empty_icon_color ? $user_rating_empty_icon_color : $site_rating_empty_icon_color,
										'filled_icon' => $user_rating_filled_icon ? $user_rating_filled_icon : $site_rating_filled_icon,
										'filled_icon_color' => $user_rating_filled_icon_color ? $user_rating_filled_icon_color : $site_rating_filled_icon_color,
										'icon_width' => $user_rating_icon_width ? $user_rating_icon_width : $site_rating_icon_width,
										'icon_height' => $user_rating_icon_height ? $user_rating_icon_height : $site_rating_icon_height,
				
										'rating_container_width' => $user_rating_container_width ? $user_rating_container_width : $site_rating_container_width,
										'rating_container_height' => $user_rating_container_height ? $user_rating_container_height : $site_rating_container_height,
										'rating_container_background_color' => $user_rating_container_background_color ? $user_rating_container_background_color : $site_rating_container_background_color,			
										'rating_container_border_width' => $user_rating_container_border_width ? $user_rating_container_border_width : $site_rating_container_border_width,	
										'rating_container_border_color' => $user_rating_container_border_color ? $user_rating_container_border_color : $site_rating_container_border_color,
										'rating_container_extra_css' => $user_rating_container_extra_css ? $user_rating_container_extra_css : $site_rating_container_extra_css,
									
										'gauge_width' => $user_rating_gauge_width ? $user_rating_gauge_width : $site_rating_gauge_width,
										'gauge_filled_color_1' => $user_rating_gauge_filled_color_1 ? $user_rating_gauge_filled_color_1 : $site_rating_gauge_filled_color_1,
										'gauge_filled_color_2' => $user_rating_gauge_filled_color_2 ? $user_rating_gauge_filled_color_2 : $site_rating_gauge_filled_color_2,
										'gauge_empty_color' => $user_rating_gauge_empty_color ? $user_rating_gauge_empty_color : $site_rating_gauge_empty_color,	

										'show_avg_user_rating_text' => $show_avg_user_rating_text,
										'avg_user_rating_label' => $avg_user_rating_label,
										'avg_user_rating_label_size' => $avg_user_rating_label_size ? $avg_user_rating_label_size : $site_rating_label_size,
										'avg_user_rating_label_color' => $avg_user_rating_label_color ? $avg_user_rating_label_color : $site_rating_label_color,
										'avg_user_rating_label_extra_css' => $avg_user_rating_label_extra_css ? $avg_user_rating_label_extra_css : $site_rating_label_extra_css,
										'avg_user_rating_number_size' => $avg_user_rating_number_size ? $avg_user_rating_number_size : $site_rating_number_size,
										'avg_user_rating_number_color' => $avg_user_rating_number_color ? $avg_user_rating_number_color : $site_rating_number_color,
										'avg_user_rating_number_extra_css' => $avg_user_rating_number_extra_css ? $avg_user_rating_number_extra_css : $site_rating_number_extra_css,
										'show_avg_user_rating_max_rating_number' => $show_avg_user_rating_max_rating_number,
										'avg_user_rating_max_rating_number_size' => $avg_user_rating_max_rating_number_size ? $avg_user_rating_max_rating_number_size : $site_rating_max_rating_number_size,
										'avg_user_rating_max_rating_number_color' => $avg_user_rating_max_rating_number_color ? $avg_user_rating_max_rating_number_color : $site_rating_max_rating_number_color,
										'avg_user_rating_max_rating_number_extra_css' => $avg_user_rating_max_rating_number_extra_css ? $avg_user_rating_max_rating_number_extra_css : $site_rating_max_rating_number_extra_css,

										'show_user_votes_text' => $show_user_votes_text,
										'singular_vote_label' => $singular_vote_label,
										'plural_vote_label' => $plural_vote_label,	
										'user_votes_text_size' => $user_votes_text_size,
										'user_votes_text_color' => $user_votes_text_color,
										'user_votes_text_extra_css' => $user_votes_text_extra_css,				
			
										'show_ind_user_rating_text' => $show_ind_user_rating_text,
										'ind_user_rating_label' => $ind_user_rating_label,
										'ind_user_rating_label_size' => $ind_user_rating_label_size,
										'ind_user_rating_label_color' => $ind_user_rating_label_color,
										'ind_user_rating_label_extra_css' => $ind_user_rating_label_extra_css,
										'ind_user_rating_number_size' => $ind_user_rating_number_size,
										'ind_user_rating_number_color' => $ind_user_rating_number_color,
										'ind_user_rating_number_extra_css' => $ind_user_rating_number_extra_css,
										'show_ind_user_rating_max_rating_number' => $show_ind_user_rating_max_rating_number,
										'ind_user_rating_max_rating_number_size' => $ind_user_rating_max_rating_number_size,
										'ind_user_rating_max_rating_number_color' => $ind_user_rating_max_rating_number_color,
										'ind_user_rating_max_rating_number_extra_css' => $ind_user_rating_max_rating_number_extra_css,
				
										'criteria' => $user_rating_criteria,
										'criteria_format' => 'format-column',
										'criteria_title_size' => $user_rating_criteria_title_size ? $user_rating_criteria_title_size : $site_rating_criteria_title_size,
										'criteria_title_color' => $user_rating_criteria_title_color ? $user_rating_criteria_title_color : $site_rating_criteria_title_color,
										'criteria_title_extra_css' => $user_rating_criteria_title_extra_css ? $user_rating_criteria_title_extra_css : $site_rating_criteria_title_extra_css,
								
										'show_ranges_text' => $show_user_rating_ranges_text,
										'rating_ranges' => $user_rating_ranges ? $user_rating_ranges : $site_rating_ranges,
										'ranges_text_size' => $user_rating_ranges_text_size ? $user_rating_ranges_text_size : $site_rating_ranges_text_size,
										'ranges_text_color' => $user_rating_ranges_text_color ? $user_rating_ranges_text_color : $site_rating_ranges_text_color,
										'ranges_text_extra_css' => $user_rating_ranges_text_extra_css ? $user_rating_ranges_text_extra_css : $site_rating_ranges_text_extra_css,				
									),
								)	
							);								

							if ( 'style-stars' === $user_rating_style OR 'style-hearts' === $user_rating_style OR 'style-squares' === $user_rating_style OR 'style-circles' === $user_rating_style OR 'style-bars' === $user_rating_style OR 'style-icon' === $user_rating_style OR 'style-image' === $user_rating_style ) {
								$linear_class = 'gpur-linear';	
							} else {
								$linear_class = 'gpur-non-linear';	
							}
			
						}
				
					$output_ratings .= '</div>';
					
				}	
				
				$output .= '<section class="' . implode( ' ', get_post_class( 'gpur-reviews-list-item ' . $linear_class ) ) . '">';

					if ( 1 == $show_ranking ) { 
						if ( ! isset( $ranking_counter ) ) { $ranking_counter = 0; } 
						$ranking_counter++; 
						$output .= '<div class="gpur-reviews-list-ranking-counter">' . absint( $ranking_counter ) . '</div>';
					} 
	
					$review_image = '';
					if ( 'review-image-1' === $image_source && get_post_meta( get_the_ID(), 'gpur_review_image_1', true ) ) {
						$image_id = get_post_meta( get_the_ID(), 'gpur_review_image_1', true );
						$review_image = wp_get_attachment_image( $image_id, gpur_image_dimensions( $image_size ) );
					} elseif ( 'review-image-2' === $image_source && get_post_meta( get_the_ID(), 'gpur_review_image_2', true ) ) {
						$image_id = get_post_meta( get_the_ID(), 'gpur_review_image_2', true );
						$review_image = wp_get_attachment_image( $image_id, gpur_image_dimensions( $image_size ) );
					} elseif ( 'featured-image' === $image_source && has_post_thumbnail() ) {
						$review_image = get_the_post_thumbnail( get_the_ID(), gpur_image_dimensions( $image_size ) );
					}
	
					if ( $review_image && 1 == $show_image && 'gpur-format-list' === $post_format ) {
						$output .= '<div class="gpur-reviews-list-featured-image">';
							if ( 'gpur-ratings-over-image' === $ratings_position ) { 
								$output .= $output_ratings; 
							}
							$output .= '<a href="' .get_the_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '">' . wp_kses_post( $review_image ) . '</a>';			
						$output .= '</div>';
					}	

					$output .= '<div class="gpur-reviews-list-content">';

						if ( has_post_thumbnail() && '1' == $show_image && 'gpur-format-list' !== $post_format ) {
							$output .= '<div class="gpur-reviews-list-featured-image">';
								if ( 'gpur-ratings-over-image' === $ratings_position ) {
									$output .= $output_ratings; }
								$output .= '<a href="' . get_the_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '">' . wp_kses_post( $review_image ) . '</a>';			
							$output .= '</div>';
						}	
	
						if ( 1 == $show_title ) {		
							$title = get_the_title();
							if ( '' !== $title_length ) {
								if ( mb_strlen( $title ) > $title_length ) {
									$title = mb_substr( $title, 0, (int) $title_length ) . apply_filters( 'gpur_ellipses', '...' );
								}
							}
							$output .= '<h2 class="gpur-reviews-list-title gp-loop-title"><a href="' . get_the_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '">' . esc_attr( $title ) . '</a></h2>';
						}
		
						if ( 1 == $show_name OR 1 == $show_date OR 1 == $show_comments OR 1 == $show_likes ) {
		
							$output .= '<div class="gpur-reviews-list-meta gp-loop-meta">';
	
								if ( 1 == $show_name ) {
									$output .= '<span class="gpur-reviews-list-meta-item gpur-reviews-list-name gp-post-meta">' . get_the_author_meta( 'display_name' ) . '</span>';
								}

								if ( 1 == $show_date ) {
									$output .= '<span class="gpur-reviews-list-meta-item gpur-reviews-list-date gp-post-meta">' . get_the_time( get_option( 'date_format' ) ) . '</span>';
								}
	
								if ( 1 == $show_comments ) {
									
									$output .= '<span class="gpur-reviews-list-meta-item gpur-reviews-list-comments gp-post-meta">';
										if ( 0 == get_comments_number() && ! comments_open() && ! pings_open() ) {
											$output .= esc_html__( 'Comments Closed', 'gpur' );
										} else {
											$output .= get_comments_number_text( esc_html__( 'No Comments', 'gpur' ), esc_html__( '1 Comment', 'gpur' ), esc_html__( '% Comments', 'gpur' ) );
										}
									$output .= '</span>';
	
								}
	
								if ( 1 == $show_likes ) {
									if ( get_post_meta( get_the_ID(), 'gpur_up_votes', true ) ) {
										if ( 1 == get_post_meta( get_the_ID(), 'gpur_up_votes', true ) ) {
											$text = esc_html__( 'like', 'gpur' );
										} else {
											$text = esc_html__( 'likes', 'gpur' );
										}
										$output .= '<span class="gpur-reviews-list-meta-item gpur-reviews-list-likes gp-post-meta">' . sprintf( __( '%d %s', 'gpur' ), get_post_meta( get_the_ID(), 'gpur_up_votes', true ), $text ) . '</span>';
									}
								}
		
							$output .= '</div>';
			
						}	
		
						if ( 1 == $show_excerpt ) {
		
							if ( get_post_meta( get_the_ID(), $excerpt_meta_key, true ) ) {
								$text = strip_tags( get_post_meta( get_the_ID(), $excerpt_meta_key, true ) );
							} else {
								$text = get_the_excerpt();
							}
			
							if ( $text ) {
			
								if ( '' !== $excerpt_length ) {	
									if ( mb_strlen( $text ) > $excerpt_length ) {	
										$text = mb_substr( $text, 0, (int) $excerpt_length ) . apply_filters( 'gpur_ellipses', '...' );
									}
								}	
								$view_link = '';
				
								if ( 1 == $show_view_link ) {
									$view_link = ' <a href="' . get_permalink() . '">' . apply_filters( 'gpur_view_text', esc_html__( 'View', 'gpur' ) ) . '</a>';
								}
				
								$output .= '<div class="gpur-reviews-list-text">' . esc_attr( $text ) . wp_kses_post( $view_link ) . '</div>';
				
							}
						}
		
						if ( 'gpur-ratings-below' === $ratings_position ) { $output .= $output_ratings; }

					$output .= '</div>';
	
					if ( 'gpur-ratings-to-right' === $ratings_position ) { $output .= $output_ratings; }

				$output .= '</section>';
						
			endwhile;
			endif;
			wp_reset_postdata();
			
		$output .= '<div class="gpur-clear"></div></div>';

		return $output;

	}		
}