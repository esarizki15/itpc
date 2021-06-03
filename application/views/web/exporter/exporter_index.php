<div id="exporter-content" class="innerPage">
  <section id="top-exporter-list" class="section">
    <div class="wrapper">
      <div class="title_top_exporter">
        <h3>Trade with<br/>Indonesia</h3>
        <p>Search & Find Indonesian exporter for your business</p>
      </div><!--end.title_top_exporter-->
      <!-- <form method="get" action="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en'."/web_exporter_search_result" : $this->uri->segment(1)."/web_exporter_search_result") ?>"> -->
        <div class="row_input_filter">
          <div class="input_big_text">
            <div class="group_no_line">
              <label>Exporter Name</label>
              <input type="text" class="input_exporter exporter_name" name="name" placeholder="Ex. Category">
            </div>
          </div>

          <div class="input_small_text">
            <div class="group_no_line">
              <label>Category</label>
              <div class="custom_select field">
                <select name="categoryId" id="category_atas" required>
                  <option selected disabled value="0">-- Pilih Category --</option>
                  <?php foreach($category as $itemcat){ ?> 
                          <option value="<?=$itemcat['id']?>" catTitle="<?=$itemcat['title']?>"><?=$itemcat['title']?></option>
                        <?php } ?> 
                </select>
              </div>
            </div>
          </div><!--end.input_big_text-->
          <button href="javascript:void(0)" class="orange_big searchexporter">Search</button>
        </div><!--end,row_input_filter-->
      <!-- </form> -->
    </div><!--end,wrapper-->
  </section>

  <section id="bottom-exporter-list" class="section padSection">
    <div class="wrapper">
      <div class="inner_exporter_list">
        <div class="top-white-box">
          <div class="blue_title">
            <h3>How It Works</h3>
          </div>
          <div class="row-list">
            <div class="cols3">
              <div class="item_how_to">
                <div class="icon_howto">
                  <img src="<?php echo $this->config->item('frontend'); ?>images/icon_search_for_exporter.png">
                </div>
                <div class="caption_howto">
                  <h4>1.Search for Exporter</h4>
                  <p>Temukan exporter produk yang Anda butuhkan. </p>
                </div>
              </div>
            </div><!--end.cols3-->
            <div class="cols3">
              <div class="item_how_to">
                <div class="icon_howto">
                  <img src="<?php echo $this->config->item('frontend'); ?>images/icon_check_list.png">
                </div>
                <div class="caption_howto">
                  <h4>2. Contact Us</h4>
                  <p>Hubungi kami dan buat inquiry. Selanjutnya kami akan menghubungkanmu dengan exporter Indonesia</p>
                </div>
              </div>
            </div><!--end.cols3-->
            <div class="cols3">
              <div class="item_how_to">
                <div class="icon_howto">
                  <img src="<?php echo $this->config->item('frontend'); ?>images/icon-trading.png">
                </div>
                <div class="caption_howto">
                  <h4>3. Start Trading</h4>
                  <p>Mulai berdagang dengan exporter dari Indonesia</p>
                </div>
              </div>
            </div><!--end.cols3-->


          </div>
        </div><!--end.top-white-box-->

        <div class="list_bottom_exporter">
          <div class="left_content_exporter">
            <div class="item_left_content">
              <h3>Filter</h3>
              <div class="row_filter">
                <label class="title_row">Select Category</label>
                <div class="custom_select field">
                    <select name="category" id="category" class="catbawah">
                      <option selected disabled value="0">Category</option>
                      <?php foreach($category as $itemcat){ ?> 
                        <option value="<?=$itemcat['id']?>" catTitle="<?=$itemcat['title']?>"><?=$itemcat['title']?></option>
                      <?php } ?> 
                    </select>
                </div>
              </div><!--end.row_filter--> 
              <div class="row_filter">
                <label class="title_row">Select Sub Category</label>
                <div class="custom_select field">
                <select name="subcategory" id="subcategory" class="subcatbawah">
                          <option selected disabled value="0">Sub Category</option>
                </select>
                </div>
              </div><!--end.row_filter-->
              <div class="row_filter">
                <label class="title_row">Sort Category</label>
                <div class="sort_by_Radio">
                 <label class="radio_container">Newest First
                   <input type="radio" checked="checked" name="radio" value="newor" class="pilihan">
                    <span class="checkmark"></span>
                  </label>
                  <label class="radio_container">Oldest First
                    <input type="radio" name="radio" value="oldor" class="pilihan">
                    <span class="checkmark"></span>
                  </label>
                  <label class="radio_container">By Title
                    <input type="radio" name="radio" value="titor" class="pilihan" >
                    <span class="checkmark" ></span>
                  </label>
                </div><!--end.row_filter-->
              </div>
            </div><!--end.item_left_content-->
          </div><!--end.list_bottom_exporter-->

          <div class="right_content_exporter">
            <div class="item_list_exporternya">
              <div class="row_list_exporternya">

                <?php foreach($exporter['it_ex'] as $item) {  ?>
                <div class="top_row_list_exporter">
                  <div class="thumb_list_exporter">
                    <img src="<?php echo $this->config->item('website_assets').'exporter_product/'.$item['imagenya']; ?>">
                  </div><!--en.dthumb_list_exporter-->
                  <div class="caption_list_exporter">
                    <h3><?=$item['exporter_name']; ?></h3>
                    <p><?=$item['exporter_address']; ?></p>
                    <div class="label_link">
                      <i class="fa fa-tags" aria-hidden="true"></i>
                      <span> 
                      <?php
                        echo $item['category']['category_title'];
                        ?></span>
                    </div>
                  </div>
                </div><!--end.top_row_list_exporter-->
                <div class="bottom_row_list_exporter">
                  <div class="link_exporter">
                    <div class="item_call">
                      <i class="fa fa-phone" aria-hidden="true"></i>
                      <span><?=$item['exporter_phone'];?></span>
                    </div>
                    <div class="item_call">
                      <i class="fa fa-link" aria-hidden="true"></i>
                      <span><?=$item['exporter_link']; ?></span>
                    </div>
                  </div>
                  <a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en'."/web_index_exporter_detail/".$item['exporter_slug']: $this->uri->segment(1)."/web_index_exporter_detail/".$item['exporter_slug']) ?>" class="see_detail">DETAILS ></a>
                </div><!--end.bottom_row_list_exporter-->
        
              <?php } ?>

              </div><!--end.row_list_exporternya-->
              

            </div><!--end.item_list_exporternya-->

        </div>
      </div>
    </div><!--end.wrapper-->
  </section>

 </div>

 <script>
