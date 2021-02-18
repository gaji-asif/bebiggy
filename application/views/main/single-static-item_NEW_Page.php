<?php
if (!empty($single_item) && !empty($single_item[0])) {
    $single_item = $single_item[0];
?>
    <section>
        <div class="container">
            <div class="row listingslider_div_a">

                <div class="col-md-4">
                    <img src="<?php echo site_url('assets/img/users/' . $single_item['image']); ?>" class="rounded w-100">
                </div>
                <div class="col-md-8 Listing_header_a">
                    <h1><?php echo $single_item['name'] ?? ''; ?></h1>
                    <!-- <div class="listing_para_a">
                    <p><?php echo _str_limit($single_item['description']) ?? '' ?></p>
                </div> -->
                    <div class="listingdetails_div_a">
                        <h2>$<?php echo $single_item['price'] ?? ''; ?></h2>
                        <p>Price</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section>

        <div class="container">
            <div class="row listing_details_div">

                <div class="col-md-8">
                    <div class="course_shadow shadow">

                        <div class="coursedetail_title">
                            <div class="course_title_bar"></div>
                            <h3>Description</h3>
                        </div>
                        <?php
                        if (!empty($single_item['description'])) {
                            echo $single_item['description'];
                        }
                        ?>
                        <div class="course_lesson">
                            <div class="features_list_a">
                                <div class="course_title_bar"></div>
                                <h3>Features</h3>
                            </div>
                            <!-- accordance -->
                            <div class="row features_type_a">
                                <?php if (!empty($single_item['type'])) : ?>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="box_feature_a">
                                            <h5>Type</h5>
                                            <p><?php echo $single_item['type']; ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($single_item['delivery'])) : ?>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="box_feature_a">
                                            <h5>Delivery</h5>
                                            <p><?php echo $single_item['delivery']; ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="row features_type_a">
                                <?php if (!empty($single_item['design'])) : ?>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="box_feature_a">
                                            <h5>Design</h5>
                                            <p><?php echo $single_item['design']; ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($single_item['responsive'])) : ?>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="box_feature_a">
                                            <h5>Responsive</h5>
                                            <p><?php echo $single_item['responsive']; ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="row features_type_a">
                                <?php if (!empty($single_item['products_import'])) : ?>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="box_feature_a">
                                            <h5>Products Import</h5>
                                            <p><?php echo $single_item['products_import']; ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($single_item['automation'])) : ?>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="box_feature_a">
                                            <h5>Automation</h5>
                                            <p><?php echo $single_item['automation']; ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="row features_type_a">
                                <?php if (!empty($single_item['shipping'])) : ?>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="box_feature_a">
                                            <h5>Shipping</h5>
                                            <p><?php echo $single_item['shipping'] ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($single_item['products'])) : ?>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="box_feature_a">
                                            <h5>Products</h5>
                                            <p><?php echo $single_item['products'] ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="row features_type_a">
                                <?php if (!empty($single_item['suppliers'])) : ?>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="box_feature_a">
                                            <h5>Suppliers</h5>
                                            <p><?php echo $single_item['suppliers'] ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($single_item['support'])) : ?>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="box_feature_a">
                                            <h5>Support</h5>
                                            <p><?php echo $single_item['support'] ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="row features_type_a">
                                <?php if (!empty($single_item['domain_name'])) : ?>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="box_feature_a">
                                            <h5>Domain Name</h5>
                                            <p><?php echo $single_item['domain_name'] ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($single_item['ownership'])) : ?>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="box_feature_a">
                                            <h5>Ownership</h5>
                                            <p><?php echo $single_item['ownership'] ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="row features_type_a">
                                <?php if (!empty($single_item['profit_sharing'])) : ?>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="box_feature_a">
                                            <h5>Profit Sharing</h5>
                                            <p><?php echo $single_item['profit_sharing'] ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($single_item['editable'])) : ?>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="box_feature_a">
                                            <h5>Editable</h5>
                                            <p><?php echo $single_item['editable'] ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="row features_type_a">
                                <?php if (!empty($single_item['pricing_setup'])) : ?>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="box_feature_a">
                                            <h5>Pricing Setup</h5>
                                            <p><?php echo $single_item['pricing_setup'] ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($single_item['liquidity'])) : ?>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="box_feature_a">
                                            <h5>Liquidity</h5>
                                            <p><?php echo $single_item['liquidity'] ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="row features_type_a">
                                <?php if (!empty($single_item['monthly_expenses'])) : ?>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="box_feature_a">
                                            <h5>Monthly Expenses</h5>
                                            <p><?php echo $single_item['monthly_expenses'] ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="bottom_div_a"></div>
                        </div>
                    </div>
                    <div class="advertisement_box">
                        <div class="area_box">
                            <h4>Advertisement Area</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="right_coursedetails">

                        <div class="btn buy_nowbtn w-100 h-auto listing_type_btn_a">
                            <a href="#" class="white d-flex align-items-center">
                                <span>Buy Now
                                </span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
                        </div>

                        <div class="btn buy_nowbtn mt-2 w-100 h-auto listing_type_btn_a">
                            <a href="#" class="white d-flex align-items-center">
                                <span>View Live Demo
                                </span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
                        </div>
                        <div class="donnot_like_a my-4 shadow">
                            <h4>Don’t like what you see? Or have something new in mind?</h4>
                            <div class="order_custom_a">
                                <p>Order Custom Shopify Premium Store</p>
                            </div>

                        </div>

                        <div class="listin_advertise_box_a">
                            <div class="area_box">
                                <h4>Advertisement Area</h4>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
<?php
} ?>