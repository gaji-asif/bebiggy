
<!-- <section class="offer-area">
=======
<section class="offer-area admin_offer_area_a">
>>>>>>> Stashed changes
    <div class="container">
        <div class="row">
            <div class="col-12">
                Limited Time Offer: 50% OFF & Buy 1 Get 1 Free. 
                <a href="#">Get Now <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
            </div>
        </div>

    </div>
</section> -->
<section class="auth-area">
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 offset-md-3 col-lg-4 offset-lg-4 px-0 px-md-2">
                    <div class="card login-register">
                        <div class="card-header">
                            <span class="left-bor white ar"> Login</span>
                        </div>
                        <div class="card-body login">
                            <form id="AdminLoginForm" method="post" enctype="multipart/form-data">
                                <input type="text" class="form-control mb-2" name="login_username" id="login_username" placeholder="<?php echo $this->lang->line('lang_txt_username'); ?> / <?php echo $this->lang->line('lang_txt_email'); ?>"/>
                                <input type="password" class="form-control mb-2" name="login_password" id="login_password" placeholder="<?php echo $this->lang->line('lang_txt_password'); ?>" />
                                <div class="full sub-section">
                                    <!-- <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="remember">
                                        <label class="custom-control-label" for="remember">Remember Password</label>
                                    </div> -->
                                    <a href="<?php echo base_url().'forgotpassword' ?>" class="float-right">Lost Your
                                    Password?</a>
                                    <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                </div>
                                <div class="full">
                                    <div class="btn buy_nowbtn mt-3 log_btn login_button admin_loginbtn_a"> <button type="submit"
                                        class="white"><span>Login
                                        </span><i class="fa fa-long-arrow-right"
                                            aria-hidden="true"></i></button>
                                    </div>
                                </div>
                                <span id="loadingImageLogin" style="display:none;" class="centerButtons"> <img src="<?php echo base_url(); ?>assets/img/loadingimage.gif" /> </span>
                                <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                               
                            </form>
                        </div>
                       <!--  <div id="loginStatus"></div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>