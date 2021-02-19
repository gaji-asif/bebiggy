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

        <?php if ((isset($commonData) && isset($commonData2)) && (!empty($commonData) && !empty($commonData2))) { ?>
            <?php if (isset($commonData)) { ?>
                <div class="container-fluid p-0" id="section">
                    <div class="row website-sale" id="response_print_here">
                        <?php $this->load->view('main/includes/common_listing_pagination-new', ['commonData' => $commonData]); ?>
                    </div>
                </div>
            <?php }
            if (isset($commonData2)) { ?>
                <div class="container-fluid p-0 ecommerce_div">
                    <div class="row website-sale" id="solution">
                        <?php $commonData2['type'] = 'solution';
                        $this->load->view('main/includes/common-lisiting-solution-new', ['commonData' => $commonData2]); ?>
                    </div>
                </div>
            <?php } ?>
            <?php if (isset($commonData)) { ?>
                <div class="container-fluid p-0" id="section">
                    <div class="row website-sale" id="response_print_here">
                        <?php $this->load->view('main/includes/common_listing_pagination-new2', ['commonData' => $commonData]); ?>
                    </div>
                </div>

            <?php }
            if (isset($commonData2)) { ?>
                <div class="container-fluid p-0 ecommerce_div">
                    <div class="row website-sale" id="solution">
                        <?php $commonData2['type'] = 'solution';
                        $this->load->view('main/includes/common-lisiting-solution-new2', ['commonData' => $commonData2]); ?>
                    </div>
                </div>

            <?php } ?>
            <?php if (!empty($links)) if (isset($links)) { ?>
                <div class="row pagination_div mb-2 pagi_top_a w-100">
                    <div class="container paginationSearch w-100">
                        <nav aria-label="Page navigation example w-100">
                            <ul class="pagination justify-content-center w-100" style="margin:20px 0">
                                <?php if (!empty($links)) if (isset($links)) {
                                    echo $links;
                                } ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            <?php } ?>

        <?php } else { ?>
            <div class="container">
                <div class="row domain_row_selling_a">
                    <!-- <div class="title_ecommerce"> -->
                    <div class="w-100 text-center pb-3">
                        <center>
                            <h2>All MarketPlaces Listing</h2>
                        </center>
                    </div>
                    <div class=" first_div mb-3 p-4 shadow ">

                        <div class="text-center">
                            <h3>Search data not found</h3>
                        </div>
                    </div>
                <?php } ?>
</section>