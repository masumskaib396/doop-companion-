(function ($) {

"use strict";


 // Make sure you run this code under Elementor..
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/doop_gallery.default',function($scope, $){
           
 			var pslider = $scope.find(".doop_gallery_carpusel");

			 if( pslider.length === 0 )
			    return;

			 var settings = pslider.data('settings');

			/*--------------------------------------------------------------
			DOOP PROMO SLIDER JS
			--------------------------------------------------------------*/
			$('.doop_gallery_carpusel').owlCarousel({
			    loop:true,
				nav:true,
				dots:false,
				margin:30,
				mouseDrag:true,
				autoplay:false,
				autoplayTimeout:false,
				items:1,
				 navText: ["<i class=\"icon icon-left-arrow\"></i>",
       			 "<i class=\"icon icon-right-arrow\"></i>"],
       			
			})
			// END JS SLIDER
			  
        });

    });

})(jQuery);

