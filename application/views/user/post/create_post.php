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
		<div class="dashboard-content-inner createpage_page">
			
			<!-- Dashboard Headline -->
			<div class="dashboard-headline create_post_page_headline">
				<h3>Create New Post</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Dashboard</a></li>
						<li>User Profile</li>
					</ul>
				</nav>
			</div>
	
			<!-- Row -->
			<div class="row">

				<form id="UserDetailsChangeForm_create_post" method="post" enctype="multipart/form-data"/>
				<!-- Dashboard Box -->
				<!-- overview start -->
					<div class="col-md-12">
						<div class="post_box">
							 <ul class="nav nav-tabs user_new_post">
							    <li><a data-toggle="tab" href="#home" class="active"><i class="fa fa-pencil" aria-hidden="true"></i> Title</a></li>
							    <li><a data-toggle="tab" href="#menu1"><i class="fa fa-th-list" aria-hidden="true"></i> Category</a></li>
							    <li><a data-toggle="tab" href="#menu2"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Price</a></li>
							  </ul>

							  <div class="tab-content">
							    <div id="home" class="tab-pane in active">
							    	<div class="title_text">
							    		 <center> <p>Let's start with the basic information.</p></center>
							    	</div>
							    	
							     <div class="col-md-12 create_post">
							     	<div class="col-md-12">
							     		<form action="">
										  <div class="form-group">
										  	<!-- <label for="email" class="post_title">Enter Title (required)</label> -->
										  	<input type="email" class="form-control" id="title_post" placeholder="Enter Title *" required>
										  </div>
										  <div class="form-group">
										  	<!-- <label for="email" class="post-desc">Description (required)</label> -->
										  	<textarea id="post_description" name="user_description" cols="30" rows="5" class="with-border" placeholder="Description *" required></textarea>
										  </div>
										  <div class="form-group">
											  <center>
									     		<input type="file" id="wizard-picture" multiple>
									     		<div class="attach_file">
									     			<i class="fa fa-paperclip" aria-hidden="true"></i> <h6 class="image_description">Attach files</h6>
									     		</div>
								     			</center>
							     			</div>
							     			</div>
							     			<div class="col-md-12 files-uploads">
							     				<div class="col-md-6 col-sm-12 images_task">
								     			 	<div class="image_task">
								     			 		<img src="<?php echo base_url('assets/img/first.jpg'); ?>" class="taskimg_attached">	
											     		<i class="fa fa-times" aria-hidden="true"></i>
									     			</div>
									     			<div class="image_task">
								     			 		<img src="<?php echo base_url('assets/img/first.jpg'); ?>" class="taskimg_attached">	
											     		<i class="fa fa-times" aria-hidden="true"></i>
									     			</div>
									     			<div class="image_task">
								     			 		<img src="<?php echo base_url('assets/img/first.jpg'); ?>" class="taskimg_attached">	
											     		<i class="fa fa-times" aria-hidden="true"></i>
									     			</div>
								     			</div>
								     			<div class="col-md-6 col-sm-12">
								     			 	<div class="form-group browers_pictures">
													  <center>
											     		<input type="file" id="browes-pictures" multiple>
											     		<div class="attach_files">
											     			<h6 class="browes_pictures">Drop files have or <span class="browse_file"> Browse </span><br>
											     			or add attachments</h6>
											     		</div>
										     			</center>
									     			</div>
								     			</div>
							     			
										  <button type="submit" class="btn btn-primary submit_post">Submit</button>
										</form>

							     	</div>
							     	
							     </div>
							      
							    </div>
							    <div id="menu1" class="tab-pane">
							      <div class="submit-field category_post">
							      	<form>
							      		<div class="col-md-12">
							     			<h5>CATEGORY *</h5>
												<select name="" class="form-control category_select">
		                                            	<option selected>Please Select</option>
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
							      		<div class="col-md-12">
									<div class="submit-field">
										<h5>SUB CATEGORY *</h5>
										<select name="user_country" class="form-control sub_cate_post">
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
									<div class="col-md-12">
									<div class="submit-field">
										<h5>SERVICE TYPE *</h5>
											<select name="user_country" class="form-control service_post">
                                            	<option value="" selected>Select A Service Type</option>
                                            	<option>Backgrounds &amp; Environments</option>
                                            	<option>Character Design</option>
                                            	<option>Props &amp; Objects</option>
                                            	<option>UI &amp; UX</option>
                                        	</select>
											</div>
										</div>
										 <button type="submit" class="btn btn-primary submit_post">Submit</button>
							      	</form>
										
									</div>
							      
							    </div>
							    <div id="menu2" class="tab-pane">
							     	<div class="col-md-12 paymant_price">
							     		<div class="col-md-6 col-sm-12">
							     			<div class="form-group">
										  	<label for="email" class="post_title">Enter Price (required)</label>
										  	<input type="email" class="form-control" id="price_title" placeholder="Price" required>
										  </div>
							     		</div>
							     		<div class="col-md-6 col-sm-12">
							     			<div class="submit-field">
												<h5>Delivery Time *</h5>
												<select name="user_country" class="form-control" >
												<option value="" selected>Select Delivery Time</option>
		                                            	<option>22 days Delivery</option>
		                                            	<option>24 days Delivery</option>
		                                            	<option>28 days Delivery</option>
		                                            	<option>29 days Delivery</option>
		                                            	<option>30 days Delivery</option>
		                                            </select>
											</div>
							     		</div>
							     		
							     		 <button type="submit" class="btn btn-primary submit_post">Submit</button>
							     	</div>
							      
							    </div>
							  </div>
  
						</div>
					</div>
				<!-- Button -->
				

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