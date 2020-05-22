<?php
	
$output .= '<div class="gpur-thead">';
			
	foreach( $fields as $field ) {

		// Get custom field data
		if ( false !== strpos( $field, 'CUSTOM_FIELD:' ) ) {
			preg_match_all( "~CUSTOM_FIELD:(.*?):~", $field, $m );
			$atts['meta_key'] = $m[1][0];
			$label = substr( $field, strrpos( $field, ':' ) + 1 ) . "\n";
			$field = 'CUSTOM_FIELD';
		} else {
			$label = $all_fields[$field][2];
		}
			
		$field_name = $all_fields[$field][1];
		$sorting = $all_fields[$field][3];
		
		if ( in_array( $field, $all_fields[$field] ) ) {		

			$output .= '<div class="gpur-th">';
				$output .= gpur_sort_icons( $field_name, $label, $sorting, $atts );
			$output .= '</div>';
			
		}
			
	}

$output .= '</div>';
		
while ( $query->have_posts() ) {
	$query->the_post();

	$output .= '<div class="gpur-tr">';

		foreach( $fields as $field ) {

			// Get custom field data
			if ( false !== strpos( $field, 'CUSTOM_FIELD:' ) ) {
				preg_match_all( "~CUSTOM_FIELD:(.*?):~", $field, $m );
				$atts['meta_key'] = $m[1][0];
				$label = substr( $field, strrpos( $field, ':' ) + 1 ) . "\n";
				$field = 'CUSTOM_FIELD';
			} else {
				$label = $all_fields[$field][2];
			}
				
			$field_name = $all_fields[$field][1];
			$sorting = $all_fields[$field][3];
				
			if ( in_array( $field, $all_fields[$field] ) ) {			

				$output .= '<div class="gpur-td gpur-comparison-table-' . esc_attr( $field_name ) . '">';
					
					$output .= '<div class="gpur-th-inner">';
						$output .= gpur_sort_icons( $field_name, $label, $sorting, $atts );
					$output .= '</div>';
					
					$output .= '<div class="gpur-td-inner">';
						$output .= gpur_comparison_table_fields( $field_name, $builder, $atts );
					$output .= '</div>';
				$output .= '</div>';	
				
			}
				
		}

	$output .= '</div>';

}

return $output;