	<!-- Dashboard Sidebar -->
	<div class="dashboard-sidebar">
		<div class="dashboard-sidebar-inner" data-simplebar>
			<div class="dashboard-nav-container">
				<div class="row mobileadmin_view_a">
					<div class="col-sm-6 col-md-6 admin_logo_a col-xs-12">
						<div class="w-100">
							<a class="navbar-brand brand-logo-mini text-center" href="<?php echo base_url() ?>">
								<img src="<?php if (isset($imagesData[0]['invoice_logo'])) echo base_url() . ADMIN_IMAGES . $imagesData[0]['invoice_logo']; ?>" alt="logo" />
							</a>
						</div>
					</div>
					<div class="col-sm-6 col-md-6 admin_user_a col-xs-12">
						<div class="user_name">
							<span class="margin-top-7">Welcome <a href=""><?php if (isset($userdata[0]['username'])) {
																				echo $userdata[0]['username'];
																			} ?> </a> !</span>
						</div>
					</div>
				</div>

				<!-- Responsive Navigation Trigger -->
				<a href="#" class="dashboard-responsive-nav-trigger">
					<span class="hamburger hamburger--collapse">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</span>
					<span class="trigger-title">Dashboard Navigation</span>
				</a>

				<!-- Navigation -->
				<div class="dashboard-nav">
					<div class="dashboard-nav-inner admin_dashboard_left">
						<div class="desktop_view_dashboad_a">
							<div class="w-100">
								<a class="navbar-brand brand-logo-mini text-center" href="<?php echo base_url()  ?>">
									<img src="<?php if (isset($imagesData[0]['invoice_logo'])) echo base_url() . ADMIN_IMAGES . $imagesData[0]['invoice_logo']; ?>" alt="logo" />
								</a>
							</div>
							<hr>
							<div class="user_name">
								<span class="margin-top-7">Welcome <a href=""><?php if (isset($userdata[0]['username'])) {
																					echo $userdata[0]['username'];
																				} ?> </a> !</span>
							</div>
						</div>



						<ul data-submenu-title="Start">
							<?php if (getUserWiseMenu(SIDEMENU['Dashboard'])) { ?>
								<li class="<?php if ($_SERVER['PHP_SELF'] === "dashboard.php") {
												echo "active";
											} ?>"><a href="<?php echo site_url('admin'); ?>"><i class="icon-material-outline-dashboard"></i> Dashboard</a></li>
							<?php } ?>
						</ul>

						<ul data-submenu-title="Listings Manage">
							<?php if (getUserWiseMenu(SIDEMENU['General_Settings'])) { ?>
								<li <?php if (in_array($this->uri->segment(2), ['general_settings'])) echo "class='active'" ?>><a href="<?php echo site_url('admin/general_settings'); ?>"><i class="mdi mdi-wrench"></i> General Settings </a></li>
							<?php } ?>

							<?php if (getUserWiseMenu(SIDEMENU['Plugins_Manager'])) { ?>
								<li <?php if (in_array($this->uri->segment(2), ['plugins_manager'])) echo "class='active'" ?>><a href="<?php echo site_url('admin/plugins_manager'); ?>"><i class="mdi mdi-power-plug"></i> Plugins Manager</a></li>
							<?php } ?>
							<!-- <li><a href="#otherSections" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" role="button" aria-controls="otherSections"> -->
							<!-- <i class="mdi mdi-pipe"></i></i>Add Category Section</a></li>
							<ul class="collapse list-unstyled bg-gray" id="otherSections"> -->
							<?php if (getUserWiseMenu(SIDEMENU['Monetization_Control'])) { ?>
								<li <?php if (in_array($this->uri->segment(2), ['monetization_control'])) echo "class='active'" ?>><a href="<?php echo site_url('admin/monetization_control'); ?>"><i class="mdi mdi-pipe"></i> Monetization Method </a></li>
							<?php } ?>
							<?php if (getUserWiseMenu(SIDEMENU['Website_Industry'])) { ?>
								<li <?php if (in_array($this->uri->segment(2), ['category_control'])) echo "class='active'" ?>><a href="<?php echo site_url('admin/category_control'); ?>"><i class="mdi mdi-pipe"></i> Website Industry</a></li>
							<?php } ?>
							<?php if (getUserWiseMenu(SIDEMENU['Solution_Industry'])) { ?>
								<li <?php if (in_array($this->uri->segment(2), ['category_solution'])) echo "class='active'" ?>><a href="<?php echo site_url('admin/category_solution'); ?>"><i class="mdi mdi-pipe"></i> Solution Industry</a></li>
							<?php } ?>
							<?php if (getUserWiseMenu(SIDEMENU['Service_Type'])) { ?>
								<li <?php if (in_array($this->uri->segment(2), ['category_service_type'])) echo "class='active'" ?>><a href="<?php echo site_url('admin/category_service_type'); ?>"><i class="mdi mdi-pipe"></i> Service Type </a></li>
							<?php } ?>

							<!-- <li><a href="<?php //echo site_url('admin/permission-list'); 
												?>"><i class="mdi mdi-pipe"></i> Membership's Permission</a></li> -->
							<?php if (getUserWiseMenu(SIDEMENU['Membership_Level'])) { ?>
								<li <?php if (in_array($this->uri->segment(2), ['membership-level-list'])) echo "class='active'" ?>><a href="<?php echo site_url('admin/membership-level-list'); ?>"><i class="mdi mdi-pipe"></i> Membership Level</a></li>
							<?php  } ?>
							<!-- </ul> -->
							<?php if (getUserWiseMenu(SIDEMENU['Course_Category']) || getUserWiseMenu(SIDEMENU['Courses'])) { ?>

								<li <?php if (in_array($this->uri->segment(2), ['course_category', 'list_courses', 'add_course', 'view_lession', 'add_lession'])) echo "class='active'" ?>><a href="#course" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" role="button" aria-controls="course">
										<i class="mdi mdi-book"></i></i>Courses</a></li>
								<ul class="collapse list-unstyled bg-gray pl-3 <?php if (in_array($this->uri->segment(2), ['course_category', 'list_courses', 'add_course', 'view_lession', 'add_lession'])) : echo 'show';
																				else : '';
																				endif; ?>" id="course">
									<?php if (getUserWiseMenu(SIDEMENU['Course_Category'])) { ?>
										<li><a href="<?php echo site_url('admin/course_category'); ?>"><i class="mdi mdi-circle-outline"></i> Course Category </a></li>
									<?php } ?>
									<?php if (getUserWiseMenu(SIDEMENU['Courses'])) { ?>
										<li><a href="<?php echo site_url('admin/list_courses'); ?>"><i class="mdi mdi-circle-outline"></i>Courses</a></li>
									<?php } ?>
								</ul>
								</li>
							<?php } ?>
							<?php if (getUserWiseMenu(SIDEMENU['Current_Listings'])) { ?>

								<li <?php if (in_array($this->uri->segment(2), ['current_listings'])) echo "class='active'" ?>><a href="<?php echo site_url('admin/current_listings'); ?>"><i class="mdi mdi-image-area-close"></i> Current Listings </a></li>

							<?php  } ?>

							<?php if (getUserWiseMenu(SIDEMENU['Solution_Listings'])) { ?>

								<li <?php if (in_array($this->uri->segment(2), ['solution_listings'])) echo "class='active'" ?>><a href="<?php echo site_url('admin/solution_listings'); ?>"><i class="mdi mdi-image-area-close"></i> Solution Listings </a></li>
							<?php } ?>

							<?php if (getUserWiseMenu(SIDEMENU['Cron_Jobs'])) { ?>

								<li <?php if (in_array($this->uri->segment(2), ['cron_jobs'])) echo "class='active'" ?>><a href="<?php echo site_url('admin/cron_jobs'); ?>"><i class="mdi mdi-calendar-clock"></i> Cron Jobs Manager </a></li>
							<?php } ?>
							<?php if (getUserWiseMenu(SIDEMENU['Email_Settings'])) { ?>

								<li <?php if (in_array($this->uri->segment(2), ['email_settings'])) echo "class='active'" ?>><a href="<?php echo site_url('admin/email_settings'); ?>"><i class="mdi mdi-email"></i> Email Settings </a></li>

							<?php } ?>
							<?php if (getUserWiseMenu(SIDEMENU['Listing_Control'])) { ?>

								<li <?php if (in_array($this->uri->segment(2), ['listing_control'])) echo "class='active'" ?>><a href="<?php echo site_url('admin/listing_control'); ?>"><i class="mdi mdi-wallet-giftcard"></i> Listing Plans </a></li>
							<?php } ?>
							<?php if (getUserWiseMenu(SIDEMENU['Bulk_Upload'])) { ?>

								<li <?php if (in_array($this->uri->segment(2), ['bulk_upload'])) echo "class='active'" ?>><a href="<?php echo site_url('admin/bulk_upload'); ?>"><i class="mdi mdi-briefcase-upload"></i> Bulk Upload </a></li>
							<?php } ?>
							<?php if (getUserWiseMenu(SIDEMENU['Manage_Disputes'])) { ?>

								<li><a href="#"><i class="mdi mdi-thumb-up"></i> Manage Disputes <span class="nav-tag"><?php echo count($disputes); ?></span></a>
									<?php if (!empty($disputes)) { ?>
										<ul>
											<?php
											foreach ($disputes as $dispute) {
											?>
												<li><a href="<?php echo site_url('admin/manage_disputes/' . $dispute['contract_id']); ?>">Transaction - #<?php echo $dispute['contract_id']; ?> </a></li>
											<?php } ?>
										</ul>
									<?php } ?>
								</li>
							<?php } ?>
							<?php if (getUserWiseMenu(SIDEMENU['Reported_Listings'])) { ?>

								<li <?php if (in_array($this->uri->segment(2), ['reported_listings'])) echo "class='active'" ?>><a href="<?php echo site_url('admin/reported_listings'); ?>"><i class="mdi mdi-alert"></i> Reported Listings </a></li>
							<?php } ?>
						</ul>


						<ul data-submenu-title="Organize and Manage">
							<?php if (getUserWiseMenu(SIDEMENU['Pages_Manager'])) { ?>
								<li <?php if (in_array($this->uri->segment(2), ['pages_manager'])) echo "class='active'" ?>><a href="<?php echo site_url('admin/pages_manager'); ?>"><i class="mdi mdi-book-open-page-variant"></i> Pages </a></li>
							<?php } ?>

							<?php if (getUserWiseMenu(SIDEMENU['Blog_Manager'])) { ?>
								<li <?php if (in_array($this->uri->segment(2), ['blog_manager'])) echo "class='active'" ?>><a href="<?php echo site_url('admin/blog_manager'); ?>"><i class="mdi mdi-blogger"></i> Blog </a></li>
							<?php } ?>

							<?php if (getUserWiseMenu(SIDEMENU['Language_Setup'])) { ?>
								<li <?php if (in_array($this->uri->segment(2), ['language_setup'])) echo "class='active'" ?>><a href="<?php echo site_url('admin/language_setup'); ?>"><i class="mdi mdi-language-swift"></i>Languages</a></li>
							<?php } ?>

							<?php if (getUserWiseMenu(SIDEMENU['Images_Manager'])) { ?>
								<li <?php if (in_array($this->uri->segment(2), ['images_manager'])) echo "class='active'" ?>><a href="<?php echo site_url('admin/images_manager'); ?>"><i class="mdi mdi-image-multiple"></i>Images </a></li>
							<?php } ?>

							<?php if (getUserWiseMenu(SIDEMENU['Ads_Manager'])) { ?>
								<li <?php if (in_array($this->uri->segment(2), ['ads_manager'])) echo "class='active'" ?>><a href="<?php echo site_url('admin/ads_manager'); ?>"><i class="mdi mdi-headset-dock"></i>Ads </a></li>
							<?php } ?>

						</ul>

						<ul data-submenu-title="Payments & Withdrawals">

							<?php if (getUserWiseMenu(SIDEMENU['Payments_Setup'])) { ?>
								<li <?php if (in_array($this->uri->segment(2), ['payments_setup'])) echo "class='active'" ?>><a href="<?php echo site_url('admin/payments_setup'); ?>"><i class="mdi mdi-credit-card-scan"></i> Payments Setup </a></li>
							<?php } ?>

							<?php if (getUserWiseMenu(SIDEMENU['Payments_Data'])) { ?>
								<li <?php if (in_array($this->uri->segment(2), ['payments_data'])) echo "class='active'" ?>><a href="<?php echo site_url('admin/payments_data'); ?>"><i class="mdi mdi-cash-multiple"></i> Payments Data </a></li>
							<?php } ?>


							<?php if (getUserWiseMenu(SIDEMENU['Withdrawal_Settings'])) { ?>
								<li <?php if (in_array($this->uri->segment(2), ['withdrawal_settings'])) echo "class='active'" ?>><a href="<?php echo site_url('admin/withdrawal_settings'); ?>"><i class="mdi mdi-cash-usd"></i> Withdrawal Requests </a></li>
							<?php } ?>


							<?php if (getUserWiseMenu(SIDEMENU['Listings_Types'])) { ?>
								<li <?php if (in_array($this->uri->segment(2), ['listings_types'])) echo "class='active'" ?>><a href="<?php echo site_url('admin/listings_types'); ?>"><i class="mdi mdi-format-annotation-plus"></i> Sponsored & Regular</a></li>
							<?php } ?>


						</ul>



						<ul data-submenu-title="User Controls">

							<?php if (getUserWiseMenu(SIDEMENU['User_Control'])) { ?>
								<li <?php if (in_array($this->uri->segment(2), ['admin_user'])) echo "class='active'" ?>><a href="<?php echo site_url('admin/admin_user'); ?>"><i class="mdi mdi-account-circle"></i> Admin User </a></li>
								<li <?php if (in_array($this->uri->segment(2), ['user_control'])) echo "class='active'" ?>><a href="<?php echo site_url('admin/user_control'); ?>"><i class="mdi mdi-account-circle"></i> User Control </a></li>
							<?php } ?>
							<li <?php if (in_array($this->uri->segment(2), ['user-wise-membership-list'])) echo "class='active'" ?>>
								<a href="<?php echo site_url('admin/users-membership-list'); ?>"><i class="mdi mdi-account-circle"></i>User Membership List</a>
							</li>

							<li <?php if (in_array($this->uri->segment(2), ['expert-directory'])) echo "class='active'" ?>>
								<a href="<?php echo site_url('admin/expert-directory'); ?>"><i class="mdi mdi-account-circle"></i>Expert Directory</a>
							</li>


							<?php if (getUserWiseMenu(SIDEMENU['Announcement_Control'])) { ?>
								<li <?php if (in_array($this->uri->segment(2), ['announcement_control'])) echo "class='active'" ?>><a href="<?php echo site_url('admin/announcement_control'); ?>"><i class="mdi mdi-bullhorn"></i> Announcements </a></li>
							<?php } ?>

							<li <?php if (in_array($this->uri->segment(2), ['manage-badges'])) echo "class='active'" ?>>
								<a href="<?php echo site_url('admin/manage-badges'); ?>"><i class="mdi mdi-account-circle"></i> Badges</a>
							</li>
							<li <?php if (in_array($this->uri->segment(2), ['manage_pages_tags'])) echo "class='active'" ?>>
								<a href="<?php echo site_url('admin/manage_pages_tags'); ?>"><i class="mdi mdi-account-circle"></i> Pages Tags</a>
							</li>
							<li <?php if (in_array($this->uri->segment(2), ['manage-advertisements'])) echo "class='active'" ?>>
								<a href="<?php echo site_url('admin/manage-advertisements'); ?>"><i class="mdi mdi-account-circle"></i> Advertisements</a>
							</li>

							<li <?php if (in_array($this->uri->segment(2), ['manage-email-subscribers'])) echo "class='active'" ?>>
								<a href="<?php echo site_url('admin/manage-email-subscribers'); ?>"><i class="mdi mdi-account-circle"></i> Subscribers</a>
							</li>
							<li <?php if (in_array($this->uri->segment(2), ['manage-coupons'])) echo "class='active'" ?>>
								<a href="<?php echo site_url('admin/manage-coupons'); ?>"><i class="mdi mdi-account-circle"></i> Coupons</a>
							</li>
						</ul>

						<ul data-submenu-title="Account">


							<li <?php if (in_array($this->uri->segment(2), ['user_settings'])) echo "class='active'" ?>><a href="<?php echo site_url('admin/user_settings'); ?>"><i class="icon-material-outline-settings"></i> Settings</a></li>


							<?php if (getUserWiseMenu(SIDEMENU['Change_Password'])) { ?>
								<li <?php if (in_array($this->uri->segment(2), ['change_password'])) echo "class='active'" ?>><a href="<?php echo site_url('admin/change_password'); ?>"><i class="icon-material-outline-lock"></i> Change Password</a></li>
							<?php } ?>

							<li><a href="<?php echo site_url('admin/logout'); ?>"><i class="icon-material-outline-power-settings-new"></i> Logout</a></li>


						</ul>
						<!-- 
						<ul data-submenu-title="About Developers & Credits">

							<?php// if (getUserWiseMenu(SIDEMENU['About_Developers'])) { ?>
								<li <?php //if (in_array($this->uri->segment(2), ['about_developers'])) echo "class='active'" 
									?>><a href="<?php //echo site_url('admin/about_developers'); 
												?>"><i class="mdi mdi-information"></i> About us</a></li>
							<?php //} 
							?>


						</ul> -->

					</div>
					<?php //$this->load->view('main/includes/create-lisiting-option-backend'); 
					?>
				</div>
				<!-- Navigation / End -->

			</div>
		</div>
	</div>

	<!-- Dashboard Sidebar / End -->