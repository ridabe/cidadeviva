<?php
					
/**
 * Get site rating meta key
 *
 */ 
if ( ! function_exists( 'gpur_get_site_rating' ) ) {
	function gpur_get_site_rating( $post_id ) {
		$output = '';
		if ( get_post_meta( $post_id, 'gpur_site_rating', true ) ) { // Plugin
			$output = 'gpur_site_rating';
		} elseif ( get_post_meta( $post_id, 'site_rating', true ) ) { // Huber
			$output = 'site_rating';
		} elseif ( get_post_meta( $post_id, '_gp_site_rating', true ) ) { // Gauge/The Review
			$output = '_gp_site_rating';
		} else {
			$output = 'gpur_site_rating';
		}	
		return esc_attr( $output );
	}
}

/**
 * Get average user rating meta key
 *
 */ 
if ( ! function_exists( 'gpur_get_avg_user_rating' ) ) {
	function gpur_get_avg_user_rating( $post_id ) {
		$output = '';
		if ( get_post_meta( $post_id, 'gpur_avg_user_rating', true ) ) { // Plugin
			$output = 'gpur_avg_user_rating';
		} elseif ( get_post_meta( $post_id, 'ghostpool_user_rating', true ) ) { // Huber
			$output = 'ghostpool_user_rating';
		} elseif ( get_post_meta( $post_id, '_gp_user_rating', true ) ) { // Gauge/The Review
			$output = '_gp_user_rating';
		} else {
			$output = 'gpur_avg_user_rating';
		}
		return esc_attr( $output );
	}
}

/**
 * Get individual user ratings meta key
 *
 */ 
if ( ! function_exists( 'gpur_get_ind_user_rating' ) ) {
	function gpur_get_ind_user_rating( $post_id ) {
		$output = '';
		if ( get_user_meta( get_current_user_id(), 'gpur_user_rating_' . $post_id, true ) ) { // Plugin
			$output = 'gpur_user_rating_' . $post_id;
		} elseif ( get_user_meta( get_current_user_id(), 'ghostpool_user_rating_' . $post_id, true ) ) { // Huber
			$output = 'ghostpool_user_rating_' . $post_id;
		} elseif ( get_user_meta( get_current_user_id(), '_gp_user_rating_'. $post_id, true ) ) { // Gauge/The Review
			$output = '_gp_user_rating_' . $post_id;
		} else {
			$output = 'gpur_user_rating_' . $post_id;
		}
		return esc_attr( $output );
	}
}

/**
 * Get user votes meta key
 *
 */ 
if ( ! function_exists( 'gpur_get_user_votes' ) ) {
	function gpur_get_user_votes( $post_id ) {
		$output = '';
		if ( get_post_meta( $post_id, 'gpur_user_votes', true ) ) { // Plugin
			$output = 'gpur_user_votes';
		} elseif ( get_post_meta( $post_id, 'ghostpool_user_votes', true ) ) { // Huber
			$output = 'ghostpool_user_votes';
		} elseif ( get_post_meta( $post_id, '_gp_user_votes', true ) ) { // Gauge/The Review
			$output = '_gp_user_votes';
		} else {
			$output = 'gpur_user_votes';
		}
		return esc_attr( $output );
	}
}

/**
 * Get user sum meta key
 *
 */ 
if ( ! function_exists( 'gpur_get_user_sum' ) ) {
	function gpur_get_user_sum( $post_id ) {
		$output = '';
		if ( get_post_meta( $post_id, 'gpur_user_sum', true ) ) { // Plugin
			$output = 'gpur_user_sum';
		} elseif ( get_post_meta( $post_id, 'ghostpool_user_sum', true ) ) { // Huber
			$output = 'ghostpool_user_sum';
		} elseif ( get_post_meta( $post_id, '_gp_user_sum', true ) ) { // Gauge/The Review
			$output = '_gp_user_sum';
		} else {
			$output = 'gpur_user_sum';
		}
		return esc_attr( $output );
	}
}

/**
 * Get summary meta key
 *
 */ 
