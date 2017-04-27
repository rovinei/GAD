(function($) {

	"use strict";	



    $(".owl-carousel").owlCarousel({
      autoPlay: 3000, //Set AutoPlay to 3 seconds
      items: 3,
      navigation: true,
      pagination: false,
      navigationText: ["",""],
      itemsDesktop : [1000,2], //5 items between 1000px and 901px
      itemsDesktopSmall : [900,2], // betweem 900px and 601px
      itemsTablet: [600,1], //2 items between 600 and 0
  });


})(jQuery);