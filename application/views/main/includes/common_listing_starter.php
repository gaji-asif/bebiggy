<div class="container-fluid ecommerce_div fashion_page_a">
    <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
    <div class="row website-sale" id="response_print_here">

        <!-- Feature Listing website -->
        <?php if (in_array('website', array_column($platforms, 'platform'))) { ?>
            <?php

            if (!empty(@$commonData)) {
                $common_listing = $commonData;
            ?>
                <div class="container">
                    <div class="row fashion_last_div_a">
                        <div class="title_ecommerce ">
                            <center>
                                <h2><?php echo $this->lang->line($heading); ?></h2>
                            </center>
                        </div>
                        <?php $this->load->view('main/includes/common-lisiting', ['common_listing' => $common_listing]); ?>
                    </div>
                </div>

            <?php } ?>
        <?php } ?>
        <!-- end:Feature Listing website -->
        <div class="col-12  col-md-12 text-center pb-4">
            <a href="<?php echo site_url($detailed_url); ?>" class="new_btn btn_blue">View More</a>
        </div>
    </div>


    <!-- end:ajax -->