function gpMultiTextField( $ ) {

	$( '.gp-settings-section.gp-show .gp-multi-text-field' ).each( function() {

		var field = $( this ),
			id = field.data( 'id' ),
			addRow = field.find( '#gp-add-row-' + id );

		addRow.on( 'click', function( e ) {
			e.preventDefault();
			var element = $( this ).parent(),
				row = element.find( '.gp-hide.screen-reader-text' ).clone( true );
			row.removeClass( 'gp-hide screen-reader-text' );
			row.insertBefore( element.find( '.gp-multi-text-input' ).last() );
			return false;
		});

		$( '.gp-remove-row' ).on( 'click', function( e ) {
			e.preventDefault();
			$( this ).prev().remove();
			$( this ).remove();
			return false;
		});

	});
	
}

jQuery( function( $ ) {

	'use strict';

	gpMultiTextField( $ );
			
});	