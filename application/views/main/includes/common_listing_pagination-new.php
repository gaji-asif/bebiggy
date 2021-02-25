<!-- Feature Listing website -->
<div class="container-fluid ecommerce_div domain_selling_a " style="padding-top: 0;">
    <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
    <div class="row website-sale" id="response_print_here">
        <?php if (in_array('website', array_column($platforms, 'platform'))) { ?>
            <?php

            if (!empty(@$commonData)) {
                @$common_listing = $commonData;
            ?>
                <div class="container">
                    <div class="row domain_row_selling_a">
                        <!-- <div class="title_ecommerce"> -->

                        <?php $this->load->view('main/includes/common-lisiting-new', ['common_listing' => $common_listing]); ?>
                    </div>
                </div>
    </div>

<?php } ?>
<?php } ?>
<!-- end:Feature Listing website -->

</div>
</div>
</div>
</div>
<!-- end:ajax -->