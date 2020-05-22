function gpAceEditorField( $, global ) {

	$( '.gp-settings-section .gp-ace-editor-field' ).each( function() {
	
		var aceField = $( this ),
			editor,
			mode,
			textarea = '#' + aceField.find( 'textarea' ).attr( 'data-textarea' ),
			syncCSS = function() {
				$( textarea ).val( editor.getSession().getValue() );
			},
			loadAce = function() {
				editor = ace.edit( aceField.find( '.gp-ace-editor' ).attr( 'data-editor' ) );
				mode = aceField.find( '.gp-ace-editor' ).attr( 'data-mode' );
				global.safecss_editor = editor;
				editor.getSession().setUseWrapMode( true );
				editor.setShowPrintMargin( false );
				editor.getSession().setValue( $( textarea ).length ? $( textarea ).val() : '' );
				editor.getSession().setMode( "ace/mode/" + mode );
				editor.setTheme( 'ace/theme/twilight' );
				$( '#gp-settings-form' ).submit( syncCSS );
			};

		$( global ).load( loadAce );
		global.aceSyncCSS = syncCSS;
		
	});			
		
}

( function( $, global ) {

	'use strict';
	
	gpAceEditorField( $, global );

} )( jQuery, this );