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
                                        <p>Online Health Products Business For Sale <br/>Want To Start Your Online Health Products Business?</p>
                                    </div>
                                    <div class="blogslider_title">
                                        <h2><?php echo $this->lang->line('uppercase_site_name'); ?> Offers Turnkey <br/>Health Products Websites</h2>
                                    </div>
                                    <div class="website_start_now_a">
                                        <a href="<?php echo site_url('product-category/health') ?>"><span>Start Now</span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
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
                <p>The needs of the aging population, trends toward increased healthy living and improving per capita disposable income are all contributing to the industry’s growth. In particular, changing attitudes toward personal healthcare are driving demand for natural and anti-aging products.</p>
            </div>
            <div class="col-md-6 px-2">
                <p>
                  About 36 million US consumers shopped online for health and beauty products in the spring of 2014, up from 20 million consumers in spring 2010.
                </p>
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
                        <li>Online health and personal care sales volume is expected to grow at a much faster rate than traditional drug stores sales, with annual growth rate of 13% between 2015 and 2020.</li>
                    </ul>
                </div>
                <div class="col-md-6 pr-2">
                    <ul>
                         <li>Subscription shopping models can help mitigate retailers’ costs and provide an added layer of convenience to customers, and these services are helping the health and personal care category grow. 38% of US consumers who regularly purchase health and beauty products online say they’re signed up for a subscription service.</li>
                       
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="health_last_section">
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