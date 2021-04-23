
<?php foreach ($data['data'] as $key => $item){ ?>
	<img src="<?php echo $item['contact_header']; ?>" style="width:100%;">
	<p><i class="dripicons-location"></i> <?php echo $item['contact_location']; ?></p>
	<p><i class="dripicons-phone"></i> <?php echo $item['contact_phone']; ?></p>
	<p><i class="fas fa-fax"></i> <?php echo $item['contact_fax']; ?></p>
	<p><i class="dripicons-mail"></i> <?php echo $item['contact_email']; ?></p>
	<p><i class="dripicons-web"></i> <?php echo $item['contact_website']; ?></p>
	<?php echo $item['contact_map']; ?>
<?php
		}
?>
