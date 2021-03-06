﻿<?php
$msg = "";
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $body = $_POST['message'];
try {
    //Server settings
    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'techpvec1@gmail.com';                  // SMTP username
    $mail->Password   = 'wqzlvttbvlikwuph';                     // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom($email, $name);
    
    $mail->addAddress('sales@channelier.com');               
    // $mail->addReplyTo('info@example.com', 'Information');
     
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Website Contact Form:  '.$name;
    $mail->Body = '<h3 align=center>You have received a new message from your website contact form.</h3><br>Here are the details:<br><br>Name: '.$name.'<br><br>Email: '.$email.'<br><br>Message: '.$body; 
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    $msg = 'Hey '.$name.'! Your message has been successfully sent. We will contact you very soon!';

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    die();
}
}


// Checks if form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  function post_captcha($user_response) {
      $fields_string = '';
      $fields = array(
          'secret' => '6LeGaaQUAAAAAO11R3c5_KpbsrKSzP34Yla4ivOq',
          'response' => $user_response
      );
      foreach($fields as $key=>$value)
      $fields_string .= $key . '=' . $value . '&';
      $fields_string = rtrim($fields_string, '&');

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
      curl_setopt($ch, CURLOPT_POST, count($fields));
      curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

      $result = curl_exec($ch);
      curl_close($ch);

      return json_decode($result, true);
  }

  // Call the function post_captcha
  $res = post_captcha($_POST['g-recaptcha-response']);

  if (!$res['success']) {
      // What happens when the CAPTCHA wasn't checked
      echo '<p>Please go back and make sure you check the security CAPTCHA box.</p><br>';
      die();
  } else {
      // If CAPTCHA is successfully completed...

      // Paste mail function or whatever else you want to happen here!
      //echo '<br><p>CAPTCHA was completed successfully!</p><br>';
  }
} 


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Arachnomesh</title>
<meta name="description" content="">
<meta name="author" content="">

<!-- Favicons
    ============================================== -->
<link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
<link rel="apple-touch-icon" href="img/favicon.png">
<link rel="apple-touch-icon" sizes="72x72" href="img/favicon.png">
<link rel="apple-touch-icon" sizes="114x114" href="img/favicon.png">

<!-- Bootstrap -->
<link rel="stylesheet" type="text/css"  href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.css">

<!-- Slider
    ================================================== -->
<link href="css/owl.carousel.css" rel="stylesheet" media="screen">
<link href="css/owl.theme.css" rel="stylesheet" media="screen">

<!-- Stylesheet
    ================================================== -->
<link rel="stylesheet" type="text/css"  href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/animate.min.css">
<link href='https://fonts.googleapis.com/css?family=Lato:400,700,900,300' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800,600,300' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="js/modernizr.custom.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
<div id="preloader">
  <div id="status"> <img src="img/preloader.gif" height="64" width="64" alt=""> </div>
</div>
<!-- Navigation
    ==========================================-->
<nav id="menu" class="navbar navbar-default navbar-fixed-top">
  <div class="container"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand" href="index.html"><img src="img/arachnomesh_logo.png" class="img-responsive" alt="Glimray" style="height:78px; top:-30px; position:relative;"></a> </div>
    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li class="nav_link"><a href="#home" class="page-scroll nav_link">Home</a></li>
        <li class="nav_link"><a href="#services-section" class="page-scroll nav_link">Services</a></li>
        <li class="nav_link"><a href="#clients-section" class="page-scroll nav_link">Portfolio</a></li>
        <li class="nav_link"><a href="#about-section" class="page-scroll nav_link">About</a></li>
        <li class="nav_link"><a href="#team-section" class="page-scroll nav_link">Team</a></li>
        <li class="nav_link"><a href="#testimonials-section" class="page-scroll nav_link">Testimonials</a></li>
        <li class="nav_link"><a href="#contact-section" class="page-scroll nav_link">Contact</a></li>
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container --> 
</nav>

<!-- Header -->
<header class="text-center full_section" name="home">
  <div class="intro-text">
    <h1 class="wow fadeInDown">We are <strong><span class="color">Arachnomesh</span></strong></h1>
    <a href="#clients-section" class="btn btn-default btn-lg page-scroll wow fadeInUp" data-wow-delay="200ms">Our Portfolio</a> </div>
</header>

