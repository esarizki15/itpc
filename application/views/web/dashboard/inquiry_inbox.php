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

                <form id="addInquiry">
                  <div class="cols2">
                    <span class="infoSmall"><strong>Inbox</strong></span>
                    <div class="list_inbox max-height-scroll">
                      <?php foreach($data['inbox'] as $item) { ?>
                          <div class="row_inbox inboxinq">
                            <input type="hidden" class="detail_id_inbox" value='<?php echo $item['inbox_id'];?>' >
                            <input type="hidden" value='<?php echo $item['inbox_content'];?>' >
                            <input type="hidden" value='<?php echo $item['inquiry_id'];?>' >
                            <div class="block_inbox <?php if($item['inbox_read']==0){echo "active";}?>">
                              <h3>Your Progress (100%)</h3>
                              <span class="date_inbox"><?=$item['post_date'];?></span>
                            </div>
                          </div><!--end.row_inbox-->
                      <?php } ?>
                     
                    </div>
                  </div><!--end.cols2-->
                 
                 
                  <div class="cols2 rescontent" >
                    <span class="infoSmall"><strong>Message</strong></span>
                    <div class="isi-inbox_row">
                      <div class="isi_boxnya">
                        <p>Thank you your inquiry is being reviewed. Usually it takes 2-3 working days.</p>
                      </div>
                      <div class="form_group">
<button type="button" class="bt_block_blue buttonAddInquiry allread">
<input type="hidden" value='<?php  if(@$data['inbox']) echo $data['inbox'][0]['inquiry_id'];?>' >
                        
                          I have read all the messages
                        </button>
                      </div>
                    </div>
                   </div><!--end.cols2-->

             



                </form>
              </div><!--end.row-list-->
            </div><!--end.action_exporter_account-->
          </div><!--end.box_login-->
        </div>
      </div><!--end.inner_flex_middle-->
    </div>

  </section>
</div>
<script type="text/javascript">
$(document).ready(function() {

  $('.inboxinq').click(function() {
   
    var idnya=$(this).children().val();
    var auth_code='<?php echo $data['auth_code'] ?>';
    var content=$(this).children().next().val();
    var inquiry_id=$(this).children().next().next().val();
    var thiss=$(this);
    var basedomain= '<?=base_url()?>';
    //console.log(inquiry_id+','+idnya)
      $.ajax({
            url: basedomain+"API/inbox_read",
            type: "POST",
            headers: {
                "auth_code":auth_code
            },
            data:{inquiry_id:inquiry_id,inbox_id:idnya}  ,
            success: function (response) {
              thiss.children().next().next().next().removeClass('active')
              console.log(thiss.children().next().next().removeClass('active'))
              thiss.children().next().next().removeClass('active')
              $('.rescontent').show();
              $('.isi_boxnya').html(content);
            },
        });


});

$('.allread').click(function() {
   
   var inquiry_id=$(this).children().val();
   var auth_code='<?php echo $data['auth_code'] ?>';
   var thiss=$(this);
   var basedomain= '<?=base_url()?>';
   //console.log(inquiry_id+','+idnya)
     $.ajax({
           url: basedomain+"API/inbox_read",
           type: "POST",
           headers: {
               "auth_code":auth_code
           },
           data:{inquiry_id:inquiry_id}  ,
           success: function (response) {
             thiss.children().next().next().next().removeClass('active')
             console.log(thiss.children().next().next().removeClass('active'))
             $('.block_inbox').removeClass('active')
             $('.rescontent').show();
            
           },
       });


});

});
</script>