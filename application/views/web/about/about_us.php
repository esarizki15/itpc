

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
            <h3>ABOUT<br/>US</h3>
          </div>
        </div>

      </div>
    </div>
  </section>

  <section id="detail_about" class="section padSection">
  	<div class="wrapper">
      <div class="padSection">
        <div class="text_detail">

        <?php foreach($about as $item) { ?>
          <h3><?=$item['short']?></h3>
          <?=$item['long']?>
        <?php } ?>
        </div>
      </div><!--end.padSection-->


      <div class="padSection">
        <div class="justify_flex_beetween">
          <h3>DOWNLOAD ITPC BARCELONA OFFICIAL APP</h3>
          <div class="download_icon">
            <a href="#">
                <img src="<?php echo $this->config->item('frontend'); ?>images/google_play.png">
            </a>
            <a href="#">
                <img src="<?php echo $this->config->item('frontend'); ?>images/appstore.png">
            </a>
          </div><!--end.download_icon-->
        </div>
      </div><!--emd.padSection-->

    </div>
  </section>

 </div>
