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
  
var start = parseInt('<?=$start?>');
var page = parseInt('<?=$page?>');
winscroll(start);
function winscroll(start,category){
  $(window).scroll(function() {
    var currentPage = page - 1;
      if($(window).scrollTop() + $(window).height() >= $(document).height()) {
          console.log(start);
          console.log(page);
          if(currentPage < page) {
            loadData(page,category);
            // page = page + 1
          }
      }
  });
}
/*Load more Function*/
function loadData(page,category) {
    var basedomain= '<?=base_url()?>';
    $.ajax({
        dataType: "json",
        type: "GET",
        url: basedomain+"en/web_indonesian_product",
        data: { 'start':start,
                'page' : page += 1
               }
    })
    .done(function( response ) {
      console.log(response['indonesian_product']);
      page = response["page"];
      start = response["start"];
      var Str = "";
      var myArr=response['indonesian_product'];
        $(myArr).each(function( index ) {
          console.log(myArr[index]['thumbnail']);
          if(myArr[index] !== null){
              Str=Str+'<div class="cols4">';
              Str=Str+'<div class="item_product">';
              Str=Str+'<div class="thumb_product">';
              Str=Str+'<img src="<?php echo $this->config->item('website_assets').'indonesia_product/'; ?>'+ myArr[index]['thumbnail'] +'">';
              Str=Str+'</div>';
              Str=Str+'<div class="caption_thumb">';
              Str=Str+'<div class="module line-clamp">';
              Str=Str+'<h3>'+ myArr[index]['title'] +'</h3>';
              Str=Str+'</div>';
              Str=Str+'<a href="<?php echo $this->config->item('website_assets').'indonesia_product/'; ?>'+ myArr[index]['file'] +'" target="_blank">View</a>';
              Str=Str+'</div>';
              Str=Str+'</div>';
              Str=Str+'</div>';
          }
        });
        $('.row-list').append(Str);
    });
}
</script>