<?php 

// Load widgets
require_once( plugin_dir_path( __FILE__ ) . 'review-template.php' );
require_once( plugin_dir_path( __FILE__ ) . 'user-reviews.php' );
//require_once( plugin_dir_path( __FILE__ ) . 'reviews-list.php' );

if ( ! class_exists( 'GPUR_Widgets' ) ) {
	class GPUR_Widgets {

		public function __construct() {
			
			add_action( 'widgets_init', array( $this, 'register_widgets' ) );
		
		}

		public function register_widgets() {
			register_widget( 'GPUR_Review_Template_Widget' );
			register_widget( 'GPUR_User_Reviews_Widget' );
			//register_widget( 'GPUR_Reviews_List_Widget' );
		}
		
	}
}
new GPUR_Widgets();