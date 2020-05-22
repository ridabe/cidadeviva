<?php
if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' ); 
/**
 * Plugin Name: Wp ultimate review
 * Description: The most advanced WordPress Review Plugin
 * Plugin URI: https://wpmet.com/
 * Author: Wpmet
 * Version: 1.2.1
 * Author URI: https://wpmet.com/
 *
 * Text Domain: wp-ultimate-review
 *
 * @package Wp Ultimate Reviews
 * @category Pro
 *
 * License description goes here.
 */


/**
 * Defining static values as global constants
 * @since 1.0.0
 */
define( 'WUR_REVIEW_VERSION', '1.1.0' );
define( 'WUR_REVIEW_PREVIOUS_STABLE_VERSION', '1.0.3' );

define( 'WUR_REVIEW_KEY', 'wp_ultimate_review' );

define( 'WUR_TEXT_DOMAIN', 'wp-ultimate-review' );

define( 'WUR_REVIEW_FILE_', __FILE__ );
define( "WUR_REVIEW_PLUGIN_PATH", plugin_dir_path( WUR_REVIEW_FILE_ ) );
define( 'WUR_REVIEW_PLUGIN_URL', plugin_dir_url( WUR_REVIEW_FILE_ ) );


// initiate actions
add_action( 'plugins_loaded', 'wur_review_load_plugin_textdomain' );

/**
 * Load WUR Review textdomain.
 * @since 1.0.0
 * @return void
 */
function wur_review_load_plugin_textdomain() {
	load_plugin_textdomain( 'wp-ultimate-review', false, basename( dirname( __FILE__ ) ) . '/languages' );

		/**
	 * Load Review Loader main page.
	 * @since 1.0.0
	 * @return plugin output
	 */
	require_once(WUR_REVIEW_PLUGIN_PATH.'init.php');
	new \WurReview\Init();

	// custom function added
	if(file_exists(WUR_REVIEW_PLUGIN_PATH.'inc/custom-function.php') ){
		include( WUR_REVIEW_PLUGIN_PATH.'inc/custom-function.php');
	}
}




