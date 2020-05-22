function submitVote( element ) {

	var button = element,
		parentContainer = button.parent().parent(),
		postID = parentContainer.data( 'content-id' ),
		nonce = parentContainer.data( 'nonce' ),
		meta = parentContainer.data( 'meta' ),
		type = button.data( 'type' ),
		itemName = 'gpur_up_down_voting' + postID,
		typeItemName = 'gpur_up_down_voting' + postID + '_' + type;

	// Check if the localStorage value exists, if not proceed
	if ( ! localStorage.getItem( itemName ) ) {

		// Set HTML5 localStorage so the user can not vote again unless they clear it					   
		localStorage.setItem( itemName, true );
		localStorage.setItem( typeItemName, true );

		// Collect data ready for sending to PHP
		var data = {
			action: 'gpur_up_down_voting_callback',
			postID: postID,
			type: type,
			nonce: nonce,
			meta: meta
		};

		jQuery.post( gpur_up_down_voting.ajax_url, data, function() {
			var count = parseInt( button.find( '.gpur-vote-count' ).html() ) + 1;
			button.find( '.gpur-vote-count' ).html( count );
			button.addClass( 'gpur-voted' );
			parentContainer.addClass( 'gpur-voted' );
		});
	
	} else {

		// Display message if user has already voted
		parentContainer.find( '.gpur-error' ).fadeIn().css( 'display', 'block' );
	
	}
}

jQuery( document ).ready( function( $ ) {

	'use strict';

	//localStorage.clear();

	// Submit data when clicking up/down buttons
	$( document ).on( 'click', '.gpur-vote-button', function( e ) {
		submitVote( $( this ) );
	});
	
	// Get all voting containers
	$( '.gpur-voting-container' ).each( function( index ) {

		// Get data attribute
		var parentContainer = $( this ),
			postID = parentContainer.data( 'content-id' ),
			itemName = 'gpur_up_down_voting' + postID;

		// Check if this content has localStorage
		if ( localStorage.getItem( itemName ) ) {
		
			parentContainer.addClass( 'gpur-voted' );

			// Check if user has already voted and add class
			if ( localStorage.getItem( 'gpur_up_down_voting' + postID + '_up' ) ) {
				parentContainer.find( '.gpur-up-vote' ).addClass( 'gpur-voted' );
			}
			if ( localStorage.getItem( 'gpur_up_down_voting' + postID + '_down' ) ) {
				parentContainer.find( '.gpur-down-vote' ).addClass( 'gpur-voted' );
			}
		}
	
	});
	
});