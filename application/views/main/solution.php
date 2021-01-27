<section class="slider_section pb-0 business_slider_div">
    <div class="container">
        <div class="row image_slider">
            <div class="col-12 ">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="page-banner solution_page_a">
                                <div>
                                    <div class="aboutpara_text">
                                        <p>Kickstart Your Dropshipping Business</p>
                                    </div>
                                    <div class="blogslider_title">

                                        <h2>Buy An Amazing Shopify <br />Dropship Store</h2>
                                    </div>
                                    <div class="btn_kickstart_a">
                                    <a href="<?php echo site_url('product-category/shopify-dropship-websites-for-sale'); ?>#regular-shopfiy-store" class="first_btn"><span>Regular Shopify Stores</span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                        <a href="<?php echo site_url('product-category/shopify-premium-dropship-websites-for-sale');  ?>#premium-shopfiy-store" class="second_btn"><span>Premium Shopify Stores</span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
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

<!-- <section class="shopify_get_started_setion_a">
    <div class="container text-center">
        <div class="row">
            <div class="col-12">
                <div class="shopify_get_started_a">
                    <h2>Fed-up of filter apps?</h2>
                    <p>Add my Advanced Shopify Collection Filters to your Shopify theme today!</p>

                </div>
                <div class="paragraph_text_fed-up">
                    <p class="gl">These powerful filters offer a super-fast user experience by using existing Shopify technology. Best of all? Simply add prefix tags to your products and select the filters you’d like to show on your collection pages from your theme settings. You can add as many filters as you like and can change the display order to meet your requirements. You can even restrict certain options.</p>
                </div>
            </div>
        </div>
        <div class="row steps_feb_up_a">
            <div class="col-md-3 col-sm-12">
                <div class="start_widgets fed_up_steps_as">
                    <div>
                        <span class="cg">1.</span>
                        <p>Filter by color</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="start_widgets fed_up_steps_as">
                    <div>
                        <span class="cg">2.</span>
                        <p>Filter by size</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="start_widgets fed_up_steps_as">
                    <div>
                        <span class="cg">3.</span>
                        <p>Filter by style</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="start_widgets fed_up_steps_as">
                    <div>
                        <span class="cg">4.</span>
                        <p>Filter by type</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

</section>
<section class="dark_gry py-4 customer_paragraphe_a">
    <div class="container">
        <div class="simply">
            <h3 class="ar">As the customer interacts with these advanced filters, options will be removed to prevent the customer from ever seeing a collection page with no products.
                I will install these filters and ensure they match your theme’s existing styling!

            </h3>
        </div>
    </div>
</section> -->

<section class="solution_last_section solution_lisitng_a_lastdiv_a">

    <?php /*<input type="hidden" name="listing_type" id="listing_type" value="<?php echo $searchtype; ?>">*/ ?>
    <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
    <div id="viewProduct">
        <!-- start:ajax -->
        <div class="container-fluid p-0 ecommerce_div">
            <div class="row website-sale" id="solution">
                <?php $this->load->view('main/includes/common-lisiting-solution', ['commonData' => $commonData]); ?>

            </div>

        </div>
</section>