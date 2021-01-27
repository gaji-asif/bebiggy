	<div class="mobile_menu">
	<div class="row header_before_banner mobile_table">
            <div class="container p-0">
                <div class="col-sm-12">
                    
                <div class="text_herder_getnow">
                    <p>LIMITED TIME OFFER: 50% OFF & BUY GET 1 FREE.
						 <!-- <span><a href="#" class="get_now">GET NOW <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></span> -->
						
						</p>
                </div>
                </div>
            </div>
		</div>
		</div>
		<div class="desktop_menu">
			<div class="row header_before_banner">
	            <div class="container p-0">
	                <div class="col-sm-12">
	                    
	                <div class="text_herder_getnow">
	                    <p>LIMITED TIME OFFER: 50% OFF & BUY GET 1 FREE. 
							<!-- <span><a href="#" class="get_now">GET NOW <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></span> -->
						</p>
	                </div>
	                </div>
	            </div>
			</div>
		</div>
        
<section>
	<div class="row image_slider">
		<div class="container p-0">
			<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
    	
    	<div class="second_slider_text">
    		<h2 class="desktop_view">All You Need To Know About <br>Dropshipping </h2>
    		<h2 class="mobile_view">All You Need To Know About Dropshipping </h2>
    		<div class="para_text desktop_view">
    		<p>Drop shipping is a form of ecommerce online store where a store</p>
    		<p>doesn't keep the products it sells in stocks.</p>
			</div>
			<div class="para_text mobile_view">
    		<p>Drop shipping is a form of ecommerce online store where a store doesn't keep the products it sells in stocks.</p>
    		</div>
    		
    		<a href="#"><span>View More Features </span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
    	</div>
      <img class="d-block w-100" src="assets/img/first_banner.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
    	<div class="second_slider_text">
		<h2 class="desktop_view">All You Need To Know About <br>Dropshipping </h2>
    		<h2 class="mobile_view">All You Need To Know About Dropshipping </h2>
    		<div class="para_text desktop_view">
    		<p>Drop shipping is a form of ecommerce online store where a store</p>
    		<p>doesn't keep the products it sells in stocks.</p>
			</div>
			<div class="para_text mobile_view">
    		<p>Drop shipping is a form of ecommerce online store where a store doesn't keep the products it sells in stocks.</p>
    		</div>
    		
    		<a href="#"><span>View More Features </span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
    	</div>
      <img class="d-block w-100" src="assets/img/first_banner.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
    	<div class="second_slider_text">
		<h2 class="desktop_view">All You Need To Know About <br>Dropshipping </h2>
    		<h2 class="mobile_view">All You Need To Know About Dropshipping </h2>
    		<div class="para_text desktop_view">
    		<p>Drop shipping is a form of ecommerce online store where a store</p>
    		<p>doesn't keep the products it sells in stocks.</p>
			</div>
			<div class="para_text mobile_view">
    		<p>Drop shipping is a form of ecommerce online store where a store doesn't keep the products it sells in stocks.</p>
    		</div>
    		
    		<a href="#"><span>View More Features </span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
    	</div>
      <img class="d-block w-100" src="assets/img/first_banner.jpg" alt="Third slide">
    </div>
  </div>
  <!-- <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a> -->
</div>

		</div>
	</div>
</section>
<?php if(!empty($data) && !empty($data['home_type_1'])) { ?>
<section>
	<div class="row ecommerce_div">
		<div class="container">
			<div class="title_ecommerce">
				<center>
				<h2 class="desktop_view">BUY FEATURED SHOPIFY DROPSHIP STORES & ECOMMERCE WEBSITES FOR SALE</h2>
				<h2 class="mobile_view">BUY FEATURED SHOPIFY DROPSHIP STORES & ECOMMERCE WEBSITES FOR SALE</h2>
				
				</center>
			</div>
			
			<?php $this->load->view('main/includes/home-listing', ['common_listing'=>$data['home_type_1']]); ?>
			<div class="row">
				<div class="view-btn d-block w-100 text-center">
					<div class="btn_allview view_btn">
						<a href="#" class="btn btn-default d-flex justify-content-between">
							<span>View All Shopify Dropship Shopify Stores & Ecommerce Websites </span>
							<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</section>
<?php } ?>

