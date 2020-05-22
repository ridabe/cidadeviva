<?php foreach( $fields as $field ) {

	$count = 1;
	$column_count[] = $count;

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

	while ( $query->have_posts() ) {
		$query->the_post();

		if ( in_array( $field, $all_fields[$field] ) ) {

			if ( 1 === $count ) {
				$output .= '<div class="gpur-tr">';
			}
			
				if ( 1 === $count ) {
					$output .= '<div class="gpur-th">';
						$output .= gpur_sort_icons( $field_name, $all_fields[$field][2], $sorting, $atts );
					$output .= '</div>';
				}
					
				$output .= '<div class="gpur-td gpur-comparison-table-' . esc_attr( $field_name ) . '">';
					$output .= gpur_comparison_table_fields( $field_name, $builder, $atts );
				$output .= '</div>';

			if ( $query->post_count === $count ) {
				$output .= '</div>';
			}	
	
		}

		$count++;
	
	}
	
	$query->rewind_posts();
	
}

return $output;