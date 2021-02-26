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
		<?php echo $language['greeting']; ?> <br>
		<?php echo $language['menu1']; ?> <br>
		<?php echo $language['menu2']; ?> <br>
	</div>

		<!-- Disini untuk Content -->
		<?php echo $content; ?>

		<footer id="footer">
	    	<div class="wrapper">
		    	<div class="left">
		    		<div class="menu_footer">
		    			<a href="#">Home</a>
		    			<a href="#">ABOUT US</a>
		    			<a href="#">trade with indonesia</a>
		    			<a href="#">NEWS</a>
		    			<a href="#">CONTACT US</a>
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
