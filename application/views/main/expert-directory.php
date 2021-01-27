<!-- Dashboard Headline -->
<div class="container">
    <div class="dashboard-headline">
        <div class='row mt-5'>
            <div class="col-xl-12 expert_row_a">
                <div class="title_card_a">
                    <h3><b>Meet Our Experts </b> </h3>
                </div>
                <div class="divider_a"></div>
                <div class="expert_para_a">
                    <p class="mb-0">Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.</p>
                </div>
            </div>
        </div>

        <?php if (!empty($experts)) { ?>
            <div class='row meet_our_expert_a'>

                <?php foreach ($experts as $expert) {
                    //  pre($permission['expert'],1);
                ?>

                    <div class="col-xl-4 col-sm-12 col-xs-12 mt-5">
                        <div class="card shadow show_profile_a">

                            <div class="tag_price_a">
                                <div class="price_tag">
                                    <span class="card-text"> $<?php echo $expert['rate'] ?? '' ?>/ hour</span>
                                </div>
                                <?php if(!empty($expert['profile_image']) && file_exists(IMAGES_UPLOAD.$expert['profile_image'])) {?>
                                    <img class="card-img-top" src="<?php echo site_url(IMAGES_UPLOAD . $expert['profile_image']); ?>" alt="Card image cap" />
                                <?php } else {?>
                                    <img class="card-img-top" src="<?php echo base_url('assets/img/Noimage.jpeg');?>" alt="Card image cap" />
                                <?php } ?>
                            </div>

                            <div class="card-body">
                                <h6 class="card-title">
                                    <?php if (!empty($permission['expert']['view-demo'])) : ?>
                                        <a href="<?php echo site_url('about-expert/' . $expert['slug']); ?>"><b><?php echo $expert['profile_name'] ?? '' ?></b></a>
                                    <?php elseif (empty($permission['expert']['view-demo']) && empty($this->session->userdata('user_id'))) : ?>
                                        <a href="<?php echo site_url('login'); ?>"><b><?php echo $expert['profile_name'] ?? '' ?></b></a>
                                        <?php elseif (empty($permission['expert']['view-demo']) && !empty($this->session->userdata('user_id'))) : ?>
                                            <a href="javascript:void(0)" id='upgradePlan'><b><?php echo $expert['profile_name'] ?? '' ?></b></a>
                                    <?php endif; ?>
                                </h6>

                                <p class="card-text"><?php if (!empty($expert['description'])) echo _str_limit(strip_tags($expert['description']), 85); ?>
                                </p>

                            </div>
                            <div class="card-footer">

                                <div class="row p-0">
                                    <div class="col-sm-12 col-md-12 col-xs-12 p-0 availability_section_a">
                                        <?php
                                        $avail = "";
                                        $avail = explode(',', $expert['availability']) ?? '';
                                        ?>
                                        <?php if (in_array('onsite', $avail)) { ?>
                                            <i class="fa fa-map-marker" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Onsite"></i>
                                        <?php }
                                        if (in_array('offsite', $avail)) { ?>
                                            <i class="fa fa-handshake-o" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Offsite"></i>
                                        <?php }
                                        if (!empty(in_array('online', $avail))) { ?>
                                            <i class="fa fa-globe" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Online"></i>
                                        <?php }  ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
    </div>
    <!-- Pagination -->
    <div class="clearfix"></div>
    <?php if (!empty($links)) : ?>
        <div class="row pagination_div pagi_top w-100 mt-5">
            <div class="container paginationSearch w-100">
                <nav aria-label="Page navigation example w-100">
                    <ul class="pagination justify-content-center w-100" style="margin:20px 0">
                        <?php if (!empty($links)) if (isset($links)) {
                            echo $links;
                        } ?>
                    </ul>
                </nav>
            </div>
        </div>
    <?php endif; ?>
    <!-- Pagination / End -->
<?php } ?>

</div>
</div><!-- extra div close kita ha -->
<br>
<br>
<br>
<br>