<!-- Services Section -->
<section id="services-section" class="text-center full_section">
  <div class="container-fluid">
    <div class="section-title wow fadeInDown">
      <h2>Our <strong>Services</strong></h2>
      <hr>
      <div class="clearfix"></div>
    </div>
    <div class="space"></div>
    <div class="row">
      <div class="col-md-3 col-sm-6 service wow fadeInUp" data-wow-delay="300ms"> <i class="fa fa-code"></i>
        <h4><strong>Web Development</strong></h4>
        <p>Arachnomesh offers web development services, our development work increases visibility of your corporate identity.</p>
      </div>
      <div class="col-md-3 col-sm-6 service wow fadeInUp" data-wow-delay="400ms"> <i class="fa fa-desktop"></i>
        <h4><strong>Web design</strong></h4>
        <p>Arachnomesh is web designing company in Delhi which offers a wide range of web design & development for the web.</p>
      </div>
      <div class="col-md-3 col-sm-6 service wow fadeInUp" data-wow-delay="500ms"> <i class="fa fa-android"></i>
        <h4><strong>App Development</strong></h4>
        <p>Arachnomesh has acquired profound experience in Android application development of various complexity.</p>
      </div>
      <div class="col-md-3 col-sm-6 service wow fadeInUp" data-wow-delay="600ms"> <i class="fa fa-shopping-cart"></i>
        <h4><strong>E-Commerce</strong></h4>
        <p>Arachnomesh offers all kind of ecommerce web development with credit card processing and netbanking.</p>
      </div>
    </div>
  </div>
</section>


