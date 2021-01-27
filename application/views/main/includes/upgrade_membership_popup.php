<!-- upgradePlan Popup -->
<div id="upgradePlanModel" class="modal fade" style="z-index:1000000000">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title  text-center">MembershipLevel !!</h4>
			</div>
			<div class="modal-body">
				<p class="text-center">Upgrade Your Membership Plan.</p>
			</div>
			<div class="modal-footer">
				<button class="btn btn-success theme_btns" data-dismiss="modal">Close</button>
				<a href="<?php echo site_url('pricing') ?>" class="btn btn-success theme_btns" >Upgrade</a>
			</div>
		</div>
	</div>
</div>
<!-- upgradePlan Popup -->

<script>
	$(document).on('click', "#upgradePlan", function() {
		$.magnificPopup.close();
		//$('#OfferSuccessfull').modal('show');
		$('#upgradePlanModel').modal('show');
	});
</script>