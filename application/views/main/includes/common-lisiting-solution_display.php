<style>
	.custom_height{
		height: 180px;
	}

	.custom_height_normal_listing{
		height: 165px;
	}

	.view_demo_btn {
		background-color: #ffc24d; 
		padding: 14px; 
		font-size: 14px; 
		color: #FFFFFF; 
		font-weight: bold; 
		width: 49%;
		margin-right: 1%;
		text-align: center;
	}

	.my_btn{
		text-align: center;
	}

	a.my_btn:hover{
		color: #000000 !important;
		opacity: 0.5 !important;
		/*background-color: #000000 !important;*/
	}
/*
	@media only screen and (min-width: 1056px)
.but_now {
     margin-top: 5px; 
}*/
	
</style>

<?php
// pre($common_listing , 1); 
/*$m  = 0 ;*/
//  pre($common_listing);
//  die("---");
foreach ($common_listing as $ad) {
	/*$m++;
	if($m == 5) die('-===========');
*/	// pre($ad['website_thumbnail'][0]['name'] , 1)

// pre($ad , 1);
	if (!empty($ad['id'])) {
		?>
		<div  class="row first_div dropshipping_products_a mb-3 p-4 shadow clearfix  <?php if (isset($ad['listing_header_priority'])  && $ad['listing_header_priority'] != 1) echo "sponsership_bgcolor" ?>">
			<?php 
			$show_image = 0;
			if (!empty($ad['listing_header_priority']) && $ad['listing_header_priority'] != 1) {
				if(isset($ad['website_thumbnail'][0]['name'])){

					$img_url = FCPATH . IMAGES_UPLOAD . $ad['website_thumbnail'][0]['name'];

					if (fileExists($img_url)) {

						$show_image = 1;
						$img_url = base_url() . IMAGES_UPLOAD . $ad['website_thumbnail'][0]['name'];
					}
				}
			}?>
			<?php if($show_image === 1):?>
				<div class="col-md-3 col-sm-12 image_div custom_height">					
					<img src="<?php echo $img_url; ?>" class="rounded">					
				</div>
			<?php endif ?>

			<?php
			$text_length_countss = '';
			if($show_image === 1){
				$text_length_countss = '170';
			}
			else{
				$text_length_countss = '275';
			}
			?>
			
			<?php /* <div class="col-md-3 col-sm-12 image_div">
				<?php if (!empty($listing_data[0]['listing_header_priority']) && $listing_data[0]['listing_header_priority'] != 1) :  ?>
					<?php
					$img_url = base_url() . BLOG_UPLOAD . 'banner-10.jpg';
					if (isset($ad['website_thumbnail'][0]['name'])) {
						$img_url = FCPATH . IMAGES_UPLOAD . $ad['website_thumbnail'][0]['name'];

						if (fileExists($img_url)) {

							$img_url = base_url() . IMAGES_UPLOAD . $ad['website_thumbnail'][0]['name'];
						} else {
							$img_url = base_url() . BLOG_UPLOAD . 'banner-10.jpg';
						}
					} else {
						$img_url = base_url() . BLOG_UPLOAD . 'banner-10.jpg';
					}
					?>
					<img src="<?php echo $img_url; ?>" class="rounded">
					 <?php else : ?>
                        <?php
                        $img_url = base_url() . NO_IMAGE . 'Noimage.jpeg';
                        ?>
                        <img src="<?php echo $img_url; ?>" class="rounded w-100 ">
                    <?php endif; ?>

                    </div> */?>
                    <?php
				/**
				 * set product as url before 1-dec-2020 after that solution-details
				 */
				$newDate = new DateTime($ad['date']);
				$p_date = $newDate->format('Y-m-d');
				$setDate = new DateTime(PRODUCT_DATE);
				$d_date = $setDate->format('Y-m-d');

				if ($d_date > $p_date) $url_proudct = SOLUTION_DETAILS_URL[0];
				else $url_proudct = SOLUTION_DETAILS_URL[1] ?>
					<div class="<?php echo $show_image === 1 ? 'col-md-6 custome-height': 'col-md-9'?> col-sm-12 title_withbtn">
						<a href="<?php echo base_url() . "$url_proudct/" . $ad['slug'];  ?>"><h4 <?php if (isset($ad['listing_header_priority'])  && $ad['listing_header_priority'] == 1) {
							echo "class='title_unboald'";
						} ?>>






						<!-- Added by asif -->

						<?php 

						if(isset($ad['sponsorship_priority']) && $ad['sponsorship_priority']  == 4 && isset($ad['listing_header_priority']) && $ad['listing_header_priority']  == 3){  ?>

							<span class="sponsored">Sponsored Premium</span>
							<br>

						<?php } 

						elseif(isset($ad['sponsorship_priority']) && $ad['sponsorship_priority']  == 4) {

							?>



							<span class="sponsored">Sponsored
								<!-- <i class="help-icon" data-tippy-placement="top" title="This is Ad as per your search">
									<i class="fa fa-info-circle sponsored"></i>
								</i> -->
							</span>
							<br>

						<?php } 
						elseif(isset($ad['listing_header_priority']) && $ad['listing_header_priority']  == 3) { 
							?>



							<span class="sponsored">Premium
								<!-- <i class="help-icon" data-tippy-placement="top" title="This is Ad as per your search">
									<i class="fa fa-info-circle sponsored"></i>
								</i> -->
							</span>
							<br>

						<?php }  else{  } ?>


						<!-- End Added By Asif -->




						<?php if (isset($ad['website_BusinessName'])) echo $ad['website_BusinessName']; ?></h4></a>

					
						<hr>
						<div class="start_coffee description_domain_a">
							<?php if (!empty($ad['description'])) echo _str_limit(strip_tags($ad['description']), $text_length_countss);    ?>  
						</div>
					</div>
					<div class="col-md-3 col-sm-12 price_div">
						<div class="float_right text">
							<!--  start mobile view -->
							<div class="price_withvalue_a_mobile">
								<?php if (!empty($common_listing['user_permission']['price'])  || $ad['user_id'] == $this->session->userdata('user_id')) {  ?>
									<div class="price">
										<span class="cutting_text "><del>
											<?php if (!empty($ad['website_discountprice'])) { ?>
												<?php if (isset($default_currency)) echo $default_currency;
												else echo '$'; ?><?php echo $ad['website_discountprice']; ?>
												<?php } ?></del>
											</span>
											<div class="price_with_a">
												<span class="pricetext d-block">Price</span>
												<?php if (!empty($ad['price'])) { ?>
													<span class="price_text"><?php if (isset($default_currency)) echo $default_currency;
													else echo '$'; ?><?php if (isset($ad['price'])) echo number_format(floatval($ad['price']), 2);																																				else echo number_format(floatval($ad['price']), 2);  ?></span>
												<?php } ?>

											</div>
										</div>
									<?php  } else
									if (empty($common_listing['user_permission']['price'])  && !empty($this->session->userdata('user_id'))) {  ?>
										<div class="btn buy_nowbtn mt-2 w-100 h-auto">
											<a href="javascript:void(0)" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 custom_contact_seller" id='upgradePlan'><span>See Price</span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
										</div>
									<?php } ?>
								</div>

								<!--  /end mobile view -->



								<!--  start desktop view -->
								<?php if (!empty($common_listing['user_permission']['price']) || $ad['user_id'] == $this->session->userdata('user_id')) {  
									$show_price_label = 0;
									?>
									<div class="desktop_price_a">
										<div class="price">
											<?php 
											if (!empty($ad['website_discountprice'])) { 
												$show_price_label++;
												?>
												<span class="cutting_text">
													<del><?php if (isset($default_currency)) echo $default_currency;
													else echo '$'; ?>
													<?php echo $ad['website_discountprice']; ?>
												</del></span>
											<?php } else {
												?> <span class="cutting_text invisible"><del>$2625</del></span>
											<?php } ?>

											<?php if (!empty($ad['price'])) { 
												$show_price_label++;
												?>
												<span style="font-size: 20px; padding-top: 1px; margin-bottom: 10px;">Price: </span>
												<span class="price_text"> <?php if (isset($default_currency)) echo $default_currency;
												else echo '$'; ?><?php if (isset($ad['price'])) echo number_format(floatval($ad['price']), 2);
												else echo number_format(floatval($ad['price']), 2);  ?></span>
											<?php } ?>
										</div>
										<?php if($show_price_label > 0) { //it means, if anyone price shows between 2 then this label will be visible ?>
											<!-- <span class="pricetext d-block">Priceasdas</span> -->
										<?php } ?>
									</div>
								<?php  } else if (empty($common_listing['user_permission']['price']) && !empty($this->session->userdata('user_id'))) {
									?>
									<div class="desktop_price_a">
										<div class="btn buy_nowbtn mt-2 w-100 h-auto">
											<a href="javascript:void(0)" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 custom_contact_seller" id='upgradePlan'><span>See Price</span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
										</div>
									</div>
								<?php } else
								if (empty($common_listing['user_permission']['price']) && empty($this->session->userdata('user_id'))) { ?>
									<div class="when_notprice_a">
										<p>price not show</p>
									</div>
									<div class="products_btn">
										<div class="btn buy_nowbtn mt-0 w-100 h-auto">
											<a href="#small-dialog-4" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 popup-with-zoom-anim custom_contact_seller">
												<span>See Price
												</span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
											</div>
										</div>

									<?php  }

									?>

									<!--  /end desktop view -->

									<?php
									if (!empty($common_listing['user_permission']['buy-now']) && !empty($common_listing['user_permission']['price'])) {  ?>
										<?php if (!empty($ad['price'])) : ?>

											<?php if ($ad['user_id'] !== $this->session->userdata('user_id')) { ?>


												<!-- start added by asif -->

												<div class="row" style="margin-bottom: 5px;">

													


													

													<?php if (!empty($ad['solution_url'])) { ?>
									<!-- show view demo -->
									<?php if (empty($common_listing['user_permission']['view-demo'])  && empty($this->session->userdata('user_id'))) { ?>
										<!-- Guest user to login to view demo website/domain -->
										<a  href="#small-dialog-4" class="view_demo  ripple-effect move-on-hover  popup-with-zoom-anim view_demo_btn my_btn">View Demo</a>

									<?php } else if (!empty($common_listing['user_permission']['view-demo']) || $ad['user_id'] == $this->session->userdata('user_id')) { ?>
										<!-- login to view demo website/domain -->
										<a target="_blank" href="<?php if (!empty($ad['solution_url'])) echo  $ad['solution_url']; ?> " class="view_demo  ripple-effect move-on-hover view_demo_btn my_btn">View Demo</a>

									<?php } 

									else if (empty($common_listing['user_permission']['view-demo'] && !empty($this->session->userdata('user_id')))) { ?>
										<!-- Logged-In user without permssion view demo -->
										<a  href="javascript:void(0)" class="view_demo  ripple-effect move-on-hover view_demo_btn my_btn" id='upgradePlan'> View Demo</a>
									<?php }
								} ?>




								<a href="<?php echo base_url() . "$url_proudct/" . $ad['slug'];  ?>" style="background-color: #38bffe; padding: 14px; font-size: 14px; color: #FFFFFF; font-weight: bold; width: 50%;" class="my_btn">View Listing</a>

												</div>

												<!-- End added by asif -->

												<?php 
												
												if(isset($ad['sold_or_not']) && !empty($ad['sold_or_not']) ){
													if($ad['sold_or_not']=='no' || (isset($common_listing['type']) && !empty($common_listing['type']) )){
														 
												 ?>
											
												<div class="">
													<div class="but_now d-flex buy_btn_a row">
														<a href="<?php echo base_url() . 'checkout/' . 'buynow-solution' . '/' . $ad['slug']; ?>" class="btn btn-default buy_nowbtn d-flex align-item-center">
															<span>Buy Now</span> <i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i>
														</a>
													</div>
													
												</div>
												<?php }
												else{ ?>
													<div class="">
													<div class="but_now d-flex buy_btn_a row">
														<button class="btn btn-default buy_nowbtn d-flex align-item-center">
															<span>Sold</span> 
														</button>
													</div>
													
												</div>
												<?php
												}
											} ?>




												
											<?php  } else { ?>
												<div class="btn buy_nowbtn mt-2 w-100 h-auto listing_type_btn_a">
													<a href="javascript:void(0)" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20  custom_contact_seller" data-user_id="<?php echo $ad['user_id']; ?>">
														<span>It belongs to You</span><i class="fa  ml-auto" aria-hidden="true"></i></a>
													</div>
												<?php  } ?>

											<?php endif; ?>
										<?php } else if ($ad['user_id'] === $this->session->userdata('user_id')) { ?>
											<div class="btn buy_nowbtn mt-2 w-100 h-auto listing_type_btn_a">
												<a href="javascript:void(0)" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20  custom_contact_seller">
													<span>It belongs to You</span><i class="fa  ml-auto" aria-hidden="true"></i></a>
												</div>

											<?php } else if (!empty($common_listing['user_permission']['contact-seller'])) {  ?>

												<div class="btn buy_nowbtn mt-2 w-100 h-auto listing_type_btn_a">
													<a href="#small-dialog-4" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 popup-with-zoom-anim custom_contact_seller" data-user_id="<?php echo $ad['user_id']; ?>">
														<span>Contact Seller
														</span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
													</div>
												<?php  } else if (empty($this->session->userdata('user_id') && empty($common_listing['user_permission']['contact-seller']))) { ?>
													<div class="btn buy_nowbtn mt-2 w-100 h-auto listing_type_btn_a">
														<a href="#small-dialog-4" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 popup-with-zoom-anim custom_contact_seller">
															<span>Contact Seller
															</span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
														</div>
													<?php  } else if (!empty($this->session->userdata('user_id') && empty($common_listing['user_permission']['contact-seller']))) { ?>
														<div class="btn buy_nowbtn mt-2 w-100 h-auto">
															<a href="javascript:void(0)" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 custom_contact_seller" id='upgradePlan'><span>Contact seller</span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
														</div>
													<?php } ?>
												</div>
											</div>
										</div>	
										<div class="clearfix"></div>
									<?php }
								} ?>