
( function ($, elementor) {
	"use strict";

   
    var DIGIQOLE = {

        init: function () {
            
            var widgets = {
               'newszone-post-grid-slider.default': DIGIQOLE.Newszone_post_grid_slider,
               'newszone-post-block-slider.default': DIGIQOLE.Newszone_post_block_slider,
               'newszone-main-slider.default': DIGIQOLE.Newszone_main_slider,
               'newszone-post-slider.default': DIGIQOLE.Newszone_post_slider,
               'newszone-editor-pick-post-slider.default': DIGIQOLE.Newszone_editor_pick_post_slider,
               'newszone-video-post-slider2.default': DIGIQOLE.Newszone_video_slider2,
		          
            };
            $.each(widgets, function (widget, callback) {
                elementor.hooks.addAction('frontend/element_ready/' + widget, callback);
            });
           
      },
            /* ----------------------------------------------------------- */
            /*  Grid slider
            /* ----------------------------------------------------------- */
            Newszone_post_grid_slider:function($scope){
            
               var $container = $scope.find('.weekend-top');
               var conrol_data = $container.attr('data-controls');
               var autoslide = true;
               var dot_nav = true;
               var nav_show = false;
               var item_count = true;
               if(conrol_data){
                  var controls = JSON.parse($container.attr('data-controls'));
                  autoslide = Boolean(controls.auto_nav_slide?true:false);
                  dot_nav = Boolean(controls.dot_nav_show?true:false);
                  nav_show = Boolean(controls.nav_show?true:false);
                  item_count = parseInt( controls.item_count );
               }
            
               if ($container.length > 0) {
                     $container.owlCarousel({
                        items: item_count,
                        loop: true,
                        autoplay: autoslide,
                        nav: nav_show,
                        dots: dot_nav,
                        autoplayTimeout: 8000,
                        autoplayHoverPause: false,
                        mouseDrag: true,
                        smartSpeed: 1100,
                        margin:30,
                        navText: ["<i class='icon icon-arrow-left'></i>", "<i class='icon icon-arrow-right'></i>"],
                        responsive: {
                           0: {
                              items: 1,
                           },
                           600: {
                              items: 2,
                           },
                           1000: {
                              items:item_count,
                           }
                        }
                  
                     });
               }
          
         },

           /* ----------------------------------------------------------- */
            /*  Post block slider
            /* ----------------------------------------------------------- */
            Newszone_post_block_slider:function($scope){
            
               var $container = $scope.find('.block-slider');
                var controls= JSON.parse($container.attr('data-controls'));
                var autoslide = Boolean(controls.auto_nav_slide?true:false);
                var dot_nav = Boolean(controls.dot_nav_show?true:false);
                var item_count = parseInt( controls.item_count );
               
               if ($container.length > 0) {
                     $container.owlCarousel({
                        items: item_count,
                        loop: true,
                        autoplay: autoslide,
                        nav: false,
                        dots: dot_nav,
                        autoplayTimeout: 8000,
                        autoplayHoverPause: false,
                        mouseDrag: true,
                        smartSpeed: 1100,
                        margin:30,
                        navText: ["<i class='icon icon-arrow-left'></i>", "<i class='icon icon-arrow-right'></i>"],
                        responsive: {
                           0: {
                              items: 1,
                           },
                           600: {
                              items: 2,
                           },
                           1000: {
                              items: 3,
                           },
                           1200: {
                              items:item_count,
                           }
                        }
                  
                     });
               }
          
         },

            /* ----------------------------------------------------------- */
            /*  main slider
            /* ----------------------------------------------------------- */
            Newszone_main_slider:function($scope){
            
               var $container = $scope.find('.main-slider');
               var control_data = $container.attr('data-controls');
               var autoslide = true;
               var nav = true;
               var dot = false;
               if(control_data){
                  var controls= JSON.parse($container.attr('data-controls'));
                  var autoslide = Boolean(controls.auto_nav_slide?true:false);
                  var nav = Boolean(controls.dot_nav_show?true:false);
                  var dot = Boolean(controls.slider_dot_show?true:false);
               }
               
               if ($container.length > 0) {
                     $container.owlCarousel({
                        items: 3,
                        loop: true,
                        autoplay: autoslide,
                        nav: nav,
                        dots: dot,
                        autoplayTimeout: 5000,
                        autoplayHoverPause: true,
                        mouseDrag: true,
                        smartSpeed: 1100,
                        margin:30,
                       
                        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
                        responsive: {
                           0: {
                              items: 1,
                           },
                           600: {
                              items: 1,
                           },
                           1000: {
                              items:1,
                           },
                           1300: {
                              items:1,
                           }
                        }
                  
                     });
                     $('.main-slider').on('mouseleave',function(){
                        $container.trigger('play.owl.autoplay',[1000])
                    })
                    $('.main-slider').on('mouseover',function(){
                     $container.trigger('stop.owl.autoplay')
                    });
               };

               var $container2 = $scope.find('.main-slide.style4');
               var conrol_data = $container2.attr('data-controls');
               var autoslide1 = true;
               var nav1 = true;
               var dot1 = false;
               if(conrol_data){
                  var controls1= JSON.parse($container2.attr('data-controls'));
                  var autoslide1 = Boolean(controls1.auto_nav_slide?true:false);
                  var nav1 = Boolean(controls1.dot_nav_show?true:false);
                  var dot1 = Boolean(controls1.slider_dot_show?true:false);
               }
               if ($container2.length > 0) {
                     $container2.owlCarousel({
                        items: 1,
                        loop: true,
                        autoplay: autoslide1,
                        nav: nav1,
                        dots: dot1,
                        autoplayTimeout: 5000,
                        autoplayHoverPause: true,
                        mouseDrag: true,
                        smartSpeed: 1100,
                        margin:30,
                        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
                        responsive: {
                           0: {
                              items: 1,
                           },
                           600: {
                              items: 1,
                              stagePadding: 30,
                           },
                           1300: {
                              items:1,
                              stagePadding: 200,
                           }
                        }
                  
                     });
                  
               }
         },
           
            /* ----------------------------------------------------------- */
            /*  post slider
            /* ----------------------------------------------------------- */
            Newszone_post_slider:function($scope){
            
               var $container = $scope.find('.post-slider');
                var controls= JSON.parse($container.attr('data-controls'));
                    
                var autoslide = Boolean(controls.auto_nav_slide?true:false);
                var dot_nav = Boolean(controls.dot_nav_show?true:false);
                var nav = Boolean(controls.nav_show?true:false);
                var item_count = parseInt(controls.item_count);
                var margin = parseInt(controls.margin);
               
               
               if ($container.length > 0) {
                     $container.owlCarousel({
                        items: item_count,
                        loop: true,
                        autoplay: autoslide,
                        nav: nav,
                        dots: dot_nav,
                        autoplayTimeout: 8000,
                        autoplayHoverPause: true,
                        mouseDrag: true,
                        smartSpeed: 1100,
                        margin:margin,
                        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
                        responsive: {
                           0: {
                              items: 1,
                           },
                           600: {
                              items: 2,
                           },
                           1000: {
                              items:2,
                           },
                           1200: {
                              items:item_count,
                           }
                        }
                  
                     });
                     $('.post-slider').on('mouseleave',function(){
                        $container.trigger('play.owl.autoplay',[1000])
                    })
                    $('.post-slider').on('mouseover',function(){
                     $container.trigger('stop.owl.autoplay')
                    });
               }
          
         },
            /* ----------------------------------------------------------- */
            /*video  post slider
            /* ----------------------------------------------------------- */
            Newszone_video_slider2:function($scope){
            
               var sync1 = $("#video-sync-slider1");
               var sync2 = $("#video-sync-slider2");
               var slidesPerPage = 4;
               var syncedSecondary = true;
             
               sync1.owlCarousel({
                 items : 1,
                 slideSpeed : 2000,
                 autoplayHoverPause:false,
                 nav: false,
                 autoplay: false,
                 dots: false,
                 loop: true,
                 responsiveRefreshRate : 200,
             }).on('changed.owl.carousel', syncPosition);
             
               sync2
                 .on('initialized.owl.carousel', function () {
                   sync2.find(".owl-item").eq(0).addClass("current");
                 })
                 .owlCarousel({
                 items : slidesPerPage,
                 dots: false,
                 nav: false,
                 smartSpeed: 200,
                 slideSpeed : 500,
                 slideBy: slidesPerPage,
                 responsiveRefreshRate : 100,
                 responsive: {
                  0: {
                     items: 1,
                  },
                  500: {
                     items: 2,
                  },
                  768: {
                     items: 3,
                  },
                  1000: {
                     items:slidesPerPage,
                  }
               }

               }).on('changed.owl.carousel', syncPosition2);
             
               function syncPosition(el) {
               
                 var count = el.item.count-1;
                 var current = Math.round(el.item.index - (el.item.count/2) - .5);
                 
                 if(current < 0) {
                   current = count;
                 }
                 if(current > count) {
                   current = 0;
                 }
                 
                 //end block
             
                 sync2
                   .find(".owl-item")
                   .removeClass("current")
                   .eq(current)
                   .addClass("current");
                     var onscreen = sync2.find('.owl-item.active').length - 1;
                     var start = sync2.find('.owl-item.active').first().index();
                     var end = sync2.find('.owl-item.active').last().index();
                 
                 if (current > end) {
                   sync2.data('owl.carousel').to(current, 100, true);
                 }
                 if (current < start) {
                   sync2.data('owl.carousel').to(current - onscreen, 100, true);
                 }
               }
               
               function syncPosition2(el) {
                 if(syncedSecondary) {
                   var number = el.item.index;
                   sync1.data('owl.carousel').to(number, 100, true);
                 }
               }
               
               sync2.on("click", ".owl-item", function(e){
                 e.preventDefault();
                 var number = $(this).index();
                 sync1.data('owl.carousel').to(number, 300, true);
               });
          
         },
           /* ----------------------------------------------------------- */
            /*  Editor pick post slider
            /* ----------------------------------------------------------- */
            Newszone_editor_pick_post_slider:function($scope){
            
               var $container = $scope.find('.editor-pick-post-slider');
                var controls= JSON.parse($container.attr('data-controls'));
                    
                var autoslide = Boolean(controls.auto_nav_slide?true:false);
                var nav = Boolean(controls.dot_nav_show?true:false);
                var item_count = parseInt(controls.item_count);
               
               
               if ($container.length > 0) {
                     $container.owlCarousel({
                        items: item_count,
                        loop: true,
                        autoplay: autoslide,
                        nav: false,
                        dots: nav,
                        autoplayTimeout: 8000,
                        autoplayHoverPause: true,
                        mouseDrag: true,
                        smartSpeed: 1100,
                        margin:30,
                        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
                        responsive: {
                           0: {
                              items: 1,
                           },
                           600: {
                              items: 2,
                           },
                           1000: {
                              items:item_count,
                           }
                        }
                  
                     });

                     $('.editor-pick-post-slider').on('mouseleave',function(){
                        $container.trigger('play.owl.autoplay',[1000])
                    })
                    $('.editor-pick-post-slider').on('mouseover',function(){
                     $container.trigger('stop.owl.autoplay')
                    });
               }
          
         },
     
    };
    $(window).on('elementor/frontend/init', DIGIQOLE.init);
    
}(jQuery, window.elementorFrontend) ); 