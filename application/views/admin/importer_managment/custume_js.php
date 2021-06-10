
<!-- Required datatable js -->
<!--script src="<?php echo $this->config->item('admin_source'); ?>plugins/datatables/jquery.dataTables.min.js"></script-->
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

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

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
  $("#categoryId").select2({
      placeholder: "Select a category",
      allowClear: true
  });
</script>

<!-- Datatable init js -->
<script src="<?php echo $this->config->item('admin_source'); ?>pages/datatables.init.js"></script>



<!--script type="text/javascript">
	$(document).ready(function(){
		exporter_data();	//pemanggilan fungsi tampil barang.

		$('#mydata').dataTable();

		//fungsi tampil barang
		function exporter_data(){
		    $.ajax({
		        type  : 'GET',
		        url   : '<?php echo base_url()?>index.php/Admin/Expoter_list_data',
		        async : true,
		        dataType : 'json',
		        success : function(data){

              var html = '';
               var i;
               for(i=0,n=1; i<data.length; i++,n++){
                   html += '<tr>'+
                         '<td>'+n+'</td>'+
                           '<td>'+data[i].name+'</td>'+
                           '<td>'+data[i].email+'</td>'+
                           '<td>'+data[i].date+'</td>'+
                           '<td>'+data[i].status+'</td>'+
                           '</tr>';

               }
							 		$('#show_data').html(html);


		        }

		    });
		}

	});

</script-->

<script>
// Add the following code if you want the name of the file appear on select
$("#categoryId").on("change", function() {
	$("#all_category").hide();
	$("#Filter_category").show();
	var categoryId = $('#categoryId').find('option:selected').val();
	$('#empTable2').dataTable().fnDestroy();
	var table = $('#empTable2').DataTable({
		"retrieve": true,
		"processing": true,
		"serverSide": true,

		// Load data dari ajax
		"ajax": {
			"url": "<?php echo base_url()?>index.php/Admin/importer_category_filter_data",
			"type": "GET", //(untuk mendapatkan data)
			"data":{categoryId : categoryId}
		},
		// Tambahkan bagian ini:
		"columns": [                              // Membuat nomor pada datatable (bukan ID user)
			{
				data: 'id',
				name:'id'
			},
			{data: 'name', name: 'name' },
			{data: 'city', name: 'city' },
			{data: 'post_date', name: 'post_date'},
			{data: 'status', name: 'status'},
			{
				data:'id',
				mRender: function (data) {
					 return '<a class="btn btn-info waves-effect waves-light" href="<?php echo base_url()?>Admin/importer_detail/'+ data +'"><i class="fas fa-pencil-alt"></i></a> | \n\
					 <a class="btn btn-danger waves-effect waves-light" href="<?php echo base_url()?>Admin/importer_delete/'+ data +'" onclick="javascript:return confirm(\'Anda yakin?\');"><i class="fas fa-trash-alt"></i></a>';
			 }
		 }
		],
		//Set column definition initialisation properties.
		"columnDefs":[
															// membuat kolom 0 (No.) dan kolom 1 (ID) tidak dapat di search dan sorting
			{"searchable": false, "orderable": false, "targets": [4,5]},
		],

		})

});
</script>


<script type="text/javascript">
	var save_method; //for save method string
	$(document).ready(function() {
		$("#Filter_category").hide();
		//datatables
		var table = $('#empTable').DataTable({
			"processing": true,
			"serverSide": true,

			// Load data dari ajax
			"ajax": {
				"url": "<?php echo base_url()?>index.php/Admin/Importer_list_data",
				"type": "GET" //(untuk mendapatkan data)
			},
			// Tambahkan bagian ini:
			"columns": [                              // Membuat nomor pada datatable (bukan ID user)
				{
					data: 'id',
					name:'id'
				},
				{data: 'name', name: 'name' },
				{data: 'city', name: 'city' },
				{data: 'post_date', name: 'post_date'},
				{data: 'status', name: 'status'},
				{
					data:'id',
					mRender: function (data) {
						 return '<a class="btn btn-info waves-effect waves-light" href="<?php echo base_url()?>Admin/importer_detail/'+ data +'"><i class="fas fa-pencil-alt"></i></a> | \n\
						 <a class="btn btn-danger waves-effect waves-light" href="<?php echo base_url()?>Admin/importer_delete/'+ data +'" onclick="javascript:return confirm(\'Anda yakin?\');"><i class="fas fa-trash-alt"></i></a>';
				 }
			 }
			],
			//Set column definition initialisation properties.
			"columnDefs":[
                                // membuat kolom 0 (No.) dan kolom 1 (ID) tidak dapat di search dan sorting
				{"searchable": false, "orderable": false, "targets": [4,5]},
			],
		})
	});
</script>