<!-- Portfolio Section -->
<section id="clients-section" class="text-center full_section">
  <div class="container-fluid"> <!-- Container -->
    <div class="section-title wow fadeInDown hel">
      <h2>Our <strong>Portfolio</strong></h2>
      <hr>
      <div class="clearfix"></div>
    </div>
    <div class="categories hide">
      <ul class="cat">
        <li>
          <ol class="type">
            <li><a href="#" data-filter="*" class="active">All</a></li>
            <li><a href="#" data-filter=".app">App Development</a></li>
            <li><a href="#" data-filter=".web">Web Development</a></li>
            <li><a href="#" data-filter=".ecommerce">E-Commerce</a></li>
          </ol>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="row">
      <div class="portfolio-items">
        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-2 web app">
          <div class="portfolio-item " >
            <div class="hover-bg">
              <div class="hover-text hide">
                <h4>Glimray</h4>
                App Development
                <div class="clearfix"></div>
                <i class="fa fa-plus"></i> </div>
              <img src="img/portfolio/Glimray.png" class="img-responsive wow grayScale" data-wow-delay="200ms" data-wow-duartion="50ms" alt="Glimray"></div>
          </div>
        </div>
        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-2 web ecommerce app">
          <div class="portfolio-item">
            <div class="hover-bg">
              <div class="hover-text hide">
                <h4>Channelier</h4>
                Web Development & E-Commerce
                <div class="clearfix"></div>
                <i class="fa fa-plus"></i> </div>
              <img src="img/portfolio/Channelier.png" class="img-responsive wow grayScale" data-wow-delay="400ms" data-wow-duartion="50ms" alt="Project Title"></div>
          </div>
        </div>
        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-2 web ecommerce">
          <div class="portfolio-item">
            <div class="hover-bg">
              <div class="hover-text hide hide">
                <h4>Repairmen</h4>
                Web Development & E-Commerce
                <div class="clearfix"></div>
                <i class="fa fa-plus"></i> </div>
              <img src="img/portfolio/Forevernew.png" class="img-responsive wow grayScale" data-wow-delay="600ms" data-wow-duartion="50ms" alt="Project Title"></div>
          </div>
        </div>
        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-2 web ecommerce">
          <div class="portfolio-item">
            <div class="hover-bg">
              <div class="hover-text hide">
                <h4>Sportsphere</h4>
                Web Development & E-Commerce
                <div class="clearfix"></div>
                <i class="fa fa-plus"></i> </div>
              <img src="img/portfolio/Naturals.png" class="img-responsive wow grayScale" data-wow-delay="800ms" data-wow-duartion="50ms" alt="Project Title"></div>
          </div>
        </div>
        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-2 web">
          <div class="portfolio-item">
            <div class="hover-bg">
              <div class="hover-text hide">
                <h4>Little Umbrella</h4>
               Web Development
                <div class="clearfix"></div>
                <i class="fa fa-plus"></i> </div>
              <img src="img/portfolio/Citysocl.png" class="img-responsive wow grayScale" data-wow-delay="1000ms" data-wow-duartion="50ms" alt="Project Title"></div>
          </div>
        </div>
        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-2 web">
          <div class="portfolio-item">
            <div class="hover-bg">
              <div class="hover-text hide">
                <h4>Ashok Motor</h4>
                Web Development
                <div class="clearfix"></div>
                <i class="fa fa-plus"></i> </div>
              <img src="img/portfolio/Leads.png" class="img-responsive wow grayScale" data-wow-delay="1200ms" data-wow-duartion="50ms" alt="Project Title"></div>
          </div>
        </div>
        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-2 web">
          <div class="portfolio-item">
            <div class="hover-bg">
              <div class="hover-text hide">
                <h4>Forver New</h4>
                Web Development
                <div class="clearfix"></div>
                <i class="fa fa-plus"></i> </div>
              <img src="img/portfolio/Tripsocl.png" class="img-responsive wow grayScale" data-wow-delay="1400ms" data-wow-duartion="50ms" alt="Project Title"></div>
          </div>
        </div>
        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-2 web">
          <div class="portfolio-item">
            <div class="hover-bg">
              <div class="hover-text hide">
                <h4>Naturals</h4>
                Web Development
                <div class="clearfix"></div>
                <i class="fa fa-plus"></i> </div>
              <img src="img/portfolio/Feedback.png" class="img-responsive wow grayScale" data-wow-delay="1600ms" data-wow-duartion="50ms" alt="Project Title"></div>
          </div>
        </div>  
        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-2 web">
          <div class="portfolio-item">
            <div class="hover-bg">
              <div class="hover-text hide">
                <h4>Naturals</h4>
                Web Development
                <div class="clearfix"></div>
                <i class="fa fa-plus"></i> </div>
              <img src="img/portfolio/Akkicups.png" class="img-responsive wow grayScale" data-wow-delay="1800ms" data-wow-duartion="50ms" alt="Project Title"></div>
          </div>
        </div>  
        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-2 web">
          <div class="portfolio-item">
            <div class="hover-bg">
              <div class="hover-text hide">
                <h4>Naturals</h4>
                Web Development
                <div class="clearfix"></div>
                <i class="fa fa-plus"></i> </div>
              <img src="img/portfolio/Decor.png" class="img-responsive wow grayScale" data-wow-delay="2000ms" data-wow-duartion="50ms" alt="Project Title">
            </div>
          </div>
        </div>  
        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-2 web">
          <div class="portfolio-item">
            <div class="hover-bg"> <a href="#portfolioModal8" class="portfolio-link" data-toggle="modal">
              <div class="hover-text hide">
                <h4>Naturals</h4>
                Web Development
                <div class="clearfix"></div>
                <i class="fa fa-plus"></i> </div>
              <img src="img/portfolio/Parvatiya.png" class="img-responsive wow grayScale" data-wow-delay="2200ms" data-wow-duartion="50ms" alt="Project Title"> </a> </div>
          </div>
        </div>  
        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-2 web">
          <div class="portfolio-item">
            <div class="hover-bg">
              <div class="hover-text hide">
                <h4>Naturals</h4>
                Web Development
                <div class="clearfix"></div>
                <i class="fa fa-plus"></i> </div>
              <img src="img/portfolio/Survey.png" class="img-responsive wow grayScale" data-wow-delay="2400ms" data-wow-duartion="50ms" alt="Project Title"></div>
          </div>
        </div> 
        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-2 web">
          <div class="portfolio-item">
            <div class="hover-bg">
              <div class="hover-text hide">
                <h4>Naturals</h4>
                Web Development
                <div class="clearfix"></div>
                <i class="fa fa-plus"></i> </div>
              <img src="img/portfolio/Little.png" class="img-responsive wow grayScale" data-wow-delay="2600ms" data-wow-duartion="50ms" alt="Project Title">
            </div>
          </div>
        </div>  
        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-2 web">
          <div class="portfolio-item">
            <div class="hover-bg">
              <div class="hover-text hide">
                <h4>Naturals</h4>
                Web Development
                <div class="clearfix"></div>
                <i class="fa fa-plus"></i> </div>
              <img src="img/portfolio/Repairmen.png" class="img-responsive wow grayScale" data-wow-delay="2800ms" data-wow-duartion="50ms" alt="Project Title"></div>
          </div>
        </div>  
        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-2 web">
          <div class="portfolio-item">
            <div class="hover-bg">
              <div class="hover-text hide">
                <h4>Naturals</h4>
                Web Development
                <div class="clearfix"></div>
                <i class="fa fa-plus"></i> </div>
              <img src="img/portfolio/Gopalnamkeen.png" class="img-responsive wow grayScale" data-wow-delay="3000ms" data-wow-duartion="50ms" alt="Project Title"></div>
          </div>
        </div>
        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-2 web">
          <div class="portfolio-item">
            <div class="hover-bg">
              <div class="hover-text hide">
                <h4>Naturals</h4>
                Web Development
                <div class="clearfix"></div>
                <i class="fa fa-plus"></i> </div>
              <img src="img/portfolio/Ashokmotors.png" class="img-responsive wow grayScale" data-wow-delay="3200ms" data-wow-duartion="50ms" alt="Project Title">
            </div>
          </div>
        </div>  
        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-2 web">
          <div class="portfolio-item">
            <div class="hover-bg"> <a href="#portfolioModal8" class="portfolio-link" data-toggle="modal">
              <div class="hover-text hide">
                <h4>Naturals</h4>
                Web Development
                <div class="clearfix"></div>
                <i class="fa fa-plus"></i> </div>
              <img src="img/portfolio/Sportsphere.png" class="img-responsive wow grayScale" data-wow-delay="3400ms" data-wow-duartion="50ms" alt="Project Title"> </a> </div>
          </div>
        </div>  
        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-2 web">
          <div class="portfolio-item">
            <div class="hover-bg">
              <div class="hover-text hide">
                <h4>Naturals</h4>
                Web Development
                <div class="clearfix"></div>
                <i class="fa fa-plus"></i> </div>
              <img src="img/portfolio/Global.png" class="img-responsive wow grayScale" data-wow-delay="3600ms" data-wow-duartion="50ms" alt="Project Title"></div>
          </div>
        </div>
        <div class="col-sm-0 col-md-0 col-lg-2 web"></div>
        <div class="col-sm-0 col-md-0 col-lg-2 web"></div>
        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-2 web">
          <div class="portfolio-item">
            <div class="hover-bg">
              <div class="hover-text hide">
                <h4>Naturals</h4>
                Web Development
                <div class="clearfix"></div>
                <i class="fa fa-plus"></i> </div>
              <img src="img/portfolio/Jaypees.png" class="img-responsive wow grayScale" data-wow-delay="3800ms" data-wow-duartion="50ms" alt="Project Title"></div>
          </div>
        </div>
        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-2 web">
          <div class="portfolio-item">
            <div class="hover-bg">
              <div class="hover-text hide">
                <h4>Naturals</h4>
                Web Development
                <div class="clearfix"></div>
                <i class="fa fa-plus"></i> </div>
              <img src="img/portfolio/Yostra.png" class="img-responsive wow grayScale" data-wow-delay="4000ms" data-wow-duartion="50ms" alt="Project Title"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- About Section -->
