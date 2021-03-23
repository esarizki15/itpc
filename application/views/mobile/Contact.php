<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<body>
<?php foreach ($data['data'] as $key => $item){ ?>
	<img src="<?php echo $item['contact_header']; ?>" style="width:100%;">
	<?php echo $item['contact_content']; ?>
<?php
		}
?>
</body>
</html>
