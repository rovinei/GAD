jQuery(document).ready(function($) {

  'use strict';

  var flexSliderOptions = {
    animation: "fade",
    controlNav: true,
    prevText: "&larr;",
    nextText: "&rarr;",
    start: function (slider) {
       // lazy load
       $(slider).find("img.lazy").slice(0,5).each(function () {
       var src = $(this).attr("data-src");
          $(this).attr("src", src).removeAttr("data-src").removeClass("lazy");
       });
     },
    before: function (slider) {
        // lazy load
       var slide = $(slider).find('.slides').children().eq(slider.animatingTo+1).find('img');
       var src = slide.attr("data-src");
       slide.attr("src", src).removeAttr("data-src").removeClass("lazy");
    }

   };

  $('img.lazy').lazyload({
    event: 'scroll mouseover click'
  });

  $(".our-listing").owlCarousel({
    items: 4,
    navigation: true,
    lazyLoad: true,
    navigationText: ["&larr;","&rarr;"],
  });

  $('.home.flexslider').flexslider(flexSliderOptions);

    $('.toggle-menu').click(function(){
          $('.menu-responsive').slideToggle();
          return false;
      });

  var carDetailFlexslider = $('.car-detail.flexslider').flexslider(flexSliderOptions);

  $('.detail-image-list>a').bind('click', function() {
    carDetailFlexslider.flexslider($(this).data('index'));
  });

  $('#filter').bind('change', function() {
    var val = $(this).val();
    var url = "index.php?pageview=2&filter=" + val;
    window.location.replace(url);
  });

  // Contact Form
  jQuery.validator.addMethod("telephone", function(phone_number, element) {
    var numLength = phone_number.replace(/\D/g, '').length
    return this.optional(element) || numLength >= 9 &&
    phone_number.match(/^\+?[0-9\-\(\)\s]+$/);
  }, "Please enter valid telephone number.");

  $('#contactform').validate({
      rules: {
          name: { required: "" },
          subject: { required: "" },
          email: {
              required: true,
              email: true
          },
          tel: {
              required: true,
              telephone: true
          },
          message: { required: true }
      }
  });

  $('#contactform input[type=text], #contactform textarea').bind('keyup focusout', validateContact);

  function validateContact() {
    var submitBtn = $('#submit');
    console.log('result', $('#contactform').valid());
    if ($('#contactform').valid()) {
        submitBtn.prop('disabled', false);
    } else {
        submitBtn.prop('disabled', 'disabled');
    }
  };
});









