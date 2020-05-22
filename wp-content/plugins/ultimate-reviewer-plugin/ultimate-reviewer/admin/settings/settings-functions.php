<?php

/**
 * Save default settings upon theme activation
 *
 */
if ( ! function_exists( 'gpur_save_default_options' ) ) {
	function gpur_save_default_options() {
		$framework = gpur_framework_data();
		
		if ( '' == get_option( $framework['option_name'] ) ) {
		
			$settings = gpur_global_settings( $framework['theme_slug'] );
			
			if ( $settings ) {
			
				$defaults = array();
				
				foreach( $settings as $setting ) {		
									
					if ( isset( $setting['default'] ) ) {
					
						$defaults[$setting['id']] = $setting['default'];
						
					} elseif ( isset( $setting['styling'] ) ) {
					
						foreach( $setting['styling'] as $style => $value ) {
			
							if ( isset( $setting['styling'][$style]['default'] ) ) {						
								$defaults[$setting['id']][$style] = $setting['styling'][$style]['default'];
							} else {
								$defaults[$setting['id']][$style] = '';
							}
							
						}
						
					} else {
					
						$defaults[$setting['id']] = '';
						
					}					
										
				}
			}				
			update_option( $framework['option_name'], $defaults );
			
		}
		
	}
}
add_action( 'after_setup_theme', 'gpur_save_default_options' );

/**
 * Load options function
 *
 */
if ( ! function_exists( 'gpur_option' ) ) {
	function gpur_option( $id, $id2 = false, $id3 = false ) {
		$framework = gpur_framework_data();
		$options = get_option( $framework['option_name'] );
		if ( $id3 ) {
			if ( isset( $options[$id][$id2][$id3] ) ) {
				return $options[$id][$id2][$id3];
			}
		} elseif ( $id2 ) {
			if ( isset( $options[$id][$id2] ) ) {
				return $options[$id][$id2];
			}	
		} else {
			if ( isset( $options[$id] ) ) {
				return $options[$id];
			}
		}
	}
}

