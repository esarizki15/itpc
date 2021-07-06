<!-- Parsley js -->
<script src="<?php echo $this->config->item('admin_source'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo $this->config->item('admin_source'); ?>plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="<?php echo $this->config->item('admin_source'); ?>plugins/datatables/dataTables.buttons.min.js"></script>
<script src="<?php echo $this->config->item('admin_source'); ?>plugins/datatables/buttons.bootstrap4.min.js"></script>
<script src="<?php echo $this->config->item('admin_source'); ?>plugins/datatables/jszip.min.js"></script>
<script src="<?php echo $this->config->item('admin_source'); ?>plugins/datatables/pdfmake.min.js"></script>
<script src="<?php echo $this->config->item('admin_source'); ?>plugins/datatables/vfs_fonts.js"></script>
<script src="<?php echo $this->config->item('admin_source'); ?>plugins/datatables/buttons.html5.min.js"></script>
<script src="<?php echo $this->config->item('admin_source'); ?>plugins/datatables/buttons.print.min.js"></script>
<script src="<?php echo $this->config->item('admin_source'); ?>plugins/datatables/buttons.colVis.min.js"></script>
<!-- Responsive examples -->
<script src="<?php echo $this->config->item('admin_source'); ?>plugins/datatables/dataTables.responsive.min.js"></script>
<script src="<?php echo $this->config->item('admin_source'); ?>plugins/datatables/responsive.bootstrap4.min.js"></script>
<script src="<?php echo $this->config->item('admin_source'); ?>plugins/parsleyjs/parsley.min.js"></script>


<script src="<?php echo $this->config->item('admin_source'); ?>plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>


<script>
     $(document).ready(function() {
         $('form').parsley();
     });
 </script>

 <script>
 $(function() {
 	enable_cb();
 	$("#customCheck4").click(enable_cb);
  });

 function enable_cb(){
 		if (this.checked) {
 			$("#password").removeAttr("disabled");
 			$("#password").attr("required", true);
 		} else {
 			$("#password").attr("disabled", true);
 			$("#password").removeAttr("required");
      $('#password').val("");
 		}
 	}
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
   $("#category_id").select2({
       placeholder: "Select a categories",
       allowClear: true
   });
   $("#subcategory_id").select2({
       placeholder: "Select a subcategories",
       allowClear: true
   });
 </script>

<script>
   $(document).ready(function(){
     $('#category_id').on('change', function (){
        var category_id = $(this).val();
        $.ajax({
          url : "<?php echo site_url('Admin/get_importer_list');?>",
          method : "GET",
          data : {category_id: category_id},
          async : true,
          dataType : 'json',
          success: function(response){

             var html = '';
              var i;

              for(i=0; i<response.length; i++){
                  html += '<option value='+response[i].importer_id+'>'+response[i].importer_name+'</option>';
              }
              option_all = '<option value="all">All</option>';
              html_all = option_all+html;
              $('#subcategory_id').html(html_all);


          }
        });
        return false;
      });
   });
</script>

<script>

