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
                                        <p>Kickstart Your Dropshipping Business</p>
                                    </div>
                                    <div class="blogslider_title">
                                        
                                        <h2>Buy An Amazing Shopify <br> Dropship Store</h2>
                                    </div>
                                     <div class="btn_kickstart_a">
                                        <a href="<?php echo site_url('product-category/shopify-dropship-websites-for-sale'); ?>#regular-shopfiy-store"><span>Regular Shopify Stores</span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                        <a href="<?php echo site_url('product-category/shopify-premium-dropship-websites-for-sale');  ?>#premium-shopfiy-store"><span>Premium Shopify Stores</span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
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


<section class="gadgets_last_section gadgets_lastelectronics">
   
    <?php /*<input type="hidden" name="listing_type" id="listing_type" value="<?php echo $searchtype; ?>">*/ ?>
    <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
    <div id="viewProduct">
        <!-- start:ajax -->
        <div class="container-fluid px-0 ecommerce_div" id="solution">
            <div class="row website-sale" id="response_print_here">

            <?php $this->load->view('main/includes/common-lisiting-solution', ['commonData' => $commonData]); ?>
              
        </div>


    </div>
</section>