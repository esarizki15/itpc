<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<body>
<?php foreach ($data['importer_detail'] as $key => $item){ ?>
	<h2 style="font-size:90px;">Name</h2>
	<p style="font-size:40px;"><?php echo $item['importer_name']; ?>
		
	<br/>
	<h2>Detai</h2>
	<?php if($item['importer_detail'] == null){
			echo "<p>data not available</p>";
	}else{ ?>
	<p><?php echo $item['importer_detail']; ?></p>
	<?php
		}
	?>

	<h2>Address</h2>
	<?php if($item['importer_address'] == null){
			echo "<p>data not available</p>";
	}else{ ?>
	<p><?php echo $item['importer_address']; ?></p>
	<?php
		}
	?>

	<h2>City</h2>
	<?php if($item['importer_city'] == null){
			echo "<p>data not available</p>";
	}else{ ?>
	<p><?php echo $item['importer_city']; ?></p>
	<?php
		}
	?>

	<h2>State / Provience / Region</h2>
	<?php if($item['importer_provience'] == null){
			echo "<p>data not available</p>";
	}else{ ?>
	<p><?php echo $item['importer_provience']; ?></p>
	<?php
		}
	?>

	<h2>Postal / Zip Code</h2>
	<?php if($item['importer_postal'] == null){
			echo "<p>data not available</p>";
	}else{ ?>
	<p><?php echo $item['importer_postal']; ?></p>
	<?php
		}
	?>

	<h2>Country</h2>
	<?php if($item['country_name'] == null){
			echo "<p>data not available</p>";
	}else{ ?>
	<p><?php echo $item['country_name']; ?></p>
	<?php
		}
	?>

	<h2>Country</h2>
	<?php if($item['country_name'] == null){
			echo "<p>data not available</p>";
	}else{ ?>
	<p><?php echo $item['country_name']; ?></p>
	<?php
		}
	?>

	<h4>Contact Information</h4>
	<h2>Name</h2>
	<?php if($item['contact_name'] == null){
			echo "<p>data not available</p>";
	}else{ ?>
	<p><?php echo $item['contact_name']; ?></p>
	<?php
		}
	?>
	<h2>Office Phone</h2>
	<?php if($item['contact_office_phone'] == null){
			echo "<p>data not available</p>";
	}else{ ?>
	<p><?php echo $item['contact_office_phone']; ?></p>
	<?php
		}
	?>
	<h2>Personal Phone</h2>
	<?php if($item['contact_phone'] == null){
			echo "<p>data not available</p>";
	}else{ ?>
	<p><?php echo $item['contact_phone']; ?></p>
	<?php
		}
	?>

	<h2>Fax</h2>
	<?php if($item['contact_fax'] == null){
			echo "<p>data not available</p>";
	}else{ ?>
	<p><?php echo $item['contact_fax']; ?></p>
	<?php
		}
	?>

	<h2>Email</h2>
	<?php if($item['contact_email'] == null){
			echo "<p>data not available</p>";
	}else{ ?>
	<p><?php echo $item['contact_email']; ?></p>
	<?php
		}
	?>

	<h2>Website</h2>
	<?php if($item['contact_website'] == null){
			echo "<p>data not available</p>";
	}else{ ?>
	<p><?php echo $item['contact_website']; ?></p>
	<?php
		}
	?>

	<h4>Social Media</h4>
	<h2>Twitter</h2>
	<?php if($item['social_twitter'] == null){
			echo "<p>data not available</p>";
	}else{ ?>
	<p><?php echo $item['contact_website']; ?></p>
	<?php
		}
	?>

	<h2>Facebook</h2>
	<?php if($item['social_facebook'] == null){
			echo "<p>data not available</p>";
	}else{ ?>
	<p><?php echo $item['social_facebook']; ?></p>
	<?php
		}
	?>

	<h2>Google</h2>
	<?php if($item['social_google'] == null){
			echo "<p>data not available</p>";
	}else{ ?>
	<p><?php echo $item['social_google']; ?></p>
	<?php
		}
	?>

	<h2>Created</h2>
	<?php if($item['post_date'] == null){
			echo "<p>data not available</p>";
	}else{ ?>
	<p><?php echo $item['post_date']; ?></p>
	<?php
		}
	?>

	<h2>Update</h2>
	<?php if($item['update_date'] == null){
			echo "<p>data not available</p>";
	}else{ ?>
	<p><?php echo $item['update_date']; ?></p>
	<?php
		}
	?>

	<h2>Created by</h2>
	<?php if($item['created_by'] == null){
			echo "<p>data not available</p>";
	}else{ ?>
	<p><?php echo $item['created_by']; ?></p>
	<?php
		}
	?>



<?php } ?>
</body>
</html>
