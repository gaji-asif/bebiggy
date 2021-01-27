<!DOCTYPE html>
<html lang="<?php if (!empty($language)) echo $language;
			else echo 'en'; ?>">

<head>

	<!--User Page Meta Tags-->
	<title>Edit Listings - <?php if (isset($listing_data[0]['website_BusinessName'])) echo $listing_data[0]['website_BusinessName']; ?> | <?php echo $this->lang->line('site_name') ?>| User Dashboard</title>
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
			<?php $this->load->view('admin/includes/sidebar'); ?>
			<!--------------------------------------------------------------------------------------------------------------->

			<div class="dashboard-content-container" data-simplebar>
				<div class="dashboard-content-inner">
					<!-- Dashboard Headline -->
					<div class="dashboard-headline">


						<?php $this->load->view('admin/includes/admin_headline'); ?>
						<h3><b>Edit Domain Listing | </b> <?php if (isset($listing_data[0]['website_BusinessName'])) echo $listing_data[0]['website_BusinessName']; ?> | <?php if (isset($domainData[0]['domain'])) echo $domainData[0]['domain']; ?></h3>

						<!-- Breadcrumbs -->
						<nav id="breadcrumbs" class="dark">
							<ul>
								<li><a href="<?php echo site_url('admin'); ?>">Home</a></li>
								<li><a href="<?php echo site_url('admin/current_listings'); ?>">Current Listing</a></li>
								<li>Edit Listings</li>
							</ul>
						</nav>
					</div>
					<!-- Row -->
					<div class="row createapplistingform_admin_a">
						<?php
						// check file permission 
						CheckFilePermissionOrgenerateAlert(IMAGES_UPLOAD);
						?>
						<form id="createListingFormAdmin" name="createListingFormAdmin" method="POST" enctype="multipart/form-data">
							<!-- Dashboard Box -->
							<div class="col-xl-12">
								<div class="dashboard-box margin-top-0 panel-group" id="accordion" role="tablist" aria-multiselectable="true">

									<div class="panel panel-default">

										<!---Listing Edit Form Tab ----->
										<div class="panel-heading" role="tab" id="headingOne">
											<!-- Headline -->
											<div class="headline">
												<h3><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
														<i class="more-less glyphicon glyphicon-plus"></i><i class="icon-feather-folder-plus panel-title"></i> Listings Edit Form</a></h3>
											</div>
										</div>

										<!---Listing Edit Form Tab ----->
										<div id="collapseOne" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingOne">
											<div class="panel-body">

												<div class="content with-padding padding-bottom-10">

													<div class="row">

														<div class="col-xl-6">
															<div class="submit-field">
																<h5>Domain Name</h5>
																<input type="text" id="website_BusinessName" name="website_BusinessName" value="<?php if (isset($listing_data[0]['website_BusinessName'])) echo $listing_data[0]['website_BusinessName']; ?>" class="with-border" placeholder="Business Name" required>

																<input type="hidden" name="listing_id" name="listing_id" value="<?php if (isset($listing_data[0]['id'])) echo $listing_data[0]['id']; ?>">
																<input type="hidden" name="listing_type" name="listing_type" value="<?php if (isset($listing_data[0]['listing_type'])) echo $listing_data[0]['listing_type']; ?>">
																<input type="hidden" name="listing_option" name="listing_option" value="<?php if (isset($listing_data[0]['listing_option'])) echo $listing_data[0]['listing_option']; ?>">
															</div>
														</div>

														<div class="col-xl-6">
															<div class="submit-field">
																<h5>Tagline <span>(Optional)</span> </h5>
																<input type="text" id="website_tagline" name="website_tagline" class="with-border" placeholder="" value="<?php if (isset($listing_data[0]['website_tagline'])) echo $listing_data[0]['website_tagline']; ?>">
																<input type="hidden" id="listing_id" name="listing_id" value="<?php if (isset($listing_data[0]['id'])) echo $listing_data[0]['id']; ?>">
																<input type="hidden" id="domain_id" name="domain_id" value="<?php if (isset($listing_data[0]['domain_id'])) echo $listing_data[0]['domain_id']; ?>">
															</div>
														</div>
														<?php $this->load->view('user/includes/_listing_slug'); ?>
														<div class="col-xl-6">
															<div class="submit-field">
																<h5>Meta Description of the Domain <span>(Optional)</span> </h5>
																<textarea id="website_metadescription" name="website_metadescription" rows="5" cols="60" class=" with-border"><?php if (isset($listing_data[0]['website_metadescription'])) echo $listing_data[0]['website_metadescription']; ?></textarea>
															</div>
														</div>

														<div class="col-xl-6">
															<div class="submit-field">
																<h5>Meta Keywords <span>(Optional)</span> <i class="help-icon" data-tippy-placement="right" title="Seperate each word by a ,"></i> <span class='text-danger'>*</span></h5>
																<textarea id="website_metakeywords" name="website_metakeywords" rows="3" cols="60" class=" with-border"><?php if (isset($listing_data[0]['website_metakeywords'])) echo $listing_data[0]['website_metakeywords']; ?></textarea>
															</div>
														</div>

														<div class="col-xl-6">
															<div class="submit-field">
																<h5>How old is your domain? <span class='text-danger'>*</span></h5>
																<input type="text" id="required" name="website_age" class="qty with-border required  numeric_validation" placeholder="No. year old" value="<?php if (isset($listing_data[0]['website_age'])) echo $listing_data[0]['website_age']; ?>" onkeyup='validateInputNumbers(event)'>
															</div>
														</div>
														<div class="col-xl-6">
															<div class="submit-field">
																<h5>Domain Registrar <span class='text-danger'>*</span></h5>
																<select class="required" id="business_registrar" name="business_registeredCountry" class="selectpicker with-border ">
																	<option value="">Select domain registrar</option>
																	<?php foreach (BUSIENSS_REGISTERED as $key => $val) : ?>
																		<?php echo "<option value='$key'";
																		if ($key == $listing_data[0]['business_registeredCountry']) echo "selected";
																		echo ">$val</option>"; ?>
																	<?php endforeach; ?>
																</select>
															</div>
														</div>

														<div class="col-xl-6">
															<div class="submit-field">
																<h5>Page Tags</h5>
																<input type="text" id="page_tags" name="page_tags" value="<?php if (isset($listing_data[0]['page_tags'])) echo $listing_data[0]['page_tags'];  ?>" class="with-border" placeholder="Put comma separated tags">
															</div>
														</div>

														<div class="col-xl-12">
															<div class="submit-field tell_us_div">
																<h5>Tell us about your domain so potential buyers get excited. <span>(Optional)</span> <i class="help-icon" data-tippy-placement="right" title="Be Descriptive. Add everything you think which is important"></i></h5>
																<textarea id="tiny-editor" name="editordata" rows="5" cols="60" class="form-control"><?php if (isset($listing_data[0]['description'])) echo $listing_data[0]['description']; ?></textarea>

																<!-- <textarea id="summernoteDomain" name="editordata" rows="5" cols="60" class="form-control required"><?php //if (isset($listing_data[0]['description'])) echo $listing_data[0]['description']; 
																																										?></textarea> -->
															</div>
														</div>

														<div class="col-xl-6">
															<div class="submit-field">
																<div class="uploadButton margin-top-30 important_work_a">
																	<input class="uploadButton-input-thumb" type="file" accept="image/*" id="uploadThumbnailImage" name="uploadThumbnailImage" />
																	<label class="uploadButton-button ripple-effect" for="uploadThumbnailImage">Upload Image</label>
																	&nbsp;<span class='text-danger'>*</span>
																	<span class="uploadButton-file-name-thumb"></span><b>Listing Thumbnail Image ,An eye-catching image goes a long way.Upload a photograph of your domain, product, or service (min 200px x 200px)</b>
																</div>
															</div>
														</div>

														<div class="col-xl-6">
															<div class="submit-field">
																<h5>Will deliver in No. of Days</h5>
																<select id="deliver_in" name="deliver_in" class="required" class="selectpicker with-border">
																	<?php
																	for ($i = 1; $i <= 60; $i++) {
																		echo "<option value='$i'";
																		if ($i == $listing_data[0]['deliver_in']) echo "selected";
																		echo ">$i day</option>";
																	} ?>
																</select>
															</div>
														</div>


														<!--  start -->
														<!-- buying details -->
														<div id="Sell-Classified-Website" class="row w-100 asing_price_section_a">
															<?php  ?>
															<div class="col-xl-4 col-md-4">
																<div class="submit-field">
																	<h5>Asking Price (<?php if (!empty($default_currency)) echo $default_currency;
																						else echo '$'; ?>)</h5>
																	<input type="text" id="website_minimumoffer" name="website_minimumoffer" class="website_minimumoffer_j form-control with-border numeric_validation" value="<?php if (isset($listing_data[0]['original_minimumoffer'])) echo $listing_data[0]['original_minimumoffer']; ?>" onkeyup='validateInputNumbers(event)'>
																	<small class="text-info"> Leave Empty for further Decision </small>
																</div>
															</div>

															<div class="col-xl-4 col-md-4">
																<div class="submit-field">
																	<h5>Buy Now Price (<?php if (!empty($default_currency)) echo $default_currency;
																						else echo '$'; ?>)</h5>
																	<input type="text" id="website_buynowprice" name="website_buynowprice" class="website_buynowprice_j form-control with-border numeric_validation" value="<?php if (isset($listing_data[0]['original_buynowprice'])) echo $listing_data[0]['original_buynowprice']; ?>" onkeyup='validateInputNumbers(event)'><small class="text-info"> Leave Empty to disable</small>
																</div>
															</div>

															<div class="col-xl-4 col-md-4">
																<div class="submit-field">
																	<h5>Actual Price(<?php if (!empty($default_currency)) echo $default_currency;
																						else echo '$'; ?>)</h5>
																	<input type="text" id="website_discountprice" name="website_discountprice" class="website_discountprice_j form-control with-border txt_price numeric_validation" value="<?php if (isset($listing_data[0]['original_discountprice'])) echo $listing_data[0]['original_discountprice']; ?>" onkeyup='validateInputNumbers(event)'><small class="text-info"> Leave Empty to disable</small>
																</div>
															</div>

														</div>
														<!-- buying details end  -->
														<!--   commission div-->
														<div id="Sell-Classified-Website" class="row w-100 asing_price_section_a">
															<?php  ?>
															<div class="col-xl-4 col-md-4">
																<div class="submit-field">
																	<h5>Commission Type</h5>
																	<?php
																	// pre($listing_data[0],1);
																	$commission_type =  "";
																	if (!empty($listing_data[0]['commission_type'])) {
																		if ($listing_data[0]['commission_type'] == 1) {
																			$commission_type = "Fixed";
																		}
																		if ($listing_data[0]['commission_type'] == 2) {
																			$commission_type = "Percentage";
																		}
																	}   ?>


																	<select id="commission_type" name="commission_type" class=" commission_type_j form-control with-border ">

																		<?php if (!empty($listing_data[0]['commission_user_product'])) {
																			if ($listing_data[0]['commission_user_product'] == 2) {
																				foreach (COMMISSION_TYPE as $k => $v) : ?>
																					<option value="<?php echo $k; ?>" <?php if (trim($v) == trim($commission_type)) echo 'selected'; ?>> <?php echo $v ?> </option>
																				<?php endforeach;
																			} else if (!empty($commission_type)) { ?>
																				<option value="<?php echo $listing_data[0]['commission_type']; ?>"> <?php echo $commission_type ?> </option>
																				<?php  } else {
																				foreach (COMMISSION_TYPE as $k => $v) : ?>
																					<option value="<?php echo $k; ?>" <?php if (trim($v) == trim($commission_type)) echo 'selected'; ?>> <?php echo $v ?> </option>
																				<?php endforeach;
																				?>

																		<?php }
																		} ?>
																	</select>
																</div>
															</div>
															<div class="col-xl-4 col-md-4">
																<div class="submit-field">
																	<h5>Commission Amount (<?php if (!empty($default_currency)) echo $default_currency;
																							else echo '$'; ?>)</h5>
																	<input id="commission_amount" name="commission_amount" class="commission_amount_j form-control with-border " <?php if ($listing_data[0]['commission_user_product'] == 1) echo 'readonly';  ?> value="<?php if (isset($listing_data[0]['commission_amount'])) echo $listing_data[0]['commission_amount']; ?>" onkeyup='validateInputNumbers(event)'>

																</div>
															</div>
															<div class="col-xl-4 col-md-4">
																<div class="submit-field">
																	<h5>Commission Base </h5>
																	<?php
																	$commission_user_product =  "";
																	if (!empty($listing_data[0]['commission_user_product'])) {
																		if ($listing_data[0]['commission_user_product'] == 1) {
																			$commission_user_product = "General";
																		}
																		if ($listing_data[0]['commission_user_product'] == 2) {
																			$commission_user_product = "Product";
																		}
																	}   ?>
																	<!-- COMMISSION_BASE -->
																	<select onchange="showPriceCommission()" type="text" class="form-control with-border" name="commission_base" id="commission_base">
																		<?php foreach (COMMISSION_BASE as $k => $v) : ?>
																			<option value="<?php echo $k; ?>" <?php if (trim($v) == trim($commission_user_product)) echo 'selected'; ?>> <?php echo $v ?> </option>
																		<?php endforeach; ?>
																	</select>

																	<?php if ((empty($listing_data[0]['commission_user_product']) || $listing_data[0]['commission_user_product'] == 1) && $listing_data[0]['commission_amount'] == 0) { ?>
																		<!-- if commission not set then is message will show -->
																		<small class="text-danger">User profile commission is not added for this user</small>
																	<?php } ?>
																</div>
															</div>

														</div>
														<!--  commission div end  -->

														<!-- visible price -->

														<div id="Sell-Classified-Website" class="row w-100 asing_price_section_a">
															<?php  ?>
															<div class="col-xl-4 col-md-4">
																<div class="submit-field">
																	<h5>View Asking Price (<?php if (!empty($default_currency)) echo $default_currency;
																							else echo '$'; ?>)</h5>
																	<input disabled id="view_asking" type="text" class="form-control with-border " value="<?php if (isset($listing_data[0]['website_minimumoffer'])) echo $listing_data[0]['website_minimumoffer']; ?>">

																</div>
															</div>

															<div class="col-xl-4 col-md-4">
																<div class="submit-field">
																	<h5>View Buy Now Price (<?php if (!empty($default_currency)) echo $default_currency;
																							else echo '$'; ?>)</h5>
																	<input id="view_buynow" type="text" disabled class="form-control with-border" value="<?php if (isset($listing_data[0]['website_buynowprice'])) echo $listing_data[0]['website_buynowprice']; ?>">
																</div>
															</div>

															<div class="col-xl-4 col-md-4">
																<div class="submit-field">
																	<h5>View Actual Price(<?php if (!empty($default_currency)) echo $default_currency;
																							else echo '$'; ?>)</h5>
																	<input id="view_actual" disabled class="form-control with-border txt_price " value="<?php if (isset($listing_data[0]['website_discountprice'])) echo $listing_data[0]['website_discountprice']; ?>">
																</div>
															</div>

														</div>
														<!-- visbile price end -->
														
														<?php $this->load->view('admin/includes/edit-listing-type-and-sponsorship'); ?>
														
														<!--  end -->

														<div class="col-xl-6 ">
															<div class="submit-field">
																<h5>Current Status</h5>
																<div class="form-check form-check-inline">
																	<input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1" <?php if ($listing_data[0]['status'] == 1) echo "checked";
																																							else echo ""; ?>>
																	<label class="form-check-label pl-3 mb-3">Approved</label>
																</div>
																<div class="form-check form-check-inline">
																	<input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="9" <?php if ($listing_data[0]['status'] == 9) echo "checked";
																																							else echo ""; ?>>
																	<label class="form-check-label pl-3 mb-3"">Pending for Approval</label>
																</div>
															</div>
														</div>




													</div>
												</div>

												<!-- <div class=" row">

																		<div class="col-xl-8">
																			<div class="submit-field">
																				<h5>Domain Name</h5>
																				<input type="text" id="website_BusinessName" name="website_BusinessName" value="<?php if (isset($listing_data[0]['website_BusinessName'])) echo $listing_data[0]['website_BusinessName']; ?>" class="with-border" readonly="true" placeholder="Business Name" required>
																				<input type="hidden" name="listing_id" name="listing_id" value="<?php if (isset($listing_data[0]['id'])) echo $listing_data[0]['id']; ?>">
																				<input type="hidden" name="listing_type" name="listing_type" value="<?php if (isset($listing_data[0]['listing_type'])) echo $listing_data[0]['listing_type']; ?>">
																				<input type="hidden" name="listing_option" name="listing_option" value="<?php if (isset($listing_data[0]['listing_option'])) echo $listing_data[0]['listing_option']; ?>">
																			</div>
																		</div>

																		<div class="col-xl-4">
																			<div class="submit-field">
																				<h5>Register On <i class="help-icon" data-tippy-placement="right" title="Should be add date of established"></i></h5>

																				<input type="text" id="established_date" readonly="true" name="established_date" value="<?php if (isset($listing_data[0]['established_date'])) echo $listing_data[0]['established_date']; ?>" class="with-border datepicker" placeholder="yyyy/mm/dd" required>
																			</div>
																		</div>

																</div> -->
																<!---1st Row ends-->

																<!-- <div class="row">

													<div class="col-xl-6">
														<div class="submit-field">
															<h5>Tagline</h5>
															<input type="text" id="website_tagline" name="website_tagline" class="required form-control" placeholder="Tag Line" value="<?php if (isset($listing_data[0]['website_tagline'])) echo $listing_data[0]['website_tagline']; ?>" required>
														</div>
													</div>

													<div class="col-xl-6">
														<div class="submit-field">
															<h5>Meta Description of the website</h5>
															<textarea id="website_metadescription" name="website_metadescription" rows="5" cols="60" class="required form-control"><?php if (isset($listing_data[0]['website_metadescription'])) echo $listing_data[0]['website_metadescription']; ?></textarea>
														</div>
													</div>

													<div class="col-xl-12">
														<div class="submit-field">
															<h5>Domain Listing Description <span>(Important)</span> <i class="help-icon" data-tippy-placement="right" title="Be Descriptive. Add everything you think which is important"></i></h5>
															<textarea id="summernote" name="editordata" rows="5" cols="60" class="form-control"><?php if (isset($listing_data[0]['description'])) echo $listing_data[0]['description']; ?></textarea>
														</div>
													</div>

													<div class="col-xl-6">
														<div class="submit-field">
															<h5>Domain Registrar</h5>
															<select class="required" id="business_registrar" name="business_registeredCountry" class="selectpicker with-border">
																<?php
																if (isset($listing_data[0]['business_registeredCountry'])) {
																	echo "<option selected>" . $listing_data[0]['business_registeredCountry'] . "</option>";
																} else {
																	echo   "<option>Select domain registrar</option>";
																}
																?>
																<option>GoDaddy</option>
																<option>Tucows Domains</option>
																<option>NameCheap</option>
																<option>Network Solutions</option>
																<option>1&1</option>
																<option>eNom</option>
																<option>GMO Internet</option>
																<option>PDR</option>
																<option>Alibaba Cloud Computing</option>
																<option>Other</option>
															</select>
														</div>
													</div>

													<div class="col-xl-6">
														<div class="submit-field">
															<div class="uploadButton margin-top-30">
																<input class="uploadButton-input-thumb" type="file" accept="image/*" id="uploadThumbnailImage" name="uploadThumbnailImage" />
																<label class="uploadButton-button ripple-effect" for="uploadThumbnailImage">Upload Image</label>
																<span class="uploadButton-file-name-thumb"><b>Listing Thumbnail Image ,An eye-catching image goes a long way.Upload a photograph of your site, product, or service (min 200px x 200px)</b></span>
															</div>
														</div>
													</div>

												</div> -->

																<!------------->
															</div>
														</div>
														<!--Listing Tab Ends-->

													</div>

												</div>
												<!--/Panel Ends--->

											</div>
											<!--Full Tabs Ends-->
										</div>

										<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

						</form>

						<div class="col-xl-12">
						<div id="response_success" class="text-center"></div>
							<span id="loadingImageSubmit" style="display:none;" class="centerButtons"> <img src="<?php echo base_url(); ?>assets/img/loadingimage.gif" /> </span>
							<div id="submitValidaton"></div>
							<button type="submit" class="button ripple-effect big margin-top-30 btntheme_color_a" style="float: right;" form="createListingFormAdmin"><i class="icon-feather-plus"></i> Update Changes</button>
						</div>

					</div>
					<!-- Row / End -->

					<!-- Footer -->
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
			$('#summernote,#summernoteDomain').summernote({
				height: 300,
				dialogsInBody: true

			});
		});
	</script>

	<script>
		populateListOfCountries('business_registeredCountry', '<?php echo $listing_data[0]['business_registeredCountry']; ?>');
		$('.uploadButton-input-thumb').next('label').text("<?php echo $listing_data[0]['website_thumbnail']; ?>");
	</script>


</body>

</html>