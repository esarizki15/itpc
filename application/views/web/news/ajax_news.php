<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
 <?php foreach($news['news'] as $item) {  ?>
            <div class="cols2">
              <div class="item_news">
                <div class="thumb_news">
                  <img class="object-fit" src="<?php echo $this->config->item('frontend'); ?>images/thumb_news1.png">
                </div>
                <div class="caption_news">
                  <span class="category">NEWS</span>
                  <h3><?php echo $item['title']; ?></h3>
                  <a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en' : $this->uri->segment(1)."/web_news_detail/".$item['slug']) ?>" class="readMore">Read more ></a>
                </div>
              </div>
            </div><!--end.cols2-->
 <?php } ?>