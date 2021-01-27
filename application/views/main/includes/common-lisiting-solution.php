<?php
	
	// pre($common_listing , 1); 

if (!empty(@$commonData)) {
	$common_listing = $commonData;
	// pre($common_listing , 1);
?>
	<div class="container mobile_section_ecommerce_a spacing_issue_a">
		<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

		<div class="container">
			<div class="row website-sale mobile_section" id="response_print_here">
				<?php if (!empty($heading)) :  ?>
					<div class="title_ecommerce w-100 text-center dropshipping_products_title_a">
						<center>
							<h2><?php echo $this->lang->line($heading); ?></h2>
						</center>
					</div>
				<?php endif; ?>
				<div class="row w-100">
				<?php  $this->load->view('main/includes/common-lisiting-solution_display', ['common_listing' => $common_listing]); ?>
				</div>


			</div>
		</div>
		<!-- common-listing-solution -->
		<!-- end:ajax -->
		<?php if (!empty($links)) : ?>
			<div class="row pagination_div pagi_top w-100">
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
		<?php endif; ?>
	</div>
<?php } ?>
<?php $this->load->view('main/includes/models'); ?>