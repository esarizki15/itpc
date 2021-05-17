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
					<form action="<?php echo base_url(); ?>Admin/Update_about" method="post" enctype="multipart/form-data">

						<div class="card mb-0">

							<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="card-body">
									<div class="row">
										<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

										<?php
										 foreach ($data['about_header'] as $key_about => $item_about) {
									 ?>
										<div class="col-md-12">
											<div class="form-group">
												<center>
													<div class="form-group">
														<img class="m-t-30" id="blah_2" name="header" src="<?php echo $item_about['about_header'];?>" alt="your image" style="max-width:300px;max-height:200px;" />
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
											}
										?>

										<div class="col-md-12 m-b-10">
											<div class="form-group">
												 <h3>English</h3>
												 <hr/>
                         <label>Title English</label>
												 <input type="text"  class="form-control" name="title_english" value="<?php echo $data['about_detail']['title_english']; ?>"/>
												 <br/>
												 <label>About English</label>
												 <br/>
                       	 <textarea  class="form-control" id="elm_english" name="content_english" ><?php echo $data['about_detail']['content_english']; ?></textarea>
												 <br/>
												 <label>Vision English</label>
												 <textarea  class="form-control" id="elm_v_english" name="vision_english" ><?php echo $data['about_detail']['visi_english']; ?></textarea>
												 <br/>
												 <label>Mission English</label>
												 <textarea  class="form-control" id="elm_m_english" name="mission_english" ><?php echo $data['about_detail']['mission_english']; ?></textarea>
                     </div>

										 <div class="form-group">
												<h3>Bahasa</h3>
												<hr/>
												<label>Title Bahasa</label>
												<input type="text"  class="form-control" name="title_bahasa" value="<?php echo $data['about_detail']['title_bahasa']; ?>"/>
												<br/>
												<label>About Bahasa</label>
												<br/>
												<textarea  class="form-control" id="elm_bahasa" name="content_bahasa" ><?php echo $data['about_detail']['content_bahasa']; ?></textarea>
												<br/>
												<label>Vision Bahasa</label>
												<textarea  class="form-control" id="elm_v_bahasa" name="vision_bahasa" ><?php echo $data['about_detail']['visi_bahasa']; ?></textarea>
												<br/>
												<label>Mission Bahasa</label>
												<textarea  class="form-control" id="elm_m_bahasa" name="mission_bahasa" ><?php echo $data['about_detail']['mission_bahasa']; ?></textarea>
										</div>

										<div class="form-group">
											 <h3>Spanyol</h3>
											 <hr/>
											 <label>Title Spanyol</label>
											 <input type="text"  class="form-control" name="title_spanyol" value="<?php echo $data['about_detail']['title_spanyol']; ?>"/>
											 <br/>
											 <label>About Spanyol</label>
											 <br/>
											 <textarea  class="form-control" id="elm_spanyol" name="content_spanyol" ><?php echo $data['about_detail']['content_spanyol']; ?></textarea>
											 <br/>
											 <label>Vision Spanyol</label>
											 <textarea  class="form-control" id="elm_v_spanyol" name="vision_spanyol" ><?php echo $data['about_detail']['visi_spanyol']; ?></textarea>
											 <br/>
											 <label>Mission Spanyol</label>
											 <textarea  class="form-control" id="elm_m_spanyol" name="mission_spanyol" ><?php echo $data['about_detail']['mission_spanyol']; ?></textarea>
									 </div>


										</div>



									</div>
								</div>
							</div>
						</div>

						<div class="row m-t-20 justify-content-md-center">
							<div class="col-md-6">
								<button type="submit" class="btn btn-success btn-lg btn-block waves-effect waves-light">Update Data</button>
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div> <!-- end col -->
</div> <!-- end row -->
<!-- end page title end breadcrumb -->
