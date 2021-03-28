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
  					
            <div class="action_exporter_account">
              <div class="row-list">
              <form id="addInquiry" action="<?php echo base_url(). 'store_inquiry'; ?>" method="post" enctype="multipart/form-data" >
                  <div class="cols2">
                  <span class="infoSmall"><strong>Add Inquiry</strong></span>
                    <span class="infoSmall">Input detailed information about your inquiry</span>
                    <div class="form_inner">
                      <div class="form_group">
                        <div class="field">
                          <input type="text" name="inquiry_title" class="input_form" placeholder="Inquiry Title" required />
                        </div>
                      </div>
                      <div class="form_group">
                        <div class="field">
                          <input type="text" name="exporter_name" class="input_form field" placeholder="Company Name" required />
                        </div>
                      </div>
                      <div class="form_group">
                        <div class="field">
                          <input type="text" name="exporter_address" class="input_form field" placeholder="Company Address" required />
                        </div>
                      </div>
                      <div class="form_group">
                        <div class="custom_select field">
                          <select name="category_id" id="category" required>
                            <option selected disabled value="0">Category</option>
                            <?php foreach($data['category'] as $itemcat){ ?> 
                            <option value="<?=$itemcat['id']?>" catTitle="<?=$itemcat['title']?>"><?=$itemcat['title']?></option>
                          <?php } ?> 
                          </select>
                        </div>
                      </div>
                      <div class="form_group">
                        <div class="custom_select">
                          <select name="subcategory_id" id="subcategory">
                            <option selected disabled value="0">Sub Category</option>
                          
                          </select>
                        </div>
                      </div>

                      <div class="form_group">

                        <div class="field">
                          <textarea class="input_form field" name="product_detail" rows="4" cols="50" placeholder="Product Details" required></textarea>
                        </div>
                      </div>
                      <div class="form_group">
                        <div class="field">
                          <input type="text" name="product_capacity" class="input_form field number" placeholder="Product Capacity" required />
                        </div>
                      </div>
                      <div class="form_group">
                        <div class="custom_select field">
                          <select name="have_export" id="haveAnswer" required>
                            <option selected disabled value="0">Have Export? Choose Answer</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                          </select>
                        </div>
                      </div>

                    </div>
                  </div><!--end.cols2-->


              
                  <div class="cols2">
                    <span class="infoSmall"><strong>Contact Person</strong></span>
                    <span class="infoSmall">Input contact of Person in charge</span>
                    <div class="form_inner">
                      <div class="form_group">
                        <input type="text" name="contact_name" class="input_form" placeholder="Full Name"  />
                      </div>
                      <div class="form_group">
                        <input type="email" name="contact_email" class="input_form" placeholder="Email"  />
                      </div>
                      <div class="form_group">
                        <input type="tel" name="contact_phone" class="input_form" placeholder="Email Phone/ Mobile Phone"  />
                      </div>
                      <input type="hidden" name='exporter_id' value="<?=$data['id_ex']?>">

                      <div class="form_group">
                      <input type="hidden" name="csrf_token_reg" value="<?=$token;?>" />
                        <button type="submit" class="bt_block_blue buttonAddInquiry">
                          Submit
                        </button>
                      </div>
                    </div>
                  </div><!--end.cols2-->
                </form>
              </div><!--end.row-list-->
            </div><!--end.action_exporter_account-->
  				</div><!--end.box_login-->

          <?php echo '<b><i>'.$this->session->flashdata('flsh_msg').'</i></b>'; ?>


  			</div>
  		</div><!--end.inner_flex_middle-->
  	</div>
  </section>
</div>

<script type="text/javascript">
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
$(document).ready(function() {
  TreeCat()
  $("#addInquiry").validate({
    submitHandler: function() {
        $(".buttonAddInquiry").prop( "disabled" );
        $(".buttonAddInquiry").html('<i class="fa fa-spinner fa-spin"></i> Loading');
        form.submit();
    },
    errorPlacement: function(error, element) {
        error.insertAfter(element.parent('.field'));
    } 
  });

  $('.number').keypress(function(event){
  

if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
    event.preventDefault(); //stop character from entering input
}

});

});
</script>