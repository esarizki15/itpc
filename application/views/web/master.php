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
		<!-- Disini untuk Header Bahasa -->
		<?php echo $language['greeting']; ?> <br>
		<?php echo $language['menu1']; ?> <br>
		<?php echo $language['menu2']; ?> <br>

		<!-- Disini untuk Content -->
		<?php echo $content; ?>
</body>
		<!-- Disini untuk JS nya  -->
		<?php echo $main_js; ?>
		<?php if($custume_js != NULL){
			echo $custume_js;
		}
		?>

</html>
