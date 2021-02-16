<!DOCTYPE html>
<html lang="<?php if(!empty($language)) echo $language; else echo 'en'; ?>">
<head>

	<!--User Page Meta Tags-->
	<title>User Dashboard | <?php echo $this->lang->line('site_name') ?>| User Dashboard</title>
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

			<div class="dashboard-content-container" data-simplebar>
				<div class="dashboard-content-inner">

					 <!-- added by asif -->

					<div class="user_header_panel" style="border:2px solid #fff3cd;">
						<link href="<?php echo base_url(); ?>assets/css/custom_style.css?v=<?php echo time() ;?>" rel="stylesheet" />
						<link href="<?php echo base_url(); ?>assets/css/designer_css/custom_style.css" rel="stylesheet" />
						<link href="<?php echo base_url(); ?>assets/css/custom_responsive_style.css?v=<?php echo time(); ?>" rel="stylesheet" />
						<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/iconfonts/font-awesome/css/font-awesome.min.css" />
						<header>
							<div class="desktop_menu">
								<div class="row header_custom py-1">
									<div class="container p-0">
										<div class="col-sm-12 p-0">
											<nav class="navbar navbar-expand-sm">
											
												<?php
												$select = "";
												$opt = "";
												if (isset($_GET['search'])) {
													$opt = $this->uri->segment(1);
													$search = strtolower($_GET['search']);
												} ?>
												<div class="col-sm-4 p-0" style="margin-left: 25px;">
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
												<div style="margin-left: 25px;" class="col-sm-6 p-0 menu_withbtn justify-content-between">


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
													<nav class="navbar navbar-expand-sm justify-content-between menu_desktop_a d-none">
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
												<nav class="navbar navbar-default navbar-static-top p-0" role="navigation">
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

				<div class="mobile_menu">
					<div class="row tablet_menu">
						<div class="container">
							<div class="col-md-12">
								<div class="menu_with_logo_tablet d-flex justify-content-between">
									<a class="navbar-brand" href="<?php echo site_url(); ?>">
										<!-- sir to url change krvana ha  -->
										
									</a>

									<div style="margin-top: 15px;" class="menu_icon_tablet tablet_menu_icon" onclick="myFunction(this)">

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
									<div class="row header_before_banner mobile_table">
										<div class="container p-0">
											<div class="col-sm-12">

												<div class="text_herder_getnow" style="padding-top: 6px;">
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
												<div class="text_herder_getnow" style="text-align:center; padding-top: 6px;" >
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


				<!-- added by asif -->
				
				<!-- Dashboard Headline -->
				<div class="dashboard-headline" style="margin-top: 20px;">
					<div class="dashboad_table">
						<i class="icon-material-outline-dashboard"></i> <h3>Dashboard</h3>
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
				
				<div class="row breadcrumbs_row dashboad_breadcrum_list">
					<!-- Breadcrumbs -->
					<div class="col-xl-12">
						<nav id="breadcrumbs" class="dark">
							<ul>
								<li><a href="#">Home</a></li>
								<li><a href="#" class="breadcrumb_active">Dashboard</a></li>
							</ul>
						</nav>
					</div>
				</div>

				<!-- Row -->
				<div class="row">
					<div class="col-xl-12 p-0">
						<!--------Announcement ----------------------------------------------------------------------------------->
						<?php $this->load->view('user/includes/announcements'); ?>
						<!--------------------------------------------------------------------------------------------------------->
					</div>
				</div>

				<!-- Dashboard Container -->
				<div class="row margin-top-10">
					<div class="col-xl-12">
						<!-- Dashboard Container -->
						<div class="fun-facts-container">
							<div class="fun-fact" data-fun-fact-color="#ecac1f">
								<div class="fun-fact-icon"><i class="fa fa-users"></i></div>
								<div class="fun-fact-text">
									<span>Total Listings</span>
									<h4><?php if(isset($TL)) echo $TL; ?></h4>
								</div>

							</div>

							<div class="fun-fact" data-fun-fact-color="#ecac1f">
								<div class="fun-fact-icon"><i class="fas fa-wallet"></i></div>
								<div class="fun-fact-text">
									<span>Total Earnings</span>
									<h4><?php if(isset($TE)) echo number_format(floatval($TE),2); ?></h4>
								</div>

							</div>

						</div>

					</div>
				</div>
				<!-- Dashboard Box -->
				<!-- Row / End -->

				<div class="row">	
					<div class="col-md-12 col-lg-12 col-xl-12">
						<div class="content shadow">						
							<div class="card mb-3">
								<div class="card-header">
									<h3><i class="fa fa-line-chart"></i> MONTHLY WISE TOTAL EARNINGS </h3>
								</div>

								<div class="card-body">
									<div class="submit-field">
										<select class="form-control" id="years_drop" name="years_drop"></select>
									</div>

									<canvas id="monthluserwisechart"></canvas>
								</div>		

								<div class="card-footer small text-muted">Updated <?php echo date('Y-m-d H:i:s'); ?></div>
							</div><!-- end card-->	
						</div>				
					</div>
				</div>
				<!--/Monthlywise Earnings--->

				<!-- open contracts -->
				<div class="row margin-top-7">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">						
						<div class="card mb-3 shadow">

							<div class="card-header">
								<h3> YOUR OPEN Transaction </h3>
							</div>

							<?php if(!empty($contracts)) { foreach ($contracts as $contract) { ?>
								<div class="card-body">
									<p class="font-600 m-b-5"><b>TRANSACTION ID: </b><?php echo $contract['contract_id'] ?> <b> | TRANSACTION BETWEEN </b><?php echo $contract['owner'] ?> <b> & </b><?php echo $contract['customer'] ?> <?php if ($contract['status'] === '0' ){?>
										<div class="badge badge-info"> Pending for payment</div>
									<?php } else if ($contract['status'] === '1' ) { ?>
										<div class="badge badge-success"> Paid Transacion</div>
									<?php } else if ($contract['status'] === '2' ) { ?>
										<div class="badge badge-danger"> In Reolution Manager</div>
									<?php } else if ($contract['status'] === '3' ) { ?>
										<div class="badge badge-danger"> Canceled By Buyer</div>
									<?php } else if ($contract['status'] === '4' ) { ?>
										<div class="badge badge-warning"> Sale Completed</div>	
									<?php } else if ($contract['status'] === '5' ) { ?>
										<div class="badge badge-dark"> Delivered</div>
									<?php } else if ($contract['status'] === '6' ) { ?>
										<div class="badge badge-warning"> On Revision</div>
									<?php } else if ($contract['status'] === '8' ) { ?>
										<div class="badge badge-warning"> Reject Cancel Request</div>
									<?php } else if ($contract['status'] === '9' ) { ?>
										<div class="badge badge-warning"> Raised a Dispute</div>
									<?php } else if ($contract['status'] === '7' ) { ?>
										<div class="badge badge-warning"> Canceled Transacion & Refunded</div>
										<?php } ?> <span class="text-primary pull-right"><b>IN PROGRESS (<?php echo $contract['percentage'] ?>%)</b></span></p>
										<div class="progress">
											<div class="progress-bar progress-bar-striped progress-xs bg-warning" role="progressbar" style="width: <?php echo $contract['percentage'] ?>%" aria-valuenow="<?php echo $contract['percentage'] ?>" aria-valuemin="0" aria-valuemax="100"></div>
										</div>

										<div class="m-b-20"></div>						
									</div>
								<?php } } else { ?>
									<p class="m-b-5 sorry_text"> Sorry , No Transacions were found </p>
								<?php } ?>

								<div class="card-footer small text-muted">Updated <?php echo date('Y-m-d H:i:s'); ?></div>
							</div><!-- end card-->					
						</div>
					</div>	
					<!-- Row / End -->
					<!-- /open contracts -->

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
	<script>loadUserwiseMonthlyWiseTotalEarnings('monthluserwisechart','<?php echo date('Y') ?>');loadYears('years_drop');</script>
	<!--------------------------------------------------------------------------------------------------------------->

</body>
</html>