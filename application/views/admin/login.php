<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
        <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one" style="background-image: url('<?php if(isset($imagesData[0]['mainback'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['mainback']; ?>'); ">
            <div class="row w-100">
                <div class="col-lg-4 mx-auto">
                    <div class="auto-form-wrapper-reset">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="login-register-page">
                                    <!-- Welcome Text -->
                                    <div class="welcome-text">
                                        <a href="<?php echo base_url(); ?>">
                                        <img src="<?php if(!empty($imagesData[0]['invoice_logo'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['invoice_logo']; ?>" data-holder-rendered="true" width="30%" height="30%" />
                                        </a>
                                        <br>
                                        <h3><?php echo $this->lang->line('site_name'); ?> Admin Login !</h3>
                                        <span>Please use your admin credentials to login</a></span>
                                    </div>
                                    <!-- Form -->
                                    <form id="AdminLoginForm" method="post" enctype="multipart/form-data">
                                        <div class="input-with-icon-left">
                                            <i class="icon-material-baseline-mail-outline"></i>
                                            <input type="text" class="input-text with-border" name="login_username" id="login_username" placeholder="<?php echo $this->lang->line('lang_txt_username'); ?> / <?php echo $this->lang->line('lang_txt_email'); ?>"/>
                                        </div>
                                        <div class="input-with-icon-left">
                                            <i class="icon-material-outline-lock"></i>
                                            <input type="password" class="input-text with-border" name="login_password" id="login_password" placeholder="<?php echo $this->lang->line('lang_txt_password'); ?>"/>
                                        </div>
                                        <a href="<?php echo base_url().'forgotpassword' ?>" class="forgot-password"><?php echo $this->lang->line('lang_txt_forgotpassword'); ?></a>
                                        <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                    </form>
                                    <!-- Button -->
                                    <span id="loadingImageLogin" style="display:none;" class="centerButtons"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>
                                    <button id="button_login" name="button_login"  class="button full-width button-sliding-icon ripple-effect margin-top-10" type="submit" form="AdminLoginForm"><?php echo $this->lang->line('lang_btn_login'); ?><i class="icon-material-outline-arrow-right-alt"></i></button>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div id="loginStatus"></div>
                    </div>
                    <ul class="auth-footer">
                        <li>
                            <a href="<?php echo base_url().'page/dmca'; ?>"><?php echo $this->lang->line('lang_privacy_policy'); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>contactus"><?php echo $this->lang->line('lang_txt_contact_us'); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().'page/terms-of-service'; ?>"><?php echo $this->lang->line('lang_terms_ofservice'); ?></a>
                        </li>
                    </ul>
                    <p class="footer-text text-center">copyright © <?php echo date('Y'); ?> <a href="<?php echo base_url(); ?>" target="_blank"> <?php echo $this->lang->line('site_name'); ?> </a><?php if($settings[0]['footer_credits'] === '1') { ?> . <?php } ?> All rights reserved.</p>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>