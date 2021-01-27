<!DOCTYPE html>
<html lang="en">

<head>

    <!--Admin Page Meta Tags-->
    <title>Lessons | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
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
                        
                         <div class="dashboard-headline">
                        
                         <div class="dashboad_table">
                           <i class="mdi mdi-book"></i>  <h3>Lessons</h3>
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
                                <li><a href="#">Lessons</a></li>
                            </ul>
                        </nav>
                    

                    <!-- Row -->
                    <div class="row">

                        <!-- Dashboard Box -->
                        <div class="col-xl-12">
                            <div class="dashboard-box margin-top-0">
                                <!-- Headline -->
                                <div class="headline d-flex justify-content-between">
                                    <h3 class="float-right"><a href="javascript:void(0)">Course Name : </a><?php if (isset($course['name'])) echo _str_limit($course['name']);
                                                                                                            else ''; ?></h3>
                                    <h3 class="float-right"><a href="javascript:void(0)">Total Lesson : </a><?php if (isset($course['lession_count'])) echo ($course['lession_count']);else '1'; ?></h3>
                                    <a href="<?php echo site_url('admin/add_lession/') . $course['id']; ?>" data-id=" 12" class="btn btn-warning float-right mb-2 editLink">   Add New Lession</a>
                                </div>

                                <!----- PAGES ---------------->
                                <div class="row">
                                    <div class="col-xs-24 col-sm-24 col-md-24 col-lg-12 col-xl-12">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <div class=" table-responsive">
                                                    <table class="table table-striped table-hover responsive ">
                                                        <thead>
                                                            <tr>
                                                                <th><a href="javascript:void(0)" class="topMenu" id="id">ID </a></th>
                                                                <th><a href="javascript:void(0)" class="topMenu" id="name">LESSON NAME </a></th>
                                                                <th><a href="javascript:void(0)" class="topMenu" id="validity">Vimeo ID </a></th>
                                                                <th><a href="javascript:void(0)" class="topMenu" id="validity">STATUS </a></th>
                                                                <th><a href="javascript:void(0)" class="topMenu" id="validity">FREE VIEW </a></th>
                                                                <th><a href="javascript:void(0)" class="topMenu" id="action">ACTION </a></th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php if (isset($records) && !empty($records)) : ?>
                                                                <?php foreach ($records as $record) : ?>
                                                                    <tr>
                                                                        <td><?php echo $record['id']; ?> </td>
                                                                        <td><?php echo _str_limit($record['name']);  ?></td>
                                                                        <td><?php echo $record['vimeo_id'] ?></td>
                                                                        <td><?php echo ($record['status'] == 1) ? 'Active' : 'InActive';  ?></td>
                                                                        <td>
                                                                        <?php  if($record['free_view'] == 1): ?>        
                                                                        <a href="javascript:void(0)" class="free-view" data-url="<?php echo site_url('admin/free_lesson/') ?>" data-status="<?php echo $record['free_view'] ?>" data-id="<?php echo $record['id']; ?>"><i title="Allowed Free View" class="fas fa-eye" aria-hidden="true"></i></a>
                                                                        <?php else: ?>
                                                                        <a href="javascript:void(0)"  class="free-view" data-url="<?php echo site_url('admin/free_lesson/') ?>"  data-status="<?php echo $record['free_view'] ?>" data-id="<?php echo $record['id']; ?>"><i title="Block Free View" class="fas fa-eye-slash" aria-hidden="true"></i></a>
                                                                        <?php  endif; ?>
                                                                    
                                                                    </td>
                                                                        <td><a href="<?php echo site_url('admin/edit_lession/') . $record['id']; ?>" data-id="<?php echo $record['id']; ?>"><i title="edit" class="fas fa-edit" aria-hidden="true"></i></a>
                                                                        <a href="javascript:void(0)" class="pl-3s" data-name="<?php echo _str_limit($record['name']);  ?>"  data-id="<?php echo $record['id']; ?>" data-url='admin/delete_lesson' id="deleteLesson" ><i title="delete" class="fas fa-trash" aria-hidden="true"></i></a></td>
                                                                    </tr>
                                                                        </td>
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