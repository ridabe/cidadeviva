jQuery( function( $ ) {

	'use strict';

  	// Reset user ratings
	$( '.gpur-reset-user-ratings-button' ).click( function( e ) {
		
		e.preventDefault();
		
		var link = $( this ),
			confirmMessage = link.data( 'confirm-msg' ),
			postID = link.data( 'post-id' ),
			clicked = confirm( confirmMessage );
			
		if ( 1 != clicked ) return !1;
		
		var loader = link.parent().find( '.gpur-loader' ),
			data = {
				action: gpur_reset_user_ratings.action,
				security: gpur_reset_user_ratings.ajax_nonce,
				postID: postID
			};
			
		loader.fadeIn( 'fast' );
		
		$.post( gpur_reset_user_ratings.ajax_url, data, function( e ) {

			// Reset up/down votes for this post
			var itemName = 'gpur_up_down_voting' + postID;
			localStorage.removeItem( itemName );
	
			link.parent().parent().find( '.gpur_user_rating' ).html( '-' );
			link.parent().parent().find( '.gpur_user_votes' ).html( '-' );
			link.remove();
			loader.fadeOut( 'fast' );
			
		}).fail( function() {
		
			loader.fadeOut( 'fast' );
			alert( 'Error resetting score.' );
			
		})
	});
	
  	// Delete site rating
	$( '.gpur-delete-site-rating-button' ).click( function( e ) {
		
		e.preventDefault();
		
		var link = $( this ),
			confirmMessage = link.data( 'confirm-msg' ),
			postID = link.data( 'post-id' ),
			clicked = confirm( confirmMessage );
			
		if ( 1 != clicked ) return !1;
		var loader = link.parent().find( '.gpur-loader' ),
			data = {
				action: gpur_delete_site_rating.action,
				security: gpur_delete_site_rating.ajax_nonce,
				postID: postID
			};
		loader.fadeIn( 'fast' ), 
		$.post( gpur_delete_site_rating.ajax_url, data, function( e ) {
			link.parent().parent().find( '.gpur_site_rating' ).html( '-' );	
			link.remove();
			loader.fadeOut( 'fast' );	
		}).fail( function( e ) {
			loader.fadeOut( 'fast' );
		});
	});
 
});