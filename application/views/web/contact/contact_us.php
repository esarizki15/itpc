

<div id="middle-content" class="innerPage">
  <section id="bannerPages" class="section">
     <div class="doodle_dots">
      <img src="<?php echo $this->config->item('frontend'); ?>images/dots_banner.png">
    </div>
    <div class="offside_banner">
      <div class="banner_slider">
        <div class="item">
          <div class="images_banner">
            <img src="<?php echo $this->config->item('frontend'); ?>images/img_about.png">
          </div>
          <div class="caption_banner max_width">
            <h3>Contact<br/>US</h3>
          </div>
        </div>

      </div>
    </div>
  </section>

  <section id="detail_contact" class="section">
    <div class="offside_banner">
      <div class="inner_detail_contact">
        <div class="row-list">
          <div class="cols2">
            <div class="item_form_contact">
              <h3>Contact Us</h3>
              <?php echo '<b><i>'.$this->session->flashdata('flsh_msg').'</i></b>'; ?>
              <form id="contactForm" action="<?php echo base_url(). 'store_contact_us'; ?>" method="post">
                <div class="form_group">
                  <label class="title_input">Your Name (required)</label>
                  <div class="field">
                    <input type="text" name="name" class="input_form field" required />
                  </div>
                </div><!--end.form_group-->
                <div class="form_group">
                  <label class="title_input">Your Email (required)</label>
                  <div class="field">
                    <input type="email" name="email" class="input_form field" required />
                  </div>
                </div><!--end.form_group-->
                <div class="form_group">
                  <label class="title_input">Industry</label>
                  <div class="field">
                    <input type="text" name="industry" class="input_form field"  />
                  </div>
                </div><!--end.form_group-->
                <div class="form_group">
                  <label class="title_input">Phone Number</label>
                  <div class="field">
                    <input type="tel" name="phone" class="input_form field"  />
                  </div>
                </div><!--end.form_group-->
                <div class="form_group">
                  <label class="title_input">Your Message</label>
                  <div class="field">
                    <textarea class="input_form field" name="message" rows="4" cols="50">
                    </textarea>
                  </div>
                </div><!--end.form_group-->
                <div class="form_group">
                <input type="hidden" name="csrf_token_reg" value="<?=$token;?>" />
                <button  class="bt_block_blue register"><i style="display:none" class="fa fa-spinner fa-spin"></i> Send</button>
                </div>


              </form>
            </div>
          </div>
          <div class="cols2">
            <div class="maps_iframe">
              <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.986257218055!2d106.78215031465437!3d-6.265537095464954!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f1a5f4fbee47%3A0x682837113c4ea854!2sPondok%20Indah%20Mall!5e0!3m2!1sen!2sid!4v1617902273207!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe> -->
                <?=$content['about'][0]['contact_map'];?>  
            </div><!--end.maps_iframe-->
          </div>
        </div><!--end.row-list-->
      </div><!--end.inner_detail_contact-->
    </div>
  </section>

 

  <section id="contact_call" class="section">
    <div class="wrapper">
      <div class="row-list">
        <div class="cols3">
          <div class="item_call">
            <i class="fa fa-map-marker" aria-hidden="true"></i>
            <!-- INI buaT Longnya  <?php echo $about[0]['long']; ?> -->
            <span><?=$content['about'][0]['contact_location'];?></span>
          </div>
        </div><!--end.cols2-->
        <div class="cols3">
          <div class="item_call">
            <i class="fa fa-envelope" aria-hidden="true"></i>
            <span><?=$content['about'][0]['contact_email'];?></span>
          </div>
        </div><!--end.cols2-->
        <div class="cols3">
          <div class="item_call">
            <i class="fa fa-fax" aria-hidden="true"></i>
            <span><?=$content['about'][0]['contact_phone'];?></span>
          </div>
        </div><!--end.cols2-->
        <div class="cols3">
          <div class="item_call">
            <i class="fa fa-phone" aria-hidden="true"></i>
            <span><?=$content['about'][0]['contact_fax'];?></span>
          </div>
        </div><!--end.cols2-->
        <div class="cols3">
          <div class="item_call">
            <i class="fa fa-link" aria-hidden="true"></i>
            <span><?=$content['about'][0]['contact_website'];?></span>
          </div>
        </div><!--end.cols2-->
      </div><!--end.row-list-->
    </div><!--end.wrapper-->
  </section>

  <section class="padSection">
    <div class="wrapper">
      <div class="justify_flex_beetween">
        <h3>DOWNLOAD ITPC BARCELONA OFFICIAL APP</h3>
        <div class="download_icon">
          <a href="<?=$download[0]['playstore'];?>">
              <img src="<?php echo $this->config->item('frontend'); ?>images/google_play.png">
          </a>
          <a href="<?=$download[0]['appstore'];?>">
              <img src="<?php echo $this->config->item('frontend'); ?>images/appstore.png">
          </a>
        </div><!--end.download_icon-->
      </div>
    </div>
  </section>

 </div>

<script>
$(document).ready(function() {

$("#contactForm").validate({
  submitHandler: function() {
      $(".register").prop( "disabled" );
      $(".register").html('<i class="fa fa-spinner fa-spin"></i> Loading');
      form.submit();
  }
});
</script>


