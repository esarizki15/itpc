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

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
  $("#coutry_id").select2({
      placeholder: "Select a coutry",
      allowClear: true
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

<script>

$('form#category_form').submit(function(e) {
    alert("test");
    //var form = $(this);


    var importer_id = $("#importer_id").val();
    var category_id = $("#categoryId").val();

          //let exporter_id = $('input[name=exporter_id]').val();
          //let category_id = $('input[name=category_id]').val();
          //let subcategory_id = $('input[name=subcategory_id]').val();
          //let csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
          //let csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
      e.preventDefault();
    $.ajax({
        type: "GET",
        url: "<?php echo site_url('Admin/submit_importer_product_category');?>",
        //data: form.serialize(), // <--- THIS IS THE CHANGE
        data:{importer_id: importer_id, category_id: category_id},
        dataType: "json",
        success: function(data){
              //$('#feed-container').prepend(data);
              $('#feed-container').prepend(data);

        },
        error: function() { alert("Error posting feed."); }
    });

 });
</script>

<script>
$('document').ready(function () {
setInterval(function () {getRealData()}, 1000);//request every x seconds

function getRealData() {
  var importer_id = $("#importer_id").val();
    $.ajax({
        type: "GET",
        url: "<?php echo site_url('Admin/get_list_importer_product_category');?>",
        //data: form.serialize(), // <--- THIS IS THE CHANGE
        data:{importer_id: importer_id},
        async : true,
        dataType: "json",
        cache: false,
        success: function(data){
           var html = '';
           var i;
           for(i=0,no=1; i<data.length; i++,no++){
               html += '<tr><td>'+no+'</td><td>'+data[i].category_title+'</td><td><a class="btn btn-danger waves-effect waves-light" href="<?php echo base_url();?>Admin/delete_importer_product_category/'+data[i].product_id +'/'+data[i].importer_id+'" onclick="javascript:return confirm(\'Anda yakin?\');"><i class="fas fa-trash-alt"></i></td></tr>';
           }
           $('#list_importer_categories').html(html);
        },
        error: function() { alert("Error posting feed."); }
    });

}

});
</script>
