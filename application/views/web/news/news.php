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
        <a href="javascript:void(0)" class="tab_menu allberita active">All</a>
        <?php foreach($tag as $item) {  ?>
          <a href="javascript:void(0)" class="tab_menu tabcategory"><input type="hidden" value="<?=$item['tag_id'];?>"> <?=$item['tag_title'];?></a>
        <?php } ?>
      </div>

      <div class="list_news tabnya" >
          <div class="row-list" id="posts-infinite">
          <?php foreach($news['news'] as $item) {  ?>
            <div class="cols2">
              <div class="item_news">
                <div class="thumb_news">
                <a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en'."/web_news_detail/".$item['slug'] : $this->uri->segment(1)."/web_news_detail/".$item['slug']) ?>">
                  <img class="object-fit" src="<?php echo $this->config->item('frontend'); ?>images/thumb_news1.png">
                </a>
                </div>
                <div class="caption_news">
                  <span class="category">NEWS</span>
                  <h3><a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en'."/web_news_detail/".$item['slug'] : $this->uri->segment(1)."/web_news_detail/".$item['slug']) ?>"><?php echo $item['title']; ?></a></h3>
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
  var param = '<?=$category;?>';
            
  winscroll(1,param);
  $(".allberita").click(function () {
    
    // var param='';
  
    $('#posts-infinite').html("");
    $('.tab_menu').removeClass('active');
    $(this).addClass('active');
    var basedomain= '<?=base_url()?>';
    param='All';
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
                  Str=Str+'<a href="'+basedomain+'en/web_news_detail/'+myArr['news'][index]['slug']+'">';
                  Str=Str+'<img class="object-fit" src="<?php echo $this->config->item('frontend'); ?>images/thumb_news1.png">';
                  Str=Str+'</a>';
                  Str=Str+'</div>';
                  Str=Str+'<div class="caption_news">';
                  Str=Str+'<span class="category">'+myArr['news'][index]['tag_title']+'</span>';
                  Str=Str+'<a href="'+basedomain+'en/web_news_detail/'+myArr['news'][index]['slug']+'">';
                  Str=Str+'<h3>'+myArr['news'][index]['title']+'</h3>';
                  Str=Str+'</a>';
                  Str=Str+'<a href="'+basedomain+'en/web_news_detail/'+myArr['news'][index]['slug']+'" class="readMore">Read more ></a>';
                  Str=Str+'</div>';
                  Str=Str+'</div>';
                  Str=Str+'</div>';
                });
           
                $('#posts-infinite').html(Str);
                winscroll(1,param);
                return false;
              }
            })
  })

  
  $(".tabcategory").click(function () {
    $('.tab_menu').removeClass('active');
    // var param='';
    $(this).addClass('active');
    var param=$(this).children().val();
    var basedomain= '<?=base_url()?>';
      $.ajax({
              url: basedomain+"en/web_news",
              type: "POST",
              data: "category="+param,
              success: function (response) {
                var myArr = JSON.parse(response);
                var Str = "";
               
                $(myArr['news']).each(function( index ) {
                  Str=Str+"<div class='cols2'>";
                  Str=Str+'<div class="item_news">';
                  Str=Str+'<div class="thumb_news">';
                  Str=Str+'<a href="'+basedomain+'en/web_news_detail/'+myArr['news'][index]['slug']+'">';
                  Str=Str+'<img class="object-fit" src="<?php echo $this->config->item('frontend'); ?>images/thumb_news1.png">';
                  Str=Str+'</a>';
                  Str=Str+'</div>';
                  Str=Str+'<div class="caption_news">';
                  Str=Str+'<span class="category">'+myArr['tag']+'</span>';
                  Str=Str+'<a href="'+basedomain+'en/web_news_detail/'+myArr['news'][index]['slug']+'">';
                  Str=Str+'<h3>'+myArr['news'][index]['title']+'</h3>';
                  Str=Str+'</a>';
                  Str=Str+'<a href="'+basedomain+'en/web_news_detail/'+myArr['news'][index]['slug']+'" class="readMore">Read more ></a>';
                  Str=Str+'</div>';
                  Str=Str+'</div>';
                  Str=Str+'</div>';
                });
           
                $('#posts-infinite').html(Str);
                winscroll(1,param);
              }
            })
  })
  
    function winscroll(pagenya,category){
      var page =pagenya;
      var total_pages = <?php print $total_pages?> ;
      $(window).scroll(function() {
        console.log('i', param);
       
          if($(window).scrollTop() + $(window).height() >= $(document).height()) {
              page++;
              console.log('page'+page +'total'+total_pages);
              if(page < total_pages) {
                
                  loadData(page,category);
              }else{
                  $('.button_load').hide();
              }
          }
      });
    }

    /*Load more Function*/
    function loadData(page,category) {
      console.log(category);
        var tabActive = $(".tabcategory.active");
        var newCategory = category == '' ? 'All' : category;
        if(tabActive.length != 0){
          newCategory = tabActive.children()[0].value;
        }
        $( ".loader" ).css( "display","block" );
        var basedomain= '<?=base_url()?>';
       
        $.ajax({
            method: "POST",
            url: basedomain+"en/web_news",
            data: { 'page':page,
                    'category':newCategory }
        })
        .done(function( response ) {
          $( ".loader" ).css( "display","none" );
          var myArr = JSON.parse(response);
          param = myArr['news']['category'];
                var Str = "";
               
                $(myArr['news']['news']).each(function( index ) {
                  Str=Str+"<div class='cols2'>";
                  Str=Str+'<div class="item_news">';
                  Str=Str+'<div class="thumb_news">';
                  Str=Str+'<a href="'+basedomain+'en/web_news_detail/'+myArr['news']['news'][index]['slug']+'">';
                  Str=Str+'<img class="object-fit" src="<?php echo $this->config->item('frontend'); ?>images/thumb_news1.png">';
                  Str=Str+'</a>';
                  Str=Str+'</div>';
                  Str=Str+'<div class="caption_news">';
                  Str=Str+'<span class="category">'+myArr['news']['news'][index]['tag_title']+'</span>';
                  Str=Str+'<a href="'+basedomain+'en/web_news_detail/'+myArr['news']['news'][index]['slug']+'">';
                  Str=Str+'<h3>'+myArr['news']['news'][index]['title']+'</h3>';
                  Str=Str+'</a>';
                  Str=Str+'<a href="'+basedomain+'en/web_news_detail/'+myArr['news']['news'][index]['slug']+'" class="readMore">Read more ></a>';
                  Str=Str+'</div>';
                  Str=Str+'</div>';
                  Str=Str+'</div>';
                });
           
                $('#posts-infinite').append(Str);
                return false;
                //winscroll(1,category);
           // $("#posts-infinite").append(content);

        });
    }



</script>