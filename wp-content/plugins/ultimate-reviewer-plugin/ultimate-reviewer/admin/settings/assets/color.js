function gpColorField( $ ) {
	$( '.gp-settings-section.gp-show .gp-color-picker-field input' ).wpColorPicker();
}

jQuery( function( $ ) {

	'use strict';	

	gpColorField( $ );
	
});	

/*
TO DO
wp.customize.controlConstructor['color-rgba'] = wp.customize.Control.extend( {
	ready: function() {
		var control = this;

		this.container.on( 'change', 'click',
			function() {
				control.setting.set( jQuery( this ).val() );
			}
		);
	}
} );*/