<?php

define('TAGDIV_ROOT', get_template_directory_uri());
define('TAGDIV_ROOT_DIR', get_template_directory());


// load the deploy mode
require_once( TAGDIV_ROOT_DIR . '/tagdiv-deploy-mode.php' );


/**
 * Theme configuration.
 */
require_once TAGDIV_ROOT_DIR . '/includes/tagdiv-config.php';


/**
 * Theme wp booster.
 */
require_once( TAGDIV_ROOT_DIR . '/includes/wp-booster/tagdiv-wp-booster-functions.php');


/**
 * Theme page generator support.
 */
if ( ! class_exists('tagdiv_page_generator' ) ) {
	include_once ( TAGDIV_ROOT_DIR . '/includes/tagdiv-page-generator.php');
}


/**
 * Theme sidebar.
 */
add_action( 'widgets_init', function (){
	register_sidebar(
		array(
			'name'=> 'Newsmag default',
			'id' => 'td-default',
			'before_widget' => '<aside class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<div class="block-title"><span>',
			'after_title' => '</span></div>'
		)
	);
});

/**
 * Theme setup.
 */
add_action( 'after_setup_theme', function (){

	/**
	 * Loads the theme's translated strings.
	 */
	load_theme_textdomain( strtolower(TD_THEME_NAME ), get_template_directory() . '/translation' );

	/**
	 * Theme menu location.
	 */
	register_nav_menus(
		array(
			'header-menu' => 'Header Menu (main)',
			'footer-menu' => 'Footer Menu',
		)
	);
});


/* ----------------------------------------------------------------------------
 * Add theme support for features
 */
add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_theme_support('automatic-feed-links');
add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));
add_theme_support('woocommerce');
add_theme_support('bbpress');

global $content_width;
if ( !isset($content_width) ) {
    $content_width = 640;
}


/* ----------------------------------------------------------------------------
 * WooCommerce
 */

// breadcrumb
add_filter('woocommerce_breadcrumb_defaults', 'tagdiv_woocommerce_breadcrumbs');
function tagdiv_woocommerce_breadcrumbs() {
    return array(
        'delimiter' => ' <i class="td-icon-right td-bread-sep"></i> ',
        'wrap_before' => '<div class="entry-crumbs" itemprop="breadcrumb">',
        'wrap_after' => '</div>',
        'before' => '',
        'after' => '',
        'home' => _x('Home', 'breadcrumb', 'newsmag'),
    );
}


// Override theme default specification for product 3 per row
add_filter( 'loop_shop_columns', 'tagdiv_wc_loop_shop_columns', 1, 10 );
function tagdiv_wc_loop_shop_columns( $number_columns ) {
	return 3;
}


// Number of product per page 6
add_filter( 'loop_shop_per_page', 'tagdiv_wc_loop_shop_per_page' );
function tagdiv_wc_loop_shop_per_page( $cols ) {
	return 6;
}


// use own pagination
if (!function_exists('woocommerce_pagination')) {
    // pagination
    function woocommerce_pagination() {
        echo tagdiv_page_generator::get_pagination();
    }
}

if ( ! function_exists('woocommerce_output_related_products' ) ) {
    // Number of related products
    function woocommerce_output_related_products() {
        woocommerce_related_products(array(
            'posts_per_page' => 3,
            'columns' => 3,
            'orderby' => 'rand',
        )); // Display 3 products in rows of 1
    }
}


add_filter('upgrader_clear_destination', function($removed, $local_destination, $remote_destination, $args) {
	usleep(500);
	return $removed;
}, 10, 4);


