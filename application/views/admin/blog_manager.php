<!DOCTYPE html>
<html lang="en">
<head>

<!--Admin Page Meta Tags-->
<title>Blog Manager | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="icon" href="<?php if(isset($imagesData[0]['favicon'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['favicon']; ?>" alt="favicon" />
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
		<div class="dashboard-content-inner" >
			
			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				
				 			<div class="dashboad_table">
                            <i class="mdi mdi-blogger"></i><h3>Create Blog Post</h3>
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
						<li><a href="#">Create Blog Post</a></li>
					</ul>
				</nav>
			
	
			<!-- Row -->
			<div class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">

						<!-- Headline -->
						<div class="headline">
							<h3>Blog Manager</h3>
						</div>

						<!----- Content --->
						<form id="blogSettingsForm" method="post" enctype="multipart/form-data"/>
						<div class="content with-padding padding-bottom-10">
						<div class="row">

							<div class="col-xl-12">
								
								<div class="submit-field">
									<h5>Blog Post Title</h5>
									<input type="text" id="txt_blogpost_title" name="txt_blogpost_title" class="required form-control" placeholder="Blog Post Title" required>
									<input type="hidden" id="txt_blogpost_id" name = "txt_blogpost_id">
								</div>
							</div>
							<div class="col-xl-12 div_floats">
							<div class="col-xl-6">
								<div class="submit-field">
									<h5>Blog Post Meta Description</h5>
									<textarea rows = "8" class="form-control" cols = "60" name = "txt_blogpost_meta_description" id="txt_blogpost_meta_description" maxlength="150" required="true"></textarea>
								</div>
							</div>

							<div class="col-xl-6">
								<div class="submit-field">
									<h5>Blog Post Meta Keywords <code>(Seperate by a ",")</code></h5>
									<textarea rows = "6" class="form-control" cols = "60" name = "txt_blogpost_meta_keywords" id="txt_blogpost_meta_keywords" maxlength="150" required="true"></textarea>
								</div>
							</div>
						</div>

							<div class="col-xl-12">
								<div class="submit-field">
									<h5>Blog Post Slug</h5>
									<input type="text" class="form-control" id="txt_blogpost_url_slug" name = "txt_blogpost_url_slug" placeholder="URL Slug" readonly="true" required="true">
								</div>
							</div>

							<div class="col-xl-12 blog_post">
								<div class="submit-field">
									<h5>Blog Post</h5>
									<textarea rows = "50" class="form-control" cols ="100" name ="txt_blogpost_description" id="txt_blogpost_description" maxlength="5000" required="true"></textarea>
								</div>
							</div>


							<div class="col-xl-12">
								<div class="submit-field">
									<h5>Blog Post Image</h5>
                            		<div class="uploadButton margin-top-30">
										<input class="uploadButton-input-cover" type="file" accept="image/*" id="uploadListingImage" name="uploadListingImage"/>
										<label class="uploadButton-button ripple-effect" for="uploadListingImage">Upload Thumbnail Image</label>
										<span class="uploadButton-file-name-cover"><b>Thumbnail image for blog post An eye-catching image goes a long way.Upload a photograph of your site, product, or service (min 550px x 300px)</b></span>
									</div>
								</div>
							</div>

							<div class="col-xl-12">
								<div class="submit-field">
									<h5>Blog Tags <code>(Seperate by a ",")</code></h5>
									<textarea rows = "6" class="form-control" cols = "60" name = "txt_blogpost_tags" id="txt_blogpost_tags" maxlength="150" required="true"></textarea>
								</div>
							</div>

							<div class="col-xl-12">
								<div class="submit-field">
									<h5>Blog Post Status</h5>
									<select class="form-control form-control-lg" id="blogpostvisibility_status" name="blogpostvisibility_status">
                            			<option value="1"> Active </option>
                            			<option value="2"> Disabled </option>
                          			</select>
								</div>
							</div>

							<div class="col-xl-12">
								<button type="submit" name="btn_blogsave" class="btn btn-success mr-2 save_page btntheme_color_a ">Save</button>
                        		<div id="notification"></div>
                        		<span id="loader" style="display:none;"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>
                        	</div>

                        	<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

						</div>
						</div>
						</form>
						<!----- /Content --->
						
						<!----- BLOG ---------------->
						<div class="col-xl-12" style="margin-bottom: 10px">
							<a href="<?php echo base_url().'admin/view_comments/'?>" class="btn btn-success mr-2 btntheme_color_a save_page">View Pending Comments </a>							
						</div>
        				<div class="row blog_page_withpagination_a">
                    	<div class="col-xs-24 col-sm-24 col-md-24 col-lg-12 col-xl-12"> 
						        
                        <div class="card mb-3">						
                          <div class="card-body">
                            <div class="table-responsive">
                              <table id="tbl_blogData" class="table table-bordered table-hover display">
                      			<thead>
                        		<tr>
                          			<th>ID</th>
                          			<th>TITLE</th>
                          			<th>DESCRIPTION</th>
                          			<th>LINK</th>
                          			<th>STATUS</th>
                          			<th>EDIT</th>
                          			<th>DELETE</th>
									<th>View Comments</th>
                        		</tr>
                      		</thead>
                    		</table>
                            </div>
                          </div>              
                        </div><!-- end card-->          
                    	</div>
                  		</div>	
        				<!----- /BLOG ---------------->
        				
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
    $(document).ready(function() {
        $('#txt_blogpost_description').summernote({
            height: 300,
            dialogsInBody: true

        });
    });
</script>
<script>loadBlogData();</script>
<!--------------------------------------------------------------------------------------------------------------->

</body>
</html>