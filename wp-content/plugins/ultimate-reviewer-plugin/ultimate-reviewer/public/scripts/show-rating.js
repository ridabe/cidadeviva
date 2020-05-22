jQuery( function( $ ) {

  'use strict';
  
	/**
	 * Set width for rating bar sections
	 *
	 */	
	var criterionWrapper = $( '.gpur-style-bars .gpur-criterion' );
	criterionWrapper.each( function() {
		var eachCriterionWrapper = $( this ),
			barCount = $( this ).find( '.gpur-user-rating' ).data( 'stop' ),
			barWidth = ( 100 / barCount ) + '%';
			eachCriterionWrapper.find( '.rating-symbol' ).css( 'width', barWidth );	
	});	
								
});	