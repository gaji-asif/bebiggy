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
			<?php $this->load->view('user/includes/sidebar'); ?>
			<!--------------------------------------------------------------------------------------------------------------->


			<!-- Dashboard Content -->
			<!-------------------------------------------------------------------------------------------------------------->
			<div class="dashboard-content-container" data-simplebar>
				<div class="dashboard-content-inner createpage_page">

					<!-- Dashboard Headline -->
					<div class="dashboard-headline create_post_page_headline">

						<div class="dashboad_table">
							<i class="icon-material-outline-business-center"></i>
							<h3><?php echo $soln_title ?? ''  ?></h3>
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

					<!-- Breadcrumbs -->
					<nav id="breadcrumbs" class="dark">
						<ul>
							<li><a href="#">Home</a></li>
							<li><a href="#">Dashboard</a></li>
							<li>Solution</li>
						</ul>
					</nav>


					<?php isset($solution_data['solution'][0]) ? extract($solution_data['solution'][0]) : ''; ?>
					<!-- Row -->
					<div class="row create_solution">
						<!-- Dashboard Box -->
						<!-- overview start -->
						<div class="col-md-12">
							<div class="post_box">
								<ul class="nav nav-tabs <?php  if(!empty($id)) echo 'edit_user_new_post user_new_post ' ; else echo 'user_new_post'; ?> ">
									<li><a data-toggle="tab" href="#home" class="active eventBlock"><i class="fa fa-pencil" aria-hidden="true"></i> <span>Basicinfo</span></a></li>
									<li><a data-toggle="tab" href="#menu1" class="eventBlock" <?php //echo  isset($id) ? '' : 'class="eventBlock"' 
																								?>><i class="fa fa-file-image-o" aria-hidden="true"></i> Media</a></li>
									<li><a data-toggle="tab" href="#menu2" class="eventBlock" <?php //echo  isset($id) ? '' : 'class="eventBlock"' 
																								?>><i class="fa fa-th-list" aria-hidden="true"></i> Category</a></li>
									<li><a data-toggle="tab" href="#menu3" class="eventBlock" <?php //echo  isset($id) ? '' : 'class="eventBlock"' 
																								?>><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Price</a></li>
																								<?php  if(empty($id)) { ?>

									<li><a data-toggle="tab" href="#menu4" class="eventBlock" <?php //echo  isset($id) ? '' : 'class="eventBlock"' 
																								?>><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Type</a></li>

									<li><a data-toggle="tab" href="#menu5" class="eventBlock" <?php //echo  isset($id) ? '' : 'class="eventBlock"' 
																								?>><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Sponsor</a></li>

									<li><a data-toggle="tab" href="#menu6" class="eventBlock" <?php //echo  isset($id) ? '' : 'class="eventBlock"' 
																								?>><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Pay </a></li>
																								<?php } ?>
								</ul>

								<div class="tab-content">
									<div id="home" class="tab-pane in active">
										<div class="col-md-12 create_post p-0">
											<div class="col-md-12 p-0">

												<form id="solutionFormStep1" method="post" enctype="multipart/form-data">
													<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

													<input type="hidden" name="solution_id" id="solution_id" value="<?php echo  $id ?? '' ?>">
													<input type="hidden" name="list_id" id="list_id" value="<?php echo  $list_id ?? '' ?>">
													<input type="hidden" name="domain_id" id="domain_id" value="<?php echo  $domain_id ?? '' ?>">

													<input type="hidden" name="step" value='1'>
													<div id="SolutionUrlValMsg"></div>
													<div class="form-group">
														<input type="text" name="solution_url" class="form-control solution_url" id="txt_solution_url" maxlength="200" placeholder="Enter Soultion URL " value="<?php echo $solution_url ?? '' ?>">
														<span class="helper-text">Allowed URL Website,App,Domain (Optional) </span>
													</div>
													<div class="form-group">
														<input type="text" name="name" maxlength="200" class="form-control solution_name" id="txt_solution_title" placeholder="Enter Soultion name *" required value="<?php echo $name ?? '' ?>">
														<span class="helper-text">max length is 200 character</span>
													</div>
													<div class="form-group">
														<input type="text" name="slug" maxlength="200" class="form-control solution_name" onchange="updateSlug()" id="txt_solution_url_slug" placeholder="Enter slug" required value="<?php echo $slug ?? '' ?>">
														<span class="helper-text">max length is 200 character</span>
													</div>
													<div class="form-group">
														<h5>Tell us about your Solution so potential buyers get excited<span>(Important)</span> <i class="help-icon" data-tippy-placement="right" title="Be Descriptive. Add everything you think which is important"></i></h5>
														<textarea id="tiny-editor" name="description" rows="5" cols="60" class="form-control"><?php echo $description ?? '' ?></textarea>
													</div>
													<button type="submit" id="solution_step1" class="mt-2 btn btn-primary submit_post">Next</button>

												</form>
											</div>

										</div>

									</div>
									<div id="menu1" class="tab-pane">
										<div class="error_sms_a mt-4">
											<?php
											// check file permission 
											CheckFilePermissionOrgenerateAlert(IMAGES_UPLOAD);
											?>
										</div>

										<div class="title_text row">
											<div class="col-md-12">
												<center>
													<p style="margin-bottom: 0px;">Lets add Visuals image file for solutions. </p>
												</center>
											</div>
											<div class="col-md-12 mb-2">
												<div class="ext-not-except col-md-12"></div>
											</div>

										</div>
										<div class="col-md-12 files-uploads">
											<div class="dropzone dropzone-previews" id="myDropzone"></div>
											<div class="title_text my-2"> upload multiple files here (max limit 1Mb)</div>
											<input type="hidden" name="solution_id" id="solution_id" value="<?php echo  $id ?? '' ?>">
											<input type="hidden" name="list_id" id="list_id" value="<?php echo  $list_id ?? '' ?>">
											<input type="hidden" name="domain_id" id="domain_id" value="<?php echo  $domain_id ?? '' ?>">
											<!--   submit form --->
											<div class="row second_step_a">
												<div class="col-md-6 col-sm-12">
													<button type="submit" id="solution_step_2" class=" btn btn-primary submit_post float-left">Previous</button>
												</div>
												<div class="col-md-6 col-sm-12">
													<button type="submit" id="solution_step2" class="btn btn-primary submit_post float-right">Next</button>
												</div>
											</div>
										</div>
										<div class="solution_image_ajax">
											<?php if (isset($solution_data) && count($solution_data) > 0) : ?>
												<div class="row my-3">
													<?php foreach ($solution_data['solutions_media'] as $file) : ?>
														<?php $fileName =  base_url() . IMAGES_UPLOAD . $file['name']; ?>
														<div id="<?php echo 'file_' . $file['id']; ?>" class="image_task mt-5 d-block">
															<?php if (!fileIcon($file['ext'])) : ?>
																<a href="javascript:void(0)" class="solution_file" data-id="<?php echo 'file_' . $file['id']; ?>"><i class="fa fa-times" aria-hidden="true"></i></a>
																<embed src="<?php if (isset($file['name'])) echo $fileName; ?>" type="<?php echo $file['mime']; ?>" width="100" height="100" class="d-block" />
																<span><?php echo  _str_limit($file['name'], 15); ?></span>
															<?php else : ?>
																<a href="javascript:void(0)" class="solution_file" data-id="<?php echo 'file_' . $file['id']; ?>"><i class="fa fa-times" aria-hidden="true"></i></a>
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
												<p>Fill category information for your given solutions. </p>
											</center>
										</div>
										<div class="submit-field category_post">
											<form id="solutionFormStep3" method="post" enctype="multipart/form-data">
												<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
												<input type="hidden" name="solution_id" id="solution_id" value="<?php echo  $id ?? '' ?>">
												<input type="hidden" name="list_id" id="list_id" value="<?php echo  $list_id ?? '' ?>">
												<input type="hidden" name="domain_id" id="domain_id" value="<?php echo  $domain_id ?? '' ?>">
												<input type="hidden" name="step" value='3'>

												<div class="col-md-12">
													<div class="submit-field">
														<h5>CATEGORY *</h5>
														<select class="required" name="category_id" id="solution_category_user" class="selectpicker with-border">
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
												<div class="row third_section_a">

													<div class="col-md-6 col-sm-12">
														<button type="submit" id="solution_step_3" class="btn btn-primary submit_post float-left ">Previous</button>

													</div>
													<div class="col-md-6 col-sm-12">
														<button type="submit" id="solution_step3" class="btn btn-primary submit_post">Next</button>
													</div>

												</div>


											</form>

										</div>

									</div>
									<!-- step3 -->
									<div id="menu3" class="tab-pane">
										<div class="title_text">
											<center>
												<p>Fill selling process for your given solutions .</p>
											</center>
										</div>


										<form id="solutionFormStep4" method="post" enctype="multipart/form-data">
											<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
											<input type="hidden" name="solution_id" id="solution_id" value="<?php echo  $id ?? '' ?>">
											<input type="hidden" name="list_id" id="list_id" value="<?php echo  $list_id ?? '' ?>">
											<input type="hidden" name="domain_id" id="domain_id" value="<?php echo  $domain_id ?? '' ?>">
											<input type="hidden" name="step" value='4'>

											<!-- start -->
											<div class="row">

												<div class="col-md-6 col-sm-12">
													<div class="submit-field">

														<h5 for="price" class="price">Price ($) <span class='text-danger required'>*</span></h5>
														<input type="text" onkeyup="showPriceCommissionSoln()" id="website_buynowprice_soln" name="price" class="form-control numeric_validation" id="price" placeholder="$" required value="<?php echo $original_buynowprice ?? '' ?>">
													</div>
												</div>
												<?php if (!empty($id)) {  ?>
													<!--   commission div-->
													<div class="col-md-6 col-sm-12">
														<div class="submit-field">
															<h5 for="price" class="price">View Price ($) <span class='text-danger required'>*</span></h5>
															<input id="view_buynow" class="form-control" value="<?php echo $price ?? '' ?>" disabled='disabled'>
														</div>
													</div>
													<div id="Sell-Classified-Website" class="row w-100 asing_price_section_a">
														<?php  ?>
														<div class="col-xl-4 col-md-4">
															<div class="submit-field">
																<h5>Commission Type</h5>
																<?php
																$commission_type_1 = "";
																if (!empty($commission_type)) {
																	if ($commission_type == 1) {
																		$commission_type_1 = "Fixed";
																	}
																	if ($commission_type == 2) {
																		$commission_type_1 = "Percentage";
																	}
																}   ?>
																<select disabled id="commission_type_soln" name="commission_type" class="form-control with-border ">

																	<option selected value="<?php echo $commission_type; ?>"> <?php echo $commission_type_1 ?> </option>

																</select>

															</div>
														</div>
														<div class="col-xl-4 col-md-4">
															<div class="submit-field">
																<h5>Commission Amount (<?php if (!empty($default_currency)) echo $default_currency;
																						else echo '$'; ?>)</h5>
																<input type="text" id="commission_amount_soln" class="form-control with-border " placeholder="0" disabled value="<?php if (isset($commission_amount)) echo $commission_amount; ?>">

															</div>
														</div>
														<div class="col-xl-4 col-md-4">
															<div class="submit-field">
																<h5>Commission Base </h5>
																<?php
																//pre($listing_data[0]);

																if (!empty($commission_user_product)) {
																	if ($commission_user_product == 1) {
																		$commission_user_product = "General";
																	}
																	if ($commission_user_product == 2) {
																		$commission_user_product = "Product";
																	}
																}   ?>
																<!-- COMMISSION_BASE -->
																<select disabled class="form-control with-border" name="commission_base" id="commission_base_soln">
																	<?php foreach (COMMISSION_BASE as $k => $v) : ?>
																		<option value="<?php echo $k; ?>" <?php if (trim($v) == trim($commission_user_product)) echo 'selected'; ?>> <?php echo $v ?> </option>
																	<?php endforeach; ?>
																</select>
															</div>
														</div>

													</div>
													<!--  commission div end  -->

												<?php  } ?>
												<div class="col-md-6 col-sm-12">
													<div class="submit-field">

														<h5 for="delivery_days" class="delivery_days">Delivery Day <span class='text-danger'>*</span></h5>
														<input type="text" name="delivery_days" class="form-control numeric_validation required" id="delivery_days" placeholder="No of days" required onkeypress='validateInputNumbers(event)' value="<?php echo $delivery_days ?? '' ?>">

													</div>
												</div>

												<div class="col-md-6 col-sm-12">
													<div class="submit-field">

														<h5 for="post_title" class="post_title">Meta Title </h5>
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

												<!-- end -->

												<div class="row fourth_step_a m-0 w-100">
													<div class="col-md-6 col-sm-12">
														<button type="submit" id="solution_step_4" class=" btn btn-primary submit_post float-left">Previous</button>

													</div>
													<div class="col-md-6 col-sm-12">
													   <?php if(!empty($id)) {?>
														<button type="submit" id="solution_step_edit_4" class="btn btn-primary submit_post"> Submit </button><?php }else {?>
														<button type="submit" id="solution_step4" class="btn btn-primary submit_post">Next</button>
														<?php } ?>
													</div>
												</div>

											</div>
										</form>
									</div>
									<!-- step4 -->
									<div id="menu4" class="tab-pane">
										<div class="title_text">
											<center>
												<p>Fill selling process for your given solutions .</p>
											</center>
										</div>


										<form id="solutionFormStep5" method="post" enctype="multipart/form-data">
											<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
											<input type="hidden" name="solution_id" id="solution_id" value="<?php echo  $id ?? '' ?>">
											<input type="hidden" name="list_id" id="list_id" value="<?php echo  $list_id ?? '' ?>">
											<input type="hidden" name="domain_id" id="domain_id" value="<?php echo  $domain_id ?? '' ?>">
											<input type="hidden" name="step" value='4'>

											<!-- start -->
											<div class="row">
												<div class="row centerButtons">
													<?php if (isset($listingOptions)) {
														$i = true;

														foreach ($listingOptions as $option) { ?>

															<div class="col-xl-4 <?php if($i == true) {?> smallestPlan<?php } ?>">
																<span class='text-danger'>*</span>
																<div class="submit-field item">
																	<input id="answer_<?php echo $option['listing_id']; ?>" type="radio" name="listing_group_1" value="<?php echo $option['listing_id'] ?>" class="required">
																	<label for="answer_<?php echo $option['listing_id']; ?>">
																		<img src="<?php echo base_url() . ICON_UPLOAD . $option['listing_icon']; ?>" alt="">
																		<?php if (!empty($default_currency)) echo $default_currency;
																		else echo '$'; ?>

																		<?php if (isset($option['listing_price']))
																			if ($option['listing_discount'] != 0) {
																				$discount = $option['listing_discount'];
																				echo  "<del>" . $option['listing_price'] . "</del>";
																				$option['listing_price']  = $option['listing_price'] - $discount;
																				echo ' - $' . $option['listing_price'];
																			} else {
																				echo $option['listing_price'];
																			}

																		?>
																		<br>
																		<h2 class="titlte_section_a"><?php if (isset($option['listing_name'])) echo $option['listing_name']; ?></h2>
																		<p class="description_section_a"><?php if (isset($option['listing_description'])) echo html_entity_decode($option['listing_description']); ?></p>

																		<h4><b> Listing Duraton : <?php if (isset($option['listing_duration'])) echo $option['listing_duration']; ?> Days </b></h4>
																	</label>
																	<input type="hidden" name="txt_listamount" class="txt_listamount" value="<?php if (isset($option['listing_price'])) echo $option['listing_price']; ?>">
																	<input type="hidden" name="txt_listingname" class="txt_listingname" value="<?php if (isset($option['listing_name'])) echo $option['listing_name']; ?>">
																</div>
															</div>

													<?php $i = false;
														}
													} ?>

												</div>
												<div class="row fourth_step_a m-0 w-100">
													<div class="col-md-6 col-sm-12">
														<button type="submit" id="solution_step_5" class=" btn btn-primary submit_post float-left">Previous</button>

													</div>
													<div class="col-md-6 col-sm-12">

														<button type="submit" id="solution_step5" class="btn btn-primary submit_post">Next</button>
													</div>
												</div>

											</div>
										</form>
									</div>

									<!-- step5 -->
									<div id="menu5" class="tab-pane">
										<div class="title_text">
											<center>
												<p>Fill selling process for your given solutions .</p>
											</center>
										</div>


										<form id="createListingForm" method="post" enctype="multipart/form-data">
											<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
											<input type="hidden" name="solution_id" id="solution_id" value="<?php echo  $id ?? '' ?>">
											<input type="hidden" name="list_id" id="list_id" value="<?php echo  $list_id ?? '' ?>">
											<input type="hidden" name="domain_id" id="domain_id" value="<?php echo  $domain_id ?? '' ?>">
											<input type="hidden" name="step" value='5'>

											<!-- start -->
											<div class="row centerButtons">
												<div class="row ">

													<?php if (isset($sponsorOptions)) {

														foreach ($sponsorOptions as $option) { ?>

															<div class="col-xl-12">
																<div class="submit-field item">
																	<input id="answer_<?php echo $option['listing_id']; ?>" type="radio" name="sponsor_group_1" value="<?php echo $option['listing_id'] ?>">
																	<label for="answer_<?php echo $option['listing_id']; ?>"><img src="<?php echo base_url() . ICON_UPLOAD . $option['listing_icon']; ?>" alt="">
																		<h2><b><?php if (!empty($default_currency)) echo $default_currency;
																				else echo '$'; ?><?php if (isset($option['listing_price'])) echo $option['listing_price']; ?></b></h2><strong><?php if (isset($option['listing_name'])) echo $option['listing_name']; ?></strong><?php if (isset($option['listing_description'])) echo html_entity_decode($option['listing_description']); ?><br>
																		<h4><b> Listing Duraton : <?php if (isset($option['listing_duration'])) echo $option['listing_duration']; ?> Days </b></h4>
																	</label>
																</div>
															</div>

													<?php }
													} ?>

												</div>

												<div class="row fourth_step_a m-0 w-100">
													<div class="col-md-6 col-sm-12">
														<button type="submit" id="solution_step_6" class=" btn btn-primary submit_post float-left">Previous</button>

													</div>
													<div class="col-md-6 col-sm-12">

														<button id="BtnNextFinal" type="button" value="NEXT" class="btn btn-primary submit_post solution_step6">Next</button>
													</div>
												</div>

											</div>
										</form>
									</div>



									<!-- step5 -->
									<div id="menu6" class="tab-pane">

										<!-- Row -->
										<div id="pay_listing" class="row" style="display: none;">

											<!-- Dashboard Box -->
											<div class="col-xl-12">

												<form id="payWrapper" method="POST" enctype="multipart/form-data" class="creditly-card-form agileinfo_form" action="<?php echo site_url("payments/proceedtoPayment") ?>">

													<div class="question_title">
														<h3>Pay & Start Selling</h3>
													</div>


													<?php if (!empty($error)) { ?>
														<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><span><?php print_r($error); ?></span></div>
													<?php } ?>

													<!-- Payment Methods Accordion -->

													<div class="row centerButtons">
														<?php if (!empty($payments)) { ?>
															<?php foreach ($payments as $key) {

																if ($key['id'] === '2') { ?>
																	<div class="col-lg-3">
																		<div class="item">
																			<input id="answer_1_payvia_card" type="radio" name="branch_1_pay_1" value="payvia_card" class="required">
																			<label for="answer_1_payvia_card"><img src="<?php echo base_url() . ICON_UPLOAD ?>pay.svg" alt=""><strong>Credit Card</strong></label>
																		</div>
																	</div>
																<?php } else if ($key['id'] === '1') { ?>
																	<div class="col-lg-3">
																		<div class="item">
																			<input id="answer_2_payvia_paypal" name="branch_1_pay_1" type="radio" value="payvia_paypal" class="required">
																			<label for="answer_2_payvia_paypal"><img src="<?php echo base_url() . ICON_UPLOAD ?>paypal.svg" alt=""><strong>Via PayPal</strong></label>
																		</div>
																	</div>
																<?php } else if ($key['id'] === '3') { ?>
																	<div class="col-lg-3">
																		<div class="item">
																			<input id="answer_4_payvia_paypal" name="branch_1_pay_1" type="radio" value="payvia_stripe" class="required">
																			<label for="answer_4_payvia_paypal"><img src="<?php echo base_url() . ICON_UPLOAD ?>stripe.png" alt=""><strong>Via Stripe</strong></label>
																		</div>
																	</div>
														<?php }
															}
														} ?>
														<div id="freecheckout_select" class="col-lg-3">
															<div class="item">
																<input id="answer_3_freecheckout" name="branch_1_pay_1" type="radio" value="free_checkout" class="required">
																<label for="answer_3_freecheckout"><img src="<?php echo base_url() . ICON_UPLOAD ?>bonus.svg" alt=""><strong>Free Checkout</strong></label>
															</div>
														</div>
													</div>
													<!-- /row-->

													<div class="row justify-content-center p-3">
														<div class="col-lg-8">
															<div class="box_general">
																<div class="boxed-widget-headline">
																	<h3>Summary <span class="noofitems-summary"></span></h3>
																</div>

																<div class="boxed-widget-inner">
																	<ul class="checkout-items"></ul>
																	<ul id="listings"></ul>
																	<h2 style="float: right;" id="total"></h2>
																</div>
															</div>
															<div id="paymentValidations"></div>
														</div>
													</div>

													<?php foreach ($payments as $key) {
														if ($key['id'] === '2') { ?>
															<div id="Pay_Credit_Card" class="row justify-content-center p-3 creditly-wrapper gray-theme" style="display:none;">
																<div class="col-lg-8">

																	<div class="box_general paypal">

																		<label for="creditCart"><strong>Credit / Debit Card (Paypal Pro)</strong></label>
																		<img class="payment-logo" src="<?php if (!empty($key['icon_url'])) echo $key['icon_url'] ?>" alt="" hspace="20">

																		<div class="row payment-form-row credit-card-wrapper">

																			<div class="col-md-6">
																				<div class="card-label">
																					<input name="nameOnCard" type="text" class="required" placeholder="Cardholder Name">
																				</div>
																			</div>

																			<div class="col-md-6">
																				<div class="card-label">
																					<input class="number credit-card-number form-control required" type="text" name="number" inputmode="numeric" autocomplete="cc-number" autocompletetype="cc-number" x-autocompletetype="cc-number" placeholder="&#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149;" onkeypress='validateInputNumbers(event)'>
																				</div>
																			</div>

																			<div class="col-md-4">
																				<div class="card-label">
																					<label class="control-label">Expiration Date</label>
																					<input class="expiration-month-and-year form-control required" type="text" name="expiration-month-and-year" placeholder="MM / YY" onkeypress='validateInputNumbers(event)'>
																					<input type="hidden" name="txt_month" class="txt_month" />
																					<input type="hidden" name="txt_year" class="txt_year" />
																				</div>
																			</div>

																			<div class="col-md-4">
																				<div class="card-label">
																					<input class="security-code form-control required" Â·inputmode="numeric" type="text" name="security-code" placeholder="&#149;&#149;&#149;">
																				</div>
																			</div>

																		</div>

																	</div>
																	<!-- /box_general -->
																</div>
															</div>
															<!-- /row-->
														<?php } else if ($key['id'] === '3') { ?>
															<div id="Pay_stripe" class="row justify-content-center p-3 creditly-wrapper gray-theme" style="display:none;">
																<div class="col-lg-8">

																	<div class="box_general stripe">

																		<label for="creditCart"><strong>Credit / Debit Card (Stripe)</strong></label>
																		<img class="payment-logo" src="<?php if (!empty($key['icon_url'])) echo $key['icon_url'] ?>" alt="" hspace="20">

																		<div class="row payment-form-row credit-card-wrapper">

																			<div class="col-md-6">
																				<div class="card-label">
																					<input name="nameOnCard" type="text" class="required" placeholder="Cardholder Name">
																				</div>
																			</div>

																			<div class="col-md-6">
																				<div class="card-label">
																					<input class="number credit-card-number form-control required" type="number" name="number" id="stripe_credit_card" inputmode="numeric" autocomplete="cc-number" autocompletetype="cc-number" x-autocompletetype="cc-number" placeholder="&#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149;" onkeypress='validateInputNumbers(event)'>
																				</div>
																			</div>

																			<div class="col-md-6">
																				<div class="card-label">
																					<label class="control-label">Expiration Date</label>
																					<input class="expiration-month-and-year form-control required" type="text" name="expiration-month-and-year" placeholder="MM / YY" onkeypress='validateInputNumbers(event)' id="day_month">
																					<input type="hidden" name="txt_month" class="txt_month" />
																					<input type="hidden" name="txt_year" class="txt_year" />
																				</div>
																			</div>

																			<div class="col-md-6">
																				<div class="card-label">
																					<input class="security-code form-control required" Â·inputmode="numeric" type="text" name="security-code" placeholder="&#149;&#149;&#149;" id="security_code">
																				</div>
																			</div>

																		</div>

																	</div>
																	<!-- /box_general -->
																</div>
															</div>
															<!-- /row-->
														<?php } else if ($key['id'] === '1') { ?>
															<div id="Pay_paypal" class="row justify-content-center p-3" style="display:none;">
																<div class="col-lg-8">
																	<div class="box_general">
																		<label for="paypal"><strong>PayPal</strong></label>
																		<img class="payment-logo paypal" src="<?php if (!empty($key['icon_url'])) echo $key['icon_url'] ?>" alt="" hspace="20">
																		<p>You will be redirected to PayPal to complete payment.</p>
																	</div>
																	<!-- /box_general -->
																</div>
															</div>
													<?php }
													} ?>
													<div id="Pay_free" class="row justify-content-center p-3" style="display:none;">
														<div class="col-lg-8">
															<div class="box_general">
																<label for="paypal"><strong>Free Checkout</strong></label>
																<img class="payment-logo paypal" src="https://i.imgur.com/ApBxkXU.png" alt="" hspace="20">
																<p>Your Listing will be activated free of charge for selected period of time</p>
															</div>
															<!-- /box_general -->
														</div>
													</div>

													<input type="hidden" name="txt_payid" id="txt_payid">
													<input type="hidden" name="txt_payamount" id="txt_payamount">
													<input type="hidden" name="txt_listingid" id="txt_listingid" value="<?php echo  $list_id ?? '' ?>">
													<input type="hidden" name="txt_sponsored_id" id="txt_sponsored_id">
													<span id="loaderImage" style="display:none;" class="float-right"> <img src="<?php echo base_url(); ?>assets/img/loadingimage.gif" /> </span>

													<input id="button_pay" name="button_pay" type="submit" class="button big ripple-effect margin-top-40 margin-bottom-65 submit" style="float: right; display: none;" value="Proceed Payment">
													<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
												</form>
											</div>
										</div>
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

	<script> checkoutlistingspage(); </script>
	<script src="<?php echo base_url(); ?>assets/js/dropzone.js"></script>
	<script>
		Dropzone.autoDiscover = false;
		$(document).ready(function() {

			var myDropzone = new Dropzone(".dropzone", {

					url: baseUrl + 'user/upload_solution',
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
							url: baseUrl + 'user/delete_solution_media',
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

					// if (this.files.length) {
					// 	$(".ext-not-except").html('')
					// 	var _i, _len;
					// 	for (_i = 0, _len = this.files.length; _i < _len - 1; _i++) // -1 to exclude current file
					// 	{
					// 		if (this.files[_i].name === file.name && this.files[_i].size === file.size && this.files[_i].lastModifiedDate.toString() === file.lastModifiedDate.toString()) {
					// 			$(".ext-not-except").html("Duplicate image can not added")
					// 			this.removeFile(file);
					// 		}
					// 	}
					// }
					let csrfName = $('.txt_csrfname').attr('name');
					let csrfHash = $('.txt_csrfname').val();
					formData.append([csrfName], csrfHash);
					formData.append('id', $('input[name="solution_id"]').val());
				})
				.on('success', function(file, xhr) {
					$('.solution_image_ajax').html('');
					$('.solution_image_ajax').html(xhr.img_div);
					// console.log(xhr.img_div);
					// console.log(xhr.solution_data);

					//$('.dz-remove').attr('href', xhr.latest_image.name);
					$('.txt_csrfname').val(xhr.token);

					if (xhr.errorUploadType != "") {
						//console.log("hello");
						//console.log(xhr.errorUploadType);
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
				// console.log("addedfile-----")
				// console.log(file);
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
					<button type="button" class="close" id="btnTimesUser" data-dismiss="modal">&times;</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body">
					Your solution is saved successfully!!.
				</div>
				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="button" id="closeUser" class="btn btn-warning" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

</body>

</html>