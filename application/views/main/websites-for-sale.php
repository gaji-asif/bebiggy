<section class="slider_section pb-0 business_slider_div website_for_sale_it_a">
    <div class="container">
        <div class="row image_slider">
            <div class="col-12 ">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="page-banner">
                                <div>
                                    <div class="aboutpara_text">

                                        <p class="about_desktop_view websites_desktop_view_a"> <?php echo $this->lang->line('uppercase_site_name'); ?> Offers Profitable Turnkey Shopify <br> Dropship Websites & Drop Shipping Businesses <br> For Sale</p>
                                    </div>
                                    <div class="aboutpara_text website_for_salemobiletext_a">

                                        <p class="about_mobile_view"> <?php echo $this->lang->line('uppercase_site_name'); ?> Offers Profitable Turnkey Shopify Dropship Websites & Drop Shipping Businesses For Sale</p>
                                    </div>
                                    <div class="blogslider_title about_page_title_a">

                                        <h2 class="about_desktop_title_a">Buy Best Shopify Stores <br />For Sale</h2>
                                    </div>
                                    <div class="about_page_title_a website_for_salemobileheading_a">
                                        <h2 class="about_mobile_title">Buy Best Shopify Stores For Sale</h2>
                                    </div>
                                    <div class="website_start_now_a websites_start_btn_a">
                                        <a href="#shopify-stores"><span>Start Now</span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                            <img class="d-block w-100" src="<?php echo site_url('assets/img/website-for-sale.png'); ?>" alt="First slide">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container desktop_padding text-center">
        <div class="">
            <p class="gl p-highlight2">Don’t miss out on the latest eCommerce trends and new online business ideas! Sign up for our weekly newsletter here:</p>
        </div>
    </div>



</section>
<section class="shopify_get_started_setion_a">
    <div class="container text-center">
        <div class="row">
            <div class="col-12">
                <div class="shopify_get_started_a">
                    <h2>How To Get Started With a Shopify Dropshipping Website</h2>
                    <p class="gl">Start your dream business today, it’s really easy to get <br>started.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="start_widgets">
                    <div>
                        <span class="cg">1.</span>
                        <p>Browse our range of stores and buy online</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="start_widgets">
                    <div>
                        <span class="cg">2.</span>
                        <p>You will receive access details to your store.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="start_widgets">
                    <div>
                        <span class="cg">3.</span>
                        <p>Start Selling!</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

</section>
<section class="dark_gry py-4"  >
    <div class="container">
        <div class="simply row_shopfy_a">
            <h3 class="ar">Each store is ready to run out of the box. Simply market your website and start selling
                to make profits from day one. If you need help, we have your back covered with unlimited support as
                long as you need it.

            </h3>
        </div>
    </div>
</section>
<section id="shopify-stores">

    <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
    <!-- Feature Listing website -->

    <?php
    if (!empty($featuredWebsite)) {
        $common_listing = $featuredWebsite;
        if(!empty($common_listing[0]['id'])){
    ?>
            <section id="featured_buy_shopify_a" class="website_lastfor_sale_a">
                <div class="row ecommerce_div">
                    <div class="container">
                        <div class="title_ecommerce eCommerce_website_title_a">
                            <center>
                                <h2><?php echo $this->lang->line('site_websites'); ?></h2>
                            </center>
                        </div>
                        <div class="row paragraph_ecommerce_websites_a">
                            <div class="col-md-12 col-sm-12">
                                <p class="ecommerce_para_a">
                                    Buy a Shopify Dropshipping Website and start your turnkey online Drop Ship business from only $199! Each Shopify store comes as a fully functioning e-commerce store complete with products from trusted suppliers, payment processing, hosting and more. Ready to get started? Simply choose a Shopify Store from one of many popular niches below and get started today.
                                </p>
                                <p class="ecommerce_para_a"> See our top featured shopify stores for sale!. These ready to go live stores are the most viewed stores offering trending products that are catching attention of shoppers right now. Hurry, our featured stores sell fast. Get 50% Off today!</p>

                                <p class="ecommerce_para_a"> <b>BONUS:</b> Get free access to our online course on how to promote your shopify store and maximise your profits.</p>
                            </div>
                            <div class="col-md-6 col-sm-12">

                            </div>
                        </div>
                        <?php $this->load->view('main/includes/common-lisiting-solution', ['commonData' => $common_listing]); ?>
                        
                    </div>
                </div>
                <div class="container-fluid spacing_issue_btn_a">
                            <div class="row w-100 reload_button_a">
                                <div class="view-btn d-block w-100 text-center">
                                    <div class="btn_allview view_btn">
                                        <a href="<?php echo site_url('product-category/shopify-dropship-websites-for-sale'); ?>" class="btn btn-default d-flex justify-content-between">
                                            <span>View all Featured Shopify Stores & Dropship Ecommerce Websites for Sale </span>
                                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
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
        if(!empty($common_listing[0]['id'])){
    ?>
            <section>
                <div class="row ecommerce_div">
                    <div class="container">
                        <div class="title_ecommerce eCommerce_website_title_a">
                            <center>
                                <h2><?php echo $this->lang->line('site_websites_premium'); ?></h2>
                            </center>
                        </div>
                        <div class="paragraph_ecommerce_websites_a">
                            <p class="ecommerce_para_a">
                                Our premium shopify websites are provided with premium designs and upto 10,000 of pre-loaded products from trusted local suppliers in the USA. There are a wide range of niches to choose from allowing you to start your dream shopify dropship website today!

                            </p>
                            <p class="ecommerce_para_a"><b>BONUS:</b>Free customization and logo design included! </p>
                        </div>

                        <?php $this->load->view('main/includes/common-lisiting-solution', ['commonData' => $common_listing]); ?>

                    </div>
                </div>
                 <div class="container-fluid spacing_issue_btn_a">
                            <div class="row w-100 reload_button_a">
                                <div class="view-btn d-block w-100 text-center">
                                    <div class="btn_allview view_btn">
                                        <a href="<?php echo site_url('product-category/shopify-premium-dropship-websites-for-sale'); ?>" class="btn btn-default d-flex justify-content-between">
                                            <span>View all Premium Shopify Stores & Dropship Ecommerce Websites for Sale </span>
                                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
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
        if(!empty($common_listing[0]['id'])){
    ?>
            <section class="websitefor_sale_latest_a">
                <div class="row ecommerce_div">
                    <div class="container">
                        <div class="title_ecommerce eCommerce_website_title_a">
                            <center>
                                <h2><?php echo $this->lang->line('site_websites_latest'); ?></h2>
                            </center>
                        </div>
                        <p class="ecommerce_para_a">
                            Browse the latest dropship businesses for sale in our portfolio and get the first choice on our newest e-commerce stores. You can have your own ‘ready to run’ Shopify business within 24 hours!
                        </p>
                        <?php $this->load->view('main/includes/common-lisiting-solution', ['commonData' => $common_listing]); ?>

                    </div>
                </div>
                <div class="container-fluid spacing_issue_btn_a">
                            <div class="row w-100 reload_button_a">
                                <div class="view-btn d-block w-100 text-center">
                                    <div class="btn_allview view_btn">
                                        <a href="<?php echo site_url('product-category/shopify-latest-dropship-websites-for-sale'); ?>" class="btn btn-default d-flex justify-content-between">
                                            <span>View all Latest Shopify Stores & Dropship Ecommerce Websites for Sale </span>
                                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    <?php }
    } ?>

    <!-- end:Feature Listing website -->

    </div>

    </div>
    <!-- <div  class="mb-5"></div> -->
</section>