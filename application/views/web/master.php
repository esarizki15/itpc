<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
		<!-- Disini untuk Css nya -->
		<?php
		echo $main_css;
		if($custume_css != NULL){
		echo $custume_css;
		}
		?>
</head>
<body>
		<?php echo $header; ?>
		<div style="position: absolute;left: 0;top: 0;z-index: -1">
		<!-- Disini untuk Header Bahasa -->
	
	</div>

		<!-- Disini untuk Content -->
		<?php echo $content; ?>

		<footer id="footer">
	    	<div class="wrapper">
		    	<div class="left">
		    		<div class="menu_footer">
					
						<a href="<?php echo base_url();?>" class="active"><?php echo $language['home']; ?></a>
						<a href="#"><?php echo $language['aboutus']; ?></a>
						<a href="#"><?php echo $language['trade']; ?></a>
						<a href="#"><?php echo $language['news']; ?></a>
						<a href="#"><?php echo $language['contactus']; ?></a>
						<?php  if(!$this->session->user_logged) { ?><a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en'."/login" : $this->uri->segment(1)."/login") ?>"><?php echo $language['login']; ?></a><?php } else { ?>
						<a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en'."/exporter_account" : $this->uri->segment(1)."/exporter_account") ?>"><?php echo $language['exporter_dashboard']; ?></a> <?php } ?>
					
		    			<!-- <a href="#">Home</a>
		    			<a href="#">ABOUT US</a>
		    			<a href="#">trade with indonesia</a>
		    			<a href="#">NEWS</a>
		    			<a href="#">CONTACT US</a> -->
		    		</div>
		    	</div>

		    	<div class="right">
		    		<p>Copyright 2020 ITPC Barcelona</p>
		    	</div>
	    	</div>
	    </footer>
</body>
		<!-- Disini untuk JS nya  -->
		<?php echo $main_js; ?>
		<?php if($custume_js != NULL){
			echo $custume_js;
		}
		?>

</html>
