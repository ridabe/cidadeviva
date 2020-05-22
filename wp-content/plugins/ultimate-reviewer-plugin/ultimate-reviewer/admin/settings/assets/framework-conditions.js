function conditions( optionContainer, optionUpdatedValue ) {
	
	optionContainer.find( '.gp-conditions' ).each( function() {
	
		var inputField = jQuery( this );
		var desiredValue = inputField.data( 'desired-value' );
		var targetID = inputField.data( 'target-id' );
		var targetValue = inputField.val() ? inputField.val() : jQuery( '.' + targetID ).data( 'default' );
		var operator = inputField.data( 'operator' );

		if ( inputField.length ) {
					
			// If values are equal
			if ( '=' === operator ) {
				if ( targetValue == desiredValue ) {
					if ( ! optionContainer.hasClass( 'gp-prev-hide' ) ) {
						optionContainer.removeClass( 'gp-hide' );
					}	
				} else {
					optionContainer.addClass( 'gp-hide gp-prev-hide' );
				}
			}
		
			// If values are not equal
			if ( '!=' === operator ) {
				if ( targetValue != desiredValue ) {
					if ( ! optionContainer.hasClass( 'gp-prev-hide' ) ) {
						optionContainer.removeClass( 'gp-hide' );
					}	
				} else {
					optionContainer.addClass( 'gp-hide gp-prev-hide' );
				}	
			}

			// If values are in array
			if ( 'in_array' === operator ) {
				var desiredValue = desiredValue.split( ',' );
				if ( jQuery.inArray( targetValue, desiredValue ) !== -1 ) {	
					if ( ! optionContainer.hasClass( 'gp-prev-hide' ) ) {
						optionContainer.removeClass( 'gp-hide' );
					}	
				} else {
					optionContainer.addClass( 'gp-hide gp-prev-hide' );
				}	
			}		
		
			// If value is not empty
			if ( 'not_empty' === operator ) {
				if ( '' != targetValue ) {
					if ( ! optionContainer.hasClass( 'gp-prev-hide' ) ) {
						optionContainer.removeClass( 'gp-hide' );
					}	
				} else {
					optionContainer.addClass( 'gp-hide gp-prev-hide' );
				}	
			}
							
		} else {
		
			optionContainer.removeClass( 'gp-hide' );
		
		}
		
	});	
	
	optionContainer.removeClass( 'gp-prev-hide' );
	
	
}

jQuery( function( $ ) {

	'use strict';
	
	$( '.gp-settings-section.gp-show .gp-setting' ).each( function() {	
		var optionContainer = $( this );
		conditions( optionContainer );
	});

	// When changing field values
	$( '.gp-setting' ).find( 'select, input[type=text], input[type=radio], input[type=checkbox], textarea, .gp-image-select' ).on( 'change click input', function() {
	
		// Get target option ID 
		var targetID = $( this ).closest( '.gp-setting' ).find( '.gp-option-id' ).val();
			
		// Update target value for target option
		var fieldValue = $( this ).val();
				
		// If image select field, get value this way
		if ( $( this ).is( '.gp-image-select' ) ) {
			fieldValue = $( this ).next().val();
		}
		
		// If checkbox field, get value this way
		if ( $( this ).is( 'input[type=checkbox]' ) ) {
			fieldValue = [];
			var checkboxContainer = $( this ).closest( '.gp-checkbox-field' );
			checkboxContainer.find( 'input[type=checkbox]' ).each( function() {
				if ( $( this ).is( ':checked' ) ) {	
					fieldValue.push( $( this ).val() );
				}	
			});	
			fieldValue.join( ',' );
		}
		
		// Add new target value to the conditional option
		$( '.gp-conditions[data-target-id="' + targetID + '"]' ).val( fieldValue );
		
		// Run function for each of the conditional options
		$( '.gp-conditions[data-target-id="' + targetID + '"]' ).closest( '.gp-setting' ).each( function() {	
			var optionContainer = $( this );
			conditions( optionContainer );
		});
				
	});

});