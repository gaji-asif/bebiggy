<?php if (isset($solution_data) && count($solution_data) > 0) : ?>
    <div class="row mt-5">
        <?php foreach ($solution_data as $file) : ?>
            <?php $fileName =  base_url() . IMAGES_UPLOAD . $file['name']; ?>
            <div id="<?php echo 'file_' . $file['id']; ?>" class="image_task mt-5 d-block">
                <?php if (!fileIcon($file['ext'])) : ?>
                    <a href="javascript:void(0)" class="solution_file_admin" data-id="<?php echo 'file_' . $file['id']; ?>"><i class="fa fa-times" aria-hidden="true"></i></a>
                    <embed src="<?php if (isset($file['name'])) echo $fileName; ?>" type="<?php echo $file['mime']; ?>" width="100" height="100" class="d-block" />
                    <span><?php echo  _str_limit($file['name'], 15); ?></span>
                <?php else : ?>
                    <a href="javascript:void(0)" class="solution_file_admin" data-id="<?php echo 'file_' . $file['id']; ?>"><i class="fa fa-times" aria-hidden="true"></i></a>
                    <span class="d-block"> <a href="javascript:void(0)" data-id="<?php echo 'file_' . $file['id']; ?>"><?php echo fileIcon($file['ext']); ?></i></a></span>
                    <span><?php echo  _str_limit($file['name'], 15); ?></span>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif;  ?>