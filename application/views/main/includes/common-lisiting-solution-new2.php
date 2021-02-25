<?php

// pre($common_listing , 1); 

if (!empty(@$commonData)) {
	$common_listing = $commonData;

	// pre($common_listing , 1);
?>

	<div class="container">
		<div class="row website-sale mobile_section" id="response_print_here">
			<div class="row w-100">
				<?php
				$this->load->view('main/includes/common-lisiting-solution_display-new2', ['common_listing' => $common_listing]); ?>
			</div>


		</div>
	</div>
	<!-- common-listing-solution -->
	<!-- end:ajax -->

	</div>
<?php } ?>
<?php $this->load->view('main/includes/models'); ?>