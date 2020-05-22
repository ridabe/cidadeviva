<?php

if ( ! defined( 'ABSPATH' ) ) exit;

if(defined('ELEMENTOR_VERSION')):
    
include_once DIGIQOLE_EDITOR . '/elementor/manager/controls.php';

class DIGIQOLE_Shortcode{

	/**
     * Holds the class object.
     *
     * @since 1.0
     *
     */
    public static $_instance;
    

    /**
     * Localize data array
     *
     * @var array
     */
    public $localize_data = array();

	/**
     * Load Construct
     * 
     * @since 1.0
     */

	public function __construct(){

		add_action('elementor/init', array($this, 'digiqole_elementor_init'));
        add_action('elementor/controls/controls_registered', array( $this, 'digiqole_icon_pack' ), 11 );

        if(!class_exists('ElementsKit')){
            add_action('elementor/controls/controls_registered', array( $this, 'control_image_choose' ), 13 );
            add_action('elementor/controls/controls_registered', array( $this, 'digiqole_ajax_select2' ), 13 );
        }

        add_action('elementor/widgets/widgets_registered', array($this, 'digiqole_shortcode_elements'));
        add_action( 'elementor/editor/after_enqueue_styles', array( $this, 'editor_enqueue_styles' ) );
        add_action( 'elementor/frontend/before_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_action( 'elementor/preview/enqueue_styles', array( $this, 'preview_enqueue_scripts' ) );
        
	}


    /**
     * Enqueue Scripts
     *
     * @return void  
     */ 
    
     public function enqueue_scripts() {
        wp_enqueue_script( 'digiqole-main-elementor', DIGIQOLE_JS  . '/elementor.js',array( 'jquery', 'elementor-frontend' ), DIGIQOLE_VERSION, true );
    }

    /**
     * Enqueue editor styles
     *
     * @return void
     */

    public function editor_enqueue_styles() {
        wp_enqueue_style( 'digiqole-icon-elementor', DIGIQOLE_CSS.'/icon-font.css',null, DIGIQOLE_VERSION );
        wp_enqueue_style( 'digiqole-panel-elementor', DIGIQOLE_CSS.'/panel.css',null, DIGIQOLE_VERSION );
        wp_enqueue_script('digiqole-admin', DIGIQOLE_JS . '/digiqole-admin.js', array('jquery'), DIGIQOLE_VERSION, true);
    }

    /**
     * Preview Enqueue Scripts
     *
     * @return void
     */

    public function preview_enqueue_scripts() {}
	/**
     * Elementor Initialization
     *
     * @since 1.0
     *
     */

    public function DIGIQOLE_elementor_init(){
    
        \Elementor\Plugin::$instance->elements_manager->add_category(
            'digiqole-elements',
            [
                'title' =>esc_html__( 'digiqole', 'digiqole' ),
                'icon' => 'fa fa-plug',
            ],
            1
        );
    }

    /**
     * Extend Icon pack core controls.
     *
     * @param  object $controls_manager Controls manager instance.
     * @return void
     */ 

    public function digiqole_icon_pack( $controls_manager ) {

        require_once DIGIQOLE_EDITOR_ELEMENTOR. '/controls/icon.php';

        $controls = array(
            $controls_manager::ICON => 'DIGIQOLE_Icon_Controler',
        );

        foreach ( $controls as $control_id => $class_name ) {
            $controls_manager->unregister_control( $control_id );
            $controls_manager->register_control( $control_id, new $class_name() );
        }

    }
    // registering ajax select 2 control
    public function digiqole_ajax_select2( $controls_manager ) {
        require_once DIGIQOLE_EDITOR_ELEMENTOR. '/controls/select2.php';
        $controls_manager->register_control( 'ajaxselect2', new \Control_Ajax_Select2() );
    }
    
    // registering image choose
    public function control_image_choose( $controls_manager ) {
        require_once DIGIQOLE_EDITOR_ELEMENTOR. '/controls/choose.php';
        $controls_manager->register_control( 'imagechoose', new \Control_Image_Choose() );
    }

    public function digiqole_shortcode_elements($widgets_manager){
       
      require_once DIGIQOLE_EDITOR_ELEMENTOR.'/widgets/post-tab.php';
      $widgets_manager->register_widget_type(new Elementor\Digiqole_post_tab_widget());

      require_once DIGIQOLE_EDITOR_ELEMENTOR.'/widgets/post-block.php';
      $widgets_manager->register_widget_type(new Elementor\Digiqole_Post_block_Widget());
     
      require_once DIGIQOLE_EDITOR_ELEMENTOR.'/widgets/post-list-tab.php';
      $widgets_manager->register_widget_type(new Elementor\Digiqole_post_list_tab_widget());

      require_once DIGIQOLE_EDITOR_ELEMENTOR.'/widgets/category-list.php';
      $widgets_manager->register_widget_type(new Elementor\Digiqole_Category_List_Widget());

      require_once DIGIQOLE_EDITOR_ELEMENTOR.'/widgets/category-classic.php';
      $widgets_manager->register_widget_type(new Elementor\Digiqole_Category_List_classic_Widget());

      require_once DIGIQOLE_EDITOR_ELEMENTOR.'/widgets/post-grid.php';
      $widgets_manager->register_widget_type(new Elementor\Digiqole_Post_Grid_Widget());

      require_once DIGIQOLE_EDITOR_ELEMENTOR.'/widgets/post-grid-loadmore.php';
      $widgets_manager->register_widget_type(new Elementor\Digiqole_Post_Grid_Loadmore_Widget());

      require_once DIGIQOLE_EDITOR_ELEMENTOR.'/widgets/post-list.php';
      $widgets_manager->register_widget_type(new Elementor\Digiqole_Post_List_Widget());

      require_once DIGIQOLE_EDITOR_ELEMENTOR.'/widgets/video-post-tab.php';
      $widgets_manager->register_widget_type(new Elementor\Digiqole_Video_Post_Tab_Widget());

      require_once DIGIQOLE_EDITOR_ELEMENTOR.'/widgets/post-grid-slider.php';
      $widgets_manager->register_widget_type(new Elementor\Digiqole_Post_Grid_Slider_Widget());

      require_once DIGIQOLE_EDITOR_ELEMENTOR.'/widgets/post-block-slider.php';
      $widgets_manager->register_widget_type(new Elementor\Digiqole_Post_block_Slider_Widget());

      require_once DIGIQOLE_EDITOR_ELEMENTOR.'/widgets/title.php';
      $widgets_manager->register_widget_type(new Elementor\Digiqole_Title_Widget());
      
      require_once DIGIQOLE_EDITOR_ELEMENTOR.'/widgets/comments.php';
      $widgets_manager->register_widget_type(new Elementor\Digiqole_Comment_Widget());
    

      require_once DIGIQOLE_EDITOR_ELEMENTOR.'/widgets/main-slider.php';
      $widgets_manager->register_widget_type(new Elementor\Digiqole_Main_Slider_Widget());

      require_once DIGIQOLE_EDITOR_ELEMENTOR.'/widgets/post-slider.php';
      $widgets_manager->register_widget_type(new Elementor\Digiqole_Post_Slider_Widget());


      require_once DIGIQOLE_EDITOR_ELEMENTOR.'/widgets/video-post-slider2.php';
      $widgets_manager->register_widget_type(new Elementor\Digiqole_Video_Post_Slider2_Widget());

      require_once DIGIQOLE_EDITOR_ELEMENTOR.'/widgets/editor-pick.php';
      $widgets_manager->register_widget_type(new Elementor\Digiqole_Editor_Pick_Post_Slider_Widget());

      require_once DIGIQOLE_EDITOR_ELEMENTOR.'/widgets/post-vertical-grid.php';
      $widgets_manager->register_widget_type(new Elementor\Digiqole_Post_Vertical_Grid_Widget());
      
      require_once DIGIQOLE_EDITOR_ELEMENTOR.'/widgets/feature-post-tab.php';
      $widgets_manager->register_widget_type(new Elementor\Digiqole_Feature_Post_Tab_Widget());

      require_once DIGIQOLE_EDITOR_ELEMENTOR.'/widgets/post-horizontal-block.php';
      $widgets_manager->register_widget_type(new Elementor\Digiqole_Horizonal_Post_Block_Widget());

      require_once DIGIQOLE_EDITOR_ELEMENTOR.'/widgets/site-logo.php';
      $widgets_manager->register_widget_type(new Elementor\Digiqole_Site_Logo_Widget());

      if(class_exists('\Elementor\Digiqole_Widget_Instagram_Feed')){
        $widgets_manager->register_widget_type(new Elementor\Digiqole_Widget_Instagram_Feed());
    }
    }
    
	public static function digiqole_get_instance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new DIGIQOLE_Shortcode();
        }
        return self::$_instance;
    }

}
$DIGIQOLE_Shortcode = DIGIQOLE_Shortcode::digiqole_get_instance();

endif;