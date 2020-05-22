<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * customizer option: ads
 */
$options =[
    'ads_settings' => [
            'title'		 => esc_html__( 'Ads settings', 'digiqole' ),
            'options'	 => [
                'top_banner' => [
                    'type' => 'popup',
                    'label' => 'Top banner',
                    'button' => esc_html__( 'Top banner', 'digiqole' ),
                    'popup-title' => esc_html__( 'Top banner', 'digiqole' ),
                    'size' => 'medium',
                    'popup-options' => [
                        'ad_link'	 => [
                            'type'	 => 'text',
                            'label'	 => esc_html__( 'Ad link', 'digiqole' ),
                        ],
                        'ad_image' => [
                            'label'	        => esc_html__( 'Ad Image', 'digiqole' ),
                            'type'	        => 'upload',
                            'image_only'    => true,
                         ],
                        'ad_html'	 => [
                            'type'	 => 'textarea',
                            'label'	 => esc_html__( 'Ad html', 'digiqole' ),
                            'desc'	 => esc_html__( 'You can use Adsense code here.', 'digiqole' ),
                        ],
                    ]
                ],

                'single_blog_banner' => [
                  'type' => 'popup',
                  'label' => 'Single blog Ad one',
                  'button' => esc_html__( 'Single blog Ad', 'digiqole' ),
                  'popup-title' => esc_html__( 'Single blog Ad', 'digiqole' ),
                  'size' => 'medium',
                  'popup-options' => [
                     'single_ad_enable' => [
                        'type'			    => 'switch',
                        'label'			 => esc_html__( 'Enable Ad', 'digiqole' ),
                        'desc'			    => esc_html__( 'Do you want to enable Ad?', 'digiqole' ),
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

                    'single_ad_link'	 => [
                     'type'	 => 'text',
                     'label'	 => esc_html__( 'Ad link', 'digiqole' ),
                     ],

                    'single_ad_image' => [
                        'label'	        => esc_html__( 'Ad Image', 'digiqole' ),
                        'type'	        => 'upload',
                        'image_only'    => true,
                     ], 
                     'single_ad_html'	 => [
                          'type'	 => 'textarea',
                          'label'	 => esc_html__( 'Ad html', 'digiqole' ),
                          'desc'	 => esc_html__( 'You can use Adsense code here.', 'digiqole' ),
                     ],

                     'single_ad_position' => [
                        'type'  => 'select',
                        'value' => 'after_content',
                        'label' => esc_html__('Ad position', 'digiqole'),
                        'choices' => array(
                           '' => '---',
                           'before_title' => esc_html__('Before post title', 'digiqole'),
                           'before_content' => esc_html__('Before post content', 'digiqole'),
                           'after_content'  => esc_html__('After post content', 'digiqole'),
                           'after_tag' => esc_html__('After post tag', 'digiqole'),
                          
                         
                        ),
                      
                     ]


                  ]
              ],

              'single_blog_banner_two' => [
               'type' => 'popup',
               'label' => 'Single blog Ad two',
               'button' => esc_html__( 'Single blog Ad', 'digiqole' ),
               'popup-title' => esc_html__( 'Single blog Ad', 'digiqole' ),
               'size' => 'medium',
               'popup-options' => [
                  'single_ad_enable' => [
                     'type'			    => 'switch',
                     'label'			 => esc_html__( 'Enable Ad', 'digiqole' ),
                     'desc'			    => esc_html__( 'Do you want to enable Ad?', 'digiqole' ),
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

                 'single_ad_link'	 => [
                  'type'	 => 'text',
                  'label'	 => esc_html__( 'Ad link', 'digiqole' ),
                  ],

                 'single_ad_image' => [
                     'label'	        => esc_html__( 'Ad Image', 'digiqole' ),
                     'type'	        => 'upload',
                     'image_only'    => true,
                  ], 
                  'single_ad_html'	 => [
                       'type'	 => 'textarea',
                       'label'	 => esc_html__( 'Ad html', 'digiqole' ),
                       'desc'	 => esc_html__( 'You can use Adsense code here.', 'digiqole' ),
                  ],

                  'single_ad_position' => [
                     'type'  => 'select',
                     'value' => 'after_content',
                     'label' => esc_html__('Ad position', 'digiqole'),
                     'choices' => array(
                        '' => '---',
                        'before_title' => esc_html__('Before post title', 'digiqole'),
                        'before_content' => esc_html__('Before post content', 'digiqole'),
                        'after_content'  => esc_html__('After post content', 'digiqole'),
                        'after_tag' => esc_html__('After post tag', 'digiqole'),
                       
                      
                     ),
                   
                  ]


               ]
           ],



            ],
        ],
    ];