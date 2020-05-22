function gpSliderField( $ ) {

	$( '.gp-settings-section.gp-show .gp-slider-field' ).each( function() {
	
		var field = $( this ),
			id = field.data( 'id' ),
			value = field.data( 'value' ),
			step = field.data( 'step' ),
			min = field.data( 'min' ),
			max = field.data( 'max' );
			
		$( '#gp-slider-' + id ).slider({
			range: 'min',
			value: value,
			step: step,
			min: min,
			max: max,
			slide: function( event, ui ) {
				$( '#' + id ).val( ui.value );
			}
		});
	
		$( '#' + id ).change( function() {
			var value = $( this ).val();
			$( '#gp-slider-' + id ).slider( 'value', value );
		});			
		
	});
	
}

jQuery( function( $ ) {

	'use strict';

	gpSliderField( $ );
			
});	