/**
 * Enqueue styles and scripts
 *
 */
 if ( ! function_exists( 'ghostpool_framework_enqueue_framework_scripts' ) ) {
	function ghostpool_framework_enqueue_framework_scripts() {
	
		$framework = gpur_framework_data();

		// Global scripts
		wp_register_style( 'ghostpool-framework-settings', $framework['directory_uri'] . 'settings/assets/framework-settings.css', array(), $framework['the_version'] );
		wp_register_script( 'ghostpool-framework-global', $framework['directory_uri'] . 'settings/assets/framework-global.js', array( 'jquery' ), $framework['the_version'], false );	
		
		// Metaboxes scripts
		wp_register_style( 'ghostpool-framework-settings', $framework['directory_uri'] . 'settings/assets/framework-settings.css', array(), $framework['the_version'] );	
		wp_register_script( 'ghostpool-framework-metaboxes', $framework['directory_uri'] . 'settings/assets/framework-metaboxes.js', array( 'jquery' ), $framework['the_version'], false );
		wp_register_script( 'ghostpool-framework-conditions', $framework['directory_uri'] . 'settings/assets/framework-conditions.js', array( 'jquery' ), $framework['the_version'], false );
		if ( is_ssl() ) { $scheme = 'https'; } else { $scheme = 'http'; }
		wp_localize_script( 'ghostpool-framework-metaboxes', 'ghostpool_framework', array(
			'ajaxurl' => admin_url( 'admin-ajax.php', $scheme ),
		) );
		
		// Field styling	
		wp_register_style( 'jquery-ui-theme-smoothness', sprintf( '//ajax.googleapis.com/ajax/libs/jqueryui/%s/themes/smoothness/jquery-ui.css', wp_scripts()->registered['jquery-ui-core']->ver ) );

		// Select2 scripts
		wp_register_style( 'select2css', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css' );
		wp_register_script( 'select2js', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js', array( 'jquery' ) );

		// Ace editor field scripts
		wp_register_script( 'ace-editor', $framework['directory_uri'] . 'settings/assets/ace.js', array(), $framework['the_version'] );
		wp_register_script( 'ace-editor-mode-css', $framework['directory_uri'] . 'settings/assets/mode-css.js', array( 'ace-editor' ), $framework['the_version'] );
		wp_register_script( 'ace-editor-mode-javascript', $framework['directory_uri'] . 'settings/assets/mode-javascript.js', array( 'ace-editor' ), $framework['the_version'] );
		wp_register_script( 'ghostpool-ace-editor-field', $framework['directory_uri'] . 'settings/assets/ace-editor.js', array( 'jquery', 'ace-editor' ), $framework['the_version'] );

		// Color field scripts
		wp_register_script( 'wp-color-picker-alpha', $framework['directory_uri'] . 'settings/assets/wp-color-picker-alpha.min.js', array( 'wp-color-picker' ), $framework['the_version'], false );
		wp_register_script( 'ghostpool-color-field', $framework['directory_uri'] . 'settings/assets/color.js', array( 'jquery', 'wp-color-picker' ), $framework['the_version'], false );

		// Gallery field scripts
		wp_register_script( 'ghostpool-gallery-field', $framework['directory_uri'] . 'settings/assets/gallery.js', array( 'jquery' ), $framework['the_version'], false );

		// Icon field scripts
		$options = get_option( $framework['option_name'] );
		if ( 'enabled' === $options['fontawesome5'] OR defined( 'ELEMENTOR_VERSION' ) ) {

			wp_deregister_style( 'font-awesome' );
			wp_register_style( 'fontawesome5', $framework['font_uri'] . 'fontawesome5/css/all.min.css', array(), $framework['the_version'] );
		
		} else {
		
			if ( file_exists( plugin_dir_url( 'js_composer' ) . 'assets/lib/bower/font-awesome/css/font-awesome.min.css' ) ) {
				$font_url = plugin_dir_url( 'js_composer' ) . 'assets/lib/bower/font-awesome/css/font-awesome.min.css';
			} else {
				$font_url = $framework['font_uri'] . 'font-awesome/css/font-awesome.min.css';
			}
			wp_register_style( 'font-awesome', $font_url, array(), $framework['the_version'], 'all' );
		
		}
		wp_register_script( 'ghostpool-icon-field', $framework['directory_uri'] . 'settings/assets/icon.js', array( 'jquery' ), $framework['the_version'], false );

		// Image select field scripts
		wp_register_script( 'ghostpool-image-select-field', $framework['directory_uri'] . 'settings/assets/image-select.js', array( 'jquery' ), $framework['the_version'], false );

		// Media field scripts
		wp_register_script( 'ghostpool-media-field', $framework['directory_uri'] . 'settings/assets/media.js', array( 'jquery' ), $framework['the_version'], false );

		// Multi text field scripts
		wp_register_script( 'ghostpool-multi-text-field', $framework['directory_uri'] . 'settings/assets/multi-text.js', array( 'jquery' ), $framework['the_version'], false );

		// Slider field scripts
		wp_register_script( 'ghostpool-slider-field', $framework['directory_uri'] . 'settings/assets/slider.js', array( 'jquery', 'jquery-ui-slider' ), $framework['the_version'], false );

		// Spinner field scripts
		wp_register_script( 'ghostpool-spinner-field', $framework['directory_uri'] . 'settings/assets/spinner.js', array( 'jquery', 'jquery-ui-spinner' ), $framework['the_version'], false );
			
		// Typography field scripts
		wp_register_script( 'ghostpool-typography-field', $framework['directory_uri'] . 'settings/assets/typography.js', array( 'jquery' ), $framework['the_version'], false );
	
	}
}	
add_action( 'admin_enqueue_scripts', 'ghostpool_framework_enqueue_framework_scripts' );

/**
 * Load default setting fields
 *
 */
if ( ! function_exists( 'ghostpool_default_setting_fields' ) ) {	
	function ghostpool_default_setting_fields( $setting = array() ) {
					
		$defaults = array(
			'id' => '',
			'title' => '',
			'section',
			'desc' => '',
			'type' => '',
			'format' => '',
			'units' => 'px',
			'styling' => array(),
			'options' => array(),
			'data' => '',
			'default_pages' => array(),
			'select2' => false,
			'default' => '',
			'step' => 1,
			'min' => 0,
			'max' => 10,
			'validate' => '',
			'class' => 'gp-setting',
			'important' => '',
			'media_query' => '',
			'rtl' => false,
			'output' => '',
			'conditions' => array(),
		);
		
		$output = wp_parse_args( $setting, $defaults );	
		
		return $output;
				
	}
}					
					
/**
 * Load field types
 *
 */
if ( ! function_exists( 'ghostpool_settings_field_types' ) ) {	
	function ghostpool_settings_field_types( $name, $value, $settings ) {
					
		$framework = gpur_framework_data();
					
		if ( $settings && is_array( $settings ) ) {
			extract( $settings );
		}
		
		// Clean IDs
		if ( false === strpos( $id, '_customize-input-' ) ) {
			$id = 'gp-' . str_replace( '_', '-', $id );
		}
		
		// Get value
		if ( $value ) {
			$value = $value;
		} elseif ( isset( $default ) && '' !== $default ) {
			$value = $default;
		} elseif ( ( isset( $options ) && ! empty( $options ) ) OR ( isset( $data ) && ! empty( $data ) ) ) {
			$value = array();
		} else {
			$value = '';
		}

		// Data variable
		if ( isset( $data ) && '' !== $data ) {

			if ( 'post_types' === $data ) {

				$post_types = get_post_types( 
					array(
						'public'              => true,
						'exclude_from_search' => false,
					), 
					'names', 
					'and'
				);
			
				foreach ( $post_types as $post_type ) {
					if ( 'attachment' !== $post_type && 'gpur-template' !== $post_type ) {
						$options[ $post_type ] = $post_type;
					}
				}
		
			} elseif ( 'categories' === $data ) {
	
				$options[] = esc_html__( 'All categories', 'gpur' );
	
				$cats = get_categories();
				if ( ! empty ( $cats ) ) {
					foreach ( $cats as $cat ) {
						$options[ $cat->term_id ] = $cat->name;
					}
				}

			} elseif ( 'roles' === $data ) {

				$data = array();
				global $wp_roles;
				$roles = $wp_roles->get_names();
				foreach ( $roles as $role ) {
					$role = str_replace( ' ', '_', $role );
					$role = strtolower( $role );
					$options[ $role ] = $role;
				}

			} elseif ( 'sidebars' === $data ) {
		 
				global $wp_registered_sidebars;
				
				if ( 'default' === $default ) {
					$options['default'] = esc_html__( 'Default', 'gpur' );		
				}
				
				foreach ( $wp_registered_sidebars as $sidebar_id => $sidebar ) {
					$options[ $sidebar_id ] = $sidebar['name'];
				}

			} elseif ( 'pages' === $data ) {
		
				if ( 'multi' !== $format ) {
					$options[] = esc_html__( 'None', 'gpur' );
				}
				
				if ( isset( $default_pages ) && is_array( $default_pages ) ) {
					if ( in_array( 'dashboard', $default_pages ) ) {
						$options['dashboard'] = esc_html__( 'Dashboard', 'gpur' );
					}	
					if ( in_array( 'profile', $default_pages ) && function_exists( 'bp_is_active' ) ) {
						$options['profile'] = esc_html__( 'BuddyPress Profile Page', 'gpur' );
					}
					if ( in_array( 'author', $default_pages ) ) {
						$options['author'] = esc_html__( 'WordPress Author Page', 'gpur' );
					}
					if ( in_array( 'login-link', $default_pages ) ) {
						$options['login-link'] = esc_html__( 'Login Link', 'gpur' );
					}	
					if ( in_array( 'register-link', $default_pages ) ) {
						$options['register-link'] = esc_html__( 'Register Link', 'gpur' );
					}	
					if ( in_array( 'logout-link', $default_pages ) ) {
						$options['logout-link'] = esc_html__( 'Logout Link', 'gpur' );
					}
					if ( in_array( 'bp-profile-posts', $default_pages ) ) {
						$options['bp-profile-posts'] = esc_html__( 'BuddyPress Profile Posts', 'gpur' );
					}
				}	
				
				$args = array(
					'hierarchical' => false,
				);
                $pages = get_pages( $args );
                if ( is_array( $pages ) && ! empty ( $pages ) ) {
                	foreach ( $pages as $page ) {
                    	$options[ $page->ID ] = $page->post_title . ' (ID: ' . $page->ID . ')';
                    }
                }

			}
	
		}

		if ( 'ace_editor' === $type ) {
					
			include( $framework['directory_path'] . 'settings/fields/standard-ace-editor.php' );
	
		} elseif ( 'background' === $type ) {
					
			include( $framework['directory_path'] . 'settings/fields/standard-background.php' );

		} elseif ( 'border' === $type ) {
					
			include( $framework['directory_path'] . 'settings/fields/standard-border.php' );

		} elseif ( 'checkbox' === $type ) {
		
			include( $framework['directory_path'] . 'settings/fields/standard-checkbox.php' );
	
		} elseif ( 'color' === $type ) {	
			
			include( $framework['directory_path'] . 'settings/fields/standard-color.php' );	

		} elseif ( 'color_gradient' === $type ) {	
			
			include( $framework['directory_path'] . 'settings/fields/standard-color-gradient.php' );	
		
		} elseif ( 'color_rgba' === $type ) {	
			
			include( $framework['directory_path'] . 'settings/fields/standard-color-rgba.php' );	

		} elseif ( 'dimensions' === $type ) {
			
			include( $framework['directory_path'] . 'settings/fields/standard-dimensions.php' );	

		} elseif ( 'export' === $type ) {

			include( $framework['directory_path'] . 'settings/fields/standard-export.php' );

		} elseif ( 'import' === $type ) {

			include( $framework['directory_path'] . 'settings/fields/standard-import.php' );
			
		} elseif ( 'gallery' === $type ) {

			include( $framework['directory_path'] . 'settings/fields/standard-gallery.php' );
	
		} elseif ( 'image_select' === $type ) {
		
			include( $framework['directory_path'] . 'settings/fields/standard-image-select.php' );
			
		} elseif ( 'link_color' === $type ) {
		
			include( $framework['directory_path'] . 'settings/fields/standard-link-color.php' );
	
		} elseif ( 'media' === $type ) {
		
			include( $framework['directory_path'] . 'settings/fields/standard-media.php' );
	
		} elseif ( 'multi_text' === $type ) {
		
			include( $framework['directory_path'] . 'settings/fields/standard-multi-text.php' );
	
		} elseif ( 'radio' === $type ) {

			include( $framework['directory_path'] . 'settings/fields/standard-radio.php' );				

		} elseif ( 'select' === $type ) {
			
			include( $framework['directory_path'] . 'settings/fields/standard-select.php' );				
	
		} elseif ( 'slider' === $type ) {

			include( $framework['directory_path'] . 'settings/fields/standard-slider.php' );	
		
		} elseif ( 'spacing' === $type ) {

			include( $framework['directory_path'] . 'settings/fields/standard-spacing.php' );	
						
		} elseif ( 'spinner' === $type ) {

			include( $framework['directory_path'] . 'settings/fields/standard-spinner.php' );	
			
		} elseif ( 'styling' === $type ) {
			
			include( $framework['directory_path'] . 'settings/fields/standard-styling.php' );	
			
		} elseif ( 'text' === $type ) {
	
			include( $framework['directory_path'] . 'settings/fields/standard-text.php' );	
			
		} elseif ( 'textarea' === $type ) {
			
			include( $framework['directory_path'] . 'settings/fields/standard-textarea.php' );	
		
		} elseif ( 'typography' === $type ) {

			include( $framework['directory_path'] . 'settings/fields/standard-typography.php' );

		}	
		
		if ( isset( $desc ) && 'section-header' !== $type ) {
			echo '<p class="description">' . wp_kses_post( $desc ) . '</p>';
		}

	}	
}			

/**
 * Backup fonts
 *
 */
if ( ! function_exists( 'ghostpool_backup_fonts_array' ) ) {
	function ghostpool_backup_fonts_array() {
		
		//delete_transient( 'ghostpool_backup_fonts_array' );
	
		$output = get_transient( 'ghostpool_backup_fonts_array' );
	
		if ( false === $output ) {

			$backup_fonts = array(
				"Arial, Helvetica, sans-serif",
				"'Arial Black', Gadget, sans-serif",
				"'Bookman Old Style', serif",
				"'Comic Sans MS', cursive",                             
				"Courier, monospace",                                  
				"Garamond, serif",                                      
				"Georgia, serif",                         
				"Impact, Charcoal, sans-serif",      
				"'Lucida Console', Monaco, monospace",    
				"'Lucida Sans Unicode', 'Lucida Grande', sans-serif", 
				"'MS Sans Serif', Geneva, sans-serif",                  
				"'MS Serif', 'New York', sans-serif",                   
				"'Palatino Linotype', 'Book Antiqua', Palatino, serif", 
				"Tahoma,Geneva, sans-serif",                            
				"'Times New Roman', Times,serif",                      
				"'Trebuchet MS', Helvetica, sans-serif" ,               
				"Verdana, Geneva, sans-serif",                       
			);
	
			// Create key of same name as value
			foreach( $backup_fonts as $backup_font ) {
				$output[$backup_font] = $backup_font;
			}		

			set_transient( 'ghostpool_backup_fonts_array', $output, 7 * DAY_IN_SECONDS );
			
		}	
		
		return $output;
		
	}	
}
        
/**
 * Google fonts
 *
 */
if ( ! function_exists( 'ghostpool_google_fonts_array' ) ) {
	function ghostpool_google_fonts_array() {	
			
		//delete_transient( 'ghostpool_google_fonts_array' );

		$output = get_transient( 'ghostpool_google_fonts_array' );
		
		if ( false === $output ) {	

			$result = @wp_remote_get( apply_filters( 'ghostpool_google_fonts_api_url', 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyAVYztkPt5uXNl8LuJ2nFJW0CZTKdbmaSM' ), array( 'sslverify' => false ) );
			
			if ( is_wp_error( $result ) OR $result['response']['code'] != 200 ) {
				$result = @wp_remote_get( apply_filters( 'ghostpool_google_fonts_api_url', 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyBox9fgfm5aPvjPA2jH2Aj0Kmv8qapDIkI' ), array( 'sslverify' => false ) );
			}
		
			if ( ! is_wp_error( $result ) && $result['response']['code'] == 200 ) {
			
				$fonts = json_decode( $result['body'] );
				$fonts = $fonts->items;
				if ( $fonts ) { 
					foreach( $fonts as $font ) {
						$google_fonts_array[$font->family] = $font->family;
					}
				}
			
				if ( is_array( ghostpool_backup_fonts_array() ) ) {
					$output = array_merge( ghostpool_backup_fonts_array(), $google_fonts_array );	
				} else {			
					$output = $google_fonts_array;
				}
				
			} else {
		
				$output = ghostpool_backup_fonts_array();
			}
			
			$output = apply_filters( 'ghostpool_font_families', $output );
		
			set_transient( 'ghostpool_google_fonts_array', $output, 7 * DAY_IN_SECONDS );
			
		}	
		
		return $output;
		
	}	
}	

/**
 * Google font variants
 *
 */
if ( ! function_exists( 'ghostpool_google_font_variants_array' ) ) {
	function ghostpool_google_font_variants_array( $font_family = '' ) {	
			
		//delete_transient( 'ghostpool_google_font_variants_array' );

		$output = get_transient( 'ghostpool_google_font_variants_array' );
		
		if ( false === $output ) {	

			$result = @wp_remote_get( apply_filters( 'ghostpool_google_fonts_api_url', 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyAVYztkPt5uXNl8LuJ2nFJW0CZTKdbmaSM' ), array( 'sslverify' => false ) );
			
			if ( is_wp_error( $result ) OR 200 != $result['response']['code'] ) {
				$result = @wp_remote_get( apply_filters( 'ghostpool_google_fonts_api_url', 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyBox9fgfm5aPvjPA2jH2Aj0Kmv8qapDIkI' ), array( 'sslverify' => false ) );
			}
			
			if ( ! is_wp_error( $result ) && 200 == $result['response']['code'] ) {
			
				$fonts = json_decode( $result['body'] );
				$fonts = $fonts->items;

				foreach( $fonts as $font ) {
					if ( $font->family === $font_family ) {
						foreach( $font->variants as $font_variant ) {
							if ( 'regular' === $font_variant ) {
								$font_variant_value = '400';
								$font_variant_name = '400';
							} elseif ( 'italic' === $font_variant ) {
								$font_variant_value = '400italic';
								$font_variant_name = '400 Italic';	
							} else {
								$font_variant_value = $font_variant;
								$font_variant_name = ucwords( preg_replace('/(\d+)/', '${1} ', $font_variant ) );
							}
							$output[$font_variant_name] = $font_variant_value;
						}
					}
				}										
				
			}
			
			$output = apply_filters( 'ghostpool_font_variants', $output );
					
			set_transient( 'ghostpool_google_font_variants_array', $output, 7 * DAY_IN_SECONDS );
			
		}	
		
		return $output;
		
	}	
}

/**
 * Google font subsets
 *
 */
if ( ! function_exists( 'ghostpool_google_font_subsets_array' ) ) {
	function ghostpool_google_font_subsets_array( $font_family = '' ) {	
			
		//delete_transient( 'ghostpool_google_font_subsets_array' );

		$output = get_transient( 'ghostpool_google_font_subsets_array' );
		
		if ( false === $output ) {	

			$result = @wp_remote_get( apply_filters( 'ghostpool_google_fonts_api_url', 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyAVYztkPt5uXNl8LuJ2nFJW0CZTKdbmaSM' ), array( 'sslverify' => false ) );
			
			if ( is_wp_error( $result ) OR 200 != $result['response']['code'] ) {
				$result = @wp_remote_get( apply_filters( 'ghostpool_google_fonts_api_url', 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyBox9fgfm5aPvjPA2jH2Aj0Kmv8qapDIkI' ), array( 'sslverify' => false ) );
			}
			
			if ( ! is_wp_error( $result ) && 200 == $result['response']['code'] ) {
			
				$fonts = json_decode( $result['body'] );
				$fonts = $fonts->items;

				foreach( $fonts as $font ) {
					if ( $font->family === $font_family ) {
						foreach( $font->subsets as $font_subset ) {
							$output[$font_subset] = ucwords( $font_subset );
						}
					}
				}										
				
			}
			
			$output = apply_filters( 'ghostpool_font_subsets', $output );
					
			set_transient( 'ghostpool_google_font_subsets_array', $output, 7 * DAY_IN_SECONDS );
			
		}	
		
		return $output;
		
	}	
}	

/**
 * Ajax typography values
 *
 */
if ( ! function_exists( 'ghostpool_typography_ajax' ) ) {
	function ghostpool_typography_ajax() {		

		$font_family = $_GET['fontFamily'];

		if ( ghostpool_google_font_variants_array( $font_family ) ) {		
			$current_weight = $_GET['fontWeight'];
			foreach( ghostpool_google_font_variants_array( $font_family ) as $title => $key ) {
				if ( $key === $current_weight ) {
					$checked = ' selected="selected"';
				} else {
					$checked = '';
				}
				$weights[] = '<option value="' . esc_attr( $key ) . '"' . $checked . '>' . esc_attr( $title ) . '</option>';
			}	
		}		
		
		if ( ghostpool_google_font_subsets_array( $font_family ) ) {	
			$current_subset = $_GET['fontSubset'];		
			foreach( ghostpool_google_font_subsets_array( $font_family ) as $key => $title ) {
				if ( $key === $current_subset ) {
					$checked = ' selected="selected"';
				} else {
					$checked = '';
				}
				$subsets[] = '<option value="' . esc_attr( $key ) . '"' . $checked . '>' . esc_attr( $title ) . '</option>';
			}
		}
	
		echo json_encode( array( 'subsets' => $subsets, 'weights' => $weights ) );

		die();
		
	}
}
add_action( 'wp_ajax_ghostpool_typography_ajax', 'ghostpool_typography_ajax' );
add_action( 'wp_ajax_nopriv_ghostpool_typography_ajax', 'ghostpool_typography_ajax' );

/**
 * FontAwesome 5 icons
 *
 */
if ( ! function_exists( 'gpur_fontawesome_icons' ) ) {
	function gpur_fontawesome_icons( $icon ) {

		if ( 'enabled' === gpur_option( 'fontawesome5' ) OR defined( 'ELEMENTOR_VERSION' ) ) {
	
			if ( 'fa fa-star-o' === $icon ) {
				$output = 'fas fa-star';
			} elseif ( 'fa fa-star' === $icon ) {	
				$output = 'fas fa-star';
			} elseif ( 'fa fa-heart-o' === $icon ) {		
				$output = 'fas fa-heart';
			} elseif ( 'fa fa-heart' === $icon ) {	
				$output = 'fas fa-heart';
			} elseif ( 'fa fa-angle-right' === $icon ) {	
				$output = 'fas fa-angle-right';
			} elseif ( 'fa fa-thumbs-o-up' === $icon ) {	
				$output = 'fas fa-thumbs-up';
			} elseif ( 'fa fa-thumbs-o-down' === $icon ) {	
				$output = 'fas fa-thumbs-down';
			} elseif ( 'fa fa-check' === $icon ) {	
				$output = 'fas check';
			} elseif ( 'fa fa-times' === $icon ) {	
				$output = 'fas fa-times';
			}
		
		} else {
		
			$output = $icon;
		
		}
	
		return $output;
	
	}	
}

/**
 * Icon selection
 *
 */
if ( ! function_exists( 'ghostpool_icons' ) ) {
	function ghostpool_icons() {
		
		$framework = gpur_framework_data();
		$options = get_option( $framework['option_name'] );
		if ( 'enabled' === $options['fontawesome5'] ) {

			$output = array( '', 'fas fa-ad', 'fas fa-address-book', 'fas fa-address-card', 'fas fa-adjust', 'fas fa-air-freshener', 'fas fa-align-center', 'fas fa-align-justify', 'fas fa-align-left', 'fas fa-align-right', 'fas fa-allergies', 'fas fa-ambulance', 'fas fa-american-sign-language-interpreting', 'fas fa-anchor', 'fas fa-angle-double-down', 'fas fa-angle-double-left', 'fas fa-angle-double-right', 'fas fa-angle-double-up', 'fas fa-angle-down', 'fas fa-angle-left', 'fas fa-angle-right', 'fas fa-angle-up', 'fas fa-angry', 'fas fa-ankh', 'fas fa-apple-alt', 'fas fa-archive', 'fas fa-archway', 'fas fa-arrow-alt-circle-down', 'fas fa-arrow-alt-circle-left', 'fas fa-arrow-alt-circle-right', 'fas fa-arrow-alt-circle-up', 'fas fa-arrow-circle-down', 'fas fa-arrow-circle-left', 'fas fa-arrow-circle-right', 'fas fa-arrow-circle-up', 'fas fa-arrow-down', 'fas fa-arrow-left', 'fas fa-arrow-right', 'fas fa-arrow-up', 'fas fa-arrows-alt', 'fas fa-arrows-alt-h', 'fas fa-arrows-alt-v', 'fas fa-assistive-listening-systems', 'fas fa-asterisk', 'fas fa-at', 'fas fa-atlas', 'fas fa-atom', 'fas fa-audio-description', 'fas fa-award', 'fas fa-baby', 'fas fa-baby-carriage', 'fas fa-backspace', 'fas fa-backward', 'fas fa-bacon', 'fas fa-balance-scale', 'fas fa-balance-scale-left', 'fas fa-balance-scale-right', 'fas fa-ban', 'fas fa-band-aid', 'fas fa-barcode', 'fas fa-bars', 'fas fa-baseball-ball', 'fas fa-basketball-ball', 'fas fa-bath', 'fas fa-battery-empty', 'fas fa-battery-full', 'fas fa-battery-half', 'fas fa-battery-quarter', 'fas fa-battery-three-quarters', 'fas fa-bed', 'fas fa-beer', 'fas fa-bell', 'fas fa-bell-slash', 'fas fa-bezier-curve', 'fas fa-bible', 'fas fa-bicycle', 'fas fa-biking', 'fas fa-binoculars', 'fas fa-biohazard', 'fas fa-birthday-cake', 'fas fa-blender', 'fas fa-blender-phone', 'fas fa-blind', 'fas fa-blog', 'fas fa-bold', 'fas fa-bolt', 'fas fa-bomb', 'fas fa-bone', 'fas fa-bong', 'fas fa-book', 'fas fa-book-dead', 'fas fa-book-medical', 'fas fa-book-open', 'fas fa-book-reader', 'fas fa-bookmark', 'fas fa-border-all', 'fas fa-border-none', 'fas fa-border-style', 'fas fa-bowling-ball', 'fas fa-box', 'fas fa-box-open', 'fas fa-boxes', 'fas fa-braille', 'fas fa-brain', 'fas fa-bread-slice', 'fas fa-briefcase', 'fas fa-briefcase-medical', 'fas fa-broadcast-tower', 'fas fa-broom', 'fas fa-brush', 'fas fa-bug', 'fas fa-building', 'fas fa-bullhorn', 'fas fa-bullseye', 'fas fa-burn', 'fas fa-bus', 'fas fa-bus-alt', 'fas fa-business-time', 'fas fa-calculator', 'fas fa-calendar', 'fas fa-calendar-alt', 'fas fa-calendar-check', 'fas fa-calendar-day', 'fas fa-calendar-minus', 'fas fa-calendar-plus', 'fas fa-calendar-times', 'fas fa-calendar-week', 'fas fa-camera', 'fas fa-camera-retro', 'fas fa-campground', 'fas fa-candy-cane', 'fas fa-cannabis', 'fas fa-capsules', 'fas fa-car', 'fas fa-car-alt', 'fas fa-car-battery', 'fas fa-car-crash', 'fas fa-car-side', 'fas fa-caret-down', 'fas fa-caret-left', 'fas fa-caret-right', 'fas fa-caret-square-down', 'fas fa-caret-square-left', 'fas fa-caret-square-right', 'fas fa-caret-square-up', 'fas fa-caret-up', 'fas fa-carrot', 'fas fa-cart-arrow-down', 'fas fa-cart-plus', 'fas fa-cash-register', 'fas fa-cat', 'fas fa-certificate', 'fas fa-chair', 'fas fa-chalkboard', 'fas fa-chalkboard-teacher', 'fas fa-charging-station', 'fas fa-chart-area', 'fas fa-chart-bar', 'fas fa-chart-line', 'fas fa-chart-pie', 'fas fa-check', 'fas fa-check-circle', 'fas fa-check-double', 'fas fa-check-square', 'fas fa-cheese', 'fas fa-chess', 'fas fa-chess-bishop', 'fas fa-chess-board', 'fas fa-chess-king', 'fas fa-chess-knight', 'fas fa-chess-pawn', 'fas fa-chess-queen', 'fas fa-chess-rook', 'fas fa-chevron-circle-down', 'fas fa-chevron-circle-left', 'fas fa-chevron-circle-right', 'fas fa-chevron-circle-up', 'fas fa-chevron-down', 'fas fa-chevron-left', 'fas fa-chevron-right', 'fas fa-chevron-up', 'fas fa-child', 'fas fa-church', 'fas fa-circle', 'fas fa-circle-notch', 'fas fa-city', 'fas fa-clinic-medical', 'fas fa-clipboard', 'fas fa-clipboard-check', 'fas fa-clipboard-list', 'fas fa-clock', 'fas fa-clone', 'fas fa-closed-captioning', 'fas fa-cloud', 'fas fa-cloud-download-alt', 'fas fa-cloud-meatball', 'fas fa-cloud-moon', 'fas fa-cloud-moon-rain', 'fas fa-cloud-rain', 'fas fa-cloud-showers-heavy', 'fas fa-cloud-sun', 'fas fa-cloud-sun-rain', 'fas fa-cloud-upload-alt', 'fas fa-cocktail', 'fas fa-code', 'fas fa-code-branch', 'fas fa-coffee', 'fas fa-cog', 'fas fa-cogs', 'fas fa-coins', 'fas fa-columns', 'fas fa-comment', 'fas fa-comment-alt', 'fas fa-comment-dollar', 'fas fa-comment-dots', 'fas fa-comment-medical', 'fas fa-comment-slash', 'fas fa-comments', 'fas fa-comments-dollar', 'fas fa-compact-disc', 'fas fa-compass', 'fas fa-compress', 'fas fa-compress-arrows-alt', 'fas fa-concierge-bell', 'fas fa-cookie', 'fas fa-cookie-bite', 'fas fa-copy', 'fas fa-copyright', 'fas fa-couch', 'fas fa-credit-card', 'fas fa-crop', 'fas fa-crop-alt', 'fas fa-cross', 'fas fa-crosshairs', 'fas fa-crow', 'fas fa-crown', 'fas fa-crutch', 'fas fa-cube', 'fas fa-cubes', 'fas fa-cut', 'fas fa-database', 'fas fa-deaf', 'fas fa-democrat', 'fas fa-desktop', 'fas fa-dharmachakra', 'fas fa-diagnoses', 'fas fa-dice', 'fas fa-dice-d20', 'fas fa-dice-d6', 'fas fa-dice-five', 'fas fa-dice-four', 'fas fa-dice-one', 'fas fa-dice-six', 'fas fa-dice-three', 'fas fa-dice-two', 'fas fa-digital-tachograph', 'fas fa-directions', 'fas fa-divide', 'fas fa-dizzy', 'fas fa-dna', 'fas fa-dog', 'fas fa-dollar-sign', 'fas fa-dolly', 'fas fa-dolly-flatbed', 'fas fa-donate', 'fas fa-door-closed', 'fas fa-door-open', 'fas fa-dot-circle', 'fas fa-dove', 'fas fa-download', 'fas fa-drafting-compass', 'fas fa-dragon', 'fas fa-draw-polygon', 'fas fa-drum', 'fas fa-drum-steelpan', 'fas fa-drumstick-bite', 'fas fa-dumbbell', 'fas fa-dumpster', 'fas fa-dumpster-fire', 'fas fa-dungeon', 'fas fa-edit', 'fas fa-egg', 'fas fa-eject', 'fas fa-ellipsis-h', 'fas fa-ellipsis-v', 'fas fa-envelope', 'fas fa-envelope-open', 'fas fa-envelope-open-text', 'fas fa-envelope-square', 'fas fa-equals', 'fas fa-eraser', 'fas fa-ethernet', 'fas fa-euro-sign', 'fas fa-exchange-alt', 'fas fa-exclamation', 'fas fa-exclamation-circle', 'fas fa-exclamation-triangle', 'fas fa-expand', 'fas fa-expand-arrows-alt', 'fas fa-external-link-alt', 'fas fa-external-link-square-alt', 'fas fa-eye', 'fas fa-eye-dropper', 'fas fa-eye-slash', 'fas fa-fan', 'fas fa-fast-backward', 'fas fa-fast-forward', 'fas fa-fax', 'fas fa-feather', 'fas fa-feather-alt', 'fas fa-female', 'fas fa-fighter-jet', 'fas fa-file', 'fas fa-file-alt', 'fas fa-file-archive', 'fas fa-file-audio', 'fas fa-file-code', 'fas fa-file-contract', 'fas fa-file-csv', 'fas fa-file-download', 'fas fa-file-excel', 'fas fa-file-export', 'fas fa-file-image', 'fas fa-file-import', 'fas fa-file-invoice', 'fas fa-file-invoice-dollar', 'fas fa-file-medical', 'fas fa-file-medical-alt', 'fas fa-file-pdf', 'fas fa-file-powerpoint', 'fas fa-file-prescription', 'fas fa-file-signature', 'fas fa-file-upload', 'fas fa-file-video', 'fas fa-file-word', 'fas fa-fill', 'fas fa-fill-drip', 'fas fa-film', 'fas fa-filter', 'fas fa-fingerprint', 'fas fa-fire', 'fas fa-fire-alt', 'fas fa-fire-extinguisher', 'fas fa-first-aid', 'fas fa-fish', 'fas fa-fist-raised', 'fas fa-flag', 'fas fa-flag-checkered', 'fas fa-flag-usa', 'fas fa-flask', 'fas fa-flushed', 'fas fa-folder', 'fas fa-folder-minus', 'fas fa-folder-open', 'fas fa-folder-plus', 'fas fa-font', 'fas fa-football-ball', 'fas fa-forward', 'fas fa-frog', 'fas fa-frown', 'fas fa-frown-open', 'fas fa-funnel-dollar', 'fas fa-futbol', 'fas fa-gamepad', 'fas fa-gas-pump', 'fas fa-gavel', 'fas fa-gem', 'fas fa-genderless', 'fas fa-ghost', 'fas fa-gift', 'fas fa-gifts', 'fas fa-glass-cheers', 'fas fa-glass-martini', 'fas fa-glass-martini-alt', 'fas fa-glass-whiskey', 'fas fa-glasses', 'fas fa-globe', 'fas fa-globe-africa', 'fas fa-globe-americas', 'fas fa-globe-asia', 'fas fa-globe-europe', 'fas fa-golf-ball', 'fas fa-gopuram', 'fas fa-graduation-cap', 'fas fa-greater-than', 'fas fa-greater-than-equal', 'fas fa-grimace', 'fas fa-grin', 'fas fa-grin-alt', 'fas fa-grin-beam', 'fas fa-grin-beam-sweat', 'fas fa-grin-hearts', 'fas fa-grin-squint', 'fas fa-grin-squint-tears', 'fas fa-grin-stars', 'fas fa-grin-tears', 'fas fa-grin-tongue', 'fas fa-grin-tongue-squint', 'fas fa-grin-tongue-wink', 'fas fa-grin-wink', 'fas fa-grip-horizontal', 'fas fa-grip-lines', 'fas fa-grip-lines-vertical', 'fas fa-grip-vertical', 'fas fa-guitar', 'fas fa-h-square', 'fas fa-hamburger', 'fas fa-hammer', 'fas fa-hamsa', 'fas fa-hand-holding', 'fas fa-hand-holding-heart', 'fas fa-hand-holding-usd', 'fas fa-hand-lizard', 'fas fa-hand-middle-finger', 'fas fa-hand-paper', 'fas fa-hand-peace', 'fas fa-hand-point-down', 'fas fa-hand-point-left', 'fas fa-hand-point-right', 'fas fa-hand-point-up', 'fas fa-hand-pointer', 'fas fa-hand-rock', 'fas fa-hand-scissors', 'fas fa-hand-spock', 'fas fa-hands', 'fas fa-hands-helping', 'fas fa-handshake', 'fas fa-hanukiah', 'fas fa-hard-hat', 'fas fa-hashtag', 'fas fa-hat-wizard', 'fas fa-haykal', 'fas fa-hdd', 'fas fa-heading', 'fas fa-headphones', 'fas fa-headphones-alt', 'fas fa-headset', 'fas fa-heart', 'fas fa-heart-broken', 'fas fa-heartbeat', 'fas fa-helicopter', 'fas fa-highlighter', 'fas fa-hiking', 'fas fa-hippo', 'fas fa-history', 'fas fa-hockey-puck', 'fas fa-holly-berry', 'fas fa-home', 'fas fa-horse', 'fas fa-horse-head', 'fas fa-hospital', 'fas fa-hospital-alt', 'fas fa-hospital-symbol', 'fas fa-hot-tub', 'fas fa-hotdog', 'fas fa-hotel', 'fas fa-hourglass', 'fas fa-hourglass-end', 'fas fa-hourglass-half', 'fas fa-hourglass-start', 'fas fa-house-damage', 'fas fa-hryvnia', 'fas fa-i-cursor', 'fas fa-ice-cream', 'fas fa-icicles', 'fas fa-icons', 'fas fa-id-badge', 'fas fa-id-card', 'fas fa-id-card-alt', 'fas fa-igloo', 'fas fa-image', 'fas fa-images', 'fas fa-inbox', 'fas fa-indent', 'fas fa-industry', 'fas fa-infinity', 'fas fa-info', 'fas fa-info-circle', 'fas fa-italic', 'fas fa-jedi', 'fas fa-joint', 'fas fa-journal-whills', 'fas fa-kaaba', 'fas fa-key', 'fas fa-keyboard', 'fas fa-khanda', 'fas fa-kiss', 'fas fa-kiss-beam', 'fas fa-kiss-wink-heart', 'fas fa-kiwi-bird', 'fas fa-landmark', 'fas fa-language', 'fas fa-laptop', 'fas fa-laptop-code', 'fas fa-laptop-medical', 'fas fa-laugh', 'fas fa-laugh-beam', 'fas fa-laugh-squint', 'fas fa-laugh-wink', 'fas fa-layer-group', 'fas fa-leaf', 'fas fa-lemon', 'fas fa-less-than', 'fas fa-less-than-equal', 'fas fa-level-down-alt', 'fas fa-level-up-alt', 'fas fa-life-ring', 'fas fa-lightbulb', 'fas fa-link', 'fas fa-lira-sign', 'fas fa-list', 'fas fa-list-alt', 'fas fa-list-ol', 'fas fa-list-ul', 'fas fa-location-arrow', 'fas fa-lock', 'fas fa-lock-open', 'fas fa-long-arrow-alt-down', 'fas fa-long-arrow-alt-left', 'fas fa-long-arrow-alt-right', 'fas fa-long-arrow-alt-up', 'fas fa-low-vision', 'fas fa-luggage-cart', 'fas fa-magic', 'fas fa-magnet', 'fas fa-mail-bulk', 'fas fa-male', 'fas fa-map', 'fas fa-map-marked', 'fas fa-map-marked-alt', 'fas fa-map-marker', 'fas fa-map-marker-alt', 'fas fa-map-pin', 'fas fa-map-signs', 'fas fa-marker', 'fas fa-mars', 'fas fa-mars-double', 'fas fa-mars-stroke', 'fas fa-mars-stroke-h', 'fas fa-mars-stroke-v', 'fas fa-mask', 'fas fa-medal', 'fas fa-medkit', 'fas fa-meh', 'fas fa-meh-blank', 'fas fa-meh-rolling-eyes', 'fas fa-memory', 'fas fa-menorah', 'fas fa-mercury', 'fas fa-meteor', 'fas fa-microchip', 'fas fa-microphone', 'fas fa-microphone-alt', 'fas fa-microphone-alt-slash', 'fas fa-microphone-slash', 'fas fa-microscope', 'fas fa-minus', 'fas fa-minus-circle', 'fas fa-minus-square', 'fas fa-mitten', 'fas fa-mobile', 'fas fa-mobile-alt', 'fas fa-money-bill', 'fas fa-money-bill-alt', 'fas fa-money-bill-wave', 'fas fa-money-bill-wave-alt', 'fas fa-money-check', 'fas fa-money-check-alt', 'fas fa-monument', 'fas fa-moon', 'fas fa-mortar-pestle', 'fas fa-mosque', 'fas fa-motorcycle', 'fas fa-mountain', 'fas fa-mouse-pointer', 'fas fa-mug-hot', 'fas fa-music', 'fas fa-network-wired', 'fas fa-neuter', 'fas fa-newspaper', 'fas fa-not-equal', 'fas fa-notes-medical', 'fas fa-object-group', 'fas fa-object-ungroup', 'fas fa-oil-can', 'fas fa-om', 'fas fa-otter', 'fas fa-outdent', 'fas fa-pager', 'fas fa-paint-brush', 'fas fa-paint-roller', 'fas fa-palette', 'fas fa-pallet', 'fas fa-paper-plane', 'fas fa-paperclip', 'fas fa-parachute-box', 'fas fa-paragraph', 'fas fa-parking', 'fas fa-passport', 'fas fa-pastafarianism', 'fas fa-paste', 'fas fa-pause', 'fas fa-pause-circle', 'fas fa-paw', 'fas fa-peace', 'fas fa-pen', 'fas fa-pen-alt', 'fas fa-pen-fancy', 'fas fa-pen-nib', 'fas fa-pen-square', 'fas fa-pencil-alt', 'fas fa-pencil-ruler', 'fas fa-people-carry', 'fas fa-pepper-hot', 'fas fa-percent', 'fas fa-percentage', 'fas fa-person-booth', 'fas fa-phone', 'fas fa-phone-alt', 'fas fa-phone-slash', 'fas fa-phone-square', 'fas fa-phone-square-alt', 'fas fa-phone-volume', 'fas fa-photo-video', 'fas fa-piggy-bank', 'fas fa-pills', 'fas fa-pizza-slice', 'fas fa-place-of-worship', 'fas fa-plane', 'fas fa-plane-arrival', 'fas fa-plane-departure', 'fas fa-play', 'fas fa-play-circle', 'fas fa-plug', 'fas fa-plus', 'fas fa-plus-circle', 'fas fa-plus-square', 'fas fa-podcast', 'fas fa-poll', 'fas fa-poll-h', 'fas fa-poo', 'fas fa-poo-storm', 'fas fa-poop', 'fas fa-portrait', 'fas fa-pound-sign', 'fas fa-power-off', 'fas fa-pray', 'fas fa-praying-hands', 'fas fa-prescription', 'fas fa-prescription-bottle', 'fas fa-prescription-bottle-alt', 'fas fa-print', 'fas fa-procedures', 'fas fa-project-diagram', 'fas fa-puzzle-piece', 'fas fa-qrcode', 'fas fa-question', 'fas fa-question-circle', 'fas fa-quidditch', 'fas fa-quote-left', 'fas fa-quote-right', 'fas fa-quran', 'fas fa-radiation', 'fas fa-radiation-alt', 'fas fa-rainbow', 'fas fa-random', 'fas fa-receipt', 'fas fa-recycle', 'fas fa-redo', 'fas fa-redo-alt', 'fas fa-registered', 'fas fa-remove-format', 'fas fa-reply', 'fas fa-reply-all', 'fas fa-republican', 'fas fa-restroom', 'fas fa-retweet', 'fas fa-ribbon', 'fas fa-ring', 'fas fa-road', 'fas fa-robot', 'fas fa-rocket', 'fas fa-route', 'fas fa-rss', 'fas fa-rss-square', 'fas fa-ruble-sign', 'fas fa-ruler', 'fas fa-ruler-combined', 'fas fa-ruler-horizontal', 'fas fa-ruler-vertical', 'fas fa-running', 'fas fa-rupee-sign', 'fas fa-sad-cry', 'fas fa-sad-tear', 'fas fa-satellite', 'fas fa-satellite-dish', 'fas fa-save', 'fas fa-school', 'fas fa-screwdriver', 'fas fa-scroll', 'fas fa-sd-card', 'fas fa-search', 'fas fa-search-dollar', 'fas fa-search-location', 'fas fa-search-minus', 'fas fa-search-plus', 'fas fa-seedling', 'fas fa-server', 'fas fa-shapes', 'fas fa-share', 'fas fa-share-alt', 'fas fa-share-alt-square', 'fas fa-share-square', 'fas fa-shekel-sign', 'fas fa-shield-alt', 'fas fa-ship', 'fas fa-shipping-fast', 'fas fa-shoe-prints', 'fas fa-shopping-bag', 'fas fa-shopping-basket', 'fas fa-shopping-cart', 'fas fa-shower', 'fas fa-shuttle-van', 'fas fa-sign', 'fas fa-sign-in-alt', 'fas fa-sign-language', 'fas fa-sign-out-alt', 'fas fa-signal', 'fas fa-signature', 'fas fa-sim-card', 'fas fa-sitemap', 'fas fa-skating', 'fas fa-skiing', 'fas fa-skiing-nordic', 'fas fa-skull', 'fas fa-skull-crossbones', 'fas fa-slash', 'fas fa-sleigh', 'fas fa-sliders-h', 'fas fa-smile', 'fas fa-smile-beam', 'fas fa-smile-wink', 'fas fa-smog', 'fas fa-smoking', 'fas fa-smoking-ban', 'fas fa-sms', 'fas fa-snowboarding', 'fas fa-snowflake', 'fas fa-snowman', 'fas fa-snowplow', 'fas fa-socks', 'fas fa-solar-panel', 'fas fa-sort', 'fas fa-sort-alpha-down', 'fas fa-sort-alpha-down-alt', 'fas fa-sort-alpha-up', 'fas fa-sort-alpha-up-alt', 'fas fa-sort-amount-down', 'fas fa-sort-amount-down-alt', 'fas fa-sort-amount-up', 'fas fa-sort-amount-up-alt', 'fas fa-sort-down', 'fas fa-sort-numeric-down', 'fas fa-sort-numeric-down-alt', 'fas fa-sort-numeric-up', 'fas fa-sort-numeric-up-alt', 'fas fa-sort-up', 'fas fa-spa', 'fas fa-space-shuttle', 'fas fa-spell-check', 'fas fa-spider', 'fas fa-spinner', 'fas fa-splotch', 'fas fa-spray-can', 'fas fa-square', 'fas fa-square-full', 'fas fa-square-root-alt', 'fas fa-stamp', 'fas fa-star', 'fas fa-star-and-crescent', 'fas fa-star-half', 'fas fa-star-half-alt', 'fas fa-star-of-david', 'fas fa-star-of-life', 'fas fa-step-backward', 'fas fa-step-forward', 'fas fa-stethoscope', 'fas fa-sticky-note', 'fas fa-stop', 'fas fa-stop-circle', 'fas fa-stopwatch', 'fas fa-store', 'fas fa-store-alt', 'fas fa-stream', 'fas fa-street-view', 'fas fa-strikethrough', 'fas fa-stroopwafel', 'fas fa-subscript', 'fas fa-subway', 'fas fa-suitcase', 'fas fa-suitcase-rolling', 'fas fa-sun', 'fas fa-superscript', 'fas fa-surprise', 'fas fa-swatchbook', 'fas fa-swimmer', 'fas fa-swimming-pool', 'fas fa-synagogue', 'fas fa-sync', 'fas fa-sync-alt', 'fas fa-syringe', 'fas fa-table', 'fas fa-table-tennis', 'fas fa-tablet', 'fas fa-tablet-alt', 'fas fa-tablets', 'fas fa-tachometer-alt', 'fas fa-tag', 'fas fa-tags', 'fas fa-tape', 'fas fa-tasks', 'fas fa-taxi', 'fas fa-teeth', 'fas fa-teeth-open', 'fas fa-temperature-high', 'fas fa-temperature-low', 'fas fa-tenge', 'fas fa-terminal', 'fas fa-text-height', 'fas fa-text-width', 'fas fa-th', 'fas fa-th-large', 'fas fa-th-list', 'fas fa-theater-masks', 'fas fa-thermometer', 'fas fa-thermometer-empty', 'fas fa-thermometer-full', 'fas fa-thermometer-half', 'fas fa-thermometer-quarter', 'fas fa-thermometer-three-quarters', 'fas fa-thumbs-down', 'fas fa-thumbs-up', 'fas fa-thumbtack', 'fas fa-ticket-alt', 'fas fa-times', 'fas fa-times-circle', 'fas fa-tint', 'fas fa-tint-slash', 'fas fa-tired', 'fas fa-toggle-off', 'fas fa-toggle-on', 'fas fa-toilet', 'fas fa-toilet-paper', 'fas fa-toolbox', 'fas fa-tools', 'fas fa-tooth', 'fas fa-torah', 'fas fa-torii-gate', 'fas fa-tractor', 'fas fa-trademark', 'fas fa-traffic-light', 'fas fa-train', 'fas fa-tram', 'fas fa-transgender', 'fas fa-transgender-alt', 'fas fa-trash', 'fas fa-trash-alt', 'fas fa-trash-restore', 'fas fa-trash-restore-alt', 'fas fa-tree', 'fas fa-trophy', 'fas fa-truck', 'fas fa-truck-loading', 'fas fa-truck-monster', 'fas fa-truck-moving', 'fas fa-truck-pickup', 'fas fa-tshirt', 'fas fa-tty', 'fas fa-tv', 'fas fa-umbrella', 'fas fa-umbrella-beach', 'fas fa-underline', 'fas fa-undo', 'fas fa-undo-alt', 'fas fa-universal-access', 'fas fa-university', 'fas fa-unlink', 'fas fa-unlock', 'fas fa-unlock-alt', 'fas fa-upload', 'fas fa-user', 'fas fa-user-alt', 'fas fa-user-alt-slash', 'fas fa-user-astronaut', 'fas fa-user-check', 'fas fa-user-circle', 'fas fa-user-clock', 'fas fa-user-cog', 'fas fa-user-edit', 'fas fa-user-friends', 'fas fa-user-graduate', 'fas fa-user-injured', 'fas fa-user-lock', 'fas fa-user-md', 'fas fa-user-minus', 'fas fa-user-ninja', 'fas fa-user-nurse', 'fas fa-user-plus', 'fas fa-user-secret', 'fas fa-user-shield', 'fas fa-user-slash', 'fas fa-user-tag', 'fas fa-user-tie', 'fas fa-user-times', 'fas fa-users', 'fas fa-users-cog', 'fas fa-utensil-spoon', 'fas fa-utensils', 'fas fa-vector-square', 'fas fa-venus', 'fas fa-venus-double', 'fas fa-venus-mars', 'fas fa-vial', 'fas fa-vials', 'fas fa-video', 'fas fa-video-slash', 'fas fa-vihara', 'fas fa-voicemail', 'fas fa-volleyball-ball', 'fas fa-volume-down', 'fas fa-volume-mute', 'fas fa-volume-off', 'fas fa-volume-up', 'fas fa-vote-yea', 'fas fa-vr-cardboard', 'fas fa-walking', 'fas fa-wallet', 'fas fa-warehouse', 'fas fa-water', 'fas fa-wave-square', 'fas fa-weight', 'fas fa-weight-hanging', 'fas fa-wheelchair', 'fas fa-wifi', 'fas fa-wind', 'fas fa-window-close', 'fas fa-window-maximize', 'fas fa-window-minimize', 'fas fa-window-restore', 'fas fa-wine-bottle', 'fas fa-wine-glass', 'fas fa-wine-glass-alt', 'fas fa-won-sign', 'fas fa-wrench', 'fas fa-x-ray', 'fas fa-yen-sign', 'fas fa-yin-yang', 'fab fa-500px', 'fab fa-accessible-icon', 'fab fa-accusoft', 'fab fa-acquisitions-incorporated', 'fab fa-adn', 'fab fa-adobe', 'fab fa-adversal', 'fab fa-affiliatetheme', 'fab fa-airbnb', 'fab fa-algolia', 'fab fa-alipay', 'fab fa-amazon', 'fab fa-amazon-pay', 'fab fa-amilia', 'fab fa-android', 'fab fa-angellist', 'fab fa-angrycreative', 'fab fa-angular', 'fab fa-app-store', 'fab fa-app-store-ios', 'fab fa-apper', 'fab fa-apple', 'fab fa-apple-pay', 'fab fa-artstation', 'fab fa-asymmetrik', 'fab fa-atlassian', 'fab fa-audible', 'fab fa-autoprefixer', 'fab fa-avianex', 'fab fa-aviato', 'fab fa-aws', 'fab fa-bandcamp', 'fab fa-battle-net', 'fab fa-behance', 'fab fa-behance-square', 'fab fa-bimobject', 'fab fa-bitbucket', 'fab fa-bitcoin', 'fab fa-bity', 'fab fa-black-tie', 'fab fa-blackberry', 'fab fa-blogger', 'fab fa-blogger-b', 'fab fa-bluetooth', 'fab fa-bluetooth-b', 'fab fa-bootstrap', 'fab fa-btc', 'fab fa-buffer', 'fab fa-buromobelexperte', 'fab fa-canadian-maple-leaf', 'fab fa-cc-amazon-pay', 'fab fa-cc-amex', 'fab fa-cc-apple-pay', 'fab fa-cc-diners-club', 'fab fa-cc-discover', 'fab fa-cc-jcb', 'fab fa-cc-mastercard', 'fab fa-cc-paypal', 'fab fa-cc-stripe', 'fab fa-cc-visa', 'fab fa-centercode', 'fab fa-centos', 'fab fa-chrome', 'fab fa-chromecast', 'fab fa-cloudscale', 'fab fa-cloudsmith', 'fab fa-cloudversify', 'fab fa-codepen', 'fab fa-codiepie', 'fab fa-confluence', 'fab fa-connectdevelop', 'fab fa-contao', 'fab fa-cpanel', 'fab fa-creative-commons', 'fab fa-creative-commons-by', 'fab fa-creative-commons-nc', 'fab fa-creative-commons-nc-eu', 'fab fa-creative-commons-nc-jp', 'fab fa-creative-commons-nd', 'fab fa-creative-commons-pd', 'fab fa-creative-commons-pd-alt', 'fab fa-creative-commons-remix', 'fab fa-creative-commons-sa', 'fab fa-creative-commons-sampling', 'fab fa-creative-commons-sampling-plus', 'fab fa-creative-commons-share', 'fab fa-creative-commons-zero', 'fab fa-critical-role', 'fab fa-css3', 'fab fa-css3-alt', 'fab fa-cuttlefish', 'fab fa-d-and-d', 'fab fa-d-and-d-beyond', 'fab fa-dashcube', 'fab fa-delicious', 'fab fa-deploydog', 'fab fa-deskpro', 'fab fa-dev', 'fab fa-deviantart', 'fab fa-dhl', 'fab fa-diaspora', 'fab fa-digg', 'fab fa-digital-ocean', 'fab fa-discord', 'fab fa-discourse', 'fab fa-dochub', 'fab fa-docker', 'fab fa-draft2digital', 'fab fa-dribbble', 'fab fa-dribbble-square', 'fab fa-dropbox', 'fab fa-drupal', 'fab fa-dyalog', 'fab fa-earlybirds', 'fab fa-ebay', 'fab fa-edge', 'fab fa-elementor', 'fab fa-ello', 'fab fa-ember', 'fab fa-empire', 'fab fa-envira', 'fab fa-erlang', 'fab fa-ethereum', 'fab fa-etsy', 'fab fa-evernote', 'fab fa-expeditedssl', 'fab fa-facebook', 'fab fa-facebook-f', 'fab fa-facebook-messenger', 'fab fa-facebook-square', 'fab fa-fantasy-flight-games', 'fab fa-fedex', 'fab fa-fedora', 'fab fa-figma', 'fab fa-firefox', 'fab fa-first-order', 'fab fa-first-order-alt', 'fab fa-firstdraft', 'fab fa-flickr', 'fab fa-flipboard', 'fab fa-fly', 'fab fa-font-awesome', 'fab fa-font-awesome-alt', 'fab fa-font-awesome-flag', 'fab fa-fonticons', 'fab fa-fonticons-fi', 'fab fa-fort-awesome', 'fab fa-fort-awesome-alt', 'fab fa-forumbee', 'fab fa-foursquare', 'fab fa-free-code-camp', 'fab fa-freebsd', 'fab fa-fulcrum', 'fab fa-galactic-republic', 'fab fa-galactic-senate', 'fab fa-get-pocket', 'fab fa-gg', 'fab fa-gg-circle', 'fab fa-git', 'fab fa-git-alt', 'fab fa-git-square', 'fab fa-github', 'fab fa-github-alt', 'fab fa-github-square', 'fab fa-gitkraken', 'fab fa-gitlab', 'fab fa-gitter', 'fab fa-glide', 'fab fa-glide-g', 'fab fa-gofore', 'fab fa-goodreads', 'fab fa-goodreads-g', 'fab fa-google', 'fab fa-google-drive', 'fab fa-google-play', 'fab fa-google-plus', 'fab fa-google-plus-g', 'fab fa-google-plus-square', 'fab fa-google-wallet', 'fab fa-gratipay', 'fab fa-grav', 'fab fa-gripfire', 'fab fa-grunt', 'fab fa-gulp', 'fab fa-hacker-news', 'fab fa-hacker-news-square', 'fab fa-hackerrank', 'fab fa-hips', 'fab fa-hire-a-helper', 'fab fa-hooli', 'fab fa-hornbill', 'fab fa-hotjar', 'fab fa-houzz', 'fab fa-html5', 'fab fa-hubspot', 'fab fa-imdb', 'fab fa-instagram', 'fab fa-intercom', 'fab fa-internet-explorer', 'fab fa-invision', 'fab fa-ioxhost', 'fab fa-itch-io', 'fab fa-itunes', 'fab fa-itunes-note', 'fab fa-java', 'fab fa-jedi-order', 'fab fa-jenkins', 'fab fa-jira', 'fab fa-joget', 'fab fa-joomla', 'fab fa-js', 'fab fa-js-square', 'fab fa-jsfiddle', 'fab fa-kaggle', 'fab fa-keybase', 'fab fa-keycdn', 'fab fa-kickstarter', 'fab fa-kickstarter-k', 'fab fa-korvue', 'fab fa-laravel', 'fab fa-lastfm', 'fab fa-lastfm-square', 'fab fa-leanpub', 'fab fa-less', 'fab fa-line', 'fab fa-linkedin', 'fab fa-linkedin-in', 'fab fa-linode', 'fab fa-linux', 'fab fa-lyft', 'fab fa-magento', 'fab fa-mailchimp', 'fab fa-mandalorian', 'fab fa-markdown', 'fab fa-mastodon', 'fab fa-maxcdn', 'fab fa-medapps', 'fab fa-medium', 'fab fa-medium-m', 'fab fa-medrt', 'fab fa-meetup', 'fab fa-megaport', 'fab fa-mendeley', 'fab fa-microsoft', 'fab fa-mix', 'fab fa-mixcloud', 'fab fa-mizuni', 'fab fa-modx', 'fab fa-monero', 'fab fa-napster', 'fab fa-neos', 'fab fa-nimblr', 'fab fa-node', 'fab fa-node-js', 'fab fa-npm', 'fab fa-ns8', 'fab fa-nutritionix', 'fab fa-odnoklassniki', 'fab fa-odnoklassniki-square', 'fab fa-old-republic', 'fab fa-opencart', 'fab fa-openid', 'fab fa-opera', 'fab fa-optin-monster', 'fab fa-osi', 'fab fa-page4', 'fab fa-pagelines', 'fab fa-palfed', 'fab fa-patreon', 'fab fa-paypal', 'fab fa-penny-arcade', 'fab fa-periscope', 'fab fa-phabricator', 'fab fa-phoenix-framework', 'fab fa-phoenix-squadron', 'fab fa-php', 'fab fa-pied-piper', 'fab fa-pied-piper-alt', 'fab fa-pied-piper-hat', 'fab fa-pied-piper-pp', 'fab fa-pinterest', 'fab fa-pinterest-p', 'fab fa-pinterest-square', 'fab fa-playstation', 'fab fa-product-hunt', 'fab fa-pushed', 'fab fa-python', 'fab fa-qq', 'fab fa-quinscape', 'fab fa-quora', 'fab fa-r-project', 'fab fa-raspberry-pi', 'fab fa-ravelry', 'fab fa-react', 'fab fa-reacteurope', 'fab fa-readme', 'fab fa-rebel', 'fab fa-red-river', 'fab fa-reddit', 'fab fa-reddit-alien', 'fab fa-reddit-square', 'fab fa-redhat', 'fab fa-renren', 'fab fa-replyd', 'fab fa-researchgate', 'fab fa-resolving', 'fab fa-rev', 'fab fa-rocketchat', 'fab fa-rockrms', 'fab fa-safari', 'fab fa-salesforce', 'fab fa-sass', 'fab fa-schlix', 'fab fa-scribd', 'fab fa-searchengin', 'fab fa-sellcast', 'fab fa-sellsy', 'fab fa-servicestack', 'fab fa-shirtsinbulk', 'fab fa-shopware', 'fab fa-simplybuilt', 'fab fa-sistrix', 'fab fa-sith', 'fab fa-sketch', 'fab fa-skyatlas', 'fab fa-skype', 'fab fa-slack', 'fab fa-slack-hash', 'fab fa-slideshare', 'fab fa-snapchat', 'fab fa-snapchat-ghost', 'fab fa-snapchat-square', 'fab fa-soundcloud', 'fab fa-sourcetree', 'fab fa-speakap', 'fab fa-speaker-deck', 'fab fa-spotify', 'fab fa-squarespace', 'fab fa-stack-exchange', 'fab fa-stack-overflow', 'fab fa-stackpath', 'fab fa-staylinked', 'fab fa-steam', 'fab fa-steam-square', 'fab fa-steam-symbol', 'fab fa-sticker-mule', 'fab fa-strava', 'fab fa-stripe', 'fab fa-stripe-s', 'fab fa-studiovinari', 'fab fa-stumbleupon', 'fab fa-stumbleupon-circle', 'fab fa-superpowers', 'fab fa-supple', 'fab fa-suse', 'fab fa-symfony', 'fab fa-teamspeak', 'fab fa-telegram', 'fab fa-telegram-plane', 'fab fa-tencent-weibo', 'fab fa-the-red-yeti', 'fab fa-themeco', 'fab fa-themeisle', 'fab fa-think-peaks', 'fab fa-trade-federation', 'fab fa-trello', 'fab fa-tripadvisor', 'fab fa-tumblr', 'fab fa-tumblr-square', 'fab fa-twitch', 'fab fa-twitter', 'fab fa-twitter-square', 'fab fa-typo3', 'fab fa-uber', 'fab fa-ubuntu', 'fab fa-uikit', 'fab fa-uniregistry', 'fab fa-untappd', 'fab fa-ups', 'fab fa-usb', 'fab fa-usps', 'fab fa-ussunnah', 'fab fa-vaadin', 'fab fa-viacoin', 'fab fa-viadeo', 'fab fa-viadeo-square', 'fab fa-viber', 'fab fa-vimeo', 'fab fa-vimeo-square', 'fab fa-vimeo-v', 'fab fa-vine', 'fab fa-vk', 'fab fa-vnv', 'fab fa-vuejs', 'fab fa-waze', 'fab fa-weebly', 'fab fa-weibo', 'fab fa-weixin', 'fab fa-whatsapp', 'fab fa-whatsapp-square', 'fab fa-whmcs', 'fab fa-wikipedia-w', 'fab fa-windows', 'fab fa-wix', 'fab fa-wizards-of-the-coast', 'fab fa-wolf-pack-battalion', 'fab fa-wordpress', 'fab fa-wordpress-simple', 'fab fa-wpbeginner', 'fab fa-wpexplorer', 'fab fa-wpforms', 'fab fa-wpressr', 'fab fa-xbox', 'fab fa-xing', 'fab fa-xing-square', 'fab fa-y-combinator', 'fab fa-yahoo', 'fab fa-yammer', 'fab fa-yandex', 'fab fa-yandex-international', 'fab fa-yarn', 'fab fa-yelp', 'fab fa-yoast', 'fab fa-youtube', 'fab fa-youtube-square', 'fab fa-zhihu' );
		
		} else {
		
			$output = array( '', 'fa fa-lg fa-500px', 'fa fa-lg fa-adjust', 'fa fa-lg fa-adn', 'fa fa-lg fa-align-center', 'fa fa-lg fa-align-justify', 'fa fa-lg fa-align-left', 'fa fa-lg fa-align-right', 'fa fa-lg fa-amazon', 'fa fa-lg fa-ambulance', 'fa fa-lg fa-american-sign-language-interpreting', 'fa fa-lg fa-anchor', 'fa fa-lg fa-android', 'fa fa-lg fa-angellist', 'fa fa-lg fa-angle-double-down', 'fa fa-lg fa-angle-double-left', 'fa fa-lg fa-angle-double-right', 'fa fa-lg fa-angle-double-up', 'fa fa-lg fa-angle-down', 'fa fa-lg fa-angle-left', 'fa fa-lg fa-angle-right', 'fa fa-lg fa-angle-up', 'fa fa-lg fa-apple', 'fa fa-lg fa-archive', 'fa fa-lg fa-area-chart', 'fa fa-lg fa-arrow-circle-down', 'fa fa-lg fa-arrow-circle-left', 'fa fa-lg fa-arrow-circle-o-down', 'fa fa-lg fa-arrow-circle-o-left', 'fa fa-lg fa-arrow-circle-o-right', 'fa fa-lg fa-arrow-circle-o-up', 'fa fa-lg fa-arrow-circle-right', 'fa fa-lg fa-arrow-circle-up', 'fa fa-lg fa-arrow-down', 'fa fa-lg fa-arrow-left', 'fa fa-lg fa-arrow-right', 'fa fa-lg fa-arrow-up', 'fa fa-lg fa-arrows', 'fa fa-lg fa-arrows-alt', 'fa fa-lg fa-arrows-h', 'fa fa-lg fa-arrows-v', 'fa fa-lg fa-asl-interpreting', 'fa fa-lg fa-assistive-listening-systems', 'fa fa-lg fa-asterisk', 'fa fa-lg fa-at', 'fa fa-lg fa-audio-description', 'fa fa-lg fa-automobile', 'fa fa-lg fa-backward', 'fa fa-lg fa-balance-scale', 'fa fa-lg fa-ban', 'fa fa-lg fa-bank', 'fa fa-lg fa-bar-chart', 'fa fa-lg fa-bar-chart-o', 'fa fa-lg fa-barcode', 'fa fa-lg fa-bars', 'fa fa-lg fa-battery-0', 'fa fa-lg fa-battery-1', 'fa fa-lg fa-battery-2', 'fa fa-lg fa-battery-3', 'fa fa-lg fa-battery-4', 'fa fa-lg fa-battery-empty', 'fa fa-lg fa-battery-full', 'fa fa-lg fa-battery-half', 'fa fa-lg fa-battery-quarter', 'fa fa-lg fa-battery-three-quarters', 'fa fa-lg fa-bed', 'fa fa-lg fa-beer', 'fa fa-lg fa-behance', 'fa fa-lg fa-behance-square', 'fa fa-lg fa-bell', 'fa fa-lg fa-bell-o', 'fa fa-lg fa-bell-slash', 'fa fa-lg fa-bell-slash-o', 'fa fa-lg fa-bicycle', 'fa fa-lg fa-binoculars', 'fa fa-lg fa-birthday-cake', 'fa fa-lg fa-bitbucket', 'fa fa-lg fa-bitbucket-square', 'fa fa-lg fa-bitcoin', 'fa fa-lg fa-black-tie', 'fa fa-lg fa-blind', 'fa fa-lg fa-bluetooth', 'fa fa-lg fa-bluetooth-b', 'fa fa-lg fa-bold', 'fa fa-lg fa-bolt', 'fa fa-lg fa-bomb', 'fa fa-lg fa-book', 'fa fa-lg fa-bookmark', 'fa fa-lg fa-bookmark-o', 'fa fa-lg fa-braille', 'fa fa-lg fa-briefcase', 'fa fa-lg fa-btc', 'fa fa-lg fa-bug', 'fa fa-lg fa-building', 'fa fa-lg fa-building-o', 'fa fa-lg fa-bullhorn', 'fa fa-lg fa-bullseye', 'fa fa-lg fa-bus', 'fa fa-lg fa-buysellads', 'fa fa-lg fa-cab', 'fa fa-lg fa-calculator', 'fa fa-lg fa-calendar', 'fa fa-lg fa-calendar-check-o', 'fa fa-lg fa-calendar-minus-o', 'fa fa-lg fa-calendar-o', 'fa fa-lg fa-calendar-plus-o', 'fa fa-lg fa-calendar-times-o', 'fa fa-lg fa-camera', 'fa fa-lg fa-camera-retro', 'fa fa-lg fa-car', 'fa fa-lg fa-caret-down', 'fa fa-lg fa-caret-left', 'fa fa-lg fa-caret-right', 'fa fa-lg fa-caret-square-o-down', 'fa fa-lg fa-caret-square-o-left', 'fa fa-lg fa-caret-square-o-right', 'fa fa-lg fa-caret-square-o-up', 'fa fa-lg fa-caret-up', 'fa fa-lg fa-cart-arrow-down', 'fa fa-lg fa-cart-plus', 'fa fa-lg fa-cc', 'fa fa-lg fa-cc-amex', 'fa fa-lg fa-cc-diners-club', 'fa fa-lg fa-cc-discover', 'fa fa-lg fa-cc-jcb', 'fa fa-lg fa-cc-mastercard', 'fa fa-lg fa-cc-paypal', 'fa fa-lg fa-cc-stripe', 'fa fa-lg fa-cc-visa', 'fa fa-lg fa-certificate', 'fa fa-lg fa-chain', 'fa fa-lg fa-chain-broken', 'fa fa-lg fa-check', 'fa fa-lg fa-check-circle', 'fa fa-lg fa-check-circle-o', 'fa fa-lg fa-check-square', 'fa fa-lg fa-check-square-o', 'fa fa-lg fa-chevron-circle-down', 'fa fa-lg fa-chevron-circle-left', 'fa fa-lg fa-chevron-circle-right', 'fa fa-lg fa-chevron-circle-up', 'fa fa-lg fa-chevron-down', 'fa fa-lg fa-chevron-left', 'fa fa-lg fa-chevron-right', 'fa fa-lg fa-chevron-up', 'fa fa-lg fa-child', 'fa fa-lg fa-chrome', 'fa fa-lg fa-circle', 'fa fa-lg fa-circle-o', 'fa fa-lg fa-circle-o-notch', 'fa fa-lg fa-circle-thin', 'fa fa-lg fa-clipboard', 'fa fa-lg fa-clock-o', 'fa fa-lg fa-clone', 'fa fa-lg fa-close', 'fa fa-lg fa-cloud', 'fa fa-lg fa-cloud-download', 'fa fa-lg fa-cloud-upload', 'fa fa-lg fa-cny', 'fa fa-lg fa-code', 'fa fa-lg fa-code-fork', 'fa fa-lg fa-codepen', 'fa fa-lg fa-codiepie', 'fa fa-lg fa-coffee', 'fa fa-lg fa-cog', 'fa fa-lg fa-cogs', 'fa fa-lg fa-columns', 'fa fa-lg fa-comment', 'fa fa-lg fa-comment-o', 'fa fa-lg fa-commenting', 'fa fa-lg fa-commenting-o', 'fa fa-lg fa-comments', 'fa fa-lg fa-comments-o', 'fa fa-lg fa-compass', 'fa fa-lg fa-compress', 'fa fa-lg fa-connectdevelop', 'fa fa-lg fa-contao', 'fa fa-lg fa-copy', 'fa fa-lg fa-copyright', 'fa fa-lg fa-creative-commons', 'fa fa-lg fa-credit-card', 'fa fa-lg fa-credit-card-alt', 'fa fa-lg fa-crop', 'fa fa-lg fa-crosshairs', 'fa fa-lg fa-css3', 'fa fa-lg fa-cube', 'fa fa-lg fa-cubes', 'fa fa-lg fa-cut', 'fa fa-lg fa-cutlery', 'fa fa-lg fa-dashboard', 'fa fa-lg fa-dashcube', 'fa fa-lg fa-database', 'fa fa-lg fa-deaf', 'fa fa-lg fa-deafness', 'fa fa-lg fa-dedent', 'fa fa-lg fa-delicious', 'fa fa-lg fa-desktop', 'fa fa-lg fa-deviantart', 'fa fa-lg fa-diamond', 'fa fa-lg fa-digg', 'fa fa-lg fa-dollar', 'fa fa-lg fa-dot-circle-o', 'fa fa-lg fa-download', 'fa fa-lg fa-dribbble', 'fa fa-lg fa-dropbox', 'fa fa-lg fa-drupal', 'fa fa-lg fa-edge', 'fa fa-lg fa-edit', 'fa fa-lg fa-eject', 'fa fa-lg fa-ellipsis-h', 'fa fa-lg fa-ellipsis-v', 'fa fa-lg fa-empire', 'fa fa-lg fa-envelope', 'fa fa-lg fa-envelope-o', 'fa fa-lg fa-envelope-square', 'fa fa-lg fa-envira', 'fa fa-lg fa-eraser', 'fa fa-lg fa-eur', 'fa fa-lg fa-euro', 'fa fa-lg fa-exchange', 'fa fa-lg fa-exclamation', 'fa fa-lg fa-exclamation-circle', 'fa fa-lg fa-exclamation-triangle', 'fa fa-lg fa-expand', 'fa fa-lg fa-expeditedssl', 'fa fa-lg fa-external-link', 'fa fa-lg fa-external-link-square', 'fa fa-lg fa-eye', 'fa fa-lg fa-eye-slash', 'fa fa-lg fa-eyedropper', 'fa fa-lg fa-fa', 'fa fa-lg fa-facebook', 'fa fa-lg fa-facebook-f', 'fa fa-lg fa-facebook-official', 'fa fa-lg fa-facebook-square', 'fa fa-lg fa-fast-backward', 'fa fa-lg fa-fast-forward', 'fa fa-lg fa-fax', 'fa fa-lg fa-feed', 'fa fa-lg fa-female', 'fa fa-lg fa-fighter-jet', 'fa fa-lg fa-file', 'fa fa-lg fa-file-archive-o', 'fa fa-lg fa-file-audio-o', 'fa fa-lg fa-file-code-o', 'fa fa-lg fa-file-excel-o', 'fa fa-lg fa-file-image-o', 'fa fa-lg fa-file-movie-o', 'fa fa-lg fa-file-o', 'fa fa-lg fa-file-pdf-o', 'fa fa-lg fa-file-photo-o', 'fa fa-lg fa-file-picture-o', 'fa fa-lg fa-file-powerpoint-o', 'fa fa-lg fa-file-sound-o', 'fa fa-lg fa-file-text', 'fa fa-lg fa-file-text-o', 'fa fa-lg fa-file-video-o', 'fa fa-lg fa-file-word-o', 'fa fa-lg fa-file-zip-o', 'fa fa-lg fa-files-o', 'fa fa-lg fa-film', 'fa fa-lg fa-filter', 'fa fa-lg fa-fire', 'fa fa-lg fa-fire-extinguisher', 'fa fa-lg fa-firefox', 'fa fa-lg fa-first-order', 'fa fa-lg fa-flag', 'fa fa-lg fa-flag-checkered', 'fa fa-lg fa-flag-o', 'fa fa-lg fa-flash', 'fa fa-lg fa-flask', 'fa fa-lg fa-flickr', 'fa fa-lg fa-floppy-o', 'fa fa-lg fa-folder', 'fa fa-lg fa-folder-o', 'fa fa-lg fa-folder-open', 'fa fa-lg fa-folder-open-o', 'fa fa-lg fa-font', 'fa fa-lg fa-font-awesome', 'fa fa-lg fa-fonticons', 'fa fa-lg fa-fort-awesome', 'fa fa-lg fa-forumbee', 'fa fa-lg fa-forward', 'fa fa-lg fa-foursquare', 'fa fa-lg fa-frown-o', 'fa fa-lg fa-futbol-o', 'fa fa-lg fa-gamepad', 'fa fa-lg fa-gavel', 'fa fa-lg fa-gbp', 'fa fa-lg fa-ge', 'fa fa-lg fa-gear', 'fa fa-lg fa-gears', 'fa fa-lg fa-genderless', 'fa fa-lg fa-get-pocket', 'fa fa-lg fa-gg', 'fa fa-lg fa-gg-circle', 'fa fa-lg fa-gift', 'fa fa-lg fa-git', 'fa fa-lg fa-git-square', 'fa fa-lg fa-github', 'fa fa-lg fa-github-alt', 'fa fa-lg fa-github-square', 'fa fa-lg fa-gitlab', 'fa fa-lg fa-gittip', 'fa fa-lg fa-glass', 'fa fa-lg fa-glide', 'fa fa-lg fa-glide-g', 'fa fa-lg fa-globe', 'fa fa-lg fa-google', 'fa fa-lg fa-google-plus', 'fa fa-lg fa-google-plus-circle', 'fa fa-lg fa-google-plus-official', 'fa fa-lg fa-google-plus-square', 'fa fa-lg fa-google-wallet', 'fa fa-lg fa-graduation-cap', 'fa fa-lg fa-gratipay', 'fa fa-lg fa-group', 'fa fa-lg fa-h-square', 'fa fa-lg fa-hacker-news', 'fa fa-lg fa-hand-grab-o', 'fa fa-lg fa-hand-lizard-o', 'fa fa-lg fa-hand-o-down', 'fa fa-lg fa-hand-o-left', 'fa fa-lg fa-hand-o-right', 'fa fa-lg fa-hand-o-up', 'fa fa-lg fa-hand-paper-o', 'fa fa-lg fa-hand-peace-o', 'fa fa-lg fa-hand-pointer-o', 'fa fa-lg fa-hand-rock-o', 'fa fa-lg fa-hand-scissors-o', 'fa fa-lg fa-hand-spock-o', 'fa fa-lg fa-hand-stop-o', 'fa fa-lg fa-hard-of-hearing', 'fa fa-lg fa-hashtag', 'fa fa-lg fa-hdd-o', 'fa fa-lg fa-header', 'fa fa-lg fa-headphones', 'fa fa-lg fa-heart', 'fa fa-lg fa-heart-o', 'fa fa-lg fa-heartbeat', 'fa fa-lg fa-history', 'fa fa-lg fa-home', 'fa fa-lg fa-hospital-o', 'fa fa-lg fa-hotel', 'fa fa-lg fa-hourglass', 'fa fa-lg fa-hourglass-1', 'fa fa-lg fa-hourglass-2', 'fa fa-lg fa-hourglass-3', 'fa fa-lg fa-hourglass-end', 'fa fa-lg fa-hourglass-half', 'fa fa-lg fa-hourglass-o', 'fa fa-lg fa-hourglass-start', 'fa fa-lg fa-houzz', 'fa fa-lg fa-html5', 'fa fa-lg fa-i-cursor', 'fa fa-lg fa-ils', 'fa fa-lg fa-image', 'fa fa-lg fa-inbox', 'fa fa-lg fa-indent', 'fa fa-lg fa-industry', 'fa fa-lg fa-info', 'fa fa-lg fa-info-circle', 'fa fa-lg fa-inr', 'fa fa-lg fa-instagram', 'fa fa-lg fa-institution', 'fa fa-lg fa-internet-explorer', 'fa fa-lg fa-intersex', 'fa fa-lg fa-ioxhost', 'fa fa-lg fa-italic', 'fa fa-lg fa-joomla', 'fa fa-lg fa-jpy', 'fa fa-lg fa-jsfiddle', 'fa fa-lg fa-key', 'fa fa-lg fa-keyboard-o', 'fa fa-lg fa-krw', 'fa fa-lg fa-language', 'fa fa-lg fa-laptop', 'fa fa-lg fa-lastfm', 'fa fa-lg fa-lastfm-square', 'fa fa-lg fa-leaf', 'fa fa-lg fa-leanpub', 'fa fa-lg fa-legal', 'fa fa-lg fa-lemon-o', 'fa fa-lg fa-level-down', 'fa fa-lg fa-level-up', 'fa fa-lg fa-life-bouy', 'fa fa-lg fa-life-buoy', 'fa fa-lg fa-life-ring', 'fa fa-lg fa-life-saver', 'fa fa-lg fa-lightbulb-o', 'fa fa-lg fa-line-chart', 'fa fa-lg fa-link', 'fa fa-lg fa-linkedin', 'fa fa-lg fa-linkedin-square', 'fa fa-lg fa-linux', 'fa fa-lg fa-list', 'fa fa-lg fa-list-alt', 'fa fa-lg fa-list-ol', 'fa fa-lg fa-list-ul', 'fa fa-lg fa-location-arrow', 'fa fa-lg fa-lock', 'fa fa-lg fa-long-arrow-down', 'fa fa-lg fa-long-arrow-left', 'fa fa-lg fa-long-arrow-right', 'fa fa-lg fa-long-arrow-up', 'fa fa-lg fa-low-vision', 'fa fa-lg fa-magic', 'fa fa-lg fa-magnet', 'fa fa-lg fa-mail-forward', 'fa fa-lg fa-mail-reply', 'fa fa-lg fa-mail-reply-all', 'fa fa-lg fa-male', 'fa fa-lg fa-map', 'fa fa-lg fa-map-marker', 'fa fa-lg fa-map-o', 'fa fa-lg fa-map-pin', 'fa fa-lg fa-map-signs', 'fa fa-lg fa-mars', 'fa fa-lg fa-mars-double', 'fa fa-lg fa-mars-stroke', 'fa fa-lg fa-mars-stroke-h', 'fa fa-lg fa-mars-stroke-v', 'fa fa-lg fa-maxcdn', 'fa fa-lg fa-meanpath', 'fa fa-lg fa-medium', 'fa fa-lg fa-medkit', 'fa fa-lg fa-meh-o', 'fa fa-lg fa-mercury', 'fa fa-lg fa-microphone', 'fa fa-lg fa-microphone-slash', 'fa fa-lg fa-minus', 'fa fa-lg fa-minus-circle', 'fa fa-lg fa-minus-square', 'fa fa-lg fa-minus-square-o', 'fa fa-lg fa-mixcloud', 'fa fa-lg fa-mobile', 'fa fa-lg fa-mobile-phone', 'fa fa-lg fa-modx', 'fa fa-lg fa-money', 'fa fa-lg fa-moon-o', 'fa fa-lg fa-mortar-board', 'fa fa-lg fa-motorcycle', 'fa fa-lg fa-mouse-pointer', 'fa fa-lg fa-music', 'fa fa-lg fa-navicon', 'fa fa-lg fa-neuter', 'fa fa-lg fa-newspaper-o', 'fa fa-lg fa-object-group', 'fa fa-lg fa-object-ungroup', 'fa fa-lg fa-odnoklassniki', 'fa fa-lg fa-odnoklassniki-square', 'fa fa-lg fa-opencart', 'fa fa-lg fa-openid', 'fa fa-lg fa-opera', 'fa fa-lg fa-optin-monster', 'fa fa-lg fa-outdent', 'fa fa-lg fa-pagelines', 'fa fa-lg fa-paint-brush', 'fa fa-lg fa-paper-plane', 'fa fa-lg fa-paper-plane-o', 'fa fa-lg fa-paperclip', 'fa fa-lg fa-paragraph', 'fa fa-lg fa-paste', 'fa fa-lg fa-pause', 'fa fa-lg fa-pause-circle', 'fa fa-lg fa-pause-circle-o', 'fa fa-lg fa-paw', 'fa fa-lg fa-paypal', 'fa fa-lg fa-pencil', 'fa fa-lg fa-pencil-square', 'fa fa-lg fa-pencil-square-o', 'fa fa-lg fa-percent', 'fa fa-lg fa-phone', 'fa fa-lg fa-phone-square', 'fa fa-lg fa-photo', 'fa fa-lg fa-picture-o', 'fa fa-lg fa-pie-chart', 'fa fa-lg fa-pied-piper', 'fa fa-lg fa-pied-piper-alt', 'fa fa-lg fa-pied-piper-pp', 'fa fa-lg fa-pinterest', 'fa fa-lg fa-pinterest-p', 'fa fa-lg fa-pinterest-square', 'fa fa-lg fa-plane', 'fa fa-lg fa-play', 'fa fa-lg fa-play-circle', 'fa fa-lg fa-play-circle-o', 'fa fa-lg fa-plug', 'fa fa-lg fa-plus', 'fa fa-lg fa-plus-circle', 'fa fa-lg fa-plus-square', 'fa fa-lg fa-plus-square-o', 'fa fa-lg fa-power-off', 'fa fa-lg fa-print', 'fa fa-lg fa-product-hunt', 'fa fa-lg fa-puzzle-piece', 'fa fa-lg fa-qq', 'fa fa-lg fa-qrcode', 'fa fa-lg fa-question', 'fa fa-lg fa-question-circle', 'fa fa-lg fa-question-circle-o', 'fa fa-lg fa-quote-left', 'fa fa-lg fa-quote-right', 'fa fa-lg fa-ra', 'fa fa-lg fa-random', 'fa fa-lg fa-rebel', 'fa fa-lg fa-recycle', 'fa fa-lg fa-reddit', 'fa fa-lg fa-reddit-alien', 'fa fa-lg fa-reddit-square', 'fa fa-lg fa-refresh', 'fa fa-lg fa-registered', 'fa fa-lg fa-remove', 'fa fa-lg fa-renren', 'fa fa-lg fa-reorder', 'fa fa-lg fa-repeat', 'fa fa-lg fa-reply', 'fa fa-lg fa-reply-all', 'fa fa-lg fa-resistance', 'fa fa-lg fa-retweet', 'fa fa-lg fa-rmb', 'fa fa-lg fa-road', 'fa fa-lg fa-rocket', 'fa fa-lg fa-rotate-left', 'fa fa-lg fa-rotate-right', 'fa fa-lg fa-rouble', 'fa fa-lg fa-rss', 'fa fa-lg fa-rss-square', 'fa fa-lg fa-rub', 'fa fa-lg fa-ruble', 'fa fa-lg fa-rupee', 'fa fa-lg fa-safari', 'fa fa-lg fa-save', 'fa fa-lg fa-scissors', 'fa fa-lg fa-scribd', 'fa fa-lg fa-search', 'fa fa-lg fa-search-minus', 'fa fa-lg fa-search-plus', 'fa fa-lg fa-sellsy', 'fa fa-lg fa-send', 'fa fa-lg fa-send-o', 'fa fa-lg fa-server', 'fa fa-lg fa-share', 'fa fa-lg fa-share-alt', 'fa fa-lg fa-share-alt-square', 'fa fa-lg fa-share-square', 'fa fa-lg fa-share-square-o', 'fa fa-lg fa-shekel', 'fa fa-lg fa-sheqel', 'fa fa-lg fa-shield', 'fa fa-lg fa-ship', 'fa fa-lg fa-shirtsinbulk', 'fa fa-lg fa-shopping-bag', 'fa fa-lg fa-shopping-basket', 'fa fa-lg fa-shopping-cart', 'fa fa-lg fa-sign-in', 'fa fa-lg fa-sign-language', 'fa fa-lg fa-sign-out', 'fa fa-lg fa-signal', 'fa fa-lg fa-signing', 'fa fa-lg fa-simplybuilt', 'fa fa-lg fa-sitemap', 'fa fa-lg fa-skyatlas', 'fa fa-lg fa-skype', 'fa fa-lg fa-slack', 'fa fa-lg fa-sliders', 'fa fa-lg fa-slideshare', 'fa fa-lg fa-smile-o', 'fa fa-lg fa-snapchat', 'fa fa-lg fa-snapchat-ghost', 'fa fa-lg fa-snapchat-square', 'fa fa-lg fa-soccer-ball-o', 'fa fa-lg fa-sort', 'fa fa-lg fa-sort-alpha-asc', 'fa fa-lg fa-sort-alpha-desc', 'fa fa-lg fa-sort-amount-asc', 'fa fa-lg fa-sort-amount-desc', 'fa fa-lg fa-sort-asc', 'fa fa-lg fa-sort-desc', 'fa fa-lg fa-sort-down', 'fa fa-lg fa-sort-numeric-asc', 'fa fa-lg fa-sort-numeric-desc', 'fa fa-lg fa-sort-up', 'fa fa-lg fa-soundcloud', 'fa fa-lg fa-space-shuttle', 'fa fa-lg fa-spinner', 'fa fa-lg fa-spoon', 'fa fa-lg fa-spotify', 'fa fa-lg fa-square', 'fa fa-lg fa-square-o', 'fa fa-lg fa-stack-exchange', 'fa fa-lg fa-stack-overflow', 'fa fa-lg fa-star', 'fa fa-lg fa-star-half', 'fa fa-lg fa-star-half-empty', 'fa fa-lg fa-star-half-full', 'fa fa-lg fa-star-half-o', 'fa fa-lg fa-star-o', 'fa fa-lg fa-steam', 'fa fa-lg fa-steam-square', 'fa fa-lg fa-step-backward', 'fa fa-lg fa-step-forward', 'fa fa-lg fa-stethoscope', 'fa fa-lg fa-sticky-note', 'fa fa-lg fa-sticky-note-o', 'fa fa-lg fa-stop', 'fa fa-lg fa-stop-circle', 'fa fa-lg fa-stop-circle-o', 'fa fa-lg fa-street-view', 'fa fa-lg fa-strikethrough', 'fa fa-lg fa-stumbleupon', 'fa fa-lg fa-stumbleupon-circle', 'fa fa-lg fa-subscript', 'fa fa-lg fa-subway', 'fa fa-lg fa-suitcase', 'fa fa-lg fa-sun-o', 'fa fa-lg fa-superscript', 'fa fa-lg fa-support', 'fa fa-lg fa-table', 'fa fa-lg fa-tablet', 'fa fa-lg fa-tachometer', 'fa fa-lg fa-tag', 'fa fa-lg fa-tags', 'fa fa-lg fa-tasks', 'fa fa-lg fa-taxi', 'fa fa-lg fa-television', 'fa fa-lg fa-tencent-weibo', 'fa fa-lg fa-terminal', 'fa fa-lg fa-text-height', 'fa fa-lg fa-text-width', 'fa fa-lg fa-th', 'fa fa-lg fa-th-large', 'fa fa-lg fa-th-list', 'fa fa-lg fa-themeisle', 'fa fa-lg fa-thumb-tack', 'fa fa-lg fa-thumbs-down', 'fa fa-lg fa-thumbs-o-down', 'fa fa-lg fa-thumbs-o-up', 'fa fa-lg fa-thumbs-up', 'fa fa-lg fa-ticket', 'fa fa-lg fa-times', 'fa fa-lg fa-times-circle', 'fa fa-lg fa-times-circle-o', 'fa fa-lg fa-tint', 'fa fa-lg fa-toggle-down', 'fa fa-lg fa-toggle-left', 'fa fa-lg fa-toggle-off', 'fa fa-lg fa-toggle-on', 'fa fa-lg fa-toggle-right', 'fa fa-lg fa-toggle-up', 'fa fa-lg fa-trademark', 'fa fa-lg fa-train', 'fa fa-lg fa-transgender', 'fa fa-lg fa-transgender-alt', 'fa fa-lg fa-trash', 'fa fa-lg fa-trash-o', 'fa fa-lg fa-tree', 'fa fa-lg fa-trello', 'fa fa-lg fa-tripadvisor', 'fa fa-lg fa-trophy', 'fa fa-lg fa-truck', 'fa fa-lg fa-try', 'fa fa-lg fa-tty', 'fa fa-lg fa-tumblr', 'fa fa-lg fa-tumblr-square', 'fa fa-lg fa-turkish-lira', 'fa fa-lg fa-tv', 'fa fa-lg fa-twitch', 'fa fa-lg fa-twitter', 'fa fa-lg fa-twitter-square', 'fa fa-lg fa-umbrella', 'fa fa-lg fa-underline', 'fa fa-lg fa-undo', 'fa fa-lg fa-universal-access', 'fa fa-lg fa-university', 'fa fa-lg fa-unlink', 'fa fa-lg fa-unlock', 'fa fa-lg fa-unlock-alt', 'fa fa-lg fa-unsorted', 'fa fa-lg fa-upload', 'fa fa-lg fa-usb', 'fa fa-lg fa-usd', 'fa fa-lg fa-user', 'fa fa-lg fa-user-md', 'fa fa-lg fa-user-plus', 'fa fa-lg fa-user-secret', 'fa fa-lg fa-user-times', 'fa fa-lg fa-users', 'fa fa-lg fa-venus', 'fa fa-lg fa-venus-double', 'fa fa-lg fa-venus-mars', 'fa fa-lg fa-viacoin', 'fa fa-lg fa-viadeo', 'fa fa-lg fa-viadeo-square', 'fa fa-lg fa-video-camera', 'fa fa-lg fa-vimeo', 'fa fa-lg fa-vimeo-square', 'fa fa-lg fa-vine', 'fa fa-lg fa-vk', 'fa fa-lg fa-volume-control-phone', 'fa fa-lg fa-volume-down', 'fa fa-lg fa-volume-off', 'fa fa-lg fa-volume-up', 'fa fa-lg fa-warning', 'fa fa-lg fa-wechat', 'fa fa-lg fa-weibo', 'fa fa-lg fa-weixin', 'fa fa-lg fa-whatsapp', 'fa fa-lg fa-wheelchair', 'fa fa-lg fa-wheelchair-alt', 'fa fa-lg fa-wifi', 'fa fa-lg fa-wikipedia-w', 'fa fa-lg fa-windows', 'fa fa-lg fa-won', 'fa fa-lg fa-wordpress', 'fa fa-lg fa-wpbeginner', 'fa fa-lg fa-wpforms', 'fa fa-lg fa-wrench', 'fa fa-lg fa-xing', 'fa fa-lg fa-xing-square', 'fa fa-lg fa-y-combinator', 'fa fa-lg fa-y-combinator-square', 'fa fa-lg fa-yahoo', 'fa fa-lg fa-yc', 'fa fa-lg fa-yc-square', 'fa fa-lg fa-yelp', 'fa fa-lg fa-yen', 'fa fa-lg fa-yoast', 'fa fa-lg fa-youtube', 'fa fa-lg fa-youtube-play', 'fa fa-lg fa-youtube-square' );
			
		}		
		
		return apply_filters( 'ghostpool_icons', $output );
				
	}
}