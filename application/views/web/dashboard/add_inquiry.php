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
  					
            <div class="action_exporter_account">
              <div class="row-list">

                <form id="addInquiry">
                  <div class="cols2">

                    <span class="infoSmall"><strong>Add Inquiry</strong></span>
                    <span class="infoSmall">Input detailed information about your inquiry</span>
                    <div class="form_inner">
                      <div class="form_group">
                        <div class="field">
                          <input type="text" name="inquirytitle" class="input_form" placeholder="Inquiry Title" required />
                        </div>
                      </div>
                      <div class="form_group">
                        <div class="field">
                          <input type="text" name="companyname" class="input_form field" placeholder="Company Name" required />
                        </div>
                      </div>
                      <div class="form_group">
                        <div class="field">
                          <input type="text" name="companyaddress" class="input_form field" placeholder="Company Address" required />
                        </div>
                      </div>
                      <div class="form_group">
                        <div class="custom_select field">
                          <select name="category" id="category" required>
                            <option selected disabled value="0">Category</option>
                            <option value="category1">Category 01</option>
                            <option value="category2">Category 02</option>
                            <option value="category3">category 03</option>
                          </select>
                        </div>
                      </div>

                      <div class="form_group">

                        <div class="field">
                          <textarea class="input_form field" name="productdetails" rows="4" cols="50" placeholder="Product Details" required></textarea>
                        </div>
                      </div>
                      <div class="form_group">
                        <div class="field">
                          <input type="text" name="productcapacity" class="input_form field" placeholder="Product Capacity" required />
                        </div>
                      </div>
                      <div class="form_group">
                        <div class="custom_select field">
                          <select name="haveAnswer" id="haveAnswer" required>
                            <option selected disabled value="0">Have Export? Choose Answer</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                          </select>
                        </div>
                      </div>

                    </div>
                  </div><!--end.cols2-->

                  <div class="cols2">
                    <span class="infoSmall"><strong>Contact Person</strong></span>
                    <span class="infoSmall">Input contact of Person in charge</span>
                    <div class="form_inner">
                      <div class="form_group">
                        <input type="text" name="fullName" class="input_form" placeholder="Full Name"  />
                      </div>
                      <div class="form_group">
                        <input type="email" name="email" class="input_form" placeholder="Email"  />
                      </div>
                      <div class="form_group">
                        <input type="tel" name="phone" class="input_form" placeholder="Email  Phone/ Mobile Phone"  />
                      </div>
                      <div class="form_group">
                        <button type="submit" class="bt_block_blue buttonAddInquiry">
                          Submit
                        </button>
                      </div>
                    </div>
                  </div><!--end.cols2-->
                </form>
              </div><!--end.row-list-->
            </div><!--end.action_exporter_account-->
  				</div><!--end.box_login-->
  			</div>
  		</div><!--end.inner_flex_middle-->
  	</div>
  </section>
</div>

<script type="text/javascript">
$(document).ready(function() {
  $("#addInquiry").validate({
    submitHandler: function() {
        $(".buttonAddInquiry").prop( "disabled" );
        $(".buttonAddInquiry").html('<i class="fa fa-spinner fa-spin"></i> Loading');
    },

    errorPlacement: function(error, element) {
        error.insertAfter(element.parent('.field'));
    } 
  });
});
</script>