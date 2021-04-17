<div id="exporter-content" class="innerPage">
  <section id="top-exporter-list" class="section">
    <div class="wrapper">
      <div class="title_top_exporter">
        <h3>Trade with<br/>Indonesia</h3>
        <p>Search & Find Indonesian exporter for your business</p>
      </div><!--end.title_top_exporter-->
      <div class="row_input_filter">
        <div class="input_big_text">
          <div class="group_no_line">
            <label>Exporter Name</label>
            <input type="text" class="input_exporter" name="" placeholder="Ex. Category">
          </div>
        </div><!--end.input_big_text-->

        <div class="input_small_text">
          <div class="group_no_line">
            <label>Category</label>
            <div class="custom_select field">
              <select name="category_id" id="category_atas" required>
                <option selected disabled value="0">-- Pilih Category --</option>
                <?php foreach($category as $itemcat){ ?> 
                        <option value="<?=$itemcat['id']?>" catTitle="<?=$itemcat['title']?>"><?=$itemcat['title']?></option>
                      <?php } ?> 
              </select>
            </div>
          </div>
        </div><!--end.input_big_text-->
        <button type="submit" class="orange_big">Search</button>
      </div><!--end,row_input_filter-->
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
                    <select name="category" id="category">
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
                <select name="subcategory" id="subcategory">
                          <option selected disabled value="0">Sub Category</option>
                </select>
                </div>
              </div><!--end.row_filter-->
              <div class="row_filter">
                <label class="title_row">Sort Category</label>
                <div class="sort_by_Radio">
                 <label class="radio_container">Newest First
                   <input type="radio" checked="checked" name="radio">
                    <span class="checkmark"></span>
                  </label>
                  <label class="radio_container">Oldest First
                    <input type="radio" name="radio">
                    <span class="checkmark"></span>
                  </label>
                  <label class="radio_container">By Title
                    <input type="radio" name="radio">
                    <span class="checkmark"></span>
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
                    <img src="<?php echo $this->config->item('frontend'); ?>images/thumb_exporter_list.png">
                  </div><!--en.dthumb_list_exporter-->
                  <div class="caption_list_exporter">
                    <h3><?=$item['exporter_name']; ?></h3>
                    <p>We are exporter and manufacturer of rattan and wooden furniture in Central Java. Having experience more than 25 years in furniture business, we have been supplying customers all over the world.....</p>
                    <div class="label_link">
                      <i class="fa fa-tags" aria-hidden="true"></i>
                      <span>9403 Furniture</span>
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
                  <a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en'."/web_index_exporter_detail" : $this->uri->segment(1)."/web_index_exporter_detail") ?>" class="see_detail">DETAILS ></a>
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
TreeCat();
function TreeCat(){
    $('#category').on("change",function () {
        var categoryId = $(this).find('option:selected').val();
        var basedomain= '<?=base_url()?>';
        //console.log(basedomain);
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
            },
        });
    }); 
}

</script> 
