<!--------------------------------------------------------------------------------------------------------------->
<?php // $this->load->view('main/includes/headerscripts'); 

?>
<!--------------------------------------------------------------------------------------------------------------->


<div class="clearfix"></div>
<!-- Header Container / End -->

<!-- Content -->
<div class="container checkout_page margin-top-50">
	<div class="row">
		<div class="col-xl-8 col-lg-8 content-right-offset left_payment_a">

			<?php if (!isset($userdata[0]['username'])) { ?>
				<!-- Hedaline -->
				<h3>Login</h3>

				<!-- Billing Cycle Radios  -->
				<div class="billing-cycle margin-top-25">
					<div class="container">
						<div class="row">
							<div class="col-xl-8 offset-xl-3">
								<div class="login-register-page">
									<div id="loginStatus"></div>
									<!-- Welcome Text -->
									<div class="welcome-text">
										<h3><?php echo $this->lang->line('lang_checkout_page_val'); ?></h3>
										<span><?php echo $this->lang->line('lang_txt_notamember'); ?> <a href="<?php echo base_url() ?>signup"><?php echo $this->lang->line('lang_header_main_signup'); ?>!</a></span>
									</div>

									<!-- Form -->
									<form id="UserLoginForm" method="post" enctype="multipart/form-data">
										<div class="input-with-icon-left">
											<i class="icon-material-baseline-mail-outline"></i>
											<input type="text" class="input-text with-border" name="login_username" id="login_username" placeholder="<?php echo $this->lang->line('lang_txt_username'); ?> / <?php echo $this->lang->line('lang_txt_email'); ?>" />
										</div>

										<div class="input-with-icon-left">
											<i class="icon-material-outline-lock"></i>
											<input type="password" class="input-text with-border" name="login_password" id="login_password" placeholder="<?php echo $this->lang->line('lang_txt_password'); ?>" />
										</div>
										<a href="<?php echo base_url() . 'forgotpassword' ?>" class="forgot-password"><?php echo $this->lang->line('lang_txt_forgotpassword'); ?></a>

										<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
									</form>

									<!-- Button -->
									<button id="button_login" name="button_login" class="button full-width button-sliding-icon ripple-effect margin-top-10" type="submit" form="UserLoginForm"><?php echo $this->lang->line('lang_btn_login'); ?><i class="icon-material-outline-arrow-right-alt"></i></button>
									<span id="loadingImageLogin" style="display:none;" class="centerButtons"> <img src="<?php echo base_url(); ?>assets/img/loadingimage.gif" /> </span>

								</div>
							</div>
						</div>
					</div>
				</div>

			<?php } else { ?>

				<!-- payment form --->
				<form id="paymentForm" class="creditly-card-form agileinfo_form" method="post" enctype="multipart/form-data" action="<?php echo site_url('payments/pay_contract'); ?>">

					<input type="hidden" name="txt_paytotal" id="txt_paytotal" value="<?php if (!empty($total)) echo $total; ?>" />
					<input type="hidden" name="txt_paytotal_original" id="txt_paytotal_original" value="<?php if (!empty($total)) echo $total; ?>" />
					<input type="hidden" name="txt_description" id="txt_description" value="<?php echo $name; ?>" />
					<input type="hidden" name="txt_id" id="txt_id" value="<?php echo $id; ?>" />
					<input type="hidden" name="txt_type" id="txt_type" value="<?php echo $type; ?>" />
					<input type="hidden" name="txt_contract" id="txt_contract" value="<?php if (!empty($contract_id)) echo $contract_id; ?>" />
					<input type="hidden" name="paymentType" id="paymentType" value="" />

					<!-- Hedline -->
					<h3 class="payment_tab_a">
						<div class="course_title_bar"></div>Payment Methods
					</h3>

					<?php if (!empty($error)) { ?>
						<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><span><?php print_r($error); ?></span></div>
					<?php } ?>

					<div id="paymentValidations"></div>

					<?php if (!empty($payments)) { ?>
						<!-- Payment Methods Accordion -->
						<div class="payment margin-top-30">

							<?php foreach ($payments as $key) {

								if ($key['id'] === '1') { ?>
									<!----PAYPAL EXPRESS ----->
									<div class="payment-tab payment-tab-active">
										<div class="payment-tab-trigger">
											<input checked id="paypal" name="cardType" type="radio" value="PayPal_Express">
											<label for="paypal">PayPal</label>
											<img class="payment-logo paypal" src="<?php if (!empty($key['icon_url'])) echo $key['icon_url'] ?>" alt="">
										</div>

										<div class="payment-tab-content">
											<p>You will be redirected to PayPal to complete payment.</p>
										</div>
									</div>
									<!----/ PAYPAL EXPRESS ----->
								<?php } else if ($key['id'] === '2') { ?>
									<!---- PAYPAL PRO ----->
									<div class="payment-tab">
										<div class="payment-tab-trigger">
											<input type="radio" name="cardType" id="creditCart" value="PayPal_Pro">
											<label for="creditCart">Credit / Debit Card (Paypal Pro)</label>
											<img class="payment-logo" src="<?php if (!empty($key['icon_url'])) echo $key['icon_url'] ?>" alt="">
										</div>

										<section id="paypal-pro" class="creditly-wrapper">
											<div class="payment-tab-content paypal">
												<div class="row payment-form-row credit-card-wrapper">

													<div class="col-md-6">
														<div class="card-label">
															<input class="nameOnCard" name="name" required type="text" placeholder="Cardholder Name">
														</div>
													</div>

													<div class="col-md-6">
														<div class="card-label">
															<input class="number credit-card-number form-control" type="text" name="number" inputmode="numeric" autocomplete="cc-number" autocompletetype="cc-number" x-autocompletetype="cc-number" placeholder="&#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149;" onkeypress='validateInputNumbers(event)'>
														</div>
													</div>

													<div class="col-md-6">
														<div class="card-label">
															<label class="control-label">Expiration Date</label>
															<input class="expiration-month-and-year form-control" type="text" name="expiration-month-and-year" placeholder="MM / YY" onkeypress='validateInputNumbers(event)'>
															<input type="hidden" name="txt_month" class="txt_month" />
															<input type="hidden" name="txt_year" class="txt_year" />
														</div>
													</div>

													<div class="col-md-6">
														<div class="card-label">
															<input class="security-code form-control" Â·inputmode="numeric" type="text" name="security-code" placeholder="&#149;&#149;&#149;">
														</div>
													</div>
												</div>
											</div>
										</section>
									</div>
									<!----/ PAYPAL PRO ----->
								<?php } else if ($key['id'] === '3') { ?>
									<!---- STRIPE ----->
									<div class="payment-tab payment-tab-active">
										<div class="payment-tab-trigger">
											<input type="radio" checked name="cardType" id="Stripe" value="Stripe">
											<label for="Stripe">Credit / Debit Card (Stripe)</label>
											<img class="payment-logo" src="<?php if (!empty($key['icon_url'])) echo $key['icon_url'] ?>" alt="">
										</div>

										<section id="stripe" class="creditly-wrapper">
											<div class="payment-tab-content stripe">
												<div class="row payment-form-row credit-card-wrapper">

													<div class="col-md-6">
														<div class="card-label">
															<input class="nameOnCard" name="name" required type="text" id="cardholder_name" placeholder="Cardholder Name">
														</div>
													</div>

													<div class="col-md-6">
														<div class="card-label">
															<input id="stripe_credit_card" class="number credit-card-number form-control" type="number" name="number" inputmode="numeric" autocomplete="cc-number" autocompletetype="cc-number" x-autocompletetype="cc-number" placeholder="&#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149;" onkeypress='validateInputNumbers(event)'>
														</div>
													</div>

													<div class="col-md-6 col-sm-12">
														<div class="card-label">
															<label class="control-label">Expiration Date</label>
															<input class="expiration-month-and-year form-control"  id="expiration-month-and-year" type="text" name="expiration-month-and-year" placeholder="MM / YY" onkeypress='validateInputNumbers(event)'>
															<input type="hidden" name="txt_month" class="txt_month" />
															<input type="hidden" name="txt_year" class="txt_year" />
														</div>
													</div>

													<div class="col-md-6 col-sm-12">
														<div class="card-label">
															<input class="security-code form-control" Â·inputmode="numeric" type="text" name="security-code" placeholder="&#149;&#149;&#149;" id="security_code">
														</div>
													</div>
												</div>
											</div>
										</section>
									</div>
									<!---- / STRIPE ----->
								<?php } ?>

								<!-- Payment Methods Accordion / End -->
							<?php } ?>

						</div>
						<span id="loader" style="display:none;"> <img src="<?php echo base_url(); ?>assets/img/loadingimage.gif" /> </span>
						<?php if (!empty($owner_id) && $owner_id !== $this->session->userdata('user_id')) { ?>
							<button class="button big ripple-effect margin-top-40 margin-bottom-65 submitpay full-width button-sliding-icon ripple-effect" id="product_payment">Pay Now</button>
						<?php } else { ?>
							<a class="button big ripple-effect margin-top-40 margin-bottom-65 add-to-cart-own float-right full-width button-sliding-icon ripple-effect" href="#">Proceed Payment</a>
						<?php } ?>

					<?php } else {
						echo 'No Payment Options are available. Please contact site owner';
					} ?>

					<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

				</form>
			<?php } ?>
			<!-- /payment form --->
			<?php if (($this->session->flashdata('error_message') != null) && !empty($this->session->flashdata('error_message'))) { ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Error !</strong> <?php echo $this->session->flashdata('error_message');  ?>
					<button type="button" class="close" da ta-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<?php } ?>
		</div>

		<!-- Summary -->
		<div class="col-xl-4 col-lg-4 margin-top-0 margin-bottom-60 total_section_a">

			<!-- Summary -->
			<div class="boxed-widget summary margin-top-0">
				<div class="boxed-widget-headline">
					<h3>Summary <span class="noofitems-summary"></span></h3>
				</div>
				<div class="boxed-widget-inner">
					<ul class="checkout-items check_out_page_a">
						<li><span class="name_getting_a"><?php echo $name; ?></span><span><?php echo $currency; ?> <span id="payAmt"><?php echo number_format($amount, 2); ?></span></span></li>
						<?php if (empty($membership_buy)) { ?>
							<li>Fee <b>(<?php echo $percentage ?>%)</b><span><?php echo $currency; ?><span id="feeAmt"> <?php echo number_format($fee, 2); ?></span></span></li>
							<li>Discount : <span class="total-discount">0</span></span></li>
						<?php  } ?>


						<?php if (!empty($membership_buy)) { ?>
							<li>Balance Amount <span> - <?php echo $currency; ?><span id="balanceAmt"> <?php echo number_format($balance_amount, 2); ?></span></span></li>
						<?php  } ?>


					</ul>
					<ul>

						<li class="total-costs">Final Price <span class="total-cost"><?php echo $currency; ?><?php echo number_format($total, 2); ?></span></li>

					</ul>
				</div>
			</div>

			<?php $this->session->set_userdata('checkout_url_', current_url()); ?>

			<!-- Summary / End -->

			<?php if (empty($membership_buy)) { ?>

				<form id="discountCouponForm">
					<div class="input-with-icon-left margin-top-30">
						<i class="fa fa-tags"></i>
						<input type="text" class="input-text with-border" name="checkoutCoupon" id="checkoutCoupon" placeholder="Coupon Code" required />
					</div>

					<div id="loadingCoupon" align="center" style="display:none;"> <img src="<?php echo base_url(); ?>assets/img/loadingimage.gif" /> </div>
					<div id="discountCouponValidate"></div>

					<button id="discountCodeApply" class="button full-width button-sliding-icon ripple-effect margin-top-10" type="submit">Apply <i class="icon-material-outline-arrow-right-alt"></i></button>

					<!-- Checkbox -->
					<div class="checkbox margin-top-30">
						<input type="checkbox" id="two-step" class="payment_checkbox_a" required checked>
						<label for="two-step"><span class="checkbox-icon"></span> I agree to the <a href="<?php echo base_url() ?>terms-of-services"><?php echo $this->lang->line('lang_termsandconditions'); ?></a> and the <a href="<?php echo base_url() . 'privacy-policy'; ?>"><?php echo $this->lang->line('lang_privacy_policy'); ?></a></label>
					</div>

					<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

				</form>
			<?php  } ?>

		</div>
		<!--/ summary -->
	</div>
</div>
<!-- Container / End -->

<!--------------------------------------------------------------------------------------------------------------->
<?php //$this->load->view('main/includes/footer'); 
?>
<!--------------------------------------------------------------------------------------------------------------->

</div>
<!-- Wrapper / End -->

<!--------------------------------------------------------------------------------------------------------------->

<script>
	//checkoutpage();
</script>
<!--------------------------------------------------------------------------------------------------------------->