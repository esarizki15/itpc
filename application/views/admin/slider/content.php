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
					<h4 class="mt-0 header-title">Form Useful link</h4>
					<form action="<?php echo base_url(); ?>Admin/Submit_useful" method="post" enctype="multipart/form-data">
						<div class="card mb-0">
							<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="card-body">
									<div class="row">
										<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
										<div class="col-md-12">
											<center>
												<div class="form-group">
													<img class="m-t-30" id="blah" name="thumbnail" src="#" alt="your image" style="max-width:200px;max-height:200px;" />
												</div>
												<div class="form-group">
													<label class="col-form-label">Logo Exporter( max 500 x 500px )</label>
													<div class="field" align="center">
														<input type="file" id="imgInp" name="logo" />
													</div>
												</div>
											</center>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Name</label>
												<input type="text" name="userful_title" class="form-control"  required placeholder="Type something" />
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<label>Link<span style="color:red">*</span></label>
												<input type="text" name="useful_link" class="form-control" required placeholder="Type something" />
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
              <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Name</th>
                          <th>Logo</th>
													<th>Link</th>
                          <th>Post date</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>

										<?php
										$no = 1;
										 foreach ($data as $key_useful => $item_useful) {
									 ?>
									  <tr>
									 	<td><?php echo $no; ?></td>
										<td><?php echo $item_useful['userful_title']; ?></td>
										<td><img src="<?php echo $item_useful['useful_logo'];?>" style="width:50px;"></td>
										<td><a href="<?php echo $item_useful['useful_link']; ?>" target="_blank"><?php echo $item_useful['useful_link']; ?></a></td>
										<td><?php echo $item_useful['post_date']; ?></td>
									 	<td><?php echo $item_useful['status']; ?></td>
										<td>
												<a href="" class="btn btn-info waves-effect waves-light"><i class="fas fa-pencil-alt"></i></a>
												<?php
													$status = $item_useful['status'];
													if($status == "actived"){
														$status = "btn-success";
													}else{
														$status = "btn-danger";
													}
												?>
												<a href="" class="btn <?php echo $status; ?> waves-effect waves-light"><i class="fas fa-check"></i></a>
												<a href="" class="btn btn-danger waves-effect waves-light"><i class="fas fa-trash-alt"></i></a>
										</td>
								 	 </tr>

									 <?php
									 		$no++;
										 }
									 ?>

									</tbody>
              </table>
           </div>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->
