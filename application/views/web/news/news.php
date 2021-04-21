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
            <img src="<?php echo $this->config->item('frontend'); ?>images/inner_banner.png">
          </div>
          <div class="caption_banner">
            <h3>NEWS &<br/>EXHIBITIONS</h3>
          </div>
        </div>

      </div>
    </div>
  </section>


  <section id="news_inner" class="section padSection">
    <div class="wrapper">
      <div class="tab_row_menu">
        <a href="javascript:void(0)" class="tab_menu allberita">All</a>
        <a href="javascript:void(0)" class="tab_menu newsall">News</a>
        <a href="javascript:void(0)" class="tab_menu exhibition">Exhibition</a>
      </div>

      <div class="list_news tabnya" >
          <div class="row-list" id="posts-infinite">
          <?php foreach($news['news'] as $item) {  ?>
            <div class="cols2">
              <div class="item_news">
                <div class="thumb_news">
                  <img class="object-fit" src="<?php echo $this->config->item('frontend'); ?>images/thumb_news1.png">
                </div>
                <div class="caption_news">
                  <span class="category">NEWS</span>
                  <h3><?php echo $item['title']; ?></h3>
                  <a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en' : $this->uri->segment(1)."/news_detail") ?>" class="readMore">Read more ></a>
                </div>
              </div>
            </div>
            <?php } ?>
            
          </div>
          
          <div class="button_load">
          <div class="loader" style="margin: auto;width: 50%;"><img src="https://upload.wikimedia.org/wikipedia/commons/c/c7/Loading_2.gif" width="100" height="100"> </div>
          <a href="#" class="blue_button">SCROLL FOR MORE</a>
          </div>
        </div><!--end.list-news-->
    </div>
  </section>
</div>


<script type="text/javascript">
  
  
  winscroll(1);
  $(".allberita").click(function () {
    $('.tab_menu').removeClass('active');
    $(this).addClass('active');
    var basedomain= '<?=base_url()?>';
      $.ajax({
              url: basedomain+"en/web_news",
              type: "POST",
              data: "category=All",
              success: function (response) {
                var myArr = JSON.parse(response);
                var Str = "";
               
                $(myArr['news']).each(function( index ) {
                  Str=Str+"<div class='cols2'>";
                  Str=Str+'<div class="item_news">';
                  Str=Str+'<div class="thumb_news">';
                  Str=Str+'<img class="object-fit" src="<?php echo $this->config->item('frontend'); ?>images/thumb_news1.png">';
                  Str=Str+'</div>';
                  Str=Str+'<div class="caption_news">';
                  Str=Str+'<span class="category">NEWS</span>';
                  Str=Str+'<h3>'+myArr['news'][index]['title']+'</h3>';
                  Str=Str+'<a href="'+basedomain+'en/web_news_detail/'+myArr['news'][index]['slug']+'" class="readMore">Read more ></a>';
                  Str=Str+'</div>';
                  Str=Str+'</div>';
                  Str=Str+'</div>';
                });
           
                $('#posts-infinite').html(Str);
                winscroll(1);
              }
            })
  })

  $(".newsall").click(function () {
    $('.tab_menu').removeClass('active');
    $(this).addClass('active');
    var basedomain= '<?=base_url()?>';
      $.ajax({
              url: basedomain+"en/web_news",
              type: "POST",
              data: "category=All",
              success: function (response) {
                var myArr = JSON.parse(response);
                var Str = "";
               
                $(myArr['news']).each(function( index ) {
                  Str=Str+"<div class='cols2'>";
                  Str=Str+'<div class="item_news">';
                  Str=Str+'<div class="thumb_news">';
                  Str=Str+'<img class="object-fit" src="<?php echo $this->config->item('frontend'); ?>images/thumb_news1.png">';
                  Str=Str+'</div>';
                  Str=Str+'<div class="caption_news">';
                  Str=Str+'<span class="category">NEWS</span>';
                  Str=Str+'<h3>'+myArr['news'][index]['title']+'</h3>';
                  Str=Str+'<a href="'+basedomain+'en/web_news_detail/'+myArr['news'][index]['slug']+'" class="readMore">Read more ></a>';
                  Str=Str+'</div>';
                  Str=Str+'</div>';
                  Str=Str+'</div>';
                });
           
                $('#posts-infinite').html(Str);
                winscroll(1);
              }
            })
  })

  $(".exhibition").click(function () {
    $('.tab_menu').removeClass('active');
    $(this).addClass('active');
    var basedomain= '<?=base_url()?>';
      $.ajax({
              url: basedomain+"en/web_news",
              type: "POST",
              data: "category=All",
              success: function (response) {
                var myArr = JSON.parse(response);
                var Str = "";
               
                $(myArr['news']).each(function( index ) {
                  Str=Str+"<div class='cols2'>";
                  Str=Str+'<div class="item_news">';
                  Str=Str+'<div class="thumb_news">';
                  Str=Str+'<img class="object-fit" src="<?php echo $this->config->item('frontend'); ?>images/thumb_news1.png">';
                  Str=Str+'</div>';
                  Str=Str+'<div class="caption_news">';
                  Str=Str+'<span class="category">NEWS</span>';
                  Str=Str+'<h3>'+myArr['news'][index]['title']+'</h3>';
                  Str=Str+'<a href="'+basedomain+'en/web_news_detail/'+myArr['news'][index]['slug']+'" class="readMore">Read more ></a>';
                  Str=Str+'</div>';
                  Str=Str+'</div>';
                  Str=Str+'</div>';
                });
           
                $('#posts-infinite').html(Str);
                winscroll(1);
              }
            })
  })
  
    function winscroll(pagenya){
      var page =pagenya;
      var total_pages = <?php print $total_pages?>;
      $(window).scroll(function() {
          if($(window).scrollTop() + $(window).height() >= $(document).height()) {
              page++;
              if(page < total_pages) {
                  loadData(page);
              }else{
                  $('.button_load').hide();
              }
          }
      });
    }

    /*Load more Function*/
    function loadData(page) {
        $( ".loader" ).css( "display","block" );
        var basedomain= '<?=base_url()?>';
       
        $.ajax({
            method: "GET",
            url: basedomain+"en/web_news",
            data: { page: page }
        })
        .done(function( content ) {
            $( ".loader" ).css( "display","none" );
            $("#posts-infinite").append(content);

        });
    }



</script>