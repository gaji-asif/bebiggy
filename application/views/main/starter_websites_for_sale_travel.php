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
                                        <p><?php echo $this->lang->line('uppercase_site_name'); ?> Offers Profitable Turnkey Shopify Dropship Websites <br />& Drop Shipping Businesses For Sale</p>
                                    </div>
                                    <div class="blogslider_title">
                                        
                                        <h2>Buy Best Shopify Stores <br />For Sale</h2>
                                    </div>
                                     <div class="website_start_now_a">
                                        <a href="<?php echo site_url('product-category/travel') ?>"><span>Start Now</span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
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
                <p>The travel industry is expected to record significant growth until 2019, driven by a steady rise in tourist flows. The online travel category is currently experiencing rapid change with expansion of mobile bookings, personalization and peer-to-peer travel services being the main disruptors.</p>
                <p>The rise of the mobile bookings is changing booking patterns, consumer behavior and business models in travel. Global mobile travel sales accounted for $96 billion in 2014, and are expected to reach $260 billion in 2019, which is 25% of total online travel bookings.</p>
                
               
            </div>
            <div class="col-md-6 px-2">
                <p>
                   Online travel services are a $250 billion business in the U.S. with over 75% of travel bookings being made exclusively online. Google predicts that the further rise in mobile devices will have a major impact on online travel services, which could have a major impact on the decline of the in-person travel industry.
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
                        <li>The industry has benefited from an increase in travel to emerging economies.</li>
                        <li>Technology has revolutionized the industry over the past decade in the favor of online travel agencies.</li>
                       
                    </ul>
                </div>
                <div class="col-md-6 pr-2">
                    <ul>
                        <li>The industry will benefit from the improving economy and increased consumer spending.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="trvel_last_section">
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