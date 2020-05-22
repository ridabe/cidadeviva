<?php if ( ! function_exists( 'gpur_comparison_table_fields' ) ) {	
	function gpur_comparison_table_fields( $field_name, $builder, $atts ) {

		extract( $atts );
		
		$output = '';

		// Get correct meta keys
		$avg_user_rating_meta_key = gpur_get_avg_user_rating( get_the_ID() );
		$user_votes_meta_key = gpur_get_user_votes( get_the_ID() );
		$user_sum_meta_key = gpur_get_user_sum( get_the_ID() );
		$summary_meta_key = gpur_get_summary( get_the_ID() );
		$excerpt_meta_key = gpur_get_excerpt( get_the_ID() );
		$up_votes_meta_key = gpur_get_up_votes( get_the_ID() );
		$down_votes_meta_key = gpur_get_down_votes( get_the_ID() );
		
		if ( 'ranking-numbers' === $field_name ) {
		
			static $ranking_number = 1;
			$output .= $ranking_number;
			$ranking_number++;
		
		} elseif ( 'review-image-1' === $field_name ) {

			$review_image = get_post_meta( get_the_ID(), 'gpur_review_image_1', true );
			if ( $review_image ) {
				$output .= wp_get_attachment_image( $review_image, gpur_image_dimensions( $image_size ) );
			}
		
		} elseif ( 'review-image-2' === $field_name ) {

			$review_image = get_post_meta( get_the_ID(), 'gpur_review_image_2', true );
			if ( $review_image ) {
				$output .= wp_get_attachment_image( $review_image, gpur_image_dimensions( $image_size ) );
			}

		} elseif ( 'featured-image' === $field_name ) {

			$output .= get_the_post_thumbnail( get_the_ID(), gpur_image_dimensions( $image_size ) );
						
		} elseif ( 'post-title' === $field_name ) {
		
			$output .= '<a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '">' . get_the_title() . '</a>';
			
		} elseif ( 'post-title-no-link' === $field_name ) {
		
			$output .= get_the_title();
						
		} elseif ( 'post-date' === $field_name ) {
		
			$output .= get_the_time( get_option( 'date_format' ) );
		
		} elseif ( 'post-cats' === $field_name ) {

			$categories = get_the_category();
			$separator = ', ';
			$output = '';
			if ( ! empty( $categories ) ) {
				foreach( $categories as $category ) {
					$output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'gpur' ), $category->name ) ) . '">' . esc_attr( $category->name ) . '</a>' . $separator;
				}
				$output .= trim( $output, $separator );
			}
			
		} elseif ( 'post-tags' === $field_name ) {
		
			$tags = get_the_tags();
			$separator = ', ';
			$output = '';
			if ( ! empty( $tags ) ) {
				foreach( $tags as $tag ) {
					$output .= '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'gpur' ), $tag->name ) ) . '">' . esc_attr( $tag->name ) . '</a>' . $separator;
				}
				$output .= trim( $output, $separator );
			}
		
		} elseif ( 'site-rating' === $field_name ) {		
				
			$output .= gpur_show_rating_template( array(
				'post_id' => get_the_ID(),
				'builder' => $builder,
				'atts' => array(
					'data' => 'site-rating',
					'max_rating' => $site_rating_max_rating,
					'decimal_places' => $site_rating_decimal_places,
					'show_zero_rating' => $site_rating_show_zero_rating,
			
					'style' => $site_rating_style,
					'position' => 'position-center',
					'text_position' => 'position-text-bottom',
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
				) )	
			);
		
		} elseif ( 'user-rating' === $field_name ) {

			$output .= gpur_show_rating_template( array(
				'post_id' => get_the_ID(),
				'builder' => $builder,
				'atts' => array(
					'data' => 'user-rating',
					'max_rating' => $user_rating_max_rating ? $user_rating_max_rating : $site_rating_max_rating,
					'decimal_places' => $user_rating_decimal_places ? $user_rating_decimal_places : $site_rating_decimal_places,
					'show_zero_rating' => $user_rating_show_zero_rating,
										
					'style' => $user_rating_style ? $user_rating_style : $site_rating_style,
					'position' => 'position-center',
					'text_position' => 'position-text-bottom',
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
				) )	
			);
		
		} elseif ( 'user-votes' === $field_name ) {
		
			$output .= absint( get_post_meta( get_the_ID(), $user_votes_meta_key, true ) );	

		} elseif ( 'likes' === $field_name ) {

			$output .= absint( apply_filters( 'gpur_up_votes', get_post_meta( get_the_ID(), $up_votes_meta_key, true ) ) );
			
		} elseif ( 'dislikes' === $field_name ) {

			$output .= absint( apply_filters( 'gpur_down_votes', get_post_meta( get_the_ID(), $down_votes_meta_key, true ) ) );
			
		} elseif ( 'summary' === $field_name ) {
		
			if ( $summary = get_post_meta( get_the_ID(), $summary_meta_key, true ) ) {		
				$ellipses = apply_filters( 'gpur_ellipses', '...' );
				if ( $summary_length != '' ) {
					if ( mb_strlen( $summary ) > $summary_length ) {
						$summary = mb_substr( $summary, 0, (int) $summary_length ) . $ellipses;
					}
				}
				$output .= wp_kses_post( $summary );
			}
			
		} elseif ( 'excerpt' === $field_name ) {

			if ( $excerpt = strip_tags( get_post_meta( get_the_ID(), $excerpt_meta_key, true ) ) ) {		
				$ellipses = apply_filters( 'gpur_ellipses', '...' );
				if ( $excerpt_length != '' ) {
					if ( mb_strlen( $excerpt ) > $excerpt_length ) {
						$excerpt = mb_substr( $excerpt, 0, (int) $excerpt_length ) . $ellipses;
					}
				}
				$output .= wp_kses_post( $excerpt );
			}

		} elseif ( 'good-points' === $field_name ) {

			$output .= gpur_good_points_template( array( 			
				'builder' => $builder,
				'atts' => array(
					'title' => '',
					'icon' => $good_icon,
					'icon_size' => $good_icon_size,
					'icon_color' => $good_icon_color,
					'icon_extra_css' => $good_icon_extra_css,
					'text_size' => $good_text_size,
					'text_color' => $good_text_color,
					'text_extra_css' => $good_text_extra_css,
				) 
			) );
				
		} elseif ( 'bad-points' === $field_name ) {
					
			$output .= gpur_bad_points_template( array(
				'builder' => $builder,
				'atts' => array(
					'title' => '',
					'icon' => $bad_icon,
					'icon_size' => $bad_icon_size,
					'icon_color' => $bad_icon_color,
					'icon_extra_css' => $bad_icon_extra_css,
					'text_size' => $bad_text_size,
					'text_color' => $bad_text_color,
					'text_extra_css' => $bad_text_extra_css,
				) 
			) );
		
		} elseif ( 'button' === $field_name ) {
	
			if ( get_post_meta( get_the_ID(), 'gpur_review_button_link', true ) ) {
				if ( get_post_meta( get_the_ID(), 'gpur_review_button_text', true ) ) {
					$new_button_text = get_post_meta( get_the_ID(), 'gpur_review_button_text', true );
				} else {
					$new_button_text = $button_text;
				}
				
				$output .= gpur_review_button_template( array( 
					'builder' => $builder,
					'atts' => array(
						'button_alignment' => 'button-center',
						'text' => $button_text,
						'button_padding_width' => $button_padding_width,
						'button_padding_height' => $button_padding_height,
						'button_color' => $button_color,
						'button_hover_color' => $button_hover_color,
						'text_size' => $button_text_size,
						'text_color' => $button_text_color,
						'text_hover_color' => $button_text_hover_color,
						'border_width' => $button_border_width,
						'border_radius' => $button_border_radius,
						'border_color' => $button_border_color,
						'border_hover_color' => $button_border_hover_color,
						'icon' => $button_icon,
						'icon_size' => $button_icon_size,
						'icon_color' => $button_icon_color,
						'icon_hover_color' => $button_icon_hover_color,
						'icon_alignment' => $button_icon_alignment,
					) 
				) ); 
				
			}	
				
		} elseif ( 'custom-field' === $field_name ) {
				
			if ( isset( $meta_key ) && ! is_array( $meta_key ) ) {
				$meta_value = get_post_meta( get_the_ID(), $meta_key, true );
				$output .= apply_filters( 'gpur_comparison_table_custom_field_' . $meta_key, $meta_value, $meta_key );
			}
						
		}
		
		return $output;
		
	}
	
}			