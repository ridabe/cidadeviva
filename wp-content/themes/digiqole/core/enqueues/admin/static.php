<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * enqueue static files: javascript and css for backend
 */

wp_enqueue_style('digiqole-custom-iconfont', DIGIQOLE_CSS . '/icon-font.css', null, DIGIQOLE_VERSION);
wp_enqueue_style('digiqole-custom-css', DIGIQOLE_CSS . '/digiqole-admin.css', null, DIGIQOLE_VERSION);

wp_enqueue_script('digiqole-admin', DIGIQOLE_JS . '/digiqole-admin.js', array('jquery'), DIGIQOLE_VERSION, true);
wp_enqueue_script('digiqole-customize', DIGIQOLE_JS . '/digiqole-customize.js', array('jquery'), DIGIQOLE_VERSION, true);

wp_localize_script( 'digiqole-customize', 'admin_url_object',array( 'admin_url' => admin_url( '?action=elementor&post=' ) ) );
