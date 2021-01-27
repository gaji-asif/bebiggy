<!DOCTYPE html>
<html lang="en">

<head>

	<!--Admin Page Meta Tags-->
	<title>Admin Dashboard | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="icon" href="<?php if (isset($imagesData[0]['favicon'])) echo base_url() . ADMIN_IMAGES . $imagesData[0]['favicon']; ?>" alt="favicon" />
	<meta name="robots" content="noindex">
	<!--/Admin Page Meta Tags-->

	<!--------------------------------------------------------------------------------------------------------------->
	<?php $this->load->view('main/includes/headerscripts'); ?>
	<!--------------------------------------------------------------------------------------------------------------->

</head>

<body class="gray">
	<div id="wrapper">
		<div class="clearfix"></div>

		<div class="dashboard-container">
			<?php $this->load->view('admin/includes/sidebar'); ?>

			<div class="dashboard-content-container" data-simplebar>
				<div class="dashboard-content-inner">

					<!-- Dashboard Headline -->
					<div class="dashboard-headline">

						<div class="dashboad_table">
							<i class="icon-material-outline-dashboard"></i>
							<h3>Admin Dashboard</h3>
							<div class="ml-auto dropdown user_name">
								<div class="get_user dropdown-toggle" data-toggle="dropdown">AD</div>
								<div class="dropdown-menu">
									<a href="<?php echo base_url(); ?>admin/user_settings" class="dropdown-item"><i class="icon-material-outline-settings"></i> Settings</a>
									<li class="divider"></li>
									<a href="<?php echo base_url(); ?>admin/change_password" class="dropdown-item"><i class="icon-material-outline-lock"></i> Change Password</a>
									<a href="<?php echo base_url(); ?>admin/logout" class="dropdown-item"><i class="icon-material-outline-power-settings-new"></i> Logout</a>
								</div>
							</div>
						</div>
					</div>
					<br><br>
					<div class="dashboard-headline" >
						<div class="dashboad_table " style="padding: 10px;"> 
						<i class="icon-line-awesome-warning"></i>
						<h4>Your are not authorized to access this  page </h4>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>



</body>

</html>