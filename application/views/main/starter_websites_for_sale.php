<section class="slider_section pb-0">
    <div class="container">
        <div class="row image_slider">
            <div class="col-12 ">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="page-banner">
                                <div>
                                    <div class="aboutpara_text">
                                        <p>BE BIGGY Offers Profitable Turnkey Shopify Dropship Websites <br />& Drop Shipping Businesses for sale</p>
                                    </div>
                                    <div class="blogslider_title">
                                        <h2>BUY BEST SHOPIFY STORES <br />FOR SALE</h2>
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
    <div class="container desktop_padding text-center mt-md-5 mt-sm-4">
        <div class="blogpage_title_a">
            <p class="gl p-highlight2">Don’t miss out on the latest eCommerce trends and new online business ideas! Sign up for our weekly newsletter here:</p>
        </div>
    </div>



</section>
<section class="ligh_gry">
    <div class="container text-center ">
        <div class="row">
            <div class="col-12">
                <div class="get_started ">
                    <h2>How To Get Started With a Shopify Dropshipping Website</h2>
                    <p class="gl mb-5">Start your dream business today, it’s really easy to get <br>started.</p>
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
        <div class="simply">
            <h3 class="ar">Each store is ready to run out of the box. Simply market your website and start selling
                to make profits from day one. If you need help, we have your back covered with unlimited support as
                long as you need it.

            </h3>
        </div>
    </div>
</section>

<section class="last_section">

    <?php /*<input type="hidden" name="listing_type" id="listing_type" value="<?php echo $searchtype; ?>">*/ ?>
    <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
    <div id="viewProduct">
        <!-- start:ajax -->
        <div class="container"  id="solution">
            <div class="row website-sale" id="response_print_here">

            <?php $this->load->view('main/includes/common-lisiting-solution_starter', ['commonData' => $commonData]); ?>

              
            </div>

        </div>
</section>