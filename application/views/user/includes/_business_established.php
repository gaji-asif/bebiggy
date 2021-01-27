
<div class="row pl-3 pr-4">
	<div class="col-xl-12">
		<div class="submit-field">
			<h5>Monetization Method<span class='text-danger'>*</span></h5>
			<div class="row">
					<?php foreach (array_values($monetization_through) as $val) { ?>
						<div class="col-xl-4 monetize_methods">
							<input type="checkbox" class="checkbox_monetize" name="monetization_through[]" value="<?= $val['id'] ?>"><?= $val['name'] ?>
							<span class="checkmark"></span>
						</div>

					<?php } ?>
				
			</div>
		</div>
	</div>
	<div class="col-xl-4">
		<div class="submit-field">
			<h5>Date Established <i class="help-icon" data-tippy-placement="right" title="Should be add date of established"></i><span class='text-danger'>*</span></h5>

			<input type="text" id="established_date" readonly="true" 
			name="established_date" value="<?php if (isset($listing_data[0]['established_date'])) echo $listing_data[0]['established_date']; ?>" 
			class="with-border datepicker" placeholder="yyyy/mm/dd" required>
		</div>
	</div>
	<div class="col-xl-4" style="display: none;">
		<div class="submit-field">
			<h5>Bussiness Age <span>(Years)</span> <i class="help-icon" data-tippy-placement="right" title="Should be add in years"></i><span class='text-danger'>*</span></h5>
			<input type="text" id="website_age" readonly="true" name="website_age" value="<?php if (isset($listing_data[0]['website_age'])) echo $listing_data[0]['website_age']; ?>" class="with-border numeric_validation" placeholder="2 Years" onkeypress='validateInputNumbers(event)' required>
		</div>
	</div>
	<div class="col-xl-4">
		<div class="submit-field">
			<h5>Monetized Since<i class="help-icon" data-tippy-placement="right" title="Should be add date from motitization starts"></i><span class='text-danger'>*</span></h5>
			<input type="text" id="monetized_since"
			 readonly="true" name="monetized_since" 
			 value="<?php if (isset($listing_data[0]['monetized_since'])) echo $listing_data[0]['monetized_since']; ?>" 
			 class="datepicker with-border" placeholder="yyyy/mm/dd" required>

		</div>
	</div>

	<div class="col-xl-4">
		<div class="submit-field">
			<h5>Last 6 Months Avg Revenue<i class="help-icon" data-tippy-placement="right" title="Should be add Last 6 Months Avg Revenue"></i><span class='text-danger'>*</span></h5>
			<input type="text" id="six_months_revenue" name="six_months_revenue" value="<?php if (isset($listing_data[0]['six_months_revenue'])) echo $listing_data[0]['six_months_revenue']; ?>" class="with-border numeric_validation" placeholder="$00" required onkeypress='validateInputNumbers(event)'>
		</div>
	</div>

	<div class="col-xl-4">
		<div class="submit-field">
			<h5>Last 6 Months Avg Profit<i class="help-icon" data-tippy-placement="right" title="Should be add Last 6 Months Avg Profit"></i><span class='text-danger'>*</span></h5>
			<input type="text" id="six_months_profit" name="six_months_profit" value="<?php if (isset($listing_data[0]['six_months_profit'])) echo $listing_data[0]['six_months_profit']; ?>" class="with-border numeric_validation" placeholder="$00" required onkeypress='validateInputNumbers(event)'>
		</div>
	</div>



	<div class="col-xl-8">
		<div class="submit-field">
			<h5><b> Financial Overview : </b> Revenue | Expenses | <span>(Net Profit)</span> <i class="help-icon" data-tippy-placement="right" title="Net Profit will be automatically calculated"></i></h5>
			<div class="row">
				<div class="col-xl-4">
					<div class="input-with-icon">
						<input type="text" id="last12_monthsrevenue" name="last12_monthsrevenue" value="<?php if (isset($listing_data[0]['last12_monthsrevenue'])) echo $listing_data[0]['last12_monthsrevenue']; ?>" min-class="with-border numeric_validation" maxlength="<?php echo CURRENCY_MAXLENGTH ?>" placeholder="$00" onkeypress='validateInputNumbers(event)' required>
						<i class="currency"><?php if (isset($default_currency)) echo $default_currency;
											else echo '$'; ?></i>
					</div>
				</div>
				<div class="col-xl-4">
					<div class="input-with-icon">
						<input type="text" id="last12_monthsexpenses" name="last12_monthsexpenses" value="<?php if (isset($listing_data[0]['last12_monthsexpenses'])) echo $listing_data[0]['last12_monthsexpenses']; ?>"  class="with-border numeric_validation" maxlength="<?php echo CURRENCY_MAXLENGTH ?>" placeholder="$00" onkeypress='validateInputNumbers(event)' required>
						<i class="currency"><?php if (isset($default_currency)) echo $default_currency;
											else echo '$'; ?></i>
					</div>
				</div>
				<div class="col-xl-4">
					<div class="input-with-icon">
						<input type="text" id="annual_profit" name="annual_profit" value="<?php if (isset($listing_data[0]['annual_profit'])) echo $listing_data[0]['annual_profit']; ?>" class="with-border" placeholder="" readonly="true">
						<i class="currency"><?php if (isset($default_currency)) echo $default_currency;
											else echo '$'; ?></i>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="col-xl-4">
		<div class="submit-field">
			<h5>Traffic Sources <span> (Optional)	</span></h5>
			<select id="traffic_sources" name="traffic_sources[]" class="js-example-basic-multiple with-border" multiple >
				<?php  foreach(TRAFFIC_SOURCES as $key => $val): ?>
				<option value="<?php echo $key; ?>"><?php echo $val ; ?></option>
				<?php  endforeach; ?>
			</select>
		</div>
	</div>


	<div class="col-xl-4">
		<div class="submit-field">
			<h5>Monthly Visitors<span class='text-danger'>*</span></h5>
			<input type="text" id="monthly_visitors" name="monthly_visitors" value="<?php if (isset($listing_data[0]['monthly_visitors'])) echo $listing_data[0]['monthly_visitors']; ?>" class="with-border" placeholder="" required>
		</div>
	</div>

	<div class="col-xl-4">
		<div class="submit-field submit-field check_boxwebsite_a">
			<h5>Sales Support (Optional)</h5>
			<input type="checkbox" id="sales_support" class="col-sm-1" name="sales_support" value="<?php if (isset($listing_data[0]['sales_support'])) echo $listing_data[0]['sales_support']; else echo "1" ; ?>" class="with-border">
		</div>
	</div>

</div>
<script>
	$(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
</script>