<!DOCTYPE html>
<html lang="en">

<head>

    <!--Admin Page Meta Tags-->
    <title>Courses | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
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
                            <i class="mdi mdi-pipe"></i>
                            <h3>Courses</h3>
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
                            <li><a href="<?php echo site_url('admin/list_courses') ?>">Courses</a></li>
                        </ul>
                    </nav>


                    <!-- Row -->
                    <div class="row">

                        <!-- Dashboard Box -->
                        <div class="col-xl-12">
                            <div class="dashboard-box margin-top-0">

                                <!----- PAGES ---------------->
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <a href="<?php echo site_url('admin/add_course') ?>" class="btn btn-warning float-right mb-2 editLink">
                                                    Add
                                                </a>

                                                <div class=" table-responsive">
                                                    <table class="table table-striped table-hover table-condensed">
                                                        <thead>
                                                            <tr>
                                                                <th><a href="javascript:void(0)" class="topMenu" id="id">ID </a></th>
                                                                <th><a href="javascript:void(0)" class="topMenu" id="name">COURSE NAME </a></th>
                                                                <th><a href="javascript:void(0)" class="topMenu" id="validity">PRICE </a></th>
                                                                <th><a href="javascript:void(0)" class="topMenu" id="validity">LESSONS </a></th>
                                                                <th><a href="javascript:void(0)" class="topMenu" id="action">STATUS </a></th>
                                                                <th colspan="2"><a href="javascript:void(0)" class="topMenu" id="action">ACTION </a></th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php if (isset($records) && !empty($records)) : ?>
                                                                <?php foreach ($records as $record) : ?>
                                                                    <tr>
                                                                        <td><?php echo $record['id']; ?> </td>
                                                                        <td><?php echo _str_limit($record['name']);  ?></td>
                                                                        <td><?php echo $record['price'] ?></td>
                                                                        <td><a href="<?php echo site_url('admin/view_lession/') . $record['id']; ?>" data-id=" 12" class="pr-2">
                                                                                <?php echo $record['lession_count'] ?>
                                                                            </a>
                                                                        </td>
                                                                        <td><?php echo ($record['status'] == 1) ? 'Active' : 'InActive';  ?></td>
                                                                        <td><a href="<?php echo site_url('admin/add_course/') . $record['id']; ?>" class="pr-2" data-id="<?php echo $record['id']; ?>"><i title="edit" class="fas fa-edit" aria-hidden="true"></i></a>
                                                                        
                                                                        <a href="javascript:void(0)" class="pl-2 deleteCourse" data-name="<?php echo _str_limit($record['name']);  ?>"  data-id="<?php echo $record['id']; ?>" data-url='admin/delete_course'  ><i title="delete" class="fas fa-trash" aria-hidden="true"></i></a>

                                                                        
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                            <?php else : ?>
                                                                <tr>
                                                                    <td><?php echo "Record is not found." ?></td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- Pagination -->
                                        <div class="clearfix"></div>
                                        <div class="pagination-container margin-top-40 margin-bottom-10 centerButtons">
                                            <nav class="pagination">
                                                <ul>
                                                    <?php echo $links; ?>
                                                </ul>
                                            </nav>
                                        </div>
                                        <div class="clearfix"></div>
                                        <!-- Pagination / End -->

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!----- /PAGES ---------------->

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

    <!-----------------Common Models -------------------------------------------------------------------------------->
    <?php $this->load->view('admin/includes/models'); ?>
    <!--------------------------------------------------------------------------------------------------------------->
    <?php $this->load->view('main/includes/footerscripts'); ?>
    <script>
        loadListingsData('');
    </script>
    <!--------------------------------------------------------------------------------------------------------------->


</body>

</html>