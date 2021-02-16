
<!-- Required datatable js -->
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


<script type="text/javascript">
	var save_method; //for save method string
	$(document).ready(function() {
		//datatables
		var table = $('#empTable').DataTable({
			"processing": true,
			"serverSide": true,
                        "order": [], //Line ini sudah tidak diperlukan
			// Load data dari ajax
			"ajax": {
				"url": "<?php echo base_url()?>index.php/Admin/Subcategory_list_data",
				"type": "GET" //(untuk mendapatkan data)
			},
			// Tambahkan bagian ini:
			"columns": [                              // Membuat nomor pada datatable (bukan ID user)
				{
					data: 'id',
					name:'id'
				},
				{data: 'subcategory_title', name: 'subcategory_title' },
				{data: 'category_title', name: 'category_title' },
				{data: 'post_date', name: 'post_date'},
				{data: 'status', name: 'status'},
				{
					data:'id',
					mRender: function (data) {
						 return '<a class="btn btn-info waves-effect waves-light" href="<?php echo base_url()?>Admin/exporter_detail/'+ data +'"><i class="fas fa-pencil-alt"></i></a> | \n\
						 <a class="btn btn-danger waves-effect waves-light" href="<?php echo base_url()?>Admin/exporter_delete/'+ data +'" onclick="javascript:return confirm(\'Anda yakin?\');"><i class="fas fa-trash-alt"></i></a>';
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
