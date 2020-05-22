jQuery( function( $ ) {

	'use strict';
	
	/**
	 * Dependency display
	 *
	 */			
	function dependencyDisplay( id, value ) {			
		
		// Equal to dependency	
		$( '.gp-settings-section.gp-show .gp-setting.gp-equal.gp-setting-' + id ).each( function() {	

			if ( $( this ).hasClass( 'gp-value-' + value ) && ! $( this ).hasClass( 'gp-prev-hidden' ) ) {
				$( this ).removeClass( 'gp-hide' );
			} else {
				$( this ).addClass( 'gp-hide gp-prev-hidden' )
			}
			
		});	
			
		// Not equal to dependency	
		$( '.gp-settings-section.gp-show .gp-setting.gp-not-equal.gp-setting-' + id ).each( function() {	
			
			if ( $( this ).hasClass( 'gp-value-' + value ) ) {
				$( this ).addClass( 'gp-hide' );
			} else {
				$( this ).removeClass( 'gp-hide' );
			}
		
		});
		
		// Not empty dependency		
		$( '.gp-settings-section.gp-show .gp-setting.gp-not-empty.gp-setting-' + id ).each( function() {

			if ( $( '#' + id + ' [type=checkbox]' ).length ) {
				if ( $( '#' + id + ' [type=checkbox]' ).is( ':checked' ) ) {
					$( this ).removeClass( 'gp-hide' );
				} else {
					$( this ).addClass( 'gp-hide' );
				}
			} else if ( $( '#' + id + ' input[type=radio]' ).length ) {
				if ( $( '#' + id + ' input[type=radio]' ).is( ':checked' ) ) {
					$( this ).removeClass( 'gp-hide' );
				} else {
					//$( this ).addClass( 'gp-hide' );
				}
			} else if ( '' !== $( '#' + id ).val() ) {
				$( this ).removeClass( 'gp-hide' );	
			} else if ( '' === $( '#' + id ).val() ) {
				$( this ).addClass( 'gp-hide' );
			}
	
		});	
		
	}

	/**
	 * Get field ids and values
	 *
	 */		
	function getFieldIDValues( fields ) {	
	
		var value = '';

		if ( $( fields ) ) {	
		
			if ( fields.is( 'input[type=checkbox]' ) ) {
			
				fields.each( function() {	

					if ( $( this ).hasClass( 'gp-data-checkbox' ) ) {
						var id = $( this ).parent().parent().attr( 'id' );
					} else {
						var id = $( this ).attr( 'id' );
					}
					
					if ( $( this ).is( ':checked' ) ) {
						var value = $( this ).val();
					} else {
						var value = '';
					}
					dependencyDisplay( id, value );
					
				});	

			} else if ( fields.is( '.gp-image-select' ) ) {	
					
				fields.on( 'click', function() {
					var id = $( this ).parent().parent().attr( 'id' ),
						value = $( this ).next().val();
					dependencyDisplay( id, value );
				});	
					
			} else if ( fields.is( 'input[type=radio]' ) ) {
			
				fields.each( function() {
				
					if ( $( this ).is( ':checked' ) ) {
						var id = $( this ).parent().parent().attr( 'id' );
						var value = $( this ).val();
						dependencyDisplay( id, value );
					}
						
				});
		
			} else if ( fields.is( 'textarea' ) || fields.is( 'input[type=text]' ) ) {
		
				var id = fields.attr( 'id' );
				var value = '';
				if ( fields.val().length )  {
					value = 'gp-not-empty';
				}
				dependencyDisplay( id, value );
			
			} else {

				var id = fields.attr( 'id' ),
					value = fields.val();
				dependencyDisplay( id, value );
			
			}	
		
		}	

	}	
						
	/**
	 * Get field ids and values
	 *
	 */	
	function loadFields() {
	
		$( '.gp-setting' ).find( 'select, input[type=text], input[type=radio], input[type=checkbox], textarea, .gp-image-select' ).each( function() {	

			var fields = $( this );
	
			if ( fields.length ) {
		
				// On page load
				getFieldIDValues( fields );
			
				// When changing field option
				fields.on( 'change click input', function() {
					var fields = $( this );
					$( '.gp-settings-section.gp-show .gp-setting' ).removeClass( 'gp-prev-hidden' );
					getFieldIDValues( fields );
				});
		
			}				

		});
	
	}
		
	// Load dependency fields
	loadFields( $ );
					
});	