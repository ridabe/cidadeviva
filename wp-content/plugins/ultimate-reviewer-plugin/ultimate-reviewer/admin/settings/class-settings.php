<?php 

// Load setting functions
require_once( plugin_dir_path( __FILE__ ) . 'settings-functions.php' );
require_once( plugin_dir_path( __FILE__ ) . 'conditions.php' );
require_once( plugin_dir_path( __FILE__ ) . 'sanitize-data.php' );

// Load theme settings
require_once( plugin_dir_path( __FILE__ ) . 'config-global.php' );
require_once( plugin_dir_path( __FILE__ ) . 'framework-global.php' );

// Load metaboxes settings
require_once( plugin_dir_path( __FILE__ ) . 'config-metaboxes.php' );
require_once( plugin_dir_path( __FILE__ ) . 'framework-metaboxes.php' );

// Load comment settings
require_once( plugin_dir_path( __FILE__ ) . 'framework-comments.php' );
