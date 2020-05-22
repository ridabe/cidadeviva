<?php if (!defined('ABSPATH')) die('Direct access forbidden.');

$options = [
    
    'featured_upload_img' => [
        'label'	        => esc_html__( 'upload feature image', 'digiqole' ),
        'desc'	        => esc_html__( 'This will be used as the image', 'digiqole' ),
        'type'	        => 'upload',
    ],

    'block_highlight_color' => [
        'label'	        => esc_html__( 'Highlight color', 'digiqole' ),
        'desc'	        => esc_html__( 'This will be used as the primary color for this category', 'digiqole' ),
        'type'	        => 'color-picker',
        'value'         => '#fc4a00',
    ],
    'block_secondary_color' => [
        'label'	        => esc_html__( 'Text color', 'digiqole' ),
        'desc'	        => esc_html__( 'Choose a color that is easily readable within the highlight color background.', 'digiqole' ),
        'type'	        => 'color-picker',
        'value'         => '#ffffff',
    ],
    'block_bg_color' => [
      'label'	        => esc_html__( 'background color', 'digiqole' ),
      'desc'	        => esc_html__( 'Choose a color that is easily readable within the highlight color background.', 'digiqole' ),
      'type'	        => 'hidden',
      'value'         => '#ffffff',
    ],
    'override_default'	 => [
        'type'	 => 'switch',
        'value'	 => 'no',
        'label'	 => esc_html__( 'Override default layouts?', 'digiqole' ),
        'desc'	 => esc_html__( 'You can change the default options from customizer\'s "Blog settings".', 'digiqole' ),
        'left-choice' => [
            'value' => 'yes',
            'label' => esc_html__( 'Yes', 'digiqole' ),
        ],
        'right-choice' => [
            'value' => 'no',
            'label' => esc_html__( 'No', 'digiqole' ),
        ],
    ],
 

    'block_category_template' => [
        'label'	        => esc_html__( 'Category template', 'digiqole' ),
        'desc'	        => esc_html__( 'Category block style in category pages.', 'digiqole' ),
        'type'	        => 'image-picker',
        'choices'       => [
           
         'style1'    => [
            'small'     => DIGIQOLE_IMG . '/admin/category-main-layout/category_min1.png',
            'large'     => DIGIQOLE_IMG . '/admin/category-main-layout/screen/style1.png',
         ],

        'style2'    => [
            'small'     => DIGIQOLE_IMG . '/admin/category-main-layout/category_min2.png',
           'large'     => DIGIQOLE_IMG . '/admin/category-main-layout/screen/style2.png',
        ],

        'style3'    => [
          'small'     => DIGIQOLE_IMG . '/admin/category-main-layout/category_min3.png',
          'large'     => DIGIQOLE_IMG . '/admin/category-main-layout/screen/style3.png',
        ],

       'style4'    => [
            'small'     => DIGIQOLE_IMG . '/admin/category-main-layout/category_min4.png',
            'large'     => DIGIQOLE_IMG . '/admin/category-main-layout/screen/style4.png',
        ],

        'style5'    => [
             'small'     => DIGIQOLE_IMG . '/admin/category-main-layout/category_min5.png',
             'large'     => DIGIQOLE_IMG . '/admin/category-main-layout/screen/style5.png',
        ],

        'style6'    => [
            'small'     => DIGIQOLE_IMG . '/admin/category-main-layout/category_min6.png',
            'large'     => DIGIQOLE_IMG . '/admin/category-main-layout/screen/style6.png',
        ],
   
       
        ],
        'value'         => 'style2',
     ],
    
     'block_featured_post'      => [
      'type'			 => 'switch',
      'label'			 => esc_html__( 'Block feature post', 'digiqole' ),
      'desc'			 => esc_html__( 'Do you want to show the feature post in category page?', 'digiqole' ),
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
    
    'block_sidebar_layout' => [
      'label'	        => esc_html__( 'Category sidebar layout', 'digiqole' ),
      'desc'	        => esc_html__( 'The sidebar position of a blog category.', 'digiqole' ),
      'type'	        => 'image-picker',
      'choices'       => [
          'sidebar-right'    => [
              'small'     => DIGIQOLE_IMG . '/admin/category-sidebar-layout/min-sidebar-right.png',
              'large'     => DIGIQOLE_IMG . '/admin/category-sidebar-layout/sidebar-right.png',
          ],
          'sidebar-none'    => [
              'small'     => DIGIQOLE_IMG . '/admin/category-sidebar-layout/min-sidebar-none.png',
              'large'     => DIGIQOLE_IMG . '/admin/category-sidebar-layout/sidebar-none.png',
          ]
      ],
      'value'         => 'sidebar-right',
   ],
    'block_pagination_alignment'      => [
        'type'  => 'radio',
        'value' => 'center',
        'label' => esc_html__('Pagination alignment', 'digiqole'),
        'desc'  => esc_html__('Pagination alignment in blog category page.', 'digiqole'),
        'choices' => [
            'left' => esc_html__('Left', 'digiqole'),
            'center' => esc_html__('Center', 'digiqole'),
            'right' => esc_html__('Right', 'digiqole'),
        ],
        'inline' => true,
    ],
    'block_crop_title'      => [
        'type'    => 'multi-picker',
        'picker'  => [
            'block_crop_title_switch'      => [
                'type'  => 'switch',
                'value' => 'no',
                'label' => esc_html__('Custom post title length', 'digiqole'),
                'desc'  => esc_html__('Enable disable custom post title length.', 'digiqole'),
                'left-choice' => [
                    'value' => 'yes',
                    'label' => esc_html__( 'Yes', 'digiqole' ),
                ],
                'right-choice' => [
                    'value' => 'no',
                    'label' => esc_html__( 'No', 'digiqole' ),
                ],
            ],
        ],
        'choices' => [
            'yes' => [
                'block_crop_title_limit'	 => [
                    'type'	 => 'text',
                    'label' => esc_html__( 'Post title limit.', 'digiqole' ),
                    'desc'  => esc_html__('Post title limit, example: 10', 'digiqole'),
                    'value'  => 10
                ],
            ]
        ]
    ], // 
    'block_crop_desc'      => [
        'type'    => 'multi-picker',
        'picker'  => [
            'block_crop_desc_switch'      => [
                'type'  => 'switch',
                'value' => 'no',
                'label' => esc_html__('Custom post word length', 'digiqole'),
                'desc'  => esc_html__('Enable disable custom post word length.', 'digiqole'),
                'left-choice' => [
                    'value' => 'yes',
                    'label' => esc_html__( 'Yes', 'digiqole' ),
                ],
                'right-choice' => [
                    'value' => 'no',
                    'label' => esc_html__( 'No', 'digiqole' ),
                ],
            ],
        ],
        'choices' => [
            'yes' => [
                'block_crop_desc_limit'	 => [
                    'type'	 => 'text',
                    'label'	 => esc_html__( 'Post word limit.', 'digiqole' ),
                    'desc'  => esc_html__('Post word limit, example: 100', 'digiqole'),
                    'value'  => 35
                ],
            ]
        ]
    ], //
];