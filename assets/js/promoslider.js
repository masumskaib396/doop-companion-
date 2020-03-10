(function ($) {

"use strict";


 // Make sure you run this code under Elementor..
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/doop_promoslider.default',function($scope, $){
           
 			var pslider = $scope.find(".doop__proslider");

			 if( pslider.length === 0 )
			    return;

			 var settings = pslider.data('settings');

			/*--------------------------------------------------------------
			DOOP PROMO SLIDER JS
			--------------------------------------------------------------*/
			$('.doop__proslider').owlCarousel({
			    loop:true,
				nav:true,
				dots:false,
				mouseDrag:false,
				autoplay:false,
				autoplayTimeout:5000,
				items:1,
				 navText: ["<i class=\"icon icon-left-arrow\"></i>",
        "<i class=\"icon icon-right-arrow\"></i>"],
				responsive:{
			        0:{
			            items:1
			        },
			        600:{
			            items:1
			        },
			        1000:{
			            items:1
			        }
			    }
			})
			// END JS SLIDER
			  
        });

    });

})(jQuery);

