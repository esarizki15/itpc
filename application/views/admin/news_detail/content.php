<!-- Page-Title -->
<div class="row">
	<div class="col-sm-12">
		<div class="page-title-box">
			<div class="row align-items-center">
				<div class="col-md-8">
					<h4 class="page-title m-0">Detail News</h4>
					<span>News Management / Detail News</span>
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
					<h4 class="mt-0 header-title">Form Detail News</h4>
					<form action="<?php echo base_url(); ?>Admin/Update_news" method="POST" enctype="multipart/form-data">
						<?php
						 foreach ($data['detail_news'] as $key_news => $item_news) {
					 ?>
						<div class="card mb-0">
							<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="card-body">
									<div class="row">
										<input type="hidden" name="news_id" value="<?php echo $item_news['news_id'];?>">
										<input type="hidden" name="trans_key" value="<?php echo $item_news['trans_key'];?>">
										<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
										<div class="col-md-6">
											<div class="form-group">
												<center>
													<div class="form-group">
														<img class="m-t-30" id="blah" name="thumbnail" src="<?php echo $item_news['news_thumbnail'];?>" alt="your image" style="max-width:200px;max-height:200px;" />
													</div>
													<div class="form-group">
														<label class="col-form-label">Thumbnail News( max 500 x 500px )</label>
														<div class="field" align="center">
															<input type="file" id="imgInp" name="thumbnail" />
														</div>
													</div>
												</center>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<center>
													<div class="form-group">
														<img class="m-t-30" id="blah_2" name="header" src="<?php echo $item_news['news_header'];?>" alt="your image" style="max-width:300px;max-height:200px;" />
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


										<div class="col-md-6">
											<div class="form-group">
												 <select class="js-states form-control" name="tag_id" id="category_id" data-live-search="true">
														<option value="0">Select a category</option>
														 <option value="<?php echo $item_news['tag_id']; ?>" selected ><?php echo $item_news['tag_title']; ?></option>
														 <?php
															foreach ($data['tag_list'] as $key_tag => $item_tag) {
														?>
														 <option value="<?php echo $item_tag['tag_id']; ?>"><?php echo $item_tag['tag_title']; ?></option>
														 <?php
															 }
														 ?>
												 </select>
										 </div>
										</div>
										<div class="col-md-6">

											<div class="input-group">
												 <input type="text" class="form-control" placeholder="mm/dd/yyyy" value="<?php echo $item_news['post_date']; ?>" name="published_at" id="published_at">
												 <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
										 </div><!-- input-group -->
											<div class="form-group" style="display:none;">
												 <select class="js-states form-control" name="news_thumbnail_type"  data-live-search="true">
													 	<option value="0">Select a thumbnail type</option>
														<option value="1" selected >Image</option>
														<option value="2">Youtube</option>
												 </select>
											</div>
										</div>

										<?php
										 foreach ($data['language_list'] as $key_language => $item_language) {
									 ?>
										<div class="col-md-12 m-b-10">
											<div class="form-group">
												<label>Title <?php echo $item_language['language_title']; ?></label>
												<?php
															$title = "title_".$item_language['language_title'];
															$content = "content_".$item_language['language_title'];
												?>
												<input type="text" value="<?php echo $item_news[$title]; ?>" name="title[<?php echo $item_language['language_title']; ?>]" class="form-control" required placeholder="Type something" />
											</div>
											<div class="form-group">
                         <label>Content <?php echo $item_language['language_title']; ?></label>
                       <textarea id="elm_<?php echo $item_language['language_title']; ?>" name="content[<?php echo $item_language['language_title']; ?>]" ><?php echo $item_news[$content]; ?>"</textarea>
                     </div>
										</div>
										<?php
											}
										?>

									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 text-center p-t-10">
								<input type="checkbox" class="custom-control-input" id="customCheck3" value="<?php echo $item_news['status']; ?>" name="is_draft" data-parsley-multiple="groups" checked disabled>
								<label class="custom-control-label" for="customCheck3">Save Draft</label>
							</div>
						</div>
						<div class="row m-t-20 justify-content-md-center">
							<div class="col-md-6">
								<button type="submit" class="btn btn-success btn-lg btn-block waves-effect waves-light">Submit Data</button>
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
