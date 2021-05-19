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
              <select name="category_id" id="category" required>
                <option selected disabled value="0">-- Pilih Category --</option>
                <option value="category01" catTitle="category01">Category 01</option>
                <option value="category02" catTitle="category02">Category 02</option>
                <option value="category03" catTitle="category03">Category 03</option>
                <option value="category04" catTitle="category04">Category 04</option>
              </select>
            </div>
          </div>
        </div><!--end.input_big_text-->
        <a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en'."/web_exporter_search_result" : $this->uri->segment(1)."/web_exporter_search_result") ?>"  class="orange_big">Search</a>
      </div><!--end,row_input_filter-->
    </div><!--end,wrapper-->
  </section>

  <section id="bottom-exporter-list" class="section padSection">
    <div class="wrapper">
      <div class="inner_exporter_list">
        

        <div class="list_bottom_exporter">
          <div class="left_content_exporter">
            <div class="item_left_content">
              <h3>Filter</h3>
              
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
            <div class="text_result_search">
              <span>Result for <strong><?= $exporterName; ?></strong> in <strong><?= $category; ?></strong></span>
            </div>
            <div class="item_list_exporternya">
            <?php foreach($exporter["data"] as $data):?>
              <div class="row_list_exporternya">
                <div class="top_row_list_exporter">
                  <div class="thumb_list_exporter">
                    <img src="<?php echo $this->config->item('frontend'); ?>images/thumb_exporter_list.png">
                  </div><!--en.dthumb_list_exporter-->
                  <div class="caption_list_exporter">
                    <h3><?= $data["exporter_name"] ?></h3>
                    <p><?= $data["exporter_address"] ?></p>
                    <div class="label_link">
                      <i class="fa fa-tags" aria-hidden="true"></i>
                      <span><?= $category; ?></span>
                    </div>
                  </div>
                </div><!--end.top_row_list_exporter-->
                <div class="bottom_row_list_exporter">
                  <div class="link_exporter">
                    <div class="item_call">
                      <i class="fa fa-phone" aria-hidden="true"></i>
                      <span><?= $data["exporter_phone"]; ?>2</span>
                    </div>
                    <div class="item_call">
                      <i class="fa fa-link" aria-hidden="true"></i>
                      <span><?= $data["exporter_link"]; ?></span>
                    </div>
                  </div>
                  <a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en'."/web_index_exporter_detail" : $this->uri->segment(1)."/web_index_exporter_detail") ?>" class="see_detail">DETAILS ></a>
                </div><!--end.bottom_row_list_exporter-->
              </div><!--end.row_list_exporternya-->
            <?php endforeach;?>
            </div><!--end.item_list_exporternya-->

        </div>
      </div>
    </div><!--end.wrapper-->
  </section>

 </div>