var start = parseInt('<?=$start?>');
var page = parseInt('<?=$page?>');
winscroll(start);
TreeCat();
search();
sortcategory();
SortOrder();

function TreeCat(){
    $('#category').on("change",function () {
        var categoryId = $(this).find('option:selected').val();
        var basedomain= '<?=base_url()?>';
       
        $.ajax({
            url: basedomain+"en/web_add_category",
            type: "POST",
            data: "categoryId="+categoryId,
            success: function (response) {
              var myArr = JSON.parse(response);
              var Str = "";
              Str=Str+ "<option selected disabled value='0'>Sub Category</option>";
              $(myArr).each(function( index ) {
                Str=Str+ "  <option value='"+myArr[index]['id']+"' title='"+myArr[index]['title'] +"'>"+myArr[index]['title'] + "</option>";
              });
              $('#subcategory').html(Str);
              search();
              sortcategory();
              SortOrder();

            },
        });
    }); 
}
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
    var categoryId = "";
        if($('.catbawah').find('option:selected').val() !== 0){
            var categoryId = $('.catbawah').find('option:selected').val();
        }
    var subcategory=$('.subcatbawah').find('option:selected').val();
      console.log("categoryId = ", categoryId);
      console.log("subCategory = ", subcategory);
    $.ajax({
        dataType: "json",
        type: "GET",
        url: basedomain+"en/web_index_exporter",
        data: { 'start':start,
                'page' : page += 1,
                'categoryId':categoryId,
                'subCategory':subcategory,
               }
    })
    .done(function( response ) {
      page = response["page"];
      start = response["start"];
      // var myArr = JSON.parse(response);
      // param = myArr['news']['category'];
            var Str = "";
            var myArr=response['exporter']['it_ex'];
              $(myArr).each(function( index ) {
                var categoryName = "";
                if(myArr[index]["category"] != undefined){
                  categoryName = myArr[index]["category"]["category_title"];
                }
                if(myArr[index] !== null){
                    Str=Str+'<div class="top_row_list_exporter">';
                    Str=Str+'<div class="thumb_list_exporter">';
                    Str=Str+'<img src="<?php echo $this->config->item('website_assets')."exporter_product/"; ?>'+myArr[index]["imagenya"]+'">';
                    Str=Str+'</div>';
                    Str=Str+'<div class="caption_list_exporter">';
                    Str=Str+'<h3>'+myArr[index]["exporter_name"]+'</h3>';
                    Str=Str+'<p>'+myArr[index]["exporter_address"]+'</p> ';
                    Str=Str+'<div class="label_link"> ';
                    Str=Str+'<i class="fa fa-tags" aria-hidden="true"></i> ';
                    Str=Str+'<span>'+categoryName+'</span> ';
                    Str=Str+'</div> ';
                    Str=Str+'</div> ';
                    Str=Str+'</div>';
                    Str=Str+'<div class="bottom_row_list_exporter"> ';
                    Str=Str+'<div class="link_exporter"> ';
                    Str=Str+'<div class="item_call"> ';
                    Str=Str+'<i class="fa fa-phone" aria-hidden="true"></i> ';
                    Str=Str+'<span>'+myArr[index]["exporter_phone"]+'</span> ';
                    Str=Str+'</div> ';
                    Str=Str+'<div class="item_call"> ';
                    Str=Str+'<i class="fa fa-link" aria-hidden="true"></i> ';
                    Str=Str+'<span>'+myArr[index]["exporter_link"]+'</span> ';
                    Str=Str+'</div> ';
                    Str=Str+'</div> ';
                    Str=Str+'<a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en'."/web_index_exporter_detail/" : $this->uri->segment(1)."/web_index_exporter_detail/") ?>'+myArr[index]["exporter_slug"]+'" class="see_detail">DETAILS ></a> ';
                    Str=Str+'</div> ';
                }
               });
              //  $(".row_list_exporternya").attr("tabindex",-1).focus();
               $('.row_list_exporternya').append(Str);
    });
}
function search(){
  $('.searchexporter').on("click",function () {
        var categoryId = "";
        if($('#category_atas').find('option:selected').val() !== 0){
            var categoryId = $('#category_atas').find('option:selected').val();
        }
        var ExName = $('.exporter_name').val();
        var basedomain= '<?=base_url()?>';

        $.ajax({
            url: basedomain+"en/web_exporter_search_result",
            type: "GET",
            data: {name:ExName,categoryId:categoryId},
            success: function (response) {
              var myArr = JSON.parse(response);
              myArr=myArr['exporter']['data'];
              var Str = "";
              $(myArr).each(function( index ) {
      
                if(myArr[index] !== null){
                    Str=Str+'<div class="top_row_list_exporter">';
                    Str=Str+'<div class="thumb_list_exporter">';
                    Str=Str+'<img src="<?php echo $this->config->item('website_assets')."exporter_product/"; ?>'+myArr[index]["imagenya"]+'">';
                    Str=Str+'</div>';
                    Str=Str+'<div class="caption_list_exporter">';
                    Str=Str+'<h3>'+myArr[index]["exporter_name"]+'</h3>';
                    Str=Str+'<p>'+myArr[index]["exporter_address"]+'</p> ';
                    Str=Str+'<div class="label_link"> ';
                    Str=Str+'<i class="fa fa-tags" aria-hidden="true"></i> ';
                    Str=Str+'<span>'+myArr[index]["category"]["category_title"]+'</span> ';
                    Str=Str+'</div> ';
                    Str=Str+'</div> ';
                    Str=Str+'</div>';
                    Str=Str+'<div class="bottom_row_list_exporter"> ';
                    Str=Str+'<div class="link_exporter"> ';
                    Str=Str+'<div class="item_call"> ';
                    Str=Str+'<i class="fa fa-phone" aria-hidden="true"></i> ';
                    Str=Str+'<span>'+myArr[index]["exporter_phone"]+'</span> ';
                    Str=Str+'</div> ';
                    Str=Str+'<div class="item_call"> ';
                    Str=Str+'<i class="fa fa-link" aria-hidden="true"></i> ';
                    Str=Str+'<span>'+myArr[index]["exporter_link"]+'</span> ';
                    Str=Str+'</div> ';
                    Str=Str+'</div> ';
                    Str=Str+'<a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en'."/web_index_exporter_detail/" : $this->uri->segment(1)."/web_index_exporter_detail/") ?>'+myArr[index]["exporter_slug"]+'" class="see_detail">DETAILS ></a> ';
                    Str=Str+'</div> ';
                }
               });
               $(".row_list_exporternya").attr("tabindex",-1).focus();
               $('.row_list_exporternya').html(Str);
                TreeCat();
                sortcategory();
                SortOrder();
            }
          })
  });
}


