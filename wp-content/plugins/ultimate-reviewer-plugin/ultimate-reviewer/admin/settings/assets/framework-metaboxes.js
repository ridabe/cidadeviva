jQuery( function( $ ) {

	'use strict';

	/**
	 * Show page template/post format dependant metaboxes
	 *
	 */
	if ( $( 'body' ).hasClass( 'block-editor-page' ) ) { // Is Gutenberg active?

		wp.data.subscribe( () => {

			var newPageTemplate = wp.data.select( 'core/editor' ).getEditedPostAttribute( 'template' );
		
			$( '.gp-postbox-page-template' ).each( function() {
		
				var metabox = $( this ),
					metaboxID = metabox.attr( 'id' );
		
				metaboxID = metaboxID.replace( 'gp-', '' );
				metaboxID = metaboxID + '.php';
			
				if ( metaboxID === newPageTemplate ) {
					metabox.removeClass( 'hide-if-js closed' );
				} else {
					metabox.addClass( 'hide-if-js' );
				}
		
			});

		});

		wp.data.subscribe( () => {

			var newPostFormat = wp.data.select( 'core/editor' ).getEditedPostAttribute( 'format' );

			$( '.gp-postbox-post-format' ).each( function() {
	
				var metabox = $( this ),
					metaboxID = metabox.attr( 'id' );
			
				metaboxID = metaboxID.replace( 'gp-', '' );
				metaboxID = metaboxID.replace( '-format', '' );
				
				if ( metaboxID === newPostFormat ) {
					metabox.removeClass( 'hide-if-js closed' );
				} else {
					metabox.addClass( 'hide-if-js' );
				}
	
			});

		});

	} else {
	
		function pageTemplateMetaboxes( value ) {	
			var selectedTemplate = value.val();
			selectedTemplate = selectedTemplate.replace( '.php', '' );
			selectedTemplate = 'gp-' + selectedTemplate;
			$( '.gp-postbox-page-template' ).each( function() {
				var metabox = $( this ),
					metaboxID = metabox.attr( 'id' );
				if ( selectedTemplate === metaboxID ) {
					metabox.removeClass( 'hide-if-js closed' );
				} else {
					metabox.addClass( 'hide-if-js' );
				}
			});	
		}
		if ( $( '#page_template' ).length ) {
			pageTemplateMetaboxes( $( '#page_template' ) );
		}
		$( '#page_template' ).on( 'change', function() {
			pageTemplateMetaboxes( $( this ) );
		});

		function postFormatMetaboxes( value ) {
			var selectedFormat;
			$( value ).each( function() {		
				var value = $( this );
				if ( value.is( ':checked' ) ) {
					selectedFormat = value.val();
					selectedFormat = 'gp-' + selectedFormat + '-format';
				}
			});
			$( '.gp-postbox-post-format' ).each( function() {
				var metabox = $( this ),
					metaboxID = metabox.attr( 'id' );
				if ( selectedFormat === metaboxID ) {
					metabox.removeClass( 'hide-if-js closed' );
				} else {
					metabox.addClass( 'hide-if-js' );
				}
			});	
		}
		postFormatMetaboxes( $( '#post-formats-select input[type=radio]' ) );
		$( '#post-formats-select input[type=radio]' ).on( 'change', function() {
			postFormatMetaboxes( $( this ) );
		});	
		
	}
					
});