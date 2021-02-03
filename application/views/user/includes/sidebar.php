<style>
	.select2-selection__rendered li input,
	.select2-container {
		width: 100% !important;
	}

	.select2-results__options {
		height: 250px;
		overflow: scroll !important;
	}
</style>
<!-- Dashboard Sidebar -->



<div class="dashboard-sidebar">
	<div class="dashboard-sidebar-inner" data-simplebar>
		<div class="dashboard-nav-container">

			<!-- Responsive Navigation Trigger -->
			<div class="container mobile_dasboard_logo_with_useranem_a">
				<div class="row">
					
				
						<div class="col-md-6 col-sm-6 col-xs-12 logo_mobile_a">
							<div class="w-100">
								<a class="navbar-brand brand-logo-mini text-center" href="<?php echo base_url() ?>">
									<img src="<?php if (isset($imagesData[0]['invoice_logo'])) echo base_url() . ADMIN_IMAGES . $imagesData[0]['invoice_logo']; ?>" alt="logo" width="100%" />
								</a>
							</div>
						</div>
				
					<div class="col-md-6 col-sm-6 col-xs-12 username_a">
						<div class="user_name">
							<span class="margin-top-7">Welcome <a href=""><?php if (isset($userdata[0]['username'])) {
																				echo $userdata[0]['username'];
																			} ?></a> !</span>
						</div>
					</div>

				</div>



			</div>
			<a href="#" class="dashboard-responsive-nav-trigger mobile_dashboard_a">
				<span class="hamburger hamburger--collapse">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</span>
				<span class="trigger-title">Dashboard Navigation</span>
			</a>

			<!-- Navigation -->
			<div class="dashboard-nav mobiledashboard_a">
				<div class="dashboard-nav-inner">

					
						<div class="w-100 desktopdashboard_a">
							<a class="navbar-brand brand-logo-mini text-center" href="<?php echo base_url() ?>">
								<img src="<?php if (isset($imagesData[0]['invoice_logo'])) echo base_url() . ADMIN_IMAGES . $imagesData[0]['invoice_logo']; ?>" alt="logo" width="100%" />
							</a>
						</div>
						<hr>
				
				

					<div class="user_name desktopdashboard_a">
						<span class="margin-top-7">Welcome <a href=""><?php if (isset($userdata[0]['username'])) {
																			echo $userdata[0]['username'];
																		} ?></a> !</span>
					</div>

					<?php if (!empty($this->session->userdata('role'))) { ?> <?php if ($this->session->userdata('role') ==  'admin') { ?>
							<ul>
								<li class="active bg-dark admin-hover"><a href="<?php echo site_url('user/admin-login'); ?>" class="text-white"><i class="active text-white icon-material-outline-alarm-add"></i> Back to admin panel</a></li>

							</ul>
						<?php  } ?>
					<?php  } ?>

					<ul data-submenu-title="Start">
						<li><a href="<?php echo site_url('user/dashboard'); ?>"><i class="icon-material-outline-dashboard"></i> Dashboard</a></li>
						<li><a href="<?php echo site_url('user/become-expert'); ?>"><i class="icon-material-outline-dashboard"></i> Become Expert</a></li>
						<!-- <li><a href="<?php echo site_url('user/contact-expert'); ?>"><i class="icon-material-outline-dashboard"></i> Contact Expert</a></li> -->
						<li <?php if (in_array($this->uri->segment(1), ['chat'])) echo "class='active'" ?>><a href="<?php echo site_url('chat'); ?>"><i class="icon-material-outline-question-answer"></i> Messages <span class="nav-tag"><?php echo $messageCount; ?></span></a></li>
						<li <?php if (in_array($this->uri->segment(1), ['user-membership-list'])) echo "class='active'" ?>><a href="<?php echo site_url('user-membership-list'); ?>"> <i class="fa fa-id-card" aria-hidden="true"></i> Membership Listing</a></li>
					</ul>
					<?php $this->load->view('main/includes/create-lisiting-option-backend');
					/*
						<ul data-submenu-title="Organize and Manage">
							<li  <?php if(in_array($this->uri->segment(2),['create_listings','manage_offers','manage_solutions'])) echo "class='active-submenu'" ?> ><a href="#"><i class="icon-material-outline-business-center"></i> Listings</a>
								<ul>
									<li><a href="<?php echo site_url('user/create_listings'); ?>">Create a Listing</a></li>
									<!-- <?php //if (in_array('auction', array_column($options, 'platform'))) { ?>
										<li><a href="<?php// echo site_url('user/manage_listings'); ?>">Manage Auctions<span class="nav-tag"><?php // echo $listingCount; ?></span></a></li>
									<?php //} ?> -->
									<?php if (in_array('classified', array_column($options, 'platform'))) { ?>
										<li><a href="<?php echo site_url('user/manage_offers'); ?>">Manage Offers<span class="nav-tag"><?php echo $listingOfferCount; ?></span></a></li>
									<?php } ?>
									<?php if (empty($listingSolutionCount)) { $listingSolutionCount = 0 ;}?>
										<li><a href="<?php echo site_url('user/manage_solutions'); ?>">Manage Solutions<span class="nav-tag"><?php echo $listingSolutionCount; ?></span></a></li>
								</ul>
							</li>
							<li   <?php if(in_array($this->uri->segment(2),['pending_offers'])) echo "class='active-submenu'" ?>  ><a href="#"><i class="mdi mdi-gavel"></i> Bids & Offers</a>
								<ul>
									<?php if (in_array('auction', array_column($options, 'platform'))) { ?>
										<li><a href="<?php echo site_url('user/pending_bids'); ?>">My Active Bids</a></li>
									<?php } ?>
									<?php if (in_array('classified', array_column($options, 'platform'))) { ?>
										<li><a href="<?php echo site_url('user/pending_offers'); ?>">My Active Offers</a></li>
									<?php } ?>
								</ul>
							</li>

							<li    <?php if(in_array($this->uri->segment(2),['contract'])) echo "class='active-submenu'" ?> ><a href="#"><i class="icon-material-outline-assignment"></i> Open Contracts <span class="nav-tag"><?php echo count($openContracts); ?></span></a>
								<ul>
									<?php foreach ($openContracts as $contract) { ?>
										<li><a href="<?php echo site_url('user/contract/' . $contract['contract_id']); ?>">Contract - #<?php echo $contract['contract_id']; ?> </a></li>
									<?php } ?>
								</ul>
							</li>

							<li    <?php if(in_array($this->uri->segment(2),['closed_contracts'])) echo "class='active-submenu'" ?> ><a href="#"><i class="mdi mdi-briefcase-check"></i> Closed Contracts <span class="nav-tag"><?php echo count($closeContracts); ?></span></a>
								<ul>
									<?php foreach ($closeContracts as $contract) { ?>
										<li><a href="<?php echo site_url('user/closed_contracts/' . $contract['contract_id']); ?>">Contract - #<?php echo $contract['contract_id']; ?> </a></li>
									<?php } ?>
								</ul>
							</li>

							<li    <?php if(in_array($this->uri->segment(2),['invoices'])) echo "class='active'" ?> ><a href="<?php echo site_url('user/invoices'); ?>"><i class="mdi mdi-fax"></i> Invoices </a></li>
						</ul>
						*/ ?>
					<ul data-submenu-title="Account">
						<li <?php if (in_array($this->uri->segment(2), ['withdrawals'])) echo "class='active'" ?>><a href="<?php echo site_url('user/withdrawals'); ?>"><i class="mdi mdi-currency-usd"></i> Withdrawals</a></li>
						<li <?php if (in_array($this->uri->segment(2), ['user_settings'])) echo "class='active'" ?>><a href="<?php echo site_url('user/user_settings'); ?>"><i class="icon-material-outline-settings"></i> Settings</a></li>
						<li <?php if (in_array($this->uri->segment(2), ['change_password'])) echo "class='active'" ?>><a href="<?php echo site_url('user/change_password'); ?>"><i class="icon-material-outline-lock"></i> Change Password</a></li>
						<li><a href="<?php echo site_url('user/logout'); ?>"><i class="icon-material-outline-power-settings-new"></i> Logout</a></li>
					</ul>

				</div>
			</div>
			<!-- Navigation / End -->

		</div>
	</div>
</div>
<!-- Dashboard Sidebar / End -->