<!DOCTYPE html>
<html lang="en">

<head>

	<!--Admin Page Meta Tags-->
	<title>User Control | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
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

			<div class="dashboard-content-container" data-simplebar>
				<div class="dashboard-content-inner">

					<!-- Dashboard Headline -->
					<div class="dashboard-headline">
						<div class="dashboad_table">
							<i class="mdi mdi-account-circle"></i>
							<?php if (isset($define_type) && $define_type == 'admin_user') { ?>
								<h3>Admin User</h3>
							<?php } else { ?>
								<h3>User Controls</h3>
							<?php } ?>

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
							<?php if (isset($define_type) && $define_type == 'admin_user') { ?>
								<li><a href="#">Admin User</a></li>
							<?php } else { ?>
								<li><a href="#">User Controls</a></li>
							<?php } ?>

						</ul>
					</nav>


					<!-- Row -->
					<div class="row">

						<!-- Dashboard Box -->
						<div class="col-xl-12">
							<div class="dashboard-box margin-top-0">
								<div class="headline">
									<?php
									if ($this->session->userdata('adminMessage')) {  ?>
										<div class="alert alert-danger" role="alert">
											<?php echo $this->session->userdata('adminMessage'); ?>
										</div>
									<?php
										$this->session->set_userdata('adminMessage', '');
									}
									?>
								</div>
								<!-- Headline -->
								<div class="headline">
									<h3>User Controls</h3>
								</div>
								<!----- PAGES ---------------->
								<div class="row">
									<div class="col-xs-24 col-sm-24 col-md-24 col-lg-12 col-xl-12">
										<div class="card mb-3">
											<div class="card-body">
												<div class="table-responsive">
													<table id="tbl_userdata" class="table table-bordered table-hover display">
														<thead>
															<tr>
																<th>ID</th>
																<th>USERNAME</th>
																<th>EMAIL</th>
																<th>FIRST NAME</th>
																<th>IP</th>
																<th>STATUS</th>
																<th>BLOCK</th>
																<th>ACTIVE</th>
																<th>PERMISSION</th>
																<th>MEMBERSHIP</th>
																<th>USERLOGIN</th>

															</tr>
														</thead>
													</table>
												</div>
											</div>
										</div><!-- end card-->
									</div>
								</div>
								<!----- /PAGES ---------------->
							</div>
						</div>
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


	<div class="modal fade" id="assignBadgeModal" tabindex="-1" role="dialog" aria-labelledby="change-listing" aria-hidden="true">
		<div class="modal-dialog modal-danger modal-dialog-centered modal-lg" role="document">
			<div class="modal-content bg-gradient-danger">
				<div class="modal-header">
					<h3 id="assignBadgeModalH3">Assign Badge</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>

				<div class="card">
					<div class="card-body">
						<!---card--->
						<div class="modal-body">
							<?php if (isset($badges)) { ?>
								<form action="<?php echo site_url('admin/save_user_badge'); ?>" method="post">
									<input type="hidden" name="modalUserId" id="modalUserId" value="" />
									<div class="row">
										<div class="col-md-12">
											<?php
											for ($i = 0; $i < count($badges); $i++) {
												if (isset($badges[$i]) && isset($badges[$i]['name'])) {
											?>
													<div class="form-check form-check-inline">
														<input class="form-check-input searchterm mdlRdoBtn" type="radio" id="badgeRd<?php echo $badges[$i]['id'] ?>" name="userBadge" value="<?php echo $badges[$i]['id'] ?>" />
														<label class="form-check-label" for="inlineRadio1"><?php echo $badges[$i]['name'] ?></label>
													</div>
											<?php
												}
											}
											?>
										</div>
										<div class="col-md-12">
											<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
											<button type="submit" class="btn btn-success mr-2 theme_btn">Submit</button>
										</div>

									</div>

								</form>
							<?php } else { ?>
								<p>No Badge Found</p>
							<?php } ?>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<!-- start  -->

	<div class="modal fade" id="setCommission" tabindex="-1" role="dialog" aria-labelledby="change-listing" aria-hidden="true">
		<div class="modal-dialog modal-danger modal-dialog-centered modal-lg" role="document">
			<div class="modal-content bg-gradient-danger">
				<div class="modal-header">
					<h3 id="setCommissionH3">Assign Badge</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>

				<div class="card">
					<div class="card-body">
						<!---card--->
						<div class="modal-body">
							<form action="<?php echo site_url('admin/save_user_commission'); ?>" method="post" id="commissionForm" novalidate>
								<input type="hidden" name="commissionUserId" id="commissionUserId" value="" />

								<div class="submit-field d-flex flex-row">
									<h5>Commission Price : </h5>
									<input type="text" id="commissionTxt" name="admin_commission" value="" class="with-border numberOnly col-md-8 ml-4" placeholder="Enter Commission" required>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="submit-field commission_div_a flex-row d-flex">
											<h5>Commission Type : </h5>
											<div class="form_commission_a">
												<div class="form-check-inline">
													<input type="radio" name="commission_type" class="form-check-input commission_type_a commissionRd1" value="1" required>
													<label class="form-check-label">
														Fixed
													</label>
												</div>
												<div class="form-check-inline">
													<input type="radio" name="commission_type" class="form-check-input commission_type_a commissionRd2" value="2" required>
													<label class="form-check-label">
														Percentage
													</label>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
									<button type="submit" class="btn btn-success mr-2 theme_btn">Submit</button>
								</div>

							</form>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	</div>

	<!-- end -->


	<!--------------------------------------------------------------------------------------------------------------->
	<?php $this->load->view('main/includes/footerscripts'); ?>

	<?php if (isset($define_type) && $define_type == 'admin_user') {
	?>

		<script>
			customeLoadUserData();
		</script>
	<?php } else { ?>
		<script>
			loadUserData();
		</script>
	<?php } ?>

	<!--------------------------------------------------------------------------------------------------------------->

</body>

</html>