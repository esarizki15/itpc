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
                          <?php foreach($data['category'] as $itemcat){ ?> 
                            <option value="<?=$itemcat['id']?>" catTitle="<?=$itemcat['title']?>"><?=$itemcat['title']?></option>
                          <?php } ?> 
                        </select>
                      </div>
                    </div>
                    <div class="form_group">
                      <div class="custom_select">
                        <select name="subcategory" id="subcategory">
                          <option selected disabled value="0">Sub Category</option>
                         
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
                    

                  <?php foreach($data['curr_category'] as $itemcurcat){  ?> 
                              <div class="row_added_cat">
                                <span class="teks_cat"><?=$itemcurcat['sub_title']?></span>
                                <div class="trigger_remove">
                                  <img src="<?php echo $this->config->item('frontend'); ?>images/icon_remove.png">
                                  <input type="hidden" name='idsubcat' value="<?=$itemcurcat['ex_cat_id']?>">
                                </div>
                              </div>
                   <?php } ?> 
                   <!--end.row_added_cat-->
                
                    
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
    console.log('ss')
    var parentDiv = $(this).closest(".row_added_cat")
    var idnya=$(this).children().next().val();
    var basedomain= '<?=base_url()?>';
      $.ajax({
            url: basedomain+"API/delete_category_exporter",
            type: "POST",
            data: 'ex_cat_id=' + idnya ,
            success: function (response) {
                console.log(response)
            },
        });
    $(parentDiv).remove();
  });
}


function TreeCat(){
    $('#category').on("change",function () {
        var categoryId = $(this).find('option:selected').val();
        var basedomain= '<?=base_url()?>';
        //console.log(basedomain);
        $.ajax({
            url: basedomain+"en/add_category",
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
  clickRemove();
  TreeCat();
  $("#addCategory").click(function () {
    var Cat = $('#category :selected').attr('value');
    var subCat = $('#subcategory :selected').attr('value');
    var katasub= $('#subcategory').find("option:selected").attr("title");
    var toDoLists = document.getElementById('listCategory');

    if(subCat == 0){
      Swal.fire({
        text: 'Please choose cagetory'
      });
    }else{
      var id = '<?=$data['id_ex']?>';
			var category_id = Cat;
			var subcategory_id = subCat;
      var basedomain= '<?=base_url()?>';
      console.log('expoter_id=' + id + '&category_id=' + category_id + '&subcategory_id=' + subcategory_id)
      $.ajax({
            url: basedomain+"API/add_category_exporter",
            type: "POST",
            data: 'expoter_id=' + id + '&category_id[]=' + category_id + '&subcategory_id[]=' + subcategory_id,
            success: function (response) {

              
              // console.log(response)
              const elements = `<div class="row_added_cat">
                      <span class="teks_cat">`+katasub+`</span>
                      <div class="trigger_remove">
                        <img src="<?php echo $this->config->item('frontend'); ?>images/icon_remove.png">
                        <input type="hidden" name='idsubcat' value="`+id+`">
                      </div>
                    </div>`
                toDoLists.insertAdjacentHTML('beforeend', elements);
            },
        });


     
      clickRemove();
    }

  });

});
</script>