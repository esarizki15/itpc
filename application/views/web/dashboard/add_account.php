<div id="middle-content" class="homePage">
  <section id="login" class="section full_section">
  	<div class="doodle_right_dots">
  		<img src="<?php echo $this->config->item('frontend'); ?>images/dots_register_right.png">
  	</div>
  	<div class="doodle_left_dots">
  		<img src="<?php echo $this->config->item('frontend'); ?>images/dots_register_left.png">
  	</div>

  	<div class="wrapper">
  		<div class="inner_flex_middle">
  			<div class="inner_flex">
  				<div class="box_exporter">
  					<div class="login_title">
  						<h3>Profile</h3>
  						<p>Create profile of your company</p>
  					</div>
            <form action="<?php echo base_url(). 'store_detail_exporter'; ?>" method="post" enctype="multipart/form-data" >
  					<?php 
            if ($detail_user['exporter_detail']){
            foreach($detail_user['exporter_detail'] as $item){ ?>
           
            <div class="action_exporter_account">
              <div class="row-list">
                <div class="cols2">
                  <div class="form_inner">
                    <div class="form_group">
                      <input type="text" name="name" class="input_form" placeholder="Company Name" value="<?php echo $item['name']; ?>" required />
                    </div>
                    <div class="form_group">
                      <input type="text" name="address" class="input_form" placeholder="Address" value="<?php echo $item['address']; ?>"  required />
                    </div>
                    <div class="form_group">
                      <input type="email" name="email" class="input_form" placeholder="Email" value="<?php echo $item['email']?>" required />
                    </div>
                    <div class="form_group">
                      <input type="tel" name="phone" class="input_form" placeholder="Mobile Phone" value="<?php echo $item['phone']; ?>"  required />
                    </div>
                  </div>
                </div><!--end.cols2-->

                <div class="cols2">
                  <div class="form_inner">
                    <div class="form_group">
                      <input type="tel" name="office_phone" class="input_form" placeholder="Office Phone" value="<?php echo $item['office_phone']; ?>"  required />
                    </div>
                    <div class="form_group">
                      <input type="tel" name="fax" class="input_form" placeholder="Fax" value="<?php echo $item['fax']; ?>"  required />
                    </div>
                    <div class="form_group">
                      <input type="text" name="link" class="input_form" placeholder="Website link"  value="<?php echo $item['link']; ?>"  required />
                    </div>
                  </div>
                </div><!--end.cols2-->

              </div><!--end.row-list-->
              <div class="rows relative">
                <div class="title_upload">
                  <span>Company Logo (500x500px)</span>
                </div>
                <div class="preview_img">
                  <img id="logo_preview" src="<?php if($item['logo']){echo $item['logo'].'.png';}else{echo $this->config->item('frontend').'images/logo_preview.png'; } ?> ">
                  <input type='file' name='exporter_logo' id="imgInp" style="opacity: 0;position: absolute;" />
                </div><!--end.preview_img-->
                <div class="row-block-button">
                  <button type="button" id="trigger_upload" class="bt_block_white bt_with_icon">
                    <img src="<?php echo $this->config->item('frontend'); ?>images/icon_upload.png">
                    <span>Choose File</span>
                  </button>
                  <input type="hidden" name="id" class="input_form" placeholder="Mobile Phone" value="<?php echo $user_id; ?>" />
                  <button type="submit" class="bt_block_blue ">
                    Submit
                  </button>
                </div>
              </div>
            </div><!--end.action_exporter_account-->
          <?php  }}else{ ?>
            <div class="action_exporter_account">
              <div class="row-list">
                <div class="cols2">
                  <div class="form_inner">
                    <div class="form_group">
                      <input type="text" name="name" class="input_form" placeholder="Company Name"  required />
                    </div>
                    <div class="form_group">
                      <input type="text" name="address" class="input_form" placeholder="Address"  required />
                    </div>
                    <div class="form_group">
                      <input type="email" name="email" class="input_form" placeholder="Email"  required />
                    </div>
                    <div class="form_group">
                      <input type="tel" name="phone" class="input_form" placeholder="Mobile Phone"  required />
                    </div>
                  </div>
                </div><!--end.cols2-->

                <div class="cols2">
                  <div class="form_inner">
                    <div class="form_group">
                      <input type="tel" name="office_phone" class="input_form" placeholder="Office Phone"  required />
                    </div>
                    <div class="form_group">
                      <input type="tel" name="fax" class="input_form" placeholder="Fax"  required />
                    </div>
                    <div class="form_group">
                      <input type="text" name="link" class="input_form" placeholder="Website link"  required />
                    </div>
                  </div>
                </div><!--end.cols2-->

              </div><!--end.row-list-->
              <div class="rows relative">
                <div class="title_upload">
                  <span>Company Logo (500x500px)</span>
                </div>
                <div class="preview_img">
                  <img id="logo_preview" src="<?php echo $this->config->item('frontend').'images/logo_preview.png';  ?> ">
                  <input type='file' name='exporter_logo' id="imgInp" style="opacity: 0;position: absolute;" />
                </div><!--end.preview_img-->
                <div class="row-block-button">
                  <button type="button" id="trigger_upload" class="bt_block_white bt_with_icon">
                    <img src="<?php echo $this->config->item('frontend'); ?>images/icon_upload.png">
                    <span>Choose File</span>
                  </button>
                  <input type="hidden" name="id" class="input_form" placeholder="Mobile Phone" value="<?php echo $user_id; ?>" />
                  <button type="submit" class="bt_block_blue ">
                    Submit
                  </button>
                </div>
              </div>
            </div><!--end.action_exporter_account-->
          <?php } ?>
          </form>


  				</div><!--end.box_login-->
  			</div>
  		</div><!--end.inner_flex_middle-->
  	</div>
  </section>
</div>

<script type="text/javascript">
$(document).ready(function() {
  $("#trigger_upload").click(function () {
      $("#imgInp").click();
  })



  function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
          $('#logo_preview').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]); // convert to base64 string
      }
    }

    $("#imgInp").change(function() {
      readURL(this);
    });

});
</script>