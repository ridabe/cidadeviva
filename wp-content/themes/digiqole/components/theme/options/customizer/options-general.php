<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * customizer option: general
 */

$options =[
    'general_settings' => [
            'title'		 => esc_html__( 'General settings', 'digiqole' ),
            'options'	 => [
               'preloader_show' => [
                  'type'			 => 'switch',
                  'label'		    => esc_html__( 'Preloader show', 'digiqole' ),
                  'desc'			 => esc_html__( 'Do you want to show preloader on your site ?', 'digiqole' ),
                  'value'         => 'no',
                  'left-choice'	 => [
                     'value'     => 'yes',
                     'label'	   => esc_html__( 'Yes', 'digiqole' ),
                  ],
                  'right-choice'	 => [
                     'value'	 => 'no',
                     'label'	 => esc_html__( 'No', 'digiqole' ),
                  ],
                ],
                'preloader_logo' => [
                  'label'	        => esc_html__( 'Preloader logo', 'digiqole' ),
                  'desc'	           => esc_html__( 'When you enable preloader then you can set preloader image otherwise default color preloader you will see', 'digiqole' ),
                  'type'	           => 'upload',
                  'image_only'      => true,
               ],
              

               'general_text_logo' => [
                  'type'			   => 'switch',
                  'label'			   => esc_html__( 'Logo text', 'digiqole' ),
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
                  'general_text_logo_settings' => array(
                     'type' => 'multi-picker',
                     'picker' => 'general_text_logo',
            
                     'choices' => array(
                        'yes' => array(
                           
                           'general_text_logo_title' => array(
                              'type'  => 'text',
                              'value' => 'blog',
                              'label' => __('Title', 'digiqole'),
                           
                           ),
                        ),
                  ),      
                ),
                'general_light_logo' => [
                    'label'	        => esc_html__( 'Light logo', 'digiqole' ),
                    'desc'	           => esc_html__( 'It\'s the Main logo and Footer logo, mostly it will be shown on "dark or coloreful" type area.', 'digiqole' ),
                    'type'	           => 'upload',
                    'image_only'      => true,
                 ],
                'general_dark_logo' => [
                    'label'	        => esc_html__( 'Dark logo', 'digiqole' ),
                    'desc'	           => esc_html__( 'It will be shown on any "light background" type area.', 'digiqole' ),
                    'type'	           => 'upload',
                    'image_only'      => true,
                 ],
                 'logo_style' => [
                    'type' => 'popup',
                    'label' => 'Logo style',
                    'button' => esc_html__( 'logo style', 'digiqole' ),
                    'popup-title' => esc_html__( 'logo style', 'digiqole' ),
                    'size' => 'medium',
                    'popup-options' => [
                       'logo_width' => [
                          'label' => esc_html__( 'Logo width', 'digiqole' ),
                          'type' => 'text',
                          'desc'	           => esc_html__( 'Set Logo width. dont use "px"', 'digiqole' ),
                       ],
                  
                       'Padding_top' => [
                          'label' => esc_html__( 'Logo Padding Top', 'digiqole' ),
                          'type' => 'text',
                          'desc'	           => esc_html__( 'Set Logo top padding. dont use "px"', 'digiqole' ),
                       ],
                       'Padding_bottom' => [
                          'label' => esc_html__( 'Logo Padding bottom', 'digiqole' ),
                          'type' => 'text',
                          'desc'	           => esc_html__( 'Set Logo bottom padding. dont use "px"', 'digiqole' ),
                       ],
                    ]
                ],

                
          
               'blog_breadcrumb_show' => [
                    'type'			    => 'switch',
                    'label'			 => esc_html__( 'Breadcrumb', 'digiqole' ),
                    'desc'			    => esc_html__( 'Do you want to show breadcrumb?', 'digiqole' ),
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

               'breadcrumb_length' => [
                    'type'			    => 'text',
                    'label'			 => esc_html__( 'Breadcrumb word length', 'digiqole' ),
                    'desc'			    => esc_html__( 'The length of the breadcumb text.', 'digiqole' ),
                    'value'          => '3',
                ],
               'general_social_links' => [
                    'type'          => 'addable-popup',
                    'template'      => '{{- title }}',
                    'popup-title'   => null,
                    'label' => esc_html__( 'Social links', 'digiqole' ),
                    'desc'  => esc_html__( 'Add social links and it\'s icon class bellow. These are all fontaweseome-4.7 icons.', 'digiqole' ),
                    'add-button-text' => esc_html__( 'Add new', 'digiqole' ),

                    'popup-options' => [
                        'title' => [ 
                            'type' => 'text',
                            'label'=> esc_html__( 'Title', 'digiqole' ),
                            'value'	 => 'Facebook',
                        ],
                        'icon_class' => [ 
                            'type' => 'new-icon',
                            'value'	 => 'fa fa-facebook',
                            'label'=> esc_html__( 'Social icon', 'digiqole' ),
                        ],
                        'url' => [ 
                            'type' => 'text',
                            'value'	 => '#',
                            'label'=> esc_html__( 'Social link', 'digiqole' ),

                        ],
                    ],
                   
                ],

               'blog_reading_pregressbar' => [
                  'type'			    => 'switch',
                  'label'			 => esc_html__( 'Reading progressbar', 'digiqole' ),
                  'desc'			    => esc_html__( 'Do you want to enable reading progressbar?', 'digiqole' ),
                  'value'          => 'no',
                  'left-choice'	 => [
                      'value'	 => 'yes',
                      'label'	 => esc_html__('Yes', 'digiqole'),
                  ],
                  'right-choice'	 => [
                      'value'	 => 'no',
                      'label'	 => esc_html__('No', 'digiqole'),
                  ],
              ],

              'blog_reading_progressbar_color' => [
               'label' => esc_html__( 'Progressbar color', 'digiqole'),
               'type' => 'color-picker',
               'value' => '#000',
               'desc' => esc_html__( 'You can change the progressbar color with rgba color or solid color', 'digiqole'),
               ],

               'blog_reading_pregressbar_settings' => [
                  'type' => 'multi-picker',
                  'picker' => 'blog_reading_pregressbar',
         
                  'choices' => [
                        'yes' => [
                           'blog_reading_progressbar_area' => [
                              'type'  => 'select-multiple',
                              'value' => ['post'],
                              'label' => esc_html__('Reading progressbar area', 'digiqole'),
                              'desc'  => esc_html__('Select option for reading progressbar on top ', 'digiqole'),
                              'choices' => [
                                 
                                 'post' => esc_html__('Blog Post', 'digiqole'),
                                 'page' => esc_html__('Blog Page', 'digiqole'),
                                 'category' => esc_html__('Blog Category', 'digiqole'),
                                 'all' => esc_html__('All', 'digiqole'),
                                 
                                 ]
                        
                              ],
                        ],

                    ]
               ],
               'general_container_width' => [
                  'type'			    => 'switch',
                  'label'			 => esc_html__( 'Custom Container Width', 'digiqole' ),
                  'desc'			    => esc_html__( 'Do you want to enable custom container width?', 'digiqole' ),
                  'value'          => 'no',
                  'left-choice'	 => [
                      'value'	 => 'yes',
                      'label'	 => esc_html__('Yes', 'digiqole'),
                  ],
                  'right-choice'	 => [
                      'value'	 => 'no',
                      'label'	 => esc_html__('No', 'digiqole'),
                  ],
              ],

              'general_container_width_settings' => [
               'type' => 'multi-picker',
               'picker' => 'general_container_width',
      
               'choices' => [
                     'yes' => [
                        'container_width_laptop' => [
                           'type'  => 'slider',
                           'value' => 960,
                           'properties' => [
                             
                              'min' => 900,
                              'max' => 3000,
                              'step' => 1, 
                             
                           ],
                           'label' => esc_html__('Container width laptop', 'digiqole'),
                        ],
                        'container_width_desktop' => [
                           'type'  => 'slider',
                           'value' => 1200,
                           'properties' => [
                             
                              'min' => 900,
                              'max' => 3000,
                              'step' => 1, 
                             
                           ],
                           'label' => esc_html__('Container width Desktop', 'digiqole'),
                        ],
                     ],

                 ]
            ],
            ],
        ],
    ];
