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