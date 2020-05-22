function gpGalleryField( $ ) {

	$( '.gp-settings-section.gp-show .gp-gallery-field' ).each( function() {
		 		
		var	field = $( this ),
			id = field.data( 'id' ),
			uploadButton = $( '#gp-gallery-' + id ),
			removeButton = $( '#gp-remove-gallery-' + id ),
			addText = uploadButton.data( 'add' ),
			changeText = uploadButton.data( 'change' ),
			value = $( '#' + id ),
			galleryUploader;
		
		$( '#gp-gallery-' + id ).click( function( e ) {

			e.preventDefault();

			if ( galleryUploader ) {
				galleryUploader.open();
				return;
			}

			galleryUploader = wp.media.frames.file_frame = wp.media({
				title: uploadButton.val(),
				button: {
					text: uploadButton.val()
				},
				multiple: true 
			});
			
			galleryUploader.on( 'select', function() {
			
				var attachments = galleryUploader.state().get( 'selection' ).map( 
					function( attachments ) {
						attachments.toJSON();
						return attachments;
					});
					
				var attachment_ids = [],
					i;
					
				uploadButton.val( changeText );				
				removeButton.addClass( 'gp-show' );
				
				for ( i = 0; i < attachments.length; i++ ) {
					attachment_ids[i] = attachments[i].id;
					$( '#gp-gallery-preview-' + id ).append( '<img src="' + attachments[i].attributes.sizes.thumbnail.url +'">' );
				}
				
				if ( attachment_ids ) {
					$( '#' + id ).data( 'val', $( '#' + id ).val() );
					var prevValues = $( '#' + id ).data( 'val' );
					if ( prevValues ) {
						attachment_ids.push( prevValues );
					}
					value.val( attachment_ids.join( ',' ) );
				}
				
			});
			
			galleryUploader.open();
			
		});
		
		$( '#gp-remove-gallery-' + id ).click( function( e ) {
			e.preventDefault();
			var attachment_ids = [];
			value.val( '' );
			$( '#gp-gallery-preview-' + id + ' img' ).remove();
			$( this ).removeClass( 'gp-show' );
			uploadButton.val( addText );
		});
	
	});
	
}

jQuery( function( $ ) {

	'use strict';

	gpGalleryField( $ );
			
});