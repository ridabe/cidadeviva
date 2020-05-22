<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * customizer option: footer
 */

$options =[
    'footer_settings' => [
        'title'		 => esc_html__( 'Footer settings', 'digiqole' ),

        'options'	 => [

            'footer_top_show_hide'				 => [
                'type'			 => 'switch',
                'value'			 => 'yes',
                'label'			 => esc_html__( 'Footer Top Show', 'digiqole'),
                'desc'	           => esc_html__( 'footer top / newsletter area show or hide.', 'digiqole' ),

                'left-choice'	 => [
                    'value'	 => 'yes',
                    'label'	 => esc_html__( 'Yes', 'digiqole'),
                ],
                'right-choice'	 => [
                    'value'	 => 'no',
                    'label'	 => esc_html__( 'No', 'digiqole'),
                ],
            ],

            'footer_top_bg_color' => [
                'type'  => 'gradient',
                'label'	        => esc_html__( 'Footer Top BG Color', 'digiqole' ),
                'desc'	           => esc_html__( 'Set footer top / newsletter area background color.', 'digiqole' ),
             ],

            
             'footer_mailchimp' => [
               'label'	 => esc_html__( 'Mailchimp Shortcode', 'digiqole'),
                'type'	 => 'text',
            
             ],

            'ts_footer_widget_title_color' => [
                'label'	 => esc_html__( 'Widget title color', 'digiqole'),
                'type'	 => 'color-picker',
                'value'  => '#fff',
                'desc'	 => esc_html__( 'You can change the widget title color with rgba color or solid color', 'digiqole'),
            ],
            'footer_text_color' => [
                'label'	 => esc_html__( 'Widget text color', 'digiqole'),
                'type'	 => 'color-picker',
                'value'  => '#fff',
                'desc'	 => esc_html__( 'You can change the widget text color with rgba color or solid color', 'digiqole'),
            ],
            
            'footer_bg_url' => [
               'label'	        => esc_html__( 'Footer background Image', 'digiqole' ),
               'type'	        => 'upload',
               'image_only'    => true,
            ],

            'footer_bg_color' => [
                'label'	 => esc_html__( 'Footer Background color', 'digiqole'),
                'type'	 => 'color-picker',
                'value'  => '#222222',
                'desc'	 => esc_html__( 'You can change the Footer background color with rgba color or solid color', 'digiqole'),
            ],

            'footer_copyright_color' => [
                'label'	 => esc_html__( 'Footer Copyright color', 'digiqole'),
                'type'	 => 'color-picker',
                'desc'	 => esc_html__( 'You can change the footer\'s background color with rgba color or solid color', 'digiqole'),
            ],
            'footer_social_title' => [
               'label'	 => esc_html__( 'Social', 'digiqole' ),
               'desc'			 => esc_html__( 'Social text', 'digiqole' ),
               'type'	 => 'text',
               'value'   => esc_html__('Social','digiqole')
            ],
            
         
            'footer_copyright'	 => [
                'type'	 => 'textarea',
                'value'  =>  esc_html__('&copy; 2019, Digiqole. All rights reserved','digiqole'),
                'label'	 => esc_html__( 'Copyright text', 'digiqole' ),
                'desc'	 => esc_html__( 'This text will be shown at the footer of all pages.', 'digiqole' ),
            ],

            'footer_padding_top' => [
                'label'	        => esc_html__( 'Footer Padding Top', 'digiqole' ),
                'desc'	        => esc_html__( 'Use Footer Padding Top', 'digiqole' ),
                'type'	        => 'text',
                'value'         => '100px',
             ],
            'footer_padding_bottom' => [
                'label'	        => esc_html__( 'Footer Padding Bottom', 'digiqole' ),
                'desc'	        => esc_html__( 'Use Footer Padding Bottom', 'digiqole' ),
                'type'	        => 'text',
                'value'         => '100px',
             ],
             'back_to_top'				 => [
                'type'			 => 'switch',
                'value'			 => 'hello',
                'label'			 => esc_html__( 'Back to top', 'digiqole'),
                'left-choice'	 => [
                    'value'	 => 'yes',
                    'label'	 => esc_html__( 'Yes', 'digiqole'),
                ],
                'right-choice'	 => [
                    'value'	 => 'no',
                    'label'	 => esc_html__( 'No', 'digiqole'),
                ],
            ],
            
        ],
            
        ]
    ];