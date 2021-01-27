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
                                        <p>Online Toy Store For Sale <br/>Want To Start Your Online Toy Store?</p>
                                    </div>
                                    <div class="blogslider_title">
                                        <h2><?php echo $this->lang->line('uppercase_site_name'); ?> Offers Turnkey <br/>Toy Websites</h2>
                                    </div>
                                    <div class="website_start_now_a">
                                        <a href="<?php echo site_url('product-category/toys') ?>"><span>Start Now</span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
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
                <p>According to the Toy Industry Association, the US toy market is worth $22 billion a year with a worldwide revenue of $84.1 billion overall market. When looking at the global market, US market share is 41%, Europe 29%, Asia/Oceania 30% and Africa 1%.</p>
                
               
            </div>
            <div class="col-md-6 px-2">
                <p>
                   Industry operators have benefited from increased e-commerce activity along with rising consumer spending. As online shopping has become more secure and easily accessible to consumers, e-commerce sales have increased. Although general retailers like Walmart, Target and Costco account for the majority of toy sales on a brick-and-mortar level, these retailers account for only a small portion of industry-specific online sales.
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
                        <li>Industry operators have benefited from increased e-commerce activity and rising consumer spending.</li>
                        <li>Games and puzzle sales grew at a faster rate than outdoor and sports toys.</li>
                       
                    </ul>
                </div>
                <div class="col-md-6 pr-2">
                    <ul>
                        <li>E-commerce sales will account for a larger share of the industry as shipping becomes more efficient.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="toys_last_section">
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