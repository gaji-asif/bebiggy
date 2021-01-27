<!-- <section>
    <div class="modal fade" id="subscirbe_form">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header border-bottom-0 d-block header_subscibe_a pb-0">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">
                        Our BEST OFFERS are only for Email Subscribers. So subscribe NOW
                    </h4>
                    <p>Don't miss out on good things</p>

                </div>

                <div class="modal-body pt-0">
                    <form id="emailSubscriberForm" action="common/save_subscriber_email" method="post" onsubmit="return validateEmailSubscriberForm();">
                        <input type="hidden" name="emailSubscriberPageTags" value="<?php //echo emailSubscriberPageTags(); ?>" />
                        
                        <input type="hidden" class="txt_csrfname" name="<?php //echo $this->security->get_csrf_token_name(); ?>" value="<?php //echo $this->security->get_csrf_hash(); ?>">

                        <div class="form-group">

                            <input type="text" class="form-control" name="esFirstName" id="esFirstName" placeholder="Enter First Name">
                        </div>
                        
                        <div class="form-group">

                            <input type="text" class="form-control" name="esLastName" id="esLastName" placeholder="Enter Last Name">
                        </div>
                        <div class="form-group">

                            <input type="email" class="form-control" name="esEmail" id="esEmail" placeholder="Enter Email...">
                        </div>
                        <div class="form-group" id="showEmailSubscribeErrors"></div>

                        <div class="subscribe_button_a">
                            <a href="javascript:void(0);" onclick="$('#emailSubscriberForm').submit();" class="btn btn-default d-flex justify-content-between">
                                <span>Yes, I don't want to miss anything exciting. </span>
                                <i class="fa fa-paper-plane-o" aria-hidden="true"></i></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section> -->


<!-- end subscirbe form -->
<section class="search_error_a d-none">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="search_text_errore_a">
                    <h2>No Result Found</h2>
                    <p>Try searching again using a different term.</p>
                </div>
            </div>
        </div>
        <div class="row need_div mt-4 mb-5">
            <!-- start -->

            <div class="container py-5">


                <div class="col-md-8 col-sm-12">
                    <h2>Have a website or domain to sell? Contact us now to get a listing.</h2>

                </div>
                <div class="col-md-4 col-sm-12">
                    <a href="<?php echo site_url('faq-3/what-is-drop-shipping'); ?>" class="btn btn-default learn_nowbtn justify-content-between"><span>Contact Us</span> <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                </div>

            </div>
            <!-- end -->
        </div>
    </div>
