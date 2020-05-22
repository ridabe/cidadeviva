<?php if ( ! class_exists( 'GPUR_Review_Template_Widget' ) ) {
	class GPUR_Review_Template_Widget extends WP_Widget {
	
		function __construct() {
		
			$widget_ops = array( 
				'classname' => 'gpur-review-template-widget', 
				'description' => esc_html__( 'Display a review template.', 'gpur' ) 
			);
			
			parent::__construct( 
				'gpur-review-template-widget', 
				esc_html__( 'Ultimate Reviewer: Review Template', 'gpur' ), 
				$widget_ops 
			);
			
		}

		function widget( $args, $instance ) {
		
			extract( $args );
				
			$id = isset( $instance['id'] ) ? $instance['id'] : 0;
			
			$post = get_post( $id );
			
			if ( $post ) {

				// Load custom CSS from review template	
				$inline_css = get_post_meta( $post->ID, '_wpb_shortcodes_custom_css', true );	
				wp_register_style( 'gpur-shortcodes', false );
				wp_enqueue_style( 'gpur-shortcodes' );
				wp_add_inline_style( 'gpur-shortcodes', $inline_css );
										
				echo wp_kses_post( $before_widget ); ?>
					
					<div class="gpur-element-wrapper gpur-review-template-wrapper">
			
						<?php echo do_shortcode( $post->post_content ); ?>
							
					</div>
		
				<?php echo wp_kses_post( $after_widget );
				
			}	

		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['id'] = isset( $new_instance['id'] ) ? sanitize_text_field( $new_instance['id'] ) : 0;
			return $instance;
		}

		function form( $instance ) {
		
			// Defaults
			$id = isset( $instance['id'] ) ? absint( $instance['id'] ) : 0;
			
			?>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'id' ) ); ?>"><?php esc_html_e( 'Template:', 'gpur' ); ?></label><br/>
				
				<select id="<?php echo esc_attr( $this->get_field_id( 'id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'id' ) ); ?>">
					<?php 
				
					$templates = gpur_templates_dropdown_values();
					
					foreach( $templates as $title => $template ) {
					
						if ( $id === $template ) {
							$checked = ' selected="selected"';
						} else {
							$checked = '';
						}
				
						echo '<option value="' . esc_attr( $template ) . '"' . $checked . '>' . esc_html( $title ) . '</option>';
				
					} ?>
				</select>
			</p>

			<?php

		}
	}

}