$('form#category_form').submit(function(e) {

    //var form = $(this);


    var exporter_id = $("#exporter_id").val();
    var inquiry_id = $("#inquiry_id").val();
    var category_id = $("#category_id").val();
    var subcategory_id = $("#subcategory_id").val();

          //let exporter_id = $('input[name=exporter_id]').val();
          //let category_id = $('input[name=category_id]').val();
          //let subcategory_id = $('input[name=subcategory_id]').val();
          //let csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
          //let csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
      e.preventDefault();
    $.ajax({
        type: "GET",
        url: "<?php echo site_url('Admin/submit_inquery_importer_list');?>",
        //data: form.serialize(), // <--- THIS IS THE CHANGE
        data:{exporter_id: exporter_id, inquiry_id: inquiry_id,category_id: category_id , subcategory_id: subcategory_id},
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

$('form#inbox_form').submit(function(e) {

    //var form = $(this);


    var inbox_content = $("#inbox_content").val();
    var exporter_id = $("#exporter_id_inbox").val();
    var inquiry_id = $("#inquiry_id_inbox").val();
      e.preventDefault();
    $.ajax({
        type: "GET",
        url: "<?php echo site_url('Admin/Submit_inbox_data');?>",
        //data: form.serialize(), // <--- THIS IS THE CHANGE
        data:{inbox_content: inbox_content , exporter_id: exporter_id , inquiry_id: inquiry_id},
        dataType: "json",
        success: function(data){
              //$('#feed-container').prepend(data);
              $('#feed-inbox').prepend(data);
        },
        error: function() { alert("Error posting feed."); }
    });

 });
</script>


<script>
$('document').ready(function () {
setInterval(function () {getRealData()}, 1000);//request every x seconds

function getRealData() {
  var inquiry_id = $("#inquiry_id").val();
    $.ajax({
        type: "GET",
        url: "<?php echo site_url('Admin/get_list_importer_inquiry');?>",
        //data: form.serialize(), // <--- THIS IS THE CHANGE
        data:{inquiry_id: inquiry_id},
        async : true,
        dataType: "json",
        cache: false,
        success: function(data){
           var html = '';
           var i;
           for(i=0,no=1; i<data.length; i++,no++){
               html += '<tr><td>'+no+'</td><td>'+data[i].importer_name+'</td><td>'+data[i].category_title+'</td><td><a class="btn btn-danger waves-effect waves-light" href="<?php echo base_url();?>Admin/delete_importer_inquiry/'+data[i].inquiry_id+'/'+data[i].importer_inquiry_id+'" ><i class="fas fa-trash-alt"></i></td></tr>';
           }
           $('#list_importer_categories').html(html);
        },
        error: function() { alert("Error posting feed."); }
    });

}

});
</script>


<script type="text/javascript">
	var save_method; //for save method string
	$(document).ready(function() {
    setInterval(function () {getRealData()}, 1000);//request every x seconds

		//datatables
		var table = $('#empTable').DataTable({
			"processing": true,
			"serverSide": true,
      "crossDomain": true,
      "contentType":"application/json; charset=utf-8",
      "order": [], //Line ini sudah tidak diperlukan
			// Load data dari ajax
			"ajax": {
				"url": "<?php echo base_url()?>index.php/Admin/Get_inbox_list",
				"type": "GET", //(untuk mendapatkan data)
         "data": $('#inquiry_id').val()
			},
			// Tambahkan bagian ini:
			"columns": [                              // Membuat nomor pada datatable (bukan ID user)
        { "data": null,"sortable": false,
           render: function (data, type, row, meta) {
                     return meta.row + meta.settings._iDisplayStart + 1;
                    }
        },
        {data: 'post_date', name: 'post_date'},
				{data: 'inbox_content', name: 'inbox_content' },
				{data: 'inbox_read', name: 'inbox_read'},
				{
					data:'inbox_id',
					mRender: function (data) {
						 return '<a class="btn btn-info waves-effect waves-light" href="<?php echo base_url()?>Admin/exporter_detail/'+ data +'"><i class="fas fa-pencil-alt"></i></a> | \n\
						 <a class="btn btn-danger waves-effect waves-light" href="<?php echo base_url()?>Admin/exporter_delete/'+ data +'" onclick="javascript:return confirm(\'Anda yakin?\');"><i class="fas fa-trash-alt"></i></a>';
				 }
			 }
			],
			//Set column definition initialisation properties.
			"columnDefs":[
                                // membuat kolom 0 (No.) dan kolom 1 (ID) tidak dapat di search dan sorting
				{"searchable": false, "orderable": false, "targets": [3,4]},
			],
		});
    setInterval( function () {
    table.ajax.reload(null, false);
  }, 8000 );
	});

</script>




<script>
  $(document).ready(function () {
      $("#range_01").ionRangeSlider({
          type: "single",
          grid: true,
          skin: "modern",
          min: 0,
          max: 100,
          from: <?php echo $data['progress'];?>,
          onChange: function (val) {
              // see inside console developer tools to see returned properties
              console.log(val);
              // here you put ajax request
              //var progress = val.from;
              var progress = val.from;
              var inquiry_id = $("#inquiry_id_inbox").val();
              $.ajax({
                  type: 'GET',
                  url: "<?php echo site_url('Admin/Update_progress');?>",
                  data: {
                      progress: progress,
                      inquiry_id: inquiry_id  // send this paramter
                  },
                  async : true,
                  dataType: 'json',
                  success: function (data) {

                  }
              });
          }
      });
  });
</script>
