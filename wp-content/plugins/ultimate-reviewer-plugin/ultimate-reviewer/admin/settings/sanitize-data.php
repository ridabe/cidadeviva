<?php 

// Sanitize XSS
if ( ! function_exists( 'ghostpool_sanitize_xss' ) ) {
	function ghostpool_sanitize_xss( $value = '' ) {
		return htmlspecialchars( strip_tags( $value ) );	
	}
}

// Sanitize checkbox field
if ( ! function_exists( 'ghostpool_sanitize_checkbox' ) ) {
	function ghostpool_sanitize_checkbox( $value = array(), $settings = array() ) {	

		if ( isset( $settings['data'] ) && '' !== $settings['data'] ) {
			
			$count = count( $value );
			for( $i = 0; $i < $count - 1; $i++ ) {
				$value[$i] = isset( $value[$i] ) ? sanitize_key( $value[$i] ) : isset( $settings['default'][$i] ) ? $settings['default'][$i] : '';
			}	
		
			return $value;
		
		} elseif ( isset( $settings['options'] ) && ! empty( $settings['options'] ) ) {
		
			$count = count( $value );
			for( $i = 0; $i < $count - 1; $i++ ) {
				$value[$i] = ( isset( $value[$i] ) && array_key_exists( $value[$i], $settings['options'] ) ) ? sanitize_key( $value[$i] ) : isset( $settings['default'][$i] ) ? $settings['default'][$i] : '';
			}
		
			return $value;
		
		} else {
		
			return isset( $value ) ? sanitize_key( $value ) : $settings['default'];
		
		}

	}
}

