<?php if ( ! class_exists( 'GPUR_Framework_Global' ) ) {
	class GPUR_Framework_Global {

		private $options;
		private $sections;
		private $settings;
		private $framework;

		public function __construct() {
				
			// Framework data 
			$this->framework = gpur_framework_data();
			
			// Load setting sections
			$this->sections = gpur_global_setting_sections( $this->framework['theme_slug'] );
			
			// Load settings
			$this->settings = gpur_global_settings( $this->framework['theme_slug'] );
			
			add_action( 'admin_menu', array( $this, 'add_menu_page' ), 11 );			
			add_action( 'admin_init', array( $this, 'register_settings' ) );	

			if ( isset( $_GET['page'] ) && $this->framework['page_slug'] === $_GET['page'] ) {
			
				add_action( 'admin_init', array( $this, 'show_settings' ) );
				add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
				add_action( 'admin_init', array( $this, 'import_settings' ) );
				add_action( 'admin_init', array( $this, 'export_settings' ) );
			
			}
							
		}
		
		public function add_menu_page() {
			add_submenu_page( 
				$this->framework['parent_page_slug'], 
				esc_attr( $this->framework['page_title'] ),
				esc_attr( $this->framework['page_title'] ),
				'manage_options', 
				$this->framework['page_slug'], 
				array( $this, 'generate_menu_page' )
			);
		}
		
		public function enqueue_scripts() {
			wp_enqueue_style( 'ghostpool-framework-settings' );
			wp_enqueue_script( 'ghostpool-framework-global' );	
			wp_enqueue_script( 'ghostpool-framework-conditions' );		
			if ( is_ssl() ) { $scheme = 'https'; } else { $scheme = 'http'; }
			wp_localize_script( 'ghostpool-framework-global', 'ghostpool_framework', array(
				'ajaxurl' => admin_url( 'admin-ajax.php', $scheme ),	
				'maintab' => 'ghostpool_' . $this->framework['theme_slug'] . '_selected_main_tab',
				'subtab' => 'ghostpool_' . $this->framework['theme_slug'] . '_selected_sub_tab',
			) ); 
		}
		
		public function generate_menu_page()  {
		
			if ( ! isset( $this->sections ) ) {
				return;
			}

			$this->options = get_option( $this->framework['option_name'] );
		
			?>
		
			<div class="wrap">
		  
				<h1><?php echo esc_attr( $this->framework['page_title'] ); ?></h1>
				
				<?php settings_errors(); ?>
		   
				<form id="gp-settings-form" method="post" action="options.php">

					<nav class="nav-tab-wrapper">

						<?php 
						
						// Main tabs
						foreach( $this->sections as $section => $data ) {
							$id = $this->sections[$section]['id'];
							$title = $this->sections[$section]['title'];
							echo '<a id="gp-tab-' . $id . '" class="nav-tab gp-main-nav-tab">' . $title . '</a>';
						}
						
						echo '<a href="https://ghostpool.com/documentation/ultimate-reviewer/" class="nav-tab nav-tab-right" target="_blank">' . esc_html__( 'Documentation', 'gpur' ) . '</a>';
						
						?>
				
					</nav>
				
					<?php
			
					// Generate sub nav		
					foreach( $this->sections as $section => $data ) {
						$subsections = $this->sections[$section]['subsections'];
						$i = 0;
						$count = count( $subsections );
						if ( $count > 1 ) {
							echo '<ul class="subsubsub" id="gp-tab-' . $section . '-sub-nav">';
								foreach( $subsections as $subsection => $data ) {
									$i++;
									$title = isset( $data['title'] ) ? $data['title'] : $data;
									$divider = ( $i < $count ) ? ' | ' : '';
									echo '<li><a id="gp-tab-' . $subsection . '" class="gp-sub-nav-tab">' . esc_attr( $title ) . '</a>' . $divider . '</li>';							
								}
							echo '</ul>';
							echo '<div class="gp-clear"></div>';
						}
					}		
				
					// Load settings
					settings_fields( $this->framework['option_name'] . '_group' );
					
					// Generate each settings section
					foreach( $this->sections as $section => $data ) {
						$subsections = $this->sections[$section]['subsections'];
						foreach( $subsections as $subsection => $data ) {
							echo '<div class="gp-settings-section" id="gp-tab-' . $subsection . '-container">';
								do_settings_sections( $subsection . '_settings' );
							echo '</div>';
						}						
					}	
					
					?>

					<p class="gp-submit submit">
						<?php submit_button( esc_html__( 'Save Changes', 'gpur' ), 'primary', 'submit', false ); ?>
						<?php submit_button( esc_html__( 'Reset All Settings', 'gpur' ), 'secondary', 'reset', false, array(
							'onClick' => 'if ( confirm( "' . esc_html__( 'Are you sure you want to reset all your settings?', 'gpur' ) . '" ) ) return true; else return false;'
						) ); ?>
					</p>
					
				</form>
			
			</div>
			<?php
		}

		/**
		 * Show settings fields
		 *
		 */
		public function show_settings() {

			// Create each setting section
			foreach( $this->sections as $section => $data ) { 
				$subsections = $this->sections[$section]['subsections'];
				foreach( $subsections as $subsection => $data ) {
				
					$title = isset( $data['title'] ) ? $data['title'] : $data;
					$title .= isset( $data['desc'] ) ? '<span class="description">' . $data['desc'] . '</span>' : '';
					
					add_settings_section(
						$subsection,
						$title,
						array( $this, 'add_settings_callback' ),
						$subsection . '_settings'
					);  
				}	
			}		

			// Create each setting
			if ( $this->settings ) {		

				foreach( $this->settings as $setting ) {
					
					// Get extracted setting variables
					$parsed_settings = ghostpool_default_setting_fields( $setting );
					extract( $parsed_settings );
						
					// Title field type
					if ( 'section-header' === $type ) {
						$title = '<h2>' . $title . '</h2>';
						if ( '' !== $desc ) {
							$title .= '<p class="description">' . $desc . '</p>';
						}	
					} else {
						$title = $title;
					}
					
					add_settings_field(
						$id,
						$title,
						array( $this, 'field_types' ),
						$section . '_settings',
						$section,
						array(
							'id' => $id,
							'desc' => $desc,
							'type' => $type,
							'format' => $format,
							'units' => $units,
							'styling' => $styling,
							'options' => $options,
							'data' => $data,
							'default_pages' => $default_pages,
							'select2' => $select2,
							'default' => $default,
							'step' => $step,
							'min' => $min,
							'max' => $max,
							'validate' => $validate,
							'class' => $class,
							'important' => $important,
							'media_query' => $media_query,
							'rtl' => $rtl,
							'output' => $output,
							'conditions' => $conditions,
						)
					);
					
				}
				
			}	
			
		}	
		
		/**
		 * Register settings fields
		 *
		 */
		public function register_settings() {
				
			register_setting(
				$this->framework['option_name'] . '_group',
				$this->framework['option_name'],
				array(
					'sanitize_callback' => array( $this, 'save_settings' ),
				)
			);	
																				
		}

		/**
		 * Save settings
		 *
		 */
		public function save_settings( $data ) {
			
			if ( null != $data ) {
						
				$settings = gpur_global_settings( $this->framework['theme_slug'] );

				if ( isset( $_POST['reset'] ) ) {
	
					// Reset to default values
					if ( $settings ) {
						foreach( $settings as $setting ) {
							$default = isset( $setting['default'] ) ? $setting['default'] : '';
							$data[$setting['id']] = $default;
						}
					}	
								
					$type = 'updated';
					$message = esc_html__( 'Your settings have been reset to the default values.', 'gpur' );
					
				} else {
				
					// Sanitize data
					if ( $settings ) {
						foreach( $settings as $setting ) {
							if ( isset( $data[$setting['id']] ) ) {
								$data[$setting['id']] = ghostpool_sanitize_data( $data[$setting['id']], $setting );
							}
						}
					}

					$type = 'updated';
					$message = esc_html__( 'Your settings have been saved.', 'gpur' );
					
				}
				
			} else {
			
				$type = 'error';
				$message = esc_html__( 'Error saving your settings.', 'gpur' );
			
			}	
	
			add_settings_error( $this->framework['option_name'], 'setting_messages', $message, $type );		
							
			return $data;
				
		}
				
		public function add_settings_callback() {}	
			
		/**
		 * Field types
		 *
		 */
		public function field_types( $settings ) {	 	

			extract( $settings );

			// Name variable
			$name = $this->framework['option_name'] . '[' . $id . ']';
				
			// Get value
			$value = isset( $this->options[$id] ) ? $this->options[$id] : '';		
						
			// Load field types
			ghostpool_settings_field_types( $name, $value, $settings );		
											
			// Conditions
			ghostpool_conditions( 'global', $settings, $this->options );
				
		}

		/**
		 * Import settings
		 *
		 */
		public function import_settings() {
			if ( empty( $_POST['ghostpool_action'] ) OR 'import_settings' != $_POST['ghostpool_action'] ) {
				return;
			}	
			if ( ! wp_verify_nonce( $_POST['ghostpool_import_nonce'], 'ghostpool_import_nonce' ) ) {
				return;
			}	
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}	
			$extension = end( explode( '.', $_FILES['import_file']['name'] ) );
			if ( $extension != 'txt' ) {
				wp_die( esc_html__( 'Please upload a valid .txt file.', 'gpur' ) );
			}
			$import_file = $_FILES['import_file']['tmp_name'];
			if ( empty( $import_file ) ) {
				wp_die( esc_html__( 'Please upload a file to import.', 'gpur' ) );
			}
			$settings = json_decode( ghostpool_fs_get_contents( $import_file ), true );
			update_option( $this->framework['option_name'], $settings );
			wp_safe_redirect( admin_url( 'admin.php?page=' . $this->framework['page_slug'] ) ); 
			exit;
		}
		
		/**
		 * Export settings
		 *
		 */
		public function export_settings() {
			if ( empty( $_POST['ghostpool_action'] ) OR 'export_settings' != $_POST['ghostpool_action'] ) {
				return;
			}	
			if ( ! wp_verify_nonce( $_POST['ghostpool_export_nonce'], 'ghostpool_export_nonce' ) ) {
				return;
			}	
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}	
			$settings = get_option( $this->framework['option_name'] );
			ignore_user_abort( true );
			nocache_headers();
			header( 'Content-Type: application/txt; charset=utf-8' );
			header( 'Content-Disposition: attachment; filename=' . $this->framework['page_slug'] . '-' . date( 'm-d-Y' ) . '.txt' );
			header( "Expires: 0" );
			echo json_encode( $settings );
			exit;
		}
				
	}
}

if ( is_admin() ) {
	new GPUR_Framework_Global();
}