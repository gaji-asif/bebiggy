<section>
  <div class="row image_slider">
    <div class="container">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">

            <div class="page-banner">
              <div>
                <div class="aboutpara_text">

                  <P>Contact Us</P>
                </div>
                <div class="blogslider_title">
                  <h2>Looking For An Ecommerce <br>Business For Sale?</h2>
                </div>

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
          <form method="post" name="contactform" id="contactform" autocomplete="on">
            <div class="form-group">
              <input type="text" class="form-control" id="contact_name" placeholder="Your name" name="contact_name" required="required" />
            </div>
            <div class="form-group">
              <input type="email" class="form-control" id="contact_email" placeholder="Your email" name="contact_email" pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$" required="required" />
            </div>
            <div class="form-group">
              <textarea class="form-control" rows="5" id="contact_msg" name="contact_msg" placeholder="Your message" spellcheck="true" required="required"></textarea>
            </div>
            <button type="submit" class="btn btn-primary theme_btns">Send</button>
            
 

            <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
          </form>
        </div>
        <!-- <div id="notification"></div> -->
        <div id="notification">
             <span id="loader" style="display:none;"> <img src="<?php echo base_url(); ?>assets/img/loadingimage.gif" style="width: 7%;"/> </span>
           </div>
      </div>
    </div>
  </div>
</section>