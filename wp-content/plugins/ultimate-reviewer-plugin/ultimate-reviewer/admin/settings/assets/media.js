function gpMediaField( $ ) {

	$( '.gp-settings-section.gp-show .gp-media-field' ).each( function() {
		 		
		var	field = $( this ),
			id = field.data( 'id' ),
			uploadButton = $( '#gp-media-' + id ),
			removeButton = $( '#gp-remove-media-' + id ),
			addText = uploadButton.data( 'add' ),
			changeText = uploadButton.data( 'change' ),
			value = $( '#' + id ),
			mediaUploader;
		
		$( '#gp-media-' + id ).click( function( e ) {
			
			e.preventDefault();
			
			if ( mediaUploader ) {
				mediaUploader.open();
				return;
			}
			
			mediaUploader = wp.media.frames.file_frame = wp.media({
				title: uploadButton.val(),
				button: {
					text: uploadButton.val()
				}, 
				multiple: false 
			});
			
			mediaUploader.on( 'select', function() {
				
				var attachment = mediaUploader.state().get( 'selection' ).first().toJSON();	
				$( '#gp-media-preview-' + id + ' img' ).remove();
				
				value.val( attachment.id );
				
				uploadButton.val( changeText );
				removeButton.addClass( 'gp-show' );
				
				if ( 'image' === attachment.type ) {
					$( '#gp-media-preview-' + id ).append( '<img src="' + attachment.sizes.thumbnail.url +'" class="gp-image-thumbnail" alt="">' );
				} else if ( 'audio' === attachment.type || 'video' === attachment.type ) {
					$( '#gp-media-preview-' + id ).append( '<img src="' + attachment.icon +'" class="gp-audio-video-thumbnail" alt="">' + '<strong>' + attachment.filename + '</strong>' );
				}
				
			});
			mediaUploader.open();
		});
		
		$( '#gp-remove-media-' + id ).click( function( e ) {
			e.preventDefault();
			var attachment = '';
			value.val( '' );
			$( '#gp-media-preview-' + id + ' img' ).remove();
			$( '#gp-media-preview-' + id + ' strong' ).remove();
			$( this ).removeClass( 'gp-show' );
			uploadButton.val( addText );
		});
	
	});
	
}

jQuery( function( $ ) {

	'use strict';

	gpMediaField( $ );
			
});	