<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * customizer option: blocks
 */
$options =[
    'blocks_settings' => [
            'title'		 => esc_html__( 'Blog', 'digiqole' ),
            'options'	 => [
               'blog_title' => [
                  'label'	 => esc_html__( 'Global blog title', 'digiqole' ),
                  'type'	 => 'text',
                ],
                
                'blog_header_image' => [
                  'label'	 => esc_html__( 'Global header background image', 'digiqole' ),
                  'type'	 => 'upload',
               ],
                'block_category_template' => [
                    'label'	        => esc_html__( 'Category template', 'digiqole' ),
                    'desc'	        => esc_html__( 'Post block style in category pages.', 'digiqole' ),
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
                       'style7'    => [
                        'small'     => DIGIQOLE_IMG . '/admin/category-main-layout/category_min5.png',
                        'large'     => DIGIQOLE_IMG . '/admin/category-main-layout/screen/style5.png',
                       ],

                       'style8'    => [
                        'small'     => DIGIQOLE_IMG . '/admin/category-main-layout/category_min4.png',
                        'large'     => DIGIQOLE_IMG . '/admin/category-main-layout/screen/style4.png',
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
                    'value'         => '3',
                  ],

                  'blog_post_char_limit' => [
                     'label'	 => esc_html__( 'Post Char Limit', 'digiqole' ),
                     'desc'			 => esc_html__( 'Post Char Limit ex. 110', 'digiqole' ),
                     'type'	 => 'hidden',
                     'value' => 110,
                  ],

                 'blog_list_cat_show' => [
                  'type'			 => 'switch',
                  'label'			 => esc_html__( 'Post category', 'digiqole' ),
                  'desc'			 => esc_html__( 'Do you want to show post category?', 'digiqole' ),
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
                'blog_child_cat_show' => [
                  'type'			 => 'switch',
                  'label'			 => esc_html__( 'Post child category', 'digiqole' ),
                  'desc'			 => esc_html__( 'Do you want to show post child category?', 'digiqole' ),
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
                'blog_list_date_show' => [
                  'type'			 => 'switch',
                  'label'			 => esc_html__( 'Post date', 'digiqole' ),
                  'desc'			 => esc_html__( 'Do you want to show post date?', 'digiqole' ),
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
                'blog_list_author_show' => [
                  'type'			 => 'switch',
                  'label'			 => esc_html__( 'Blog author', 'digiqole' ),
                  'desc'			 => esc_html__( 'Do you want to show blog author?', 'digiqole' ),
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

                'blog_author_avatar_show' => [
                    'type'			 => 'switch',
                    'label'			 => esc_html__( 'Author image show', 'digiqole' ),
                    'desc'			 => esc_html__( 'Do you want to show author avatar image?', 'digiqole' ),
                    'value'          => 'no',
                    'left-choice' => [
                        'value'	 => 'yes',
                        'label'	 => esc_html__( 'Yes', 'digiqole' ),
                    ],
                    'right-choice' => [
                        'value'	 => 'no',
                        'label'	 => esc_html__( 'No', 'digiqole' ),
                    ],
                ],

                'blog_archive_title_show' => [
                    'type'			 => 'switch',
                    'label'			 => esc_html__( 'Archive title show', 'digiqole' ),
                    'desc'			 => esc_html__( 'Do you want to show archive title?', 'digiqole' ),
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

                'blog_category_title_show' => [
                    'type'			 => 'switch',
                    'label'			 => esc_html__( 'Category title show', 'digiqole' ),
                    'desc'			 => esc_html__( 'Do you want to show category title?', 'digiqole' ),
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

                'blog_read_more' => [
                  'type'			 => 'switch',
                  'label'			 => esc_html__( 'Read more', 'digiqole' ),
                  'desc'			 => esc_html__( 'Do you want to show read more buttons?', 'digiqole' ),
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
              
                'blog_read_more_text' => [
                  'label'	 => esc_html__( 'Continue reading', 'digiqole' ),
                  'desc'			 => esc_html__( 'Readmore button text', 'digiqole' ),
                  'type'	 => 'text',
                  'value'   => esc_html__('Read More','digiqole')
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
                
               'blog_pagination_style' => [
                  'label'	        => esc_html__( 'Blog pagination', 'digiqole' ),
                  'type'	        => 'image-picker',
                  'choices'       => [
                    
                     'number'    => [
                        'small'     => DIGIQOLE_IMG . '/admin/pagination/number.png',
                        'large'     => DIGIQOLE_IMG . '/admin/pagination/number.png',
                     ]
                  ],
                  'value'         => 'number',
               ],

                'block_crop_title'      => [
                  'type'    => 'multi-picker',
                  'picker'  => [
                      'block_crop_title_switch'      => [
                          'type'  => 'switch',
                          'value' => 'no',
                          'label' => esc_html__('Post title length', 'digiqole'),
                          'desc'  => esc_html__('Enable disable post title length.', 'digiqole'),
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
                            'label' => esc_html__('Post word length', 'digiqole'),
                            'desc'  => esc_html__('Enable disable  post word length.', 'digiqole'),
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
                                'label' => esc_html__( 'Post word limit.', 'digiqole' ),
                                'desc'  => esc_html__('Post word limit, example: 100', 'digiqole'),
                                'value'  => 35
                            ],
                        ]
                    ]
                ], //
            ],
        ],
    ];