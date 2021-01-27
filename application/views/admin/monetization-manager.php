<!DOCTYPE html>
<html lang="en">
<head>

<!--Admin Page Meta Tags-->
<title>Monetization Manager | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
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
				<i class="mdi mdi-pipe"></i> <h3>Monetization Method Manager</h3>
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
						<li><a href="#">Monetization Method Manager</a></li>
					</ul>
				</nav>
			
	
			<!-- Row -->
			<div class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">

						<!-- Headline -->
						<div class="headline">
							<h3>Monetization Method Manager</h3>
						</div>

						<!----- Content --->
						<div class="card">
                    	<div class="card-body">
                       	<form id="MonetizationMethodSettingsForm" method="post" enctype="multipart/form-data"/>

                       	<div class="col-xl-12">
							<div class="submit-field">
                          		<h4> Monetization Method Name </h4>
                          		<input type="text" class="with-border form-control" maxlength="30" id="name" name = "name" placeholder="Monetization method" required="true">
								<span class="help-block pl-1">max length 30 char</span>   
								  <input type="hidden" class="form-control" id="monetization_id" name = "monetization_id">
                       		</div>
                        </div>

                        <div class="d-flex justify-content-end save_button_resent_a pb-4">
							<a href="<?php echo site_url('admin/monetization_control') ?>" class="btn theme_btn mr-2">Reset</a>
							<button type="submit" id="btn_save" name="btn_categorysave" class="btn theme_btn mr-3">Save</button>
						</div>
                        <div id="categoriesSettingsMsg"></div>
                        <span id="loadingCategories" style="display:none;"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>

                        <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                      </form>
                    </div>
                  	</div>
					<!----- /Content --->

					<!----- PAGES ---------------->
					<div class="row">
                    <div class="col-xs-24 col-sm-24 col-md-24 col-lg-12	 col-xl-12	">           
                    <div class="card mb-12">
                        <div class="card-body">
                            <div class="table-responsive">
                              	<table id="tbl_categoriesData" class="table table-striped table-hover responsive monetization_table_a">
                      			<thead>
                        			<tr>
                          			<th>NAME</th>
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
<script>loadMonetizedMethodData();</script>
<!--------------------------------------------------------------------------------------------------------------->

</body>
</html>