<!DOCTYPE html>
<html lang="<?php if(!empty($language)) echo $language; else echo 'en'; ?>">
<head>

<!--User Page Meta Tags-->
<title>User Messages | <?php echo $this->lang->line('site_name') ?>| User Dashboard</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="icon" href="<?php if(isset($imagesData[0]['favicon'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['favicon']; ?>" alt="favicon" />
<meta name="robots" content="noindex">
<!--User Page Meta Tags-->

<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/includes/headerscripts'); ?>
<!--------------------------------------------------------------------------------------------------------------->

</head>

<body class="gray" onload="bootChat();">

<!-- Wrapper -->
<div id="wrapper">

<!--------------------------------------------------------------------------------------------------------------->
<div class="clearfix"></div>
<!--------------------------------------------------------------------------------------------------------------->
<!-- Header Container / End -->


<!-- Dashboard Container -->
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
				<i class="icon-material-outline-question-answer"></i> <h3>Messages</h3>
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
				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="<?php echo site_url('user/dashboard'); ?>">Dashboard</a></li>
						<li>Messages</li>
					</ul>
				</nav>
			</div>
	
				<div class="messages-container margin-top-0">

					<div class="messages-container-inner">

						<!-- Messages -->
						<div class="messages-inbox">
							<div class="messages-headline">
								<div class="input-with-icon">
										<input id="autocomplete-input" type="text" placeholder="Search">
									<i class="icon-material-outline-search"></i>
								</div>
							</div>

							<ul>
								<?php foreach ($users as $user) {  if(isset($user['to'][0]->user_id) && $user['to'][0]->user_id !== $cur_user->user_id ){  ?> 

								<li class="active-message chat-user" data-chatfriend="<?php echo $user['to'][0]->user_id; ?>" data-mychat="<?php echo $cur_user->user_id; ?>">
									<a href="#">
										<?php $status = $user['to'][0]->online == '1' ? 'status-online' : 'status-offline'; ?>
										<?php if(isset($user['unread'])) { ?>
											<div class="message-count"> <?php echo $user['unread']; ?> </div>
										<?php } ?>
										<div class="message-avatar"><i class="status-icon <?php echo $status; ?>"></i><img src="<?php if(!empty($user['to'][0]->thumbnail)) echo base_url().USER_UPLOAD.$user['to'][0]->thumbnail; else echo base_url().USER_UPLOAD.'no-image.png';  ?>" alt="" /></div>

										<div class="message-by">
											<div class="message-by-headline">
												<h5><?php if(isset($user['to'][0]->firstname)) echo $user['to'][0]->firstname; ?></h5>
												<span><?php if(isset($user['ago'])) echo $user['ago'] ?></span>
											</div>
											<p><?php if(isset($user['last_msg'][0]->message)) echo substr($user['last_msg'][0]->message,0,40); ?>..</p>
										</div>
									</a>
								</li>
								<?php } } ?>
							</ul>
						</div>
						<!-- Messages / End -->

						<!-- Message Content -->
						<div class="message-content">

							<div class="messages-headline">
								<input type="hidden" name="chat_buddy_id" id="chat_buddy_id" value="">
								<h4 id="ChatName">Click on the user</h4>
							</div>
							
							<!-- Message Content Inner -->
							<div id="chat-message" class="message-content-inner">
								<!----message loading bubble-->
								<div id="message-loading" class="message-bubble" style="display: none;">
									<div class="message-bubble-inner">
										<div class="message-avatar"><img src="<?php echo base_url().USER_UPLOAD.'no-image.jpg'  ?>"alt="" /></div>
										<div class="message-text">
											<!-- Typing Indicator -->
											
											<div class="typing-indicator">
												<span></span>
												<span></span>
												<span></span>
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
								<!----/Ends message loading bubble-->

							</div>
							<!-- Message Content Inner / End -->
							
							<!-- Reply Area -->
							<div class="message-reply">
								<textarea id="chat_message" class="chat-textarea" cols="1" rows="1" placeholder="Type a Message here" data-autoresize></textarea>
								<button class="button ripple-effect sendMsg">Send</button>
							</div>

						</div>
						<!-- Message Content -->

					</div>
			</div>
			<!-- Messages Container / End -->

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