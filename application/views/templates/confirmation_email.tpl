<html xmlns="http://www.w3.org/1999/xhtml"><head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ title }}</title>
  <!-- Designed by https://github.com/kaytcat -->
  <!-- Robot header image designed by Freepik.com -->

  <style type="text/css">
  @import url(http://fonts.googleapis.com/css?family=Droid+Sans);

  /* Take care of image borders and formatting */

  img {
    max-width: 600px;
    outline: none;
    text-decoration: none;
    -ms-interpolation-mode: bicubic;
  }

  a {
    text-decoration: none;
    border: 0;
    outline: none;
    color: #bbbbbb;
  }

  a img {
    border: none;
  }

  /* General styling */

  td, h1, h2, h3  {
    font-family: Helvetica, Arial, sans-serif;
    font-weight: 400;
  }

  td {
    text-align: center;
  }

  body {
    -webkit-font-smoothing:antialiased;
    -webkit-text-size-adjust:none;
    width: 100%;
    height: 100%;
    color: #37302d;
    background: #ffffff;
    font-size: 16px;
  }

   table {
    border-collapse: collapse !important;
  }

  .headline {
    color: #ffffff;
    font-size: 36px;
  }

 .force-full-width {
  width: 100% !important;
 }
  </style>

  <style type="text/css" media="screen">
      @media screen {
         /*Thanks Outlook 2013! http://goo.gl/XLxpyl*/
        td, h1, h2, h3 {
          font-family: 'Droid Sans', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
        }
      }
  </style>

  <style type="text/css" media="only screen and (max-width: 480px)">
    /* Mobile styles */
    @media only screen and (max-width: 480px) {

      table[class="w320"] {
        width: 320px !important;
      }
    }
  </style>
</head>
<body class="body" style="padding:0;margin:0;display:block;background: #de1515;-webkit-text-size-adjust:none;" bgcolor="#ffffff">
<table align="center" cellpadding="0" cellspacing="0" width="100%" height="100%">
  <tbody><tr>
    <td align="center" valign="top" bgcolor="#ffffff" width="100%">
      <center>
        <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="600" class="w320">
          <tbody><tr>
            <td align="center" valign="top">

                <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="100%">
                  <tbody><tr>
                    <td style="font-size: 30px; text-align:center;">
                      <br>
                        {{ sitename }}
                      <br>
                      <br>
                    </td>
                  </tr>
                </tbody></table>

                <table style="margin: 0 auto;background-color: #e8e8e8;border-bottom: 1px solid black;" cellpadding="0" cellspacing="0" width="100%" bgcolor="white">
                  <tbody><tr>
                    <td>
                
                    </td>
                  </tr>
                  <tr>
                    <td class="headline" style="color:#000000">
                      Welcome!
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <center>
                        <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="60%">
                          <tbody><tr>
                            <td>
                            <br>
                             on board, Your one step behind the To the awesomest place on earth! We're sure you will feel right at home with {{ sitename }}.Please click on the below link to confirm and activate your account. 
                            <br>
                            <br>
                            </td>
                          </tr>
                        </tbody></table>
                      </center>

                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div>
                      <!--[if mso]>
                        <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://" style="height:50px;v-text-anchor:middle;width:200px;" arcsize="8%" stroke="f" fillcolor="#178f8f">
                          <w:anchorlock/>
                          <center>
                        <![endif]-->
                            <a href="{{ activation_link }}" target="_blank" style="background: #f2b42f;
    color: #0f1131!important;;border-radius:4px;display:inline-block;font-family:Helvetica, Arial, sans-serif;font-size:16px;font-weight:bold;line-height:50px;text-align:center;text-decoration:none;width:200px;-webkit-text-size-adjust:none;">Activate Account!</a>
                        <!--[if mso]>
                          </center>
                        </v:roundrect>
                      <![endif]-->
                        </div>
                      <br>
                      <br>
                    </td>
                  </tr>
                </tbody></table>
                <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" class="force-full-width" bgcolor="background: #0b1131;">
                  <tbody><tr>
                    <td style="background: #0b1131;">
                    <br>
                    <br>
                      <a href="{{ gihub }}"><img src="https://www.filepicker.io/api/file/R4VBTe2UQeGdAlM7KDc4" alt="github"></a>
                      <a href="{{ facebook }}"><img src="https://www.filepicker.io/api/file/cvmSPOdlRaWQZnKFnBGt" alt="facebook"></a>
                      <a href="{{ twitter }}"><img src="https://www.filepicker.io/api/file/Gvu32apSQDqLMb40pvYe" alt="twitter"></a>
                      <br>
                      <br>
                    </td>
                  </tr>
                  <tr>
                    <td style="background: #0b1131; color:#fff; font-size:12px;">
                      <a href="<?php echo base_url().'contactus'; ?>">Contact us</a>
                      <br><br>
                    </td>
                  </tr>
                  <tr>
                    <td style="background: #0b1131;color:#ffffff; font-size:12px;">
                       © <?php echo date('Y');?>{{ sitename }} All Rights Reserved
                       <br>
                       <br>
                    </td>
                  </tr>
                </tbody></table>
            </td>
          </tr>
        </tbody></table>
    </center>
    </td>
  </tr>
</tbody></table>

</body></html>