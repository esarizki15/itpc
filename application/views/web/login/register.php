
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
              <?php echo '<b><i>'.$this->session->flashdata('flsh_msg').'</i></b>'; ?>
  					</div>
  					<div class="form_inner">
             <form action="<?php echo base_url(). 'store_register'; ?>" method="post">
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
              <div class="form_group icon_group">
                <input type="password" name="conf_password" class="input_form password_icon passwordInput repass" placeholder="Confirm Password" required />
                <span class="eye_trigger trigger_showPassword">
                  <img class="non_eye" src="<?php echo $this->config->item('frontend'); ?>images/icon_eye.png" />
                  <img class="non_eye_active" src="<?php echo $this->config->item('frontend'); ?>images/icon_eye_slash.png" />
                </span>
              </div>


              <div class="form_group button_row">
                <input type="hidden" name="csrf_token_reg" value="<?=$token;?>" />
                <button type="submit" class="bt_block_blue register"><i style="display:none" class="fa fa-spinner fa-spin"></i> Register</button>
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
  
  $( ".register" ).click(function() {
    
    var email=$('.email').val();
    var pass=$('.pass').val();
    var repass=$('.repass').val();
    if(email == '' || pass == '' || repass == ''){
      return false;
    }else{
      $(this).prop( "disabled" );
      $(this).html('<i class="fa fa-spinner fa-spin"></i> Loading');
    }
  });
  </script>