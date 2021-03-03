<header id="mainheader">
	<div class="wrapper">
		<div class="inner_header">
			<div class="mobile_nav">
		      <div id="menu-trigger" class=""><img src="<?php echo $this->config->item('frontend'); ?>images/hamburger_menu2.png"></div>
		    </div>

			<div class="left_header">
				<div class="logo">
					<a href="#"><img src="<?php echo $this->config->item('frontend'); ?>images/logo.png"></a>
				</div>
				<div class="main_menu">
					<ul>
						<li><a href="<?php echo base_url();?>" class="active"><?php echo $language['home']; ?></a></li>
						<li><a href="#"><?php echo $language['aboutus']; ?></a></li>
						<li><a href="#"><?php echo $language['trade']; ?></a></li>
						<li><a href="#"><?php echo $language['news']; ?></a></li>
						<li><a href="#"><?php echo $language['contactus']; ?></a></li>
						<?php  if(!$this->session->user_logged) { ?><li><a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en'."/itpc_login" : $this->uri->segment(1)."/itpc_login") ?>"><?php echo $language['login']; ?></a></li><?php } else { ?>
						<li><a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en'."/exporter_account" : $this->uri->segment(1)."/exporter_account") ?>"><?php echo $language['exporter_dashboard']; ?></a></li> 
						<li><a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en'."/itpc_logout" : $this->uri->segment(1)."/itpc_logout") ?>"><?php echo $language['logout']; ?></a></li>
						<?php } ?>
					</ul>
				</div>
			</div>
			<div class="right_header">
				<div class="select_lang">
					<div class="btn_lang">
						<img class="lang_img" src="<?php echo $this->config->item('frontend'); ?>images/lang_<?php  if($lang == 'en' || $lang == '') { echo 'en'; }elseif( $lang == 'id') { echo 'ina'; }else{ echo 'sp';} ?>.png">
						<span class="lang_caption"><?php  if($lang == 'en' || $lang == '') { echo "English"; }elseif( $lang == 'id') { echo "Bahasa"; }else{ echo "Spanish";}  ?></span>

						
					</div>
					<ul class="dropdown-lang" role="menu">
					   <li>
					   		<a href="<?php echo getLang('en');?>" class="trigger_lang" data-img="<?php echo $this->config->item('frontend'); ?>images/lang_en.png" data-lang="English">
								<img class="lang_img_menu" src="<?php echo $this->config->item('frontend'); ?>images/lang_en.png">
								<span class="lang_caption_menu">English</span>
					   		</a>
					   </li>
					   <li>
					   		<a href="<?php echo getLang('sp');?>" class="trigger_lang active" data-img="<?php echo $this->config->item('frontend'); ?>images/lang_sp.png" data-lang="Spanish">
								<img class="lang_img_menu" src="<?php echo $this->config->item('frontend'); ?>images/lang_sp.png">
								<span class="lang_caption_menu">Spanish</span>
					   		</a>
					   </li>
					   <li>
					   		<a href="<?php echo getLang('id');?>" class="trigger_lang" data-img="<?php echo $this->config->item('frontend'); ?>images/lang_ina.png" data-lang="Bahasa">
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

	<div class="float_mobile_menu">
	  <div class="close_menu"><img src="<?php echo $this->config->item('frontend'); ?>images/close.png"></div>
	  <div class="main_mobile_menu">
	    <ul>
			<li><a href="<?php echo base_url();?>" class="active"><?php echo $language['home']; ?></a></li>
			<li><a href="#"><?php echo $language['aboutus']; ?></a></li>
			<li><a href="#"><?php echo $language['trade']; ?></a></li>
			<li><a href="#"><?php echo $language['news']; ?></a></li>
			<li><a href="#"><?php echo $language['contactus']; ?></a></li>
			<li><a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en' : $this->uri->segment(1)."/itpc_login") ?>"><?php echo $language['login']; ?></a></li>
	    </ul>
	  </div>
	  <div class="select_lang select_lang_mobile">
		<div class="btn_lang">
			<img class="lang_img" src="<?php echo $this->config->item('frontend'); ?>images/lang_<?php  if($lang == 'en' || $lang == '') { echo 'en'; }elseif( $lang == 'id') { echo 'ina'; }else{ echo 'sp';} ?>.png">
			<span class="lang_caption"><?php  if($lang == 'en' || $lang == '') { echo "English"; }elseif( $lang == 'id') { echo "Bahasa"; }else{ echo "Spanish";}  ?></span>

			
		</div>
		<ul class="dropdown-lang" role="menu">
		   <li>
		   		<a href="en" class="trigger_lang" data-img="<?php echo $this->config->item('frontend'); ?>images/lang_en.png" data-lang="English">
					<img class="lang_img_menu" src="<?php echo $this->config->item('frontend'); ?>images/lang_en.png">
					<span class="lang_caption_menu">English</span>
		   		</a>
		   </li>
		   <li>
		   		<a href="sp" class="trigger_lang active" data-img="<?php echo $this->config->item('frontend'); ?>images/lang_sp.png" data-lang="Spanish">
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
	</div>
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