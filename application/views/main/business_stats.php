<?php //pre($listing_data[0]);
extract($listing_data[0]);
?>
<style>
    .first_li_a {
        width: 70%;
    }

    .content_div_a ul {
        width: 100%;
    }

    .content_div_a ul li span {
        color: #212529;
        font-size: 16px;
    }

    .first_li_a {}

    .content_div_a ul li {
        display: flex;
    }

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
    <div class="row deatils_view_s">
        <div class="col-md-12 px-0">
            <div class="details_tables_a">

                <div class="coursedetail_title">
                    <div class="course_title_bar"></div>
                    <h3>Business Stats</h3>
                </div>
                <?php $i = 0;
                if (!empty('established_date')) { ?>
                    <div class="content_div_a">
                        <div class="row">
                            <div class="col-md-12 pl-0">
                                <ul class="p-0 mb-0">
                                    <?php if (isset($last12_monthsrevenue) && !empty($last12_monthsrevenue)) {  ?>
                                        <li><span class="first_li_a">Financial Overview Last 12 Months Revenue</span> <span class="right_align">: <?php $i++;
                                                                                                                                                    echo  $last12_monthsrevenue ?? '' ?></span></li>
                                    <?php } ?>

                                    <?php if (isset($established_date) && !empty($established_date)) {  ?>
                                        <li><span class="first_li_a">Date Established </span><span class="right_align">: <?php $i++;
                                                                                                                            echo  $established_date ?? '' ?></span></li>
                                    <?php } ?>

                                    <?php if (isset($Monetized_since) && !empty($Monetized_since)) {  ?>
                                        <li><span class="first_li_a">Monetized Since </span> <span class="right_align">: <?php $i++;
                                                                                                                            echo  $Monetized_since ?? '' ?></span></li>
                                    <?php } ?>


                                    <?php if (isset($six_months_revenue) && !empty($six_months_revenue)) {  ?>
                                        <li><span class="first_li_a">Last 6 Months Avg Revenue </span> <span class="right_align">: <?php $i++;
                                                                                                                                    echo  $six_months_revenue ?? 0 ?> </li>
                                    <?php } ?>

                                    <?php if (isset($six_months_profit) && !empty($six_months_profit)) {  ?>
                                        <li><span class="first_li_a">Last 6 Months Avg Profit </span> <span class="right_align">: <?php $i++;
                                                                                                                                    echo  $six_months_profit ?? '' ?></span></li>
                                    <?php } ?>
                                </ul>

                                <ul class="p-0">
                                    <?php if (isset($last12_monthsexpenses) && !empty($last12_monthsexpenses)) {  ?>
                                        <li><span class="first_li_a">Last 12 Months Expenses</span> <span class="right_align">: <?php $i++;
                                                                                                                                echo  $last12_monthsexpenses ?? '' ?></span></li>
                                    <?php } ?>

                                    <?php if (isset($annual_profit) && !empty($annual_profit)) {  ?>
                                        <li><span class="first_li_a">Annual Profit </span> <span class="right_align">: <?php $i++;
                                                                                                                        echo  $annual_profit ?? '' ?></span></li>
                                    <?php  } ?>

                                    <?php if (isset($traffic_sources) && !empty($traffic_sources)) {  ?>
                                        <li><span class="first_li_a">Traffic Sources </span> <span class="right_align">:
                                                <?php $i++; ?>
                                                <?php $tfsoucr = [];
                                                $traffic_sources  = explode(',', $traffic_sources);
                                                foreach (TRAFFIC_SOURCES as $key => $val) : ?>
                                                    <?php if (in_array($key, $traffic_sources))  $tfsoucr[] = $val; ?>
                                                <?php endforeach;
                                                if (!empty($tfsoucr) && count($tfsoucr) > 0) {
                                                    echo implode(" , ", $tfsoucr);
                                                }
                                                ?>
                                            </span></li>

                                    <?php  } ?>

                                    <?php if (isset($monthly_visitors) && !empty($monthly_visitors)) {  ?>
                                        <li><span class="first_li_a">Monthly Visitors </span> <span class="right_align">: <?php $i++;
                                                                                                                            echo  $monthly_visitors ?? '' ?></span></li>
                                    <?php  } ?>

                                    <?php if (empty($i)) { ?>
                                        <h6 class="ml-4">Details are not availables</h6>

                                    <?php } ?>
                                </ul>
                            </div>
                        </div>




                    </div>

                <?php } else { ?>
                    <div class="content_div_a">
                        <h4>Details are not availables</h4>
                    </div>
                <?php } ?>
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