<?php if(!empty($data) && !empty($data['home_type_2'])) { ?>
<section>
	<div class="row ecommerce_div">
		<div class="container">
			<div class="title_ecommerce">
				<center>
				<h2 class="desktop_view">BUY FEATURED PREMIUM SHOPIFY DROPSHIP STORES & ECOMMERCE WEBSITES FOR SALE</h2>
				<h2 class="mobile_view">BUY FEATURED PREMIUM SHOPIFY DROPSHIP STORES & ECOMMERCE WEBSITES FOR SALE</h2>
				
				</center>
			</div>
			
			<?php $this->load->view('main/includes/home-listing', ['common_listing'=>$data['home_type_2']]); ?>
			<div class="row">
				<div class="view-btn d-block w-100 text-center">
					<div class="btn_allview view_btn">
						<a href="#" class="btn btn-default d-flex justify-content-between">
							<span>View All Shopify Dropship Shopify Stores & Ecommerce Websites </span>
							<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</section>
<?php } ?>

<?php if(!empty($data) && !empty($data['home_type_3'])) { ?>
<section>
	<div class="row ecommerce_div">
		<div class="container">
			<div class="title_ecommerce">
				<center>
				<h2 class="desktop_view">BUY FEATURED PREMIUM SHOPIFY DROPSHIP STORES & ECOMMERCE WEBSITES FOR SALE</h2>
				<h2 class="mobile_view">BUY FEATURED PREMIUM SHOPIFY DROPSHIP STORES & ECOMMERCE WEBSITES FOR SALE</h2>
				
				</center>
			</div>
			
			<?php $this->load->view('main/includes/home-listing', ['common_listing'=>$data['home_type_3']]); ?>
			<div class="row">
				<div class="view-btn d-block w-100 text-center">
					<div class="btn_allview view_btn">
						<a href="#" class="btn btn-default d-flex justify-content-between">
							<span>View All Shopify Dropship Shopify Stores & Ecommerce Websites </span>
							<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</section>
<?php } ?>

<!-- Listing Domain -->
<?php /* if(in_array('domain',array_column($platforms,'platform'))) { ?>
	<?php 
		if(!empty($featuredDomains)) { 
			$common_listing = $featuredDomains;
	?>
		<section>
			<div class="row ecommerce_div">
				<div class="container">
					<div class="title_ecommerce">
						<center>
						<h2 class="desktop_view"><?php echo $this->lang->line('lang_featured_domain_title'); ?></h2>
						<h2 class="mobile_view"><?php echo $this->lang->line('lang_featured_domain_title'); ?></h2>
						
						</center>
					</div>
					<?php $this->load->view('main/includes/common-lisiting', ['common_listing'=>$common_listing]); ?>
					<div class="row">
						<div class="view-btn d-block w-100 text-center">
							<div class="btn_allview view_btn">
								<a href="#" class="btn btn-default d-flex justify-content-between">
									<span>View All Shopify Dropship Shopify Stores & Ecommerce Websites </span>
									<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php } ?>
<?php } */ ?>
<?php /*
<!-- Listing website -->
<?php if(in_array('website',array_column($platforms,'platform'))) { ?>
	<?php 
		if(!empty($featuredWebsite)) { 
			$common_listing = $featuredWebsite;
	?>
		<section>
			<div class="row ecommerce_div last_div">
				<div class="container">
					<div class="title_ecommerce">
						<center>
						<h2>Websites</h2>
						
						</center>
					</div>
					<?php $this->load->view('main/includes/common-lisiting', ['common_listing'=>$common_listing]); ?>
					<div class="row">
						<div class="view-btn d-block w-100 text-center">
							<div class="btn_allview view_btn">
								<a href="#" class="btn btn-default d-flex justify-content-between">
									<span>View All Shopify Dropship Shopify Stores & Ecommerce Websites </span>
									<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
							</div>
							
						</div>
					</div>
				</div>

			</div>
		</section>
	<?php } ?>
<?php } ?>


<!-- Listing App -->
<?php if(in_array('app',array_column($platforms,'platform'))) { ?>
	<?php 
		if(!empty($featuredApp)) { 
			
			$common_listing = $featuredApp;
	?>
		<section>
			<div class="row ecommerce_div last_div">
				<div class="container">
					<div class="title_ecommerce">
						<center>
						<h2>App</h2>
						
						</center>
					</div>
					<?php $this->load->view('main/includes/common-lisiting', ['common_listing'=>$common_listing]); ?>
					<div class="row">
						<div class="view-btn d-block w-100 text-center">
							<div class="btn_allview view_btn">
								<a href="#" class="btn btn-default d-flex justify-content-between">
									<span>View All Shopify Dropship Shopify Stores & Ecommerce Websites </span>
									<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
							</div>
							
						</div>
					</div>
				</div>

			</div>
		</section>
	<?php } ?>
<?php } ?>


<?php if(in_array('business',array_column($platforms,'platform'))) { ?>
	<?php 
		if(!empty($featuredBusiness)) { 
			$common_listing = $featuredBusiness;
	?>
		<section>
			<div class="row ecommerce_div last_div">
				<div class="container">
					<div class="title_ecommerce">
						<center>
						<h2>App</h2>
						
						</center>
					</div>
					<?php $this->load->view('main/includes/common-lisiting', ['common_listing'=>$common_listing]); ?>
					<div class="row">
						<div class="view-btn d-block w-100 text-center">
							<div class="btn_allview view_btn">
								<a href="#" class="btn btn-default d-flex justify-content-between">
									<span>View All Shopify Dropship Shopify Stores & Ecommerce Websites </span>
									<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
							</div>
							
						</div>
					</div>
				</div>

			</div>
		</section>
	<?php } ?>
<?php } ?>
*/
?>

