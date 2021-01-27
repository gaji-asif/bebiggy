<!DOCTYPE html>
<html lang="<?php if(!empty($language)) echo $language; else echo 'en'; ?>">
<head>

<!--User Page Meta Tags-->
<title>View Offers | <?php echo $this->lang->line('site_name') ?>| User Dashboard</title>
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
				 <i class="mdi mdi-gavel"></i> <h3><b>View Offers </b></h3>
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
						<li>Pending Offers</li>
					</ul>
				</nav>
			
	
			<!-- Row -->
			<div class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="fa fa-users"></i> Negotiation Between you and <a href=""><?php if(isset($Offers[0]['username'])) echo $Offers[0]['username']; ?></a></h3>
						</div>
						<div id="negotiations_table" class="bs-example container" data-example-id="striped-table">
							<div class="table-responsive view_offer_section_a">
	  							<table class="table table-striped table-bordered table-hover">
	    							<thead>
	      							<tr>
	        							<th>#</th>
	        							<th>Offer</th>
	        							<th>Time</th>
	        							<th>Status</th>
	        							<th>Ending</th>
	        							<th>Action</th>
	      							</tr>
	    							</thead>
	    							<tbody>

	    								<?php $i=1; foreach ($Offers as $Offer) { ?>
	      								<tr>
	        								<th scope="row"><?php echo $i; ?></th>
	        								<td><?php if(isset($Offer['offer_amount'])) echo $Offer['offer_amount']; ?></td>
	        								<td><?php if(isset($Offer['ago'])) echo $Offer['ago']; ?></td>
	        								<td><?php if($Offer['offer_status'] === '0') echo 'pending'; else if($Offer['offer_status'] === '1')
	        								echo 'Rejected'; else if($Offer['offer_status'] === '2')
	        								echo 'Approved'; else if($Offer['offer_status'] === '3')
	        								echo 'Canceled'; ?></td>
	        								<td><?php if(isset($Offer['expire'])) echo $Offer['expire']; ?></td>
	        								<td class="centerButtons">
	        								<?php if($Offer['offer_status'] === '0') { ?>
	        									<button type="button" class="btn btn-outline-dark btn-sm cancel_offer" data-offerid="<?php echo $Offer["offer_id"];?>">cancel</button> 
	        									<?php } ?>
	      									</td>
	      								</tr>
	      								<?php $i++; } ?>
	    							</tbody>
	  							</table>
  							</div>
						</div>
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
<!--------------------------------------------------------------------------------------------------------------->

</body>
</html>