<section id="about-section" class="full_section">
  <div class="container-fluid aboutus">
    <div class="section-title text-center wow fadeInDown">
      <h2><strong>About</strong> us</h2>
      <hr>
    <div class="col-xs-12">
      <div class="col-md-6 wow fadeInLeft"> <img src="img/about.png" class="img-responsive"> </div>
      <div class="col-md-6 wow fadeInRight aboutcolor">
          <h4>Who We Are</h4>
          <p>Arachnomesh is one stop solution to all your IT related needs be it website design to online marketing, web solution to software solutions, we offer a wide spectrum of services to fulfill all your business requirements, to facilitate your internet presence. We over years we have built a reputation in providing Software development and web development services. </p>
          <div class="space"></div>
          <h4>What We Do</h4>
          <p>We provide end-to-end Software Consulting Services.</p>
          <div class="space"></div><div class="list-style">
            <div class="row">
              <div class="col-lg-6 col-sm-6 col-xs-12">
                <ul>
                  <li>App Development</li>
                  <li>Web Designing</li>
                  <li>Software Solutions</li>
                </ul>
              </div>
              <div class="col-lg-6 col-sm-6 col-xs-12">
                <ul>
                  <li>Web Development</li>
                  <li>E Commerce</li>
                  <li>Web Hosting</li>
                </ul>
              </div>
            </div>
          </div>     
      </div>
    </div>
  </div>
