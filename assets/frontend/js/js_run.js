/*===============================================================================================================	
Author     : Muhammad Febriansyah
Date       : November 2016
 =============================================================================================================== */
 $(document).ready(function() {
 	bannerSlider();
 	showPassword();

 	$("#menu-trigger").on('click', function(e){
		e.stopPropagation();
  		$(".float_mobile_menu").addClass("expand");
  		$("body").addClass("overflowHidden");
	});
	$(".close_menu").on('click', function(e){
		e.stopPropagation();
  		$(".float_mobile_menu").removeClass("expand");
  		$("body").removeClass("overflowHidden");
	});
});

