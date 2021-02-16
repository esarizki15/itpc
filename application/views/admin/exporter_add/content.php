<!-- Page-Title -->
<div class="row">
	<div class="col-sm-12">
		<div class="page-title-box">
			<div class="row align-items-center">
				<div class="col-md-8">
					<h4 class="page-title m-0">Add Exporter</h4>
					<span>Exporter Management / Add Exporter</span>
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
					<form action="<?php echo base_url(); ?>Admin/Submit_expoter" method="post" enctype="multipart/form-data">
						<div class="card mb-0">
							<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="card-body">
									<div class="row">
										<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
										<div class="col-md-12">
											<div class="form-group">
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
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>Exporter Name<span style="color:red">*</span></label>
												<input type="text" name="exporter_name" class="form-control" required placeholder="Type something" />
											</div>
											<div class="form-group">
												<label>Exporter Address<span style="color:red">*</span></label>
												<input type="text" name="exporter_address" class="form-control" required placeholder="Type something" />
											</div>

											<div class="form-group">
												<label>Exporter Office Phone</label>
												<input type="text" name="exporter_office_phone" class="form-control" placeholder="Type something" />
											</div>


											<div class="form-group">
												<label>Exporter link</label>
												<input parsley-type="url" type="url" name="exporter_link" class="form-control" placeholder="Type something" />
											</div>

										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Exporter Email<span style="color:red">*</span></label>
												<input parsley-type="email" type="email" name="exporter_email" class="form-control" required placeholder="Type something" />
											</div>
											<div class="form-group">
												<label>Exporter Phone</label>
												<input type="text" name="exporter_phone" class="form-control" placeholder="Type something" />
											</div>



											<div class="form-group">
												<label>Exporter Fax</label>
												<input type="text" name="exporter_fax" class="form-control" placeholder="Type something" />
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
<!-- end page title end breadcrumb -->
