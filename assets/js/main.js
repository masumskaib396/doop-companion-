(function($) {
"use strict";

/*------------------------------------------------------------------
[Table of contents]

THEPAW EVT MEANMENU INIT JS
THEPAW EVT ACCORDION CUSTOM JS
THEPAW EVT YOUTUBE MAGNIFIC POPUP JS
THEPAW EVT MAGNIFIC POPUP JS
THEPAW EVT GALLERY MASONAY FILTER JS
THEPAW EVT MAP JS

-------------------------------------------------------------------*/

/*--------------------------------------------------------------
CUSTOM PRE DEFINE FUNCTION
------------------------------------------------------------*/
/* is_exist() */
jQuery.fn.is_exist = function(){
  return this.length;
}


$(function(){




/*--------------------------------------------------------------
THEPAW EVT MAGNIFIC POPUP JS
------------------------------------------------------------*/
var tpw_gallery_popup = $('.doop__gallery_image');
if(tpw_gallery_popup.is_exist()){
  $(tpw_gallery_popup).magnificPopup({
     // delegate: 'a',
      type: 'image',
      closeOnContentClick: false,
      closeBtnInside: false,
      mainClass: 'mfp-with-zoom mfp-img-mobile',
      image: {
        verticalFit: true,
        titleSrc: function(item) {
          return item.el.attr('title') + ' &middot; <a class="image-source-link" href="'+item.el.attr('data-source')+'" target="_blank">image source</a>';
        }
      },
      gallery: {
        enabled: true
      },
      zoom: {
        enabled: true,
        duration: 300, // don't foget to change the duration also in CSS
        opener: function(element) {
          return element.find('img');
        }
      }

  });
}


});/*End document ready*/


$(window).on("resize", function(){

}); // end window resize


$(window).on("load" ,function(){



}); // End window LODE



})(jQuery);






