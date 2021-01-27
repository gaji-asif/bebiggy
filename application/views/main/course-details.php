<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script src="http://a.vimeocdn.com/js/froogaloop2.min.js"></script>


<?php // pre($user_permission , 1);  ?>
<?php if (!empty($records[0])) {
    extract($records[0]); ?>
    <section>
        <div class="row course_detail">
            <div class="container">
                <div class="col-md-12">
                    <div class="col-md-4">

                        <?php
                        $img_url = base_url() . BLOG_UPLOAD . 'banner-10.jpg';
                        if (isset($image)) {
                            $img_url = FCPATH . COURSE_IMAGE . $image;

                            if (fileExists($img_url)) {

                                $img_url = base_url() . COURSE_IMAGE . $image;
                            } else {
                                $img_url = base_url() . BLOG_UPLOAD . 'banner-10.jpg';
                            }
                        } else {
                            $img_url = base_url() . BLOG_UPLOAD . 'banner-10.jpg';
                        }
                        ?>

                        <img src="<?php echo $img_url;  ?>" alt="course-image" class="rounded w-100" />
                    </div>
                    <div class="col-md-8">
                        <div class="price_with_title_a">
                            <div class="title_name_a">
                                <h3><?php echo $name; ?></h3>
                            </div>

                            <div class="category_div">
                                <p>Category : <?php echo COURSE_TYPE[$course_type] ?? ""; ?></p>
                                <p class="by_author_a">By : BEBIGGY</p>
                            </div>
                            <div class="pricedetails_div">
                                <h2><?php echo "$default_currency $price";  ?></h2>
                                <p>Price</p>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="row details_div">
            <div class="container">
                <div class="col-md-12 p-0">
                    <div class="col-md-8">
                        <div class="course_shadow shadow">

                            <div class="coursedetail_title">
                                <div class="course_title_bar"></div>
                                <h3>Description</h3>
                            </div>
                            <p class="first_para">
                                <?php echo  $description ?? "N/A";  ?>
                            </p>
                            <!-- lessons stars -->
                            <div class="course_lesson">
                                <div class="coursedetail_title">
                                    <div class="course_title_bar"></div>
                                    <h3>Course Lessons</h3>
                                </div>

                                <!-- accordance -->
                                <div id="accordion" class="course_details single_course_page_a">
                                    <?php if (!empty($lessons)) :  $index = 0; ?>
                                        <?php foreach ($lessons as $lesson) : ?>
                                            <!-- lesson -->
                                            <div class="card">
                                                <div class="card-header">
                                                    <a class="collapsed card-link d-flex justify-content-between active" data-index="<?php echo $index; ?>" data-toggle="collapse" href="#collapse<?php echo $lesson['id']; ?>">
                                                        <div class="paragraph_text_a">
                                                            <?php echo $lesson['name']; ?>
                                                        </div>
                                                        <i class="fa fa-angle-up" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                                <div id="collapse<?php echo $lesson['id']; ?>"" class=" collapse" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <p><?php echo $lesson['description'];  ?></p>
                                                        <?php if ($lesson['free_view'] != 0) :  ?>
                                                            <div class="deatils_withvideo">
                                                                <div class="deatils_content">
                                                                    <h5 class="post_sql"><?php echo $lesson['name']; ?></h5>

                                                                    <!-- <a href="#">https://bebiggy.com/course/</a> -->
                                                                </div>
                                                                <iframe class="vimeo-player" src="https://player.vimeo.com/video/<?php echo $lesson['vimeo_id'] ?>" width="100%" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                                                            </div>
                                                        <?php else : ?>
                                                            <p class="font-weight-bold"><a href="<?php echo site_url('login'); ?>">Log in</a> to Access the Course <i class="fa fa-eye-slash" aria-hidden="true"></i></p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--- /lesson -->
                                        <?php $index++;
                                        endforeach; ?>
                                    <?php else : ?>
                                        Comming soon...
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!-- End: lessons -->
                        </div>

                        <?php

                                if (isset($course_detail_page_left_side) && is_array($course_detail_page_left_side) && count($course_detail_page_left_side) > 0) {
                                    for ($k = 0; $k < count($course_detail_page_left_side); $k++) {
                                        if (isset($course_detail_page_left_side[$k]) && trim($course_detail_page_left_side[$k]['text_or_icon']) != '') {
                                            $img_url = FCPATH . CATEGORY_IMAGES . "/" . trim($course_detail_page_left_side[$k]['text_or_icon']);
                                            if (fileExists($img_url)) {
                                                $img_url = base_url() . CATEGORY_IMAGES . "/" . trim($course_detail_page_left_side[$k]['text_or_icon']); ?>
                                                <div class="col-md-12 px-0 advertisement_box course_adv_a">
                                                    <img src="<?php echo isset($img_url) ? $img_url : ''; ?>" alt="" title="" />
                                                </div>

                                <?php
                                            }
                                        }
                                    }
                                }
                                ?>

                        


                    </div>
                    <div class="col-md-4">
                        <div class="right_coursedetails">
                            <div class="otherdetail_box">
                                <div class="other_title"></div>
                                <h3>More Courses</h3>
                            </div>
                            <div class="row other_below 1">

                                <!-- show latest courses -->
                                <?php if (!empty($courses)) : ?>
                                    <?php foreach ($courses as $course) : ?>
                                        <a href="<?php echo site_url('course-detail/' . $course['slug']); ?>" class="w-100">
                                            <div class="col-md-12 px-0">
                                                <div class="col-md-3 p-0">

                                                    <?php
                                                    $img_url = base_url() . BLOG_UPLOAD . 'banner-10.jpg';
                                                    if (isset($course['image'])) {
                                                        $img_url = FCPATH . COURSE_IMAGE . $course['image'];

                                                        if (fileExists($img_url)) {

                                                            $img_url = base_url() . COURSE_IMAGE . $course['image'];
                                                        } else {
                                                            $img_url = base_url() . BLOG_UPLOAD . 'banner-10.jpg';
                                                        }
                                                    } else {
                                                        $img_url = base_url() . BLOG_UPLOAD . 'banner-10.jpg';
                                                    }
                                                    ?>
                                                    <img src="<?php echo $img_url; ?>" class="rounded w-100" alt="course-image">


                                                </div>
                                                <div class="col-md-9 pr-0">
                                                    <p><?php echo $course['name'] ?></p>
                                                    <hr class="m-0">
                                                    <p>By : BeBiggy</p>
                                                </div>
                                            </div>
                                        </a>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <!-- /end coures-->


                               <?php
                                if (isset($course_detail_page_right_side) && is_array($course_detail_page_right_side) && count($course_detail_page_right_side) > 0) {

                                    for ($k = 0; $k < count($course_detail_page_right_side); $k++) {

                                        if (isset($course_detail_page_right_side[$k]) && trim($course_detail_page_right_side[$k]['text_or_icon']) != '') {
                                            $img_url = FCPATH . CATEGORY_IMAGES . "/" . trim($course_detail_page_right_side[$k]['text_or_icon']);

                                            if (fileExists($img_url)) {

                                                $img_url = base_url() . CATEGORY_IMAGES . "/" . trim($course_detail_page_right_side[$k]['text_or_icon']); ?>
                                                <div class="col-md-12 px-0 advertisement_box course_adv_a">
                                                    <img src="<?php echo isset($img_url) ? $img_url : ''; ?>" alt="" title="" />
                                                </div>

                                <?php  }
                                        }
                                    }
                                }
                                ?>

                            </div>

                        </div>

                    </div>



                </div>

            </div>
    </section>
<?php } else { ?>

    <h4> No Infomation Found.</h4>

<?php } ?>