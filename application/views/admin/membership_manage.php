<!DOCTYPE html>
<html lang="en">

<head>

  <!--Admin Page Meta Tags-->
  <title>Membership Level | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
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
                <i class="mdi mdi-pipe"></i>  <h3>Add Membership Level</h3>
                <div class="ml-auto dropdown user_name">
                <div class="get_user dropdown-toggle" data-toggle="dropdown">AD</div>
                <div class="dropdown-menu">
                    <a href="<?php echo base_url(); ?>admin/user_settings" class="dropdown-item"><i class="icon-material-outline-settings"></i> Settings</a>
                    <li class="divider"></li>
                    <a href="<?php echo base_url(); ?>admin/change_password" class="dropdown-item"><i class="icon-material-outline-lock"></i> Change Password</a>
                   <a href="<?php echo base_url(); ?>admin/logout" class="dropdown-item"><i class="icon-material-outline-power-settings-new"></i> Logout</a>
                   </div>
                  </div>
                </div></div>

            <!-- Breadcrumbs -->
            <nav id="breadcrumbs" class="dark">
              <ul>
                <li><a href="#">Home</a></li>
                <li><a href="<?php echo site_url('admin/membership-level-list') ?>">Membership Level</a></li>
              </ul>
            </nav>
          

          <!-- Row -->
          <div class="row">

            <!-- Dashboard Box -->
            <div class="col-xl-12">
              <div class="dashboard-box margin-top-0">

                <!-- Headline -->

                <div class="headline">
                  <h3>Membership level</h3>
                </div>
                <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">


                <!----- PAGES ---------------->
                <div id="customPaginate">
                  <?php $this->load->view('admin/partials/_membership_form');  ?>
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

  <!--------------------------------------------------------------------------------------------------------------->
  <?php $this->load->view('main/includes/footerscripts'); ?>

  <!--------------------------------------------------------------------------------------------------------------->

</body>

</html>