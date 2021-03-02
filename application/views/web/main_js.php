

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


