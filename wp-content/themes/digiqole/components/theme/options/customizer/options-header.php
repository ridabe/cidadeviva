<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * customizer option: Header
 */
$header_settings = digiqole_option('theme_header_default_settings');
$header_id = '';
$header_builder_enable = digiqole_option('header_builder_enable');
if($header_builder_enable=='yes'){
   $header_id =   $header_settings['yes']['digiqole_header_builder_select'];
}

$options =[
    'header_settings' => [
        'title'		 => esc_html__( 'Header settings', 'digiqole' ),

        'options'	 => [
            
            'header_builder_enable' => [
               'type'			   => 'switch',
               'label'			   => esc_html__( 'Header builder Enable', 'digiqole' ),
               'desc'			   => '' ,
               'value'           => 'no',
               'left-choice'	 => [
                   'value'	 => 'yes',
                   'label'	 => esc_html__('Yes', 'digiqole'),
               ],
               'right-choice'	 => [
                  'value'	 => 'no',
                  'label'	 => esc_html__('No', 'digiqole'),
                 ],
               ],
         
              'theme_header_default_settings' => array(
                  'type' => 'multi-picker',
                  'picker' => 'header_builder_enable',
         
                  'choices' => array(
                     'yes' => array(
                        'digiqole_header_builder_select' =>array(
                           'type'  => 'select',
                         
                           'attr'  => array( 'class' => 'digiqole_header_builder_select', 'data-foo' => 'digiqole_header_builder_select' ),
                           'label' => __('Header style', 'digiqole'),
                        
                           'choices' => digiqole_ekit_headers(),
                         
                           'no-validate' => false,
                        ),
                        'edit_header' => array(
                           'type'  => 'html',
                           'value' => '',
                        
                           'label' => __('edit', 'digiqole'),
                           'html'  => '<h3 class="header_builder_edit"><a class="digiqole_header_builder_edit_link" target="_blank" href='. admin_url( 'action=elementor&post='.$header_id ). '>'. esc_html('Edit'). '</a><h3>' ,
                      ),
                     ),

                      
         
                     'no' => array(
                        'header_layout_style' => [
                           'label'	        => esc_html__( 'Header style', 'digiqole' ),
                           'desc'	        => esc_html__( 'This is the site\'s main header style.', 'digiqole' ),
                           'type'	        => 'image-picker',
                           'attr'  => array( 'class' => 'header_layout_style', 'data-foo' => 'bar' ),
                           'choices'       => [
                            
                              'standard'    => [
                                   'small'     => DIGIQOLE_IMG . '/admin/header-style/style1.png',
                                   'large'     => DIGIQOLE_IMG . '/admin/header-style/style1.png',
                               ],
                               'style2'    => [
                                   'small'     => DIGIQOLE_IMG . '/admin/header-style/style2.png',
                                   'large'     => DIGIQOLE_IMG . '/admin/header-style/style2.png',
                               ],
                               'style3'    => [
                                   'small'     => DIGIQOLE_IMG . '/admin/header-style/style3.png',
                                   'large'     => DIGIQOLE_IMG . '/admin/header-style/style3.png',
                                   ],
                               'style4'    => [
                                   'small'     => DIGIQOLE_IMG . '/admin/header-style/style4.png',
                                   'large'     => DIGIQOLE_IMG . '/admin/header-style/style4.png',
                                ],
                               'style5'    => [
                                   'small'     => DIGIQOLE_IMG . '/admin/header-style/style5.png',
                                   'large'     => DIGIQOLE_IMG . '/admin/header-style/style5.png',
                                ],
                               'style6'    => [
                                   'small'     => DIGIQOLE_IMG . '/admin/header-style/style6.png',
                                   'large'     => DIGIQOLE_IMG . '/admin/header-style/style6.png',
                                ],
                               'style7'    => [
                                   'small'     => DIGIQOLE_IMG . '/admin/header-style/style7.png',
                                   'large'     => DIGIQOLE_IMG . '/admin/header-style/style7.png',
                                ],
                               'style8'    => [
                                   'small'     => DIGIQOLE_IMG . '/admin/header-style/style8.png',
                                   'large'     => DIGIQOLE_IMG . '/admin/header-style/style8.png',
                                ],
                               'style9'    => [
                                   'small'     => DIGIQOLE_IMG . '/admin/header-style/style9.png',
                                   'large'     => DIGIQOLE_IMG . '/admin/header-style/style9.png',
                                ],
                               'style10'    => [
                                   'small'     => DIGIQOLE_IMG . '/admin/header-style/style10.png',
                                   'large'     => DIGIQOLE_IMG . '/admin/header-style/style10.png',
                                ],
                           
                                   
                           ],
                           'value'         => 'standard',
                        ], //Header style
           

                        'header_nav_sticky' => [
                          'type'			   => 'switch',
                          'label'			   => esc_html__( 'Sticky header', 'digiqole' ),
                          'desc'			   => esc_html__('Do you want to enable sticky nav?', 'digiqole' ),
                          'value'           => 'no',
                          'left-choice'	 => [
                              'value'	 => 'yes',
                              'label'	 => esc_html__('Yes', 'digiqole'),
                          ],
                          'right-choice'	 => [
                             'value'	 => 'no',
                             'label'	 => esc_html__('No', 'digiqole'),
                            ],
                         ],
           
                         
           
                        'header_top_info_show' => [
                          'type'			    => 'switch',
                          'label'			 => esc_html__( 'Topbar', 'digiqole' ),
                          'desc'			    => esc_html__( 'Do you want to show topbar?', 'digiqole' ),
                          'value'          => 'yes',
                          'left-choice'	 => [
                              'value'	 => 'yes',
                              'label'	 => esc_html__('Yes', 'digiqole'),
                          ],
           
                          'right-choice'	 => [
                              'value'	 => 'no',
                              'label'	 => esc_html__('No', 'digiqole'),
                             ],
                          ],
           
                          'topbar_style' => [
                            'type' => 'popup',
                            'label' => 'Topbar style',
                            'button' => esc_html__( 'Topbar style', 'digiqole' ),
                            'popup-title' => esc_html__( 'topbar style', 'digiqole' ),
                            'size' => 'medium',
                            'popup-options' => [
                               'topbar_padding_top' => [
                                  'label' => esc_html__( 'Topbar Padding top', 'digiqole' ),
                                  'type' => 'text',
                                  'desc'	           => esc_html__( 'Set topbar padding top. dont use "px"', 'digiqole' ),
                               ],
                          
                               'topbar_padding_bottom' => [
                                  'label' => esc_html__( 'Topbar Padding bottom', 'digiqole' ),
                                  'type' => 'text',
                                  'desc'	           => esc_html__( 'Set topbar bottom padding. dont use "px"', 'digiqole' ),
                               ],
                               'topbat_bg_color' => [
                                  'label'	        => esc_html__( 'Topbar background color', 'digiqole' ),
                                  'desc'	           => esc_html__( 'Set topbar background color.', 'digiqole' ),
                                  'type'	           => 'color-picker',
                              ],
                               'topbar_color' => [
                                  'label'	        => esc_html__( 'Topbar Text color', 'digiqole' ),
                                  'desc'	           => esc_html__( 'Set topbar text color.', 'digiqole' ),
                                  'type'	           => 'color-picker',
                              ],
                            ]
                          ],
                          'header_nav_search_section' => [
                             'type'			 => 'switch',
                             'label'		    => esc_html__( 'Search button show', 'digiqole' ),
                             'desc'			 => esc_html__( 'Do you want to show search button in header ?', 'digiqole' ),
                             'value'         => 'yes',
                             'left-choice'	 => [
                                'value'     => 'yes',
                                'label'	   => esc_html__( 'Yes', 'digiqole' ),
                             ],
                             'right-choice'	 => [
                                'value'	 => 'no',
                                'label'	 => esc_html__( 'No', 'digiqole' ),
                             ],
                           ],
           
                        
                           'header_social_share' => [
                             'type'			 => 'switch',
                             'label'			 => esc_html__( 'Social share', 'digiqole' ),
                             'desc'			 => esc_html__( 'Do you want to show social share buttons in header?', 'digiqole' ),
                             'value'          => 'yes',
                             'left-choice' => [
                                 'value'	 => 'yes',
                                 'label'	 => esc_html__( 'Yes', 'digiqole' ),
                             ],
                             'right-choice' => [
                                 'value'	 => 'no',
                                 'label'	 => esc_html__( 'No', 'digiqole' ),
                             ],
                           ],
                     )
                  )
            ),
    
           
            
             
        
        ], //Options end
    ]
];

