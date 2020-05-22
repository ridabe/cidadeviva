jQuery( function( $ ) {

	'use strict';

	/**
	 * Load functions
	 *
	 */
	function loadFunctions( $ ) {		
		
		if ( $( '.select2-field' ).length > 0 ) {
			$( '.gp-settings-section.gp-show .select2-field' ).select2();	
		}
		
		if ( $.isFunction( window.gpColorField ) ) {
			gpColorField( $ );
		}
		if ( $.isFunction( window.gpIconField ) ) {
			gpIconField( $ );
		}
		if ( $.isFunction( window.gpImageSelectField ) ) {
			gpImageSelectField( $ );
		}
		if ( $.isFunction( window.gpGalleryField ) ) {
			gpGalleryField( $ );
		}
		if ( $.isFunction( window.gpMediaField ) ) {
			gpMediaField( $ );
		}
		if ( $.isFunction( window.gpMultiTextField ) ) {
			gpMultiTextField( $ );	
		}
		if ( $.isFunction( window.gpSliderField ) ) {
			gpSliderField( $ );
		}
		if ( $.isFunction( window.gpSpinnerField ) ) {
			gpSpinnerField( $ );
		}
		if ( $.isFunction( window.gpTypographyField ) ) {
			gpTypographyField( $ );
		}
		
		gpScrollButtons();
		
	}
					
	/**
	 * Nav tabs
	 *
	 */		
	// Reset all sections
	$( '#gp-settings-form .gp-main-nav-tab' ).addClass( 'nav-tab-inactive' );	
	$( '#gp-settings-form .gp-sub-nav-tab' ).addClass( 'nav-tab-inactive' );
	$( '#gp-settings-form .subsubsub' ).removeClass( 'gp-show' );
	$( '#gp-settings-form .gp-settings-section' ).removeClass( 'gp-show' );
	
	if ( localStorage.getItem( ghostpool_framework.subtab ) ) {
	
		var tabID = localStorage.getItem( ghostpool_framework.maintab );
		var subTabID = localStorage.getItem( ghostpool_framework.subtab );
		
		$( '#' + tabID + '.gp-main-nav-tab' ).addClass( 'nav-tab-active' );
		$( '#' + subTabID + '.gp-sub-nav-tab' ).addClass( 'current' );
		$( '#' + tabID + '-sub-nav' ).addClass( 'gp-show' );
		$( '#' + subTabID + '-container' ).addClass( 'gp-show' );
		
		// Load functions
		if ( $( '.select2-field' ).length > 0 ) {
			$( '.gp-settings-section.gp-show .select2-field' ).select2();	
		}
		
	} else if ( localStorage.getItem( ghostpool_framework.maintab ) ) {
		
		var tabID = localStorage.getItem( ghostpool_framework.maintab );

		$( '#' + tabID + '.gp-main-nav-tab' ).addClass( 'nav-tab-active' );
		$( '#' + tabID + '.gp-sub-nav-tab:first' ).addClass( 'current' );
		$( '#' + tabID + '-sub-nav' ).addClass( 'gp-show' );
		$( '#' + tabID + '-container' ).addClass( 'gp-show' );	
		
		// Load functions
		if ( $( '.select2-field' ).length > 0 ) {
			$( '.gp-settings-section.gp-show .select2-field' ).select2();	
		}
			
	} else {
	
		$( '#gp-settings-form .gp-main-nav-tab:first' ).addClass( 'nav-tab-active' );
		$( '#gp-settings-form .gp-settings-section:first' ).addClass( 'gp-show' );
		$( '#gp-settings-form .subsubsub:first' ).addClass( 'gp-show' );
		$( '#gp-settings-form .subsubsub:first .gp-sub-nav-tab:first' ).addClass( 'current' );
				
		// Load functions
		if ( $( '.select2-field' ).length > 0 ) {
			$( '.gp-settings-section.gp-show .select2-field' ).select2();	
		}
		
	}

	// Main nav tabs
	$( document ).on( 'click', '#gp-settings-form .gp-main-nav-tab', function() {
		
		var tabID = $( this ).attr( 'id' );

		localStorage.setItem( ghostpool_framework.maintab, tabID );	
		localStorage.removeItem( ghostpool_framework.subtab );		 
		
		if ( $( this ).hasClass( 'nav-tab-inactive' ) ) {
						
			// Reset all sections
			$( '#gp-settings-form .gp-main-nav-tab' ).addClass( 'nav-tab-inactive' ).removeClass( 'nav-tab-active' ); 
			$( '#gp-settings-form .gp-sub-nav-tab' ).addClass( 'nav-tab-inactive' ).removeClass( 'current' ); 
			$( '#gp-settings-form .subsubsub' ).removeClass( 'gp-show' );
			$( '#gp-settings-form .gp-settings-section' ).removeClass( 'gp-show' );
			
			// Add classes to currently selected tab
			$( this ).removeClass( 'nav-tab-inactive' ).addClass( 'nav-tab-active' );
			$( '#' + tabID + '.gp-sub-nav-tab' ).removeClass( 'nav-tab-inactive' ).addClass( 'current' );
			$( '#' + tabID + '-sub-nav' ).addClass( 'gp-show' );
			$( '#' + tabID + '-container' ).addClass( 'gp-show' );			

			// Load functions
			loadFunctions( $ );
			
			return false;	
	
		}
		
	});

	// Sub nav tabs
	$( document ).on( 'click', '#gp-settings-form .gp-sub-nav-tab', function() {
		
		var tabID = $( this ).attr( 'id' );
		
		localStorage.setItem( ghostpool_framework.subtab, tabID );
		if ( $( this ).hasClass( 'nav-tab-inactive' ) ) {
			
			// Reset all sections
			$( '#gp-settings-form .gp-sub-nav-tab' ).addClass( 'nav-tab-inactive' ).removeClass( 'current' );    
			$( '#gp-settings-form .gp-settings-section' ).removeClass( 'gp-show' );
			
			// Add classes to currently selected tab
			$( this ).removeClass( 'nav-tab-inactive' ).addClass( 'current' );
			$( '#' + tabID + '-container' ).addClass( 'gp-show' );
			
			// Load functions
			loadFunctions( $ );
			
			return false;
	
		}
		
	});
	
	/**
	 * Show buttons on scroll
	 *
	 */
	function gpScrollButtons() {
	
		var scrollHeight = $( document ).height();
		var scrollPosition = $( window ).height() + $( window ).scrollTop();

		if ( ( scrollHeight - scrollPosition ) > 70 ) {
			$( '.gp-submit' ).addClass( 'gp-scrolling-submit' );
		} else {
			$( '.gp-submit' ).removeClass( 'gp-scrolling-submit' );
		}

	}
	
	$( document ).on( 'ready', function() {
		gpScrollButtons();
	});
	$( window ).on( 'scroll', function() {	
		gpScrollButtons();
	});
						
});