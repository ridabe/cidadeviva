function gpTypographyField( $ ) {

	$( '.gp-settings-section.gp-show .gp-font-family-field' ).each( function() {
		
		var fontFamilySelect = $( this ).find( 'select' ),
			parentContainer = $( this ).closest( '.gp-setting' );

		fontFamilySelect.change( function() {
		
			// Ajax query
			$.ajax({
				type: 'GET',
				data: {
					action: 'ghostpool_typography_ajax',
					fontFamily: $( this ).val(),
					fontWeight: parentContainer.find( '.gp-font-weight-field select' ).val(),
					fontSubset: parentContainer.find( '.gp-subsets-field select' ).val(),
				},
				dataType: 'json',
				url: ghostpool_framework.ajaxurl,
				success: function( data ) {
				
					parentContainer.find( '.gp-font-weight-field select' ).html( data.weights );
					
					parentContainer.find( '.gp-subsets-field select' ).html( data.subsets );
					
				},
				error: function( jqXHR, textStatus, errorThrown ) {
					console.log( jqXHR + " :: " + textStatus + " :: " + errorThrown );
				}
			});	
			
		});		
	
	});	
	
}

jQuery( function( $ ) {

	'use strict';

	gpTypographyField( $ );
		
});	