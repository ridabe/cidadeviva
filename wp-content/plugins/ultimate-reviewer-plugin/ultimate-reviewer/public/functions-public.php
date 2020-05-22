<?php

/**
 * Add theme name to body class
 *
 */ 
if ( ! function_exists( 'gpur_add_theme_name_to_body_class' ) ) {
	function gpur_add_theme_name_to_body_class( $classes ) {
		if ( defined( 'MAGZINE_THEME_VERSION' ) ) {
			$classes[] = 'gpur-magzine-theme';
		} elseif ( defined( 'AARDVARK_THEME_VERSION' ) ) {
			$classes[] = 'gpur-aardvark-theme';
		} elseif ( defined( 'HUBER_THEME_VERSION' ) ) {
			$classes[] = 'gpur-huber-theme';
		} elseif ( defined( 'GAUGE_THEME_VERSION' ) ) {
			$classes[] = 'gpur-gauge-theme';
		} elseif ( defined( 'THE_REVIEW_THEME_VERSION' ) ) {
			$classes[] = 'gpur-the-review-theme';
		} else {
			$classes[] = 'gpur-other-theme';
		}
		return $classes;
	}
}
add_filter( 'body_class', 'gpur_add_theme_name_to_body_class' );

/**
 * Get hub ID for Huber, Gauge and The Review themes
 *
 */ 
if ( ! function_exists( 'gpur_get_hub_id' ) ) {
	function gpur_get_hub_id( $post_id ) {
		if ( function_exists( 'get_hub_association_id' ) ) { // Huber
			$output = get_hub_association_id( $post_id );
		} elseif ( function_exists( 'ghostpool_get_hub_id' ) ) { // Gauge/The Review
			$output = ghostpool_get_hub_id( $post_id );
		} elseif ( '' !== $post_id ) {
			$output = $post_id;
		} else {
			$output = get_the_ID();
		}
		return $output;
	}
}

/**
 * Add units to values if left empty
 *
 */
if ( ! function_exists( 'ghostpool_add_units' ) ) {
	function ghostpool_add_units( $value = '', $units = 'px' ) {
		if ( is_numeric( $value ) ) {
			$value = $value . $units;
		}
		return $value;	
	}
}

/**
 * Remove px from values
 *
 */
if ( ! function_exists( 'ghostpool_remove_units' ) ) {
	function ghostpool_remove_units( $value = '', $units = 'px' ) {
		if ( ! is_numeric( $value ) ) {
			$value = str_replace( $units, '', $value );
		}
		return (int) $value;	
	}
}

/**
 * Sorting
 *
 */
