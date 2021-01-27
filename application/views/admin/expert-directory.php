<!DOCTYPE html>
<html lang="en">

<head>

    <!--Admin Page Meta Tags-->
    <title>Expert-Directory | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
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
            <?php $this->load->view('admin/includes/sidebar'); ?>
            <!--------------------------------------------------------------------------------------------------------------->
            <div class="dashboard-content-container" data-simplebar>
                <div class="dashboard-content-inner">

                    <!-- Dashboard Headline -->
                    <div class="dashboard-headline">

                        <div class="dashboad_table">
                            <i class="mdi mdi-image-area-close"></i>
                            <h3>Expert Directory</h3>
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
                            <li>Expert Directory</li>
                        </ul>
                    </nav>

                    <!-- Row -->
                    <div class="row">

                        <!-- Dashboard Box -->
                        <div class="col-xl-12">
                            <div class="dashboard-box margin-top-0">

                                <!-- Headline -->
                                <div class="headline">
                                    <h3><i class="icon-material-outline-assignment"></i>Expert Directory</h3>
                                </div>
                                <div class="col-xl-12">
                                    <input type="text" name="search" id="expertSearch_admin" placeholder="Search">
                                </div>
                                <?php

                                if ($this->session->flashdata('sussess_listing')) {
                                    echo '<div class="alert alert-success">';
                                    echo   $this->session->set_flashdata('sussess_listing');
                                    echo '</div>';
                                }

                                ?>
                                <div id="body_content">

                                <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                                    <div class="content">

                                        <div class="table-responsive solutions_listings">
                                            <table class="table table-head-fixed table-border table-hover table-striped table-condensed">
                                                <thead>
                                                    <tr>
                                                        <th><a href="javascript:void(0);" class="tblMnu">Public Name</a></th>
                                                        <th><a href="javascript:void(0);" class="tblMnu">Type</a></th>
                                                        <th><a href="javascript:void(0);" class="tblMnu">Solution Category</a></th>
                                                        <th><a href="javascript:void(0);" class="tblMnu">Rate</a></th>
                                                        <th><a href="javascript:void(0);" class="tblMnu">Date</a></th>
                                                        <th><a href="javascript:void(0);" class="tblMnu">Status</a></th>
                                                        <th><a href="javascript:void(0);" class="tblMnu">Action</a></th>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($experts)) {
                                                        foreach ($experts as $listing) { ?>

                                                            <tr>
                                                                <td><a href='javascript:void(0);' data-sid="<?php echo $listing['id']; ?>" data-name="<?php echo $listing['profile_name']; ?>" class=""><?php echo $listing['profile_name']; ?></a></td>
                                                                <td><?php echo $listing['type'] ?? ''; ?></td>
                                                                <td><?php echo $listing['solution_category'] ?? ''; ?></td>
                                                                <td><?php echo $listing['rate'] ?? ''; ?></td>
                                                                <td>
                                                                    <?php
                                                                    $listing['created_date']  = $listing['created_date'] ?? '';
                                                                    $dt = new DateTime($listing['created_date']);
                                                                    echo $dt->format('Y-m-d');
                                                                    ?>

                                                                </td>
                                                                <td>
                                                                    <?php if ($listing['admin_approved'] == 1) : ?>
                                                                        Approved
                                                                    <?php elseif ($listing['admin_approved'] == 2) :  ?>
                                                                        Suspended
                                                                    <?php elseif ($listing['admin_approved'] == 0) :  ?>
                                                                        Approval Pending
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td>
                                                                    <a href='<?php echo site_url('admin/edit-expert/' . $listing['user_id']); ?>' class="solution_edit_icon_a" id="EditSolution" title=" Edit"><i class="fas fa-edit" aria-hidden="true"></i></a>
                                                                    &nbsp;&nbsp;

                                                                    <a href="javascript:void(0);" class="solution_delete_icon_a" id="deleteExpert" data-id="<?php echo $listing['id'] ?>" title="Delete">
                                                                        <i class="fas fa-trash" aria-hidden="true"></i></a>
                                                                </td>
                                                            </tr>
                                                    <?php  }
                                                    } else echo '<li>Sorry !! No Listings are available</li>'; ?>
                                                    <!-- set bundle id just for show side icon-->
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