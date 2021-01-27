<!DOCTYPE html>
<html lang="en">
<head>

<!--Admin Page Meta Tags-->
<title>Plugins Manager  | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
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
         <i class="mdi mdi-power-plug"></i> <h3>Plugins Manager</h3>
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
						<li><a href="#">Plugins Manager</a></li>
					</ul>
				</nav>
			
	
			<!-- Row -->
			<div class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12 installed_div">
					<div class="dashboard-box margin-top-0">

						<div class="col-12 grid-margin">
              			<div class="card">
                  		<div class="card-body">
                      	<h4 class="card-title">INSTALLED PLUGINS </h4>
                      	<form class="forms-sample">
                        <!--/Plugins Table -->
                        <div id="table_plugins_div">
                          <div class="table-responsive">
                            
                          
                        	<table id="table_plugins" class="table table-striped table-hover responsive active_domain_drop_a">
                          	<tbody>
                          	<?php if(isset($plugins)) { foreach ($plugins as $Plugin) { ?>
                            <tr>
                            <td>
                                <div class="flex_div_upload_plugin">
                                    <img class="img_upload_plugin" src="<?php echo base_url().ICON_UPLOAD; ?><?php echo $Plugin['icon']; ?>"></img>
                                    <p class="text_action">
                                      <span class="plugin_lits_name"><?php if(isset($Plugin['name'])) {echo $Plugin['name']; } ?></span>
                                    
                                    </p>
                                </div>
                            </td>
                            <td>
                                <div class="flex_div_upload_plugin">
                                   
                                    <p class="">
                                    
                                      <span class=""><i class="plugin_lits_icon far fa-calendar-alt"></i> <?php if(isset($Plugin['updated'])) {echo $Plugin['updated']; } ?></span>
                                      
                                    </p>
                                </div>
                            </td>

                            <td>
                                <div class="flex_div_upload_plugin">
                                   
                                    <p class="">
                                  
                                      <span class=""><i class="plugin_lits_icon fas fa-plug"></i> <?php if(isset($Plugin['version'])) {echo " ".$Plugin['version']; } ?></span>
                                    </p>
                                </div>
                            </td>


                            <td>
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                  	<?php if($Plugin['status'] === '1') { ?>
                                    <button type="button" class="btn btn-toggle active plugin_activate" data-toggle="button" aria-pressed="true" autocomplete="on" data-pluginid=<?php if(isset($Plugin['id'])) {echo $Plugin['id']; } ?> data-actkey=<?php if(isset($Plugin['platform'])) {echo $Plugin['platform']; } ?>  >
                                      <div class="handle"></div>
                                    </button>
                                  	<?php } else { ?>
                                    <button type="button" class="btn btn-toggle plugin_activate" data-toggle="button" aria-pressed="false" autocomplete="on" data-pluginid=<?php if(isset($Plugin['id'])) {echo $Plugin['id']; } ?> data-actkey=<?php if(isset($Plugin['platform'])) {echo $Plugin['platform']; } ?> >
                                      <div class="handle"></div>
                                    </button>
                                  	<?php } ?>
                                </div>
                            </td>
                                
                        	<!-- <td>
                         
                            </td> -->
                            </tr>
                          	<?php } } else {echo "No Plugins are installed.."; } ?>

                        	</tbody>
                        	</table>
                          </div>
                        	</div>
                        	<!---/Plugins Table -->
                    	</form>
                  		</div>
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