// Sanitize color codes 
if ( ! function_exists( 'ghostpool_sanitize_colors' ) ) {
	function ghostpool_sanitize_colors( $value = '' ) {
		
		if ( is_array( $value ) ) {
			
			$count = count( $value );
			for( $i = 0; $i < $count - 1; $i++ ) {		
				if ( isset( $value[$i] ) && false === strpos( $value[$i], 'rgba' ) ) {
					$value[$i] = sanitize_hex_color( $value[$i] );
				} elseif ( isset( $value[$i] ) ) {
					$value[$i] = str_replace( ' ', '', $value[$i] );
					sscanf( $value[$i], 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
					$value[$i] = 'rgba('.$red.','.$green.','.$blue.','.$alpha.')';
				}
			}
			
			return $value;
		
		} else {
		
			if ( false === strpos( $value, 'rgba' ) ) {
				return sanitize_hex_color( $value );
			} else {
				$value = str_replace( ' ', '', $value );
				sscanf( $value, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
				return 'rgba('.$red.','.$green.','.$blue.','.$alpha.')';
			}		
			
		}
				
	}
}

// Sanitize dimensions
if ( ! function_exists( 'ghostpool_sanitize_dimensions' ) ) {
	function ghostpool_sanitize_dimensions( $value = array() ) {
		if ( is_array( $value ) ) {
			$count = count( $value );
			for( $i = 0; $i < $count - 1; $i++ ) {
				if ( isset( $value[$i] ) && 'auto' !== $value[$i] ) {
					$value[$i] = preg_replace( "/[^(-?\d+\.)?-?\d]+/", '', $value[$i] );
				}
			}
		}						
		return $value;	
	}
}	

// Sanitize radio fields
if ( ! function_exists( 'ghostpool_sanitize_radio' ) ) {
	function ghostpool_sanitize_radio( $value = array(), $settings = array() ) {
		$value = sanitize_key( $value );
		return ( array_key_exists( $value, $settings['options'] ) ? $value : $settings['default'] ); 
	}	
}		

// Sanitize multi text fields
if ( ! function_exists( 'ghostpool_sanitize_multi_text' ) ) {
	function ghostpool_sanitize_multi_text( $value = array() ) {
		if ( is_array( $value ) ) {
			$count = count( $value );
			for( $i = 0; $i < $count - 1; $i++ ) {
				$value[$i] = sanitize_text_field( $value[$i] );
			}
			return array_filter( $value );
		}
	}
}	
	
// Sanitize URL or ID					
if ( ! function_exists( 'ghostpool_sanitize_url_id' ) ) {
	function ghostpool_sanitize_url_id( $value = '' ) {						
		if ( is_numeric( $value ) ) {
			return absint( $value );
		} else {
			return esc_url_raw( $value );
		}
	}
}

// Sanitize select field
if ( ! function_exists( 'ghostpool_sanitize_select' ) ) {
	function ghostpool_sanitize_select( $value = array(), $settings = array(), $options = '' ) {	
	
		if ( isset( $settings['data'] ) && '' !== $settings['data'] ) {	
		
			if ( is_array( $value ) ) {
				$count = count( $value );
				for( $i = 0; $i < $count - 1; $i++ ) {
					$value[$i] = sanitize_key( $value[$i] );
				}
			}
			
			return $value;
						
		} else {	
		
			/*if ( 'background-repeat' === $options ) {
			
				$array = array(
					'no-repeat' => esc_html__( 'No Repeat', 'gpur' ),
					'repeat'    => esc_html__( 'Repeat All', 'gpur' ),
					'repeat-x'  => esc_html__( 'Repeat Horizontally', 'gpur' ),
					'repeat-y'  => esc_html__( 'Repeat Vertically', 'gpur' ),
					'inherit'   => esc_html__( 'Inherit', 'gpur' ),
				);
			
			} elseif ( 'background-attachment' === $options ) {
			
				$array = array(
					'fixed'   => esc_html__( 'Fixed', 'gpur' ),
					'scroll'  => esc_html__( 'Scroll', 'gpur' ),
					'inherit' => esc_html__( 'Inherit', 'gpur' ),
				);
		
			} elseif ( 'background-position' === $options ) {
				
				$array = array(
					'left top'      => esc_html__( 'Left Top', 'gpur' ),
					'left center'   => esc_html__( 'Left center', 'gpur' ),
					'left bottom'   => esc_html__( 'Left Bottom', 'gpur' ),
					'center top'    => esc_html__( 'Center Top', 'gpur' ),
					'center center' => esc_html__( 'Center Center', 'gpur' ),
					'center bottom' => esc_html__( 'Center Bottom', 'gpur' ),
					'right top'     => esc_html__( 'Right Top', 'gpur' ),
					'right center'  => esc_html__( 'Right Center', 'gpur' ),
					'right bottom'  => esc_html__( 'Right Bottom', 'gpur' ),
				);
	
			} elseif ( 'background-size' === $options ) {
				
				$array = array(
					'inherit' => esc_html__( 'Inherit', 'gpur' ),
					'cover'   => esc_html__( 'Cover', 'gpur' ),
					'contain' => esc_html__( 'Contain', 'gpur' ),
				);

			} elseif ( 'background-clip' === $options ) {

				$array = array(
					'inherit'     => esc_html__( 'Inherit', 'gpur' ),
					'border-box'  => esc_html__( 'Border Box', 'gpur' ),
					'content-box' => esc_html__( 'Content Box', 'gpur' ),
					'padding-box' => esc_html__( 'Padding Box', 'gpur' ),
				);

			} elseif ( 'background-origin' === $options ) {
				
				$array = array(
					'inherit'     => esc_html__( 'Inherit', 'gpur' ),
					'border-box'  => esc_html__( 'Border Box', 'gpur' ),
					'content-box' => esc_html__( 'Content Box', 'gpur' ),
					'padding-box' => esc_html__( 'Padding Box', 'gpur' ),
				);

			} elseif ( 'border-style' === $options ) {
				
				$array = array(
					'solid'  => esc_html__( 'Solid', 'gpur' ),
					'dashed' => esc_html__( 'Dashed', 'gpur' ),
					'dotted' => esc_html__( 'Dotted', 'gpur' ),
					'double' => esc_html__( 'Double', 'gpur' ),
					'none'   => esc_html__( 'None', 'gpur' ),
				);
				
			} elseif ( 'text-transform' === $options ) {
				
				$array = array(
					'none' => esc_html__( 'None', 'gpur' ),
					'capitalize' => esc_html__( 'Capitalize', 'gpur' ),
					'uppercase' => esc_html__( 'Uppercase', 'gpur' ),
					'lowercase' => esc_html__( 'Lowercase', 'gpur' ),
					'initial' => esc_html__( 'Initial', 'gpur' ),
					'inherit' => esc_html__( 'Inherit', 'gpur' ),
				);

			} elseif ( 'text-align' === $options ) {
				
				$array = array(
					'inherit' => esc_html__( 'Inherit', 'gpur' ),
					'left' => esc_html__( 'Left', 'gpur' ),
					'right' => esc_html__( 'Right', 'gpur' ),
					'center' => esc_html__( 'Center', 'gpur' ),
					'justify' => esc_html__( 'Justify', 'gpur' ),
					'initial' => esc_html__( 'Initial', 'gpur' ),
				);
				
			} elseif ( 'text-decoration' === $options ) {
				
				$array = array(
					'none' => esc_html__( 'None', 'gpur' ),
					'inherit' => esc_html__( 'Inherit', 'gpur' ),
					'underline' => esc_html__( 'Underline', 'gpur' ),
					'overline' => esc_html__( 'Overline', 'gpur' ),
					'line-through' => esc_html__( 'Line Through', 'gpur' ),
					'blink' => esc_html__( 'Blink', 'gpur' ),
				);
								
			} else {
			
				if ( isset( $settings['options'] ) ) {
					$array = $settings['options'];
				} else {
					$array = '';
				}
			
			}*/
			
			if ( isset( $settings['default'] ) ) {
				$default = $settings['default'];
			} else {
				$default = '';
			}
			
			return isset( $value ) ? $value : $default;
			
		}
			
	}
}

// Run sanitize functions
if ( ! function_exists( 'ghostpool_sanitize_data' ) ) {
	function ghostpool_sanitize_data( $value = '', $setting = array() ) {
			
		if ( 'ace_editor' === $setting['type'] ) {
		
			$value = ghostpool_sanitize_xss( $value );

		} elseif ( 'background' === $setting['type'] ) {
		
			if ( isset( $value['background-color'] ) ) {
				$value['background-color'] = ghostpool_sanitize_colors( $value['background-color'] );
			}
			
			if ( isset( $value['background-image'] ) ) {
				$value['background-image'] = ghostpool_sanitize_url_id( $value['background-image'] );
			}
			
			if ( isset( $value['background-repeat'] ) ) {
				$value['background-repeat'] = ghostpool_sanitize_select( $value['background-repeat'], $setting, 'background-repeat' );
			}
			
			if ( isset( $value['background-attachment'] ) ) {
				$value['background-attachment'] = ghostpool_sanitize_select( $value['background-attachment'], $setting, 'background-attachment' );
			}
			
			if ( isset( $value['background-position'] ) ) {
				$value['background-position'] = ghostpool_sanitize_select( $value['background-position'], $setting, 'background-position' );
			}
			
			if ( isset( $value['background-size'] ) ) {
				$value['background-size'] = ghostpool_sanitize_select( $value['background-size'], $setting, 'background-size' );
			}
			
			if ( isset( $value['background-clip'] ) ) {
				$value['background-clip'] = ghostpool_sanitize_select( $value['background-clip'], $setting, 'background-clip' );
			}
			
			if ( isset( $value['background-origin'] ) ) {
				$value['background-origin'] = ghostpool_sanitize_select( $value['background-origin'], $setting, 'background-origin' );
			}
	
		} elseif ( 'border' === $setting['type'] ) {

			if ( isset( $value['border-width'] ) ) {
				$value['border-width'] = ghostpool_sanitize_dimensions( $value['border-width'] );
			}
			
			if ( isset( $value['border-top'] ) ) {
				$value['border-top'] = ghostpool_sanitize_dimensions( $value['border-top'] );
			}
			
			if ( isset( $value['border-right'] ) ) {
				$value['border-right'] = ghostpool_sanitize_dimensions( $value['border-right'] );
			}
			
			if ( isset( $value['border-bottom'] ) ) {
				$value['border-bottom'] = ghostpool_sanitize_dimensions( $value['border-bottom'] );
			}
			
			if ( isset( $value['border-left'] ) ) {
				$value['border-left'] = ghostpool_sanitize_dimensions( $value['border-left'] );
			}
			
			if ( isset( $value['border-style'] ) ) {
				$value['border-style'] = ghostpool_sanitize_select( $value['border-style'], $setting, 'border-style' );
			}
			
			if ( isset( $value['border-color'] ) ) {
				$value['border-color'] = ghostpool_sanitize_colors( $value['border-color'] );
			}
			
		} elseif ( 'checkbox' === $setting['type'] ) {

			$value = ghostpool_sanitize_checkbox( $value, $setting );
			
		} elseif ( 'color' === $setting['type'] ) {	

			$value = ghostpool_sanitize_colors( $value );
			
		} elseif ( 'color_gradient' === $setting['type'] ) {	

			$value = ghostpool_sanitize_colors( $value );

		} elseif ( 'color_rgba' === $setting['type'] ) {	

			$value = ghostpool_sanitize_colors( $value );

		} elseif ( 'dimensions' === $setting['type'] ) {

			$value = ghostpool_sanitize_dimensions( $value );

		} elseif ( 'export' === $setting['type'] ) {

		} elseif ( 'import' === $setting['type'] ) {

		} elseif ( 'gallery' === $setting['type'] ) {

			$value = wp_parse_list( $value );

		} elseif ( 'image_select' === $setting['type'] ) {

			$value = ghostpool_sanitize_radio( $value, $setting );

		} elseif ( 'link_color' === $setting['type'] ) {

			$value = ghostpool_sanitize_colors( $value );

		} elseif ( 'media' === $setting['type'] ) {

			$value = ghostpool_sanitize_url_id( $value );

		} elseif ( 'multi_text' === $setting['type'] ) {

			$value = ghostpool_sanitize_multi_text( $value );

		} elseif ( 'radio' === $setting['type'] ) {

			$value = ghostpool_sanitize_radio( $value, $setting );

		} elseif ( 'select' === $setting['type'] ) {

			$value = ghostpool_sanitize_select( $value, $setting );		

		} elseif ( 'slider' === $setting['type'] ) {

			$value = floatval( $value );				

		} elseif ( 'spacing' === $setting['type'] ) {

			$value = ghostpool_sanitize_dimensions( $value );
			
		} elseif ( 'spinner' === $setting['type'] ) {

			$value = floatval( $value );

		} elseif ( 'styling' === $setting['type'] ) {
		
			foreach( $setting['styling'] as $k => $v ) {
				
				if ( isset( $value[$k] ) && 'dimensions' === $v['type'] ) {
					
					$value[$k] = ghostpool_sanitize_dimensions( $value[$k] );
				
				} elseif ( isset( $value[$k] ) && 'color' === $v['type'] ) {
					
					$value[$k] = ghostpool_sanitize_colors( $value[$k] );
				
				} elseif ( isset( $value[$k] ) && 'icon' === $v['type'] ) {
					
					$value[$k] = sanitize_text_field( $value[$k] );
				
				} elseif ( isset( $value[$k] ) && 'media' === $v['type'] ) {
					
					$value[$k] = ghostpool_sanitize_url_id( $value[$k] );
				
				} elseif ( isset( $value[$k] ) && 'extra_css' === $v['type'] ) {
					
					$value[$k] = ghostpool_sanitize_xss( $value[$k] );
					
				}	
				
			}	

		} elseif ( 'text' === $setting['type'] ) {

			$value = sanitize_text_field( $value );

		} elseif ( 'textarea' === $setting['type'] ) {

			if ( isset( $setting['validate'] ) && 'html' === $setting['validate'] ) {
				$allowed = array(
					'a' => array(
						'href' => array(),
						'title' => array()
					),
					'br' => array(),
					'em' => array(),
					'link' => array(
						'href' => array(),
						'rel' => array(),
						'title' => array(),
						'type' => array(),
					),
					'meta' => array(
						'content' => array(),
						'name' => array(),
					),
					'noscript' => array(),
					'p' => array(),
					'strong' => array(),
					'script' => array(
						'src' => array(),
						'type' => array(),
						'defer' => array(),
					),
				);
				$allowed = apply_filters( 'ghostpool_textarea_allowed_tags', $allowed );
				$value = wp_kses( $value, $allowed );
			} else {
				$value = wp_kses_post( $value );
			}

		} elseif ( 'typography' === $setting['type'] ) {
		
			if ( isset( $value['font-family'] ) ) {
				$value['font-family'] = ghostpool_sanitize_select( $value['font-family'], $setting, ghostpool_google_fonts_array() );
			} else {
				$value['font-family'] = gpur_option( $setting['id'], 'font-family' );
			}

			if ( isset( $value['font-backup'] ) ) {
				$value['font-backup'] = ghostpool_sanitize_select( $value['font-backup'], $setting, ghostpool_backup_fonts_array() );
			}
									
			if ( isset( $value['font-size']['value'] ) ) {
				$value['font-size']['value'] = ghostpool_sanitize_dimensions( $value['font-size']['value'] );
			}
			if ( isset( $value['font-size']['units'] ) ) {	
				$value['font-size']['units'] = ghostpool_sanitize_select( $value['font-size']['units'] );
			}
			
			if ( isset( $value['line-height']['value'] ) ) {
				$value['line-height']['value'] = ghostpool_sanitize_dimensions( $value['line-height']['value'] );
			}
			if ( isset( $value['line-height']['units'] ) ) {		
				$value['line-height']['units'] = ghostpool_sanitize_select( $value['line-height']['units'] );
			}
			
			if ( isset( $value['color'] ) ) {
				$value['color'] = ghostpool_sanitize_colors( $value['color'] );
			}
			
			if ( isset( $value['font-weight'] ) ) {
				$value['font-weight'] = ghostpool_sanitize_select( $value['font-weight'], $setting, ghostpool_google_font_variants_array() );
			} else {
				$value['font-weight'] = gpur_option( $setting['id'], 'font-weight' );
			}
			
			if ( isset( $value['subsets'] ) ) {
				$value['subsets'] = ghostpool_sanitize_select( $value['subsets'], $setting, ghostpool_google_font_subsets_array() );
			} else {
				$value['subsets'] = gpur_option( $setting['id'], 'subsets' );
			}
			
			if ( isset( $value['letter-spacing']['value'] ) ) {
				$value['letter-spacing']['value'] = ghostpool_sanitize_dimensions( $value['letter-spacing']['value'] );
			}
			if ( isset( $value['letter-spacing']['units'] ) ) {		
				$value['letter-spacing']['units'] = ghostpool_sanitize_select( $value['letter-spacing']['units'] );
			}
			
			if ( isset( $value['word-spacing']['value'] ) ) {
				$value['word-spacing']['value'] = ghostpool_sanitize_dimensions( $value['word-spacing']['value'] );
			}
			if ( isset( $value['word-spacing']['units'] ) ) {
				$value['word-spacing']['units'] = ghostpool_sanitize_select( $value['word-spacing']['units'] );
			}
			
			if ( isset( $value['text-transform'] ) ) {
				$value['text-transform'] = ghostpool_sanitize_select( $value['text-transform'], $setting, 'text-transform' );
			}
			
			if ( isset( $value['text-align'] ) ) {
				$value['text-align'] = ghostpool_sanitize_select( $value['text-align'], $setting, 'text-align' );
			}
			
			if ( isset( $value['text-decoration'] ) ) {
				$value['text-decoration'] = ghostpool_sanitize_select( $value['text-decoration'], $setting, 'text-decoration' );
			}
		
			
		}
		
		return $value;
		
	}
}