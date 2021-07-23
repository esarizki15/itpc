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
            <div class="login_title">
              <h3>Importer List</h3>
              <p>Inquiry Title: Chemical Inquiry</p>
            </div>
            <div class="list_table_inquiry">
              <table>
                <tbody id="table_body">

                <?php if ($importer_list) {
                  $i=1;
                  foreach ($importer_list as $item) { ?>
                  <tr>
                    <td><?=$item['importer_name'];?></td>
                    <td>
                      <a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en'."/web_importer_list_detail/".$item['importer_id'] : $this->uri->segment(1)."/web_importer_list_detail/".$item['importer_id'] ) ?>" class="detail_importer_link">Detail <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                    </td>
                  </tr>

                  <?php } } ?>

                </tbody>

              </table>
            </div><!--end.list_table_inquiry-->
          </div>


  			</div>
  		</div><!--end.inner_flex_middle-->
  	</div>
  </section>
</div>

<script type="text/javascript">
var start = '<?= $start ?>';
var detailId = '<?=$_SERVER['QUERY_STRING']?>';
var url = location.href;
$(document).ready(function() {
  winscroll(1,0);
  function winscroll(pagenya,category){
    $(window).scroll(function() {
        if($(window).scrollTop() + $(window).height() >= $(document).height()) {
          loadData();
        }
    });
  }

    /*Load more Function*/
    function loadData() {
        $.ajax({
            method: "GET",
            url: url+"&start="+start,
        })
        .done(function( response ) {
          var res = JSON.parse(response);
          if(res != false){
            if(res.start) start = res.start; 
            var data = res.importer_list;
            console.log(data);
            var Str = "";
            for(var i=0; i<data.length;i++){
              var link = '<?php echo base_url("".$this->uri->segment(1) == '' ? 'en'."/web_importer_list_detail/" : $this->uri->segment(1)."/web_importer_list_detail/" ) ?>';
              link += data[0].importer_id;
              Str=Str+"<tr>";
              Str=Str+"<td>"+data[0].importer_name+"</td>";
              Str=Str+"<td><a href="+ link +" class=detail_importer_link>Detail <i class='fa fa-angle-right' aria-hidden=true></i></a></td>";
              Str=Str+"</tr>";
            }
             $('#table_body').append(Str);
          }
        });
    }


});
</script>