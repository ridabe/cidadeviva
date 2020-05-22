function comparisonTableSorting( clickedElement ) {

	jQuery.ajax({
		type: 'GET',
		data: {			
			action: 'gpur_comparison_table_sorting',
			atts: clickedElement.closest( '.gpur-comparison-table' ).data( 'gpur-sorting-query' ),
			builder: clickedElement.closest( '.gpur-comparison-table' ).data( 'gpur-sorting-builder' ),
			nonce: clickedElement.closest( '.gpur-comparison-table' ).data( 'gpur-nonce' ),
			sorting: clickedElement.data( 'gpur-sorting' )
		},
		dataType: 'html',
		url: gpur_comparison_table_sorting.ajax_url,
		success: function( data, textStatus ) {
						
			if ( 'success' === textStatus ) {
			
				var table = clickedElement.closest( '.gpur-comparison-table-wrapper' );

				table.addClass( 'gpur-loading' );

				setTimeout( function() {
					var newTable = table.html( data ).removeClass( 'gpur-loading' );
					newTable.find( '.gpur-comparison-table' ).unwrap();
					if ( jQuery( 'input.rating' ).length ) {
						jQuery( 'input.rating' ).rating();
					}
				}, 800 );
				
			}

		},
		error: function( e ) {
			//console.log(e);
		}
		
	});

}

jQuery( document ).on( 'ready', function() {

	'use strict';
	
	jQuery( document ).on( 'click', '.gpur-sort-button', function( e ) {

		e.preventDefault();

		var clickedElement = jQuery( this );
		
		comparisonTableSorting( clickedElement );
		
		return false;
		
	});
	
});