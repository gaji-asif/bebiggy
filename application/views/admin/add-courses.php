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
    <style>
        select.form-control:not([size]):not([multiple]) {
            height: 36px !important;
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
                            <i class="mdi mdi-book"></i>
                            <h3><?php echo isset($pageHeader) ? $pageHeader : '' ?></h3>
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
                            <li><a href="#"><?php echo isset($pageHeader) ? $pageHeader : '' ?></a></li>
                        </ul>
                    </nav>

                    <!-- Headline -->

                    <!-- Row -->
                    <div class="row">
                        <!-- Dashboard Box -->
                        <div class="col-xl-12">
                            <div class="dashboard-box margin-top-0 edit_course">
                                <!-- Headline -->
                                <div class="headline">
                                    <h3><?php echo isset($pageHeader) ? $pageHeader : '' ?> Manager</h3>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <form id="addCourseForm" method="post" action="<?php echo site_url('admin/add_course'); ?>" enctype="multipart/form-data" novalidate>
                                            <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="submit-field">
                                                        <h4>Course Name</h4>
                                                        <input type="text" class="with-border solution_name" id="course_name" maxlength="200" name="course_name" placeholder="Course Name" required="true" value="<?php echo isset($courses['name']) ? $courses['name'] : ''; ?>">
                                                        <input type="hidden" class="form-control" id="course_id" name="course_id" value="<?php echo isset($courses['id']) ? $courses['id'] : ''; ?>">
                                                        <span class="helper-text">max length is 200 character</span>

                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="submit-field">
                                                        <h4>Slug</h4>
                                                        <input type="text" name="slug" maxlength="200"  class="form-control solution_name" id="txt_course_url_slug" placeholder="Enter Slug" required value="<?php echo $courses['slug'] ?? '' ?>">
                                                        <span class="helper-text">max length is 200 character</span>
                                                    </div>
                                                </div>
                                               

                                                <div class="col-xl-6">
                                                    <div class="submit-field">
                                                        <h4 for="category_course">Course Category</h4>
                                                        <select name="course_category_id" id="" class="with-border" required="true">
                                                            <option value="">Select Category</option>
                                                            <?php if (isset($courseCategories) && !empty($courseCategories)) :  ?>
                                                                <?php foreach ($courseCategories as $courseCategory) : ?>
                                                                    <?php $select = "";
                                                                    if ($courses['course_category_id'] == $courseCategory['id']) {
                                                                        $select = "selected";
                                                                    }
                                                                    ?>
                                                                    <option value="<?php echo $courseCategory['id']; ?>" <?php echo $select; ?>><?php echo $courseCategory['name'] ?></option>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6">
                                                    <div class="submit-field">
                                                        <h4 for="Course_Type">Course Type</h4>
                                                        <select name="course_type" id="" class="with-border" required="true">
                                                            <option value="">Select Type</option>

                                                            <?php foreach (COURSE_TYPE as $key => $value) {

                                                                $select = "";
                                                            if(isset($courses['course_type']) && !empty($courses['course_type'])){
                                                                if ($courses['course_type'] == $key) {
                                                                    $select = "selected";
                                                                }
                                                            }

                                                                echo "<option value='$key' $select >$value</option>";
                                                            } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6">
                                                    <div class="submit-field">
                                                        <h4 for="Status">Status</h4>
                                                        <select name="status" id="" class="with-border" required="true">
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
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="submit-field">
                                                        <h4 for="price">Price</h4>
                                                        <input type="text" class="with-border numeric_validation" maxlength="5" id="price" onkeypress='validateInputNumbers(event)' name="price" placeholder="Price" required="true" value="<?php echo isset($courses['price']) ? $courses['price'] : ''; ?>">

                                                    </div>
                                                </div>
                                               
                                                <div class="col-xl-12">
                                                    <div class="submit-field">
                                                        <h4>Description<span>(Important)</span> <i class="help-icon" data-tippy-placement="right" title="Be Descriptive. Add everything you think which is important"></i></h4>
														<textarea id="tiny-editor" name="description" rows="5" cols="60" class="form-control"><?php echo $courses['description'] ?? '' ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-12">
													<div class="submit-field">

														<h5 for="price" class="post_title"> Title </h5>
														<input type="text" name="metatitle" class="form-control" id="metatitle" placeholder="Enter title"  value="<?php echo $courses['site_title'] ?? '' ?>">

													</div>
												</div>
												<div class="col-md-6 col-sm-12">
													<div class="submit-field">
														<h5>Meta Description  </h5>
														<textarea id="metadescription" name="metadescription" rows="3" cols="60" class=" with-border"><?php echo $courses['site_metadescription'] ?? '' ?></textarea>
													</div>
												</div>

												<div class="col-md-6 col-sm-12">
													<div class="submit-field">
														<h5>Meta Keywords<span>(important)</span> <i class="help-icon" data-tippy-placement="right" title="Seperate each word by a ,"></i> </h5>
														<textarea id="metakeywords" name="metakeywords" rows="3" cols="60" class=" with-border"><?php echo $courses['site_keywords'] ?? '' ?></textarea>
													</div>
												</div>
                                                
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="submit-field">
                                                        <h5>Page Tags</h5>
                                                        <input type="text" id="page_tags" name="page_tags" value="<?php if (isset($courses['page_tags'])) echo $courses['page_tags'];  ?>" class="form-control" placeholder="Put comma separated tags" />
                                                    </div>
                                                </div>

<!-- 
                                                <div class="col-xl-6">
                                                    <div class="submit-field">
                                                        <h4 for="Membership_Level">Membership Level (<small> mulitple</small>)</h4>
                                                        <select name="membership_level_id[]" id="" class="with-border js-example-basic-multiple" required="true" multiple style="height:100px">
                                                            <?php if (isset($membershipLevels) && !empty($membershipLevels)) :  ?>
                                                                <?php foreach ($membershipLevels as $membershipLevel) : ?>
                                                                    <?php $select = "";
                                                                    if (!empty($courses)) {
                                                                        $membershipId = explode(',', $courses['membership_level_id']);
                                                                        if (in_array($membershipLevel['id'], $membershipId)) {
                                                                            $select = "selected";
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <option value="<?php echo $membershipLevel['id']; ?>" <?php echo $select; ?>><?php echo $membershipLevel['name'] ?></option>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </select>
                                                    </div>
                                                </div> -->
                                                <div class="col-xl-12">
                                                    <div class="submit-field">
                                                        <h4 for="image" class="u_image">Upload Image</h4>
                                                        
                                                        <input type="file" class="with-border up_loadimage addcourse_file_a" id="file" name="uploadCourseImage" accept="image/*">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-xl-12" id="uploadedImageName">

                                                </div>
                                                <div class="col-xl-12">
                                                    <div class="row pl-3 col-xl-3 pb-5">
                                                        <?php if (isset($courses['image'])) : ?>
                                                            <img src="<?php echo base_url() . COURSE_IMAGE . $courses['image']  ?>" alt="">
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <?php if (isset($courses['id'])) { ?>
                                                    <button type="submit" name="updateCourse" class="btn btn-success mr-2 theme_btn">Update</button>
                                                <?php } else { ?>
                                                    <button type="submit" name="addCourse" class="btn btn-success mr-2 theme_btn">Save</button>
                                                <?php } ?>
                                                <a href="<?php echo site_url('admin/list_courses');  ?>" class="btn btn-success mr-2 theme_btn">CANCEL</a>
                                            </div>
                                    </div>
                                    </form>

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
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });

        document.getElementById('file').onchange = function () {
             $('#uploadedImageName').html(this.value);
            };
    </script>
    <!--------------------------------------------------------------------------------------------------------------->


</body>

</html>