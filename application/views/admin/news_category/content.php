<!-- Page-Title -->
<div class="row">
	<div class="col-sm-12">
		<div class="page-title-box">
			<div class="row align-items-center">
				<div class="col-md-8">
					<h4 class="page-title m-0">Category News</h4>
					<span>News / Category</span>
				</div>
				<div class="col-md-4">
					<div class="float-right d-none d-md-block">
						<a href="<?php echo base_url(); ?>Admin/News_management" class="btn btn-primary text-white">
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
					<h4 class="mt-0 header-title">Form Add Category</h4>
					<form action="<?php echo base_url(); ?>Admin/Submit_news_category" method="post" enctype="multipart/form-data">
						<div class="card mb-0">
							<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="card-body">
									<div class="row">
										<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

										<div class="col-md-12">
											<div class="form-group">
												<label>Title Category<span style="color:red">*</span></label>
												<input type="text" name="tag_title" class="form-control" required placeholder="Type something" />
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
                          <th>Category Title</th>
                          <th>Post date</th>
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
<!-- end page title end breadcrumb -->
