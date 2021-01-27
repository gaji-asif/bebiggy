<!DOCTYPE html>
<html lang="en">

<head>

    <!--Admin Page Meta Tags-->
    <title>Course Category | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
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
                           <i class="mdi mdi-book"></i>  <h3>Course Category</h3>
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
                                <li><a href="#">Course Category</a></li>
                            </ul>
                        </nav>
                   

                    <!-- Row -->
                    <div class="row">

                        <!-- Dashboard Box -->
                        <div class="col-xl-12">
                            <div class="dashboard-box margin-top-0 course_category_edit_a">

                                <!----- PAGES ---------------->
                                <div class="row">
                                    <div class="col-xs-24 col-sm-24 col-md-24 col-lg-12 col-xl-12">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <button type="button" class="btn btn-warning float-right mb-2  btntheme_color_a" id="addCourseCategory">
                                                    Add
                                                </button>

                                                <div class=" table-responsive">
                                                    <table class="table table-striped table-hover responsive ">
                                                        <thead>

                                                            <tr>
                                                                <th><a href="javascript:void(0)" class="topMenu" id="id">ID </a></th>
                                                                <th><a href="javascript:void(0)" class="topMenu" id="name">CATEGORY </a></th>
                                                                <th><a href="javascript:void(0)" class="topMenu" id="parent_id">PARENT CATEGORY </a></th>
                                                                <th><a href="javascript:void(0)" class="topMenu" id="status">STATUS</a></th>
                                                                <th><a href="javascript:void(0)" class="topMenu" id="action">ACTION </a></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php if (isset($records) && !empty($records)) : ?>
                                                                <?php foreach ($records as $record) : ?>
                                                                    <tr>
                                                                        <td><?php echo $record['id']; ?> </td>
                                                                        <td><?php echo _str_limit($record['category']);  ?></td>
                                                                        <td><?php if (!empty($record['parent'])) : echo _str_limit($record['parent']);
                                                                            else : echo "N/A";
                                                                            endif; ?></td>
                                                                        <td><?php echo ($record['status'] == 1) ? 'Active' : 'InActive';  ?></td>
                                                                        <td>
                                                                        <a href="javascript:void(0)" data-id="<?php echo $record['id']; ?>" class="course-category-edit"><i title="edit" class="fas fa-edit" aria-hidden="true"></i></a>
                                                                        <a href="javascript:void(0)" data-name="<?php echo _str_limit($record['category']);  ?>" data-id="<?php echo $record['id']; ?>" id="course-category-delete"><i title="delte" class="fas fa-trash pl-3" aria-hidden="true"></i></a>
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


    <!------Admin Category Model------>
    <div class="modal fade" id="course-category" tabindex="-1" role="dialog" aria-labelledby="change-listing" aria-hidden="true">
        <div class="modal-dialog modal-danger modal-dialog-centered modal-lg" role="document">
            <div class="modal-content bg-gradient-danger">
                <div class="modal-header">
                    <h3>Course Category Manager</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="card">
                    <div class="card-body">
                        <!---card--->
                        <div class="modal-body">
                            <form id="CourseCategoryForm" action="<?php echo site_url('admin/course_category'); ?>" method="post" enctype="multipart/form-data" novalidate>
                                <div class="submit-field">
                                    <h5>Course Category Name</h5>
                                    <input type="text" class="with-border category_name" maxlength="30" name="name" placeholder="Course Category Name" required="true">
                                    <input type="hidden" class="form-control" id="course_category_id" name="course_category" value="<?php echo isset($course_category) ? $course_category : '' ?>">
                                </div>

                                <div class="submit-field">
                                    <h5>Status</h5>
                                    <select name="status" class="with-border" id="category_status">
                                        <?php if (STATUS != null && !empty(STATUS)) :  ?>
                                            <?php foreach (STATUS as $key => $value) : ?>
                                                <?php $select = "";
                                                if ($courses['status'] == $key) {
                                                    $select = "selected";
                                                }
                                                ?>
                                                <option value="<?php echo $key; ?>" <?php echo $select ?>><?php echo $value; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>

                                <div class="courseMainCategory">
                                    <div class="submit-field">
                                        <h5>Main Category Solution</h5>
                                        <select name="parent_id" id="course_parent_category" class="with-border">
                                            <option value="0">Optional Select Category</option>
                                            <?php if (!empty($categories)) : ?>
                                                <?php foreach ($categories as $category) : ?>
                                                    <?php echo "<option  value='" . $category['id'] . "'>" . $category['name'] . "</option>";  ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>

                                <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                <button type="submit" name="btn_categorysave" id="btnCourseCategory" class="btn btn-success mr-2 theme_btn">Submit</button>


                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /Admin Category Model -->
    <?php $this->load->view('main/includes/footerscripts'); ?>
    <script>
        loadListingsData('');
    </script>
    <!--------------------------------------------------------------------------------------------------------------->


</body>

</html>