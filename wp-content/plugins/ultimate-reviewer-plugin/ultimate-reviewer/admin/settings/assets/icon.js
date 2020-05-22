function gpIconField( $ ) {

	// Open icons box
	$( document ).on( 'click', '.gp-closed .gp-open-icons-box', function() {
		$( '.gp-icon-wrapper.gp-opened' ).removeClass( 'gp-opened' ).addClass( 'gp-closed' );
		var container = $( this ).parent().removeClass( 'gp-closed' ).addClass( 'gp-opened' );
		//container.find( '.gp-icon-box' ).show();
	});
	
	// Close icons box
	$( document ).on( 'click', '.gp-opened .gp-open-icons-box', function( e ) {
		var container = $( this ).parent().removeClass( 'gp-opened' ).addClass( 'gp-closed' );
		//container.find( '.gp-icon-box' ).hide();
	});

	// Close icons box when clicking elsewhere
	$( document ).on( 'click', function( e ) {
		var container = $( '.gp-icon-wrapper.gp-opened' );
		if ( ! container.is( e.target ) && container.has( e.target ).length === 0) {
			//$( '.gp-icon-box' ).hide()
			container.removeClass( 'gp-opened' ).addClass( 'gp-closed' );
		}
	});
	
	// Add selected icon link as input value	
	$( '.gp-icon-link' ).click( function() {
		
		var container = $( this ).parent().parent();
		
		container.find( '.gp-icon-link.gp-selected' ).removeClass( 'gp-selected' );
		
		$( this ).addClass( 'gp-selected' );   
		  
		var value = $( this ).attr( 'href' );
		container.find( '.gp-selected-icon' ).val( value );
		container.find( '.gp-open-icons-box' ).html( '' ).prepend( '<i class="' + value + '"></i><span class="gp-icon-box-arrow"></span>' );
		
		return false;
		
	});
	
	// Remember selected icon link on page reload
	$( '.gp-icon-link' ).each( function() {
		var value = $( this ).attr( 'href' );	
		var container = $( this ).parent().parent();
		if ( value === container.find( '.gp-selected-icon' ).val() ) {
			$( this ).addClass( 'gp-selected' ); 
		}
	});	

}

jQuery( function( $ ) {

	'use strict';

	gpIconField( $ );
			
});	
		