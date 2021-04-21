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
                  <tr>
                    <td>1</td>
                    <td>
                      <a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en' : $this->uri->segment(1)."/web_inquiry_progress") ?>" class="inquiry_list_title">Lorem Ipsum Dolor Sit Amet </a>
                      <span class="sub_title_list">Crustaceans, Molluscs Prepared or Preserved</span>
                      <span class="sub_title_date">17 Feb 2021</span>
                    </td>
                    <td>100%</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>
                      <a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en' : $this->uri->segment(1)."/web_inquiry_progress") ?>" class="inquiry_list_title">Lorem Ipsum Dolor Sit Amet</a>
                      <span class="sub_title_list">Animal or Vegetable Fats</span>
                      <span class="sub_title_date">17 Feb 2021</span>
                    </td>
                    <td>100%</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>
                      <a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en' : $this->uri->segment(1)."/web_inquiry_progress") ?>" class="inquiry_list_title non_active">Lorem Ipsum Dolor Sit Amet </a>
                      <span class="sub_title_list">Crustaceans, Molluscs Prepared or Preserved</span>
                      <span class="sub_title_date">17 Feb 2021</span>
                    </td>
                    <td><span class="red">closed</span></td>
                  </tr>
                </tbody>

              </table>
            </div><!--end.list_table_inquiry-->
          </div>
        <?php 
        if($data){
        foreach($data as $item) { ?>
  				          <table>
                      <tr><th>no</th><th>list</th></tr>
                      <tr><td>1</td><td><a href="<?php echo base_url("".$this->uri->segment(1) == '' ? 'en' : $this->uri->segment(1)."/web_inquiry_progress") ?>">detail </a></td></tr>
                    </table>
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