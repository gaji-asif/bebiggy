<!DOCTYPE html>
<html lang="en">
<head>

<!--Admin Page Meta Tags-->
<title>Disputes Manager | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="icon" href="<?php if(isset($imagesData[0]['favicon'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['favicon']; ?>" alt="favicon" />
<meta name="robots" content="noindex">
<!--/Admin Page Meta Tags-->

<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/includes/headerscripts'); ?>
<!--------------------------------------------------------------------------------------------------------------->

</head>

<body class="gray" onload="bootChat();load_thread();">

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
				<h3>Open Transaction With <b>Buyer :</b><a href=""> <?php if(isset($buyer[0]['firstname'])) echo $buyer[0]['firstname'] ?> <?php if(isset($buyer[0]['lastname'])) echo $buyer[0]['lastname']; ?></a> & <b>Seller :</b> <a href="<?php echo current_url(); ?>"><?php if(isset($seller[0]['firstname'])) echo $seller[0]['firstname'] ?> <?php if(isset($seller[0]['lastname'])) echo $seller[0]['lastname']; ?></a></h3>
			

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Dashboard</a></li>
						<li>Open Disputes</li>
					</ul>
				</nav>
			</div>
			<!-- Dashboard Headline -->
		
			<div id="contract_history" class="row" style="padding-top:50px">

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">

						<!-- Headline -->
						<div class="headline">
							<h3>Pending Transaction</h3>
						</div>
						<div id="negotiations_table" class="bs-example container" data-example-id="striped-table">
  							<table class="table table-striped table-bordered table-hover">
    							<thead>
      							<tr>
        							<th>#</th>
        							<th>Transaction Id</th>
        							<th>Date</th>
      							</tr>
    							</thead>
    							<tbody>
								<?php $i=1; foreach ($disputes as $dispute) { ?>
      								<tr>
        								<th scope="row"><?php echo $i; ?></th>
        								<td><a href="<?php echo site_url('admin/manage_disputes/' . $dispute['contract_id']); ?>">Transaction - #<?php echo $dispute['contract_id']; ?> </a></td>
        								<td><?php if(!empty($dispute['date'])) echo date('Y-m-d',strtotime($dispute['date'])); ?></td>
      								</tr>
      								<?php $i++; } ?>
    							</tbody>
  							</table>
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


<!-----------------Common Models -------------------------------------------------------------------------------->
<?php $this->load->view('user/includes/models'); ?>
<!--------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/includes/footerscripts'); ?>

<!--------------------------------------------------------------------------------------------------------------->

</body>
</html>