<section>
	<div class="row money_div pb-5">
		<div class="container">
			<div class="title_ecommerce text-center">
				
				<h2>Make Money Drop Shipping</h2>
			
			</div>
			<div class="tabs_money">
				  <ul class="nav nav-tabs" role="tablist"> 
				    <li class="nav-item">
				      <a class="nav-link active" data-toggle="tab" href="#home">
						  <img src="assets/img/first_tab.png" class="first_img" style="display: none;">
						  <img src="assets/img/graph.png" class="round img_active " style="display: block;">
						  <div><span class="title_nav">Low Cost</span><br><span class="subtitle">Bigger Net Profit</span></div></a>
				    </li>
				    <li class="nav-item">
				      <a class="nav-link" data-toggle="tab" href="#menu1">
						  <img src="assets/img/flyimage.png" class="first_img">
						  <img src="assets/img/widelogo.png" class="img_active">

						  <div><span class="title_nav">Wide Product Selection</span><br><span class="subtitle">More Customers</span></div></a>
				    </li>
				    <li class="nav-item">
				      <a class="nav-link" data-toggle="tab" href="#menu2">
						  <img src="assets/img/thumb.png"  class="first_img">
						  <img src="assets/img/hand.png"  class="img_active">
						  <div><span class="title_nav">Easy To Get Started</span><br><span class="subtitle">Sooner To Start Earning</span></div></a>
				    </li>
				     <li class="nav-item">
				      <a class="nav-link" data-toggle="tab" href="#menu2">
						  <img src="assets/img/weight.png" class="first_img">
						  <img src="assets/img/weight_new.png" class="img_active">
						  <div><span class="title_nav">Easy To Scale </span><br><span class="subtitle">There Is Not Limit!</span></div></a>
				    </li>
				  </ul>

				  <!-- Tab panes -->
				  <div class="tab-content">
				    <div id="home" class="container tab-pane active"><br>
				    	<div class="top_bar"></div>
				      <h3>Wide Product Selection</h3>
				       <p>Since you do not have to pre-purchase the products you sell on your dropship website, you can offer a wide selection of products to your customers. Listing many products on your website does not cause any additional costs to you, as long as the supplier has it in stock.</p>
				    </div>
				    <div id="menu1" class="container tab-pane fade"><br>
				    	<div class="top_bar"></div>
				       <h3>Wide Product Selection</h3>
				        <p>Since you do not have to pre-purchase the products you sell on your dropship website, you can offer a wide selection of products to your customers. Listing many products on your website does not cause any additional costs to you, as long as the supplier has it in stock.</p>
				    </div>
				    <div id="menu2" class="container tab-pane fade"><br>
				    	<div class="top_bar"></div>
				       <h3>Wide Product Selection</h3>
				       <p>Since you do not have to pre-purchase the products you sell on your dropship website, you can offer a wide selection of products to your customers. Listing many products on your website does not cause any additional costs to you, as long as the supplier has it in stock.</p>
				    </div>
				  </div>
			</div>
			
		</div>

	</div>