function sortcategory(){
  $('.catbawah').on("change",function () {
        var categoryId = "";
        if($('.catbawah').find('option:selected').val() !== 0){
            var categoryId = $('.catbawah').find('option:selected').val();
        }
   
        var basedomain= '<?=base_url()?>';
      
        $.ajax({
            url: basedomain+"en/web_exporter_search_result",
            type: "GET",
            data: {categoryId:categoryId},
            success: function (response) {
              var myArr = JSON.parse(response);
              myArr=myArr['exporter']['data'];
              var Str = "";
              $(myArr).each(function( index ) {
    
                if(myArr[index] !== null){
                    Str=Str+'<div class="top_row_list_exporter">';
                    Str=Str+'<div class="thumb_list_exporter">';
                    Str=Str+'<img src="<?php echo $this->config->item('website_assets')."exporter_product/"; ?>'+myArr[index]["imagenya"]+'">';
                    Str=Str+'</div>';
                    Str=Str+'<div class="caption_list_exporter">';
                    Str=Str+'<h3>'+myArr[index]["exporter_name"]+'</h3>';
                    Str=Str+'<p>'+myArr[index]["exporter_address"]+'</p> ';
                    Str=Str+'<div class="label_link"> ';
                    Str=Str+'<i class="fa fa-tags" aria-hidden="true"></i> ';
                    Str=Str+'<span>'+myArr[index]["category"]["category_title"]+'</span> ';
                    Str=Str+'</div> ';
                    Str=Str+'</div> ';
                    Str=Str+'</div>';
                    Str=Str+'<div class="bottom_row_list_exporter"> ';
                    Str=Str+'<div class="link_exporter"> ';
                    Str=Str+'<div class="item_call"> ';
                    Str=Str+'<i class="fa fa-phone" aria-hidden="true"></i> ';
                    Str=Str+'<span>'+myArr[index]["exporter_phone"]+'</span> ';
                    Str=Str+'</div> ';
                    Str=Str+'<div class="item_call"> ';
                    Str=Str+'<i class="fa fa-link" aria-hidden="true"></i> ';
                    Str=Str+'<span>'+myArr[index]["exporter_link"]+'</span> ';
                    Str=Str+'</div> ';
                    Str=Str+'</div> ';
                    Str=Str+'<a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en'."/web_index_exporter_detail" : $this->uri->segment(1)."/web_index_exporter_detail") ?>'+myArr[index]["exporter_slug"]+'" class="see_detail">DETAILS ></a> ';
                    Str=Str+'</div> ';
                }
               });
               $(".row_list_exporternya").attr("tabindex",-1).focus();
               $('.row_list_exporternya').html(Str);
                TreeCat();
                search();
                SortOrder();
            }
          })
  });
 
}

