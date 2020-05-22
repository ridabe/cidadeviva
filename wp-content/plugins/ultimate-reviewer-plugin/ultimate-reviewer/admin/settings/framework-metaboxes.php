<?php if ( ! class_exists( 'GPUR_Framework_Metaboxes' ) ) {
	class GPUR_Framework_Metaboxes {
 
 		private $framework;
 		//private $settings;
 		    
		public function __construct() {
		
			global $pagenow;
				
			// Framework data 
			$this->framework = gpur_framework_data();
			
			if ( 'post.php' === $pagenow OR 'post-new.php' === $pagenow ) {
				add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			}
				
			add_action( 'add_meta_boxes', array( $this, 'register_metaboxes' ) );
			add_action( 'save_post', array( $this, 'save_settings' ) );
						
		}
				
		public function enqueue_scripts() {
			wp_enqueue_style( 'ghostpool-framework-settings' );
			wp_enqueue_script( 'ghostpool-framework-metaboxes' );
			wp_enqueue_script( 'ghostpool-framework-conditions' );
		}
		 
		public function register_metaboxes() {
			
			$settings = gpur_metaboxes_settings( $this->framework['theme_slug'] );
			if ( $settings ) {
			
				foreach( $settings as $setting ) {
											
					$defaults = array(
						'id' => '',
						'title' => '',
						'post_types' => array( 'post' ),
						'position' => 'normal',	
						'priority' => 'high',
						'post_formats' => array(),
						'page_templates' => array(),
					);
			
					$setting = wp_parse_args( $setting, $defaults );
			
					add_meta_box( 
						$setting['id'], 
						$setting['title'], 
						array( $this, 'register_settings' ), 
						$setting['post_types'],
						$setting['position'],
						$setting['priority'],
						array( 
							'id' => $setting['id'],
							'post_formats' => $setting['post_formats'],
							'page_templates' => $setting['page_templates']
						)
					);

					if ( is_array( $setting['post_types'] ) ) {
						if ( in_array( 'page', $setting['post_types'] ) && ! empty( $setting['page_templates'] ) ) {
							add_filter( 'postbox_classes_page_' . $setting['id'], array( $this, 'add_metabox_classes' ) );	
						}
						if ( in_array( 'post', $setting['post_types'] ) && ! empty( $setting['post_formats'] ) ) {
							add_filter( 'postbox_classes_post_' . $setting['id'], array( $this, 'add_metabox_classes' ) );						
						}
					}	
					
				}				
						
			}		
				
		}
		
		public function add_metabox_classes( $classes = array() ) {
			global $post;
			if ( ! in_array( 'gp-postbox', $classes ) ) {
				$classes[] = 'gp-postbox';
				if ( 'post' === $post->post_type ) {
					$classes[] = 'gp-postbox-post-format';
				}
				if ( 'page' === $post->post_type ) {	
					$classes[] = 'gp-postbox-page-template';
				}
			}
			return $classes;
		}
		
		/**
		 * Register settings fields
		 *
		 */															
		public function register_settings( $post, $args ) {
			
			wp_nonce_field( 'ghostpool_framework_metaboxes_action', 'ghostpool_framework_metaboxes_nonce' );

			$settings = gpur_metaboxes_settings( $this->framework['theme_slug'] );
			if ( $settings ) {
			
				echo '<div class="gp-settings-section gp-show">';

					foreach( $settings as $settings ) {

						// Check if this setting should be shown on this page
						if ( isset( $settings['id'] ) && isset( $args['args']['id'] ) && ( $settings['id'] === $args['args']['id'] ) ) {
					
							foreach( $settings['section'] as $setting ) {

								// Get extracted setting variables
								$parsed_settings = ghostpool_default_setting_fields( $setting );
								extract( $parsed_settings );

								// Name variable
								$name = $id;
								
								// Get value 
								$value = get_post_meta( $post->ID, $id, true );

								echo '<div class="gp-setting ' . esc_attr( $class ) . '">';
						
									if ( isset( $title ) ) {
										echo '<label>' . esc_html( $title ) . '</label>';
									}
							
									// Load field types
									ghostpool_settings_field_types( $name, $value, $parsed_settings );
									
									// Conditions
									ghostpool_conditions( 'metaboxes', $parsed_settings, $post->ID );
																				
								echo '</div>';					
				
							}
						
						}
					
					}
					
				echo '</div>';
	
			}
						 
		}

		/**
		 * Save settings
		 *
		 */
		public function save_settings( $post_id ) {
			
			$post_id = (int) $post_id;
			
			if ( ! isset( $_POST['ghostpool_framework_metaboxes_nonce'] ) ) {
				return;
			}
 
			if ( ! wp_verify_nonce( $_POST['ghostpool_framework_metaboxes_nonce'], 'ghostpool_framework_metaboxes_action' ) ) {
				return;
			}
 
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}
 
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
 
			if ( ! isset( $_POST['post_type'] ) ) {
 				return;
			}

			// Get data being saved
			$settings = gpur_metaboxes_settings( $this->framework['theme_slug'] );
			if ( $settings ) {
				foreach( $settings as $settings ) {
					foreach( $settings['section'] as $setting ) {
	
						// Sanitize data
						if ( isset( $_POST[$setting['id']] ) ) {
							$new_value = ghostpool_sanitize_data( $_POST[$setting['id']], $setting );
						} else {
							$new_value = '';
						}	

						// Get current value
						$current_value = get_post_meta( $post_id, $setting['id'], true );

						if ( $new_value && ( ( '' === $current_value ) OR ( $new_value !== $current_value ) ) ) {
							update_post_meta( $post_id, $setting['id'], $new_value, $current_value );
						} elseif ( ( '' === $new_value OR array() === $new_value ) && $current_value ) {
							delete_post_meta( $post_id, $setting['id'], $current_value );
						}
						
					}	

				}
			}
			
		}
				
	}
}
		
if ( is_admin() ) {
	new GPUR_Framework_Metaboxes();
}