
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
  						<h3>Login</h3>
              
  						<p>Sign in to your account<br />
              
              <?php echo '<b><i>'.$this->session->flashdata('flsh_msg_login').'</i></b><br>'; ?>
              
              Didn’t have an account? <a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en' : $this->uri->segment(1)."/register") ?>" class="blue_teks">Register here</a></p>
  					</div>
  					<div class="form_inner">
            <form id="loginPage" action="<?php echo base_url(). 'store_login'; ?>" method="post">
              <div class="form_group icon_group">
                <input type="email" name="email" class="input_form email_icon email" placeholder="Email" required />
              </div>
              <div class="form_group icon_group">
                <input type="password" name="password" class="input_form password_icon passwordInput pass" placeholder="Password" required />
                <span class="eye_trigger trigger_showPassword">
                  <img class="non_eye" src="<?php echo $this->config->item('frontend'); ?>images/icon_eye.png" />
                  <img class="non_eye_active" src="<?php echo $this->config->item('frontend'); ?>images/icon_eye_slash.png" />
                </span>
              </div>


              <div class="form_group overflowForm rememberRow">
                <div class="left">
                  <input type="checkbox" id="remember" name="remember" value="remember">
                  <label class="checkbox_teks" for="remember">Remember me</label>
                </div>
                <div class="right">
                  <a href="#" class="blue_teks">Forgot Password?</a>
                </div>

              </div>

              <div class="form_group button_row">
                <input type="hidden" name="csrf_token_reg" value="<?=$token;?>" />
                <button type="submit" class="bt_block_blue loginsubmit">Login</button>
              </div>
              </form>

  					</div>
  				</div><!--end.box_login-->
  			</div>
  		</div><!--end.inner_flex_middle-->
  	</div>
  </section>
</div>

<script>

  $(document).ready(function() {
    $("#loginPage").validate({
      submitHandler: function() {
          $(".loginsubmit").prop( "disabled" );
          $(".loginsubmit").html('<i class="fa fa-spinner fa-spin"></i> Loading');
          form.submit();
      }
    });

    /*$( ".loginsubmit" ).click(function() {
      
      var email=$('.email').val();
      var pass=$('.pass').val();

      if(email == '' || pass == '') {
        return false;
      }else{
        $(this).prop( "disabled" );
        $(this).html('<i class="fa fa-spinner fa-spin"></i> Loading');
      }
    });*/
  });
  </script>