</div>
</section>
<!-- Team Section -->
<section id="team-section" class="text-center full_section">
  <div class="container">
    <div class="section-title1 wow fadeInDown hel">
      <h2>Meet the <strong>Team</strong></h2>
      <hr>
      <div class="clearfix"></div>      
    </div>
    <div id="row" class="">
      <div class="col-md-6 col-sm-6 col-xs-6 team wow fadeInUp" data-wow-delay="200ms">
        <div class="thumbnail"> <img src="img/team/sid.png" alt="..." class="img-circle team-img">
          <div class="caption">
            <h3>Sidharth Das</h3>
            <p>Co-Founder</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-6 team wow fadeInUp" data-wow-delay="400ms">
        <div class="thumbnail"> <img src="img/team/ankur.png" alt="..." class="img-circle team-img">
          <div class="caption">
            <h3>Ankur Gupta</h3>
            <p>Co-Founder</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row hel1">
        <div class="col-md-3 col-sm-3 col-xs-6 team wow fadeInUp hel" data-wow-delay="600ms">
          <div class="thumbnail"> <img src="img/team/sumit.jpg" alt="..." class="img-circle team-img">
            <div class="caption">
              <h3>Sumit</h3>
              <p>Web Developer</p>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-6 team wow fadeInUp" data-wow-delay="600ms">
          <div class="thumbnail"> <img src="img/team/sandeep.jpg" alt="..." class="img-circle team-img">
            <div class="caption">
              <h3>Sandeep Chorge</h3>
              <p>Android Developer</p>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-6 team wow fadeInUp" data-wow-delay="600ms">
          <div class="thumbnail"> <img src="img/team/mayuri.jpeg" alt="..." class="img-circle team-img">
            <div class="caption">
              <h3>Mayuri Aswale</h3>
              <p>Web Developer</p>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-6 team wow fadeInUp" data-wow-delay="800ms">
          <div class="thumbnail"> <img src="img/team/kshitij.jpg" alt="..." class="img-circle team-img">
            <div class="caption">
              <h3>Kshitij Tiwari</h3>
              <p>Sr. Software Engineer</p>
            </div>
          </div>
        </div>   
      </div>
  </div>
  

  <div class="container-fluid">
    <div class="row">
        <div class="col-md-1 col-sm-1 col-xs-0 team wow fadeInUp" data-wow-delay="600ms"></div>
      <div class="col-md-2 col-sm-2 col-xs-6 team wow fadeInUp" data-wow-delay="600ms">
        <div class="thumbnail"> <img src="img/team/deepankar.jpg" alt="..." class="img-circle team-img">
          <div class="caption">
            <h3>Deepankar Sahu</h3>
            <p>Web Developer</p>
          </div>
        </div>
      </div>
      <div class="col-md-2 col-sm-2 col-xs-6 team wow fadeInUp" data-wow-delay="600ms">
        <div class="thumbnail"> <img src="img/team/shubhangi.jpg" alt="..." class="img-circle team-img">
          <div class="caption">
            <h3>Shubhangi Rai</h3>
            <p>Administrator</p>
          </div>
        </div>
      </div>
      <div class="col-md-2 col-sm-2 col-xs-6 team wow fadeInUp" data-wow-delay="600ms">
        <div class="thumbnail"> <img src="img/team/ajay.jpg" alt="..." class="img-circle team-img">
          <div class="caption">
            <h3>Ajay Pandey</h3>
            <p>Sales & Marketing</p>
          </div>
        </div>
      </div>
      <div class="col-md-2 col-sm-2 col-xs-6 team wow fadeInUp" data-wow-delay="800ms">
        <div class="thumbnail"> <img src="img/team/tanya.jpg" alt="..." class="img-circle team-img">
          <div class="caption">
            <h3>Tanya Keshari</h3>
            <p>Human Resource</p>
          </div>
        </div>
      </div> 
      <div class="col-md-2 col-sm-2 col-xs-12 team wow fadeInUp" data-wow-delay="800ms">
        <div class="thumbnail"> <img src="img/team/paresh.jpg" alt="..." class="img-circle team-img">
          <div class="caption">
            <h3>Paresh</h3>
            <p>Digital Marketing</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Testimonials Section -->
<section id="testimonials-section" class="text-center full_section">
  <div class="container-fluid">
    <div class="section-title wow fadeInDown">
      <h2>What our <strong>Clients</strong> say</h2>
      <hr>
    </div>
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div id="testimonial" class="owl-carousel owl-theme wow fadeInUp" data-wow-delay="200ms">
          <div class="item">
            <p>Brilliant Work!! Support System is great. I can now manage my distribution chain using one platform only.</p>
            <p><strong>Promptec</strong>, CEO, Promptec.</p>
          </div>
          <div class="item">
            <p>Arachnomesh makes handling of entire service providers very easy for us. Managing service provider listings and bookings are a cakewalk now. The customer support is fantastic now.</p>
            <p><strong>Sportsphere</strong></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Contact Section -->
