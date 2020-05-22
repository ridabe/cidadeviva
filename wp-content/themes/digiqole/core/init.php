<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * includes all files and trigger the action hook by load
 */

class Digiqole_Theme_Includes {

	private static $rel_path	 = null;
	private static $initialized	 = false;
	private static $customizer	 = [];


    // auto load
    // ----------------------------------------------------------------------------------------
	public static function init() {
		if ( self::$initialized ) {
			return;
		} else {
			self::$initialized = true;
		}
		self::_action_init();
		
		if(!is_admin()){
            // for frontend
			add_action( 'wp_enqueue_scripts', array( __CLASS__, '_action_enqueue_scripts' ), 20	);
		}else{
			// for admin
			add_action( 'admin_enqueue_scripts', array( __CLASS__, '_action_enqueue_admin_scripts' ), 20 );
		}

		add_action('fw_option_types_init', array( __CLASS__, '_action_custom_option_types'));
	}

    // include method, using file prefix
    // ----------------------------------------------------------------------------------------
	public static function include_isolated( $file = null, $directory = 'core' ) {
		if($file != null){
         $filename = $directory . $file;
        
			require_once( trailingslashit( get_template_directory() ). $filename );
		}
	}

    // include and extract customizer options
    // ----------------------------------------------------------------------------------------
	public static function include_customizer_options( $option_list ) {
		$options = [];
		foreach($option_list as $option){
			$options[] = fw()->theme->get_options( 'customizer/options-' . $option );
		}

		return $options;
	}


    /******************************************************************************************
    ** starts include section
    ** add all files bellow, they will be included by load.
    ** all include files should be mentioned here.
    ** DO NOT use include() function anywhere else except init.php nd the theme functions.php
    ******************************************************************************************/

    // include all necessary files for hooks
    // ----------------------------------------------------------------------------------------
	public static function _action_init() {
 		
        // helper files:functions
        self::include_isolated( '/helpers/functions/global.php' );
		self::include_isolated( '/helpers/functions/template.php' );
		
        // helper files:classes
        self::include_isolated( '/helpers/classes/global.php' );

		// lib files
		self::include_isolated( '/libs/class-tgm-plugin-activation.php' );
		
        // setup related files
        self::include_isolated( '/installation-fragments/tgmpa-plugins.php' );
		self::include_isolated( '/installation-fragments/theme-demos.php' );
		
        // header templater loader
        self::include_isolated( '/hooks/header-loader.php' );

        // menu
        self::include_isolated( '/hooks/menus.php' );

        // blog related all hooks
        self::include_isolated( '/hooks/blog.php' );
          // custom post types
        self::include_isolated( '/hooks/cpt.php' );
        
        // custom font
        self::include_isolated( '/hooks/custom-fonts.php' );
        
        // gogole font
        self::include_isolated( '/hooks/unyson-google-fonts.php' );
        
        // register widget areas
		self::include_isolated( '/hooks/widget-areas.php' );
    }
    

    // add all enqueue files here, for frontend
    // ----------------------------------------------------------------------------------------
	public static function _action_enqueue_scripts() {
		self::include_isolated( '/enqueues/frontend/static.php' );
		self::include_isolated( '/enqueues/frontend/dynamic.php' );
	}


    // add all enqueue files here, for admin
    // ----------------------------------------------------------------------------------------
	public static function _action_enqueue_admin_scripts() {
		self::include_isolated( '/enqueues/admin/static.php' );
	}

	
    // include customizer options
    // ----------------------------------------------------------------------------------------

	public static function _customizer_options() {
		$option_list = [
		 'general',
		 'style',
		 'menu',
         'header',
         'newsticker',
         'blocks',
		 'blog',
         'ads',
		 'instgram',
		 'footer',
		];

		return self::include_customizer_options($option_list);
	}


	// custom option types for unyson
    // ----------------------------------------------------------------------------------------
	public static function _action_custom_option_types() {
		if (is_admin()) {
			$dir = '/option-types';
			self::include_isolated( $dir . '/new-icon/class-fw-option-type-new-icon.php', 'components');
			self::include_isolated( $dir . '/fw-multi-inline/class-fw-option-type-fw-multi-inline.php', 'components');
			// and all other option types
		}
	}

}

Digiqole_Theme_Includes::init();