<!DOCTYPE html>
<html lang="en">

<head>

	<!--Admin Page Meta Tags-->
	<title>Manage Advertisements | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
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
							<h3>Manage Advertisements</h3>
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
							<li><a href="javascript:void(0);">Manage Advertisements</a></li>
						</ul>
					</nav>


					<!-- Row -->
					<div class="row">

						<!-- Dashboard Box -->
						<div class="col-xl-12">
							<div class="dashboard-box margin-top-0">

								<!-- Headline -->
								<div class="headline">
									<h3>Manage Advertisements</h3>
								</div>

								<!----- Content --->
								<div class="card">
									<div class="card-body">
										<form id="manageAdvertisementForm" method="post" enctype="multipart/form-data" />

										<div class="col-xl-12">
											<div class="submit-field">
												<label for="name">Type</label>
												
												<select class="with-border" name="type" required="true" onchange="choseType(this.value);">
													<option value="listing_detail_page_left_side">Listing Detail Page Left Side</option>
													<option value="listing_detail_page_right_side">Listing Detail Page Right Side</option>
													<option value="course_detail_page_left_side">Course Detail Page Left Side</option>
													<option value="course_detail_page_right_side">Course Detail Page Right  Side</option>
													<!-- <option value="blog_detail_page_left_side">Blog Detail Page Left Side</option>
													<option value="blog_detail_page_right_side">Blog Detail Page Right Side</option> -->
													<option value="text_below_main_menu">Text Below Main Menu</option>
												</select>
												<input type="hidden" class="form-control" id="id" name="id">
											</div>
										</div>

										
										<div class="col-xl-12" id="imageDiv">
											<div class="submit-field">
												<h5>Image (For left side image, recommended width of banner is 723px and for left side image, recommended height of banner is 353px)</h5>
												<h5>Image (For  right or bottom side image, recommended width of banner is 300px and for left side image, recommended width of banner is 350px)</h5>
												<div class="uploadButton margin-top-30">
													<input class="uploadButton-input-cover" type="file" accept="image/*" id="uploadListingImage" name="uploadListingImage" />
													<label class="uploadButton-button ripple-effect" for="uploadListingImage">Upload Icon Image</label>
													<span class="uploadButton-file-name-cover"><b>png/jpg image</b></span>
												</div>
											</div>
										</div>

										<div class="col-xl-12" id="text_below_main_menu" style="display: none;">
											<div class="submit-field">
												<h5>Text (Enter maximum 50 characters)</h5>
												<input type="text" class="with-border" id="text_below_main_menu_input" name="text_below_main_menu" value="" />
											</div>
										</div>


										<div class="d-flex justify-content-end">
											<a href="<?php echo site_url('admin/manage-badges') ?>" class="btn theme_btn mr-2">Reset</a>
											<button type="submit" name="btn_categorysave" id="btn_save" class="btn btn-success mr-2">Save</button>
										</div>

										<div id="categoriesSettingsMsg"></div>
										<span id="loadingCategories" style="display:none;"> <img src="<?php echo base_url(); ?>assets/img/loadingimage.gif" /> </span>

										<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

										</form>

									</div>
									<!----- /Content --->

									<!----- PAGES ---------------->
									<div class="row manage_advertisementspage_a">
										<div class="col-xs-24 col-sm-24 col-md-24 col-lg-12 col-xl-12">
											<div class="card mb-3">
												<div class="card-body">
													<div class="table-responsive">
														<table id="tbl_manageAdvertisementData" class="table table-striped table-hover responsive">
															<thead>
																<tr>
																	<th>Type</th>
																	<th>Image/Text</th>
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
			loadManageAdvertisementsData();

			function choseType(val) {
				if(val == "text_below_main_menu") {
					$('#text_below_main_menu').show();
					$('#imageDiv').hide();
				} else {
					$('#imageDiv').show();
					$('#text_below_main_menu_input').val('');
					$('#text_below_main_menu').hide();
				}
			}
		</script>
		<!--------------------------------------------------------------------------------------------------------------->

</body>

</html>