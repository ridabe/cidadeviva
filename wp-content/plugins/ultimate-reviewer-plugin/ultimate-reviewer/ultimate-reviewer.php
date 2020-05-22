<?php
/**
 * Plugin Name:       Ultimate Reviewer
 * Plugin URI:        http://themeforest.net/user/GhostPool/portfolio?ref=GhostPool
 * Description:       Ultimate review and rating plugin. Create custom review layouts, user submitted ratings, comment form ratings, comparision tables etc.
 * Version:           2.5.2
 * Author:            GhostPool
 * Author URI:        http://ghostpool.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       gpur
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Plugin definitions
define( 'GPUR_NAME', 'Ultimate Reviewer' );
define( 'GPUR_VERSION', '2.5.2' );
define( 'GPUR_URL', plugin_dir_url( __FILE__ ) );
define( 'GPUR_PATH', plugin_dir_path( __FILE__ ) );

function gpur_load_plugin_textdomain() {
	load_plugin_textdomain(
		'gpur',
		false,
		plugin_basename( dirname( __FILE__ ) ) . '/languages/'
	);
}
add_action( 'plugins_loaded', 'gpur_load_plugin_textdomain' );
	
/**
 * The code that runs during plugin activation.
 *
 */
function gpur_activate() {
	require_once plugin_dir_path( __FILE__ ) . 'admin/class-activator.php';
	GPUR_Activator::activate();
}
register_activation_hook( __FILE__, 'gpur_activate' );

/**
 * The code that runs during plugin deactivation.
 *
 */
function gpur_deactivate() {
	require_once plugin_dir_path( __FILE__ ) . 'admin/class-deactivator.php';
	GPUR_Deactivator::deactivate();
}
register_deactivation_hook( __FILE__, 'gpur_deactivate' );

/**
 * Load plugin functions
 *
 */
// Load admin-facing side of the site
require_once plugin_dir_path( __FILE__ ) . 'admin/framework.php';

// Load public-facing side of the site
require_once plugin_dir_path( __FILE__ ) . 'public/class-public.php';

/**
 * TGM Plugin Activation class
 *
 */
if ( true === apply_filters( 'gpur_load_tgm_class', true ) ) {
 
	if ( version_compare( phpversion(), '5.2.4', '>=' ) ) {
		require_once plugin_dir_path( __FILE__ ) . 'admin/settings/class-tgm-plugin-activation.php';
	}

	if ( ! function_exists( 'gpur_required_plugins' ) ) {
		function gpur_required_plugins() {

			$plugins = array();
		
			if ( ! defined( 'AARDVARK_THEME_VERSION' ) ) {
				$plugins[] = array(
					'name'               => esc_html__( 'WPBakery Page Builder', 'gpur' ),
					'slug'               => 'js_composer',
					'source'             => plugin_dir_path( __FILE__ ) . 'admin/plugins/js_composer.zip',
					'required'           => false,
					'version'            => '6.1',
				);
			}

			$plugins[] = array(
				'name'               => esc_html__( 'Elementor', 'gpur' ),
				'slug'               => 'elementor',
				'required'           => false,
			);		
				
			$plugins[] = array(
				'name'      		=> esc_html__( 'Envato Market', 'gpur' ),
				'slug'      		=> 'envato-market',
				'source'			=> 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
				'required' 			=> false,
			);

			$config = array(
				'id'           => 'gpur',
				'default_path' => '',
				'menu'         => 'tgmpa-install-plugins',
				'has_notices'  => true,                 
				'dismissable'  => true,                  
				'dismiss_msg'  => '',
				'is_automatic' => true,
				'message'      => '',
			);
 
			tgmpa( $plugins, $config );

		}
	
	}
	add_action( 'tgmpa_register', 'gpur_required_plugins' );
	
}	