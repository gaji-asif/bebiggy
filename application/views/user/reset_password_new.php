<section class="auth-area">
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 offset-md-3 col-lg-4 offset-lg-4 px-0 px-md-2 forget_password_a">
                    <div class="auto-form-wrapper-reset">
                        <div class="card login-register">
                            <div class="card-header text-center">
                                <span class="left-bor white ar">Reset Password !</span>
                            </div>
                            <div class="col-xl-12">
                                <div class="login-register-page">

                                    <!-- Welcome Text -->
                                    <div class="welcome-text mt-3">
                                        <span>Please enter your email. Password reset email will be sent to your
                                            email.</span>
                                    </div>

                                    <form id="ResetPasswordForm" class="forms-sample" method="post"
                                        enctype="multipart/form-data" />
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input id="reset_email" name="reset_email" type="text" class="form-control reser_password_a"
                                                placeholder="<?php echo $this->lang->line('lang_txt_email'); ?>"
                                                required>
                                           <!--  <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i id="i_emailcheckReset" class="fa fa-check-circle"></i>
                                                </span>
                                            </div> -->
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <span id="loadingImageReset" style="display:none;" class="centerButtons"> <img
                                                src="<?php echo base_url();?>assets/img/loadingimage.gif" /> </span>
                                        <div id="ResetStatus"></div>
                                        <button id="button_reset" name="button_reset"
                                            class="button full-width button-sliding-icon ripple-effect margin-top-10"
                                            disabled="true">Reset Password</button>
                                    </div>

                                    <input type="hidden" class="txt_csrfname"
                                        name="<?= $this->security->get_csrf_token_name(); ?>"
                                        value="<?= $this->security->get_csrf_hash(); ?>">

                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

