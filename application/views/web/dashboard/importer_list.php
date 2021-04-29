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
                <tbody>

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
$(document).ready(function() {


});
</script>