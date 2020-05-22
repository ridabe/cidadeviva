<?php if ( ! class_exists( 'GPUR_Status' ) ) {
	class GPUR_Status {

		public function __construct() {
			
			if ( isset( $_GET['page'] ) && 'gpur-status' === $_GET['page'] ) {
				add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			}
			
			add_action( 'admin_menu', array( $this, 'add_menu_page' ), 11 );
		}
		
		public function enqueue_scripts() {
			wp_enqueue_style( 'gpur-status', plugin_dir_url( __FILE__ ) . 'assets/status.css', array(), GPUR_VERSION );
		}
				
		public function add_menu_page() {
			add_submenu_page( 
				'gpur-templates-page', 
				esc_html__( 'Status', 'gpur' ),
				esc_html__( 'Status', 'gpur' ),
				'manage_options', 
				'gpur-status', 
				array( $this, 'setup_page' )
			);
		}
		
		public function setup_page() { ?>
		
			<div class="wrap">
		  
				<h1><?php esc_html_e( 'Status', 'gpur' ); ?></h1>
				
				<table class="gpur-status-table widefat">

					<thead>
						<tr>
							<th colspan="3"><h2><?php esc_html_e( 'Plugin', 'gpur' ); ?></h2></th>
						</tr>
					</thead>		
					
					<tbody>
						<tr>
							<td><?php esc_html_e( 'Version', 'gpur' ); ?></td>
							<td class="help"></td>
							<td><?php echo GPUR_VERSION; ?></div></td>
						</tr>	
					</tbody>	
						
				</table>
				
				<table class="gpur-status-table widefat">

					<thead>
						<tr>
							<th colspan="3"><h2><?php esc_html_e( 'Server', 'gpur' ); ?></h2></th>
						</tr>
					</thead>	
					
					<tbody>
					
						<?php
			
						$statuses = array();
			
						// WordPress version
						$icon = 'dashicons-yes';
						$message = get_bloginfo( 'version' );
						if ( version_compare( get_bloginfo( 'version' ), '3.8', '<' ) ) {
							$icon = 'dashicons-no';
							$message .= esc_html__( ' - Please update WordPress as version 3.8 or higher is required.', 'gpur' );
						}
						$statuses[] = array(
							'name' => esc_html__( 'WordPress Version', 'gpur' ),
							'title' => esc_html__( 'WordPress version.', 'gpur' ),
							'icon' => $icon,
							'message' => $message,
						);
			
						// Writable directory
						$upload_dir = wp_upload_dir();
						$icon = 'dashicons-yes';
						$message = esc_html__( 'Uploads folder is writable', 'gpur' );
						if ( ! wp_is_writable( trailingslashit( $upload_dir['basedir'] ) ) ) {
							$icon = 'dashicons-no';
							$message = esc_html__( 'Uploads folder is not writable. Please check with your hosting provider.', 'gpur' );
						}
						$statuses[] = array(
							'name' => esc_html__( 'File Permissions', 'gpur' ),
							'title' => esc_html__( 'Whether or not your uploads folder is writable.', 'gpur' ),
							'icon' => $icon,
							'message' => $message,
						);

						// PHP version
						$icon = 'dashicons-yes';
						$php_version = phpversion();
						$message = $php_version;
						if ( version_compare( $php_version, '5.6', '<' ) ) {
							$icon = 'dashicons-no';
							$message .= esc_html__( ' - A PHP version greater than 5.6 is required, to update this', 'gpur' ) . ' <a href="' . esc_url( 'https://ghostpool.ticksy.com/article/15108/' ) . '" target="_blank">' . esc_html__( 'click here', 'gpur' ) . '</a>.';
						} elseif ( version_compare( $php_version, '7.2', '<' ) ) {
							$icon = 'dashicons-warning';
							$message .= esc_html__( ' - We recommend using PHP version 7.2 or above for greater performance and security, to update this', 'gpur' ) . ' <a href="' . esc_url( 'https://ghostpool.ticksy.com/article/15108/' ) . '" target="_blank">' . esc_html__( 'click here', 'gpur' ) . '</a>.';
						}
						$statuses[] = array(
							'name' => esc_html__( 'PHP Version', 'gpur' ),
							'title' => esc_html__( 'PHP version of your server.', 'gpur' ),
							'icon' => $icon,
							'message' => $message,
						);

						// Memory limit
						$icon = 'dashicons-yes';
						$memory = wp_convert_hr_to_bytes( ini_get( 'memory_limit' ) );
						$message = size_format( $memory );
						if ( $memory < 128000000 ) {
							$icon = 'dashicons-no';
							$message .= esc_html__( ' - We recommend setting the memory limit to at least 128MB, to do this', 'gpur' ) . ' <a href="' . esc_url( 'https://ghostpool.ticksy.com/article/15110' ) . '" target="_blank">' . esc_html__( 'click here', 'gpur' ) . '</a>.';
						}
						$statuses[] = array(
							'name' => esc_html__( 'PHP Memory Limit', 'gpur' ),
							'title' => esc_html__( 'The maximum amount of memory that your site can use at one time.', 'gpur' ),
							'icon' => $icon,
							'message' => $message

						);
			
						// Max execution time
						$message = '';
						$icon = 'dashicons-yes';
						$time_limit = @ini_get( 'max_execution_time' );
						$message = $time_limit;
						if ( $time_limit < 180 && $time_limit != 0 ) {
							$icon = 'dashicons-no';
							$message .= esc_html__( ' - We recommend setting the maximum execution time to at least 180 for running larger tasks, to do this', 'gpur' ) . ' <a href="' . esc_url( 'https://ghostpool.ticksy.com/article/15111' ) . '" target="_blank">' . esc_html__( 'click here', 'gpur' ) . '</a>.';
						}
						$statuses[] = array(
							'name' => esc_html__( 'PHP Maximum Execution Limit', 'gpur' ),
							'title' => esc_html__( 'The amount of time (in seconds) that your site will spend on a single operation before timing out.', 'gpur' ),
							'icon' => $icon,
							'message' => $message
						);

						// Max input vars
						$icon = 'dashicons-yes';
						$input_vars = ini_get('max_input_vars');
						$message = $input_vars;
						if ( $input_vars < 1000 ) {
							$icon = 'dashicons-no';
							$message .= esc_html__( ' - We recommend setting the maximum input vars to at least 1000 otherwise POST data will be truncated, to do this', 'gpur' ) . ' <a href="' . esc_url( 'https://ghostpool.ticksy.com/article/15112' ) . '" target="_blank">' . esc_html__( 'click here', 'gpur' ) . '</a>.';
						}
						$statuses[] = array(
							'name' => esc_html__( 'PHP Maximum Input Vars', 'gpur' ),
							'title' => esc_html__( 'The maximum number of variables your server can use for a single function to avoid overloads.', 'gpur' ),
							'icon' => $icon,
							'message' => $message
						);

						// ZipArchive
						$message = esc_html__( 'Installed' , 'gpur' );
						$icon = 'dashicons-yes';
						if ( ! class_exists( 'ZipArchive' ) ) {
							$icon = 'dashicons-no';
							$message = esc_html__( 'Not installed - ZipArchive is required for importing the demo data. Please contact your server administrator and ask them to enable it.', 'gpur' );
						}
						$statuses[] = array(
							'name' => esc_html__( 'ZipArchive', 'gpur' ),
							'title' => esc_html__( 'ZipArchive is required for importing the demo data.', 'gpur' ),
							'icon' => $icon,
							'message' => $message
						);

						// WP DEBUG Mode
						$message = esc_html__( 'OK - DEBUG is OFF' , 'gpur' );
						$icon = 'dashicons-yes';
						if ( defined( 'WP_DEBUG' ) && TRUE === WP_DEBUG ) {
							$icon = 'dashicons-warning';
							$message = esc_html__( 'DEBUG is ON - It is recommended you disable WordPress debugging on your live site, to do this', 'gpur' ) . ' <a href="' . esc_url( 'https://codex.wordpress.org/WP_DEBUG' ) . '" target="_blank">' . esc_html__( 'click here', 'gpur' ) . '</a>.';
						}
						$statuses[] = array(
							'name' => esc_html__( 'WP Debug', 'gpur' ),
							'title' => esc_html__( 'Whether or not WordPress is in Debug Mode.', 'gpur' ),
							'icon' => $icon,
							'message' => $message
						);

						?>

						<?php foreach ( $statuses as $status ) : ?>

							<tr>
								<td><?php echo esc_attr( $status['name'] ); ?></td>
								<td class="help"><span class="tooltip-me dashicons-before dashicons-editor-help" title="<?php echo esc_attr( $status['title'] );?>"></span></td>
								<td><span class="dashicons-before <?php echo esc_attr( $status['icon'] ); ?>"></span> <?php echo wp_kses_post( $status['message'] ); ?></td>
							</tr>

						<?php endforeach; ?>
					
					</tbody>
				</table>
				
				<?php $theme_data = wp_get_theme(); ?>

				<table class="gpur-status-table widefat">

					<thead>
						<tr>
							<th colspan="3"><h2><?php esc_html_e( 'Theme', 'gpur' ); ?></h2></th>
						</tr>
					</thead>		
					
					<tbody>
						<tr>
							<td><?php echo esc_html__( 'Name', 'gpur' ); ?></td>
							<td class="help"></td>
							<td><?php echo esc_attr( $theme_data->get( 'Name' ) ); ?></div></td>
						</tr>	
						<tr>
							<td><?php echo esc_html__( 'Version', 'gpur' ); ?></td>
							<td class="help"></td>
							<td><?php echo esc_attr( $theme_data->get( 'Version' ) ); ?></div></td>
						</tr>	
					</tbody>	
						
				</table>
							
			</div>
			<?php
		}

	}
}

if ( is_admin() ) {
	new GPUR_Status();
}