<!DOCTYPE html>
<html lang="en">

<head>

    <!--Admin Page Meta Tags-->
    <title><?php echo isset($pageHeader) ? $pageHeader : '' ?> | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
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
                            <h3><?php echo isset($pageHeader) ? $pageHeader : '' ?> </h3>
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

                        <!-- Breadcrumbs -->
                        <nav id="breadcrumbs" class="dark">
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li><a href="<?php echo site_url('admin/list_courses') ?>">Courses</a></li>
                                <li><a href="<?php echo site_url('admin/view_lession/') . $this->uri->segment(3); ?>">Lessons</a></li>
                                <li><a href="#"><?php echo isset($pageHeader) ? $pageHeader : '' ?> </a></li>
                            </ul>
                        </nav>
                    </div>
                    <!-- Headline -->

                    <!-- Row -->
                    <div class="row">
                        <?php if (!empty($records[0])) extract($records[0]); ?>
                        <!-- Dashboard Box -->
                        <div class="col-xl-12">
                            <div class="dashboard-box margin-top-0">
                                <!-- Headline -->
                                <div class="headline d-flex justify-content-between">
                                    <h3> Lesson Manager</h3>

                                    <h3 class="float-right"><a href="javascript:void(0)">Course Name : </a><?php if (isset($course['name'])) echo _str_limit($course['name']);
                                                                                                            else ''; ?></h3>
                                    <!-- <h3 class="float-right"><a href="javascript:void(0)">Lesson Number : </a><?php if (isset($course['lession_count'])) ($course['lession_count'] + 1);
                                                                                                                    else '1'; ?></h3> -->
                                </div>
                                <form id="addLessionForm" method="post" action="<?php echo site_url('admin/add_lession'); ?>" enctype="multipart/form-data" novalidate>
                                    <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="submit-field">
                                                        <h5>Lesson Name</h5>
                                                        <input type="text" class="with-border" id="course_name" name="lession_name" placeholder="Lesson Name" maxlength="50" required="true" value="<?php echo isset($name) ? $name : ''; ?>">
                                                        <input type="hidden" id="lesson_id" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
                                                        <input type="hidden" id="course_id" name="course_id" value="<?php echo isset($course_id) ? $course_id : ''; ?>">
                                                        <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                                                    </div>
                                                </div>

                                                <div class="col-xl-12">
                                                    <div class="submit-field">
                                                        <h5>Description</h5>
                                                        <textarea rows="8" class="form-control" cols="60" name="lession_description" id="" required="true"><?php echo isset($description) ? $description : ''; ?></textarea>

                                                    </div>
                                                </div>


                                                <div class="col-xl-8">
                                                    <div class="submit-field">
                                                        <h5>Vimeo URL <span>(Important)</span> <i class="help-icon" data-tippy-placement="right" title="Sample URL : <br>https://vimeo.com/channels/staffpicks/272053388<br>
https://vimeo.com/272053388<br>
https://player.vimeo.com/video/272053388"></i></h5>
                                                        <input type="text" class="with-border" id="vimeo_id" name="vimeo_id" placeholder="Vimeo ID" required="true" value="<?php echo isset($vimeo_id) ? $vimeo_id : ''; ?>">

                                                    </div>
                                                </div>

                                                <div class="col-xl-4">
                                                    <div class="submit-field">
                                                        <h5>Status</h5>
                                                        <select name="status" id="" class="with-border" required="true">
                                                            <?php if (STATUS != null && !empty(STATUS)) :  ?>
                                                                <?php foreach (STATUS as $key => $value) : ?>
                                                                    <?php $select = "";
                                                                    if (isset($status)) {
                                                                        if ($status == $key) {
                                                                            $select = "selected";
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <option value="<?php echo $key; ?>" <?php echo $select ?>><?php echo $value; ?></option>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <?php if (isset($courses['id'])) { ?>
                                                    <button type="submit" name="updateCourse" class="btn btn-success mr-2 btntheme_color_a ">Update</button>
                                                <?php } else { ?>
                                                    <button type="submit" name="addCourse" class="btn btn-success mr-2 btntheme_color_a">Save</button>
                                                <?php } ?>
                                                <a href="<?php echo site_url('admin/view_lession/') . $course_id;  ?>" class="btn btn-success mr-2 theme_btn">CANCEL</a>
                                            </div>
                                            <!--------/row------->
                                        </div>
                                    </div>
                                </form>
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