<?php
if (!empty(@$commonData)) {
	$common_listing = $commonData;
	if(!empty($common_listing[0]['id'])){
		//  pre($common_listing , 1);
?>
		<div class="container-fluid ecommerce_div mobile_section_ecommerce_a spacing_issue_a">
			<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

			<div class="container shopify_product_page_a">
				<div class="row website-sale mobile_section fashion_page_shop_a" id="response_print_here">
					<?php if (!empty($heading)) :  ?>
						<div class="title_ecommerce w-100 text-center dropshipping_products_title_a">
							<center>
								<h2><?php echo $this->lang->line($heading); ?></h2>
							</center>
						</div>
					<?php endif; ?>
					<div class="row d-block w-100">
					<?php  $this->load->view('main/includes/common-lisiting-solution_display', ['common_listing' => $common_listing]); ?>

					</div>
					<?php if (!empty($detailed_url)) { ?>
						<div class="col-12  col-md-12 text-center pb-4 mt-4 view_more">
							<a href="<?php echo site_url($detailed_url); ?>" class="new_btn btn_blue">View More</a>
						</div>
					<?php  } ?>
				</div>
				<!-- end:Feature Listing website -->
				<!-- end:ajax -->

			</div>
		</div>
<?php }
} ?>
<?php $this->load->view('main/includes/models'); ?>