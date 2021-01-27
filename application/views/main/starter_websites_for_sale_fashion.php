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
                                        <p></p>
                                        <P>Online Fashion Business For Sale <br /> Want To Sell Clothing Online?</P>
                                    </div>
                                    <div class="blogslider_title">
                                        <h2><?php echo $this->lang->line('uppercase_site_name'); ?> Offers Turnkey <br> Fashion Dropship Websites</h2>
                                    </div>
                                     <div class="website_start_now_a">
                                        <a href="<?php echo site_url('product-category/fashion') ?>"><span>Sell Now</span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
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
                <p>The size of the fashion industry has been steadily growing for many years. Making up 2% of all global GDP, clothing generates over three trillion dollars every year. Approximately 80% of the industry is concentrated in the women’s wear, men’s wear, and luxury goods segments.</p>
                <p>
                    Online fashion sales continue to capture a great share of US retail eCommerce sales. Best performing online category – fashion and accessories – is registering high annual growth rate of 17.2%, according to eMarketer.
                </p>
               
            </div>
            <div class="col-md-6 px-2">
                <p>
                    According to the eCommerce Benchmark Research, conducted by eCommerce Foundation, with over 70 fashion companies who participated in the study, fashion retailers are either Generalist (18%), or operate in specific segments, such as Women (34%), Men (13%), Shoes (4%), Body (12%) and Jeans (3%).
                </p>
                <p>For online fashion retailers, the majority of traffic comes from search engines (53%), email marketing (10%) and social and viral media (8%).</p>
               
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
                        <li>49% of people between the ages of 25 and 34 prefer shopping online, according to a recent survey conducted by Retail Week and Microsoft.</li>
                        <li>Online fashion and accessories sales in the U.S. could grow 20% over the next four years, compared to just 10% six years ago.</li>
                       
                    </ul>
                </div>
                <div class="col-md-6 pr-2">
                    <ul>
                        <li>Fashion eCommerce market is expected to reach $54.2B this year (Source – Internet Retailer) in the US alone and is quickly becoming the top eCommerce market second only to consumer electronics.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="startar_last_section_a">
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
                <div class="col-md-4 col-sm-12 check_now_btn">
                    <a href="<?php echo site_url('contact-us') ?>" class="btn btn-default check_nowbtn"><span>Get a Listing</span> <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                </div>
            </div>
            
        </div>
    </div>
</section>