<?php if ( ! class_exists( 'GPUR_Activator' ) ) {
	class GPUR_Activator {

		public static function activate() {

			if ( ! current_user_can( 'activate_plugins' ) ) {
				return;
			}

			/**
			 * Create review template before creating default post type
			 *
			 */
			$args = array(
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => 'gpur-templates-page',
				'query_var'          => true,
				'rewrite'            => array( 'slug' => 'gpur-template' ),
				'capability_type'    => 'post',
				'has_archive'        => false,
				'hierarchical'       => false,
				'menu_position'      => null,
				'supports'           => array( 'title', 'editor', 'custom-fields' ),
			);

			register_post_type( 'gpur-template' );

			/**
			 * Create default review template upon activation once
			 *
			 */	
			if ( '' == get_option( 'gpur_default_template_installed' ) ) {

				$post_content = '[vc_row][vc_column][gpur_show_rating max_rating="5" fractions="1" step="0.5" decimal_places="1" rich_snippets="1" style="style-bars" show_site_rating_text="" criteria="Criterion 1,Criterion 2,Criterion 3,Criterion 4" show_ranges_text="" criteria_format="format-column" css=".vc_custom_1571226223655{margin-bottom: 30px !important;}"][vc_row_inner content_placement="middle" offset="vc_hidden-xs"][vc_column_inner width="5/6" css=".vc_custom_1540992759876{margin-bottom: 35px !important;}"][gpur_summary][/vc_column_inner][vc_column_inner width="1/6" css=".vc_custom_1540992765861{margin-bottom: 35px !important;}"][gpur_show_rating data="custom" value="4" max_rating="5" fractions="1" step="1" decimal_places="1" position="position-right" site_rating_number_color="#000000" site_rating_number_size="30px" show_ranges_text="" max_rating_text_size="30px"][/vc_column_inner][/vc_row_inner][vc_row_inner content_placement="middle" offset="vc_hidden-lg vc_hidden-md vc_hidden-sm"][vc_column_inner width="5/6" css=".vc_custom_1540992759876{margin-bottom: 35px !important;}"][gpur_summary][/vc_column_inner][vc_column_inner width="1/6" css=".vc_custom_1540992765861{margin-bottom: 35px !important;}"][gpur_show_rating data="custom" value="4" max_rating="5" fractions="1" step="1" decimal_places="1" position="position-center" site_rating_number_color="#000000" site_rating_number_size="30px" show_ranges_text="" max_rating_text_size="30px"][/vc_column_inner][/vc_row_inner][gpur_show_rating data="user-rating" max_rating="5" step="1" style="style-stars" text_position="position-text-left" show_ind_user_rating_text="" criterion_boxes="true" show_ranges_text="" text_position="position-text-right" show_ind_user_rating_text_at_top="1" bb_tab_container=""][/vc_column][/vc_row]';
		
				$args = array(
				  'post_title'    => esc_html__( 'Default Review Template', 'gpur' ),
				  'post_content'  => $post_content,
				  'post_status'   => 'publish',
				  'post_type'     => 'gpur-template',
				);
 
				wp_insert_post( $args );
			
				update_option( 'gpur_default_template_installed', 'yes' );

			}
		
		}

	}
}