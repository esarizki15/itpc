<!-- Begin page -->
        <div class="home-btn d-none d-sm-block">
            <a href="<?php echo base_url(); ?>" class="text-dark"><i class="mdi mdi-home h1"></i></a>
        </div>

        <div class="account-pages">

            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div>
                            <div>
                                <center>
                                  <a href="<?php echo base_url(); ?>" class="logo logo-admin"><img src="<?php echo $this->config->item('admin_source'); ?>images/logo_login.png" height="70" alt="logo" style="margin-bottom:20px;"></a>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 offset-lg-1">
                        <div class="card mb-0">
                            <div class="card-body">


                                <div class="p-2">
                                      <form role="form" id="form" method="post" action="<?php echo base_url();?>Admin/Submit_login" enctype="multipart/form-data" onsubmit="">

                                        <div class="form-group row">
                                            <div class="col-12">
                                                <input class="form-control" type="email" required=""  value="" placeholder="Username" name="email">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-12">
                                                <input class="form-control" type="password" required=""  value="" placeholder="Password" name="password">
                                            </div>
                                        </div>

                                      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                        <div class="form-group text-center row m-t-20">
                                            <div class="col-12">
                                                <button class="btn btn-info btn-block waves-effect waves-light" type="submit">Log In</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!--div class="form-group m-t-10 mb-0 row">
                                        <div class="col-sm-7 m-t-20">
                                            <a href="<?php echo base_url();?>Admin/forgot_password" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password? tes</a>
                                        </div>
                                    </div-->
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
