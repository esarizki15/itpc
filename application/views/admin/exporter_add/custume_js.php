<!-- Parsley js -->
<script src="<?php echo $this->config->item('admin_source'); ?>plugins/parsleyjs/parsley.min.js"></script>

<script>
     $(document).ready(function() {
         $('form').parsley();
     });
 </script>

 <script>
 // Add the following code if you want the name of the file appear on select
 $(".custom-file-input").on("change", function() {
   var fileName = $(this).val().split("\\").pop();
   $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
 });
 </script>


<script type='text/javascript'>
$(document).ready(function(){
	var counter = 2;
	$('#del_file').hide();
	$('img#add_file').click(function(){
		$('#file_tools').before('<div class="file_upload" id="f'+counter+'"><input name="files[]" type="file">'+counter+'</div>');
		$('#del_file').fadeIn(0);
	counter++;
	});
	$('img#del_file').click(function(){
		if(counter==3){
			$('#del_file').hide();
		}
		counter--;
		$('#f'+counter).remove();
	});
});
</script>


<script>
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#imgInp").change(function() {
  readURL(this);
});
</script>
