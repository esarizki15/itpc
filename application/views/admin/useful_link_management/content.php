<!-- Page-Title -->
<div class="row">
	<div class="col-sm-12">
		<div class="page-title-box">
			<div class="row align-items-center">
				<div class="col-md-8">
					<h4 class="page-title m-0">Useful link</h4>
					<span>Other Fiture / Useful link Managment</span>
				</div>
				<div class="col-md-4">
					<div class="float-right d-none d-md-block">
						<a href="<?php echo base_url(); ?>Admin/Expoter_management" class="btn btn-primary text-white">
							<i class="dripicons-arrow-thin-left"></i> Back
						</a>
					</div>
				</div>

			</div>

		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card m-b-30">
			<div class="card-body">
				<div class="card-body">
					<h4 class="mt-0 header-title">Form Add Exporter</h4>
					<form action="<?php echo base_url(); ?>Admin/Submit_subcategory" method="post" enctype="multipart/form-data">
						<div class="card mb-0">
							<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="card-body">
									<div class="row">
										<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
										<div class="col-md-4">
													<div class="form-group">
														<label>Categories<span style="color:red">*</span></label>
                             <select class="js-states form-control" name="category_id" id="category_id" data-live-search="true">
															 	<option value="0">Select a category</option>
																 <?php
 																	foreach ($data as $key_expoter_categories => $item_expoter_categories) {
 																?>
 																 <option value="<?php echo $item_expoter_categories['category_id']; ?>"><?php echo $item_expoter_categories['category_title']; ?></option>
 																 <?php
 																	 }
 																 ?>
                             </select>
                         </div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Old subcategory id</label>
												<input type="text" name="subcategory_old_id" class="form-control"  placeholder="Type something" />
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Title subcategory<span style="color:red">*</span></label>
												<input type="text" name="subcategory_title" class="form-control" required placeholder="Type something" />
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 text-center p-t-10">
								<input type="checkbox" class="custom-control-input" id="customCheck3" value="1" name="is_draft" data-parsley-multiple="groups" checked disabled>
								<label class="custom-control-label" for="customCheck3">Save Draft</label>
							</div>
						</div>
						<div class="row m-t-20 justify-content-md-center">
							<div class="col-md-6">
								<button type="submit" class="btn btn-success btn-lg btn-block waves-effect waves-light">Submit Data</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div> <!-- end col -->
</div> <!-- end row -->

<div class="row">
   <div class="col-12">
       <div class="card m-b-30">

           <div class="card-body">
              <table id="empTable"  class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Subcategory Title</th>
                          <th>Category Title</th>
                          <th>Post date</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
										<tr>
										<?php
										$no = 1;
										 foreach ($data as $key_useful => $item_useful) {
									 ?>
									 <td><?php echo $no; ?></td>
									 <?php
									 		$no++;
										 }
									 ?>
								 </tr>
									</tbody>
              </table>
           </div>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->
