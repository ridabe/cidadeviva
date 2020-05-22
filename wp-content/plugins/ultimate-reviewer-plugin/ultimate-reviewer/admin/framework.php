<?php 

/**
 * Theme data
 *
 */
if ( ! function_exists( 'gpur_framework_data' ) ) {
	function gpur_framework_data() {
		$data = array(
			'settings_class' => 'GPUR_Framework_Global',
			'theme_slug' => 'gpur',
			'page_slug' => 'gpur-settings',
			'parent_page_slug' => 'gpur-templates-page',
			'option_name' => 'gpur_settings',
			'page_title' => esc_html__( 'Settings', 'gpur' ),
			'the_version' => GPUR_VERSION,
			'directory_path' => plugin_dir_path( __FILE__ ),
			'directory_uri' => plugin_dir_url( __FILE__ ),
			'font_uri' => GPUR_URL . 'public/fonts/',
		);
		return $data;
	}
}

/**
 * Load framework files
 *
 */

// Load admin functions
require_once( plugin_dir_path( __FILE__ ) . 'functions-admin.php' );

// Load settings files
require_once( plugin_dir_path( __FILE__ ) . 'settings/class-settings.php' );
 
// Load inc files
require_once( plugin_dir_path( __FILE__ ) . 'inc/class-inc.php' );

// Load template menu and register post type
require_once( plugin_dir_path( __FILE__ ) . 'class-review-templates.php' );

// Load status page
require_once( plugin_dir_path( __FILE__ ) . 'status/class-status.php' );

// Save site ratings
require_once( plugin_dir_path( __FILE__  ) . 'class-save-site-ratings.php' );		

// Ajax save user ratings
require_once( plugin_dir_path( __FILE__  ) . 'class-save-user-ratings.php' );		

// Load WPBakery page builder functions
if ( function_exists( 'vc_set_as_theme' ) ) {
	require_once( plugin_dir_path( __FILE__ ) . 'wpb/class-wpb.php' );
}

// Load Elementor functions
if ( defined( 'ELEMENTOR_VERSION' ) ) {
	require_once( plugin_dir_path( __FILE__ ) . 'elementor/class-elementor.php' );
}

// Load list of reviews
require_once( plugin_dir_path( __FILE__ ) . 'reviews-list/class-reviews-list.php' );

// Load widgets
require_once( plugin_dir_path( __FILE__ ) . 'widgets/class-widgets.php' );

// Load Gutenberg blocks
if ( function_exists( 'register_block_type' ) ) {
	require_once( plugin_dir_path( __FILE__ ) . 'gutenberg/class-gutenberg.php' );
}

/**
 * Try to get file content using WP File system API
 *
 */
if ( ! function_exists( 'ghostpool_fs_get_contents' ) ) {
	function ghostpool_fs_get_contents( $file_path ) {

		// Frontend or customizer fallback
		if ( ! function_exists( 'get_filesystem_method' ) ) {
			require_once ABSPATH . 'wp-admin/includes/file.php';
		}
		
		$allow_relaxed_file_ownership = true;
		$context = '';

		if ( function_exists( 'get_filesystem_method' ) && get_filesystem_method( array(), $context, $allow_relaxed_file_ownership ) === 'direct' ) {
		
			// You can safely run request_filesystem_credentials() without any issues and don't need to worry about passing in a URL
			$creds = request_filesystem_credentials( site_url() . '/wp-admin/', '', false, $context, null, $allow_relaxed_file_ownership );

			// Initialize API
			if ( ! WP_Filesystem( $creds, $context, $allow_relaxed_file_ownership ) ) {
				return false;
			}

			global $wp_filesystem;

			// Do our file manipulations below
			return $wp_filesystem->get_contents( $file_path );

		} else {
		
			return false;
			
		}
	}
}