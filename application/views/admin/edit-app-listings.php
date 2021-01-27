<!DOCTYPE html>
<html lang="<?php if (!empty($language)) echo $language;
			else echo 'en'; ?>">

<head>

	<!--User Page Meta Tags-->
	<title>Edit App Listings - <?php if (isset($listing_data[0]['website_BusinessName'])) echo $listing_data[0]['website_BusinessName']; ?> | <?php echo $this->lang->line('site_name') ?>| User Dashboard</title>
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
						
						<h3><b>Edit App Listing | </b> <?php if (isset($listing_data[0]['website_BusinessName'])) echo $listing_data[0]['website_BusinessName']; ?> | <?php if (isset($listing_data[0]['app_market'])) echo $listing_data[0]['app_market']; ?></h3>

						<!-- Breadcrumbs -->
						<nav id="breadcrumbs" class="dark">
							<ul>
								<li><a href="<?php echo site_url('admin'); ?>">Home</a></li>
								<li><a href="<?php echo site_url('admin/current_listings'); ?>">Current Listing</a></li>
								<li>Edit App Listings</li>
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

												<div class="content with-padding padding-bottom-10 correct_app_listing_a">
													<div class="row">

														<div class="content with-padding padding-bottom-10">
															<div class="row">

																<!-- <div class="col-xl-8">

																	<div class="submit-field">
																		<div id="AppUrlValMsg"></div>
																		<h5>App URL <span>(Important)</span> <i class="help-icon" data-tippy-placement="right" title="Please enter your Playstore or Appstore App URL"></i></h5>
																		<div class="keywords-container">
																			<div class="keyword-input-container">
																				<input type="text" id="appURL" name="appURL" class="with-border" placeholder="http://play.google.com/store/apps/yourapp" required>
																				<button class="keyword-input-button ripple-effect button-verify-appurl-admin"><i class="fa fa-check" aria-hidden="true"></i></button>
																			</div>
																			<span id="loadingImageVerify" style="display:none;" class="centerButtons"> <img src="<?php echo base_url(); ?>assets/img/loadingimage.gif" /> </span>
																			<div class="clearfix"></div>
																		</div>
																	</div>
																	<div id="ContinueVal"></div>
																</div> -->
																<div class="col-xl-6">

																	<div class="submit-field">
																		<h5>App Name <span class="text-danger">*</span> </h5>
																		<input type="text" id="website_BusinessName" name="website_BusinessName" value="<?php if (isset($listing_data[0]['website_BusinessName'])) echo $listing_data[0]['website_BusinessName']; ?>" class="with-border requried" placeholder="App Name" required>
																		<input type="hidden" id="domain_id" name="domain_id" value="<?php if (isset($listing_data[0]['domain_id'])) echo $listing_data[0]['domain_id']; ?>">

																		<input type="hidden" id="listing_id" name="listing_id" name="listing_id" value="<?php if (isset($listing_data[0]['id'])) echo $listing_data[0]['id']; ?>">
																		<input type="hidden" name="listing_type" name="listing_type" value="<?php if (isset($listing_data[0]['listing_type'])) echo $listing_data[0]['listing_type']; ?>">
																		<input type="hidden" name="listing_option" name="listing_option" value="<?php if (isset($listing_data[0]['listing_option'])) echo $listing_data[0]['listing_option']; ?>">
																	</div>
																</div>
																<?php $this->load->view('user/includes/_listing_slug'); ?>


																<div class="col-xl-4">
																	<div class="submit-field">
																		<h5>Select One Option</h5>

																		<select class="" id="website_status_edit" name="website_status" class="selectpicker with-border">
																			<option value="">Status of App</option>
																			<option value="Established" <?php echo  $listing_data[0]['website_status'] == "Established" ? "selected" : "";  ?> data-file="_app_established">Established</option>
																			<option value="Starter" data-file="_app_starter" <?php echo  $listing_data[0]['website_status'] == "Starter" ? "selected" : "";  ?>>Starter</option>
																		</select>
																	</div>
																</div>



																<div class="col-xl-4">
																	<div class="submit-field">
																		<h5>Date Established <i class="help-icon" data-tippy-placement="right" title="Should be add date of established"></i></h5>
																		<input type="text" id="established_date" name="established_date" value="<?php if (isset($listing_data[0]['established_date'])) echo $listing_data[0]['established_date'];  ?>" class="with-border datepicker" placeholder="yyyy/mm/dd" readonly="true" required="">
																	</div>
																</div>


																<div class="col-xl-4">
																	<div class="submit-field">
																		<h5>App Registered</h5>
																		<select class="required" id="business_registeredCountry" name="business_registeredCountry" class="selectpicker with-border">
																			<option value="" selected>Where is your app registered?</option>
																		</select>
																	</div>
																</div>

																<div class="col-xl-4">
																	<div class="submit-field">
																		<h5>App Industry</h5>
																		<?php if (isset($listing_data[0]['website_industry']) && !empty($listing_data[0]['website_industry'])) ?>
																		<select class="required" name="website_industry" id="website_industry" class="selectpicker with-border">
																			<option value="">Select Your App Industry</option>
																			<?php foreach ($categoriesData as $key) {
																				if (!empty($listing_data[0]['website_industry'])) {
																					if ($key['c_id'] == $listing_data[0]['website_industry']) {
																			?>
																						<option value="<?php echo $key['c_id']; ?>" selected><?php echo $key['c_name']; ?></option>
																					<?php } else { ?>
																						<option value="<?php echo $key['c_id']; ?>"><?php echo $key['c_name']; ?></option>
																					<?php }
																				} else { ?>
																					<option value="<?php echo $key['c_id']; ?>"><?php echo $key['c_name']; ?></option>
																			<?php }
																			} ?>
																		</select>
																	</div>
																</div>

																<div class="col-xl-8">
																	<div class="submit-field">
																		<h5><b> Financial Overview : </b> Revenue | Expenses | <span>(Net Profit)</span> <i class="help-icon" data-tippy-placement="right" title="Net Profit will be automatically calculated"></i></h5>
																		<div class="row">
																			<div class="col-xl-4">
																				<div class="input-with-icon">
																					<input type="text" id="last12_monthsrevenue" name="last12_monthsrevenue" value="<?php if (isset($listing_data[0]['last12_monthsrevenue'])) echo $listing_data[0]['last12_monthsrevenue']; ?>" class="with-border numeric_validation" placeholder="$00" onkeypress='validateInputNumbers(event)'>
																					<i class="currency"><?php if (!empty($default_currency)) echo $default_currency;
																										else echo '$'; ?></i>
																				</div>
																			</div>
																			<div class="col-xl-4">
																				<div class="input-with-icon">
																					<input type="text" id="last12_monthsexpenses" name="last12_monthsexpenses" value="<?php if (isset($listing_data[0]['last12_monthsexpenses'])) echo $listing_data[0]['last12_monthsexpenses']; ?>" class="with-border numeric_validation" placeholder="$00" onkeypress='validateInputNumbers(event)'>
																					<i class="currency"><?php if (!empty($default_currency)) echo $default_currency;
																										else echo '$'; ?></i>
																				</div>
																			</div>
																			<div class="col-xl-4">
																				<div class="input-with-icon">
																					<input type="text" id="annual_profit" name="annual_profit" value="<?php if (isset($listing_data[0]['annual_profit'])) echo $listing_data[0]['annual_profit']; ?>" class="with-border" placeholder="" readonly="true">
																					<i class="currency"><?php if (!empty($default_currency)) echo $default_currency;
																										else echo '$'; ?></i>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>

																<div class="row pl-4 pr-4 website_status_established <?php echo  $listing_data[0]['website_status'] != 'Established' ? 'd-none' : ''; ?>">

																	<div class="col-xl-4">
																		<div class="submit-field">
																			<h5>Monetized Since <i class="help-icon" data-tippy-placement="right" title="Should be add date form motitization starts"></i></h5>
																			<input type="text" id="monetized_since" name="monetized_since" value="<?php if (isset($listing_data[0]['monetized_since'])) echo $listing_data[0]['monetized_since'];  ?>" class="with-border datepicker" placeholder="yyyy/mm/dd" readonly="true">
																		</div>
																	</div>

																	<div class="col-xl-4">
																		<div class="submit-field">
																			<h5>Last 6 Months Avg Revenue <i class="help-icon" data-tippy-placement="right" title="Should be add Last 6 Months Avg Revenue"></i></h5>
																			<input type="text" id="six_months_revenue" name="six_months_revenue" value="<?php if (isset($listing_data[0]['six_months_revenue'])) echo $listing_data[0]['six_months_revenue'];  ?>" class="with-border numeric_validation" placeholder="$00" maxlength="8" onkeypress="validateInputNumbers(event)">
																		</div>
																	</div>

																	<div class="col-xl-4">
																		<div class="submit-field">
																			<h5>Last 6 Months Avg Profit <i class="help-icon" data-tippy-placement="right" title="Should be add Last 6 Months Avg Profit"></i></h5>
																			<input type="text" id="six_months_profit" name="six_months_profit" value="<?php if (isset($listing_data[0]['six_months_profit'])) echo $listing_data[0]['six_months_profit'];  ?>" class="with-border numeric_validation" placeholder="$00" maxlength="8" onkeypress="validateInputNumbers(event)">
																		</div>
																	</div>

																	<div class="col-xl-4">
																		<div class="submit-field">
																			<h5>Monthly Visitors <span class="text-danger">*</span></h5>
																			<input type="text" id="monthly_visitors" name="monthly_visitors" value="<?php if (isset($listing_data[0]['monthly_visitors'])) echo $listing_data[0]['monthly_visitors'];  ?>" class="with-border numeric_validation" placeholder="$00" required="">
																		</div>
																	</div>



																</div>




																<div class="col-xl-12">
																	<h5><b> Financial Evidences </b> <span>(Optional)</span> <i class="help-icon" data-tippy-placement="right" title="Net Profit will be automatically calculated"></i></h5>
																	<div class="row">
																		<div class="col-xl-6">
																			<div class="submit-field">
																				<div class="uploadButton margin-top-30">
																					<input class="uploadButton-input-visual" type="file" accept="image/*, application/pdf" id="uploadVisual" name="uploadVisual" />
																					<label class="uploadButton-button ripple-effect" for="uploadVisual">Upload Files</label>
																					<span class="uploadButton-file-name-visual"></span><br><b>Visual Evidence of Revenue Screenshot or video walkthrough. Can be from Quickbooks, AdSense, Shopify, Amazon, PayPal, etc.</b>
																				</div>
																			</div>
																		</div>

																		<div class="col-xl-6">
																			<div class="submit-field">
																				<div class="uploadButton margin-top-30">
																					<input class="uploadButton-input-profit" type="file" accept="image/*, application/pdf" id="uploadProfitLoss" name="uploadProfitLoss" />
																					<label class="uploadButton-button ripple-effect" for="uploadProfitLoss">Upload Files</label>
																					<span class="uploadButton-file-name-profit"></span><br><b>P&L (Profit and Loss Statement), Please ensure this is up to date to gain customer trust towards your listings.Ignore if you don't have this</b>
																				</div>
																			</div>
																		</div>

																	</div>

																</div>

															</div>
															<!---1st Row ends-->

															<div class="row">

																<div class="col-xl-6">
																	<div class="submit-field">
																		<h5>Tagline <span>(Optional)</span></h5>
																		<input type="text" id="website_tagline" name="website_tagline" class="with-border" placeholder="Tag Line" value="<?php if (isset($listing_data[0]['website_tagline'])) echo $listing_data[0]['website_tagline']; ?>">
																	</div>
																</div>

																<div class="col-xl-6">
																	<div class="submit-field">
																		<h5>Page Tags</h5>
																		<input type="text" id="page_tags" name="page_tags" value="<?php if (isset($listing_data[0]['page_tags'])) echo $listing_data[0]['page_tags'];  ?>" class="with-border" placeholder="Put comma separated tags">
																	</div>
																</div>

																<div class="col-xl-6">
																	<div class="submit-field">
																		<h5>Meta Description of the App <span>(Optional)</span> </h5>
																		<textarea id="website_metadescription" name="website_metadescription" rows="5" cols="60" class=" with-border"><?php if (isset($listing_data[0]['website_metadescription'])) echo $listing_data[0]['website_metadescription']; ?></textarea>
																	</div>
																</div>

																<div class="col-xl-6">
																	<div class="submit-field">
																		<h5>Meta Keywords <span>(Optional)</span> <i class="help-icon" data-tippy-placement="right" title="Seperate each word by a ,"></i></h5>
																		<textarea id="website_metakeywords" name="website_metakeywords" rows="3" cols="60" class=" with-border"><?php if (isset($listing_data[0]['website_metakeywords'])) echo $listing_data[0]['website_metakeywords']; ?></textarea>
																	</div>
																</div>

																<div class="col-xl-12">
																	<div class="submit-field">
																		<h5>Tell us about your App so potential buyers get excited. What does your App do? <span>(Optional)</span> <i class="help-icon" data-tippy-placement="right" title="Be Descriptive. Add everything you think which is important"></i></h5>
																		<!-- <textarea id="summernote" name="editordata" rows="5" cols="60" class="form-control"><?php //if (isset($listing_data[0]['description'])) echo $listing_data[0]['description']; 
																																									?></textarea> -->
																		<textarea id="tiny-editor" name="editordata" rows="5" cols="60" class="form-control"><?php if (isset($listing_data[0]['description'])) echo $listing_data[0]['description']; ?></textarea>

																	</div>
																</div>

																<div class="col-xl-6">
																	<div class="submit-field">
																		<h5>How does your App make money? <span>(Optional)</span></h5>
																		<textarea id="website_how_make_money" name="website_how_make_money" rows="3" cols="60" class=" form-control"><?php if (isset($listing_data[0]['website_how_make_money'])) echo $listing_data[0]['website_how_make_money']; ?></textarea>
																	</div>
																</div>


																<div class="col-xl-6">
																	<div class="submit-field">
																		<h5>Describe your purchasing and order fulfilment process <span>(Optional)</span> </h5>
																		<textarea id="website_purchasing_fulfilment" name="website_purchasing_fulfilment" rows="3" cols="60" class=" form-control"><?php if (isset($listing_data[0]['website_purchasing_fulfilment'])) echo $listing_data[0]['website_purchasing_fulfilment']; ?></textarea>
																	</div>
																</div>

																<div class="col-xl-6">
																	<div class="submit-field">
																		<h5>Why are you selling this app? <span>(Optional)</span> </h5>
																		<textarea id="website_whyselling" name="website_whyselling" rows="3" cols="60" class=" form-control"><?php if (isset($listing_data[0]['website_whyselling'])) echo $listing_data[0]['website_whyselling']; ?></textarea>
																	</div>
																</div>

																<div class="col-xl-6">
																	<div class="submit-field">
																		<h5>Will deliver in No. of Days</h5>
																		<select id="deliver_in" name="deliver_in" class="required" class="selectpicker with-border">
																			<?php
																			for ($i = 1; $i <= 30; $i++) {
																				echo "<option value='$i'";
																				if ($i == $listing_data[0]['deliver_in']) echo "selected";
																				echo ">$i day</option>";
																			} ?>
																		</select>
																	</div>
																</div>

																<div class="col-xl-6">
																	<div class="submit-field">
																		<h5>Average Monthly Downloads <span class="text-danger">*</span> </h5>
																		<input type="text" id="monthly_downloads" name="monthly_downloads" value="<?php if (isset($listing_data[0]['monthly_downloads'])) echo $listing_data[0]['monthly_downloads']; ?>" class="with-border numeric_validation" placeholder="00" onkeypress='validateInputNumbers(event)'>
																	</div>
																</div>

																<div class="col-xl-6">
																	<div class="submit-field">
																		<div class="uploadButton margin-top-36 important_work_a">
																			<input class="uploadButton-input-thumb" type="file" accept="image/*" id="uploadThumbnailImage" name="uploadThumbnailImage" />
																			<label class="uploadButton-button ripple-effect uplaoddatabase_a" for="uploadThumbnailImage">Upload App Icon Image</label>
																			<span class="uploadButton-file-name-thumb"></span>
																		</div>
																	</div>
																</div>





																<!------------->
																<div class="col-xl-12">
																	<h4> How would like to sell | How much would you like to sell it for</h4>
																</div>
																<br>
																<br>
																<!-- <div class="col-xl-4">
																	<div class="submit-field">
																		<h5>Asking Price (<?php if (!empty($default_currency)) echo $default_currency;
																							else echo '$'; ?>)</h5>
																		<input type="text" id="website_minimumoffer" name="website_minimumoffer" class=" form-control with-border 
																			numeric_validation" placeholder="0" value="<?php if (isset($listing_data[0]['website_minimumoffer'])) echo $listing_data[0]['website_minimumoffer']; ?>" onkeypress='validateInputNumbers(event)'>
																		<small class="text-info"> Leave Empty for further Decision </small>
																	</div>
																</div>

																<div class="col-xl-4">
																	<div class="submit-field">
																		<h5>Buy Now Price (<?php if (!empty($default_currency)) echo $default_currency;
																							else echo '$'; ?>)</h5>
																		<input type="text" id="website_buynowprice" name="website_buynowprice" class="form-control with-border numeric_validation" placeholder="0" value="<?php if (isset($listing_data[0]['website_buynowprice'])) echo $listing_data[0]['website_buynowprice']; ?>" onkeypress='validateInputNumbers(event)'><small class="text-info"> Leave Empty to disable</small>
																	</div>
																</div>


																<div class="col-xl-4">
																	<div class="submit-field">
																		<h5>Actual Price(<?php if (!empty($default_currency)) echo $default_currency;
																							else echo '$'; ?>)</h5>
																		<input type="text" id="website_discountprice" name="website_discountprice" class="form-control with-border txt_price numeric_validation" placeholder="0" value="<?php if (isset($listing_data[0]['website_discountprice'])) echo $listing_data[0]['website_discountprice']; ?>" onkeypress='validateInputNumbers(event)'><small class="text-info"> Leave Empty to disable</small>
																	</div>
																</div> -->
																<!--  start -->
																<!-- buying details -->
																<div id="Sell-Classified-Website" class="row w-100 asing_price_section_a">
																	<?php  ?>
																	<div class="col-xl-4 col-md-4">
																		<div class="submit-field">
																			<h5>Asking Price (<?php if (!empty($default_currency)) echo $default_currency;
																								else echo '$'; ?>)</h5>
																			<input type="text" id="website_minimumoffer" name="website_minimumoffer" class="website_minimumoffer_j form-control with-border numeric_validation" value="<?php if (isset($listing_data[0]['original_minimumoffer'])) echo $listing_data[0]['original_minimumoffer']; ?>" onkeypress='validateInputNumbers(event)'>
																			<small class="text-info"> Leave Empty for further Decision </small>
																		</div>
																	</div>

																	<div class="col-xl-4 col-md-4">
																		<div class="submit-field">
																			<h5>Buy Now Price (<?php if (!empty($default_currency)) echo $default_currency;
																								else echo '$'; ?>)</h5>
																			<input type="text" id="website_buynowprice" name="website_buynowprice" class="website_buynowprice_j form-control with-border numeric_validation" value="<?php if (isset($listing_data[0]['original_buynowprice'])) echo $listing_data[0]['original_buynowprice']; ?>" onkeypress='validateInputNumbers(event)'><small class="text-info"> Leave Empty to disable</small>
																		</div>
																	</div>

																	<div class="col-xl-4 col-md-4">
																		<div class="submit-field">
																			<h5>Actual Price(<?php if (!empty($default_currency)) echo $default_currency;
																								else echo '$'; ?>)</h5>
																			<input type="text" id="website_discountprice" name="website_discountprice" class="website_discountprice_j form-control with-border txt_price numeric_validation" value="<?php if (isset($listing_data[0]['original_discountprice'])) echo $listing_data[0]['original_discountprice']; ?>" onkeypress='validateInputNumbers(event)'><small class="text-info"> Leave Empty to disable</small>
																		</div>
																	</div>

																</div>
																<!-- buying details end  -->
																<!--   commission div-->
																<div id="Sell-Classified-Website" class="row w-100 asing_price_section_a">
																	
																	<div class="col-xl-4 col-md-4">
																		<div class="submit-field">
																			<h5>Commission Type</h5>
																			<?php
																			$commission_type =  "";
																			if (!empty($listing_data[0]['commission_type'])) {
																				if ($listing_data[0]['commission_type'] == 1) {
																					$commission_type = "Fixed";
																				}
																				if ($listing_data[0]['commission_type'] == 2) {
																					$commission_type = "Percentage";
																				}
																			}   ?>


																			<select id="commission_type" name="commission_type" class="commission_type_j form-control with-border ">

																				<?php if (!empty($listing_data[0]['commission_user_product'])) {
																					if ($listing_data[0]['commission_user_product'] == 2) {
																						foreach (COMMISSION_TYPE as $k => $v) : ?>
																							<option value="<?php echo $k; ?>" <?php if (trim($v) == trim($commission_type)) echo 'selected'; ?>> <?php echo $v ?> </option>
																						<?php endforeach;
																					} else if (!empty($commission_type)) { ?>
																						<option value="<?php echo $listing_data[0]['commission_user_product']; ?>"> <?php echo $commission_type ?> </option>
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
																			<input id="commission_amount" name="commission_amount" class="commission_amount_j form-control with-border " <?php if ($listing_data[0]['commission_user_product'] == 1) echo 'readonly';  ?> value="<?php if (isset($listing_data[0]['commission_amount'])) echo $listing_data[0]['commission_amount']; ?>" onkeypress='validateInputNumbers(event)'>

																		</div>
																	</div>
																	<div class="col-xl-4 col-md-4">
																		<div class="submit-field">
																			<h5>Commission Base </h5>
																			<?php

																			$commission_user_product =  "";
																			if (!empty($listing_data[0]['commission_user_product'])) {
																				if ($listing_data[0]['commission_user_product'] == 1) {
																					$commission_user_product = "User Profile";
																				}
																				if ($listing_data[0]['commission_user_product'] == 2) {
																					$commission_user_product = "Product";
																				}
																			}   ?>
																			<!-- COMMISSION_BASE -->
																			<select onchange="showPriceCommission()" class="form-control with-border" name="commission_base" id="commission_base">
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
																			<input disabled type="text" id="view_asking" class="form-control with-border " value="<?php if (isset($listing_data[0]['website_minimumoffer'])) echo $listing_data[0]['website_minimumoffer']; ?>">

																		</div>
																	</div>

																	<div class="col-xl-4 col-md-4">
																		<div class="submit-field">
																			<h5>View Buy Now Price (<?php if (!empty($default_currency)) echo $default_currency;
																									else echo '$'; ?>)</h5>
																			<input type="text" disabled id="view_buynow" class="form-control with-border" value="<?php if (isset($listing_data[0]['website_buynowprice'])) echo $listing_data[0]['website_buynowprice']; ?>">
																		</div>
																	</div>

																	<div class="col-xl-4 col-md-4">
																		<div class="submit-field">
																			<h5>View Actual Price(<?php if (!empty($default_currency)) echo $default_currency;
																									else echo '$'; ?>)</h5>
																			<input disabled id="view_actual" class="form-control with-border txt_price " value="<?php if (isset($listing_data[0]['website_discountprice'])) echo $listing_data[0]['website_discountprice']; ?>">
																		</div>
																	</div>

																</div>
																<!-- visbile price end -->
																
																<?php $this->load->view('admin/includes/edit-listing-type-and-sponsorship'); ?>

																
																
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

														<div id=" response_success" class="button mt-4 ml-5  col-xl-3 float-right"></div>

																	</div>
																</div>
															</div>





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
		$('.uploadButton-input-cover').next('label').text("<?php echo $listing_data[0]['website_cover']; ?>");
		$('.uploadButton-input-thumb').next('label').text("<?php echo $listing_data[0]['website_thumbnail']; ?>");
		$('.uploadButton-input-visual').next('label').text("<?php echo $listing_data[0]['financial_uploadVisual']; ?>");
		$('.uploadButton-input-profit').next('label').text("<?php echo $listing_data[0]['financial_uploadProfitLoss']; ?>");
	</script>

</body>

</html>