</section>
<section class="page_ment_section_a d-none">
    <div class="container-fluid">
        <div class="container">


            <div class="row">
                <div class="col-md-4">


                    <div class="icon_text_a d-flex justify-content-between">
                        <i class="fa fa-question fa-3x" aria-hidden="true"></i>
                        <p class="mr-auto"><b><a href="faq-3">FAQ</a></b></p>

                    </div>

                </div>
                <div class="col-md-4">
                    <div class="icon_text_a d-flex justify-content-between">
                        <i class="fa fa-life-ring fa-3x"></i>
                        <p class="mr-auto"><b class="theme_color_a"> Support </b> teams across the world
                        </p>
                    </div>

                </div>
                <div class="col-md-4">

                    <div class="icon_text_a d-flex justify-content-between">
                        <i class="fa fa-lock fa-3x"></i>
                        <p class="mr-auto"><b class="theme_color_a">Safe & Secure </b> online payment
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="footer">
    <section>
        <div class="container-fluid footer_firts">
            <div class="container">
                <div class="row py-4">
                    <div class="col-md-5 col-sm-4 col-xs-12">
                        <div class="footer_title py-3">
                            <h3>Useful Links</h3>
                        </div>
                        <div class="footer_content">
                            <ul>
                                <li><a href="<?php echo site_url('get-started') . '#pick_a_niche'; ?>">Pick a Niche</a></li>
                                <li><a href="<?php echo site_url('get-started') . '#learn_about_market'; ?>">Learn About Market</a></li>
                                <li><a href="<?php echo site_url('get-started') . '#pick_your_website'; ?>">Pick A Website</a></li>
                                <li><a href="<?php echo site_url('get-started') . '#manage-supply'; ?>">Manage Suppliers</a></li>
                                <li><a href="<?php echo site_url('get-started') . '#maximize-income'; ?>">Maximize Your Income</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="footer_title py-3">
                            <h3>More Links</h3>
                        </div>
                        <div class="footer_content">
                            <ul>
                                <li><a href="<?php echo site_url('contact-us'); ?>">Contact Us</a></li>
                                <li><a href="<?php echo site_url('terms-of-services'); ?>">Terms of Services</a></li>
                                <li><a href="<?php echo site_url('privacy-policy'); ?>">Privacy Policy</a></li>
                                <li><a href="<?php echo site_url('purchase-agreement'); ?>"> Purchase Agreement </a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <div class="footer_title py-3">
                            <h3>Connect With Us</h3>
                        </div>
                        <div class="footer_content">
                            <ul>
                                <li>Email: <a href="mailto:support@bebiggy.com" class="support_email">support@bebiggy.com</a></li>
                                <li><a href="https://www.facebook.com/bebiggy/">Facebook</a></li>
                                <li><a href="https://www.instagram.com/bebiggy/">Instagram</a></li>
                            </ul>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="row footer_second py-3">
            <div class="container text-center">
                <p class="mb-0">© Copyright 2014-<script>
                        document.write(new Date().getFullYear())
                    </script> BE BIGGY Alright Reserved</p>
                    <input type="hidden" name="currentOpenedPage" id="currentOpenedPage" value="<?php echo emailSubscriberPageTags(); ?>" />

                    <form id="currentOpenedPageForm" action="<?php echo site_url('main/user_accessed_pages')?>" method="post">
                        <!-- <input type="hidden" class="txt_csrfname" name="<?php //echo  $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>"> -->
                        <?php
                        /*$detailPageTags = '';
                        if(isset($listing_data['page_tags'])) { 
                            //will come from Main.php controller > function solutionDetails
                            $detailPageTags = $listing_data['page_tags']; 
                        }*/
                        ?>
                        <!-- <input type="hidden" name="completePageUrl" id="completePageUrl" value="<?php //echo current_url();?>" /> -->
                        <!-- <input type="hidden" name="solutionPageTags" id="solutionPageTags" value="<?php //echo $detailPageTags ?>" /> -->
                        <input type="hidden" name="currentOpenedPageHidden" id="currentOpenedPageHidden" value="" />
                    </form>
            </div>
        </div>
    </section>
</footer>

<!-- <script src="<?php //echo base_url(); 
                    ?>assets/vendor/js/jquery-3.3.1.min.js"></script> -->
<!-- <script src="<?php //echo base_url(); 
                    ?>assets/js/popper.min.js"></script> -->
<!-- <script src="<?php //echo base_url(); 
                    ?>assets/vendor/js/bootstrap.min.js"></script> -->
<!-- <script src="<?php //echo base_url(); 
                    ?>assets/vendor/js/bootstrap-slider.min.js"></script> -->
<!-- <script src="<?php //echo base_url(); 
                    ?>assets/js/owl.carousel.js"></script> -->
<?php $this->load->view('main/includes/footerscripts'); ?>
<script src="<?php echo base_url(); ?>assets/js/frontFooterScript.js"></script>

