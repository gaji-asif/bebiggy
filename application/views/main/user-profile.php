
<div class="clearfix"></div>
<!-- Page Content-->
<div class="container user_profile_section_a">
	<div class="row">
		<input type="hidden" name="listingidwebsite" id="listingidwebsite" value="<?php if(isset($listing_data[0]['id'])) echo $listing_data[0]['id']; ?>">
		<!-- Content -->
		<div class="col-md-8 col-sm-12 content-right-offset user_view_section_a">
		<div class="imil-box margin-bottom-30">
            <div class="slippa-box-style-2">
                <h4 class="f-size-36 f-size-xs-30 slippa-semiblod user_profilename_a"><?php if(isset($userprofile[0]['firstname'])) echo $userprofile[0]['firstname'].' '.$userprofile[0]['lastname']; ?> <span></h4>  
                	<?php if(!empty($this->session->userdata('user_id'))) { ?>
					<?php if($userprofile[0]['user_id'] !== $this->session->userdata('user_id')) { ?>
					<a href="#small-dialog-2" class="popup-with-zoom-anim badge badge-light"><i class="icon-material-outline-thumb-up"></i> Leave a Review</a>
					<?php } } ?>  
                <div class="row margin-top-30">
                    <div class="domain-border col-lg-3 username_a">
                        <span class="d-block f-size-23 slippa-semiblod username_a"><?php if(isset($userprofile[0]['username'])) echo '@'.$userprofile[0]['username']; ?></span>
                        <span class="d-block f-size-16 slippa-light3">Username</span>
                    </div>

                    <div class="domain-border col-lg-6">
                        <span class="f-size-24 slippa-semiblod star_view_a"><div class="star-rating" data-rating="<?php if(isset($profileRatingsAvg[0]['avg_r'])) echo number_format(floatval($profileRatingsAvg[0]['avg_r']),1); ?>"></div></span>
                        <span class="d-block f-size-16 slippa-light3">Reviews</span>
                    </div>

                    <div class="col-lg-3 media-body">
                        <span class="d-block f-size-24 slippa-semiblod">
						<img class="flag" src="<?php echo base_url().ICON_FLAGS ?><?php if(isset($userprofile[0]['user_country'])) echo strtolower($userprofile[0]['user_country']); ?>.svg" alt=""> <?php if(isset($userprofile[0]['user_country'])) echo strtoupper($userprofile[0]['user_country']); ?></span>
                        <span class="d-block f-size-16 slippa-light3 country_title_a">Country</span>
                   </div>

                </div><!-- /.d-flex -->
            </div><!-- /.slippa-box-style-2 -->
            <div class="slippa-gradient-4 text-center f-size-18 slippa-semiblod padding-top-10 margin-bottom-10 padding-bottom-10 text-white package_section_a premium_button_a">
                Premium Seller
           	</div><!-- /.slippa-gradient-4 -->
        </div><!-- /.imil-box -->

        <div class="slippa-box-style-2 margin-bottom-30 about_person_a">
        	<span class="f-size-24 d-block margin-bottom-30"><h3>About Me</h3></span>
        	 <!-- About me -->
			<p class="f-size-18 slippa-light3 line-height-34"><?php if(isset($userprofile[0]['user_description'])) echo $userprofile[0]['user_description']; ?></p>

			<!----User Review ------>
			<div id="user_reviews_tab" class="boxed-list margin-bottom-60">
				<div class="boxed-list-headline review_a">
					<h3><i class="icon-material-outline-thumb-up"></i> User Reviews</h3>
				</div>
				<ul class="boxed-list-ul">
					<?php if(!empty($profileRatings)) { foreach ($profileRatings as $review) { ?>

					<!----User Review ------>
					<li>
						<div class="boxed-list-item">
							<div class="review-avatar">
								<a href="<?php echo base_url().'main/user_profile/'.$review['user_id']; ?>"><img src="<?php if(isset($review['thumbnail'])) echo base_url().USER_UPLOAD.$review['thumbnail']; ?>" alt=""></a>
							</div>
							<!-- Content -->
							<div class="item-content">

								<h4><a href="<?php echo base_url().'main/user_profile/'.$review['user_id']; ?>"><?php if(isset($review['username'])) echo $review['firstname'].' '.$review['lastname']; ?> <span><?php if(isset($review['username'])) echo '@'.$review['username']; ?></span></a></h4>
								<div class="star_view_a item-details margin-top-10">
									<div class="star-rating" data-rating="<?php if(isset($review['ratings'])) echo number_format(floatval($review['ratings']),1); ?>"></div>
									<div class="detail-item"><i class="icon-material-outline-date-range"></i><?php echo date('M/Y', strtotime($review['date'])); ?></div>
								</div>
								<div class="item-description">
									<p><?php if(isset($review['review'])) echo $review['review']; ?> </p>
								</div>
							</div>
						</div>
					</li>
					<!----/Ends User Review ------>
					<?php } } ?>

				</ul>

				<!-- Pagination -->
				<div class="clearfix"></div>
				<div class="pagination-container margin-top-40 margin-bottom-10 centerButtons">
					<nav class="pagination paginationReviews">
						<ul>
							<?php if(isset($links)) { echo $links; }?>
						</ul>
					</nav>
				</div>
				<div class="clearfix"></div>
				<!-- Pagination / End -->

			</div>
			<!----/Ends User Reviews ------>

        </div>

        </div>

		<!-- Sidebar -->
		<div class="col-md-4 col-sm-12">
			<div class="sidebar-container seller_php_a">

				<!----About Seller --->
				<div class="sidebar-widget">
					<div class="seller-box margin-bottom-30">
                    <div class="slippa-box-style-2">
                        <h4 class="f-size-20 slippa-semiblod text-center">THE SELLER</h4>
                        <div class="media margin-top-10">
                            <div class="media-body text-center star_view_a">
                            	<img src="<?php if(isset($userprofile[0]['thumbnail'])) echo base_url().USER_UPLOAD.$userprofile[0]['thumbnail']; ?>" alt="" class="msgavatar centerButtons">

                                <h5 class="margin-bottom-15 f-size-24 slippa-semiblod"><a href="<?php echo base_url().'user_profile/'.$userprofile[0]['username']?>" class="user_profilename_a"><?php if(isset($userprofile[0]['username'])) echo $userprofile[0]['username']; ?></a></h5>
                                <img class="flag" src="<?php echo base_url().ICON_FLAGS ?><?php if(isset($userprofile[0]['user_country'])) echo strtolower($userprofile[0]['user_country']); ?>.svg" alt=""> <?php if(isset($userprofile[0]['user_country'])) echo strtoupper($userprofile[0]['user_country']); ?>
                                <p class="margin-bottom-15 f-size-18 text-338">
                                    <div class="star-rating" data-rating="<?php if(isset($profileRatingsAvg[0]['avg_r'])) echo number_format(floatval($profileRatingsAvg[0]['avg_r']),1); ?>"></div>
                                </p>
                            </div>
                        </div>
                    </div><!-- /.slippa-box-style-3 -->
                </div><!-- /.seller-box -->
				</div>
				
				<!-- Profile Overview -->
				<div class="profile_rating_a">
					
				
				<div class="profile-overview">
					<div class="overview-item"><strong><?php if(isset($default_currency)) echo $default_currency; else echo '$'; ?><?php if(isset($totalEarnings)) echo number_format(floatval($totalEarnings)); ?></strong><span>Earnings</span></div>
					<div class="overview-item"><strong><?php echo count($websitelistings); ?></strong><span>Listings</span></div>
					<div class="overview-item"><strong><?php echo count($soldlistings); ?></strong><span>Sold</span></div>
				</div>

				<!-- seller Indicators -->
				<div class="sidebar-widget">
					<div class="seller-indicators">

						<!-- Indicator -->
						<div class="indicator">
							<strong><?php if(!empty($profileRatingsAvg[0]['avg_r']) || $profileRatingsAvg[0]['avg_r'] !== 0) echo (floatval($profileRatingsAvg[0]['avg_r']) / 5) * 100; else echo 0; ?>%</strong>
							<div class="indicator-bar rating_a" data-indicator-percentage="<?php if(!empty($profileRatingsAvg[0]['avg_r']) || $profileRatingsAvg[0]['avg_r'] !== 0) echo (floatval($profileRatingsAvg[0]['avg_r']) / 5) * 100; else echo 0; ?>"><span></span></div>
							<span>User Ratings</span>
						</div>

						<!-- Indicator -->
						<div class="indicator">
							<strong><?php if( count($websitelistings) !== 0 &&  count($soldlistings) !== 0) echo number_format((count($soldlistings) /  count($websitelistings)) * 100 , 2); else echo 0; ?>%</strong>
							<div class="indicator-bar rating_a" data-indicator-percentage="<?php if( count($websitelistings) !== 0 &&  count($soldlistings) !== 0) echo number_format((count($soldlistings) /  count($websitelistings)) * 100 , 2); else echo 0; ?>"><span></span></div>
							<span>Selling Score</span>
						</div>

					</div>
				</div>
				
				<!-- Sidebar Widget -->
				<div class="sidebar-widget">
					<h3>Share</h3>
					<!-- Copy URL -->
					<div class="copy-url">
						<input id="copy-url" type="text" value="" class="with-border">
						<button class="copy-url-button ripple-effect copy_url_a" data-clipboard-target="#copy-url" title="<?php echo $this->lang->line('lang_pop_copy');  ?>" data-tippy-placement="top"><i class="icon-material-outline-file-copy"></i></button>
					</div>

					<!-- Share Buttons -->
					
				</div>
				</div>

			</div>
		</div>
	</div>
</div>

<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/includes/models'); ?>
<!--------------------------------------------------------------------------------------------------------------->