if ( ! function_exists( 'gpur_get_summary' ) ) {
	function gpur_get_summary( $post_id ) {
		$output = '';
		if ( get_post_meta( $post_id, 'gpur_summary', true ) ) { // Plugin
			$output = 'gpur_summary';
		} elseif ( get_post_meta( $post_id, 'summary', true ) ) { // Huber
			$output = 'summary';
		} elseif ( get_post_meta( $post_id, 'hub_review_summary', true ) ) { // The Review
			$output = 'hub_review_summary';
		} elseif ( get_post_meta( $post_id, 'review_summary', true ) ) { // The Review
			$output = 'review_summary';
		} else {
			$output = 'gpur_summary';
		}
		return esc_attr( $output );
	}
}
	
/**
 * Get excerpt meta key
 *
 */ 
if ( ! function_exists( 'gpur_get_excerpt' ) ) {
	function gpur_get_excerpt( $post_id ) {
		$output = '';		
		if ( get_post_meta( $post_id, 'gpur_excerpt', true ) ) {
			$output = 'gpur_excerpt';
		} elseif ( get_post_meta( $post_id, 'synopsis', true ) ) { // Huber
			$output = 'synopsis';
		} elseif ( get_post_meta( $post_id, 'hub_synopsis', true ) ) { // Gauge/The Review
			$output = 'hub_synopsis';
		} elseif ( get_post_meta( $post_id, 'hub_review_synopsis', true ) ) { // Gauge/The Review
			$output = 'hub_review_synopsis';
		} else {
			$output = 'gpur_excerpt';
		}
		return esc_attr( $output );
	}
}
				
/**
 * Get good points meta key
 *
 */ 
if ( ! function_exists( 'gpur_get_good_points' ) ) {
	function gpur_get_good_points( $post_id ) {
		$output = '';
		if ( count( array_filter( (array) get_post_meta( get_the_ID(), 'gpur_good_points', true ) ) ) != 0 ) { // Plugin
			$output = 'gpur_good_points';
		} elseif ( count( array_filter( (array) get_post_meta( get_the_ID(), 'good_points', true ) ) ) != 0 ) { // Huber
			$output = 'good_points';
		} elseif ( count( array_filter( (array) get_post_meta( get_the_ID(), 'hub_review_good_points', true ) ) ) != 0 ) { // Gauge/The Review
			$output = 'hub_review_good_points';
		} elseif ( count( array_filter( (array) get_post_meta( get_the_ID(), 'review_good_points', true ) ) ) != 0 ) { // Gauge/The Review
			$output = 'review_good_points';
		} else {
			$output = 'gpur_good_points';
		}		
		return esc_attr( $output );
	}
}

/**
 * Get bad points meta key
 *
 */ 
if ( ! function_exists( 'gpur_get_bad_points' ) ) {
	function gpur_get_bad_points( $post_id ) {
		$output = '';
		if ( count( array_filter( (array) get_post_meta( $post_id, 'gpur_bad_points', true ) ) ) != 0 ) { // Plugin
			$output = 'gpur_bad_points';
		} elseif ( count( array_filter( (array) get_post_meta( $post_id, 'bad_points', true ) ) ) != 0 ) { // Huber
			$output = 'bad_points';
		} elseif ( count( array_filter( (array) get_post_meta( $post_id, 'hub_review_bad_points', true ) ) ) != 0 ) { // Gauge/The Review
			$output = 'hub_review_bad_points';
		} elseif ( count( array_filter( (array) get_post_meta( $post_id, 'review_bad_points', true ) ) ) != 0 ) { // Gauge/The Review
			$output = 'review_bad_points';
		} else {
			$output = 'gpur_bad_points';
		}
		return esc_attr( $output );
	}
}

/**
 * Get up votes meta key
 *
 */ 
if ( ! function_exists( 'gpur_get_up_votes' ) ) {
	function gpur_get_up_votes( $post_id ) {
		$output = '';
		if ( get_post_meta( $post_id, 'gpur_up_votes', true ) ) { // Plugin
			$output = 'gpur_up_votes';
		} elseif ( get_post_meta( $post_id, 'ghostpool_voting_up', true ) ) { // Aardvark/Huber
			$output = 'ghostpool_voting_up';
		} else {
			$output = 'gpur_up_votes';
		}
		return esc_attr( $output );
	}
}

/**
 * Get down votes meta key
 *
 */ 
