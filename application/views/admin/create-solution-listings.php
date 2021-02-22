<!DOCTYPE html>
<html lang="<?php if (!empty($language)) echo $language;
			else echo 'en'; ?>">

<head>

	<!--Admin Page Meta Tags-->
	<title>Solution Listing | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="icon" href="<?php if (isset($imagesData[0]['favicon'])) echo base_url() . ADMIN_IMAGES . $imagesData[0]['favicon']; ?>" alt="favicon" />
	<meta name="robots" content="noindex">
	<!--User Page Meta Tags-->

	<!--------------------------------------------------------------------------------------------------------------->
	<?php $this->load->view('main/includes/headerscripts'); ?>
	<!--------------------------------------------------------------------------------------------------------------->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dropzone.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dropzone_basic.css">
	<style>
		.select2-selection__rendered li input,
		.select2-container {
			width: 100% !important;
		}

		.select2-results__options {
			height: 250px;
			overflow: scroll !important;
		}
	</style>
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


			<!-- Dashboard Content -->
			<!-------------------------------------------------------------------------------------------------------------->
			<div class="dashboard-content-container" data-simplebar>
				<div class="dashboard-content-inner createpage_page">

					<!-- Dashboard Headline -->
					<div class="dashboard-headline create_post_page_headline">

						<div class="dashboad_table">
							<i class="mdi mdi-book"></i>
							<h3>Edit Solution</h3>
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
							<li><a href="#">Edit Solution</a></li>
						</ul>
					</nav>


					<?php isset($solution_data['solution'][0]) ? extract($solution_data['solution'][0]) : ''; ?>
					<!-- Row -->
					<div class="row create_solution">
						<!-- Dashboard Box -->
						<!-- overview start -->
						<div class="col-md-12">
							<div class="post_box">
								<ul class="nav nav-tabs user_new_post">
									<li><a data-toggle="tab" href="#home" class="active eventBlock"><i class="fa fa-pencil" aria-hidden="true"></i> <span>Basicinfo</span></a></li>
									<li><a data-toggle="tab" href="#menu1" class="eventBlock" <?php //echo  isset($id) ? '' : 'class="eventBlock"' 
																								?>><i class="fa fa-file-image-o" aria-hidden="true"></i> Media</a></li>
									<li><a data-toggle="tab" href="#menu2" class="eventBlock" <?php //echo  isset($id) ? '' : 'class="eventBlock"' 
																								?>><i class="fa fa-th-list" aria-hidden="true"></i> Category</a></li>
									<li><a data-toggle="tab" href="#menu3" class="eventBlock" <?php //echo  isset($id) ? '' : 'class="eventBlock"' 
																								?>><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Price</a></li>
								</ul>

								<div class="tab-content">
									<div id="home" class="tab-pane in active">
										<div class="col-md-12 create_post p-0 add_listing_a">
											<div class="col-md-12 p-0">

												<form id="solutionFormStep12" method="post" enctype="multipart/form-data">
													<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
													<input type="hidden" name="solution_id" id="solution_id" value="<?php echo  $id ?? '' ?>">
													<input type="hidden" name="step" value='1'>
													<input type="hidden" name="domain_id" value='<?php echo $domain_id ?? '';  ?>'>
													<input type="hidden" name="list_id" id="list_id" value="<?php echo  $list_id ?? '' ?>">


													<div id="SolutionUrlValMsg"></div>
													<div class="form-group">
														<input type="text" name="solution_url" class="form-control solution_url" id="txt_solution_url" maxlength="200" placeholder="Enter Soultion URL " value="<?php echo $solution_url ?? '' ?>">
														<span class="helper-text">Allowed URL Website,App,Domain (Optional) </span>
													</div>
													<div class="form-group">
														<input type="text" name="name" class="form-control solution_name" id="txt_solution_title" maxlength="200" placeholder="Enter Soultion name *" required value="<?php echo $name ?? '' ?>">
														<span class="helper-text">max length is 200 character</span>
													</div>

													<div class="form-group">
														<input type="text" name="slug" class="form-control solution_name" id="txt_solution_url_slug" onchange="updateSlug()" maxlength="200" placeholder="Enter slug" required value="<?php echo $slug ?? '' ?>">
														<span class="helper-text">max length is 200 character</span>
													</div>

													<div class="form-group">
														<h5>Tell us about your Solution so potential buyers get excited<span>(Important)</span> <i class="help-icon" data-tippy-placement="right" title="Be Descriptive. Add everything you think which is important"></i></h5>
														<textarea id="tiny-editor" name="description" rows="5" cols="60" class="form-control"><?php echo $description ?? '' ?></textarea>
													</div>
													<button type="submit" id="solution_step12" class="mt-2 btn btn-primary submit_post">Next</button>
												</form>
											</div>


										</div>

									</div>
									<div id="menu1" class="tab-pane">
										<div class="pt-4">


											<?php
											// check file permission 
											CheckFilePermissionOrgenerateAlert(IMAGES_UPLOAD);
											?>
										</div>
										<div class="title_text">
											<center>
												<p style="margin-bottom: 0px;">Lets add Visuals image file for solutions. </p>
											</center>
											<span class="ext-not-except"></span>
										</div>
										<div class="col-md-12 files-uploads">

											<div class="dropzone dropzone-previews" id="myDropzone"></div>
											<div class="title_text"> upload multiple files here (max limit 1Mb)</div>
											<input type="hidden" name="solution_id" value="<?php echo  $id ?? '' ?>">
											<input type="hidden" name="domain_id" value='<?php echo $domain_id ?? '';  ?>'>
											<input type="hidden" name="list_id" id="list_id" value="<?php echo  $list_id ?? '' ?>">

											<!--   submit form --->

											<div class="row">
												<div class="col-xs-12 col-sm-12 col-md-6">
													<button type="submit" id="solution_step_2" class=" btn btn-primary submit_post float-left">Previous</button>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-6">
													<button type="submit" id="solution_step22" class="btn btn-primary submit_post float-right">Next</button>
												</div>
											</div>
										</div>
										<div class="solution_image_ajax">
											<?php if (isset($solution_data) && count($solution_data) > 0) : ?>
												<div class="row mt-5">
													<?php foreach ($solution_data['solutions_media'] as $file) : ?>
														<?php $fileName =  base_url() . IMAGES_UPLOAD . $file['name']; ?>
														<div id="<?php echo 'file_' . $file['id']; ?>" class="image_task mt-5 d-block">
															<?php if (!fileIcon($file['ext'])) : ?>
																<a href="javascript:void(0)" class="solution_file_admin" data-id="<?php echo 'file_' . $file['id']; ?>"><i class="fa fa-times" aria-hidden="true"></i></a>
																<embed src="<?php if (isset($file['name'])) echo $fileName; ?>" type="<?php echo $file['mime']; ?>" width="100" height="100" class="d-block" />
																<span><?php echo  _str_limit($file['name'], 15); ?></span>
															<?php else : ?>
																<a href="javascript:void(0)" class="solution_file_admin" data-id="<?php echo 'file_' . $file['id']; ?>"><i class="fa fa-times" aria-hidden="true"></i></a>
																<span class="d-block"> <a href="javascript:void(0)" data-id="<?php echo 'file_' . $file['id']; ?>"><?php echo fileIcon($file['ext']); ?></i></a></span>
																<span><?php echo  _str_limit($file['name'], 15); ?></span>
															<?php endif; ?>
														</div>
													<?php endforeach; ?>
												</div>
											<?php endif;  ?>
										</div>

									</div>
									<div id="menu2" class="tab-pane">
										<div class="title_text">
											<center>
												<p>Fill category information for your given solutions .</p>
											</center>
										</div>
										<div class="submit-field category_post">
											<form id="solutionFormStep32" method="post" enctype="multipart/form-data">
												<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
												<input type="hidden" name="solution_id" value="<?php echo $id ?? ''; ?>" />
												<input type="hidden" name="step" value='3'>
												<input type="hidden" name="domain_id" value='<?php echo $domain_id ?? '';  ?>'>
												<input type="hidden" name="list_id" id="list_id" value="<?php echo  $list_id ?? '' ?>">


												<div class="col-md-12">
													<div class="submit-field">
														<h5>CATEGORY *</h5>
														<select class="required" name="category_id" id="solution_category_admin" class="selectpicker with-border">
															<option value="">Select Category</option>
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

												<div class="col-md-12">
													<div class="submit-field">
														<h5>SUB CATEGORY </h5>
														<select class="" name="sub_category_id" id="sub_category" class="selectpicker with-border">

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
												<div class="col-md-12">
													<div class="submit-field">
														<h5>SERVICE TYPE *</h5>
														<select class="required" name="service_type_id" id="server_type" class="selectpicker with-border">

															<option value=''>Select Service type</option>
															<?php
															foreach ($serviceTypes as $servicetype) {
																if (!empty($servicetype)) {
																	$selected = '';
																	if ($service_type_id == $servicetype['id']) {
																		$selected = 'selected';
																	}
																	echo '<option value="' . $servicetype['id'] . '"' . $selected . '>'  . $servicetype['c_name'] . '</option>';
																}
															}
															?>
														</select>
													</div>
												</div>
												<div class="col-xl-12">
													<div class="submit-field">
														<h5>Page Tags</h5>
														<input type="text" id="page_tags" name="page_tags" value="<?php if (isset($solution_data['solution'][0]['page_tags'])) echo $solution_data['solution'][0]['page_tags'];  ?>" class="form-control" placeholder="Put comma separated tags" />
													</div>

												</div>

												<div class="row next_previous_a">
													<div class="col-xs-12 col-sm-12 col-md-6">
														<button type="submit" id="solution_step_3" class="btn btn-primary submit_post float-left ">Previous</button>
													</div>
													<div class="col-xs-12 col-sm-12 col-md-6">

														<button type="submit" id="solution_step32" class="btn btn-primary submit_post">Next</button>
													</div>
												</div>


											</form>

										</div>

									</div>
									<div id="menu3" class="tab-pane">
										<div class="title_text">
											<center>
												<p>Fill selling process for your given solutions .</p>
											</center>
										</div>


										<form id="solutionFormStep42" method="post" enctype="multipart/form-data">
											<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
											<input type="hidden" name="solution_id" value="<?php echo $id ?? ''; ?>" />
											<input type="hidden" name="step" value='4'>
											<input type="hidden" name="domain_id" value='<?php echo $domain_id ?? '';  ?>'>
											<input type="hidden" name="list_id" id="list_id" value="<?php echo  $list_id ?? '' ?>">


											<!-- start -->
											<div class="row">
												<div class="col-md-6 col-sm-12">
													<div class="submit-field">

														<h5 for="price" class="price">Price (<?php if (!empty($default_currency)) echo $default_currency;
																								else echo '$'; ?>) <span class='text-danger'>*</span></h5>
														<input onkeyup="showPriceCommissionSoln()" id="website_buynowprice_soln" type="text" name="price" class="form-control numeric_validation required" id="price" placeholder="No of days" required value="<?php echo $original_buynowprice ?? '' ?>" required>

													</div>
												</div>

												<!--   commission div-->
												<div class="col-md-6 col-sm-12">
													<div class="submit-field">
														<h5 for="price" class="price">View Price ($) <span class='text-danger required'>*</span></h5>
														<input name='view_price' id="view_buynow" class="form-control" value="<?php echo $price ?? '' ?>">
													</div>
												</div>

												<div id="Sell-Classified-Website" class="row w-100 asing_price_section_a">
													<?php  ?>
													<div class="col-xl-4 col-md-4">
														<div class="submit-field">
															<h5>Commission Type</h5>
															<?php
															$commission_type_1 = '';
															if (!empty($commission_type)) {
																if ($commission_type == 1) {
																	$commission_type_1 = "Fixed";
																}
																if ($commission_type == 2) {
																	$commission_type_1 = "Percentage";
																}
															}
															?>
															<select onchange="showPriceCommissionSoln()" id="commission_type_soln" name="commission_type" class="form-control with-border ">

																<?php if (!empty($commission_user_product)) {
																	if ($commission_user_product == 2) {
																		foreach (COMMISSION_TYPE as $k => $v) : ?>
																			<option value="<?php echo $k; ?>" <?php if (trim($v) == trim($commission_type_1)) echo 'selected'; ?>> <?php echo $v ?> </option>
																		<?php endforeach;
																	} else if (!empty($commission_type) && $commission_user_product == 1) {  ?>
																		<option value="<?php echo $commission_type; ?>"> <?php echo $commission_type_1 ?> </option>
																		<?php  } else {
																		foreach (COMMISSION_TYPE as $k => $v) : ?>
																			<option value="<?php echo $k; ?>" <?php if (trim($v) == trim($commission_type_1)) echo 'selected'; ?>> <?php echo $v ?> </option>
																		<?php endforeach;
																		?>

																	<?php }
																} else { ?>
																	<option value="1">Fixed</option>
																<?php } ?>
															</select>
														</div>
													</div>
													<div class="col-xl-4 col-md-4">
														<div class="submit-field">
															<h5>Commission Amount (<?php if (!empty($default_currency)) echo $default_currency;
																					else echo '$'; ?>)</h5>
															<input onkeyup="showPriceCommissionSoln()" id="commission_amount_soln" name="commission_amount" class="form-control with-border " <?php if ($commission_user_product == 1) echo 'readonly';  ?> placeholder="0" value="<?php if (isset($commission_amount)) echo $commission_amount; ?>" onkeypress='validateInputNumbers(event)'>

														</div>
													</div>
													<div class="col-xl-4 col-md-4">
														<div class="submit-field">
															<h5>Commission Base </h5>
															<?php
															if (!empty($commission_user_product)) {
																if ($commission_user_product == 1) {
																	$commission_user_product = "User Profile";
																}
																if ($commission_user_product == 2) {
																	$commission_user_product = "Product";
																}
															}   ?>
															<!-- COMMISSION_BASE -->
															<select class="form-control with-border" name="commission_base" id="commission_base_soln">
																<?php foreach (COMMISSION_BASE as $k => $v) : ?>
																	<option value="<?php echo $k; ?>" <?php if (trim($v) == trim($commission_user_product)) echo 'selected'; ?>> <?php echo $v ?> </option>
																<?php endforeach; ?>
															</select>
														</div>
													</div>

												</div>

												<!--  commission div end  -->
												<div class="col-md-6 col-sm-12">
													<div class="submit-field">
														<h5 for="delivery_days" class="delivery_days">Delivery Day <span class='text-danger'>*</span></h5>
														<input type="text" name="delivery_days" class="form-control numeric_validation required" id="delivery_days" placeholder="No of days" required onkeypress='validateInputNumbers(event)' value="<?php echo $delivery_days ?? '' ?>">

													</div>
												</div>
												<div class="col-md-12 col-sm-12">
													<div class="submit-field">

														<h5 for="price" class="post_title">Meta Title </h5>
														<input type="text" name="title" class="form-control" id="title" placeholder="Enter title" value="<?php echo $title ?? '' ?>">

													</div>
												</div>
												<div class="col-md-6 col-sm-12">
													<div class="submit-field">
														<h5>Meta Description </h5>
														<textarea id="metadescription" name="metadescription" rows="3" cols="60" class=" with-border"><?php echo $metadescription ?? ''; ?></textarea>
													</div>
												</div>

												<div class="col-md-6 col-sm-12">
													<div class="submit-field">
														<h5>Meta Keywords<span>(important)</span> <i class="help-icon" data-tippy-placement="right" title="Seperate each word by a ,"></i> </h5>
														<textarea id="metakeywords" name="metakeywords" rows="3" cols="60" class=" with-border"><?php echo $metakeywords ?? ''; ?></textarea>
													</div>
												</div>
												<?php //echo '<pre>';print_r($solution_data);
												$listing_type_arr = array('Regular' => 1, 'Highlighted' => 2, 'Premium' => 3); ?>
												<div class="col-xl-6 col-md-4">
													<div class="submit-field">
														<h5>Select Type</h5>

														<select class="form-control with-border" name="listing_header_priority">
															<?php if (isset($listingOptions)) {

																foreach ($listingOptions as $option) { ?>
																	<option <?php echo 	$solution_data['solution'][0]['listing_header_priority'] == $listing_type_arr[trim($option['listing_name'])] ? 'selected="selected"' : '' ?> value="<?php echo $option['listing_id'] ?>"><?php echo $option['listing_name']; ?></option>
															<?php }
															} ?>
														</select>

													</div>
												</div>
												<div class="col-xl-6 col-md-4">
													<div class="submit-field">
														<h5>Select Sponsorship</h5>

														<select class="form-control with-border" name="sponsorship_priority">
															<option value="">Select Sponsorship </option>
															<?php if (isset($sponsorOptions)) {

																foreach ($sponsorOptions as $option) { ?>
																	<option <?php echo 	$solution_data['solution'][0]['sponsorship_priority'] == array_search($option['listing_id'], LISTING_HEADER_SPONSORSHIP) ? 'selected="selected"' : '' ?> value="<?php echo $option['listing_id'] ?>"><?php echo $option['listing_name']; ?></option>
															<?php }
															} ?>
														</select>

													</div>
												</div>
												<!--  end -->

												<div class="col-md-12 col-sm-12">
													<div class="submit-field">
														<h5>Current Status</h5>
														<div class="form-check form-check-inline">
															<input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1" <?php if ($status == 1) echo "checked";
																																					else echo ""; ?>>
															<label class="form-check-label pl-3 mb-3">Approved</label>
														</div>
														<div class="form-check form-check-inline">
															<input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="9" <?php if ($status == 9) echo "checked";
																																					else echo ""; ?>>
															<label class="form-check-label pl-3 mb-3 ">Pending for Approval</label>
														</div>
													</div>
												</div>

												<!-- end -->

												<?php
												$page = [];
												if (isset($display_on_page)) {
													$page['page'] = $display_on_page;
												}
												if (isset($frontend_section)) {
													$page['section'] = $frontend_section;
												}

												$this->load->view('user/includes/page_disaply', $page);
												?>

												<div class="row w-100 previous_save_btn_a">
													<div class="col-md-6 col-sm-12">
														<button type="submit" id="solution_step_4" class=" btn btn-primary submit_post float-left">Previous</button>
													</div>
													<div class="col-md-6 col-sm-12">
														<button type=" submit" id="solution_step42" class="btn btn-primary submit_post">Submit</button>
													</div>
												</div>


										</form>
									</div>

								</div>
							</div>

						</div>
					</div>
					<!-- Button -->




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


	<script src="<?php echo base_url(); ?>assets/js/dropzone.js"></script>
	<script>
		Dropzone.autoDiscover = false;
		$(document).ready(function() {

			var myDropzone = new Dropzone(".dropzone", {

					url: baseUrl + 'admin/upload_solution',
					previewsContainer: ".dropzone-previews",
					//previewsContainer: ".dropzone-previews",
					uploadMultiple: true, // allow to upload multiple files
					maxFilesize: 1, // 500 mb
					maxFiles: 10, // 10 file upload 
					acceptedFiles: ".jpeg,.jpg,.png", // upload file extension allowed
					//acceptedFiles: ".jpeg,.jpg,.png,.docx,.doc,.txt,.xls,.xlsx,.pdf,.mp4,.ogg,.mov,.3gp,.wmv,.avi", // upload file extension allowed
					parallelUploads: 10, // Number of files process at a time (default 2)
					addRemoveLinks: true,
					// timeout: 1800000,
					// chunking: true,
					// forceChunking: true,
					// chunkSize: 10000000, // 10 mb
					// parallelChunkUploads: true,
					// retryChunks: true,
					// retryChunksLimit: 3,
					// paramName: 'files',
					removedfile: function(file) {
						let csrfName = $('.txt_csrfname').attr('name');
						let csrfHash = $('.txt_csrfname').val();
						var name = file.name;
						$.ajax({
							type: 'POST',
							url: baseUrl + 'admin/delete_solution_media',
							data: {
								"name": name,
								[csrfName]: csrfHash
							},
							dataType: 'html'
						}).done(function(data) {
							data = JSON.parse(data);
							console.log("done-----" + data);
							$('.txt_csrfname').val(data.token);
						}).error(function(data) {
							data = JSON.parse(data);
							console.log("error-----" + data);
							$('.txt_csrfname').val(data.token);
						});
						var _ref;
						return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
					}
				})
				.on('sending', function(file, xhr, formData) {
					file.previewElement.innerHTML = "";
					let csrfName = $('.txt_csrfname').attr('name');
					let csrfHash = $('.txt_csrfname').val();
					formData.append([csrfName], csrfHash);
					formData.append('id', $('input[name="solution_id"]').val());
					$(".ext-not-except").html('')
				})
				.on('success', function(file, xhr) {
					$('.solution_image_ajax').html('');
					$('.solution_image_ajax').html(xhr.img_div);

					$('.txt_csrfname').val(xhr.token);
					if (xhr.errorUploadType != "") {
						this.removeFile(file);
						$(".ext-not-except").html(xhr.errorUploadType)
					} else {
						bootbox.alert({
							message: "Uploaded Successfully",
							size: 'small',
							buttons: {
								ok: {
									label: 'OK',
									className: 'btntheme_color_a'
								}
							},

						});
					}
				})
				.on("error", function(file, error) {

					if (!file.accepted) {
						this.removeFile(file);
						$(".ext-not-except").html(error)
					}
				});
			myDropzone.on("addedfile", function(file) {
				//console.log("addedfile-----" + file)
				data = $('input[name="solution_id"]').val();
				if (data == null || data == undefined || data == "") {
					myDropzone.removeFile(file);
					$("#menu3").removeClass('active');
					$("#menu2").removeClass('active');
					$("#menu1").removeClass('active');
					$("a[href=#menu3]").removeClass('active');
					$("a[href=#menu2]").removeClass('active');
					$("a[href=#menu1]").removeClass('active');

					$("a[href=#home]").addClass('active');
					$("#home").addClass('active');
					$("#common_error").removeClass("d-none");
					return false;
				}
			});


		});


		$(Document).ready(function() {
			$('.js-example-basic-multiple').select2();

			$('#summernote,#summernoteDomain').summernote({
				height: 300,
				dialogsInBody: true

			});
		});
	</script>


	<!-- The Modal -->
	<div class="modal" id="myModal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Message</h4>
					<button type="button" class="close" id="btnTimes" data-dismiss="modal">&times;</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body">
					Your solution is saved successfully!!.
				</div>
				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="button" id="close" class="btn btn-warning" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

</body>

</html>