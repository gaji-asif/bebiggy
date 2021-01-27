 

    <section>
        <div class="row image_slider slider_image_a">
            <div class="container">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="slider_image_a">
                                <div class="second_slider_text home_page_slider_a">
                                    <h2 class="desktop_view">All You Need To Know About <br>Dropshipping </h2>
                                    <h2 class="mobile_view">All You Need To Know About Dropshipping </h2>
                                    <div class="para_text desktop_view">
                                        <p>Drop shipping is a form of ecommerce online store where a store. Doesn't keep the products it sells in stocks.</p>
                                        
                                    </div>
                                    <div class="para_text mobile_view">
                                        <p>Drop shipping is a form of ecommerce <br> online store where a store doesn't <br> keep the products it sells in stocks.</p>
                                    </div>

                                    <a href="<?php echo site_url('faq-3/what-is-drop-shipping'); ?>"><span>View More Features </span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                </div>
                                <img class="d-block w-100" src="assets/img/first_banner.jpg" alt="First slide">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="slider_image_a">
                            <div class="second_slider_text">
                                <h2 class="desktop_view">How To Quickly Start A Profitable<br />Online Business? </h2>
                                <h2 class="mobile_view">How To Quickly Start A Profitable <br> Online Business? </h2>

                                <a href="<?php echo site_url('faq-3/how-to-start-drop-shipping'); ?>"><span>Learn More </span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                            </div>
                            <img class="d-block w-100" src="assets/img/first_banner.jpg" alt="Second slide">
                        </div>
                        </div>
                        <div class="carousel-item">
                            <div class="slider_image_a">
                            <div class="second_slider_text">
                                <h2 class="desktop_view">How To Make Money Online With<br />Low Risk? </h2>
                                <h2 class="mobile_view">How To Make Money Online <br> With Low Risk?</h2>
                                <a href="<?php echo site_url('faq-3/how-to-make-money-drop-shipping'); ?>"><span>Learn More </span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                            </div>
                            <img class="d-block w-100" src="assets/img/first_banner.jpg" alt="Third slide">
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Feature Listing website -->

    <?php
    if (!empty($featuredWebsite)) {
        $common_listing = $featuredWebsite;
        if (isset($common_listing[0]['id'])) {
    ?>
            <section>
                <div class="row ecommerce_div products_div_a">
                    <div class="container">
                        <div class="title_ecommerce">
                            <center>
                                <h2><?php echo $this->lang->line('site_websites'); ?></h2>
                            </center>
                        </div>
                        <div class="row p-0">
                        <?php $this->load->view('main/includes/common-lisiting-solution', ['commonData' => $common_listing]); ?>
                        </div>
                        <div class="container-fluid spacing_issue_btn_a">
                            <div class="row reload_button_a">
                                <div class="view-btn d-block w-100 text-center">
                                    <div class="btn_allview view_btn">
                                        <a href="<?php echo site_url('product-category/shopify-dropship-websites-for-sale'); ?>" class="btn btn-default d-flex justify-content-between">
                                            <span>View all Featured Shopify Stores & Dropship Ecommerce Websites for Sale </span>
                                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    <?php }
    } ?>

    <!-- end:Feature Listing website -->


    <!-- Premium Listing website -->

    <?php
    if (!empty($premiumWebsites)) {
        $common_listing = $premiumWebsites;
        if (isset($common_listing[0]['id'])) {
    ?>
            <section class="premium_shop_product_a">
                <div class="row ecommerce_div">
                    <div class="container">
                        <div class="title_ecommerce">
                            <center>
                                <h2><?php echo $this->lang->line('site_websites_premium'); ?></h2>
                            </center>
                        </div>
                        <?php $this->load->view('main/includes/common-lisiting-solution', ['commonData' => $common_listing]); ?>
                        <div class="container-fluid spacing_issue_btn_a">
                            <div class="row reload_button_a">
                                <div class="view-btn d-block w-100 text-center">
                                    <div class="btn_allview view_btn">
                                        <a href="<?php echo site_url('product-category/shopify-premium-dropship-websites-for-sale'); ?>" class="btn btn-default d-flex justify-content-between">
                                            <span>View all Premium Shopify Stores & Dropship Ecommerce Websites for Sale </span>
                                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    <?php }
    } ?>

    <!-- end:Feature Listing website -->



    <!-- Feature Listing website -->

    <?php
    if (!empty($latestWebsites)) {
        $common_listing = $latestWebsites;
        if (isset($common_listing[0]['id'])) {

    ?>
            <section class="last_home_page_section_a">
                <div class="row last_div_lastest_shopify_a shopify_product_a">
                    <div class="container">
                        <div class="title_ecommerce">
                            <center>
                                <h2><?php echo $this->lang->line('site_websites_latest'); ?></h2>
                            </center>
                        </div>
                        <?php $this->load->view('main/includes/common-lisiting-solution', ['commonData' => $common_listing]); ?>
                        <div class="container-fluid spacing_issue_btn_a">
                            <div class="row reload_button_a">
                                <div class="view-btn d-block w-100 text-center">
                                    <div class="btn_allview view_btn">
                                        <a href="<?php echo site_url('product-category/shopify-latest-dropship-websites-for-sale'); ?>" class="btn btn-default d-flex justify-content-between">
                                            <span>View all Latest Shopify Stores & Dropship Ecommerce Websites for Sale </span>
                                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    <?php }
    } ?>

    <!-- end:Feature Listing website -->

    <section class="">
        <div class="row money_div pb-5 mobile_money_div_a make_money_div_a">
            <div class="container">
                <div class="title_ecommerce text-center">

                    <h2>Make Money Drop Shipping</h2>

                </div>
                <div class="tabs_money">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home">
                                <img src="assets/img/first_tab.png" class="first_img" style="display: none;">
                                <img src="assets/img/graph.png" class="round img_active " style="display: block;">
                                <div><span class="title_nav">Low Cost</span><br><span class="subtitle">Bigger Net Profit</span></div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu1">
                                <img src="assets/img/flyimage.png" class="first_img">
                                <img src="assets/img/widelogo.png" class="img_active">

                                <div><span class="title_nav">Wide Product Selection</span><br><span class="subtitle">More Customers</span></div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu2">
                                <img src="assets/img/thumb.png" class="first_img">
                                <img src="assets/img/hand.png" class="img_active">
                                <div><span class="title_nav">Easy To Get Started</span><br><span class="subtitle">Sooner To Start Earning</span></div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu3">
                                <img src="assets/img/weight.png" class="first_img">
                                <img src="assets/img/weight_new.png" class="img_active">
                                <div><span class="title_nav">Easy To Scale </span><br><span class="subtitle">There Is No Limit!</span></div>
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="home" class="container tab-pane active"><br>
                            <div class="top_bar"></div>
                            <h3>Low Costs – Bigger Net Profit</h3>
                            <p>With the drop shipping model, you don’t have to purchase a product unless you already made the sale and have been paid by the customer. You don’t have up-front inventory investments or costs of managing a warehouse, which enables you to start your eCommerce business with much less money.</p>
                        </div>
                        <div id="menu1" class="container tab-pane fade"><br>
                            <div class="top_bar"></div>
                            <h3>Wide Product Selection – More Customers</h3>
                            <p>Since you do not have to pre-purchase the products you sell on your dropship website, you can offer a wide selection of products to your customers. Listing many products on your website does not cause any additional costs to you, as long as the supplier has it in stock.</p>
                        </div>
                        <div id="menu2" class="container tab-pane fade"><br>
                            <div class="top_bar"></div>
                            <h3>Easy To Get Started – Sooner To Start Earning</h3>
                            <p>With drop shipping model, you don’t need to build your eCommerce business from scratch. You will get all you need to start your business right away: an ready to go live established brandable website, all the products already filled in and online order system integrated with suppliers.</p>
                        </div>
                        <div id="menu3" class="container tab-pane fade"><br>
                            <div class="top_bar"></div>
                            <h3>Easy To Scale – There Is No Limit!</h3>
                            <p>With a traditional eCommerce business, more sales mean more work for you to manage orders and complete purchases. Running a drop shipping business, most of the work to process orders will be done by product suppliers so you can expand your business and scale easily.</p>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>
    <section class="benefits_div">

        <div class="container p-0 w-100">
            <div class="row pb-5">
                <div class="benefits_title py-5 w-100">
                    <center>
                        <h2>Benefits</h2>
                        <h3>Perks of running a dropship business</h3>
                    </center>
                </div>
                <div class="row icon_text w-100">
                    <div class="col-md-3 col-sm-6">
                        <div class="box_benefits">
                            <img src="assets/img/box_image.png"><br>
                            <p>No need to worry about ordering products, managing stock and tracking inventory.</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="box_benefits">
                            <img src="assets/img/truck_image.png"><br>
                            <p>No need to worry about packing and shipping your orders.</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="box_benefits">
                            <img src="assets/img/girl_image.png"><br>
                            <p>No stress about customer service and handling returns.</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="box_benefits">
                            <img src="assets/img/cutting_icon.png"><br>
                            <p>No costs for managing a warehouses</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="business_sales_div">
        <div class="container p-0">
            <div class="row pb-5 droptrunkey_a">
                <div class="trunkey_section_a px-0">
                    <div class="col-md-8 col-sm-12">
                        <h2 class="turnkey_drop_a">Turnkey Drop Shipping Business For Sale</h2>
                        <h4 class="trukey_para_a">Check out latest additions to our list of profitable turnkey websites for sale.</h4>
                    </div>
                    <div class="col-md-4 col-sm-12 check_now_btn">
                        <a href="<?php echo site_url('websites-for-sale'); ?>" class="btn btn-default check_nowbtn"><span>Check Now</span> <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="dropshipping_div start_youown_shipping_a">
        <div class="container p-0 py-5">
            <div class="row w-100">
                <div class="title_ecommerce w-100">

                    <h2>Start Your Own Dropshipping Store The Easy Way?</h2>

                </div>
                <div class="col-md-12 px-0">
                    <p>Buy E-Commerce Dropshipping Websites for sale and start your own business in just a few clicks. Drop Shipping a product means you don’t keep any stock, the supplier will ship the product direct to your customer for you, allowing you to focus on building your online business. Click below to get started or see our latest offers!</p>
                </div>
                <div class="col-md-12 w-100 text-center">
                    <a href="<?php echo site_url('websites-for-sale'); ?>" class="btn btn-default start_yourown_nowbtn my-4"><span>Get Started</span> <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                </div>

            </div>
        </div>
    </section>

    <section class="need_div">
        <div class="container py-5">
            <div class="row need_know_a">
                <img src="assets/img/top.png" class="image_back">

                <div class="col-md-8 col-sm-12">
                    <h2>Need To Know More ?</h2>
                    <p>Looking for a profitable e-commerce business but don't have time to build it form scratch?<br>
                        Here is a solution. BUY TURNKEY SHOPIFY DROPSHIP STORES & WEBSITES FOR SALES.
                    </p>
                </div>
                <div class="col-md-4 col-sm-12">
                    <a href="<?php echo site_url('faq-3/what-is-drop-shipping'); ?>" class="btn btn-default learn_nowbtn justify-content-between"><span>Learn More</span> <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                </div>

                <img src="assets/img/bottom.png" class="bottomimage_back">

            </div>
        </div>
    </section>

    <section>
        <div class="row start_yourown testimonila_div">
            <img src="assets/img/leftimage.png" class="leftimage">

            <div class="container p-0 py-5">
                <div class="title_ecommerce py-4">
                    <h2>Success Stories</h2>
                </div>
                <div class="col-md-12 px-0 pb-4 success_para">
                    <h3>Don’t just take our word for it – check out what our clients have to say about us.</h3>

                </div>
                <div class="col-md-12 px-0">
                    <div class="owl-carousel success_owl">
                        <div class="item text-center">
                            <p>I learned with BE BIGGY what I could not in my last few years of online study plus I also own a drop shipping business. Their no nonsense approach keeps aside theory. These guys are action focused.</p>
                            <h3 class="py-3">Denice, Bought Pet Supply Website</h3>
                        </div>


                        <div class="item text-center">
                            <p>I took a plunge without giving much thought. Then I realized I have no idea what to do with the site. Kudos to BE BIGGY team, they hold my hand and guided me all the way to successfully running my dropshipping business. Sometimes risks pay off.</p>
                            <h3 class="py-3">Jonathan, Bought Cigar Website</h3>
                        </div>

                        <div class="item text-center">
                            <p>Buying a shopify drop shipping store website from BE BIGGY was the best decision I made in the favor of my business. I got up and running within few hours of my purchase.</p>
                            <h3 class="py-3">Maja, Bought Jewelry Website</h3>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>


    <section>
        <div class="row get_started pt-5 pb-3 dropshipping_getstarted_a">
            <div class="container p-0">
                <div class="title_ecommerce pb-3">
                    <h2>How To Get Started With Your Dropshipping Business</h2>
                </div>
                <div class="col-md-12 px-0 get_started_paraa">

                    <h4>Start your dream dropshipping e-commerce business today, it’s really easy to get started.</h4>

                </div>
                <div class="col-md-12 py-4 box_div px-0">
                    <div class="col-md-4 col-sm-12">
                        <div class="box_shadow">
                            <div class="box_get_started">
                                <h2>1.</h2>

                                <p>Browse our range of drop ship websites and buy online.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="box_shadow">
                            <div class="box_get_started">
                                <h2>2.</h2>

                                <p>You will receive access details to your new business</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="box_shadow">
                            <div class="box_get_started">
                                <h2>3.</h2>

                                <p>Start Selling!</p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="clearfix"></div>
                <div class="col-md-12 each_div py-4 mt-4">
                    <p>Each e-commerce website is ready to run out of the box. Simply advertise your website and start selling to make profits from day one. If you need help, we have a range of guides and provide a video course to help you along the way to a profitable e-commerce store.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <section class="get_started pb-5 pt-4 blog_section_a">

        <div class="container p-0">
            <div class="row">
                <div class="pb-3 w-100">
                    <h2>Latest On Blog</h2>
                </div>
                <div class="col-md-12 py-4 box_div px-0">
                    <?php
                    foreach ($blogs as $key => $post) {
                    ?>
                        <div class="col-md-4 col-sm-12">
                            <div class="blog">
                                <?php

                                $img_url = base_url() . BLOG_UPLOAD . 'banner-10.jpg';
                                if (isset($post['thumbnail'])) {
                                    $img_url = FCPATH . BLOG_UPLOAD . $post['thumbnail'];

                                    if (fileExists($img_url)) {

                                        $img_url = base_url() . BLOG_UPLOAD . $post['thumbnail'];
                                    } else {
                                        $img_url = base_url() . BLOG_UPLOAD . 'banner-10.jpg';
                                    }
                                } else {
                                    $img_url = base_url() . BLOG_UPLOAD . 'banner-10.jpg';
                                }
                                ?>
                                <img src="<?php echo $img_url; ?>" class="rounded">
                            </div>
                            <div class="blog_title text-left py-2">
                                <h3><?php if (isset($post['title'])) echo $post['title']; ?></h3>
                            </div>
                            <div class="read_more text-left">
                                <a href="<?php echo base_url() . 'blog/' . $post['slug'] ?>"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>

            </div>

            <div class="view-btn d-block w-100 text-center">
                <div class="btn_allview view_btn mobile_view_btn_blog_a">
                    <a href="<?php echo site_url('blog'); ?>" class="btn btn-default d-flex justify-content-between">
                        <span>View All</span>
                        <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                </div>

            </div>

        </div>
    </section>