if ( ! function_exists( 'gpur_get_down_votes' ) ) {
	function gpur_get_down_votes( $post_id ) {
		$output = '';
		if ( get_post_meta( $post_id, 'gpur_down_votes', true ) ) { // Plugin
			$output = 'gpur_down_votes';
		} elseif ( get_post_meta( $post_id, 'ghostpool_voting_down', true ) ) { // Aardvark/Huber
			$output = 'ghostpool_voting_down';
		} else {
			$output = 'gpur_down_votes';
		}
		return esc_attr( $output );
	}
}					

/**
 * Get all classes and add spacing
 *
 */ 
if ( ! function_exists( 'gpur_custom_css_class' ) ) { 
	function gpur_custom_css_class( $param_value, $prefix = '' ) {
		$css_class = '';
		if ( $param_value ) {
			$css_class = preg_match( '/\s*\.([^\{]+)\s*\{\s*([^\}]+)\s*\}\s*/', $param_value ) ? $prefix . preg_replace( '/\s*\.([^\{]+)\s*\{\s*([^\}]+)\s*\}\s*/', '$1', $param_value ) : '';
		}	
		return $css_class;
	}
}

/**
 * Get styles
 *
 */ 
if ( ! function_exists( 'gpur_rating_styles' ) ) {
	function gpur_rating_styles( $style, $empty_icon, $filled_icon ) {

		$output = '';
		
		if ( 'style-stars' === $style ) {
			$output = array(
				'class' => $style,
				'empty' => gpur_fontawesome_icons( 'fa fa-star-o' ),
				'filled' => gpur_fontawesome_icons( 'fa fa-star' ),
				'linear_class' => 'gpur-linear',
			);	
		} elseif ( 'style-hearts' === $style ) {
			$output = array(
				'class' => $style,
				'empty' => gpur_fontawesome_icons( 'fa fa-heart-o' ),
				'filled' => gpur_fontawesome_icons( 'fa fa-heart' ),
				'linear_class' => 'gpur-linear',
			);		
		} elseif ( 'style-squares' === $style ) {
			$output = array(
				'class' => $style,
				'empty' => 'gpur-symbol gpur-symbol-empty',
				'filled' => 'gpur-symbol gpur-symbol-filled',
				'linear_class' => 'gpur-linear',
			);	
		} elseif ( 'style-circles' === $style ) {
			$output = array(
				'class' => $style,
				'empty' => 'gpur-symbol gpur-symbol-empty',
				'filled' => 'gpur-symbol gpur-symbol-filled',
				'linear_class' => 'gpur-linear',
			);		
		} elseif ( 'style-bars' === $style ) {
			$output = array(
				'class' => $style,
				'empty' => 'gpur-symbol gpur-symbol-empty',
				'filled' => 'gpur-symbol gpur-symbol-filled',
				'linear_class' => 'gpur-linear',
			);
		} elseif ( 'style-icon' === $style ) {
			$empty_icon = isset( $empty_icon['value'] ) ? $empty_icon['value'] : $empty_icon;
			$filled_icon = isset( $filled_icon['value'] ) ? $filled_icon['value'] : $filled_icon;					
			$output = array(
				'class' => $style,
				'empty' => $empty_icon,
				'filled' => $filled_icon,
				'linear_class' => 'gpur-linear',
			);				
		} elseif ( 'style-image' === $style ) {
			$output = array(
				'class' => $style,
				'empty' => 'gpur-symbol gpur-symbol-empty',
				'filled' => 'gpur-symbol gpur-symbol-filled',
				'linear_class' => 'gpur-linear',
			);		
		} else {
			$output = array(
				'class' => $style,
				'empty' => '',
				'filled' => '',
				'linear_class' => 'gpur-non-linear',
			);		
		}

		return $output;

	}
}

/**
 * Put criteria and weights into an array
 *
 */
