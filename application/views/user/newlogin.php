<section class="auth-area">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 offset-md-3 col-lg-4 offset-lg-4 px-0 px-md-2">
                        <div class="card login-register">
                            <div class="card-header">
                                <span class="left-bor white ar"> Login</span>
                            </div>
                            <div class="card-body">
                                <form action="" id="UserLoginForm">
                                    <input type="text" class="form-control mb-2" name="login_username" id="login_username"  placeholder="<?php echo $this->lang->line('lang_txt_username'); ?> / <?php echo $this->lang->line('lang_txt_email'); ?>" >
                                    <input type="text" class="form-control mb-2" name="login_password" id="login_password" placeholder="<?php echo $this->lang->line('lang_txt_password'); ?>"/>
                                    <div class="full sub-section">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="remember">
                                            <label class="custom-control-label" for="remember">Remember Password</label>
                                            <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                                        </div>
                                        <a href="<?php echo base_url().'forgotpassword' ?>" class="float-right"><?php echo $this->lang->line('lang_txt_forgotpassword'); ?></a>
                                    </div>
                                    <div class="full">
                                        <div class="btn buy_nowbtn mt-3"> <button type="submit"
                                                class="white"><span>Login
                                                </span><i class="fa fa-long-arrow-right"
                                                    aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>