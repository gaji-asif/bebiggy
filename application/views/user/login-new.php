<!-- <section class="offer-area">
    <div class="container limited_offer_a">
        <div class="row">
            <div class="col-12">
                Limited Time Offer: 50% OFF & Buy 1 Get 1 Free. 

            </div>
        </div>

    </div>
</section> -->
<section class="auth-area login_page_section_a">
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card login-register">
                        <div class="card-header">
                            <span class="left-bor white ar"> Register</span>
                        </div>
                        <div class="card-body login">
                            <form id="UserRegistrationForm" class="forms-sample" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <input type="text" id="register_firstname" name="register_firstname" class="form-control mb-2" placeholder="<?php echo $this->lang->line('lang_txt_firstname'); ?>" required />
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="text" id="register_lastname" name="register_lastname" class="form-control mb-2" placeholder="<?php echo $this->lang->line('lang_txt_lastname'); ?>" required>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <input type="text" id="register_username" name="register_username" class="form-control" placeholder="<?php echo $this->lang->line('lang_txt_username'); ?>" required>
                                        <span class="text-danger" id="register_username_error"></span>
                                    </div>
                                    <div class="col-12">
                                        <input type="text" id="register_email" name="register_email" class="form-control mb-2" placeholder="<?php echo $this->lang->line('lang_txt_email'); ?>" required>
                                        <span class="text-danger" id="register_email_error"></span>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="password" id="register_password" name="register_password" class="form-control mb-2" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters' : ''); if(this.checkValidity()) form.confirmPassword.pattern = this.value;" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" class="form-control" required data-toggle="popover" title="Password Strength" data-content="Enter Password..." placeholder="<?php echo $this->lang->line('lang_txt_password'); ?>" required>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="password" class="form-control mb-2" placeholder="Confirm Password" id="register_repassword" name="register_repassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="<?php echo $this->lang->line('lang_txt_retypepassword'); ?>" required>
                                        <span class="text-danger" id="register_repassword_error"></span>
                                    </div>
                                    <div class="col-12">

                                        <div class="full1 sub-section1">
                                            <div class="custom-control1 custom-checkbox1">
                                                <input type="checkbox" class="custom-control-input1" id="remember1" required="">
                                                <label class="custom-control-label1" for="remember1">I accept
                                                    <a href="javascript:void(0)" class="yellow1" id="terms_condition" >Terms & Conditions
                                                        </a></label>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="full">
                                            <div class="btn buy_nowbtn mt-3 signup_btn">
                                                <button id="register_submit" type="submit" class="white"><span>Register
                                                    </span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                                            </div>
                                            <div class="mt-3" id="registrationStatus"></div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <span id="loadingImageRegister" style="display:none;" class="centerButtons"> <img src="<?php echo base_url(); ?>assets/img/loadingimage.gif" /></span>
                                <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                            </form>
                        </div>
                       
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="card login-register">
                        <div class="card-header">
                            <span class="left-bor white ar"> Login</span>
                        </div>
                        <div class="card-body login">
                            <form id="UserLoginForm" method="post" enctype="multipart/form-data">
                                <input type="text" class="form-control mb-2" name="login_username" id="login_username" placeholder="<?php echo $this->lang->line('lang_txt_username'); ?> / <?php echo $this->lang->line('lang_txt_email'); ?>">
                                <input type="password" class="form-control mb-2" name="login_password" id="login_password" placeholder="<?php echo $this->lang->line('lang_txt_password'); ?>">
                                <div class="full sub-section">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="remember">
                                        <label class="custom-control-label" for="remember">Remember Password</label>
                                    </div>
                                    <a href="<?php echo base_url() . 'forgotpassword' ?>" class="float-right">Lost Your
                                    Password?</a>
                                </div>
                                <div class="full">
                                    <div class="btn buy_nowbtn mt-3 log_btn login_button login_page_btn_a user_loginbtn_a"> <button type="submit"
                                        class="white"><span>Login
                                        </span><i class="fa fa-long-arrow-right"
                                            aria-hidden="true"></i></button>
                                    </div>
                                </div>
                                <span id="loadingImageLogin" style="display:none;" class="centerButtons"> <img src="<?php echo base_url(); ?>assets/img/loadingimage.gif" /> </span>
                                <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                               
                            </form>
                        </div>
                        <div id="loginStatus" class="status_section_a"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
