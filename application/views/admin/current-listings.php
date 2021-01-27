   <!DOCTYPE html>
   <html lang="en">

   <head>

   	<!--Admin Page Meta Tags-->
   	<title>Current Listings | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
   	<meta charset="utf-8">
   	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   	<link rel="icon" href="<?php if (isset($imagesData[0]['favicon'])) echo base_url() . ADMIN_IMAGES . $imagesData[0]['favicon']; ?>" alt="favicon" />
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
   				<div class="dashboard-content-inner">

   					<!-- Dashboard Headline -->
   					<div class="dashboard-headline">

   						<div class="dashboad_table">
   							<i class="mdi mdi-image-area-close"></i>
   							<h3>Current Listings</h3>
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
   							<li><a href="#">Current Listings</a></li>
   						</ul>
   					</nav>
   					<!-- Row -->
   					<div class="row">

   						<!-- Dashboard Box -->
   						<div class="col-xl-12">
   							<div class="dashboard-box margin-top-0">

   								<!-- Headline -->
   								<div class="headline">
   									<h3>CURRENT LISTINGS</h3>
   								</div>

   								<!----- PAGES ---------------->
   								<div class="content with-padding padding-bottom-10">
   									<div class="row">
   										<div class="col-xl-12">

   											<div class="col-xl-12 p-0">
   												<div class="submit-field">
   													<h5>Filter Listings</h5>
   													<select class="form-control" id="filter_type" name="filter_type">
   														<option value=""> ALL </option>
   														<option value="0"> PAYMENT PENDINGS </option>
   														<option value="1"> ACTIVE </option>
   														<option value="2"> SUSPENDED </option>
   														<!-- <option value="4"> EXPIRED </option>
   														<option value="5"> UNVERIFIED DOMAIN REMOVALS </option> -->
   														<option value="6"> DELETED BY SELLER </option>
   														<option value="7"> AVAILABLE LISTINGS </option>
   														<option value="8"> SOLD LISTINGS </option>
   														<option value="9"> PENDING APPROVAL STATUS</option>
   													</select>
   												</div>
   											</div>

   											<div class="row">
   												<div class="col-xs-24 col-sm-24 col-md-24 col-lg-12 col-xl-12">
   													<div class="card mb-3">
   														<div class="card-body">
   															<div class="table-responsive">
   																<table id="tbl_ListingsData" class="table table-bordered table-hover display">
   																	<thead>
   																		<tr>
   																			<th>ID</th>
   																			<th>TYPE</th>
   																			<th>NAME</th>
   																			<th>OPTION</th>
   																			<th>STATUS</th>
   																			<th>AVAILABILITY</th>
   																			<th>BLOCK</th>
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


   										</div>
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

   	<!-----------------Common Models -------------------------------------------------------------------------------->
   	<?php $this->load->view('admin/includes/models'); ?>
   	<!--------------------------------------------------------------------------------------------------------------->
   	<?php $this->load->view('main/includes/footerscripts'); ?>
   	<script>
   		loadListingsData('');
   	</script>

   	<script>
   		$(function() {
   			setTimeout(() => {
   				$('.buttons-csv ').addClass('mb-3')
   			}, 3000);
   		});
   	</script>
   	<!--------------------------------------------------------------------------------------------------------------->


   </body>

   </html>