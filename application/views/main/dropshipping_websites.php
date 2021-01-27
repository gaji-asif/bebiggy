<section class="slider_section pb-0 business_slider_div">
	<div class="container">
		<div class="row image_slider">
			<div class="col-12 ">
				<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
						<div class="carousel-item active">
							<div class="page-banner">
								<div>
									<div class="aboutpara_text">

										<p>Buy Dropshipping Websites For Sale</p>
									</div>
									<div class="blogslider_title">

										<h2>Start Dropshipping Fast</h2>
									</div>
									<div class="website_start_now_a">
										<a href="#dropshipping-websites"><span>Start Now</span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
									</div>
								</div>
							</div>
							<img class="d-block w-100" src="<?php echo site_url('assets/img/website-for-sale.png'); ?>" alt="First slide">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section>
	<div class="container desktop_padding text-center">
		<div class="">
			<p class="gl p-highlight2">Don’t miss out on the latest eCommerce trends and new online business ideas! Sign up for our weekly newsletter here:</p>
		</div>
	</div>



</section>
<section class="shopify_get_started_setion_a">
	<div class="container text-center">
		<div class="row">
			<div class="col-12">
				<div class="shopify_get_started_a">
					<h2>How To Get Started With a Shopify Dropshipping Website</h2>
					<p class="gl">Start your dream business today, it’s really easy to get <br>started.</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 col-sm-12">
				<div class="start_widgets">
					<div>
						<span class="cg">1.</span>
						<p>Browse our range of stores and buy online</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-12">
				<div class="start_widgets">
					<div>
						<span class="cg">2.</span>
						<p>You will receive access details to your store</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-12">
				<div class="start_widgets">
					<div>
						<span class="cg">3.</span>
						<p>Start Selling!</p>
					</div>
				</div>
			</div>

		</div>
	</div>

</section>
<section class="dark_gry py-4" id="dropshipping-websites">
	<div class="container">
		<div class="simply row_shopfy_a">
			<h3 class="ar">Each store is ready to run out of the box. Simply market your website and start selling
				to make profits from day one. If you need help, we have your back covered with unlimited support as
				long as you need it.

			</h3>
		</div>
	</div>
</section>
<?php
if (!empty($featuredWebsite)) {
	$common_listing = $featuredWebsite;
	if (!empty($common_listing[0]['id'])) {
?>
		<section>
			<div class="row ecommerce_div pb-5">
				<div class="container">
					<div class="title_ecommerce">
						<center>
							<h2><?php echo $this->lang->line('site_websites'); ?></h2>
						</center>
					</div>
					<?php $this->load->view('main/includes/common-lisiting-solution', ['commonData' => $common_listing]); ?>
					<div class="row">
						<div class="view-btn d-block w-100 text-center">
							<div class="btn_allview view_btn">
								<a href="<?php echo site_url('product-category/shopify-dropship-websites-for-sale'); ?>" class="btn btn-default d-flex justify-content-between">
									<span>View all Featured Shopify Stores & Dropship Ecommerce Websites for Sale </span>
									<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
							</div>

						</div>
					</div>
				</div>
			</div>
		</section>
<?php }
} ?>

<!-- end:Feature Listing website -->


<!-- Premium Listing website -->

<?php
if (!empty($premiumWebsites)) {
	$common_listing = $premiumWebsites;
	if (!empty($common_listing[0]['id'])) {
?>
		<section>
			<div class="row ecommerce_div pb-5">
				<div class="container">
					<div class="title_ecommerce">
						<center>
							<h2><?php echo $this->lang->line('site_websites_premium'); ?></h2>
						</center>
					</div>
					<?php $this->load->view('main/includes/common-lisiting-solution', ['commonData' => $common_listing]); ?>
					<div class="row">
						<div class="view-btn d-block w-100 text-center">
							<div class="btn_allview view_btn">
								<a href="<?php echo site_url('product-category/shopify-premium-dropship-websites-for-sale'); ?>" class="btn btn-default d-flex justify-content-between">
									<span>View all Premium Shopify Stores & Dropship Ecommerce Websites for Sale </span>
									<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
							</div>

						</div>
					</div>
				</div>
			</div>
		</section>
<?php }
} ?>

<!-- end:Feature Listing website -->



<!-- Feature Listing website -->

<?php
if (!empty($latestWebsites)) {
	$common_listing = $latestWebsites;
	if (!empty($common_listing[0]['id'])) {
?>
		<section>
			<div class="row last_div_lastest_shopify_a">
				<div class="container">
					<div class="title_ecommerce">
						<center>
							<h2><?php echo $this->lang->line('site_websites_latest'); ?></h2>
						</center>
					</div>
					<?php $this->load->view('main/includes/common-lisiting-solution', ['commonData' => $common_listing]); ?>
					<div class="row">
						<div class="view-btn d-block w-100 text-center">
							<div class="btn_allview view_btn">
								<a href="<?php echo site_url('product-category/shopify-latest-dropship-websites-for-sale'); ?>" class="btn btn-default d-flex justify-content-between">
									<span>View all Latest Shopify Stores & Dropship Ecommerce Websites for Sale </span>
									<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
							</div>

						</div>
					</div>
				</div>
			</div>
		</section>
<?php }
} ?>

<!-- end:Feature Listing website -->