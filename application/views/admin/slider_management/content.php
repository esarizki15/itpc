<!-- Page-Title -->
<div class="row">
	<div class="col-sm-12">
		<div class="page-title-box">
			<div class="row align-items-center">
				<div class="col-md-8">
					<h4 class="page-title m-0">Slider Management</h4>
					<span>Other Fiture / Slider managment</span>
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
					<h4 class="mt-0 header-title">Form Slider managment</h4>
					<form action="<?php echo base_url(); ?>Admin/Submit_slider" method="post" enctype="multipart/form-data">
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
													<label class="col-form-label">Logo Exporter( max 1268 x 671px )</label>
													<div class="field" align="center">
														<input type="file" id="imgInp" name="file_patch" />
													</div>
												</div>
											</center>
										</div>
										<?php
										 foreach ($data['language_list'] as $key_language => $item_language) {
									 ?>
										<div class="col-md-12">
											<div class="form-group">
												<label>Title <?php echo $item_language['language_title']; ?></label>
												<input type="text" name="title[<?php echo $item_language['language_title']; ?>]"  class="form-control"  required placeholder="Type something" />
											</div>
											<div class="form-group">
											<div class="m-t-20">
                        <label class="text-muted">Description (<?php echo $item_language['language_title']; ?>)</label>
                        <textarea id="textarea" name="description[<?php echo $item_language['language_title']; ?>]" class="form-control" maxlength="225" rows="3" placeholder="This textarea has a limit of 225 chars."></textarea>
                    	</div>
										</div>
										<hr>
										</div>
										<?php
											}
										?>
										<div class="col-md-12">
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
                          <th>Title</th>
                          <th>Image</th>
													<th>Link</th>
                          <th>Post date</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>

										<?php
										$no = 1;
										 foreach ($data['slider'] as $key_useful => $item_useful) {
									 ?>
									  <tr>
									 	<td><?php echo $no; ?></td>
										<td><?php echo $item_useful['title_bahasa']; ?></td>
										<td><img src="<?php echo $item_useful['file_patch'];?>" style="width:50px;"></td>
										<?php if($item_useful['link'] == false){
										?>
										<td>link not available</td>
										<?php
											}else{
										?>
										<td><a href="<?php echo $item_useful['link']; ?>" target="_blank"><?php echo $item_useful['link']; ?></a></td>
										<?php
											}
										?>
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
												<a href="<?php echo base_url();?>Admin/slider_status_update/<?php echo $item_useful['slider_id']; ?>" class="btn <?php echo $status; ?> waves-effect waves-light"><i class="fas fa-check"></i></a>
												<a href="<?php echo base_url();?>Admin/slider_delete/<?php echo $item_useful['slider_id']; ?>" class="btn btn-danger waves-effect waves-light"><i class="fas fa-trash-alt"></i></a>
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
