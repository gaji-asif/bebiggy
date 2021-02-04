<header>
	<div class="desktop_menu">
		<div class="row header_custom py-1">
			<div class="container p-0">
				<div class="col-sm-12 p-0">
					<nav class="navbar navbar-expand-sm">
						<div class="col-sm-2 p-0">
							<a class="navbar-brand" href="<?php echo site_url(); ?>">
								<!-- sir to url change krvana ha  -->
								<img src="<?php echo site_url('assets/img/admin/Logo_-small.png'); ?>" alt="logo">
							</a>
						</div>
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
								<a href="<?php echo site_url('user/create_listings'); ?>" class="btn btn-default header_selling">Start Selling</a>
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
															<li class="firstulli_li_a active d-flex justify-content-end align-items-right pr-0">
															<a class="free_register_a" style="color: #3abffd; margin-right: 5px;" href="<?php echo site_url($key); ?>"><?php echo ucwords($val); ?></a>
															</li>

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
										<img src="<?php echo site_url('assets/img/admin/Logo_-small.png'); ?>" alt="logo">
									</a>

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
									<div class="row header_before_banner mobile_table">
										<div class="container p-0">
											<div class="col-sm-12">

												<div class="text_herder_getnow">
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
												<div class="text_herder_getnow" style="text-align:center" >
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