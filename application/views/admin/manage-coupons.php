<!DOCTYPE html>
<html lang="en">

<head>

	<!--Admin Page Meta Tags-->
	<title>Manage Coupons | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
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
							<i class="mdi mdi-pipe"></i>
							<h3>Manage Coupons</h3>
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
							<li><a href="javascript:void(0);">Manage Coupons</a></li>
						</ul>
					</nav>


					<!-- Row -->
					<div class="row">

						<!-- Dashboard Box -->
						<div class="col-xl-12">
							<div class="dashboard-box margin-top-0">

								<!-- Headline -->
								<div class="headline">
									<h3>Manage Coupons</h3>
								</div>

								<!----- Content --->
								<div class="card">
									<div class="card-body">
										<form id="couponForm" method="post" enctype="multipart/form-data" />

										<input type="hidden" class="form-control" id="id" name="id" />
										<div class="col-xl-12 mb-2 percentage_section_a">
											<div class="form-check form-check-inline">
												<input class="form-check-input searchterm mdlRdoBtn" type="radio" id="discountPercentage" name="discountType" value="0" />
												<label class="form-check-label" for="inlineRadio1">Percentage</label>
											</div>
											<div class="form-check form-check-inline">
												<input class="form-check-input searchterm mdlRdoBtn" type="radio" id="discountFixed" name="discountType" value="1" checked="checked" />
												<label class="form-check-label" for="inlineRadio1">Fixed Amount</label>
											</div>
											
										</div>

										<div class="col-xl-12">
											<div class="submit-field">
												
												<input type="text" class="with-border" id="amount" name="amount" placeholder="Amount" required="true">
											</div>
										</div>

										<div class="col-xl-12">
											<div class="submit-field">
												<label for="name">Discount Code</label>
												<input type="text" class="with-border" id="discount_code" name="discount_code" placeholder="Discount Code" required="true">
											</div>
										</div>

										<div class="col-xl-12">
											<div class="submit-field">
												<label for="name">Valid From (Date format: YYYY-MM-DD like 2020-10-26)</label>
												<input type="text" class="with-border datapickerNormal" id="valid_from" name="valid_from" placeholder="Valid From" value="<?php echo date('Y-m-d') ?>" required="true" readonly="readonly" />
											</div>
										</div>
										<div class="col-xl-12">
											<div class="submit-field">
												<label for="name">Valid Till</label>
												<input type="text" class="with-border datapickerNormal" id="valid_till" name="valid_till" placeholder="Valid Till" readonly="readonly" required="true" />
											</div>
										</div>

										<div class="col-xl-12">
											<div class="form-check form-check-inline">
												<input class="form-check-input searchterm mdlRdoBtn" type="radio" name="status" value="0" />
												<label class="form-check-label" for="inlineRadio1">Disabled</label>
											</div>
											<div class="form-check form-check-inline">
												<input class="form-check-input searchterm mdlRdoBtn" type="radio" name="status" value="1" checked="checked" />
												<label class="form-check-label" for="inlineRadio1">On</label>
											</div>
										</div>

										<div class="d-flex justify-content-end mb-3">
											<a href="<?php echo site_url('admin/manage-coupons') ?>" class="btn theme_btn mr-2">Reset</a>
											<button type="submit" name="btn_categorysave" id="btn_save" class="btn btn-success mr-2 btntheme_color_a ">Save</button>
										</div>

										<div id="categoriesSettingsMsg" class="message_section_a"></div>
										<span id="loadingCategories" style="display:none;"> <img src="<?php echo base_url(); ?>assets/img/loadingimage.gif" /> </span>

										<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

										</form>

									</div>
									<!----- /Content --->

									<!----- PAGES ---------------->
									<div class="row manage_coupons_page_in_a">
										<div class="col-xs-24 col-sm-24 col-md-24 col-lg-12 col-xl-12">
											<div class="card mb-3">
												<div class="card-body">
													<div class="table-responsive">
														<table id="tbl_couponsData" class="table table-striped table-hover responsive">
															<thead>
																<tr>
																	<th>Type</th>
																	<th>Amount</th>
																	<th>code</th>
																	<th>Valid</th>
																	<th>Status</th>
																	<th>Created At</th>
																	<th>Edit</th>
																	<th>DELETE</th>
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
	<script>
		loadCouponsData();
	</script>
	<!--------------------------------------------------------------------------------------------------------------->

</body>

</html>