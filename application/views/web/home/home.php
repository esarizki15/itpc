<!-- middle -->
<div id="middle-content" class="homePage">
  <?php if(count($slider) > 1): ?>
  <section id="home_banner" class="section">
    <div class="doodle_dots">
      <img src="<?php echo $this->config->item('frontend'); ?>images/dots_banner.png">
    </div>
    <div class="offside_banner">
      <div class="banner_slider">
        <div class="owl-carousel_banner owl-carousel owl-theme">
        <?php foreach($slider as $data): ?>
          <div class="item">
            <div class="images_banner">
              <img src="<?= $this->config->item('website_assets') . "slider/" . $data["file_patch"]; ?>">
            </div>
            <div class="caption_banner">
              <h3>WELCOME TO ITPC BARCELONA</h3>
              <p>Lorem Ipsum Dolor Sit Amet</p>
              <a target="_blank" href="<?= $data["link"] ?>" class="bt_banner">Learn More</a>
            </div>
          </div>
        <?php endforeach;?>
        </div>
      </div>
      <div class="client_list">
        <div class="row-list">
        
        <?php foreach($useful_link as $useful) { ?>
          <div class="cols6">
            <div class="item_client">
              <a target="_blank" href="<?php echo $useful['link']; ?>">
              <img src="<?php echo $useful['logo']; ?>"   />
              </a>
            </div>
          </div><!--end.cols6-->
          <?php } ?>
         
        </div>
      </div>
    </div>
  </section>
  <?php endif; ?>
  <section id="product_home" class="section">
    <div class="title_section">
      <h3>Indonesian<br/>Product</h3>
    </div>

      <div class="product_carousel owl-carousel owl-theme">
       
       <?php foreach($indonesia_product as $item) { ?>
        <div class="item">
          <div class="item_product">
            <a href="<?php echo $item['file']; ?>" target="_blank">
              <div class="thumb_product">
              <img src="<?php echo $item['thumbnail']; ?>"   />
              </div>
              <div class="caption_product">
                <p><?php echo $item['title']; ?></p>
              </div>
            </a>
          </div>
        </div><!--end.item-->
      <?php } ?>
       

        </div>
        
  </section>


  <section id="exporter_home" class="section padSection">
      <div class="wrapper">
        <div class="title_section_left">
          <h3>Exporters</h3>
          <a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en'."/web_index_exporter": $this->uri->segment(1)."/web_index_exporter") ?>" class="viewAll">View All</a>
        </div>
      </div>
      
      <div class="exporter_carousel owl-carousel owl-theme">
      <?php foreach($exporter_home as $item) { ?>
        <div class="item">
          <div class="item_exporter">
            <a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en'."/web_index_exporter_detail/".$item['id']: $this->uri->segment(1)."/web_index_exporter_detail/".$item['id']) ?>">
              <img src="<?php echo $item['logo']; ?>" width="200" height="40"  />
            </a>
          </div>
        </div>
      <?php } ?>
     
      </div>

  </section>

  <section id="news_home" class="section padSection">
      <div class="wrapper">
        <div class="title_section_left">
          <h3>Lates News</h3>
          <a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en/web_news' : $this->uri->segment(1)."/web_news") ?>" class="viewAll">View All</a>
        </div>
        <div class="list_news">
          <div class="row-list">

          <?php foreach($news_latest as $item) { ?>
            <div class="cols2">
              <div class="item_news">
                <div class="thumb_news">
                <a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en'."/web_news_detail/".$item['slug'] : $this->uri->segment(1)."/web_news_detail/".$item['slug']) ?>">
                  <img class="object-fit" src="<?php echo $item['thumbnail']; ?>">
                </a>
                </div>
                <div class="caption_news">
                  <span class="category">News</span>
                  <h3 class="line-clamp"><a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en'."/web_news_detail/".$item['slug'] : $this->uri->segment(1)."/web_news_detail/".$item['slug']) ?>"><?php echo $item['title'];?></a></h3>
                  <a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en'."/web_news_detail/".$item['slug'] : $this->uri->segment(1)."/web_news_detail/".$item['slug']) ?>" class="readMore">Read more ></a>
                </div>
              </div>
            </div><!--end.cols2-->

            <?php } ?>
            
          </div>
        </div>
      </div>


  </section>
</div>
<!-- end of middle -->

<script type="text/javascript">

$(document).ready(function() {

  $('.owl-carousel_banner').owlCarousel({
    center: true,
    loop:true,
    autoplay:false,
    autoplayTimeout:5000,
    nav:false,
  });

  $('.product_carousel').owlCarousel({
    center: true,
    loop:true,
    autoplay:false,
    autoplayTimeout:5000,
    nav:false,
    responsive:{
        0:{
            items:1,
          stagePadding: 50,
            margin:5
          },
          600:{
              items:3,
              margin:25,
              stagePadding:60,
          },
          1000:{
              items:3,
              margin:55,
              stagePadding:250,
          }
    }
  });

  $('.exporter_carousel').owlCarousel({
    center: true,
    loop:true,
    autoplay:false,
    autoWidth:false,
    autoplayTimeout:5000,
    nav:false,
    pagination: false,
    responsive:{
        0:{
            items:1,
            stagePadding: 50,
            margin:5
          },
          600:{
              items:5,
              stagePadding: 10,
              margin:60
          },
          1000:{
              items:5,
              margin:10,
              stagePadding:20,
          }
    }
  });
});


</script>