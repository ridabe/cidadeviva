<?php if ( ! class_exists( 'GPUR_Ajax_Comparison_Table' ) ) {
	class GPUR_Ajax_Comparison_Table {

		public function __construct() {
			add_action( 'wp_ajax_gpur_comparison_table_sorting', array( $this, 'gpur_comparison_table_sorting' ) );
			add_action( 'wp_ajax_nopriv_gpur_comparison_table_sorting', array( $this, 'gpur_comparison_table_sorting' ) );
		}

		public function gpur_comparison_table_sorting() {	
	
			if ( isset( $_GET['action'] ) && 'gpur_comparison_table_sorting' === $_GET['action'] ) {
	
				// Check the nonce
				check_ajax_referer( 'gpur_comparison_table_sorting_nonce', 'nonce' );
				
				// Sort order
				$args = array(
					'sort' => $_GET['sorting'],
				);
				
				// Builder
				$builder = $_GET['builder'];
				
				// Atts
				$atts = array();
				$atts = stripslashes( $_GET['atts'] );
				$atts = ltrim( $atts, '{"' );
				$atts = rtrim( $atts, '}"' );
				$atts = explode( '|', $atts );
				foreach( $atts as $att ) {
   					list( $key, $value ) = explode( ':', $att );
    				$new_atts[$key] = $value;
				}
				$new_atts = wp_parse_args( $args, $new_atts );
				//print_r($new_atts);

				echo gpur_comparison_table_template( array( 'builder' => $builder, 'atts' => $new_atts ) );
				
				die();

			}
			
		}	
	
	}
}
new GPUR_Ajax_Comparison_Table();	