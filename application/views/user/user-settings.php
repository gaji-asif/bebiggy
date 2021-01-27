<!DOCTYPE html>
<html lang="<?php if(!empty($language)) echo $language; else echo 'en'; ?>">
<head>

<!--User Page Meta Tags-->
<title>User Settings | <?php echo $this->lang->line('site_name') ?>| User Dashboard</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="icon" href="<?php if(isset($imagesData[0]['favicon'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['favicon']; ?>" alt="favicon" />
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


	<!-- Dashboard Content
	================================================== -->
	<div class="dashboard-content-container" data-simplebar>
		<div class="dashboard-content-inner" >
			
			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				
				<div class="dashboad_table">
				<i class="icon-material-outline-settings"></i>  <h3><b>User Profile </b></h3>
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
						<li><a href="<?php echo site_url('user/dashboard'); ?>">Dashboard</a></li>
						<li>User Profile</li>
					</ul>
				</nav>
			
	
			<!-- Row -->
			<div class="row">

				<form id="UserDetailsChangeForm" method="post" enctype="multipart/form-data"/>

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-account-circle"></i> My Account</h3>
						</div>

						<div class="content with-padding padding-bottom-0">

							<div class="row">

								<div class="col-auto">
									<div class="avatar-wrapper" data-tippy-placement="bottom" title="Change Avatar">
										<img class="profile-pic" src="<?php if(!empty($userdata[0]['thumbnail'])) echo base_url().USER_UPLOAD.$userdata[0]['thumbnail']; else echo 'images/user-avatar-placeholder.png'; ?>" alt="" />
										<div class="upload-button"></div>
										<input id="uploadthumbnail" name="uploadthumbnail" class="file-upload" type="file" accept="image/*" value="<?php if(!empty($userdata[0]['thumbnail'])) echo realpath(USER_UPLOAD.$userdata[0]['thumbnail']); ?>" />
									</div>
								</div>

								<div class="col">
									<div class="row">

										<div class="col-xl-6">
											<div class="submit-field">
												<h5>First Name</h5>
												<input id="firstname" name="firstname" type="text" class="with-border" value="<?php if(isset($userdata[0]['firstname'])) echo $userdata[0]['firstname']; ?>">
												<input id="user_id" name="user_id" type="hidden" value="<?php if(isset($userdata[0]['user_id'])) echo $userdata[0]['user_id']; ?>">
											</div>
										</div>

										<div class="col-xl-6">
											<div class="submit-field">
												<h5>Last Name</h5>
												<input id="lastname" name="lastname" type="text" class="with-border" value="<?php if(isset($userdata[0]['lastname'])) echo $userdata[0]['lastname']; ?>">
											</div>
										</div>

										<div class="col-xl-6">
											<!-- Account Type -->
											<div class="submit-field">
												<h5>Account Status</h5>
												<div class="account-type">
													<div>
														<?php if($userdata[0]['online'] === '1') { ?>
														<input type="radio" name="account-online-radio" id="seller-radio" class="account-type-radio" value="1" checked/>
														<?php } else {?>
														<input type="radio" name="account-online-radio" id="seller-radio" class="account-type-radio" value="1" />
														<?php }  ?>
														<label for="seller-radio" class="ripple-effect-dark"><i class="icon-material-outline-account-circle"></i> Online</label>
													</div>

													<div>
														<?php if($userdata[0]['online'] === '0') { ?>
														<input type="radio" name="account-online-radio" id="employer-radio" class="account-type-radio" value="0" checked/>
														<?php } else {?>
														<input type="radio" name="account-online-radio" id="employer-radio" class="account-type-radio" value="0" />
														<?php }  ?>
														<label for="employer-radio" class="ripple-effect-dark"><i class="icon-material-outline-business-center"></i> Offline</label>
													</div>
												</div>
											</div>
										</div>

										<div class="col-xl-6">
											<div class="submit-field">
												<h5>Email</h5>
												<input type="email" class="with-border" value="<?php if(isset($userdata[0]['email'])) echo $userdata[0]['email']; ?>" readonly="true">
											</div>
										</div>

									</div>
								</div>
							</div>

						</div>
					</div>
				</div>

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-face"></i> My Profile</h3>
						</div>

						<div class="content">
							<ul class="fields-ul">
							<li>
								<div class="row">
									<div class="col-xl-12">
										<div class="submit-field">
											<h5>Nationality</h5>
											<select id="user_country" name="user_country" class="form-control" >
                                            	<option value="" selected>What is your country?</option>
                                        	</select>
										</div>
									</div>

									<div class="col-xl-12 intro_filed">
										<div class="col-xl-6">
										<div class="submit-field">
											<h5>Introduce Yourself</h5>
											<textarea id="user_description" name="user_description" cols="30" rows="5" class="with-border"><?php if(isset($userdata[0]['user_description'])) echo $userdata[0]['user_description']; ?></textarea>
										</div>
									</div>
									<div class="col-xl-6">
										<div class="submit-field">
											<h5>Meta Description</h5>
											<textarea id="user_metadescription" name="user_metadescription" cols="30" rows="2" class="with-border"><?php if(isset($userdata[0]['user_metadescription'])) echo $userdata[0]['user_metadescription']; ?></textarea>
										</div>
									</div>
									</div>

								</div>
							</li>
						</ul>
						</div>
					</div>
				</div>

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div id="test1" class="dashboard-box">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-facebook"></i> Social Networks</h3>
						</div>

						<div class="content with-padding">
							<div class="row">
								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Twitter</h5>
										<input id="social_twitter" name="social_twitter" type="text" class="with-border" value="<?php if(isset($userdata[0]['social_twitter'])) echo $userdata[0]['social_twitter']; ?>">
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Facebook</h5>
										<input id="social_facebook" name="social_facebook" type="text" class="with-border" value="<?php if(isset($userdata[0]['social_facebook'])) echo $userdata[0]['social_facebook']; ?>">
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Youtube</h5>
										<input id="social_youtube" name="social_youtube" type="text" value="<?php if(isset($userdata[0]['social_youtube'])) echo $userdata[0]['social_youtube']; ?>" class="with-border">
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>


				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div id="test1" class="dashboard-box">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-facebook"></i> Payment Settings</h3>
						</div>

						<div class="content with-padding">
							<div class="row">

								<?php foreach ($withdraw_meths as $key) { 
								if($key['id'] === '1') {?>
								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Paypal Email Address</h5>
										<input id="paypal_email" name="paypal_email" type="text" class="with-border" value="<?php if(isset($userdata[0]['paypal'])) echo $userdata[0]['paypal']; ?>">
									</div>
								</div>
								<?php } else if ($key['id'] === '2') { ?>
								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Payoneer Email Address</h5>
										<input id="payoneer_email" name="payoneer_email" type="text" class="with-border" value="<?php if(isset($userdata[0]['payoneer'])) echo $userdata[0]['payoneer']; ?>">
									</div>
								</div>
								<?php } else if ($key['id'] === '3') { ?>
								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Bank Account Name</h5>
										<input id="bank_accountname" name="bank_accountname" type="text" class="with-border" value="<?php if(isset($userdata[0]['firstname'])) echo $userdata[0]['firstname']; ?> <?php if(isset($userdata[0]['lastname'])) echo $userdata[0]['lastname']; ?>"  readonly=true>
									</div>
								</div>
								
								<div class="col-xl-12">
									<div class="submit-field">
										<h5>Bank Details<code> (Account No /Swift code/Bank name/Branch name/Branch address/Branch code)</code></h5>
										<textarea rows="8" id="bank_details" name="bank_details" type="text" class="with-border"><?php if(isset($userdata[0]['bank_transfer'])) echo $userdata[0]['bank_transfer']; ?> </textarea> 
									</div>
								</div>
								<?php } } ?>
							</div>
						</div>
					</div>
				</div>
				<!-- overview start -->
				<div class="col-xl-12">
					<div id="test1" class="dashboard-box">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-facebook"></i> Overview</h3>
						</div>

						<div class="content with-padding">
							<div class="row">

								<?php foreach ($withdraw_meths as $key) { 
								if($key['id'] === '1') {?>
								<div class="col-xl-12">
									<div class="submit-field">
										<h5>GIG TITLE</h5>
										<input id="paypal_email" name="git_title" type="text" class="with-border" value="<?php if(isset($userdata[0]['paypal'])) echo $userdata[0]['paypal']; ?>" placeholder="I will do any thing something i'm really good at">
									</div>
								</div>
								<?php } else if ($key['id'] === '2') { ?>
								<div class="col-xl-4">
									<div class="submit-field">
										<h5>CATEGORY</h5>
										<select id="user_country" name="user_country" class="form-control" >
                                            	<option value="" selected>Please Select</option>
                                            	<option>Graphics &amp; Design</option>
                                            	<option>Digital Marketing</option>
                                            	<option>Writing &amp; Translation</option>
                                            	<option>Video &amp; Animation</option>
                                            	<option>Music &amp; Audio</option>
                                            	<option>Programming &amp; Tech</option>
                                            	<option>Business</option>
                                            	<option>Lifestyle</option>
                                        	</select>
									</div>
								</div>
								<div class="col-xl-4">
									<div class="submit-field">
										<h5>SUB CATEGORY</h5>
										<select id="user_country" name="user_country" class="form-control" >
										<option value="" selected>Select A Subcategory</option>
                                            	<option>Graphics &amp; Design</option>
                                            	<option>Digital Marketing</option>
                                            	<option>Writing &amp; Translation</option>
                                            	<option>Video &amp; Animation</option>
                                            	<option>Music &amp; Audio</option>
                                            	<option>Programming &amp; Tech</option>
                                            	<option>Business</option>
                                            	<option>Lifestyle</option>
                                            </select>
									</div>
								</div>
								<div class="col-xl-4">
									<div class="submit-field">
										<h5>SERVICE TYPE</h5>
										<select id="user_country" name="user_country" class="form-control" >
                                            	<option value="" selected>Select A Service Type</option>
                                            	<option>Backgrounds &amp; Environments</option>
                                            	<option>Character Design</option>
                                            	<option>Props &amp; Objects</option>
                                            	<option>UI &amp; UX</option>
                                        	</select>
									</div>
								</div>
							<?php } } ?>
							</div>
						</div>
					</div>
				</div>
				<!-- end overview -->
				<!-- start scope and pricing -->
				<div class="col-xl-12">
					<div id="test1" class="dashboard-box">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-facebook"></i> BASIC</h3>
						</div>

						<div class="content with-padding">
							<div class="row">

								<?php foreach ($withdraw_meths as $key) { 
								if($key['id'] === '1') {?>
								<div class="col-xl-6 col-sm-12">
									<div class="submit-field">
										
										<input id="paypal_email" name="git_title" type="text" class="with-border" value="<?php if(isset($userdata[0]['paypal'])) echo $userdata[0]['paypal']; ?>" placeholder="Name your package">
									</div>
								</div>
								<?php } else if ($key['id'] === '2') { ?>
								<div class="col-xl-6 col-sm-12">
									<div class="submit-field">
										
										<input id="paypal_email" name="git_title" type="text" class="with-border" value="<?php if(isset($userdata[0]['paypal'])) echo $userdata[0]['paypal']; ?>" placeholder="Describe the details of your offering">
									</div>
								</div>
								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Delivery Time</h5>
										<select id="user_country" name="user_country" class="form-control" >
										<option value="" selected>Select Delivery Time</option>
                                            	<option>22 days Delivery</option>
                                            	<option>24 days Delivery</option>
                                            	<option>28 days Delivery</option>
                                            	<option>29 days Delivery</option>
                                            	<option>30 days Delivery</option>
                                            </select>
									</div>
								</div>
								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Management Duration (days)</h5>
										<select id="user_country" name="user_country" class="form-control" >
                                            	<option value="" selected>Select</option>
                                            	<option>1</option>
                                            	<option>2</option>
                                            	<option>3</option>
                                            	<option>4</option>
                                            	<option>5</option>
                                        	</select>
									</div>
								</div>
								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Price</h5>
										<select id="user_country" name="user_country" class="form-control" >
                                            	<option value="" selected>Select</option>
                                            	<option>$5</option>
                                            	<option>$10</option>
                                            	<option>$15</option>
                                            	<option>$20</option>
                                            	<option>$25</option>
                                        	</select>
									</div>
								</div>
							<?php } } ?>
							</div>
						</div>
					</div>
				</div>
				<!-- end scope and pricing -->		

				<!-- start Description -->
				<div class="col-xl-12">
					<div id="test1" class="dashboard-box">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-facebook"></i>Description</h3>
						</div>

						<div class="content with-padding">
							<div class="row">

								<?php foreach ($withdraw_meths as $key) { 
								if($key['id'] === '1') {?>
								<div class="col-xl-12">
									<div class="submit-field">
										<h5>Briefly Describe Your Gig</h5>
										<textarea id="user_description" name="user_description" cols="30" rows="5" class="with-border"><?php if(isset($userdata[0]['user_description'])) echo $userdata[0]['user_description']; ?></textarea>
									</div>
								</div>
								<?php } else if ($key['id'] === '2') { ?>
								<?php } } ?>
							</div>
						</div>
					</div>
				</div>
				<!-- end Description -->	
				<!-- start Buyer -->
				<div class="col-xl-12">
					<div id="test1" class="dashboard-box">
						<!-- Headline -->
						<div class="headline">
							<h3>Tell your buyer what you need to get started</h3>
							<p>Structure your Buyer Instructions as free text, a multiple choice question or file upload.</p>
						</div>

						<div class="content with-padding">
							<div class="row">

								<?php foreach ($withdraw_meths as $key) { 
								if($key['id'] === '1') {?>
								<div class="col-xl-12">
									<div class="submit-field">
										<h5>REQUIREMENT #1</h5>
										<textarea id="user_description" name="user_description" cols="30" rows="5" class="with-border"><?php if(isset($userdata[0]['user_description'])) echo $userdata[0]['user_description']; ?></textarea>
									</div>
								</div>
								<?php } else if ($key['id'] === '2') { ?>
								<?php } } ?>
							</div>
						</div>
					</div>
				</div>
				<!-- end Buyer -->	
				<!-- start Gallery -->
				<div class="col-xl-12">
					<div id="test1" class="dashboard-box">
						<!-- Headline -->
						<div class="headline">
							<h3>Build Your Gig Gallery</h3>
							<p>Add memorable content to your gallery to set yourself apart from competitors.</p>
						</div>

						<div class="content with-padding">
							<div class="row">

								<?php foreach ($withdraw_meths as $key) { 
								if($key['id'] === '1') {?>
								<div class="col-xl-12">
									<div class="submit-field">
										<h3>Gig Photos</h3>
										<p>Upload photos that describe or are related to your Gig.</p>
										<div class="upload_img">
										<span class="file-upload">Upload Photos</span>
										<input type="file" name="" class="fileuploads">
										</div>
									</div>
								</div>
								<?php } else if ($key['id'] === '2') { ?>
								<?php } } ?>
							</div>
						</div>
					</div>
				</div>
				<!-- end Gallery -->	

				<!-- Button -->
				<div class="col-xl-12">
					<button type="submit" class="btn btn-success margin-top-30">Save Changes</button>
                   	<div id="validator"></div>
                   	<span id="loader" style="display:none;"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>
				</div>

				<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

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

<?php if(isset($userdata[0]['user_country']) && !empty($userdata[0]['user_country'])) {?>
	<script>populateListOfCountries('user_country','<?php echo $userdata[0]['user_country']; ?>');</script>
<?php }else {?>
	<script>populateListOfCountries('user_country');</script>
<?php } ?>

</body>
</html>