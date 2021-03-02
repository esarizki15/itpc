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
  						<h3>Hello</h3>
  						<p><?php echo $this->session->user_logged['username'].' !' ?></p>
  					</div>
  					
            <div class="action_exporter_account">
              <div class="row-list">
                <div class="cols2">
                  <div class="action_item">
                    <span class="infoSmall">You haven’t input category and product. Add below</span>
                      <div class="row_action_button">
                        <a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en' : $this->uri->segment(1)."/add_account") ?>" class="button_with_icon">
                          <img src="<?php echo $this->config->item('frontend'); ?>images/icon_add_profile.png" />
                          <span>Add Exporter Profile</span>
                        </a>

                        <a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en' : $this->uri->segment(1)."/add_account") ?>" class="button_with_icon">
                          <img src="<?php echo $this->config->item('frontend'); ?>images/icon_add_edit.png" />
                          <span>Edit Exporter Profile</span>
                        </a>

                        <a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en' : $this->uri->segment(1)."/add_category") ?>" class="button_with_icon">
                          <img src="<?php echo $this->config->item('frontend'); ?>images/icon_add_plus.png" />
                          <span>Update Category</span>
                        </a>

                        <a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en' : $this->uri->segment(1)."/add_product") ?>" class="button_with_icon">
                          <img src="<?php echo $this->config->item('frontend'); ?>images/icon_add_plus.png" />
                          <span>Update Product</span>
                        </a>

                      </div><!--end.row_action_button-->
                  </div><!--end.action_item-->
                </div><!--end.cols2-->

                <div class="cols2">
                  <div class="action_item">
                    <span class="infoSmall"><strong>Create Inquiry</strong></span>
                      <div class="row_action_button">
                        <a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en' : $this->uri->segment(1)."/add_inquiry") ?>" class="button_with_icon">
                          <img src="<?php echo $this->config->item('frontend'); ?>images/icon_add_plus.png" />
                          <span>Create Inquiry</span>
                        </a>

                        <a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en' : $this->uri->segment(1)."/inquiry_list") ?>" class="button_with_icon">
                          <img src="<?php echo $this->config->item('frontend'); ?>images/icon_add_list.png" />
                          <span>Inquiry List</span>
                        </a>

                      </div><!--end.row_action_button-->
                  </div><!--end.action_item-->
                </div><!--end.cols2-->

              </div><!--end.row-list-->
            </div><!--end.action_exporter_account-->
  				</div><!--end.box_login-->
  			</div>
  		</div><!--end.inner_flex_middle-->
  	</div>
  </section>
</div>