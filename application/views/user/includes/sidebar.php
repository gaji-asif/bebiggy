<style>
	.select2-selection__rendered li input,
	.select2-container {
		width: 100% !important;
	}

	.select2-results__options {
		height: 250px;
		overflow: scroll !important;

	}

	.sticky {
		position: fixed;
		top: 0;
		
		z-index: 99999;
	}

	.width_for_sticky{
		width: 72%;
	}

	/*.sticky+.content {
		padding-top: 60px;
		}*/

		.users_header_asif{
			/*padding: 10px;*/
			border:2px solid #ffc24d;
		}

		.padding_left_asif{
			margin-left: 9%;
		}

		.padding_top_asif{
			margin-top: 3px;
		}

		@media screen and (max-width: 700px)
		{
			.sticky{
				width: 94%;
			}

		}


	/*	@media screen and (min-device-width: 510px) and (max-device-width: 1500px) { 
	  		.sticky{
				width: 94%;
			}
		}*/





	/*@media screen and (max-width: 500px)
	{
	    li.common_user_header{
			display: block !important;
		}
	    
	}

	

	@media screen and (min-device-width: 510px) and (max-device-width: 1500px) { 
	   li.common_user_header{
			display: none;
		}
		}*/


	</style>
	<!-- Dashboard Sidebar -->



	<div class="dashboard-sidebar">
		<div class="dashboard-sidebar-inner" data-simplebar>
			<div class="dashboard-nav-container" id="dashboard-nav-container">

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
				<a href="#" onclick="show_user_headre();" class="dashboard-responsive-nav-trigger mobile_dashboard_a">
					<span class="hamburger hamburger--collapse">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</span>
					<span class="trigger-title mobile_dashboard_a">Dashboard Navigation</span>
				</a>

				<script type="text/javascript">

					function show_user_headre(){
						$('.common_user_header').show();
					}

		  // $(".mobile_dashboard_a").click(function(){
		  //   alert("asif");
		  // });

		</script>

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

						<ul style="display: none;" class="common_user_header">
							
							
							<li class=""><a href="#"><i class="mdi mdi-gavel"></i> Website For Sale</a>
								<ul>
									<li><a href="http://52.13.172.193/product-category/shopify-dropship-websites-for-sale">Shopify Dropship Websites For Sale</a></li>
									<li><a href="http://52.13.172.193/product-category/shopify-premium-dropship-websites-for-sale">Shopify Premium Dropship Websites For Sale</a></li>
									
									<li><a href="http://52.13.172.193/product-category/exclusive-shopify-dropship-stores-for-sale">Exclusive Shopify Dropship Stores For Sale</a></li>
								</ul>
							</li>

							<li class=""><a href="#"><i class="mdi mdi-gavel"></i> Dropshipping</a>
								<ul>
									<li><a href="http://52.13.172.193/dropshipping-products">Winning Products</a></li>
									<li><a href="http://52.13.172.193/dropshipping-websites">Dropshipping Websites</a></li>
									
									<li><a href="http://52.13.172.193/shopify-stores-for-sale">Shopify Stores</a></li>
								</ul>
							</li>

							<li class=""><a href="#"><i class="mdi mdi-gavel"></i> Learn</a>
								<ul>
									<li><a href="http://52.13.172.193/standard-courses">Standard Courses</a></li>
									<li><a href="http://52.13.172.193/special-courses">Special Courses</a></li>
									
									
								</ul>
							</li>

							<li class=""><a href="#"><i class="mdi mdi-gavel"></i> FAQ</a>
								

								<ul>
									<li><a class="" href="http://52.13.172.193/faq-3/how-to-make-money-drop-shipping">How To Make Money Drop Shipping</a></li>

									<li class="">
										<a class="" href="http://52.13.172.193/faq-3/how-to-start-an-online-shop">How To Start An Online Shop</a>
									</li>
									<li class="">
										<a class="" href="http://52.13.172.193/faq-3/how-to-start-drop-shipping">How To Start Drop Shipping</a>
									</li>
									<li class="">
										<a class="" href="http://52.13.172.193/faq-3/what-is-drop-shipping">What Is Drop Shipping</a>
									</li>

								</ul>

							</li>


							<li><a href="#"><i class="mdi mdi-gavel"></i> Marketplace</a>
								<ul>
									<li class="">

			<a class="" href="http://52.13.172.193/domains">Domain</a>
		</li>
		<li class="">
			<a class="" href="http://52.13.172.193/websites">Website</a>
		</li>
		<li class="">
			<a class="" href="http://52.13.172.193/businesses">Business</a>
		</li>
		<li class="">
			<a class="" href="http://52.13.172.193/apps">App</a>
		</li>
		<li class="">
			<a class="" href="http://52.13.172.193/solution">Solution</a>
		</li>
								</ul>
							</li>

							<li><a href="#"><i class="mdi mdi-gavel"></i> About</a>
								<ul>
									<li class="">
			<a class="" href="http://52.13.172.193/get-started">How To Get Started?</a>
		</li>
								</ul>
							</li>

							<li><a href="http://52.13.172.193/blog"><i class="mdi mdi-gavel"></i> Blog</a>
							</li>





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
		<div class="dashboard-content-container" data-simplebar>
			<div class="dashboard-content-inner">

				<!-- Dashboard Sidebar / End -->

				<!-- 	// started BY asif -->

				<div class="users_header_asif" id="users_header_asif">

					<link href="<?php echo base_url(); ?>assets/css_asif/css/custom_style.css?v=<?php echo time(); ?>" rel="stylesheet" />
					<link href="<?php echo base_url(); ?>assets/css_asif/designer_css/custom_style.css" rel="stylesheet" />
					<link href="<?php echo base_url(); ?>assets/css_asif/css/custom_responsive_style.css?v=<?php echo time(); ?>" rel="stylesheet" />
					<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/iconfonts/font-awesome/css/font-awesome.min.css" />






					<header>
						<div class="desktop_menu">
							<div class="header_custom py-1">
								<div class="container p-0">
									<div class="col-sm-12 p-0 padding_left_asif">
										<nav class="navbar navbar-expand-sm">
						<!-- <div class="col-sm-2 p-0">
							<a class="navbar-brand" href="<?php echo site_url(); ?>">
								
								<img src="<?php echo site_url('assets/img/admin/Logo_-small.png'); ?>" alt="logo">
							</a>
						</div> -->
						<?php
						$select = "";
						$opt = "";
						if (isset($_GET['search'])) {
							$opt = $this->uri->segment(1);
							$search = strtolower($_GET['search']);
						} ?>
						<div class="col-sm-4 p-0">
							<form class="form-inline my-2 my-lg-0 header_search_box" action="<?php echo site_url('q') ?>" method="get">
								<input class="form-control border border-0 header_search_text" type="text" placeholder="Search For" name="p" value="<?php echo $search ?? ""  ?>">
								<span class="bar"></span>
								<div class="form-group header_top_dropdown mr-sm-2">
									<select class="form-control header_shopy_stores" name="opt">
										<option selected value="all-marketplaces" >All Marketplace</option>
										<?php foreach (SEARCH_OPTION as $key => $val) :  $select = "" ;?>
											<?php if ($key == $opt) $select = 'selected'; ?>
											<?php echo "<option value='$key' $select >";
											echo ucwords(strtolower($val));
											echo "</option>"; ?>
											<?php $select = "";
										endforeach; ?>

									</select>
									<!-- <img src="<?php //echo site_url(); ?>assets/img/drop_down.png" class="mobile_drop_a"> -->
								</div>
								<button class="btn btn-success my-2 my-sm-0 header_search_btn" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
							</form>
						</div>
						<div class="col-sm-6 p-0 menu_withbtn justify-content-between">
							

							<nav class="navbar navbar-default navbar-static-top p-0" role="navigation">
								<div class="navbar-collapse">
									<ul class="nav navbar-nav top_ulli_a">
										<?php if (defined('MAIN_HEAD_MENU') != null && !empty(defined('MAIN_HEAD_MENU'))) :  ?>
										<?php foreach (MAIN_HEAD_MENU as $key => $val) : ?>
											<?php if ($val != null && !empty($val) && is_array($val)) :  ?>

											<li class="topfirstlevel_a dropdown">
												<?php if (strtolower($key) != 'about us'): ?>
													<a  class="dropdown-toggle" data-toggle="dropdown"><?php echo ucwords(strtolower($key)); ?>
													<i class="fa fa-angle-down" aria-hidden="true"></i></a>
													<?php  else: ?>
														<a  href="<?php echo site_url($val['about-us']) ?? '#' ?>" class=" cursor_pointer_a" data-toggle=""><?php echo ucwords(strtolower($key)); ?>
														<i class="fa fa-angle-down" aria-hidden="true"></i></a>
													<?php endif; ?>


													<ul class="dropdown-menu">
														<?php

														foreach ($val as $subKey => $subVal) : ?>
															<?php  if($subKey  != 'about-us') :?>
																<li class="topfirstlevelli_a ">
																	<a class="dropdown-item" href="<?php echo site_url($subKey) ?? '#' ?>"><?php echo ucwords(strtolower($subVal)); ?></a>
																</li>
															<?php endif; ?>
														<?php endforeach; ?>

													</ul>
												</li>
												<?php else : ?>
													<li class="nav-item dropdown">
														<a class="" href="<?php echo site_url($key); ?>">
															<?php echo ucwords($val); ?>
														</a>
													</li>
												<?php endif; ?>
											<?php endforeach; ?>
										<?php endif; ?>
									</ul>
								</div><!-- /.navbar-collapse -->
							</nav>
							<?php if (!empty($this->session->userdata('user_id')) && $this->session->userdata('user_level') != '0') : ?>
							<a href="<?php echo base_url(); ?>user/logout" class="btn btn-default header_signin">Sign Out</a>
							<?php elseif ($this->session->userdata('user_level') == '0') : ?>
								<a href="<?php echo base_url(); ?>admin/logout" class="btn btn-default header_signin">Sign Out</a>
								<?php else : ?>
									<a href="<?php echo site_url('login'); ?>" class="btn btn-default header_signin">Sign in</a>
								<?php endif; ?>
								<a href="<?php echo site_url('expert-directory'); ?>" class="btn btn-default header_signin">Expert Directory</a>
								
							</div>
						</nav>
					</div>
				</div>
			</div>

			<div class="container-fluid menu_custom_sale">
				<div class="container p-0">
					<div class="row py-0">
						<div class="col-sm-12 col-md-10 p-0">
							<nav class="navbar navbar-expand-sm justify-content-between menu_desktop_a d-none padding_left_asif">
								<ul class="nav navbar-nav first_ul_a">
									<?php if (defined('MAIN_MENU') != null && !empty(defined('MAIN_MENU'))) :  ?>
									<?php foreach (MAIN_MENU as $key => $val) : ?>
										<?php if ($val != null && !empty($val) && is_array($val)) :  ?>
										<li class="nav-item dropdown pl-3 submenu_li">
											<a class="nav-link dropdown-toggle"  id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<?php if ($key == 'faq') echo strtoupper(strtolower($key));
												else echo ucwords(strtolower($key)); ?>
											</a>


											<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
												<?php foreach ($val as $subKey => $subVal) : ?>
													<li>
														
													</li>
													<div class="dropdown-divider"></div>
												<?php endforeach; ?>
											</ul>
										</li>
										<?php else : ?>
											<li class="nav-item dropdown pl-3">
												<a class="nav-link" href="<?php echo site_url($key); ?>">
													<?php echo ucwords($val); ?>
												</a>
											</li>
										<?php endif; ?>
									<?php endforeach; ?>
								<?php endif; ?>



							</ul>
							
							<?php if (empty($this->session->userdata('user_id'))) : ?>
								<a href="<?php echo site_url('signup'); ?>" class="register_free">Register Free <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
							<?php endif; ?>
						</nav>
						<nav class="navbar navbar-default navbar-static-top p-0 padding_left_asif" role="navigation">
							<div class="navbar-collapse">
								<ul class="nav navbar-nav firstulli_a">

									<!-- <li class="firstulli_li_a active"><a >Active Link</a></li>
										<li class="firstulli_li_a"><a >Link</a></li> -->


										<?php foreach (MAIN_MENU as $key => $val) : ?>
											<?php if ($val != null && !empty($val) && is_array($val)) :  ?>

											<li class="firstulli_li_a dropdown"><a href="<?php echo site_url(@array_search($key, $val)) ?? '#' ?>"><?php if ($key == 'faq') echo strtoupper(strtolower($key));else echo ucwords(strtolower($key)); ?><i class="fa fa-angle-down" aria-hidden="true"></i></a>
												<?php array_shift($val); ?>
												<ul class="dropdown-menu">
													<?php foreach ($val as $subKey => $subVal) :   ?>
														<?php if ($subVal != null && !empty($subVal) && is_array($subVal)) :  ?>
														<li class="dropdown dropdown-submenu second_levelli_a">
															<a href="<?php echo site_url(@array_search($subKey, $subVal)) ?? '#' ?>"><?php echo ucwords(strtolower($subKey)); ?><i class="fa fa-angle-down" aria-hidden="true"></i></a>
															<ul class="dropdown-menu">
																<?php
																if (is_array($subVal)) :
																	array_shift($subVal);
																	foreach ($subVal as $sub_sub_key => $sub_sub_val) : ?>
																		<li class="">
																			<a class="" href="<?php echo site_url($sub_sub_key) ?? '#' ?>"><?php echo ucwords(strtolower($sub_sub_val)); ?></a>
																		</li>
																	<?php endforeach;
																endif; ?>
															</ul>
														</li>
														<?php else : ?>
															<li class="">
																<a class="" href="<?php echo site_url($subKey) ?? '#' ?>">
																	<?php if ($subVal == 'faq') echo strtoupper(strtolower($key));
																	else echo ucwords(strtolower($subVal)); ?></a>
																</li>
															<?php endif; ?>
														<?php endforeach; ?>

													</ul>
												</li>

												<?php else : ?>
													<li class="firstulli_li_a active">
														<a href="<?php echo site_url($key); ?>"><?php echo ucwords($val); ?> </a>
													</li>

												<?php endif; ?>
											<?php endforeach; ?>
											<?php if (!empty($this->session->userdata('user_id'))) : ?>

												<?php foreach (CUSTOME_MAIN_MENU as $key => $val) : ?>
													<?php if ($val != null && !empty($val) && is_array($val)) :  ?>

													<li class="firstulli_li_a dropdown"><a href="<?php echo site_url(@array_search($key, $val)) ?? '#' ?>"><?php if ($key == 'faq') echo strtoupper(strtolower($key));else echo ucwords(strtolower($key)); ?><i class="fa fa-angle-down" aria-hidden="true"></i></a>
														<?php array_shift($val); ?>
														<ul class="dropdown-menu">
															<?php foreach ($val as $subKey => $subVal) :   ?>
																<?php if ($subVal != null && !empty($subVal) && is_array($subVal)) :  ?>
																<li class="dropdown dropdown-submenu second_levelli_a">
																	<a href="<?php echo site_url(@array_search($subKey, $subVal)) ?? '#' ?>"><?php echo ucwords(strtolower($subKey)); ?><i class="fa fa-angle-down" aria-hidden="true"></i></a>
																	<ul class="dropdown-menu">
																		<?php
																		if (is_array($subVal)) :
																			array_shift($subVal);
																			foreach ($subVal as $sub_sub_key => $sub_sub_val) : ?>
																				<li class="">
																					<a class="" href="<?php echo site_url($sub_sub_key) ?? '#' ?>"><?php echo ucwords(strtolower($sub_sub_val)); ?></a>
																				</li>
																			<?php endforeach;
																		endif; ?>
																	</ul>
																</li>
																<?php else : ?>
																	<li class="">
																		<a class="" href="<?php echo site_url($subKey) ?? '#' ?>">
																			<?php if ($subVal == 'faq') echo strtoupper(strtolower($key));
																			else echo ucwords(strtolower($subVal)); ?></a>
																		</li>
																	<?php endif; ?>
																<?php endforeach; ?>

															</ul>
														</li>

														<?php else : ?>
															<!-- <li class="firstulli_li_a active d-flex justify-content-end align-items-right pr-0">
															<a class="free_register_a" style="color: #3abffd; margin-right: 5px;" href="<?php echo site_url($key); ?>"><?php echo ucwords($val); ?></a>
														</li> -->

													<?php endif; ?>
												<?php endforeach; ?>
											<?php endif; ?>
										</ul>
										<!---=============== -->

									</div><!-- /.navbar-collapse -->
								</nav>

							</div>
							<div class="col-md-2 col-sm-12 d-flex justify-content-end align-items-center pr-0">
								<?php if (empty($this->session->userdata('user_id'))) { ?>
									<a href="<?php echo site_url('signup'); ?>" class="free_register_a">Register Free <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="mobile_menu" style="display: none;">
				<div class="row tablet_menu">
					<div class="container">
						<div class="col-md-12">
							<div class="menu_with_logo_tablet d-flex justify-content-between">
									<!-- <a class="navbar-brand" href="<?php echo site_url(); ?>">
										
										<img src="<?php echo site_url('assets/img/admin/Logo_-small.png'); ?>" alt="logo">
									</a> -->

									<div class="menu_icon_tablet tablet_menu_icon" onclick="myFunction(this)">

										<div class="bar1"></div>
										<div class="bar2"></div>
										<div class="bar3"></div>
									</div>
								</div>
							</div>
							<div class="col-md-12 table_menu navbar-collapse">

								<ul class="nav navbar-nav">

									<?php foreach (MAIN_MENU as $key => $val) : ?>
										<?php if ($val != null && !empty($val) && is_array($val)) :  ?>

										<li class="firstulli_li_a dropdown">
											<div class="menu_li_a">
												<a href="<?php echo site_url(@array_search($key, $val)) ?? '#' ?>"><?php if ($key == 'faq') echo strtoupper(strtolower($key));else echo ucwords(strtolower($key)); ?> </a>
												<i class="fa fa-angle-down" aria-hidden="true"></i>
											</div>	

											<?php array_shift($val); ?>
											<ul class="dropdown-menu">
												<?php foreach ($val as $subKey => $subVal) :   ?>
													<?php if ($subVal != null && !empty($subVal) && is_array($subVal)) :  ?>
													<li class="dropdown dropdown-submenu second_levelli_a">
														<div class="mobile_submenu_a">

															<a href="<?php echo site_url(@array_search($subKey, $subVal)) ?? '#' ?>"><?php echo ucwords(strtolower($subKey)); ?></a>
															<i class="fa fa-angle-down" aria-hidden="true"></i>
														</div>
														<ul class="dropdown-menu">
															<?php
															if (is_array($subVal)) :
																array_shift($subVal);
																foreach ($subVal as $sub_sub_key => $sub_sub_val) : ?>
																	<li class="">
																		<a class="" href="<?php echo site_url($sub_sub_key) ?? '#' ?>"><?php echo ucwords(strtolower($sub_sub_val)); ?></a>
																	</li>
																<?php endforeach;
															endif; ?>
														</ul>
													</li>
													<?php else : ?>
														<li class="">
															<a class="" href="<?php echo site_url($subKey) ?? '#' ?>">
																<?php if ($subVal == 'faq') echo strtoupper(strtolower($key));
																else echo ucwords(strtolower($subVal)); ?></a>
															</li>
														<?php endif; ?>
													<?php endforeach; ?>

												</ul>
											</li>
											<div class="dropdown-divider"></div>
											<?php else : ?>
												<li class="firstulli_li_a active">
													<a href="<?php echo site_url($key); ?>"><?php echo ucwords($val); ?></a>
												</li>
												<div class="dropdown-divider"></div>
											<?php endif; ?>
										<?php endforeach; ?>

										<?php foreach (CUSTOME_MAIN_MENU as $key => $val) : ?>
											<?php if ($val != null && !empty($val) && is_array($val)) :  ?>

											<li class="firstulli_li_a dropdown">
												<div class="menu_li_a">
													<a href="<?php echo site_url(@array_search($key, $val)) ?? '#' ?>"><?php if ($key == 'faq') echo strtoupper(strtolower($key));else echo ucwords(strtolower($key)); ?> </a>
													<i class="fa fa-angle-down" aria-hidden="true"></i>
												</div>	

												<?php array_shift($val); ?>
												<ul class="dropdown-menu">
													<?php foreach ($val as $subKey => $subVal) :   ?>
														<?php if ($subVal != null && !empty($subVal) && is_array($subVal)) :  ?>
														<li class="dropdown dropdown-submenu second_levelli_a">
															<div class="mobile_submenu_a">

																<a href="<?php echo site_url(@array_search($subKey, $subVal)) ?? '#' ?>"><?php echo ucwords(strtolower($subKey)); ?></a>
																<i class="fa fa-angle-down" aria-hidden="true"></i>
															</div>
															<ul class="dropdown-menu">
																<?php
																if (is_array($subVal)) :
																	array_shift($subVal);
																	foreach ($subVal as $sub_sub_key => $sub_sub_val) : ?>
																		<li class="">
																			<a class="" href="<?php echo site_url($sub_sub_key) ?? '#' ?>"><?php echo ucwords(strtolower($sub_sub_val)); ?></a>
																		</li>
																	<?php endforeach;
																endif; ?>
															</ul>
														</li>
														<?php else : ?>
															<li class="">
																<a class="" href="<?php echo site_url($subKey) ?? '#' ?>">
																	<?php if ($subVal == 'faq') echo strtoupper(strtolower($key));
																	else echo ucwords(strtolower($subVal)); ?></a>
																</li>
															<?php endif; ?>
														<?php endforeach; ?>

													</ul>
												</li>
												<div class="dropdown-divider"></div>
												<?php else : ?>

													<?php if (!empty($this->session->userdata('user_id'))) { ?>

														<li class="firstulli_li_a active">
															<a href="<?php echo site_url($key); ?>"><?php echo ucwords($val); ?></a>
														</li>

														<div class="dropdown-divider"></div>

													<?php } ?>

													
												<?php endif; ?>
											<?php endforeach; ?>
											<?php if (defined('MAIN_HEAD_MENU') != null && !empty(defined('MAIN_HEAD_MENU'))) :  ?>
											<?php foreach (MAIN_HEAD_MENU as $key => $val) : ?>
												<?php if ($val != null && !empty($val) && is_array($val)) :  ?>

												<li class="firstulli_li_a nav-item dropdown">
													<div class="market_link_a">
														<a class="nav-link dropdown-toggle"  id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo ucwords(strtolower($key)); ?> </a>
														<i class="fa fa-angle-down" aria-hidden="true"></i>
													</div>

													<ul class="dropdown-menu">
														<?php

														foreach ($val as $subKey => $subVal) : ?>
															<li class="topfirstlevelli_a">
																<a class="dropdown-item" href="<?php echo site_url($subKey) ?? '#' ?>"><?php echo ucwords(strtolower($subVal)); ?></a>
															</li>
														<?php endforeach; ?>

													</ul>
												</li>
												<div class="dropdown-divider"></div>
												<?php else : ?>
													<li class="firstulli_li_a nav-item dropdown">
														<a class="" href="<?php echo site_url($key); ?>">
															<?php echo ucwords($val); ?>
														</a>
													</li>
												<?php endif; ?>
											<?php endforeach; ?>
										<?php endif; ?>
										<?php if (empty($this->session->userdata('user_id'))) { ?>
											<div class="dropdown-divider"></div>
											<li class="firstulli_li_a">
												<a href="<?php echo site_url('signup'); ?>" class="register_free">
												Register Free </a>
											</li>
										<?php } ?>

										<div class="dropdown-divider"></div>

										<?php if (!empty($this->session->userdata('user_id')) && $this->session->userdata('user_level') != '0') : ?>
										<button type="button" class="btn btn-default header_signin"><a href="<?php echo base_url(); ?>user/logout" class="">Sign Out</a>
										</button>
										<div class="dropdown-divider"></div>
										<?php elseif ($this->session->userdata('user_level') == '0') : ?>
											<button type="button" class="btn btn-default header_signin"> <a href="<?php echo base_url(); ?>admin/logout" class="">Sign Out</a>
											</button>
											<div class="dropdown-divider"></div>
											<?php else : ?>
												<button type="button" class="btn btn-default header_signin"><a href="<?php echo site_url('login'); ?>" class="">Sign in</a>
													<div class="dropdown-divider"></div></button>
													<div class="dropdown-divider"></div>
												<?php endif; ?>
												<button type="button" class="btn btn-default header_selling"><a href="<?php echo site_url('user/create_listings'); ?>" class="">Start Selling</a></button>


											</ul>
										</div>
									</div>
								</div>
								<div class="row mobile_search">
									<div class="container p-0">
										<div class="col-md-12">
											<form class="form-inline my-2 my-lg-0 header_search_box" action="<?php echo site_url('q') ?>" method="get">
												<input class="form-control border border-0 header_search_text" type="text" placeholder="Search For" name="p" value="<?php echo $search ?? ""  ?>">
												<span class="bar"></span>
												<div class="form-group header_top_dropdown mr-sm-2">
													<select class="form-control header_shopy_stores" name="opt">
														<option selected  value="all-marketplaces" >All Marketplace</option>
														<?php foreach (SEARCH_OPTION as $key => $val) : $select = "";?>
															<?php if ($key == $opt) $select = 'selected'; ?>
															<?php echo "<option value='$key' $select >";
															echo ucwords(strtolower($val));
															echo "</option>"; ?>
															<?php $select = "";
														endforeach; ?>

													</select>

												</div>
												<button class="btn btn-success my-2 my-sm-0 header_search_btn" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
											</form>
										</div>
									</div>
								</div>
							</div>
							<?php 
							$dev_text_below_main_menu = fileCache("text_below_main_menu", "",  "get");
							if(isset($dev_text_below_main_menu)) {?>
								<div class="mobile_menu">
									<div class="header_before_banner mobile_table">
										<div class="container p-0">
											<div class="col-sm-12">

												<div class="text_herder_getnow padding_top_asif">
													<p><?php echo substr($dev_text_below_main_menu,0,75);?>
													<!-- <span><a href="#" class="get_now">GET NOW <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></span> -->
												</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="desktop_menu">
								<div class="container-fluid header_before_banner">
									<div class="container p-0">
										<div class="row">
											<div class="col-sm-12">
												<div class="text_herder_getnow padding_top_asif" style="text-align:center" >
													<p>
														<?php echo substr($dev_text_below_main_menu,0,75);?>
														<!-- <span><a href="#" class="get_now">GET NOW <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></span> -->
													</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php } ?> 

					</header>
				</div>

				<!-- // ended by asif -->
				<!--  <script src="<?php echo base_url(); ?>assets/vendor/js/jquery-3.3.1.min.js"></script> -->


				<script>

		// When the user scrolls the page, execute myFunction
		window.onscroll = function() {myFunction()};

		// Get the header
		var header = document.getElementById("users_header_asif");
		var top_header = document.getElementById("dashboard-nav-container");

		// Get the offset position of the navbar
		var sticky = header.offsetTop;
		var top_header_sticky = top_header.offsetTop;

		// Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
		function myFunction() {
			if (window.pageYOffset > sticky) {
				header.classList.add("sticky");
				header.classList.add("width_for_sticky");

			} else {
				header.classList.remove("sticky");
				header.classList.remove("width_for_sticky");
			}

		  // if (window.pageYOffset > top_header_sticky) {
		  //   header.classList.add("sticky");
		  //   header.classList.add("width_for_sticky");

		  // } else {
		  //   header.classList.remove("sticky");
		  //   header.classList.remove("width_for_sticky");
		  // }
		}

		

		
		
	</script>