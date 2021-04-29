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
              <h3>Inquiry List</h3>
              <p>Check your inquiry status</p>
            </div>
            <div class="list_table_inquiry">
              <table>
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Inquiry Title</th>
                    <th>Progress</th>
                  </tr>
                </thead>
                <tbody>

                <?php if ($data) {
    $i=1;
    foreach ($data as $item) { ?>
                                    <tr>
                                      <td><?=$i++; ?></td>
                                      <td>
                                        <a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en' : $this->uri->segment(1)."/web_inquiry_progress?detail=".$item['inquiry_id']) ?>" class="inquiry_list_title">
                                        <?php echo $item['inquiry_title']; ?> </a>
                                        <span class="sub_title_list"> <?php echo $item['subcategory_title']; ?> </span>
                                        <span class="sub_title_date"><?php echo $item['post_date'] ?></span>
                                      </td>
                                      <td><?php echo $item['progress']; ?></td>
                                    </tr>
                             <?php
                             }
} else { ?>
                              <tr>
                                      
                                      <td colspan="3" style="margin:auto;text-align:center;">
                                        Belum ada data
                                      </td>
                                      
                                    </tr>
                <?php }  ?>
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
 $( "#progressbar" ).progressbar({
    value: $(this).next().val()
  });

});
</script>