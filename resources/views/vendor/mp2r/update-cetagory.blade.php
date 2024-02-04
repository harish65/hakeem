<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="shortcut icon" href="images/ic_32.png" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="css/intlTelInput.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />

</head>

<body>

    <!-- header -->
    <header>
        <div class="navigation-wrap shadow pt-2 pb-3">
            <div class="container">
                
				<div class="row align-items-center ">
					<div class="col-md-4">
					<a class="navbar-brand pt-2" href="index.html"> <img src="images/ic_logo.png" alt=""></a>
					</div>
			   
					<div class="col-md-6 col-sm-9">
					<div class="input-search mt-2"> 
						<div class="inputDiv">
							<img src="images/ic_search_grey.png" alt="">
							<input type="text" placeholder="Search for a professional" class="w-100">
						</div>
					</div>
					</div>
					<div class="col-md-2 col-sm-3 col-6">
						<div class="row align-items-center pt-2 m-0">
							<a href="#" class="text-dark">Chat</a>
							
							<div class="dropdown ml-auto chat">
							<div class="dropdown-toggle" type="button" data-toggle="dropdown">
							<img src="images/ic_prof-small.png" class="img-fluid">
							 <span><img src="images/ic_dd-header.png" class="img-fluid pl-2"></span>
								<ul class="dropdown-menu">
								  <li><a href="#">1</a></li>
								  <li><a href="#">2</a></li>
								  <li><a href="#">3</a></li>
								</ul>
							</div>
						</div>
						</div>   
					</div>   
				</div>
            </div>
        </div>

    </header>
    <!-- header -->
	
	
	<section class="main-height-clr bg-clr">
		<div class="container">
		<h2 class="heading-top">Account</h2>
			<div class="row">
					<!-- left side  -->
				<div class="col-md-4 col-lg-4 col-sm-4">
					<div class="left-dashboard2 mt-4">
						<div class="side-head p-4">
						<img src="images/ic_prof-medium@2x.png" class="img-fluid mx-auto d-block">
						<hr/>
						</div>
						
						<ul class="left-side-bar mb-3">
						<li><a href="#"> Profile Details</a></li>
						<li><a href="#">  Manage Availability</a></li>
						<li><a href="#">  Change Password</a></li>
						<li  class="active"><a href="#"> Update Category</a></li>
						</ul>						
					</div>
				</div>
				
			<!-- left side  end -->	
				
				<div class="col-lg-8 col-md-8 col-sm-8">
					
					<section class="wrapper2 form-sec">
					<p class="change-pw">Update Category</p>
					
					<div class="row align-items-center pt-3">
						<div class="col-md-6 col-lg-6 ">
						<div class="form-group ">
						  <label for="pwd"> Category</label>
							 <select class="form-control" id="sel1" name="sellist1">
							<option>Aetna</option>
							<option>Aetna</option>
							<option>Aetna</option>
							<option>Aetna</option>
						  </select>	
						</div>
						</div>					
					</div>
					
					
					
					
					
					<div class="row m-0 ">
					<button type="button" class="btn-next mt-3">Update</button></div>
					</div>
					</section>
				
				</div>
			</div>
		</div>
	
	</section>
	
	
    <footer>
        <div class="footer-btm bg-clr">
            <div class="container">
			<ul class="nav justify-content-center bottom-nav pb-2">
			<li><a href="#"> About Us  </a></li>·
			<li><a href="#"> Blogs  </a></li>·
			<li><a href="#"> Terms & Conditions   </a></li>·
			<li><a href="#"> Privacy policy  </a></li>·
			<li><a href="#"> Contact Us</a></li>
			</ul>
            <h5>© 2020 My Path 2 Recovery · All rights reserved</h5>
            </div>
        </div>
    </footer>
	
	
    <!-- footer -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/intlTelInput.js"></script>

    <script>
        $('.carousel').carousel({
            pause: "false"
        });
    </script>

    <script>
        var input = document.querySelector("#phone");
        window.intlTelInput(input, {
            utilsScript: "js/utils.js",
        });
		
    </script>

    
	<script>
	$(".toggle-password").click(function() {
		  $(this).toggleClass("fa-eye fa-eye-slash");
		  var input = $($(this).attr("toggle"));
		  if (input.attr("type") == "password") {
			input.attr("type", "text");
		  } else {
			input.attr("type", "password");
		  }
		});</script>
	
	</script>
<script type="text/javascript">
$(window).on("load resize",(function(){var o=$(".navigation-wrap");$("body").css("padding-top",o.outerHeight())}))
</script>
</body>

</html>