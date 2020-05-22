function gpSpinnerField( $ ) {

	$( '.gp-settings-section.gp-show .gp-spinner-field' ).each( function() {

		var field = $( this ),
			id = field.data( 'id' ),
			value = field.data( 'value' ),
			step = field.data( 'step' ),
			min = field.data( 'min' ),
			max = field.data( 'max' );
			
		$( '#' + id ).spinner({
			value: value,
			step: step,
			min: min,
			max: max
		});
		
	});		
	
}

jQuery( function( $ ) {

	'use strict';

	gpSpinnerField( $ );
			
});	