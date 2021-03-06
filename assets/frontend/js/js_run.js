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

	$("#trigger_fullSearch").click(function(){
		$(".search_fullpage").addClass("active");
  		$("body").addClass("overflowHidden");
	});
	$(".close_search").on('click', function(e){
		e.stopPropagation();
  		$(".search_fullpage").removeClass("active");
  		$("body").removeClass("overflowHidden");
	});
});

