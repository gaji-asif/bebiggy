<div class="row pl-3 pr-4">
	<div class="col-xl-12">
		<div class="submit-field">
			<h5>Date Established<i class="help-icon" data-tippy-placement="right" title="Should be add date of established"></i></h5>
			<input type="text" readonly="true" id="established_date" name="established_date" value="<?php if (isset($listing_data[0]['established_date'])) echo $listing_data[0]['established_date']; ?>" class="with-border datepicker" placeholder="yyyy/mm/dd" required>
		</div>
	</div>

</div>