if ( ! function_exists( 'gpur_criteria' ) ) {
	function gpur_criteria( $criteria = '' ) {
		if ( $criteria && ! is_array( $criteria ) ) {
		
			if ( FALSE === strpos( $criteria, "\n" ) && FALSE === strpos( $criteria, "\r" ) ) {						
				$criteria = explode( "\n", $criteria );
				$criteria = implode( ",", $criteria );
			}
			$criteria_trim = rtrim( $criteria, ',' );
			$criteria_data = str_replace( ',,', ',', $criteria_trim );
			if ( FALSE !== strpos( $criteria, "\r" ) ) {					
				preg_match_all( '/([^:]+)\:([^\r]+),?/', $criteria_data, $m ) ? list( , $criteria, $weights ) = $m : $criteria = explode( "\r", $criteria );
			} elseif ( FALSE !== strpos( $criteria, "\n" ) ) {					
				preg_match_all( '/([^:]+)\:([^\n]+),?/', $criteria_data, $m ) ? list( , $criteria, $weights ) = $m : $criteria = explode( "\n", $criteria );	
			} else {
				preg_match_all( '/([^:]+)\:([^,]+),?/', $criteria_data, $m ) ? list( , $criteria, $weights ) = $m : $criteria = explode( ',', $criteria );	
			}	
			$weights = isset( $weights ) ? $weights : '';
			$output = array(
				'fields' => $criteria,
				'weights' => $weights,
				'count' => count( $criteria ),
				'class' => 'gpur-multi-rating',
				'multi' => 'yes',
			);	
		} else {
			$output = array(
				'fields' => '',
				'count' => 1,
				'class' => 'gpur-single-rating',
				'multi' => 'no',
			);	
		}
		return $output;
	}		
}


/**
 * Call a shortcode function by tag name
 *
 */
if ( ! function_exists( 'gpur_do_shortcode_func' ) ) { 
	function gpur_do_shortcode_func( $tag, array $atts = array(), $content = null ) {
		global $shortcode_tags;
		if ( ! isset( $shortcode_tags[ $tag ] ) ) {
			return false;
		}
		return call_user_func( $shortcode_tags[ $tag ], $atts, $content, $tag );
	}
}

/**
 * Get permissions
 *
 */
if ( ! function_exists( 'gpur_permissions' ) ) {
	function gpur_permissions( $permissions, $permission_roles ) {
		$output = 'disallowed';
		if ( 'all-users' === $permissions ) {
			$output = 'allowed';
		} elseif ( 'logged-in-users' === $permissions && is_user_logged_in() ) {
			$output = 'allowed';
		} elseif ( 'specific-roles' === $permissions ) {
			if ( $permission_roles ) {
				if ( ! is_array( $permission_roles ) ) {
					$permission_roles = explode( ',', $permission_roles );
				}
				$current_user = wp_get_current_user();
				foreach( $permission_roles as $permission_role ) {		
					if ( in_array( $permission_role, $current_user->roles ) ) {
						$output = 'allowed';
						break;
					}
				}
			}
		}
		return $output;
	}
}

/**
 * Get review comments support
 *
 */
if ( ! function_exists( 'gpur_supports_review_comments' ) ) {
	function gpur_supports_review_comments( $post_id = 0 ) {
	
		$support = false;
		
		// If no post ID specified, add one 
		if ( 0 === $post_id && is_singular() ) {
			$post_id = get_the_ID();
		}
		
		// If comment reviews are disabled, exit
		if ( 'disabled' === gpur_option( 'comment_form_review_support' ) ) {
			return false;
		}
		
		// If this post does not have any of these post types, exit
		$post_types = gpur_option( 'comment_form_post_types' );
		$post_types = array_keys( $post_types );
		$post_types = array_values( array_filter( $post_types ) );
		if ( '' !== gpur_option( 'comment_form_post_types' ) && ! in_array( get_post_type( $post_id ), $post_types ) ) {
			return false;
		}
		
		// If this post matches any of these IDs, support review comments
		$ids = explode( ',', gpur_option( 'comment_form_ids' ) );
		if ( '' !== gpur_option( 'comment_form_ids' ) && ( is_single( $ids ) OR is_page( $ids ) ) ) {
			$support = true;
		}
		
		// If this post matches any of these categories, support review comments
		$cats = explode( ',', gpur_option( 'comment_form_cats' ) );
		if ( '' !== gpur_option( 'comment_form_cats' ) && in_category( $cats, $post_id ) ) {
			$support = true;
		}

		// If this post matches any of these tags, support review comments
		$tags = explode( ',', gpur_option( 'comment_form_tags' ) );
		if ( '' !== gpur_option( 'comment_form_tags' ) && has_tag( $tags, $post_id ) ) {
			$support = true;
		}
		
		if ( '' === gpur_option( 'comment_form_ids' ) && '' === gpur_option( 'comment_form_cats' ) && '' === gpur_option( 'comment_form_tags' ) ) {
			$support = true;
		}
		
		return $support;
	
	}
}		
		
