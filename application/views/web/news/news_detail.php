<?php foreach($news_detail as $item) { ?>

<div id="middle-content" class="innerPage">
  <section id="bannerPages" class="section">
     <div class="doodle_dots">
      <img src="<?php echo $this->config->item('frontend'); ?>images/dots_banner.png">
    </div>
    <div class="offside_banner">
      <div class="banner_slider">
        <div class="item item_detail_news">
          <div class="images_banner">
            <img src="<?php echo $this->config->item('frontend'); ?>images/news_detail.png">
          </div>
          <div class="caption_banner news_detail">
          	<span class="category">News</span>
            <h3><?php echo $item['title'];?></h3>
          </div>
        </div>

      </div>
    </div>
  </section>

  <section id="detail_news" class="section padSection">
  	<div class="wrapper">
  		<div class="content_news">
  			<span class="published"><?php echo $item['date'];?></span>
  			<div class="isi_news">
  				<p> <?php echo $item['long'];?> </p>
  			</div>
  			<div class="share_row">
  				<span>Share to</span>
  				<div class="share_lnk">
  					<a href="mailto:?Subject=<?php echo $item['title'];?>s&Body=<?php echo base_url("".$this->uri->segment(1) == '' ? 'en'."/web_news_detail/".$item['slug'] : $this->uri->segment(1)."/web_news_detail/".$item['slug']) ?>"><img src="<?php echo $this->config->item('frontend'); ?>images/share_email.png"></a>
  					<a href="https://twitter.com/share?url=<?php echo base_url("".$this->uri->segment(1) == '' ? 'en'."/web_news_detail/".$item['slug'] : $this->uri->segment(1)."/web_news_detail/".$item['slug']) ?>"><img src="<?php echo $this->config->item('frontend'); ?>images/share_twitter.png"></a>
  					<a href="http://www.facebook.com/sharer.php?u=<?php echo base_url("".$this->uri->segment(1) == '' ? 'en'."/web_news_detail/".$item['slug'] : $this->uri->segment(1)."/web_news_detail/".$item['slug']) ?>"><img src="<?php echo $this->config->item('frontend'); ?>images/share_fb.png"></a>
  					<a href="whatsapp://send?text=<?php echo base_url("".$this->uri->segment(1) == '' ? 'en'."/web_news_detail/".$item['slug'] : $this->uri->segment(1)."/web_news_detail/".$item['slug']) ?>"><img src="<?php echo $this->config->item('frontend'); ?>images/share_wa.png"></a>
  				</div>
  			</div>
  		</div>
  	</div>
  </section>

 </div>

 <?php } ?>