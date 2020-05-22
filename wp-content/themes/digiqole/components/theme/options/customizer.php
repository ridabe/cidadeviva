<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * options for wp customizer
 * section name format: digiqole_section_{section name}
 */
$options = [
	'digiqole_section_theme_settings' => [
		'title'				 => esc_html__( 'Theme settings', 'digiqole' ),
		'options'			 => Digiqole_Theme_Includes::_customizer_options(),
		'wp-customizer-args' => [
			'priority' => 3,
		],
	],
];
