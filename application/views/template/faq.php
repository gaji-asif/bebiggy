<!DOCTYPE html>
<html>
    <head>
        <title>BeBiggy</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--------------------------------------------------------------------------------------------------------------->
        <?php $this->load->view('main/includes/custom_headerscripts'); ?>
        <!--------------------------------------------------------------------------------------------------------------->
    </head>
    <body>
        <?php  $this->load->view('main/includes/custom_header') ?>
       <section class="slider_section">
    <div class="row image_slider">
        <div class="container p-0">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
        
        <div class="course_slider_text">
        <div class="aboutpara_text">
            <p>Drop Shipping Blog</p>
            </div>
            
            <div class="blogslider_title">
            <h2>Tips and Tricks to get your<br> online business started</h2>   
            </div>
         
        </div>
      <img class="d-block w-100" src="assets/img/blogbanner.png" alt="First slide">
    </div>
  </div>
</div>

        </div>
    </div>
</section>


<section class="blog_section">
	 <div class="container desktop_padding">
            <div class="blogpage_title_a">
                <h2>Latest From Our Blog</h2>
            </div>
        </div>
     <div class="container">
   
   
    </div>
</section>





        <?php  $this->load->view('main/includes/newfooter') ?>
    </body>
</html>