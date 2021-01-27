<section class="slider_section pb-0 business_slider_div domain_slider_a">
    <div class="container">
        <div class="row image_slider">
            <div class="col-12 ">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="page-banner">
                                <div>
                                    <div class="aboutpara_text">
                                        <p><?php echo $this->lang->line('uppercase_site_name'); ?> Offers Profitable Turnkey Shopify Dropship Websites <br />& Drop Shipping Businesses For Sale</p>
                                    </div>
                                    <div class="blogslider_title">
                                        <h2>Buy Best Shopify Stores <br />For Sale</h2>
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

<section class="domain_last_section domain_mobilelsiting_a">
   
    <?php /*<input type="hidden" name="listing_type" id="listing_type" value="<?php echo $searchtype; ?>">*/ ?>
    <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
    <div id="viewProduct">
        <!-- start:ajax -->
        <div class="container-fluid p-0" id="section">
            <div class="row website-sale" id="response_print_here">

        <?php $this->load->view('main/includes/common_listing_pagination', ['commonData' => $commonData]); ?>
              
        </div>

    </div>
</section>