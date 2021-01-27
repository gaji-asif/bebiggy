<section class="slider_section pb-0">
        <div class="container">
            <div class="row image_slider">
                <div class="col-12 ">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="page-banner">
                                    <div>
                                        <div class="aboutpara_text">
                                            <p>Buy An Amazing Shopify Dropship Store</p>
                                        </div>
                                        <div class="blogslider_title">
                                            <h2>Kickstart your Dropshipping <br>
                                                Business</h2>
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
        <div class="container desktop_padding text-center mt-md-5 mt-sm-4">
            <div class="blogpage_title_a">
                <p class="gl p-highlight2">Start selling with your own Shopify Store today. Each store is provided
                    with a great design complete with top selling and top rated products from top rated & reliable
                    suppliers, all setup for you and ready to go. </p>
                <strong class="gb sub-head">To get started, simply choose a website from one of many popular
                    niches below.
                </strong>
            </div>
        </div>
    </section>
    <section class="ligh_gry">
        <div class="container text-center ">
            <div class="row">
                <div class="col-12">
                    <div class="get_started ">
                        <h2>How To Get Started With a Shopify Dropshipping Website</h2>
                        <p class="gl mb-5">Start your dream business today, it’s really easy to get <br>started.</p>
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
    <section class="dark_gry py-4">
        <div class="container">
            <div class="simply">
                <h3 class="ar">Each store is ready to run out of the box. Simply market your website and start selling
                    to make profits from day one. If you need help, we have your back covered with unlimited support as
                    long as you need it.

                </h3>
            </div>
        </div>
    </section>

    <section class="last_section">
        <div class="container">
            <div class="row drop_pad">
                <div class="col-12 col-md-6 ">
                    <a href="<?php echo site_url('product-category/shopify-dropship-websites-for-sale'); ?>#regular-shopfiy-store" class="new_btn btn_blue">Regular Shopify Stores</a> 
                    <a href="<?php echo site_url('product-category/shopify-premium-dropship-websites-for-sale');  ?>#premium-shopfiy-store"  class="new_btn btn_grey">Premium Shopify Stores</a>
                </div>
                <div class="col-12 col-md-6 ">
                    <div class="dropdown float-right sortt">
                        <button class="btn  dropdown-toggle arial" type="button" id="dropdownMenu2">
                            Default Order
                        </button>
                        <div id="sortBy" class="dropdown-menu arial" aria-labelledby="dropdownMenu2"
                            style="display: none;">
                            <a href="#" class="dropdown-item">High to Low</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">Low to Hight</a>

                        </div>
                    </div>
                    <div class="sort">
                        <p>Sort by:</p>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="listing_type" id="listing_type" value="<?php echo $searchtype; ?>">
        <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
        <div class="container">
            <div class="row website-sale" id="response_print_here" >
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
                <?php endif; ?>

                <div class="row pagination_div pagi_top w-100">
                    <div class="container paginationSearch w-100">
                        <nav aria-label="Page navigation example w-100">
                            <ul class="pagination justify-content-center w-100" style="margin:20px 0">
                                <?php if(!empty($links)) if(isset($links)) { echo $links; }?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
           
            <!-- Page Content-->
            <div class="container">
                <div class="row" style="display: none;">
                    <div class="col-xl-3 col-lg-4">
                        <div id="sidebar-search" class="sidebar-container collapse show">
                            
                            <!-- Location -->
                            <div class="sidebar-widget">
                                <h3>Country</h3>
                                <select id="location-input" name="location-input" class="form-control default">
                                    <option value="">Any</option>
                                </select>
                            </div>

                            <!-- Keywords -->
                            <div class="sidebar-widget">
                                <h3>Keywords</h3>
                                <div class="keywords-container">
                                    <div class="keyword-input-container">
                                        <input type="text" class="keyword-input" placeholder="e.g. domains title"/>
                                        <button class="keyword-input-button ripple-effect"><i class="icon-material-outline-add"></i></button>
                                    </div>
                                    <div class="keywords-list"><!-- keywords go here --></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            
                            <?php if($searchtype === 'website') { ?>
                            <!--Website Category -->
                            <div class="sidebar-widget">
                                <h3>Website Category</h3>
                                <select id="website_industry" name="website_industry" class="form-control default">
                                    <option value="">Any</option>
                                    <?php foreach ($categoriesData as $key) { ?>
                                        <option value="<?php echo $key['c_id']; ?>"><?php echo $key['c_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <?php } ?>

                            <?php if($searchtype !== 'app') { ?>
                            <!--Domain Extension -->
                            <div class="sidebar-widget">
                                <h3>Domain Extension</h3>
                                <select id="extension" name="extension" class="form-control default">
                                    <option value="">Any</option>
                                </select>
                            </div>
                            <?php } ?>
                            
                            <?php if(in_array('auction',array_column($options,'platform')) && in_array('classified',array_column($options,'platform'))) {?>
                            <!-- domains Types -->
                            <div class="sidebar-widget">
                                <h3>Listing Types</h3>

                                <div class="switches-list">
                                    <!-- <div class="switch-container">
                                        <label class="switch"><input id="auction_check" name="auction_check" type="checkbox"><span class="switch-button"></span> Auction Listings</label>
                                    </div> -->

                                    <div class="switch-container">
                                        <label class="switch"><input id="classified_check" name="classified_check" type="checkbox"><span class="switch-button"></span> Classified Listings</label>
                                    </div>

                                </div>

                            </div>
                            <?php } ?>

                            <!-- Price Range -->
                            <div class="sidebar-widget">
                                <h3>Price Range</h3>
                                <div class="margin-top-55"></div>
                                <!-- Range Slider -->
                                <input class="range-slider" type="text" value="" data-slider-currency="<?php if(!empty($default_currency)) echo $default_currency; else echo '$'; ?>" data-slider-min="<?php echo RANGE_MIN ?>" data-slider-max="<?php echo RANGE_MAX ?>" data-slider-step="<?php echo RANGE_STEP ?>" data-slider-value="[<?php echo RANGE_MIN ?>,<?php echo RANGE_MAX ?>]"/>
                            </div>

                        </div>
                    </div>

                    <input type="hidden" name="listing_type" id="listing_type" value="<?php echo $searchtype; ?>">
                    <div id="results_div" class="col-xl-9 col-lg-8 content-left-offset">
                        <h3 class="page-title">Search Results</h3>
                        <div class="notify-box margin-top-15">
                            <div class="sort-by">
                                <span>Sort by:</span>
                                <select id="sortyby" class="slippa-sort hide-tick">
                                    <option value="tbl_listings.date">Relevance</option>
                                    <option value="tbl_listings.views">Views</option>
                                    <option value="tbl_listings.date">Date</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>

<?php $this->load->view('main/includes/models'); ?>