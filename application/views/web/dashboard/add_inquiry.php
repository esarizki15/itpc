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
                <div class="cols2">

                  <span class="infoSmall"><strong>Add Inquiry</strong></span>
                  <span class="infoSmall">Input detailed information about your inquiry</span>
                  <div class="form_inner">
                    <div class="form_group">
                      <input type="text" name="inquirytitle" class="input_form" placeholder="Inquiry Title" required />
                    </div>
                    <div class="form_group">
                      <input type="text" name="companyname" class="input_form" placeholder="Company Name" required />
                    </div>
                    <div class="form_group">
                      <input type="text" name="companyaddress" class="input_form" placeholder="Company Address" required />
                    </div>
                    <div class="form_group">
                      <div class="custom_select">
                        <select name="category" id="category">
                          <option selected disabled value="0">Category</option>
                          <option value="category1">Category 01</option>
                          <option value="category2">Category 02</option>
                          <option value="category3">category 03</option>
                        </select>
                      </div>
                    </div>

                    <div class="form_group">
                      <textarea class="input_form" name="productdetails" rows="4" cols="50" placeholder="Product Details"></textarea>
                    </div>
                    <div class="form_group">
                      <input type="text" name="productcapacity" class="input_form" placeholder="Product Capacity" required />
                    </div>
                    <div class="form_group">
                      <div class="custom_select">
                        <select name="haveAnswer" id="haveAnswer">
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
                      <input type="text" name="fullName" class="input_form" placeholder="Full Name" required />
                    </div>
                    <div class="form_group">
                      <input type="email" name="email" class="input_form" placeholder="Email" required />
                    </div>
                    <div class="form_group">
                      <input type="tel" name="phone" class="input_form" placeholder="Email Phone/ Mobile Phone" required />
                    </div>
                    <div class="form_group">
                      <button type="submit" class="bt_block_blue ">
                        Submit
                      </button>
                    </div>
                  </div>
                </div><!--end.cols2-->

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
 

});
</script>