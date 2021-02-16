

<!-- jQuery  -->
<script src="<?php echo $this->config->item('admin_source'); ?>js/jquery.min.js"></script>


<script src="<?php echo $this->config->item('admin_source'); ?>js/bootstrap.bundle.min.js"></script>
<script src="<?php echo $this->config->item('admin_source'); ?>js/modernizr.min.js"></script>
<script src="<?php echo $this->config->item('admin_source'); ?>js/waves.js"></script>
<script src="<?php echo $this->config->item('admin_source'); ?>js/jquery.slimscroll.js"></script>
<link href="<?php echo $this->config->item('admin_source'); ?>plugins/bootstrap-select/bootstrap-select.min.js" rel="stylesheet">
<!-- App js -->
<script src="<?php echo $this->config->item('admin_source'); ?>js/app.js"></script>

<script>
$('img').on("error", function() {
  $(this).attr('src', '<?php echo $this->config->item('admin_source'); ?>images/defalut.png');
});
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script type="text/javascript">

	<?php if($this->session->flashdata('success')){ ?>
		toastr.success("<?php echo $this->session->flashdata('success'); ?>");
	<?php }else if($this->session->flashdata('error')){  ?>
  <?php
	  $msg = $this->session->flashdata('error');
  ?>
		toastr.error("<?php echo is_array($msg) ? $msg[0] : $msg; ?>");
	<?php }else if($this->session->flashdata('warning')){
		$msg = $this->session->flashdata('warning');
	?>
		toastr.warning("<?php echo is_array($msg) ? $msg[0] : $msg; ?>");
	<?php }else if($this->session->flashdata('info')){  ?>
		toastr.info("<?php echo $this->session->flashdata('info'); ?>");
	<?php } ?>

</script>
