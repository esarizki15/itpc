<!-- Page-Title -->
<div class="row">
	<div class="col-sm-12">
		<div class="page-title-box">
			<div class="row align-items-center">
				<div class="col-md-8">
					<h4 class="page-title m-0">Detail Importer</h4>
					<span>Importer / Management / Detail </span>
				</div>
				<div class="col-md-4">
					<div class="float-right d-none d-md-block">
						<a href="<?php echo base_url(); ?>Admin/Importer_management" class="btn btn-primary text-white">
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
					<h4 class="mt-0 header-title">Importer Detail</h4>
					<form action="<?php echo base_url(); ?>Admin/Update_importer" method="post" enctype="multipart/form-data">
						<?php
							 foreach ($data['detail'] as $key_detail => $item_detail) {
						 ?>
						<div class="card mb-0">
							<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="card-body">
									<div class="row">
										<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
										<div class="col-md-6">
											<input type="hidden" name="importer_id" id="importer_id" class="form-control" required placeholder="Type something" value="<?php echo $item_detail['importer_id'];?>"/>
											<div class="form-group">
												<label>Importer Name<span style="color:red">*</span></label>
												<input type="text" name="importer_name" class="form-control" required placeholder="Type something" value="<?php echo $item_detail['importer_name'];?>"/>
											</div>
											<div class="form-group">
												<label class="text-muted">Importer detail</label>
												<textarea id="textarea" name="importer_detail" class="form-control" maxlength="225" rows="3" placeholder="This textarea has a limit of 225 chars."><?php echo $item_detail['importer_detail'];?></textarea>
											</div>
											<div class="form-group">
												<label class="text-muted">Importer address <span style="color:red">*</span></label>
												<textarea id="textarea" name="importer_address" class="form-control" maxlength="225" rows="3" placeholder="This textarea has a limit of 225 chars."><?php echo $item_detail['importer_address'];?></textarea>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Importer City<span style="color:red">*</span></label>
												<input type="text" name="importer_city" class="form-control" required placeholder="Type something" value="<?php echo $item_detail['importer_city'];?>"/>
											</div>
											<div class="form-group">
												<label>Importer Province<span style="color:red">*</span></label>
												<input type="text" name="importer_provience" class="form-control" required placeholder="Type something" value="<?php echo $item_detail['importer_provience'];?>"/>
											</div>
											<div class="form-group">
												<label>Importer Postal<span style="color:red">*</span></label>
												<input type="text" name="importer_postal" class="form-control" required placeholder="Type something" value="<?php echo $item_detail['importer_postal'];?>"/>
											</div>
											<div class="form-group">
												<label>Importer Coutry<span style="color:red">*</span></label>
                         <select class="js-states form-control" name="coutry_id" id="coutry_id" data-live-search="true">
													 	<option value="0">Select a coutry</option>
														<option value="<?php echo $item_detail['id'];?>" selected><?php echo $item_detail['name'];?></option>
														 <?php
																foreach ($data['coutry'] as $key_coutry => $item_coutry) {
															?>
															 <option value="<?php echo $item_coutry['id']; ?>"><?php echo $item_coutry['name']; ?></option>
															 <?php
																 }
															 ?>
                         </select>
                     </div>
										</div>
									</div>

									<hr>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Contact Name</label>
												<input type="text" name="contact_name" class="form-control" required placeholder="Type something" value="<?php echo $item_detail['contact_name'];?>"/>
											</div>
											<div class="form-group">
												<label>Office Phone<span style="color:red">*</span></label>
												<input type="text" name="office_phone" class="form-control" required placeholder="Type something" value="<?php echo $item_detail['contact_office_phone'];?>"/>
											</div>
											<div class="form-group">
												<label>Contact Phone</label>
												<input type="text" name="contact_phone" class="form-control" required placeholder="Type something" value="<?php echo $item_detail['contact_phone'];?>"/>
											</div>
											<div class="form-group">
												<label>Contact Fax</label>
												<input type="text" name="contact_fax" class="form-control" required placeholder="Type something" value="<?php echo $item_detail['contact_fax'];?>"/>
											</div>
											<div class="form-group">
												<label>Contact Email<span style="color:red">*</span></label>
												<input type="text" name="contact_email" class="form-control" required placeholder="Type something" value="<?php echo $item_detail['contact_email'];?>"/>
											</div>
											<div class="form-group">
												<label>Contact Website</label>
												<input type="text" name="contact_website" class="form-control" required placeholder="Type something" value="<?php echo $item_detail['contact_website'];?>"/>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Twitter</label>
												<input type="text" name="social_twitter" class="form-control" required placeholder="Type something" value="<?php echo $item_detail['social_twitter'];?>"/>
											</div>
											<div class="form-group">
												<label>Facebook</label>
												<input type="text" name="social_facebook" class="form-control" required placeholder="Type something" value="<?php echo $item_detail['social_facebook'];?>"/>
											</div>
											<div class="form-group">
												<label>Google</label>
												<input type="text" name="social_google" class="form-control" required placeholder="Type something" value="<?php echo $item_detail['social_google'];?>"/>
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
					<?php
						}
					?>
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
					<form id="category_form">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
						<div class="row">
								<div class="col-md-8 m-b-20">
									<label>Product Category</label>
									 <select class="js-states form-control" name="categoryId" id="categoryId" data-live-search="true">
											<option value="0">All</option>
											 <?php
													foreach ($data['product'] as $key_category => $item_category) {
												?>
												 <option value="<?php echo $item_category['category_id']; ?>"><?php echo $item_category['category_title']; ?></option>
												 <?php
													 }
												 ?>
									 </select>
								 </div>
								 <div class="col-md-4 m-t-30">
									 <button type="submit" class="btn btn-success btn-lg btn-block waves-effect waves-light">Submit Data</button>
								 </div>
							 </div>
					 </form>
			</div>
	</div>

	<div class="card m-b-30">
		<div class="card-body">
				<h4 class="mt-0 header-title">Importer Categories List</h4>
				<div class="table-responsive">
						<table class="table mb-0">
								<thead>
										<tr>
												<th>#</th>
												<th>Category</th>
												<th>Delete</th>
										</tr>
								</thead>
								<tbody id="list_importer_categories">

								</tbody>
						</table>
				</div>
		</div>
	</div>

</div>
</div>
<!-- end page title end breadcrumb -->
