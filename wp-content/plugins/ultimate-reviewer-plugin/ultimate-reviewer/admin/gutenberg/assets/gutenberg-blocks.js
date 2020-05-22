var el = wp.element.createElement,
    registerBlockType = wp.blocks.registerBlockType,
    ServerSideRender = wp.components.ServerSideRender,
    SelectControl = wp.components.SelectControl;
	reviewTemplates = gpur_gutenberg_blocks.review_templates,
	dropdownValues = [],
	count = 0;

dropdownValues[0] = '';	
jQuery.each( reviewTemplates, function( title, id )  {
	count++;
	dropdownValues[count] = {
		value: id,
		label: title,
	};
});

registerBlockType( 'gpur/review-template', {
    title: 'Review Template',
    icon: 'star-empty',
    category: 'layout',
	attributes: {
		review_template_id: {
			type: 'string',
			default: ''
		}
	},
    edit: function( props ) {
		return wp.element.createElement( SelectControl, {
			label: 'Review Template',
			options: dropdownValues,
			value: props.attributes.review_template_id,
			onChange: function( value ) {
				props.setAttributes( { review_template_id: value } );
			}
		});		
    },
    save: function( props ) {  
       	return (
            el( ServerSideRender, {
                block: 'gpur/review-template',
                attributes: props.attributes
            })
        );
    },
});