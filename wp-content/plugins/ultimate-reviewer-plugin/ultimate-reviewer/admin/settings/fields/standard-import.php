<?php

echo '</form><span class="gp-import-field">';
	
	echo '<form method="post" enctype="multipart/form-data">';
	
		echo '<input type="file" name="import_file" />';
	
		echo '<input type="hidden" name="ghostpool_action" value="import_settings" />';
	
		wp_nonce_field( 'ghostpool_import_nonce', 'ghostpool_import_nonce' );
	
		submit_button( esc_html__( 'Import', 'gpur' ), 'secondary', 'submit', false );
	
	echo '</form>';
	
echo '</span>';