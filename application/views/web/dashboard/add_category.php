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
                <div class="cols2">
                  <span class="infoSmall"><strong>Category</strong></span>
                  <span class="infoSmall">What kind of products your company produce?</span>
                  <div class="form_inner">
                    <div class="form_group">
                      <div class="custom_select">
                        <select name="category" id="category">
                          <option selected disabled value="0">Category</option>
                          <option value="category1">Category 01</option>
                          <option value="category2">Category 02</option>
                          <option value="category3">category 03</option>
                        </select>
                      </div>
                    </div>
                    <div class="form_group">
                      <div class="custom_select">
                        <select name="subcategory" id="subcategory">
                          <option selected disabled value="0">Sub Category</option>
                          <option value="subcategory1">Sub Category 01</option>
                          <option value="subcategory2">Sub Category 02</option>
                          <option value="subcategory3">Sub Category 03</option>
                        </select>
                      </div>
                    </div>
                    <div class="form_group">
                      <button type="button" id="addCategory" class="bt_block_blue ">
                        Add Category
                      </button>
                    </div>
                  </div>
                </div><!--end.cols2-->

                <div class="cols2">
                  <span class="infoSmall"><strong>Added Category</strong></span>
                  <div class="list_added_category" id="listCategory">
                    
                    <div class="row_added_cat">
                      <span class="teks_cat">Animal or Vegetable Fats, Oils, Waxes</span>
                      <div class="trigger_remove">
                        <img src="<?php echo $this->config->item('frontend'); ?>images/icon_remove.png">
                      </div>
                    </div><!--end.row_added_cat-->
                    <div class="row_added_cat">
                      <span class="teks_cat">Creative & Social Media</span>
                      <div class="trigger_remove">
                        <img src="<?php echo $this->config->item('frontend'); ?>images/icon_remove.png">
                      </div>
                    </div><!--end.row_added_cat-->
                    <div class="row_added_cat">
                      <span class="teks_cat">Sports Athlete Agency Management</span>
                      <div class="trigger_remove">
                        <img src="<?php echo $this->config->item('frontend'); ?>images/icon_remove.png">
                      </div>
                    </div><!--end.row_added_cat-->
                    
                  </div>
                </div><!--end.cols2-->

              </div><!--end.row-list-->
            </div><!--end.action_exporter_account-->
  				</div><!--end.box_login-->
  			</div>
  		</div><!--end.inner_flex_middle-->
  	</div>
  </section>
</div>

<script type="text/javascript">

function clickRemove(){

  $(".trigger_remove").click(function () {
    var parentDiv = $(this).closest(".row_added_cat")
    $(parentDiv).remove();
  });
}

$(document).ready(function() {
  clickRemove();
  $("#addCategory").click(function () {
    var subCat = $('#subcategory :selected').val();
    var toDoLists = document.getElementById('listCategory');

    if(subCat == 0){
      Swal.fire({
        text: 'Please choose cagetory'
      });
    }else{
      const elements = `<div class="row_added_cat">
                      <span class="teks_cat">${subCat}</span>
                      <div class="trigger_remove">
                        <img src="<?php echo $this->config->item('frontend'); ?>images/icon_remove.png">
                      </div>
                    </div>`
      toDoLists.insertAdjacentHTML('beforeend', elements);
      clickRemove();
    }

  });

});
</script>