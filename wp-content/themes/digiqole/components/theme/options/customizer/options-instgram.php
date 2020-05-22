<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * customizer option: instgram
 */

$options =[
    'instgram_settings' => [
        'title'		 => esc_html__( 'Instgram settings', 'digiqole' ),

        'options'	 => [
            'instgram_user_id' => [
               'label'	 => esc_html__( 'Instgram User ID', 'digiqole' ),
               'type'	 => 'text',
               'value'   => esc_html__('30833064716','digiqole')
            ],
            'instagram_access_token'	 => [
                'type'	 => 'text',
                'value'  =>  esc_html__('30833064716.3a81a9f.c65c1abd3b064ffc86e6cea51aa01ceb','digiqole'),
                'label'	 => esc_html__( 'Instgram Access Token', 'digiqole' ),
            ],
        ],
    ]
];