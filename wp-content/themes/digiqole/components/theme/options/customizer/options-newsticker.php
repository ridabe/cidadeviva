<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * customizer option: newsticker
 */

$options =[
    'newsticker_settings' => [
            'title'		 => esc_html__( 'News Ticker settings', 'digiqole' ),
            'options'	 => [
              
               'newsticker_enable' => [
                    'type'			    => 'switch',
                    'label'			 => esc_html__( 'Newsticker', 'digiqole' ),
                    'desc'			    => esc_html__( 'Would you like to enable newsticker?', 'digiqole' ),
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
                'newsticker_bg_color' => [
                  'label'	        => esc_html__( 'Tranding box bg color', 'digiqole' ),
                  'desc'	           => esc_html__( 'Tranding box bg color.', 'digiqole' ),
                  'type'	           => 'hidden',
                ],
                'newsticker_title_bg_color' => [
                  'label'	        => esc_html__( 'Tranding Title bg color', 'digiqole' ),
                  'desc'	           => esc_html__( 'Tranding box bg color.', 'digiqole' ),
                  'type'	           => 'hidden',
                ],
              
                  'newsticker_title' => [
                     'type'			    => 'text',
                     'label'			 => esc_html__( 'News Ticker title', 'digiqole' ),
                     'desc'			    => esc_html__( 'News Ticker Title.', 'digiqole' ),
                     'value'          => esc_html__('Trending','digiqole'),
                ],
                'newsticker_nav_enable' => [
                     'type'			    => 'switch',
                     'label'			 => esc_html__( 'Newsticker Navigation', 'digiqole' ),
                     'desc'			    => esc_html__( 'Would you like to enable newsticker navigation?', 'digiqole' ),
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
            
                'newsticker_post_order_by' => [
                        'type'  => 'select',
                        'value' => 'latest',
                        'label' => esc_html__('Post select by', 'digiqole'),
                        'desc'  => esc_html__('Newsticker post source ', 'digiqole'),
                       
                        'choices' => [
                           'latest'   => esc_html__('latest Post', 'digiqole'),
                           'trending' => esc_html__('Trending post', 'digiqole'),
                           'category' => esc_html__('Category', 'digiqole'),
                           'tag' => esc_html__('Tag', 'digiqole'),
                        ],
                      
               ],
               'newsticker_post_by_choice' => array(
                  'type' => 'multi-picker',
                  'picker' => 'newsticker_post_order_by',
                  'choices' => array(
                      'category' => array(
                           'newsticker_post_category' => [
                              'type'  => 'multi-select',
                              'label' => esc_html__('Newsticker post category', 'digiqole'),
                              'population' => 'taxonomy',
                              'source' => 'category',
                              'limit' => 300,
                           ],
                      ),
                    
                  )
              ),
              'newsticker_tag_by_choice' => array(
               'type' => 'multi-picker',
               'picker' => 'newsticker_post_order_by',
               'choices' => array(
                   'tag' => array(
                        'newsticker_post_tag' => [
                           'type'  => 'multi-select',
                           'label' => esc_html__('Newsticker post tag', 'digiqole'),
                           'population' => 'taxonomy',
                           'source' => 'tag',
                           'limit' => 300,
                        ],
                   ),
                 
               )
           ),
           
              
               'newsticker_post_number' => [
                  'type'  => 'text',
                  'value' => 5,
                  'label' => esc_html__('Number of post', 'digiqole'),
                  'desc'  => esc_html__('Number of post to show in newsticker', 'digiqole'),
                 
               ],
         
            ],
        ],
    ];

   
