<!DOCTYPE html>
<html lang="en">

<head>

  <!--Admin Page Meta Tags-->
  <title>Permssion Level | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
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
            <h3>Permssion Level</h3>

            <!-- Breadcrumbs -->
            <nav id="breadcrumbs" class="dark">
              <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Permssion Level</a></li>
              </ul>
            </nav>
          </div>

          <!-- Row -->
          <div class="row">

            <!-- Dashboard Box -->
            <div class="col-xl-12">
              <div class="dashboard-box margin-top-0">

                <!-- Headline -->

                <div class="headline">
                  <h3>Permssion level</h3>
                </div>
                <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">


                <!----- PAGES ---------------->
                <div id="customPaginate">
                  <?php $this->load->view('admin/partials/_common_listing_page');  ?>
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