<section>
    <div class="row image_slider standar_course_slider_a">
        <div class="container p-0">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">

                        <div class="page-banner">
                                <div>
                                    <div class="aboutpara_text">
                                        <p>Training & Resource</p>
                                    </div>
                                    <div class="blogslider_title">
                                        <h2>We offer over 100 courses across <br> the spectrum of entrepreneurship,<br>
                                        and we add more every month.</h2>
                                    </div>
                                   
                                </div>
                            </div>
                        <img class="d-block w-100" src="<?php echo site_url('assets/img/courses_banner.jpg'); ?>" alt="First slide">
                    </div>
                    
                   
                </div>
            </div>

        </div>
    </div>
</section>


<section>
<?php if (isset($data['records'])) : ?>
    
        <div class="container p-0">
            <div class="standar_course" id="courses">
                <div class="row">
            <div class="course_title">
                <div class="title_bar"></div>
                <h2>Standard Courses</h2>
            </div>
        </div>
        <div class="row">
            <?php $i = 1; foreach ($data['records'] as $record) : ?>
                <div class="col-md-3 col-sm-6">
                    <a href="<?php echo site_url('course-detail/' . $record['slug']); ?>">
                        <div class="course_box">
                            <div class="card border-0">
                                <div class="card-header p-0">
                                    <div class="top_border"></div>
                                    <?php
                                    $img_url = base_url().BLOG_UPLOAD.'banner-10.jpg';
                                    if(isset($record['image'])){
                                        $img_url = FCPATH.COURSE_IMAGE.$record['image'];  
                                        
                                        if(fileExists($img_url)) {
                                            
                                            $img_url = base_url().COURSE_IMAGE.$record['image'];  
                                        } else {
                                            $img_url = base_url().BLOG_UPLOAD.'banner-10.jpg';
                                        }
                                    } else {
                                        $img_url = base_url().BLOG_UPLOAD.'banner-10.jpg';
                                    }
                                    ?>
                                    <img class="card-img-top w-100 offer_we_image_a square-thumb" src="<?php echo $img_url;  ?>" alt="image">
                                </div>
                                <div class="body_footer_course">
                                    <div class="card-body">
                                        <h5><?php echo $record['name']; ?></h5>
                                    </div>
                                    <div class="card-footer bg-none">By : bebiggy</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php if($i % 4 == 0): ?>
                    <div class="clearfix"></div>
                <?php endif; ?>
            <?php $i++; endforeach; ?>
        </div>
        </div>
    </div>
    <div class="row pagination_div main_standardcourses_a">
        <div class="container">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center" style="margin:20px 0">
                    <?php echo $links;  ?>
                </ul>
            </nav>
        </div>
    </div>
    <?php else : ?>
        <div class="row standar_course Comming_soon_a">
            <div class="container p-0">
                <div class="course_title">
                    <div class="title_bar"></div>
                    <h2>Comming soon...</h2>
                </div>
            </div>
        </div>
    <?php endif; ?>
</section>