<section class="slider_section pb-0 business_slider_div">
    <div class="container">
        <div class="row image_slider">
            <div class="col-12 ">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="page-banner">
                                <div>
                                    <div class="aboutpara_text">
                                        <p>BUY AN AMAZING SHOPIFY DROPSHIP STORE</p>
                                    </div>
                                    <div class="blogslider_title desktop_view_a">

                                        <h2>Kickstart your Dropshipping <br> Business</h2>
                                    </div>
                                    <div class="blogslider_title mobile_title_a">

                                        <h2>Kickstart your Dropshipping Business</h2>
                                    </div>
                                    <div class="website_start_now_a">
                                       <a href="<?php echo site_url('product-category/shopify-dropship-websites-for-sale') ?>"><span>Regular Shopify Stores</span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
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
        <div class="blogpage_title_a pb-1">
            <p class="gl p-highlight2 shopify_para_start">Browse our range of Premium Shopify Stores for sale connected to USA based Suppliers. Each store is beautifully designed on a premium theme pre loaded with upto 10,000 products from USA based reliable suppliers, all setup for you and ready to go.</p>

        </div>
        <div class="shpify_title_para">
            <h3><b> Start now</b>– Simply choose a Store from one of many popular niches below and get started today!</h3>
        </div>
    </div>



</section>
<section class="shopify_get_started_setion_a">
    <div class="container text-center">
        <div class="row">
            <div class="col-12">
                <div class="shopify_get_started_a">
                    <h2>How To Get Started With a Shopify Dropshipping Website</h2>
                    <p class="gl desktop_view_text">Start your dream business today, it’s really easy to get <br>started.</p>
                    <p class="gl mobile_start_a">Start your dream business today, it’s really easy to get started.</p>
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
                        <p>You will receive access details to your store</p>
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
<section class="dark_gry py-4">
    <div class="container">
        <div class="simply row_shopfy_a">
            <h3 class="ar">Each store is ready to run out of the box. Simply market your website and start selling
                to make profits from day one. If you need help, we have your back covered with unlimited support as
                long as you need it.

            </h3>
        </div>
    </div>
</section>

<section class="premium_sale_last_section mainwebsitesforpremiumsale_a" id="premium-shopfiy-store">
    <div class="container">
        <div class="row drop_pad" >
            <div class="col-12 col-md-12 shopify_category_a">
                <a href="<?php echo site_url('product-category/shopify-dropship-websites-for-sale'); ?>#regular-shopfiy-store" class="new_btn btn_grey">Regular Shopify Stores</a>
                <a href="<?php echo site_url('product-category/shopify-premium-dropship-websites-for-sale');  ?>#premium-shopfiy-store" class="new_btn btn_blue ">Premium Shopify Stores</a>
                <a href="<?php echo site_url('product-category/shopify-latest-dropship-websites-for-sale'); ?>#latest-shopfiy-store" class="new_btn btn_grey">Latest Shopify Stores</a>
            </div>
            <!-- <div class="col-12 col-md-4 ">
                    <div class="dropdown float-right sortt">
                        <button class="btn  dropdown-toggle arial" type="button" id="dropdownMenu2">
                            Default Order
                        </button>
                        <div id="sortBy" class="dropdown-menu arial" aria-labelledby="dropdownMenu2"
                            style="display: none;">
                            <a href="#" class="dropdown-item">High to Low</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">Low to Hight</a>

                        </div>
                    </div>
                    <div class="sort">
                        <p>Sort by:</p>
                    </div>
                </div> -->
        </div>
    </div>
    <?php /*<input type="hidden" name="listing_type" id="listing_type" value="<?php echo $searchtype; ?>">*/ ?>
    <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
    <div id="viewProduct" class="product_section_a">
        <div class="container-fluid px-0" id="solution">
            <div class="row website-sale" id="response_print_here">

                <?php $this->load->view('main/includes/common-lisiting-solution', ['commonData' => $commonData]); ?>

            </div>

        </div>
</section>