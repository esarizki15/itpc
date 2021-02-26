
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
  				<div class="box_login">
  					<div class="login_title">
  						<h3>Register</h3>
  						<p>Create an ITPC account with your email address</p>
  					</div>
  					<div class="form_inner">
              <form>
              <div class="form_group icon_group">
                <input type="email" name="email" class="input_form email_icon" placeholder="Email" required />
              </div>

              <div class="form_group icon_group">
                <input type="password" name="password" class="input_form password_icon passwordInput" placeholder="Password" required />
                <span class="eye_trigger trigger_showPassword">
                  <img class="non_eye" src="<?php echo $this->config->item('frontend'); ?>images/icon_eye.png" />
                  <img class="non_eye_active" src="<?php echo $this->config->item('frontend'); ?>images/icon_eye_slash.png" />
                </span>
              </div>

              <div class="form_group icon_group">
                <input type="password" name="confirm_password" class="input_form password_icon passwordInput" placeholder="Confirm Password" required />
                <span class="eye_trigger trigger_showPassword">
                  <img class="non_eye" src="<?php echo $this->config->item('frontend'); ?>images/icon_eye.png" />
                  <img class="non_eye_active" src="<?php echo $this->config->item('frontend'); ?>images/icon_eye_slash.png" />
                </span>
              </div>


              <div class="form_group button_row">
                <button type="submit" class="bt_block_blue">Register</button>
              </div>
              </form>

  					</div>
  				</div><!--end.box_login-->
  			</div>
  		</div><!--end.inner_flex_middle-->
  	</div>
  </section>
</div>