if ( defined('TD_COMPOSER' ) && strpos( td_util::get_registration(), chr(42 ) ) > 0 ) {

	if ( is_admin()) {

		$value = get_transient( 'td_update_theme_' . TD_THEME_NAME );
		if ( false === $value ) {

			tagdiv_check_theme_version();

		} else {

			$td_theme_update_to_version = get_transient( 'td_update_theme_to_version_' . TD_THEME_NAME );
			if ( false !== $td_theme_update_to_version ) {
				$theme_update_to_version = tagdiv_util::get_option( 'theme_update_to_version' );

				if ( ! empty( $theme_update_to_version ) ) {

					add_filter( 'pre_set_site_transient_update_themes', function( $transient ) {

						$to_version = tagdiv_util::get_option( 'theme_update_to_version' );
						if ( ! empty( $to_version )) {
							$args = array();
							$to_version = json_decode( $to_version, true );
							$to_version_keys = array_keys( $to_version );
							if ( is_array( $to_version_keys ) && count( $to_version_keys ) ) {
								$to_version_serial = $to_version_keys[ 0 ];
								$to_version_url = $to_version[$to_version_serial];
								$theme_slug = get_template();

								$transient->response[ $theme_slug ] = array(
									'theme'       => $theme_slug,
									'new_version' => $to_version_serial,
									'url' => "https://tagdiv.com/" . TD_THEME_NAME,
									'clear_destination' => true,
									'package'     => add_query_arg( $args, $to_version_url ),
								);
							}
						}

						return $transient;
					});
					delete_site_transient('update_themes');
				}
			} else {

				$td_theme_update_latest_version = get_transient( 'td_update_theme_latest_version_' . TD_THEME_NAME );

				if ( false !== $td_theme_update_latest_version ) {

					add_filter( 'pre_set_site_transient_update_themes', function( $transient ) {

						$latest_version = tagdiv_util::get_option( 'theme_update_latest_version' );
						if ( ! empty( $latest_version ) ) {
							$args = array();
							$latest_version = json_decode( $latest_version, true );

							$latest_version_keys = array_keys( $latest_version );
							if ( is_array( $latest_version_keys ) && count( $latest_version_keys ) ) {
								$latest_version_serial = $latest_version_keys[ 0 ];
								$latest_version_url = $latest_version[$latest_version_serial];
								$theme_slug = get_template();

								$transient->response[ $theme_slug ] = array(
									'theme' => $theme_slug,
									'new_version' => $latest_version_serial,
									'url' => "https://tagdiv.com/" . TD_THEME_NAME,
									'clear_destination' => true,
									'package' => add_query_arg( $args, $latest_version_url ),
								);
							}
						}

						return $transient;
					});
					delete_site_transient('update_themes');
				}
			}
		}
	}


	add_filter( 'admin_body_class', function ( $classes ) {
		$new_update_available = false;
		$latest_version = tagdiv_util::get_option( 'theme_update_latest_version' );

		if ( ! empty( $latest_version ) ) {
			$latest_version = json_decode( $latest_version, true );

			$latest_version_keys = array_keys( $latest_version );
			if ( is_array( $latest_version_keys ) && count( $latest_version_keys ) ) {
				$latest_version_serial = $latest_version_keys[ 0 ];

				if ( 1 == version_compare( $latest_version_serial, TD_THEME_VERSION ) ) {
					$new_update_available = true;
				}
			}
		}

		if ( $new_update_available ) {
			$classes .= ' td-theme-update';
		}

		return $classes;
	} );


	add_filter( 'admin_head', function () {

		$td_update_theme_ready = get_transient( 'td_update_theme_' . TD_THEME_NAME );
		if ( false !== $td_update_theme_ready ) {

			$update_data = '';

			$td_theme_update_to_version = get_transient( 'td_update_theme_to_version_' . TD_THEME_NAME );
			if ( false !== $td_theme_update_to_version ) {

				$data = tagdiv_util::get_option( 'theme_update_to_version' );
				if ( ! empty( $data ) ) {
					$update_data = $data;
				}
			} else {

				$data = tagdiv_util::get_option( 'theme_update_latest_version' );
				if ( ! empty( $data ) ) {
					$update_data = $data;
				}
			}

			if ( ! empty( $update_data ) ) {
				ob_start();
				?>
				<script>
					var tdData = {
						version: <?php echo $update_data ?>,
						adminUrl: "<?php echo admin_url() ?>",
						themeName: "<?php echo TD_THEME_NAME ?>",
					};
				</script>
				<?php
				echo ob_get_clean();
			}
		}
	} );
}


add_action('upgrader_process_complete', function($upgrader, $data) {

	if ($data['action'] == 'update' && $data['type'] == 'theme' ) {

		// clear flag to update theme
		delete_transient( 'td_update_theme_' . TD_THEME_NAME );

		// clear flag to update theme to latest version
		delete_transient( 'td_update_theme_latest_version_' . TD_THEME_NAME );

		// clear flag to update theme to specific version
		delete_transient( 'td_update_theme_to_version_' . TD_THEME_NAME );

		// clear flag to update to a specific version
		tagdiv_util::update_option( 'theme_update_to_version', '' );

		$current_deactivated_plugins = tagdiv_options::get_array('td_theme_deactivated_current_plugins' );

		if ( ! empty( $current_deactivated_plugins ) ) {
			$theme_setup = tagdiv_theme_plugins_setup::get_instance();
			$theme_setup->theme_plugins( array_keys( $current_deactivated_plugins ) );

			ob_start();

			?>

			<script>
				setTimeout(function(){
					jQuery('.td-button-install-plugins').trigger('click');
				}, 1000);
			</script>

			<?php

			echo ob_get_clean();
		}
	}

}, 10, 2);


add_filter('upgrader_pre_install', function( $return, $theme) {
	if ( is_wp_error( $return ) ) {
		return $return;
	}

	$theme = isset( $theme['theme'] ) ? $theme['theme'] : '';

	if ( $theme != get_stylesheet() ) { //If not current
		return $return;
	}

	tagdiv_options::update_array( 'td_theme_deactivated_current_plugins', '' );
	$deactivation = new tagdiv_current_plugins_deactivation();
	$deactivation->td_deactivate_current_plugins( true );

	return $return;

}, 10, 2);



add_action( 'current_screen', function() {
	$current_screen = get_current_screen();

	if ( 'update-core' === $current_screen->id && isset( $_REQUEST['update_theme'] )) {

		add_action('admin_head', function() {

			$theme_name = $_REQUEST['update_theme'];

			ob_start();
			?>

			<script>
				jQuery(window).ready(function() {

					'use strict';

					var $formUpgradeThemes = jQuery('form[name="upgrade-themes"]');
					if ( $formUpgradeThemes.length ) {
						var $input = $formUpgradeThemes.find('input[type="checkbox"][value="<?php echo $theme_name ?>"]');
						if ($input.length) {
							$input.attr( 'checked', true );
							$formUpgradeThemes.submit();
						}
					}
				});
			</script>

			<?php
			echo ob_get_clean();
		});
	}
});
