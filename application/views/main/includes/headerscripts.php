<!----------------------------------------------------------------------------------------------------------->
<!-- vendors -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/css/owl.carousel.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/css/creditly.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/iconfonts/mdi/css/materialdesignicons.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/css/bootstrap-tagsinput.css"/>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/css/select2.min.css"/>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/css/all.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/iconfonts/flag-icon-css/css/flag-icon.min.css">
<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/iconfonts/font-awesome/css/font-awesome.min.css"> -->
<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/iconfonts/font-awesome/css/font-awesome.min.css"> -->
<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/iconfonts/mdi/css/materialdesignicons.min.css"/> -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/css/app-slider.css">
<!----------------------------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/summernote/summernote.min.css">
<!----------------------------------------------------------------------------------------------------------->
<!-- main -->
<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<link href="<?php echo base_url(); ?>assets/css/colors/gradient.css" rel="stylesheet" />
<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/iconfonts/font-awesome/css/font-awesome.min.css"> -->
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<!----------------------------------------------------------------------------------------------------------->

<!---------------------------Google Analytics------------------------------------------------------------------------------>
<?php if(isset($settingsData[0]['headcode']) and !empty($settingsData[0]['headcode'])){
    print_r( $settingsData[0]['headcode']); } 
?>
<!------------------------------------------------------------------------------------------------------------------------->
<!--Cookie BAR -->
<div class="cookies mobile-hidden" style="display:none;">
   	<div class="container">
        <div class="col-sm-12"><?php echo $this->lang->line('cookies_msg'); ?></span> <!--<a href="/cookies">Find out more</a>.--> <a class="close-cookie-warning"><span>×</span></a></div>
    </div>
</div>
<!------------------------------------------------------------------------------------------------------------------------->

<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">


