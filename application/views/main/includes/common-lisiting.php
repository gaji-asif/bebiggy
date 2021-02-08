	<?php
	foreach ($common_listing as $ad) {
		//pre($common_listing , 1);
		//pre($data['commonData']['user_permission']);
		if (isset($ad['id'])) {
	?>
			<div class="row first_div mb-3 p-4 shadow <?php if (isset($ad['listing_header_priority']) && $ad['listing_header_priority'] != 1) echo "sponsership_bgcolor" ?>">
			<?php 
				$show_image = 0;
				
				if (!empty($ad['listing_header_priority']) && $ad['listing_header_priority'] != 1) {
					if(isset($ad['website_thumbnail'])){

						$img_url = FCPATH . IMAGES_UPLOAD . $ad['website_thumbnail'];
						
						if (fileExists($img_url)) {

							$show_image = 1;
							$img_url = base_url() . IMAGES_UPLOAD . $ad['website_thumbnail'];
						}
					}
				}?>
				<?php 
				if($show_image === 1):	?>
				<div class="col-md-3 col-sm-12 image_div">					
					<img src="<?php echo $img_url; ?>" class="rounded">					
				</div>
				<?php endif ?>

				<?php /*if (!empty($ad['listing_header_priority']) && $ad['listing_header_priority'] != 1) :  ?>
					<div class="col-md-3 col-sm-12 image_div">
						<?php
						$img_url = base_url() . NO_IMAGE . 'Noimage.jpeg';
						if (isset($ad['website_thumbnail'])) {
							$img_url = FCPATH . IMAGES_UPLOAD . $ad['website_thumbnail'];

							if (fileExists($img_url)) {

								$img_url = base_url() . IMAGES_UPLOAD . $ad['website_thumbnail'];
							} else {
								$img_url = base_url() . NO_IMAGE . 'Noimage.jpeg';
							}
						} else {
							$img_url = base_url() . NO_IMAGE . 'Noimage.jpeg';
						}
						?>
						<img src="<?php echo $img_url; ?>" class="rounded">
					</div>
				<?php else : ?>
					<div class="col-md-3 col-sm-12 image_div">
						<?php
						$img_url = base_url() . NO_IMAGE . 'Noimage.jpeg';
						?>
						<img src="<?php echo $img_url; ?>" class="rounded">
					</div>
				<?php endif; */?>
				<div class="<?php echo $show_image === 1 ?'col-md-6' : 'col-md-9'?> col-sm-12 title_withbtn">
					<h4 <?php if (isset($ad['listing_header_priority']) && $ad['listing_header_priority'] == 1) {
							echo "class='title_unboald'";
						} ?>>
						<?php if (isset($ad['sponsorship_priority']) && $ad['sponsorship_priority']  == 4) { ?>
							<span class="sponsored">Sponsored
								<i class="help-icon" data-tippy-placement="top" title="This is Ad as per your search">
									<i class="fa fa-info-circle sponsored"></i>
								</i>
							</span>
							<br>
						<?php  } ?>
						<?php if (isset($ad['website_BusinessName'])) {
							echo ' <a href="'.base_url() . $ad['listing_option'] . '/' . $ad['listing_type'] . '/' . $ad['slug'].  '">'.$ad['website_BusinessName'];
							if (isset($ad['listing_header_priority']) && $ad['listing_header_priority'] == 3)
								echo " (Premium) ";
								
								echo '</a>';
						}	
						?></h4>
					<div class='row py-2 p-0'>
						<div class="col-md-12 col-sm-12 d-flex w-100 p-0">
							<a href="<?php echo base_url() . $ad['listing_option'] . '/' . $ad['listing_type'] . '/' . $ad['slug'];  ?>" class="listing">View Listing</a>

							<?php if ($ad['listing_type'] !== 'app' && $ad['listing_type'] !== 'business') { ?>
								<?php if ((!empty($common_listing['user_permission']['view-demo'])) || $ad['user_id']  == $this->session->userdata('user_id')) {  ?>
									<!--   Permssion to view demo website/domain -->
									<a target="_blank" href="<?php if (!empty($ad['website_BusinessName'])) echo '//' . $ad['website_BusinessName']; ?>" class="view_demo">View Demo</a>

								<?php  } else if (empty($common_listing['user_permission']['view-demo']) && empty($this->session->userdata('user_id'))) { ?>

									<!-- Guest user to login to view demo website/domain -->
									<a href="#small-dialog-4" class="view_demo  ripple-effect move-on-hover  popup-with-zoom-anim ">View Demo</a>


								<?php } else if (!empty($this->session->userdata('user_id'))  && empty($common_listing['user_permission']['view-demo'])) { ?>

									<!-- Logged-In user without permssion view demo -->
									<a href="javascript:void(0)" class="view_demo  ripple-effect move-on-hover" id='upgradePlan'>View Demo</a>

								<?php }  ?>
							<?php

							} else  if ($ad['listing_type'] == 'app') { ?>

								<!-- for app only start  -->

								<?php if ((!empty($common_listing['user_permission']['view-demo']))  || $ad['user_id']  == $this->session->userdata('user_id')) {  ?>

									<a target="_blank" href="<?php if (!empty($ad['app_url'])) echo  $ad['app_url']; ?>" class="view_demo">View Demo</a>

								<?php  } else if (empty($this->session->userdata('user_id'))) { ?>

									<!-- Guest user to login to view demo website/domain -->
									<a href="#small-dialog-4" class="view_demo  ripple-effect move-on-hover  popup-with-zoom-anim ">View Demo</a>


								<?php } else if (!empty($this->session->userdata('user_id'))  && empty($common_listing['user_permission']['view-demo'])) { ?>

									<!-- Logged-In user without permssion view demo -->
									<a href="javascript:void(0)" class="view_demo  ripple-effect move-on-hover" id='upgradePlan'>View Demo</a>

							<?php }
							}  ?>

							<!-- for app only end  -->
						</div>
					</div>
					<hr>
					<div class="start_coffee website_descrition_a"><?php if (!empty(($ad['description']))) echo _str_limit(strip_tags($ad['description']), text_lenght_front);  ?></div>
				</div>
				<div class="col-md-3 col-sm-12 price_div">
					<div class="float_right">
						<!-- see price start -->
						<?php if (!empty($common_listing['user_permission']['price']) || $ad['user_id'] == $this->session->userdata('user_id')) {
						?>
							<div class="price">
								<?php // echo $ad['website_discountprice'] , 'website_discountprice'; 
								?>
								<?php if (!empty($ad['website_discountprice']) && !empty($ad['website_buynowprice'])) { ?>
									<!-- discount price see when discount price not empty and buy now price is also not empty -->
									<span class="cutting_text"><del><?php if (isset($default_currency)) echo $default_currency;
																	else echo '$'; ?><?php echo $ad['website_discountprice']; ?></del></span>
								<?php } ?>

								<?php  //echo $ad['website_buynowprice'] . 'website_buynowprice'  ;  
								?>
								<?php if (!empty($ad['website_buynowprice'])) { ?>
									<!-- buynow price will see if has permssion  -->
									<span class="price_text actual_prices_a"><?php if (isset($default_currency)) echo $default_currency;
																				else echo '$'; ?><?php if (isset($ad['website_buynowprice'])) echo number_format(floatval($ad['website_buynowprice']));
																									else echo number_format(floatval($ad['website_buynowprice']));  ?></span>
								<?php } ?>
							</div>
							<?php if (!empty($ad['website_buynowprice']) || !empty($ad['website_discountprice'])) { ?>
								<span class="pricetext actual_prices_a d-block">Price</span>
							<?php } else { ?>
								<div class="price but_now d-flex">
									<span class="pricetext actual_prices_a d-block invisible">&nbsp;</span>
								</div>
							<?php  } ?>

							<?php if (empty($ad['website_buynowprice']) && empty($ad['website_discountprice'])) { ?>
								<!-- if buynow-price and discount-price both are not available   -->
								<span class="text-danger invisible">No price available </span>
							<?php } ?>


						<?php } else if (empty($common_listing['user_permission']['price']) && empty($this->session->userdata('user_id'))) {  ?>

							<!--  guest user  need to logged in  -->
							<div class="btn buy_nowbtn mt-0 w-100 h-auto">
								<a href="#small-dialog-4" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 popup-with-zoom-anim custom_contact_seller" ?><span>See Price</span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
							</div>

						<?php  } else if ($this->uri->segment(1) !== 'businesses' && empty($common_listing['user_permission']['price']) && !empty($this->session->userdata('user_id'))) {  ?>
							<div class="btn buy_nowbtn mt-0 w-100 h-auto">
								<a href="javascript:void(0)" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 custom_contact_seller" id='upgradePlan'><span>See Price</span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
							</div>
						<?php } else { ?>
							<div class="btn buy_nowbtn mt-4 w-100 h-auto invisible">
								<a href="javascript:void(0)" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 custom_contact_seller" id='upgradePlan'><span></span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
							</div>
						<?php } ?>
						<!-- see price end -->
						<?php if (!empty($ad['website_buynowprice']) && !empty($common_listing['user_permission']['price'])) { ?>
							<!-- user has buynow-price and has perimission to see price  -->
							<?php if (!empty($common_listing['user_permission']['buy-now'])) {  ?>
								<!--  user has buynow permission  -->
								<?php if ($ad['user_id'] !== $this->session->userdata('user_id')) { ?>
									<!--  Product belongs to different user -->
									<div class="but_now d-flex">
										<a href="<?php echo base_url() . 'checkout/' . 'buynow' . '/' . $ad['slug']; ?>" class="btn btn-default buy_nowbtn d-flex align-item-center"><span>Buy Now</span> <i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
									</div>
								<?php  } else { ?>
									<div class="btn buy_nowbtn mt-2 w-100 h-auto listing_type_btn_a">
										<a href="javascript:void(0)" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 custom_contact_seller" ?>
											<span>It belongs to You</span><i class="fa  ml-auto" aria-hidden="true"></i></a>
									</div>
								<?php  } ?>
							<?php } else if ($ad['user_id'] !== $this->session->userdata('user_id')) {  ?>
								<!--  product belongs to different user -->
								<?php if (!empty($common_listing['user_permission']['contact-seller'])) {  ?>
									<!-- user has contact seller permission -->

									<div class="btn buy_nowbtn mt-2 w-100 h-auto listing_type_btn_a">
										<a href="#small-dialog-4" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 popup-with-zoom-anim custom_contact_seller" data-user_id="<?php echo $ad['user_id']; ?>">
											<span>Contact Seller
											</span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
									</div>

								<?php } else if (!empty($this->session->userdata('user_id') && empty($common_listing['user_permission']['contact-seller']))) { ?>
									<!-- logged in user has not contact seller permission -->

									<div class="btn buy_nowbtn mt-2 w-100 h-auto">
										<a href="javascript:void(0)" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 custom_contact_seller" id='upgradePlan'><span>Contact Seller</span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
									</div>
								<?php  } else if (empty($this->session->userdata('user_id') && empty($common_listing['user_permission']['contact-seller']))) { ?>
									<!-- guest user need to login -->
									<div class="btn buy_nowbtn mt-2 w-100 h-auto listing_type_btn_a">
										<a href="#small-dialog-4" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 popup-with-zoom-anim custom_contact_seller">
											<span>Contact Seller
											</span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
									</div>
								<?php  }
							} else if ($ad['user_id'] === $this->session->userdata('user_id')) { ?>
								<!-- product belongs to same user -->
								<div class="btn buy_nowbtn mt-2 w-100 h-auto listing_type_btn_a">
									<a href="javascript:void(0)" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 custom_contact_seller" data-user_id="<?php echo $ad['user_id']; ?>">
										<span>It belongs to You</span><i class="fa  ml-auto" aria-hidden="true"></i></a>
								</div>

							<?php } ?>

						<?php } else if (($ad['user_id'] !== $this->session->userdata('user_id'))) {  ?>
							<!-- product belongs to different user  -->

							<?php if (!empty($common_listing['user_permission']['contact-seller'])) {  ?>
								<!-- user has contact seller permission  -->
								<div class="btn buy_nowbtn mt-2 w-100 h-auto listing_type_btn_a">
									<a href="#small-dialog-4" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 popup-with-zoom-anim custom_contact_seller" data-user_id="<?php echo $ad['user_id']; ?>">
										<span>Contact Seller
										</span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
								</div>
							<?php  } else if (empty($this->session->userdata('user_id') && empty($common_listing['user_permission']['contact-seller']))) { ?>
								<!-- Guest user Login to see Contact-seller permission -->
								<div class="btn buy_nowbtn mt-2 w-100 h-auto listing_type_btn_a">
									<a href="#small-dialog-4" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 popup-with-zoom-anim custom_contact_seller">
										<span>Contact Seller
										</span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
								</div>
							<?php } else if (!empty($this->session->userdata('user_id') && empty($common_listing['user_permission']['contact-seller']))) { ?>
								<!--  user is logged in but no have contact seller permission  -->
								<div class="btn buy_nowbtn mt-2 w-100 h-auto">
									<a href="javascript:void(0)" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 custom_contact_seller" id='upgradePlan'><span>Contact Seller</span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
								</div>

							<?php }
						} else if ($ad['user_id'] === $this->session->userdata('user_id')) { ?>
							<div class="btn buy_nowbtn mt-2 w-100 h-auto listing_type_btn_a">
								<a href="javascript:void(0)" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 custom_contact_seller">
									<span>It belongs to You</span><i class="fa  ml-auto" aria-hidden="true"></i></a>
							</div>

						<?php } ?>


					</div>
				</div>
			</div>
	<?php }
	} ?>
	<?php $this->load->view('main/includes/models'); ?>