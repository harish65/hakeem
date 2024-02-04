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
		<h2 class="heading-top">Edit Profile</h2>
			<div class="row">
					<!-- left side  -->
				<div class="col-md-4 col-lg-4 col-sm-12">
					<div class="left-dashboard3 mt-4">
						<div class="side-head p-4">
						<div class="img-pos">
						<img src="images/ic_prof-medium@2x.png" class="img-fluid mx-auto d-block ">
						<!-- <img src="images/ic_changeimage.png" class=" plus"> -->
						</div>
						</div>
						
												
					</div>
				</div>
				
			<!-- left side  end -->	
				
				<div class="col-lg-8 col-md-8 col-sm-12">
					
					
					<section class="wrapper2">
					<!-- form start -->
				<section class="form-sec p-0">
				<form action="/action_page.php">
				<div class="row pb-2">
					<div class="col-md-6">
						<div class="form-group">
						   <label for="pwd">Name</label>
						  <input type="text" class="form-control" id="name" placeholder="John Doe" name="name">
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="form-group">
						   <label for="pwd">Username / Email</label>
						  <input type="text" class="form-control" id="johndoe@gmail.com" placeholder="johndoe@gmail.com" name="name">
						</div>
					</div>
				</div>
				
				<div class="row pb-2">
					<div class="col-md-6">
						<div class="form-group">
						   <label for="pwd">Phone number</label>
						   
						   <div class="input-outer d-flex align-items-center p-2">
							   <div class="flag row m-0">
								<img src="images/ic_flag@1x.png" class="img-fluid pr-2">
								 <div class="dropdown">
									<span type="button" data-toggle="dropdown">+91 <span><img src="images/ic_dd-header.png" class="img-fluid pl-2"></span>
									<!-- <i class="fa fa-chevron-down text-dark"></i></span> -->
									<ul class="dropdown-menu">
									  <li><a href="#">+91</a></li>
									  <li><a href="#">+92</a></li>
									  <li><a href="#">+93</a></li>
									</ul>
								  </div>
							   </div>
							   <input type="text" class="border-0 pl-2" id="name" placeholder="9984929384" name="name">
						   </div>
						   
						  <!-- <img src="images/ic_flag@2x.png"><input type="text" class="form-control" id="name" placeholder="Yuvraj" name="name"> -->
						</div>
						
					</div>
					
					<div class="col-md-6">
						<div class="form-group">
						<label for="email">Address</label>
						 <input type="text" class="form-control" id="email" placeholder="204, Eloisa Village Apt. 827" name="tex">
						</div>
					</div>
				</div>
				
				<div class="row pb-2">
					<div class="col-md-6">
						<div class="form-group">
						   <label for="state">City</label>					   
						    <select class="form-control" id="sel1" name="sellist1">
								<option>Los Angeles</option>
								<option>Los Angeles</option>
								<option>Los Angeles</option>
								<option>Los Angeles</option>
							  </select>					
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="form-group">
						   <label for="state">State</label>					   
						    <select class="form-control" id="sel1" name="sellist1">
								<option>California</option>
								<option>California</option>
								<option>California</option>
								<option>California</option>
							  </select>					
						</div>
					</div>
				</div>
				<div class="row pb-2">
					<div class="col-md-6">
						<div class="form-group">
						   <label for="pwd">Zip Code</label>
						  <input type="number" class="form-control" id="name" placeholder="90010" name="name">
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="form-group">
						   <label for="pwd">Education</label>
						  <input type="text" class="form-control" id="johndoe@gmail.com" placeholder="M.D. MBBS" name="name">
						</div>
					</div>
				</div>
				

				
					
					
					<div class="row align-items-center pt-3">
						<div class="col-md-12 col-lg-12">
						<div class="form-group">
						  <label for="comment">Comment:</label>
						  <textarea class="form-control height-100" rows="5" id="comment" placeholder="If you’re looking for feedback on a doctor but don’t have anyone to ask, online reviews will tell you everything you needed to know."></textarea>
						</div>
						</div>
						
					</div>
					<div class="row pb-2">
					<div class="col-md-6">
						<div class="form-group">
						   <label for="state">Your Accepted Insurance</label>					   
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
					<button type="button" class="btn-next">Save</button></div>
					</div>
					
					</form>
				</section>	
					
					
					
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