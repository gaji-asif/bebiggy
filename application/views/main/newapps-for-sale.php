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


<section class="newapp_last_section newapps_lastsection_a">

    <?php /*<input type="hidden" name="listing_type" id="listing_type" value="<?php echo $searchtype; ?>">*/ ?>
    <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
    <div id="viewProduct">
        <!-- start:ajax -->
        <?php
        if (isset($commonData) && !empty($commonData)) { ?>
            <div class="container-fluid p-0" id="section">
                <div class="row website-sale" id="response_print_here">

                    <?php $this->load->view('main/includes/common_listing_pagination', ['commonData' => $commonData]); ?>

                </div>

            </div>
        <?php } else { ?>
            <div class="container-fluid ecommerce_div domain_selling_a pb-5">
                <div class="row website-sale" id="response_print_here">
                    <div class="container-fluid p-0" id="section">
                        <div class="row website-sale" id="response_print_here">
                            <div class="container">
                                <div class="row domain_row_selling_a">
                                    <!-- <div class="title_ecommerce"> -->
                                    <div class="w-100 text-center mb-3">
                                        <center>
                                            <h2><?php echo $this->lang->line($heading);
                                                ?></h2>
                                        </center>
                                    </div>
                                    <div class=" first_div mb-3 p-4 shadow ">

                                        <div class="text-center">
                                            <h3>Search data not found</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        <?php } ?>
</section>