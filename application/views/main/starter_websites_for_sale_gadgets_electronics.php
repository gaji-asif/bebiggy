<section class="slider_section pb-0 business_slider_div">
    <div class="container">
        <div class="row image_slider">
            <div class="col-12 ">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="page-banner">
                                <div>
                                    <div class="aboutpara_text">

                                        <p class="about_desktop_view websites_desktop_view_a online_sell_text_a"> Online Gadgets & Electronics Business For Sale <br/>Want To Sell Gadgets & Electronics Online?</p>
                                    </div>
                                    <div class="aboutpara_text website_for_salemobiletext_a">

                                        <p class="about_mobile_view sell_mobile_top_text_a"> Online Gadgets & Electronics Business For Sale Want To Sell Gadgets & Electronics Online?</p>
                                    </div>
                                    <div class="blogslider_title about_page_title_a">

                                        <h2 class="about_desktop_title_a sell_text_desktop_a"><?php echo $this->lang->line('uppercase_site_name'); ?> Offers Turnkey Gadgets <br> & Electronics Dropship Website</h2>
                                    </div>
                                    <div class="about_page_title_a website_for_salemobileheading_a">
                                        <h2 class="gadget_slider_mobile_text_a about_mobile_title sell_text_mobile_a"><?php echo $this->lang->line('uppercase_site_name'); ?> Offers Turnkey Gadgets & Electronics Dropship Website</h2>
                                    </div>
                                    <div class="website_start_now_a sell_now_btn_a">
                                        <a href="<?php echo site_url('product-category/gadgets-electronics') ?>"><span>Sell Now</span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>







                            <!-- <div class="page-banner">
                                <div>
                                    <div class="aboutpara_text ">
                                        <p>Online Gadgets & Electronics Business For Sale <br/>Want To Sell Gadgets & Electronics Online?</p>
                                    </div>
                                    <div class="blogslider_title">
                                        <h2><?php //echo $this->lang->line('uppercase_site_name'); ?> Offers Turnkey Gadgets <br> & Electronics Dropship Website</h2>
                                    </div>
                                    <div class="website_start_now_a">
                                        <a href="<?php //echo site_url('product-category/gadgets-electronics') ?>"><span>Sell Now</span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div> -->
                            <img class="d-block w-100" src="<?php echo site_url('assets/img/website-for-sale.png'); ?>" alt="First slide">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container-fluid about_para_a">
        
    
        <div class="container">
            <div class="row w-100 d-block">
                <div class="about_paratext_a">
            <div class="title_ecommerce">
                <h2>About This Niche </h2>
            </div>
            <div class="row">
                
            
            <div class="col-md-6 px-2">
                <p>According to the research conducted by Future Market Insights, the global consumer electronics market will be worth US$ 2976.1 Billion by 2020. It is anticipated that the global consumer electronics market will witness an annual growth rate of over 15% during the forecast period 2015 and 2020.</p>
                <p>
                   The demand for latest gadgets and wearable devices, especially in the emerging markets, is anticipated to boost the consumer electronics market during the forecast period 2015 – 2020.
                </p>
               
            </div>
            <div class="col-md-6 px-2">
                <p>
                    Among the various segments of the global consumer electronics market, the demand for consumer electronics devices and smart home devices is anticipated to be robust through 2020.
                </p>
                <p>The demand for consumer electronics and gadgets is quite strong in the emerging nations, and this trend is anticipated to continue in the near future as well. This presents a crucial opportunity to online retailers to tap into this market.</p>
               
            </div>
            </div>
            <div class="row text-center">
                <div class="col-md-12">
                    
                 <a href="<?php echo site_url('about-us') ?>" class="btn btn-default start_yourown_nowbtn my-4"><span>Read More</span> <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</section>
<section class="reasons_div_a">
   
        <div class="container">
             <div class="row w-100 d-block">
            <div class="reasons_title_a">
                <h2>Reasons To Enter This Niche Market</h2>
            </div>
            <div class="row">
                <div class="col-md-6 pr-2">
                    <ul>
                        <li>$1,200 amount an average US citizen spends annually on consumer electronics.</li>
                       
                       <li>28% share of holiday gift-giving budgets likely to be spent on consumer electronics.</li>
                    </ul>
                </div>
                <div class="col-md-6 pr-2">
                    <ul>
                         <li>72% of US Internet surfers use their computers to listen to music and podcasts.</li>
                        <li>29% of online shoppers have purchased computers or electronics at category-specific online stores and 17% at webstores.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="gadgets_last_section_a">
      <?php /*<input type="hidden" name="listing_type" id="listing_type" value="<?php echo $searchtype; ?>">*/ ?>
    <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
    <div id="solution">
        
    <?php $this->load->view('main/includes/common-lisiting-solution_starter', ['commonData' => $commonData]); ?>
    
        </div>
    </div>
</section>
<section>
    <div class="row fashion_lastdiv_a">
        <div class="container">
            <div class="col-md-12">
                <div class="col-md-8 col-sm-12">
                    <h2>Have a website or domain to sell? Contact us now to get a listing.</h2>
                </div>
                <div class="col-md-4 col-sm-12 check_now_btn webiste_footer_a">
                    <a href="<?php echo site_url('contact-us') ?>" class="btn btn-default check_nowbtn"><span>Get a Listing</span> <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                </div>
            </div>
            
        </div>
    </div>
</section>