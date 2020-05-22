jQuery( document ).ready( function($){
    "use strict";
    
    // auto hide according to selected post format
    $('#post-formats-select').on('change', 'input[name=post_format]:checked', function(){
        var metaboxes = '#fw-options-box-settings-featured-video, #fw-options-box-settings-featured-gallery, #fw-options-box-settings-featured-audio';
        $(metaboxes).hide();

        var selected_format = $(this).val();
        $('#fw-options-box-settings-featured-' + selected_format).show(); 
    });
    $( "#post-formats-select input[name=post_format]:checked" ).trigger( "change" );
    
 

    // fix for google ad conflicts in elementor's editor
    (function () {
        var x = 0;
        var intervalID = setInterval(function () {
            var editor = $( "#elementor-preview-iframe");
            if(editor.length > 0){
                editor.css({'min-height': '100%' });
            }
            var editor = $( "#customize-preview iframe");
            if(editor.length > 0){
                editor.css({'min-height': '100%' });
            }
            if (++x === 5) {
                window.clearInterval(intervalID);
            }
        }, 3000);
    }());

});