<section id="contact-section" class="text-center full_section">
  <div class="container">
    <div class="wow fadeInDown">
      <h2><strong>Contact</strong> us</h2>
      <hr>
    </div>
    <div class="col-md-8 col-md-offset-2 wow fadeInUp" data-wow-delay="200ms">
      <div class="col-md-4 col-sm-4"> <i class="fa fa-map-marker fa-2x"></i>
        <p>#17, JSSATE-STEP,<br>
          C-20/1, Sector 62, Noida<br>
          Uttar Pradesh<br>
          India - 201 309</p>
      </div>
      <div class="col-md-4 col-sm-4"> <i class="fa fa-map-marker fa-2x"></i>
        <p>403, Vashi Infotech Park,<br>
          Vashi, Navi Mumbai<br>
          Maharashtra<br>
          India - 400 705</p>
      </div>
      <div class="col-md-4 col-sm-4"> <i class="fa fa-envelope-o fa-2x"></i>
        <p><a href = "mailto: contact@channelier.com">contact@channelier.com</a></p>
      </div>
      <div> <i class="fa fa-phone fa-2x"></i>
        <p><a href="tel:919958595034">+91-99585 95034</a></p>
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="col-md-8 col-md-offset-2 wow fadeInUp" data-wow-delay="400ms">
    <h3>Leave us a message</h3>
    

      <form name="sentMessage" method='post' id="contactForm" novalidate>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="name" id="name" class="form-control" placeholder="Name" required="required">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="email" name="email" id="email" class="form-control" placeholder="Email" required="required">
              <p class="help-block text-danger"></p>
            </div>
          </div>
        </div>
        <div class="form-group">
          <textarea name="message" id="message" class="form-control" rows="4" placeholder="Message" required></textarea>
          <p class="help-block text-danger"></p>
        </div>
  
        <div class="g-recaptcha" data-sitekey="6LeGaaQUAAAAABUhM6wSmmYU9qXqvIR8ZqH02VoJ"></div>
        <button type="submit" name="submit" class="btn btn-default">Send Message</button>
      </form>

      <?php echo $msg; ?>
    
      
      <div class="social">
        <ul>
          <li><a href="https://www.facebook.com/Channelexperts/" target="blank"><i class="fa fa-facebook"></i></a></li>
          <li><a href="https://twitter.com/channelier" target="blank"><i class="fa fa-twitter"></i></a></li>
          <li><a href="https://www.youtube.com/watch?v=5tY0m2QwYcg" target="blank"><i class="fa fa-youtube"></i></a></li>
          <li><a href="https://www.linkedin.com/company/channelier" target="blank"><i class="fa fa-linkedin"></i></a></li>
        </ul>
      </div>
    </div>
  </div>
</section>
<section id="footer">
  <div class="container">
      <p>Copyright © Arachnomesh. Design by <a href="http://www.Channelier.com" target="blank" rel="nofollow">Channelier</a></p>
  </div>
</section>

<!-- Portfolio Modals --> 
<!-- Use the modals below to showcase details about your portfolio projects! --> 

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
<script type="text/javascript" src="js/jquery.1.11.1.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script type="text/javascript" src="js/bootstrap.js"></script> 
<script type="text/javascript" src="js/SmoothScroll.js"></script> 
<script type="text/javascript" src="js/wow.min.js"></script> 
<!-- <script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>  -->
<script type="text/javascript" src="js/jquery.isotope.js"></script> 
<script type="text/javascript" src="js/jqBootstrapValidation.js"></script> 
<script type="text/javascript" src="js/contact_me.js"></script> 
<script type="text/javascript" src="js/owl.carousel.js"></script> 
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="js/jquery.scrollify.min.js"></script>
<script>
    $(function() {
        $.scrollify({
            section : ".full_section",
            setHeights: false,
            overflowScroll: false,
            touchScroll:false,
            scrollSpeed: 2000,
        });
    });
</script>
<!-- Javascripts
    ================================================== --> 
<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript">
$(".nav_link").on("click",function(){
    $(".navbar-collapse").removeClass("in");
});  
</script>
</body>
</html>