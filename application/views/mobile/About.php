
	<?php foreach ($data['data'] as $key => $item){ ?>
		<img src="<?php echo $item['about_header']; ?>" style="width:100%;">
		<h4><?php echo $item['about_title']; ?></h4>
		<p><?php echo $item['about_content']; ?></p>
		<img src="<?php echo $item['function_image']; ?>" style="width:100%;">
		<p><?php echo $item['function_content']; ?></p>
		<img src="<?php echo $item['mission_image']; ?>" style="width:100%;">
		<p><?php echo $item['mission_content']; ?></p>
	<?php
			}
	?>
