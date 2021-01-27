	<div class="row pl-3 pr-4">

			<div class="col-xl-4">
				<div class="submit-field">
					<h5>Date Established <span class='text-danger'>*</span><i class="help-icon" data-tippy-placement="right" title="Should be add date of established"></i></h5>
					<input type="text" id="established_date" name="established_date" value="<?php if(isset($listing_data[0]['established_date'])) echo $listing_data[0]['established_date']; ?>" class="with-border datepicker" placeholder="yyyy/mm/dd" readonly="true" required>
				</div>
			</div>
			<div class="col-xl-4">
				<div class="submit-field">
					<h5>Monetized Since <span class='text-danger'>*</span><i class="help-icon" data-tippy-placement="right" title="Should be add date form motitization starts"></i></h5>
					<input type="text" id="monetized_since" name="monetized_since" value="<?php if(isset($listing_data[0]['monetized_since'])) echo $listing_data[0]['monetized_since']; ?>" class="with-border datepicker" placeholder="yyyy/mm/dd" readonly="true" required>
				</div>
			</div>

			<div class="col-xl-4">
				<div class="submit-field">
					<h5>Last 6 Months Avg Revenue <span class='text-danger'>*</span><i class="help-icon" data-tippy-placement="right" title="Should be add Last 6 Months Avg Revenue"></i></h5>
					<input type="text" id="six_months_revenue" name="six_months_revenue" value="<?php if(isset($listing_data[0]['six_months_revenue'])) echo $listing_data[0]['six_months_revenue']; ?>" class="with-border numeric_validation" placeholder="$00" maxlength="<?php echo CURRENCY_MAXLENGTH ?>" required onkeypress='validateInputNumbers(event)'>
				</div>
			</div>
		
			<div class="col-xl-4">
				<div class="submit-field">
					<h5>Last 6 Months Avg Profit<span class='text-danger'>*</span> <i class="help-icon" data-tippy-placement="right" title="Should be add Last 6 Months Avg Profit"></i></h5>
					<input type="text" id="six_months_profit" name="six_months_profit" value="<?php if(isset($listing_data[0]['six_months_profit'])) echo $listing_data[0]['six_months_profit']; ?>" class="with-border numeric_validation" placeholder="$00" required maxlength="<?php echo CURRENCY_MAXLENGTH ?>" onkeypress='validateInputNumbers(event)'>
				</div>
			</div>
					
		<div class="col-xl-4">
			<div class="submit-field">
				<h5>Monthly Visitors <span class='text-danger'>*</span></h5>
				<input type="text" id="monthly_visitors" name="monthly_visitors" value="<?php if(isset($listing_data[0]['monthly_visitors'])) echo $listing_data[0]['monthly_visitors']; ?>" class="with-border numeric_validation" placeholder="$00" required>
			</div>
		</div>
	</div>
	

						
				  
					
				

							
					