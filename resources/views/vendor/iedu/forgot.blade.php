<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/responsive.css">
  <title>Landing Page</title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.1/css/font-awesome.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.2/assets/owl.carousel.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.2/assets/owl.theme.default.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.2/assets/owl.theme.green.min.css" />
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
<!-- Header section -->
<section class="login-section">
  <div class="container-fluid px-0">
    <div class="row no-gutters">
      <div class="col-md-6">
        <div class="logo-side">
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="images/ic_1.png" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="images/ic_1.png" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="images/ic_1.png" class="d-block w-100" alt="...">
              </div>
            </div>
          </div>
          <div class="vertical-center text-center full-width"><a href=""><img class="img-fluid logo" src="images/ic_2.png"></a></div>
        </div>
      </div>
      <div class="offset-md-1 col-md-5">
        <div class="form-side">
          <div class="top-bar pt-4">
            <p><a href="">Back to login</a></p>
          </div>
        <div class="vertical-center full-width">
          <h4 class="mb-2">Forgot Password?</h4>
          <p class="mb-5 forgot-text">Enter the email address used to create your account. We’ll send you a link to reset your password.</p>
          <form class="">
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label>Email address</label>
                  <input class="form-control" type="" name="">
                </div>
              </div>
            </div>
            <div class="form-group">
              <button class="btn"><span>Send reset link</span></button>
            </div>
          </form>
        </div>
        <div class="bottom-block">
          <div class="row">
            <div class="col-md-7 pr-0">
              <small>©Copyright 2020 by Consumables and Stores. All Rights Reserved.</small>
            </div>
            <div class="col-md-5 text-right">
              <a href="">Privacy Policy<span class="ml-2 mr-2">•</span></a><a href="">   Terms & Conditions</a>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</section>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.2/owl.carousel.min.js"></script>
  <script type="text/javascript">
      $(window).scroll(function() {
        if ($(document).scrollTop() > 50) {
          $("nav").addClass("shrink");
        } else {
          $("nav").removeClass("shrink");
        }
      });

      $(function () {
        $(window).on("scroll", function () {
          if ($(window).scrollTop() > 100) {
            $("header").addClass("bg-black");
          } else {
            $("header").removeClass("bg-black");
          }
        });
      });
    </script>
    <script type="text/javascript">
      jQuery("#testimonial").owlCarousel({
      loop: true,
      margin: 40,
      responsiveClass: true,
      // autoHeight: true,
      autoplayTimeout: 7000,
      smartSpeed: 800,
      nav: true,
      items:3,
      responsiveClass:true,
      responsive: {
        0: {
          items: 1,
          nav:true
        },

        600: {
          items: 2,
          nav:true
        },

        1024: {
          items: 3,
          nav:true
        },

        1366: {
          items: 3,
          nav:true
        }
      }
    });
  </script>
  </body>
</html>