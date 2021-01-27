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
       <section class="contact_slider">
    <div class="row image_slider">
        <div class="container p-0">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
        
        <div class="course_slider_text">
        <div class="aboutpara_text">
            <p>Contact Us</p>
            </div>
            
            <div class="contact_title">
            <h2>Looking for an eCommerce <br>Business For Sale? </h2>
            
            </div>
        </div>
      <img class="d-block w-100" src="assets/img/contact_banner.png" alt="First slide">
    </div>
  </div>
</div>

        </div>
    </div>
</section>


<section>
        <div class="container contact_para">
            <div class="row">
            <div class="col-md-6 col-sm-12">
                <p class="first_child">We’re here to help you start your online business and we’ll support you from finding your business niche to selecting and optimizing a turnkey drop shipping website.</p>
            </div>
           
            <div class="col-md-6 col-sm-12">
            	<div class="contacttitle">
            		<h2>Let's Get In Touch</h2>
            	</div>
            	<div class="form_div">
            		<p>Fill out the contact form below and let’s see how we can work for you.</p>
            		<form action="">
				    <div class="form-group">
				      <input type="text" class="form-control" id="name" placeholder="Your name" name="name">
				    </div>
				    <div class="form-group">
				      <input type="email" class="form-control" id="email" placeholder="Your email" name="email">
				    </div>
				    <div class="form-group">
				      <textarea class="form-control" rows="5" id="comment" placeholder="Your message"></textarea>
				    </div>
				    <button type="submit" class="btn btn-primary theme_btns">Send</button>
				  </form>
            	</div>
               
            </div>
        </div>
    </div>
</section>


        <?php  $this->load->view('main/includes/newfooter') ?>
    </body>
</html>