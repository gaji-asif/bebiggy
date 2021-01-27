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
                                        <p>Online Sports Business For Sale <br />Want To Start Your Online Sports Business?</p>
                                    </div>
                                    <div class="blogslider_title">
                                        <h2><?php echo $this->lang->line('uppercase_site_name'); ?> Offers Turnkey <br/>Sports Websites</h2>
                                    </div>
                                    <div class="website_start_now_a">
                                        <a href="<?php echo site_url('product-category/sports') ?>"><span>Start Now</span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
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
                <p>Over the five years to 2017, the sporting goods online stores and fitness websites industry has fared well due to strong demand from health-conscious individuals. Over the five years to 2022, industry revenue is forecast to continue to grow as growth in sports participation propels demand for athletic apparel, equipment and footwear as well as fitness and nutrition tips and programs.</p>
                
               
            </div>
            <div class="col-md-6 px-2">
                <p>
                   Although time-strapped individuals will find it difficult to incorporate fitness and sporting activities into their daily routine, rising health consciousness and per capita disposable income will spur demand for sporting goods and fitness bloggers.
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
                        <li>The industry has benefited from downstream demand and sports participation growth.</li>
                        <li>Demand for sporting goods from businesses and adolescents will prompt industry revenue growth.</li>
                       
                    </ul>
                </div>
                <div class="col-md-6 pr-2">
                    <ul>
                        <li>Sporting goods retailers have contended with intensifying competition over the past five years.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="sports_last_section">
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