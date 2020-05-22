<?php if ( ! class_exists( 'GPUR_Elementor' ) ) {
	class GPUR_Elementor {

		public function __construct() {

			add_action( 'elementor/widgets/widgets_registered', array( $this, 'register_widgets' ) );
			
			add_action( 'elementor/elements/categories_registered',  array( $this, 'add_categories' ) );
	
			add_action( 'after_switch_theme', array( $this, 'default_post_types' ) );
				
			add_action( 'init', array( $this, 'default_templates' ) );

			add_action( 'elementor/preview/enqueue_styles', array( $this, 'enqueue_scripts' ) );
			
		}

		public function enqueue_scripts() {
			
			wp_enqueue_script( 'gpur-elementor', plugin_dir_url( __FILE__ ) . 'assets/elementor.js', array( 'jquery' ), GPUR_VERSION, false );
			
			wp_enqueue_script( 'bootstrap-rating', GPUR_URL . 'public/scripts/bootstrap-rating.min.js', array( 'jquery' ), GPUR_VERSION, false );
			
			wp_enqueue_script( 'gpur-show-rating', GPUR_URL . 'public/scripts/show-rating.js', array( 'jquery' ), GPUR_VERSION, false );	
			
			wp_enqueue_script( 'gpur-add-user-ratings', GPUR_URL . 'public/scripts/add-user-ratings.js', array( 'jquery' ), GPUR_VERSION, false );	

		}

		public function load_files() {		
		
			require_once( plugin_dir_path( __FILE__ ) . 'elementor-add-user-ratings.php' );
			require_once( plugin_dir_path( __FILE__ ) . 'elementor-bad-points.php' );
			require_once( plugin_dir_path( __FILE__ ) . 'elementor-comparison-table.php' );
			require_once( plugin_dir_path( __FILE__ ) . 'elementor-excerpt.php' );
			require_once( plugin_dir_path( __FILE__ ) . 'elementor-good-points.php' );
			require_once( plugin_dir_path( __FILE__ ) . 'elementor-image.php' );
			require_once( plugin_dir_path( __FILE__ ) . 'elementor-review-button.php' );
			
			if ( ! defined( 'MAGZINE_THEME_VERSION' ) ) {
				require_once( plugin_dir_path( __FILE__ ) . 'elementor-reviews-list.php' );
			}
			
			require_once( plugin_dir_path( __FILE__ ) . 'elementor-review-template.php' );
			require_once( plugin_dir_path( __FILE__ ) . 'elementor-show-rating.php' );
			require_once( plugin_dir_path( __FILE__ ) . 'elementor-summary.php' );
			require_once( plugin_dir_path( __FILE__ ) . 'elementor-title.php' );
			require_once( plugin_dir_path( __FILE__ ) . 'elementor-up-down-voting.php' );		

		}
					
		public function register_widgets() {
		
			// Its is now safe to include Widgets files
			$this->load_files();
			
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new GPUR_Elementor_Add_User_Rating_Widget() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new GPUR_Elementor_Bad_Points_Widget() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new GPUR_Elementor_Comparison_Table_Widget() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new GPUR_Elementor_Excerpt_Widget() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new GPUR_Elementor_Good_Points_Widget() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new GPUR_Elementor_Image_Widget() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new GPUR_Elementor_Review_Button_Widget() );
			
			if ( ! defined( 'MAGZINE_THEME_VERSION' ) ) {
				\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new GPUR_Elementor_Reviews_List_Widget() );
			}
			
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new GPUR_Elementor_Review_Template_Widget() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new GPUR_Elementor_Show_Rating_Widget() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new GPUR_Elementor_Summary_Widget() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new GPUR_Elementor_Title_Widget() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new GPUR_Elementor_Up_Down_Voting_Widget() );
							
		}

		public function add_categories( $elements_manager ) {
			$elements_manager->add_category(
				'review',
				[
					'title' => esc_html__( 'Review', 'aardvark' ),
					'icon' => 'fas fa-star',
				]
			);
		}

		public function default_post_types() {
			$cpt_support = get_option( 'elementor_cpt_support' );
			if ( ! $cpt_support ) {
				$cpt_support = [ 'page', 'post', 'gpur-template' ];
				update_option( 'elementor_cpt_support', $cpt_support );
			} elseif ( ! in_array( 'gpur-template', $cpt_support ) ) {
				$cpt_support[] = 'gpur-template';
				update_option( 'elementor_cpt_support', $cpt_support );
			}
		}

		public function default_templates() {
			require_once( plugin_dir_path( __FILE__ ) . 'elementor-preset-comparison-table-templates.php' );
			require_once( plugin_dir_path( __FILE__ ) . 'elementor-preset-review-templates.php' );
			require_once( plugin_dir_path( __FILE__ ) . 'elementor-preset-reviews-list-templates.php' );
		}

		public static function gpur_elementor_post_types() {
			$post_types = get_post_types( 
				array(
					'public' => true,
					'exclude_from_search' => false,
				), 
				'names', 
				'and'
			);
			foreach ( $post_types as $post_type ) {
				if ( 'attachment' !== $post_type && 'gpur-template' !== $post_type ) {
					$output[ $post_type ] = $post_type;
				}
			}
			return $output;
		}
		
		public static function gpur_elementor_permissions_roles() {
			$roles = wp_roles()->get_names();
			if ( $roles ) {
				$output = array();
				foreach ( $roles as $id => $role ) {  			
					$output[ $id ] = $role;
				}
			}
			return $output;
		}
	
	}
}	
new GPUR_Elementor();