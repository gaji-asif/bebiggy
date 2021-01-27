<?php //pre($expert[0]);
extract($expert[0]);
?>
<style>
    .rate_show_a {

        font-size: 15px;
        position: absolute;
        font-weight: 600;
        margin: 0px auto;
        background: #ffc24d;
        padding: 5px;
        right: 0;
        text-align: center;
        top: 85%;
        color: #fff;
        transform: translate(0%);
    }

    .expert_image {
        position: relative;
    }
</style>
<div class="container expert_single_page_a">
    <div class='row mt-5'>
        <div class="col-xl-10 ">
            <!-- <h3><b>Expert Details </b> </h3> -->
        </div>
    </div>


    <div class="row deatils_view_s">
        <div class="col-md-9">
            <div class="details_tables_a">
                <div class="data_title_a">
                    <h4>Expert Details</h4>
                    <hr>
                </div>
                <div class="content_div_a">
                    <ul>
                        <li><span class="first_li_a">Type</span><span class="right_align">: <?php echo  $type ?? '' ?></span></li>
                        <li><span class="first_li_a">Specialization </span> <span class="right_align">: <?php echo  $specialization ?? '' ?></span></li>
                        <li><span class="first_li_a">Experience </span> <span class="right_align">: <?php echo  $year ?? 0 ?> Yr <?php echo  $month ?? 0 ?> Month</span></li>
                        <li><span class="first_li_a">Solution Category </span> <span class="right_align">: <?php echo  $solution_category ?? '' ?></span></li>


                    </ul>

                    <ul>
                        <li><span class="first_li_a">Availability </span> <span class="right_align">: <?php echo  $availability ?? '' ?></span></li>

                        <li><span class="first_li_a">Country</span> <span class="right_align">: <?php echo  $business_registeredCountry ?? '' ?></span></li>
                        <li><span class="first_li_a">City </span> <span class="right_align">: <?php echo  $city ?? '' ?></span></li>
                        <li><span class="first_li_a">Service Type </span> <span class="right_align">: <?php echo  $service_type ?? '' ?></span></li>


                    </ul>

                    <div class="service_offered_a">
                        <h4>Service Offered</h4>
                        <?php echo  $service_offered ?? '' ?>
                    </div>
                </div>
            </div>

            <div class="details_bio_a dark_gry">
                <div class="data_title_a">
                    <h4>Expert Bio</h4>
                    <hr>
                </div>
                <div class="content_div_a">
                    <p>
                        <?php echo  $description ?? '' ?>
                    </p>


                </div>
            </div>

        </div>
        <div class="col-md-3 col-sm-12">
            <div class="expert_image">
                <img class="card-img-top" src="<?php if (!empty($profile_image)) echo site_url(IMAGES_UPLOAD . $profile_image); ?>" alt="Card image cap">
                <p class="rate_show_a"><?php echo  $rate ?? '' ?> / <?php echo  $rate_time ?? '' ?></p>
            </div>
            <br>
            <p class="card-text text-center"><b><?php echo $profile_name ?? '';  ?></b></p>
            <div class="">
                <?php if (!empty($permission['expert']['contact-seller']) && !empty($this->session->userdata('user_id'))) : ?>
                    <div class="btn buy_nowbtn mt-2 w-100 h-auto listing_type_btn_a expert_button_a">
                        <a href="#small-dialog-4" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 popup-with-zoom-anim custom_contact_seller" data-user_id="<?php echo $user_id; ?>">
                            <span>Contact Expert
                            </span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
                    </div>
                <?php elseif (empty($permission['expert']['contact-seller']) && empty($this->session->userdata('user_id'))) : ?>
                    <div class="btn buy_nowbtn mt-2 w-100 h-auto listing_type_btn_a expert_button_a">
                        <a href="#small-dialog-4" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 popup-with-zoom-anim custom_contact_seller">
                            <span>Contact Expert
                            </span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
                    </div>

                <?php elseif (empty($permission['expert']['contact-seller']) && !empty($this->session->userdata('user_id'))) : ?>
                    <div class="btn buy_nowbtn mt-2 w-100 h-auto">
                        <a href="javascript:void(0)" class="white d-flex align-items-center button ripple-effect move-on-hover full-width margin-top-20 custom_contact_seller" id='upgradePlan'><span>Contact Expert</span><i class="fa fa-long-arrow-right ml-auto" aria-hidden="true"></i></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

    <!----Send message------------>
    <div id="small-dialog-4" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

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
    <!-- Send Direct Message Popup / End -->