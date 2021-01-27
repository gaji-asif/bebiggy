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

                                        <p>Buy An Amazing Shopigy Dropship Store</p>
                                    </div>
                                    <div class="blogslider_title">
                                        <h2>Kickstart Your Dropshipping <br>Business</h2>
                                    </div>
                                    <div class="btn_kickstart_a regular_text">
                                        <a href="<?php echo site_url('product-category/shopify-dropship-websites-for-sale');  ?>"><span>Regular Shopify Stores</span><i class=" fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                        <a href="<?php echo site_url('product-category/shopify-premium-dropship-websites-for-sale'); ?>"><span>Premium Shopify Stores</span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
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
            <p class="gl p-highlight2 shopify_para_start">Start selling with your own Shopify Store today. Each store is provided with a great design complete with top selling and top rated products from top rated &amp; reliable suppliers, all setup for you and ready to go.</p>

        </div>
        <div class="shpify_title_para">
            <h3>To get started, simply choose a website from one of many <br>popular niches below</h3>
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
                <div class="start_widgets dropshipping_website_a">
                    <div>
                        <span class="cg">1.</span>
                        <p>Browse our range of stores and buy online</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="start_widgets dropshipping_website_a">
                    <div>
                        <span class="cg">2.</span>
                        <p>You will receive access details to your store</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="start_widgets dropshipping_website_a">
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


<section class="shopifydomain_lastsection_a shopifydomainlastsection_aa" id="regular-shopfiy-store">
<div class="container">
        <div class="row drop_pad">
        <div class="col-12 col-md-12 mt-5 tabs_products_a_websites_for_sale">
                <a href="<?php echo site_url('product-category/shopify-dropship-websites-for-sale'); ?>#regular-shopfiy-store" class="new_btn btn_blue">Regular Shopify Stores</a>
                <a href="<?php echo site_url('product-category/shopify-premium-dropship-websites-for-sale');  ?>#premium-shopfiy-store" class="new_btn btn_grey ">Premium Shopify Stores</a>
                <a href="<?php echo site_url('product-category/shopify-latest-dropship-websites-for-sale'); ?>#latest-shopfiy-store" class="new_btn btn_grey">Latest Shopify Stores</a>
            </div>
        </div>
    </div>

    <?php /*<input type="hidden" name="listing_type" id="listing_type" value="<?php echo $searchtype; ?>">*/ ?>
    <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
    <div id="viewProduct" class="productsection_a">
        <!-- start:ajax -->
        <div class="container-fluid px-0" id="solution">
            <div class="row website-sale" id="response_print_here">

                <?php $this->load->view('main/includes/common-lisiting-solution', ['commonData' => @$commonData]); ?>

            </div>

        </div>
</section>