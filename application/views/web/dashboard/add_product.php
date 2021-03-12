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
  				<div class="box_exporter">
          <form action="<?php echo base_url(). 'store_product'; ?>" method="post" enctype="multipart/form-data" >
            <div class="action_exporter_account">
              <div class="row-list">
                <div class="cols2">
                  <span class="infoSmall"><strong>Product Image</strong></span>
                  <span class="infoSmall">Add your company products photo</span>
                  <div class="preview_img">
                  <img id="logo_preview" src="<?php if($item['logo']){echo $item['logo'].'.png';}else{echo $this->config->item('frontend').'images/logo_preview.png'; } ?> ">
                  <input type='file' name='ex_pro_image' id="imgInp" style="opacity: 0;position: absolute;" />
                  </div><!--end.preview_img-->
                <div class="row-block-button">
                  <button type="button" id="trigger_upload" class="bt_block_white bt_with_icon">
                    <img src="<?php echo $this->config->item('frontend'); ?>images/icon_upload.png">
                    <span>Choose File</span>
                  </button>
                    <input type='hidden' name='exporter_id' value='<?=$ex_id?>'>
                   
                    <button type="submit" class="bt_block_blue submitproduct">
                      Add Image
                    </button>
                  </div>
                </div><!--end.cols2-->

                <div class="cols2">

                  <span class="infoSmall"><strong>Added Product (<?php echo $totaldataproduk;?>/5)</strong></span>

                  <div class="list_added_product" id="listProduct">
                    <div class="row-list">

                    <?php 
                    if(@$data){
                      //pr($data);exit;
                    foreach($data as $itemcat){ ?> 
                       <div class="cols3">
                        <div class="item_img_product text-center">
                          <div class="thumb_add_product">
                            <img src="<?=$itemcat['image']?>">
                          </div>
                          <button type="button" class="del_button">Delete</button>
                          <input type="hidden" name='idsubcat' value="<?=$itemcat['id']?>">
                        </div><!--end.item_img_product-->
                      </div><!--end.cols3--->
                      <?php  } }?>

                  </div>
                </div><!--end.cols2-->
              </div><!--end.row-list-->
            </form>

            </div><!--end.action_exporter_account-->
  				</div><!--end.box_login-->
  			</div>
  		</div><!--end.inner_flex_middle-->
  	</div>
  </section>
</div>

<script type="text/javascript">
$(document).ready(function() {
  $("#trigger_upload").click(function () {
      $("#imgInp").click();
  })
  clickRemove()
  function clickRemove(){
   $(".del_button").click(function () {
    var idnya=$(this).next().val();
    var thiss=$(this);
      var basedomain= '<?=base_url()?>';
        $.ajax({
              url: basedomain+"API/delete_exporter_product",
              type: "POST",
              data: 'ex_pro_id=' + idnya ,
              success: function (response) {
                thiss.parent().parent().remove();
              },
          });
      
    });
  }
 function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
          $('#logo_preview').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]); // convert to base64 string
      }
    }

    $("#imgInp").change(function() {
      readURL(this);
    });

});
</script>