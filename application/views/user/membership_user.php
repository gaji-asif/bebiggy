<!DOCTYPE html>
<html lang="en">

<head>

    <!--Admin Page Meta Tags-->
    <title>Membership | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="icon" href="<?php if (isset($imagesData[0]['favicon'])) echo base_url() . ADMIN_IMAGES . $imagesData[0]['favicon']; ?>" alt="favicon" />
    <meta name="robots" content="noindex">
    <!--/Admin Page Meta Tags-->

    <!--------------------------------------------------------------------------------------------------------------->
    <?php $this->load->view('main/includes/headerscripts'); ?>
    <!--------------------------------------------------------------------------------------------------------------->
    <style>
        .select2-container {
            z-index: 100000;
        }

        .select2-results ul {
            height: 200px !important;
            overflow-y: scroll !important;
        }
    </style>
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

                    <!-- Dashboard Headline -->
                    <div class="dashboard-headline">

                        <div class="dashboad_table">
                            <i class="mdi mdi-image-area-close"></i>
                            <h3>Membership Listings</h3>
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
                            <li><a href="<?php echo site_url('user/dashboard'); ?>">Dashboard</a></li>
                            <li>Membership Listings</li>
                        </ul>
                    </nav>

                    <!-- Row -->
                    <div class="row">

                        <!-- Dashboard Box -->
                        <div class="col-xl-12">
                            <div class="dashboard-box margin-top-0">

                                <!-- Headline -->
                                <div class="headline">
                                    <h3><i class="icon-material-outline-assignment"></i> Membership Listings</h3>
                                </div>
                                <!-- <div class="col-xl-12">
                                    <input type="text" name="search" id="MemberShipearch_admin" placeholder="Search">
                                </div> -->
                                <?php

                                if ($this->session->flashdata('sussess_listing')) {
                                    echo '<div class="alert alert-success">';
                                    echo   $this->session->set_flashdata('sussess_listing');
                                    echo '</div>';
                                }

                                ?>
                                <div id="body_content">
                                    <div class="content">

                                        <div class="table-responsive solutions_listings">
                                            <table class="table table-head-fixed table-border table-hover table-striped table-condensed">
                                                <thead>
                                                    <tr>
                                                        <th><a href="javascript:void(0);" class="tblMnu">Plan Name</a></th>
                                                        <th><a href="javascript:void(0);" class="tblMnu">Price</a></th>
                                                        <th><a href="javascript:void(0);" class="tblMnu">Adj. Plan Name</a></th>
                                                        <th><a href="javascript:void(0);" class="tblMnu">Adj. Amt</a></th>
                                                        <th><a href="javascript:void(0);" class="tblMnu">Start-Date</a></th>
                                                        <th><a href="javascript:void(0);" class="tblMnu">End-Date</a></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    //pre($membership_details,1);
                                                    if (!empty($membership_details) && empty($membership_history)) {
                                                        foreach ($membership_details as $listing) { ?>

                                                            <tr class="bg-warning">

                                                                <td><a><?php echo $listing['name']; ?></a></td>
                                                                <td>$<?php echo $listing['price']; ?></td>
                                                                <td> - </td>
                                                                <td> 0 </td>
                                                                <td><?php $date = $listing['membership_assign_date'];
                                                                    $dt = new DateTime($date);
                                                                    echo $buy_date = $dt->format('Y-m-d');
                                                                    ?></td>
                                                                <td><?php echo date('Y-m-d', strtotime($date . ' + ' . $listing['validity'] . ' days')); ?></td>
                                                            </tr>
                                                    <?php  }
                                                    }?>
                                                    <!-- set bundle id just for show side icon-->

                                           

                                                    <!--  history -->

                                                    <?php if (!empty($membership_history)) {
                                                        $flag = false ;
                                                        foreach ($membership_history as $history) { ?>
                                                            <tr <?php if(!$flag) { echo 'class="bg-warning"'; $flag= true ;} ?>>

                                                                <td><a><?php echo $history['name']; ?></a></td>
                                                                <td>$ <?php echo $history['amount']; ?></td>
                                                                <td><?php
                                                                    $index = array_search($history['prev_plan_id'], array_column($all_plans, 'id'));
                                                                    if (is_numeric($index)) {
                                                                        echo $all_plans[$index]['name'];
                                                                    }else echo " -  "; ?>
                                                                </td>
                                                                <td>$<?php echo !empty($history['adjusted_amount']) ? $history['adjusted_amount'] : 0 ?></td>
                                                                <td><?php echo $history['start_date']; ?></td>
                                                                <td><?php echo date('Y-m-d', strtotime($history['start_date'] . ' + ' . $history['validity'] . ' days')); ?></td>
                                                            </tr>

                                                    <?php }
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- End Listing -->

                                        <!-- Pagination -->
                                        <div class="clearfix"></div>
                                        <div class="pagination-container margin-top-40 margin-bottom-10 centerButtons">
                                            <nav class="pagination solutions_listings_pagination_a">
                                                <ul>
                                                    <?php if (isset($links)) {
                                                        echo $links;
                                                    }
                                                    ?>
                                                </ul>
                                            </nav>
                                        </div>
                                        <!-- Pagination / End -->

                                    </div>
                                    <!--  content / end  -->

                                </div>
                                <!-- body_content / end -->
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

    </div>
    <!-- Wrapper / End -->

    <?php $this->load->view('main/includes/footerscripts'); ?>
    <!-----------------Common Models -------------------------------------------------------------------------------->
    <?php $this->load->view('admin/includes/models'); ?>
    <!--------------------------------------------------------------------------------------------------------------->
    <script>
        loadListingsData('');
    </script>
    <!--------------------------------------------------------------------------------------------------------------->


</body>

</html>