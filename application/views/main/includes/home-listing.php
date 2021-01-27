<div class="row">
	<?php
	foreach ($common_listing as $ad) { ?>
		<div class="col-sm-12 first_div mb-3 p-4 shadow">
			<div class="col-md-3 col-sm-12 image_div">
				<img src="<?php echo site_url('assets/img/users/'.$ad['website_thumbnail']); ?>" class="rounded">
			</div>
			<div class="col-md-6 col-sm-12 title_withbtn">
				<h4><?php if (isset($ad['website_BusinessName'])) echo $ad['website_BusinessName'];  ?></h4>

				<div class='row py-2'>
					<div class="col-md-12 col-sm-12 d-flex w-100 p-0"><a href="<?php echo site_url('static-products/'.$ad['id']); ?>" class="listing">View
							Listing</a><a href="#" class="view_demo">View Demo</a> </div> 
				</div>
				
				<hr>
				
				<!-- <p class="start_coffee"><?php if (!empty($ad['description'])) echo htmlspecialchars(_str_limit($ad['description'])); ?></p> -->
			</div>
			<div class="col-md-3 col-sm-12 price_div">
				<div class="float_right">
					<div class="price">
						
						<span class="price_text"><?php if (isset($ad['price'])) echo '$'.$ad['price']; ?></span>

					</div>
					<span class="pricetext d-block">Price</span>
					
					<div class="but_now d-flex">
						<a href="#" class="btn btn-default buy_nowbtn d-flex align-item-center"><span>Buy
								Now</span> <i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
					</div>
					
				</div>
			</div>
		</div>
	<?php } ?>
	
</div>