<!-- middle -->
<div id="middle-content" class="innerPage">
  <section id="bannerPages" class="section">
     <div class="doodle_dots">
      <img src="<?php echo $this->config->item('frontend'); ?>images/dots_banner.png">
    </div>
    <div class="offside_banner">
      <div class="banner_slider">
        <div class="item">
          <div class="images_banner">
            <img src="<?php echo $this->config->item('frontend'); ?>images/bg_indonesian_product.png">
          </div>
          <div class="caption_banner">
            <h3>Indonesian<br/>Product</h3>
          </div>
        </div>

      </div>
    </div>
  </section>


  <section id="news_inner" class="section padSection">
    <div class="wrapper">

      <div class="list_indonesian_product tabnya" >
          <div class="row-list">

            <?php foreach($indonesian_product as $item) { ?>
              <div class="cols4">
                <div class="item_product">
                  <div class="thumb_product">
                    <img src="<?php echo $this->config->item('website_assets').'indonesia_product/'.$item['thumbnail']; ?>">
                  </div>
                  <div class="caption_thumb">
                    <div class="module line-clamp">
                      <h3><?php echo $item['title']; ?></h3>
                    </div>
                    <a href="<?php echo $this->config->item('website_assets').'indonesia_product/'.$item['file']; ?>" target="_blank">View</a>
                  </div>
                </div><!--end.item_product-->
              </div><!--end.cols4-->
            <?php } ?>

            
          </div>
          
        </div><!--end.list-news-->
    </div>
  </section>
</div>


<script type="text/javascript">
  
</script>