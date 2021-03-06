
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
  				<div class="box_login text-center">
            <div class="icon_thankyou">
              <img src="<?php echo $this->config->item('frontend'); ?>images/icon_thankyou.png">
            </div>
  					<div class="login_title text-center">
              
  						<h3>Thank you</h3>
              
  						<p>We’ve sent a verification link to your e-mail. 
Check your inbox. Do not share to anybody.</p>
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