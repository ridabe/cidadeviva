function gpImageSelectField( $ ) {

	$( '.gp-settings-section.gp-show .gp-image-select-field' ).each( function() {
	
		var imageSelectField = $( this );
			
		$( document ).on( 'click', '.gp-image-select-field .gp-image-select:not(.gp-active)', function() {

			imageSelectField.find( 'img' ).removeClass( 'gp-active' );
			imageSelectField.find( 'input[type="radio"]' ).removeClass( 'gp-active' ).prop( 'checked', false );	
			
			$( this ).addClass( 'gp-active' );
			$( this ).next().addClass( 'gp-active' ).prop( 'checked', true );	
	
		});
		
	});	

}

jQuery( function( $ ) {

	'use strict';

	gpImageSelectField( $ );
			
});	