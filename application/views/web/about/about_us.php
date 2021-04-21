

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

      <!-- <div class="client_list">
        <div class="row-list">
        
                  <div class="cols6">
            <div class="item_client">
              <a href="https://www.kemendag.go.id/id">
              <img src="http://itpc_frontend.test/assets/website/exporter/logo-kemendag.png">
              </a>
            </div>
          </div>
                    <div class="cols6">
            <div class="item_client">
              <a href="http://djpen.kemendag.go.id/">
              <img src="http://itpc_frontend.test/assets/website/exporter/logo-dgned.png">
              </a>
            </div>
          </div>
                    <div class="cols6">
            <div class="item_client">
              <a href="http://embajadaindonesia.es/">
              <img src="http://itpc_frontend.test/assets/website/exporter/logo-kbri.png">
              </a>
            </div>
          </div>
                    <div class="cols6">
            <div class="item_client">
              <a href="http://www.bkpm.go.id/">
              <img src="http://itpc_frontend.test/assets/website/exporter/logo-bkpm.png">
              </a>
            </div>
          </div>
                    <div class="cols6">
            <div class="item_client">
              <a href="http://www.indonesia.travel/">
              <img src="http://itpc_frontend.test/assets/website/exporter/logo-wonderful-indonesia.png">
              </a>
            </div>
          </div>
                    <div class="cols6">
            <div class="item_client">
              <a href="http://www.kemlu.go.id/">
              <img src="http://itpc_frontend.test/assets/website/exporter/logo-kemenlu.png">
              </a>
            </div>
          </div>
                   
        </div>
      </div> -->


      <!-- <div class="padSection">
        <div class="text_detail">
          <div class="row-list">
            <div class="cols2">
              <div class="item_teks">
                <h3>Function</h3>
                <ul>
                  <li>Provide facility for Marketing of Indonesian export products and enhancement of the trade mission in the accredited countries</li>
                  <li>Provide facility for Development of the business contacts and cooperation between Indonesian business council and the business communities in the accredited countries (business matching)</li>
                  <li>Provide the business information and market opportunities in host countries and assist Indonesian business community about potential products in overseas markets</li>
                  <li>Provide the information services on the potential export products to the foreign buyers</li>
                  <li>Undertake the market analysis and improving business Intelligence and networking with business communities in host countries</li>
                  <li>Disseminating information to the Spanish  business communities;</li>
                  <li>Prepare the work program and budgets as well as administrative and financial duties corresponding to the existing regulation</li>
                </ul>
              </div>
            </div>
            <div class="cols2">
              <div class="item_images">
                <img src="<?php echo $this->config->item('frontend'); ?>images/half_banner.png">
              </div>
            </div>

            <div class="cols2">
              <div class="item_images">
                <img src="<?php echo $this->config->item('frontend'); ?>images/half_banner.png">
              </div>
            </div>
            <div class="cols2">
              <div class="item_teks">
                <h3>Mission</h3>
                <ul>
                  <li>Provide facility for Marketing of Indonesian export products and enhancement of the trade mission in the accredited countries</li>
                  <li>Provide facility for Development of the business contacts and cooperation between Indonesian business council and the business communities in the accredited countries (business matching)</li>
                  <li>Provide the business information and market opportunities in host countries and assist Indonesian business community about potential products in overseas markets</li>
                  <li>Provide the information services on the potential export products to the foreign buyers</li>
                  <li>Undertake the market analysis and improving business Intelligence and networking with business communities in host countries</li>
                  <li>Disseminating information to the Spanish  business communities;</li>
                  <li>Prepare the work program and budgets as well as administrative and financial duties corresponding to the existing regulation</li>
                </ul>
              </div>
            </div>


          </div>

        </div>
      </div>emd.padSection -->


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