function filtersubcategory(){
  $('.subcatbawah').on("change",function () {
        var categoryId = "";
        if($('.catbawah').find('option:selected').val() !== 0){
            var categoryId = $('.catbawah').find('option:selected').val();
        }
        var subcategory=$(this).find('option:selected').val();
   
        var basedomain= '<?=base_url()?>';
      
        $.ajax({
            url: basedomain+"en/web_exporter_search_result",
            type: "GET",
            data: {categoryId:categoryId,subcategoryId:subcategory},
            success: function (response) {
              var myArr = JSON.parse(response);
              myArr=myArr['exporter']['data'];
              var Str = "";
              $(myArr).each(function( index ) {
    
                if(myArr[index] !== null){
                    Str=Str+'<div class="top_row_list_exporter">';
                    Str=Str+'<div class="thumb_list_exporter">';
                    Str=Str+'<img src="<?php echo $this->config->item('website_assets')."exporter_product/"; ?>'+myArr[index]["imagenya"]+'">';
                    Str=Str+'</div>';
                    Str=Str+'<div class="caption_list_exporter">';
                    Str=Str+'<h3>'+myArr[index]["exporter_name"]+'</h3>';
                    Str=Str+'<p>'+myArr[index]["exporter_address"]+'</p> ';
                    Str=Str+'<div class="label_link"> ';
                    Str=Str+'<i class="fa fa-tags" aria-hidden="true"></i> ';
                    Str=Str+'<span>'+myArr[index]["category"]["category_title"]+'</span> ';
                    Str=Str+'</div> ';
                    Str=Str+'</div> ';
                    Str=Str+'</div>';
                    Str=Str+'<div class="bottom_row_list_exporter"> ';
                    Str=Str+'<div class="link_exporter"> ';
                    Str=Str+'<div class="item_call"> ';
                    Str=Str+'<i class="fa fa-phone" aria-hidden="true"></i> ';
                    Str=Str+'<span>'+myArr[index]["exporter_phone"]+'</span> ';
                    Str=Str+'</div> ';
                    Str=Str+'<div class="item_call"> ';
                    Str=Str+'<i class="fa fa-link" aria-hidden="true"></i> ';
                    Str=Str+'<span>'+myArr[index]["exporter_link"]+'</span> ';
                    Str=Str+'</div> ';
                    Str=Str+'</div> ';
                    Str=Str+'<a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en'."/web_index_exporter_detail" : $this->uri->segment(1)."/web_index_exporter_detail") ?>'+myArr[index]["exporter_slug"]+'" class="see_detail">DETAILS ></a> ';
                    Str=Str+'</div> ';
                }
               });
               $(".row_list_exporternya").attr("tabindex",-1).focus();
               $('.row_list_exporternya').html(Str);
                TreeCat();
                search();
                sortcategory();
                SortOrder();
            }
          })
  });
 
}


