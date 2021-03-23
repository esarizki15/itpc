<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<body>
<?php foreach ($data['data'] as $key => $item){ ?>
	<img src="<?php echo $item['about_header']; ?>" style="width:100%;">
	<?php echo $item['about_content']; ?>
<?php
		}
?>
</body>
</html>
