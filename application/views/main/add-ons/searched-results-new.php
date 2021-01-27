<?php if(!empty($results) && count($results) > 0): //pre($results, 1); ?>
                <?php foreach($results as $key => $val) :?>
                <div class="col-sm-12 first_div mb-3 p-4 shadow">
                    <div class="col-md-3 col-sm-12 image_div">
                        <?php              
                        $img_url = base_url().BLOG_UPLOAD.'banner-10.jpg';
                        if(isset($val['website_thumbnail'])){
                            $img_url = FCPATH.IMAGES_UPLOAD.$val['website_thumbnail'];  
                            
                            if(fileExists($img_url)) {
                                
                                $img_url = base_url().IMAGES_UPLOAD.$val['website_thumbnail'];  
                            } else {
                                $img_url = base_url().BLOG_UPLOAD.'banner-10.jpg';
                            }
                        } else {
                            $img_url = base_url().BLOG_UPLOAD.'banner-10.jpg';
                        }
                        ?>
                        <img src="<?php echo $img_url; ?>" class="rounded">
                    </div>
                    <div class="col-md-6 col-sm-12 title_withbtn">
                        <h4><?php echo $val['website_BusinessName'] ?? '' ?></h4>
                        <div class='row py-2'>
                            <div class="col-md-12 col-sm-12  d-flex w-100"><a href="<?php echo base_url() . $val['listing_option'] . '/' . $val['listing_type'] . '/' . $val['id'];  ?>" class="listing">View
                                    Listing</a>
                                    <?php if ($val['listing_type'] !== 'app')
                                    { ?>
                                        
                                        <a href="<?php if (!empty($val['website_BusinessName'])) echo '//' . $val['website_BusinessName']; ?>" class="view_demo">View Demo</a> 
                                    <?php
                                    }
                                    else
                                    { ?>
                                        <a href="<?php if (!empty($val['app_url'])) echo '//' . $val['app_url']; ?>" class="view_demo">View Demo</a>  
                                    <?php } ?>
                            </div>
                        </div>
                        <hr>
                        <p class="start_coffee"><?php if (!empty($val['description'])) echo _str_limit($val['description']); ?></p>
                    </div>
                    <div class="col-md-3 col-sm-12 price_div">
                        <div class="float_right">
                            <div class="price">
                                    
                                <?php if (!empty($val['website_discountprice'])) { ?>
                                    <span class="cutting_text"><del><?php if (isset($default_currency)) echo $default_currency; else echo '$'; ?><?php echo $val['website_discountprice']; ?></del></span>
                                <?php } else {
                                    ?>  <span class="cutting_text invisible"><del>$2625</del></span><?php
                                } ?>
                                
                                
                                <span class="price_text">
                                    <?php if (isset($default_currency)) echo $default_currency;
                                        else echo '$'; ?>
                                    <?php if (isset($val['website_buynowprice'])) echo number_format(floatval($val['website_buynowprice']));
                                    else echo number_format(floatval($val['website_buynowprice']));  ?>                                        
                                </span>

                            </div>
                            <span class="pricetext d-block">Price</span>
                            <?php  if (!empty($val['website_buynowprice'])): ?>
                            <div class="but_now d-flex">
                                <a href="<?php echo base_url() . $val['listing_option'] . '/' . $val['listing_type'] . '/' . $val['id'];  ?>" class="btn btn-default buy_nowbtn d-flex align-item-center"><span>Buy
                                        Now</span> <i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
                            </div>
                            <?php elseif ($val['user_id'] !== $this->session->userdata('user_id')) : ?>
                                <div class="btn buy_nowbtn mt-2 w-100 h-auto listing_type_btn_a"> 
                                    <a href="#small-dialog-4" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 popup-with-zoom-anim custom_contact_seller" data-user_id="<?php echo $val['user_id']; ?>">
                                        <span>Contact Seller
                                        </span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a> 
                                </div>
                            <?php  endif ; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
					<h4 class="domains-listing-company"><?php echo $this->lang->line('lang_noresults'); ?> 
                <?php endif; ?>

			<!-- Pagination -->
			<div class="clearfix"></div>
			<div class="row pagination_div pagi_top w-100">
                <div class="container paginationSearch">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center" style="margin:20px 0">
                            <?php if(!empty($links)) if(isset($links)) { echo $links; }?>
                        </ul>
                    </nav>
                </div>
            </div>
			<div class="clearfix"></div>
			<!-- Pagination / End -->
<?php $this->load->view('main/includes/models'); ?>