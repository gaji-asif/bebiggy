<div id="body_content">
    <div class="content">

        <div class="table-responsive solutions_listings">
            <table class="table table-head-fixed table-border table-hover table-striped table-condensed">
                <thead>
                    <tr>
                        <th><a href="javascript:void(0);" class="tblMnu">User Name</a></th>
                        <th><a href="javascript:void(0);" class="tblMnu">Plan Name</a></th>
                        <th><a href="javascript:void(0);" class="tblMnu">Price</a></th>
                        <th><a href="javascript:void(0);" class="tblMnu">Start-Date</a></th>
                        <th><a href="javascript:void(0);" class="tblMnu">End-Date</a></th>
                </thead>
                <tbody>
                    <?php
                    //pre($membership_details,1);
                    if (!empty($membership_details)) {
                        foreach ($membership_details as $listing) { ?>

                            <tr>

                                <td><a href="<?php echo site_url('admin/user-wise-membership-list/') ?><?php echo $listing['user_id'];  ?>"><?php echo $listing['username']; ?></a></td>
                                <td><a><?php echo $listing['name']; ?></a></td>
                                <td>$ <?php echo $listing['price']; ?></td>

                                <td><?php $date = $listing['membership_assign_date'];
                                    $dt = new DateTime($date);
                                    echo $buy_date = $dt->format('Y-m-d');
                                    ?></td>
                                <td><?php echo date('Y-m-d', strtotime($date . ' + ' . $listing['validity'] . ' days')); ?></td>
                            </tr>
                    <?php  }
                    } else echo '<li>Sorry !! No Listings are available</li>'; ?>
                    <!-- set bundle id just for show side icon-->
                </tbody>
            </table>
        </div>
        <!-- End Listing -->

        <!-- Pagination -->
        <div class="clearfix"></div>
        <div class="pagination-container margin-top-40 margin-bottom-10 centerButtons">
            <nav class="pagination solutions_listings_pagination_a">
                <ul>
                    <?php if (isset($links)) {
                        echo $links;
                    }
                    ?>
                </ul>
            </nav>
        </div>
        <!-- Pagination / End -->

    </div>
    <!--  content / end  -->

</div>
<!-- body_content / end -->