/**
* Review template dropdown field values
*
*/	
function gpur_templates_dropdown_values( $switch = false ) {

	$args = array(
		'post_status' 	 => 'publish',
		'post_type'	 	 => 'gpur-template',
		'orderby'	  	 => 'title',
		'order'		  	 => 'asc',	
		'posts_per_page' => '-1',
		'offset'         => 0,
	);

	$args = apply_filters( 'gpur_templates_dropdown_values_query', $args );

	$posts = get_posts( $args );

	$output = array();

	foreach( $posts as $post ) {
	
		if ( true == $switch ) {
			$title = $post->ID;
			$id = $post->post_title;
		} else {
			$title = $post->post_title;
			$id = $post->ID;
		}
			
		$output[ $title ] = $id;

	}

	return $output;

	wp_reset_postdata();

}

/**
 * Insert review template into selected items automatically
 *
 */
function gpur_get_review_templates( $post_id ) {

	// Is this review template disabled on this post

	$template_id = array();

	// Get all review templates
	$args = array(
		'post_status' 	      => 'publish',
		'post_type'           => array( 'gpur-template' ),
		'meta_key'   		  => 'gpur_review_template_automatic_insertion',
		'orderby'             => 'date',
		'order'               => 'desc',
		'posts_per_page'      => -1,
		'no_found_rows'		  => true,
	);
	$templates = get_posts( $args );
	
	if ( ! empty( $templates ) ) {
	
		foreach( $templates as $template ) { // Go through each review template
					
			$continue = true;
			
			if ( $post_id === $template->ID ) {
				$continue = false;
			}
		
			//setup_postdata( $template ); // Get review template post data

			// If it's not the main query bail
			if ( ! is_main_query() ) {
				$continue = false;
			}
			
			// Does this review template have this post type
			if ( $post_types = get_post_meta( $template->ID, 'gpur_review_template_automatic_insertion', true ) ) {
				if ( ! in_array( get_post_type( $post_id ), $post_types ) ) {
					$continue = false;
				}	
			}
			
			// Does this review template have this post ID
			if ( $ids = get_post_meta( $template->ID, 'gpur_review_template_automatic_insertion_ids', true ) ) {
				$ids = explode( ',', $ids );
				if ( ! in_array( $post_id, $ids ) ) {
					$continue = false;
				}
			}

			// Does this review template have these categories
			if ( $cats = get_post_meta( $template->ID, 'gpur_review_template_automatic_insertion_cats', true ) ) {
				$cats = explode( ',', $cats );
				$current_cats = get_the_category( $post_id );
				if ( $current_cats ) {
					foreach( $current_cats as $current_cat ) {
						if ( in_array( $current_cat->slug, $cats ) ) {
							$cat_continue = true;
							break;
						}
					}
				}	
				if ( isset( $cat_continue ) ) {
					$continue = true;
				} else {
					$continue = false;
				}
			}

			// Does this review template have these tags		
			if ( $tags = get_post_meta( $template->ID, 'gpur_review_template_automatic_insertion_tags', true ) ) {
				$tags = explode( ',', $tags );
				$current_tags = get_the_tags( $post_id );
				if ( $current_tags ) {
					foreach( $current_tags as $current_tag ) {
						if ( in_array( $current_tag->slug, $tags ) ) {
							$tag_continue = true;
							break;
						}
					}
				}	
				if ( isset( $tag_continue ) ) {
					$continue = true;
				} else {
					$continue = false;
				}
			}
			
			// Get builder
			if ( get_post_meta( $template->ID, '_elementor_data', true ) ) {
				$builder = 'elementor';
			} else {
				$builder = 'wpb';
			}

			if ( true === $continue ) {
				
				$template_id[$template->ID] = $template->ID;
				$template_id[$template->ID] = $builder;
				
			}	
		
		}
	
	}
	
	//wp_reset_postdata();
	
	$template_ids = $template_id;
	
	return $template_ids;

}

/**
 * Insert review template into selected items automatically
 *
 */