</section>
<section>
	<div class="row benefits_div pb-5">
		<div class="container p-0">
			<div class="benefits_title py-5">
				<center>
				<h2>Benefits</h2>
				<h3>Perks of running a  dropship business</h3>
				</center>
			</div>
			<div class="col-md-12 icon_text">
				<div class="col-md-3 col-sm-6">
					<div class="box_benefits">
						<img src="assets/img/box_image.png"><br>
						<p>No need to worry about packing and shipping your orders</p>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
				<div class="box_benefits">
						<img src="assets/img/truck_image.png"><br>
						<p>No need to worry about packing and shipping your orders</p>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
				<div class="box_benefits">
						<img src="assets/img/girl_image.png"><br>
						<p>No need to worry about packing and shipping your orders</p>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
				<div class="box_benefits">
						<img src="assets/img/cutting_icon.png"><br>
						<p>No need to worry about packing and shipping your orders</p>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</section>
<section>
	<div class="row business_sales_div pb-5">
		<div class="container p-0">
			<div class="col-md-12 px-0 py-5">
				<div class="col-md-8 col-sm-12">
					<h2>Turnkey Drop Shipping Business For Sale</h2>
					<h4>Check out latest additions to our list of profitable turnkey websites for sale.</h4>
				</div>
				<div class="col-md-4 col-sm-12 check_now_btn">
					<a href="#" class="btn btn-default check_nowbtn"><span>Check Now</span> <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
				</div>
			</div>
			
		</div>
	</div>
</section>

<section>
	<div class="row start_yourown dropshipping_div">
		<div class="container p-0 py-5">
			<div class="title_ecommerce">
				
				<h2>Start Your Own Dropshipping Store The Easy Way?</h2>
				
			</div>
			<div class="col-md-12 px-0">
				<p>Buy E-Commerce Dropshipping Websites for sale and start your own business in just a few clicks. Drop Shipping a product means you don’t keep any stock, the supplier will ship the product direct to your customer for you, allowing you to focus on building your online business. Click below to get started or see our latest offers!</p>
				<a href="#" class="btn btn-default start_yourown_nowbtn my-4"><span>Get Started</span> <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
			</div>
			
		</div>
	</div>
</section>

<section>
	<div class="row need_div">
		<div class="container py-5">
			<img src="assets/img/top.png" class="image_back">
			
				<div class="col-md-8 col-sm-12">
					<h2>Need To Know More ?</h2>
					<p>Looking for a profitable e-commerce business but don't have time to build it form scratch?<br>
						Here is a solution.  BUY TURNKEY SHOPIFY DROPSHIP STORES & WEBSITES FOR SALES.
					</p>
				</div>
				<div class="col-md-4 col-sm-12">
					<a href="#" class="btn btn-default learn_nowbtn justify-content-between"><span>Learn More</span> <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
				</div>
			
			<img src="assets/img/bottom.png" class="bottomimage_back">
			
		</div>
	</div>
</section>

<section>
	<div class="row start_yourown testimonila_div">
		<img src="assets/img/leftimage.png" class="leftimage">
		<img src="assets/img/leftimage.png" class="rightimagesecond">
		<div class="container p-0 py-5">
			<div class="title_ecommerce py-4">
				<h2>Success Stories</h2>
			</div>
			<div class="col-md-12 px-0 pb-4 success_para">
				<h3>Don’t just take our word for it – check out what our clients have to say about us.</h3>
				
			</div>
			<div class="col-md-12 px-0">
				<div class="owl-carousel success_owl">
				    <div class="item text-center">
				    	<p>I learned with BE BIGGY what I could not in my last few years of online study plus I also own a drop shipping business.  Their no nonsense approach keeps aside theory.  These guys are action focused.</p>
				    	<h3 class="py-3">Denice, Bought Pet Supply Website</h3>
				    </div>


				    <div class="item text-center">
				    	<p>I learned with BE BIGGY what I could not in my last few years of online study plus I also own a drop shipping business.  Their no nonsense approach keeps aside theory.  These guys are action focused.</p>
				    	<h3 class="py-3">Denice, Bought Pet Supply Website</h3>
				    </div>

				    <div class="item text-center">
				    	<p>I learned with BE BIGGY what I could not in my last few years of online study plus I also own a drop shipping business.  Their no nonsense approach keeps aside theory.  These guys are action focused.</p>
				    	<h3 class="py-3">Denice, Bought Pet Supply Website</h3>
				    </div>
				    <div class="item text-center">
				    	<p>I learned with BE BIGGY what I could not in my last few years of online study plus I also own a drop shipping business.  Their no nonsense approach keeps aside theory.  These guys are action focused.</p>
				    	<h3 class="py-3">Denice, Bought Pet Supply Website</h3>
				    </div>
				    <div class="item text-center">
				    	<p>I learned with BE BIGGY what I could not in my last few years of online study plus I also own a drop shipping business.  Their no nonsense approach keeps aside theory.  These guys are action focused.</p>
				    	<h3 class="py-3">Denice, Bought Pet Supply Website</h3>
				    </div>
				    <div class="item text-center">
				    	<p>I learned with BE BIGGY what I could not in my last few years of online study plus I also own a drop shipping business.  Their no nonsense approach keeps aside theory.  These guys are action focused.</p>
				    	<h3 class="py-3">Denice, Bought Pet Supply Website</h3>
				    </div>
				    <div class="item text-center">
				    	<p>I learned with BE BIGGY what I could not in my last few years of online study plus I also own a drop shipping business.  Their no nonsense approach keeps aside theory.  These guys are action focused.</p>
				    	<h3 class="py-3">Denice, Bought Pet Supply Website</h3>
				    </div>
				    <div class="item text-center">
				    	<p>I learned with BE BIGGY what I could not in my last few years of online study plus I also own a drop shipping business.  Their no nonsense approach keeps aside theory.  These guys are action focused.</p>
				    	<h3 class="py-3">Denice, Bought Pet Supply Website</h3>
				    </div>
				    <div class="item text-center">
				    	<p>I learned with BE BIGGY what I could not in my last few years of online study plus I also own a drop shipping business.  Their no nonsense approach keeps aside theory.  These guys are action focused.</p>
				    	<h3 class="py-3">Denice, Bought Pet Supply Website</h3>
				    </div>
				   
				</div>
			</div>
		</div>
	</div>