<script>


    // tag name start
     $(document).ready(function(){
        var currentOpenedPage = $('#currentOpenedPage').val();
        //console.log("Page:"+currentOpenedPage);
        if($.trim(currentOpenedPage)!='') {
            var userOpenedPages = localStorage.getItem('userOpenedPages');
            if($.trim(userOpenedPages)!='') {
                userOpenedPages = userOpenedPages + ","+currentOpenedPage;
            } else {
                userOpenedPages = currentOpenedPage;
            }
            //console.log(userOpenedPages);
            var myPageArr = userOpenedPages.split(",");
            if(myPageArr.length < 14){
                localStorage.setItem('userOpenedPages',userOpenedPages);
            } else {
                $('#currentOpenedPageHidden').val(userOpenedPages);
                $.ajax({
                        url    : "<?php echo site_url('main/user_accessed_pages')?>",
                        data   : $('#currentOpenedPageForm').serialize(), 
                        method : "post",
                        success: function(result){
                            localStorage.setItem('userOpenedPages',"");
                            $('.txt_csrfname').val(result.token);
                        }
                      });
            }
            //console.log(myPageArr);
            //console.log(myPageArr.length);
        }
    });
    
    // end tag name 




    /*const now = new Date();
    var pageOpenedTime = now.getTime(); 
    if (typeof(Storage) !== "undefined") {
       
        if(localStorage.getItem("userClosedEmailSubscriberPopup") === null) {
            
             $(window).load(function(){
               setTimeout(function(){
                   $('#subscirbe_form').modal('show');
               }, 2000);
            });
         } else if(parseInt(localStorage.getItem("userClosedEmailSubscriberPopup")) < parseInt(pageOpenedTime)) {
           
             $(window).load(function(){
               setTimeout(function(){
                   $('#subscirbe_form').modal('show');
               }, 2000);
            });
         }  
    }*/

    /*$('#subscirbe_form').on('hidden.bs.modal', function () {
      // Check browser support
        if (typeof(Storage) !== "undefined") {
          // Store
          localStorage.setItem("userClosedEmailSubscriberPopup", pageOpenedTime + 21600000);
        }
    })*/

    function myFunction(x) {
        x.classList.toggle("change");
    }
    $('.carousel').carousel({
        interval: 1500
    })
function validateEmailSubscriberForm(){

    var esFirstName = $.trim($('#esFirstName').val());
    var esLastName  = $.trim($('#esLastName').val());
    var esEmail     = $.trim($('#esEmail').val());
    var atpos       = esEmail.indexOf("@");
    var dotpos      = esEmail.lastIndexOf(".");

    var error = 0;
    var errorMsg = '';
    if(esFirstName == "") {
        error = error + 1;
        errorMsg += 'First name is required';
    }else if(esLastName == "") {
        error = error + 1;
        if(errorMsg == "")
            errorMsg += 'Last name is required';
        else
            errorMsg += ', Last name is required';
    }else if(esEmail == "") {
        error = error + 1;
         if(errorMsg == "")
            errorMsg += 'Email is required';
        else
            errorMsg += ', Email is required';
    } else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=esEmail.length) {
        error = error + 1;
         if(errorMsg == "")
            errorMsg += 'Please enter a valid email address';
        else
            errorMsg += ', Please enter a valid email address';
      }

    if(error > 0) {
        $('#showEmailSubscribeErrors').html('<label class="error_msg_a">'+errorMsg+'</label>');
    } else {
        $('#showEmailSubscribeErrors').html('');
        $.ajax({
            method: 'POST',
            url: baseUrl + 'common/save_subscriber_email',
            data: $("#emailSubscriberForm").serialize(),
            dataType: 'json',
            success: function(data) {
                
                if (data.response === true) {
                    clearInputs('emailSubscriberForm');
                    $('#showEmailSubscribeErrors').html('<label class="success_msg_a">Successfully subscribed for email</label>');
                } else {
                    $('#showEmailSubscribeErrors').html(data.msg);
                }
            },
            complete: function() {
               /* $('#loader').hide();
                $('#notification').show();*/
            },
            error: function(xhr, ajaxOptions, thrownError) {
                //alert(thrownError);
                $('#showEmailSubscribeErrors').html('<label class="error_msg_a">Could not complete your request, some unknown error occurred</label>');
            }
        });
    }

    return false;
}
    // $(document).ready(function() {
    //       $(".mobile_menu .firstulli_li_a").click(function() {
    //         $(".mobile_menu .firstulli_li_a > .dropdown-menu").toggle();
    //       });

    //       $(".mobile_menu .second_levelli_a").click(function() {
    //         $(".second_levelli_a .dropdown-menu").toggle();
    //       });
    // });
    


var url = document.URL;
var hash = url.substring(url.indexOf('#'));

$(".tabs_list_a").find("li a").each(function(key, val) {
    if (hash == $(val).attr('href')) {
        $(val).click();
    }
    
    $(val).click(function(ky, vl) {
        location.hash = $(this).attr('href');
    });
});


$(document).ready(function() {
  $(window).scroll(function() {
    if ($(document).scrollTop() > 50) {
      $("header").addClass("sticky_header_a");
    } else {
      $("header").removeClass("sticky_header_a");
    }
  });
});

</script>