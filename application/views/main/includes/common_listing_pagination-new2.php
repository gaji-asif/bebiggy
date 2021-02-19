<div class="container-fluid ecommerce_div domain_selling_a " style="padding-top: 0;">
    <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
    <div class="row website-sale" id="response_print_here">

        <!-- Feature Listing website -->
        <?php if (in_array('website', array_column($platforms, 'platform'))) { ?>
            <?php

            if (!empty(@$commonData)) {
                @$common_listing = $commonData;
            ?>
                <div class="container">
                    <div class="row domain_row_selling_a">
                        <?php $this->load->view('main/includes/common-lisiting-new2', ['common_listing' => $common_listing]); ?>
                    </div>
                </div>

            <?php } ?>
        <?php } ?>

    </div>
</div>
<!-- end:ajax -->