<!DOCTYPE html>
<html lang="<?php if (!empty($language)) echo $language;
			else echo 'en'; ?>">

<head>

	<!--User Page Meta Tags-->
	<title>Manage Solutions Listings | <?php echo $this->lang->line('site_name') ?>| User Dashboard</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="icon" href="<?php if (isset($imagesData[0]['favicon'])) echo base_url() . ADMIN_IMAGES . $imagesData[0]['favicon']; ?>" alt="favicon" />
	<meta name="robots" content="noindex">
	<!--User Page Meta Tags-->

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
			<?php $this->load->view('user/includes/sidebar'); ?>
			<!--------------------------------------------------------------------------------------------------------------->
			<div class="dashboard-content-container" data-simplebar>
				<div class="dashboard-content-inner">

					<!-- Dashboard Headline -->
					<div class="dashboard-headline">

						<div class="dashboad_table">
							<i class="icon-material-outline-business-center"></i>
							<h3>Manage Solutions Listings</h3>
							<div class="ml-auto dropdown user_name">
								<div class="get_user dropdown-toggle" data-toggle="dropdown">GP</div>
								<div class="dropdown-menu">
									<a href="<?php echo base_url(); ?>user/user_settings" class="dropdown-item"><i class="icon-material-outline-settings"></i> Settings</a>
									<li class="divider"></li>
									<a href="<?php echo base_url(); ?>user/change_password" class="dropdown-item"><i class="icon-material-outline-lock"></i> Change Password</a>
									<a href="<?php echo base_url(); ?>user/logout" class="dropdown-item"><i class="icon-material-outline-power-settings-new"></i> Logout</a>
								</div>
							</div>
						</div>

						<!-- Breadcrumbs -->
						<nav id="breadcrumbs" class="dark">
							<ul>
								<li><a href="<?php echo site_url('user/dashboard'); ?>">Dashboard</a></li>
								<li>Manage Solutions Listings</li>
							</ul>
						</nav>
					</div>
					<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

					<!-- Row -->
					<div class="row">

						<!-- Dashboard Box -->
						<div class="col-xl-12">
							<div class="dashboard-box margin-top-0">

								<!-- Headline -->
								<div class="headline">
									<h3><i class="icon-material-outline-assignment"></i> Solutions Listings</h3>
									<div class="">
										<input type="text" name="search" id="solutionSearch" placeholder="Search">
									</div>
								</div>

								<div id="body_content">
									<div class="content">

										<div class="table-responsive solutions_listings">
											<table class="table table-head-fixed table-border table-hover table-striped table-condensed">
												<thead>
													<tr>
														<th><a href="javascript:void(0);" class="tblMnu">Name</a></th>
														<th><a href="javascript:void(0);" class="tblMnu">ServiceType</a></th>
														<th><a href="javascript:void(0);" class="tblMnu">Category</a></th>
														<th><a href="javascript:void(0);" class="tblMnu">Price</a></th>
														<th><a href="javascript:void(0);" class="tblMnu">Date</a></th>
														<th><a href="javascript:void(0);" class="tblMnu">Status</a></th>
														<th><a href="javascript:void(0);" class="tblMnu">Action</a></th>
												</thead>
												<tbody>
													<?php if (!empty($solutionListing['solution'])) {
														foreach ($solutionListing['solution'] as $listing) { ?>

															<tr>
																<td><?php echo _str_limit($listing['name'],10); ?></td>
																<td><?php echo $listing['service_type']; ?></td>
																<td><?php echo $listing['category']; ?></td>
																<td><?php echo $listing['price']; ?></td>
																<td><?php echo $listing['date']; ?></td>
																<td>
																	<?php if ($listing['status'] != 9) : ?>
																		Approved
																	<?php else :  ?>
																		Approval Pending
																	<?php endif; ?>
																</td>
																<td>
																	<a href="<?php echo base_url('user/create_solution/solution/' . $listing['id']); ?>" title="Edit">
																		<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> | <a href="javascript:void(0);" id="deleteSolution" data-url='user/deleteSolution'' data-id="<?php echo $listing['id'] ?>" title="Delete"> <i class="fa fa-trash" aria-hidden="true"></i></a>
															</td>
															</tr>
													<?php  }
													} else echo '<li>Sorry !! No Listings are available</li>'; ?>
													<!-- set bundle id just for show side icon-->
												</tbody>
											</table>
										</div>
										<!-- End Listing -->

										<!-- Pagination -->
										<div class="clearfix"></div>
										<div class="pagination-container margin-top-40 margin-bottom-10 centerButtons">
											<nav class="pagination">
												<ul>
													<?php if (isset($links)) {
														echo $links;
													}
													?>
												</ul>
											</nav>
										</div>
										<!-- Pagination / End -->

									</div>
									<!--  content / end  -->

								</div>
								<!-- body_content / end -->
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


	<!--------------------------------------------------------------------------------------------------------------->
	<?php $this->load->view('main/includes/footerscripts'); ?>
	<!--------------------------------------------------------------------------------------------------------------->

</body>

</html>