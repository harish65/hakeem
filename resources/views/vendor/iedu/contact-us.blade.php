@extends('vendor.iedu.layouts.index', ['title' => 'Contact Us', 'show_footer'=>true])
@section('content')

<!-- Bannar Section -->
<section class="about-main">
    <img src="{{ asset('assets/iedu/images/contactt-bnr.jpg')}}" alt="">
    <h3>Contact Us</h3>
</section>
<section class="about-inner">
    <div class="container">
        <div class="row outer-shad">
            <div class="col-md-7">
            <iframe src="https://maps.google.com/maps?q=I%20Edu%20FZE-LLC,%20Business%20Center,%20Sharjah%20Publishing%20City%20Free%20Zone%20,%20Sharjah%20United%20Arab%20Emirates&t=&z=13&ie=UTF8&iwloc=&output=embed" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <div class="col-md-5">
               <ul class="nav d-block contact-list">
                   <li><span>Company Name </span>:  <span class="right-c">iEdu FZE-LLC </span></li>
                   <li><span>Complete Office  </span>:  <span class="right-c"></span></li>
                   <li><span>Address <small class="address-s">(Office/Shop/Apt. No., Building, Area, City)</small> </span>: 
                   <span class="right-c">Business Center, Sharjah
Publishing City Free Zone , Sharjah
United Arab Emirates
            </span>

</li>
                   <li><span>Country </span>:  <span class="right-c">United Arab Emirates</span></li>
                   <li><span> P.O Box No. </span>:  <span class="right-c"></span></li>
                   <li><span>Contact Number </span>:  <span class="right-c">00971566212335 </span></li>
                   <li><span>Email Address </span>:  <span class="right-c">info@iedu.ae </span></li>
               </ul>
            </div>
        </div>
       </div>
</section>

<div class="cursor"></div>



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
</script>

<script>
    const cursor = document.querySelector('.cursor');

    document.addEventListener('mousemove', e => {
        cursor.setAttribute("style", "top: " + (e.pageY - 10) + "px; left: " + (e.pageX - 10) + "px;")
    })

    document.addEventListener('click', () => {
        cursor.classList.add("expand");
        setTimeout(() => {
            cursor.classList.remove("expand");
        }, 500)
    })
</script>

@endsection
