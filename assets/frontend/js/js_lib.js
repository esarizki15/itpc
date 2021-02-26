/*===============================================================================================================	
Author     : Muhammad Febriansyah
Date       : Mei 2016
 =============================================================================================================== */

 $.fn.generate_height = function () {
  var maxHeight = -1;
  $(this).each(function () {
    $(this).children().each(function () {
      maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
    });

    $(this).children().each(function () {
      $(this).height(maxHeight);
    });
  })
}

function bannerSlider(){
	$('.owl-carousel_banner').owlCarousel({
        autoplay:true,
        autoplayTimeout:10000,
        margin:0,
        loop:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1,
            },
            1000:{
                items:1
            }
        }
    });	
}

function showPassword(){
    $(".trigger_showPassword").click(function(){
        console.log('aaaa');
        $(this).toggleClass("actived");
        var parentThis = $(this).closest(".form_group");
        var thisPass = $(parentThis).find(".passwordInput");
        if (thisPass.attr("type") === "password") {
            thisPass.attr("type", "text");
          } else {
            thisPass.attr("type", "password");
          }
    });

}