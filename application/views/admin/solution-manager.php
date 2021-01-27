<!DOCTYPE html>
<html lang="en">

<head>

	<!--Admin Page Meta Tags-->
	<title>Solution Category Manager | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
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
				        <i class="mdi mdi-pipe"></i>  <h3>Solution Category Manager</h3>
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
								<li><a href="#">Solution Category Manager</a></li>
							</ul>
						</nav>
					

					<!-- Row -->
					<div class="row">

						<!-- Dashboard Box -->
						<div class="col-xl-12">
							<div class="dashboard-box margin-top-0">

								<!-- Headline -->
								<div class="headline">
									<h3>Solution Category Manager</h3>
								</div>

								<!----- Content --->
								<div class="card">
									<div class="card-body">
										<form id="SolutionCategoryForm" method="post" enctype="multipart/form-data" />
										<div class="col-xl-12">
											<div class="submit-field">
												<h4>Solution Category Name <span class='text-danger'>*</span></h4>
												<input type="text" class="with-border" id="category_name" name="category_name" placeholder="Solution Category Name" required="true">
												<input type="hidden" class="form-control" id="category_id" name="category_id">
												<span class="helper">It become main category if not selected Main Category Solutions</span>
											</div>
										</div>
										
										<div class="col-xl-12 mainCategory">
											<div class="submit-field">
												<h4>Main Category Solution</h4>
												<select name="parent_id" id="admin_solution_category" class="with-border">
													<option value="">Optional Select Category</option>
													<?php
													foreach ($mainCategories as $cat) {
														if (!empty($cat)) {
															$selected = '';
															if ($category_id == $cat['id']) {
																$selected = 'selected';
															}
															echo '<option value="' . $cat['id'] . '"' . $selected . '>' . $cat['c_name'] . '</option>';
														}
													}
													?>
												</select>
											</div>
										</div>



										<div class="col-xl-12">
											<div class="submit-field">
												<h4>Solution Meta Description <span class='text-danger'>*</span></h4>
												<textarea rows="8" class="with-border" cols="60" name="category_meta_description" id="category_meta_description" maxlength="150" required="true"></textarea>
											</div>
										</div>

										<div class="col-xl-12">
											<div class="submit-field">
												<h4>Solution Meta Keywords <span class='text-danger'>*</span><code> (each keyword should be seperated by a comma )</code></h4>
												<textarea rows="3" class="with-border" cols="60" name="category_meta_keywords" id="category_meta_keywords" maxlength="150" required="true"></textarea>
											</div>
										</div>

										<div class="col-xl-12">
											<div class="submit-field">
												<h4>Solution Image</h4>
												<div class="uploadButton margin-top-30">
													<input class="uploadButton-input-cover" type="file" accept="image/*" id="uploadListingImage" name="uploadListingImage" />
													<label class="uploadButton-button ripple-effect" for="uploadListingImage">Upload Icon Image</label>
													<span class="uploadButton-file-name-cover"><b>Icon png image</b></span>
												</div>
											</div>
										</div>

										<div class="col-xl-12 d-none">
											<div class="submit-field">
												<h4 for="category_url_slug">URL SLUG <span class='text-danger'>*</span><span class='text-danger'>*</span></h4>
												<input type="text" class="with-border" id="category_url_slug" name="category_url_slug" placeholder="URL Slug" readonly="true" required="true">
											</div>
										</div>

									
										 <div class="col-xl-12 d-none">
											<div class="submit-field">
												<h3>Sub-Category Solution <span class='text-danger'>*</span></h3>
												<select class="required" name="sub_category_id" id="sub_category" class="selectpicker with-border">
													<?php if (isset($subCategories) && !empty($subCategories)) : ?>
														<?php
														foreach ($subCategories as $subCategory) {
															if (!empty($subCategory)) {
																$selected = '';
																if ($service_type_id == $subCategory['id']) {
																	$selected = 'selected';
																}
																echo '<option value="' . $subCategory['id'] . '"' . $selected . '>'  . $subCategory['c_name'] . '</option>';
															}
														}
														?>
													<?php else : ?>
														<option value=''>Select SubCategory</option>
													<?php endif; ?>
												</select>
											</div>
										</div> 

										<div class="d-flex justify-content-end save_button_resent_a pb-4">
											<a href="<?php echo site_url('admin/category_service_type') ?>" class="btn theme_btn mr-2">Reset</a>
											<button type="submit" name="btn_categorysave" id="btn_save" class="btn btn-success mr-2">Save</button>
										</div>

										
										<div id="categoriesSettingsMsg"></div>
										<span id="loadingCategories" style="display:none;"> <img src="<?php echo base_url(); ?>assets/img/loadingimage.gif" /> </span>

										<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

										</form>
									</div>
								</div>
								<!----- /Content --->

								<!----- PAGES ---------------->
								<div class="row">
									<div class="col-xs-24 col-sm-24 col-md-24 col-lg-12 col-xl-12">
										<div class="card mb-3">
											<div class="card-body">
												<div class="table-responsive">
													<table id="tbl_categoriesData" class="table table-striped table-hover responsive">
														<thead>
															<tr>
																<th>CATEGORY</th>
																<th>PARENT CATEGORY</th>
																<th>IMAGE</th>
																<th>EDIT</th>
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
		loadSolutionCategoryData();
	</script>
	<!--------------------------------------------------------------------------------------------------------------->

</body>

</html>