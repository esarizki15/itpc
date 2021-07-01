
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
				"url": "<?php echo base_url()?>index.php/Admin/Category_list_data",
				"type": "GET" //(untuk mendapatkan data)
			},
			// Tambahkan bagian ini:
			"columns": [                              // Membuat nomor pada datatable (bukan ID user)
				{
					data: null,
					"sortable": false,
					render: function (data, type, row, meta) {
					 return meta.row + meta.settings._iDisplayStart + 1;
					}
				},
				{data: 'category_title', name: 'category_title' },
				{data: 'post_date', name: 'post_date'},
				{data: 'status', name: 'status'},
				{
					data:'id',
					mRender: function (data) {
						 return '<a class="btn btn-info waves-effect waves-light" href="<?php echo base_url()?>Admin/Exporter_category_detail/'+ data +'"><i class="fas fa-pencil-alt"></i></a> | \n\
						 <a class="btn btn-danger waves-effect waves-light" href="<?php echo base_url()?>Admin/Exporter_category_delete/'+ data +'" onclick="javascript:return confirm(\'Anda yakin?\');"><i class="fas fa-trash-alt"></i></a>';
				 }
			 }
			],
			//Set column definition initialisation properties.
			"columnDefs":[
                                // membuat kolom 0 (No.) dan kolom 1 (ID) tidak dapat di search dan sorting
				{"searchable": false, "orderable": false, "targets": [3,4]},
			],
		})
	});
</script>
