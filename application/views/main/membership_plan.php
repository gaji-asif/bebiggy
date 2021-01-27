<section class="knowthat_a">
    <div class="container">
        <div class="row">
            <div class="get_started w-100 text-center">
                <h2>Low Price, High Value</h2>
                <p class="gl mb-5 display-5 cost_as_low_a">Cost as low as 40 cents a day.</p>

            </div>
            <?php if (!empty($this->session->flashdata('error_membership'))) { ?>

                <div class="col-md-6 offset-md-3 text-center">
                    <div class="alert alert-danger" role="alert">
                        <?php echo $this->session->flashdata('error_membership'); ?>!
                    </div>
                </div>

            <?php  } ?>
        </div>
        <div class="row">
            <?php foreach ($membershipPlans as $membershipPlan) {   ?>
                <div class="col-md-3 col-sm-12 first_price_a">
                    <div class="price_box_a">
                        <div class="price_titlewithprice_a">
                            <div class="price_title_a">
                                <h5><?php if (!empty(($membershipPlan['name']))) echo ($membershipPlan['name']);  ?></h5>
                            </div>
                            <div class="price_section_a">
                                <h3>$ <?php echo  $membershipPlan['price']  ?></h3>
                                <!-- <span><del>$39.99</del> monthly</span> -->
                                <!-- <span>monthly</span> -->
                            </div>
                        </div>
                        <div class="price_body_a">
                            <ul>
                                <li>Unlimited Products Everyday</li>
                                <li>Access all products</li>
                                <li>Competitor Info</li>
                                <li>Facebook Ad Insight</li>
                                <li>Ad Video</li>
                                <li>Supplier Info</li>
                                <li>Targettin Suggestion</li>
                                <li>24/7 Support</li>
                                <li>Community Access</li>

                            </ul>
                        </div>
                        <div class="price_footer_a">
                            <!-- <a href="<?php// echo base_url() . 'checkout/' . 'buynow' . '/' . $ad['slug']; ?>" class="btn btn-default buy_nowbtn d-flex align-item-center"><span>Buy Now</span> <i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a> -->

                            <a href="<?php echo base_url() . 'checkout/' . 'membership' . '/' . $membershipPlan['slug']; ?>"><span>Buy Now</span> <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                            <!-- <a href="#"><span>Buy Now</span><i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                        </a> -->
                        </div>
                    </div>
                </div>
            <?php  } ?>
        </div>
    </div>
</section>
<!-- <div class="col-md-3 col-sm-12 first_price_a">
                <div class="price_box_a">
                    <div class="price_titlewithprice_a">
                        <div class="price_title_a">
                            <h5>Monthly</h5>
                        </div>
                        <div class="price_section_a">
                            <h3>$19.99</h3>
                            <span><del>$39.99</del> monthly</span>
                        </div>
                    </div>
                    <div class="price_body_a">
                        <ul>
                            <li>Unlimited Products Everyday</li>
                            <li>Access all products</li>
                            <li>Competitor Info</li>
                            <li>Facebook Ad Insight</li>
                            <li>Ad Video</li>
                            <li>Supplier Info</li>
                            <li>Targettin Suggestion</li>
                            <li>24/7 Support</li>
                            <li>Community Access</li>

                        </ul>
                    </div>
                    <div class="price_footer_a">
                        <a href="#"><span>Start Now</span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div> -->
<!-- <div class="col-md-3 col-sm-12 second_price_a">
                <div class="price_box_a">
                    <div class="price_titlewithprice_a">
                        <div class="price_title_a">
                            <h5>Quarterly</h5>
                        </div>
                        <div class="price_section_a">
                            <h3>$54.99</h3>
                            <span><del>$99.99</del> quarterly</span>
                        </div>
                    </div>
                    <div class="price_body_a">
                        <ul>
                            <li>Unlimited Products Everyday</li>
                            <li>Access all products</li>
                            <li>Competitor Info</li>
                            <li>Facebook Ad Insight</li>
                            <li>Ad Video</li>
                            <li>Supplier Info</li>
                            <li>Targettin Suggestion</li>
                            <li>24/7 Support</li>
                            <li>Community Access</li>

                        </ul>
                    </div>
                    <div class="price_footer_a">
                        <a href="#"><span>Start Now</span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12 third_price_a">
                <div class="price_box_a">
                    <div class="price_titlewithprice_a">
                        <div class="most_popular_a">
                            <h5>Most Popular</h5>
                        </div>
                        <div class="septor"></div>
                        <div class="price_title_a">
                            <h5>BI Annual</h5>
                        </div>
                        <div class="price_section_a">
                            <h3>$99.99</h3>
                            <span><del>$190.99</del> bi annual</span>
                        </div>
                    </div>
                    <div class="price_body_a">
                        <ul>
                            <li>Unlimited Products Everyday</li>
                            <li>Access all products</li>
                            <li>Competitor Info</li>
                            <li>Facebook Ad Insight</li>
                            <li>Ad Video</li>
                            <li>Supplier Info</li>
                            <li>Targettin Suggestion</li>
                            <li>24/7 Support</li>
                            <li>Community Access</li>

                        </ul>
                    </div>
                    <div class="price_footer_a">
                        <a href="#"><span>Start Now</span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12 fourth_price_a">
                <div class="price_box_a">
                    <div class="price_titlewithprice_a">
                        <div class="most_popular_a">
                            <h5>Most Economical</h5>
                        </div>
                        <div class="septor"></div>
                        <div class="price_title_a">
                            <h5>Annual</h5>
                        </div>
                        <div class="price_section_a">
                            <h3>$199.99</h3>
                            <span><del>$290.99</del> annual</span>
                        </div>
                    </div>
                    <div class="price_body_a">
                        <ul>
                            <li>Unlimited Products Everyday</li>
                            <li>Access all products</li>
                            <li>Competitor Info</li>
                            <li>Facebook Ad Insight</li>
                            <li>Ad Video</li>
                            <li>Supplier Info</li>
                            <li>Targettin Suggestion</li>
                            <li>24/7 Support</li>
                            <li>Community Access</li>

                        </ul>
                    </div>
                    <div class="price_footer_a">
                        <a href="#"><span>Start Now</span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                    </div> 
                </div>
            </div>
        </div>

    </div>
</section>-->