function SortOrder(){
  
  $('.pilihan').on("change",function () {
        var categoryId = "";
        if($('.catbawah').find('option:selected').val() !== 0){
            var categoryId = $('.catbawah').find('option:selected').val();
        }
        var order =$(this).val();
        var basedomain= '<?=base_url()?>';
      
        $.ajax({
            url: basedomain+"en/web_exporter_search_result",
            type: "GET",
            data: {categoryId:categoryId,order:order},
            success: function (response) {
              var myArr = JSON.parse(response);
              myArr=myArr['exporter']['data'];
              var Str = "";
              $(myArr).each(function( index ) {
        
                if(myArr[index] !== null){
                    Str=Str+'<div class="top_row_list_exporter">';
                    Str=Str+'<div class="thumb_list_exporter">';
                    Str=Str+'<img src="<?php echo $this->config->item('website_assets')."exporter_product/"; ?>'+myArr[index]["imagenya"]+'">';
                    Str=Str+'</div>';
                    Str=Str+'<div class="caption_list_exporter">';
                    Str=Str+'<h3>'+myArr[index]["exporter_name"]+'</h3>';
                    Str=Str+'<p>'+myArr[index]["exporter_address"]+'</p> ';
                    Str=Str+'<div class="label_link"> ';
                    Str=Str+'<i class="fa fa-tags" aria-hidden="true"></i> ';
                    Str=Str+'<span>'+myArr[index]["category"]["category_title"]+'</span> ';
                    Str=Str+'</div> ';
                    Str=Str+'</div> ';
                    Str=Str+'</div>';
                    Str=Str+'<div class="bottom_row_list_exporter"> ';
                    Str=Str+'<div class="link_exporter"> ';
                    Str=Str+'<div class="item_call"> ';
                    Str=Str+'<i class="fa fa-phone" aria-hidden="true"></i> ';
                    Str=Str+'<span>'+myArr[index]["exporter_phone"]+'</span> ';
                    Str=Str+'</div> ';
                    Str=Str+'<div class="item_call"> ';
                    Str=Str+'<i class="fa fa-link" aria-hidden="true"></i> ';
                    Str=Str+'<span>'+myArr[index]["exporter_link"]+'</span> ';
                    Str=Str+'</div> ';
                    Str=Str+'</div> ';
                    Str=Str+'<a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en'."/web_index_exporter_detail" : $this->uri->segment(1)."/web_index_exporter_detail") ?>'+myArr[index]["exporter_slug"]+'" class="see_detail">DETAILS ></a> ';
                    Str=Str+'</div> ';
                }
               });
               $(".row_list_exporternya").attr("tabindex",-1).focus();
               $('.row_list_exporternya').html(Str);
            }
          })
  });
 

}


</script> 
