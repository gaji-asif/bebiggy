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
                            <i class="mdi mdi-blogger"></i><h3>Comments</h3>
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
						<li><a href="#">Comments</a></li>
					</ul>
				</nav>

				<?php if(!empty($this->session->flashdata('success'))):?>
					<div class="alert alert-success" style="opacity: 500; "><a class="close" data-dismiss="alert">×</a><span><?php echo $this->session->flashdata('success'); ?></span></div>
				<?php endif; ?>
				

			<!-- Row -->
			<div class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">

						<!-- Headline -->
						<div class="headline">
							<h3>Comment Manager</h3>
						</div>
						<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

						<!----- BLOG ---------------->
        				<div class="row blog_page_withpagination_a">
                    	<div class="col-xs-24 col-sm-24 col-md-24 col-lg-12 col-xl-12">           
                        <div class="card mb-3">
                          <div class="card-body">
                            <div class="table-responsive">
                              <table id="tbl_CommentData" class="table table-bordered table-hover display">
                      			<thead>
                        		<tr>
                          			
                          			<th>USER NAME</th>
									<th>BLOG TITLE</th>
                          			<th>COMMENT</th>
                          			<th>STATUS</th>
                          			<th>DELETE</th>									
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
<!-- <script>
    $(document).ready(function() {
        $('#txt_blogpost_description').summernote({
            height: 300,
            dialogsInBody: true

        });
    });
</script> -->
<script>loadCommentData();</script>
<!--------------------------------------------------------------------------------------------------------------->

</body>
</html>