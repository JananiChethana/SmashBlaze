<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/boostrap.min.css">
    <link rel="stylesheet" href="./css/owl.carousel.min.css">
    <link rel="stylesheet" href="./css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Google Maps JavaScript API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBck6XZj5sQ-97B3VYiULzMA7az-sZld4Q&libraries=places"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>SmashBlaze</title>
  </head>
  <body data-bs-spy="scroll" data-bs-target=".navbar">

  <style>
      body{
          font-family: Poppins, sans-serif;
      }
  </style>
    <!---- NAVBAR ---->
    <?php  require 'components/nav.php'?>


    <!---SLIDER ---->

    <div class="slider-wrapper owl-carousel owl-themo" id="hero-slider">

      <div class="slide1 min-vh-100 bg-cover d-flex align-items-center">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <h6 class="text-uppercase text-white">Your Ultimate Hub for Courts, Couches, Tournaments, and More!</h6>
              <h1 class="display-3 my-3 text-white text-uppercase">Smash into the World of<br>Badminton!</h1>
              <a href="joincourtown.php" class="btn btn-brand">Join as a Court Owner</a>
              <a href="contactus.php" class="btn btn-outline-light ms-md-3">Contact Us</a>
            </div>
          </div>
        </div>
      </div>
      <div class="slide2 min-vh-100 bg-cover d-flex align-items-center">
        <div class="container">
          <div class="row">
            <div class="col-12 text-center">
              <h6 class="text-uppercase text-white">Your Ultimate Hub for Courts, Couches, Tournaments, and More!</h6>
              <h1 class="display-3 my-3 text-white text-uppercase">Elevate your coaching <br>journey!</h1>
              <a href="joincoach.php" class="btn btn-brand">Join as a Coach</a>
              <a href="contactus.php" class="btn btn-outline-light ms-md-3">Contact Us</a>
            </div>
          </div>
        </div>
      </div>
      
      <div class="slide4 min-vh-100 bg-cover d-flex align-items-center">
        <div class="container">
          <div class="row">
            <div class="col-12 text-center">
              <h6 class="text-uppercase text-white">Your Ultimate Hub for Courts, Couches, Tournaments, and More!</h6>
              <h1 class="display-3 my-3 text-white text-uppercase">Serve success, sponsor badminton<br>brilliance!</h1>
              <a href="addtournament.php" class="btn btn-brand">Post Tournament</a>
              <a href="contactus.php" class="btn btn-outline-light ms-md-3">Contact Us</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    
    <!----SERVISERS-->
    <section id="services">
      <div class="container">
        <div class="row">
          <div class="col-12 intro text-center">
            <h6>OUR SERVICES</h6>
            <h1>What we provide?</h1>
            <p>Discover top-notch badminton services: locate courts, connect with skilled coaches, find quality equipment, and stay updated with news.</p>
          </div>
        </div>
        <div class="row justify-content-center g-4">
          <div class="col-lg-4 col-sm-6">
            <div class="service-box">
              <img src="./img/icon2.jpg" alt="">
              <h5>Badminton  Courts</h5>
              <p>Explore our Badminton Court section to locate top-notch venues for thrilling matches.</p>
            </div>
          </div>
          <div class="col-lg-4 col-sm-6">
            <div class="service-box">
              <img src="./img/icon3.webp" alt="">
              <h5>Badminton  Coaches</h5>
              <p>Discover skilled badminton coaches dedicated to enhancing your game and achieving success.</p>
            </div>
          </div>
          <div class="col-lg-4 col-sm-6">
            <div class="service-box">
              <img src="./img/icon4.webp" alt="">
              <h5>Badminton  Equipments</h5>
              <p>Discover top-notch badminton gear for enhanced performance and winning gameplay. Equip excellence now</p>
            </div>
          </div>
          <div class="col-lg-4 col-sm-6">
            <div class="service-box">
              <img src="./img/icon2.jpg" alt="">
              <h5>Badminton  Tournements</h5>
              <p>Expole thrilling badminton tournaments .Compete, showcase skills, and embrace badminton excellence together.</p>
            </div>
          </div>
          <div class="col-lg-4 col-sm-6">
            <div class="service-box">
              <img src="./img/icon3.webp" alt="">
              <h5>Badminton  News</h5>
              <p>Stay in the game with our Badminton News – latest updates, insights, and highlights.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    
  

  <?php require 'components/footer.php'?>



    <script src="./js/boostrap.bundle.min.js"></script>
    <script src="./js/jquery.min.js"></script>
    <script src="./js/owl.carousel.min.js"></script>
    <script src="./js/app.js"></script>
    
  </body>
</html>