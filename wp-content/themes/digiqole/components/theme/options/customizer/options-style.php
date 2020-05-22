<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * customizer option: style
 */
$options =[
    'style_settings' => [
            'title'		 => esc_html__( 'Style settings', 'digiqole' ),
            'options'	 => [
                'general_body_box_layout' => array(
                    'type'         => 'multi-picker',
                    'label'        => false,
                    'desc'         => false,
                    'picker'       => array(
                        'style' => array(
                            'type'			 => 'switch',
                            'label'		 => esc_html__( 'Body box layout', 'digiqole' ),
                            'value'       => 'no',
                            'left-choice'	 => [
                               'value'   	     => 'yes',
                               'label'	        => esc_html__( 'Yes', 'digiqole' ),
                            ],
                            'right-choice'	 => [
                               'value'	 => 'no',
                               'label'	 => esc_html__( 'No', 'digiqole' ),
                            ],
                          
                        )
                    ),
                    'choices'      => array(
                         'yes' => array(
                          'general_body_box_bg_image' => [
                             'type'  => 'upload',
                             'label'			    => esc_html__( 'Background Image', 'digiqole' ),
                             'desc'			    => esc_html__( 'Body background image', 'digiqole' ),
                             'images_only' => true,
                            
                          ],
                         
                         ),
                      
                      
                     
                    ),
                    'show_borders' => false,
                ), 

                'style_theme_setting' => [
                    'type'			 => 'switch',
                    'label'			 => esc_html__( 'Theme dark style?', 'digiqole' ),
                    'desc'			 => esc_html__( 'Do you want to use theme style?', 'digiqole' ),
                    'value'          => 'light',
                    'left-choice'	 => [
                        'value'	 => 'dark',
                        'label'	 => esc_html__( 'Dark', 'digiqole' ),
                    ],
                    'right-choice'	 => [
                        'value'	 => 'light',
                        'label'	 => esc_html__( 'Light', 'digiqole' ),
                    ],
                ],
                
                'style_body_bg' => [
                    'label'	        => esc_html__( 'Body background', 'digiqole' ),
                    'desc'	           => esc_html__( 'Site\'s main background color.', 'digiqole' ),
                    'type'	           => 'color-picker',
                 ],

                'style_primary' => [
                    'label'	        => esc_html__( 'Primary color', 'digiqole' ),
                    'desc'	           => esc_html__( 'Site\'s main color.', 'digiqole' ),
                    'type'	           => 'color-picker',
                ],

                'secondary_color' => [
                    'label'	        => esc_html__( 'Secondary color', 'digiqole' ),
                    'desc'	           => esc_html__( 'Secondary color.', 'digiqole' ),
                    'type'	           => 'color-picker',
                ],
                
                'body_color' => [
                'label'	        => esc_html__( 'Body Text color', 'digiqole' ),
                'desc'	        => esc_html__( 'Body Text color.', 'digiqole' ),
                'type'	        => 'color-picker',
                ],
                'title_color' => [
                'label'	        => esc_html__( 'Title color', 'digiqole' ),
                'desc'	        => esc_html__( 'Blog title color.', 'digiqole' ),
                'type'	        => 'color-picker',
                ],


              

                'body_font'    => array(
                    'type' => 'typography-v2',
                    'label' => esc_html__('Body Font', 'digiqole'),
                    'desc'  => esc_html__('Choose the typography for the title', 'digiqole'),
                    'value' => array(
                        'family' => 'Roboto',
                        'size'  => '14',
                        'font-weight' => '400',
                    ),
                    'components' => array(
                        'family'         => true,
                        'size'           => true,
                        'line-height'    => false,
                        'letter-spacing' => false,
                        'color'          => false,
                        'font-weight'    => true,
                    ),
                ),
                
                'heading_font_one'	 => [
                    'type'		 => 'typography-v2',
                    'value'		 => [
                        'family'		 => 'Barlow',
                        'size'  => '',
                        'font-weight' => '700',
                    ],
                    'components' => [
                        'family'         => true,
                        'size'           => true,
                        'line-height'    => false,
                        'letter-spacing' => false,
                        'color'          => false,
                        'font-weight'    => true,
                    ],
                    'label'		 => esc_html__( 'Heading H1 and H2 Fonts', 'digiqole' ),
                    'desc'		    => esc_html__( 'This is for heading google fonts', 'digiqole' ),
                ],

                'heading_font_two'	 => [
                    'type'		    => 'typography-v2',
                    'value'		 => [
                        'family'		  => 'Barlow',
                        'size'        => '',
                        'font-weight' => '700',
                    ],
                    'components' => [
                        'family'         => true,
                        'size'           => true,
                        'line-height'    => false,
                        'letter-spacing' => false,
                        'color'          => false,
                        'font-weight'    => true,
                    ],
                    'label'		 => esc_html__( 'Heading H3 Fonts', 'digiqole' ),
                    'desc'		    => esc_html__( 'This is for heading google fonts', 'digiqole' ),
                ],

                'heading_font_three'	 => [
                    'type'		    => 'typography-v2',
                    'value'		 => [
                        'family'		  => 'Barlow',
                        'size'        => '',
                        'font-weight' => '700',
                    ],
                    'components' => [
                        'family'         => true,
                        'size'           => true,
                        'line-height'    => false,
                        'letter-spacing' => false,
                        'color'          => false,
                        'font-weight'    => true,
                    ],
                    'label'		 => esc_html__( 'Heading H4 Fonts', 'digiqole' ),
                    'desc'		    => esc_html__( 'This is for heading google fonts', 'digiqole' ),
                ],
            
            ],
        ],
    ];