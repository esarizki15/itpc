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
  					<div class="progres_row rows">
              <span class="titleProgress">Progress (25%)</span>
              <span class="titleProgress">Status (On Progress)</span>
              <div class="progress-bar">
                <div id="progressbar"></div>
              </div>
            </div>
            <div class="list_inquiry rows">
              <div class="row-list">
                <div class="cols2">
                  <div class="item_inquiry">
                    <div class="group_inquiry">
                      <label>Inquiry Title</label>
                      <p>Test Tedihouse</p>
                    </div><!--end.group_inquiry-->

                    <div class="group_inquiry">
                      <label>Company Name</label>
                      <p>Dharma Saputra</p>
                    </div><!--end.group_inquiry-->


                    <div class="group_inquiry">
                      <label>Company Address</label>
                      <p>Jl. Salam Raya No.19 A, Sukabumi Utara,<br/>
Kec. Kb. Jeruk, Kota Jakarta Barat, <br/>
Daerah Khusus Ibukota Jakarta 11540</p>
                    </div><!--end.group_inquiry-->
                    <br/>
                    <br/>


                    <div class="group_inquiry">
                      <label>Product Category</label>
                      <p>Electronics, Electrical Machinery</p>
                    </div><!--end.group_inquiry-->


                    <div class="group_inquiry">
                      <label>Product Detail </label>
                      <p>IT Developer</p>
                    </div><!--end.group_inquiry-->


                    <div class="group_inquiry">
                      <label>Product Capacity</label>
                      <p>100</p>
                    </div><!--end.group_inquiry-->

                  </div>
                </div><!--end.cols2-->
                <div class="cols2">
                  <span class="infoSmall"><strong>Contact Person</strong></span>
                  <div class="item_inquiry">
                    <div class="group_inquiry">
                      <label>Name</label>
                      <p>dharma saputra</p>
                    </div><!--end.group_inquiry-->

                    <div class="group_inquiry">
                      <label>Email</label>
                      <p>dharma@tedihouse.com</p>
                    </div><!--end.group_inquiry-->

                    <div class="group_inquiry">
                      <label>Phone</label>
                      <p>081316947758</p>
                    </div><!--end.group_inquiry-->

                    <div class="group_inquiry">
                      <label>Created By</label>
                      <p>Dharmasaputra (Dharmasaputra)</p>
                    </div><!--end.group_inquiry-->
                    <br/><br/>

                    <div class="group_inquiry">
                      <label>Date Created </label>
                      <p>2020-06-15 20:01:49</p>
                    </div><!--end.group_inquiry-->
                    <div class="group_inquiry">
                      <label>Last Update </label>
                      <p>2020-06-15 20:01:49</p>
                    </div><!--end.group_inquiry-->
                  </div>
                </div>
              </div><!--end.row-list-->
            </div><!--end.list_inquiry-->
            
  				</div><!--end.box_exporter-->
  			</div>
  		</div><!--end.inner_flex_middle-->
  	</div>
  </section>
</div>

<script type="text/javascript">
$(document).ready(function() {
 $( "#progressbar" ).progressbar({
    value: 37
  });

});
</script>