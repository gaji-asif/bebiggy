<div class="container-fluid ecommerce_div domain_selling_a pb-5">
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
                        <!-- <div class="title_ecommerce"> -->
                        <div class="w-100 text-center mb-3">
                            <center>
                                <h2><?php echo $this->lang->line($heading);
                                    ?></h2>
                            </center>
                        </div>
                        <?php $this->load->view('main/includes/common-lisiting', ['common_listing' => $common_listing]); ?>
                    </div>
                </div>

            <?php } ?>
        <?php } ?>
        <!-- end:Feature Listing website -->
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
    </div>
</div>
<!-- end:ajax -->