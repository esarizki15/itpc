
<?php foreach ($data['importer_detail'] as $key => $item){ ?>
	<h4>Name</h4>
	<p><b><?php echo $item['importer_name']; ?>
	<h4>Detai</h4>
	<?php if($item['importer_detail'] == null){
			echo "<p><b>data not available</b></p>";
	}else{ ?>
	<p><b><?php echo $item['importer_detail']; ?></b></p>
	<?php
		}
	?>

	<h4>Address</h4>
	<?php if($item['importer_address'] == null){
			echo "<p><b>data not available</b></p>";
	}else{ ?>
	<p><b><?php echo $item['importer_address']; ?></b></p>
	<?php
		}
	?>

	<h4>City</h4>
	<?php if($item['importer_city'] == null){
			echo "<p><b>data not available</b></p>";
	}else{ ?>
	<p><b><?php echo $item['importer_city']; ?></b></p>
	<?php
		}
	?>

	<h4>State / Provience / Region</h4>
	<?php if($item['importer_provience'] == null){
			echo "<p><b>data not available</b></p>";
	}else{ ?>
	<p><b><?php echo $item['importer_provience']; ?></b></p>
	<?php
		}
	?>

	<h4>Postal / Zip Code</h4>
	<?php if($item['importer_postal'] == null){
			echo "<p><b>data not available</b></p>";
	}else{ ?>
	<p><b><?php echo $item['importer_postal']; ?></b></p>
	<?php
		}
	?>

	<h4>Country</h4>
	<?php if($item['country_name'] == null){
			echo "<p><b>data not available</b></p>";
	}else{ ?>
	<p><b><?php echo $item['country_name']; ?></b></p>
	<?php
		}
	?>

	<h4>Country</h4>
	<?php if($item['country_name'] == null){
			echo "<p><b>data not available</b></p>";
	}else{ ?>
	<p><b><?php echo $item['country_name']; ?></b></p>
	<?php
		}
	?>

	<hr/>
	<h4><i class="dripicons-user-id"></i> Contact Information</h4>
	<h4>Name</h4>
	<?php if($item['contact_name'] == null){
			echo "<p><b>data not available</b></p>";
	}else{ ?>
	<p><b><?php echo $item['contact_name']; ?></b></p>
	<?php
		}
	?>
	<h4>Office Phone</h4>
	<?php if($item['contact_office_phone'] == null){
			echo "<p><b>data not available</b></p>";
	}else{ ?>
	<p><b><?php echo $item['contact_office_phone']; ?></b></p>
	<?php
		}
	?>
	<h4>Personal Phone</h4>
	<?php if($item['contact_phone'] == null){
			echo "<p><b>data not available</b></p>";
	}else{ ?>
	<p><b><?php echo $item['contact_phone']; ?></b></p>
	<?php
		}
	?>

	<h4>Fax</h4>
	<?php if($item['contact_fax'] == null){
			echo "<p><b>data not available</b></p>";
	}else{ ?>
	<p><b><?php echo $item['contact_fax']; ?></b></p>
	<?php
		}
	?>

	<h4>Email</h4>
	<?php if($item['contact_email'] == null){
			echo "<p><b>data not available</b></p>";
	}else{ ?>
	<p><b><?php echo $item['contact_email']; ?></b></p>
	<?php
		}
	?>

	<h4>Website</h4>
	<?php if($item['contact_website'] == null){
			echo "<p><b>data not available</b></p>";
	}else{ ?>
	<p><b><?php echo $item['contact_website']; ?></b></p>
	<?php
		}
	?>

	<hr/>
	<h4><i class="dripicons-user-group"></i> Social Media</h4>
	<h4>Twitter</h4>
	<?php if($item['social_twitter'] == null){
			echo "<p><b>data not available</b></p>";
	}else{ ?>
	<p><b><?php echo $item['contact_website']; ?></b></p>
	<?php
		}
	?>

	<h4>Facebook</h4>
	<?php if($item['social_facebook'] == null){
			echo "<p><b>data not available</b></p>";
	}else{ ?>
	<p><b><?php echo $item['social_facebook']; ?></b></p>
	<?php
		}
	?>

	<h4>Google</h4>
	<?php if($item['social_google'] == null){
			echo "<p><b>data not available</b></p>";
	}else{ ?>
	<p><b><?php echo $item['social_google']; ?></b></p>
	<?php
		}
	?>

	<h4>Created</h4>
	<?php if($item['post_date'] == null){
			echo "<p><b>data not available</b></p>";
	}else{ ?>
	<p><b><?php echo $item['post_date']; ?></b></p>
	<?php
		}
	?>
	<hr/>
	<h4>Update</h4>
	<?php if($item['update_date'] == null){
			echo "<p><b>data not available</b></p>";
	}else{ ?>
	<p><b><?php echo $item['update_date']; ?></b></p>
	<?php
		}
	?>

	<h4>Created by</h4>
	<?php if($item['created_by'] == null){
			echo "<p><b>data not available</b></p>";
	}else{ ?>
	<p><b><?php echo $item['created_by']; ?></b></p>
	<?php
		}
	?>
<?php } ?>
