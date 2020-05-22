     <?php
       if(digiqole_option('blog_archive_title_show','yes')=='no'){
         return;
       } 
     ?>
     <div class="row"> 
            <div class="digiqole-page col-md-12"> 
               <div class="category-main-title heading-style3">
                  <h1 class="block-title">
                     <span class="title-angle-shap"> <?php echo esc_html(get_the_archive_title()); ?> </span>
                  </h1>
               </div>
            </div>
      </div> 