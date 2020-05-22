<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * customizer option: blog
 */

$options =[
    'blog_settings' => [
        'title'		 => esc_html__( 'Blog Single', 'digiqole' ),

        'options'	 => [
       
            'blog_sticky_sidebar' => [
                'type'			 => 'switch',
                'label'			 => esc_html__( 'Blog sticky sidebar', 'digiqole' ),
                'desc'			 => esc_html__( 'Do you want to enable sticky sidebar?', 'digiqole' ),
                'value'          => 'no',
                'left-choice'	 => [
                    'value'	 => 'yes',
                    'label'	 => esc_html__( 'Yes', 'digiqole' ),
                ],
                'right-choice'	 => [
                    'value'	 => 'no',
                    'label'	 => esc_html__( 'No', 'digiqole' ),
                ],
            ],
           
            'post_header_layout' => [
               'label'	        => esc_html__( 'Post header layout', 'digiqole' ),
               'desc'	        => esc_html__( 'Single post\'s header style.', 'digiqole' ),
               'type'	        => 'image-picker',
               'choices'       => [
                  'style1'    => [
                     'small'     => DIGIQOLE_IMG . '/admin/post-header-layout/min-style1.png',
                     'large'     => DIGIQOLE_IMG . '/admin/post-header-layout/style1.png',
                  ],
                  'style2'    => [
                     'small'     => DIGIQOLE_IMG . '/admin/post-header-layout/min-style9.png',
                     'large'     => DIGIQOLE_IMG . '/admin/post-header-layout/style9.png',
                  ],
                  'style3'    => [
                     'small'     => DIGIQOLE_IMG . '/admin/post-header-layout/min-style2.png',
                     'large'     => DIGIQOLE_IMG . '/admin/post-header-layout/style2.png',
                  ],
                  'style4'    => [
                     'small'     => DIGIQOLE_IMG . '/admin/post-header-layout/min-style5.png',
                     'large'     => DIGIQOLE_IMG . '/admin/post-header-layout/style5.png',
                  ],
                  'style5'    => [
                     'small'     => DIGIQOLE_IMG . '/admin/post-header-layout/min-style6.png',
                     'large'     => DIGIQOLE_IMG . '/admin/post-header-layout/style6.png',
                  ],
                  'style6'    => [
                     'small'     => DIGIQOLE_IMG . '/admin/post-header-layout/min-style7.png',
                     'large'     => DIGIQOLE_IMG . '/admin/post-header-layout/style7.png',
                  ],
                  'style7'    => [
                    'small'     => DIGIQOLE_IMG . '/admin/post-header-layout/min-style4.png',
                    'large'     => DIGIQOLE_IMG . '/admin/post-header-layout/style4.png',
                 ],
                 'style8'    => [
                    'small'     => DIGIQOLE_IMG . '/admin/post-header-layout/min-style1.png',
                    'large'     => DIGIQOLE_IMG . '/admin/post-header-layout/style1.png',
                 ],
               ],
               'value'         => 'style1',
            ],

            'post_sidebar_layout' => [
               'label'	        => esc_html__( 'Post sidebar layout', 'digiqole' ),
               'desc'	        => esc_html__( 'The sidebar position of a blog post.', 'digiqole' ),
               'type'	        => 'image-picker',
               'choices'       => [
                  'sidebar-right'    => [
                     'small'     => DIGIQOLE_IMG . '/admin/post-sidebar-layout/min-sidebar-right.png',
                     'large'     => DIGIQOLE_IMG . '/admin/post-sidebar-layout/sidebar-right.png',
                  ],
                  'sidebar-none'    => [
                     'small'     => DIGIQOLE_IMG . '/admin/post-sidebar-layout/min-sidebar-none.png',
                     'large'     => DIGIQOLE_IMG . '/admin/post-sidebar-layout/sidebar-none.png',
                  ]
               ],
               
               'value'         => 'style1',
             ],
       
            'show_view_count' => [
                  'type'			 => 'switch',
                  'label'			 => esc_html__( 'Post view counter', 'digiqole' ),
                  'desc'			 => esc_html__( 'Do you want to show the view counter in posts?', 'digiqole' ),
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

            'blog_post_comment' => [
               'type'			 => 'switch',
               'label'			 => esc_html__( 'Post Comment', 'digiqole' ),
               'desc'			 => esc_html__( 'Do you want to show comment?', 'digiqole' ),
               'value'          => 'yes',
               'left-choice'	 => [
                   'value'	 => 'yes',
                   'label'	 => esc_html__( 'Yes', 'digiqole' ),
               ],
               'right-choice'	 => [
                   'value'	 => 'no',
                   'label'	 => esc_html__( 'No', 'digiqole' ),
               ],
            ],
          
            
            'blog_author_image_show' => [
               'type'			 => 'switch',
               'label'			 => esc_html__( 'Author image show', 'digiqole' ),
               'desc'			 => esc_html__( 'Do you want to show author image?', 'digiqole' ),
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
          
         'blog_author_show' => [
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
           'blog_navigation_show' => [
            'type'			 => 'switch',
            'label'			 => esc_html__( 'Blog navigation', 'digiqole' ),
            'desc'			 => esc_html__( 'Do you want to show single blog navigation post?', 'digiqole' ),
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
           
           'blog_social_share_show' => [
               'type'			 => 'switch',
               'label'			 => esc_html__( 'Social share', 'digiqole' ),
               'desc'			 => esc_html__( 'Do you want to show social share buttons?', 'digiqole' ),
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
            'blog_related_post' => [
                'type'			 => 'switch',
                'label'			 => esc_html__( 'Blog related post', 'digiqole' ),
                'desc'			 => esc_html__( 'Do you want to show single blog related post?', 'digiqole' ),
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
           'blog_related_post_title' => [
            'label'	 => esc_html__( 'Related post title', 'digiqole' ),
            'type'	 => 'text',
            'value'	 =>  esc_html__( 'Related post', 'digiqole' ),
           ],

           'blog_related_post_number' => [
            'label'	 => esc_html__( 'Related post count', 'digiqole' ),
            'type'	 => 'text',
            'value'	 => 3,
           ],

         
          'blog_read_time_show' => [
            'type'			 => 'switch',
            'label'			 => esc_html__( 'Read Time', 'digiqole' ),
            'desc'			 => esc_html__( 'Do you want to show read time buttons?', 'digiqole' ),
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
        
         
          'blog_cat_show' => [
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

          
          'blog_date_show' => [
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

         

          'blog_cat_single' => [
            'type'			 => 'switch',
            'label'			 => esc_html__( 'Show multiple category', 'digiqole' ),
            'desc'			 => esc_html__( 'Do you want to show post single or multiple category ?', 'digiqole' ),
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
          'blog_author_show_footer' => [
            'type'			 => 'switch',
            'label'			 => esc_html__( 'Blog author footer', 'digiqole' ),
            'desc'			 => esc_html__( 'Do you want to show blog author in post footer ?', 'digiqole' ),
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
          'blog_social_share' => [
            'type'          => 'addable-popup',
            'template'      => '{{- social }}',
            'popup-title'   => null,
            'label' => esc_html__( 'Social share', 'digiqole' ),
            'desc'  => esc_html__( 'Add social links and it\'s icon class bellow. These are all fontaweseome-4.7 icons.', 'digiqole' ),
            'add-button-text' => esc_html__( 'Add new', 'digiqole' ),

            'popup-options' => [
               'icon_class' => [ 
                  'type' => 'new-icon',
                  'label'=> esc_html__( 'Social icon', 'digiqole' ),
                ],
                'social' => array(
                  'type'  => 'select',
                  'value' => 'facebook',
                 
                  'label' => __('Social share', 'digiqole'),
                 
                  'choices' => array(
                      '' => '---',
                      'facebook' => __('Facebook', 'digiqole'),
                      'twitter' => __('twitter', 'digiqole'),
                      'linkedin' => __('linkedin', 'digiqole'),
                      'pinterest' => __('pinterest ', 'digiqole'),
                      'digg' => __('digg', 'digiqole'),
                      'tumblr' => __('tumblr', 'digiqole'),
                      'blogger' => __('blogger', 'digiqole'),
                      'reddit' => __('reddit', 'digiqole'),
                      'delicious' => __('delicious', 'digiqole'),
                      'flipboard' => __('flipboard', 'digiqole'),
                      'vkontakte' => __('vkontakte', 'digiqole'),
                      'odnoklassniki' => __('odnoklassniki', 'digiqole'),
                      'moimir' => __('moimir', 'digiqole'),
                      'livejournal' => __('livejournal', 'digiqole'),
                      'blogger' => __('blogger', 'digiqole'),
                      'evernote' => __('evernote', 'digiqole'),
                      'flipboard' => __('flipboard', 'digiqole'),
                      'mix' => __('mix', 'digiqole'),
                      'meneame' => __('meneame ', 'digiqole'),
                      'pocket' => __('pocket ', 'digiqole'),
                      'surfingbird' => __('surfingbird ', 'digiqole'),
                      'liveinternet' => __('liveinternet ', 'digiqole'),
                      'buffer' => __('buffer ', 'digiqole'),
                      'instapaper' => __('instapaper ', 'digiqole'),
                      'xing' => __('xing ', 'digiqole'),
                      'wordpres' => __('wordpres ', 'digiqole'),
                      'baidu' => __('baidu ', 'digiqole'),
                      'renren' => __('renren ', 'digiqole'),
                      'weibo' => __('weibo ', 'digiqole'),
                    
                     
                  ),
                )  
               
            ],
           
        ], 
      ],
            
   ]
];