function gpur_sorting( $sorting, $rating_range ) {

	$meta_query = array();
	
	if ( 'post-date-desc' === $sorting ) {
		$meta_key = '';
		$order_by = 'date';
		$order = 'desc';
	} elseif ( 'post-date-asc' === $sorting ) {
		$meta_key = '';
		$order_by = 'date';
		$order = 'asc';			
	} elseif ( 'post-title-desc' === $sorting ) {
		$meta_key = '';
		$order_by = 'title';
		$order = 'desc';	
	} elseif ( 'post-title-asc' === $sorting ) {
		$meta_key = '';
		$order_by = 'title';
		$order = 'asc';			
	} elseif ( 'site-rating-desc' === $sorting ) {
		$meta_key = 'gpur_site_rating';
		$order_by = 'meta_value_num';
		$order = 'desc';
		if ( $rating_range ) {
			$site_rating_query = array(
				'key' => 'gpur_site_rating',
				'value' => array_map( 'floatval', explode( '-', $rating_range ) ),
				'compare' => 'BETWEEN',
				'type' => 'DECIMALS',
			);
		} else {
			$site_rating_query = array(
				'key' => 'gpur_site_rating',
				'compare' => 'EXISTS',
				'type' => 'NUMERIC',
			);
		}
		$meta_query = array(
			'relation' => 'AND',
			$site_rating_query,
		);			
	} elseif ( 'site-rating-asc' === $sorting ) {
		$meta_key = 'gpur_site_rating';
		$order_by = 'meta_value_num';
		$order = 'asc';	
		if ( $rating_range ) {
			$site_rating_query = array(
				'key' => 'gpur_site_rating',
				'value' => array_map( 'floatval', explode( '-', $rating_range ) ),
				'compare' => 'BETWEEN',
				'type' => 'DECIMALS',
			);
		} else {
			$site_rating_query = array(
				'key' => 'gpur_site_rating',
				'compare' => 'EXISTS',
				'type' => 'NUMERIC',
			);
		}
		$meta_query = array(
			'relation' => 'OR',
			$site_rating_query,
		);		
	} elseif ( 'user-rating-desc' === $sorting ) {
		$meta_key = 'gpur_avg_user_rating';
		$order_by = array(
			'gpur_avg_user_rating_clause' => 'desc',
			'gpur_user_votes_clause' => 'desc',
		);
		$order = 'desc';
		if ( $rating_range ) {
			$user_rating_query = array(
				'key' => 'gpur_avg_user_rating',
				'value' => array_map( 'floatval', explode( '-', $rating_range ) ),
				'compare' => 'BETWEEN',
				'type' => 'DECIMALS',
			);
		} else {
			$user_rating_query = array(
				'key' => 'gpur_avg_user_rating',
				'compare' => 'EXISTS',
				'type' => 'NUMERIC',
			);
		}
		$meta_query = array(
			'relation' => 'AND',
			'gpur_avg_user_rating_clause' => $user_rating_query,
			'gpur_user_votes_clause' => array(
				'key' => 'gpur_user_votes',
				'compare' => 'EXISTS',
				'type' => 'NUMERIC',
			),
		);
	} elseif ( 'user-rating-asc' === $sorting ) {
		$meta_key = 'gpur_avg_user_rating';
		$order_by = array(
			'gpur_avg_user_rating_clause' => 'asc',
			'gpur_user_votes_clause' => 'asc',
		);
		$order = 'asc';
		if ( $rating_range ) {
			$user_rating_query = array(
				'key' => 'gpur_avg_user_rating',
				'value' => array_map( 'floatval', explode( '-', $rating_range ) ),
				'compare' => 'BETWEEN',
				'type' => 'DECIMALS',
			);
		} else {
			$user_rating_query = array(
				'key' => 'gpur_avg_user_rating',
				'compare' => 'EXISTS',
				'type' => 'NUMERIC',
			);
		}		
		$meta_query = array(
			'relation' => 'AND',
			'gpur_avg_user_rating_clause' => $user_rating_query,
			'gpur_user_votes_clause' => array(
				'key' => 'gpur_user_votes',
				'compare' => 'EXISTS',
				'type' => 'NUMERIC',
			),
		);
	} elseif ( 'user-votes-desc' === $sorting ) {
		$meta_key = 'gpur_user_votes';
		$order_by = 'meta_value_num';
		$order = 'desc';
	} elseif ( 'user-votes-asc' === $sorting ) {
		$meta_key = 'gpur_user_votes';
		$order_by = 'meta_value_num';
		$order = 'asc';		
	} elseif ( 'likes-desc' === $sorting ) {
		$meta_key = '';
		$order_by = 'meta_value_num';
		$order = 'desc';
		$meta_query = array(
			'relation' => 'OR',
			array(
				'key' => 'gpur_up_votes',
           	 	'type' => 'NUMERIC',
			),
			array(
				'key' => 'ghostpool_voting_up',
           	 	'type' => 'NUMERIC',
			),
		);
	} elseif ( 'likes-asc' === $sorting ) {
		$meta_key = '';
		$order_by = 'meta_value_num';
		$order = 'asc';				
		$meta_query = array(
			'relation' => 'OR',
			array(
				'key' => 'gpur_up_votes',
           	 	'type' => 'NUMERIC',
			),
			array(
				'key' => 'ghostpool_voting_up',
           	 	'type' => 'NUMERIC',
			),
		);	
	} elseif ( 'dislikes-desc' === $sorting ) {
		$meta_key = '';
		$order_by = 'meta_value_num';
		$order = 'desc';		
		$meta_query = array(
			'relation' => 'OR',
			array(
				'key' => 'gpur_down_votes',
           	 	'type' => 'DECIMAL', // 2.2 - Previously NUMERIC
			),
			array(
				'key' => 'ghostpool_voting_down',
           	 	'type' => 'NUMERIC',
			),
		);	
	} elseif ( 'dislikes-asc' === $sorting ) {
		$meta_key = '';
		$order_by = 'meta_value_num';
		$order = 'asc';		
		$meta_query = array(
			'relation' => 'OR',
			array(
				'key' => 'gpur_down_votes',
           	 	'type' => 'NUMERIC',
			),
			array(
				'key' => 'ghostpool_voting_down',
           	 	'type' => 'NUMERIC',
			),
		);	
	} elseif ( 'random' === $sorting ) {
		$meta_key = '';
		$order_by = 'rand';
		$order = 'asc';
	} elseif ( 'post-page-order' === $sorting ) {
		$meta_key = '';
		$order_by = 'post__in';
		$order = 'asc';	
	} else {
		$meta_key = '';
		$order_by = 'date';
		$order = 'desc';	
	}
	
	return array(
		'meta_key' => $meta_key,
		'meta_query' => $meta_query,
		'order_by' => $order_by,
		'order' => $order,
	);

}

/**
 * Comparison table sort icons
 *
 */
