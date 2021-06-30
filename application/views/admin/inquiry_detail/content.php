<!-- Page-Title -->
<div class="row">
	<div class="col-sm-12">
		<div class="page-title-box">
			<div class="row align-items-center">
				<div class="col-md-8">
					<h4 class="page-title m-0">Detail Inquiry</h4>
					<span>Inquiry Management / Detail Inquiry</span>
				</div>
				<div class="col-md-4">
					<div class="float-right d-none d-md-block">
						<a href="<?php echo base_url(); ?>Admin/Inquiry_management" class="btn btn-primary text-white">
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
						<div class="card mb-0">
								<div class="card-body">
									<div class="row">
										<?php
											foreach ($data['inquiry_detail'] as $key_inquiry_detail=> $item_inquiry_detail) {

											$approvel_status = $item_inquiry_detail['approved'];
										?>
										<input type="hidden" id="inquiry_id" name="inquiry_id" class="form-control" required placeholder="Type something" value="<?php echo $item_inquiry_detail['inquiry_id']; ?>"/>
										<div class="invoice-title">
                        <h3 class="m-t-0 center">
                          <?php echo $item_inquiry_detail['inquiry_title']; ?>
                        </h3>
												<p>Post Date : <?php echo $item_inquiry_detail['post_date']; ?> / Approved Status : <?php echo $item_inquiry_detail['approved']; ?></p>
                    </div>
                    <hr>
									</div>
									<div class="row">
										<div class="col-6">
											<h5>Exporter Detail</h5>
											<div class="table-responsive">
                          <table class="table table-striped mb-0">
                              <tbody>
                                  <tr>
                                    <th scope="row">Name</th>
                                    <td><?php echo $item_inquiry_detail['exporter_name']; ?></td>
                                  </tr>
																	<tr>
																		<th scope="row">Address</th>
																		<td><?php echo $item_inquiry_detail['exporter_address']; ?></td>
																	</tr>
																	<tr>
																		<th scope="row">Product</th>
																		<td><?php echo $item_inquiry_detail['product_detail']; ?></td>
																	</tr>
																	<tr>
																		<th scope="row">Capacity</th>
																		<td><?php echo $item_inquiry_detail['product_capacity']; ?></td>
																	</tr>
																	<tr>
																		<th scope="row">Have Export</th>
																		<td><?php echo $item_inquiry_detail['have_export']; ?></td>
																	</tr>
																	<tr>
																		<th scope="row">Category</th>
																		<td><?php echo $item_inquiry_detail['category_title']; ?></td>
																	</tr>
																	<tr>
																		<th scope="row">Sub category</th>
																		<td><?php echo $item_inquiry_detail['subcategory_title']; ?></td>
																	</tr>
                              </tbody>
                          </table>
                      </div>
										</div>
										<div class="col-6">
											<h5>Contact Detail</h5>
											<div class="table-responsive">
                          <table class="table table-striped mb-0">
                              <tbody>
                                  <tr>
                                    <th scope="row">Name</th>
                                    <td><?php echo $item_inquiry_detail['contact_name']; ?></td>
                                  </tr>
																	<tr>
																		<th scope="row">Address</th>
																		<td><?php echo $item_inquiry_detail['contact_email']; ?></td>
																	</tr>
																	<tr>
																		<th scope="row">Product</th>
																		<td><?php echo $item_inquiry_detail['contact_phone']; ?></td>
																	</tr>

                              </tbody>
                          </table>
                      </div>
										</div>
										<div class="col-12 m-t-30">
											<h5>Attactment</h5>
											<div class="row">
											<?php
												foreach ($data['inquiry_file'] as $key_inquiry_file => $item_inquiry_file) {
											?>

													<div class="col-4">
												 		<img  style="width:100%;" src="<?php echo $item_inquiry_file['file_patch']; ?>">
													</div>

											<?php
												}
											?>
											</div>
										</div>
									</div>
								</div>
						</div>

						<div class="row m-t-20 justify-content-md-center">
							<?php
									if($item_inquiry_detail['approved'] == "waiting"){
							?>
							<div class="col-md-4">
								<a href="<?php echo base_url()?>Admin/update_approved_inquiry/approved/<?php echo $item_inquiry_detail['inquiry_id']; ?>" class="btn btn-success btn-lg btn-block waves-effect waves-light">Approved</a>
							</div>
							<div class="col-md-4">
								<a href="<?php echo base_url()?>Admin/update_approved_inquiry/reject/<?php echo $item_inquiry_detail['inquiry_id']; ?>" class="btn btn-danger btn-lg btn-block waves-effect waves-light">Reject</a>
							</div>
							<?php
								}else{
							?>
							<div class="col-md-6">
								<a href="<?php echo base_url()?>Admin/update_approved_inquiry/waiting/<?php echo $item_inquiry_detail['inquiry_id']; ?>" class="btn btn-warning btn-lg btn-block waves-effect waves-light">Un Approved</a>
							</div>
							<?php
								}
							?>
						</div>
						<?php
							}
						?>
			</div>
		</div>
	</div> <!-- end col -->
