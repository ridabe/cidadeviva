jQuery( document ).ready( function($){
   "use strict";
   
    $('.digiqole_header_builder_select').on('change',function(){
       var id = $(this).val();
       var admin_url = admin_url_object.admin_url+id;
       $('.digiqole_header_builder_edit_link').attr("href", admin_url)
    });
    
   //  $('.header_layout_style').on('click',function(){

   //   var selected_header =  $(".header_layout_style .image_picker_selector .thumbnail.selected").find('img').data('hasqtip');
    
   //   if(parseInt(selected_header) == 7){
   //       $(".header_banner_override").show();
   //       var label =   $(".header_banner_override").parent('.fw-backend-option-input').html();
   //       console.log(label);
   //   }else{
   //    $(".header_banner_override").hide();
   //      var label =   $(".header_banner_override").parents(".fw-backend-option").hide();
   //   }
   //  });

  
});