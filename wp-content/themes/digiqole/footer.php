
   <?php
   
      if ( !defined( 'FW' ) ) {

         get_template_part( 'template-parts/footer/footer', 'style-1' );  

      } else {

         $style = digiqole_option("footer_style");
         
         if(is_array($style)){

            if(array_key_exists("style",$style)){
               $style = $style["style"]==''?'style-1':$style["style"];
            }

         } else {

            $style = "style-1";

         }
             
         get_template_part( 'template-parts/footer/footer', $style );
      }



   ?>
   </div>

   <?php wp_footer(); ?>

   </body>
</html>