if ( ! function_exists( 'gpur_automatically_insert_review_template' ) ) {
	function gpur_automatically_insert_review_template( $content ) {
	
		$top_templates = '';
		$bottom_templates = '';
		
		if ( 'disable' !== get_post_meta( get_the_ID(), 'gpur_show_review_template', true ) ) {
	
			// Get auto inserted templates
			$template_ids = gpur_get_review_templates( get_the_ID() );
		
			if ( $template_ids ) {
			
				foreach( $template_ids as $template_id => $builder ) {
				
					$post = get_post( $template_id );
					$review_template = gpur_review_template( array( 'builder' => $builder, 'atts' => array( 'template_id' => $template_id  ) ) );
					$position = get_post_meta( $template_id, 'gpur_review_template_position', true );
					
					if ( 'top' === $position ) {
						$top_templates .= $review_template;
					} elseif ( 'bottom' === $position ) {
						$bottom_templates .= $review_template;
					}
  
				}
	
			}	

		}
		
		return $top_templates . $content . $bottom_templates;		
					
	}
}
add_filter( 'the_content', 'gpur_automatically_insert_review_template' );

/**
 * Get review template data from inserted review template
 *
 */	
if ( ! function_exists( 'gpur_get_review_template_data' ) ) {		
	function gpur_get_review_template_data( $post_id ) {	

		if ( 'gpur-template' !== get_post_type( $post_id ) ) {
		
			$template_ids = gpur_get_review_templates( get_the_ID() );

			if ( ! empty( $template_ids ) && 'disabled' !== get_post_meta( $post_id, 'gpur_show_review_template', true ) ) { // If review templates are automatically inserted

				// Get first review template ID
				$first_id = true;
				foreach( $template_ids as $template_id => $builder ) {
					if ( true === $first_id ) {
						$review_template_id = $template_id;
						$first_id = false;
					}
				}

			} else { // If review templates are manually inserted into post content
			
				$elementor_data = get_post_meta( get_the_ID(), '_elementor_data', true );

				if ( ! empty( $elementor_data ) ) { // Elementor
									
					// Get review template ID from current post					
					$review_template_id = '';
					$widgets = json_decode( $elementor_data, true );
					foreach( $widgets as $widget ) {
						$first_id = true;
						$elements = $widget['elements']['0']['elements'];
						foreach( $elements as $element ) {
							if ( true === $first_id ) {
								if ( isset( $element['widgetType'] ) && 'review_template' === $element['widgetType'] ) {
									$review_template_id = $element['settings']['template_id'];  
									$first_id = false;
								}
							}	
						}
					}
					
					$review_template_id = ( '' !== $review_template_id ) ? (int) $review_template_id : '';
					
				} else { // WPB
				
					$post = get_post( get_the_ID() );		
				
					if ( isset( $post->post_content ) ) {
									
						// Get review template ID from current post
						preg_match_all( '/' . get_shortcode_regex() . '/s', $post->post_content, $matches );
						if ( isset( $matches[2] ) ) {
							$first_id = true;
							foreach( (array) $matches[2] as $key => $value ) {
								if ( true === $first_id ) {
									if ( 'gpur_review_template' === $value ) {
										$review_template[] = shortcode_parse_atts( $matches[3][$key] );  
										$first_id = false;
									}	
								}	
							}
						}
						$review_template_id = isset( $review_template[0]['template_id'] ) ? (int) $review_template[0]['template_id'] : '';
					
					}
				
				}
		
			}

			// If post has a review template
			if ( ! empty( $review_template_id ) ) {
			
				// Get review template data
				
				// Elementor
				if ( $elementor_data = get_post_meta( $review_template_id, '_elementor_data', true ) ) {
							
					if ( FALSE !== strpos( $elementor_data, 'show_rating' ) ) {
			
						$elementor_data = str_replace( '"', '', $elementor_data );
						$elementor_data = str_replace( '{', '', $elementor_data );
						$elementor_data = str_replace( '}', '', $elementor_data );
						$elementor_data = str_replace( '[', '', $elementor_data );
						$elementor_data = str_replace( ']', '', $elementor_data );
						$elementor_data = str_replace( 'settings:', '', $elementor_data );
						
						// Fix issue in Elementor that doesn't save line breaks in imported templates
						$elementor_data = str_replace( 'Criterion 1,Criterion 2,Criterion 3,Criterion 4', "Criterion 1\nCriterion 2\nCriterion 3\nCriterion 4", $elementor_data );
			
						$convert_to_array = explode( ',', $elementor_data );

						for( $i = 0; $i < count( $convert_to_array ); $i++ ) {
							$key_value = explode( ':', $convert_to_array[$i] );
							$get_element[$key_value[0]] = isset( $key_value[1] ) ? $key_value[1] : '';
						}
				
						// Get show rating widget
						if ( isset( $get_element['criteria'] ) ) {
							if ( FALSE !== strpos( $get_element['criteria'], '\n' ) ) {	
								$site_criteria = explode( '\n', $get_element['criteria'] );  
							} else {	
								$site_criteria = explode( ',', $get_element['criteria'] );  
							}
						}
						$site_step = isset( $get_element['step'] ) ? $get_element['step'] : 1;  
						$site_min_rating = isset( $get_element['min_rating'] ) ? $get_element['min_rating'] : 0;  
						$site_rating_max_rating = isset( $get_element['max_rating'] ) ? $get_element['max_rating'] : 5;  
					
						// Get user rating widget
						$user_max_rating = isset( $get_element['max_rating'] ) ? $get_element['max_rating'] : gpur_option( 'comment_form_max_rating' );  
						
					}
				
				// WPB		
				} else {
				
					// Get review template data
					$template = get_post( $review_template_id );
				
					// Get site rating shortcode
					$shortcode = preg_match_all( "/\[gpur_show_rating(.*?)\]/", $template->post_content, $variables ) ? $variables[1] : '';

					// If site rating shortcode exists
					if ( '' !== $shortcode ) {
		
						if ( is_array( $shortcode ) ) {
							$shortcode = implode( ',', $shortcode );
						}	

						$shortcode_matches = '';
						preg_match_all( '/(\w+)\s*=\s*"(.*?)"/', $shortcode, $shortcode_matches );

						// Get shortcode variables as save as post meta
						if ( '' !== $shortcode_matches ) {						

							$variables = array();
							for( $i = 0; $i < count( $shortcode_matches[1] ); $i++ ) {
								$variables[$shortcode_matches[1][$i]] = $shortcode_matches[2][$i];
							}

						}

					}	
					
					$site_criteria = isset( $variables['criteria'] ) ? explode( ',', $variables['criteria'] ) : '';
					$site_step = isset( $variables['step'] ) ? $variables['step'] : 1;
					$site_min_rating = isset( $variables['min_rating'] ) ? $variables['min_rating'] : 0;
					$site_rating_max_rating = isset( $variables['max_rating'] ) ? $variables['max_rating'] : 5;					

					// Get add user rating shortcode
					$shortcode = preg_match( "/\[gpur_add_user_ratings(.*?)\]/", $template->post_content, $variables ) ? $variables[1] : '';

					// If site rating shortcode exists
					if ( '' !== $shortcode ) {

						$shortcode_matches = '';
						preg_match_all( '/(\w+)\s*=\s*"(.*?)"/', $shortcode, $shortcode_matches );

						// Get shortcode variables as save as post meta
						if ( '' !== $shortcode_matches ) {						

							$variables = array();
							for( $i = 0; $i < count( $shortcode_matches[1] ); $i++ ) {
								$variables[$shortcode_matches[1][$i]] = $shortcode_matches[2][$i];				
							}
							$user_max_rating = isset( $variables['max_rating'] ) ? $variables['max_rating'] : 5;
							
						}

					} else {

						$user_max_rating = gpur_option( 'comment_form_max_rating' );

					}
			
				}

			}
			
		}	
									
		$output = array(
			'id' => isset( $review_template_id ) ? $review_template_id : '',
			'site_criteria' => isset( $site_criteria ) ? $site_criteria : '',
			'site_step' => isset( $site_step ) ? $site_step : '',
			'site_min_rating' => isset( $site_min_rating ) ? $site_min_rating : '',
			'site_rating_max_rating' => isset( $site_rating_max_rating ) ? $site_rating_max_rating : '',
			'user_max_rating' => isset( $user_max_rating ) ? $user_max_rating : '',
		);

		return $output;
			
	}
}