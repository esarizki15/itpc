<div id="middle-content" class="innerPage">
  <section id="main_thumb" class="section">
     <div class="doodle_dots">
      <img src="<?php echo $this->config->item('frontend'); ?>images/dots_banner.png">
    </div>
    <div class="wrapper">
      <div class="section_big_thumb">
      <img src="<?php echo $this->config->item('website_assets').'exporter/'.$exporter['data'][0]['exporter_logo']; ?>">
      </div>  
      <div class="title_big_blue">
        <h1><?php echo $exporter['data'][0]['exporter_name']?></h1>
      </div>
    </div><!--end.wrapper-->
  </section>
  <section id="detail_exporter" class="section padSection">
    <div class="wrapper">
      <div class="rows">
        <!-- <ul class="breadcrumb">
          <li><a href="#">Home</a></li>
          <li><a href="#">Trade With Indonesia</a></li>
          <li><a href="#">Company</a></li>
          <li>Furniture</li>
        </ul> -->
      </div><!--end.rows-->
      <div class="list_detail_exporter">
        <div class="left_detail_exporter">

          <div class="item_left_row">
            <div class="rows">
              <div class="title_blue_row">
                <h3>GALLERY</h3>
              </div>
              <div class="row-list">
              <?php foreach($product as $item){  ?>
                <div class="cols2">
             
                  <div class="item_gallery">
                    <a href="<?php echo $this->config->item('website_assets').'exporter_product/'.$item['ex_pro_image']; ?>" class="single_gallery">
                        <img src="<?php echo $this->config->item('website_assets').'exporter_product/'.$item['ex_pro_image']; ?>">
                    </a>
                  </div>
                </div><!--end.cols2-->
                <?php } ?>
                
              </div><!--end.row-list"-->
            </div><!--end.rows-->
            <div class="rows">
              <div class="title_blue_row">
                <h3>CATEGORY</h3>
              </div>
              <div class="label_link">
                <i class="fa fa-tags" aria-hidden="true"></i>
                <span><?php echo $exporter['data'][0]['category']['category_title']; ?></span>
              </div>
             
            </div><!--end.rows-->
          </div><!--end.item_left_row-->
        </div><!--end.left_detail_exporter-->
        <div class="right_detail_exporter">
          <div class="rows">
            <div class="title_blue_row">
              <h3>DESCRIPTION</h3>
            </div>
            <div class="description_exporter">
              <p><?php echo $exporter['data'][0]['exporter_address']?></p>
            </div>
          </div><!--end.rows-->
          <div class="rows">
            <div class="title_blue_row">
              <h3>COMPANY INFO</h3>
            </div>
            <div class="call_detail_exporter">
              <div class="row-list">
                <div class="cols2">
                  <div class="item_call">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    <span><?php echo $exporter['data'][0]['exporter_address']?></span>
                  </div>
                </div><!--end.cols2-->
                <div class="cols2">
                  <div class="item_call">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <span><?php echo $exporter['data'][0]['exporter_email']?></span>
                  </div>
                </div><!--end.cols2-->
                <div class="cols2">
                  <div class="item_call">
                    <i class="fa fa-fax" aria-hidden="true"></i>
                    <span><?php echo $exporter['data'][0]['exporter_phone']?></span>
                  </div>
                </div><!--end.cols2-->
                <div class="cols2">
                  <div class="item_call">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    <span><?php echo $exporter['data'][0]['exporter_office_phone']?></span>
                  </div>
                </div><!--end.cols2-->
                <div class="cols2">
                  <div class="item_call">
                    <i class="fa fa-link" aria-hidden="true"></i>
                    <span><?php echo $exporter['data'][0]['exporter_link']?></span>
                  </div>
                </div><!--end.cols2-->
              </div>
            </div>
          </div><!--end.rows-->
          <div class="share_row">
          <span>Share to </span>
          <div class="share_lnk">
            <a href="mailto:?subject=I wanted you to see this site&amp;body=Check out this site <?=urlencode(current_url())?>"  target="_blank"> <img src="<?php echo base_url('assets/frontend/images/share_email.png'); ?>"></a>
            <a href="https://twitter.com/intent/tweet?url=<?=urlencode(current_url())?>"  target="_blank"><img src="<?php echo base_url('assets/frontend/images/share_twitter.png'); ?>"></a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?=urlencode(current_url())?>" target="_blank"><img src="<?php echo base_url('assets/frontend/images/share_fb.png'); ?>"></a>
            <a href="https://twitter.com/intent/tweet?url=<?=urlencode(current_url())?>"  target="_blank"><img src="<?php echo base_url('assets/frontend/images/share_wa.png'); ?>"></a>
          </div>
        </div>
        </div><!--end.right_detail_exporter-->
      </div><!--end.list_detail_exporter-->
    </div><!--end.wrapper-->
  </section>
</div>

<script type="text/javascript">
$(document).ready(function() {
  $(".single_gallery").fancybox({
        helpers: {
            title : {
                type : 'float'
            }
        }
    });
});
</script>