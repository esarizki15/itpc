<!-- Logo-->
<div>

	<a href="<?php echo base_url() ?>Admin" class="logo" style="color:#fff;">
		<h3>ITPC</h3>
	</a>

</div>
<!-- End Logo-->

<div class="menu-extras topbar-custom navbar p-0">


	<ul class="list-inline ml-auto mb-0">

		<!-- notification-->

		<li class="list-inline-item dropdown notification-list nav-user">
			<a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
				<img src="<?php echo $this->config->item('admin_source'); ?>images/users/avatar-6.jpg" alt="user" class="rounded-circle">
				<span class="d-none d-md-inline-block ml-1"><?php echo $this->session->userdata('admin_name'); ?><i class="mdi mdi-chevron-down"></i> </span>
			</a>
			<div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown">
				<a class="dropdown-item" href="<?php echo base_url(); ?>Admin/Logout"><i class="dripicons-exit text-muted"></i> Logout</a>
			</div>
		</li>
		<li class="menu-item list-inline-item">
			<!-- Mobile menu toggle-->
			<a class="navbar-toggle nav-link">
				<div class="lines">
					<span></span>
					<span></span>
					<span></span>
				</div>
			</a>
			<!-- End mobile menu toggle-->
		</li>

	</ul>

</div>
<!-- end menu-extras -->

<div class="clearfix"></div>
