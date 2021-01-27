<div class="content">

<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">


    <div class="table-responsive solutions_listings">
        <table class="table table-head-fixed table-border table-hover table-striped table-condensed">
            <thead>
                <tr>
                    <th><a href="javascript:void(0);" class="tblMnu">Public Name</a></th>
                    <th><a href="javascript:void(0);" class="tblMnu">Type</a></th>
                    <th><a href="javascript:void(0);" class="tblMnu">Solution Category</a></th>
                    <th><a href="javascript:void(0);" class="tblMnu">Rate</a></th>
                    <th><a href="javascript:void(0);" class="tblMnu">Date</a></th>
                    <th><a href="javascript:void(0);" class="tblMnu">Status</a></th>
                    <th><a href="javascript:void(0);" class="tblMnu">Action</a></th>
            </thead>
            <tbody>
                <?php if (!empty($experts)) {
                    foreach ($experts as $listing) { ?>

                        <tr>
                            <td><a href='javascript:void(0);' data-sid="<?php echo $listing['id']; ?>" data-name="<?php echo $listing['profile_name']; ?>" class=""><?php echo $listing['profile_name']; ?></a></td>
                            <td><?php echo $listing['type'] ?? ''; ?></td>
                            <td><?php echo $listing['solution_category'] ?? ''; ?></td>
                            <td><?php echo $listing['rate'] ?? ''; ?></td>
                            <td>
                                <?php
                                $listing['created_date']  = $listing['created_date'] ?? '';
                                $dt = new DateTime($listing['created_date']);
                                echo $dt->format('Y-m-d');
                                ?>

                            </td>
                            <td>
                                <?php if ($listing['admin_approved'] == 1) : ?>
                                    Approved
                                <?php elseif ($listing['admin_approved'] == 2) :  ?>
                                    Suspended
                                <?php elseif ($listing['admin_approved'] == 0) :  ?>
                                    Approval Pending
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href='<?php echo site_url('admin/edit-expert/' . $listing['user_id']); ?>' class="solution_edit_icon_a" id="EditSolution" title=" Edit"><i class="fas fa-edit" aria-hidden="true"></i></a>
                                &nbsp;&nbsp;

                                <a href="javascript:void(0);" class="solution_delete_icon_a" data-url='admin/delete-expert' id="deleteExpert" data-id="<?php echo $listing['id'] ?>" title="Delete">
                                    <i class="fas fa-trash" aria-hidden="true"></i></a>
                            </td>
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