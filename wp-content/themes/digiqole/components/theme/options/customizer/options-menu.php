<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * customizer option: menu
 */
$options =[
    'menu_style_settings' => [
            'title'		 => esc_html__( 'Menu Style settings', 'digiqole' ),
            'options'	 => [

        
              'navmenu_height'	 => [
                  'type'		 => 'slider',
                  'properties' => [
                        
                           'min' => 0,
                           'max' => 200,
                           'step' => 1, 
                        
                        ],
                        'label'		 => esc_html__( 'Menu Height', 'digiqole' ),
                  ],
               
                'menu_bg_color' => [
                    'type'  => 'gradient',
                    'label'	        => esc_html__( 'Menu background', 'digiqole' ),
                    'desc'	           => esc_html__( 'Set Menu background color.', 'digiqole' ),
                 ],

                'menu_color' => [
                    'label'	        => esc_html__( 'Menu color', 'digiqole' ),
                    'desc'	           => esc_html__( 'Set Menu color.', 'digiqole' ),
                    'type'	           => 'color-picker',
                ],
                'menu_hover_color' => [
                    'label'	        => esc_html__( 'Menu hover color', 'digiqole' ),
                    'desc'	           => esc_html__( 'Set Menu Hover color.', 'digiqole' ),
                    'type'	           => 'color-picker',
                ],

                'submenu_color' => [
                    'label'	        => esc_html__( 'Sub Menu color', 'digiqole' ),
                    'desc'	           => esc_html__( 'Set sub menu color.', 'digiqole' ),
                    'type'	           => 'color-picker',
                ],
                'submenu_hover_color' => [
                    'label'	        => esc_html__( 'Sub hover color', 'digiqole' ),
                    'desc'	           => esc_html__( 'sub menu color.', 'digiqole' ),
                    'type'	           => 'color-picker',
                ],

                'humberger_color' => [
                    'label'	        => esc_html__( 'Humberger Color', 'digiqole' ),
                    'desc'	           => esc_html__( 'only for tab and mobile device', 'digiqole' ),
                    'type'	           => 'color-picker',
                ],
         
                'menu_font'    => array(
                    'type' => 'typography-v2',
                    'label' => esc_html__('Menu Font', 'digiqole'),
                    'desc'  => esc_html__('Choose the typography for the menu', 'digiqole'),
                    'value' => array(
                           'family' => 'Roboto',
                           'size' => 14,
                           'font-weight' => 700,
                           'line-height' => 70,
                           
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
                
                'submenu_font'	 => [
                    'type'		 => 'slider',
                    'value' => 12,
                    'properties' => [
                      
                       'min' => 0,
                       'max' => 50,
                       'step' => 1, 
                      
                    ],
                    'label'		 => esc_html__( 'Sub menu fonts size', 'digiqole' ),
                ],
            
            ],
        ],
    ];