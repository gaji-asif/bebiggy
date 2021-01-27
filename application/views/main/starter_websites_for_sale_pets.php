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
                                        <p>Online Pet Stores For Sale <br /> Want To Start Your Online Pet Store? </p>
                                    </div>
                                    <div class="blogslider_title">
                                        <h2><?php echo $this->lang->line('uppercase_site_name'); ?> Offers Turnkey <br> Dropship Pet Stores</h2>
                                    </div>
                                     <div class="website_start_now_a">
                                        <a href="<?php echo site_url('product-category/pets') ?>"><span>Start Now</span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
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
                <p>Over the five years to 2022, the Pet Stores industry is projected to maintain strong growth. Expenditures on pets in the US are rising annually and are projected to reach almost $100 billion by the end of the decade.</p>
                <p>
                   Online shopping has shown the most growth of any sector in pet industry in the past five years; 8.2% of pet owners bought pet products online in 2015, and the amount is expected to increase to 20% in the next few years.
                </p>
               
            </div>
            <div class="col-md-6 px-2">
                <p>
                   With pet ownership growing, the market for pet products of all kinds has expanded with it. US citizens are spending on pets reached an estimated $62.75 billion in 2016, and it is estimated that spending on pets averaged more than $500 per household in 2015. With an industry growing at 4.6% a year, it is projected that total sales will be nearly $100 billion by 2020.
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
                        <li>The emerging trend of pet parents has bolstered demand for premium pet products and services.</li>
                        <li>A vast product selection, convenience and competitive prices in online pet stores lured customers away from specialty stores.</li>
                       
                    </ul>
                </div>
                <div class="col-md-6 pr-2">
                    <ul>
                        <li>A rise in pet ownership will lead to higher demand for discretionary and nondiscretionary products.</li>
                        <li>Potential online customers include busy parents, Millennials and aging pet owners who cannot drive any more or carry heavy bags of pet food.</li>
                       
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="pets_last_section">
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