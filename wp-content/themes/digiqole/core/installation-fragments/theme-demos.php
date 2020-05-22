<?php

function digiqole_fw_ext_backups_demos( $demos ) {
	$demo_content_installer	 = 'https://demo.themewinter.com/wp/demo-content/digiqole';
	$demos_array			 = array(
		'default'			 => array(
			'title'			 => esc_html__( 'Demo (1-10)', 'digiqole' ),
			'screenshot'	 => esc_url( $demo_content_installer ) . '/default/screenshot.png',
			'preview_link'	 => esc_url( 'http://themeforest.net/user/tripples/portfolio' ),
		),
		'personal_blog'			 => array(
			'title'			 => esc_html__( 'Personal Blog', 'digiqole' ),
			'screenshot'	 => esc_url( $demo_content_installer ) . '/personal_blog/screenshot.png',
			'preview_link'	 => esc_url( 'http://themeforest.net/user/tripples/portfolio' ),
		),
		'dark'			 => array(
			'title'			 => esc_html__( 'Dark', 'digiqole' ),
			'screenshot'	 => esc_url( $demo_content_installer ) . '/dark/screenshot.png',
			'preview_link'	 => esc_url( 'http://themeforest.net/user/tripples/portfolio' ),
		),
		'covid19'			 => array(
			'title'			 => esc_html__( 'Covid-19', 'digiqole' ),
			'screenshot'	 => esc_url( $demo_content_installer ) . '/covid19/screenshot.png',
			'preview_link'	 => esc_url( 'http://themeforest.net/user/tripples/portfolio' ),
		),
		'food_recipe'			 => array(
			'title'			 => esc_html__( 'Food Recipe', 'digiqole' ),
			'screenshot'	 => esc_url( $demo_content_installer ) . '/food_recipe/screenshot.png',
			'preview_link'	 => esc_url( 'http://themeforest.net/user/tripples/portfolio' ),
		),
		
	);
	$download_url			 = esc_url( $demo_content_installer ) . '/manifest.php';
	foreach ( $demos_array as $id => $data ) {
		$demo						 = new FW_Ext_Backups_Demo( $id, 'piecemeal', array(
			'url'		 => $download_url,
			'file_id'	 => $id,
		) );
		$demo->set_title( $data[ 'title' ] );
		$demo->set_screenshot( $data[ 'screenshot' ] );
		$demo->set_preview_link( $data[ 'preview_link' ] );
		$demos[ $demo->get_id() ]	 = $demo;
		unset( $demo );
	}
	return $demos;
}

add_filter( 'fw:ext:backups-demo:demos', 'digiqole_fw_ext_backups_demos' );