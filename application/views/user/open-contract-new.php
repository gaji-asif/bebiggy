<!DOCTYPE html>
<html lang="<?php if (!empty($language)) echo $language;
			else echo 'en'; ?>">

<head>

	<!--User Page Meta Tags-->
	<title>Transaction | <?php echo $this->lang->line('site_name') ?>| User Dashboard</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="icon" href="<?php if (isset($imagesData[0]['favicon'])) echo base_url() . ADMIN_IMAGES . $imagesData[0]['favicon']; ?>" alt="favicon" />
	<meta name="robots" content="noindex">
	<!--User Page Meta Tags-->

	<!--------------------------------------------------------------------------------------------------------------->
	<?php $this->load->view('main/includes/headerscripts'); ?>
	<!--------------------------------------------------------------------------------------------------------------->

</head>

<body class="gray" onload="bootChat();load_thread(<?php if (isset($contract[0]['user_id'])) echo $contract[0]['user_id']; ?>);">

	<!-- Wrapper -->
	<div id="wrapper">

		<!--------------------------------------------------------------------------------------------------------------->
		<div class="clearfix"></div>
		<!--------------------------------------------------------------------------------------------------------------->


		<!-- Dashboard Container -->
		<!--------------------------------------------------------------------------------------------------------------->
		<div class="dashboard-container">
			<?php $this->load->view('user/includes/sidebar'); ?>
			<!--------------------------------------------------------------------------------------------------------------->

			<div class="dashboard-content-container" data-simplebar>
				<div class="dashboard-content-inner">
					<div class="dashboad_table">


						<div class="ml-auto dropdown user_name">
							<div class="get_user dropdown-toggle" data-toggle="dropdown">GP</div>
							<div class="dropdown-menu">
								<a href="<?php echo site_url('user/user_settings'); ?>" class="dropdown-item"><i class="icon-material-outline-settings"></i> Settings</a>
								<li class="divider"></li>
								<a href="<?php echo site_url('user/change_password'); ?>" class="dropdown-item"><i class="icon-material-outline-lock"></i> Change Password</a>
								<a href="<?php echo site_url('user/logout') ?>" class="dropdown-item"><i class="icon-material-outline-power-settings-new"></i> Logout</a>

							</div>
						</div>
					</div>

					<!-- Dashboard Headline -->

					<div id="paymentView" class="row">

						<div class="col-xl-12">
							<div class="dashboard-box margin-top-0">
								<div class="content">

									<!-------EnDs---------------->
								</div>
							</div>
						</div>

					</div>

					<!-- Row -->

					<div id="contract_history" class="row">

						<!-- Dashboard Box -->
						<div class="col-xl-12">
							<div class="dashboard-box margin-top-0">

								<!-- Headline -->
								<div class="headline">
									<h3>Transaction History</h3>
								</div>
								<div id="negotiations_table" class="bs-example container" data-example-id="striped-table">
									<table class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>#</th>
												<th style="width: 13%">Date</th>
												<th>Transaction Id</th>
												<th>Status</th>
												<th>Listing Name</th>
												<th>Listing Id</th>
												<th>Listing Status</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($contract)) {
												$i = 1;
												foreach ($contract as $row) {
													// var_dump($row);
													// exit; 
											?>
													<tr>
														<th scope="row"><?php echo $i; ?></th>

														<td><?php if (!empty($row['date'])) echo date('Y-m-d', strtotime($row['date'])); ?></td>
														<td><?php if (!empty($row['contract_id'])) { ?><a href="<?php echo site_url('user/contract/' . $row['contract_id']); ?>">Transaction - #<?php echo $row['contract_id']; ?> </a> <?php } ?></td>
														<td></td>
														<td><?php if (!empty($row['website_BusinessName'])) echo $row['website_BusinessName']; ?></td>
														<td><?php if (!empty($row['listing_id'])) echo $row['listing_id']; ?></td>

														<td></td>

													</tr>

											<?php $i++;
												}
											} ?>

										</tbody>
									</table>
								</div>
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


	<!-----------------Common Models -------------------------------------------------------------------------------->
	<?php $this->load->view('user/includes/models'); ?>
	<!--------------------------------------------------------------------------------------------------------------->
	<!--------------------------------------------------------------------------------------------------------------->
	<?php $this->load->view('main/includes/footerscripts'); ?>
	<script>
		dateval = <?php echo date("Y", strtotime($contract[0]['delivery_time'])); ?> + '-' + <?php echo date("m", strtotime($contract[0]['delivery_time'])); ?> + '-' + <?php echo date("d", strtotime($contract[0]['delivery_time'])); ?>;
		timeval = <?php echo date("H", strtotime($contract[0]['delivery_time'])); ?> + ':' + <?php echo date("i", strtotime($contract[0]['delivery_time'])); ?>;

		timeleft();
	</script>
	<!--------------------------------------------------------------------------------------------------------------->

</body>

</html>