<!DOCTYPE html>
<html lang="<?php if (!empty($language)) echo $language;
			else echo 'en'; ?>">

<head>

	<!--User Page Meta Tags-->
	<title>User Settings | <?php echo $this->lang->line('site_name') ?>| User Dashboard</title>
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
		body {
			overflow-x: hidden;
		}

		.select2-selection__rendered li input,
		.select2-container {
			width: 100% !important;
		}

		.expert_select2_a>span,
		.expert_city_section_a>span {
			border: 1px solid #ced4da;
			padding: 10px;
			background: #fff;
		}

		.select2-results__option {
			border-top: 1px solid #eee !important;
		}

		.select2-dropdown--above {
			background-color: #fff !important;
		}

		.select2-results__options {
			height: 250px;
			overflow: auto !important;
			background-color: #fff !important;
		}

		.select2-container--open .select2-dropdown--below {
			border: 1px solid #d0d0d0 !important;
			background: #fff !important;
		}

		.select2-search--dropdown {
			padding-top: 10px;
			padding-left: 10px;
			padding-right: 10px;
		}

		.expert_select2_a .error,
		.expert_city_section_a .error {
			padding: 6px 8px !important;
			background-color: #e34f4f !important;
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
			<?php $this->load->view('user/includes/sidebar'); ?>
			<!--------------------------------------------------------------------------------------------------------------->


			<!-- Dashboard Content -->
			<!-------------------------------------------------------------------------------------------------------------->
			<div class="dashboard-content-container" data-simplebar>

				<div class="dashboard-content-inner createpage_page">
					<!-- Dashboard Headline -->
					<div class="dashboard-headline create_post_page_headline">
						<div class="dashboad_table">
							<i class="mdi mdi-account-circle"></i>
							<h3>Expert <?php echo $soln_title ?? '' ?></h3>
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
					</div>

					<form id="becomeExpertform" method="post" action="<?php echo site_url('user/addProfileBecomeExpert'); ?>" enctype="multipart/form-data">
						<!-- Breadcrumbs -->
						<nav id="breadcrumbs" class="dark">
							<ul>
								<li><a href="<?php echo site_url('user/dashboard'); ?>">Dashboard</a></li>
								<li>Become Expert</li>
							</ul>
						</nav>


						<?php isset($user[0]) ? extract($user[0]) : ''; ?>

						<!-- Row -->
						<div class="row">
							<!-- Dashboard Box -->
							<!-- overview start -->
							<div class="col-md-12 pb-4">
								<div class="post_box">
									<ul class="nav nav-tabs form_become_expert ">
										<li><a data-toggle="tab" href="#home" class="active eventBlock"><i class="fa fa-pencil" aria-hidden="true"></i> <span>Basic Information</span></a></li>

									</ul>
								</div>
								<?php if (!empty($this->session->flashdata('expert_msg'))) { ?>
									<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
										<?php echo $this->session->flashdata('expert_msg'); ?>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
								<?php }	?>
								<?php
								if (!empty($id)) {
									if (empty($admin_approved) && $admin_approved  == 0) {
								?>
										<div class="alert alert-warning mt-4" role="alert">
											PENDING APPROVAL FROM ADMIN
										</div>
									<?php } else if (!empty($admin_approved) && $admin_approved  == 1) { ?>
										<div class="alert alert-success mt-4" role="alert">
											PROFILE APPROVED BY ADMIN
										</div>

									<?php } else if (!empty($admin_approved) && $admin_approved  == 2) { ?>
										<div class="alert alert-danger mt-4" role="alert">
											PRORFILE SUSPENDED BY ADMIN
										</div>
								<?php }
								} ?>
							</div>


							<div class="col-md-6">
								<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

								<input type="hidden" name="id" id="directory_id" value="<?php echo  $id ?? '' ?>">

								<div class="submit-field">
									<h5>Profile Name <span class='text-danger'>*</span></h5>
									<input type="text" name="profile_name" maxlength="100" class="form-control required stringSpace" placeholder="Enter profile name" id="profile_name" value="<?php echo $profile_name ?? '' ?>">
								</div>
							</div>

							<?php $this->load->view('user/includes/_listing_slug_expert',  $user); ?>

							<div class="col-md-6">
								<div class="submit-field">
									<h5>Name <span class='text-danger'>*</span></h5>
									<input type="text" name="name" maxlength="100" class="form-control required stringSpace" id="name" placeholder="Enter name" value="<?php echo $name ?? '' ?>">
								</div>
							</div>

							<div class="col-md-6">
								<div class="submit-field">
									<h5>Type <span class='text-danger'>*</span></h5>
									<select name="type" class="with-border required" required>
										<option value="">Select Option</option>
										<?php foreach (EXPERT_TYPE as $k => $v) { ?>
											<option <?php if (!empty($type) && $type == $k) echo  'selected'; ?> value="<?php echo $k; ?>"><?php echo $v; ?></option>

										<?php } ?>
									</select>
								</div>
							</div>

							<div class="col-md-6">
								<div class="submit-field">
									<h5>Specialization <span class='text-danger'>*</span></h5>
									<select name="specialization" class="with-border required" required>
										<option value="">Select Option</option>
										<?php foreach (QUALIFICATION as $k => $v) { ?>
											<option <?php if (!empty($specialization) && $specialization == $k) echo  'selected'; ?> value="<?php echo $k; ?>"><?php echo $v; ?></option>

										<?php } ?>
									</select>
								</div>
							</div>

							<div class="col-md-6 p-0">
								<div class="submit-field">
									<div class="col-md-6 float-left">
										<h5> Experience in Year <span class='text-danger'>*</span></h5>
										<input type="number" name="year" maxlength="2" minlength="0" class="form-control required" placeholder="Enter Year" required value="<?php echo $year ?? '' ?>">
									</div>
									<div class="col-md-6 float-left">
										<h5>Month <span class='text-danger'>*</span></h5>
										<input type="number" name="month" maxlength="2" minlength="0" class="form-control required" placeholder="Enter month" required value="<?php echo $month ?? '' ?>">
									</div>
								</div>
							</div>


							<div class="col-md-6">
								<div class="submit-field">
									<h5>Location Availability<span class='text-danger'>*</span></h5>
									<?php
									$avail = "";
									$avail  = isset($availability) ? explode(',', $availability) : '';

									if (!empty($avail)) {
										$onsite = in_array('onsite', $avail) ? 'checked' : '';
										$offsite = in_array('offsite', $avail) ? 'checked' : '';
										$online = in_array('online', $avail) ? 'checked' : '';
										$i = 0;
										if (!empty($onsite)) $i++;
										if (!empty($offsite)) $i++;
										if (!empty($online)) $i++;
									}

									?>
									<div class="monetize_methods">
										<label>
											<input type="checkbox" class="checkbox_monetize chb ckexp" name="availability[]" value="onsite" <?php echo $onsite ?? '' ?>>
											<!-- <input type="hidden" class="checkbox_monetize " name="availability[]" disabled value="0"> -->
											Onsite </label>
										<label>
											<input type="checkbox" class="checkbox_monetize chb ml-4 ckexp" name="availability[]" value="offsite" <?php echo $offsite ?? '' ?>>
											<!-- <input type="hidden" class="checkbox_monetize" name="availability[]" disabled value="0"> -->
											Offsite </label>
										<label>
											<input type="checkbox" class="checkbox_monetize chb ml-4 ckexp" name="availability[]" value="online" <?php echo $online ?? '' ?>>
											<!-- <input type="hidden" class="checkbox_monetize" name="availability[]" disabled value="0"> -->
											Online </label>
										<label id="allchecked"><input <?php echo !empty($i) ? ($i == 3 ? 'checked = "checked"' : '') : '' ?>type="checkbox" class="checkbox_monetize  checkbox_monetize_all chb ml-4">
											All </label>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="submit-field">
									<h5>Solution Category <span class='text-danger'>*</span></h5>
									<select name="solution_category" class="with-border required" required>
										<option value="">Select Option</option>
										<?php if (!empty(SOLUTION_CATEGORY)) {
											foreach (SOLUTION_CATEGORY as $k => $v) { ?>
												<option <?php if (!empty($solution_category) && $solution_category == $k) echo  'selected'; ?> value="<?php echo $k ?? ''; ?>"><?php echo $v ?? ''; ?></option>

										<?php }
										} ?>
									</select>
								</div>
							</div>

							<div class="col-md-6">
								<div class="submit-field">
									<h5>Solution Service Type <span class='text-danger'>*</span></h5>
									<select name="service_type" class="with-border required" required>
										<option value="">Select Option</option>
										<?php if (!empty(SOLUTION_SERVICE_TYPE)) {
											foreach (SOLUTION_SERVICE_TYPE as $k => $v) { ?>
												<option <?php if (!empty($service_type) && $service_type == $k) echo  'selected'; ?> value="<?php echo $k ?? '' ?>"><?php echo $v ?? ''; ?></option>

										<?php }
										} ?>
									</select>
								</div>
							</div>
							<div class="col-md-6 float-left">
								<div class="submit-field">
									<h5>Experience Description <span class='text-danger'>*</span</h5> <textarea name="description" rows="5" cols="60" class="form-control required"><?php echo $description ?? '' ?></textarea>
								</div>
							</div>
							<div class="col-md-6">
								<div class="submit-field">
									<h5>Services offered <span class='text-danger'>*</span></h5>
									<textarea name="service_offered" rows="5" cols="60" class="form-control required"><?php echo $service_offered ?? '' ?></textarea>
								</div>
							</div>
							<div class="col-md-6">
								<div class="submit-field">
									<h5>Rate Amount <span class='text-danger'>*</span></h5>
									<div class="monetize_methods">
										<input type="number" class="required numberOnly" style="width: 100%;" name="rate" placeholder='' value="<?php echo $rate ?? '' ?>">
										<?php $rate_time =  $rate_time ?? ''; ?>
										<input type="radio" class="checkbox_monetize radio_expert_width" name="rate_time" <?php if ($rate_time == 'hourly') echo 'checked';  ?> value="hourly"> <label> Hourly </label>
										<input type="radio" class="checkbox_monetize radio_expert_width " name="rate_time" <?php if ($rate_time == 'daily') echo 'checked';  ?> value="daily"> <label> Daily </label>
										<input type="radio" class="checkbox_monetize radio_expert_width " name="rate_time" <?php if ($rate_time == 'weekly') echo 'checked';  ?> value="weekly"> <label> Weekly </label>
										<input type="radio" class="checkbox_monetize radio_expert_width" name="rate_time" <?php if ($rate_time == 'monthly') echo 'checked';  ?> value="monthly"> <label> Monthly </label>

									</div>
								</div>
							</div>

							<div class="col-xl-6">
								<div class="submit-field expert_select2_a">
									<h5>Country <span class='text-danger'>*</span></h5>
									<select class="required js-example-basic-single form-control" id="countries" name="business_registeredCountry" class=" with-border">
										<option value="">Select Option</option>
									</select>
									<img class="dropdown_image" src="<?php echo site_url('assets/img/dropdownimage.png'); ?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="submit-field expert_city_section_a">
									<h5>City <span class='text-danger'>*</span></h5>
									<select type="text" name="city" maxlength="100" class="form-control js-example-basic-single expert_select2_a" id="cities">
										<option value="" selected>Select Option</option>
									</select>
									<img class="dropdown_image" src="<?php echo site_url('assets/img/dropdownimage.png'); ?>">
								</div>
							</div>
							<div class="col-xl-12">
								<div class="row">
									<div class="col-xl-3">
										<div class="submit-field">
											<div class="uploadButton margin-top-30">
												<input class="uploadButton-input-thumb <?php if (empty($profile_image)) echo 'required'; ?>" type="file" accept="image/*" id="uploadThumbnailImage" name="uploadThumbnailImage" />
												<span class='text-danger'>*</span>
												<label class="uploadButton-button ripple-effect" for="uploadThumbnailImage">Upload Image</label>
												<span class="uploadButton-file-name-thumb"><b></b></span>
											</div>
										</div>
									</div>
									<div class="col-xl-6">
										<img src="<?php if (!empty($profile_image)) echo site_url(IMAGES_UPLOAD . $profile_image); ?>" width="100px">
									</div>
								</div>
							</div>

							<div class="col-xl-6">.</div>

							<div id="loaderMsg"></div>
							<span id="loadingShow" style="display:none;"> <img src="<?php echo base_url(); ?>assets/img/loadingimage.gif" /> </span>


							<div class="col-sm-12">

								<?php if (!empty($id)) { ?>
									<button type="button" class="btn btn-primary submit_post updateExpertBtn ">Update</button>
								<?php } else { ?>
									<button type="button" id="becomeExpertformBtn" class="btn btn-primary submit_post">Submit</button>
								<?php } ?>
							</div>

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

	<script>
		$(document).ready(function() {
			$('.js-example-basic-single').select2();

		});
		var allCountry = '';
		var selectedCountry = "<?php echo $business_registeredCountry ?? '' ?>";
		var selectCity = "<?php echo  $city ?? '' ?>";
		$(function() {
			$("#cities").append("<option selected value='" + selectCity + "'>" + selectCity + "</option>");
			$.getJSON(baseUrl + 'assets/data/geo.json', function(countries) {
				var option = "";
				allCountry = countries;
				$.each(countries, function(country, cities) {

					if (selectedCountry == country) {
						$("#countries").append("<option selected value='" + country + "'>" + country + "</option>");
					} else {
						$("#countries").append("<option value='" + country + "'>" + country + "</option>");
					}
				});
			});
		});
		$(document).on('change', '#countries', function() {
			$("#cities").html('');
			var country = $("#countries").val();
			var cities = allCountry[country];
			$("#cities").append("<option selected  value='0' > Select City </option>");
			$.each(cities, function(index, city) {
				if (selectCity == city) {
					$("#cities").append("<option selected value='" + city + "'>" + city + "</option>");
				} else {
					$("#cities").append("<option value='" + city + "'>" + city + "</option>");
				}
			});
		});
	</script>
</body>

</html>