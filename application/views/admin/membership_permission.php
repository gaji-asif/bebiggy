<!DOCTYPE html>
<html lang="en">

<head>

	<!--Admin Page Meta Tags-->
	<title>Admin Settings | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
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

	<!-- Wrapper -->
	<div id="wrapper">

		<!--------------------------------------------------------------------------------------------------------------->
		<div class="clearfix"></div>
		<!--------------------------------------------------------------------------------------------------------------->


		<!-- Dashboard Container -->
		<!--------------------------------------------------------------------------------------------------------------->
		<div class="dashboard-container">
			<?php $this->load->view('admin/includes/sidebar'); ?>
			<!--------------------------------------------------------------------------------------------------------------->


			<!-- Dashboard Content
	================================================== -->
			<div class="dashboard-content-container" data-simplebar>
				<div class="dashboard-content-inner">

					<!-- Dashboard Headline -->
					<div class="dashboard-headline">

						<div class="dashboad_table">
							<i class="icon-material-outline-settings"></i>
							<h3>Admin Settings</h3>
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

					<!-- Breadcrumbs -->
					<nav id="breadcrumbs" class="dark">
						<ul>
							<li><a href="#">Home</a></li>
							<li><a href="#">Dashboard</a></li>
							<li>Admin Settings</li>
						</ul>
					</nav>

					<div class="my-1">
							<?php if (!empty($this->session->flashdata('membership'))) { ?>
								<div class="alert alert-success">
								<strong>Success!</strong> <?php echo $this->session->flashdata('membership') ?></a>.
							</div>
						<?php } ?>
					</div>
					<!-- Row -->
					<div class="row">

						<form action="<?php echo site_url('admin/add-membership-level'); ?>" method="post" enctype="multipart/form-data" class="w-100" />


						<!-- Dashboard Box -->
						<div class="col-xl-12">
							<div class="dashboard-box">

								<!-- Headline -->
								<div class="headline">
									<h3><i class="icon-material-outline-face"></i> Assign Member Level to <b> USER </b> </h3>
								</div>
								
								<div class="content">
									<ul class="fields-ul">
										<li>
											<div class="row">
												<div class="col-xl-12">
													<div class="submit-field">
														<h5>User Name</h5>
														<input type="text" name="name" class="form-control" value="<?php echo isset($users[0]['username']) ? $users[0]['username'] : ''; ?>" readonly="true">
														<input type="hidden" name="id" value="<?php echo isset($users[0]['user_id']) ? $users[0]['user_id'] : 0; ?>">
													</div>
												</div>

												<div class="col-xl-12 div_floats">
													<div class="offset-1 col-xl-10">
														<div class="submit-field">
															<table class="table table-bordered table-striped table-hover">
																<?php

																if (isset($permissions)) :  ?>

																	<?php foreach ($permissions as $key => $val) : ?>
																		<tr>
																			<h5>
																				<td class="">
																					<label for=""><?php echo strtoupper($key); ?></label><input type="radio" name="membership_level" value="<?php echo $val['id']; ?>" <?php if (isset($user_membership)) {
																																																							if ($user_membership[0] == $val['id']) {
																																																								echo "checked='true'";
																																																							}
																																																						}
																																																						?> class="with-border" /> </td>
																			</h5>
																			<?php
																			$i = 1;
																			array_shift($val);
																			foreach ($val as $v) : if ($i == 1)  $i = 0;
																				else echo "<td></td>"; ?>
																				<td class="">

																					<lable><?php echo strtoupper($v); ?></lable>

																				</td>
																		</tr>
																	<?php endforeach; ?>
																<?php endforeach; ?>
															<?php endif; ?>
															</table>
														</div>
													</div>
												</div>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>

						<!-- Dashboard Box -->

						<!-- Button -->
						<div class="col-xl-12">
							<button type="submit" class="btn btn-success margin-top-30 btn_themecolor_a">Save Changes</button>
						</div>

						<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

						</form>

					</div>
					<!-- Row / End -->
					<!----------------------------------------------------------------------------------------------------------->
					<?php $this->load->view('user/includes/footer'); ?>
					<!----------------------------------------------------------------------------------------------------------->
				</div>
			</div>
			<!-- Dashboard Content / End -->

		</div>
		<!-- Dashboard Container / End -->

	</div>
	<!-- Wrapper / End -->


	<!--------------------------------------------------------------------------------------------------------------->
	<?php $this->load->view('main/includes/footerscripts'); ?>
	<!--------------------------------------------------------------------------------------------------------------->

	<!--------------------------------------------------------------------------------------------------------------->

</body>

</html>