function gpur_sort_icons( $field_1, $field_2, $field_3, $atts ) {

	$slug = $field_1;
	$label = $field_2;
	$user_sorting = $field_3;

	$sort = isset( $_GET['sorting'] ) ? $_GET['sorting'] : $atts['sort'];

	$asc_selected = '';
	$desc_selected = '';
	if ( $slug . '-asc' === $sort ) {
		$asc_selected = ' gpur-selected';
	} elseif ( $slug . '-desc' === $sort ) {
		$desc_selected = ' gpur-selected';	
	}

	$output = '<span class="gpur-th-title">' . esc_attr( $label ) . '</span>';
	if ( 1 == $atts['user_sorting'] && 1 == $user_sorting ) {
		$output .= '<span class="gpur-sort-buttons-outer"><span class="gpur-sort-buttons-inner">';
			$output .= '<span class="gpur-sort-button gpur-asc' . $asc_selected . '" data-gpur-sorting="' . esc_attr( $slug ) . '-asc"></span>';
			$output .= '<span class="gpur-sort-button gpur-desc' . $desc_selected . '" data-gpur-sorting="' . esc_attr( $slug ) . '-desc"></span>';
		$output .= '</span></span>';	
	}
	
	return $output;
	
}
					
/**
 * Get image dimensions or image size name
 *
 */
if ( ! function_exists( 'gpur_image_dimensions' ) ) {
	function gpur_image_dimensions( $dimensions ) {
		$dimensions = str_replace( ' ', '', $dimensions );
		$matches = null;
		if ( preg_match( '/(\d+)x(\d+)/', $dimensions, $matches ) ) {
			return array(
				$matches[1],
				$matches[2],
			);
		} else {
			return $dimensions;
		}	
	}
}
	
/**
 * Rich snippets
 *
 */ 
if ( ! function_exists( 'gpur_rich_snippets' ) ) {
	function gpur_rich_snippets( $post_id = 0, $data, $max_rating = 5, $value = '' ) {
	
		// Get correct meta keys
		$site_rating_meta_key = gpur_get_site_rating( $post_id );
		$avg_user_rating_meta_key = gpur_get_avg_user_rating( $post_id );
		$user_votes_meta_key = gpur_get_user_votes( $post_id );
		$summary_meta_key = gpur_get_summary( $post_id );
		$excerpt_meta_key = gpur_get_excerpt( $post_id );
				
		$output = ''; 

		// URL
		$url = esc_url( get_permalink( $post_id ) );
		
		// Title
		$title = the_title_attribute( array( 'post' => $post_id, 'echo' => false ) );
		
		// Author
		$author = get_post_field( 'post_author', $post_id );
	
		// Description
		$description = '';
		if ( get_post_meta( $post_id, $summary_meta_key, true ) ) { 
			$description = get_post_meta( $post_id, $summary_meta_key, true ); 
		} elseif ( get_post_meta( $post_id, $excerpt_meta_key, true ) ) { 
			$description = get_post_meta( $post_id, $excerpt_meta_key, true );
		}
		
		// Image
		$image = esc_url( get_the_post_thumbnail_url( $post_id ) );
		
		// Rating value
		if ( 'site-rating' === $data ) {
			$rating_value = get_post_meta( $post_id, $site_rating_meta_key, true );
		} elseif ( 'custom' === $data ) {
			$rating_value = $value;	
		} else {
			$rating_value = get_post_meta( $post_id, $avg_user_rating_meta_key, true );
		}
				
		// User votes
		if ( get_post_meta( $post_id, $user_votes_meta_key, true ) ) {
			$user_votes = get_post_meta( $post_id, $user_votes_meta_key, true );
		} else {
			$user_votes = 0;
		}
					
		$output .= '{';
		
			if ( 'site-rating' === $data OR 'custom' === $data ) {
			
				$output .= '"@context": "http://schema.org/",
				"@type": "Review",
				"mainEntityOfPage": {
					  "@type": "WebPage",
					  "@id": "' . $url . '"
				},
				"itemReviewed": {
					"@type": "' . gpur_option( 'comment_rating_rich_snippets_site_rating_type' ) . '",
					"name": "' . $title . '"
				},
				"author": {
					"@type": "Person",
					"name": "' . $author . '"
				},
				"reviewRating": {
					"@type": "Rating",
					"ratingValue": "' . $rating_value . '",
					"worstRating" : "0",
					"bestRating": "' . $max_rating . '"
				}';
				
			} else {
			
				$output .= '"@context": "http://schema.org/",
				"@type": "' . gpur_option( 'comment_rating_rich_snippets_user_rating_type' ) . '",
				"mainEntityOfPage": {
					  "@type": "WebPage",
					  "@id": "' . $url . '"
				},	
				"name": "' . $title . '",
				"image": "' . $image . '",
				"description": "' . $description . '",
				"aggregateRating": {
					"@type": "AggregateRating",
					"ratingValue": "' . $rating_value . '",
					"ratingCount": "' . $user_votes . '",
					"bestRating": "' . $max_rating . '",
					"worstRating": "0"
				}';
				
			}	
			
		$output .= '}';
		
		add_action( 'wp_footer', function() use ( $output ) {
			echo '<script type="application/ld+json">' . wp_kses_post( $output ) .'</script>';
		});		
		
	}
}