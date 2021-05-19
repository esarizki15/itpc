<!-- middle -->
<div id="middle-content" class="homePage">
  <section id="top_search" class="section">
    <div class="doodle_dots">
      <img src="<?php echo $this->config->item('frontend'); ?>images/dots_banner.png">
    </div>

    <div class="wrapper">
      <div class="title_search">
        <h1>SEARCH RESULT</h1>
        <h3>IS THIS WHAT YOU’RE LOOKING FOR?</h3>
      </div>
      <div class="rows input_search_inner">
        <div class="input_search_row">
          <input type="text" class="search_inner_input search" name="search" value="<?=$param?>" />
          <input type="hidden" value="<?=$language?>" class="language"/>
        </div>
        <p>Search result of <?=$param?></p>
      </div>
    </div>
  </section>
  
  <section id="no-result_search" class="section padSection text-center" style="display: none;">
    <div class="wrapper">
      <div class="title_no_search">
        <h1 style="margin:0;">Apologies, </h1>
        <p>But no post could be found matching your criteria.</p>
      </div>
      <div class="img_no_result">
      <img src="<?php echo $this->config->item('frontend'); ?>images/no-search.png">
      </div>
    </div>
  </section>  

  <section id="exporter_search" class="section padSection">
    <div class="wrapper">
      <div class="black_title text-center">
        <h3>Exporter</h3>
      </div>
      <div class="list_inner">
        <div class="list_exporter_search res_exporter">
          
        </div>
      </div>
    </div>
  </section>

  

  <section id="exporter_category_search" class="section padSection ">
    <div class="wrapper top_border">
      <div class="black_title text-center">
        <h3>News & Exhibitions</h3>
      </div>
      <div class="list_inner">
        <div class="list_news_search">
          <div class="row-list res_news">
          </div>
        </div>
      </div>
    </div>
  </section>
</div>


<script type="text/javascript">

SearchForNews();
SearchForProduct();

function SearchForNews(){
        var search = $('.search').val();
        var lang = $('.language').val();
        var basedomain= '<?=base_url()?>';
         $.ajax({
            url: basedomain+"API/search_news",
            type: "POST",
            data:  {keyword: search, page: 0,language:lang},
            success: function (response) {
              var myArr = JSON.parse(response);
              var Str = "";
           
               
               $(myArr).each(function( index ) {
                 console.log(myArr[index]['news_title']);

                  Str=Str+'<div class="cols1">';
                  Str=Str+'<div class="item_news">';
                  Str=Str+'<div class="thumb_news">';
                  Str=Str+'<img class="object-fit" src="'+myArr[index]['news_thumbnail']+'">';
                  Str=Str+'</div>';
                  Str=Str+'<div class="caption_news">';
                  Str=Str+'<span class="category">'+myArr[index]['tag_title']+'</span>';
                  Str=Str+'<h3 class="line-clamp">'+myArr[index]['news_title']+'</h3>';
                  Str=Str+'<a href="http://itpc_frontend.test/en/web_news_detail/sadsadasqwert2" class="readMore">Read more &gt;</a>';
                  Str=Str+'</div>';
                  Str=Str+'</div>';
                  Str=Str+'</div>';
                  });
           
           $('.res_news').append(Str);
        
            },
        });
 
}

function SearchForProduct(){
        var search = $('.search').val();
        var lang = $('.language').val();
        var basedomain= '<?=base_url()?>';
         $.ajax({
            url: basedomain+"API/search_indonesia_product",
            type: "POST",
            data:  {keyword: search, page: 0,language:lang},
            success: function (response) {
              var myArr = JSON.parse(response);
              var Str = "";
              $(myArr).each(function( index ) {
                Str=Str+'<div class="item_exporter">';
                Str=Str+'<a href="#">';
                Str=Str+'<img src="'+myArr[index]['thumbnail']+'">';
                Str=Str+'</a>';
                Str=Str+'</div>';
              });
              $('.res_exporter').append(Str);

            },
        });
 
}


</script>