<!-- Page-Title -->
<div class="row">
	<div class="col-sm-12">
		<div class="page-title-box">
			<div class="row align-items-center">
				<div class="col-md-8">
					<h4 class="page-title m-0">Detail Exporter</h4>
					<span>Exporter Management / Detail Exporter</span>
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
						<h4 class="mt-0 header-title">Form User Exporter</h4>
						<form action="<?php echo base_url(); ?>Admin/Update_user_expoter" method="post" enctype="multipart/form-data">
							<div class="card mb-0">
								<div class="card-body">
									<div class="row">
										<?php
							        foreach ($data['user_data'] as $key_user_data => $item_user_data) {
							      ?>
										<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
										<input type="hidden" name="user_id" class="form-control" required placeholder="Type something" value="<?php echo $item_user_data['user_id']; ?>"/>

										<div class="col-md-4">
											<div class="form-group">
												<label>username<span style="color:red">*</span></label>
												<input type="text" name="username" class="form-control" required placeholder="Type something" value="<?php echo $item_user_data['username']; ?>"/>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>email<span style="color:red">*</span></label>
												<input type="email" name="email" class="form-control" required placeholder="Type something" value="<?php echo $item_user_data['email']; ?>"/>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<div class="row">
													<div class="col-4">
														<div class="p-4">
														<input type="checkbox" class="custom-control-input" id="customCheck4" value="1" name="change_password">
														<label class="custom-control-label" for="customCheck4">Change Password</label>
														</div>
													</div>
													<div class="col-8">
														<label>current password : <?php echo $item_user_data['password_text']; ?></label>
														<input type="password" name="password" id="password" class="form-control" disabled/>
													</div>
												</div>
											</div>
										</div>
										<?php
											}
										?>
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
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card m-b-30">
			<div class="card-body">
					<h4 class="mt-0 header-title">Form Detail Exporter</h4>
					<form action="<?php echo base_url(); ?>Admin/Update_expoter" method="post" enctype="multipart/form-data">
						<div class="card mb-0">
								<div class="card-body">
									<div class="row">
										<?php
											foreach ($data['expoter_data'] as $key_expoter_data => $item_expoter_data) {
										?>
										<?php
												 $featured = $item_expoter_data['exporter_home'];
												if($featured == 1){

										?>
										<div class="float-right">
											<a href="<?php echo base_url(); ?>Admin/featured_setting/<?php echo $featured; ?>/<?php echo $item_expoter_data['exporter_id']; ?>" class="btn btn-success text-white">
												<i class="dripicons-device-mobile"></i> Featured Home
											</a>
										</div>
										<?php
											}else{
										?>
										<div class="float-right">
											<a href="<?php echo base_url(); ?>Admin/featured_setting/<?php echo $featured; ?>/<?php echo $item_expoter_data['exporter_id']; ?>" class="btn btn-danger text-white">
												<i class="dripicons-device-mobile"></i> Featured Home
											</a>
										</div>
										<?php
											}
										?>
										<input type="hidden" name="exporter_id" id="exporter_id" class="form-control" required placeholder="Type something" value="<?php echo $item_expoter_data['exporter_id']; ?>"/>
										<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
										<div class="col-md-12">
											<div class="form-group">
												<center>
													<div class="form-group">
														<img class="m-t-30" id="blah" name="thumbnail" src="<?php echo $item_expoter_data['exporter_logo']; ?>" alt="your image" style="max-width:200px;max-height:200px;" />
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
												<input type="text" name="exporter_name" class="form-control" value="<?php echo $item_expoter_data['exporter_name']; ?>" required placeholder="Type something" />
											</div>
											<div class="form-group">
												<label>Exporter Address<span style="color:red">*</span></label>
												<input type="text" name="exporter_address" class="form-control" value="<?php echo $item_expoter_data['exporter_address']; ?>" required placeholder="Type something" />
											</div>

											<div class="form-group">
												<label>Exporter Office Phone</label>
												<input type="text" name="exporter_office_phone" class="form-control" value="<?php echo $item_expoter_data['exporter_office_phone']; ?>" placeholder="Type something" />
											</div>


											<div class="form-group">
												<label>Exporter link</label>
												<input parsley-type="url" type="url" name="exporter_link" class="form-control" value="<?php echo $item_expoter_data['exporter_link']; ?>" placeholder="Type something" />
											</div>

										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Exporter Email<span style="color:red">*</span></label>
												<input parsley-type="email" type="email" name="exporter_email" class="form-control" value="<?php echo $item_expoter_data['exporter_email']; ?>" required placeholder="Type something" />
											</div>
											<div class="form-group">
												<label>Exporter Phone</label>
												<input type="text" name="exporter_phone" class="form-control" value="<?php echo $item_expoter_data['exporter_phone']; ?>" placeholder="Type something" />
											</div>
											<div class="form-group">
												<label>Exporter Fax</label>
												<input type="text" name="exporter_fax" class="form-control" value="<?php echo $item_expoter_data['exporter_fax']; ?>" placeholder="Type something" />
											</div>


										</div>

										<?php
											}
										?>

									</div>
								</div>

						</div>
						<div class="row">
							<div class="col-md-12 text-center p-t-10">
								<?php
										$status = $item_expoter_data['status'];

										if($status == 1)
										{
											$is_checked = "";
										}else{
											$is_checked = "checked";
										}
								?>
								<input type="checkbox" class="custom-control-input" id="customCheck3" value="1" name="is_draft" <?php echo $is_checked; ?> data-parsley-multiple="groups">
								<label class="custom-control-label" for="customCheck3">Save Draft</label>
							</div>
						</div>
						<div class="row m-t-20 justify-content-md-center">
							<div class="col-md-6">
								<button type="submit" class="btn btn-success btn-lg btn-block waves-effect waves-light">Update</button>
							</div>
						</div>
					</form>
			</div>
		</div>
	</div> <!-- end col -->
</div> <!-- end row -->

<div class="row">
	<div class="col-12">
		<div class="card m-b-30">
			<div class="card-body">
					<h4 class="mt-0 header-title">Form Expoter Categories</h4>
					<form id="category_form">
						<div class="card mb-0">
								<div id="feed-container"></div>
								<div class="card-body">
									<div class="row">
										<input type="hidden" name="exporter_id" id="exporter_id" class="form-control" required placeholder="Type something" value="<?php echo $data['expoter_data'][0]['exporter_id']; ?>"/>
										<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
										<div class="col-md-6">
													<div class="form-group">
                             <select class="js-states form-control" name="category_id" id="category_id" data-live-search="true">
															 	<option value="0">Select a category</option>
																 <?php
 																	foreach ($data['expoter_categories'] as $key_expoter_categories => $item_expoter_categories) {
 																?>
 																 <option value="<?php echo $item_expoter_categories['category_id']; ?>"><?php echo $item_expoter_categories['category_title']; ?></option>
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
					<h4 class="mt-0 header-title">Expoter Categories List</h4>
					<div class="table-responsive">
              <table class="table mb-0">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Category</th>
                          <th>Subcategory</th>
                          <th>Delete</th>
                      </tr>
                  </thead>
                  <tbody id="list_expoter_categories">

                  </tbody>
              </table>
          </div>
			</div>
		</div>

	</div>
</div>
