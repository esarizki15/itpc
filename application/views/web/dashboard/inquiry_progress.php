<div id="middle-content" class="homePage">
  <section id="login" class="section full_section">
  	<div class="doodle_right_dots">
  		<img src="<?php echo $this->config->item('frontend'); ?>images/dots_register_right.png">
  	</div>
  	<div class="doodle_left_dots">
  		<img src="<?php echo $this->config->item('frontend'); ?>images/dots_register_left.png">
  	</div>

  	<div class="wrapper">
  		<div class="inner_flex_middle">
  			<div class="inner_flex">
        
        <?php 
        if($data){
        foreach($data as $item) { ?>
  				<div class="box_exporter" style="displa:none">
  					<div class="progres_row rows">
              <span class="titleProgress">Progress (<?=$item['progress']?>%)</span>
              <span class="titleProgress"><?php if($item['progress'] < 100){?> Status (On Progress)<?php } else{echo "finish";} ?></span>
              <div class="progress-bar">
                <div id="progressbar"></div>
                <input type="hidden" class="persentasenya" value="<?=$item['progress']?>" >
              </div>
            </div>
            <div class="rows">
              <div class="tabs_menu_inquiry">
                <a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en' : $this->uri->segment(1)."/web_importer_list") ?>" class="tabs_menunya">Importer Lists</a>
                <a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en' : $this->uri->segment(1)."/web_inquiry_inbox/".$item['inquiry_id']) ?>" class="tabs_menunya">Inbox</a>
                <a href="#" class="tabs_menunya">Additional File</a>
              </div>
            </div>
            <div class="list_inquiry rows">
              <div class="row-list">
                <div class="cols2">
                  <div class="item_inquiry">
                    <div class="group_inquiry">
                      <label>Inquiry Title</label>
                      <p><?=$item['inquiry_title']?></p>
                    </div><!--end.group_inquiry-->

                    <div class="group_inquiry">
                      <label>Company Name</label>
                      <p><?=$item['contact_name']?></p>
                    </div><!--end.group_inquiry-->


                    <div class="group_inquiry">
                      <label>Company Address</label>
                      <p><?php echo $detail_user['exporter_detail'][0]['address']?></p>
                    </div><!--end.group_inquiry-->
                    <br/>
                    <br/>


                    <div class="group_inquiry">
                      <label>Product Category</label>
                      <p><?=$item['category_title']?></p>
                    </div><!--end.group_inquiry-->


                    <div class="group_inquiry">
                      <label>Product Detail </label>
                      <p><?=$item['subcategory_title']?></p>
                    </div><!--end.group_inquiry-->


                    <div class="group_inquiry">
                      <label>Product Capacity</label>
                      <p></p>
                    </div><!--end.group_inquiry-->

                  </div>
                </div><!--end.cols2-->
                <div class="cols2">
                  <span class="infoSmall"><strong>Contact Person</strong></span>
                  <div class="item_inquiry">
                    <div class="group_inquiry">
                      <label>Name</label>
                      <p><?php echo $detail_user['exporter_detail'][0]['name']?></p>
                    </div><!--end.group_inquiry-->

                    <div class="group_inquiry">
                      <label>Email</label>
                      <p><?php echo $detail_user['exporter_detail'][0]['email']?></p>
                    </div><!--end.group_inquiry-->

                    <div class="group_inquiry">
                      <label>Phone</label>
                      <p><?php echo $detail_user['exporter_detail'][0]['phone']?></p>
                    </div><!--end.group_inquiry-->

                    <div class="group_inquiry">
                      <label>Created By</label>
                      <p><?php echo $detail_user['exporter_detail'][0]['name']?></p>
                    </div><!--end.group_inquiry-->
                    <br/><br/>

                    <div class="group_inquiry">
                      <label>Date Created </label>
                      <p><?=$item['post_date'];?></p>
                    </div><!--end.group_inquiry-->
                    <div class="group_inquiry">
                      <label>Last Update </label>
                      <p><?=$item['post_date'];?></p>
                    </div><!--end.group_inquiry-->
                  </div>
                </div>
              </div><!--end.row-list-->
            </div><!--end.list_inquiry-->

           
  				</div><!--end.box_exporter-->

          <?php } ?>
          <?php } ?>

  			</div>
  		</div><!--end.inner_flex_middle-->
  	</div>
  </section>
</div>

<script type="text/javascript">
$(document).ready(function() {
 $( "#progressbar" ).progressbar({
    value: $(this).next().val()
  });

});
</script>