<?php
//pre($listing_data['user_permission'],1);
// pre($listing_data[0],1);
if (!empty($listing_data[0])) {
    // $single_item = $listing_data[0];
?>
    <section class="single_listing_page_a">
        <div class="container">
            <div class="row listingslider_div_a">
                <?php
                $show_image = 0;
                if (isset($listing_data[0]['website_thumbnail'])) {

                    $img_url = FCPATH . IMAGES_UPLOAD . $listing_data[0]['website_thumbnail'];

                    if (fileExists($img_url)) {

                        $show_image = 1;
                        $img_url = base_url() . IMAGES_UPLOAD . $listing_data[0]['website_thumbnail'];
                    }
                } ?>

                <?php if ($show_image === 1) : ?>
                    <div class="col-md-4">
                        <img src="<?php echo $img_url; ?>" class="rounded w-100 ">
                    </div>
                <?php endif ?>
                <?php /*<div class="col-md-4">
                    <?php if (!empty($listing_data[0]['listing_header_priority']) && $listing_data[0]['listing_header_priority'] != 1) :  ?>
                        <?php
                        $img_url = base_url() . NO_IMAGE . 'Noimage.jpeg';
                        if (isset($listing_data[0]['website_thumbnail'])) {
                            $img_url = FCPATH . IMAGES_UPLOAD . $listing_data[0]['website_thumbnail'];

                            if (fileExists($img_url)) {

                                $img_url = base_url() . IMAGES_UPLOAD . $listing_data[0]['website_thumbnail'];
                            } else {
                                $img_url = base_url() . NO_IMAGE . 'Noimage.jpeg';
                            }
                        } else {
                            $img_url = base_url() . NO_IMAGE . 'Noimage.jpeg';
                        }
                        ?>
                        <img src="<?php echo $img_url; ?>" class="rounded w-100">
                    <?php else : ?>
                        <?php
                        $img_url = base_url() . NO_IMAGE . 'Noimage.jpeg';
                        ?>
                        <img src="<?php echo $img_url; ?>" class="rounded w-100 ">
                    <?php endif; ?>
                </div> */ ?>
                <div class="<?php echo $show_image === 1 ? 'col-md-8' : 'col-md-12' ?> Listing_header_a">
                    <div class="salling_domain_a">
                        <h1>
                            <?php if (isset($listing_data[0]['website_BusinessName'])) echo $listing_data[0]['website_BusinessName']; ?>
                        </h1>
                        <!-- Added show Listing-Plan-Header single-static-item -->
                        <?php foreach (LISTING_HEADER  as $k => $v) : ?>
                            <?php if (!empty($listing_data[0]['listing_header_priority'])) :  ?>

                                <?php if ($k == $listing_data[0]['listing_header_priority']) :  ?>
                                    <div class="regulare_listing_a mb-2">
                                        <?php echo  $v; ?>
                                    </div>

                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <?php if (!empty($listing_data['user_permission']['price']) || $listing_data[0]['user_id'] == $this->session->userdata('user_id')) { ?>
                            <div class="all_button_section_a">

                                <div class="listingdetails_div_a single_page_view_a classfied_a">
                                    <?php if (!empty($listing_data[0]['website_buynowprice'])) { ?>
                                        <p>Price</p>
                                        <h2><?php if (!empty($default_currency)) echo $default_currency;
                                            else echo '$'; ?> <?php if (!empty($listing_data[0]['website_buynowprice'])) echo number_format($listing_data[0]['website_buynowprice']);
                                                                else echo 'Price unavailable'; ?></h2>

                                    <?php } else if (!empty($listing_data['user_permission']['ask-price']) && $this->uri->segment(2) == 'business') { ?>
                                        <h2><?php if (!empty($default_currency)) echo $default_currency;
                                            else echo '$'; ?> <?php if (!empty($listing_data[0]['website_minimumoffer'])) echo number_format($listing_data[0]['website_minimumoffer']);
                                                                else echo 'Price unavailable'; ?></h2>
                                    <?php } else {
                                        echo "<h2>Price unavailable</h2>";
                                    } ?>
                                </div>

                            <?php } elseif (!empty($listing_data['user_permission']['ask-price']) &&  $this->uri->segment(2) == 'business') { ?>

                                <div class="listingdetails_div_a">
                                    <?php if (!empty($listing_data[0]['website_minimumoffer'])) { ?>
                                        <h2> Price <?php if (!empty($default_currency)) echo $default_currency;
                                                    else echo '$'; ?> <?php if (!empty($listing_data[0]['website_minimumoffer'])) echo number_format($listing_data[0]['website_minimumoffer']);
                                                                        else echo 'Price unavailable'; ?></h2>

                                    <?php } else {
                                        echo "<h2>Price unavailable</h2>";
                                    } ?>
                                </div>
                            <?php } else if (empty($listing_data['user_permission']['price']) && !empty($this->session->userdata('user_id'))) {
                            ?>
                                <!-- upgrade permission -->
                                <div class="btn buy_nowbtn mt-2 single_page_width_auto_a h-auto">
                                    <a href="javascript:void(0)" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 custom_contact_seller" id='upgradePlan'><span>See Price</span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
                                </div>
                            <?php
                        } else if (empty($listing_data['user_permission']['price']) && empty($this->session->userdata('user_id'))) {
                            ?>
                                <!-- upgrade permission -->
                                <div class="btn buy_nowbtn mt-2 single_page_width_auto_a h-auto">
                                    <a href="javascript:void(0)" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 custom_contact_seller popup-with-zoom-anim"><span>See Price</span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
                                </div>
                            <?php
                        }
                            ?>



                            <?php

                            if ($listing_data[0]['status'] !== '5') {

                                if ($listing_data[0]['sold_status'] === '0') { ?>


                                    <?php if (!empty($listing_data['user_permission']['ask-price'])) {
                                        if (!empty($listing_data[0]['website_minimumoffer'])) { ?>
                                            <!-- Headline -->
                                            <div class="asked_details_a single_page_width_auto_a classic_price_a">
                                                <span class="bidding-detail"><strong>Asking Price</strong></span>
                                                <!-- Price Slider -->
                                                <div class="bidding-value"><?php if (!empty($default_currency)) echo $default_currency;
                                                                            else echo '$'; ?> <?php if (!empty($listing_data[0]['website_minimumoffer'])) echo number_format($listing_data[0]['website_minimumoffer']);
                                                                                                else echo 'Price unavailable'; ?></div>
                                            </div>

                                    <?php }
                                    } ?>



                                    <?php if ($listing_data[0]['user_id'] !== $this->session->userdata('user_id') && !empty($listing_data['user_permission']['ask-price']) && !empty($listing_data[0]['website_minimumoffer'])) { ?>

                                        <?php if (!empty($listing_data['user_permission']['make-offer']) && $listing_data[0]['listing_type'] != 'business') { ?>
                                            <div class="btn buy_nowbtn single_page_width_auto_a h-auto listing_type_btn_a mt-2">
                                                <a href="#small-dialog-6" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 popup-with-zoom-anim">
                                                    <span>Make Offer
                                                    </span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
                                            </div>
                                        <?php } else if (empty($listing_data['user_permission']['make-offer']) && $listing_data[0]['listing_type'] != 'business') {  ?>

                                            <!-- upgrade permission -->
                                            <div class="btn buy_nowbtn single_page_width_auto_a h-auto mt-2">
                                                <a href="javascript:void(0)" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 custom_contact_seller" id='upgradePlan'><span>Make Offer</span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
                                            </div>
                                        <?php } ?>

                                    <?php } else if ($listing_data[0]['user_id'] == $this->session->userdata('user_id')) { ?>

                                        <div class="btn buy_nowbtn single_page_width_auto_a h-auto listing_type_btn_a mt-2">
                                            <a href="javascript:void(0)" class="white d-flex align-items-center button  full-width margin-top-20 it_belongs_to_you_a">
                                                <span>It belongs to You
                                                </span></a>
                                        </div>

                                    <?php } ?>

                                    <?php if ($listing_data[0]['listing_type'] == 'app' || $listing_data[0]['listing_type'] == 'business' || $listing_data[0]['listing_type'] == 'website') { ?>

                                        <?php if (!empty($listing_data['user_permission']['stats'])  || ($listing_data[0]['user_id'] == $this->session->userdata('user_id'))) { ?>
                                            <div class="btn buy_nowbtn single_page_width_auto_a h-auto listing_type_btn_a">
                                                <a href="javascript:void(0)" id="business_stats" class="white d-flex align-items-center">
                                                    <span>Business stats</span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
                                            </div>
                                        <?php } else if (empty($listing_data['user_permission']['stats']) && !empty($this->session->userdata('user_id'))) { ?>

                                            <!-- upgrade permission -->

                                            <div class="btn buy_nowbtn single_page_width_auto_a h-auto mt-2">
                                                <a href="javascript:void(0)" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 custom_contact_seller" id='upgradePlan'><span>Business Stats</span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
                                            </div>

                                        <?php } elseif (empty($listing_data['user_permission']['stats']) && empty($this->session->userdata('user_id'))) { ?>
                                            <div class="btn buy_nowbtn single_page_width_auto_a h-auto listing_type_btn_a mt-2">
                                                <a href="#small-dialog-4" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 popup-with-zoom-anim"><span>Business Stats</span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
                                            </div>

                                    <?php }
                                    } ?>


                                    <!-- Button -->
                                    <?php if ($listing_data[0]['user_id'] !== $this->session->userdata('user_id')) { ?>
                                        <?php if (!empty($listing_data['user_permission']['contact-seller'])) {  ?>
                                            <!-- logged in user -->
                                            <div class="btn buy_nowbtn single_page_width_auto_a h-auto listing_type_btn_a mt-2">
                                                <a href="#small-dialog-4" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 popup-with-zoom-anim" data-user_id="<?php echo $listing_data[0]['user_id']; ?>"><span>Contact Seller</span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
                                            </div>
                                        <?php  } else if (empty($this->session->userdata('user_id') && empty($listing_data['user_permission']['contact-seller']))) { ?>
                                            <div class="btn buy_nowbtn single_page_width_auto_a h-auto listing_type_btn_a mt-2">
                                                <a href="#small-dialog-4" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 popup-with-zoom-anim" data-user_id="<?php echo $listing_data[0]['user_id']; ?>"><span>Contact Seller</span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
                                            </div>
                                        <?php } else if (empty($listing_data['user_permission']['contact-seller']) && !empty($this->session->userdata('user_id'))) { ?>

                                            <!-- upgrade permission -->
                                            <div class="btn buy_nowbtn single_page_width_auto_a h-auto mt-2">
                                                <a href="javascript:void(0)" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 custom_contact_seller" id='upgradePlan'><span>Contact Seller</span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
                                            </div>

                                    <?php }
                                    } ?>


                                    <?php if ($listing_data[0]['user_id'] !== $this->session->userdata('user_id')) { ?>

                                        <?php if (!empty($listing_data['user_permission']['buy-now'])) { ?>
                                            <?php if (!empty($listing_data[0]['website_buynowprice']) && !empty($listing_data['user_permission']['price'])) { ?>
                                                <!-- Button -->

                                                <?php if ($sold_or_not == 'no') { ?>

                                                    <div class="btn buy_nowbtn single_page_width_auto_a h-auto listing_type_btn_a mt-2">
                                                        <a href="<?php echo base_url() . 'checkout/' . 'buynow' . '/' . $listing_data[0]['slug']; ?>" class="white d-flex align-items-center">
                                                            <span>Buy Now <?php if (!empty($default_currency)) echo $default_currency;
                                                                            else echo '$'; ?> <?php if (!empty($listing_data[0]['website_buynowprice'])) echo number_format($listing_data[0]['website_buynowprice']); ?>
                                                            </span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="btn buy_nowbtn single_page_width_auto_a h-auto listing_type_btn_a mt-2">
                                                        <a href="" class="white d-flex align-items-center">
                                                            <span>Sold Out</span>
                                                            <i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                <?php } ?>


                                            <?php } else if (!empty($listing_data[0]['website_buynowprice'])) { ?>
                                                <!-- upgrade permission -->
                                                <?php if ($sold_or_not == 'no') { ?>
                                                    <div class="btn buy_nowbtn single_page_width_auto_a h-auto mt-2">
                                                        <a href="javascript:void(0)" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 custom_contact_seller" id='upgradePlan'><span>Buy Now</span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="btn buy_nowbtn single_page_width_auto_a h-auto listing_type_btn_a mt-2">
                                                        <a href="" class="white d-flex align-items-center">
                                                            <span>Sold Out</span>
                                                            <i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                <?php } ?>


                                    <?php }
                                        }
                                    } ?>
                                <?php
                                } else { ?>
                                    <div class="alert alert-warning text-dark margin-bottom-35 text-center"> SOLD </div>
                                <?php
                                }
                            } else { ?>
                                <div class="alert alert-danger text-dark margin-bottom-35 text-center"> UNVERIFIED LISTING </div>
                            <?php
                            } ?>

                            <?php if ($listing_data[0]['user_id'] !== $this->session->userdata('user_id')) { ?>
                                <div class="btn buy_nowbtn single_page_width_auto_a h-auto listing_type_btn_a bidding-signup mt-2">
                                    <a href="#small-dialog-5" class="white d-flex align-items-center popup-with-zoom-anim">
                                        <span>Report this
                                        </span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
                                </div>

                            <?php
                            } ?>

                            <!--  without app  -->
                            <?php if ($listing_data[0]['listing_type'] !== 'app' && $listing_data[0]['listing_type'] !== 'business') { ?>

                                <?php if (!empty($listing_data['user_permission']['view-demo']) || $listing_data[0]['user_id'] == $this->session->userdata('user_id')) { ?>
                                    <div class="btn buy_nowbtn single_page_width_auto_a h-auto listing_type_btn_a mt-2">
                                        <a target="_blank" href="<?php if (!empty($listing_data[0]['website_BusinessName'])) echo '//' . $listing_data[0]['website_BusinessName']; ?>" class="white d-flex align-items-center">
                                            <span> View Demo </span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
                                    </div>
                                <?php } else  if (empty($listing_data['user_permission']['view-demo']) && !empty($this->session->userdata('user_id'))) { ?>
                                    <!-- upgrade permission -->
                                    <div class="btn buy_nowbtn mt-2 single_page_width_auto_a h-auto">
                                        <a href="javascript:void(0)" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 custom_contact_seller" id='upgradePlan'><span> View Demo </span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
                                    </div>
                                <?php } else if (empty($listing_data['user_permission']['view-demo']) && empty($this->session->userdata('user_id'))) { ?>
                                    <!--  ask for login Permission  -->
                                    <div class="btn buy_nowbtn mt-2 single_page_width_auto_a h-auto">
                                        <a href="javascript:void(0)" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 custom_contact_seller popup-with-zoom-anim"><span> View Demo </span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
                                    </div>


                                <?php }
                            } else if ((!empty($listing_data['user_permission']['view-demo']) &&  ($listing_data[0]['listing_type'] !== 'business') &&  $listing_data[0]['listing_type'] == 'app') || $listing_data[0]['user_id'] == $this->session->userdata('user_id')) {  ?>
                                <!--  With App  -->
                                <div class="btn buy_nowbtn mt-2 single_page_width_auto_a h-auto listing_type_btn_a">
                                    <a target="_blank" href="<?php if (!empty($listing_data[0]['app_url']) && $listing_data[0]['app_url'] !== 'n/a') echo $listing_data[0]['app_url']; ?>" class="white d-flex align-items-center">
                                        <span>View Demo
                                        </span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
                                </div>

                            <?php
                            } else if (
                                empty($listing_data['user_permission']['view-demo']) && $listing_data[0]['listing_type'] !== 'business' && $listing_data[0]['listing_type'] == 'app'
                                && !empty($this->session->userdata('user_id'))
                            ) { ?>
                                <!-- upgrade permission -->
                                <div class="btn buy_nowbtn mt-2 single_page_width_auto_a h-auto">
                                    <a href="javascript:void(0)" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 custom_contact_seller" id='upgradePlan'><span> View Demo </span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
                                </div>
                            <?php
                            } else if (
                                empty($listing_data['user_permission']['view-demo']) && $listing_data[0]['listing_type'] !== 'business' && $listing_data[0]['listing_type'] == 'app'
                                && empty($this->session->userdata('user_id'))
                            ) { ?>
                                <!-- ask for login permission -->
                                <div class="btn buy_nowbtn mt-2 single_page_width_auto_a h-auto">
                                    <a href="javascript:void(0)" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 custom_contact_seller popup-with-zoom-anim "><span> View Demo </span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if (!empty($badges)) { ?>
                            <div class=" row mt-4">
                                <div class="col-md-3">
                                    <img src="<?php echo site_url('assets/img/categories/' . $badges[0]['icon']); ?>" class="rounded-circle round_size_a" />
                                </div>
                                <div class="col-md-8 badge_a_line_height pl-2 pt-1">
                                    <span class="font-weight-bold"><?php echo  ucfirst(strtolower($badges[0]['user_name'])); ?></span><br>
                                    <small class="badge_a"><?php echo ucfirst(strtolower($badges[0]['name'])) ?></small>
                                </div>
                            </div>
                        <?php } ?>


                    </div>

                </div>

                <!--  <div class="col-md-4 mb-5">
                   
                    </div> -->


                <!-- 
                    <div class="listin_advertise_box_a">
                        <div class="area_box">
                            <h4>Advertisement Area</h4>
                        </div>
                    </div> -->

            </div>
        </div>
    </section>
    <section class="single_listing_page_a">
        <div class="container">
            <div class="row listing_details_div">
                <div class="col-md-8">
                    <?php if ($listing_data[0]['listing_type'] == 'app' || $listing_data[0]['listing_type'] == 'business' || $listing_data[0]['listing_type'] == 'website') { ?>
                        <?php if (!empty($listing_data['user_permission']['stats']) || ($listing_data[0]['user_id'] == $this->session->userdata('user_id'))) { ?>
                            <div class="col-md-12 px-0">
                                <div class="course_shadow shadow d-none" id="business_stats_id">
                                    <?php $this->load->view('main/business_stats', $listing_data);  ?>
                                </div>
                            </div>
                    <?php }
                    } ?>
                    <div class="course_shadow shadow">
                        <div class="coursedetail_title">
                            <div class="course_title_bar"></div>
                            <h3>Description</h3>
                        </div>
                        <div class="textarea_section_a">
                            <?php if (isset($listing_data[0]['description'])) if (DECODE_DESCRIPTIONS) echo html_entity_decode(($listing_data[0]['description']));
                            else echo ($listing_data[0]['description']); ?>
                        </div>
                    </div>

                    <?php
                    if (isset($listing_detail_page_left_side) && is_array($listing_detail_page_left_side) && count($listing_detail_page_left_side) > 0) {
                        for ($k = 0; $k < count($listing_detail_page_left_side); $k++) {
                            if (isset($listing_detail_page_left_side[$k]) && trim($listing_detail_page_left_side[$k]['text_or_icon']) != '') {
                                $img_url = FCPATH . CATEGORY_IMAGES . "/" . trim($listing_detail_page_left_side[$k]['text_or_icon']);
                                if (fileExists($img_url)) {
                                    $img_url = base_url() . CATEGORY_IMAGES . "/" . trim($listing_detail_page_left_side[$k]['text_or_icon']); ?>
                                    <div class="col-md-12 px-0 advertisement_box course_adv_a">
                                        <img src="<?php echo isset($img_url) ? $img_url : ''; ?>" alt="" title="" />
                                    </div>

                    <?php
                                }
                            }
                        }
                    }
                    ?>

                    <!-- <div class="advertisement_box">
                        <div class="area_box">
                            <h4>Advertisement Area</h4>
                        </div>
                    </div> -->
                </div>

                <div class="col-md-4">
                    <div class="right_coursedetails">
                        <div class="donnot_like_a shadow">
                            <h4>Don’t like what you see? Or have something new in mindss?</h4>
                            <div class="order_custom_a">
                                <p>Order Custom Shopify Premium Store</p>
                            </div>

                        </div>

                        <?php
                        if (isset($listing_detail_page_right_side) && is_array($listing_detail_page_right_side) && count($listing_detail_page_right_side) > 0) {
                            for ($k = 0; $k < count($listing_detail_page_right_side); $k++) {
                                if (isset($listing_detail_page_right_side[$k]) && trim($listing_detail_page_right_side[$k]['text_or_icon']) != '') {
                                    $img_url = FCPATH . CATEGORY_IMAGES . "/" . trim($listing_detail_page_right_side[$k]['text_or_icon']);
                                    if (fileExists($img_url)) {
                                        $img_url = base_url() . CATEGORY_IMAGES . "/" . trim($listing_detail_page_right_side[$k]['text_or_icon']); ?>
                                        <div class="col-md-12 px-0 advertisement_box course_adv_a">
                                            <img src="<?php echo isset($img_url) ? $img_url : ''; ?>" alt="" title="" />
                                        </div>

                        <?php  }
                                }
                            }
                        }
                        ?>
                    </div>
                </div>

            </div>

        </div>
        </div>
    </section>
<?php
} ?>
<!-- <script type="text/javascript">
    $(document).ready(function(){
    $("#terms_condition").click(function () {        
        $('#small-dialog-6').modal('hide');
     }); 
});
</script> -->
<?php $this->load->view('main/includes/models'); ?>