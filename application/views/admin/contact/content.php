<!-- Page-Title -->
<div class="row">
	<div class="col-sm-12">
		<div class="page-title-box">
			<div class="row align-items-center">
				<div class="col-md-8">
					<h4 class="page-title m-0">Update Contact</h4>
					<span>Other Page / Contact</span>
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
					<h4 class="mt-0 header-title">Form About</h4>
					<form action="<?php echo base_url(); ?>Admin/Update_contact" method="post" enctype="multipart/form-data">
						<?php
						 foreach ($data['contact'] as $key_contact => $item_contact) {
					 ?>
						<div class="card mb-0">
							<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="card-body">
									<div class="row">
										<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

										<div class="col-md-12">
											<div class="form-group">
												<center>
													<div class="form-group">
														<img class="m-t-30" id="blah_2" name="header" src="<?php echo $item_contact['contact_header'];?>" alt="your image" style="max-width:300px;max-height:200px;" />
													</div>
													<div class="form-group">
														<label class="col-form-label">Header News( max 1360 x 768px )</label>
														<div class="field" align="center">
															<input type="file" id="imgInp_2" name="header" />
														</div>
													</div>
												</center>
											</div>
										</div>
										<?php
										 foreach ($data['language_list'] as $key_language => $item_language) {
											 $content = "content_".$item_language['language_title'];
									 ?>
										<div class="col-md-12 m-b-10">
											<div class="form-group">
                         <label>Content <?php echo $item_language['language_title']; ?></label>
                       <textarea id="elm_<?php echo $item_language['language_title']; ?>" name="content[<?php echo $item_language['language_title']; ?>]" ><?php echo $item_contact[$content]; ?>"</textarea>
                     </div>
										</div>
										<?php
											}
										?>

									</div>
								</div>
							</div>
						</div>
						<div class="row m-t-20 justify-content-md-center">
							<div class="col-md-6">
								<button type="submit" class="btn btn-success btn-lg btn-block waves-effect waves-light">Update Data</button>
							</div>
						</div>
						<?php
								}
						?>
					</form>
				</div>
			</div>
		</div>
	</div> <!-- end col -->
</div> <!-- end row -->
<!-- end page title end breadcrumb -->