</section>


<section>
	<div class="row get_started py-5">
		<div class="container p-0">
			<div class="title_ecommerce pb-3">
				<h2>How To Get Started With Your Dropshipping Business</h2>
			</div>
			<div class="col-md-12 px-0">

				<h4>Start your dream dropshipping e-commerce business today, it’s really easy to get started.</h4>
				
			</div>
			<div class="col-md-12 py-4 box_div px-0">
				<div class="col-md-4 col-sm-4">
					<div class="box_shadow">
					<div class="box_get_started">
						<h2>1.</h2>
			
						<p>Browse our range of drop ship websites and buy online.</p>
					</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-4">
					<div class="box_shadow">
				<div class="box_get_started">
					<h2>2.</h2>
						
						<p>You will receive access details to your new business</p>
					</div>
				</div>
				</div>
				<div class="col-md-4 col-sm-4">
					<div class="box_shadow">
				<div class="box_get_started">
					<h2>3.</h2>
						
						<p>Start Selling!</p>
					</div>
				</div>
			</div>
				
			</div>
			<div class="clearfix"></div>
			<div class="col-md-12 each_div py-4 mt-4">
					<p>Each e-commerce website is ready to run out of the box. Simply advertise your website and start selling to make profits from day one. If you need help, we have a range of guides and provide a video course to help you along the way to a profitable e-commerce store.
					</p>
			</div>

		</div>
	</div>
</section>

<section>
	<div class="row get_started pb-5">
		<div class="container p-0">
			<div class="title_ecommerce pb-3">
				<h2>Latest On Blog</h2>
			</div>
			
			<div class="col-md-12 py-4 box_div px-0">
				<div class="col-md-4 col-sm-4">
					<div class="blog">
					<img src="assets/img/blog_image.png" class="rounded">
					</div>
					<div class="blog_title text-left py-2">
						<h3>How To Launch Dropshipping Store At Low Cost?</h3>
					</div>
					<div class="read_more text-left">
						<a href="#"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
					</div>
				</div>
				<div class="col-md-4 col-sm-4">
					<div class="blog">
					<img src="assets/img/blog_image.png" class="rounded">
					</div>
					<div class="blog_title text-left py-2">
						<h3>Best Dropshipping Niches For 2019</h3>
					</div>
					<div class="read_more text-left">
						<a href="#"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
					</div>
				</div>
				<div class="col-md-4 col-sm-4">
					<div class="blog">
					<img src="assets/img/blog_image.png" class="rounded">
					</div>
					<div class="blog_title text-left py-2">
						<h3>Things You Can’t Advertise On Facebook</h3>
					</div>
					<div class="read_more text-left">
						<a href="#"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
					</div>
				</div>
				
			</div>

		</div>
	</div>
</section>
