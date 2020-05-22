<?php if ( !defined( 'FW' ) ) {	die( 'Forbidden' ); }

$options = array(
   
   
  
   'settings-post-layout' => array(
		'title'		 => esc_html__( 'Post layout', 'digiqole' ),
		'type'		 => 'box',
		'priority'	 => 'high',
		'options'	 => [
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
         ]
      ]
   ),    
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

	'post_featured_video' => array(
		'title'		 => esc_html__( 'Featured video', 'digiqole' ),
		'type'		 => 'box',
		'priority'	 => 'default',
		'context'	 => 'side',
		'options'	 => array(
			'featured_video'	 => array(
				'type'	 => 'text',
				'label'	 => esc_html__( 'Video URL', 'digiqole' ),
				'desc'	 => esc_html__( 'Paste a video link from Youtube, Vimeo, Dailymotion, Facebook or Twitter it will be embedded in the post and the thumb used as the featured image of this post. 
				You need to choose "Video Format" as post format to use "Featured Video".', 'digiqole' ),
			)
		),
	),


	'settings-featured-audio' => array(
		'title'		 => esc_html__( 'Featured audio', 'digiqole' ),
		'type'		 => 'box',
		'priority'	 => 'default',
		'context'	 => 'side',
		'options'	 => array(
			'featured_audio'	 => array(
				'type'	 => 'text',
				'label'	 => esc_html__( 'Audio URL', 'digiqole' ),
				'desc'	 => esc_html__( 'Paste a soundcloud link here.', 'digiqole' ),
			)
		),
	),
	
	
	'settings-featured-gallery' => array(
      'title'		 => esc_html__( 'Featured gallary', 'digiqole' ),
		'type'		 => 'box',
		'priority'	 => 'default',
		'context'	 => 'side',
		'options'	 => array(
			'featured_gallery'	 => array(
            'type'	 => 'multi-upload',
            'desc'	 => esc_html__( 'Only use post format gallery.', 'digiqole' ),
				'images_only' => true,
			)
		),
	),
   

);
