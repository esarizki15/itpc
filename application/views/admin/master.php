<!DOCTYPE html>
<html dir="ltr" lang="en-US">
	<head>
		<?php
			echo $main_css;
			if($custume_css != NULL){
				echo $custume_css;
			}
		?>

	</head>
	<body>

				<!-- Loader -->
        <div id="preloader">
            <div id="status">
                <div class="spinner">
                    <div class="rect1"></div>
                    <div class="rect2"></div>
                    <div class="rect3"></div>
                    <div class="rect4"></div>
                    <div class="rect5"></div>
                </div>
            </div>
        </div>

		<?php
				if($_SESSION['admin_id'] == NULL || $_SESSION['admin_id'] == "")
				{
		?>
					<?php echo $content; ?>
		<?php
			}else{
		?>
		 <div class="header-bg">
			 	 <header id="topnav">
					  <div class="topbar-main">
							<div class="container-fluid">
							<?php echo $top_menu; ?>

							</div>
						</div>
						<div class="navbar-custom">
							  <div class="container-fluid">
									 <div id="navigation">
										 		<?php echo $main_menu; ?>
									 </div>
								</div>
						</div>

				 </header>
		 </div>

		 <div class="wrapper">
			 <div class="container-fluid">
							<?php echo $content; ?>
			 </div>
		 </div>

		 <!-- Footer -->
      <footer class="footer">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-12">
                      © 2020 Turboindonesia.com</span>
                  </div>
              </div>
          </div>
      </footer>
      <!-- End Footer -->


		<?php
			}
		?>

		<?php echo $main_js; ?>
		<?php if($custume_js != NULL){
			echo $custume_js;
		}
		?>
	</body>

</html>
