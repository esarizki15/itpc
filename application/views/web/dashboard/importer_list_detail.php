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
              <h3>Importer Details</h3>
            </div>
            <div class="rows_detail_importer withBorder">
              <div class="list_inquiry rows">
                <div class="row-list">
                  <div class="cols2">
                    <div class="item_inquiry">
                      <div class="group_inquiry">
                        <label>Nama</label>
                        <p><?php echo $importer_detail[0]['importer_name'];?></p>
                      </div><!--end.group_inquiry-->

                      <div class="group_inquiry">
                        <label>Detail</label>
                        <p><?php echo $importer_detail[0]['importer_detail'];?></p>
                      </div><!--end.group_inquiry-->


                      <div class="group_inquiry">
                        <label>Alamat</label>
                        <p><?php echo $importer_detail[0]['importer_address'];?></p>
                      </div><!--end.group_inquiry-->

                    </div>
                  </div><!--end.cols2-->

                  <div class="cols2">
                    <div class="item_inquiry">
                      <div class="group_inquiry">
                        <label>City</label>
                        <p><?php echo $importer_detail[0]['importer_city'];?></p>
                      </div><!--end.group_inquiry-->

                      <div class="group_inquiry">
                        <label>State / Provience / Region</label>
                        <p><?php echo $importer_detail[0]['importer_provience'];?></p>
                      </div><!--end.group_inquiry-->

                      <div class="group_inquiry">
                        <label>Postal / Zip Code</label>
                        <p><?php echo $importer_detail[0]['importer_postal'];?></p>
                      </div><!--end.group_inquiry-->

                      <div class="group_inquiry">
                        <label>Country</label>
                        <p><?php echo $importer_detail[0]['country_name'];?></p>
                      </div><!--end.group_inquiry-->
                      <div class="group_inquiry">
                        <!-- <label>Jenis Produk </label> -->
                        <p></p>
                      </div><!--end.group_inquiry-->
                    </div>
                  </div>
                </div><!--end.row-list-->
              </div><!--end.list_inquiry-->
            </div><!--end.rows_detail_importer-->

            <div class="rows_detail_importer">
              <div class="list_inquiry rows">
                <span class="title_detail_importer">Informasi Kontak</span>
                <div class="row-list">
                  <div class="cols2">
                    <div class="item_inquiry">
                      <div class="group_inquiry">
                        <label>Nama</label>
                        <p><?php echo $importer_detail[0]['contact_name'];?></p>
                      </div><!--end.group_inquiry-->

                      <div class="group_inquiry">
                        <label>Telepon</label>
                        <p><?php echo $importer_detail[0]['contact_phone'];?>  </p>
                      </div><!--end.group_inquiry-->


                      <div class="group_inquiry">
                        <label>Handphone</label>
                        <p><?php echo $importer_detail[0]['contact_office_phone'];?>  </p>
                      </div><!--end.group_inquiry-->
                      <div class="group_inquiry">
                        <label>Faximile</label>
                        <p><?php echo $importer_detail[0]['contact_fax'];?></p>
                      </div><!--end.group_inquiry-->

                    </div>
                  </div><!--end.cols2-->

                  <div class="cols2">
                    <div class="item_inquiry">
                      <div class="group_inquiry">
                        <label>Email</label>
                        <p><strong><?php echo $importer_detail[0]['contact_email'];?></strong></p>
                      </div><!--end.group_inquiry-->

                      <div class="group_inquiry">
                        <label>Website</label>
                        <p><strong><?php echo $importer_detail[0]['contact_website'];?></strong></p>
                      </div><!--end.group_inquiry-->
                    </div>
                  </div>
                </div><!--end.row-list-->
              </div><!--end.list_inquiry-->
            </div><!--end.rows_detail_importer-->
            <div class="rows_detail_importer">
              <div class="list_inquiry rows">
                <span class="title_detail_importer">Social Media</span>
                <div class="row-list">
                  <div class="cols2">
                    <div class="item_inquiry">
                      <div class="group_inquiry">
                        <label>Twitter</label>
                        <p><?php echo $importer_detail[0]['social_twitter'];?></p>
                      </div><!--end.group_inquiry-->

                      <div class="group_inquiry">
                        <label>Facebook</label>
                        <p><?php echo $importer_detail[0]['social_facebook'];?></p>
                      </div><!--end.group_inquiry-->


                      <div class="group_inquiry">
                        <label>Google+</label>
                        <p><?php echo $importer_detail[0]['social_google'];?></p>
                      </div><!--end.group_inquiry-->
                    </div>
                  </div><!--end.cols2-->

                  
                </div><!--end.row-list-->
              </div><!--end.list_inquiry-->
            </div><!--end.rows_detail_importer-->


            <div class="rows_detail_importer withBorder">
              <div class="list_inquiry rows">
                <div class="row-list">
                  <div class="cols2">
                    <div class="item_inquiry">
                      <div class="group_inquiry">
                        <label>Created</label>
                        <p><?php echo $importer_detail[0]['post_date'];?></p>
                      </div><!--end.group_inquiry-->

                      <div class="group_inquiry">
                        <label>Last Update</label>
                        <p><?php echo $importer_detail[0]['update_date'];?></p>
                      </div><!--end.group_inquiry-->


                      <div class="group_inquiry">
                        <label>Created By+</label>
                        <p><?php echo $importer_detail[0]['created_by'];?></p>
                      </div><!--end.group_inquiry-->
                    </div>
                  </div><!--end.cols2-->

                  
                </div><!--end.row-list-->
              </div><!--end.list_inquiry-->
            </div><!--end.rows_detail_importer-->

          </div><!--end.box_exporter-->
  			</div>
  		</div><!--end.inner_flex_middle-->
  	</div>
  </section>
</div>

<script type="text/javascript">
$(document).ready(function() {


});
</script>