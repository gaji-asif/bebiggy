                        <div class="row pl-3 pr-3">
                  
                        		<div class="col-xl-4">
                        			<div class="submit-field">
                        				<h5>Date Established <i class="help-icon" data-tippy-placement="right" title="Should be add date of established"></i><span>(Optional)</span></h5>
                        				<input type="text" id="established_date" name="established_date" value="<?php if (isset($listing_data[0]['established_date'])) echo $listing_data[0]['established_date']; ?>" class="with-border datepicker" placeholder="yyyy/mm/dd" readonly="true" >
                        			</div>
                        		</div>

                        		<div class="col-xl-6" style="display: none;">
                        			<div class="submit-field">
                        				<h5>Bussiness Age <span>(Years) (optional)</span> <i class="help-icon" data-tippy-placement="right" title="Should be add in years"></i> <span class='text-danger'>*</span></h5>
                        				<input type="text" id="website_age" name="website_age" value="<?php if (isset($listing_data[0]['website_age'])) echo $listing_data[0]['website_age']; ?>" class="with-border numeric_validation" placeholder="2 Years" onkeypress='validateInputNumbers(event)' required maxlength="<?php echo CURRENCY_MAXLENGTH ?>" >
                        			</div>
                        		</div>
                        		<div class="col-xl-8">
                        			<div class="submit-field">
                        				<h5><b> Financial Overview : </b> Revenue | Expenses | <span>(Net Profit) (optional)</span> <i class="help-icon" data-tippy-placement="right" title="Net Profit will be automatically calculated"></i></h5>
                        				<div class="row">
                        					<div class="col-xl-4">
                        						<div class="input-with-icon"> 
                        							<input type="text" id="last12_monthsrevenue" name="last12_monthsrevenue" value="<?php if (isset($listing_data[0]['last12_monthsrevenue'])) echo $listing_data[0]['last12_monthsrevenue']; ?>" class="with-border numeric_validation" placeholder="$00" onkeypress='validateInputNumbers(event)'  maxlength="<?php echo CURRENCY_MAXLENGTH ?>" >
                        							<i class="currency"><?php if (isset($default_currency)) echo $default_currency;
																		else echo '$'; ?></i>
                        						</div>
                        					</div>
                        					<div class="col-xl-4">
                        						<div class="input-with-icon"> 
                        							<input type="text" id="last12_monthsexpenses" name="last12_monthsexpenses" value="<?php if (isset($listing_data[0]['last12_monthsexpenses'])) echo $listing_data[0]['last12_monthsexpenses']; ?>" class="with-border numeric_validation" placeholder="$00"  maxlength="<?php echo CURRENCY_MAXLENGTH ?>" onkeypress='validateInputNumbers(event)' >
                        							<i class="currency"><?php if (isset($default_currency)) echo $default_currency;
																		else echo '$'; ?></i>
                        						</div>
                        					</div>
                        					<div class="col-xl-4">
                        						<div class="input-with-icon">
                        							<input type="text" id="annual_profit" name="annual_profit" value="<?php if (isset($listing_data[0]['annual_profit'])) echo $listing_data[0]['annual_profit']; ?>"  maxlength="<?php echo CURRENCY_MAXLENGTH ?>" class="with-border" placeholder=""  >
                        							<i class="currency"><?php if (isset($default_currency)) echo $default_currency;
																		else echo '$'; ?></i>
                        						</div>
                        					</div>
                        				</div>
                        			</div>
                        		</div>

                       
                        </div>