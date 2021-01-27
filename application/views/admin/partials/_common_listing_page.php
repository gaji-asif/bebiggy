<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
<div class="row">
    <div class="col-xs-24 col-sm-24 col-md-24 col-lg-12 col-xl-12">
        <div class="card mb-3">
            <div class="card-body">
                <a href="<?php echo isset($addUrl) ? base_url($addUrl) : '' ?>" class="btn btn-warning float-right mb-2 editLink">Add</a>
                <div class=" table-responsive">
                    <table class="table table-striped table-hover responsive ">
                        <thead>
                            <tr>
                                <?php foreach ($fields as $field) : ?>
                                    <th><a href="javascript:void(0)" class="topMenu" id="<?php echo $field; ?>"><?php echo strtoupper($field); ?>
                                            <?php if (!empty($orderBy) && ($orderBy == 'asc' && $orderColumn == $field)) {
                                                echo ('<i class="fas fa-angle-up"></i>');
                                            } elseif (!empty($orderBy) && ($orderBy == 'desc') && $orderColumn == $field) {
                                                echo ('<i class="fas fa-angle-down"></i>');
                                            } ?></a></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            if (isset($listDatas) && count($listDatas) > 0) :

                                foreach ($listDatas as $listData) : ?>
                                    <tr>
                                        <?php $deleteId = '';
                                        foreach ($fields as $field) :
                                           
                                            $id =  $listData['id'];
                                            $name =  $listData['name'];
                                        ?>
                                            <?php if ($field !== 'action') : ?>
                                                <?php if ($field == 'status') : ?>
                                                    <td>
                                                        <?php if ($listData["$field"] == 1) echo 'Active';
                                                        else echo 'Inactive'; ?>

                                                    </td>
                                                <?php else : ?>
                                                    <td>
                                                        <?php if ($field == 'is_default') : ?>
                                                            <?php if ($listData["$field"] == 1) {
                                                                $deleteId = 1; ?>
                                                                <a href="javascript:void(0);" id="isDefault" data-id="<?php echo $id; ?>" class=""><i style="font-size: 20px;" title="active" class="fas fa-check-circle" aria-hidden="true"></i></a>
                                                            <?php } else { ?>
                                                                <a href="javascript:void(0);" id="isDefault" data-id="<?php echo $id; ?>" class=""> <i style="font-size: 20px;" title="inactive" class="fas fa-times-circle" aria-hidden="true"></i></a>
                                                            <?php } ?>
                                                        <?php endif;  ?>

                                                        <?php if ($field == 'is_guest') : ?>
                                                            <?php if ($listData["$field"] == 1) {
                                                                $deleteId = 1; ?>
                                                                <a href="javascript:void(0);" id="isGuest" data-id="<?php echo $id; ?>" class=""><i style="font-size: 20px;" title="active" class="fas fa-check-circle" aria-hidden="true"></i></a>
                                                            <?php } else { ?>
                                                                <a href="javascript:void(0);" id="isGuest" data-id="<?php echo $id; ?>" class=""> <i style="font-size: 20px;" title="inactive" class="fas fa-times-circle" aria-hidden="true"></i></a>
                                                            <?php } ?>
                                                        <?php endif;  ?>

                                                        <?php if ($field != 'is_default' && $field != 'is_guest' ) : ?>
                                                            <?php echo $listData["$field"]; ?>
                                                        <?php endif;  ?>
                                                    </td>
                                                <?php endif;  ?>


                                            <?php else : ?>
                                                <!-- <i class="fa fa-times-circle" aria-hidden="true"></i> -->

                                                <td>
                                                    <a href="<?php echo site_url($addUrl) . "/$id"; ?>" data-id="<?php echo $id; ?>" class="editLink"> <i title="edit" class="fas fa-edit" aria-hidden="true"></i></a>
                                                    <?php 
                                                    if (empty($deleteId)) { ?>
                                                        <a href="javascript:void(0);" data-name='<?php echo  $name; ?>' data-id="<?php echo $id; ?>" class="deletLinkCommon"> <i title="delete" class="fas fa-trash pl-3" aria-hidden="true"></i></a>
                                                    <?php } ?>

                                                </td>
                                            <?php endif;
                                            ?>
                                        <?php endforeach; $deleteId = '';  ?>
                                    </tr>
                            <?php endforeach;
                            else :
                                echo "No Record Found.";
                            endif;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <!-- Pagination -->
        <div class="clearfix"></div>
        <div class="pagination-container margin-top-40 margin-bottom-10 centerButtons">
            <nav class="pagination">
                <ul>
                    <?php if (isset($links)) {
                        echo $links;
                    }
                    ?>
                </ul>
            </nav>
        </div>
        <div class="clearfix"></div>
        <!-- Pagination / End -->

    </div>
</div>