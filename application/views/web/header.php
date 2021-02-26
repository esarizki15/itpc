<header id="mainheader">
	<div class="wrapper">
		<div class="inner_header">
			<div class="left_header">
				<div class="logo">
					<a href="#"><img src="<?php echo $this->config->item('frontend'); ?>images/logo.png"></a>
				</div>
				<div class="main_menu">
					<ul>
						<li><a href="#" class="active">Home</a></li>
						<li><a href="#">ABOUT US</a></li>
						<li><a href="#">trade with indonesia</a></li>
						<li><a href="#">NEWS & exhibitionS</a></li>
						<li><a href="#">CONTACT US</a></li>
						<li><a href="#">LOGIN</a></li>
					</ul>
				</div>
			</div>
			<div class="right_header">
				<div class="select_lang">
					<div class="btn_lang">
						<img class="lang_img" src="<?php echo $this->config->item('frontend'); ?>images/lang_ina.png">
						<span class="lang_caption">Bahasa</span>
					</div>
					<ul class="dropdown-lang" role="menu">
					   <li>
					   		<a href="en" class="trigger_lang" data-img="<?php echo $this->config->item('frontend'); ?>images/lang_en.png" data-lang="English">
								<img class="lang_img_menu" src="<?php echo $this->config->item('frontend'); ?>images/lang_en.png">
								<span class="lang_caption_menu">English</span>
					   		</a>
					   </li>
					   <li>
					   		<a href="sp" class="trigger_lang" data-img="<?php echo $this->config->item('frontend'); ?>images/lang_sp.png" data-lang="Spanish">
								<img class="lang_img_menu" src="<?php echo $this->config->item('frontend'); ?>images/lang_sp.png">
								<span class="lang_caption_menu">Spanish</span>
					   		</a>
					   </li>
					   <li>
					   		<a href="id" class="trigger_lang" data-img="<?php echo $this->config->item('frontend'); ?>images/lang_ina.png" data-lang="Bahasa">
								<img class="lang_img_menu" src="<?php echo $this->config->item('frontend'); ?>images/lang_ina.png">
								<span class="lang_caption_menu">Bahasa</span>
					   		</a>
					   </li>
					 </ul>
				</div>
				<div class="icon_search">
					<img src="<?php echo $this->config->item('frontend'); ?>images/icon-search.png">
				</div>
			</div><!--end.right_header-->
		</div>
	</div><!--end.wrapper-->
</header>
<!-- end of header -->
<script type="text/javascript">
	$(".btn_lang").click(function(){
		$(".dropdown-lang").toggle();
	});
	$(".trigger_lang").click(function(){
		var dataImg = $(this).data("img");
		var dataLang = $(this).data("lang");
		var closeDiv = $(this).closest(".select_lang");

		console.log(closeDiv);
		$(".dropdown-lang").hide();
		$(closeDiv).find(".lang_img").attr("src",dataImg);
		$(closeDiv).find(".lang_caption").text(dataLang);
	});
</script>