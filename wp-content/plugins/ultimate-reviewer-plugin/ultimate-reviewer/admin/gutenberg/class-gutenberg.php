<?php if ( ! class_exists( 'GPUR_Gutenberg' ) ) {
	class GPUR_Gutenberg {

		public function __construct() {
				
			add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_scripts' ) );
			
			add_action( 'init', array( $this, 'register_blocks' ) );
			
			function gpur_review_template_block( $attributes ) {
				$template_id = isset( $attributes['review_template_id'] ) ? $attributes['review_template_id'] : '';
				return  gpur_review_template( array( 'atts' => array( 'template_id' => $template_id  ) ) );
			}
			
		}	

		public function enqueue_scripts() {
		
			wp_enqueue_script( 'gpur-gutenberg-blocks', plugin_dir_url( __FILE__ ) . 'assets/gutenberg-blocks.js', array( 'wp-blocks', 'wp-element', 'wp-components' ), '', false );
			
			wp_localize_script( 'gpur-gutenberg-blocks', 'gpur_gutenberg_blocks', array(
				'review_templates' => gpur_templates_dropdown_values(),
			) );
			
		}
		
		public function register_blocks() {	

			register_block_type( 'gpur/review-template', 
				array(
					'render_callback' => 'gpur_review_template_block',
					'attributes' => array(
                		'review_template_id' => array(
                    		'type' => 'string',
						),
					),
				) 
			);
			
		}
		
	}
}
new GPUR_Gutenberg();