</div> <!-- end row -->

<div class="row">
	<div class="col-12">
		<div class="card m-b-30">
			<div class="card-body">
				<h4 class="mt-0 header-title">Progress Bar</h4>
					<input type="text" id="range_01">
			</div>
		</div>
	</div>
</div>



<?php
		if($approvel_status != "waiting"){
?>
<div class="row">
	<div class="col-12">
		<div class="card m-b-30">
			<div class="card-body">
					<h4 class="mt-0 header-title">Form Importer</h4>
					<form id="category_form">
						<div class="card mb-0">
								<div id="feed-container"></div>
								<div class="card-body">
									<div class="row">
										<input type="hidden" name="exporter_id" id="exporter_id" class="form-control" required placeholder="Type something" value="<?php echo $data['inquiry_detail'][0]['exporter_id']; ?>"/>
										<input type="hidden" name="inquiry_id" id="inquiry_id" class="form-control" required placeholder="Type something" value="<?php echo $data['inquiry_detail'][0]['inquiry_id']; ?>"/>
										<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
										<div class="col-md-6">
													<div class="form-group">
                             <select class="js-states form-control" name="category_id" id="category_id" data-live-search="true">
															 	<option value="0">Select a category</option>
																 <?php

 																	foreach ($data['importer'] as $key_importer_categories => $item_importer_categories) {
 																?>
 																 <option value="<?php echo $item_importer_categories['category_id']; ?>"><?php echo $item_importer_categories['category_title']; ?></option>
 																 <?php
 																	 }
 																 ?>
                             </select>
                         </div>
										</div>
										<div class="col-md-6">
													<div class="form-group">
                             <select class="js-states form-control" name="subcategory_id" id="subcategory_id" data-live-search="true">
															 <option value="0">Select a subcategory</option>
                             </select>
                         </div>
										</div>
									</div>
									<div class="row m-t-20 justify-content-md-center">
										<div class="col-md-6">
											 <button type="submit" class="btn btn-success btn-lg btn-block waves-effect waves-light">Update</button>
										</div>
									</div>
								</div>
						</div>
					</form>
			</div>
		</div>

		<div class="card m-b-30">
			<div class="card-body">
					<h4 class="mt-0 header-title">Impoter List</h4>
					<div class="table-responsive">
              <table class="table mb-0">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Impoter Name</th>
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

		<div class="row">
			<div class="col-12">
					<div class="card m-b-30">
						 <div class="card-body">
							 	<div id="feed-inbox"></div>
							 <form class="" id="inbox_form" action="#">
								 <input type="hidden" name="exporter_id_inbox" id="exporter_id_inbox" class="form-control" required placeholder="Type something" value="<?php echo $data['inquiry_detail'][0]['exporter_id']; ?>"/>
								 <input type="hidden" name="inquiry_id_inbox" id="inquiry_id_inbox" class="form-control" required placeholder="Type something" value="<?php echo $data['inquiry_detail'][0]['inquiry_id']; ?>"/>
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
							 <div class="form-group">
								 	<h3>Inbox Form</h3>
									 <div>
											 <textarea required class="form-control" rows="5" name="inbox_content" id="inbox_content" required></textarea>
									 </div>
							 </div>
						   <div class="form-group">
								 <div class="text-center">
									 <button type="submit" class="btn btn-primary waves-effect waves-light">
											 Submit
									 </button>
								 </div>
							 </div>
						 </form>
						 </div>
					</div>
			</div>
		</div>

		<div class="row">
			 <div class="col-12">
					 <div class="card m-b-30">

							 <div class="card-body">
								 <h3>Inbox List</h3>
									<table id="empTable"  class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
											<thead>
													<tr>
															<th>No</th>
															<th>Post date</th>
															<th>Inbox Message</th>
															<th>Status</th>
															<th>Action</th>
													</tr>
											</thead>
											<tbody></tbody>
									</table>
							 </div>
						</div>
				</div>
		</div>


	</div>
</div>
<?php
		}
?>
