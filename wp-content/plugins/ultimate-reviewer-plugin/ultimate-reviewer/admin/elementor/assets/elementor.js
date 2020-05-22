jQuery( function( $ ) {

	elementorFrontend.hooks.addAction( 'frontend/element_ready/show_rating.default', function( $scope, $ ) {

		if ( $( 'input.rating' ).length ) {
			$( 'input.rating' ).rating();
		}	

	 });	

	elementorFrontend.hooks.addAction( 'frontend/element_ready/add_user_rating.default', function( $scope, $ ) {

		if ( $( 'input.rating' ).length ) {
			$( 'input.rating' ).rating();
		}	

	 });	
	 
});