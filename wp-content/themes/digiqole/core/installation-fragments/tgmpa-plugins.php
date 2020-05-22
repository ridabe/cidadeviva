<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * register required plugins
 */

function digiqole_register_required_plugins() {
	$plugins	 = array(
		array(
			'name'		 => esc_html__( 'Unyson', 'digiqole' ),
			'slug'		 => 'unyson',
			'required'	 => true,
		), 
		array(
			'name'		 => esc_html__( 'Elementor', 'digiqole' ),
			'slug'		 => 'elementor',
			'required'	 => true,
		),
		array(
			'name'		 => esc_html__( 'Contact form 7', 'digiqole' ),
			'slug'		 => 'contact-form-7',
			'required'	 => true,
		),
		array(
			'name'		 => esc_html__( 'Mailchimp ', 'digiqole' ),
			'slug'		 => 'mailchimp-for-wp',
			'required'	 => true,
      ),
     	array(
			'name'		 => esc_html__( 'Digiqole Essentials', 'digiqole' ),
			'slug'		 => 'digiqole-essential',
			'required'	 => true,
			'version'	 => '1.6',
			'source'     => get_template_directory() . '/core/installation-fragments/plugins/digiqole-essential.zip', // The plugin source.
      ),	
      
   	array(
			'name'		 => esc_html__( 'Wp Ultimate Review kit', 'digiqole' ),
			'slug'		 => 'wp-ultimate-review',
			'required'	 => true,
		),	
   	array(
			'name'		 => esc_html__( 'Elementskit Lite', 'digiqole' ),
			'slug'		 => 'elementskit-lite',
			'required'	 => true,
		),	
   	array(
			'name'		 => esc_html__( 'AccessPress Social Counter', 'digiqole' ),
			'slug'		 => 'accesspress-social-counter',
			'required'	 => true,
		),	
	);


	$config = array(
		'id'			 => 'digiqole', // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path'	 => '', // Default absolute path to bundled plugins.
		'menu'			 => 'digiqole-install-plugins', // Menu slug.
		'parent_slug'	 => 'themes.php', // Parent menu slug.
		'capability'	 => 'edit_theme_options', // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'	 => true, // Show admin notices or not.
		'dismissable'	 => true, // If false, a user cannot dismiss the nag message.
		'dismiss_msg'	 => '', // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic'	 => false, // Automatically activate plugins after installation or not.
		'message'		 => '', // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', 'digiqole_register_required_plugins' );