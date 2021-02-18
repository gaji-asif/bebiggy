<?php

if (!empty($listing_data)) {
    // pre($listing_data, 1);
?>
    <section class="name_section_a">
        <div class="container">
            <div class="row listingslider_div_a">

                <?php
                $show_image = 0;
                if (isset($listing_data['website_thumbnail'])) {

                    $img_url = FCPATH . IMAGES_UPLOAD . $listing_data['website_thumbnail'];

                    if (fileExists($img_url)) {

                        $show_image = 1;
                        $img_url = base_url() . IMAGES_UPLOAD . $listing_data['website_thumbnail'];
                    }
                } ?>

                <?php if ($show_image === 1) : ?>
                    <div class="col-md-4">


                        <?php /*if (!empty($listing_data[0]['listing_header_priority']) && $listing_data[0]['listing_header_priority'] != 1) :  ?>
                    <?php
                    $img_url = base_url() . BLOG_UPLOAD . 'banner-10.jpg';
                    if (isset($listing_data['website_thumbnail'])) {
                        $img_url = FCPATH . IMAGES_UPLOAD . $listing_data['website_thumbnail'];

                        if (fileExists($img_url)) {

                            $img_url = base_url() . IMAGES_UPLOAD . $listing_data['website_thumbnail'];
                        } else {
                            $img_url = base_url() . BLOG_UPLOAD . 'banner-10.jpg';
                        }
                    } else {
                        $img_url = base_url() . BLOG_UPLOAD . 'banner-10.jpg';
                    }
                    ?>
                    <img src="<?php echo $img_url; ?>" class="rounded w-100">
            <?php else : ?>
                        <?php
                        $img_url = base_url() . NO_IMAGE . 'Noimage.jpeg';
                        ?>
                        <img src="<?php echo $img_url; ?>" class="rounded w-100 ">
            <?php endif; */ ?>
                        <img src="<?php echo $img_url; ?>" class="rounded w-100 ">
                    </div>
                <?php endif ?>
                <div class="<?php echo $show_image === 1 ? 'col-md-8' : 'col-md-12' ?> Listing_header_a">
                    <div class="salling_domain_a">
                        <h1>
                            <?php if (isset($listing_data['name'])) echo $listing_data['name']; ?>
                        </h1>
                        <?php if (!empty($listing_data['user_permission']['price']) || $this->session->userdata('user_id') == $listing_data['user_id']) {  ?>

                            <div class="all_button_section_a">
                                <div class="listingdetails_div_a single_page_view_a">
                                    <?php if (!empty($listing_data['price'])) { ?>
                                        <p>Price</p>
                                        <h2> <?php if (!empty($default_currency)) echo $default_currency;
                                                else echo '$'; ?> <?php if (!empty($listing_data['price'])) echo number_format($listing_data['price'], 2);
                                                                    else echo 0; ?></h2>

                                    <?php } else {
                                        echo "<h2>Price unavailable</h2>";
                                    } ?>
                                </div>

                            <?php } else if (empty($listing_data['user_permission']['price']) && !empty($this->session->userdata('user_id'))) { ?>
                                <div class="btn buy_nowbtn mt-2 h-auto single_page_width_auto_a">
                                    <a href="javascript:void(0)" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 custom_contact_seller" id='upgradePlan'><span>See Price</span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
                                </div>
                            <?php } else if (empty($listing_data['user_permission']['price']) && empty($this->session->userdata('user_id'))) { ?>
                                <div class="btn buy_nowbtn mt-2 h-auto single_page_width_auto_a">
                                    <a href="javascript:void(0)" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 custom_contact_seller popup-with-zoom-anim"><span>See Price</span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
                                </div>

                            <?php  } ?>

                            <!-- Button -->
                            <?php if ($listing_data['user_id'] !== $this->session->userdata('user_id')) { ?>

                                <?php if (!empty($listing_data['user_permission']['contact-seller'])) {  ?>
                                    <div class="btn buy_nowbtn h-auto listing_type_btn_a single_page_width_auto_a">
                                        <?php if (empty($this->session->userdata('user_id'))) { ?>
                                            <a href="<?php echo base_url() . "/login" ?>" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 popup-with-zoom-amt-2nim" data-user_id="<?php echo $listing_data['user_id']; ?>">
                                                <span>Contact Seller
                                                </span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
                                        <?php } else { ?>
                                            <a href="#small-dialog-4" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 popup-with-zoom-amt-2nim" data-user_id="<?php echo $listing_data['user_id']; ?>">
                                                <span>Contact Seller
                                                </span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
                                        <?php } ?>

                                    </div>
                                <?php  } else if (empty($this->session->userdata('user_id') && empty($listing_data['user_permission']['contact-seller']))) { ?>
                                    <!-- For guest user  -->
                                    <div class="btn buy_nowbtn h-auto listing_type_btn_a single_page_width_auto_a">
                                        <a href="#small-dialog-4" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 popup-with-zoom-anim custom_contact_seller">
                                            <span>Contact Seller
                                            </span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
                                    </div>
                                <?php  } else if (!empty($this->session->userdata('user_id') && empty($listing_data['user_permission']['contact-seller']))) { ?>
                                    <!-- upgrade permission -->
                                    <div class="btn buy_nowbtn h-auto single_page_width_auto_a">
                                        <a href="javascript:void(0)" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 custom_contact_seller" id='upgradePlan'><span>Contact Seller</span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
                                    </div>
                                <?php } ?>
                            <?php } ?>


                            <?php if ((!empty($listing_data['price']) && $listing_data['user_permission']['price'])  || ($listing_data['user_id']) == $this->session->userdata('user_id')) { ?>


                                <!-- Button -->
                                <?php if ($listing_data['user_permission']['buy-now'] && ($listing_data['user_id'] !== $this->session->userdata('user_id'))) { ?>

                                    <div class="btn buy_nowbtn h-auto listing_type_btn_a single_page_width_auto_a">
                                        <a href="<?php echo base_url() . 'checkout/' . 'buynow-solution' . '/' . $listing_data['slug']; ?>" class="white d-flex align-items-center">
                                            <span>Buy Now <?php if (!empty($default_currency)) echo $default_currency;
                                                            else echo '$'; ?> <?php if (!empty($listing_data['price'])) echo number_format($listing_data['price'], 2); ?>
                                            </span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
                                    </div>
                                <?php } ?>
                                <?php if ($listing_data['user_id'] == $this->session->userdata('user_id')) {  ?>
                                    <div class="btn buy_nowbtn h-auto listing_type_btn_a this_products_belongs_a single_page_width_auto_a">
                                        <a href="javascript:void(0)" class="white d-flex align-items-center">
                                            <span>This Product belogns to you
                                            </span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
                                    </div>
                                <?php } ?>
                            <?php
                            } ?>

                            <!--  solution view demo button  -->
                            <?php if (!empty($listing_data['solution_url'])) {  ?>
                                <?php if (!empty($listing_data['user_permission']['view-demo'])  || ($listing_data['user_id']) == $this->session->userdata('user_id')) { ?>
                                    <!-- Button -->
                                    <div class="btn buy_nowbtn h-auto listing_type_btn_a this_products_belongs_a single_page_width_auto_a">
                                        <!-- logged in user to view demo website/domain -->
                                        <a target="_blank" href="<?php if (!empty($listing_data['solution_url'])) echo  $listing_data['solution_url']; ?> " class="white d-flex align-items-center  "><span>View Demo</span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
                                    </div>
                                <?php } else if (empty($listing_data['user_permission']['view-demo']) &&  !empty($this->session->userdata('user_id'))) { ?>
                                    <!-- Logged-in without permission -->
                                    <div class="btn buy_nowbtn h-auto listing_type_btn_a this_products_belongs_a single_page_width_auto_a">
                                        <a href="javascript:void(0)" class="white d-flex align-items-center" id='upgradePlan'> <span>View Demo</span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i> </a>
                                    </div>
                                <?php
                                } else if (empty($listing_data['user_permission']['view-demo']) &&  empty($this->session->userdata('user_id'))) { ?>
                                    <!-- Without login to view demo website/domain -->
                                    <div class="btn buy_nowbtn h-auto listing_type_btn_a this_products_belongs_a single_page_width_auto_a">
                                        <a href="#small-dialog-4" class="white d-flex align-items-center  popup-with-zoom-anim "><span>View Demo</span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
                                    </div>
                                <?php } ?>

                            <?php   } ?>


                            </div>


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
                        <?php if (isset($listing_data['description'])) if (DECODE_DESCRIPTIONS) echo html_entity_decode(($listing_data['description']));
                        else echo ($listing_data['description']); ?>

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
                </div>
                <div class="col-md-4">
                    <div class="right_coursedetails">


                    </div>
                    <div class="donnot_like_a mb-5 shadow">
                        <h4>Don’t like what you see? Or have something new in mind?</h4>
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
    </section>
<?php
} ?>
<?php if (!empty($listing_data['user_permission']['contact-seller']) && !empty($this->session->userdata('user_id'))) {  ?>
    <div id="small-dialog-4" class="zoom-anim-dialog  dialog-with-tabs">
        <!--Tabs -->
        <div class="sign-in-form">

            <ul class="popup-tabs-nav">
                <li><a href="#tab2">Send Message</a></li>
            </ul>

            <div class="popup-tabs-container">

                <!-- Tab -->
                <div class="popup-tab-content" id="tab2">

                    <!-- Avatar -->
                    <a href="#"><img src="<?php if (isset($ownerData[0]['thumbnail'])) echo base_url() . USER_UPLOAD . $ownerData[0]['thumbnail']; ?>" alt="" class="msgavatar centerButtons"></a>

                    <!-- Welcome Text -->
                    <div class="welcome-text">
                        <h3>Direct Message <?php if (isset($ownerData[0]['firstname'])) echo 'To ' . $ownerData[0]['firstname']; ?> <?php if (isset($ownerData[0]['lastname'])) echo $ownerData[0]['lastname']; ?></h3>
                    </div>

                    <!-- Form -->
                    <form name="msgOwnerForm" class="msgOwnerForm" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="owner_id" class="owner_id" value="<?php if (isset($ownerData[0]['user_id'])) echo $ownerData[0]['user_id']; ?>">
                        <textarea name="txt_msg" class="txt_msg" cols="10" placeholder="Message" class="with-border" required></textarea>

                        <!-- Button -->
                        <div id="validationMsg"></div>
                        <button class="button full-width button-sliding-icon ripple-effect" type="submit">Send <i class="icon-material-outline-arrow-right-alt"></i></button>

                        <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                    </form>

                </div>

            </div>
        </div>
    </div>

<?php } ?>
<?php $this->load->view('main/includes/models'); ?>