		<!-- admin/user/footer -->
    <footer class="footer">
      <div class="container-fluid clearfix">
        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © <?php echo date('Y'); ?>
          <a href="<?php echo base_url();?>" target="_blank"> <?php echo $this->lang->line('site_name'); ?> </a>
              <?php if($settings[0]['footer_credits'] === '1') { ?> <?php } ?> All rights reserved.</span>
      </div>
    </footer>
    <!-- /admin/user/footer -->