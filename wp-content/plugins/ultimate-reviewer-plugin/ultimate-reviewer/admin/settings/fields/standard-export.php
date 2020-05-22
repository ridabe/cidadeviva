<?php

echo '<span class="gp-export-field">';

	echo '<form method="post">';

		echo '<input type="hidden" name="ghostpool_action" value="export_settings" />';
	
		wp_nonce_field( 'ghostpool_export_nonce', 'ghostpool_export_nonce' );
	
		submit_button( esc_html__( 'Export', 'gpur' ), 'secondary', 'submit', false );
	
	echo '</form>';
	

echo '</span>';	