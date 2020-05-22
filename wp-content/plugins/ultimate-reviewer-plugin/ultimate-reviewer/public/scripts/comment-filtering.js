function commentAjaxFiltering( order, rating, pageNumber ) {

	jQuery.ajax({
		type: 'GET',
		data: {			
			action: 'gpur_comment_filtering',
			post_id: gpur_comment_filtering.post_id,
			comment_count: gpur_comment_filtering.comment_count,
			order: order,
			rating: rating,
			pageNumber: pageNumber,
			nonce: gpur_comment_filtering.nonce
		},
		dataType: 'html',
		url: gpur_comment_filtering.ajax_url,
		success: function( data, textStatus ) {	

			if ( 'success' === textStatus ) {
			
				// Hide PHP comment pagination
				jQuery( '.comment-list + .comments-pagination' ).hide();

				jQuery( '.comment-list' ).addClass( 'gpur-loading' );
				
				setTimeout( function() {
					jQuery( '.comment-list' ).html( data ).removeClass( 'gpur-loading' ).find( 'li' ).fadeIn();					
					jQuery( 'input.rating' ).rating();
				}, 800 );
			
			}

		},
		error: function(e) {
			//console.log(e);
		}
		
	});

}

jQuery( document ).ready( function( $ ) {

	'use strict';

	$( document ).on( 'change', 'select[name="gpur-comment-list-order-dropdown"]', function() {
		var order = $( this ).val(),
			rating = '';
		$( this ).find( 'option[value="' + order + '"]' ).attr( 'selected', 'selected' );
		$( 'select[name="gpur-comment-list-rating-dropdown"] option[value="' + rating + '"]' ).attr( 'selected', 'selected' );			
		commentAjaxFiltering( order, rating, '' );
		return false;
	});

	$( document ).on( 'change', 'select[name="gpur-comment-list-rating-dropdown"]', function() {
		var rating = $( this ).val(),
			order = 'post-date-desc';
		$( this ).find( 'option[value="' + rating + '"]' ).attr( 'selected', 'selected' );
		$( 'select[name="gpur-comment-list-order-dropdown"] option[value="' + order + '"]' ).attr( 'selected', 'selected' );		
		commentAjaxFiltering( order, rating, 1 );
		return false;
	});

	$( document ).on( 'click', '.comments-pagination .nav-links a', function( e ) {

		e.preventDefault();

		var page_link = $( this ),
			url = page_link.attr( 'href' ),
			current_container = page_link.parent();
		 
		var pageNumber = ''; 
	 	if ( page_link.hasClass( 'prev' ) ) {		
			pageNumber = url.split('/comment-page-')[1].split( '/' )[0];			
		} else if ( page_link.hasClass( 'next' ) ) {			
			pageNumber = url.split('/comment-page-')[1].split( '/' )[0];
		} else {
			pageNumber = page_link.text();			
		}
		
		page_link.attr( 'href', '#' );
		
		commentAjaxFiltering( '', '', pageNumber );
		return false;

	});
		
});